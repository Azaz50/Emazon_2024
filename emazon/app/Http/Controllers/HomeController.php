<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Mail\UserRegistered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // Retrieve the user with ID 1
        $user = User::find(1);

        if ($user) {
            // Prepare the registration mail
            $registration_mail = new UserRegistered($user);

            // Try to send the mail and catch any potential exceptions
            try {
                Mail::to($user)->send($registration_mail);
            } catch (\Exception $e) {
                // Log the error message for debugging
                Log::error('Failed to send registration email: ' . $e->getMessage());
            }
        } else {
            // Handle the case where the user is not found
            Log::warning('User with ID 1 not found');
        }

        // Fetch the latest 12 products
        $products = Product::latest()->take(12)->get();

        // Return the home view with the products data
        return view('home', [
            'products' => $products,
        ]);
    }
}
