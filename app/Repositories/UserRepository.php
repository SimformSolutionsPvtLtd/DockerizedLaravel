<?php

namespace App\Repositories;

use App\Helpers\ResponseManager;
use App\Http\Resources\UserResource;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Response;
class UserRepository extends Repository
{

    /**
     * UserRepository constructor.
     *
     * @param User $model
     */
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

     /**
     * @Post
     * Add User
     * @param $data
     * @throw Exception
     */
    public function registerUser($data)
    {
        try {
            $data['password'] = app('hash')->make($data['password']);

            $user = $this->model::create($data);
            $token =  $user->createToken('MyApp')->accessToken;
            return ResponseManager::successResponse(__('User created successfully.'),new UserResource($user),Response::HTTP_OK, ['token' => $token]);
         } catch (\Exception $e) {
             Log::info('UserRepository@registerUser' . $e->getMessage());
            return ResponseManager::errorResponse(__('Something went wrong'), [], 500);
        }
    }

    /**
     * @Post
     * Login user
     * @param $request
     * @throw Exception
     */
    public function userLogin($request)
    {
        try {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                $user = Auth::user();
                $token = $user->createToken('MyApp')->accessToken;
                return ResponseManager::successResponse(__('User login successfully.'),new UserResource($user),Response::HTTP_OK, ['token' => $token]);
            } else {
                return ResponseManager::errorResponse(__('Unauthorised.'), [], 500);
            }
        } catch (\Exception $e) {
            Log::info('UserRepository@userLogin' . $e->getMessage());
            return ResponseManager::errorResponse(__('Something went wrong'), [], 500);
        }
    }

    /**
     * @Get
     * current user
     * @throw Exception
     */
    public function getProfile()
    {
      return ResponseManager::successResponse(__('User profile found successfully.'), new UserResource(auth()->user()),Response::HTTP_OK);
    }

    /**
     * @Post
     * Update user
     * @param $request
     * @throw Exception
     */
    public function updateUser($request)
    {
        try {
            $user = auth()->user();
            $user->name = $request->name;
            $user->save();
            return ResponseManager::successResponse(__('User profile updated successfully.'),new UserResource(auth()->user($user)),Response::HTTP_OK);

        } catch (\Exception $e) {
            Log::info('UserRepository@updateUser' . $e->getMessage());
            return ResponseManager::errorResponse(__('Something went wrong'), [], 500);
        }
    }
}
