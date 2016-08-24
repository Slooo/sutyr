<div class="col-md-12">
    <h2><?php echo $title;?></h2>
</div>

<div class="col-md-12"><hr></div>

<div class="col-md-12">
    <div class="overflow">
        <table class="table table-striped">
            <tbody>
                <?php foreach($articles as $row):?>
                <tr>
                  <td class="col-md-1 title-delete">
                  <button type="button" file="<?php echo $row['id_article'];?>" class="btn btn-danger btn-xs btn-delete-article"><i class="fa fa-times"></i></button></td>
                  <td class="col-md-1"><?php echo anchor('manage/article/'.$row['id_article'], '<i class="fa fa-edit"></i>', 'class="btn btn-primary btn-xs"');?></td>
                  <td class="col-md-10"><?php echo $row['title_article'];?></td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>

<div class="col-md-12"><hr></div>

<div class="col-md-12">
    <a href="../manage" class="btn btn-primary">Главная</a> 
    <a href="article/create" class="btn btn-primary">Добавить</a>
</div>