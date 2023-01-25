<?php

namespace App\Http\Livewire;

use Livewire\Component;
use GuzzleHttp\Client;
use App\Models\Paises;

class PaginaMapa extends Component
{
    public function render()
    {
        return view('livewire.pagina-mapa');
    }
}
