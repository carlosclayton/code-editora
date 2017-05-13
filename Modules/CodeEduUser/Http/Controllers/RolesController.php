<?php

namespace CodeEduUser\Http\Controllers;

use CodeEduUser\Criteria\FindPermissionsGroupCriteria;
use CodeEduUser\Criteria\FindPermissionsResourceCriteria;
use CodeEduUser\Http\Requests\PermissionRequest;
use CodeEduUser\Http\Requests\RoleCreateRequest;
use CodeEduUser\Http\Requests\RoleDeleteRequest;
use CodeEduUser\Http\Requests\RoleUpdateRequest;
use CodeEduUser\Http\Requests\UserCreateRequest;
use CodeEduUser\Http\Requests\UserDeleteRequest;
use CodeEduUser\Http\Requests\UserUpdateRequest;
use CodeEduUser\Repositories\PermissionRepository;
use CodeEduUser\Repositories\RoleRepository;
use CodeEduUser\Repositories\UserRepository;
use CodeEduUser\Annotations\Mapping as Permission;
use Doctrine\DBAL\Query\QueryException;


/**
 *
 * @Permission\ControllerAnnotation(name="users-admin", description="Roles administration")
 */
class RolesController extends Controller
{

    private $permissionRepository;
    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * usersController constructor.
     */
    public function __construct(RoleRepository $repository, PermissionRepository $permissionRepository)
    {
        $this->repository = $repository;
        $this->permissionRepository = $permissionRepository;
    }

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     * @Permission\ActionAnnotation(name="list", description="Role list")
     */
    public function index()
    {
        //$users = Category::Trashed()->paginate(5);
        $roles = $this->repository->paginate(5);
        return view('codeeduuser::roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     * @Permission\ActionAnnotation(name="create", description="Role create")
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('codeeduuser::roles.create');
    }

    /**
     * Store a newly created resource in storage.
     * @Permission\ActionAnnotation(name="store", description="Role store")
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleCreateRequest $request)
    {
        $this->repository->create($request->all());
        $url = $request->get('redirect_to', route('codeeduuser.roles.index'));
        $request->session()->flash('message', 'Created successfully');
        return redirect()->to($url);

    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @Permission\ActionAnnotation(name="edit", description="Role edit")
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $role = $this->repository->find($id);
        return view('codeeduuser::roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @Permission\ActionAnnotation(name="update", description="Role update")
     */
    public function update(RoleUpdateRequest $request, $id)
    {
        $data = $request->except('permissions');

        $this->repository->update($data, $id);
        $url = $request->get('redirect_to', route('codeeduuser.roles.index'));
        $request->session()->flash('message', 'Updated successfully');
        return redirect()->to($url);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @Permission\ActionAnnotation(name="destroy", description="Role destroy")
     */
    public function destroy(RoleDeleteRequest $request, $id)
    {
        try{
            $this->repository->delete($id);
            \Session::flash('message', 'Deleted successfully');
        }catch (QueryException $ex){
            \Session::flash('error', 'occurred an error.Try again...');
        }
        return redirect()->to(\URL::previous());
    }


    public function editPermission($id){
        $role = $this->repository->find($id);
        $this->permissionRepository->pushCriteria(new FindPermissionsResourceCriteria());
        $permissions = $this->permissionRepository->all();

        $this->permissionRepository->resetCriteria();
        $this->permissionRepository->pushCriteria(new FindPermissionsGroupCriteria());
        $permissionsGroup = $this->permissionRepository->all(['name', 'description']);

        return view('codeeduuser::roles.permissions', compact('role', 'permissions', 'permissionsGroup'));
    }

    public function updatePermission(PermissionRequest $request, $id){
        $data = $request->only('permissions');
        $this->repository->update($data, $id);
        $url = $request->get('redirect_to', route('codeeduuser.roles.index'));
        $request->session()->flash('message', 'Updated successfully');
        return redirect()->to($url);
    }

}
