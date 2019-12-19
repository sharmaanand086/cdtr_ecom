<div class="content-wrapper">
   
  <div class="row padtop">
      <div class="col-md-6 col-md-offset-2">
        <?php if($this->session->flashdata('class')): ?>  
      <div class="alert <?php echo $this->session->flashdata('class') ?>"  role="alert">
      <?php echo $this->session->flashdata('message'); ?>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
   <?php endif; ?>
        <h3>Add New Product</h3>
        <?php echo form_open_multipart('Admin/updateProduct','','') ?>
           <input type="hidden" name="pid" value="<?php echo $product[0]['pid']; ?>">
        <input type="hidden" name="oldimage" value="<?php echo $product[0]['pDp']; ?>">
          <div class="form-group">
            <label>Poduct Name</label>
            <?php  echo form_input('productName',$product[0]['pName'],'class="form-control"'); ?>
          </div>
          <div class="form-group">
            <label>Company Name</label>
            <?php echo form_input('companyName',$product[0]['pCompany'],'class="form-control"'); ?>
          </div>
            <div class="form-group">
            <label>Product Category</label>
           <!--  //var_dump($category->result()); -->
        <?php 
           $CategoryOption = array();
           foreach ($category->result() as $categries) {  
             $CategoryOption[$categries->cid] = $categries->cName;
               } 
        ?>
        <?php echo form_dropdown('categoryId',$CategoryOption,$product[0]['categoriyid'],'class="form-control"'); ?>
            
          </div>
          <div class="form-group">
            <label> Product Pic</label>
            <?php echo form_upload('propDp','class="form-control"',''); ?>
          </div>
          <div class="form-group">
            <?php echo form_submit('update','Update Product','class="btn btn-primary"'); ?>
          </div>

        <?php echo form_close(); ?>
      </div>
      <div  class="col-md-3 col-md-offset-1" >
        <img src="<?php echo base_url('assets/images/product/'.$product[0]['pDp']); ?>" class="img-responsive">
      </div>
  </div>
</div>