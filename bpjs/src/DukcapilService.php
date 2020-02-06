<?php
namespace Nsulistiyawan\Bpjs;

use GuzzleHttp\Client;

class DukcapilService{

    /**
     * Guzzle HTTP Client object
     * @var \GuzzleHttp\Client
     */
    private $clients;

    /**
     * Request headers
     * @var array
     */
    private $headers;

    public function __construct()
    {
        $this->clients = new Client([
            'verify' => false
        ]);
    }

    protected function post($data = [])
    {
        $this->headers['Accept']        = 'application/json';
        $this->headers['Content-Type']  = 'application/json';
        try {
            $response = @$this->clients->request(
                'POST',
                'http://172.16.160.43:8080/dukcapil/get_json/32-76/rsud_3276/call_nik',
                [
                    'headers' => $this->headers,
                    'body' => $data
                ]
            )->getBody()->getContents();
        } catch (\Exception $e) {
            $response = $e->getResponse();
        }
        
        return $response;
    }

    protected function postantrean($feature, $data = [], $headers = [])
    {
        $this->headers['Content-Type'] = 'application/x-www-form-urlencoded';
        if(!empty($headers)){
            $this->headers = array_merge($this->headers,$headers);
        }
        try {
            $response = $this->clients->request(
                'POST',
                'http://172.16.200.5/restapi_security/'. $feature,
                [
                    'form_params' => [
                        'username' => 'rsuddepok',
                        'password' => 'bismillah'
                    ]
                ]
            )->getBody()->getContents();
        } catch (\Exception $e) {
            $response = $e->getResponse();
        }
        return $response;
    }

    protected function get($feature, $headers)
    {
        $this->headers['x-token'] = $headers;
        try {
            $response = $this->clients->request(
                'GET',
                'http://172.16.200.5/restapi_security/'. $feature,
                [
                    'headers' => $this->headers
                ]
            )->getBody()->getContents();
        } catch (\Exception $e) {
            $response = $e->getResponse();
        }
        
        return $response;
    }
}