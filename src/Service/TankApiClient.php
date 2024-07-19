<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class TankApiClient
{
    // The HTTP client used for making API requests
    private $httpClient;

    // Constructor to initialize the HTTP client
    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient; // Assign the provided HTTP client to the class property
    }

    // Static method to create an HTTP client with specific configuration
    public static function createHttpClient()
    {
        return HttpClient::create([
            'verify_peer' => false, // Disable peer certificate verification for the client
        ]);
    }

    // Method to fetch the list of tanks from the API
    public function fetchTanks()
    {
        $response = $this->httpClient->request('GET', 'https://api.tanks.gg/v1/vehicles'); // Send GET request to API
        $content = $response->toArray(); // Convert the response to an associative array

        return $content['data']; // Return the 'data' field from the response
    }

    // Method to fetch details of a specific tank by its ID
    public function fetchTankDetails($tankId)
    {
        $response = $this->httpClient->request('GET', 'https://api.tanks.gg/v1/vehicles/' . $tankId); // Send GET request with tank ID
        $content = $response->toArray(); // Convert the response to an associative array

        return $content['data']; // Return the 'data' field from the response
    }
}
