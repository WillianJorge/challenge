<?php
namespace app\Services;

use App\Person;
use Illuminate\Support\Facades\DB;

class PersonServices
{
    protected $model;

    public function __construct(Person $model){
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

    public function create($person)
    {
        try {
            return $this->model::create($person);
        } catch (\Illuminate\Database\QueryException $exception) {
            throw $exception;
        }

    }

    public function update($data, $id)
    {
        try {
            $person = $this->model::find($id);
            $person->update($data);
            return $person;

        } catch (\Illuminate\Database\QueryException $exception) {
            throw $exception;
        }

    }

    public function find($id)
    {
        try {
            $person = $this->model::find($id);
            return $person;

        } catch (\Illuminate\Database\QueryException $exception) {
            throw $exception;
        }
    }

    public function delete($id)
    {
        try {
            $person = $this->model::find($id);

            $result = (!empty($person)) ? $person->delete() : false;

            return $result ? 'person deleted' : 'person not found';

        } catch (\Illuminate\Database\QueryException $exception) {
            throw $exception;
        }
    }

}
