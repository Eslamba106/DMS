<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DepartmentsController extends Controller
{
    public function index(Request $request){
        $ids = $request->bulk_ids;
        $now = Carbon::now()->toDateTimeString();
        if ($request->bulk_action_btn === 'delete' &&  is_array($ids) && count($ids)) {
            Department::whereIn('id', $ids)->delete();
            return back()->with('success', __('dashboard.deleted_successfully'));
        }
        $departments = Department::paginate();
        return view('admin.departments.all_departments' , compact('departments'));
    }
    public function create(){

        $users = User::all();
        
        return view('admin.departments.create' , compact('users'));

    }
    public function store(Request $request){
        $request->validate([
            'name' => "required",
        ]);
        $is_create = Department::create(['name' => $request->name]);
        if ($request->has('users')) {
            $is_create->users()->sync($request->users);
        }
        return redirect()->route('all_departments')->with('success' , __("dashboard.created_successfully"));
    }
    public function show($id){
        $department = Department::findOrFail($id);
        $users = $department->users;
        return view('admin.departments.show' , compact('department' , 'users'));
    }
}
