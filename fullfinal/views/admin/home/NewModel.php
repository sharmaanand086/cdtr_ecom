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
        <h3>Add New Model</h3>
  			<?php echo form_open_multipart('Admin/addModel','','') ?>
  				<div class="form-group">
            <label>Model Name</label>
  					<?php  echo form_input('modelName','','class="form-control"'); ?>
  				</div>
          <div class="form-group">
            <label>Description</label>
            <?php echo form_textarea('mdescription','','class="form-control"'); ?>
          </div>
            <div class="form-group">
            <label>Product</label>
           <!--  //var_dump($category->result()); -->
        <?php 
           $ProductssOption = array();
           foreach ($Products->result() as $Productss) {  
             $ProductssOption[$Productss->pid] = $Productss->pName;
               } 
        ?>
        <?php echo form_dropdown('productid',$ProductssOption,'','class="form-control"'); ?>
            
          </div>
          <div class="form-group">
            <label>Price</label>
            <?php echo form_input('mPrice','','class="form-control"'); ?>
          </div>
  				<div class="form-group">
            <label> Model Pic</label>
  					<?php echo form_upload('mDp','class="form-control"',''); ?>
  				</div>
  				<div class="form-group">
  					<?php echo form_submit('model','Add Model','class="btn btn-primary"'); ?>
  				</div>

  			<?php echo form_close(); ?>
			</div>
	</div>
</div>