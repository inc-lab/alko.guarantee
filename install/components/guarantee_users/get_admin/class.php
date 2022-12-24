<?
use Bitrix\Main;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Type;
use Alko\Guarantee\GuaranteeTable;
use Bitrix\Sale\Internals;
use Bitrix\Main\Loader;

class getClass extends CBitrixComponent{
    protected function checkModules(){
        if(!Loader::includeModule('alko.guarantee')){
            throw new Main\LoaderException('Модуль alko.guarantee не установлен');
        }
    }
    public function onPrepareComponentParams($arParams = []): array
    {
		foreach($arParams as $key=>$val){
			$arParams[$key]=preg_replace('/[^0-9a-zA-Zа-яёА-ЯЁ\-\.@ ]+/ui','',$val);
		}
		return $arParams;
    }

    public function select($arParams=[]){
		if(isset($arParams['CREATE'])){
			if(empty($result['error'])){
				$result['UPDATED_AT']=new Type\DateTime();
				$result['CREATED_AT']=new Type\DateTime();
				GuaranteeTable::add($result);
			}
		}
		if(isset($_GET['page'])){
			$offset = $_GET['page']*10;
		}
		else{
			$offset=0;
		}
		if(isset($arParams['FILTER'])){
			foreach($arParams['FILTER'] as $key=>$item){
				if($item!=''){
					$filter[$key] = $item;
				}
			}
			if(isset($filter)){
				$result = GuaranteeTable::getList(array('filter'=>$filter,'limit'=>10,'offset'=>$offset))->fetchAll();
			}
			else{
				$result = GuaranteeTable::getList(array('limit'=>10,'offset'=>$offset))->fetchAll();
			}
		}
		else{
			$result = GuaranteeTable::getList(array('limit'=>10,'offset'=>$offset))->fetchAll();
		}

		return $result;
	}
	private function tpl($name,$value){
		$path = $_SERVER['DOCUMENT_ROOT'].'/bitrix/components/guarantee_users/get_admin/files/'.$name.'.php';
		$def = $_SERVER['DOCUMENT_ROOT'].'/bitrix/components/guarantee_users/get_admin/files/all.php';
		if(file_exists($path)){
			$file = file_get_contents($path);
		}
		else{
			$file = file_get_contents($def);
		}
		$file = str_replace("[[value]]",$value,$file);
		$file = str_replace("[[key]]",$name,$file);
		$file = str_replace("[[name]]",GetMessage('MYMODULE_'.$name),$file);
		if($value=='on'){
			$file = str_replace("[[on]]",'selected',$file);
			$file = str_replace("[[off]]",'',$file);
		}else{
			$file = str_replace("[[off]]",'selected',$file);
			$file = str_replace("[[on]]",'',$file);
		}
		return $file;
	}
	private function tplfilter($name){
		$path = $_SERVER['DOCUMENT_ROOT'].'/bitrix/components/guarantee_users/get_admin/filter/'.$name.'.php';
		$def = $_SERVER['DOCUMENT_ROOT'].'/bitrix/components/guarantee_users/get_admin/filter/all.php';
		if(file_exists($path)){
			$file = file_get_contents($path);
		}
		else{
			$file = file_get_contents($def);
		}
		if(isset($_POST[$name])){
			$file = str_replace('[[value]]',$_POST[$name],$file);
		}
		else{
			$file = str_replace('[[value]]','',$file);
		}
		$file = str_replace("[[name]]",GetMessage('MYMODULE_'.$name),$file);
		$file = str_replace("[[key]]",$name,$file);
		if(isset($_POST[$name]) && $_POST[$name]=='on'){
			$file = str_replace("[[on]]",'selected',$file);
			$file = str_replace("[[off]]",'',$file);
		}else{
			$file = str_replace("[[off]]",'selected',$file);
			$file = str_replace("[[on]]",'',$file);
		}
		return $file;
	}

    public function executeComponent(){
        $this->includeComponentLang('lang.php');
        $this->checkModules();
        $result = $this->select($this->arParams);
		foreach($result as $key0=>$item){
			foreach($item as $key=>$field){
				$result[$key0][$key] = $this->tpl($key,$field);
			}
		}
		$arrtype = ['ACTION','TIME','IMG','USER','ARTICLE','EMAIL','CITY','SITE','NUMBER','CHECK','SHOP','ADRESS'];
		foreach($arrtype as $key=>$item){
			$resultfiler[$item] = $this->tplfilter($item);
		}
        $this->arResult=['res'=>$result,'filter'=>$resultfiler];
        $this->IncludeComponentTemplate();
    }
}