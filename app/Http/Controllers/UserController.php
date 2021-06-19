<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsersCreateRequest;
use App\Http\Requests\UsersUpdateRequest;
use App\Services\UserServices;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected $services;

    public function __construct(UserServices $services){
        $this->services = $services;
    }

    public function index()
    {
        try {

            $users = $this->services->all();
            if (request()->wantsJson()) {

                return response()->json([
                    'data' => $users,
                ]);
            }
        } catch (\Throwable $th) {
            if (request()->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $th->getMessage()
                ]);
            }
        }

    }

    public function search(Request $request)
    {

        try {
            if ($request->query()) {
                [$key, $value] = Arr::divide($request->query());


                $users = $this->services->findByField(head($key),head($value));
                if (request()->wantsJson()) {

                    return response()->json([
                        'data' => $users,
                    ]);
                }
            }

        } catch (\Throwable $th) {
            if (request()->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $th->getMessage()
                ]);
            }
        }
    }

    public function store(UsersCreateRequest $request)
    {
        try {
            $user = $this->services->create($request->all());

            $token = $user->createToken('myToken')->plainTextToken;

            $response = [
                'message' => 'user created.',
                'data'    => $user->toArray(),
                'token'   => $token
            ];

            if ($request->wantsJson()) {

                return response()->json($response,201);
            }
        } catch (\Throwable $th) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $th->getMessage()
                ]);
            }

        }


    }

    public function update(UsersUpdateRequest $request, $id)
    {
        try {
            $user = $this->services->update($request->all(),$id);
            $response = [
                'message' => 'user updated.',
                'data'    => $user->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }
        } catch (\Throwable $th) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $th->getMessage()
                ]);
            }

        }
    }

    public function show($id)
    {
        try {

            $user = $this->services->find($id);

            if (request()->wantsJson()) {

                return response()->json([
                    'data' => $user,
                ]);
            }
        } catch (\Throwable $th) {
            if (request()->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $th->getMessage()
                ]);
            }
        }
    }

    public function destroy($id)
    {

        try {

            $deleted = $this->services->delete($id);

            if (request()->wantsJson()) {

                $response = [
                    'message' => $deleted
                ];

                return response()->json($response);
            }

        } catch (\Throwable $th) {
            if (request()->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $th->getMessage()
                ]);
            }
        }
    }

    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = $this->services->checkEmail($fields);

        if (!$user || !Hash::check(Arr::get($fields, 'password'), $user->password)) {
            return response([
                'message' => 'the credentials dont match'
            ], 401);
        }

        $token = $user->createToken('myToken')->plainTextToken;

        $response = [
            'message' => 'user logged.',
            'data'    => $user->toArray(),
            'token'   => $token
        ];

        if ($request->wantsJson()) {

            return response()->json($response,201);
        }


    }
    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'user logout'
        ];

    }
}
