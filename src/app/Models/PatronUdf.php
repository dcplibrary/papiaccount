<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class PatronUdf extends Model
    {
        use HasFactory;

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
                'Display' => 'boolean',
                'Required' => 'boolean',
            ];
        }
    }
