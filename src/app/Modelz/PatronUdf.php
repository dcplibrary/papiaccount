<?php

namespace Dcplibrary\PAPIAccount\App\Modelz;

use Illuminate\Database\Eloquent\Model;

class PatronUdf extends Model
{
    protected $fillable = [
        'PatronUdfID',
        'Label',
        'Display',
        'Values',
        'Required',
        'DefaultValue',
    ];

    protected function casts(): array
    {
        return [
            'Display'  => 'boolean',
            'Required' => 'boolean',
        ];
    }
}
