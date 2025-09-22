<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class PatronCode extends Model
    {
        use HasFactory;

        protected $fillable = [
            'PatronCodeID',
            'Description',
        ];
    }
