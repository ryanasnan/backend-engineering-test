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

        if($request->has('id')) {
            return $this->cityRepo->getById($request->id);
        }
        return null;

    }
}
