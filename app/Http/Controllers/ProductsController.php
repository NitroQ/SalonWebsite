<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Http\Requests;

use App\Product;
use Session;
use Validator;
use Hash;
use Log;
use DB;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        $products = Product::query();

        if ($req->has('search')) {
			$search = $req->search;
			$s = '%'.$search.'%';

                $products = $products->where('products.product_name', 'LIKE', $s)
				->orWhere('products.id', 'LIKE', $s)
				->orWhere('products.description', 'LIKE', $s);
		}


		return view('admin.products.index', [
			'search' => $req->search,
			'products' => $products->get()
		]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $req)
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function store(Request $req) {
		$validator = Validator::make($req->all(), [
            'product_name'=> 'required|min:2',
            'price' => 'required|numeric',
            'in_stock' => 'required|numeric',       
		], [
			'product_name.required' => 'Product Name is required.',
            'product_name.min' => 'Product Name is short.',
			'price.required' => 'Price is required.',
			'price.numeric' => 'Price must only contains number.',
			'in_stock.required' => 'Quantity is required.',
            'in_stock.numeric' => 'Quantity is invalid.',
		]);

		if ($validator->fails()){
			return redirect()
				->back()
				->withErrors($validator)
				->withInput();
        }
        if($req->in_stock == 0){
            $status = 0;
        } 
        else{
            $status = 1;
        }


		try {
            DB::beginTransaction();
			$products = Product::create([
                'product_name' => $req->product_name,
                'price' => $req->price,
                'description' => $req->description,
                'in_stock' => $req->in_stock,
                'status' => $status
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
			->route('admin.products.index')
			->with('flash_success', 'Sucessfully Added ' . $req->product_name);
	}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $products = Product::find($id);
		return view('admin.products.edit', [
			'products' => $products
		]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    protected function update(Request $req, $id) {
        $validator = Validator::make($req->all(), [
            'product_name'=> 'required|min:2',
            'price' => 'required|numeric',
            'in_stock' => 'required|numeric',       
		], [
			'product_name.required' => 'Product Name is required.',
            'product_name.min' => 'Product Name is short.',
			'price.required' => 'Price is required.',
			'price.numeric' => 'Price must only contains number.',
			'in_stock.required' => 'Quantity is required.',
            'in_stock.numeric' => 'Quantity is invalid.',
		]);

		if ($validator->fails()){
			return redirect()
				->back()
				->withErrors($validator)
				->withInput();
        }
        if($req->in_stock == 0){
             $status = 0;
         } 
        else{
             $status = 1;
         }   
              

		try {
			DB::beginTransaction();

			$products = Product::find($id);
            $products->product_name = $req->product_name;
            $products->price= $req->price;
            $products->description = $req->description;
            $products->in_stock = $req->in_stock;
            $products->status = $status;
			$products->save();

			DB::commit();
		} catch (\Exception $e) {
			Log::error($e);
			DB::rollback();

			return redirect()
				->back()
				->with('flash_error', 'Something went wrong, please try again later.');
		}

		return redirect()
			->route('admin.products.index')
			->with('flash_success', 'Successfully updated' . $req->product_name );
	}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $po = Product::find($id);

		if ($po == null)
			return redirect()
				->route('admin.products.index')
				->with('flash_info', 'Product doesn\'t exists! Please try to refresh the page.');

		try {
			DB::beginTransaction();

			$po->delete();

			DB::commit();
		} catch (Exception $e) {
			DB::rollback();
			Log::error($e);

			return redirect()
				->route('admin.products.index')
				->with('flash_error', 'Something went wrong, please try again later.');
		}
		return redirect()
			->back()
			->with('flash_success', 'Successfully removed product.');
    }
}
