<?php

namespace App\Http\Controllers;

use App\Services\UserServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function store(Request $request)
    {
        try {
            $user = $this->services->create($request->all());

            $response = [
                'message' => 'user created.',
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

    public function update(Request $request, $id)
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
}
