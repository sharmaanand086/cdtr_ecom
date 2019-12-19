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
        <h3>Add New Category</h3>
  			<?php echo form_open_multipart('Admin/addCategory','','') ?>
  				<div class="form-group">
            <label>Category Name</label>
  					<?php echo form_input('categoryName','','class="form-control"'); ?>
  				</div>
  				<div class="form-group">
            <label> Category Pic</label>
  					<?php echo form_upload('catDp','class="form-control"',''); ?>
  				</div>
  				<div class="form-group">
  					<?php echo form_submit('Add Category','Add Category','class="btn btn-primary"'); ?>
  				</div>

  			<?php echo form_close(); ?>
			</div>
	</div>
</div>