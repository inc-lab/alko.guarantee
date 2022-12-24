<?

use Bitrix\Main;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Type;
use Alko\Guarantee\GuaranteeTable;
use Bitrix\Sale\Internals;
use Bitrix\Main\Loader;
use Bitrix\Main\Engine\Contract\Controllerable;

class ajaxClass extends CBitrixComponent{

	protected function checkModules(){
		if(!Loader::includeModule('alko.guarantee')){
			throw new Main\LoaderException('Модуль alko.guarantee не установлен');
		}
	}

	public function onPrepareComponentParams($arParams = []): array
    {

		foreach($arParams['FILTER'] as $key=>$val){
			$arParams['FILTER'][$key]=preg_replace('/[^0-9a-zA-Zа-яёА-ЯЁ\-\.@_ ]+/ui','',$val);
		}
		return $arParams;
    }

	public function echof()
	{

		if(isset($this->arParams['FILTER']['NUMBER']) && $this->arParams['FILTER']['NUMBER']!='' && isset($this->arParams['FILTER']['ARTICLE']) && $this->arParams['FILTER']['ARTICLE']!=''){ 
				$result = GuaranteeTable::getList(array('filter'=>['NUMBER'=>$this->arParams['FILTER']['NUMBER'],'ARTICLE'=>$this->arParams['FILTER']['ARTICLE']],'limit'=>1))->fetchAll();
				if(empty($result[0]['ID'])){
					return 5;
				}
				return $result;
			}


		return 3;
	}

    public function executeComponent(){
        $this->includeComponentLang('lang.php');
        $this->checkModules();
		$result = $this->echof();
        $this->arResult=$result;
        $this->IncludeComponentTemplate();
    }
}