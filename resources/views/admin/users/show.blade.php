@extends('layouts.app')

@section('content')
    <div class="flex">
        @include('layouts.partials.sidebar')

        <div class="flex-1 bg-gray-50 p-8">
            <div class="max-w-2xl mx-auto">
                <!-- Enhanced header with back button -->
                <div class="flex items-center gap-4 mb-8">
                    <a href="{{ route('admin.users.index') }}"
                        class="w-10 h-10 flex items-center justify-center rounded-lg hover:bg-gray-200 transition-colors">
                        <i class="fas fa-arrow-left text-gray-700"></i>
                    </a>
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">User Details</h1>
                        <p class="text-gray-600 text-sm">Manage user information and status</p>
                    </div>
                </div>

                <!-- Success message with improved styling -->
                @if (session('success'))
                    <div
                        class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl flex items-center gap-3">
                        <i class="fas fa-check-circle text-lg"></i>
                        <span class="text-sm">{{ session('success') }}</span>
                    </div>
                @endif

                <!-- User Info Card -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8 mb-6">
                    <div class="flex items-start justify-between mb-6">
                        <div>
                            <div class="flex items-center gap-3 mb-2">
                                <div
                                    class="w-12 h-12 bg-gradient-to-br from-teal-400 to-teal-600 rounded-full flex items-center justify-center">
                                    <i class="fas fa-user text-white text-xl"></i>
                                </div>
                                <div>
                                    <h2 class="text-2xl font-bold text-gray-900">{{ $user->name }}</h2>
                                    <p class="text-gray-600 text-sm">&#64;{{ $user->username }}</p>
                                </div>
                            </div>
                        </div>
                        <span
                            class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-sm font-semibold
                        @if ($user->status === 'active') bg-green-100 text-green-700
                        @elseif($user->status === 'verify') bg-yellow-100 text-yellow-700
                        @elseif($user->status === 'banned') bg-red-100 text-red-700
                        @elseif($user->status === 'suspended') bg-orange-100 text-orange-700
                        @else bg-gray-100 text-gray-700 @endif">
                            <i
                                class="fas @if ($user->status === 'active') fa-check-circle @elseif($user->status === 'verify') fa-hourglass-half @elseif($user->status === 'banned') fa-ban @elseif($user->status === 'suspended') fa-pause-circle @else fa-question-circle @endif"></i>
                            {{ ucfirst($user->status) }}
                        </span>
                    </div>

                    <!-- User Details Grid -->
                    <div class="grid grid-cols-2 gap-6 mb-8">
                        <div class="space-y-2">
                            <p class="text-xs font-semibold text-gray-600 uppercase tracking-wide">Email</p>
                            <p class="text-gray-900 font-medium flex items-center gap-2">
                                <i class="fas fa-envelope text-teal-600"></i>
                                {{ $user->email }}
                            </p>
                        </div>
                        <div class="space-y-2">
                            <p class="text-xs font-semibold text-gray-600 uppercase tracking-wide">Phone</p>
                            <p class="text-gray-900 font-medium flex items-center gap-2">
                                <i class="fas fa-phone text-teal-600"></i>
                                {{ $user->phone_number ?? 'Not Set' }}
                            </p>
                        </div>
                    </div>

                    <!-- Role Badge -->
                    <div class="pt-6 border-t border-gray-200">
                        <p class="text-xs font-semibold text-gray-600 uppercase tracking-wide mb-3">Role</p>
                        <span
                            class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-sm font-medium
                        @if ($user->role === 'admin') bg-purple-100 text-purple-700
                        @elseif($user->role === 'staff') bg-blue-100 text-blue-700
                        @else bg-gray-100 text-gray-700 @endif">
                            <i
                                class="fas @if ($user->role === 'admin') fa-shield-alt @elseif($user->role === 'staff') fa-briefcase @else fa-user @endif"></i>
                            {{ ucfirst($user->role) }}
                        </span>
                    </div>
                </div>

                <!-- Status Update Form -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8">
                    <h3 class="text-lg font-bold text-gray-900 mb-6 flex items-center gap-2">
                        <i class="fas fa-sliders-h text-teal-600"></i>
                        Update Status
                    </h3>

                    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-3">Select Status</label>
                                <select name="status"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition">
                                    @foreach (['verify', 'active', 'reset', 'banned', 'suspended'] as $status)
                                        <option value="{{ $status }}" @selected(old('status', $user->status) === $status)>
                                            {{ ucfirst($status) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit"
                                class="w-full px-6 py-3 bg-gradient-to-r from-teal-500 to-teal-600 text-white font-semibold rounded-lg hover:from-teal-600 hover:to-teal-700 transition-all duration-200 shadow-md hover:shadow-lg flex items-center justify-center gap-2">
                                <i class="fas fa-save"></i>
                                Save Status
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
