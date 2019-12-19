<?php 

class ModUser extends CI_Model
{
    public function checkUser($data)
    {
        return $this->db->get_where('user',array('email'=>$data['email']))->result_array();
    }
    public function addUser($data)
    {
        return $this->db->insert('user',$data);
    }
    public function checkLink($link)
    {
        return $this->db->get_where('user',array('link'=>$link))->result_array();
    }
    public function activateUser($uId,$data)
    {
        $this->db->where('uId',$uId);
        return $this->db->update('user',$data);
    }
}