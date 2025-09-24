<?php

namespace Dcplibrary\PAPIAccount\App\Livewire;

use Blashbrook\PAPIClient\PAPIClient;
use Dcplibrary\PAPIAccount\App\Concerns\DateConcerns;
use Dcplibrary\PAPIAccount\App\Concerns\PatronAccountConcerns;
use Dcplibrary\PAPIAccount\App\Livewire\Forms\PatronForm;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class PatronLogin extends Component
{
    use PatronAccountConcerns;
    use DateConcerns;

    public PatronForm $form;
    /**
     * @var PAPIClient|mixed|null
     */
    private mixed $papiclient;

    public function login()
    {
        if ($this->authenticate()) {
            $patronBasicData = $this->getPatronBasicData();
        }
        $this->setPatronData($patronBasicData);

        return $this->redirect('/dashboard/information');
    }

    public function boot(PAPIClient $papiclient)
    {
        $this->papiclient = $papiclient;
    }

    public function render(): View
    {
        return view('papiaccount::livewire.patron.login')
                   ->layout('papiaccount::components.layouts.app');
    }
}
