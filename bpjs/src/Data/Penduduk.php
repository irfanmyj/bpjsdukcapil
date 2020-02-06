<?php
namespace Nsulistiyawan\Bpjs\Data;

use Nsulistiyawan\Bpjs\DukcapilService;

class Penduduk extends DukcapilService
{
    public function getByNIK($data=[])
    {
        $response = $this->post($data);
        return json_decode($response, true);
    }

}