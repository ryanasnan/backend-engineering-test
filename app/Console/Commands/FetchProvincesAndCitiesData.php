<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Http\Request;
use RajaOngkir;
use App\Repositories\API\ProvinceRepository;
use App\Repositories\API\CityRepository;

class FetchProvincesAndCitiesData extends Command
{
    protected $provinceRepo;
    protected $cityRepo;

    protected $signature = 'fetch:data';

    protected $description = 'Fetching Provinces and Cities Data';

    public function __construct(
        ProvinceRepository $provinceRepo,
        CityRepository $cityRepo
    ) {
        parent::__construct();

        $this->provinceRepo = $provinceRepo;
        $this->cityRepo = $cityRepo;
    }

    public function handle()
    {
        $provinces = RajaOngkir::province();
        $cities = RajaOngkir::city();

        $totalData = count($provinces) + count($cities);
        $bar = $this->output->createProgressBar($totalData);

        $deleteProvinces = $this->provinceRepo->deleteAll();
        foreach($provinces as $province) {
            $request = new Request;
            $request->province_id = $province->province_id;
            $request->province = $province->province;

            $model = $this->provinceRepo->store($request);
            $bar->advance();
        }

        $deleteCities = $this->cityRepo->deleteAll();
        foreach($cities as $city) {
            $request = new Request;
            $request->city_id = $city->city_id;
            $request->province_id = $city->province_id;
            $request->province = $city->province;
            $request->type = $city->type;
            $request->city_name = $city->city_name;
            $request->postal_code = $city->postal_code;

            $model = $this->cityRepo->store($request);
            $bar->advance();
        }        
        $bar->finish();

        $this->info('');
        $this->info('success fetched '.count($provinces). ' provinces data');
        $this->info('success fetched '.count($cities). ' cities data');

    }
}
