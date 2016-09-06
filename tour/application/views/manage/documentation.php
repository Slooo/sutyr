<div class="col-md-12">
	<h2><?php echo $title;?></h2>
</div>

<div class="col-md-12"><hr></div>

<div class="col-md-12 box">
	<div class="dropdown">
		<button class="btn btn-default btn-document dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
			Категории <span class="caret"></span>
		</button>

		<ul class="dropdown-menu dropup scrollable-menu" aria-labelledby="category_dropdown">
		<li class="dropdown-header">Категории</li>
		<li role="separator" class="divider"></li>
			<?php 
			//menu
			foreach($category as $row):
				if($row['parent_category'] == 0 && $row['parent_category'] != 'menu')
				{
					$name = $row['parent_category'] == '0' ? '<b>'.$row['name_category'].":</b>" : $row['name_category'];
					echo '<li class="dropdown-header">'.$name.'</li>';
					$id = $row['id_category'];
					parents($category, $id);
					echo '<li role="separator" class="divider"></li>';
				}
				
				if($row['parent_category'] == 'menu')
				{
					echo '<li category-d="'.$row['id_category'].'" class="cats_document"><a>'.$row['name_category']."</a>";
				}
			endforeach;
			?>

			<?php
			//parent
			function parents($category, $id)
			{
				foreach($category as $item):
				    if($item['parent_category'] == $id)
				    {
				    	echo '<li category-d="'.$item['id_category'].'" class="cats_document"><a>'.$item['name_category']."</a>";
				    	parents($category, $item['id_category']);
				    	echo "</li>";
				    }
				endforeach;
			}
			?>
		</ul>
	</div>
</div>


<div class="col-md-12"><hr></div>

<?php $this->load->view('manage/files_upload');?>

<div class="col-md-12 collapse" id="documentation-block">
	<hr><textarea placeholder="Расширенные возможности..." id="documentation-text"></textarea>
</div>

<div class="col-md-12">
<hr>
	<?php echo anchor('manage', 'Главная', 'class="btn btn-primary"');?> 
	<div class="btn-group">
		<button type="button" class="btn btn-success" id="btn-save-documentation">Сохранить</button>
		<button type="button" class="btn btn-success" data-toggle="collapse" data-target="#documentation-block"><div class="caret"></div></button>
	</div>
</div>