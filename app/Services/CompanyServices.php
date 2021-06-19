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

    public function create($company)
    {
        try {
            return $this->model::create($company);
        } catch (\Illuminate\Database\QueryException $exception) {
            throw $exception;
        }

    }

    public function update($data, $id)
    {
        try {
            $company = $this->model::find($id);
            $company->update($data);
            return $company;

        } catch (\Illuminate\Database\QueryException $exception) {
            throw $exception;
        }

    }

    public function find($id)
    {
        try {
            $company = $this->model::find($id);
            return $company;

        } catch (\Illuminate\Database\QueryException $exception) {
            throw $exception;
        }
    }

    public function delete($id)
    {
        try {
            $company = $this->model::find($id);

            $result = (!empty($company)) ? $company->delete() : false;

            return $result ? 'company deleted' : 'company not found';

        } catch (\Illuminate\Database\QueryException $exception) {
            throw $exception;
        }
    }

}
