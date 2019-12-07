<div class="content-wrapper">
	 <?php if($this->session->flashdata('class')): ?>  
      <div class="alert <?php echo $this->session->flashdata('class') ?>"  role="alert">
      <?php echo $this->session->flashdata('message'); ?>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
   <?php endif; ?>
	<div class="row padtop">
			<div class="col-md-6 col-md-offset-3">
        <h3>Edit Category</h3>
  			<?php echo form_open_multipart('Admin/updateCategory','','') ?>
        <input type="hidden" name="cid" value="<?php echo $category[0]['cid']; ?>">
        <input type="hidden" name="oldimage" value="<?php echo $category[0]['cDp']; ?>">
  				<div class="form-group">
            <label>Category Name</label>
  					<?php echo form_input('categoryName',$category[0]["cName"],'class="form-control"'); ?>
  				</div>
  				<div class="form-group">
            <label> Category Pic</label>
  					<?php echo form_upload('catDp','class="form-control"',''); ?>
  				</div>
  				<div class="form-group">
  					<?php echo form_submit('Add Category','Update Category','class="btn btn-primary"'); ?>
  				</div>

  			<?php echo form_close(); ?>
			</div>
      <div  class="col-md-3">
        <img src="<?php echo base_url('assets/images/categories/'.$category[0]['cDp']); ?>" class="img-responsive">
      </div>
	</div>
</div>