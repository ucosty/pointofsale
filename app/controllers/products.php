<?php

	class ProductsController
	{
		public function index()
		{
			// Retrieve all products
			$products = Product::all();

			Templates::ActionTemplate(array("products" => $products));
		}

		public function create()
		{
			if($_SERVER['REQUEST_METHOD'] == "POST")
			{
				$product = new Product();

				$product->name = $_POST['Name'];
				$product->cost = $_POST['Cost'] * 100;
				$product->image = $_POST['Image'];

				$product->save();
			}


			// Retrieve all products
			$products = Product::all();
			Templates::ActionTemplate(array("products" => $products));
		}

		public function delete()
		{
			$product = Product::find_by_id($_POST['id']);
			$product->delete();
		}
	}

?>