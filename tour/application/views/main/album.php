<h2>Наш альбом</h2>
<div class="box-center-img">
<?php foreach($query as $row):?>

<a class="fancybox-thumb" rel="fancybox-thumb" title="<?php echo $row['description_file'];?>" href="<?php echo base_url().'uploads/'.$row['name_file'].$row['ext_file'];?>">
	<img alt="Изображение отсутствует" src="<?php echo base_url().'uploads/'.$row['name_file'].'_thumb'.$row['ext_file'];?>">
</a>

<?php endforeach;?>
</div>

<ul class="pagination">
	<?php echo $pagination;?>
</ul>