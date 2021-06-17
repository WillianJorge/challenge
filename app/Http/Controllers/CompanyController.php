<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompaniesCreateRequest;
use Illuminate\Http\Request;
use App\Services\CompanyServices;
use Illuminate\Support\Arr;

class CompanyController extends Controller
{

    protected $services;


    public function __construct(CompanyServices $services){
        $this->services = $services;
    }

    public function index()
    {
        try {

            $companies = $this->services->all();
            if (request()->wantsJson()) {

                return response()->json([
                    'data' => $companies,
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



    public function store(CompaniesCreateRequest $request)
    {
        try {
            $company = $this->services->create($request->all());

            $response = [
                'message' => 'company created.',
                'data'    => $company->toArray(),
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
            $company = $this->services->update($request->all(),$id);
            $response = [
                'message' => 'company updated.',
                'data'    => $company->toArray(),
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

            $company = $this->services->find($id);

            if (request()->wantsJson()) {

                return response()->json([
                    'data' => $company,
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
