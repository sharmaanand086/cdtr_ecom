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
	// all the categories relate
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
	public function getCategory(){
	 return $this->db->get_where('categories',array('cStatus' =>1));	
	}
	// categories end here


// product  start here

public function checkProduct($data){
 return $this->db->get_where('products',array('pName' =>$data['pName'],'categoriyid' =>$data['categoryId']));
}
public function addProduct($data){
	return $this->db->insert('products',$data);
}
public function allproducts(){
	return $this->db->get_where('products',array('pStatus' =>1))->num_rows();
}

public function fetchallproducts($limit,$start){
	$this->db->limit($limit,$start);
		$query =  $this->db->get_where('products',array('pStatus' =>1));
		if($query->num_rows() > 0 ){
		    foreach ($query->result() as $row) {
		             $data[]= $row;
		    }
	    	return $data;
		} 
    return false;
	 
}
 
public function checkProductById($pid){
 return $this->db->get_where('products',array('pid' =>$pid))->result_array();
}
public function updateProduct($data,$pid){
	$this->db->where('pid',$pid);
		return $this->db->update('products',$data);
}

public function getProductImage($pid){
		return $this->db->select('pDp')
		->from('products')
		->where('pid',$pid)
		->get()
		->result_array();
	}
	public function deleteProduct($pid){
			$this->db->where('pid',$pid);
		return $this->db->delete('products');
	}

	/// model start here 

	public function getProduct(){
	return	$this->db->select('pid,pName')
	             ->from('products')
	             ->where('pStatus',1) 
	             ->get();
	}
	public function checkModel($data){
 return $this->db->get_where('models',array('mName' =>$data['mName'],'productid' =>$data['productid']));
}
public function addModel($data){
	return $this->db->insert('models',$data);
}
public function fetchallModels($limit,$start){
	$this->db->limit($limit,$start);
		$query =  $this->db->get_where('models',array('mStatus' =>1));
		if($query->num_rows() > 0 ){
		    foreach ($query->result() as $row) {
		             $data[]= $row;
		    }
	    	return $data;
		} 
    return false;
	 
}

	public function getModelImage($mid){
		return $this->db->select('mDp')
		->from('models')
		->where('mid',$mid)
		->get()
		->result_array();
	}
	public function deletemodel($pid){
			$this->db->where('mid',$pid);
		return $this->db->delete('models');
	}
	public function checkmodelById($mid){
	 return $this->db->get_where('models',array('mid' =>$mid))->result_array();
	}
 
public function updateModel($data,$mid){
	$this->db->where('mid',$mid);
		return $this->db->update('models',$data);
}
public function getModel(){
	return	$this->db->select('mid,mName')
	             ->from('models')
	             ->where('mStatus',1) 
	             ->get();
	}
	///specs start here 

public function checkspecs($data){
	return $this->db->get_where('specs',array('spName' =>$data['spName'],'modelid' =>$data['modelid']));
}

public function checkspecsName($data){
	$this->db->insert('specs',$data);
	return $this->db->insert_id();

}
public function checkspecsValues($spec_values){
	return $this->db->insert_batch('specs_value',$spec_values);
	 

}

public function getallspec(){
	return $this->db->get_where('specs',array('spStatus' =>1))->num_rows();
}
public function fetchallspecs($limit,$start){
	  $this->db->limit($limit,$start);
        $query = $this->db->select('specs.*,models.mName')
            ->from('specs')
            ->where('specs.spStatus','1')
            ->join('models','models.mId  = specs.modelId')
            ->get();
		if($query->num_rows() > 0 ){
		    foreach ($query->result() as $row) {
		             $data[]= $row;

		    }
	    	return $data;
		} 
    return false;
	 
}

 public function deleteSpecnow($mId)
    {
        $this->db->where('spid',$mId);
        return $this->db->delete('specs');
    }

    public function checkSpecById($pId)
    {
        return $this->db->get_where('specs',array('spid'=>$pId))->result_array();
    }
    public function updateSpec($value,$specId)
    {
        $this->db->where('spid',$specId);
        return $this->db->update('specs',$value);
    }
    
}