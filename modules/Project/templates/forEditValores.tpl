<script type="text/javascript" src="custom/modules/Project/templates/scripts/reglas.js?v=3"></script>
<script>
	var long_list = '{$long_list}';
</script>
<link rel="stylesheet" type="text/css" href="custom/modules/Project/templates/styles/reglas.css?v=2" />
<table class='lista'>
	<tbody>
		<tr class='repositorio'>
			<td>
				<input type='hidden' name='regla[]' value='%rand%'>
	
			</td>
			<td>
				{html_options name='puesto_%rand%' options=$cargos class='wm'}
			</td>

			<td>
				<input class='wm' type='text' name='valor_%rand%' value=''>
			</td>

			<td>
				<button type="button" onclick="removeReglaItem(this);">{sugar_getimage name="id-ff-remove-nobg" alt="$app_strings.LBL_ID_FF_REMOVE" ext=".png"}</button>
			</td>
		</tr>
		<tr class='cabecera'>
		<th><button type="button" onclick="rand = addReglaItem(this);  setReglaQuickSearch(rand, 'quien2');">{sugar_getimage name="id-ff-add" alt="$app_strings.LBL_ID_FF_ADD" ext=".png"}</button></th>
			<th>{$MOD.LBL_PUESTO}</th>
			<th>{$MOD.LBL_PUESTO_VALOR}</th>
		</tr>
		{foreach from=$reglas item=regla}{assign var=rand value=100000|mt_rand:999999}
		<tr>
			<td>
				<input type='hidden' name='regla[]' value='{$rand}'>
							
			</td>
			<td>
				{html_options name="puesto_`$rand`" options=$cargos selected=$regla.puesto}

			</td>
			<td>
			<input type='text' name='valor_{$rand}' id='valor_{$rand}' value='{$regla.valor}' >
			</td>
			<td>
			<button type="button" onclick="removeReglaItem(this);">{sugar_getimage name="id-ff-remove-nobg" alt="$app_strings.LBL_ID_FF_REMOVE" ext=".png"}</button>

				<script type="text/javascript">
					setEvents('{$rand}');
					//	setReglaQuickSearch('{$rand}', 'quien2');
				</script>
			</td>
		</tr>
		{/foreach}
	</tbody>
</table>