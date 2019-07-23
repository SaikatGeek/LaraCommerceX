@extends('layouts.app')

@section('content')
	

	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="card mb-3">
					<div class="card-header">
						List of contact message
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
							      <th>SL. NO</th>			      
							      <th>First Name</th>							      
							      <th>Last Name </th>							      
							      <th>Subject</th>							      
							      <th>Messages</th>							      
							      <th >Action</th>
							      
							    </tr>
							  </thead>
							  <tbody>
							  	@forelse ( $contactmessages as $contactmessage )
							  	 <tr class="{{ ($contactmessage->read_status==1)? "bg-secondary":"" }}">		
							  	  <td>
							  	  	{{ $loop->index + 1 }}
							  	  </td>		      							      
							      <td>{{$contactmessage->first_name}}</td>
							      <td>{{$contactmessage->last_name}}</td>
							      <td>{{$contactmessage->subject}}</td>
							      <td>{{$contactmessage->message}}</td>
							      
							      <td class="">
							      	<div class="btn-group " role="group" aria-label="Basic example">
								      	<a href="{{ url('read/contact/message') }}/{{ $contactmessage -> id }}" class="btn btn-sm btn-danger">Read </a>								      	
								      </div>
							      </td>
							      
							    </tr>
							    @empty
							    <tr class="text-center text-danger">
							    	<td colspan="9">
							    		No data available
							    	</td>
							    </tr>
							  	@endforelse
							   
							    
							  </tbody>
							</table>

							
					</div>
				</div>
				
			</div>

		</div>
	</div>

@endsection


