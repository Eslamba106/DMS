<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UserManagmentController extends Controller
{
    use AuthorizesRequests;
    public function index(Request $request){

        $this->authorize('user_management');


        $ids = $request->bulk_ids;
        $now = Carbon::now()->toDateTimeString();
        if ($request->bulk_action_btn === 'update_status' && $request->status && is_array($ids) && count($ids)) {
            $data = ['status' => $request->status];
            $this->authorize('change_users_status');
          
            User::whereIn('id', $ids)->update($data);
            return back()->with('success', __('تم التحديث بنجاح'));
        }
         if ($request->bulk_action_btn === 'update_status' && $request->role && is_array($ids) && count($ids)) {
            $data = ['role_id' => $request->role];
            $this->authorize('change_users_role');

            ($request->role == 1) ? $data['role_name'] = "user" : $data['role_name'] = 'admin' ;
            $is_update = User::whereIn('id', $ids)->update($data);
            
            return back()->with('success', __('تم التحديث بنجاح'));
        }
        if ($request->bulk_action_btn === 'update_role' && $request->role_id && is_array($ids) && count($ids)) {
            $data = ['role_id' => $request->role_id];
            User::whereIn('id', $ids)->update($data);
            return back()->with('success', __('تم التحديث بنجاح'));
        }
        if ($request->bulk_action_btn === 'delete' &&  is_array($ids) && count($ids)) {


            User::whereIn('id', $ids)->delete();
            return back()->with('success', __('تم الحذف بنجاح'));
        }
        $users = User::orderBy("created_at","desc")->paginate(10);
        return view("admin.users.all_users", compact("users"));
    }
}
