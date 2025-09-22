<?php

namespace Dcplibrary\PAPIAccount\App\Livewire;

use Dcplibrary\PAPIAccount\App\Concerns\ViewConcerns;
use Livewire\Component;

class PatronDashboard extends Component
{
    use ViewConcerns;

    public $current = 'information';

    public $error = '';

    public function mount($view = 'information')
    {
        $this->current = 'patron.' . $view;
    }

    public function render()
    {
        return view('papiaccount::livewire.patron.dashboard')
            ->layout('papiaccount::components.layouts.app');
    }
}
