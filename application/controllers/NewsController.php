<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class NewsController extends CI_Controller {
    public function __construct() {
        parent::__construct();

        $this->load->model('news');
        $this->load->helper('image_handle_helper');
    }

    public function index()
    {
        $data = array();

        $data['news'] = !empty($this->news->select()) ? $this->news->select() : array();
        
        $this->load->view('admin/index/index', $data);
    }

    public function add()
    {
        $this->form_validation->set_rules('title', 'Title', 'trim|required');
        $this->form_validation->set_rules('text', 'Text', 'trim|required');
        $this->form_validation->set_rules('date', 'Date', 'trim|required');
        $this->form_validation->set_rules('status', 'Status', 'trim|required');
        
        $data['file_error'] = '';

        if ($this->form_validation->run() == false || image_validation($_FILES, TRUE)) {
            if (image_validation($_FILES, TRUE)) {
                $data['file_error'] = 'The Thumbnail field cannot be empty or wrong file extension (only jpg/png/gif allowed).';
            }
            $this->load->view('admin/news/add', $data);
        } else {

            if (isset($_FILES['thumbnail']['name'])) {
                $_FILES['thumbnail']['name'] = time() . '_' . $_FILES['thumbnail']['name'];
            }

            $data = array(
                'title'     => stripslashes(htmlspecialchars($this->input->post('title'))),
                'text'      => stripslashes(htmlspecialchars($this->input->post('text'))),
                'date'      => stripslashes(htmlspecialchars($this->input->post('date'))),
                'status'    => $this->input->post('status'),
                'thumbnail' => isset($_FILES['thumbnail']['name']) ? $_FILES['thumbnail']['name'] : ''
            );

            $result = $this->news->insert($data);

            $thumbnail_config = array(
                'upload_path'   => $this->config->item('assets_dir'),
                'allowed_types' => $this->config->item('formats')
            );

            $this->load->library('upload', $thumbnail_config);
            if ($this->upload->do_upload('thumbnail')) {
                $image_data = $this->upload->data();
                $config = $this->config->item('thumbnails');
                
                $this->load->library('image_lib');
                foreach ($config as  $value) {
                    $this->image_lib->clear();
                    $value['source_image'] = $image_data['full_path'];
                    $this->image_lib->initialize($value);
                    $this->image_lib->resize();
                }
            }

            if ($result == true) {
                $success_data = array(
                    'success_message' => 'News is added successfully!'
                );
                $this->load->view('admin/news/add', $success_data);
            } else {
                $success_data = array(
                    'success_message' => 'Server Error!'
                );
                $this->load->view('admin/news/add', $success_data);
            }
        }
    }

    public function edit($id)
    {
        $params = array(
            'id'     => $id,
            'status' => 'active'
        );

        $current_data['current_news'] = !empty($this->news->select($params)) ? $this->news->select($params) : array();

        $current_data['current_news'] = isset($current_data['current_news'][0]) ? $current_data['current_news'][0] : array();

        $this->form_validation->set_rules('title', 'Title', 'trim|required');
        $this->form_validation->set_rules('text', 'Text', 'trim|required');
        $this->form_validation->set_rules('date', 'Date', 'trim|required');
        $this->form_validation->set_rules('status', 'Status', 'trim|required');

        if ($this->form_validation->run() == false || image_validation($_FILES)) {
            if (image_validation($_FILES)) {
                $current_data['file_error'] = 'The Thumbnail extension is wrong (only jpg/png/gif allowed).';
            }
            $this->load->view('admin/news/edit', $current_data);
        } else {
            $news = array();

            if (!empty($current_data['current_news'])) {
                $news = $current_data['current_news'];
            }

            if (isset($_FILES['thumbnail']['name']) && $_FILES['thumbnail']['name'] != '') {
                $_FILES['thumbnail']['name'] = time() . '_' . $_FILES['thumbnail']['name'];

                if (!empty($news)) {
                    delete_thumbnails($news);   
                }
            }
            
            $data = array(
                'title'     => stripslashes(htmlspecialchars($this->input->post('title'))),
                'text'      => stripslashes(htmlspecialchars($this->input->post('text'))),
                'date'      => stripslashes(htmlspecialchars($this->input->post('date'))),
                'status'    => $this->input->post('status'),
                'thumbnail' => isset($_FILES['thumbnail']['name']) && $_FILES['thumbnail']['name'] != '' ? $_FILES['thumbnail']['name'] : $news->thumbnail
            );

            $result = $this->news->update($id, $data);

            $thumbnail_config = array(
                'upload_path'   => $this->config->item('assets_dir'),
                'allowed_types' => $this->config->item('formats')
            );

            $this->load->library('upload', $thumbnail_config);
            if ($this->upload->do_upload('thumbnail')) {
                $image_data = $this->upload->data();
                $config = $this->config->item('thumbnails');
                
                $this->load->library('image_lib');
                foreach ($config as  $value) {
                    $this->image_lib->clear();
                    $value['source_image'] = $image_data['full_path'];
                    $this->image_lib->initialize($value);
                    $this->image_lib->resize();
                }
            }

            if ($result == true) {

                $current_data['current_news'] = !empty($this->news->select($params)) ? $this->news->select($params) : array();

                $current_data['current_news'] = isset($current_data['current_news'][0]) ? $current_data['current_news'][0] : array();

                $success_data = array(
                    'current_news'    => $current_data['current_news'],
                    'success_message' => 'News is updated successfully!'
                );
                $this->load->view('admin/news/edit', $success_data);
            } else {
                $current_data['current_news'] = !empty($this->news->select($params)) ? $this->news->select($params) : array();

                $current_data['current_news'] = isset($current_data['current_news'][0]) ? $current_data['current_news'][0] : array();

                $success_data = array(
                    'current_news'    => $current_data['current_news'],
                    'success_message' => 'Same data or no matching ID'
                );
                $this->load->view('admin/news/edit', $success_data);
            }
        }
    }

    public function delete($id)
    {
        $params = array(
            'id'      => $id
        );
        $current_news = !empty($this->news->select($params)) ? $this->news->select($params) : array();
        $current_news = isset($current_news[0]) ? $current_news[0] : '';

        if ($current_news != '') {
            delete_thumbnails($current_news);
        }

        $this->news->delete($id);
        redirect('/admin', 'refresh');
    }
}
