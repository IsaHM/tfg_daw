/*
    Lee la longitud del texto a introducir (por ej. "programadores") y la suma uno a uno.
    Al llegar al final de la sumar, invierte el efecto para restar uno por uno los valores de la misma longitud.
    Al restar todos los valores, cambia el valor del texto y repite el proceso de forma cíclica.
*/

var TxtRotate = function (el, toRotate, period) {
  this.toRotate = toRotate;
  this.el = el;
  this.loopNum = 0;
  this.period = parseInt(period, 10) || 2000;
  this.txt = "";
  this.tick();
  this.isDeleting = false;
};

TxtRotate.prototype.tick = function () {
  var i = this.loopNum % this.toRotate.length;
  var fullTxt = this.toRotate[i];
  var that = this;
  var aux = 200 - Math.random() * 100;

  if (this.isDeleting) {
    this.txt = fullTxt.substring(0, this.txt.length - 1);
  } else {
    this.txt = fullTxt.substring(0, this.txt.length + 1);
  }

  this.el.innerHTML = '<span class="wrap">' + this.txt + "</span>";

  if (this.isDeleting) {
    aux /= 2;
  }

  if (!this.isDeleting && this.txt === fullTxt) {
    aux = this.period;
    this.isDeleting = true;
  } else if (this.isDeleting && this.txt === "") {
    this.isDeleting = false;
    this.loopNum++;
    aux = 500;
  }

  setTimeout(function () {
    that.tick();
  }, aux);
};

window.onload = function () {
  var elements = document.getElementsByClassName("txt_rotar");
  for (var i = 0; i < elements.length; i++) {
    var toRotate = elements[i].getAttribute("data-rotate");
    var period = elements[i].getAttribute("data-period");
    if (toRotate) {
      new TxtRotate(elements[i], JSON.parse(toRotate), period);
    }
  }
  var css = document.createElement("style");
  css.type = "text/css";
  css.innerHTML = ".txt_rotar > .wrap { border-right: 0.08em solid #666 }";
  document.body.appendChild(css);
};