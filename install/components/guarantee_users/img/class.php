<?

use Bitrix\Main;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Type;
use Alko\Guarantee\GuaranteeTable;
use Bitrix\Sale\Internals;
use Bitrix\Main\Loader;
use Bitrix\Main\Engine\Contract\Controllerable;

class imgClass extends CBitrixComponent{

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

	public function src()
	{

		if(isset($this->arParams['NUMBER']) && $this->arParams['NUMBER']!='' && isset($this->arParams['ARTICLE']) && $this->arParams['ARTICLE']!=''){ 
			CModule::IncludeModule("iblock");
			$arSelect = Array("ID", "NAME", "DETAIL_PICTURE","CODE");
			$arFilter = Array("IBLOCK_ID"=>(int)$this->arParams['IBLOCK_ID'], "PROPERTY_".$this->arParams['PROP']=>$this->arParams['ARTICLE'], "ACTIVE"=>"Y");
			$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>1), $arSelect);
			while($ob = $res->GetNextElement())
			{
				$result0 = $ob->GetFields();
			}
			if(empty($result0)){
				return 2;
			}
			if(isset($result0)){

				$result = GuaranteeTable::getList(array('filter'=>['NUMBER'=>$this->arParams['NUMBER'],'ARTICLE'=>$this->arParams['ARTICLE']],'limit'=>1))->fetchAll();
				if(empty($result[0]['ID'])){
					return 5;
				}else{
					$mounth = ['января','февраля','марта','апреля','мая','июня','июля','августа','сентября','октября','ноября','декабря'];
					$imgage_path = $_SERVER['DOCUMENT_ROOT']."/guarantee/imgfont/blank.jpg"; //Путь к изображению
					$time = explode('-',$result[0]['TIME']);
					$img = imagecreatefromjpeg($imgage_path); // создаём новое изображение из файла
					$font = $_SERVER['DOCUMENT_ROOT']."/guarantee/imgfont/arial.ttf"; // путь к шрифту
					$font_size = 22; // размер шрифта
					$color = imageColorAllocate($img, 0, 0, 0); //Цвет шрифта
					$x = 360;
					$y = 482; 
					$y2 = 525;
					$y0 = 434;
					$y3 = 560;
					$y5 = 612;
					$x2 = 424;
					$x3 = 624;
					$xF = 758;
					$yF = 330;
					imagettftext($img, $font_size, 0, $xF, $yF, $color, $font, $result[0]['ID']);			
					imagettftext($img, $font_size, 0, $x, $y0, $color, $font, $result0['NAME']);
					imagettftext($img, $font_size, 0, $x, $y, $color, $font, $result[0]['ARTICLE']);
					imagettftext($img, $font_size, 0, $x, $y2, $color, $font, $result[0]['NUMBER']);
					imagettftext($img, $font_size, 0, $x, $y3, $color, $font, $result[0]['SHOP']);
					imagettftext($img, $font_size, 0, $x, $y5, $color, $font, $time[2]);
					imagettftext($img, $font_size, 0, $x2, $y5, $color, $font,$mounth[$time[1]-1]);
					imagettftext($img, $font_size, 0, $x3, $y5, $color, $font, $time[0]);
					header("Content-type: image/jpeg");
					Imagejpeg($img);
					imagedestroy($img);
				}

			}
			return $result;
		}
		return 3;
	}

    public function executeComponent(){
        $this->includeComponentLang('lang.php');
        $this->checkModules();
        $this->arResult=$this->src();
        $this->IncludeComponentTemplate();
    }
}