<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;


use App\Models\Admin\Role;
use App\Http\Requests\Admin\RoleRequest;

use Illuminate\Support\Facades\Auth;

class RolesController extends Controller {
    /**
     * @var string
     */
    protected $moduleName = 'roles';

    /**
     * RolesController constructor.
     */
    public function __construct()
    {
        $this->middleware('roles',['except'=>get_role_permissions($this->moduleName)]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $roles = (Auth::user()->hasRole('Super Admin')) ? Role::latest()->paginate(10) : Role::latest()->nouser(['Guest','Super Admin'])->paginate(10);
        return view('admin.component.roles.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $modules = get_module_names(['modules']);
        $role = '';
        return view('admin.component.roles.create',compact('modules','role'));
    }

    /**
     * @param RoleRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(RoleRequest $request)
    {
        Role::create($request->all());

        flash()->success(trans('groups.added'));

        return redirect(action('Admin\RolesController@index'));
    }

    /**
     * @param $role
     * @return mixed
     */
    public function show($role)
    {
        return $role;
    }

    /**
     * @param Role $role
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Role $role)
    {
        $modules = get_module_names(['modules']);

        return view('admin.component.roles.edit',compact('role','modules'));
    }

    /**
     * @param RoleRequest $request
     * @param $role
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(RoleRequest $request,Role $role)
    {
        if(!$request->input('permissions')):
            $request->replace(['permissions'=>'']);
        endif;
        $role->update($request->all());

        flash()->success(trans('groups.updated'));

        return redirect(action('Admin\RolesController@index'));
    }

    /**
     * @param Role $role
     * @return string|\Symfony\Component\Translation\TranslatorInterface
     * @throws \Exception
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return trans('groups.removed');
    }

}
