<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Models\Industry;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    /**
     * Display a listing of the organizations with optional search and pagination.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $organizations = Organization::with('industry')
            ->when($search, function ($query, $search) {
                $query->where('name', 'ILIKE', "%{$search}%")
                    ->orWhere('website', 'ILIKE', "%{$search}%")
                    ->orWhereHas('industry', function ($q) use ($search) {
                        $q->where('name', 'ILIKE', "%{$search}%");
                    });
            })
            ->orderBy('name')
            ->paginate(10)
            ->appends(['search' => $search]);

        return view('organizations.index', compact('organizations', 'search'));
    }

    /**
     * Show the form for creating a new organization.
     */
    public function create()
    {
        $industries = Industry::where('is_active', true)->get();
        return view('organizations.create', compact('industries'));
    }

    /**
     * Store a newly created organization in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'industry_id' => 'nullable|exists:industries,id',
            'website' => 'nullable|url|max:100',
            'tax_id' => 'nullable|string|max:30',
            'is_active' => 'boolean',
        ]);

        Organization::create($validated);

        return redirect()->route('organizations.index')
            ->with('success', 'Organization created successfully!');
    }

    /**
     * Display the specified organization.
     */
    public function show($id)
    {
        $organization = Organization::with('industry')->findOrFail($id);
        return view('organizations.show', compact('organization'));
    }

    /**
     * Show the form for editing the specified organization.
     */
    public function edit($id)
    {
        $organization = Organization::findOrFail($id);
        $industries = Industry::where('is_active', true)->get();
        return view('organizations.edit', compact('organization', 'industries'));
    }

    /**
     * Update the specified organization in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'industry_id' => 'nullable|exists:industries,id',
            'website' => 'nullable|url|max:100',
            'tax_id' => 'nullable|string|max:30',
            'is_active' => 'boolean',
        ]);

        $organization = Organization::findOrFail($id);
        $organization->update($validated);

        return redirect()->route('organizations.index')
            ->with('success', 'Organization updated successfully!');
    }

    /**
     * Remove the specified organization from storage.
     */
    public function destroy($id)
    {
        $organization = Organization::findOrFail($id);
        $organization->delete();

        return redirect()->route('organizations.index')
            ->with('success', 'Organization deleted successfully!');
    }
}
