<?php

	class AdminController
	{
		public function index()
		{

		}

		public function sales()
		{
			// Retrieve all sales
			$sales = Sale::all();

			Templates::ActionTemplate(array("sales" => $sales));
		}

		public function removeproduct()
		{
		}

		public function newproductimage()
		{
			$uploader = new qqFileUploader(array(), 1024000);

			// Call handleUpload() with the name of the folder, relative to PHP's getcwd()
			$result = $uploader->handleUpload('public/uploads/');

			// to pass data through iframe you will need to encode all html tags
			echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);
		}

		public function users()
		{
			$users = User::all();
			Templates::ActionTemplate(array("users" => $users));
		}

		public function adduser()
		{
			$user = new User();
			$user->username = $_POST['username'];
			$user->password = Hash::create($_POST['password']);
			$user->save();
		}
	}

?>