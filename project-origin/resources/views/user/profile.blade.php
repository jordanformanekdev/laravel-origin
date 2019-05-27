@extends('layouts.container')

@section('panel-center')

  <img class="profile-photo" src="{{ URL::asset($profileImage->publciPath()) }}">
  <a href="/profile-image/create">Edit Image</a>
  <h2>{{ $user->name }}</h2>
  <h2>{{ $user->email }}</h2>
  <p>Biography</p>

@endsection
