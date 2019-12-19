<div class="content-wrapper">
    <div class="row padtop">
        <div class="col-md-6 col-md-offset-3">
            <?php if($this->session->flashdata('class')):?>
                <div class="alert <?php echo $this->session->flashdata('class')?> alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <?php echo $this->session->flashdata('message');?>
                </div>
            <?php endif; ?>
            <h3>Add New Specs</h3>
            <?php echo form_open_multipart('admin/updateSpec','','')?>
            <div class="form-group">
                <?php
                $categoiesOptions = array();
                foreach ($models->result() as $model){
                    $modelOptions[$model->mid] = $model->mName;
                }
                echo form_dropdown('modelid',$modelOptions,'','class="form-control"');
                ?>
            </div>
            <input type="hidden" value="<?php echo $Spec[0]['spid'];?>" name="specid">
            <div class="form-group">
                <?php echo form_input('sp_name',$Spec[0]['spName'],array('placeholder'=>'Enter Spec Name','class'=>'form-control')); ?>
            </div>



            <div class="form-group">
                <?php echo form_submit('update Spec','Update Spec','class="btn btn-primary"');  ?>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>