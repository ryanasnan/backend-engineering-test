<?php
namespace App\Repositories\API;
use Illuminate\Http\Request;
use App\Repositories\Repository;
use App\Models\Province;
use Exception;
use DB;
class ProvinceRepository extends Repository
{
    protected $model;

    public function __construct(Province $model)
    {
        $this->model = $model;
    }

    public function store(Request $request) {
        try {
            DB::beginTransaction();
            $model = $this->model->newInstance();
            $model->province_id = $request->province_id;
            $model->province = $request->province;

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
        DB::delete('delete from provinces');
        return true;
    }

    public function getById($id) {
        return $this->model->where('province_id', $id)->first();
    }
}