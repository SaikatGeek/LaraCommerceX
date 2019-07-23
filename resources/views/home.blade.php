@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table">
                      <thead class="thead-dark">
                        <tr>
                          <th>name</th>
                          <th>name</th>
                          <th>name</th>
                          <th>name</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($All_User as $User)
                        <tr>
                          <td>{{ $User->name }}</td>
                          <td>{{ $User->email }}</td>
                          <td>{{ $User->created_at }}</td>
                          <td>{{ $User->updated_at }}</td>
                          
                        </tr>
                        @endforeach
                        
                      </tbody>
                    </table>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
