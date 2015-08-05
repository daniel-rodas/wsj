<?php
/**
 * Fuel is a fast, lightweight, community driven PHP5 framework.
 *
 * @package    Fuel
 * @version    1.7
 * @author     Fuel Development Team
 * @license    MIT License
 * @copyright  2010 - 2014 Fuel Development Team
 * @link       http://fuelphp.com
 */

/**
 * NOTICE:
 *
 * If you need to make modifications to the default configuration, copy
 * this file to your app/config folder, and make them in there.
 *
 * This will allow you to upgrade fuel without losing your custom config.
 */

return array(

	/**
	 * link_multiple_providers
	 *
	 * Can multiple providers be attached to one user account
	 */
	'link_multiple_providers' => true,

	/**
	 * auto_registration
	 *
	 * If true, a login via a provider will automatically create a dummy
	 * local user account with a random password, if a nickname and an
	 * email address is present
	 */
	'auto_registration' => false,

	/**
	 * default_group
	 *
	 * Group id to be assigned to newly created users
	 */
	'default_group' => 1,

	/**
	 * debug
	 *
	 * Uncomment if you would like to view debug messages
	 */
	'debug' => false,

	/**
	 * A random string used for signing of auth response.
	 *
	 * You HAVE to set this value in your application config file!
	 */
	'security_salt' => 'fjaopefojfjsofjaejfiajfjaerofjaiefjaijfajerf',
//	'security_salt' => null,

	/**
	 * Higher value, better security, slower hashing;
	 * Lower value, lower security, faster hashing.
	 */
	'security_iteration' => 300,

	/**
	 * Time limit for valid $auth response, starting from $auth response generation to validation.
	 */
	'security_timeout' => '2 minutes',

	/**
	 * Strategy
	 * Refer to individual strategy's documentation on configuration requirements.
	 */
	'Strategy' => array(

	/**
	 *   'Facebook' => array(
	 *      'app_id' => 'APP ID',
	 *      'app_secret' => 'APP_SECRET'
	 *    ),
	 */

	    'Facebook' => array(
	       'app_id' => '1552855614989647',
	       'app_secret' => 'c6ce1212294347539d603952a7c8751e',
            'scope'      => array('email', ),

	     ),


	    'Twitter' => array(
	       'key' => 'yNuYP3eEB0Jhj6kDjEaUKMCbH',
	       'secret' => 'zdDec0x53r815cQafutZLwWdtnz4bSaSfQ0eqRd4i1N699rhy8',
	     ),

	    'Google' => array(
	       'client_id' => '752840641261-ppcb013ocuf1619ktdl52m89slo9hsmg.apps.googleusercontent.com',
	       'client_secret' => '1KWLL762e-y-QbpBtERd3ljK',
//           'scope' => array('https://www.googleapis.com/auth/userinfo.profile', 'https://www.googleapis.com/auth/userinfo.email' ),
	     ),


	 ),
);
