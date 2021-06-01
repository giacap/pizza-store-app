@extends('layouts.layout')

@section('content')


        <div class='bg-red-200 min-h-screen flex items-center flex-col'>

            <div class='flex flex-col items-center w-full mt-2 p-3'>
                <h1 class='text-5xl p-5 mb-6 text-center'>Pizze {{ $currentCat }}</h1>
                <div class='flex items-center flex-col sm:flex-row sm:items-start p-2'>
                    <div class='order-2 sm:order-1 sm:mr-4 w-44'>
                        <button class='category-select-btn p-1 border border-black rounded bg-gray-300 w-full' id='category-select-btn'>{{ $currentCat }} v</button>
                        <div style='overflow-wrap: break-word' class='hidden flex flex-col max-h-15 bg-gray-300 border border-black rounded max-h-32 overflow-y-auto' id='categories-list'>
                            <a class='hover:bg-gray-600 hover:text-white border border-black border-b-1' href="/pizzas">All</a>
                            @foreach($categories as $category)
                                <a href='/pizzas/cat/{{ $category->slug }}' class='hover:bg-gray-600 hover:text-white border border-black border-b-1'>{{ $category->name }}</a>
                            @endforeach
                        </div> 
                    </div>
                       
                    <div class='mb-5 order-1 sm:mb-0 sm:order-2 sm:ml-4'>
                        <form action="" method='GET'>
                            <input class='p-1 border border-black rounded' type="text" name='search' placeholder='find something' value="{{ request('search') }}">
                        </form>
                    </div>
                </div>
            </div>
                
            
          
            <div class='mt-7 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 pl-8 pr-8 min-w-full'>
                @if( count($pizzas) > 0 )
                    @foreach($pizzas as $pizza)
                        <div class='border border-3 border-black rounded-lg mb-3 p-5 flex flex-col items-center justify-center'>
                            <h3 class='text-3xl underline mb-2 text-center'><a href='/pizzas/{{ $pizza->slug }}'>{{ $pizza->name }}</a></h3>
                            <p class='mb-2 text-center'>{{ $pizza->description }}</p>
                            <a href="/pizzas/cat/{{ $pizza->category->slug }}"> ( {{ $pizza->category->name }} ) </a>
                        </div>
                    @endforeach
                @else 
                    <p>Sorry, no Pizza found.</p>
                @endif
            </div>

            <br /> <br />
            <a href="/pizzas" class='underline mb-5'>Tutte le Pizze</a>

        </div>
       


@endsection