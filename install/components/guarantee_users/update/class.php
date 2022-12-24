<?
use Bitrix\Main;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Type;
use Alko\Guarantee\GuaranteeTable;
use Bitrix\Sale\Internals;
use Bitrix\Main\Loader;

class upClass extends CBitrixComponent{
    protected function checkModules(){
        if(!Loader::includeModule('alko.guarantee')){
            throw new Main\LoaderException('Модуль alko.guarantee не установлен');
        }
    }
    
    public function onPrepareComponentParams($arParams = []): array
    {
		foreach($arParams['UP'] as $key=>$val){
			$arParams[$key]=preg_replace('/[^0-9a-zA-Zа-яёА-ЯЁ\-\.@ ]+/ui','',$val);
		}
		$arParams['UP']['UPDATED_AT']=new Type\DateTime();
		unset($arParams['UP']['CREATED_AT']);
        return $arParams;
    }

    public function update($arParams=[]){
		if(isset($arParams['UP']['ID'])){
			$id = $arParams['UP']['ID'];
			unset($arParams['UP']['ID']);
			$uploaddir = '/bitrix/components/guarantee_users/add/file/';
			$url_img = $uploaddir . time().basename($_FILES['files']['name']);
			unlink($_SERVER['DOCUMENT_ROOT'].$arParams['UP']['IMG']);
			$uploadfile = $_SERVER['DOCUMENT_ROOT'].$url_img;
			if (move_uploaded_file($_FILES['files']['tmp_name'], $uploadfile)) {
				$arParams['UP']['UPDATED_AT']=new Type\DateTime();
				$arParams['UP']['CREATED_AT']=new Type\DateTime();
				$arParams['UP']['IMG']=$url_img;

			}
			$result = GuaranteeTable::update((int)$id,$arParams['UP']);
			return $result;
		}
    }

    public function executeComponent(){
        if(!CUser::IsAuthorized()){
            LocalRedirect("/");
        }
        $this->includeComponentLang('lang.php');
        $this->checkModules();
        $result = $this->update($this->arParams);
        $this->arResult=(array)$result;
        $this->IncludeComponentTemplate();
    }
}