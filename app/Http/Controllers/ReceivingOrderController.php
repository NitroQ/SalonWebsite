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
class ReceivingOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        $purchase_order = PurchaseOrder::where('is_accepted', '=' , '1');
        
        if ($req->has('search')) {
			$search = $req->search;
			$s = '%'.$search.'%';

			$purchase_order = $purchase_order->where('purchase_orders.id', 'LIKE', $s);
		}

		return view('admin.receiving-order.index', [
			'search' => $req->search,
			'purchase_order' => $purchase_order->select('purchase_orders.*')->distinct()->get()
		]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.receiving-order.show', [
			'purchase_order' => PurchaseOrder::find($id)
		]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    protected function setStatus($id, $value) {
		$po = PurchaseOrder::find($id);

		if ($po == null)
			return redirect()
				->route('admin.purchase-order.index')
				->with('flash_info', 'Purchase Order doesn\'t exists! Please try to refresh the page.');

		try {
			DB::beginTransaction();

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
