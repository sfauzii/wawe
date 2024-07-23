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
document.getElementById("navbar").style.top = "-80px"; /* Scroll ke bawah, sembunyikan navbar */
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
  
