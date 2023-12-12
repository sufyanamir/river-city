<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Estimate;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $userDetails = session('user_details');

        $customers = Customer::get();

        return view('customers', ['customers' => $customers, 'user_details' => $userDetails]);
    }
}
