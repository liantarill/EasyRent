@extends('layouts.app')

@section('content')
    <div class="min-h-screen flex items-center justify-center bg-gray-50 py-12">
        <div class="w-full max-w-md bg-white rounded-xl shadow p-8">
            <h2 class="text-2xl font-bold mb-2">Set a new password</h2>
            <p class="text-sm text-gray-500 mb-6">Choose a strong password you haven't used elsewhere.</p>
            @if ($errors->any())
                <div>
                    <strong>Terjadi kesalahan:</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li style="color:red;">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ route('reset-password.updatePassword') }}" class="space-y-4">
                @csrf
                @method('POST')
                {{-- <input type="hidden" name="token" value="{{ $token }}"> --}}

                <label class="block">
                    <span class="text-sm text-gray-700">New password</span>
                    <input type="password" name="password" required class="mt-1 block w-full px-3 py-2 border rounded-md" />
                </label>
                @error('password')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror

                <label class="block">
                    <span class="text-sm text-gray-700">Confirm password</span>
                    <input type="password" name="password_confirmation" required
                        class="mt-1 block w-full px-3 py-2 border rounded-md" />
                </label>

                <button type="submit"
                    class="w-full py-2 rounded bg-primary-main text-white font-semibold hover:bg-primary-dark">
                    Reset password
                </button>
            </form>
        </div>
    </div>
@endsection
