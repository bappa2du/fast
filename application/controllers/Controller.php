<?php namespace App\controllers;
use CI_Controller;
use Illuminate\Database\Capsule\Manager as Capsule;
class Controller extends CI_Controller
{

	public function __construct()
	{
		$capsule = new Capsule;

		$capsule->addConnection([
			'driver'    => 'mysqli',
			'host'      => 'localhost',
			'database'  => '',
			'username'  => 'root',
			'password'  => '',
			'charset'   => 'utf8',
			'collation' => 'utf8_unicode_ci',
			'prefix'    => '',
			]);
		$capsule->bootEloquent();
	}

	public function json_response($output)
	{
		header('Content-type: application/json');
		echo json_encode($output);
	}

}