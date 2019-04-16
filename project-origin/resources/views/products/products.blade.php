@extends('layouts.app')

@section('title', "Welcome")

@section('content')

  <checkout-form :products="{{ $products }}"></checkout-form>
  <subscription-form :products="{{ $products }}"></subscription-form>
@endsection
