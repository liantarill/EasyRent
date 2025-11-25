@extends('layouts.app')
@section('content')
    @include('layouts.partials.sidebar')
    {{-- @include('layouts.partials.sidebar') --}}
    {{-- @if (session('success'))
        <div class="">
            {{ session('success') }}
        </div>
    @endif
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form> --}}
@endsection
