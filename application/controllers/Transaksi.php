<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */

  public function __construct() {
    // echo "ini dijalankan terlebih sebelum fungsi lainnya";
    parent::__construct();
    $this->load->model('M_transfer');
	$this->load->model('M_label_transfer');
  }
  
	public function index()
	{
        $data = [];
        $data['transfer'] = $this->M_transfer->select_transfer();
		$data['label_transfer'] = $this->M_label_transfer->select_label_transfer();
        $this->load->view('/detail/detail',$data);	
	}

//   public function tes() {
//     $data = [];
//     $data['nama'] = 'wahyu';
//     $data['umur'] = 21;
//     // var_dump($data);
//     // var_dump($data['umur']);
//     $this->load->view('Blok/belajar_tes', $data);
//   }

//   public function detail(){
// 	$data = [];
// 	$data['transfer'] = $this->M_transfer->select();
// 	$this->load->view('Blok/detail',$data);	
//   }
}