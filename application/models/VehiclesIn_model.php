<?php
/**
 * Created by PhpStorm.
 * User: Kurnain A. Ramadhan
 * Date: 7/15/2020
 * Time: 4:52 PM
 */
    Class VehiclesIn_model Extends CI_Model
    {
        Public Function vEmployee($plat, $id)
        {
            $result = array();
            $this -> db -> select("a.GroupKendaraanId, a.KendaraanId, a.JenisKendaraan,
	                                a.IdPengguna, a.NoKendaraan");
            $this -> db -> from("vw_kendaraan_karyawan a");
            $this -> db -> where("a.NoKendaraan", $plat);
            $this -> db -> where("a.IdPengguna", $id);
            $query = $this -> db -> get();

            return $query->row();
        }


    }