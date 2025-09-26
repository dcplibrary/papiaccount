<?php

namespace Dcplibrary\PAPIAccount\App\Modelz;

use Illuminate\Database\Eloquent\Model;

class PatronCode extends Model
{
    protected $fillable = [
        'PatronCodeID',
        'Description',
    ];
}
