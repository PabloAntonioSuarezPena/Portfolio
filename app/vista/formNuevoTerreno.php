<div id="formNuevoTerreno">
    <form action="index.php?ctl=validarFormTerreno" method="POST">
        <div class="caja2">
            <label>Nombre
                <input type="text" name="nombre" maxlength=40 id="nombre" />
            </label><br /><br />

            <label>Superficie (en ha)
                <input type="text" name="superficie" maxlength=40 id="superficie" />
            </label><br/><br/>

            <label>Referencia Catastral
                <input type="text" name="CatRef" maxlength=40 id="refCat" />
            </label><br/><br/>

            <label for="terrenos">Selecciona una opción:</label>
            <select id="terrenos" name="terrenos"></select>

            <br><br>
            <input class="controls" type="submit" value="Enviar" id="Enviar">
            <br><br>
            
        </div>
    </form>
</div>
        <script src="web/js/scriptForm.js"></script>