<?php

namespace App\Http\Controllers;

use App\Models\MessengerOrder;
use Illuminate\Http\Request;

class MessengerTrackingController extends Controller
{
    public function trackClick(Request $request)
    {
        MessengerOrder::create([
            'user_id' => auth()->id(),
            'type' => $request->type,
            'product_id' => $request->product_id,
            'variant_id' => $request->variant_id,
            'product_name' => $request->product_name,
            'product_slug' => $request->product_slug,
            'variant_info' => $request->variant_info,
            'price' => $request->price,
            'ip_address' => $request->ip(),
        ]);

        return response()->json(['status' => 'success']);
    }
    
}
