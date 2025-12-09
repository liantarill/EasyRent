@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-bg flex items-center justify-center px-4 py-12">
        <div class="w-full max-w-6xl">
            <!-- Main Container with Two Columns -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-0 bg-white rounded-xl overflow-hidden shadow-2xl">

                <!-- Left: Dark Overlay Section -->
                <div
                    class="hidden lg:flex relative overflow-hidden bg-linear-to-br from-gray-900 via-gray-800 to-gray-900 items-center justify-center p-12">
                    <!-- Added dark overlay background with branded content for verification step -->

                    <!-- Background Pattern -->
                    <div class="absolute inset-0 opacity-10">
                        <div
                            class="absolute top-0 left-0 w-96 h-96 bg-primary-main rounded-full mix-blend-multiply filter blur-3xl">
                        </div>
                        <div
                            class="absolute bottom-0 right-0 w-96 h-96 bg-primary-dark rounded-full mix-blend-multiply filter blur-3xl">
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="relative z-10 text-center lg:text-left">
                        <div class="mb-4 inline-block lg:block">
                            <span class="text-primary-dark font-bold text-sm tracking-widest uppercase">Final Step</span>
                        </div>
                        <h1 class="text-4xl lg:text-5xl font-bold text-white mb-4 leading-tight">
                            Verify Your Code
                        </h1>
                        <p class="text-gray-300 text-lg leading-relaxed max-w-md">
                            Enter the 6-digit verification code we just sent to your email. This code expires in 10 minutes.
                        </p>

                        <!-- Status Indicators -->
                        <div class="mt-12 space-y-4">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-8 h-8 rounded-full bg-primary-main flex items-center justify-center flex-shrink-0">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <span class="text-gray-300 text-sm">Email Sent Successfully</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-8 h-8 rounded-full bg-primary-main flex items-center justify-center flex-shrink-0">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <span class="text-gray-300 text-sm">Check Your Inbox</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-8 h-8 rounded-full bg-primary-main flex items-center justify-center flex-shrink-0">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <span class="text-gray-300 text-sm">Enter Code Below</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right: Form Section -->
                <div class="flex flex-col justify-center p-8 lg:p-12">
                    <!-- Clean verification form with OTP input fields -->

                    <!-- Header -->
                    <div class="mb-8">
                        <div class="inline-flex items-center gap-2 mb-4 px-3 py-1 bg-primary-accent rounded-full">
                            <div class="w-2 h-2 rounded-full bg-primary-main"></div>
                            <span class="text-xs font-semibold text-primary-dark uppercase tracking-wider">Step 2 of
                                2</span>
                        </div>
                        <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-2">
                            Enter Verification Code
                        </h2>
                        <p class="text-gray-600 text-base">We've sent a 6-digit code to your email. Enter it below to
                            continue.</p>
                    </div>

                    <!-- Error Messages -->
                    @if (session('error'))
                        <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg flex items-start gap-3">
                            <svg class="w-5 h-5 text-red-500 shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <div>
                                <p class="text-sm font-semibold text-red-800">Verification Failed</p>
                                <p class="text-sm text-red-700 mt-1">{{ session('error') }}</p>
                            </div>
                        </div>
                    @endif

                    <!-- Form -->
                    <form action="{{ route('verify.update', [$type, $unique_id]) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- OTP Input Fields -->
                        <div class="mb-8">
                            <label class="block text-sm font-semibold text-center text-gray-900 mb-4">6-Digit
                                Code</label>
                            <div class="flex gap-3 justify-center " id="otpContainer">
                                @for ($i = 0; $i < 6; $i++)
                                    <input type="text" maxlength="1" inputmode="numeric" pattern="[0-9]"
                                        class="w-12 h-14 text-center text-xl font-bold border-2 border-gray-300 rounded-lg focus:border-primary-main focus:ring-2 focus:ring-primary-accent outline-none transition-colors otp-input"
                                        data-index="{{ $i }}">
                                @endfor
                            </div>
                            <input type="hidden" name="otp" id="otpValue">
                            @error('otp')
                                <p class="text-red-500 text-sm mt-3">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <button type="submit"
                            class="w-full bg-primary-main hover:bg-primary-dark text-white font-semibold py-3 px-4 rounded-lg transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Verify & Proceed
                        </button>

                        <!-- Resend Option -->
                        <div class="text-center pt-4 border-t border-gray-200">
                            <p class="text-sm text-gray-600 mb-3">
                                Didn't receive the code?
                            </p>
                            <button type="button" id="resendBtn"
                                class="text-sm font-semibold text-primary-main hover:text-primary-dark transition-colors">
                                Resend Code (<span id="timer">60</span>s)
                            </button>
                        </div>
                    </form>

                    <!-- Help Section -->
                    <div class="mt-6 p-4 bg-bg rounded-lg border border-primary-accent">
                        <p class="text-xs font-semibold text-primary-dark uppercase tracking-wider mb-2">Tip:</p>
                        <p class="text-sm text-gray-600">
                            Check your spam or junk folder if you don't see the email. You can also paste the code if
                            copied.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const inputs = document.querySelectorAll('.otp-input');
            const otpValue = document.getElementById('otpValue');
            const resendBtn = document.getElementById('resendBtn');
            let timerInterval;

            // Handle OTP input
            inputs.forEach((input, index) => {
                input.addEventListener('input', function(e) {
                    // Only allow digits
                    this.value = this.value.replace(/[^0-9]/g, '');

                    // Move to next input
                    if (this.value && index < inputs.length - 1) {
                        inputs[index + 1].focus();
                    }

                    // Update hidden input
                    const otp = Array.from(inputs).map(i => i.value).join('');
                    otpValue.value = otp;

                    // Auto-submit when all digits are entered
                    if (otp.length === 6) {
                        // Optional: auto-submit
                        // document.querySelector('form').submit();
                    }
                });

                // Handle backspace
                input.addEventListener('keydown', function(e) {
                    if (e.key === 'Backspace' && !this.value && index > 0) {
                        inputs[index - 1].focus();
                    }
                });

                // Handle paste
                input.addEventListener('paste', function(e) {
                    e.preventDefault();
                    const pastedData = e.clipboardData.getData('text');
                    const digits = pastedData.replace(/[^0-9]/g, '').split('');

                    digits.forEach((digit, i) => {
                        if (index + i < inputs.length) {
                            inputs[index + i].value = digit;
                        }
                    });

                    const otp = Array.from(inputs).map(i => i.value).join('');
                    otpValue.value = otp;
                });
            });

            // Resend timer
            function startTimer() {
                let seconds = 60;
                resendBtn.disabled = true;
                resendBtn.classList.add('opacity-50', 'cursor-not-allowed');

                timerInterval = setInterval(() => {
                    seconds--;
                    document.getElementById('timer').textContent = seconds;

                    if (seconds <= 0) {
                        clearInterval(timerInterval);
                        resendBtn.disabled = false;
                        resendBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                        resendBtn.innerHTML = 'Resend Code';
                    }
                }, 1000);
            }

            resendBtn.addEventListener('click', function(e) {
                e.preventDefault();
                // Add your resend logic here
                startTimer();
            });

            // Start timer on page load
            startTimer();
        });
    </script>
@endsection
