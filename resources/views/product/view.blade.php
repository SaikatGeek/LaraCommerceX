@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-8">
				<div class="card mb-3">
					<div class="card-header">
						Product List
					</div>
					@if (session('deleteStatus'))
							<div class="alert alert-danger">
								{{ session('deleteStatus') }}
							</div>
					@endif

					<div class="card-body table-responsive">
						<table class="table table-bordered">
							  <thead>
							    <tr>	
							      <th scope="col">SL. NO</th>			      
							      <th scope="col">Category Name</th>
							      <th scope="col">Product Name</th>
							      <th scope="col">Product Description</th>
							      <th scope="col">Product Price</th>		
							      <th scope="col">Product Quantity</th>
							      <th scope="col">Alert Quantity</th>
							      <th scope="col">Product Image</th>
							      <th scope="col">Action</th>
							      
							    </tr>
							  </thead>
							  <tbody>
							  	@forelse( $products as $product )
							  	 <tr>		
							  	  <td>
							  	  	{{ $loop->index + 1 }}
							  	  </td>		      
							      {{-- <td>{{ App\Category::find($product->category_id)->category_name }}</td> --}}
							      
							      <td>{{ $product->relationtocategory->category_name }}</td>
							      <td>{{ $product->product_name }}</td>
							      <td>{{str_limit($product->product_description,15)}}</td>
							      <td>{{$product->product_price}}</td>
							      <td>{{$product->product_quantity}}</td>
							      <td>{{$product->alert_quantity}}</td>
							      <td>
							      	<img src="{{ asset('uploads/product_photos') }}/{{ $product->product_image }}" alt="not found" width="50">
							      </td>
							      <td>
							      	<div class="btn-group" role="group" aria-label="Basic example">
								      	<a href="{{ url('delete/product') }}/{{ $product -> id }}" class="btn btn-sm btn-danger">Delete</a>
								      	<a href="{{ url('edit/product') }}/{{ $product -> id }}" class="btn btn-sm btn-info">Edit</a>
								      </div>
							      </td>
							      
							    </tr>
							    @empty
							    <tr class="text-center text-danger">
							    	<td colspan="7">
							    		No data available
							    	</td>
							    </tr>
							  	@endforelse
							   
							    
							  </tbody>
							</table>

							{{ $products -> links() }}
					</div>
				</div>
				<div class="card ">
					<div class="card-header bg-danger">
						Deleted List
					</div>
					@if (session('deleteStatus'))
							<div class="alert alert-danger">
							{{ session('deleteStatus') }}
						</div>
						@endif

					<div class="card-body">
						<table class="table table-bordered">
							  <thead>
							    <tr>	
							      <th scope="col">SL. NO</th>			      
							      <th scope="col">Product Name</th>
							      <th scope="col">Product Description</th>
							      <th scope="col">Product Price</th>		
							      <th scope="col">Product Quantity</th>
							      <th scope="col">Alert Quantity</th>
							      <th scope="col">Action</th>
							      
							    </tr>
							  </thead>
							  <tbody>
							  	@forelse($deleted_products as $deleteproduct)
							  	 <tr>		
							  	  <td>
							  	  	{{ $loop->index + 1 }}
							  	  </td>		      
							      <td>{{$deleteproduct->product_name}}</td>
							      <td>{{str_limit($deleteproduct->product_description,15)}}</td>
							      <td>{{$deleteproduct->product_price}}</td>
							      <td>{{$deleteproduct->product_quantity}}</td>
							      <td>{{$deleteproduct->alert_quantity}}</td>
							      <td>
							      	<div class="btn-group" role="group" aria-label="Basic example">
								      	<a href="{{ url('restore/product') }}/{{ $deleteproduct -> id }}" class="btn btn-sm btn-success">Restore</a>
								      	<a href="{{ url('force/delete/product') }}/{{ $deleteproduct -> id }}" class="btn btn-sm btn-danger">Permanent Delete</a>
								      	
								    </div>
							      </td>
							      
							    </tr>
							    @empty
							    <tr class="text-center text-danger">
							    	<td colspan="7">
							    		No data available
							    	</td>
							    </tr>
							  	@endforelse
							   
							    
							  </tbody>
							</table>

							{{ $products -> links() }}
					</div>
				</div>
			</div>
			<div class="col-4">
				<div class="card">
					<div class="card-header">
						A Classic Card
					</div>

					<div class="card-body">
						@if (session('status'))
							<div class="alert alert-success">
							{{ session('status') }}
						</div>
						@endif
						
						@if($errors->all())
						<div class="alert alert-danger">
							@foreach($errors->all() as $error )
							<li>{{ $error }}</li>
						@endforeach
						</div>
						@endif
						
						<form action="{{ url('add/product/insert') }}" method="post" enctype="multipart/form-data">
							@csrf

						  <div class="form-group">
						    <label>Category name</label>
						    <select class="form-control" name="category_id">
						    	<option value="">-Select One-</option>
						    	@foreach($categories as $category)
						    	   	<option value="{{ $category->id }}">{{ $category->category_name }}</option>
						    	@endforeach
						    </select>				    
						  </div> 

						  <div class="form-group">
						    <label>Product name</label>
						    <input type="text" class="form-control" placeholder="Enter Product name" name="product_name" value="{{ old('product_name') }}">						    
						  </div>

						  <div class="form-group">
						    <label>Product Description</label>
						    <textarea class="form-control" rows="3" name="product_description" > {{ old('product_description')}}</textarea>		    
						  </div>

						  <div class="form-group">
						    <label>Product Price</label>
						    <input type="text" class="form-control" placeholder="Enter Product Price" name="product_price" value="{{ old('product_price') }}">		    
						  </div>

						  <div class="form-group">
						    <label>Product Quantity</label>
						    <input type="text" class="form-control" placeholder="Enter Product Quantity" name="product_quantity"  value="{{ old('product_quantity') }}">		    
						  </div>
						  
						  <div class="form-group">
						    <label>Alert Quantity</label>
						    <input type="text" class="form-control" placeholder="Enter Alert Quantity" name="alert_quantity" value="{{ old('alert_quantity') }}">		    
						  </div>

						   <div class="form-group">
						    <label>Product Image</label>
						    <input type="file" class="form-control" name="product_image" >		    
						  </div>
						  
						  <button type="submit" class="btn btn-primary">Submit</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection


