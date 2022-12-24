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
			$arParams[$key]=preg_replace('#([^0-9a-zA-Zа-яёА-ЯЁ\-\.@ ]+)#','',$val);
		}
		return $arParams;
    }

    public function select($arParams=[]){
		if(isset($filter)){
			$result = GuaranteeTable::getList(array('limit'=>1,'filter'=>$filter))->fetchAll();
			if(empty($result[0]['TIME'])){
				if(empty($result['error'])){
					$result['UPDATED_AT']=new Type\DateTime();
					$result['CREATED_AT']=new Type\DateTime();
					GuaranteeTable::add($result);
				}
			}
			return $result;
		}

    }


    public function executeComponent(){
        if(!CUser::IsAuthorized()){
            LocalRedirect("/");
        }
        $this->includeComponentLang('lang.php');
        $this->checkModules();
        $result = $this->select($this->arParams);
        $this->arResult=$result;
        $this->IncludeComponentTemplate();
    }
}