@extends('layouts.layout')

@section('content')
 
    <div class='bg-red-200 min-h-screen flex items-center flex-col'>        

        <h1 class='text-5xl p-5 mb-6 text-center'>Orders received</h1>

        <div class='mt-7 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 pl-8 pr-8 mb-5 min-w-full'>
            
            @if( count($orders) > 0)
                @foreach($orders as $order)
                    <div class='border border-3 border-black rounded-lg mb-3 p-5 flex flex-col items-center justify-center'>
                        <p class='text-3xl mb-2'>Order</p>
                        <p class='mb-3'>Date: {{ $order->created_at }}</p>
                        <p>Type of Pizza: {{ $order->pizza->name }}</p>
                        <p>Author: {{ $order->user->email }}</p>
                    </div>  
                @endforeach
            @else 
                <p>Sorry, no Order found</p>
            @endif
        </div>

    </div>

@endsection