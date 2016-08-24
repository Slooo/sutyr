<div class="col-md-12"><h2><?php echo $title;?></h2></div>

<div class="col-md-12"><hr></div>

<div class="col-md-12 box">
	<form id="form-create-article">
		<div class="form-group">
			<input type="text" id="title" class="save-create" name="title" placeholder="Заголовок" value="<?php echo set_value('title');?>">
		</div>
		<div class="form-group">
			<textarea name="content" class="save-create" placeholder="Контент"><?php echo set_value('content');?></textarea>
			<input type="hidden" id="category-a" name="category" value="">
			<input type="hidden" id="date-public" name="date_public" value="">
			<input type="hidden" id="date-event" name="date_event" value="">	
		</div>

		<div class="dropup">
			<button class="btn btn-default btn-article dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
				Категории <span class="caret"></span>
			</button>
				<ul class="dropdown-menu scrollable-menu" aria-labelledby="category_dropdown">
					<li class="dropdown-header">Категории</li>
					<li role="separator" class="divider"></li>
					<?php foreach($category as $row):?>
					<li category-a="<?php echo $row['id_category'];?>" class="cats_article"><a><?php echo $row['name_category'];?></a></li>
					<?php endforeach;?>
				</ul>
		</div>
		
		<div class="input-group date" id="datetimepicker1">
			<input type="text" class="form-control" placeholder="Дата публикации"/><span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span></span>
		</div>

		<div class="input-group date" id="datetimepicker2">
			<input type="text" class="form-control" placeholder="Дата события"/><span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span></span>
		</div>
	</form>
</div>

<div class="col-md-12"><hr></div>

<div class="col-md-12">
	<a href="/manage/articles" class="btn btn-primary">Назад</a>
	<button type="submit" name="submit" id="btn-create-article" class="btn btn-primary">Создать</button>
</div>