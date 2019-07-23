@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-6 offset-3">
			<nav aria-label="breadcrumb">
			  <ol class="breadcrumb">
			    <li class="breadcrumb-item"><a href="{{ url('home') }}">Dashboard</a></li>
			    <li class="breadcrumb-item"><a href="{{ url('add/product/view') }}">Product List</a></li>
			    <li class="breadcrumb-item active" aria-current="page">{{ $single_product_info->product_name }}</li>
			  </ol>
			</nav>
			<div class="card">
				<div class="card-header bg-primary">
					Edit Product Form
					{{ $single_product_info }}
				</div>
				<div class="card-body">
					@if(session('EditStatus'))
						<div class="alert alert-success">
							{{ session('EditStatus') }}
						</div>
						@endif
					<form method="post" action="{{ url('edit/product/insert') }}" enctype="multipart/form-data">
						@csrf
						
						<input type="hidden" name="product_id" value="{{$single_product_info->id}}">
						<div class="form-group">
						    <label>Product name</label>
						    <input type="text" class="form-control" placeholder="Enter Product name" name="product_name" value="{{ $single_product_info->product_name }}">						    
						  </div>

						  <div class="form-group">
						    <label>Product Description</label>
						    <textarea class="form-control" rows="3" name="product_description"> {{$single_product_info->product_description}}</textarea>		    
						  </div>

						   <div class="form-group">
						    <label>Product Price</label>
						    <input type="text" class="form-control" placeholder="Enter Product Price" name="product_price" value="{{$single_product_info->product_price}}">		    
						  </div>

						   <div class="form-group">
						    <label>Product Quantity</label>
						    <input type="text" class="form-control" placeholder="Enter Product Quantity" name="product_quantity" value="{{$single_product_info->product_quantity}}">		    
						  </div>
						  
						   <div class="form-group">
						    <label>Alert Quantity</label>
						    <input type="text" class="form-control" placeholder="Enter Alert Quantity" name="alert_quantity" value="{{$single_product_info->alert_quantity}}">		    
						  </div>

						  <div class="form-group">
						    <label>Product Image</label>
						    <input type="file" class="form-control" name="product_image" >	
						    <img class="mt-3" src="{{ asset('uploads/product_photos') }}/{{ $single_product_info->product_image }}" alt="Not found" width="150">  
						  </div>
						  
						  <button type="submit" class="btn btn-warning">Edit Products</button>
					</form>
				</div>
			</div>
		</div>
	</div>	
</div>


@endsection