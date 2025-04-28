<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Category;
use App\Models\Client;
use App\Models\Order;
use App\Cart;
use App\Mail\SendMail;
use Stripe\Charge;
use Stripe\Stripe;
use Session;




class ClientController extends Controller
{
    //

    public function home() {
        $sliders = slider::All()->where('status', 1);
        $products = product::All()->where('status', 1);
        
        return view('client.home')->with('sliders', $sliders)->with('products', $products);
    }

    public function howitworks() {
         $sliders = slider::All()->where('status', 1);
         $products = product::All()->where('status', 1);
        
        return view('client.howitworks')->with('sliders', $sliders)->with('products', $products);
    }

    public function shop() {
        $products = product::All()->where('status', 1);
        $categories = category::All();

        return view('client.shop')->with('products', $products)->with('categories', $categories);
    }

    public function update_qty(Request $request, $id){

        //echo 'the product id is '.$id.' And the product qty is '.$request->quantity;
        $oldCart = Session::has('cart')? Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->updateQty($id, $request->quantity);
        Session::put('cart', $cart);

        //dd(Session::get('cart'));
        return back();
    }

    public function remove_from_cart(Request $request, $id){
        $oldCart = Session::has('cart')? Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);
       
        if(count($cart->items) > 0){
            Session::put('cart', $cart);
        }
        else{
            Session::forget('cart');
        }

        //dd(Session::get('cart'));
        return back();
    }
    public function addtocart($id){
        $product = Product::find($id);

        $oldCart = Session::has('cart')? Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->add($product, $id);
        Session::put('cart', $cart);

        //dd(Session::get('cart'));
        return back();

    }

    public function cart() {
        if(!Session::has('cart')){
            return view('client.cart');
        }

        $oldCart = Session::has('cart')? Session::get('cart'):null;
        $cart = new Cart($oldCart);

        //dd(Session::get('cart'));

        return view('client.cart', ['products' => $cart->items]);
    }


    public function checkout() {
        if(!Session::has('client')){
            return view('client.login');
        }

        if(!Session::has('cart')){
            return view('client.cart');
        }
        return view('client.checkout');
    }

    public function create_account(Request $request){
        $this->validate($request, ['email' => 'email|required|unique:clients',
                                    'password' => 'required|min:4']);

        $client = new Client();
        $client->email = $request->input('email');
        $client->password = bcrypt($request->input('password'));

        $client->save();

        return back()->with('status', 'Your account has been sucessfully created!');

    }
    public function login() {
        return view('client.login');
    }
    
    public function access_account(Request $request){
        $this->validate($request, ['email' => 'email|required',
        'password' => 'required']);  

        $client = new Client();
        $client = Client::where('email', $request->input('email'))->first();

        if($client){
            if(Hash::check($request->input('password'), $client->password)){
                Session::put('client', $client);
                return redirect('shop');
            }else{
                return back()->with('status', 'Wrong email or password');
            }
        }else {
            return back()->with('status', "You don't have an account with this email");
        }
    }
    public function signup() {
        return view('client.signup');
    }


    public function logout(){
        Session::forget('client');

        return redirect('/shop');
    }

    public function postcheckout(Request $request){
   
        $oldCart = Session::has('cart')? Session::get('cart'):null;
        $cart = new Cart($oldCart);

        $stripeSecret = env('STRIPE_TESTAPI_KEY');
        Stripe::setApiKey($stripeSecret);
        
        try{

            $charge = Charge::create(array(
                "amount" => $cart->totalPrice * 100,
                "currency" => "usd",
                "source" => "tok_visa", // obtainded with Stripe.js
                //"source" => "$request->input('stripeToken')", // obtainded with Stripe.js
                "description" => "Test Charge"
            ));

          

        } catch(Exception $e){
            return redirect('/cart')->with('error', $e->getMessage());
        }

        $payer_id = time();
        
        $order = new Order();
        $order->name = $request->input('name');
        $order->address = $request->input('address');
        $order->cart = serialize($cart);
        $order->payer_id = $payer_id;
        
        $order->save();
      
        $orders = Order::where('payer_id', $payer_id)->get();

        $orders->transform(function($order, $key){
            $order->cart = unserialize($order->cart);

            return $order;
        });
    

        $email = Session::get('client')->email;

        Mail::to($email)->send(new SendMail($orders));

        Session::forget('cart');

        return redirect('/cart')->with('status', 'Your purchase has been sucessfully processed!');

    }
    public function orders() {
        $orders = Order::All();

        $orders->transform(function($order, $key){
            $order->cart = unserialize($order->cart);

            return $order;
        });


        return view('admin.orders')->with('orders', $orders);
    }

}
