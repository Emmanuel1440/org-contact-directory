<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Models\Contact;
use App\Models\Industry;

class DashboardController extends Controller
{
    public function index()
    {
        $industryId = request('industry_id');
        $status = request('status'); // 'active', 'inactive', or null
    
        $query = Organization::query();
    
        if ($industryId) {
            $query->where('industry_id', $industryId);
        }
    
        if ($status === 'active') {
            $query->where('is_active', true);
        } elseif ($status === 'inactive') {
            $query->where('is_active', false);
        }
    
        $filteredOrganizations = $query->latest()->get();
    
        $industries = Industry::orderBy('name')->get();
    
        return view('dashboard.index', [
            'industries' => $industries,
            'filteredOrganizations' => $filteredOrganizations,
            'selectedIndustry' => $industryId,
            'selectedStatus' => $status,
    
            // summary
            'totalOrganizations' => Organization::count(),
            'activeOrganizations' => Organization::where('is_active', true)->count(),
            'inactiveOrganizations' => Organization::where('is_active', false)->count(),
            'totalContacts' => Contact::count(),
            'primaryContacts' => Contact::where('is_primary_contact', true)->count(),
            'industriesSummary' => Industry::withCount('organizations')->get(),
    
            // 👇 This now uses the filtered results
            'recentOrganizations' => $filteredOrganizations->take(5),
            'recentContacts' => Contact::latest()->take(5)->get(),
        ]);
    }
    

}

