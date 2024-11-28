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
        $properties = Property::getPropertiesWithImages();
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

