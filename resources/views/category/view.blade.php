@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-8">
				<div class="card mb-3">
					<div class="card-header">
						Product List
					</div>
					

					<div class="card-body">
						<table class="table table-bordered">
							  <thead>
							    <tr>	
							      <th scope="col">SL. NO</th>			      
							      <th scope="col">Category Name</th>					      
							      <th scope="col">Menu Status</th>					      
							      <th scope="col">Created At</th> 
							      <th scope="col">Action</th> 
							      
							    </tr>
							  </thead>
							  <tbody>
							  	@forelse($categories as $category)
							  	 <tr>		
								  	  <td>
								  	  	{{ $loop->index + 1 }}
								  	  </td>		      
								      <td>{{ $category->category_name }}</td>
								      <td>{{ ($category->menu_status == 1) ? "YES":"NO" }}</td>
								      <td>
								      	{{$category->created_at->format('d-m-Y h:i:s A')}}
								      	<br>
								      	{{ $category->created_at->diffForHumans() }}
								      </td>
								      <td>
								      	<a href="{{ url('change/menu/status') }}/{{ $category->id }}" type="button" class="btn btn-info btn-sm" >Change</a>
								      </td>
								 </tr>
							       
							  	@empty
							  		<tr class="text-center text-danger">
							  			<td colspan="3">No Data Available</td>
							  		</tr>
							  	@endforelse
							   
							    
							  </tbody>
							</table>

							
					</div>
				</div>
				
			</div>
			<div class="col-4">
				<div class="card">
					<div class="card-header">
						A Classic Card
					</div>

					<div class="card-body">
						@if($errors->all())
						<div class="alert alert-danger">

							@foreach($errors->all() as $error )
								<li>{{ $error }}</li>
							@endforeach

						</div>
						@endif

						@if (session('status'))
							<div class="alert alert-success">
							{{ session('status') }}
						</div>
						@endif
						
						<form action="{{ url('add/category/insert') }}" method="post">
							@csrf

						  <div class="form-group">
						    <label>Category name</label>
						    <input type="text" class="form-control" placeholder="Enter Category name" name="category_name" >						    
						  </div>

						  <div class="form-group">
						    
						    <input type="checkbox" name="menu_status" value="1" id="menu"> <label for="menu">Use as Menu</label>					    
						  </div>

						  <button type="submit" class="btn btn-primary">Submit</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection


