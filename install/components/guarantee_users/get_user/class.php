<?

use Bitrix\Main;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Type;
use Alko\Guarantee\GuaranteeTable;
use Bitrix\Sale\Internals;
use Bitrix\Main\Loader;
use Bitrix\Main\Engine\Contract\Controllerable;
	
class getuserClass extends CBitrixComponent{

	protected function checkModules(){
		if(!Loader::includeModule('alko.guarantee')){
			throw new Main\LoaderException('Модуль alko.guarantee не установлен');
		}
	}
	
	public function onPrepareComponentParams($arParams = []): array
    {

		foreach($arParams['ADD'] as $key=>$val){
			$arParams['ADD'][$key]=preg_replace('/[^0-9a-zA-Zа-яёА-ЯЁ\-\.@_ ]+/ui','',$val);
		}
		return $arParams;
    }
	private function tpl($name,$value,$time,$num,$art){
		$path = $_SERVER['DOCUMENT_ROOT'].'/bitrix/components/guarantee_users/get_user/files/'.$name.'.php';
		$def = $_SERVER['DOCUMENT_ROOT'].'/bitrix/components/guarantee_users/get_user/files/all.php';
		if(file_exists($path)){
			$file = file_get_contents($path);
		}
		else{
			$file = file_get_contents($def);
		}
		$file = str_replace("[[key]]",$name,$file);
		$file = str_replace("[[name]]",GetMessage('MYMODULE_'.$name),$file);
		$file = str_replace('[[value]]',$value,$file);
		if($value=='on'){
			$time = time() - strtotime($time);
			if($time>126144000){
				$file = str_replace("[[action]]",GetMessage('MYMODULE_ACTION1'),$file);
			}
			else{
				$file = str_replace("[[action]]",GetMessage('MYMODULE_ACTION2').' <a href="/guarantee/guarantee.php?article='.$art.'&number='.$num.'" target="_blank">Скачать</a>',$file);
			}
		}else{
			$file = str_replace("[[action]]",GetMessage('MYMODULE_ACTION3'),$file);
		}
		return $file;
	}
	public function select()
	{
		if(isset($this->arParams['ADD']['NUMBER']) && $this->arParams['ADD']['NUMBER']!=''){
			$result = GuaranteeTable::getList(array('filter'=>['NUMBER'=>$this->arParams['ADD']['NUMBER'],'ARTICLE'=>$this->arParams['ADD']['ARTICLE']],'limit'=>1))->fetchAll();
			return $result;
		}
	}

    public function executeComponent(){
        $this->includeComponentLang('lang.php');
        $this->checkModules();
		$arrtype = ['ACTION','USER','ARTICLE','EMAIL','CITY','SITE','NUMBER','CHECK','SHOP','ADRESS','TIME','IMG'];
		$result = $this->select(); 
		foreach($arrtype as $field){
			$result[$field] = $this->tpl($field,$result[0][$field],$result[0]['TIME'],$this->arParams['ADD']['NUMBER'],$this->arParams['ADD']['ARTICLE']);
		}
        $this->arResult=['form'=>$result];
        $this->IncludeComponentTemplate();
    }
}