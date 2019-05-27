@extends('layouts.app')

@section('content')

  <div class="content-left">
    @include('layouts.panel-left')
  </div>
  <div class="content-center">
    @yield('panel-center')
  </div>
  <div class="content-right">
    @include('layouts.panel-right')
  </div>

@endsection
