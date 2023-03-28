@extends('layouts.master')

@section('content')
    <div class="col-md-12">
        <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
        <div class="col p-4 d-flex flex-column position-static">
            <small class="d-inline-block mb-2 text-success">
                @foreach($product->categories as $category)
                    {{$category->name}}
                @endforeach
            </small>
            <h5 class="mb-0">{{$product->title}}</h5>
            <div class="mb-1 text-muted"> {{$product->created_at->format('d/m/y')}} </div>
            <p class="mb-auto">{!!$product->description!!} </p>
            <p><strong>{{$product->getPrice()}}</strong></p>
            <form action="{{route('cart.store')}}" method="post">
                @csrf
                <input type="hidden" name="product_id" value="{{$product->id}}">
                <button type="submit" class="btn btn-dark">Ajouter au panier</button>
            </form>
        </div>
        <div class="col-auto d-none d-lg-block">
            <img src="{{asset('storage/'.$product->image)}}" alt="image">
        </div>
        </div>
    </div>
@endsection