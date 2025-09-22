<?php

namespace Dcplibrary\PAPIAccount\App\Livewire;


use Dcplibrary\PAPIAccount\App\Concerns\ViewConcerns;
use Livewire\Component;

class PatronInformation extends Component
{
    use ViewConcerns;
    public function render()
    {
        return view('papiaccount::livewire.patron.information');
    }
}
