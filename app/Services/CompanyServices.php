<?php
namespace app\Services;

use App\Companies;
use Illuminate\Support\Facades\DB;

class CompanyServices
{
    protected $model;

    public function __construct(Companies $model){
        $this->model = $model;
    }


    public function all()
    {

        try {
            return $this->model::all();
        } catch (\Illuminate\Database\QueryException $exception) {
            throw $exception;
        }
    }

    public function create($user)
    {
        try {
            return $this->model::create($user);
        } catch (\Illuminate\Database\QueryException $exception) {
            throw $exception;
        }

    }

    public function update($data, $id)
    {
        try {
            $user = $this->model::find($id);
            $user->update($data);
            return $user;

        } catch (\Illuminate\Database\QueryException $exception) {
            throw $exception;
        }

    }

    public function find($id)
    {
        try {
            $user = $this->model::find($id);
            return $user;

        } catch (\Illuminate\Database\QueryException $exception) {
            throw $exception;
        }
    }

    public function delete($id)
    {
        try {
            $user = $this->model::find($id);

            $result = (!empty($user)) ? $user->delete() : false;

            return $result ? 'user deleted' : 'user not found';

        } catch (\Illuminate\Database\QueryException $exception) {
            throw $exception;
        }
    }

}
