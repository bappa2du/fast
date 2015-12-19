<?php
use App\controllers\Controller;

class Welcome extends Controller {

	public function index()
	{
		$this->load->view('welcome_message');
	}
}
