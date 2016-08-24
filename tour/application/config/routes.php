<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'Tour_main/articles';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

#========== MAIN FUNCTION =========#

# dinamic page
$route['news'] 				= 'Tour_main/articles';
$route['news/page']			= 'Tour_main/articles';
$route['news/page/(:num)']  = 'Tour_main/articles/$1';
$route['news/(:num)']	    = 'Tour_main/article/$1';

$route['route']		   		= 'Tour_main/articles';
$route['route/page']		= 'Tour_main/articles';
$route['route/page/(:num)']	= 'Tour_main/articles/$1';
$route['route/(:num)']		= 'Tour_main/article/$1';

# меню
$route['album'] 	   		= 'Tour_main/album';
$route['album/page']   		= 'Tour_main/album';
$route['album/page/(:num)']	= 'Tour_main/album/$1';

$route['about']		   		= 'Tour_main/documentation';
$route['achievements'] 		= 'Tour_main/documentation';

# направления
$route['directions/(:any)'] 		= 'Tour_main/documentation/$1';

# направления краеведческое
$route['directions/local-history/(:any)']	= 'Tour_main/documentation/$1';

# направление спорт.туризм
$route['directions/sport-tourism/(:any)']	= 'Tour_main/documentation/$1';

# документация
$route['documentation/(:any)']	= 'Tour_main/documentation/$1';

#========== MANAGE FUNCTION =========#

# статьи
$route['manage'] 						   = 'Tour_control/manage';
$route['manage/articles']				   = 'Tour_manage/articles_page';
$route['manage/documentation']	   		   = 'Tour_manage/documentation_page';
$route['manage/article/create'] 		   = 'Tour_manage/article_create_page';
$route['manage/article/(:num)'] 		   = 'Tour_manage/article_update_page/$1';

# формы
$route['manage/form/auth'] = 'Tour_control/users_auth_form';
$route['manage/form/exit'] = 'Tour_control/users_logout';

$route['manage/form/documentation'] 	   = 'Tour_manage/documentation_get_form';
$route['manage/form/documentation/update'] = 'Tour_manage/documentation_update_form';
$route['manage/form/article/create'] 	   = 'Tour_manage/article_create_form';
$route['manage/form/article/update'] 	   = 'Tour_manage/article_update_form';
$route['manage/form/article/delete']	   = 'Tour_manage/article_delete_form';
$route['manage/form/files/get']			   = 'Tour_manage/files_get_form';
$route['manage/form/files/create'] 		   = 'Tour_manage/files_create_form';
$route['manage/form/files/update']		   = 'Tour_manage/files_update_form';
$route['manage/form/files/delete']		   = 'Tour_manage/files_delete_form';

