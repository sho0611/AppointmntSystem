<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\PropertyImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StorePropertyRequest; 

class ViewPropertyController extends Controller
{
    public function viewProperty()
    {

        $properties = Property::query()->get();
        $propertiesId = $properties->pluck('property_id');  

        $propertyImages = PropertyImage::query()
            ->whereIn('property_id', $propertiesId)
            ->get();

        $properties = $properties->map(function ($property) use ($propertyImages) {
            $property->images = $propertyImages
                ->where('property_id', $property->property_id)
                ->pluck('image_path') 
                ->toArray(); 
            return $property;
        });

        return response()->json([
            'properties' => $properties,
        ]); 
    }


    public function viewPropertyById($propertyId)
    {
        $property = Property::where('property_id', $propertyId)->first();   
        if (!$property) {
            return response()->json([
                'error' => '指定された物件が見つかりません。',
            ], 404);
        }
        return response()->json([
            'property' => $property,
        ]); 
        
    }   
}

