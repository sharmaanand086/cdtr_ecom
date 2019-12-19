 
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
        <h3>All Models</h3>
        <div class=" error"> </div>
  			 <?php  if($allmodel):   ?>
           <table>

            <tr>
          <th>Sr no</th>
          <th>Name</th>
          <th>Description</th>
          <th>Price</th>
          <th>edit</th>
          <th>delete</th>
        </tr>  
          <?php  $a =1; foreach ($allmodel as $allmodels ): ?>
                
          <tr class="mdls<?php echo $allmodels->mid; ?>">
            <td><?php echo $a++; ?> </td>
            <td><?php echo $allmodels->mName; ?> </td>
            <td><?php echo $allmodels->mDescription; ?> </td>
             <td><?php echo $allmodels->mPrice; ?> </td>
             <td>
                  <a  class="btn btn-info" href="<?php echo site_url('Admin/editModel/'.$allmodels->mid); ?>"><?php echo"edit"; ?></a>
               </td>
              <td>
                   <a href="javascript:void(0);"class="btn btn-danger delmodel"  class="btn btn-danger" data-id="<?php echo $allmodels->mid; ?>" data-text="<?php echo $this->encryption->encrypt($allmodels->mid); ?>">
                 Delete
                </a>
                </td>
        </tr>
        <?php endforeach;   ?>
          </table>            
         <?php echo $link; ?>
          <?php else: ?>
           Models Not Availabel

         <?php endif; ?>
			</div>
	</div>
</div>