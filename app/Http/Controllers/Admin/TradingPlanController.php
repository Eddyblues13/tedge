<?php

namespace App\Http\Controllers\Admin;

use App\Models\Plan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TradingPlanController extends Controller
{
    public function index()
    {
        $plans = Plan::all();

        $totalPlans = $plans->count();
        $avgPrice   = $plans->avg('price') ?? 0;
        $minPrice   = $plans->min('price') ?? 0;
        $maxPrice   = $plans->max('price') ?? 0;

        return view('admin.plans.index', compact(
            'plans',
            'totalPlans',
            'avgPrice',
            'minPrice',
            'maxPrice'
        ));
    }

    public function create()
    {
        // Modals are used on the index page now
        return redirect()->route('admin.plans.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'swap_fee' => 'nullable|boolean',
            'pairs' => 'required|integer|min:1',
            'leverage' => 'nullable|string|max:50',
            'spread' => 'nullable|string|max:50',
        ]);

        // Ensure swap_fee defaults to false if not sent
        $validated['swap_fee'] = $request->has('swap_fee') ? (bool) $request->input('swap_fee') : false;

        try {
            Plan::create($validated);
            return response()->json([
                'status' => 'success',
                'message' => 'Plan created successfully!',
                'redirect' => route('admin.plans.index')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error creating plan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function edit(Plan $plan)
    {
        // Modals are used on the index page now
        return redirect()->route('admin.plans.index');
    }

    public function update(Request $request, Plan $plan)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'swap_fee' => 'nullable|boolean',
            'pairs' => 'required|integer|min:1',
            'leverage' => 'nullable|string|max:50',
            'spread' => 'nullable|string|max:50',
        ]);

        $validated['swap_fee'] = $request->has('swap_fee') ? (bool) $request->input('swap_fee') : false;

        try {
            $plan->update($validated);
            return response()->json([
                'status' => 'success',
                'message' => 'Plan updated successfully!',
                'redirect' => route('admin.plans.index')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error updating plan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Plan $plan)
    {
        try {
            $plan->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Plan deleted successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error deleting plan: ' . $e->getMessage()
            ], 500);
        }
    }
}
