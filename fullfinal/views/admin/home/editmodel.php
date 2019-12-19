<div class="content-wrapper">
	 
	       <div class="row padtop">
			<div class="col-md-6 col-md-offset-1">
        <?php if($this->session->flashdata('class')): ?>  
      <div class="alert <?php echo $this->session->flashdata('class') ?>"  role="alert">
      <?php echo $this->session->flashdata('message'); ?>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
   <?php endif; ?>
        <h3>Update Model</h3>
  			<?php echo form_open_multipart('Admin/updatemodel','','') ?>
        <input type="hidden" name="id" value="<?php echo $model[0]['mid'] ?>">
        <input type="hidden" name="oldimage" value="<?php echo $model[0]['mDp'] ?>">
  				<div class="form-group">
            <label>Model Name</label>
  					<?php  echo form_input('modelName',$model[0]['mName'],'class="form-control"'); ?>
  				</div>
          <div class="form-group">
            <label>Description</label>
            <?php echo form_textarea('mdescription',$model[0]['mDescription'],'class="form-control"'); ?>
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
        <?php echo form_dropdown('productid',$ProductssOption,$model[0]['productid'],'class="form-control"'); ?>
            
          </div>
            <div class="form-group">
            <label>Price</label>
            <?php  echo form_input('modelPrice',$model[0]['mPrice'],'class="form-control"'); ?>
          </div>
  				<div class="form-group">
            <label> Model Pic</label>
  					<?php echo form_upload('modeldp','class="form-control"',''); ?>
  				</div>
  				<div class="form-group">
  					<?php echo form_submit('updatemodel','Update Model','class="btn btn-primary"'); ?>
  				</div>

  			<?php echo form_close(); ?>
        
			</div>
    <div class="col-md-4 ">
          <img src="<?php echo base_url('assets/images/model/'.$model[0]['mDp']); ?>" class="img-responsive">
        </div>

	</div>
</div>