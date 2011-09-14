<?php

namespace mako\crypto
{
	use \Exception;

	/**
	* OpenSSL cryptography adapter.
	*
	* @author     Frederic G. Østby
	* @copyright  (c) 2008-2011 Frederic G. Østby
	* @license    http://www.makoframework.com/license
	*/
	
	class OpenSSL extends \mako\crypto\Adapter
	{
		//---------------------------------------------
		// Class variables
		//---------------------------------------------
		
		/**
		* Key used to encrypt/decrypt data.
		*/
		
		protected $key;
		
		/**
		* The cipher method to use for encryption.
		*/
		
		protected $cipher;
		
		//---------------------------------------------
		// Class constructor, destructor etc ...
		//---------------------------------------------
		
		/**
		* Constructor.
		*
		* @access  public
		* @param   array   Configuration
		*/
		
		public function __construct(array $config)
		{
			if(extension_loaded('openssl') === false)
			{
				throw new Exception(__CLASS__ . ": OpenSSL is not available.");
			}
			
			$this->key      = $config['key'];
			$this->cipher   = $config['cipher'];
		}
		
		//---------------------------------------------
		// Class methods
		//---------------------------------------------
		
		/**
		* Encrypts data.
		*
		* @access  public
		* @param   string  String to encrypt
		* @return  string
		*/
		
		public function encrypt($string)
		{
			return openssl_encrypt($string, $this->cipher, $this->key);
		}
		
		/**
		* Decrypts data.
		*
		* @access  public
		* @param   string  String to decrypt
		* @return  string
		*/
		
		public function decrypt($string)
		{
			return openssl_decrypt($string, $this->cipher, $this->key);
		}
	}
}

/** -------------------- End of file --------------------**/