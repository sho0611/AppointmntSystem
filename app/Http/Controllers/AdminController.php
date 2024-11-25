<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function adminCreate(Request $request)
    {
        DB::beginTransaction();
        try {
    
            $adminData = $this->buildAdminArray($request);

            $admin = Admin::create($adminData);

            DB::commit();
            return response()->json([
                'message' => '管理者が作成されました。',
                'admin' => $admin,
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => 'データベースの保存に失敗しました: ' . $e->getMessage(),
            ], 500);
        }
    }

    private function buildAdminArray($request)
    {
        return [
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password), 
        ];
    }
}
