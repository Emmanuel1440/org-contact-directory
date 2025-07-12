<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Organization;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $contacts = Contact::with('organization')
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('first_name', 'ilike', "%$search%")
                        ->orWhere('last_name', 'ilike', "%$search%")
                        ->orWhere('job_title', 'ilike', "%$search%")
                        ->orWhereHas('organization', function ($q2) use ($search) {
                            $q2->where('name', 'ilike', "%$search%");
                        });
                });
            })
            ->orderBy('last_name')
            ->paginate(10);

        return view('contacts.index', compact('contacts', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $organizations = Organization::orderBy('name')->get();
        return view('contacts.create', compact('organizations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'organization_id' => 'required|exists:organizations,id',
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'job_title' => 'nullable|string|max:100',
            'department' => 'nullable|string|max:50',
            'is_primary_contact' => 'nullable|boolean',
            'notes' => 'nullable|string',
            'email' => 'nullable|email|max:100',
            'office_phone_number' => 'nullable|string|max:50',
            'mobile_phone_number' => 'nullable|string|max:50',
            'is_active' => 'nullable|boolean',
        ]);

        if (!isset($validated['is_active'])) $validated['is_active'] = true;
        if (!isset($validated['is_primary_contact'])) $validated['is_primary_contact'] = false;

        if ($validated['is_primary_contact']) {
            Contact::where('organization_id', $validated['organization_id'])->update(['is_primary_contact' => false]);
        }

        Contact::create($validated);
        return redirect()->route('contacts.index')->with('success', 'Contact created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $contact = Contact::with('organization')->findOrFail($id);
        return view('contacts.show', compact('contact'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $contact = Contact::findOrFail($id);
        $organizations = Organization::orderBy('name')->get();
        return view('contacts.edit', compact('contact', 'organizations'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $contact = Contact::findOrFail($id);

        $validated = $request->validate([
            'organization_id' => 'required|exists:organizations,id',
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'job_title' => 'nullable|string|max:100',
            'department' => 'nullable|string|max:50',
            'is_primary_contact' => 'nullable|boolean',
            'notes' => 'nullable|string',
            'email' => 'nullable|email|max:100',
            'office_phone_number' => 'nullable|string|max:50',
            'mobile_phone_number' => 'nullable|string|max:50',
            'is_active' => 'nullable|boolean',
        ]);

        if (!isset($validated['is_active'])) $validated['is_active'] = true;
        if (!isset($validated['is_primary_contact'])) $validated['is_primary_contact'] = false;

        if ($validated['is_primary_contact']) {
            Contact::where('organization_id', $validated['organization_id'])->update(['is_primary_contact' => false]);
        }

        $contact->update($validated);
        return redirect()->route('contacts.index')->with('success', 'Contact updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return redirect()->route('contacts.index')->with('success', 'Contact deleted.');
    }
}
