<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<h2><?php echo $title;?></h2>	
</div>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><hr></div>

<div class="col-lg-6 col-lg-push-3 col-md-6 col-md-push-3 col-sm-12 col-xs-12">

<?php if($this->session->userdata('login')) { ?>

	<?php echo form_open('manage/form/exit'); ?>
		<div class="btn btn-group-vertical">
			<a href="manage/articles" class="btn btn-primary">Новости и Маршруты</a>
			<a href="manage/documentation" class="btn btn-primary">Страницы и Документация</a>
			<button type="submit" class="btn btn-danger">Выход</button>
		</div>
	<?php echo form_close();?>
	
<?php } else { ?>
<div class="row">
	<div class="col-lg-8 col-lg-push-2 col-md-8 col-md-push-2 col-sm-8 col-sm-push-2 col-xs-8 col-xs-push-2">
		<?php echo form_open('manage/form/auth'); ?>
			<div class="form-group">
				<input type="text" id="username" class="form-control" name="username" placeholder="Логин">
			</div>

			<div class="form-group">
				<input type="password" id="password" class="form-control" name="password" placeholder="Пароль">
			</div>
			
			<button type="submit" class="btn btn-primary">Войти</button>
		<?php echo form_close();?>
	</div>
</div>
	<?php } ?>

</div>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><hr></div>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<?php echo anchor(base_url(), 'Вернуться на сайт');?>	
</div>