<?php

/**
 * Created by PhpStorm.
 * User: sankester
 * Date: 11/05/2017
 * Time: 15:53
 */
class MNilai extends CI_Model{

    public $kdPerusahaan;
    public $kdKriteria;
    public $nilai;

    public function __construct(){
        parent::__construct();
    }

    private function getTable()
    {
        return 'nilai';
    }

    private function getData()
    {
        $data = array(
            'kdPerusahaan' => $this->kdPerusahaan,
            'kdKriteria' => $this->kdKriteria,
            'nilai' => $this->nilai
        );

        return $data;
    }

    public function insert()
    {
        $status = $this->db->insert($this->getTable(), $this->getData());
        return $status;
    }

    public function getNilaiByUniveristas($id)
    {
        $query = $this->db->query(
            'select u.kdPerusahaan, u.perusahaan, k.kdKriteria, n.nilai from perusahaan u, nilai n, kriteria k, subkriteria sk where u.kdPerusahaan = n.kdPerusahaan AND k.kdKriteria = n.kdKriteria and k.kdKriteria = sk.kdKriteria and u.kdPerusahaan = '.$id.' GROUP by k.kdKriteria'
        );
        if($query->num_rows() > 0){
            foreach ($query->result() as $row) {
                $nilai[] = $row;
            }

            return $nilai;
        }
    }

    public function getNilaiUniveristas()
    {
        $query = $this->db->query(
            'select u.kdPerusahaan, u.perusahaan, k.kdKriteria, k.kriteria ,n.nilai from perusahaan u, nilai n, kriteria k where u.kdPerusahaan = n.kdPerusahaan AND k.kdKriteria = n.kdKriteria '
        );
        if($query->num_rows() > 0){
            foreach ($query->result() as $row) {
                $nilai[] = $row;
            }

            return $nilai;
        }
    }

    public function update()
    {
        $data = array('nilai' => $this->nilai);
        $this->db->where('kdPerusahaan', $this->kdPerusahaan);
        $this->db->where('kdKriteria', $this->kdKriteria);
        $this->db->update($this->getTable(), $data);
        return $this->db->affected_rows();
    }

    public function delete($id)
    {
        $this->db->where('kdPerusahaan', $id);
        return $this->db->delete($this->getTable());
    }
}