// GUARDO LAS COOKES Y BUSCO LA DEL ID DE SESION
var cookies = document.cookie;
var arrayCookies = cookies.split(";");
var valorCookie = "";
for(var i = 0; i< arrayCookies.length; i++){
    var parCookie = arrayCookies[i].split("=");
    var nomCookie = parCookie[0].trim();
    if (nomCookie === "idArrendador") {
        valorCookie = parCookie[1];
        break;
    }
}

var datos;
const cuerpoTabla = document.querySelector('#cuerpoTabla');
if (valorCookie === "") {
    datos = null;
    rellenarTabla();
}else{
    datos = caller();
}
    //HAGO UNA LLAMADA A LA API PARA RECIBIR LOS DATOS ASICIADOS AL ID RECIBIDO EN LA COOKIE
async function getJSON() {
    return fetch(`http://localhost/Apicultura/api/V1/apicultura/arrendador?id=${valorCookie}`)
        .then((response)=>response.json())
        .then((responseJson)=>{return responseJson});
}

async function caller() {
    datos = await getJSON();  // command waits until completion
    rellenarTabla();         
}

function rellenarTabla() {
    if (datos == null || datos == "" || datos['Error: ']) {
        let h1 = document.createElement("h1");
        h1.innerHTML=`El usuario no cuenta con terrenos asociados`;
        const tablaCompleta = document.querySelector('#tablaArrendador');
        tablaCompleta.removeChild(cuerpoTabla);
        tablaCompleta.appendChild(h1);
    }else{
        datos.forEach(linea => {
                let tr = document.createElement("tr");
                tr.innerHTML=`
                    <td>${linea.idTerreno}</td>
                    <td>${linea.nombre}</td>
                    <td>${linea.referencia_catastro}</td>
                    <td>${linea.estado}</td>
                    <td>${linea.usuario}</td>
                    <td>${linea.nombreTerreno}</td>
                    <td>${linea.superficie} ha</td>
                    <td> <a href="index.php?ctl=confirmarBorrado&idTerreno=${linea.idTerreno}"><img class="icono" src="web/img/iconos/papelera.png" alt="Borrar"></button></a> </td>
                `;
                console.log(linea.idTerreno);
                cuerpoTabla.appendChild(tr);
        });
    }
}
