<?php

namespace App\Http\Controllers;

use App\Http\Requests\PersonsCreateRequest;
use App\Services\PersonServices;
use Illuminate\Http\Request;

class PersonController extends Controller
{


    protected $services;


    public function __construct(PersonServices $services){
        $this->services = $services;
    }

    public function index()
    {
        try {

            $persons = $this->services->all();
            if (request()->wantsJson()) {

                return response()->json([
                    'data' => $persons,
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



    public function store(PersonsCreateRequest $request)
    {
        try {
            $person = $this->services->create($request->all());

            $response = [
                'message' => 'person created.',
                'data'    => $person->toArray(),
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
            $person = $this->services->update($request->all(),$id);
            $response = [
                'message' => 'person updated.',
                'data'    => $person->toArray(),
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

            $person = $this->services->find($id);

            if (request()->wantsJson()) {

                return response()->json([
                    'data' => $person,
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
