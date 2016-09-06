$(".fancybox-thumb").fancybox({
	prevEffect	: 'none',
	nextEffect	: 'none',
	helpers	: {
		title	: {
			type: 'outside'
		}
	}
});

//фокусы
$('#title, #username').focus();

// подгружаем input, textarea
$('.save-create').DataSaver({
	timeout: 1000, 
	events: "change keyup",
	keyUrlAttrs: ["host", "pathname", "search"],
	keyExtra: function() { 
    	return $('#linkedfield').val(); 
	}
});

// подгружаем input, textarea
$('.save-update').DataSaver({
	timeout: 1000, 
	events: "change keyup",
	keyUrlAttrs: ["host", "pathname", "search"],
	keyExtra: function() { 
    	return $('#linkedfield').val(); 
	}
});

//календарь
$('#datetimepicker1, #datetimepicker2').datetimepicker({
	format: 'DD.MM.YYYY',
	locale:'ru',
});

//сохраняет выбранно значение даты
var $dp = $('#datetimepicker1, #datetimepicker2').data("DateTimePicker");

//запись timestamp в публикации
$('#datetimepicker1').on('dp.change', function (e) {
	$('#date-public').val(e.date.unix());
});

//запись timestamp в событие
$('#datetimepicker2').on('dp.change', function (e) {
	if($('input', this).val().length == 0)
	{
		$('#date-event').val('');
	} else {
		$('#date-event').val(e.date.unix());
	}
});

// выбор категории статьи
$('.cats_article').on('click', function(e){
	var
	id 		 = $(this).attr('category-a'),
	name	 = $(this).text();

	$('#id-upload, #category-a').val(id);
	$('.btn-article').html(name);
	localStorage.setItem('name_cats_article', name);
	localStorage.setItem('id_cats_article', id);
});

// выбор категорий документаций
$('.cats_document').on('click', function(e){
	var 
	id 		 = $(this).attr('category-d'),
	name	 = $(this).text();

	$('#id-upload').val(id);
	$('.btn-document').html(name);
	localStorage.setItem('name_cats_documentation', name);
	localStorage.setItem('id_cats_documentation', id);

	get_files(localStorage.getItem('id_cats_documentation'));

});

var here = "";

// удаление файлов modal
$('body').on('click', '.btn-delete', function(e){
	e.preventDefault();

	$('.delete').attr('id', 'file-delete');
	var id = $(this).attr('file');
	here = $(this).parents('tr');
	$('.delete').val(id);
	$('.modal-title').html('Удалить файл?');
	$('#modal-delete').modal('show');
});

// удаление статьи modal
$('body').on('click', '.btn-delete-article', function(e){
	e.preventDefault();

	$('.delete').attr('id', 'article-delete');
	var id = $(this).attr('file');
	here = $(this).parents('tr');
	$('.delete').val(id);
	$('.modal-title').html('Удалить статью?');
	$('#modal-delete').modal('show');
});

// удаление файла
$('body').on('click', '#file-delete', function(e){
	e.preventDefault();

	var id = $(this).val();
	$.ajax({
		type:'POST',
		url : base_url + 'manage/form/files/delete',
		data: {"id":id},
		dataType:'json',
		success:function(answer)
		{
			if(answer.success)
			{
				here.remove();
				$('#answer').removeClass('error').addClass('success').html(answer.success);
				$('#modal-delete').modal('hide');
				$('.success p').delay(1000).fadeOut();
			}
		}
	});
});

// удаление статьи
$('body').on('click', '#article-delete', function(e){
	e.preventDefault();

	var id = $(this).val();
	$.ajax({
		type:'POST',
		url : base_url + 'manage/form/article/delete',
		data: {"id":id},
		dataType:'json',
		success:function(answer)
		{
			if(answer.success)
			{
				window.location = base_url + "manage/articles";			
			}
		}
	});
});

// создание статьи
$('body').on('click', '#btn-create-article', function(e) {
	e.preventDefault();
	var data = $('#form-create-article').serialize();

	$.ajax({
		type:'POST',
		url: base_url + 'manage/form/article/create',
		data: data,
		dataType: 'json',
		success:function(answer)
		{
			if(answer.success)
			{
				window.location = base_url + "manage/article/" + answer.success;
			}

			else

			if(answer.error)
			{
				$('#answer').removeClass('success').addClass('error').html(answer.error);
			}
		}
	});
})

// сохранение статьи
$('body').on('click', '#btn-save-article', function(e) {
	e.preventDefault();
	var data = $('#form-save-article').serialize();

	$.ajax({
		type:'POST',
		url:  base_url + 'manage/form/article/update',
		data:data,
		dataType:'json',
		success:function(answer)
		{
			if(answer.success)
			{
				$('#answer').removeClass('error').addClass('success').html(answer.success);
				$('.success p').delay(1000).fadeOut();
			}

			if(answer.error)
			{
				$('html, body').stop().animate({scrollTop:0}, '500', 'swing');
				$('#answer').removeClass('success').addClass('error').html(answer.error);
			}
		}
	});
});

// сохранение документации
$('#btn-save-documentation').click(function(e){
	e.preventDefault();
	var
	content 	= $('#documentation-text').val();
	id 			= localStorage.getItem('id_cats_documentation');
	data 		= {"id":id,"content":content};

	$.ajax({
		type:'POST',
		url:  base_url + 'manage/form/documentation/update',
		data:data,
		dataType:'json',
		success:function(answer)
		{
			if(answer.success)
			{
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