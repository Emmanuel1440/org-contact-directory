<?php

namespace App\Http\Controllers;

use App\Models\Industry;
use Illuminate\Http\Request;

class IndustryController extends Controller
{
    public function index(Request $request)
    {
        $query = Industry::query();
    
        // ✅ Search by name
        if ($request->filled('search')) {
            $query->where('name', 'ILIKE', '%' . $request->search . '%'); // Use ILIKE if using PostgreSQL
        }
    
        // ✅ Filter by is_active
        if ($request->filled('status')) {
            if ($request->status === 'active') {
                $query->where('is_active', true);
            } elseif ($request->status === 'inactive') {
                $query->where('is_active', false);
            }
        }
    
        $industries = $query->orderBy('name')->paginate(10);
    
        return view('industries.index', compact('industries'));
    }
    

    public function create()
    {
        return view('industries.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50|unique:industries,name',
            'description' => 'nullable|string',
            //'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->has('is_active') ;

        Industry::create($validated);

        return redirect()->route('industries.index')->with('success', 'Industry created successfully.');
    }

    public function show($id)
    {
        $industry = Industry::findOrFail($id);
        return view('industries.show', compact('industry'));
    }

    public function edit($id)
    {
        $industry = Industry::findOrFail($id);
        return view('industries.edit', compact('industry'));
    }

    public function update(Request $request, $id)
    {
        $industry = Industry::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:50|unique:industries,name,' . $industry->id,
            'description' => 'nullable|string',
            //'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active']= $request->has('is_active');

        $industry->update($validated);

        return redirect()->route('industries.index')->with('success', 'Industry updated successfully.');
    }

    public function destroy($id)
    {
        $industry = Industry::findOrFail($id);
        $industry->delete();

        return redirect()->route('industries.index')->with('success', 'Industry deleted.');
    }
}
