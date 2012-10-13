<?php

	function format_currency($cents)
	{
		return "$" . number_format($cents / 100, 2);
	}

?>