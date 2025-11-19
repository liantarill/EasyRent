@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-950 flex items-center justify-center p-4 relative overflow-hidden">
        <!-- Dark luxury background -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute -top-20 -right-20 w-80 h-80 bg-primary-light opacity-5 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-20 -left-20 w-80 h-80 bg-primary-main opacity-5 rounded-full blur-3xl"></div>
        </div>


        <!-- Main container -->
        <div class="relative w-full max-w-lg">
            <div
                class="bg-linear-to-br from-gray-900 to-gray-900/50 rounded-2xl shadow-2xl overflow-hidden border border-gray-800">
                <!-- Header -->
                <div class="relative px-8 py-12 border-b border-gray-800">
                    <div
                        class="absolute top-0 right-0 w-48 h-48 bg-linear-to-br from-primary-main to-primary-light opacity-10 blur-3xl">
                    </div>
                    <div class="relative z-10">
                        <div class="mb-4 inline-block">
                            <span class="text-primary-light font-semibold tracking-widest uppercase text-xs">Profile
                                Setup</span>
                        </div>
                        <h1 class="text-3xl font-black text-white mb-2 tracking-tight">Complete Your Profile</h1>
                        <p class="text-gray-300 text-sm">Upload required documents to activate your account</p>
                    </div>
                </div>

                <!-- Form section -->
                <div class="p-8">
                    @if (session('success'))
                        <!-- Success message styling for dark theme -->
                        <div class="mb-6 p-4 bg-green-500/10 border-l-4 border-green-500 text-green-400 rounded">
                            <p class="font-semibold">Success!</p>
                            <p class="text-sm">{{ session('success') }}</p>
                        </div>
                    @endif

                    @if ($showProfilePicture)
                        <form action="{{ route('customer.profile-completion.uploadProfilePicture') }}" method="POST"
                            enctype="multipart/form-data" class="space-y-6">
                            @csrf
                            <div class="text-center mb-6">
                                <div class="inline-block mb-4">
                                    <img src="{{ asset('storage/' . ($user->profile_picture ?? 'profile/profile.png')) }}"
                                        alt=""
                                        class="w-36 h-36 rounded-full object-cover border-4 border-primary-main ">
                                </div>
                                <h2 class="text-xl font-bold text-white mb-2">Profile Picture</h2>
                                <p class="text-sm text-gray-400">Upload a clear photo for your profile</p>
                            </div>

                            <!-- File input -->
                            <div class="relative">
                                <label for="profile_picture" class="block">
                                    <input type="file" id="profile_picture" name="profile_picture" accept="image/*"
                                        required class="hidden">
                                    <div
                                        class="w-full px-4 py-8 border-2 border-dashed border-gray-700 text-white rounded-lg hover:border-primary-main hover:bg-primary-main/5 transition duration-200 cursor-pointer flex flex-col items-center justify-center group">
                                        <i
                                            class="fas fa-folder mb-2 text-3xl group-hover:scale-110 group-hover:text-primary-light transition "></i>
                                        <span
                                            class="font-semibold text-gray-300 group-hover:text-primary-light transition">Click
                                            to upload</span>
                                        <span class="text-xs text-gray-500 mt-1">JPG, PNG • Max 2MB</span>
                                    </div>
                                </label>
                            </div>

                            <div class="flex gap-3">
                                <a href="{{ route('customer.profile-completion.nextPage') }}"
                                    class="flex-1 text-center py-3 border-2 border-gray-700 text-gray-300 font-semibold rounded-lg hover:border-primary-main hover:text-primary-light transition duration-200">
                                    Skip
                                </a>
                                <button type="submit"
                                    class="flex-1 bg-linear-to-r from-primary-main to-primary-light text-white font-bold py-3 rounded-lg hover:shadow-2xl hover:shadow-primary-main/30 transition duration-300">
                                    Upload
                                </button>
                            </div>
                        </form>
                    @endif

                    @if ($showKtp)
                        @if ($showProfilePicture)
                            <div class="my-6 relative">
                                <div class="absolute inset-0 flex items-center">
                                    <div class="w-full border-t border-gray-800"></div>
                                </div>
                                <div class="relative flex justify-center text-sm">
                                    <span class="px-2 bg-linear-to-br from-gray-900 to-gray-900/50 text-gray-400">Next
                                        Step</span>
                                </div>
                            </div>
                        @endif

                        <form action="{{ route('customer.profile-completion.uploadIdCard') }}" method="POST"
                            enctype="multipart/form-data" class="space-y-6">
                            @csrf
                            <div class="text-center mb-6">
                                <div class="inline-block mb-4">
                                    @if (str_ends_with($user->id_card_photo, '.enc'))
                                        <img src="{{ route('customer.profile.id_card.view') }}" alt="Foto identitas"
                                            class="w-64 h-36 rounded-xl object-cover border-4 border-primary-main ">
                                    @else
                                        <img src="{{ asset('images/id_card.jpg') }}" alt="Foto identitas"
                                            class="w-64 h-36 rounded-xl object-cover border-4 border-primary-main ">
                                    @endif
                                </div>
                                <h2 class="text-xl font-bold text-white mb-2">Identity Verification</h2>
                                <p class="text-sm text-gray-400">Upload a photo of your ID or passport
                                </p>
                            </div>

                            <!-- File input -->
                            <div class="relative">
                                <label for="id_card_photo" class="block">
                                    <input type="file" id="id_card_photo" name="id_card_photo" accept="image/*" required
                                        class="hidden">
                                    <div
                                        class="w-full px-4 py-8 border-2 border-dashed border-gray-700 text-white rounded-lg hover:border-primary-main hover:bg-primary-main/5 transition duration-200 cursor-pointer flex flex-col items-center justify-center group">
                                        <i
                                            class="fa-regular fa-address-card text-3xl mb-2 group-hover:text-primary-light group-hover:scale-110 transition"></i>
                                        <span
                                            class="font-semibold text-gray-300 group-hover:text-primary-light transition">Click
                                            to upload</span>
                                        <span class="text-xs text-gray-500 mt-1">JPG, PNG • Max
                                            5MB</span>
                                    </div>
                                </label>
                            </div>

                            <!-- Action buttons -->
                            <div class="flex gap-3">
                                <a href="{{ route('customer.profile-completion') }}"
                                    class="flex-1 text-center py-3 border-2 border-gray-700 text-gray-300 font-semibold rounded-lg hover:border-primary-main hover:text-primary-light transition duration-200">
                                    Back
                                </a>
                                <button type="submit"
                                    class="flex-1 bg-linear-to-r from-primary-main to-primary-light text-white font-bold py-3 rounded-lg hover:shadow-2xl hover:shadow-primary-main/30 transition duration-300">
                                    Upload
                                </button>
                            </div>

                            <a href="{{ route('customer.profile-completion.complete') }}"
                                class="flex justify-center items-center w-full text-center bg-linear-to-r from-primary-main to-primary-light text-white font-bold py-3 rounded-lg hover:shadow-2xl hover:shadow-primary-main/30 transition duration-300">
                                Done
                            </a>

                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
