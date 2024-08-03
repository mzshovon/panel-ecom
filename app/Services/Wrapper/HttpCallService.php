<?php

namespace App\Services\Wrapper;

use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;

class HttpCallService {

    /**
     * @param string $url
     * @param array $queryParams
     * @param array $headers
     *
     * @return mixed
     */
    public function get(string $url, array $queryParams = [], array $headers = [])
    {
        // Api post call here
        try {
            $response = Http::withHeaders($headers)->get($url, $queryParams);
            return $this->handleResponse($response);
        } catch (RequestException $re) {
            throw $re;
        }
    }

    public function post(string $url, array $data = [], array $headers = [])
    {
        // Api post call here
        try {
            $response = Http::withHeaders($headers)->post($url, $data);

            return $this->handleResponse($response);
        } catch (RequestException $re) {
            // Log the error or handle it as per your needs
            throw $re;
        }
    }

    /**
     * Handle the API response.
     *
     * @param \Illuminate\Http\Client\Response $response
     * @return mixed
     * @throws \Illuminate\Http\Client\RequestException
     */
    private function handleResponse($response)
    {
        if ($response->successful()) {
            return $response->json();
        }
        throw new RequestException($response);
    }

}
