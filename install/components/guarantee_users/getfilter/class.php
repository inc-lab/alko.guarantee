<?
use Bitrix\Main;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Type;
use Alko\Guarantee\GuaranteeTable;
use Bitrix\Sale\Internals;
use Bitrix\Main\Loader;
use Bitrix\Iblock;
class getfilterClass extends CBitrixComponent{
    protected function checkModules(){
        if(!Loader::includeModule('alko.guarantee')){
            throw new Main\LoaderException('Модуль alko.guarantee не установлен');
        }
    }
    
    public function onPrepareComponentParams($arParams = []): array
    {
		foreach($arParams as $key=>$val){
			$arParams[$key]=preg_replace('/[^0-9a-zA-Zа-яёА-ЯЁ\-\._@ ]+/ui','',$val);
		}
		return $arParams;
    }

    public function select($arParams=[]){
		if(isset($arParams['CODE'])){
			CModule::IncludeModule("iblock");
			$arSelect = Array("ID", "NAME", "DETAIL_PICTURE","CODE");
			$arFilter = Array("IBLOCK_ID"=>(int)$arParams['IBLOCK_ID'], "PROPERTY_".$arParams['PROP']=>$arParams['CODE'], "ACTIVE"=>"Y");
			$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>1), $arSelect);
			while($ob = $res->GetNextElement())
			{
				$result = $ob->GetFields();
			}
			return $result;
		}
		return false;
    }


    public function executeComponent(){
        $this->includeComponentLang('lang.php');
        $this->checkModules();
        $result = $this->select($this->arParams);
        $this->arResult=$result;
        $this->IncludeComponentTemplate();
    }
}