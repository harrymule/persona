@extends('layouts.app')

@section('content')
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
                    <span>Already have an account?</span>
                    <a href="{{ route('login') }}" class="underline">Login Here</a>
                </p>
                <p class="mt-6 text-sm text-center text-gray-300">
                    Read our <a href="#" class="underline">terms</a> and <a href="#" class="underline">conditions</a>
                </p>
            </div>
            <div class="p-5 bg-white md:flex-1">
                <h3 class="my-4 text-2xl font-semibold text-gray-700">{{ __('Register') }}</h3>
                <form method="POST" action="{{ route('register') }}" class="flex flex-col space-y-5">
                    @csrf
                    <div class="flex flex-col space-y-1">
                        <label for="name" class="text-sm font-semibold text-gray-500">{{ __('Name') }}</label>
                        <input type="text" id="name" autofocus name="name" value="{{ old('name') }}"
                            class="px-4 py-2 transition duration-300 border border-gray-300 rounded focus:border-transparent focus:outline-none focus:ring-4 focus:ring-blue-200 @error('name') border-red-500 @enderror " />
                        @error('name')
                        <span class="block text-red-600 text-sm mt-2" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="flex flex-col space-y-1">
                        <label for="email" class="text-sm font-semibold text-gray-500">{{ __('Email Address') }}</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                            class="px-4 py-2 transition duration-300 border border-gray-300 rounded focus:border-transparent focus:outline-none focus:ring-4 focus:ring-blue-200 @error('email') border-red-500 @enderror " />
                        @error('email')
                        <span class="block text-red-600 text-sm mt-2" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="flex flex-col space-y-1">
                        <label for="password" class="text-sm font-semibold text-gray-500">{{ __('Password') }}</label>
                        <input type="password" id="password" name="password" class="px-4 py-2 transition duration-300 border border-gray-300 rounded focus:border-transparent focus:outline-none:border-transparent focus:outline-none focus:ring-4 focus-blue-200 @error('password') border-red-500 @enderror" />
                        @error('password')
                        <span class="block text-red-600 text-sm mt-2" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="flex flex-col space-y-1">
                        <label for="password_confirmation" class="text-sm font-semibold text-gray-500">{{ __('Confirm
                            Password') }}</label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            class="px-4 py-2 transition duration-300 border border-gray-300 rounded focus:border-transparent focus:outline-none focus:ring-4 focus-blue-200 @error('password_confirmation') border-red-500 @enderror" />
                        @error('password_confirmation')
                        <span class="block text-red-600 text-sm mt-2" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <button type="submit"
                        class="w-full px-4 py-2 text-lg text-white bg-blue-500 rounded-md hover:bg-blue-700 focus:bg-blue-700 focus:outline-none">{{
                        __('Register') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
