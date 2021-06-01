<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AppModel extends CI_Model {

    public function __construct() {        
    }
    
    public function save( $name ) {
        $data = array( 'name' => $name );
        $res  = $this->db->insert( 'tasks', $data );
        return $res;
    }

    public function getAll() {
        $query  = $this->db->get('tasks');
        $result = $query->result();
        return $result;
    }

    public function getById( $id ) {
        $query  = $this->db->get_where( 'tasks', array( 'id' => $id) );
        $result = $query->result();
        return $result;
    }

    public function update( $id, $name ) {
        $this->db->set( 'name', $name );
        $this->db->where( 'id', $id );
        $result = $this->db->update('tasks');
        return $result;
    }

    public function delete( $id ) {
        $this->db->where( 'id', $id );
        $result = $this->db->delete( 'tasks' );
        return $result;
    }

}
