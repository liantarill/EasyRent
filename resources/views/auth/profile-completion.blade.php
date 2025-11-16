@extends('layouts.app')

@section('content')
    <div class="max-w-lg mx-auto p-6">
        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4">{{ session('success') }}</div>
        @endif

        @if ($showProfilePicture)
            <form action="{{ route('customer.profile-completion.uploadProfilePicture') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <label>Profile Picture</label>
                <input type="file" name="profile_picture" accept="image/*" required>
                <div class="mt-2">
                    <button type="submit" class="px-3 py-1 bg-blue-600 text-white rounded">Upload & Next</button>
                </div>
            </form>
        @endif

        @if ($showKtp)
            <hr class="my-4">
            <form action="{{ route('customer.profile-completion.uploadIdCard') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <label>KTP / ID Card</label>
                <input type="file" name="id_card_photo" accept="image/*" required>
                <div class="mt-2">
                    <a href="{{ route('customer.profile-completion.index') }}"
                        class="px-3 py-1 bg-gray-200 rounded">Back</a>
                    <button type="submit" class="px-3 py-1 bg-green-600 text-white rounded">Upload KTP</button>
                </div>
            </form>
        @endif
    </div>
@endsection
