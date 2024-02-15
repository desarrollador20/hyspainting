<script type="text/javascript" src="custom/modules/Project/templates/scripts/reglas.js?v=3"></script>
<script type="text/javascript" src="modules/HS_programador/javascript/select2/select2.min.js"></script>
<script>
	//Declarar los datos para el QuickSearch para la búsqueda de un establecimiento
</script>
<link rel="stylesheet" type="text/css" href="custom/modules/Project/templates/styles/reglas.css?v=2" />
<link rel="stylesheet" type="text/css" href="modules/HS_programador/javascript/select2/select2.min.css" />
<table class='lista'>
	<tbody>
		<tr class='cabecera'>
			<th></th>
			<th>{$MOD.LBL_PUESTO}</th>
			<th>{$MOD.LBL_PUESTO_VALOR}</th>
		</tr>
		{foreach from=$data item=regla}{assign var=rand value=100000|mt_rand:999999}
		<tr>
			<td>
				<input type='hidden' name='regla[]' value='{$rand}'>
			</td>
			<td >
				{$cargos[$regla.puesto]}

			</td>
			<td style="padding-left: 20px;">
				{$regla.valor}
			</td>
			<td>

				<script type="text/javascript">
					setEvents('{$rand}');
					//	setReglaQuickSearch('{$rand}', 'quien2');
				</script>
			</td>
		</tr>
		{/foreach}
	</tbody>
</table>