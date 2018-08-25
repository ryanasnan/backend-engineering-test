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
        $searchDataMethod = config('rajaongkir.search_data_method');

        if($searchDataMethod == 'database') {
            if($request->has('id')) {
                return $this->provinceRepo->getById($request->id);
            }
        }
        elseif ($searchDataMethod == 'api') {
            if($request->has('id')) {
                return json_encode(RajaOngkir::province($request->id));
            }
        }


        return null;

    }
}
