<?php

namespace App\Http\Controllers;

use mail;
use App\Models\User;
use App\Models\Product;
use App\Mail\UserRegistered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $user = User::find(1);
        $registration_mail = new UserRegistered($user);
        Mail::to($user)->send($registration_mail);
        
        $query = Product::query();
        $products = $query->take(12)->get();

        return view('home', [
            'products' => $products,
        ]);
    }
}
