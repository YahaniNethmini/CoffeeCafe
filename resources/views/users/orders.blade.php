@extends('layouts.app')

@section('content')
    <section class="home-slider owl-carousel">

        <div class="slider-item" style="background-image: url({{ asset('assets/images/bg_3.jpg') }});">
            <div class="overlay"></div>
            <div class="container">
                <div class="row slider-text justify-content-center align-items-center">

                    <div class="col-md-7 col-sm-12 text-center ftco-animate">
                        <h1 class="mb-3 mt-5 bread">My Orders</h1>
{{--                        <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Cart</span></p>--}}
                    </div>

                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section ftco-cart">
        <div class="container">
            <div class="row">
                <div class="col-md-12 ftco-animate">
                    <div class="cart-list">
                        <table class="table-dark w-100">
                            <thead class="thead-primary">
                            <tr class="text-center">
                                <th>Frst Name</th>
                                <th>Last Name</th>
                                <th>Address</th>
                                <th>City</th>
                                <th>Email</th>
                                <th>Price</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>

                            @if($orders->count() > 0)
                                @foreach($orders as $order)
                                    <tr class="text-center">
                                        <td class="product-remove">{{ $order->first_name }}</td>
                                        <td class="image-prod">{{ $order->last_name }}</td>
                                        <td class="product-name">{{ $order->address }}</td>
                                        <td class="price">{{ $order->city }}</td>
                                        <td>{{ $order->email }}</td>
                                        <td>{{ $order->price }}</td>
                                        <td>{{ $order->status }}</td>
                                    </tr><!-- END TR-->
                                @endforeach
                            @else
                                <p class="alert alert-success">
                                   You have no orders yet.
                                </p>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
