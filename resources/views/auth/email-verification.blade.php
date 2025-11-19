@extends('layouts.app')

@section('content')
    <h1>Verification</h1>
    <form action="{{ route('verify.store') }}" method="POST">
        @csrf
        <input type="hidden" name="type" value="register">
        <button type="submit">Send OTP</button>
    </form>
@endsection
