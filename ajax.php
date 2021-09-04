<?php
	require_once 'App/Db.php';
	use App\Db;
	//echo (new Db('test.ru', 'test'))->getUsersData('email');
	function start(){
	    (new Db('test.ru', 'test'))->getUserData('email');
		(new Db('test.ru', 'test'))->getUsersData('email');	
	}
	start();

	

?>