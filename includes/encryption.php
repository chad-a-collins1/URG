<?php

    class Encryption
    {
        public $td;
        // this gets called when class is instantiated
        public function __construct($key = 'MyRandomStringThatWillAlwaysBeTheSame', $iv = false, $algorithm = 'tripledes', $mode = 'ecb')
        {
            if(extension_loaded('mcrypt') === FALSE)
            {
                $prefix = (PHP_SHLIB_SUFFIX == 'dll') ? 'php_' : '';
                dl($prefix . 'mcrypt.' . PHP_SHLIB_SUFFIX) or die('The Mcrypt module could not be loaded.');
            }

            if($mode != 'ecb' && $iv === false)
            {
                /*
                the iv must remain the same from encyption to decryption and is usually
                passed into the encrypted string in some form, but not always.
                */
                die('In order to use encryption modes other then ecb, you must specify a unique and consistent initialization vector.');
            }

            // set mcrypt mode and cipher
            $this->td = mcrypt_module_open($algorithm, '', $mode, '') ;

            // Unix has better pseudo random number generator then mcrypt, so if it is available lets use it!
            //$random_seed = strstr(PHP_OS, "WIN") ? MCRYPT_RAND : MCRYPT_DEV_RANDOM;
            srand();
            $random_seed = rand();

            // if initialization vector set in constructor use it else, generate from random seed
            $iv = ($iv === false) ? mcrypt_create_iv(mcrypt_enc_get_iv_size($this->td), $random_seed) : substr($iv, 0, mcrypt_enc_get_iv_size($this->td));

            // get the expected key size based on mode and cipher
            $expected_key_size = mcrypt_enc_get_key_size($this->td);

            // we dont need to know the real key, we just need to be able to confirm a hashed version
            $key = substr(md5($key), 0, $expected_key_size);

            // initialize mcrypt library with mode/cipher, encryption key, and random initialization vector
            mcrypt_generic_init($this->td, $key, $iv);

            //$x = $this->encrypt('This is some very important data');
            //echo "One: $x<br />";
            //echo "Two: ".$this->decrypt($x)."<br />";
        }

        public function encrypt($plain_string)
        {
            /*
              encrypt string using mcrypt and then encode any special characters
              and then return the encrypted string
            */
            $Result = mcrypt_generic($this->td, $plain_string);
            $Return = base64_encode($Result);
            return $Return;
        }

        public function decrypt($encrypted_string)
        {
            /*
            remove any special characters then decrypt string using mcrypt and then trim null padding
            and then finally return the encrypted string
            */
            $encrypted_string = str_replace("%20", " ", $encrypted_string);
            $encrypted_string = str_replace(" ", "+", $encrypted_string);
            $Result = base64_decode($encrypted_string);
            $Return = mdecrypt_generic($this->td, $Result);
            return trim($Return);
        }

        public function __destruct()
        {
            // shutdown mcrypt
            mcrypt_generic_deinit($this->td);

            // close mcrypt cipher module
            mcrypt_module_close($this->td);
        }
    }

?>