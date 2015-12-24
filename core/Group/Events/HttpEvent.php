<?php

namespace Group\Events;

class HttpEvent extends \Event
{	
	protected $request;

    protected $response;

    public function __construct(\Request $request = null, \Response $response = null)
    {	
    	$this -> request = $request;
        $this -> response = $response;
    }

    public function getResponse()
    {
        return $this -> response;
    }

    public function getRequest()
    {
        return $this -> request;
    }
}
