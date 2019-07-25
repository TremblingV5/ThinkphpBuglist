<?php
	namespace app\Index\model;
	use think\Model;
	
	class Bug extends Model {
		public function index(){
			
		}
		
		// public function getCreateTimeAttr($value)
		// {
		//     // return date('Y-m-d', $value);
		// 	return date($value);
		// }
		public function getDutyId($id){
			if($id){
				$a_str = "<a href=\"/index/index/show/id/".$id.".html\">" . $id . "</a>";
				echo $a_str;
			}else{
				return "无";
			}
		}
		
		public function getRaisePeople(){
			$raise_id = $this->getData('raise_id');
			$raise_name = People::get($raise_id);
			return $raise_name;
		}
		
		public function getDutyPeople(){
			$duty_id = $this->getData('duty_id');
			$duty_name = People::get($duty_id);
			return $duty_name;
		}
		
		public function getStatus(){
			$status_id = $this->getData('status_id');
			$status_name = Status::get($status_id);
			return $status_name;
		}
	}