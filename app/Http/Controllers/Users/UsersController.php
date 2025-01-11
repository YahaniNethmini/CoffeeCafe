<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Product\Booking;
use App\Models\Product\Order;
use App\Models\Product\Review;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function displayOrders()
    {
        $orders = Order::select()
            ->where('user_id', Auth::user()->id)
            ->orderBy('id', 'desc')
            ->get();

        return view('users.orders', compact('orders'));
    }

    public function displayBookings()
    {
        $bookings = Booking::select()
            ->where('user_id', Auth::user()->id)
            ->orderBy('id', 'desc')
            ->get();

        return view('users.bookings', compact('bookings'));
    }

    public function writeReview()
    {
        return view('users.write-review');
    }

    public function processWriteReview(Request $request)
    {
        $writeReviews = Review::create([
            'name' => Auth::user()->name,
            'review' => $request->review,
        ]);

        if ($writeReviews) {
            return redirect()->route('write.reviews')
                ->with('reviews', 'Review submitted successfully');
        }
    }
}
