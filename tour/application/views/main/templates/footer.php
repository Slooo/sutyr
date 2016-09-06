		</div>
		<div class="box-right col-md-2 col-lg-2">
			<div class="panel panel-aside">
			  <div class="panel-heading">Новые маршруты</div>
			  <ul class="list-group">
			  <?php foreach($routes as $route):?>
					<a href="/route/<?php echo $route['id_article'];?>" class="list-group-item">
						<p class="list-group-item-title"><?php echo $route['title_article'];?></p>
						<?php if($route['date_event_article'] > 0) { ?>
							<p class="list-group-item-text">
							<time datetime="<?php echo date('Y-m-d', $route['date_event_article']);?>" class="list-group-time">
							Отправка <?php echo date('d.m.Y', $route['date_event_article']);?></time>
							</p>
						<?php } ?>
					</a>
			   <?php endforeach;?>
			   </ul>
			</div>

			<div class="panel panel-aside">
			  <div class="panel-heading">Последние новости</div>
			  <ul class="list-group">
			  <?php foreach($news as $new):?>
					<a href="/news/<?php echo $new['id_article'];?>" class="list-group-item">
						<p class="list-group-item-title"><?php echo $new['title_article'];?></p>
						<?php if($new['date_event_article'] > 0) { ?>
							<p class="list-group-item-text">
							<time datetime="<?php echo date('Y-m-d', $new['date_event_article']);?>" class="list-group-time">
							Отправка <?php echo date('d.m.Y', $new['date_event_article']);?></time>
							</p>
						<?php } ?>
					</a>
			   <?php endforeach;?>
			   </ul>
			</div>
		</div>

	</div>
</div>

<footer>
	<?php echo anchor('http://codbro.com', 'Copyright '.$years, 'id="copyright"');?>
</footer>

<script src="/js/jquery.js"></script>
<script src="/bootstrap/js/bootstrap.js"></script>
<script type="text/javascript" src="/fancybox/source/jquery.fancybox.js?v=2.1.5"></script>
<script>
$(document).ready(function() {
	$(".fancybox-thumb").fancybox({
		prevEffect	: 'none',
		nextEffect	: 'none',
		helpers	: {
			title	: {
				type: 'outside'
			}
		}
	});
});
</script>

</body>
</html>