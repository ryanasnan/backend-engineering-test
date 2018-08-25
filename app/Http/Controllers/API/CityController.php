<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RajaOngkir;
use App\Repositories\API\CityRepository;

class CityController extends Controller
{
    protected $cityRepo;

    public function __construct(
        CityRepository $cityRepo
    ) {
        $this->cityRepo = $cityRepo;
    }

    public function getCity(Request $request) {
        $searchDataMethod = config('rajaongkir.search_data_method');

        if($searchDataMethod == 'database') {
            if($request->has('id')) {
                return $this->cityRepo->getById($request->id);
            }
        }
        elseif ($searchDataMethod == 'api') {
            if($request->has('id')) {
                return json_encode(RajaOngkir::city($request->id));
            }
        }

        return null;

    }
}
