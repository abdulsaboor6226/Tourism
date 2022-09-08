<?php

namespace App\Http\Controllers;

use App\Models\Dictionary;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rules\Password;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::query()->latest();
        if ($request->name) {
            $users = $users->where('name','LIKE','%'.$request->name.'%');
        }
        $users = $users->with('status')->paginate(20);
        return view('user.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $status = Dictionary::userStatus()->pluck('value','id');
        $roles = Role::all()->whereNotIn('name',['super_admin'])->pluck('name');
        return view('user.create',compact('status','roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'email'=>'required|email|unique:users,email',
            'phone' => ['required','regex:'.config('general_setting.phone_number'),'unique:users,phone'],
            'password' => ['required', Password::min(8)
                ->letters()
                ->mixedCase()
                ->numbers()
                ->symbols()
                ->uncompromised()
            ],
            'profile_image'=>'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status_id'=>'required',
            'role'=>'required',
        ]);
        if($request->hasFile('profile_image')){
            $request['profile_image_url']=  $request->profile_image->store('public/image');
        }
        if($request->password){
            $request['password']=Hash::make($request->password);
        }
        $createUser = User::create($request->all());
        $createUser->assignRole($request->role);
        if(!$createUser){
            Session::flash('message', 'OOP! something went wrong');
            Session::flash('alert-class', 'alert-danger');
        }
        else{
            Session::flash('message', 'User has been successfully created');
            Session::flash('alert-class', 'alert-success');
        }
        return redirect()->route('user.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $status = Dictionary::userStatus()->pluck('value','id');
        $roles = Role::all()->whereNotIn('name',['super_admin','agent'])->pluck('name');
        return view('user.edit',compact('user','status','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request,[
            'name'=>'required',
            'email'=>'required||email|unique:users,email,'.$user->id,
            'phone' => ['required','regex:'.config('general_setting.phone_number'),'unique:users,phone,'.$user->id],
            'password' => ['required', Password::min(8)
                ->letters()
                ->mixedCase()
                ->numbers()
                ->symbols()
                ->uncompromised()
            ],
            'profile_image'=>'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status_id'=>'required',
            'role'=>'required',
        ]);
        if($request->hasFile('profile_image')){
            $request['profile_image_url']=  $request->profile_image->store('public/image');
        }
        if($request->password){
            $request['password']=Hash::make($request->password);
        }else{
            unset($request['password']);
        }
        $user->syncRoles($request->role);
        $updateUser = User::whereId($user->id)->update($request->except('_token','_method','profile_image','role'));
        if(!$updateUser){
            Session::flash('message', 'OOP! something went wrong');
            Session::flash('alert-class', 'alert-danger');
        } else{
            Session::flash('message', 'User info has been successfully Updated');
            Session::flash('alert-class', 'alert-success');
        }
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $deleteUser = $user->delete();
        if(!$deleteUser){
            Session::flash('message', 'OOP! something went wrong');
            Session::flash('alert-class', 'alert-danger');
        }
        else{
            Session::flash('message', 'User has been successfully deleted');
            Session::flash('alert-class', 'alert-success');
        }
        return redirect()->back();
    }
}
