<?php
namespace Mini\Controller;

use Mini\Libs\Response;

class ErrorController
{
	public function index()
	{
		$Response = new Response();
		$Response->send(404);
	}
}
