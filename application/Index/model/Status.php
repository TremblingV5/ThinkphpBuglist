<?php
	namespace app\Index\model;
	use think\Model;
	
	class Status extends Model {
		protected $field = true;
		
		public function index(){
			
		}
		
		public function getFlag($status_flag){
			if($status_flag == 1){
				return "处理中";
			}else{
				return "已关闭";
			}
		}
	}