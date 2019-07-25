<?php
	namespace app\Index\controller;
	use think\Controller;
	use think\Request;
	use app\Index\Model\Bug as BugModel;
	use app\Index\Model\Status as StatusModel;
	use app\Index\Model\People as PeopleModel;
	// use app\Index\Model\ as BugModel;

	class Index extends Controller{
		public function Index(){
			// 获取查询信息
			$name = input('get.name');
			$flag1 = Request::instance()->param('select_flag');
			
			$flag = Request::instance()->param('flag');
			
			$Status = new StatusModel;
			
			// 获取查询信息
			// $name = Request::instance()->get('name');
			
			$pageSize = 10; // 每页显示5条数据
			
			// 实例化Teacher
			$Bug = new BugModel; 
			
			if($flag1 == 1){
				if($flag==NULL){
					// 按条件查询数据并调用分页
					$Bugs = $Bug->where('title', 'like', '%' . $name . '%')->order('update_time desc')->paginate($pageSize, false, [
					    'query'=>[
					        'name' => $name,
					        ],
					    ]); 
				}else{
					// 按条件查询数据并调用分页
					$Bugs = $Bug->where('title', 'like', '%' . $name . '%')->where('status_flag', 'like', '%' . $flag . '%')->order('update_time desc')->paginate($pageSize, false, [
					    'query'=>[
					        ],
					    ]);
				}
			}else if($flag1==0){
				$People = new PeopleModel;
				
				$People_info = $People->where('name', 'like', '%' . $name . '%')->find()->toArray();
				
				// var_dump($People_info["id"]);
				if($flag==NULL){
					// 按条件查询数据并调用分页
					$Bugs = $Bug->where('raise_id', 'like', '%' . $People_info["id"] . '%')->order('update_time desc')->paginate($pageSize, false, [
					    'query'=>[
					        'name' => $name,
					        ],
					    ]); 
				}else{
					// 按条件查询数据并调用分页
					$Bugs = $Bug->where('raise_id', 'like', '%' . $People_info["id"] . '%')->where('status_flag', 'like', '%' . $flag . '%')->order('update_time desc')->paginate($pageSize, false, [
					    'query'=>[
					        ],
					    ]);
				}
			}
			
			
			
			
			
			// $students = StudentModel::paginate();
			$this->assign('Bugs', $Bugs);
			
			return $this->fetch();
		}
		
		public function Add(){
			$People = new PeopleModel;
			$Status = new StatusModel;
			$Bug = new BugModel;
			
			$Peoples = $People->select();
			$Statuss = $Status->select();
			$Bugs = $Bug->select();
			
			$this->assign("Peoples",$Peoples);
			$this->assign("Statuss",$Statuss);
			$this->assign("Bugs",$Bugs);
			
			return $this->fetch();
		}
		
		public function Save(){
			// 实例化请求信息
			$Request = Request::instance();
			
			// 实例化班级并赋值
			$Bug = new BugModel;
			$Bug->title = $Request->post('title');
			$Bug->raise_id = $Request->post('raise_id');
			$Bug->status_id = $Request->post('status_id');
			$Bug->status_flag = 1;
			$Bug->duty_id = $Request->post('duty_id');
			$Bug->version = $Request->post('version');
			$Bug->descript = $Request->post('descript');
			
			// 添加数据
			if (!$Bug->save($Bug->getData())) {
			    return $this->error('数据添加错误：' . $Klass->getError());
			}
			
			return $this->success('操作成功', url('index'));
		}
		
		public function Show(){
			$id = Request::instance()->param('id/d');
			
			$Bug = new BugModel;
			
			$Bugs = BugModel::get($id);
			
			$this->assign("Bugs",$Bugs);
			
			return $this->fetch();
		}
		
		public function Edit(){
			$id = Request::instance()->param('id/d');
			
			$Bug = new BugModel;
			
			$Bugs = BugModel::get($id);
			
			$this->assign("Bugs",$Bugs);
			
			$Status = new StatusModel;
			
			$Statuss = $Status->select();
			
			$this->assign("Statuss",$Statuss);
			
			return $this->fetch();
		}
		
		public function update()
		{
		    $id = Request::instance()->param('id/d');
		    //获取传入的班级信息
		    $Bug = BugModel::get($id);
			
		    if (is_null($Bug)) {
		        return $this->error('系统未找到ID为' . $id . '的记录');
		    }
		
		    // 数据更新
		    $Bug->descript = Request::instance()->post('descript');
			$Bug->status_id = Request::instance()->post('status_id');
			
		    if (!$Bug->save($Bug->getData())) {	// 这里使用的是validate()而不是validate(true)效果相同，为什么呢？
		        return $this->error('未作出任何修改' . $Bug->getError());
		    } else {
		        return $this->success('操作成功', url('index'));
		    }
		}
		
		public function Close(){
			$id = Request::instance()->param('id/d');
			
			$Bug = BugModel::get($id);
			
			$Bug->status_flag = 0;
			
			if (!$Bug->save($Bug->getData())) {	// 这里使用的是validate()而不是validate(true)效果相同，为什么呢？
			    return $this->error('此任务已关闭' . $Bug->getError());
			} else {
			    return $this->success('操作成功', url('index'));
			}
		}
		
		public function AddFather(){
			$id = Request::instance()->param('id/d');
			$name = input("get.name");
			
			
			
			$Bug = new BugModel;
			$Bugs = $Bug->where('title', 'like', '%' . $name . '%')->order('update_time desc')->select(); 
			
			
			$this->assign("id",$id);
			$this->assign("Bugs",$Bugs);
			
			return $this->fetch();
		}
		
		public function fathersave(){
			$id = Request::instance()->param('id/d');
			//获取传入的班级信息
			$Bug = BugModel::get($id);
			
			if (is_null($Bug)) {
			    return $this->error('系统未找到ID为' . $id . '的记录');
			}
					
			// 数据更新
			$Bug->last_id = Request::instance()->post('last_id');
			
			if (!$Bug->save($Bug->getData())) {	// 这里使用的是validate()而不是validate(true)效果相同，为什么呢？
			    return $this->error('未作出任何修改' . $Bug->getError());
			} else {
			    return $this->success('操作成功', url('index'));
			}
		}
	}