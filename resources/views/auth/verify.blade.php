@extends('layouts.app')

@section('content')
<div class="container">
    <div class="flex items-center min-h-screen p-4 bg-gray-100 lg:justify-center">
        <div
            class="flex flex-col overflow-hidden bg-white rounded-md shadow-lg max md:flex-row md:flex-1 lg:max-w-screen-md">
            <div
                class="p-4 py-6 text-white bg-blue-500 md:w-80 md:flex-shrink-0 md:flex md:flex-col md:items-center md:justify-evenly">
                <div class="my-3 text-4xl font-bold tracking-wider text-center">
                    <a href="#">Persona</a>
                </div>
                <p class="mt-6 font-normal text-center text-gray-300 md:mt-0">
                    Persona is a user-profile app that allows users to manage and maintain their personal profiles.
                </p>
                <p class="flex flex-col items-center justify-center mt-10 text-center">
                    <span>Don't have an account?</span>
                    <a href="{{ route('register') }}" class="underline">Get Started!</a>
                </p>
                <p class="mt-6 text-sm text-center text-gray-300">
                    Read our <a href="#" class="underline">terms</a> and <a href="#" class="underline">conditions</a>
                </p>
            </div>
            <div class="p-5 bg-white md:flex-1">
                <div class="my-4 text-2xl font-semibold text-gray-700">{{ __('Verify Your Email Address') }}</div>

                <div class="py-5">
                    @if (session('resent'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                        role="alert">
                        <span class="block sm:inline">{{ __('A fresh verification link has been sent to your email
                            address.') }}</span>
                        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                            <svg class="fill-current h-6 w-6 text-green-500" role="button"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <title>Close</title>
                                <path
                                    d="M14.348 5.652a.5.5 0 0 1 0 .707L11.414 10l2.93 2.93a.5.5 0 1 1-.707.707L10.707 10l-2.93 2.93a.5.5 0 1 1-.707-.707L9.293 10 6.364 7.07a.5.5 0 0 1 .708-.707L10 9.293l2.93-2.93a.5.5 0 0 1 .707 0z" />
                            </svg>
                        </span>
                    </div>
                    @endif

                    <p class="mb-4">{{ __('Before proceeding, please check your email for a verification link.') }}</p>
                    <p class="mb-4">{{ __('If you did not receive the email') }},</p>
                    <form class="inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="text-blue-500 underline">{{ __('click here to request another')
                            }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>




@endsection
