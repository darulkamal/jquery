<?php  
class buku extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('model_buku');
	}

	public function index(){
		$data['buku'] = $this->model_buku->get_all_books();
		$this -> load -> view('buku_view',$data);
	}
	public function tambah(){
		$data  = array(
			'isbn'=>$this ->input->post('isbn'),
			'judul'=>$this ->input->post('judul'),
			'pengarang'=>$this ->input->post('pengarang'),

		);
		$insert = $this ->model_buku-> tambah($data);
		echo json_encode(array("status" => true));
	}
	public function ajax_edit($id){
		$data = $this->model_buku->get_by_id($id);
		echo json_encode($data);
	}
	public function book_update(){
		$data = array(
			'isbn'=>$this ->input->post('isbn'),
			'judul'=>$this ->input->post('judul'),
			'pengarang'=>$this ->input->post('pengarang'),

		);
		$this->model_buku->book_update(array('id'-> $this-> input->post('id')),$data);
		echo json_encode(array("status" => TRUE));
	}
}




?>