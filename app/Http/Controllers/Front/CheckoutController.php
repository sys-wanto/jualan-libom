<?php

namespace App\Http\Controllers\Front;

use Carbon\Carbon;
use App\Models\Item;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class CheckoutController extends Controller
{
    public function index(Request $request, $slug)
    {
        $item = Item::with(['type', 'brand'])->whereSlug($slug)->firstOrFail();
        $instalment_period_list = [
            '11 Bulan', '23 Bulan', '35 Bulan'
        ];
        return view('checkout', [
            'item' => $item,
            'instalment_period_list' => $instalment_period_list
        ]);
    }

    public function store(Request $request, $slug)
    {
        // Validate the request
        $request->validate([
            'name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'address' => 'required',
            'city' => 'required',
            'zip' => 'required'
        ]);

        // Format start_date and end_date from dd mm yyyy to timestamp
        $start_date = Carbon::createFromFormat('d m Y', $request->start_date);
        $end_date = Carbon::createFromFormat('d m Y', $request->end_date);

        // Count the number of days between start_date and end_date
        // $days = $start_date->diffInDays($end_date);

        // Get the item
        $item = Item::whereSlug($slug)->firstOrFail();
        if ($request->jenis_pembayaran == 'cash') {
            //beban/pajak 10% = harga barang * 10%
            $tax = $item->price * 0.1;
            //total harga = harga barang + beban/pajak 10%
            $total_price = $item->price + $tax;
            $percent_credit = 100;
        } else {
            // Jumlah Cicilan
            // $period_month = explode(' ', $request->rencana_pembayaran)[0];
            //DP = harga barang * persen DP
            $down_payment = ($item->price / 100) * $request->downPayment;
            $percent_credit = $request->downPayment;
            //cicilan_termasuk_beban_pajak_10_persen = ((harga barang - DP) / jumlah cicilan)
            // $instalment = (($item->price - $down_payment) / intval($period_month));
            //beban/pajak 10% = harga barang * 10%
            $tax = $item->price * 0.1;
            //total harga = DP + cicilann*jumlah_cicilan + beban/pajak 10%;
            // $total_price = $down_payment + ($instalment * intval($period_month)) + $tax;
            $total_price = $down_payment + $tax;
        }
        // // Calculate the total price
        // $total_price = $days * $item->price;

        // // Add 10% tax
        // $total_price = $total_price + ($total_price * 0.1);

        // Create a new booking
        $booking = $item->bookings()->create([
            'name' => $request->name,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'address' => $request->address,
            'city' => $request->city,
            'zip' => $request->zip,
            'user_id' => auth()->user()->id,
            'percent_credit' => $percent_credit,
            'total_price' => $total_price
        ]);

        return redirect()->route('front.payment', $booking->id);
    }
}