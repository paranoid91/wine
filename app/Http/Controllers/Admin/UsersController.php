<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\UserRequest;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\Admin\Role;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    /**
     * @var string
     */
    protected $moduleName = 'users';

    /**
     * UsersController constructor.
     */
    public function __construct(){
        $this->middleware('roles',['except'=>get_role_permissions($this->moduleName)]);
    }

    /**
     * @param User $users
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(User $users)
    {
        $users = $users->paginate(10);
        return view('admin.component.users.index',compact('users'));
    }

    /**
     * @param Role $role
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Role $role)
    {
        $roles = array();
        $role = (Auth::user()->hasRole(['Super Admin','Administrator'])) ? $role->nouser(['Super Admin','Guest'])->select('id','name')->get()->toArray() : '';
        foreach($role as $r){
            $roles[$r['id']] = $r['name'];
        }
        return view('admin.component.users.create',compact('roles'));
    }

    /**
     * @param UserRequest $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(UserRequest $request,User $user)
    {
        $create = $user->create($request->all());
        $create->addRole($request->input('role'));
        flash()->success(trans('admin.user_added'));
        return redirect(action('Admin\UsersController@index'));
    }


    /**
     * @param Role $role
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Role $role,User $user)
    {
        $roles = array();
        $role = (Auth::user()->hasRole(['Super Admin','Administrator'])) ? $role->nouser(['Super Admin','Guest'])->select('id','name')->get() : '';
        if(!empty($role)){
            foreach($role as $r){
                $roles[$r['id']] = $r['name'];
            }
        }

        return view('admin.component.users.edit',compact('user','roles'));
    }

    /**
     * @param UserRequest $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(UserRequest $request,User $user)
    {
        $user->update($request->all());
        $user->updateRole($request->input('role'));
        flash()->success(trans('admin.user_updated'));
        return redirect(action('Admin\UsersController@index'));
    }

    /**
     * @param User $user
     * @return string
     * @throws \Exception
     */
    public function destroy(User $user)
    {
        $user->delete();
        return trans('admin.account') .  ' #'.$user->id.' '. trans('admin.successfully_removed');
    }


}
