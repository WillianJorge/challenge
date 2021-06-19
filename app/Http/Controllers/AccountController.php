<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccountsCreateRequest;
use App\Http\Requests\AccountsUpdateRequest;
use App\Services\AccountServices;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class AccountController extends Controller
{
    protected $services;


    public function __construct(AccountServices $services){
        $this->services = $services;
    }

    public function index()
    {
        try {

            $accounts = $this->services->all();
            if (request()->wantsJson()) {

                return response()->json([
                    'data' => $accounts,
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

    public function store(AccountsCreateRequest $request)
    {
        try {
            $account = $this->services->create($request->all());

            $response = [
                'message' => Arr::get($account,'success') ? 'account created.' : 'erro',
                'data'    => Arr::has($account,'data') ? Arr::get($account,'data') : Arr::get($account,'errors'),
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

    public function update(AccountsUpdateRequest $request, $id)
    {
        try {
            $accounts = $this->services->update($request->all(),$id);
            $response = [
                'message' => 'account updated.',
                'data'    => $accounts->toArray(),
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

            $accounts = $this->services->find($id);

            if (request()->wantsJson()) {

                return response()->json([
                    'data' => $accounts,
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
