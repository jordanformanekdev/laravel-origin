@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                  <h2>{{ $user->name }}</h2>
                  <h2>{{ $user->email }}</h2>
                  <checkout-form :products="{{ $products }}"></checkout-form>
                  <subscription-form :plans="{{ $plans }}"></subscription-form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
