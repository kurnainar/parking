<?php
/**
 * Created by PhpStorm.
 * User: Kurnain A. Ramadhan
 * Date: 7/16/2020
 * Time: 2:03 PM
 */
    Class VehiclesOut Extends CI_Controller
    {
        function __construct()
        {
            parent::__construct();
            $this -> load -> model(array('Vehicle_model'));
        }

        public function saveout()
        {
            $result = array('response' => 0);

            $no_kendaraan   = $this -> input -> post('plat_no');
            $nip    = $this -> input -> post('id_card');
            $tanggal    = date('Y-m-d H:i:s');

            $checkParking = $this -> Vehicle_model -> checkParking($no_kendaraan, $nip);

            $KendaraanId = ( $checkParking['KendaraanID'] ? $checkParking['KendaraanID'] : '' );
            $ActivityId = ( $checkParking['ActivityVehiclesId'] ? $checkParking['ActivityVehiclesId'] : '' );

            $data = array(
                'ActivityVehiclesId' => $ActivityId,
                'KendaraanID' => $KendaraanId,
                'IDEmployee' => $nip,
                'Plat' => $no_kendaraan,
                'Status' => 2,
                'DateTs' => $tanggal
            );

//            echo "<pre>";
//            print_r($checkParking);
//            echo "</pre>";

            if( empty($checkParking) ) {
                $result = array('response' => 0, 'message' => 'Data tidak tersedia');
            } else {
                $this -> Vehicle_model -> saveoutVehicles($data);
                $result = array('response' => 1, 'message' => 'Successfully', $checkParking);
            }

            echo json_encode($result);
        }
    }