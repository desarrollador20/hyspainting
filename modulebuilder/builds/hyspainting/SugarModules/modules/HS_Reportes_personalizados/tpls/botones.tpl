<div>
    <button id="btnUsuarios" class="button" onclick="setReportes('setreportesusuarios');">Usuarios</button>
    <button id="btnProyectos" class="button" onclick="setReportes('setreportesproyectos');">Proyectos</button>
</div>


{literal}
<script>
    function setReportes(action) {
        location.replace('./index.php?module=HS_Reportes_personalizados&action=' + action);
    }
</script>
{/literal}