<h1><?php echo $row->title_article;?></h1>
<p><?php echo $row->content_article;?></p>

<div class="box-center-img">
<?php foreach($images as $image):?>
<a class="fancybox-thumb" rel="fancybox-thumb" href="<?php echo base_url().'uploads/'.$image['name_file'].$image['ext_file'];?>" title="<?php echo $image['description_file'];?>">
	<img src="<?php echo base_url().'uploads/'.$image['name_file'].'_thumb'.$image['ext_file'];?>" alt="Изображение отсутствует" />
</a>
<?php endforeach;?>
</div>

<?php if($row->date_event_article){?><p class="box-center-event">Отправка <time><?php echo date('d.m.Y', $row->date_event_article);?></time> 
<a href="/about#contacts">записаться на маршрут</a>.</p><?php } ?>

<div class="box-center-doc">
<div class="timestamp"><i class="fa fa-calendar"></i> <time datetime="<?php echo date('Y-m-d', $row->date_public_article);?>">
<?php echo date('d.m.Y', $row->date_public_article);?></div>
<?php if($files) { ?>
<span>Прикрепленные файлы:</span><br>
<?php foreach($files as $file): ?>
	<?php echo anchor(base_url().'uploads/'.$file['name_file'].$file['ext_file'], '<i class="fa '.$file['icon_file'].'"></i> '.$file['description_file']);?><br>
<?php endforeach;?>
<?php } ?>
</div>