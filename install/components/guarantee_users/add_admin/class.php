<?

use Bitrix\Main;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Type;
use Alko\Guarantee\GuaranteeTable;
use Bitrix\Sale\Internals;
use Bitrix\Main\Loader;
use Bitrix\Main\Engine\Contract\Controllerable;
	
class addClass extends CBitrixComponent{

	protected function checkModules(){
		if(!Loader::includeModule('alko.guarantee')){
			throw new Main\LoaderException('Модуль alko.guarantee не установлен');
		}
	}
	
	public function onPrepareComponentParams($arParams = [])
    {

		foreach($arParams['ADD'] as $key=>$val){
			$arParams['ADD'][$key]=preg_replace('#([^0-9a-zA-Zа-яёА-ЯЁ\-\.@ ]+)#','',$val);
		}
		if(isset($_FILES['IMG']['name']) && isset($_POST['TIME']) && $_POST['TIME']!=''){
			$uploaddir = '/bitrix/components/guarantee_users/add/file/';
			$url_img = $uploaddir . time().basename($_FILES['IMG']['name']);
			$uploadfile = $_SERVER['DOCUMENT_ROOT'].$url_img;
			if (move_uploaded_file($_FILES['IMG']['tmp_name'], $uploadfile)) {
				$arParams['ADD']['UPDATED_AT']=new Type\DateTime();
				$arParams['ADD']['CREATED_AT']=new Type\DateTime();
				$arParams['ADD']['IMG']=$url_img;

			}
		}
		return $arParams;
    }
	private function tpl($name){
		$path = $_SERVER['DOCUMENT_ROOT'].'/bitrix/components/guarantee_users/add_admin/files/'.$name.'.php';
		$def = $_SERVER['DOCUMENT_ROOT'].'/bitrix/components/guarantee_users/add_admin/files/all.php';
		if(file_exists($path)){
			$file = file_get_contents($path);
		}
		else{
			$file = file_get_contents($def);
		}
		$file = str_replace("[[key]]",$name,$file);
		$file = str_replace("[[name]]",GetMessage('MYMODULE_'.$name),$file);
		return $file;
	}
	public function add()
	{

		if(isset($this->arParams['ADD']['TIME']) && $this->arParams['ADD']['TIME']!='' && isset($this->arParams['ADD']['CREATED_AT'])){
			$result = GuaranteeTable::add($this->arParams['ADD']);
		}
	}

    public function executeComponent(){
        $this->includeComponentLang('lang.php');
        $this->checkModules();
 		$arrtype = ['TIME','IMG','USER','ARTICLE','EMAIL','CITY','SITE','NUMBER','CHECK','ACTION','SHOP','ADRESS'];
		foreach($arrtype as $key=>$item){
			$result[$item] = $this->tpl($item);
		}
        $this->arResult=$result;
		$result = $this->add();
        $this->IncludeComponentTemplate();
    }
}