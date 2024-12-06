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

    public static function getPropertiesWithImages()
    {
            // $properties = DB::table('properties')
            // ->leftJoin('property_images', 'properties.property_id', '=', 'property_images.property_id')
            // ->select(
            //     'properties.property_id',
            //     'properties.title',
            //     'properties.description',
            //     'properties.address',
            //     'properties.price',
            //     'property_images.image_path'
            // )
            // ->get();
            // $properties = $properties->groupBy('property_id');

            // return $properties;
    }


    public function images()
    {
        return $this->hasMany(PropertyImage::class);
    }
}

