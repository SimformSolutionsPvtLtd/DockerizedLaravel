<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Repositories\UserRepository;
class UserController extends BaseController
{
    /**
     * UserController constructor.
     *
     * @param UserRepository $repository
    */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(RegisterRequest $request)
    {
       return $this->repository->registerUser($request->all());
    }

    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {
        return $this->repository->userLogin($request);
    }

    /**
     * Get Profile api
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        return $this->repository->getProfile();
    }

    /**
     * Update Profile api
     *
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(RegisterRequest $request)
    {
       return $this->repository->updateUser($request);
    }
}
