
function myFunction() {
  var x = document.getElementById("mimenu");
  if (x.className === "menu") {
    x.className += " responsive";
  } else {
    x.className = "menu";
  }
}


function comp_tipo(){
  let pais = document.getElementById("pais").value;
  let tipo = document.getElementById("tipo").value;
  if( tipo == "fisica" ){
      document.getElementById("doc_pasaporte").removeAttribute("disabled","");
      document.getElementById("persona_nombre").removeAttribute("disabled", "");
      document.getElementById("persona_apellidos").removeAttribute("disabled", "");
      document.getElementById("sociedad").setAttribute("disabled","disabled");
      document.getElementById("doc_cif").setAttribute("disabled","disabled");
      //quito texto
      document.getElementById("sociedad").value="";
      document.getElementById("doc_cif").value="";
      document.getElementById("sociedad_error").style.display="none";
      document.getElementById("cif_error").style.display="none";

      if ( pais=="esp"){
          document.getElementById("doc_nie").setAttribute("disabled","disabled");
          document.getElementById("doc_dni").removeAttribute("disabled", "");
          //quito texto 
          document.getElementById("doc_nie").value="";
          document.getElementById("nie_error").style.display="none";
      } else{
          document.getElementById("doc_dni").value="";
          document.getElementById("dni_error").style.display="none";
          document.getElementById("doc_dni").setAttribute("disabled","disabled");
          document.getElementById("doc_nie").removeAttribute("disabled", "");
      }
  } else {
      //quitar texto y span 
      document.getElementById("persona_nombre").value="";
      document.getElementById("persona_apellidos").value="";
      document.getElementById("doc_dni").value="";
      document.getElementById("doc_nie").value="";
      document.getElementById("doc_pasaporte").value="";
      document.getElementById("nombre_error").style.display="none";
      document.getElementById("ape_error").style.display="none";
      document.getElementById("dni_error").style.display="none";
      document.getElementById("nie_error").style.display="none";
      document.getElementById("pasaporte_error").style.display="none";
    //
      document.getElementById("sociedad").removeAttribute("disabled", "");
      document.getElementById("doc_cif").removeAttribute("disabled", "");
      document.getElementById("persona_nombre").setAttribute("disabled","disabled");
      document.getElementById("persona_apellidos").setAttribute("disabled","disabled");
      document.getElementById("doc_dni").setAttribute("disabled","disabled");
      document.getElementById("doc_nie").setAttribute("disabled", "disabled");
      document.getElementById("doc_pasaporte").setAttribute("disabled", "disabled");
  }

}
$(document).ready(
comp_tipo()
);

function comp_direccion(){
let ok=false;
let nombre = document.getElementById('direccion').value;
let patron    =  /[a-zA-Z]{3,}/ ;
if (patron.test(nombre) ){
  document.getElementById("direccion_error").style.display="none";
  ok=true;
} else {
  document.getElementById("direccion_error").style.display="block";


return true; }
}
function comp_pasaporte(){
let ok=false;
let nombre = document.getElementById('doc_pasaporte').value;
let patron    =  /[a-zA-Z]{3,}/ ;
if (patron.test(nombre)){
  document.getElementById("pasaporte_error").style.display="none";
  ok=true;
} else {
  document.getElementById("pasaporte_error").style.display="block";

return true; }
}
function comp_nombre(){
let ok=false;
let nombre = document.getElementById('persona_nombre').value;
let patron    =  /[a-zA-Z]{3,}/ ;
if (patron.test(nombre)){
  document.getElementById("nombre_error").style.display="none";
  ok=true;
} else {
  document.getElementById("nombre_error").style.display="block";
return true; }
}

function comp_ape(){
let ok=false;
let nombre = document.getElementById('persona_apellidos').value;
let patron    =  /[a-zA-Z]{3,}/ ;
if (patron.test(nombre)){
  document.getElementById("ape_error").style.display="none";
  ok=true;
} else {
  document.getElementById("ape_error").style.display="block";
return true;
}
}

function comp_sociedad(){
let ok=false;
let nombre = document.getElementById('sociedad').value;
let patron    =  /[a-zA-Z]{3,}/ ;
if (patron.test(nombre)){
  document.getElementById("sociedad_error").style.display="none";
  ok=true;
} else {
  document.getElementById("sociedad_error").style.display="block";
return true;
}
}

function comp_dni(){
let ok=false;
let nombre = document.getElementById('doc_dni').value;
let patron    =  /[0-9]{8}[a-zA-z]{1}/ ;
if (patron.test(nombre)){
  document.getElementById("dni_error").style.display="none";
  ok=true;
} else {
  document.getElementById("dni_error").style.display="block";
return true;
}
}

function comp_nie(){
let ok=false;
let nombre = document.getElementById('doc_nie').value;
let patron    =  /^[a-zA-Z]{1}[0-9]{7}[a-zA-Z]{1}/ ;
if (patron.test(nombre)){
document.getElementById("nie_error").style.display="none";
document.getElementById("doc_nie").className+="border-success";
ok=true;
} else {
document.getElementById("nie_error").style.display="block";
document.getElementById("doc_nie").classList.remove("border-success");
return true;
}
}
function comp_cif(){
let ok=false;
let nombre = document.getElementById('doc_cif').value;
let patron    =  /[a-zA-Z][0-9]{9}/ ;
if (patron.test(nombre)){
document.getElementById("cif_error").style.display="none";
document.getElementById("doc_cif").className+="border-success";
ok=true;
} else {
document.getElementById("cif_error").style.display="block";
document.getElementById("doc_cif").classList.remove("border-success");
return true;
}
}
function comp_cp(){
let ok=false;
let nombre = document.getElementById('cp').value;
let patron    =  /[0-9]{4}/ ;
if (patron.test(nombre)){
  document.getElementById("cp_error").style.display="none";
  document.getElementById("cp").className+="border-success";
} else {
  document.getElementById("cp_error").style.display="block";
  document.getElementById("cp").classList.remove("border-success");
}
return ok;

}

  
