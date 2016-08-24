<!DOCTYPE html>
<html lang="ru">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Панель управления</title>
	<link rel="stylesheet" href="/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" href="/bootstrap/css/manage.css">
	<link rel="stylesheet" href="/bootstrap/css/bootstrap-datepicker.min.css">
	<link rel="stylesheet" href="/awesome/css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="/fancybox/source/jquery.fancybox.css?v=2.1.5" media="screen" />

	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="/js/jquery.js"><\/script>')</script>

	<script src="/bootstrap/js/bootstrap.js"></script>
	<script src="/bootstrap/js/moment-with-locales.js"></script>
	<script src="/bootstrap/js/bootstrap-datetimepicker.js"></script>
	<script src="/js/jquery.DataSaver.min.js"></script>
	<script type="text/javascript" src="/fancybox/source/jquery.fancybox.js?v=2.1.5"></script>

</head>
<body>

<div class="progress hidden">
	<div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%">
	</div>
</div>

<div id="answer"></div>

<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-8 col-xs-offset-2 block">

<!-- Окно удаления -->
<div class="modal fade bs-example-modal-sm" id="modal-delete" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<h4 class="modal-title"></h4>
			<div class="modal-body">
				<button class="btn btn-danger delete" value="">Удалить</button>
				<button class="btn btn-primary" data-dismiss="modal">Отмена</button>
			</div>
		</div>
	</div>
</div>

<div class="row">

<script>
var base_url = 'http://xn--p1abdd0d.xn--p1ai/';
var segment3 = '<?php echo $this->uri->segment(3);?>';
var type 	 = '<?php echo $this->uri->segment(2);?>';

// выбираем файлы
function get_files(id)
{
	$.ajax({
		type:'POST',
		data: {'type':type, 'id':id},
		url: base_url + 'manage/form/files/get',
		dataType:'json',
		success:function(answer)
		{
			if(answer.error)
			{
				$('.overflow').text(answer.error);
		   		$('#documentation-text').val('');
			}

			else

			if(answer.success)
			{
				obj = JSON.stringify(answer.success);
				json = JSON.parse(obj);

				html = "";
				content = "";
		   		for(data in json)
		   		{
		   			html += '<tr>';
		   			html += '<td class="col-md-1"><button type="button" uri="files" file="'+json[data].id_file+'" class="btn btn-danger btn-xs btn-delete"><i class="fa fa-times"></i></button></td>';
		   			html += '<td class="col-md-1"><a class="fancybox-thumb" rel="fancybox-thumb" title="'+json[data].description_file+'" href="'+base_url+'uploads/'+json[data].name_file+json[data].ext_file+'"><i class="fa '+json[data].icon_file+' fa-lg"></i></a></td>';
		   			html += '<td class="col-md-10"><input type="text" class="description" file="'+json[data].id_file+'" value="'+json[data].description_file+'"></td>';
		   			html += '</tr>';

		   			content += '<tr>';
		   			content += '<td class="col-md-1"><a class="fancybox-thumb" rel="fancybox-thumb" title="'+json[data].description_file+'" href="'+base_url+'uploads/'+json[data].name_file+json[data].ext_file+'"><i class="fa '+json[data].icon_file+'"></i></a></td>';
		   			content += '<td class="col-md-11"><a href="'+base_url+'uploads/'+json[data].name_file+json[data].ext_file+'">'+json[data].description_file+'</a></td>';
		   			content += '</tr>';
		   		}

		   		success = '<table class="table table-striped"><tbody>'+html+'</tbody></table>';
		   		title = '<h1>'+localStorage.getItem('name_cats_documentation')+'</h1>';
		   		$('.overflow').html(success);
		   		$('#documentation-text').val(title+'<table class="table table-striped table-bordered"><tbody>'+content+'</tbody></table>');
			}
		}
	});
}

</script>