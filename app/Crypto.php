<?php

namespace App;


class Crypto
{
    protected $td;
    protected $iv;
    protected $ks;
    protected $key;
    protected $encrypted;
    protected $decrypted;

    public function __construct($pkey = 'Lam@823P#dala') {

        /* Open the cipher */
        $this->td = mcrypt_module_open('rijndael-128', '', 'ecb', '');
        srand();
        $this->iv = str_random(mcrypt_enc_get_iv_size($this->td));
        $this->ks = mcrypt_enc_get_key_size($this->td);

        $this->key = $pkey;

        /* Intialize encryption */
        mcrypt_generic_init($this->td, $this->key, $this->iv);

    }


    public function encrypt($pvalor) {
        // Encrypt data
        if ($pvalor == "") $pvalor = chr(0);
        return base64_encode(@mcrypt_generic($this->td, $pvalor));
    }

    public function decrypt($pvalor) {
        // Decrypt encrypted string
        if (base64_decode($pvalor) != "") {
            $actrl = array(chr(0), chr(1), chr(2), chr(3), chr(4), chr(5), chr(6), chr(7), chr(8), chr(9), chr(10), chr(11), chr(12), chr(13), chr(14), chr(15), chr(16), chr(17), chr(18), chr(19));
            $ret = str_replace($actrl, "", @mdecrypt_generic($this->td, base64_decode($pvalor)));
            return $ret;
        } else {
            return "";
        }
    }

    public function getKey() {
        return $this->key;
    }
}