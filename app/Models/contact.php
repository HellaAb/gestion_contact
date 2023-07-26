<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = 'contact';

    public function organisation()
    {
        return $this->belongsTo(Organisation::class, 'organisation_id');
    }
    
}

?>