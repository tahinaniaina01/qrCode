<?php

namespace App\Controllers;

class Test extends BaseController
{
    public function welcome(): string
    {	
        return view('recoit');
    }
}
