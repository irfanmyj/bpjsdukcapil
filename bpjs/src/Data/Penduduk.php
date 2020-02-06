<?php
namespace Bpjsdukcapil\Bpjs\Data;

use Bpjsdukcapil\Bpjs\DukcapilService;

class Penduduk extends DukcapilService
{
    public function getByNIK($data=[])
    {
        $response = $this->post($data);
        return json_decode($response, true);
    }

}