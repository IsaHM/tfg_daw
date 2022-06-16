/* 
  Permite desplegar la ventana modal del carrito de compra en la página "tienda.php"
  Incluye jQuery mediante Bootstrap
*/

var myModal = document.getElementById('myModal')
var myInput = document.getElementById('myInput')

myModal.addEventListener('shown.bs.modal', function () {
  myInput.focus()
})