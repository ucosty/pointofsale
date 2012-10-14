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

		public function products()
		{
			// Retrieve all products
			$products = Product::all();

			Templates::ActionTemplate(array("products" => $products));
		}

		public function createproduct()
		{
			$product = new Product();

			$product->name = $_POST['Name'];
			$product->cost = $_POST['Cost'] * 100;
			$product->image = $_POST['Image'];

			$product->save();

			// Retrieve all products
			$products = Product::all();
			Templates::ActionTemplate(array("products" => $products));
		}

		public function removeproduct()
		{
			$product = Product::find_by_id($_POST['id']);
			$product->delete();
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