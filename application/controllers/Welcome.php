<?php
use App\controllers\Controller;
use App\models\User;
class Welcome extends Controller {

	public function index()
	{
		/**
		 * Get all user by eloquent model
		 * json_respone use for json output
		 * $users = $this->db->get('users')->result(); 
		 * codeigniter like query also available 
		 * just autoload database library in config/autoload.php
		 */
		// $users = User::all();
		// $users = $this->db->get('users')->result(); 
		// $this->json_response($users);
		$this->load->view('welcome_message');
	}
}
