<?php
namespace Bpjsdukcapil\Bpjs\Pcare;

use Bpjsdukcapil\Bpjs\BpjsPcare;


class Pcare extends BpjsPcare{

    /*
    Catatan : 
    Yang belum dibuat
    1. Kunjungan
    2. Obat
    3. Pendaftaran
    4. Peserta
    5. Tindakan
    6. Kelompok
    */
    private $mcu = "mcu";
    private $spesialis = 'spesialis';
    private $kelompok = 'kelompok';

    /*
    Get Diagnosa
    */
    public function diagnosa($keyword='', $start=0, $limit=1)
    {
        $features = "diagnosa/$keyword/$start/$limit";
        $response = $this->get($features);
        return json_decode($response, true);
    }

    /**
    * Get dokter
    * @
    */
    public function dokter($start=1, $limit=1){
        $features = "dokter/$start/$limit";
        $response = $this->get($features);
        return json_decode($response, true);
    }

    /**
    * Get kesadaran
    * @
    */
    public function kesadaran(){
        $features = "kesadaran";
        $response = $this->get($features);
        return json_decode($response, true);
    }

    /**
    * Post MCU
    * @
    */
    public function insertMcu($data=[]){
        $features = $this->mcu;
        $response = $this->post($features, $data);
        return json_decode($response, true);
    }

    /**
    * Put MCU
    * @
    */
    public function updateMcu($data=[]){
        $features = $this->mcu;
        $response = $this->put($features, $data);
        return json_decode($response, true);
    }

    /**
    * Get MCU
    * @
    */
    public function getMcu($noKunjungan){
        $features = $this->mcu."/kunjungan";
        $response = $this->get($features, $noKunjungan);
        return json_decode($response, true);
    }

    /**
    * Delete MCU
    * @
    */
    public function deleteMcu($kdmcu,$noKunjungan){

        $response = json_encode(['status'=>'error','msg'=>'Mohon maaf kode mcu dan nokunjungan harus terisi']);
        if(!empty($kdmcu) && !empty($noKunjungan)){
            $features = $this->mcu.'/'.$kdmcu.'/kunjungan';
            $response = $this->get($features, $noKunjungan);
        }
        
        return json_decode($response, true);
    }

    /**
    * Get POLI FKTP
    * @
    */
    public function getPoliFktp($start=0,$limit=1){
        $features = 'poli/fktp/'.$start.'/'.$limit;
        $response = $this->get($features);
        return $response;
    }

    /**
    * Get Status Pulang
    * @
    */
    public function getStsPulang($status=FALSE){
        $features = 'statuspulang/rawatInap/'.$status;
        $response = $this->get($features);
        return $response;
    }

    /**
    * Get Kelompok Club Prolanis
    * @
    */
    public function getClubProlanis($kdJnsKelompok){
        $features = $this->kelompok.'/club/'.$kdJnsKelompok;
        $response = $this->get($features);
        return $response;
    }

    /**
    * Get Kegiatan Kelompok 
    * @
    */
    public function getKelKegiatan($tgl){
        $features = $this->kelompok.'/kegiatan/'.date('d-m-Y',strtotime($tgl));
        $response = $this->get($features);
        return $response;
    }

    /**
    * Get Peserta Kegiatan Kelompok 
    * @
    */
    public function getPesertaKelKegiatan($eduId){
        $features = $this->kelompok.'/peserta/'.$eduId;
        $response = $this->get($features);
        return $response;
    }

    /**
    * Get spesialis
    * @
    */
    public function getRefSpesialis(){
        $features = $this->spesialis;
        $response = $this->get($features);
        return $response;
    }

    /**
    * Get Sub spesialis
    * @
    */
    public function getRefSubSpesialis($kdSpesialis){
        $features = $this->spesialis.'/'.$kdSpesialis.'/subspesialis';
        $response = $this->get($features);
        return $response;
    }

    /**
    * Get Refrensi Sarana
    * @
    */
    public function getRefSarana(){
        $features = $this->spesialis.'/sarana';
        $response = $this->get($features);
        return $response;
    }

    /**
    * Get Refrensi Khusus
    * @
    */
    public function getRefKhusus(){
        $features = $this->spesialis.'/khusus';
        $response = $this->get($features);
        return $response;
    }

    /**
    * Get Faskes Rujukan Sub Spesialis (Method : GET)
    * @
    */
    public function getRujSubSpesialis($kdSubSpesialis,$kdSarana,$tgl){
        $features = $this->spesialis.'/rujuk/subspesialis/'.$kdSubSpesialis.'/sarana/'.$kdSarana.'/tglEstRujuk/'.date('d-m-Y',strtotime($tgl));
        $response = $this->get($features);
        return $response;
    }

    /**
    * Get Faskes Rujukan Khusus ALIH RAWAT, HEMODIALISA, JIWA, KUSTA, TB-MDR, SARANA KEMOTERAPI, SARANA RADIOTERAPI, HIV-ODHA (Method : GET)
    * @
    */
    public function getFaskesRujKhusus($kdKhusus,$noKartu,$tgl){
        $features = $this->spesialis.'/rujuk/khusus/'.$kdKhusus.'/noKartu/'.$noKartu.'/tglEstRujuk/'.date('d-m-Y',strtotime($tgl));
        $response = $this->get($features);
        return $response;
    }

    /**
    * Get Faskes Rujukan Khusus THALASEMIA dan HEMOFILI (Method : GET)
    * @
    */
    public function getFaskesRujKhususTha($kdKhusus,$kdSubSpesialis,$noKartu,$tgl){
        $features = $this->spesialis.'/rujuk/khusus/'.$kdKhusus.'/subspesialis/'.$kdSubSpesialis.'/noKartu/'.$noKartu.'/tglEstRujuk/'.date('d-m-Y',strtotime($tgl));
        $response = $this->get($features);
        return $response;
    }

}