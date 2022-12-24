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

	public function onPrepareComponentParams($arParams = []): array
    {

		foreach($arParams['ADD'] as $key=>$val){
			$arParams['ADD'][$key]=preg_replace('/[^0-9a-zA-Zа-яёА-ЯЁ\-\.@ ]+/ui','',$val);
		}
		return $arParams;
    }
	private function tpl($name,$req){
		$path = $_SERVER['DOCUMENT_ROOT'].'/bitrix/components/guarantee_users/add/files/'.$name.'.php';
		$def = $_SERVER['DOCUMENT_ROOT'].'/bitrix/components/guarantee_users/add/files/all.php';
		if(file_exists($path)){
			$file = file_get_contents($path);
		}
		else{
			$file = file_get_contents($def);
		}
		$file = str_replace("[[key]]",$name,$file);
		if(isset($req[$name])){
			$file = str_replace("[[req]]",'<span class="red">*</span>',$file);
		}else{
			$file = str_replace("[[req]]",'',$file);
		}
		$file = str_replace("[[name]]",GetMessage('MYMODULE_'.$name),$file);
		$file = str_replace("[[title]]",GetMessage('MYMODULE_'.$name.'_title'),$file);
		if(isset($_POST[$name])){
			$file = str_replace('[[value]]',$_POST[$name],$file);
		}
		else{
			$file = str_replace('[[value]]','',$file);
		}
		return $file;
	}
	public function add()
	{

		if(isset($this->arParams['ADD']['NUMBER']) && $this->arParams['ADD']['NUMBER']!='' && filter_var($this->arParams['ADD']['EMAIL'], FILTER_VALIDATE_EMAIL)){ 
			CModule::IncludeModule("iblock");
			$arSelect = Array("ID", "NAME", "DETAIL_PICTURE","CODE");
			$arFilter = Array("IBLOCK_ID"=>(int)$this->arParams['IBLOCK_ID'], "PROPERTY_".$this->arParams['PROP']=>$this->arParams['ADD']['ARTICLE'], "ACTIVE"=>"Y");
			$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>1), $arSelect);
			while($ob = $res->GetNextElement())
			{
				$result = $ob->GetFields();
			}
			if(empty($result)){
				return 2;
			}
			if(isset($result)){
				$result = GuaranteeTable::getList(array('filter'=>['NUMBER'=>$this->arParams['ADD']['NUMBER'],'ARTICLE'=>$this->arParams['ADD']['ARTICLE']],'limit'=>1))->fetchAll();
				if(isset($result[0]['ID'])){
					return 5;
				}else{
					$uploaddir = '/bitrix/components/guarantee_users/add/file/';
					$url_img = $uploaddir .time(). basename($_FILES['IMG']['name']);
					$uploadfile = $_SERVER['DOCUMENT_ROOT'].$url_img;			
					if (move_uploaded_file($_FILES['IMG']['tmp_name'], $uploadfile)) { 
						$this->arParams['ADD']['UPDATED_AT']=new Type\DateTime();
						$this->arParams['ADD']['CREATED_AT']=new Type\DateTime();
						$this->arParams['ADD']['IMG']=$url_img;			
						$this->arParams['ADD']['ACTION']='off';
						$result = GuaranteeTable::add($this->arParams['ADD']);
					}
				}

			}
			return $result;
		}
		return 3;
	}

    public function executeComponent(){
        $this->includeComponentLang('lang.php');
        $this->checkModules();
		$arrtype = ['ARTICLE','USER','EMAIL','CITY','SHOP','ADRESS','SITE','NUMBER','TIME','CHECK','IMG'];
		$require =  ['USER'=>'USER','CITY'=>'CITY','ARTICLE'=>'ARTICLE','EMAIL'=>'EMAIL','NUMBER'=>'NUMBER','CHECK'=>'CHECK','SHOP'=>'SHOP','TIME'=>'TIME'];
		foreach($arrtype as $key=>$item){
			$resultform[$item] = $this->tpl($item,$require);
		}
		$result = $this->add();
		if(is_object($result)){
			LocalRedirect("/guarantee/result.php");
		}
        $this->arResult=['res'=>$result,'form'=>$resultform,'req'=>$require];
        $this->IncludeComponentTemplate();
    }
}