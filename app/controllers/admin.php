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
	}

?>