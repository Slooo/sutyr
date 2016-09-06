<?php
class Mdl_manage extends CI_Model {

	function __construct() {
		parent::__construct();
	}

#===================== ARTICLE =====================#

	# выбираем все статьи | одну статью
	public function article_get($id = false)
	{
		if($id === false)
		{
			$this->db->select('id_article, title_article');
			$this->db->order_by('id_article', 'DESC');
			$query = $this->db->get('articles');
			return $query->result_array();
		} else {
			$query = $this->db->get_where('articles', array('id_article' => $id));
			if($query->num_rows() > 0)
			{
				return $query->row();
			} else {
				show_404();
			}
		}
	}

	# создание статьи
	public function article_create($data)
	{
		$query = $this->db->insert('articles', $data);
	}

	# обновление статьи
	public function article_update($id, $data)
	{
		$this->db->where('id_article', $id);
		$this->db->update('articles', $data);
	}

	# удаление статьи
	public function article_delete($id)
	{
		$this->db->where('id_article', $id);
		$this->db->delete('articles');
		$this->db->where('id_article', $id);
		$this->db->delete('files');
	}

#===================== CATEGORY =====================#

	# выбор категории
	public function category_get($id)
	{
		$this->db->select('name_category');
		$query = $this->db->get_where('category', array('id_category' => $id))->row();
		return $query->name_category;
	}

	# выбор категорий
	public function category_menu_get($limit, $offset)
	{
		$this->db->select('id_category, name_category, parent_category');
		$this->db->limit($limit, $offset);
		$query = $this->db->get('category');
		return $query->result_array();
	}

	# обновление документации
	public function category_documentation_update($id, $data)
	{
		$this->db->where('id_category', $id);
		$this->db->update('category', array('content_category' => $data));
	}

	# выбираем документацию
	public function documentation_get($id)
	{
		$this->db->select('f.id_file, f.name_file, f.ext_file, f.description_file, c.name_category');
		$this->db->from('files f');
		$this->db->join('category c', 'f.id_category = c.id_category');
		$this->db->where('c.id_category', $id);
		$this->db->order_by('f.id_file', 'DESC');
		$query = $this->db->get();
		
		if($query->num_rows() > 0)
		{
			$var = array();
			foreach($query->result_array() as $row):
				$var[] = array
				(
					'id_file'		=> $row['id_file'],
					'name_file' 	=> $row['description_file'],
					'url_file'		=> $row['name_file'].$row['ext_file'],
					'icon_file' 	=> $this->Mdl_main->files_icon($row['ext_file']),
				);
			endforeach;
			return json_encode(array('success' => $var, 'category' => $row['name_category']));
		} else {
			return json_encode(array('error' => 'Документации нет'));
		}
	}

#===================== FILES =====================#

	# выбираем файлы
	public function files_get($id, $type)
	{
		$this->db->select('id_file, name_file, ext_file, description_file, type_file');
		$this->db->where($type.' IS NOT NULL', null, false);
		$this->db->order_by('id_file', 'DESC');
		$query = $this->db->get_where('files', array($type => $id));

		if($query->num_rows() > 0)
		{
			$var = array();
			foreach($query->result_array() as $row):
				$var[] = array
				(
					'id_file'		   => $row['id_file'],
					'name_file'		   => $row['name_file'],
					'ext_file'		   => $row['ext_file'],
					'description_file' => $row['description_file'],
					'icon_file'		   => $this->Mdl_main->files_icon($row['ext_file']),
					'type_file'		   => $row['type_file']
				);
			endforeach;

			return json_encode(array('success' => $var));
		} else {
			return json_encode(array('error' => 'Файлов нет'));
		}
	}

	# запись загруженных файлов
	public function files_create($data)
	{
		$this->db->insert('files', $data);
	}

	# обновляем описание файлов
	public function files_update($id, $data)
	{
		$this->db->where('id_file', $id);
		$this->db->update('files', array('description_file' => $data));
	}

	# удаление файлов
	public function files_delete($id)
	{
		$this->db->where('id_file', $id);
		$this->db->delete('files');
	}

}