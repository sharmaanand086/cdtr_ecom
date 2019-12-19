<?php

/**
 * 
 */
class HomeMod extends CI_Model
{

	public function getAllcategories(){
		return $this->db->get_where('categories',array('cStatus'=>1));
	}
	public function getAllmodels($limit){
		$this->db->limit($limit);
		return $this->db->get_where('models',array('mStatus'=>1));
	}
	/* models model start here */

	public function checkModel($id){
		return $this->db->select('models.*,products.*')
		->from('models')
		->where(array('mid'=>$id,'mStatus'=>1))
		->join('products','products.pid = models.productid')
		->get()
		->result_array();
		//return $this->db->get_where('models',array('mid'=>$id,'mStatus'=>1))->result_array();
	}


	/* models model start here */
}


