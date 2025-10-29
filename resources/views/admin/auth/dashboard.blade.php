@extends('admin.layout.app')

@section('content')
<div class="container py-5">
    <h3>Selamat datang, {{ $user->name }}!</h3>
    <p>Email: {{ $user->email }}</p>

    <a href="{{ route('login') }}" class="btn btn-secondary mt-3">Logout</a>
</div>
@endsection
