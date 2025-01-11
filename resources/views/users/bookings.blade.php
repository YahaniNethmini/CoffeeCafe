@extends('layouts.app')

@section('content')
    <section class="home-slider owl-carousel">

        <div class="slider-item" style="background-image: url({{ asset('assets/images/bg_3.jpg') }});">
            <div class="overlay"></div>
            <div class="container">
                <div class="row slider-text justify-content-center align-items-center">

                    <div class="col-md-7 col-sm-12 text-center ftco-animate">
                        <h1 class="mb-3 mt-5 bread">My Bookings</h1>
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
                            <tr class="text-center" style="background-color: #c49b63; height: 80px;">
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Phone</th>
                                <th>Status</th>
                                <th>Write Review</th>
                            </tr>
                            </thead>
                            <tbody>

                            @if($bookings->count() > 0)
                                @foreach($bookings as $booking)
                                    <tr class="text-center" style="height: 60px;">
                                        <td class="product-remove">{{ $booking->first_name }}</td>
                                        <td class="image-prod">{{ $booking->last_name }}</td>
                                        <td class="product-name">{{ $booking->date }}</td>
                                        <td class="price">{{ $booking->time }}</td>
                                        <td>{{ $booking->phone }}</td>
                                        <td>{{ $booking->status }}</td>
                                        <td>
                                            @if( $booking->status == "Booked" )
                                                <a class="btn btn-primary" href="{{ route('write.reviews') }}">Write Review</a>
                                            @else
                                                <p>Not available yet</p>
                                            @endif
                                        </td>
                                    </tr><!-- END TR-->
                                @endforeach
                            @else
                                <p class="alert alert-success">
                                    You have no bookings yet.
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
