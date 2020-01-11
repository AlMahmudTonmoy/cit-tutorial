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
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>Sl No</th>
                          <th>First Name</th>
                          <th>Email</th>
                          <th>Website</th>
                          <th>Uploaded File</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($contacts as $contact)
                        <tr>
                          <th>{{ $loop->index+1 }}</th>
                          <th>{{ $contact->first_name }}</th>
                          <td>{{ $contact->email }}</td>
                          <td>{{ $contact->website }}</td>
                          <td>
                            @if ($contact->upload_file == 'not inserted')
                              -
                            @else
                              <a href="{{ asset('storage\contacts_uploads') }}/{{ $contact->upload_file }}" class="btn btn-primary" target="_blank">View Now</a>
                              <a href="{{ url('contact/upload/download') }}/{{ $contact->upload_file }}" class="btn btn-primary">Download Now</a>
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
</div>
@endsection
