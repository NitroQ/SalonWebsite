<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Http\Requests;

use App\Suppliers;
use Session;
use Validator;
use Hash;
use Log;
use DB;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        $suppliers = Suppliers::query();

		if ($req->has('search')) {
			$search = $req->search;
			$s = '%'.$search.'%';

			$suppliers = $suppliers->where('suppliers.business_name', 'LIKE', $s)
				->orWhere('suppliers.contact_number', 'LIKE', $s)
				->orWhere('suppliers.address', 'LIKE', $s)
				->orWhere('suppliers.description', 'LIKE', $s)
				->orWhere('suppliers.id', 'LIKE', $s);
		}

		return view('admin.inventory.suppliers.index', [
			'search' => $req->search,
			'suppliers' => $suppliers->get()
		]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $req)
    {
        return view('admin.inventory.suppliers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function store(Request $req) {
		$validator = Validator::make($req->all(), [
			'business_name' => 'required|min:2',
			'contact_number' => 'required|numeric|min:10',
            'address' => 'required|min:2',
        
		], [
			'business_name.required' => 'Business Name is required.',
			'contact_number.required' => 'Contact number is required.',
			'contact_number.numeric' => 'Contact number must only contains number.',
			'contact_number.min' => 'Contact number provided is invalid.',
			'address.required' => 'Address is required.',
			'address.min' => 'Please provide your proper address.',
		]);

		if ($validator->fails()){
			return redirect()
				->back()
				->withErrors($validator)
				->withInput();
        }
		try {
            DB::beginTransaction();
			$supplier = Suppliers::create([
                'business_name' => $req->business_name,
			    'contact_number' => $req->contact_number,
                 'address' =>  $req->address,
                 'description' => $req->description

		
			]);
            DB::commit();
		
		} catch (\Exception $e) {
			Log::error($e);
			DB::rollback();

			return redirect()
				->back()
				->with('flash_error', 'Something went wrong, please try again later.')
				->withInput();
		}

		return redirect()
			->route('admin.inventory.suppliers.index')
			->with('flash_success', 'Sucessfully Added ' . $req->business_name);
	}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $supplier = Suppliers::find($id);
		return view('admin.inventory.suppliers.edit', [
			'supplier' => $supplier
		]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id)
    {
        $validator = Validator::make($req->all(), [
			'business_name' => 'required|min:2',
			'contact_number' => 'required|numeric|min:10',
            'address' => 'required|min:2',
        
		], [
			'business_name.required' => 'Business Name is required.',
			'contact_number.required' => 'Contact number is required.',
			'contact_number.numeric' => 'Contact number must only contains number.',
			'contact_number.min' => 'Contact number provided is invalid.',
			'address.required' => 'Address is required.',
			'address.min' => 'Please provide your proper address.',
		]);

		if ($validator->fails())

			return redirect()
				->back()
				->withErrors($validator)
				->withInput();

		try {
			DB::beginTransaction();

			$supplier = Suppliers::find($id);
			$supplier->business_name = $req->business_name;
            $supplier->contact_number = $req->contact_number;
            $supplier->address = $req->address;
            $supplier->description = $req->description;
			$supplier->save();

			DB::commit();
		} catch (\Exception $e) {
			Log::error($e);
			DB::rollback();

			return redirect()
				->back()
				->with('flash_error', 'Something went wrong, please try again later.');
		}

		return redirect()
			->route('admin.inventory.suppliers.index')
			->with('flash_success', 'Successfully updated' . $req->business_name );
	}

    public function destroy($id){
        $po = Suppliers::find($id);

		if ($po == null)
			return redirect()
				->route('admin.inventory.suppliers.index')
				->with('flash_info', 'Supplier doesn\'t exists! Please try to refresh the page.');

		try {
			DB::beginTransaction();

			$po->delete();

			DB::commit();
		} catch (Exception $e) {
			DB::rollback();
			Log::error($e);

			return redirect()
				->route('admin.inventory.suppliers.index')
				->with('flash_error', 'Something went wrong, please try again later.');
		}
		return redirect()
			->back()
			->with('flash_success', 'Successfully removed supplier.');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   

}
