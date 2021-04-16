<?php

namespace App\Http\Controllers\API;

class RSA
{

    var $p;      /* Prime number #1 */
    var $q;      /* Prime number #2 */
    var $n;      /* Modulus to be used */
    var $phi; /* Totient of $n, used to find public key $e */
    var $e;      /* The public key */
    var $d;      /* The private key */
    var $char;

    public function __construct()
    {
        $this->p = $this->GeneratePrime();
        $this->q = $this->GeneratePrime();
        $this->n = $this->p * $this->q;
        $this->phi = ($this->p - 1) * ($this->q - 1);
        for ($i = 0, $j = 25; $j < 127; $j++, $i++) {
            $char[$i] = chr($j);
        }
        $this->char = $char;
    }

    public function __construct1($p, $q, $e, $d)
    {
        $this->p = $p;
        $this->q = $q;
        $this->n = $this->p * $this->q;
        $this->phi = ($this->p - 1) * ($this->q - 1);
        $this->e = $e;
        $this->d = $d;
        for ($i = 0, $j = 31; $j < 123; $j++, $i++) {
            $char[$i] = chr($j);
        }
        $char[92] = chr(32);
        $this->char = $char;
    }

    public function IsPrime($number)
    {
        if ($number < 2) { /* We don't want zero or one showing up as prime */
            return FALSE;
        }
        for ($i = 2; $i <= ($number / 2); $i++) {
            if ($number % $i == 0) { /* Modulus operator, very useful */
                return FALSE;
            }
        }
        return TRUE;
    }

    public function GeneratePrime()
    {
        $number = 0;
        while (!$this->IsPrime($number)) { /* Keep going till we get a prime number */
            $number = rand(10, 100);
        }
        return $number;
    }

    public function FindGCF($z, $phi)
    {
        return ($z % $phi) ? $this->FindGCF($phi, $z % $phi) : $phi;
    }

    public function GeneratePublicKey()
    {
        $this->e = rand(2, $this->phi);
        while ($this->FindGCF($this->e, $this->phi) != 1) { // Keep going till $e is coprime with $totient
            $this->e = rand(2, $this->phi);
        }
    }


    public function GeneratePrivateKey()
    {
        for ($d = 0; $d < $this->phi; ++$d) {
            $temp = $d * $this->e;
            if ($temp % $this->phi == 1)
                $this->d = $d;
        }
    }


    public function Encrypt($str)
    {
        $arr1 = str_split($str);
        for ($i = 0, $j = count($arr1); $i < $j; $i++) {
            $dec_array[$i] = array_search($arr1[$i], $this->char);
        }
        $dec_array = join($dec_array);
        $arr1 = str_split($dec_array, 3);
        for ($i = 0, $j = count($arr1); $i < $j; $i++) {
            $arr1[$i] = bcpowmod($arr1[$i], $this->e, $this->n);
        }
        return join($arr1);
    }

    public function Decrypt($str)
    {
        $arr1 = str_split($str, 3);
        for ($i = 0, $j = count($arr1); $i < $j; $i++) {
            $arr1[$i] = bcpowmod($arr1[$i], $this->d, $this->n);
        }
        $arr1 = join($arr1);
        $arr1 = str_split($arr1, 2);
        for ($i = 0, $j = count($arr1); $i < $j; $i++) {
            $arr1[$i] = $this->char[(int)($arr1[$i])];
        }
        return join($arr1);
    }


}
