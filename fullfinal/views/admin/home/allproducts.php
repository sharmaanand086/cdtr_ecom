 
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
        <h3>All Products</h3>
        <div class="error"></div>
  			 <?php  if($allPrdoucts):   ?>
           <table>

            <tr>
          <th>Sr no</th>
          <th>Name</th>
          <th>Company</th>
          <th>edit</th>
          <th>delete</th>
        </tr>  
          <?php  $a =1; foreach ($allPrdoucts as $prductss ): ?>
                
          <tr class="pdct<?php echo $prductss->pid; ?>">
            <td><?php echo $a++; ?> </td>
            <td><?php echo $prductss->pName; ?> </td>
            <td><?php echo $prductss->pCompany; ?> </td>
             <td>
                  <a  class="btn btn-info" href="<?php echo site_url('Admin/editproduct/'.$prductss->pid); ?>"><?php echo"edit"; ?></a>
               </td>
              <td>
                   <a href="javascript:void(0);"class="btn btn-danger delteprod"  class="btn btn-danger" data-id="<?php echo $prductss->pid; ?>" data-text="<?php echo $this->encryption->encrypt($prductss->pid); ?>">
                 Delete
                </a>
                </td>
        </tr>
        <?php endforeach;   ?>
          </table>            
         <?php echo $link; ?>
          <?php else: ?>
           Product Not Availabel

         <?php endif; ?>
			</div>
	</div>
</div>