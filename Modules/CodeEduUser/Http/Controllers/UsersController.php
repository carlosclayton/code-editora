<?php

namespace CodeEduUser\Http\Controllers;

use CodeEduUser\Http\Requests\UserCreateRequest;
use CodeEduUser\Http\Requests\UserDeleteRequest;
use CodeEduUser\Http\Requests\UserUpdateRequest;
use CodeEduUser\Repositories\RoleRepository;
use CodeEduUser\Repositories\UserRepository;
use CodeEduUser\Annotations\Mapping as Permission;



/**
 *
 * @Permission\ControllerAnnotation(name="user-admin", description="Users administration")
 */
class UsersController extends Controller
{

    /**
     * @var UserRepository
     */
    private $repository;


    /**
     * @var
     */
    private $roleRepository;

        /**
     * usersController constructor.
     */
    public function __construct(UserRepository $repository, RoleRepository $roleRepository)
    {
        $this->repository = $repository;
        $this->roleRepository = $roleRepository;
    }

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     * @Permission\ActionAnnotation(name="list", description="User list")
     */
    public function index()
    {
        //$users = Category::Trashed()->paginate(5);
        $users = $this->repository->paginate(5);
        return view('codeeduuser::users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     * @Permission\ActionAnnotation(name="create", description="User create")
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = $this->roleRepository->all()->pluck('name', 'id');
        return view('codeeduuser::users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     * @Permission\ActionAnnotation(name="store", description="User store")
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserCreateRequest $request)
    {
        $this->repository->create($request->all());
        $url = $request->get('redirect_to', route('codeeduuser.users.index'));
        $request->session()->flash('message', 'Created successfully');
        return redirect()->to($url);

    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @Permission\ActionAnnotation(name="edit", description="User edit")
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $user = $this->repository->find($id);
        $roles = $this->roleRepository->all()->pluck('name', 'id');
        return view('codeeduuser::users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @Permission\ActionAnnotation(name="update", description="User update")
     */
    public function update(UserUpdateRequest $request, $id)
    {
        $data  = $request->except(['password']);
        $this->repository->update($data, $id);
        $url = $request->get('redirect_to', route('codeeduuser.users.index'));
        $request->session()->flash('message', 'Updated successfully');
        return redirect()->to($url);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @Permission\ActionAnnotation(name="destroy", description="User destroy")
     */
    public function destroy(UserDeleteRequest $request, $id)
    {


        $this->repository->delete($id);
        \Session::flash('message', 'Deleted successfully');
        return redirect()->to(\URL::previous());
    }
}
