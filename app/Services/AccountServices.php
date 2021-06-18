<?php
namespace app\Services;

use App\Account;
use App\Companies;
use App\Http\Requests\PersonsCreateRequest;
use App\Person;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AccountServices
{
    protected $model;

    public function __construct(Account $model){
        $this->model = $model;
    }


    public function all()
    {

        try {
            // dd($this->model::with(['persons','companies'])->get());
            return $this->model::all();

        } catch (\Illuminate\Database\QueryException $exception) {
            throw $exception;
        }
    }

    public function create($account)
    {
        try {

            $company = new Companies;
            $new_company = Arr::only($account,['company_name', 'trading_name', 'cnpj']);

            if (count($new_company) != 0) {
                $validate_company = Validator::make($new_company, [
                    'company_name' => 'required|max:255',
                    'trading_name' => 'required|max:255',
                    'cnpj' => 'required|numeric|digits:14|unique:companies',
                ]);
            }

            $person = new Person;
            $new_person = Arr::only($account,['name', 'cpf']);

            if (count($new_person) != 0) {
                $validate_person = Validator::make($new_person, [
                    'cpf' => 'required|unique:persons|numeric|digits:11',
                    'name' => 'required|max:255'],
                );
            }

            $errors = isset($validate_person) && isset($validate_company)
                ?  array_merge($validate_person->errors()->messages(), $validate_company->errors()->messages())
                : (isset($validate_person) ? $validate_person->errors()->messages() : $validate_company->errors()->messages());
            if(!empty($errors)){
                return ['success' => false, 'errors' => $errors];
            }

            $person_id = isset($validate_person) ? $person->create($new_person)->id : null;
            $account = Arr::has($account,'person_id') ? Arr::set($account,'person_id',$person_id) : Arr::add($account,'person_id',$person_id);

            $company_id = isset($validate_company) ? $company->create($new_company)->id : null;
            $account = Arr::has($account,'company_id') ? Arr::set($account,'company_id',$company_id) : Arr::add($account,'company_id',$company_id);

            return ['success' => true, 'data' => $this->model::create($account)];

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
