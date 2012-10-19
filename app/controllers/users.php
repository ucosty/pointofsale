<?php

	class UsersController
	{
		public function index()
		{
			$users = User::all();
			Templates::ActionTemplate(array("users" => $users));
		}

		public function create()
		{
			$user = new User();
			$user->username = $_POST['username'];
			$user->password = Hash::create($_POST['password']);
			$user->save();
		}

		public function login()
		{
			if($_SERVER['REQUEST_METHOD'] == "POST")
			{
				$user = User::find_by_username($_POST['username']);

				if(isset($user) && Hash::verify($_POST['password'], $user->password))
				{
					$_SESSION['userid'] = $user->id;
					$_SESSION['username'] = $user->username;

					if($user->is_admin) {
						$_SESSION['admin'] = true;
					}

					session_write_close();
					
					header("Location: " . Templates::BaseURL());
				}

				Templates::ActionTemplate(array("error" => "Invalid username or password."));
			}

		}

		public function logout()
		{
			session_unset();
			header("Location: " . Templates::BaseURL());
		}
	}

?>