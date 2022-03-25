<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\ServiceCategory;
use App\SalesOrder;
use App\PurchaseOrder;
use App\Product;

class PageController extends Controller
{
	protected function dashboard(Request $req) {
		$totalsales = 0; $lowstock = 0; $purchase_order = 0; $invoice = 0;

		foreach(SalesOrder::get() as $so){
			$totalsales += $so->total() ;
			$invoice++;
		}
		foreach(Product::get() as $prod){
			if($prod->status == 0)
			$lowstock++;
		}
		foreach(PurchaseOrder::get() as $po){
			if($po->status == 0)
			$purchase_order++;
		}
		
		return view('admin.dashboard', [
			'invoice' => $invoice,
			'totalsales' => $totalsales,
			'stock' => $lowstock,
			'purchases' =>$purchase_order
		]);
	}

	protected function index() {
		return view('index');
	}

	protected function services() {
		$service_categories = ServiceCategory::get();

		return view('services', [
			'service_categories' => $service_categories
		]);
	}

	protected function gallery() {
		return view('gallery');
	}

	protected function contact() {
		return view('contact-us');
	}

	protected function about() {
		return view('about');
	}
}