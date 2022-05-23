<?php
namespace App\Controllers;

class Snap extends BaseController
{
    public function tes(){
        echo view('Snap/tes');
    }

    public function proses(){
        echo view('Snap/checkout-process');
    }

}