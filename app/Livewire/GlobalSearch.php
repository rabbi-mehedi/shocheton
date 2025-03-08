<?php

namespace App\Livewire;

use Livewire\Component;

class GlobalSearch extends Component
{
    public $searchTerm = '';

    public function render()
    {
        return view('livewire.global-search');
    }

    public function goToSearchPage()
    {
        // Redirect to a search results route, passing the query as a GET parameter
        return redirect()->route('search.results', ['query' => $this->searchTerm]);
    }
}
