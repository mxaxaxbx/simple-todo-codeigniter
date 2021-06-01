<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class App extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library("session");
        $this->load->model('AppModel');
    }

    public function index() {
        $success = $this->session->flashdata('success');
        $error = $this->session->flashdata('error');
        $tasks   = $this->AppModel->getAll();

        $data = array(
            'title'   => 'Listado de Tareas',
            'success' => $success,
            'tasks'   => $tasks,
            'error'   => $error,
        );

        $this->load->view( 'app', $data );
    }

    public function new() {
        $error = $this->session->flashdata('error');
        $data  = array(
            'title' => 'Crear tarea',
            'error' => $error,
        );
        $this->load->view( 'new-task', $data );
    }

    public function create() {
        $task = $this->input->post('task');
        
        if( !$task ) {
            $this->session->set_flashdata('error', 'ingrese un nombre');
            redirect('/app/new');
        }

        $res  = $this->AppModel->save( $task );

        if( $res ) {
            $this->session->set_flashdata('success', 'tarea creada');
            redirect('/app/');

        } else {
            $this->session->set_flashdata('error', 'error al crear la tarea');
            redirect('/app/new');

        }
    }

    public function edit( $id=0 ) {
        if( !$id ) {
            $this->session->set_flashdata('error', 'ingrese un id válido');
            redirect('/app/');
        }

        $tasks   = $this->AppModel->getById( $id );
        $count_ = count($tasks);

        if( $count_ == 0 ) {
            $this->session->set_flashdata('error', 'ingrese un id válido');
            redirect('/app/');
        }

        $task = $tasks[0];
        $success = $this->session->flashdata('success');
        $error = $this->session->flashdata('error');

        $data = array(
            'title'   => 'Editar tarea',
            'success' => $success,
            'task'    => $task,
            'error'   => $error,
        );

        $this->load->view( 'edit-task', $data );

    }

    public function update() {
        $id   = $this->input->post('id');
        $name = $this->input->post('name');

        if( !$name || !$id ) {
            $this->session->set_flashdata('error', 'ingrese datos que sean válidos');
            redirect('/app/');
        }

        $res = $this->AppModel->update( $id, $name );

        if( $res ) {
            $this->session->set_flashdata('success', 'tarea guardada');
            redirect('/app/');

        } else {
            $this->session->set_flashdata('error', 'error al guardar la tarea');
            redirect('/app/edit/' . $id );

        }

    }

    public function delete( $id=0 ) {
        if( !$id ) {
            $this->session->set_flashdata('error', 'ingrese un id válido');
            redirect('/app/');
        }

        $result = $this->AppModel->delete( $id );
        
        if( $result ) {
            $this->session->set_flashdata('success', 'Se ha borrado la tarea');
            redirect('/app/');

        } else {
            $this->session->set_flashdata('error', 'ingrese un id válido');
            redirect('/app/');
        }
    }

}
