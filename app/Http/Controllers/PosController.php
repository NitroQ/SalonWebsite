<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\Product;
use App\SalesOrder;
use App\SalesOrderProduct;
use App\SalesOrderService;
use App\ServiceVariation;

use DB;
use Exception;
use Log;
use Response;

class PosController extends Controller
{
	protected function testServer() {
		return "1";
	}

	protected function fetchProducts(Request $req) {
		$products = Product::where('in_stock','>', '0');

		if (!$req->search)
			$products = $products;

		return Response::json([
			'result' => 'okay',
			'products' => $products->distinct()->get()
		], 200, array(), JSON_PRETTY_PRINT);
	}

	protected function fetchServices(Request $req) {
		$services = ServiceVariation::leftJoin('services', 'services.id', '=', 'service_variations.service_id')
			->where('service_variations.variation_name', 'like', '%'.$req->search.'%')
			->orWhere('service_variations.description', 'like', '%'.$req->search.'%')
			->orWhere('services.service_name', 'like', '%'.$req->search.'%')
			->orWhere('services.description', 'like', '%'.$req->search.'%')
			->select('service_variations.*')
			->with('service');

		if (!$req->search)
			$services = $services;

		return Response::json([
			'result' => 'okay',
			'services' => $services->distinct()->get()
		], 200, array(), JSON_PRETTY_PRINT);
	}

	protected function submitPayment(Request $req) {
		try {
			DB::beginTransaction();

			$so = SalesOrder::create([
				'customer_name' => '',
				'description' => ''
			]);

			foreach(json_decode($req->all()["prod"], true) as $k => $v) {
				SalesOrderProduct::insert([
					'sales_order_id' => $so->id,
					'product_id' => $v['id'],
					'quantity' => $v['quantity']
				]);

				$product = Product::find($v['id']);
				$pro_status = 1;

                if($product->in_stock == 1){
                    $pro_status = 0;
                }
				$product->in_stock -= $v['quantity'];
				$product->status = $pro_status;
				$product->save();
			}

			foreach(json_decode($req->all()["serv"], true) as $k => $v) {
				SalesOrderService::insert([
					'sales_order_id' => $so->id,
					'service_variation_id' => $v['id'],
					'price' => $v['price_min'],
					'quantity' => $v['service']['quantity']
				]);
			}

			$payment = json_decode($req->all()["paid"], true);

			DB::commit();
		} catch (Exception $e) {
			DB::rollback();
			Log::error($e);

			return Response::json([
				'success' => false,
				'result' => $e
			], 200, array(), JSON_PRETTY_PRINT);
		}

		return Response::json([
			'success' => true,
			'result'=>'okay'
		], 200, array(), JSON_PRETTY_PRINT);
	}
}