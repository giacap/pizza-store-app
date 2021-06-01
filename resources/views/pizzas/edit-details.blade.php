@extends('layouts.layout')

@section('content')
    

    <div class='bg-red-200 min-h-screen flex items-center justify-center flex-col'>
        
        <h1 class="text-center text-4xl mb-8">Edit Pizza</h1>

        <form action="/pizzas/admin/edit/update" method='POST'>
            @csrf
            <div class='mb-5'>
                <label for="name" class='text-2xl'>Name:</label>
                <input type="text" name='name' id='name' class='text-2xl p-2 border border-black rounded' value="{{ $pizza->name }}">
                @error('name')
                    <div class='bg-red-600 text-white text-sm'>{{ $message }}</div>
                @enderror
            </div>
            
            <div class="flex items-center mb-6">
                <label for="description" class="text-2xl">Description:</label>
                <textarea name="description" id="description" cols="50" rows="7" class='border border-black rounded'>{{ $pizza->description }}</textarea>
                @error('description')
                    <div class='bg-red-600 text-white text-sm'>{{ $message }}</div>
                @enderror
            </div>

            <div class='mb-6'>
                <label for="price">Price (€):</label>
                <input type="number" name='price' id='price' class='border border-black rounded' value="{{ $pizza->price }}">
                @error('price')
                    <div class='bg-red-600 text-white text-sm'>{{ $message }}</div>
                @enderror
            </div>
            
            <div class='mb-6'>
                <label for="price">Category:</label>
                <input type="text" name='category' id='category' class='border border-black rounded' value="{{ $pizza->category->slug }}">
                @error('category')
                    <div class='bg-red-600 text-white text-sm'>{{ $message }}</div>
                @enderror
            </div>

            <input type="hidden" name='id' id='id' value='{{ $pizza->id }}'>

            <div class='mt-6 text-2xl mb-3 flex justify-center'>
                <button type='submit' class='bg-green-500 p-2 mr-5 rounded border border-black'>UPDATE</button>
            </div>
        </form>
        
        <form action="/pizzas/admin/edit/delete" method='POST'>
            @csrf
            @method('DELETE')
            <div class='mt-6 text-2xl mb-3'>
                <input type="hidden" name='id' id='id' value='{{ $pizza->id }}'>
                <button type='submit' class='bg-red-500 p-2 mr-5 rounded border border-black'>DELETE</button>
            </div>
        </form>


        <br /> <br />
        <a href="/pizzas/admin/edit" class='underline'>Indietro</a>
        <br />
        
    </div>

    

@endsection