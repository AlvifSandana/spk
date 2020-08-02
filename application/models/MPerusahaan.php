<?php
/**
 * Created by PhpStorm.
 * User: sankester
 * Date: 11/05/2017
 * Time: 15:51
 */

class MPerusahaan extends CI_Model{

    public $kdPerusahaan;
    public $perusahaan;

    public function __construct(){
        parent::__construct();
    }

    private function getTable(){
        return 'perusahaan';
    }

    private function getData(){
        $data = array(
            'perusahaan' => $this->perusahaan
        );

        return $data;
    }

    public function getAll()
    {
        $perusahaan = array();
        $query = $this->db->get($this->getTable());
        if($query->num_rows() > 0){
            foreach ($query->result() as $row) {
                $perusahaan[] = $row;
            }
        }
        return $perusahaan;
    }


    public function insert()
    {
        $this->db->insert($this->getTable(), $this->getData());
        return $this->db->insert_id();
    }

    public function update($where)
    {
        $status = $this->db->update($this->getTable(), $this->getData(), $where);
        return $status;

    }

    public function delete($id)
    {
        $this->db->where('kdPerusahaan', $id);
        return $this->db->delete($this->getTable());
    }

    public function getLastID(){
        $this->db->select('kdPerusahaan');
        $this->db->order_by('kdPerusahaan', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get($this->getTable());
        return $query->row();
    }


}