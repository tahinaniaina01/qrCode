<?php

namespace App\Controllers;

class Test extends BaseController
{
    public function welcome(): string
    {	
        return view('welcome');
    }
	public function teste():string
	{
		return view('teste');
	}
	public function recoit():string
	{
		return view('recoit');
	}
}
