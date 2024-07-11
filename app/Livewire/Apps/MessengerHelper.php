<?php 

namespace App\Livewire\Apps;

use RTippin\Messenger\Facades\Messenger;

final class MessengerHelper
{


    public $messenger;

    public $apiEndPoint;

    private $http;

    public function __construct()
    {
        Messenger::setProvider(auth()->user());
        $this->messenger = messenger();
        $this->apiEndPoint = $this->messenger->getApiEndpoint();

        $this->http = new \GuzzleHttp\Client([
            'base_uri' => env('JANUS_SERVER_ENDPOINT')
        ]);
    }

    public function curlPost(string $url, $query = [])
    {
        $fields_string = http_build_query($query);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Cache-Control: no-cache",
        ));
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = json_decode(curl_exec($ch), true);
        $headerSent = curl_getinfo($ch, CURLINFO_HEADER_OUT);
        return $response;
    }

    /**
     * Make Get Request to api endpoint.
     *
     * @param string $url
     * @param array $query
     * @return array
     */
    public function get(string $url, $query = []): array
    {
        try {
            $response = $this->http->get($url, [
                'headers' => [
                    'Accept'        => "application/json",
                    'Cache-Control' => "no-cache"
                ],
                'query' => $query
            ]);
            return json_decode($response->getBody()->getContents(), true);
        } catch(\GuzzleHttp\Exception\ClientException $e) {
            return array($e->getMessage());
        }
    }

    /**
     * Make Post Request to api endpoint
     *
     * @param string $url
     * @param array $query
     * @return array
     */
    public function post(string $url, $query = []): array
    {
        try {
            $response = $this->http->post($url, [
                'headers' => [
                    'Cache-Control' => "no-cache"
                ],
                'form_params' => $query,
            ]);
            return json_decode($response->getBody()->getContents(), true);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            return array($e->getMessage());
        }
    }

}