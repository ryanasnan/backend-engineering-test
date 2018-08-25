<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RajaOngkir;
use App\Repositories\API\ProvinceRepository;

class ProvinceController extends Controller
{
    protected $provinceRepo;

    public function __construct(
        ProvinceRepository $provinceRepo
    ) {
        $this->provinceRepo = $provinceRepo;
    }

    public function getProvince(Request $request) {

        if($request->has('id')) {
            return $this->provinceRepo->getById($request->id);
        }
        return null;

    }
}
