<h2><?php echo $title;?></h2>
<hr>
<?php $type = $this->uri->segment(4);?>

<?php echo form_open_multipart('manage/form/files/create', 'class="form-upload"');?>
<?php echo form_upload('uploadedfiles[]','','multiple'); ?>
<input type="hidden" name="uploadtype" value="<?php echo $type;?>">
<input type="hidden" name="id" value="<?php echo $this->uri->segment(3);?>">
<?php echo form_submit('submit','Загрузить', 'class="btn btn-success btn-upload"');?>
<?php echo form_close();?>

<p class="text-info"><?php echo $info;?></p>
<hr>
<?php if(!empty($files)){?>
<div class="overflow">
<table class="table table-striped">
    <tbody>
      <?php foreach($files as $row):?>
      <tr>
      <td class="col-md-1"><button type="button" uri="files" file="<?php echo $row['id_file'];?>" class="btn btn-danger delete btn-xs"><i class="fa fa-times"></i></button></td>
      <td class="col-md-1">
	      <?php
	      	if($type == 'files')
	      	{ 
	     		 echo anchor(base_url().'uploads/'.$row['name_file'], '<i class="fa '.$row['icon_file'].' fa-lg"></i>');
	      	}

	      	if($type == 'images')
	      	{
	      		echo '<img width="100" alt="изображение потеряно" height="100" src="'.base_url().'/uploads/'.$row['name_file'].'_thumb'.$row['ext_file'].'">';
	      	}
	      ?>
      </td>
	  <td class="col-md-10"><input type="text" class="description" file="<?php echo $row['id_file'];?>" value="<?php echo $row['description_file'];?>"></td>
      </tr>
     <?php endforeach;?>
    </tbody>
</table>
</div>
<?php } ?>