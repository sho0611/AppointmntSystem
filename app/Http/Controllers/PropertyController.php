<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\PropertyImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StorePropertyRequest; 

class PropertyController extends Controller
{
    public function postProperty(StorePropertyRequest $request)
    {
        DB::beginTransaction();

        try {
            $property = Property::create([
                'title' => $request->title,
                'description' => $request->description,
                'price' => $request->price,
            ]);

            if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('property_images', 'public');
                PropertyImage::create([
                    'property_id' => $property->property_id,
                    'image_path' => $path,
                    'is_primary' => false,  
                ]);
            }
        } else {    
            return response()->json([
                'error' => '画像がアップロードされていません。',
            ], 400);    
        }    
    
            DB::commit();
    
            return response()->json(['success' => true, 'message' => '物件情報が更新されました'], 201); 

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => '物件と画像の保存中にエラーが発生しました。',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function updateProperty(StorePropertyRequest $request, $propertyId)
    {
        DB::beginTransaction();

        try {
            $property = Property::find($propertyId);

            if (!$property) {
                return response()->json([
                    'error' => '指定された物件が見つかりません。',
                ], 404);
            }

            $property->update([
                'title' => $request->title,
                'description' => $request->description,
                'price' => $request->price,
            ]);

            DB::commit();

            return response()->json(['success' => true, 'message' => '物件情報が更新されました'], 200);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => '物件情報の更新中にエラーが発生しました。',
                'message' => $e->getMessage(),
            ], 500);
        }
    }  
    
    public function deleteProperty($propertyId)
    {
        DB::beginTransaction();

        try {
            
            $property = Property::find($propertyId);

            if (!$property) {
                return response()->json([
                    'error' => '指定された物件が見つかりません。',
                ], 404);
            }

            $property->delete();

            DB::commit();

            return response()->json(['success' => true, 'message' => '物件情報が更新されました'], 200); 

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => '物件の削除中にエラーが発生しました。',
                'message' => $e->getMessage(),
            ], 500);
        }
    }   
}

