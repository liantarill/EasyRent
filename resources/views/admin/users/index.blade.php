@extends('layouts.app')

@section('content')
    <div class="flex">
        @include('layouts.partials.sidebar')

        <div class="flex-1 p-8">
            <!-- Header -->
            <div class="mb-8">
                <div class="flex items-center gap-3 mb-2">
                    <div
                        class="w-10 h-10 bg-linear-to-br from-primary-light to-primary-main rounded-lg flex items-center justify-center">
                        <i class="fas fa-users text-white text-lg"></i>
                    </div>
                    <h1 class="text-3xl font-bold text-gray-900">Users</h1>
                </div>
                <p class="text-gray-600 text-sm ml-13">Manage all users in the system</p>
            </div>

            <!-- Table -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-linear-to-r from-gray-50 to-gray-100 border-b border-gray-200">
                        <tr class="text-gray-700 text-sm font-semibold">
                            <th class="text-left px-6 py-4">Username</th>
                            <th class="text-left px-6 py-4">Name</th>
                            <th class="text-left px-6 py-4">Email</th>
                            <th class="text-left px-6 py-4">Role</th>
                            <th class="text-left px-6 py-4">Status</th>
                            <th class="text-right px-6 py-4">Action</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200">
                        @forelse ($users as $user)
                            <tr class="text-gray-800 text-sm hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 font-medium text-gray-900">{{ $user->username }}</td>
                                <td class="px-6 py-4">{{ $user->name }}</td>
                                <td class="px-6 py-4 text-gray-600">{{ $user->email }}</td>

                                <td class="px-6 py-4">
                                    <span
                                        class="inline-flex items-center gap-2 px-2.5 py-1 rounded-full text-xs font-medium
                                    @if ($user->role === 'admin') bg-purple-100 text-purple-700
                                    @elseif($user->role === 'staff') bg-blue-100 text-blue-700
                                    @else bg-gray-100 text-gray-700 @endif">
                                        <i
                                            class="fas 
                                        @if ($user->role === 'admin') fa-shield-alt
                                        @elseif($user->role === 'staff') fa-briefcase
                                        @else fa-user @endif"></i>
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </td>

                                <td class="px-6 py-4">
                                    <span
                                        class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium
                                    @if ($user->status === 'active') bg-green-100 text-green-700
                                    @elseif($user->status === 'verify') bg-yellow-100 text-yellow-700
                                    @elseif($user->status === 'banned') bg-red-100 text-red-700
                                    @elseif($user->status === 'suspended') bg-orange-100 text-orange-700
                                    @else bg-gray-100 text-gray-700 @endif">
                                        <i
                                            class="fas 
                                        @if ($user->status === 'active') fa-check-circle
                                        @elseif($user->status === 'verify') fa-hourglass-half
                                        @elseif($user->status === 'banned') fa-ban
                                        @elseif($user->status === 'suspended') fa-pause-circle
                                        @else fa-question-circle @endif"></i>
                                        {{ ucfirst($user->status) }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('admin.users.show', $user->id) }}"
                                        class="inline-flex items-center justify-center w-8 h-8 rounded-lg hover:bg-primary-accent text-primary-main hover:text-primary-dark transition">
                                        <i class="fas fa-arrow-right"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center">
                                    <i class="fas fa-inbox text-4xl text-gray-300 mb-3"></i>
                                    <p class="text-gray-500">No users found</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
