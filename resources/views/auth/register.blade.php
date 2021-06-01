@extends('layouts.layout')

@section('content')

    <div class='bg-red-200 min-h-screen flex flex-col items-center justify-center'>

        <h1 class='text-4xl mb-5'>Register</h1>
        <form action="/register" method='POST' class='text-xl flex flex-col items-center'>
            @csrf
            <div class='flex flex-col items-center justify-center mb-6'>
                <label for="name">Name</label>
                <input type="text" name='name' id='name' class='mt-2 border-2 rounded border-black p-2 bg-gray-100' placeholder='Enter your name' value="{{ old('name') }}">
                @error('name')
                    <div class='bg-red-600 text-white text-sm'>{{ $message }}</div>
                @enderror
            </div>
            <div class='flex flex-col items-center justify-center mb-8'>
                <label for="email">Email</label>
                <input type="text" name='email' id='email' class='mt-2 border-2 rounded border-black p-2 bg-gray-100' placeholder='Enter your email' value="{{ old('email') }}">
                @error('email')
                    <div class='bg-red-600 text-white text-sm'>{{ $message }}</div>
                @enderror
            </div>
            <div class='flex flex-col items-center justify-center mb-8'>
                <label for="password">Password</label>
                <input type="password" name='password' id='password' class='mt-2 border-2 rounded border-black p-2 bg-gray-100'>
            </div>
            <div class='flex flex-col items-center justify-center mb-8'>
                <label for="password_confirmation">Confirm password</label>
                <input type="password" name='password_confirmation' id='password_confirmation' class='mt-2 border-2 rounded border-black p-2  bg-gray-100'>
                @error('password')
                    <div class='bg-red-600 text-white text-sm'>{{ $message }}</div>
                @enderror
            </div>
                
                
        
            <button type='submit' class='bg-gray-500 p-3 text-white hover:bg-gray-800'>Register</button>
        </form>
        
    </div>

@endsection