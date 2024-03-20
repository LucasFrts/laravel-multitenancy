<?php

namespace App\Livewire;

use App\Models\Tenant\Lead;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Builder;

class LeadComponent extends Component
{
    use WithPagination;


    public ?int $quantity = 10;
 
    public ?string $search = null;

    public array $headers = [
        ['index' => 'id', 'label' => '#'],
        ['index' => 'name', 'label' => 'Name'],
        ['index' => 'email', 'label' => 'Email'],
        ['index' => 'phone', 'label' => 'Phone'],
        ['index' => 'created_at', 'label' => 'Created At']
    ];  

    public function render(Request $request) : View
    {

        return view('livewire.lead-component', [
            'rows' => Lead::query()
            ->when($this->search, function (Builder $query) {
                $search = trim($this->search);
                return $query
                ->where('name', 'like',  "%{$search}%")
                ->where('email', 'like', "%{$search}%")
                ->where('phone', 'like', "%{$search}%");
            })
            ->paginate($this->quantity)
            ->withQueryString()
        ]);
    }
}
