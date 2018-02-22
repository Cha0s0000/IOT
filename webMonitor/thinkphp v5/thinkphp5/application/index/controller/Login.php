<?php
namespace app\index\controller;

use think\Controller;
use think\Cookie;

class Login extends Controller
{
    public function index()
    {
    	return $this->fetch();
    }   

    public function login()
    {
    	$post_data = input('post.');
    	$username = $post_data['username'];
    	$password = $post_data['password'];

    	if(empty($username))
    	{
    		$this->error('please input username');
    	}

    	if(empty($password))
    	{
    		$this->error('please input password');
    	}

    	$valid = db('user')->where('username', $username)->find();

    	if(empty($valid)){
    		
    		$this->error('username or password error!');
    	}
    	if($valid['password'] != md5($password)){
    		
    		$this->error('username or password error!');
    	}

    	cookie('username', $valid['username'], 3600);
    	// cookie('username',null);
    	$this->redirect(url('index/index'));
    }
}