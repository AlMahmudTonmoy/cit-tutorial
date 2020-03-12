@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">All User List</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <!-- <?php
                      print_r($users);
                    ?>
                    You are logged in! -->
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>Sl No</th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Password</th>
                          <th>Account Opened At</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($users as $user)
                        <tr>
                          <th>{{ $loop->index+1 }}</th>
                          <th>{{ $user->name }}</th>
                          <td>{{ $user->email }}</td>
                          <td>{{ $user->password }}</td>
                          <td>
                            @if($user->created_at->diffForHumans() == '1 week ago')
                              {{ $user->created_at->format('d-M-Y H:i:s A') }}
                            @else
                              {{ $user->created_at->diffForHumans() }}
                            @endif
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            {!! $chart->container() !!}
            {!! $chart->script() !!}
        </div>
    </div>
</div>
@endsection
