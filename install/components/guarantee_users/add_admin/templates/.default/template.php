<div class="popap-create"><p class="close-but">+</p>
	<div class="checkoutAlko  adm-filter-content">
		<form method="post" action="<?=POST_FORM_ACTION_URI?>" enctype="multipart/form-data">
			<div class="adm-filter-content-table-wrap">
				<div class="isdiscount">
					<?foreach($arResult as $item){?>
							<?echo $item;?>
						<?}?>
				</div>
			</div>
			<input type="submit" class="registrAlko" value="Добавить">
		</form>
	</div>
</div>