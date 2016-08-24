<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tour_control extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mdl_control');
	}

	# панель управления
	public function manage()
	{
		$this->load->view('manage/templates/header');
		$data['title'] = 'Панель управления';
		$this->load->view('manage/index', $data);
		$this->load->view('manage/templates/footer');	
	}

	# проверка формы
	public function users_auth_form() 
	{
    	$this->form_validation->set_rules('username', 'Логин', 'required|trim|callback_users_auth_check');
    	$this->form_validation->set_rules('password', 'Пароль', 'required|trim');

    	if ($this->form_validation->run() == false)
    	{
			$this->session->set_flashdata('error', validation_errors());
			redirect($_SERVER['HTTP_REFERER']);
  		} else {
        	$this->users_auth_valid();
    	}
	}

	# callback проверка
	public function users_auth_check() {
		if($this->users_auth_valid() === true) 
		{
			$data = array('login' => $this->input->post('username'));
			$this->session->set_userdata($data);
			redirect($_SERVER['HTTP_REFERER']);
		} else {
			$this->form_validation->set_message('users_auth_check', 'Неправильный логин/пароль');
			return false;
		}
	}

	# проверка в БД
	private function users_auth_valid()
	{
		$data = array(
			'username' => $this->input->post('username'),
			'password' => md5($this->input->post('password'))
		);

		$query = $this->Mdl_control->users_get($data);
		if($query > 0) {
			return true;
		}
	}

	# выход
	public function users_logout()
	{
		$this->session->sess_destroy();
		redirect($_SERVER['HTTP_REFERER']);
	}

}