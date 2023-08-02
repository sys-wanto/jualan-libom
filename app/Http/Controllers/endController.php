<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class endController extends Controller
{
    //
    public function midtrans_call_back(Request $request){
        if($request->status_code == 200){
            $booking = Booking::findOrFail($request->order_id);
            if($request->transaction_status == 'settlement'){
                $booking->update([
                    'status' => $request->transaction_status,
                    'payment_status' => 'success'
                ]);
            }
        }
        return redirect()->route('front.index');
    }
}
