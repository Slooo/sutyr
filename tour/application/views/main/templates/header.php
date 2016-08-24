<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="description" content="МБУДО Станция юных туристов г. Ишимбай"> 
	<meta name="keywords" content="Ишимбай, станция юных туристов, МБУДО, сутюр, сютур" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Официальный сайт МБУДО "Станция юных туристов г. Ишимбай"</title>
	<link rel="stylesheet" href="<?php echo base_url();?>bootstrap/css/bootstrap.css">
	<link rel="stylesheet" href="<?php echo base_url();?>bootstrap/css/style.css">
	<link rel="stylesheet" href="<?php echo base_url();?>awesome/css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>fancybox/source/jquery.fancybox.css?v=2.1.5" media="screen" />

	<div class="hide">
		<!-- Yandex.Metrika informer -->
		<a href="https://metrika.yandex.ru/stat/?id=35086085&amp;from=informer"
		target="_blank" rel="nofollow"><img src="//informer.yandex.ru/informer/35086085/3_1_FFFFFFFF_EFEFEFFF_0_pageviews"
		style="width:88px; height:31px; border:0;" alt="Яндекс.Метрика" title="Яндекс.Метрика: данные за сегодня (просмотры, визиты и уникальные посетители)" onclick="try{Ya.Metrika.informer({i:this,id:35086085,lang:'ru'});return false}catch(e){}"/></a>
		<!-- /Yandex.Metrika informer -->

		<!-- Yandex.Metrika counter -->
		<script type="text/javascript">
		(function (d, w, c) {
		    (w[c] = w[c] || []).push(function() {
		        try {
		            w.yaCounter35086085 = new Ya.Metrika({id:35086085,
		                    clickmap:true,
		                    trackLinks:true,
		                    accurateTrackBounce:true});
		        } catch(e) { }
		    });

		    var n = d.getElementsByTagName("script")[0],
		        s = d.createElement("script"),
		        f = function () { n.parentNode.insertBefore(s, n); };
		    s.type = "text/javascript";
		    s.async = true;
		    s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

		    if (w.opera == "[object Opera]") {
		        d.addEventListener("DOMContentLoaded", f, false);
		    } else { f(); }
		})(document, window, "yandex_metrika_callbacks");
		</script>
		<noscript><div><img src="//mc.yandex.ru/watch/35086085" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
		<!-- /Yandex.Metrika counter -->
	</div>

</head>
<body>

<div class="col-md-12 head-logo">
	<div id="head-text">Официальный сайт МБУДО<br> Станция юных туристов г.Ишимбай РБ</div>
</div>

<!-- ==========МЕНЮ=========== -->

<div class="col-md-12 top-menu">
<nav class="navbar navbar-default navbar-static-top">

<div class="navbar-header">
	<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#responsive-menu">
		<span class="sr-only">Открыть навигацию</span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	</button>
</div>

<div class="collapse navbar-collapse navbar-ex1-collapse" id="responsive-menu">
    <ul class="nav navbar-nav">
    	<li class="menu-item"><?php echo anchor(base_url(), 'Главная');?></li>
		<li class="menu-item"><?php echo anchor('route', 'Маршруты');?></li>

        <li class="menu-item dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown">Направления<b class="caret"></b></a>
            	<ul class="dropdown-menu">

            	    <li class="menu-item dropdown dropdown-submenu">
            	    <a class="dropdown-toggle" data-toggle="dropdown">Краеведческое</a>
            	        <ul class="dropdown-menu">
            		        <li>
            		        	<?php echo anchor('directions/local-history/certification-school-museums', 'Паспортизация школьных музеев');?>
            		        	<?php echo anchor('directions/local-history/city-position', 'Городские положения');?>
            		            <?php echo anchor('directions/local-history/republican-position', 'Республиканские положения');?>
            		            <?php echo anchor('directions/local-history/local-history-protocols', 'Итоговые протоколы');?>
            		        </li>
            	         </ul>
            	    </li>

            		<li class="menu-item dropdown dropdown-submenu">
            		<a class="dropdown-toggle" data-toggle="dropdown">Спорт. туризм</a>
            			<ul class="dropdown-menu">
	        				<li class="menu-item ">
	        					<?php echo anchor('directions/sport-tourism', 'Спорт. туризм');?>
	        					<?php echo anchor('directions/sport-tourism/recommendations', 'Методические рекомендации');?>
	        					<?php echo anchor('directions/sport-tourism/provisions', 'Положения');?>
	        					<?php echo anchor('directions/sport-tourism/sport-tourism-protocols', 'Итоговые протоколы');?>
	        				</li>
	        			</ul>
	    			</li>

	    			<li class="menu-item"><?php echo anchor('directions/alpinism', 'Альпинизм');?></li>
	    			<li class="menu-item"><?php echo anchor('directions/geological', 'Геологическое');?></li>
	    			<li class="menu-item"><?php echo anchor('directions/tour', 'Экскурсионное');?></li>
	    			<li class="menu-item"><?php echo anchor('directions/orientation', 'Ориентирование');?></li>
	    			<li class="menu-item"><?php echo anchor('directions/patriotic', 'Патриотическое воспитание');?></li>

                </ul>
       	</li>

       	<li class="menu-item dropdown">
	        <a class="dropdown-toggle" data-toggle="dropdown">Документация<b class="caret"></b></a>
	            <ul class="dropdown-menu">
		            <li class="menu-item"><?php echo anchor('documentation/school-museums', 'Школьные музеи');?></li>
		            <li class="menu-item"><?php echo anchor('documentation/state', 'Государственные нормативно-правовые документы');?></li>
		            <li class="menu-item"><?php echo anchor('documentation/sytur', 'Нормативно-правовые документы МБУДО СЮТур');?></li>
		            <li class="menu-item"><?php echo anchor('documentation/educational', 'Дополнительные общеобразовательные программы');?></li>
		            <li class="menu-item"><?php echo anchor('documentation/library', 'Библиотека');?></li>
	            </ul>
	    </li>

	    <li class="menu-item"><?php echo anchor('achievements', 'Достижения');?></li>
	    <li class="menu-item"><?php echo anchor('album', 'Альбом');?></li>
	    <li class="menu-item"><?php echo anchor('about', 'О нас');?></li>

    </ul>
</div>

</nav>
</div>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-2 col-lg-2 box-left">
			<div class="panel panel-aside">
				<div class="panel-heading">Наши партнеры</div>
				<div class="list-group">
					<a href="http://mmpsrb.ru" class="list-group-item">Министерство спорта</a>
					<a href="http://detiturizm.ru" class="list-group-item">Министерство молодежной политики и образования</a>
					<a href="http://www.ishimbaimr.ru/ru" class="list-group-item">Администрации города Ишимбай</a>
					<a href="http://morb.ru" class="list-group-item">Министерство образования РБ</a>
					<a href="http://turcentrrf.ru" class="list-group-item">Федеральный центр</a>
					<a href="http://control-education.bashkortostan.ru" class="list-group-item">Управление по контролю и надзору в сфере образования РБ</a>
				</div>
			</div>
		</div>

		<div class="col-md-8 col-lg-8 box-center">