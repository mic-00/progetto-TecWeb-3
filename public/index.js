window.onscroll = function () {
  if (document.body.scrollTop > 150 || document.documentElement.scrollTop > 150) {
    document.getElementById('back-to-top').classList.remove('hidden');
  } else {
    document.getElementById('back-to-top').classList.add('hidden');
  }
}

const backToTop = function () {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}

let f = [];

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
  f['validateUsername'] = function () {
    const input = document.getElementById('username');
    const alert = document.getElementById('username-alert');
    const validRegex = /^\w+$/;
    if (input.value.match(validRegex)) {
      alert.classList.add('hidden')
      input.classList.remove('danger');
    } else {
      alert.classList.remove('hidden');
      input.classList.add('danger');
      input.value = null;
    }
  };

  f['validateEmail'] = function () {
    const input = document.getElementById('email');
    const alert = document.getElementById('email-alert');
    const validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;
    if (input.value.match(validRegex)) {
      alert.classList.add('hidden')
      input.classList.remove('danger');
    } else {
      alert.classList.remove('hidden');
      input.classList.add('danger');
      input.value = null;
    }
  };

  f['validatePwd'] = function () {
    const input = document.getElementById('password');
    const alert = document.getElementById('pwd-alert');
    const validRegex = [ /^\w{8,}$/, /[0-9]+/, /[A-Z]+/ ];
    if (validRegex.every((regex) => input.value.match(regex))) {
      alert.classList.add('hidden')
      input.classList.remove('danger');
    } else {
      alert.classList.remove('hidden');
      input.classList.add('danger');
      input.value = null;
    }
  }
}

// ACQUISTO
// RIPARAZIONE
if (window.location.pathname === '/acquisto' || window.location.pathname === '/riparazione') {
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
    }
  };

  f['resetForm'] = function () {
    const form = document.getElementById('repair-form');
    form.reset();
    f['enableAlt']();
  }
}
