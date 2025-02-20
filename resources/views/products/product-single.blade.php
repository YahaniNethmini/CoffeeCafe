@extends('layouts.app')

@section('content')
    <section class="home-slider owl-carousel">

        <div class="slider-item" style="background-image: url({{asset('assets/images/bg_3.jpg')}});">
            <div class="overlay"></div>
            <div class="container">
                <div class="row slider-text justify-content-center align-items-center">

                    <div class="col-md-7 col-sm-12 text-center ftco-animate">
                        <h1 class="mb-3 mt-5 bread">Product Detail</h1>
{{--                        <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Product Detail</span></p>--}}
                    </div>

                </div>
            </div>
        </div>
    </section>

    <div class="container">
        @if( Session::has( 'success' ))
           <p class="alert {{ Session::get('alert-class', 'alert-info') }}">
               {{ Session::get( 'success' ) }}
           </p>
        @endif
    </div>

    <section class="ftco-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mb-5 ftco-animate">
                    <a href="{{ asset('assets/images/'.$product->image.'') }}" class="image-popup">
                        <img src="{{ asset('assets/images/'.$product->image.'') }}" class="img-fluid" alt="Colorlib Template">
                    </a>
                </div>
                <div class="col-lg-6 product-details pl-md-5 ftco-animate">
                    <h3 style="color: white;">{{ $product->name }}</h3>
                    <p class="price"><span>{{ $product->price }}</span></p>
                    <p style="color: white;">
                        {{ $product->description }}
                    </p>
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="form-group d-flex">
{{--                                <div class="select-wrap">--}}
{{--                                    <div class="icon"><span class="ion-ios-arrow-down"></span></div>--}}
{{--                                    <select name="" id="" class="form-control">--}}
{{--                                        <option value="">Small</option>--}}
{{--                                        <option value="">Medium</option>--}}
{{--                                        <option value="">Large</option>--}}
{{--                                        <option value="">Extra Large</option>--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="w-100"></div>--}}
{{--                        <div class="input-group col-md-6 d-flex mb-3">--}}
{{--	             	<span class="input-group-btn mr-2">--}}
{{--	                	<button type="button" class="quantity-left-minus btn"  data-type="minus" data-field="">--}}
{{--	                   <i class="icon-minus"></i>--}}
{{--	                	</button>--}}
{{--	            		</span>--}}
{{--                            <input type="text" id="quantity" name="quantity" class="form-control input-number" value="1" min="1" max="100">--}}
{{--                            <span class="input-group-btn ml-2">--}}
{{--	                	<button type="button" class="quantity-right-plus btn" data-type="plus" data-field="">--}}
{{--	                     <i class="icon-plus"></i>--}}
{{--	                 </button>--}}
{{--	             	</span>--}}
{{--                        </div>--}}
{{--                    </div>--}}


                        <form method="POST" action="{{ route('add.cart', $product->id) }}">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="product_name" value="{{ $product->name }}">
                            <input type="hidden" name="product_price" value="{{ $product->price }}">
                            <input type="hidden" name="product_image" value="{{ $product->image }}">

                            @if(isset(Auth::user()->id))
                                @if($checkingInCart == 0)
                                    <button type="submit" name="submit" class="btn btn-primary py-3 px-5">
                                        Add to Cart
                                    </button>
                                @else
                                    <button class="btn btn-dark py-3 px-5" disabled>
                                        Added to Cart
                                    </button>
                                @endif
                            @endif
                        </form>
{{--                            <button type="submit" name="submit" class="btn btn-primary py-3 px-5">--}}
{{--                                Add to Cart--}}
{{--                            </button>--}}
                        </div>
            </div>
        </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center mb-5 pb-3">
                <div class="col-md-7 heading-section ftco-animate text-center">
                    <span class="subheading">Discover</span>
                    <h2 class="mb-4" style="color: white;">Related products</h2>
                    <p style="color: white;">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                </div>
            </div>
            <div class="row">

                @foreach($relatedProducts as $relatedProduct)
                    <div class="col-md-3">
                        <div class="menu-entry">
                            <a href="{{ route('product.single', $relatedProduct->id) }}" class="img" style="background-image: url({{asset('assets/images/'.$relatedProduct->image.'') }}"></a>
                            <div class="text text-center pt-4">
                                <h3><a href="{{ route('product.single', $relatedProduct->id) }}">{{ $relatedProduct->name }}</a></h3>
                                <p style="color: white;">{{ $relatedProduct->description }}</p>
                                <p class="price"><span>{{ $relatedProduct->price }}</span></p>
                                <p><a href="{{ route('product.single', $relatedProduct->id) }}" class="btn btn-primary btn-outline-primary">Show</a></p>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
@endsection
