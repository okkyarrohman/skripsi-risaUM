@extends('layouts.admin.app')

@section('title', $title)

@section('content')
<h1>Dashboard</h1>

@for ($i = 0; $i < 100; $i++)
    <p>Item {{ $i + 1 }}</p>
@endfor

@endsection
