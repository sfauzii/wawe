// let swiperCards = new Swiper('.card__content', {

// loop: true,

// // If we need pagination
// pagination: {
// el: '.swiper-pagination',
// },

// // Navigation arrows
// navigation: {
// nextEl: '.swiper-button-next',
// prevEl: '.swiper-button-prev',
// },


// });

let prevScrollpos = window.pageYOffset; /* Simpan posisi scroll sebelumnya */

window.onscroll = function() {
let currentScrollPos = window.pageYOffset;
if (prevScrollpos > currentScrollPos) {
document.getElementById("navbar").style.top = "20px"; /* Scroll ke atas, tampilkan navbar */
} else {
document.getElementById("navbar").style.top = "-110px"; /* Scroll ke bawah, sembunyikan navbar */
}
prevScrollpos = currentScrollPos;
}


// SECTION FAQ
document.addEventListener('DOMContentLoaded', function() {
    var faqCards = document.querySelectorAll('.faq-card');
  
    faqCards.forEach(function(card) {
      card.addEventListener('click', function() {
        var answer = this.querySelector('.faq-answer');
        
        if (this.classList.contains('active')) {
          this.classList.remove('active');
          answer.style.maxHeight = null;
        } else {
          this.classList.add('active');
          answer.style.maxHeight = answer.scrollHeight + 'px';
        }
      });
    });
  });
  

  // TOMBOL FILTER CATALOG DI MOBILE
function toggleMobileMenu() {
  const mobileMenu = document.querySelector('.mobile-menu');
  mobileMenu.classList.toggle('active');
}


// CHECKBOX SORT
function submitForm(checkbox) {
  // Check if this checkbox is being checked or unchecked
  if (checkbox.checked) {
      // Uncheck other checkboxes
      document.querySelectorAll('input[name="sort"]').forEach(cb => {
          if (cb !== checkbox) cb.checked = false;
      });
  }

  // Submit the form
  document.getElementById('sortForm').submit();
}


// START LOGIN POPUP
document.querySelectorAll('#login-btn').forEach(function (button) {
    button.addEventListener('click', function (event) {
        event.preventDefault()
        document.getElementById('login-popup').style.display = 'flex'
    })
})

// Hide the popup if clicked outside of the card
window.addEventListener('click', function (event) {
    const popup = document.getElementById('login-popup')
    if (event.target === popup) {
        popup.style.display = 'none'
    }
})
// END LOGIN POPUP

