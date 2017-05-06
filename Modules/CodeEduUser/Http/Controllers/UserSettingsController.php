<?php

namespace CodeEduUser\Http\Controllers;

use CodeEduUser\Http\Requests\UserSettingRequest;
use CodeEduUser\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use CodeEduUser\Annotations\Mapping\ControllerAnnotation;
use CodeEduUser\Annotations\Mapping\ActionAnnotation;


/**
 * @ControllerAnnotation(name="users-settings", description="Users administration")
 */
class UserSettingsController extends Controller
{

    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * usersController constructor.
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @ActionAnnotation(name="edit", description="User edit")
     */
    public function edit()
    {
        $user = \Auth::user();
        return view('codeeduuser::users-settings.setting', compact('user'));
    }


    /**
     * @param UserSettingRequest $request
     * @ActionAnnotation(name="update", description="User update")
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserSettingRequest $request)
    {
        $user = \Auth::user();
        $this->repository->update($request->all(), $user->id);
        //$url = $request->get('redirect_to', route('codeeduser.user_settings.edit'));
        $request->session()->flash('message', 'Update sucessefully');
        return redirect()->route('codeeduuser.user_settings.edit');
    }

}
