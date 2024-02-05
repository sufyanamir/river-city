<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Estimate;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function index()
    {
        $userDetails = session('user_details');

        // Fetch customers with estimates relationship
        $customers = Customer::with('estimates')->get();

        $sources = [];
        $completedEstimators = [];

        foreach ($customers as $customer) {
            $sourceName = $customer->source;

            if (!isset($sources[$sourceName]['total_customers'])) {
                $sources[$sourceName]['total_customers'] = 0;
            }

            if (!isset($sources[$sourceName]['estimate_total'])) {
                $sources[$sourceName]['estimate_total'] = 0;
            }

            $sources[$sourceName]['total_customers'] += 1; // Increment total customers for the source
            $sources[$sourceName]['estimate_total'] += $customer->estimates->sum('estimate_total');

            // Check if estimate_status is completed before adding to completedEstimators
            foreach ($customer->estimates as $estimate) {
                if ($estimate->estimate_status === 'complete') {
                    $ownerName = $customer->owner;

                    if (!isset($completedEstimators[$ownerName]['total_estimates'])) {
                        $completedEstimators[$ownerName]['total_estimates'] = 0;
                    }

                    if (!isset($completedEstimators[$ownerName]['estimate_total'])) {
                        $completedEstimators[$ownerName]['estimate_total'] = 0;
                    }

                    $completedEstimators[$ownerName]['total_estimates'] += 1;
                    $completedEstimators[$ownerName]['estimate_total'] += $estimate->estimate_total;
                }
            }
        }

        // return response()->json(['sources' => $sources, 'completed_estimators' => $completedEstimators]);
        return view('reports', ['sources' => $sources, 'completed_estimators' => $completedEstimators]);
    }
}
