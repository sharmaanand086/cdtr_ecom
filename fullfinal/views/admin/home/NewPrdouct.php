<div class="content-wrapper">
	 
	<div class="row padtop">
			<div class="col-md-6 col-md-offset-3">
        <?php if($this->session->flashdata('class')): ?>  
      <div class="alert <?php echo $this->session->flashdata('class') ?>"  role="alert">
      <?php echo $this->session->flashdata('message'); ?>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
   <?php endif; ?>
        <h3>Add New Product</h3>
  			<?php echo form_open_multipart('Admin/addProduct','','') ?>
  				<div class="form-group">
            <label>Poduct Name</label>
  					<?php  echo form_input('productName','','class="form-control"'); ?>
  				</div>
          <div class="form-group">
            <label>Company Name</label>
            <?php echo form_input('companyName','','class="form-control"'); ?>
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
        <?php echo form_dropdown('categoryId',$CategoryOption,'','class="form-control"'); ?>
            
          </div>
  				<div class="form-group">
            <label> Product Pic</label>
  					<?php echo form_upload('pDp','class="form-control"',''); ?>
  				</div>
  				<div class="form-group">
  					<?php echo form_submit('Add Category','Add Product','class="btn btn-primary"'); ?>
  				</div>

  			<?php echo form_close(); ?>
			</div>
	</div>
</div>