<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;

class ApiService
{
    public static function post($url, $data, $headers = [])
    {
        $headers = array_merge([
            'Content-Type' => 'application/json',
        ], $headers);

        $response = Http::withHeaders($headers)->post($url, $data);
       
        return self::handleResponse($response);
    }

    public function get($url, $headers = [])
    {
        $headers = array_merge([
            'Content-Type' => 'application/json',
        ], $headers);

        $response = Http::withHeaders($headers)->get($url);

        return self::handleResponse($response);
    }

    public function put($url, $data, $headers = [])
    {
        $headers = array_merge([
            'Content-Type' => 'application/json',
        ], $headers);

        $response = Http::withHeaders($headers)->put($url, $data);

        return self::handleResponse($response);
    }

    public function delete($url, $headers = [])
    {
        $headers = array_merge([
            'Content-Type' => 'application/json',
        ], $headers);

        $response = Http::withHeaders($headers)->delete($url);

        return self::handleResponse($response);
    }

    public static function handleResponse($response)
    {
        if ($response->successful()) {
            return $response->json();
        } else {
            throw new \Exception($response->body(), $response->status());
        }
    }
}
