<?php
	namespace App;
	class Db
	{
			protected $link;
			protected $query;
			protected $text;
			
			public function __construct($host,$db_name){
				$this->link = mysqli_connect($host, 'root', '', $db_name);
				return $this;
			}
			//действие для 1-го задания
			public function getUserData($field){
				if(isset($_POST['text_submit'])){
							$this->text = $this->filterSQLInjection($_POST['text_submit']);
							$this->query = "SELECT user.email as email, user.id as user_id, user_info.name as user_name, user_info.sname as user_sname FROM user LEFT JOIN user_info ON user.id=user_info.user_id WHERE $field='$this->text'";
							echo json_encode($this->getOne());
				}
			}
			//действие для 2-го задания
			public function getUsersData($field){
					if(isset($_POST['text_keyup'])){
							$this->text = $this->filterSQLInjection($_POST['text_keyup']);
							$this->query = "SELECT user.email as email, user.id as user_id, user_info.name as user_name, user_info.sname as user_sname FROM user LEFT JOIN user_info ON user.id=user_info.user_id WHERE $field LIKE '$this->text%'";
							echo json_encode($this->getAll());
					}
			}
			
			private function getOne(){
				$result = mysqli_query($this->link, $this->query) or die(mysqli_error($this->link));
				$user = mysqli_fetch_assoc($result);
				if($user){
					$user['status'] = 'success';
						return $user;
					}
				$user['status'] = 'error';
				$user['text'] = "Записей для $this->text не обнаружено";
				return $user;
			}
			
			private function getAll(){
				$result = mysqli_query($this->link, $this->query) or die(mysqli_error($this->link));
				for($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);
				if($data){
					$data['status'] = 'success';
					return $data;
				}
				$data['status'] = 'error';
				$data ['text'] = "Записей для $this->text не обнаружено";
				return $data;
			}
			
			private function filterSQLInjection($str){
				return htmlspecialchars(mysqli_real_escape_string($this->link,$str));
			}
			
	
			
	}

?>