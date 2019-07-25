<?php
	namespace app\Index\controller;
	use think\Controller;
	use think\Request;
	use app\Index\Model\Bug as BugModel;
	use app\Index\Model\Status as StatusModel;
	use app\Index\Model\People as PeopleModel;
	// use app\Index\Model\ as BugModel;
	
	class Status extends Controller{
		public function Index(){
			// 获取查询信息
			$name = input('get.name');
			
			// 获取查询信息
			// $name = Request::instance()->get('name');
			
			$pageSize = 10; // 每页显示5条数据
			
			// 实例化Teacher
			$Status = new StatusModel; 
			
			// 按条件查询数据并调用分页
			$Statuss = $Status->where('status_name', 'like', '%' . $name . '%')->paginate($pageSize, false, [
			    'query'=>[
			        'name' => $name,
			        ],
			    ]); 
			
			// $students = StudentModel::paginate();
			$this->assign('Statuss', $Statuss);
			
			return $this->fetch();
		}
		
		public function Add(){
			$Status = new StatusModel;
			
			$Statuss = $Status->select();
			
			$this->assign("Statuss",$Statuss);
			
			return $this->fetch();
		}
		
		public function Save(){
			// 实例化请求信息
			$Request = Request::instance();
			
			// 实例化班级并赋值
			$Status = new StatusModel;
			$Status->status_name = $Request->post('status_name');
			$Status->status_flag = $Request->post('status_flag');
			
			// 添加数据
			if (!$Status->save($Status->getData())) {
			    return $this->error('数据添加错误：' . $Status->getError());
			}
			
			return $this->success('操作成功', url('index'));
		}
		
		public function Edit(){
			$id = Request::instance()->param('id/d');
			
			$Status = new StatusModel;
			
			$Statuss = StatusModel::get($id);
			
			$this->assign("Statuss",$Statuss);
			
			return $this->fetch();
		}
		
		public function update()
		{
		    $id = Request::instance()->param('id/d');
		    //获取传入的班级信息
		    $Status = StatusModel::get($id);
			
		    if (is_null($Status)) {
		        return $this->error('系统未找到ID为' . $id . '的记录');
		    }
		
		    // 数据更新
		    $Status->status_name = Request::instance()->post('status_name');
			$Status->status_flag = Request::instance()->post('status_flag');
			
		    if (!$Status->save($Status->getData())) {	// 这里使用的是validate()而不是validate(true)效果相同，为什么呢？
		        return $this->error('更新错误：' . $Status->getError());
		    } else {
		        return $this->success('操作成功', url('index'));
		    }
		}
		
		public function delete(){
			
		    $id = Request::instance()->param('id/d'); 
		
		    if (is_null($id) || 0 === $id) {
		        return $this->error('未获取到ID信息');
		    }
		
		    // 获取要删除的对象
		    $Status = StatusModel::get($id);
		
		    // 要删除的对象不存在
		    if (is_null($Status)) {
		        return $this->error('不存在id为' . $id . '的数据，删除失败');
		    }
		
		    // 删除对象
		    if (!$Status->delete()) {
		        return $this->error('删除失败:' . $Status->getError());
		    }
		
		    // 进行跳转
		    return $this->success('删除成功', url('index'));
		}
	}