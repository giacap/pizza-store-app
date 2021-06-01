@extends('layouts.layout')

@section('content')


        <div class="min-h-screen bg-red-200 flex items-center justify-center flex-col">                
        
            <h1 class='text-3xl md:text-5xl'>Pizza Paradise</h1>
            
            <br />
            <br />

            @auth 
                <h2 class='text-2xl text-center mb-5'>Hi, {{ Auth::user()->name }}</h2>
                <a class='text-xl md:text-2xl p-3 bg-gray-600 text-gray-50 rounded' href="/pizzas">Order a Pizza</a>
                <br /> <br />
                <br /> <br />

                <form action="/logout" method='POST'>
                    @csrf
                    <button type='submit' class='text-xl underline'>Log Out</button>
                </form>
            @endauth

            @guest 
                <a href="/register" class='text-2xl mb-7 underline'>Register</a>
                <a href="/login" class='text-2xl mb-7 underline'>Login</a>
            @endguest

        </div>
@endsection
