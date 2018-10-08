<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Keyword extends Model
{
    public function company(){
        return $this->belongsTo(Company::class);
    }

    protected $fillable = [
        'name', 'slug','company_id'
    ];
}
