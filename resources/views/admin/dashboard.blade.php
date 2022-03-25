@extends('template.admin')

@section('title', 'Dashboard')

@section('css')
<style type="text/css">
	div.table-container {
		overflow-x: auto;
	}

	div.table-container > table {
		white-space: nowrap;
	}
</style>
@endsection

@section('body')
<h1 class="font-weight-bold">Dashboard Overview</h1>

<hr class="hr-thick" style="border-color: #707070;">

{{-- FIRST ROW --}}
<div class="row mx-0 mt-2 mb-5">
	{{-- INVOICE TOTAL --}}
	<div class="col-3">
		<div class="px-2 d-flex flex-d-row border rounded dark-shadow summary-card h-100">
			<i class="fas fa-file-invoice fa-5x mx-2 my-auto"></i>
			<div class="d-flex flex-d-col text-right w-100">
				<h4 class="h-50">Invoice Total</h4>
				<h1 class="h-50">{{ $invoice }}</h1>
			</div>
		</div>
	</div>

	{{-- PAID TOTAL --}}
	<div class="col-3">
		<div class="px-2 d-flex flex-d-row border rounded dark-shadow summary-card h-100">
			<i class="fas fa-receipt fa-5x mx-2 my-auto"></i>
			<div class="d-flex flex-d-col text-right w-100">
				<h4 class="h-50">Sales Total</h4>
				<h1 class="h-50">{{ number_format($totalsales,2) }} </h1>
			</div>
		</div>
	</div>

	{{-- UNPAID TOTAL --}}
	<div class="col-3">
		<div class="px-2 d-flex flex-d-row border rounded dark-shadow summary-card h-100">
			<i class="fas fa-wine-bottle fa-5x mx-2 my-auto"></i>
			<div class="d-flex flex-d-col text-right w-100">
				<h4 class="h-50">Low Stock</h4>
				<h1 class="h-50">{{ $stock }}</h1>
			</div>
		</div>
	</div>

	{{-- INVOICE TOTAL --}}
	<div class="col-3">
		<div class="px-2 d-flex flex-d-row border rounded dark-shadow summary-card h-100">
			<i class="fas fa-history fa-5x fa-flip-horizontal mx-2 my-auto"></i>
			<div class="d-flex flex-d-col text-right w-100">
				<h4 class="h-50">Pending Purchases</h4>
				<h1 class="h-50">{{ $purchases }}</h1>
			</div>
		</div>
	</div>
</div>






@endsection

