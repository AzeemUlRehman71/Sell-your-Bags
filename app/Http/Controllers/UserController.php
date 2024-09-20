<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.user.index', [
            'list' => User::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user_role = DB::table('users_role')->get('user_role');
        return view('backend.user.create', compact('user_role'));
    }

    public function role()
    {
        return view('backend.user.users_role');
    }

    public function userole()
    {

        $user_role = DB::table('users_role')->get();
        return view('backend.user.user_role', compact('user_role'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $user = new User();

        $password = bcrypt($request->password);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $password;
        $user->user_role = $request->user_role;

        $user->save();
        return redirect()->route('user.index')->with('useradded', __('User Added Successfully'));
    }

    public function role_store(Request $request)
    {
        $user['user_role'] = $request->user_role;
        $user['view'] = $request->view == 'on' ? 1 : 0;
        $user['change_status'] = $request->change_status == 'on' ? 1 : 0;
        $user['edit'] = $request->edit == 'on' ? 1 : 0;
        DB::table('users_role')->insert($user);
        return redirect()->route('user.user_role')->with('useradded', __('User Role Added Successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        DB::table('users_role')->delete($request->user_id);
        return redirect()->route('user.user_role')->with('userdeleted', __('User Deleted Successfully'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $user_role = DB::table('users_role')->get('user_role');
        return view('backend.user.edit', compact('user', 'user_role'));
    }

    public function user_role_edit($id)
    {
        $user_role = DB::table('users_role')->find($id);
        return view('backend.user.user_role_update', compact('user_role'));
    }

    public function role_update($id, Request $request)
    {
        $user['user_role'] = $request->user_role;
        $user['view'] = $request->view == 'on' ? 1 : 0;
        $user['change_status'] = $request->change_status == 'on' ? 1 : 0;
        $user['edit'] = $request->edit == 'on' ? 1 : 0;
        DB::table('users_role')->where('id', $id)->update($user);
        return redirect()->route('user.user_role')->with('userupdatesuccess', __('User Updated Successfully'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user, $id)
    {
        //dd($id);
        //  $this->validate($request, [

        //     'name' => 'required',
        //     'email' => 'required|email|unique:users,email,'.$id,
        //     'utype' => 'required'
        // ]);

        // if(isset($request->password))
        // {
        //     $this->validate($request, [

        //         'password' => 'required|min:8|required_with:password_confirmation|same:password_confirmation',
        //     ]);
        // }

        $user = User::find($id);
        if (isset($request['password'])) {
            $password = bcrypt($request['password']);
        } else {
            $password = $user->password;
        }

        //$user->update($request->all());
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $password;
        $user->user_role = $request->user_role;

        $user->update();
        return redirect()->route('user.index')->with('userupdatesuccess', __('User Updated Successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required'
        ]);

        $user = User::find($request->user_id);
        $user->delete();
        return redirect()->route('user.index')->with('userdeleted', __('User Deleted Successfully'));
    }

    public function setLoginPin()
    {
        return view('backend.user.set_login_pin');
    }

    public function setLoginPinStore(Request $request)
    {
        $this->validate($request, [
            'pin' => 'required|digits:4|unique:users,pin,'.auth()->user()->id
        ]);

        $user = User::find(auth()->user()->id);
        $user->pin = $request->pin;
        $user->update();

        return redirect()->route('set_login_pin')->with('setloginpin', __('Set login pin Successfully'));
    }
}
