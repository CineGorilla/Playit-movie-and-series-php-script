@extends('layouts.login-app')
@section('content')
<div class="py-10 container mx-auto bg-gray-800">
    <div class="flex flex-col items-center justify-center w-full h-full">
        <div class="bg-gray-900 p-24 rounded-xl flex flex-col items-center justify-center">
            <div class="w-full">
                <div class="flex justify-center w-full text-center">
                    <img src="/setting_img/logo.png" class="w-full">
                </div>
                <div class="my-4 divide-y-2 divide-white divide-solid">
                    <div></div>
                    <div></div>
                </div>
                <h1 class="mb-6 font-medium font-black text-center text-white uppercase text-8xl">Login</h1>
            </div>
            <div class="w-full">
                <p class="mb-5 -mt-2 text-lg text-gray-400 text-center">Sign-in with email..</p>
                <form class="flex flex-col" method="POST" action="{{ route('login') }}">
                    @csrf
                    <input id="email" type="email" class="w-full px-5 py-3 mb-3 text-lg text-white placeholder-gray-400 bg-gray-800 border border-gray-800 rounded-lg focus:ring-4 focus:ring-blue-500 focus:ring-opacity-90 focus:outline-none" name="email" value="{{ old('email') }}" placeholder="Email Address.." required autocomplete="email" autofocus>
                    @error('email')
                    <p class="text-red-500 text-xs italic mt-2 mb-4">
                        {{ $message }}
                    </p>
                    @enderror
                    <input type="password" name="password" placeholder="Password" class="w-full px-5 py-3 mb-3 text-lg text-white placeholder-gray-400 bg-gray-800 border border-gray-800 rounded-lg focus:ring-4 focus:ring-blue-500 focus:ring-opacity-90 focus:outline-none">
                    @error('password')
                    <p class="text-red-500 text-xs italic mt-2 mb-4">
                        {{ $message }}
                    </p>
                    @enderror
                    <span class="inline-flex rounded-md shadow-sm">
                        <button type="submit" class="px-6 py-3 leading-6 text-base rounded-lg border border-transparent text-white bg-blue-600 hover:bg-blue-500 focus:border-blue-700 focus:shadow-outline-blue active:bg-blue-700 cursor-pointer inline-flex items-center w-full justify-center items-center font-medium transition duration-150 ease-in-out focus:outline-none">
                            Login
                        </button>
                    </span>
                    <div class="flex flex-col items-center mt-5">
                        <a href="{{ route('password.request') }}" class="text-xs font-medium text-blue-400">Forgot Your Password?</a>
                        <p class="mt-1 text-xs font-light text-white">New to {{config('app.name')}} ?<a href="{{ route('register') }}" class="ml-1 font-medium text-blue-400">Sign up now</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
