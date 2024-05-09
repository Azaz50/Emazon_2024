<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\CartItem;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class CartController extends Controller
{
    private $user_id = 1;

    public function index(Request $request)
    {
        $user = User::find($this->user_id);
        $cart = $user->cart()->first();
        $cart_items = [];
        if (is_null($cart)) {
            $cart = Cart::create([
                "user_id" => $this->user_id,
            ]);
        }

        // $cart = $user->cart();
        // $order = $cart->toOrder();
        // $order->save();

        // 2. Convert cart items into products
        $cart_items = $cart->cartItems()->get();
        $order_items = [];
        foreach ($cart_items as $ci) {
            $product = $ci->product()->first();

            // 3. Create order items agains product 
            $order_item = new OrderItem();
            $order_item->user_id = $user->id;
            $order_item->product_id = $product->id;
            $order_item->qty = $ci->qty;
            $order_item->price_mp = $product->price_mp * $ci->qty;
            $order_item->price_sp = $product->price_sp * $ci->qty;
            $order_item->discount = $order_item->price_mp - $order_item->price_sp;

            $order_items[] = $order_item;
        }

        // Calculate order summary
        $gross_total = 0;
        $sub_total = 0;
        $amount = 0;
        $discount = 0;
        foreach ($order_items as $oi) {
            $gross_total += $oi->price_mp;
            $sub_total += $oi->price_sp;
            $discount += ($gross_total - $sub_total);
        }

        $coupon_discount = 0;
        if ($cart->coupon_id) {
            $coupon = $cart->coupon()->first();
            $coupon_discount = $sub_total * $coupon->value / 100;
            $discount = round($discount + $coupon_discount);
        }

        $amount = $gross_total - $discount;

        $order = new Order();
        $order->amount = $amount;
        $order->sub_total = $sub_total;
        $order->gross_total = $gross_total;
        $order->discount = $discount;
        

        // dd($cart);
        return view('cart.index', [
            "cart_items"        => $cart_items,
            "order"             => $order,
            "coupon_discount"   => $coupon_discount,
            "cart"              => $cart,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            "product_id"    => "required|integer",
            "size_id"       => "required|integer|exists:sizes,id",
            "color_id"      => "required|integer|exists:colors,id",
            "qty"           => "required|integer|min:1|max:5",
        ]);
        //dd($validated);

        $product_id = (int) $validated["product_id"];
        $qty = (int) $validated["qty"];
        if (is_null($product = Product::find($product_id))) {
            // @TODO Set session notifcation
            redirect("/");
        }

        $user = User::find($this->user_id);
        // $user = auth()->user();

        // 1. Load the cart of the user
        $cart = $user->cart()->first();
        if (is_null($cart)) {
            // Create one
            $cart = Cart::create([
                "user_id" => $user->id,
            ]);
        }

        // 2. Add product to cart item
        CartItem::create([
            "cart_id"       => $cart->id,
            "product_id"    => $product->id,
            "color_id"      => $validated['color_id'],
            "size_id"       => $validated['size_id'],
            "qty"           => $qty,
        ]);

       

        // @TODO Show success message

        return redirect("/carts");
    }

    public function remove(Request $request, int $id)
    {      
       $cart_item = CartItem::where('id', $id)->delete();

        return redirect("/carts");
    }

    public function applyCoupon(Request $request)
    {
        $validated = $request->validate([
            "coupon" => "required",
        ]);

        $coupon = Coupon::where("coupon", $validated["coupon"])->first();
        if (is_null($coupon)) {
            return redirect()->route("cart.index");
        }

        $user = User::find(1);
        $cart = $user->cart()->first();
        $cart->applyCoupon($coupon)->save();

        // @TODO check for valid coupon


        return redirect()->route('cart.index');
    }


    public function removeCoupon()
    {
        $user = User::find(1);
        $cart = $user->cart()->first();
        $cart->removeCoupon()->save();

        return redirect()->route('cart.index');
    }
}
    