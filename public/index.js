window.onload = () => {
  document.getElementById('back-to-top').classList.add('hidden');

  const inputIsValid = function (input, alert, validRegex) {
    const cond = input.disabled || Array.isArray(validRegex)
        ? validRegex.every((regex) => input.value.match(regex))
        : input.value.match(validRegex);
    if (cond) {
      alert.classList.add('hidden')
      input.classList.remove('danger');
      return true;
    } else {
      alert.classList.remove('hidden');
      input.classList.add('danger');
      return false;
    }
  };

  const formIsValid = function (inputs, alerts, validRegexes, event) {
    let i = 0;
    while (inputIsValid(inputs[i], alerts[i], validRegexes[i]) && i < inputs.length) i++;
    if (i < inputs.length) {
      event.preventDefault();
      inputs[i].focus();
      return false;
    }
    return true;
  };

  // HOME
  let slideIndex = 1;

  const showSlides = function (n) {
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

  const plusSlides = function (n) {
    showSlides(slideIndex += n);
  };

  const currentSlide = function (n) {
    showSlides(slideIndex = n);
  };

  if (window.location.pathname === '/') {
    showSlides(slideIndex);
    const prevs = document.getElementsByClassName('prev');
    for (let i = 0; i < prevs.length; ++i) {
      prevs[i].onclick = () => plusSlides(-1);
    }
    const nexts = document.getElementsByClassName('next');
    for (let i = 0; i < nexts.length; ++i) {
      nexts[i].onclick = () => plusSlides(1);
    }
    const dots = document.getElementsByClassName('dot');
    for (let i = 0; i < dots.length; ++i) {
      dots[i].onclick = () => currentSlide(i + 1);
    }
  }

  // REGISTRAZIONE
  // MODIFICA DATI UTENTE
  // MODIFICA DATI AMMINISTRATORE
  if (window.location.pathname === '/registrazione'
      || window.location.pathname === '/area-utente/informazioni-personali/modifica'
      || window.location.pathname === '/area-amministratore/informazioni-personali/modifica') {
    const username = document.getElementById("username");
    const usernameAlert = document.getElementById('username-alert');
    const usernameRegex = /^[a-z|0-9]{4,10}$/;
    const email = document.getElementById('email');
    const emailAlert = document.getElementById('email-alert');
    const emailRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;
    const password = document.getElementById('password');
    const passwordAlert = document.getElementById('pwd-alert');
    const passwordRegex = [ /^\w{8,}$/, /[0-9]+/, /[A-Z]+/ ];

    username.onchange = () => inputIsValid(username, usernameAlert, usernameRegex);
    email.onchange = () => inputIsValid(email, emailAlert, emailRegex);
    password.onchange = () => inputIsValid(password, passwordAlert, passwordRegex);
    document.getElementsByClassName('form')[0].onsubmit = (event) => {
      const inputs = [ username, email, password ];
      const alerts = [ usernameAlert, emailAlert, passwordAlert ];
      const regex = [ usernameRegex, emailRegex, passwordRegex ];
      return formIsValid(inputs, alerts, regex, event);
    };
  }

  // ACQUISTO
  // RIPARAZIONE
  // GESTIONE MODELLI
  if (window.location.pathname === '/negozio'
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
    document.getElementById('brand').onchange = (event) => {
      fetch(`/public/models.php?brand=${event.target.value}`)
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
    };
  }

  // RIPARAZIONE
  const enableAlt = () => {
    if (document.getElementById('image').files.length) {
      document.getElementById('alt').removeAttribute('disabled');
    } else {
      document.getElementById('alt').setAttribute('disabled', 'disabled');
      document.getElementById('alt').classList.remove('danger');
      document.getElementById('alt-alert').classList.add('hidden');
    }
  };

  const resetForm = () => {
    document.getElementById('repair-form').reset();
    const select = document.getElementById('model');
    select.innerHTML = "<option value=''>--Seleziona--</option>";
    enableAlt();
  };

  if (window.location.pathname === '/riparazione') {
    const description = document.getElementById('description');
    const descriptionAlert = document.getElementById('desc-alert');
    const descriptionRegex = /\w+/;
    const alt = document.getElementById('alt');
    const altAlert = document.getElementById('alt-alert');
    const altRegex = /\w+/;

    description.onchange = () => inputIsValid(description, descriptionAlert, descriptionRegex);
    alt.onchange = () => inputIsValid(alt, altAlert, altRegex);
    document.getElementById('image').onchange = () => enableAlt()
    document.getElementById('reset-button').onclick = () => resetForm();
    document.getElementById('repair-form').onsubmit = (event) => {
      const inputs = [ description, alt ];
      const alert = [ descriptionAlert, altAlert ];
      const regex = [ descriptionRegex, altRegex ];
      return formIsValid(inputs, alert, regex, event);
    };
  }

  // AREA AMMINISTRATORE -> GESTIONE RIPARAZIONI
  if (window.location.pathname === '/area-amministratore/gestione-riparazioni') {
    const cost = document.getElementById('cost');
    const costAlert = document.getElementById('cost-alert');
    const costRegex = /^[0-9]+.[0-9]{2}$|^[0-9]+$/;
    const time = document.getElementById('time');
    const timeAlert = document.getElementById('time-alert');
    const timeRegex = /^[0-9]+$/;

    cost.onchange = () => inputIsValid(cost, costAlert, costRegex);
    time.onchange = () => inputIsValid(time, timeAlert, timeRegex);
    document.getElementsByClassName('form')[0].onsubmit = (event) => {
      const inputs = [ cost, time ];
      const alerts = [ costAlert, timeAlert ];
      const regexes = [ costRegex, timeRegex ];
      return formIsValid(inputs, alerts, regexes, event);
    }
  }
};

window.onscroll = function () {
  if (document.body.scrollTop > 150 || document.documentElement.scrollTop > 150) {
    document.getElementById('back-to-top').classList.remove('hidden');
  } else {
    document.getElementById('back-to-top').classList.add('hidden');
  }
}