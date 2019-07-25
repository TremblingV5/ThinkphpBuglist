<?php
	namespace app\admin\model;
	use think\Model;
	
	class Admin extends Model {
		protected $field = true;
		public function index(){
			
		}
		
		static public function login($username, $password)
		{
		    // 验证用户是否存在
		    $map = array('username' => $username);
		    $Doctor = self::get($map);
		   
		    if (!is_null($Doctor)) {
		        // 验证密码是否正确
		        if ($Doctor->checkPassword($password)) {
		            // 登录
		            session('AdminId', $Doctor->getData('id'));
		            return true;
		        }
		    }
		    return false;
		}
		
		public function checkPassword($password)
		{
		    if ($this->getData('password') == $this::encryptPassword($password))
		    {	
		        return true;
		    } else {
		        return false;
		    }
		}
		
		static public function encryptPassword($password)
		{   
		    // 实际的过程中，我还还可以借助其它字符串算法，来实现不同的加密。
		    return sha1(md5($password));
		}
		
		static public function logOut()
		{
		    // 销毁session中数据
		    session('AdminId', null);
		    return true;
		}
		
		static public function isLogin()
		{
		    $AdminId = session('AdminId');
		
		    // isset()和is_null()是一对反义词
		    if (isset($AdminId)) {
		        return true;
		    } else {
		        return false;
		    }
		}
	}