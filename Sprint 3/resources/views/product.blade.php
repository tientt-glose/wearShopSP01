@extends('layout')

@section('title', $product->name)

@section('extra-css')

@endsection

@section('content')

    <div class="breadcrumbs">
        <div class="container">
            <a href="/shopSP01/public">Home</a>
            <i class="fa fa-chevron-right breadcrumb-separator"></i>
            <a href="{{ route('shop.index') }}">Shop</a>
            <i class="fa fa-chevron-right breadcrumb-separator"></i>
            <span>{{ $product->name }}</span>
        </div>
    </div> <!-- end breadcrumbs -->

    <div class="product-section container">
        <div class="product-section-image">
            <img src="{{ $product->image }}" alt="product">
        </div>
        <div class="product-section-information">
            <h1 class="product-section-title">{{ $product->name }}</h1>
            <div class="product-section-subtitle">{{ $product->details }}</div>
            <div class="product-section-price">{{ $product->presentPrice() }}</div>

            <p>
                {{ $product->description }}
            </p>

            <p>&nbsp;</p>

            <form action="{{ route('cart.store') }}" method="POST">
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{ $product->id }}">
                <input type="hidden" name="name" value="{{ $product->name }}">
                <input type="hidden" name="price" value="{{ $product->price }}">
                <input type="hidden" name="details" value="{{ $product->details }}">
                <input type="hidden" name="image" value="{{ $product->image }}">
                <button type="submit" class="button button-plain">Add to Cart</button>
            </form>
        </div>
    </div> <!-- end product-section -->

    @include('partials.might-like')


@endsection
