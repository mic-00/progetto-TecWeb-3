window.onload = () => { document.getElementById('back-to-top').classList.add('hidden'); };

window.onscroll = function () {
  if (document.body.scrollTop > 150 || document.documentElement.scrollTop > 150) {
    document.getElementById('back-to-top').classList.remove('hidden');
  } else {
    document.getElementById('back-to-top').classList.add('hidden');
  }
}

let f = [];

const inputIsValid = function (input, alert, validRegex) {
  if (input.value.match(validRegex)) {
    alert.classList.add('hidden')
    input.classList.remove('danger');
    return true;
  } else {
    alert.classList.remove('hidden');
    input.classList.add('danger');
    return false;
  }
}

// HOME
if (window.location.pathname === '/') {
  let slideIndex = 1;

  f['showSlides'] = function (n) {
    const slides = document.getElementsByClassName('slide');
    const dots = document.getElementsByClassName('dot');
    if (n > slides.length) { slideIndex = 1; }
    if (n < 1) { slideIndex = slides.length; }
    for (let i = 0; i < slides.length; i++) {
      slides[i].classList.add('sr-only');
    }
    for (let i = 0; i < dots.length; i++) {
      dots[i].classList.remove('active');
    }
    slides[slideIndex - 1].classList.remove('sr-only');
    dots[slideIndex-1].classList.add('active');
  };

  f['plusSlides'] = function (n) {
    f['showSlides'](slideIndex += n);
  };

  f['currentSlide'] = function (n) {
    f['showSlides'](slideIndex = n);
  };

  f['showSlides'](slideIndex);
}

// REGISTRAZIONE
// MODIFICA DATI UTENTE
// MODIFICA DATI AMMINISTRATORE
if (window.location.pathname === '/registrazione'
    || window.location.pathname === '/area-utente/informazioni-personali/modifica'
    || window.location.pathname === '/area-amministratore/informazioni-personali/modifica') {
  f['formIsValid'] = function (event) {
    if (!f['validateUsername']() || !f['validateEmail']() || !f['validatePwd']()) {
      event.preventDefault();
      if (!f['validateUsername']())
        document.getElementById('username').focus();
      else if (!f['validateEmail']())
        document.getElementById('email').focus();
      else
        document.getElementById('password').focus();
      return false;
    }
    return true;
  }

  f['validateUsername'] = function () {
    const input = document.getElementById('username');
    const alert = document.getElementById('username-alert');
    const validRegex = /^(?=.{4,10}$)(?![_.])(?!.*[_.]{2})[a-zA-Z0-9]+(?<![_.])$/;
    return inputIsValid(input, alert, validRegex);
  };

  f['validateEmail'] = function () {
    const input = document.getElementById('email');
    const alert = document.getElementById('email-alert');
    const validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;
    return inputIsValid(input, alert, validRegex);
  };

  f['validatePwd'] = function () {
    const input = document.getElementById('password');
    const alert = document.getElementById('pwd-alert');
    const validRegex = [ /^\w{8,}$/, /[0-9]+/, /[A-Z]+/ ];
    if (validRegex.every((regex) => input.value.match(regex))) {
      alert.classList.add('hidden')
      input.classList.remove('danger');
      return true;
    } else {
      alert.classList.remove('hidden');
      input.classList.add('danger');
      return false;
    }
  }
}

// ACQUISTO
// RIPARAZIONE
// GESTIONE MODELLI
if (window.location.pathname === '/acquisto'
    || window.location.pathname === '/riparazione'
    || window.location.pathname === '/area-amministratore/gestione-modelli'
    || window.location.pathname === '/area-amministratore/gestione-modelli/aggiungi'
    || window.location.pathname === '/area-amministratore/aggiungi-articolo') {
  fetch('/public/brands.php')
      .then((res) => res.json())
      .then(function (data) {
        const selectBrand = document.getElementById('brand');
        data.forEach(function (a) {
          const option = document.createElement('option');
          option.setAttribute('value', a);
          const text = document.createTextNode(a);
          option.appendChild(text);
          selectBrand.appendChild(option);
        });
        if (data.length)
          selectBrand.removeAttribute('disabled');
      });

  f['getModels'] = function () {
    const selectBrand = document.getElementById('brand');
    fetch(`/public/models.php?brand=${selectBrand.value}`)
        .then((res) => res.json())
        .then(function (data) {
          const selectModel = document.getElementById('model');
          while(selectModel.childElementCount > 1)
            selectModel.removeChild(selectModel.lastChild);
          data.forEach(function (a) {
            const option = document.createElement('option');
            option.setAttribute('value', a);
            const text = document.createTextNode(a);
            option.appendChild(text);
            selectModel.appendChild(option);
          });
          if (data.length)
            selectModel.removeAttribute('disabled');
          else
            selectModel.setAttribute('disabled', 'disabled');
        });
  }
}

// RIPARAZIONE
if (window.location.pathname === '/riparazione') {
  f['enableAlt'] = function () {
    if (document.getElementById("image").files.length) {
      document.getElementById("alt").removeAttribute("disabled");
    } else {
      document.getElementById("alt").setAttribute("disabled", "disabled");
      document.getElementById("alt").classList.remove("danger");
      document.getElementById("alt-alert").classList.add("hidden");
    }
  };

  f['resetForm'] = function () {
    const form = document.getElementById('repair-form');
    form.reset();
    f['enableAlt']();
  }

  f['formIsValid'] = function (event) {
    if (!f['validateDescription']() || !f['validateAlt']()) {
      event.preventDefault();
      if (!f['validateDescription']())
        document.getElementById('description').focus();
      else
        document.getElementById('alt').focus();
      return false;
    }
    return true;
  }

  f['validateDescription'] = function () {
    const input = document.getElementById('description');
    const alert = document.getElementById('desc-alert');
    const validRegex = /\w+/;
    return inputIsValid(input, alert, validRegex);
  }

  f['validateAlt'] = function () {
    const input = document.getElementById('alt');
    if (input.disabled)
      return true;
    const alert = document.getElementById('alt-alert');
    const validRegex = /\w+/;
    return inputIsValid(input, alert, validRegex);
  }
}

// AREA AMMINISTRATORE -> GESTIONE RIPARAZIONI
if (window.location.pathname === '/area-amministratore/gestione-riparazioni') {
  f['formIsValid'] = function (event) {
    if (!f['validateCost']() || !f['validateTime']()) {
      event.preventDefault();
      if (!f['validateCost']())
        document.getElementById('cost').focus();
      else
        document.getElementById('time').focus();
      return false;
    }
    return true;
  }

  f['validateCost'] = function () {
    const input = document.getElementById('cost');
    const alert = document.getElementById('cost-alert');
    const validRegex = /^[0-9]+.[0-9]{2}$|^[0-9]+$/;
    return inputIsValid(input, alert, validRegex);
  }

  f['validateTime'] = function () {
    const input = document.getElementById('time');
    const alert = document.getElementById('time-alert');
    const validRegex = /^[0-9]+$/;
    return inputIsValid(input, alert, validRegex);
  }
}