<?php
namespace App\Libraries\RajaOngkir;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class RajaOngkir {
    protected $endpoint;
	protected $key;
    private $error;
    
	public function __construct(){
        $this->endpoint = config('rajaongkir.end_point_api');
		$this->key = config('rajaongkir.api_key');
    }
    
    private function _request($method, $path, $options = array())
	{
        $url = $this->endpoint.'/'.$path;
        $defaultConfig = [
            'headers' => [
                'key' => $this->key 
            ]
        ];
        $config = array_merge($defaultConfig, $options);

        $client = new Client;

        try {
            $request = $client->request($method, $url, $config);
        } catch (RequestException $e) {
            $this->error = $e->getMessage();
            return false;
        }
        return json_decode($request->getBody()->getContents());
	}

    public function city($id = null)
	{
		if ($id == null) {
            $request = self::_request('GET','city');
        }
        else {
			$request = self::_request('GET','/city?id=' . $id);
        }

        if($request) {
            return $request->rajaongkir->results;
        }
        return null;
    }

    public function province($id = null)
	{
		if ($id == null) {
            $request = self::_request('GET','province');
        }
        else {
			$request = self::_request('GET','/province?id=' . $id);
        }

        if($request) {
            return $request->rajaongkir->results;
        }
        return null;
	}
}
?>