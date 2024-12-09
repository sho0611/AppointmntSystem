<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Property extends Model
{
    use HasFactory;
    protected $table = 'properties';       
    protected $primaryKey = 'property_id';     

    protected $fillable = [
        'title', 'description', 'address', 'price',
    ];


    public function images()
    {
        return $this->hasMany(PropertyImage::class);
    }
}

