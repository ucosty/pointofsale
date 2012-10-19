<?php

	class AdminController
	{
		public function index()
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

	}

?>