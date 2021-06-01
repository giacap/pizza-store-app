@extends('layouts.layout')

@section('content')

    <div class='bg-red-200 min-h-screen flex flex-col items-center justify-center'>

        <h1 class='text-4xl mb-5'>Create a Pizza</h1>
        <form action="/pizzas" method='POST' class='text-xl flex flex-col items-center'>
            @csrf
            <div class='flex flex-col items-center justify-center mb-6'>
                <label for="name">Name</label>
                <input type="text" name='name' id='name' class='mt-2 border-2 rounded border-black p-2' placeholder='Enter pizza name' value="{{ old('name') }}">
                @error('name')
                    <div class='bg-red-600 text-white text-sm'>{{ $message }}</div>
                @enderror
            </div>
            <div class='flex flex-col items-center justify-center mb-8'>
                <label for="name">Description</label>
                <textarea name="description" id="description" cols="50" rows="7" class='mt-2 border-2 rounded border-black p-2' placeholder='Enter pizza description'>{{ old('description') }}</textarea>
                @error('description')
                    <div class='bg-red-600 text-white text-sm'>{{ $message }}</div>
                @enderror
            </div>
            <div class='flex flex-row items-center justify-center mb-8'>
                <div class='mr-5'>
                    <label for="price">Price</label>
                    <input type="number" step='0.1' name='price' id='price' min="1" value="5" class='mt-2 border-2 rounded border-black p-2 w-16'>
                    @error('price')
                        <div class='bg-red-600 text-white text-sm'>{{ $message }}</div>
                    @enderror
                </div>
                <div class='ml-5'>
                    <label for="category">Category</label>
                    <input type="text" name='category' id='category' class='mt-2 border-2 rounded border-black p-2 w-44'>
                    @error('category')
                        <div class='bg-red-600 text-white text-sm'>{{ $message }}</div>
                    @enderror
                </div>
                
            </div>
            <button type='submit' class='bg-gray-500 p-3 text-white hover:bg-gray-800'>Create</button>
        </form>
        
    </div>

@endsection