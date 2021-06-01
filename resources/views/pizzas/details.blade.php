@extends('layouts.layout')

@section('content')
 
    <div class='bg-red-200 min-h-screen flex items-center justify-center flex-col'>
        <h1 class='text-5xl p-5 mb-6'>{{ $pizza->name }}</h1>
        <p class='mb-6 text-2xl'>{{ $pizza->description }}</p>
        <p class='mb-6 text-2xl'>{{ $pizza->price }} €</p>
        <a class='mb-5' href="/pizzas/cat/{{ $pizza->category->slug }}"> ( {{ $pizza->category->name }} ) </a>

        <form action="/pizzas/makeorder" method='POST'>
            @csrf
            <input type="hidden" name='pizzaId' id='pizzaId' value="{{ $pizza->id }}">
            <button class='text-center bg-green-500 p-2 rounded border border-black'>ORDER</button>
        </form>


        
        <br /> <br />
        <a href="/pizzas" class='underline'>Tutte le Pizze</a>
        <br />
        <a href="/pizzas/cat/{{ $pizza->category->slug }}" class='underline'>Tutte le Pizze {{ $pizza->category->name }}</a>
    </div>

    

@endsection