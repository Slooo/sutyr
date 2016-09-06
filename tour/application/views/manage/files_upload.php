<div class="col-md-12 box">
	<form class="form-inline" id="form-upload" accept-charset="utf-8" enctype="multipart/form-data">
	  	<input type="hidden" id="id-upload" name="id" value="">
	  	<input type="hidden" name="type" value="<?php echo $this->uri->segment(2);?>">

			<div class="form-group">
				<input name="uploadedfiles[]" multiple id="input-upload-files" type="file">
			</div>

			<button type="button" id="btn-upload-files" class="btn btn-success">Загрузить</button>
	</form>

	<br>
	<p class="help-block">Доступные форматы изображений: .jpg, .jpeg, .png, .gif</p>
	<p class="help-block">Доступные форматы документов: .doc, .docx, .xls, .xlsx, xml, .pdf, .txt, zip, .rar</p>
</div>

<div class="col-md-12"><hr></div>

<div class="col-md-12">
	<div class="overflow">
		Файлов нет
	</div>
</div>

<?php if($this->uri->segment(3)) { ?>
<script>
	get_files(segment3);
	$('#id-upload').val(segment3);
</script>
<?php } else { ?>
<script>
if(localStorage.getItem('name_cats_documentation') && localStorage.getItem('id_cats_documentation'))
{
	get_files(localStorage.getItem('id_cats_documentation'));
	$('#id-upload').val(localStorage.getItem('id_cats_documentation'));
	$('.btn-document').html(localStorage.getItem('name_cats_documentation'));
}
</script>
<?php } ?>

<script>
//описание документа
$('body').on('focusout', '.description', function(e){
e.preventDefault();

	var
	here		= $(this),
	description = here.val(),
	id 			= here.attr("file"),
	data 		= {"id":id,"description":description};

	$.ajax({
		type:'POST',
		url:  base_url + 'manage/form/files/update',
		data:data,
		dataType:'json',
		success:function(answer)
		{
			if(answer.success)
			{
				<?php if($this->uri->segment(3)) { ?>
	   				get_files(segment3);
	   			<?php } else { ?>
					get_files(localStorage.getItem('id_cats_documentation'));
	   			<?php } ?>

				$('#answer').removeClass('error').addClass('success').html(answer.success);
				$('.success p').delay(1000).fadeOut();
			}

			if(answer.error)
			{
				$('#answer').removeClass('success').addClass('error').html(answer.error);
			}
			
		}
	});
});

// загрузка файлов
$('#btn-upload-files').click(function(e){
	if($('#input-upload-files').val().length === 0)
	{
		$('#answer').removeClass('success').addClass('error').html('<p>Необходимо выбрать файлы для загрузки</p>');
	} else {

		var fd = new FormData();
	    var file_data = $('input[type="file"]')[0].files;
	    for(var i = 0;i<file_data.length;i++){
	        fd.append('uploadedfiles['+i+']', file_data[i]);
	    }
	    var other_data = $('#form-upload').serializeArray();
	    $.each(other_data,function(key,input){
	        fd.append(input.name,input.value);
	    })

		var progressBar = $('.progress');

		$.ajax({
		   	type: 'POST',
		   	cache: false,
		   	processData: false,
		   	contentType: false,
		   	url: base_url + 'manage/form/files/create',
		   	data: fd,
		   	dataType:'json',

	    xhr: function(){
	    	$('.block').addClass('preload');
	    	progressBar.toggleClass('hidden');
	        var xhr = $.ajaxSettings.xhr(); // получаем объект XMLHttpRequest
	        xhr.upload.addEventListener('progress', function(evt){ // добавляем обработчик события progress (onprogress)
	            if(evt.lengthComputable)  // если известно количество байт
	            {
	               // высчитываем процент загруженного
	               var percentComplete = Math.ceil(evt.loaded / evt.total * 100);
	               // устанавливаем значение в атрибут value тега <progress>
	               // и это же значение альтернативным текстом для браузеров, не поддерживающих <progress>
	               $('.progress-bar').css('width', percentComplete+'%').text(percentComplete+'%');
	            }
	        }, false);
	        return xhr;
	    },

	   	success: function(answer)
	   	{
	   		$('.block').removeClass('preload');
			progressBar.toggleClass('hidden');
	   		$('.progress-bar').css('width', '0%');
	   		
	   		if(answer.success)
	   		{
	   			<?php if($this->uri->segment(3)) { ?>
	   				get_files(segment3);
	   			<?php } else { ?>
					get_files(localStorage.getItem('id_cats_documentation'));
	   			<?php } ?>
				var obj = JSON.stringify(answer.success);
				json = JSON.parse(obj);
		   	
		   		var html = "";
		   		for(data in json)
		   		{
		   			html += '<img src="'+base_url+'uploads/'+json[data]+'">';
		   		}
	   			$('#answer').removeClass('error').addClass('success').html(answer.success);
	   			$('.success p').delay(1000).fadeOut();
	   			$('#input-upload-files').val('');
	   		}

			if(answer.error)
			{
				$('#input-upload-files').val('');
				$('#answer').removeClass('success').addClass('error').html(answer.error);
			}
		},

		error: function(answer)
		{
			$('body').addClass('preload').html('Произошла ошибка, попробуйте перезагрузить страницу');
			$('#input-upload-files').val('');
		}

		});
	}
});
</script>
