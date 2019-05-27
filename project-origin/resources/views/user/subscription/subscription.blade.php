@extends('layouts.container')

@section('panel-center')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Subscription</div>
                  <h2>{{ $user->active() ? 'active' : 'inactive' }}</h2>
                  <checkout-form :products="{{ $products }}"></checkout-form>
                  <subscription-form :plans="{{ $plans }}"></subscription-form>
                </div>
            </div>
        </div>
    </div>

@endsection
