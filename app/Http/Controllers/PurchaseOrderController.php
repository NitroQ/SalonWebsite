<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\PurchaseOrder;
use App\PurchaseOrderProducts as PurchaseOrderProduct;
use App\Suppliers as Supplier;

use DB;
use Exception;
use Log;
use Validator;

class PurchaseOrderController extends Controller
{
	protected function index(Request $req) {
		$purchase_order = PurchaseOrder::query();

		if ($req->has('search')) {
			$search = $req->search;
			$s = '%'.$search.'%';

			$purchase_order = $purchase_order->where('purchase_orders.id', 'LIKE', $s);
		}

		return view('admin.purchase-order.index', [
			'search' => $req->search,
			'purchase_order' => $purchase_order->select('purchase_orders.*')->distinct()->get()
		]);
	}

	protected function create() {
		return view('admin.purchase-order.create', [
			'supplier' => Supplier::get()
		]);
	}

	protected function store(Request $req) {
		// dd($req);

		$validator = Validator::make($req->all(), [
			'supplier' => 'required|numeric|min:1',
			'description' => 'max:16777215',
			'product_name' => 'required|array',
			'product_price' => 'required|array',
			'product_qty' => 'required|array',
			'product_description' => 'required|array',
			'product_name.*' => 'required|max:255',
			'product_price.*' => 'required|numeric',
			'product_qty.*' => 'required|numeric|min:1',
			'product_description.*' => 'max:16777215'
		], [
			'supplier.required' => 'Please select a supplier.',
			'supplier.numeric' => 'Please refrain from modifying the page through the Dev Tools or Inspect Element.',
			'supplier.min' => 'Please select a supplier.',
			'description.max' => 'Maximum characters reached, please shorten the description.',
			'product_name.required' => 'Please refrain from modifying the page through the Dev Tools or Inspect Element.',
			'product_name.array' => 'Please refrain from modifying the page through the Dev Tools or Inspect Element.',
			'product_price.required' => 'Please refrain from modifying the page through the Dev Tools or Inspect Element.',
			'product_price.array' => 'Please refrain from modifying the page through the Dev Tools or Inspect Element.',
			'product_qty.required' => 'Please refrain from modifying the page through the Dev Tools or Inspect Element.',
			'product_qty.array' => 'Please refrain from modifying the page through the Dev Tools or Inspect Element.',
			'product_description.required' => 'Please refrain from modifying the page through the Dev Tools or Inspect Element.',
			'product_description.array' => 'Please refrain from modifying the page through the Dev Tools or Inspect Element.',
			'product_name.*.required' => 'The name of the product is required.',
			'product_name.*.max' => 'Maximum characters reached, please shorten the name.',
			'product_price.*.required' => 'Please provide a price for the product.',
			'product_price.*.numeric' => 'Please provide a valid price.',
			'product_qty.*.required' => 'Please provide a quantity for the product',
			'product_qty.*.numeric' => 'Please provide a valid quantity of this product.',
			'product_qty.*.min' => 'Minimum quantity that can be included here is 1.',
			'product_description.*.max' => 'Maximum characters reached, please shorten the description.'
		]);

		if ($validator->fails()) {
			$prod_err = '';

			if (count($req->product_name) <= 1)
				$prod_err = 'Atleast one (1) product must be added to the purchase order.';

			return redirect()
				->back()
				->withErrors($validator)
				->withInput()
				->with('product_error', $prod_err);
		}

		try {
			DB::beginTransaction();

			$po = PurchaseOrder::create([
				'supplier_id' => $req->supplier,
				'description' => $req->description
			]);

			for ($i = 1; $i < count($req->product_name); $i++) {
				PurchaseOrderProduct::create([
					'purchase_order_id' => $po->id,
					'product_name' => $req->product_name[$i],
					'price' => $req->product_price[$i],
					'quantity' => $req->product_qty[$i],
					'description' => $req->product_description[$i]
				]);
			}

			DB::commit();
		} catch (Exception $e) {
			DB::rollback();
			Log::error($e);

			return redirect()
				->route('admin.purchase-order.index')
				->with('flash_error', 'Something went wrong, please try again later.');
		}

		return redirect()
			->route('admin.purchase-order.index')
			->with('flash_success', 'Successfuly added purchase order.');
	}

	protected function show($id) {
		return view('admin.purchase-order.show', [
			'purchase_order' => PurchaseOrder::find($id)
		]);
	}

	protected function edit($id) {
		return view('admin.purchase-order.edit', [
			'purchase_order' => PurchaseOrder::find($id),
			'supplier' => Supplier::get()
		]);
	}

	protected function update(Request $req, $id) {
		// dd($req);

		$validator = Validator::make($req->all(), [
			'supplier' => 'required|numeric|min:1',
			'description' => 'max:16777215',
			'product_name' => 'required|array',
			'product_price' => 'required|array',
			'product_qty' => 'required|array',
			'product_description' => 'required|array',
			'product_name.*' => 'required|max:255',
			'product_price.*' => 'required|numeric',
			'product_qty.*' => 'required|numeric|min:1',
			'product_description.*' => 'max:16777215'
		], [
			'supplier.required' => 'Please select a supplier.',
			'supplier.numeric' => 'Please refrain from modifying the page through the Dev Tools or Inspect Element.',
			'supplier.min' => 'Please select a supplier.',
			'description.max' => 'Maximum characters reached, please shorten the description.',
			'product_name.required' => 'Please refrain from modifying the page through the Dev Tools or Inspect Element.',
			'product_name.array' => 'Please refrain from modifying the page through the Dev Tools or Inspect Element.',
			'product_price.required' => 'Please refrain from modifying the page through the Dev Tools or Inspect Element.',
			'product_price.array' => 'Please refrain from modifying the page through the Dev Tools or Inspect Element.',
			'product_qty.required' => 'Please refrain from modifying the page through the Dev Tools or Inspect Element.',
			'product_qty.array' => 'Please refrain from modifying the page through the Dev Tools or Inspect Element.',
			'product_description.required' => 'Please refrain from modifying the page through the Dev Tools or Inspect Element.',
			'product_description.array' => 'Please refrain from modifying the page through the Dev Tools or Inspect Element.',
			'product_name.*.required' => 'The name of the product is required.',
			'product_name.*.max' => 'Maximum characters reached, please shorten the name.',
			'product_price.*.required' => 'Please provide a price for the product.',
			'product_price.*.numeric' => 'Please provide a valid price.',
			'product_qty.*.required' => 'Please provide a quantity for the product',
			'product_qty.*.numeric' => 'Please provide a valid quantity of this product.',
			'product_qty.*.min' => 'Minimum quantity that can be included here is 1.',
			'product_description.*.max' => 'Maximum characters reached, please shorten the description.'
		]);

		if ($validator->fails()) {
			$prod_err = '';

			if (count($req->product_name) <= 1)
				$prod_err = 'Atleast one (1) product must be added to the purchase order.';

			return redirect()
				->back()
				->withErrors($validator)
				->withInput()
				->with('product_error', $prod_err);
		}

		$po = PurchaseOrder::find($id);

		if ($po == null)
			return redirect()
				->route('admin.purchase-order.index')
				->with('flash_info', 'Purchase Order doesn\'t exists! Please try to refresh the page.');

		$pageIsModified = false;
		try {
			DB::beginTransaction();

			// Updating the Purchase Order
			$po->supplier_id = $req->supplier;
			$po->description = $req->description;
			$po->save();

			// Removing the Purchase Order Products that's been removed
			if ($req->has('removed_product'))
				for ($i = 0; $i < count($req->removed_product); $i++)
					PurchaseOrderProduct::find($req->removed_product[$i])->delete();

			// Updating the Purchase Order Products
			for ($i = 0; $i < count($req->product_name); $i++) {
				if ($req->product_type[$i] == 'old') {
					$pop = PurchaseOrderProduct::find($req->product_id)->first();

					$pop->product_name = $req->product_name[$i];
					$pop->price = $req->product_price[$i];
					$pop->quantity = $req->product_qty[$i];
					$pop->description = $req->product_description[$i];
					$pop->save();
				}
				else if ($req->product_type[$i] == 'new') {
					PurchaseOrderProduct::create([
						'purchase_order_id' => $po->id,
						'product_name' => $req->product_name[$i],
						'price' => $req->product_price[$i],
						'quantity' => $req->product_qty[$i],
						'description' => $req->product_description[$i]
					]);
				}
				else if ($req->product_type[$i] == 'skip') {
					continue;
				}
				else {
					$pageIsModified = true;
					throw new Exception('The page is modified and the form was tampered. Aborting update...');
				}
			}

			DB::commit();
		} catch (Exception $e) {
			DB::rollback();
			Log::error($e);

			if ($pageIsModified)
				return redirect()
					->route('admin.purchase-order.index')
					->with('flash_error', 'The page is modified and the form was tampered! Update aborted.');

			return redirect()
				->route('admin.purchase-order.index')
				->with('flash_error', 'Something went wrong, please try again later.');
		}

		return redirect()
			->route('admin.purchase-order.index')
			->with('flash_success', 'Successfuly updated purchase order.');
	}

	protected function delete($id) {
		$po = PurchaseOrder::find($id);

		if ($po == null)
			return redirect()
				->route('admin.purchase-order.index')
				->with('flash_info', 'Purchase Order doesn\'t exists! Please try to refresh the page.');

		try {
			DB::beginTransaction();

			$po->delete();

			DB::commit();
		} catch (Exception $e) {
			DB::rollback();
			Log::error($e);

			return redirect()
				->route('admin.purchase-order.index')
				->with('flash_error', 'Something went wrong, please try again later.');
		}
		return redirect()
			->back()
			->with('flash_success', 'Successfully removed purchase order.');
	}

	protected function setStatus($id, $value) {
		$po = PurchaseOrder::find($id);

		if ($po == null)
			return redirect()
				->route('admin.purchase-order.index')
				->with('flash_info', 'Purchase Order doesn\'t exists! Please try to refresh the page.');

		try {
			DB::beginTransaction();
			
			if($value == 1)
				$po->is_accepted = 1;

			$po->status = $value;
			$po->save();

			DB::commit();
		} catch (Exception $e) {
			DB::rollback();
			Log::error($e);

			return redirect()
				->route('admin.purchase-order.index')
				->with('flash_error', 'Something went wrong, please try again later.');
		}
		return redirect()
			->back()
			->with('flash_success', 'Successfuly updates status of purchase order.');
	}
}