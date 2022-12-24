<?
if($arResult){?>
	<?if(isset($arResult['DETAIL_PICTURE']) && $arResult['DETAIL_PICTURE']!=''){?>
		<img src="<?=CFile::GetPath($arResult['DETAIL_PICTURE']);?>">
	<?}?>
	<a href="/catalog/<?=$arResult['CODE'];?>/" target="_blank"><?=$arResult['NAME'];?></a>
<?}else{?>
	<p class="red">Товар не найден</p>
<?}?>