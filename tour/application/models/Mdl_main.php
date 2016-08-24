<?php
class Mdl_main extends CI_Model {

	function __construct() {
		parent::__construct();
	}

#===================== ARTICLE =====================#

	# статьи
	public function articles_get($limit, $offset, $category)
	{
		$this->db->select('id_article, title_article, content_article, date_public_article, date_event_article');
		$this->db->where('id_category', $category);
		$this->db->limit($limit, $offset);
		$this->db->order_by('id_article', 'DESC');
		$query = $this->db->get('articles')->result_array();

		$var = array();
		foreach($query as $row):
			$var[] = array
			(
				'id_article'	 	  => $row['id_article'],
				'title_article'   	  => $row['title_article'],
				'content_article' 	  => $this->article_convert($row['content_article']),
				'date_public_article' => $row['date_public_article'],
				'date_event_article'  => $row['date_event_article']
			);
		endforeach;
		return $var;
	}

	# количество статей
	public function articles_get_num($category)
	{
		$this->db->select('id_article');
		$this->db->where('id_category', $category);
		$query = $this->db->count_all_results('articles');
		return $query;
	}

	# выбираем альбом
	public function album_get($limit, $offset)
	{
		$this->db->select('id_file, name_file, ext_file, description_file');
		$this->db->where('type_file', 1);
		$this->db->where('id_article IS NOT NULL', null, false);
		$this->db->limit($limit, $offset);
		$this->db->order_by('id_file', 'DESC');
		$query = $this->db->get('files')->result_array();

		$var = array();
		foreach($query as $row):
			$var[] = array
			(
				'id_file'		   => $row['id_file'],
				'name_file' 	   => $row['name_file'],
				'ext_file'		   => $row['ext_file'], 
				'description_file' => $row['description_file'],
				'icon_file'		   => $this->files_icon($row['ext_file'])
			);

		endforeach;
		return $var;
	}

	# количество фото в альбоме
	public function album_get_num()
	{
		$this->db->select('id_file');
		$this->db->where('type_file', 1);
		$this->db->where('id_article IS NOT NULL', null, false);
		$query = $this->db->count_all_results('files');
		return $query;		
	}

	# статья
	public function article_get($id, $category)
	{
		$this->db->select('id_article, title_article, content_article, date_public_article, date_event_article');
		$this->db->where('id_category', $category);
		$query = $this->db->get_where('articles', array('id_article' => $id));
		if($query->num_rows() > 0)
		{
			return $query->row();
		} else {
			show_404();
		}
	}

	# последние 5 статей
	public function article_news_get($id)
	{
		$this->db->select('id_article, title_article, date_public_article, date_event_article');
		$this->db->where('id_category', $id);
		$this->db->limit(5,0);
		$this->db->order_by('id_article', 'DESC');
		$query = $this->db->get('articles')->result_array();
		return $query;
	}

	# сокарщение контента
	private function article_convert($content)
	{
		$content = strip_tags($content);
		$content = mb_substr($content, 0, 280);
		$content = rtrim($content, "!,.-");
		$content = mb_substr($content, 0, strrpos($content, ' '));
		return $content."… ";
	}


#===================== CATEGORY =====================#

	# категории
	public function category_get($url)
	{
		$this->db->select('id_category, url_category');
		$query = $this->db->get_where('category', array('url_category' => $url));
		if($query->num_rows() > 0)
		{
			$row = $query->row();
			$data['id']  = $row->id_category;
			$data['url'] = $row->url_category;
		} else {
			$data['id']  = 1;
			$data['url'] = 'news';
		}
		return $data;
	}

	# выбираем документацию
	public function documentation_get($url)
	{
		$this->db->select('content_category');
		$this->db->where('url_category', $url);
		$query = $this->db->get('category');
		if($query->num_rows() > 0)
		{
			return $query->row()->content_category;
		} else {
			show_404();
		}
	}

#===================== FILES =====================#

	# выбор файлов
	public function files_get($type, $id = false)
	{
		$this->db->select('id_file, name_file, ext_file, description_file');
		$this->db->where('type_file', $type);
		$this->db->where('id_article IS NOT NULL', null, false);
		$this->db->order_by('id_file', 'DESC');
		
		if($id === false)
		{
			$query = $this->db->get('files')->result_array();
		} else {
			$query = $this->db->get_where('files', array('id_article' => $id))->result_array();
		}

		$var = array();
		foreach($query as $row):
			$var[] = array
			(
				'id_file'		   => $row['id_file'],
				'name_file' 	   => $row['name_file'],
				'ext_file'		   => $row['ext_file'], 
				'description_file' => $row['description_file'],
				'icon_file'		   => $this->files_icon($row['ext_file'])
			);

		endforeach;
		return $var;
	}

	# иконки документов
	public function files_icon($data)
	{
		switch ($data) 
		{
			case '.jpg':
				$file = 'fa fa-file-image-o';
				break;
			case '.jpeg':
				$file = 'fa fa-file-image-o';
				break;
			case '.png':
				$file = 'fa fa-file-image-o';
				break;
			case '.gif':
				$file = 'fa fa-file-image-o';
				break;
			case '.doc':
				$file = 'fa-file-word-o';
				break;
			case '.docx':
				$file = 'fa-file-word-o';
				break;
			case '.xls':
				$file = 'fa-file-excel-o';
				break;
			case '.xlsx':
				$file = 'fa-file-excel-o';
				break;
			case '.xml':
				$file = 'fa-file-o';
				break;
			case '.pdf':
				$file = 'fa-file-pdf-o';
				break;
			case '.txt':
				$file = 'fa-file-text-o';
				break;
			case '.zip':
				$file = 'fa-file-archive-o';
				break;
			case '.rar':
				$file = 'fa-file-archive-o';
				break;
			default:		
				$file = 'fa-file-o';
				break;
		}
		return $file;
	}

}