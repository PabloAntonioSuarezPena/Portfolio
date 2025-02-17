<div id="login">
    <form action="index.php?ctl=validar" method="POST">
        <div class="caja2">
            <label>Correo electronico
                <input type="text" name="correo" maxlength=40 />
            </label><br /><br />

            <label>Contraseña
                <input type="password" name="clave" maxlength=40 />
            </label><br/><br/>

            <label for="usuarios">Selecciona una opción:</label>
            <select id="usuarios" name="usuarios">
                <option value="apicultor">Apicultor</option>
                <option value="arrendador">Arrendador</option>
            </select>

            <br><br>
            <input class="controls" type="submit" value="Enviar ">
            <br><br>

            <p>¿No eres usuario? <a href="#">Registrate</a></p>
            
        </div>
    </form>
    <?php if ($error) : ?>   
            <div class='centrado1' >Error al validar usuario y contraseña</div>
    <?php endif;
    ?>
</div>