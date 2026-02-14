<?php

namespace App\Http\Controllers;

use App\Models\Distributor;
use Illuminate\Http\Request;

class DistributorController extends Controller
{
    /**
     * Show the public distributorship page.
     */
    public function index()
    {
        $distributors = Distributor::all();
        return view('distributorship', compact('distributors'));
    }

    /**
     * Show the admin distributors list.
     */
    public function adminIndex(Request $request)
    {
        $query = Distributor::query();
        
        // Search functionality
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('company', 'like', "%{$search}%")
                  ->orWhere('contact_person', 'like', "%{$search}%")
                  ->orWhere('email_id', 'like', "%{$search}%")
                  ->orWhere('city', 'like', "%{$search}%")
                  ->orWhere('state_wise_distribution', 'like', "%{$search}%")
                  ->orWhere('contact_information', 'like', "%{$search}%");
            });
        }
        
        $perPage = $request->get('per_page', 15);
        $distributors = $query->orderBy('created_at', 'desc')->paginate($perPage);
        
        // Append query parameters to pagination links
        $distributors->appends($request->query());
        
        return view('admin.distributors.index', compact('distributors'));
    }

    /**
     * Show the form for creating a new distributor.
     */
    public function create()
    {
        return view('admin.distributors.create');
    }

    /**
     * Store a newly created distributor in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'company' => 'required|string|max:255',
            'contact_person' => 'required|string|max:255',
            'contact_information' => 'required|string|max:255',
            'email_id' => 'required|email|max:255',
            'city' => 'required|string|max:255',
            'state_wise_distribution' => 'required|string|max:255',
        ]);

        Distributor::create($request->all());

        return redirect()->route('admin.distributors.index')->with('success', 'Distributor added successfully!');
    }

    /**
     * Display the specified distributor.
     */
    public function show(Distributor $distributor)
    {
        return view('admin.distributors.show', compact('distributor'));
    }

    /**
     * Show the form for editing the specified distributor.
     */
    public function edit(Distributor $distributor)
    {
        return view('admin.distributors.edit', compact('distributor'));
    }

    /**
     * Update the specified distributor in storage.
     */
    public function update(Request $request, Distributor $distributor)
    {
        $request->validate([
            'company' => 'required|string|max:255',
            'contact_person' => 'required|string|max:255',
            'contact_information' => 'required|string|max:255',
            'email_id' => 'required|email|max:255',
            'city' => 'required|string|max:255',
            'state_wise_distribution' => 'required|string|max:255',
        ]);

        $distributor->update($request->all());

        return redirect()->route('admin.distributors.index')->with('success', 'Distributor updated successfully!');
    }

    /**
     * Remove the specified distributor from storage.
     */
    public function destroy(Distributor $distributor)
    {
        $distributor->delete();

        return redirect()->route('admin.distributors.index')->with('success', 'Distributor deleted successfully!');
    }
}
