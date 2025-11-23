@extends('layouts.app')

@section('content')
    @include('layouts.partials.navbar')
    <div class="p-6">
        <div class="max-w-lg mx-auto bg-white rounded-2xl shadow-md p-6">
            @if (session('success'))
                <div class="mb-6 p-4 bg-green-500/10 border-l-4 border-green-500 text-green-400 rounded">
                    {{-- <p class="font-semibold">Password Diperbaharui</p> --}}
                    <p class="text-sm">{{ session('success') }}</p>
                </div>
            @endif
            <h1 class="text-2xl font-bold text-gray-800 mb-4">Detail User</h1>

            <div class="space-y-2 text-gray-700">
                <p><span class="font-semibold">Username:</span> {{ $user->username }}</p>
                <p><span class="font-semibold">Name:</span> {{ $user->name }}</p>
                <p><span class="font-semibold">Email:</span> {{ $user->email }}</p>
                <p><span class="font-semibold">Phone:</span> {{ $user->phone ?? 'Not Set' }}</p>
            </div>

            <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="mt-6 ">
                @csrf
                @method('PUT')

                <label class="block text-gray-700 font-semibold mb-1">Status</label>
                <div class="flex items-center">
                    <select name="status"
                        class="flex-1 border-gray-300 rounded-xl px-3 py-2 focus:ring-blue-500 focus:border-blue-500 transition">
                        @foreach (['verify', 'active', 'reset', 'banned', 'suspended'] as $status)
                            <option value="{{ $status }}" @selected(old('status', $user->status) === $status)>
                                {{ ucfirst($status) }}
                            </option>
                        @endforeach
                    </select>

                    <button type="submit"
                        class="ml-3 px-5 py-2.5 bg-primary-main text-white rounded-xl hover:bg-primary-light shadow transition">
                        Simpan status
                    </button>
                </div>
            </form>

            <a href="{{ route('admin.users.index') }}"
                class="inline-block px-4 py-2 rounded-lg border border-gray-300 text-gray-700 
          hover:bg-gray-100 transition">
                Kembali
            </a>



        </div>
    </div>
@endsection
