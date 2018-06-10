function enfoca() {
  var gebc = document.getElementsByClassName("enfocable");
  gebc[0].focus();
}

function asigate(codigo) {
  document.getElementById("codate").value = document.getElementById(codigo).value;
  var gebc = document.getElementsByClassName('enfocable');
  gebc[0].focus();
  gebc[0].click();
}
function ubica(){
  var msn = document.getElementById("asunto").value;
  var con = "//"
  document.getElementById("asunto").value=msn.concat(con);
  document.getElementById("asunto").select();
}
function dispara() {
  document.getElementById("codate").value="newatt";
}
function autoregv(){
  document.getElementById("autoregd").style.visibility= "visible";
  var gebc = document.getElementsByClassName("enfocable");
  gebc[1].focus();
}
function autoregi(){
  var gebc = document.getElementsByClassName("enfocable");
  gebc[0].focus();
  document.getElementById("autoregd").style.visibility= "hidden";
}
function validar() {
  if (document.getElementById("email1").value==document.getElementById("email2").value) {
    alert("Informacion validada!");
    document.getElementById("enviar").type="submit";
    var gebc = document.getElementsByClassName('enfocable');
    gebc[3].focus();
  }else {
    alert("Correos diferentes!");
    var gebc = document.getElementsByClassName('enfocable');
    gebc[2].focus();
    gebc[2].select();
  }
}
function verfal(){
  if(document.getElementById('abierto').checked==true){
    document.getElementById('abierto').value="2";
    document.getElementById('codate').value=document.getElementById('abierto').value;
  }
  if(document.getElementById('abierto').checked==false){
    document.getElementById('abierto').value="1";
    document.getElementById('codate').value=document.getElementById('abierto').value;
  }
}
function calcmargen() {
  document.getElementById('margen').value = parseFloat(document.getElementById('preofe').value)- parseFloat(document.getElementById('costo').value);
}
