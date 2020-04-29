<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Categories extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('categories_model');
		$this->load->model('product_model');
	}

	public function index($categoriesId)
	{
		$data['categories'] = $this->categories_model->findAll();
		$condition = array(
			'cate_id' => $this->mongo_db->create_document_id($categoriesId)
		);
		$data['product'] = $this->product_model->findAll($condition);
		$this->load->view('layout/head');
		$this->load->view('layout/header');
		$this->load->view('layout/left_menu', $data);
		$this->load->view('categories/content');
		$this->load->view('layout/footer');
		$this->load->view('layout/foot');
	}
}
