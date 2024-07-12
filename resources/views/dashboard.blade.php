@extends('layouts.app')

@section('content')
    @if (Auth::check())
        <h2>Dashboard</h2>
        <p>Welcome, {{ Auth::user()->name }}!</p>
    @else
        <p>Unauthorized access.</p>
    @endif
@endsection
