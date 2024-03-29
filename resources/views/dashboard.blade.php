@extends('layouts.master')

@section('title','Dashboard')

@push('css_or_js')

@endpush

@section('content')

<div class="main-content">
<div class="container-fluid">
                <div class="row mb-4 g-4">
                    <div class="col-lg-3 col-sm-6">
                        <!-- Business Summary -->
                        <div class="business-summary business-summary-customers">
                        <h2>Total Products</h2>
                            <h3>{{$pcount}}</h3>
                            <img src="{{asset('public/assets')}}/img/icons/customers.png"
                                 class="absolute-img"
                                 alt="">
                        </div>
                        <!-- End Business Summary -->
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <!-- Business Summary -->
                        <div class="business-summary business-summary-earning">
                        <h2>User Count</h2>
                            <h3>{{$user}}</h3>
                            <img src="{{asset('public/assets')}}/img/icons/customers.png"
                                 class="absolute-img"
                                 alt="">
                        </div>
                        <!-- End Business Summary -->
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <!-- Business Summary -->
                        <div class="business-summary business-summary-providers">
                        <h2>Shop Count</h2>
                            <h3>{{$shops}}</h3>
                            <img src="{{asset('public/assets')}}/img/icons/providers.png"
                                 class="absolute-img"
                                 alt="">
                        </div>
                        <!-- End Business Summary -->
                    </div>
                  
                </div>
</div>
</div>
@endsection
@push('script')
  
@endpush