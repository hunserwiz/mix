<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

	function alert($data, $die = false) {
		echo "<pre>";
	    print_r($data);
	    echo "</pre>";
	    if ($die)
	    die();
	}

}
