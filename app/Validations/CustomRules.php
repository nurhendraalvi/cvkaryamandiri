<?php

	namespace App\Validations;

	class CustomRules{
        //salah satu contoh sederhana untuk membuat fungsi custom rules
        function cek_nama(string $str, string &$error = null): bool{
            //jika awal hurun adalah numerik, maka akan dikembalikan false, jika bukan numerik dikembalikan true
            if(is_numeric($str[0])){ 
                return false;
            }else{
                return true;
            }
        }

	}
?>