<script type="text/javascript" src="modules/HS_Programador/templates/scripts/reglas.js?v=3"></script>
<script>
	//Declarar los datos para el QuickSearch para la búsqueda de un establecimiento
</script>
{literal}
<style>

table {
border-collapse: collapse;
width: 100%;
}

th, td {
border: 1px solid #dddddd;
text-align: left;
padding: 8px;
}

tr:nth-child(even) {
background-color: #f2f2f2;
}

.user-list {
list-style-type: none;
padding: 0;
margin: 0;
}

.user-list li {
display: flex;
align-items: center;
margin-bottom: 5px;
}

.user-list li span {
flex: 1;
}

.add-button {
background-color: #4CAF50;
padding: 5px 10px;
color: white;
border: none;
cursor: pointer;
}

.action-button {
background-color: #f44336;
padding: 5px 10px;
color: white;
border: none;
cursor: pointer;
}
</style>

{/literal}


<table>
    <tr>
        <th>Proyecto</th>
        <th>Usuarios</th>
        <th>Rol</th>
        <th>Acciones</th>
    </tr>
	{foreach from=$proyectos item=proyecto}
	{assign var="totalUsuarios" value=0}
	<tr>
	<td>{$proyecto.nombre_proyecto} </td>
	<td>
		<ul class='user-list'>
		{foreach from=$proyecto.usuarios item=usuario}{assign var=rand value=100000|mt_rand:999999}
			<li>
				<span>{$usuario.user_name}</span>
				<span>{$usuario.department}</span>
				<button class='action-button' onclick='eliminarUsuario(this)'>Eliminar</button>
			</li>
			{assign var="totalUsuarios" value=$totalUsuarios+1}
		{/foreach}
		</ul>
	</td>
	<td>Rol Proyecto 1</td>
	<td><button class='add-button' onclick='agregarUsuario()'>Agregar Usuario</button></td>
</tr>
<tr><td colspan='4'>Total de Usuarios: {$totalUsuarios}</td></tr>
{/foreach}

</table>