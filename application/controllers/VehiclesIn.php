<?php
/**
 * Created by PhpStorm.
 * User: Kurnain A. Ramadhan
 * Date: 7/15/2020
 * Time: 4:48 PM
 */
    Class VehiclesIn Extends CI_Controller
    {
        function __construct()
        {
            parent::__construct();
            $this -> load -> model(array('Vehicle_model'));
        }

        public function savein()
        {
            $result = array('response' => 0);

            $no_kendaraan   = $this -> input -> post('plat_no');
            $nip    = $this -> input -> post('id_card');
            $tanggal    = date('Y-m-d H:i:s');

            $getDataEmp = $this -> Vehicle_model -> vEmployee($no_kendaraan, $nip);
            $KendaraanId = ( $getDataEmp['KendaraanId'] ? $getDataEmp['KendaraanId'] : '' );

            $data = array(
                        'IDEmployee' => $nip,
                        'Plat' => $no_kendaraan,
                        'DateInTs' => $tanggal,
                        'KendaraanId' => $KendaraanId
                    );

            if( empty($getDataEmp) ) {
                $result = array('response' => 0, 'message' => 'Data tidak tersedia');
            } else {
                $this -> Vehicle_model -> saveinVehicles($data);
                $result = array('response' => 1, 'message' => 'Successfully', $getDataEmp);
            }

            echo json_encode($result);
        }

        public function getdata()
        {
            $result = array('response' => 0);

            $nip = $this -> input -> post('id');
            $plat = $this -> input -> post('nomor');

            $Employee = $this -> Vehicle_model -> employee();

            echo json_encode($result);
        }
    }
