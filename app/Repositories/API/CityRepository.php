<?php
namespace App\Repositories\API;
use Illuminate\Http\Request;
use App\Repositories\Repository;
use App\Models\City;
use Exception;
use DB;
class CityRepository extends Repository
{
    protected $model;

    public function __construct(City $model)
    {
        $this->model = $model;
    }

    public function store(Request $request) {
        try {
            DB::beginTransaction();
            $model = $this->model->newInstance();
            $model->city_id = $request->city_id;
            $model->province_id = $request->province_id;
            $model->province = $request->province;
            $model->type = $request->type;
            $model->city_name = $request->city_name;
            $model->postal_code = $request->postal_code;

            if (!$model->save()) {
                throw new Exception("Unable to save province.", 1);
            }

            DB::commit();
            return $model;
        }
        catch(Exception $e) {
            DB::rollBack();
            return false;
        }
    }

    public function deleteAll() {
        DB::delete('delete from cities');
        return true;
    }

    public function getById($id) {
        return $this->model->where('city_id', $id)->first();
    }
}