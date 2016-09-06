<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tour_main extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mdl_main');
	}

	# шаблон страниц
	private function page($page, $data = false)
	{
		$this->load->view('main/templates/header');
		$this->load->view('main/'.$page, $data);
		$footer['years']  = '2016' == date('Y') ? '2016' : '2016 - '.date('Y');
		$footer['routes'] = $this->Mdl_main->article_news_get(2);
		$footer['news']   = $this->Mdl_main->article_news_get(1);
		$this->load->view('main/templates/footer', $footer);
	}

	# документции
	public function documentation($url = false)
	{
		if($url === false)
		{
			$id = $this->uri->segment(1);
		} else {
			$id = $url;
		}
		$data['content'] = $this->Mdl_main->documentation_get($id);
		$this->page('documentation', $data);
	}

	# альбом фотографий
	public function album($offset = 0)
	{
		$limit 			  = 32;
		$offset 	 	  = $offset > 0 ? (($offset - 1) * $limit) : $offset;
		$data['query'] = $this->Mdl_main->album_get($limit, $offset);
		$num_results 	  = $this->Mdl_main->album_get_num();
		$base_url	 	  = base_url()."album/page/";
		$first_url 	      = base_url()."album";

		$this->load->library('pagination');
		$config['base_url'] 	 	= $base_url;
		$config['first_url']	 	= $first_url;
		$config['total_rows'] 	 	= $num_results;
		$config['per_page'] 		= $limit;
		$config['use_page_numbers'] = TRUE;
   		$config['next_link'] 	 	= '';
		$config['prev_link'] 	 	= '';
		$config['first_tag_open'] 	= '<li>';
		$config['first_tag_close'] 	= '</li>';
		$config['last_tag_open'] 	= '<li>';
		$config['last_tag_close'] 	= '</li>';
		$config['num_tag_open'] 	= '<li>';
		$config['num_tag_close'] 	= '</li>';
		$config['cur_tag_open']  	= '<li class="active"><a>';
		$config['cur_tag_close'] 	= '</a></li>';

		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$this->page('album', $data);
	}

	# новости / маршруты
	public function articles($offset = 0)
	{
		$url 		 	  = $this->uri->segment(1);
		$query 		 	  = $this->Mdl_main->category_get($url);
		$limit 			  = 5;
		$offset 	 	  = $offset > 0 ? (($offset - 1) * $limit) : $offset;
		$data['articles'] = $this->Mdl_main->articles_get($limit, $offset, $query['id']);
		$num_results 	  = $this->Mdl_main->articles_get_num($query['id']);
		$base_url	 	  = base_url().$query['url']."/page/";
		$first_url 	      = base_url().$query['url'];

		$this->load->library('pagination');
		$config['base_url'] 	 	= $base_url;
		$config['first_url']	 	= $first_url;
		$config['total_rows'] 	 	= $num_results;
		$config['per_page'] 		= $limit;
		$config['use_page_numbers'] = TRUE;
   		$config['next_link'] 	 	= '';
		$config['prev_link'] 	 	= '';
		$config['first_tag_open'] 	= '<li>';
		$config['first_tag_close'] 	= '</li>';
		$config['last_tag_open'] 	= '<li>';
		$config['last_tag_close'] 	= '</li>';
		$config['num_tag_open'] 	= '<li>';
		$config['num_tag_close'] 	= '</li>';
		$config['cur_tag_open']  	= '<li class="active"><a>';
		$config['cur_tag_close'] 	= '</a></li>';

		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$this->page('articles', $data);
	}

	# статья одна
	public function article($id)
	{
		$query		    = $this->Mdl_main->category_get($this->uri->segment(1));
		$data['row'] 	= $this->Mdl_main->article_get($id, $query['id']);
		$data['images'] = $this->Mdl_main->files_get(1, $id);
		$data['files']  = $this->Mdl_main->files_get(0, $id);
		$this->page('article', $data);
	}

}
