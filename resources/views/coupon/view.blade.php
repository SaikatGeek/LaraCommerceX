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
							      <th scope="col">Product Name</th>
							      <th scope="col">Discount Amount(%)</th>
							      <th scope="col">Valid Till</th>
							      <th scope="col">Status</th>
							     
							      
							    </tr>
							  </thead>
							  <tbody>
							  	@forelse($Coupons as $coupon)
							  	  <tr>
							  	  	<td>{{ $loop->index+1 }}</td>
							  	  	<td>{{ $coupon->coupon_name }}</td>
							  	  	<td>{{ $coupon->discount_amount }}</td>
							  	  	<td>{{ $coupon->valid_till }}</td>		  	  	
							  	  	<td>
							  	  		@if(Carbon\Carbon::now()->format('Y-m-d') <= $coupon->valid_till )
							  	  			<span class="text-success">Valid</span>
							  	  		@else
							  	  			<span class="text-danger">Invalid</span>
							  	  		@endif
							  	  	</td>		  	  	
							  	  	
							  	  </tr>
							  	@empty
							  	  <tr>
							  	  	<td colspan="4" class="text-center">No Coupon</td>
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
						Add Coupon Form
					</div>

					<div class="card-body">	
						@if(session('status'))
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
						
						<form action="{{ url('coupon/add') }}" method="post" enctype="multipart/form-data">
							@csrf

						  <div class="form-group">
						    <label>Coupon Name</label>
						    <input type="text" name="coupon_name" class="form-control">		    
						  </div> 

						  <div class="form-group">
						    <label>Discount Amount(%) </label>
						    <input type="text" name="discount_amount" class="form-control">		    
						  </div> 

						  <div class="form-group">
						    <label>Valid Till(Date)</label>
						    <input type="date" name="valid_till" class="form-control">		    
						  </div>

						  
						  
						  <button type="submit" class="btn btn-success">Add Coupon</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection


