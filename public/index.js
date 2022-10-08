let f = [];
//HEAD
function dropdown(){
  document.getElementById("myDropdown").classList.toggle("show");
}
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
// HOME
if (window.location.pathname === '/') {
  let slideIndex = 1;

  f['showSlides'] = function (n) {
    let i;
    let slides = document.getElementsByClassName('mySlides');
    let dots = document.getElementsByClassName('dot');
    if (n > slides.length) {slideIndex = 1}
    if (n < 1) {slideIndex = slides.length}
    for (i = 0; i < slides.length; i++) {
      slides[i].style.display = 'none';
    }
    for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(' active', '');
    }
    slides[slideIndex-1].style.display = 'block';
    dots[slideIndex-1].className += ' active';
  };

  f['plusSlides'] = function (n) {
    f['showSlides'](slideIndex += n);
  };

  f['currentSlide'] = function (n) {
    f['showSlides'](slideIndex = n);
  };

  f['showSlides'](slideIndex);
}
//REGISTRAZIONE

// ACQUISTO
if (window.location.pathname === '/acquisto') {
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
