@extends('template.main')

@section('main-content')

<style>
.card-img-overlay {
	background-image:  linear-gradient(180deg, transparent, transparent, transparent, #0838CA);
}

</style>
{{-- Products --}}
<div class="container py-5">
	<h1 class="font-weight-bold">Services</h1>
	<div class="row">
		<div class="col-6 col-lg-3 mt-3">
			<div class="card rounded">
				<img class="card-img" src="/images/main/haircut.jpg">
				<div class="card-img-overlay text-white d-flex flex-column justify-content-end">
					<h5 class="card-title">Regulars</h5>
				</div>
			</div>
		</div>
		<div class="col-6 col-lg-3 mt-3">
			<div class="card">
				<img class="card-img" src="/images/gallery/a10.jpg">
				<div class="card-img-overlay text-white d-flex flex-column justify-content-end">
					<h5 class="card-title">Treatments</h5>
				</div>
			</div>
		</div>

		<div class="col-6 col-lg-3 mt-3">
			<div class="card rounded">
				<img class="card-img" src="/images/main/Rebond.jpg">
				<div class="card-img-overlay text-white d-flex flex-column justify-content-end">
					<h5 class="card-title">Technical</h5>
				</div>
			</div>
		</div>

		<div class="col-6 col-lg-3 mt-3">
			<div class="card rounded">
				<img class="card-img" src="/images/main/Highlights.jpg">
				<div class="card-img-overlay text-white d-flex flex-column justify-content-end">
					<h5 class="card-title">Coloring</h5>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="container mt-3 p-lg-4">
	<div class="row justify-content-center">
		<div class="col-lg-9 col-12">
			<h1 class="font-weight-bold mb-5 text-center">Prices</h1>

			@foreach ($service_categories as $sc)
			@php ($variations = array())
			<div class="table-responsive px-lg-4 my-3">
				<h3 class="font-weight-bold mb-3 text-center">{{$sc->category_name}}</h3>
				<table class="table table-striped">
					<thead>
						<tr>
							<td></td>
							@foreach ($sc->serviceVariations as $v)
								@if (!in_array($v->variation_name, $variations))
									<td class="font-weight-bold">{{$v->variation_name}}</td>
									@php (array_push($variations, $v->variation_name))
								@endif
							@endforeach
						</tr>
					</thead>

					<tbody>
						@foreach ($sc->services as $s)
							<tr>
								<td class="font-weight-bold">{{$s->service_name}}</td>

								@php ($col = 0)
								@php ($added = 0)
								@foreach ($s->serviceVariations as $sv)
									@if ($s->serviceVariations != null)
										@if ($variations[$col] == $sv->variation_name)
											<td>{{ $sv->getPrice(true) }}</td>
											@if (($col - $added) == (count($s->serviceVariations) - 1) && count($s->serviceVariations) < count($variations))
												@for ($i = 0; $i < (count($variations) - $col - 1); $i++)
													<td></td>
												@endfor
											@endif
										@else
											@php ($subCol = $col + 1)
											@for ($i = 0; $i < $subCol; $i++)
												<td></td>
												@if ($i == 0)
													@php ($col++)
													@php ($added++)
												@endif
											@endfor

											<td>{{ $sv->getPrice(true) }}</td>
										@endif
									@endif

									@php ($col++)
								@endforeach
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			@endforeach

			{{--
				<div class="table-responsive px-lg-4 my-3">
					<h3 class="font-weight-bold mb-3 text-center">Regulars</h3>
					<table class="table table-striped">
						<tbody>
							<tr>
								<td class="font-weight-bold">Haircut with Blowdry</td>
								<td>₱ 70.00</td>

							</tr>
							<tr>
								<td class="font-weight-bold">Haircut with Blowdry and Shampoo</td>
								<td>₱ 100.00 - ₱ 150.00 </td>

							</tr>
							<tr>
								<td class="font-weight-bold">Shampoo and Blowdry</td>
								<td>₱ 80.00 and up</td>

							</tr>
							<tr>
								<td class="font-weight-bold">Shampoo with Blowdry and Iron</td>
								<td>₱ 100.00 and up</td>

							</tr>
							<tr>
								<td class="font-weight-bold">Eyebrow Shaving</td>
								<td>₱ 30.00</td>

							</tr>
							<tr>
								<td class="font-weight-bold">Eyebrow Threading</td>
								<td>₱ 100.00</td>

							</tr>

						</tbody>
					</table>
				</div>

				<div class="table-responsive px-lg-4 my-3">
					<h3 class="font-weight-bold mb-3 text-center">Treatments</h3>
					<table class="table table-striped">
						<tbody>
							<thead>
								<tr>
									<th scope="col"></th>
									<th scope="col">short</th>
									<th scope="col">med</th>
									<th scope="col">long</th>
								</tr>
							</thead>
							<tr>
								<td class="font-weight-bold">Collagen Treatment</td>
								<td>₱ 550.00</td>
								<td>₱ 700.00</td>
								<td>₱ 900.00</td>
							</tr>

							<tr>
								<td class="font-weight-bold">Mask Treatment</td>
								<td>₱ 350.00</td>
								<td>₱ 450.00</td>
								<td>₱ 550.00</td>
							</tr>
							<tr>
								<td class="font-weight-bold">Deep Scalp Cleansing</td>
								<td>₱ 350.00 - ₱ 500.00</td>
								<td></td>
								<td></td>
							</tr>

						</tbody>
					</table>
				</div>

				<div class="table-responsive px-lg-4 my-3">
					<h3 class="font-weight-bold mb-3 text-center">Technical</h3>
					<table class="table table-striped">
						<tbody>
							<thead>
								<tr>
									<th scope="col"></th>
									<th scope="col">short</th>
									<th scope="col">med</th>
									<th scope="col">long</th>
								</tr>
							</thead>
							<tr>
								<td class="font-weight-bold">Brazilian Blowout</td>
								<td>₱ 1000.00</td>
								<td>₱ 1500.00</td>
								<td>₱ 2000.00</td>
							</tr>

							<tr>
								<td class="font-weight-bold">Rebonding</td>
								<td>₱ 1500.00</td>
								<td>₱ 2000.00</td>
								<td>₱ 2500.00</td>
							</tr>
							<tr>
								<td class="font-weight-bold">Perming</td>
								<td>₱ 500.00</td>
								<td>₱ 700.00</td>
								<td>₱ 900.00</td>
							</tr>

						</tbody>
					</table>
				</div>

				<div class="table-responsive px-lg-4 my-3">
					<h3 class="font-weight-bold mb-3 text-center">Coloring</h3>
					<table class="table table-striped">
						<tbody>
							<thead>
								<tr>
									<th scope="col"></th>
									<th scope="col">men</th>
									<th scope="col">short</th>
									<th scope="col">med</th>
									<th scope="col">long</th>
								</tr>
							</thead>
							<tr>
								<td class="font-weight-bold">Color</td>
								<td>₱ 350.00</td>
								<td>₱ 550.00</td>
								<td>₱ 750.00</td>
								<td>₱ 950.00</td>
							</tr>
							<tr>
								<td class="font-weight-bold">Gloss Treatment</td>
								<td></td>
								<td>₱ 600.00</td>
								<td>₱ 750.00</td>
								<td>₱ 850.00</td>
							</tr>
							<tr>
								<td class="font-weight-bold">Cellophane</td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td class="font-weight-bold">Highlights (traditional)</td>
								<td></td>
								<td>₱ 550.00</td>
								<td>₱ 800.00</td>
								<td></td>
							</tr>
							<tr>
								<td class="font-weight-bold">Highlights (foil)</td>
								<td></td>
								<td>₱ 50.00/foil</td>
								<td>₱ 70/foil</td>
								<td>₱ 90/foil</td>
							</tr>
							<tr>
								<td class="font-weight-bold">Balayage/Ombre</td>
								<td></td>
								<td>₱ 900.00</td>
								<td>₱ 1500.00</td>
								<td>₱ 2000.00</td>
							</tr>
							<tr>
								<td class="font-weight-bold">Bleaching with iplex</td>
								<td></td>
								<td>₱ 650.00</td>
								<td>₱ 850.00</td>
								<td>₱ 1050.00</td>
							</tr>
						</tbody>
					</table>
				</div>
			--}}
		</div>
	</div>
</div>
@endsection