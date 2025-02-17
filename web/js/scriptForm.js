
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
const terrenos = document.querySelector('#terrenos');
if (valorCookie === "") {
    datos = null;
    selectOptions();
}else{
    datos = caller();
}
    //HAGO UNA LLAMADA A LA API PARA 
async function getJSON() {
    return fetch(`http://localhost/Apicultura/api/V1/apicultura/tipoTerrenos`)
        .then((response)=>response.json())
        .then((responseJson)=>{return responseJson});
}

async function caller() {
    datos = await getJSON();  // command waits until completion
    selectOptions();        
}

function selectOptions() {
    if (datos == null || datos == "") {
        let h1 = document.createElement("h1");
        h1.innerHTML=`Error`;
        document.appendChild(h1);
    }else{
        datos.forEach(linea => {
                let option = document.createElement("option");
                option.value = `${linea.tipo_terreno}`;
                option.innerHTML=`${linea.nombre}`;

                terrenos.appendChild(option);
        });
    }
}

const form = document.getElementById('formNuevoTerreno');
const nombre = document.getElementById('nombre');
const superficie = document.getElementById('superficie');
const refCat = document.getElementById('refCat');
const btnEnviar = document.getElementById('Enviar');
btnEnviar.style.display = "none";
form.addEventListener('change', (event) => {
  // Prevenir el envío del formulario por defecto
  event.preventDefault();
  
  validar();

});

function validar() {
      // Validar los campos del formulario
  if (nombre.value === '' || superficie.value === '' || refCat.value === '') {
    btnEnviar.style.display = "none";
    return
  }else{
    if (isNaN(superficie.value)) {
        btnEnviar.style.display = "none";
        return
    }
    btnEnviar.style.display = "inline";
    return
  }
}