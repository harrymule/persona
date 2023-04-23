@extends('layouts.app')
@section('content')
<div class="container">
    <div class="flex justify-center mt-16">
        <div class="w-full md:w-6/12">
            <div class="bg-white rounded-lg shadow-md">
                <div class="text-lg font-medium text-gray-800 bg-gray-100 p-4">{{ __('Reset Password') }}</div>
                <div class="p-4">
                    @if (session('status'))
                    <div class="bg-green-100 text-green-600 py-2 px-4 mb-4 rounded-md" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="mb-4">
                            <label for="email" class="block text-gray-700 font-medium mb-2">{{ __('Email Address')
                                }}</label>
                            <input id="email" type="email"
                                class="w-full px-4 py-2 transition duration-300 border border-gray-300 rounded focus:border-transparent focus:outline-none focus:ring-4 focus:ring-blue-200 @error('email') border-red-500 @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                            <span class="text-sm text-red-600 mt-1" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="flex items-center justify-end">
                            <button type="submit"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring focus:ring-blue-200 focus:border-blue-500">
                                {{ __('Send Password Reset Link') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
