<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Kontak extends REST_Controller {

    function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->database();
    }

    //Menampilkan data kontak
    function index_get()
    {
        $id = $this->get('id');
        if ($id == '') {
            $kontak = $this->db->get('user')->result();
        } else {
            $this->db->where('id', $id);
            $kontak = $this->db->get('user')->result();
        }
        $this->response($kontak, 200);
    }

    function index_post()
    {
        $data = array(
            'id' => "",
            'username' => $this->post('username'),
            'email' => $this->post('email'),
            'no_telp' => $this->post('no_telp'),
            'password' => $this->post('password'),
            'status' => $this->post('status'),
            'image' => $this->post('image'),
            'log' => $this->post('log')
        );
        $insert = $this->db->insert('user', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
    function index_put()
    {
        $id = $this->put('id');
        $data = array(
            'id' => $this->put('id'),
            'username' => $this->put('username'),
            'email' => $this->put('email'),
            'no_telp' => $this->put('no_telp'),
            'password' => $this->put('password'),
            'status' => $this->put('status'),
            'image' => $this->put('image'),
            'log' => $this->put('log')
        );
        $this->db->where('id', $id);
        $update = $this->db->update('user', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
    function index_delete()
    {
        $id = $this->delete('id');
        $this->db->where('id', $id);
        $delete = $this->db->delete('user');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
}
?>