<?php
namespace app\index\controller;

use think\Controller;
use think\Cookie;

class Index extends Controller
{
    public function index()
    {
    	if(cookie::has('username'))
    		return $this->fetch();
    	else
    	{
    		$this->error('Please login first');
    		$this->redirect(url('login/index'));
    	}
    		
    	

    }   
}