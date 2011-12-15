<?php defined('SYSPATH') or die('No direct access allowed.');

abstract class Auth extends Kohana_Auth { 
    
    
	/**
	 * Singleton pattern
	 *
	 * @return Auth
	 */
	public static function instance()
	{
		if ( ! isset(Auth::$_instance))
		{
			// Load the configuration for this type
			$config = Kohana::$config->load('auth'); // alterado para v3.2
            //Kohana::$config->load('dot.notation')
            //Kohana::$config->load('dot')->notation

			if ( ! $type = $config->get('driver'))
			{
				$type = 'file';
			}

			// Set the session class name
			$class = 'Auth_'.ucfirst($type);

			// Create a new session instance
			Auth::$_instance = new $class($config);
		}

		return Auth::$_instance;
	}    
}