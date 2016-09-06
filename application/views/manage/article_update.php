<div class="col-md-12">
	<h2><?php echo $title;?></h2>
	<button type="submit" id="btn-delete-article" file="<?php echo $article->id_article;?>" class="btn btn-danger btn-xs btn-delete-article"><i class="fa fa-times fa-lg"></i></button>
</div>

<div class="col-md-12"><hr></div>

<div class="col-md-12 box">
	<form id="form-save-article">
		<div class="form-group">
			<input type="text" id="title" name="title" class="save-update title-delete" placeholder="Заголовок" value="<?php echo $article->title_article;?>">
		</div>
		<div class="form-group">
			<textarea name="content" class="save-update" placeholder="Контент"><?php echo $article->content_article;?></textarea>
			<input type="hidden" name="id" value="<?php echo $article->id_article;?>">
			<input type="hidden" id="category-a" name="category" value="<?php echo $article->id_category;?>">
			<input type="hidden" id="date-public" name="date_public" value="<?php echo $article->date_public_article;?>">
			<input type="hidden" id="date-event" name="date_event" value="<?php if($article->date_event_article){echo $article->date_event_article;}?>">	
		</div>

		<div class="dropup">
			<button class="btn btn-default btn-menu btn-article dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
			<?php echo $article_category;?> <span class="caret"></span>
			</button>
				<ul class="dropdown-menu scrollable-menu" aria-labelledby="category_dropdown">
					<li class="dropdown-header">Категории</li>
					<li role="separator" class="divider"></li>
					<?php foreach($category as $row):?>
					<li category-a="<?php echo $row['id_category'];?>" class="cats_article"><a><?php echo $row['name_category'];?></a></li>
					<?php endforeach;?>
				</ul>
		</div>

	    <div class="input-group" id="datetimepicker1">
	    	<input type="text" class="form-control" placeholder="Дата публикации <?php echo date('d.m.Y', $article->date_public_article);?>"/><span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span></span>
	    </div>

	    <div class="input-group" id="datetimepicker2">
	    	<input type="text" class="form-control" placeholder="Дата события <?php if($article->date_event_article){echo date('d.m.Y', $article->date_event_article);}?>"/><span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span></span>
	    </div>
	</form>
</div>

<div class="col-md-12"><hr></div>

<?php $this->load->view('manage/files_upload');?>

<div class="col-md-12"><hr></div>

<div class="col-md-12">
	<a href="../articles" class="btn btn-primary">Назад</a>
	<button type="button" id="btn-save-article" name="id" value="<?php echo $article->id_article;?>" class="btn btn-success">Сохранить</button>
</div>