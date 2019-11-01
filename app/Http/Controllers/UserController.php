<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Authorizable;
use App\Permission;
use App\Role;
class UserController extends Controller
{
    use Authorizable;
    /**
     * Display a listing of the users
     *
     * @param  \App\User  $model
     * @return \Illuminate\View\View
     */
    public function index(User $model)
    {
        return view('users.index', ['users' => $model->paginate(15)]);
    }

    /**
     * Show the form for creating a new user
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $roles = Role::pluck('name','id');
        return view('users.create',compact('roles'));
    }

    /**
     * Store a newly created user in storage
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\User  $model
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserRequest $request, User $model)
    {
//        hash password
        $request->merge(['password' => Hash::make($request->get('password'))]);
        if($user = User::create($request->except('roles','permissions'))){
            $this->syncPermissions($request,$user);
            return redirect()->route('users.index')->withStatus(__('User successfully created.'));
        }
        else{
            return redirect()->route('users.index')->withStatus(__('Unable to create users.'));
        }
//        $model->create($request->merge(['password' => Hash::make($request->get('password'))])->all());

//        return redirect()->route('users.index')->withStatus(__('User successfully created.'));
    }

    /**
     * Show the form for editing the specified user
     *
     * @param  \App\User  $user
     * @return \Illuminate\View\View
     */
    public function edit(User $user)
    {
        $roles = Role::pluck('name','id');
        $permissions = Permission::all('name','id');
        return view('users.edit', compact('user','roles','permissions'));
    }

    /**
     * Update the specified user in storage
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserRequest $request, User  $user)
    {
        $hasPassword = $request->get('password');
//        $user->update(
//            $request->merge(['password' => Hash::make($request->get('password'))])
//                ->except([$hasPassword ? '' : 'password']
//        ));
        $user->fill($request->except('roles','permissions','password'));
        if($hasPassword){
            $user->password = Hash::make($hasPassword);
        }
        $this->syncPermissions($request,$user);
        return redirect()->route('users.index')->withStatus(__('User successfully updated.'));
    }

    /**
     * Remove the specified user from storage
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User  $user)
    {

        $user->delete();

        return redirect()->route('users.index')->withStatus(__('User successfully deleted.'));
    }

    private function syncPermissions(Request $request, $user)
    {
        // Get the submitted roles
        $roles = $request->get('roles', []);
        $permissions = $request->get('permissions', []);

        // Get the roles
        $roles = Role::find($roles);

        // check for current role changes
        if( ! $user->hasAllRoles( $roles ) ) {
            // reset all direct permissions for user
            $user->permissions()->sync([]);
        } else {
            // handle permissions
            $user->syncPermissions($permissions);
        }

        $user->syncRoles($roles);
        return $user;
    }
}
