<?php
if($this->uri->segment(1))
{
	$url = base_url().$this->uri->segment(1).'/';
} else {
	$url = base_url().'news/';
}
?>

<main>
<?php foreach($articles as $row): ?>

<article>
<h3><?php echo anchor($url.$row['id_article'], $row['title_article']);?></h3>
<p><?php echo $row['content_article'];?><?php echo anchor($url.$row['id_article'], 'читать далее');?></p>
<div class="timestamp"><i class="fa fa-calendar"></i> <time datetime="<?php echo date('Y-m-d', $row['date_public_article']);?>">
<?php echo date('d.m.Y', $row['date_public_article']);?></time></div>
</article>

<hr>
<?php endforeach;?>
</main>

<ul class="pagination">
	<?php echo $pagination;?>
</ul>