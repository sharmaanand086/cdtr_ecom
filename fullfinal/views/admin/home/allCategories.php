 
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
        <h3>All Categories</h3>
        <div class="error"></div>
  			 <?php  if($allCategory):   ?>
           <table>

            <tr>
          <th>Sr no</th>
          <th>Name</th>
          <th>Dp</th>
          <th>edit</th>
          <th>delete</th>
        </tr>  
          <?php  $a =1; foreach ($allCategory as $Categories ): ?>
                
     <tr class="ccat<?php echo $Categories->cid; ?>">
            <td><?php echo $a++; ?> </td>
            <td><?php echo $Categories->cName; ?> </td>
            <td><?php echo $Categories->cDp; ?> </td>
             <td><a  class="btn btn-info" href="<?php echo site_url('Admin/editCategory/'.$Categories->cid); ?>"><?php echo"edit"; ?></a> </td>
              <td>
       <a href="javascript:void(0);"class="btn btn-danger delcat"  class="btn btn-danger" data-id="<?php echo $Categories->cid; ?>" data-text="<?php echo $this->encryption->encrypt($Categories->cid); ?>">
                 Delete
                </a>
                 </td>
        </tr>
        <?php endforeach;   ?>
          </table>            
         <?php echo $link; ?>
          <?php else: ?>
           Category Not Availabel

         <?php endif; ?>
			</div>
	</div>
</div>