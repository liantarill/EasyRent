@extends('layouts.app')

@section('content')
    @include('layouts.partials.navbar')
    <div class="p-6 mt-12">
        <div class="overflow-x-auto bg-white shadow-md rounded-xl">
            <table class="w-full border-collapse">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-4 py-2 text-left">Username</th>
                        <th class="px-4 py-2 text-left">Name</th>
                        <th class="px-4 py-2 text-left">Email</th>
                        <th class="px-4 py-2 text-left">Phone Number</th>
                        <th class="px-4 py-2 text-left">Role</th>
                        <th class="px-4 py-2 text-left">Status</th>
                        <th class="px-4 py-2 text-left">Detail</th>
                    </tr>
                </thead>

                <tbody class="text-gray-800">
                    @foreach ($users as $user)
                        <tr class="border-t hover:bg-gray-50">
                            <td class="px-4 py-2">{{ $user->username }}</td>
                            <td class="px-4 py-2">{{ $user->name }}</td>
                            <td class="px-4 py-2">{{ $user->email }}</td>
                            <td class="px-4 py-2">{{ $user->phone_number }}</td>
                            <td class="px-4 py-2">{{ $user->role }}</td>
                            <td class="px-4 py-2">{{ $user->status }}</td>
                            <td class="px-4 py-2">
                                <a href="{{ route('admin.users.show', $user->id) }}">Detail</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
