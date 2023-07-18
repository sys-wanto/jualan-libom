<?php

namespace App\Http\Controllers\Front;

use App\Models\Item;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $items = Item::with(['type', 'brand'])->latest()->take(4)->get()->reverse();

        return view('layouts.product', [
            'items' => $items
        ]);
    }
}
