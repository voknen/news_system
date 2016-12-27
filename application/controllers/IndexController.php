<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class IndexController extends CI_Controller {
    public function __construct() {
        parent::__construct();

        $this->load->model('news');
        $this->load->helper('image_handle_helper');
    }

    public function index()
    {
        $data = array();

        $params = array(
            'limit'  => 10,
            'status' => 'active'
        );

        $data['news'] = !empty($this->news->select($params)) ? $this->news->select($params) : array();
        
        $this->load->view('index/index', $data);
    }

    public function view($id)
    {
        $data = array();

        $params = array(
            'id'     => $id,
            'status' => 'active'
        );

        $data['news'] = !empty($this->news->select($params)) ? $this->news->select($params) : array();

        $this->load->view('news/view', $data);
    }
}
