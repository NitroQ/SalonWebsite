<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\SalesOrder;

use Auth;
use DB;
use Excel;
use Log;
use Validator;

class SalesOrderController extends Controller
{
	protected function index(Request $req) {
		$sales_order = SalesOrder::query();

		if ($req->has('search')) {
			$search = $req->search;
			$s = '%'.$search.'%';

			$sales_order = $sales_order->leftJoin('sales_order_products', 'sales_order_products.sales_order_id', '=', 'sales_orders.id')
				->leftJoin('products', 'products.id', '=', 'sales_order_products.product_id');

			$sales_order = $sales_order->where('sales_orders.customer_name', 'LIKE', $s)
				->orWhere('sales_orders.id', 'LIKE', $s)
				->orWhere('sales_orders.description', 'LIKE', $s)
				->orWhere('products.product_name', 'LIKE', $s);
		}

		return view('admin.sales-order.index', [
			'search' => $req->search,
			'sales_order' => $sales_order->select('sales_orders.*')->distinct()->get()
		]);
	}

	protected function edit($id) {
		$sales_order = SalesOrder::find($id);
		return view('admin.sales-order.edit', [
			'sales_order' => $sales_order
		]);
	}

	protected function update(Request $req, $id) {
		try {
			DB::beginTransaction();

			$sales_order = SalesOrder::find($id);
			$sales_order->customer_name = $req->customer_name;
			$sales_order->description = $req->description;
			$sales_order->save();

			DB::commit();
		} catch (\Exception $e) {
			Log::error($e);
			DB::rollback();

			return redirect()
				->back()
				->with('flash_error', 'Something went wrong, please try again later.');
		}

		return redirect()
			->route('admin.sales-order.index')
			->with('flash_success', 'Successfully updated Order#'. $sales_order->id);
	}

	protected function show($id) {
		$sales_order = SalesOrder::find($id);

		return view('admin.sales-order.show', [
			'sales_order' => $sales_order
		]);
	}

	protected function printSO($id) {
		$sales_order = SalesOrder::find($id);

		return view('admin.sales-order.print', [
			'sales_order' => $sales_order
		]);
	}

	protected function dailysales(Request $req){
		$dsales = SalesOrder::query();
		return view('admin.daily-sales.index', [
			'search' => $req->search,
			'sales_order' => $dsales->get(),
			'start_date' => null,
			'end_date' => null
		]);
	}

	protected function filter(Request $request){
		$validator = Validator::make($request->all(),[
			'start_date' => 'required|date',
			'end_date' => 'required|date',
		],[
			'start_date.required' => 'Please add a starting date.',
			'end_date.required' => 'Please add a end date date.',
			'start_date.date' => 'Invalid Starting Date',
			'end_date.date' => 'Invalid End Date',
		]);

		if ($validator->fails()) {

			return redirect()
				->back()
				->withErrors($validator)
				->withInput();
		}

		$sales_order = SalesOrder::whereDate('created_at','<=',$request->end_date)
			->whereDate('created_at','>=',$request->start_date);
	 
	   return view('admin.daily-sales.index', [
		   'sales_order' => $sales_order->get(),
		   'start_date' => $request->start_date,
		   'end_date' => $request->end_date
	   ]);
	}

	protected function printReport(Request $req) {
		$so = SalesOrder::whereDate('created_at', '<=', $req->print_end_date)
			->whereDate('created_at', '>=', $req->print_start_date)
			->get();

		$total_sales = 0; 
		foreach($so as $prod){
			$total_sales += $prod->total();
		}

		return view('admin.daily-sales.print', [
			'sales_order' => $so,
			'start_date' => $req->print_start_date,
			'end_date' => $req->print_end_date,
			'total_sales' => $total_sales
		]);
	}

	protected function downloadPdfReport(Request $req) {
		$so = SalesOrder::whereDate('created_at', '<=', $req->pdf_end_date)
			->whereDate('created_at', '>=', $req->pdf_start_date)
			->get();

			$total_sales = 0; 
			foreach($so as $prod){
				$total_sales += $prod->total();
			}

		return view('admin.daily-sales.print', [
			'sales_order' => $so,
			'start_date' => $req->pdf_start_date,
			'end_date' => $req->pdf_end_date,
			'total_sales' => $total_sales
		]);
	}

	protected function downloadCsvReport(Request $req) {
		$so = SalesOrder::whereDate('created_at', '<=', $req->csv_end_date)
			->whereDate('created_at', '>=', $req->csv_start_date)
			->get();

		$header = array(
			"Content-type"			=> "text/csv",
			"Content-Disposition"	=> "attachment; filename=report.csv",
			"Pragma"				=> "no-cache",
			"Cache-Control"			=> "must-revalidate, post-check=0, pre-check=0",
			"Expires"				=> "0"
		);

		$columns = array(
			'Order #',
			'Order Date',
			'Description',
			'Customer Name',
			'Services',
			'Total'
		);

		$callback = function() use ($so, $columns) {
			$file = fopen('php://output', 'w');
			fputcsv($file, $columns);

			foreach ($so as $o) {
				$row['Order #'] = $o->id;
				$row['Order Date'] = \Carbon\Carbon::parse($o->created_at)->format('M d, Y');
				$row['Description'] = $o->description;
				$row['Customer Name'] = $o->customer_name;

				$service = "";
				$total = 0;
				foreach ($o->salesOrderService as $s) {
					$service .= $s->service()->service_name;

					if ($s->serviceVariation->variation_name != null)
						$service .= " - " . $s->serviceVariation->variation_name . ", ";
					else
						$service .= ", ";

					$total += $s->price * $s->quantity;
				}

				$row['Services'] = $service;
				$row['Total'] = "" . number_format($total, 2);

				fputcsv($file, array(
					$row['Order #'],
					$row['Order Date'],
					$row['Description'],
					$row['Customer Name'],
					$row['Services'],
					$row['Total']
				));
			}
			fclose($file);
		};

		return response()->stream($callback, 200, $header);
	}

	protected function downloadXlsReport(Request $req) {
		$so = SalesOrder::whereDate('created_at', '<=', $req->xls_end_date)
			->whereDate('created_at', '>=', $req->xls_start_date)
			->get();

		$xls = Excel::create("report", function($excel) use ($so, $req) {
			$excel->setTitle('Report for ' . \Carbon\Carbon::parse($req->xls_start_date)->format('M d, Y') . ' to ' . \Carbon\Carbon::parse($req->xls_end_date)->format('M d, Y'));
			$excel->setCreator(Auth::user()->first_name . ' ' . Auth::user()->last_name)
				->setCompany('Salon Headaway');
			$excel->setDescription('Sales Order report for ' . \Carbon\Carbon::parse($req->xls_start_date)->format('M d, Y') . ' to ' . \Carbon\Carbon::parse($req->xls_end_date)->format('M d, Y'));

			$excel->sheet('Sales Orders', function($sheet) use ($so, $req) {
				$columns = array(
					'Order #',
					'Order Date',
					'Description',
					'Customer Name',
					'Services',
					'Total'
				);

				$sheet->row(1, $columns);

				foreach ($so as $o) {
					$service = "";
					$total = 0;
					foreach ($o->salesOrderService as $s) {
						$service .= $s->service()->service_name;

						if ($s->serviceVariation->variation_name != null)
							$service .= " - " . $s->serviceVariation->variation_name . ", ";
						else
							$service .= ", ";

						$total += $s->price * $s->quantity;
					}
					
					$sheet->appendRow(array(
						$o->id . "",
						\Carbon\Carbon::parse($o->created_at)->format('M d, Y') . "",
						$o->description . "",
						$o->customer_name . "",
						$service . "",
						number_format($total, 2) . ""
					));
				}
			});
		})->download('xls');
	}
}