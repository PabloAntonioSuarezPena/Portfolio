<div id="tablaArrendador">
    <div class="encabezadoTabla flex-row">
        <a href="index.php?ctl=nuevoTerreno"><button class="btn-table flex-row"><img class="icono" src="web/img/iconos/add.png" alt="Cruz de suma"><p>Nuevo terreno</p></button></a>
        <h1>LISTADO DE TERRENOS</h1>
    </div>
    <br><br><br>
        <table class="table" id="cuerpoTabla">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Referencia Catastral</th>
                    <th>Estado</th>
                    <th>Usuario</th>
                    <th>Tipo de Terreno</th>
                    <th>Superficie</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                <!-- Aquí irán las filas generadas dinámicamente a partir del JSON recibido -->
            </tbody>
        </table> 
    </div>
    <script src="web/js/script.js"></script>
           