
//view.js: Algoritmo que define as configurações ideais de funcionamento da integração.

//Checkbox que habilita a integração com o PagSeguro Sandbox
var is_sandbox = document.getElementById("is_sandbox");

//Mapeando os campos de inserção do PagSeguro
var true_outputs = {
  "email" : document.getElementById("true_email").parentNode.parentNode,
  "token" : document.getElementById("true_token").parentNode.parentNode,
},
sandbox_outputs = {
  "email" : document.getElementById("sandbox_email").parentNode.parentNode,
  "token" : document.getElementById("sandbox_token").parentNode.parentNode,
};

/* Ação de mostrar os campos de inserção, de acordo com
o booleano retornado por 'is_sandbox.checked' (L:21) */

var mostrar_campos = function ( show, hide ) {
  show["email"].style.display = "table-row";
  show["token"].style.display = "table-row";
  hide["email"].style.display = "none";
  hide["token"].style.display = "none";
}

//Estrutura condicional que checa o estado inicial dos campos de inserção.
if ( is_sandbox.toString().length ) {
  if ( is_sandbox.checked ) {
    mostrar_campos( sandbox_outputs, true_outputs );
  } else {
    mostrar_campos( true_outputs, sandbox_outputs );
  }
}

/* Evento que ouve a alteração do checkbox 'is_sandbox' (L:1)
e modifica em tempo real o estado dos campos de inserção. */
is_sandbox.onclick = function () {
  if ( is_sandbox.checked ) {
    mostrar_campos( sandbox_outputs, true_outputs );
  } else {
    mostrar_campos( true_outputs, sandbox_outputs );
  }
}
