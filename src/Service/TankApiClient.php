<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class TankApiClient
{
    private $httpClient;

    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public static function createHttpClient()
	{
		return HttpClient::create([
			'verify_peer' => false,
		]);
	}

    public function fetchTanks()
    {
        $response = $this->httpClient->request('GET', 'https://api.tanks.gg/v1/vehicles');
        $content = $response->toArray();

        return $content['data'];
    }

    public function fetchTankDetails($tankId)
    {
        $response = $this->httpClient->request('GET', 'https://api.tanks.gg/v1/vehicles/' . $tankId);
        $content = $response->toArray();

        return $content['data'];
    }
}
