 
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
        <h3>All specs</h3>
        <div class=" error"> </div>
  			 <?php  if($allspec):   ?>
           <table>

            <tr>
          <th>Sr no</th>
          <th>Spac Name</th>
          <th>Model Name</th>
          <th>edit</th>
          <th>delete</th>
        </tr>  
          <?php  $a =1; foreach ($allspec as $specs ): ?>
                
          <tr class="specsid<?php echo $specs->spid; ?>">
            <td><?php echo $a++; ?> </td>
            <td><?php echo $specs->spName; ?> </td>
            <td><?php echo $specs->mName; ?> </td>
            <td>
              <a href="<?php echo site_url('Admin/editSpec/'. $specs->spid)?>" class="btn btn-info">
                  Edit
              </a>
          </td>
          <td>
              <a href="javascript:void(0)" class="btn btn-danger specNow"   data-id="<?php echo $specs->spid; ?>" data-text="<?php echo $this->encryption->encrypt($specs->spid); ?>">
                  Delete
              </a>
          </td>
        </tr>
        <?php endforeach;   ?>
          </table>            
         <?php echo $link; ?>
          <?php else: ?>
           specs Not Availabel

         <?php endif; ?>
			</div>
	</div>
</div>