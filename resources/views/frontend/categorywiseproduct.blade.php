@extends('layouts.frontendapp')

@section('frontend_content')

	<!-- Page Info -->
	<div class="page-info-section page-info-big">
		<div class="container">
			<h2>{{$category_name->category_name}}</h2>
			<div class="site-breadcrumb">
				<a href="{{url('/')}}">Home</a> / 
				<span>{{$category_name->category_name}}</span>
			</div>
			<img src="img/categorie-page-top.png" alt="" class="cata-top-pic">
		</div>
	</div>
	<!-- Page Info end -->


	<!-- Page -->
	<div class="page-area categorie-page spad">
		<div class="container">
			<div class="categorie-filter-warp">
				<p>Showing 12 results</p>
				<div class="cf-right">
					<div class="cf-layouts">
						<a href="#"><img src="img/icons/layout-1.png" alt=""></a>
						<a class="active" href="#"><img src="img/icons/layout-2.png" alt=""></a>
					</div>
					<form action="#">
						<select>
							<option>Color</option>
						</select>
						<select>
							<option>Brand</option>
						</select>
						<select>
							<option>Sort by</option>
						</select>
					</form>
				</div>
			</div>
			<div class="row">
				@forelse ( $products as $product)

				<div class="col-lg-3">
					<div class="product-item">
						<figure>
							<img src="{{  asset('uploads/product_photos/') }}/{{ $product->product_image }}" alt="">
							<div class="pi-meta">
								<div class="pi-m-left">
									<img src="img/icons/eye.png" alt="">
									<p>quick view</p>
								</div>
								<div class="pi-m-right">
									<img src="img/icons/heart.png" alt="">
									<p>save</p>
								</div>
							</div>
						</figure>
						<div class="product-info">
							<h6>{{ $product->product_name }}</h6>
							<p>${{ $product->product_price }}</p>
							<a href="{{ url('/product/details/') }}/{{ $product->id }}" class="site-btn btn-line">ADD TO CART</a>
						</div>
					</div>
				</div>		
				@empty
					NAI
				@endforelse		
			</div>			
		</div>
	</div>
	<!-- Page -->

@endsection