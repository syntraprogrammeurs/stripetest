<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Charge;
use Stripe\Customer;
use Stripe\Stripe;

class AankopenController extends Controller
{
    //
    public function store(){
        //dd(request()->all());
        Stripe::setApiKey(config('services.stripe.secret'));

        $customer = Customer::create([
            'email'=> request('stripeEmail'),
            'source'=> request('stripeToken'),
        ]);

        Charge::create([
            'customer'=> $customer->id,
            'amount'=> 1000,
            'currency' => 'eur',
        ]);

        return 'ok overdracht gelukt';
    }
}
