<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tour_manage extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mdl_manage');
		$this->load->model('Mdl_main');
		$this->check_session();
	}

	# переменная для загрузки файлов
	private $_uploaded; 

	# глобальная проверка сессии
	private function check_session()
	{
		if(!$this->session->userdata('login')) {
			redirect('manage');
		}
	}

	# шаблон страницы
	private function page($page, $data = false)
	{
		$this->load->view('manage/templates/header');
		$this->load->view('manage/'.$page, $data);
		$this->load->view('manage/templates/footer');
	}

	# страница статей
	public function articles_page()
	{
		$data['title']    = 'Управление статьями';
		$data['articles'] = $this->Mdl_manage->article_get();
		$this->page('articles', $data);
	}

	# страница документации
	public function documentation_page()
	{
		$data['title'] 	  = 'Управление документацией';
		$data['category'] = $this->Mdl_manage->category_menu_get(100,2);
		$this->page('documentation', $data);
	}

#===================== ARTICLE =====================#

#====== CREATE ======#

	# страница
	public function article_create_page()
	{
		$data['title']	  = 'Создание статьи';
		$data['category'] = $this->Mdl_manage->category_menu_get(2,0);
		$this->page('article_create', $data);
	}

	# форма создании статьи
	public function article_create_form()
	{
		$this->form_validation->set_rules('title', 'Заголовок', 'required|trim|max_length[100]|is_unique[articles.title_article]');
		$this->form_validation->set_rules('content', 'Контент', 'required|trim|min_length[10]|max_length[5000]');
		$this->form_validation->set_rules('category', 'Категория', 'required');
		$this->form_validation->set_rules('date_public', 'Дата публикации', 'required|numeric|exact_length[10]');
		$this->form_validation->set_rules('date_event', 'Дата события', 'numeric|exact_length[10]');

		if($this->form_validation->run() == false)
		{
			echo json_encode(array('error' => validation_errors()));
		} else {
			$this->article_create();
		}
	}

	# создание статьи
	private function article_create()
	{
		$data = array
		(
			'id_category'	  	  => $this->input->post('category'),
			'title_article'   	  => htmlspecialchars($this->input->post('title')),
			'content_article' 	  => $this->input->post('content'),
			'date_public_article' => $this->input->post('date_public'),
			'date_event_article'  => $this->input->post('date_event')
		);
		
		$this->Mdl_manage->article_create($data);
		echo json_encode(array('success' => $this->db->insert_id()));
	}

#====== UPDATE ======#

	# страница
	public function article_update_page($id)
	{
		$data['title'] 			  = 'Редактирование статьи';
		$data['article'] 		  = $this->Mdl_manage->article_get($id);
		$data['article_category'] = $this->Mdl_manage->category_get($data['article']->id_category);
		$data['category']		  = $this->Mdl_manage->category_menu_get(2, 0);
		$this->page('article_update', $data);
	}

	# форма редактирования статьи
	public function article_update_form()
	{
		$this->form_validation->set_rules('id', 'id', 'required');
		$this->form_validation->set_rules('title', 'Заголовок', 'required|trim|max_length[100]');
		$this->form_validation->set_rules('content', 'Контент', 'required|trim|min_length[10]|max_length[5000]');
		$this->form_validation->set_rules('category', 'Категория', 'required');
		$this->form_validation->set_rules('date_public', 'Дата публикации', 'required|numeric|exact_length[10]');
		$this->form_validation->set_rules('date_event', 'Дата события', 'numeric|exact_length[10]');

		if($this->form_validation->run() == false)
		{
			echo json_encode(array('error' => validation_errors()));
		} else {
			$this->article_update();
		}
	}

	# редактирование статьи
	private function article_update()
	{
		$id = $this->input->post('id');
		$data = array
		(
			'id_category'	      => $this->input->post('category'),
			'title_article'   	  => htmlspecialchars($this->input->post('title')),
			'content_article'     => $this->input->post('content'),
			'date_public_article' => $this->input->post('date_public'),
			'date_event_article'  => $this->input->post('date_event')
		);
		
		$this->Mdl_manage->article_update($id, $data);
		echo json_encode(array('success' => '<p>Статья обновлена</p>'));
	}

#====== DELETE ======#

	# форма
	public function article_delete_form()
	{
		if($this->input->is_ajax_request())
		{
			$this->form_validation->set_rules('id', 'id', 'required');
			if($this->form_validation->run() == false)
			{
				show_404();
			} else {
				$this->article_delete();
			}
		} else {
			show_404();
		}
	}

	# удаление
	private function article_delete()
	{
		$this->Mdl_manage->article_delete($this->input->post('id'));
		echo json_encode(array('success' => 1));
	}

#===================== FILES =====================#

#====== CREATE ======#

	# подгружаем файлы для статьи
	public function files_get_form()
	{
		if($this->input->is_ajax_request())
		{
			$this->form_validation->set_rules('id', 'id', 'required');
			$this->form_validation->set_rules('type', 'type', 'required');
			
			if($this->form_validation->run() == false)
			{
				echo json_encode(array('error' => validation_errors()));
			} else {
				switch ($this->input->post('type')) {
					case 'article':
						$type = 'id_article';
						break;
					case 'documentation':
						$type = 'id_category';
						break;
					default:
						show_404();
						break;
				}
				echo $this->Mdl_manage->files_get($this->input->post('id'), $type);
			}
		} else {
			show_404();
		}
	}

	# загрузка файлов
	public function files_create_form()
    {
    	if($this->input->is_ajax_request())
    	{
	    	$this->form_validation->set_rules('id', 'Категория', 'trim|required');
	    	$this->form_validation->set_rules('type', 'type', 'trim|required');

	    	if($this->form_validation->run() == false)
	    	{
	    		echo json_encode(array('error' => validation_errors()));
	    	} else {
		    	$id  = $this->input->post('id');
		    	$who = $this->input->post('type');
		    	
		    	switch($who)
		    	{
		    		case 'article':
		    			$type = 'id_article';
		    			break;
		    		case 'documentation':
		    			$type = 'id_category';
		    			break;	
		    		default:
		    			show_404();
		    			break;
		    	}

		    	$config['allowed_types'] = 'jpg|jpeg|png|gif|doc|docx|xls|xlsx|xml|pdf|txt|zip|rar';
		    	$config['upload_path'] = './uploads';
		    	$config['max_size'] = '10000';
		    	$config['remove_spaces'] = true;
	        
		        $this->load->library('upload', $config);
		        if($this->upload->do_upload('uploadedfiles'))
		        {
		            $this->_uploaded = $this->upload->data();
		            $this->files_image_resize($id, $type);
		        } else {
		        	echo json_encode(array('error' => $this->upload->display_errors()));
		        }
		    }
		} else {
			show_404();
		}
    }

    # изменение размера изображений
    private function files_image_resize($id, $type)
    {
    	$this->load->library('image_lib');
    	$config['image_library']  = 'gd2';
    	$config['create_thumb']   = TRUE;
    	$config['maintain_ratio'] = TRUE;
    	$config['width']     	  = 120;
    	$config['height']   	  = 100;

    	if(isset($this->_uploaded[0]))
    	{
	    	foreach($this->_uploaded as $row):
	    	    $config['source_image'] = './uploads/'.$row['file_name'];
	    		$this->image_lib->clear();
	    		$this->image_lib->initialize($config);
	    		$this->image_lib->resize();
	    	endforeach;
	    } else {
    		$config['source_image'] = './uploads/'.$this->_uploaded['file_name'];
    		$this->image_lib->clear();
    		$this->image_lib->initialize($config);
    		$this->image_lib->resize();
	    }

	    $this->files_create($id, $type);
    }

    # загрузка документов
	private function files_create($id, $type)
    {
		if(isset($this->_uploaded[0]))
		{
	    	foreach($this->_uploaded as $row):
	    		$data = array
	    		(
	    				   $type 	   => $id,
	    			'name_file'  	   => $row['raw_name'],
	    			'ext_file'	 	   => $row['file_ext'],
	    			'type_file'	 	   => $row['is_image'],
	    			'description_file' => $row['raw_name']
	    		);
	    		$this->Mdl_manage->files_create($data);
	    	endforeach;
		} else {
				$data = array
				(
		    			   $type 	   => $id,
					'name_file'  	   => $this->_uploaded['raw_name'],
					'ext_file'	 	   => $this->_uploaded['file_ext'],
					'type_file'	 	   => $this->_uploaded['is_image'],
					'description_file' => $this->_uploaded['raw_name']
				);
				$this->Mdl_manage->files_create($data);
		}
		echo json_encode(array('success' => '<p>Файлы загружены</p>'));
	}

#====== UPDATE ======#

	# форма редактирования файлов
	public function files_update_form()
	{
		if($this->input->is_ajax_request())
		{
			$this->form_validation->set_rules('id', 'id', 'required');
			$this->form_validation->set_rules('description', 'описание', 'trim|max_length[100]');
			if ($this->form_validation->run() == false)
			{
		    	echo json_encode(array('error' => validation_errors()));
			} else {
				$this->files_update();
			}
		} else {
			show_404();
		}
	}

	# обновляем описание файлов
	private function files_update()
	{
		$id   = $this->input->post('id');
		$data = $this->input->post('description');
		$this->Mdl_manage->files_update($id, $data);
		echo json_encode(array('success' => '<p>Файл обновлен</p>', 'description' => $data));
	}

#====== DELETE ======#

	# форма удаления файлов
	public function files_delete_form()
	{
		if($this->input->is_ajax_request())
		{
			$this->form_validation->set_rules('id', 'id', 'required|numeric');
			if($this->form_validation->run() == false)
			{
				show_404();
			} else {
				$this->files_delete();
			}
		} else {
			show_404();
		}
	}

	# удаление файла
	private function files_delete()
	{
		$id = $this->input->post('id');
		$this->Mdl_manage->files_delete($id);
		echo json_encode(array('success' => '<p>Файл удален</p>'));
	}

#===================== DOCUMENTATION =====================#

#====== SELECT ======#

	# выбираем документацию из меню
	public function documentation_get_form()
	{
		$this->form_validation->set_rules('id', 'id', 'required');
		if($this->form_validation->run() == false)
		{
			show_404();
		} else {
			$this->documentation_get();
		}
	}

	# выбираем документацию
	private function documentation_get()
	{
		$id = $this->input->post('id');
		echo $this->Mdl_manage->documentation_get($id);
	}

#====== UPDATE ======#

	# форма обновления документации
	public function documentation_update_form()
	{
		$this->form_validation->set_rules('id', 'id', 'required');
		$this->form_validation->set_rules('content', 'Контент', 'required|trim');
		if($this->form_validation->run() == false)
		{
			echo json_encode(array('error' => validation_errors()));
		} else {
			$this->documentation_update();
		}
	}

	# обновление документации
	private function documentation_update()
	{
		$id   = $this->input->post('id');
		$data = $this->input->post('content');
		$this->Mdl_manage->category_documentation_update($id, $data);
		echo json_encode(array('success' => '<p>Документация обновлена</p>'));
	}

}