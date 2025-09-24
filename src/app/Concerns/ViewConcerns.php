<?php

namespace Dcplibrary\PAPIAccount\App\Concerns;

use Dcplibrary\PAPIAccount\App\Http\Controllers\Patron;

trait ViewConcerns
{
    public function showInformation()
    {
        $this->current = 'patron-information';
    }

    public function showContact()
    {
        $this->current = 'patron-contact';
    }

    public function showNotifications()
    {
        $this->current = 'patron-notifications';
    }

    public function showRenew()
    {
        $this->current = 'patron-renew';
    }

    protected function update($key, $value): void
    {
        session([$key => $value]);
        Patron::edit($key, $value);
    }
}
