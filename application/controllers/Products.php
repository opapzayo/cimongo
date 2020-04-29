<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Products extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('product_model');
        $this->load->model('categories_model');
    }
    public function index()
    {
        $search = $this->input->get('search');
        $name_search = $this->input->get('name_search');
        $cate_search = $this->input->get('cate_search');
        $condition = [];
        if (!empty($search)) {
            if (!empty($name_search)) {
                $condition['p_name'] = array('$regex' => $name_search);
            }
            if (!empty($cate_search)) {
                $condition['cate_id'] = $this->mongo_db->create_document_id($cate_search);
            }
        }
        $data['search'] = $search;
        $data['name_search'] = $name_search;
        $data['cate_search'] = $cate_search;

        $data['categories'] = $this->categories_model->findAll();
        $data['products'] = $this->product_model->findAll($condition);

        $this->load->view('layout/head', $data);
        $this->load->view('layout/header');
        $this->load->view('products/content');
        $this->load->view('layout/footer');
        $this->load->view('layout/foot');
    }

    public function create()
    {
        $data['categories'] = $this->categories_model->findAll();

        $this->load->view('layout/head', $data);
        $this->load->view('layout/header');
        $this->load->view('products/create/content');
        $this->load->view('layout/footer');
        $this->load->view('layout/foot');
    }
    public function save()
    {
        $p_name = $this->input->post('p_name');
        $priceEach = $this->input->post('priceEach');
        $cate_id = $this->input->post('cate_id');

        $data = array(
            "p_name" =>  $p_name,
            "priceEach" => $priceEach,
            "cate_id" =>  $this->mongo_db->create_document_id($cate_id)
        );

        $id = $this->product_model->insert($data);

        if (!empty($id)) {
            $this->session->set_flashdata('success-msg', 'Product Added');
            redirect('products');
        } else {
            echo "error";
        }
    }
}
