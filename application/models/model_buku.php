<?php  
class model_buku extends CI_Model{
	var $table = 'buku';

	public function tambah($data){
		$this ->db-> insert($this->table,$data);
		return $this->db->insert_id();
	}
	public function get_all_books(){
		$this->db->from('buku');
		$query = $this->db->get();
		return $query->result();
	}
	public function get_by_id($id){
		$this->db->from($this->table);
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->row();
	}
	public function book_update($where, $data){
		$this->db->update($this->table,$data,$where);
		return $this->db->affected_rows();
	}
}

