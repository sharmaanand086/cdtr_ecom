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
        <h3>Add New Spec To Model</h3>
        <form action="<?php echo site_url('Admin/addspecs');  ?>" method="post" enctype="multipart/form-data"> 
        <div class="form-group">
            <label>Model Name</label>
  		 
         <?php 
           $CategoryOption = array();
           foreach ($models->result() as $model) {  
             $CategoryOption[$model->mid] = $model->mName;
               } 
        ?>
            <?php echo form_dropdown('modelId',$CategoryOption,'','class="form-control"'); ?>
          </div>
  				<div class="form-group">
            <label>Spec Name</label>
  					<?php  echo form_input('specName','','class="form-control"'); ?>
  				</div>
          <div class="htmlitems">
          <div class="form-group constspec">
            <label>Spec Value</label>            
            <input type="text" name="spec_value[]" class="form-control spc_cn">
            <a href="javascript:void(0)" class="add_spec">+</a>
          </div>
           </div>
        
  				<div class="form-group">
  					<?php echo form_submit('Add spec','Add spec','class="btn btn-primary"'); ?>
  				</div>
  			 
        </form>
			</div>
	</div>
</div>