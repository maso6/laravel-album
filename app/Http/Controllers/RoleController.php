<?php
    
namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Log;

use DB;
    
class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index','store']]);
        $this->middleware('permission:role-create', ['only' => ['create','store']]);
        $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(Auth::check()){
            $user = User::where('id', Auth::id())->firstorfail();
            $roles = Role::orderBy('id','DESC')->get();
            return view('roles.index',compact('roles','user'))->with('i', ($request->input('page', 1) - 1) * 5);
        } 
        return view('auth.login');
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::check()){
            $user = User::where('id', Auth::id())->firstorfail();
            $roles = Role::orderBy('id','DESC')->get();
            $permission = Permission::get();
            return view('roles.create',compact('permission','user'));
        } 
        return view('auth.login');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);
    
        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));
    
        $log = new Log;
        $log->created_at = date('Y-m-d H:i:s');
        $log->user_id = Auth::id();
        $log->description = "User: " . Auth::id() . " Have created a role with name: " . $request->input('name');
        $log->save();

        return redirect()->route('roles.index')->with('success','Role created successfully');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Auth::check()){
            $user = User::where('id', Auth::id())->firstorfail();
            $roles = Role::orderBy('id','DESC')->paginate(5);
            $role = Role::find($id);
            $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")->where("role_has_permissions.role_id",$id)->get();
            return view('roles.show',compact('role','rolePermissions','user'));
        } 
        return view('auth.login');
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::check()){
            $user = User::where('id', Auth::id())->firstorfail();
            $roles = Role::orderBy('id','DESC')->paginate(5);
            $role = Role::find($id);
            $permission = Permission::get();
            $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')->all();
            return view('roles.edit',compact('role','permission','rolePermissions','user'));
        } 
        return view('auth.login');
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);
    
        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();
    
        $role->syncPermissions($request->input('permission'));
    
        $log = new Log;
        $log->created_at = date('Y-m-d H:i:s');
        $log->user_id = Auth::id();
        $log->description = "User: " . Auth::id() . " Have edit a role with name: " . $request->input('name');
        $log->save();
        return redirect()->route('roles.index')->with('success','Rollen er opdeteret');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table("roles")->where('id',$id)->delete();

        $log = new Log;
        $log->created_at = date('Y-m-d H:i:s');
        $log->user_id = Auth::id();
        $log->description = "User: " . Auth::id() . " Have deleted a role with id: " . $id;
        $log->save();
        return redirect()->route('roles.index')->with('success','Rollen er slettet');
    }
}