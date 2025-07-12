<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Organization;
use App\Models\Industry;
use Livewire\WithPagination;

class OrganizationFilter extends Component
{
    use WithPagination;

    public $industryId = null;
    public $search = '';

    protected $paginationTheme = 'tailwind';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingIndustryId()
    {
        $this->resetPage();
    }

    public function render()
    {
        $industries = Industry::where('is_active', true)->get();

        $organizations = Organization::with('industry')
            ->when($this->search, function ($query) {
                $query->where('name', 'ILIKE', "%{$this->search}%")
                      ->orWhere('website', 'ILIKE', "%{$this->search}%")
                      ->orWhereHas('industry', function ($q) {
                          $q->where('name', 'ILIKE', "%{$this->search}%");
                      });
            })
            ->when($this->industryId, function ($query) {
                $query->where('industry_id', $this->industryId);
            })
            ->orderBy('name')
            ->paginate(10);

        return view('livewire.organization-filter', compact('industries', 'organizations'));
    }
}
