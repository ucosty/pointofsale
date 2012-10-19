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

		public function show()
		{
			$product = Product::find(Params::id());

			$product_vars['name'] = $product->name;
			$product_vars['cost'] = $product->cost / 100;
			$product_vars['image'] = $product->image;

			Templates::ActionTemplate(array("product" => $product_vars));
		}

		public function update()
		{
			if($_SERVER['REQUEST_METHOD'] == "POST")
			{
				$product = Product::find($_POST['id']);
				$product->name = $_POST['name'];
				$product->cost = $_POST['cost'] * 100;
				$product->image = $_POST['image'];

				$product->save();
			}
		}

		public function delete()
		{
			if($_SERVER['REQUEST_METHOD'] == "POST")
			{
				$product = Product::find_by_id($_POST['id']);
				$product->delete();	
			}
		}

		public function image()
		{
			$uploader = new qqFileUploader(array(), 1024000);

			// Call handleUpload() with the name of the folder, relative to PHP's getcwd()
			$result = $uploader->handleUpload('public/uploads/');

			// to pass data through iframe you will need to encode all html tags
			echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);
		}
	}

?>