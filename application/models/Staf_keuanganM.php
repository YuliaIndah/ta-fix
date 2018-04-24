<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Staf_keuanganM extends CI_Model{
	function __construct(){
		parent:: __construct();
		$this->load->database();
	}

}