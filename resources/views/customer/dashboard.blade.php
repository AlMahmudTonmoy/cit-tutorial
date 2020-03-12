@extends('layouts.app')

@section('content')
  <div class="container">
      <div class="row justify-content-center">
          <div class="col-md-9">
              <div class="card col-md-12">
                  <div class="card-header">Product List</div>
                    <div class="">
                      <div class="card-body">
                        <h1>Welcome Customer</h1>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                <th>Sl No</th>
                                <th>Order Total</th>
                                <th>Coupon Name</th>
                                <th>Purchased At</th>
                                <th>Download as PDF</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($sales as $sale)
                                <tr>
                                <th>{{ $loop->index+1 }}</th>
                                <td>{{ $sale->order_total }}</td>
                                <td>{{ $sale->coupon_code ?? "No Coupon Used" }}</td>
                                <td>
                                    @if($sale->created_at->diffForHumans() == '1 week ago')
                                    {{ $sale->created_at->format('d-M-Y H:i:s A') }}
                                    @else
                                    {{ $sale->created_at->diffForHumans() }}
                                    @endif
                                </td>
                                <td>
                                <a href="{{ url('download/pdf') }}/{{ $sale->id }}" name="button" target="_blank" class="btn btn-primary btn-sm">Download</a>
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
</div>
@endsection
