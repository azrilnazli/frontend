<?php

namespace App\Http\Controllers;
use App\Models\Category;

use Illuminate\Http\Request;

use View;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        // menu
  
        $categories = $this->getCategories();
        View::share('categories', $categories);
    }

    private function getCategories()
    {
        return Category::orderBy('title','ASC')->pluck('title', 'id');
    }   

    public function billing()
    {

        if ( auth()->user()->subscribed('main')) {
            // redirect to home
            return redirect( route('home') );
        }
        $availablePlans =[
           'price_1HlGQwHhfm2rhIO6mF7GtxBl' => "Monthly [ RM5 ]",
           'price_1HlGiRHhfm2rhIO6Z7q8PBzR' => "Yearly [ RM50 ]",
        ];
        $data = [
            'intent' => auth()->user()->createSetupIntent(),
            'plans'=> $availablePlans
        ];
        return view('payments.billing')->with($data);
    }

    public function subscribe(Request $request)
    {
        $user = auth()->user();
        $paymentMethod = $request->payment_method;

        $planId = $request->plan;
        $user->newSubscription('main', $planId)->create($paymentMethod);

        return response([
            'success_url'=> redirect()->intended('/')->getTargetUrl(),
            'message'=>'success'
        ]);

    }    

}
