<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Models\User;
Use App\Models\Category;
use Stripe;
use Session;
use Exception;
use View;

class SubscriptionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');

        // menu
  
        $categories = $this->getCategories();
        View::share('categories', $categories);
    }

    public function index()
    {
        return view('subscriptions.create');
    }

    public function create()
    {
        $availablePlans =[
           'webdevmatics_monthly' => "Monthly",
           'webdevmatics_yearly' => "Yearly",
        ];
        $data = [
            'intent' => auth()->user()->createSetupIntent(),
            'plans'=> $availablePlans
        ];
        return view('create')->with($data);
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

    private function getCategories()
    {
        return Category::orderBy('title','ASC')->pluck('title', 'id');
    }   
}
