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

function obtenerParametroDeURL(nombre) {
    nombre = nombre.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
    var expresion = '[\\?&]' + nombre + '=([^&#]*)';
    var regex = new RegExp(expresion);
    var resultados = regex.exec(window.location.search);
    return resultados === null ? '' : decodeURIComponent(resultados[1].replace(/\+/g, ' '));
}

var id = obtenerParametroDeURL('idTerreno');
var datos;

const btnConfirmar = document.getElementById('btnConfirmar');

btnConfirmar.addEventListener('click', confirmar);

function confirmar() {
    btnConfirmar.removeEventListener("click", confirmar);
    datos = caller();
}

async function getJSON() {
    return fetch(`http://localhost/Apicultura/api/V1/apicultura/arrendador?id=${valorCookie}&idTerreno=${id}`
            , {method:"DELETE"})
        .then((response)=>response.json())
        .then((responseJson)=>{return responseJson});
}

async function caller() {
    datos = await getJSON();  // command waits until completion
    mensajeAlerta();
}

const borrarDiv = document.getElementById("borrarForm");

function mensajeAlerta() {
    borrarDiv.innerHTML = `
        <h1>${datos}</h1>
        <h2>Redirigiendo al menú</h2>
        `;
        id=setInterval(() => {
            window.location.href = "http://localhost/Apicultura/index.php?ctl=verTerrenos";
        }, 2000);
}