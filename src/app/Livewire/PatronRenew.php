<?php

namespace Dcplibrary\PAPIAccount\App\Livewire;

use Dcplibrary\PAPIAccount\App\Concerns\ViewConcerns;
use Dcplibrary\PAPIAccount\App\Http\Controllers\Patron;
use Livewire\Component;
use Livewire\WithFileUploads;

class PatronRenew extends Component
{
    use withFileUploads;
    use ViewConcerns;
    public $photo;

    public function save()
    {
        Patron::savePhoto($this->photo);
        unset($this->photo);
    }

    public function render()
    {
        return view('papiaccount::livewire.patron.renew');
    }
}
