<?php

/**
 * 
 */
class AdminMod extends CI_Model
{
	
	public function checkAdmin($data)
	{
	 return $this->db->get_where('admin',$data)->result_array();
	}
	public function checkCategory($data){
		 return $this->db->get_where('categories',array('cName' =>$data['cName']));
	}
	public function checkCategoryById($cid){
		 return $this->db->get_where('categories',array('cid' =>$cid))->result_array();
	}
	public function addCategory($data){
		return $this->db->insert('categories',$data);
	}
	public function allCategory(){
	return $this->db->get_where('categories',array('cStatus' =>1))->num_rows();
	}
	public function updateCategory($data,$cid){
		$this->db->where('cid',$cid);
		return $this->db->update('categories',$data);
	}
	public function deletecategory($cid){
			$this->db->where('cid',$cid);
		return $this->db->delete('categories');
	}
	public function getCategoryImage($cid){
		return $this->db->select('cDp')
		->from('categories')
		->where('cid',$cid)
		->get()
		->result_array();
	}
	public function fetchallCategory($limit,$start)
	{
		$this->db->limit($limit,$start);
		$query =  $this->db->get_where('categories',array('cStatus' =>1));
		if($query->num_rows() > 0 ){
		    foreach ($query->result() as $row) {
		             $data[]= $row;
		    }
	    	return $data;
		} 
    return false;
	 
	}
	
}