<?php
error_reporting(0);
define('BIGQI', true);
//BIGQI_MS_ROOT
//BIGQI_ROOT
/*
+----------------------------------------------
| [Bigqi.com] ---->
| Item Name	: ModuleSystem
+----------------------------------------------
| File	: common.inc.php 2012-08-30
| Author: Haierspi ...
+----------------------------------------------
*/

/*
 ++++++++|                                                |++++++++
  ++++++++++++++|                                   |+++++++++++++
   +-----------------  ModuleSystem Body Start  ----------------+
  ++++++++++++++|                                   |+++++++++++++
 ++++++++|                                                |++++++++
*/


class Module {
	/* 模组挂载系统 */
	public $Module = Array();
	//记录实例
	public $ModuleCallnum = Array();
	//记录需要call次数
	public $ModuleCallnumed = Array();
	//记录需要已经call次数
	public $ModuleMethodClist = Array();
	public $ModuleReturnClist = Array();
	//记录模组有return得 检查
	public $ModulePointlist = Array();
	//所有被CALL数组
	public $Pointlist = Array();
	//全局嵌入点列表
	public $FuncPointlist = Array();
	//函数嵌入点列表
	public $ClassPointlist = Array();
	public $class = '';
	public $function = '';
	//类嵌入点列表
	public $Returns = Array();

	public function Module(){
		GLOBAL $Module;
		$Module = Array();
		$this->Module = & $Module;
	}

	public function ModuleAdd($modname_point, $function = '' ,$class = '') {


		if(strpos($modname_point,'/')){
			@list($modname,$args0,$args1,$args2) = explode('/',$modname_point);
			if($args2){
				$class = $args0;
				$function=$args1;
				$point = $args2;
			}elseif($args1){
				$function=$args0;
				$point = $args1;
			}else{
				$point = $args0;
			}
		}else{
			echo 'Notice: Module: '.$modname_point.'.Point Missing';
			return false;
		}
		if(!isset($this->Module[$modname])){
			$this->ModuleMethodClist[$modname] = $this->ModuleReturnClist[$modname] = Array();
		}

		//判断模组插入点是否重复插入相同得模组
		if(in_array($modname_point,$this->ModulePointlist)){
			echo 'Notice: Module: '.$modname.' Been Added';
			return false;
		}

		if(!class_exists($modname)) {
			echo 'Notice: Module: '.$modname.' NoExists';
			return false;
		}

		if(!in_array($modname,$this->ModuleMethodClist[$modname])){
			$class_methods = get_class_methods($modname);
			$this->ModuleMethodClist[$modname]=in_array('action',$class_methods )&&in_array('execute',$class_methods);
			if(!$this->ModuleMethodClist[$modname]){
				echo 'Notice: Module: '.$modname.' Method Missing';
				return false;
			}
		}

		if(!in_array($modname,$this->ModuleReturnClist[$modname])){
			$class_vars = get_class_vars($modname);
			$this->ModuleReturnClist[$modname] = array_key_exists('returns',$class_vars);
		}

		if($class && $function && $point && !in_array($modname_point,$this->ModulePointlist)){
			$this->ModulePointlist[] = $modname_point;

			if(!isset($this->ModuleCallnum[$modname])){
				$this->ModuleCallnum[$modname] = 1;
			}else{
				$this->ModuleCallnum[$modname] ++;
			}

			if(!in_array($modname,$this->ClassPointlist[$class][$function][$point])){
				$this->ClassPointlist[$class][$function][$point][] = $modname;
			}
		}elseif($function && $point && !in_array($modname_point,$this->ModulePointlist)){
			$this->ModulePointlist[] = $modname_point;

			if(!isset($this->ModuleCallnum[$modname])){
				$this->ModuleCallnum[$modname] = 1;
			}else{
				$this->ModuleCallnum[$modname] ++;
			}

			if(!is_array($this->FuncPointlist[$function][$point]) ){
				$this->FuncPointlist[$function][$point] = Array();
			}
			if(!in_array($modname,$this->FuncPointlist[$function][$point])){
				$this->FuncPointlist[$function][$point][] = $modname;
			}
		}elseif(!in_array($modname_point,$this->ModulePointlist)){
			$this->ModulePointlist[] = $modname_point;

			if(!isset($this->ModuleCallnum[$modname])){
				$this->ModuleCallnum[$modname] = 1;
			}else{
				$this->ModuleCallnum[$modname] ++;
			}
			if(!is_array($this->Pointlist[$point])||!in_array($modname,$this->Pointlist[$point])){
				$this->Pointlist[$point][] = $modname;
			}
		}
	}

	public function ModulePoint($point, $function = '' ,$class = '') {

		if($class && $function && !empty($this->ClassPointlist[$class][$function][$point])){
			$this->Classexecute($point,$this->ClassPointlist[$class][$function][$point]);
		}elseif($function && !empty($this->FuncPointlist[$function][$point])){
			$this->Functionexecute($point,$this->FuncPointlist[$function][$point]);
		}elseif($point && !empty($this->Pointlist[$point])){
			$this->Pointexecute($point,$this->Pointlist[$point]);
		}
	}

	public function Classexecute($point,& $classAry) {
		foreach($classAry as $name){
			$this->execute($name,$point);
		}
	}
	public function Functionexecute($point,& $functionAry) {
		foreach($functionAry as $name){
			$this->execute($name,$point);
		}
	}

	public function Pointexecute($point,& $pointAry) {
		foreach($pointAry as $name){
			$this->execute($name,$point);
		}
	}
	public function execute($name,$point) {

		if(!isset($this->Module[$name])){
			$this->Module[$name] = new $name();
		}

		if($this->ModuleReturnClist[$name]){
			$this->Module[$name]->returns = & $this->Returns;
		}

		if(property_exists( $this->Module[$name], 'class' ) && $this->class)$this->Module[$name]->class = $this->class;
		if(property_exists( $this->Module[$name], 'function' ) && $this->function)$this->Module[$name]->function = $this->function;

		if($this->Module[$name]->action($point)){
			$this->Module[$name]->execute($point);
		}
		if(!isset($this->ModuleCallnumed[$modname])){
			$this->ModuleCallnumed[$modname] = 1;
		}else{
			$this->ModuleCallnumed[$modname] ++;
		}
		if($this->ModuleCallnumed[$name] >= $this->ModuleCallnum[$name]){
			unset($this->Module[$name]);
		}

	}
}
function & Module() {
	static $Module;
	if(!isset($Module)){
		$Module = New Module();
	}
	return $Module;
}
function ModuleAdd($name) {
	@list($loadclassname) = explode('/',$name);
	if(!class_exists($loadclassname) && file_exists(BIGQI_MS_ROOT.'./_Module/'.$loadclassname.'.class.php')) {
		require BIGQI_MS_ROOT.'./_Module/'.$loadclassname.'.class.php';
	}
	$Module = Module();
	$Module->ModuleAdd($name);
}

function ModulePointWhether($name,$function='',$class ='') {
	$Module = Module();
	if($class && $function && !empty($Module->ClassPointlist[$class][$function][$name])){
		return TRUE;
	}elseif($function && !empty($Module->FuncPointlist[$function][$name])){
		return TRUE;
	}elseif($name && !empty($Module->Pointlist[$name])){
		return TRUE;
	}else{
		return FALSE;
	}
}
function ModulePoint($name,$function='',$class ='', $returns = array()) {
	$Module = Module();
	if($returns) $Module->Returns = $returns;

	$Module->class = $class;
	$Module->function = $function;
	
	$Module->ModulePoint($name,$function,$class);
	if($Module->Returns) return $Module->Returns;
}

function _Data($name){
	return  BIGQI_MS_ROOT.'_Data/'.$name.'.data.php';
}


/*-------------------ModuleSystem Body End-------------------*/

require BIGQI_MS_ROOT.'Library/Library.class.php';
require BIGQI_MS_ROOT.'Library/debug.class.php';
require BIGQI_MS_ROOT.'_ModuleList.php';



/* ModuleSystem Point */
if(ModulePointWhether('start',__FUNCTION__,__CLASS__)){
	UNSET($GLOBALS['_ModuleActionStorage' ]);
	$Modextract = ModulePoint('start',__FUNCTION__,__CLASS__);
	if(isset($Modextract) && is_array($Modextract)){
		extract($Modextract);
		unset($Modextract);
	}
}
/* ModuleSystem Point */
?>