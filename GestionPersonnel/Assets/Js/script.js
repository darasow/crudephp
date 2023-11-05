

var swiper = new Swiper(".mySwiperGrid", {
    spaceBetween: 1,
    grid: {
      rows:2,
    },
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
    keyboard: {
      enabled: true,
    },
    autoplay: {
      delay: 5000,
  disableOnInteraction: false
  },
  breakpoints: {
  450: {
    slidesPerView: 1,
    spaceBetween: 10,
      grid: {
      rows:2,
    },
  },
  572: {
    slidesPerView: 2,
    spaceBetween: 10,
      grid: {
      rows:2,
    },
  },
  882: {
    slidesPerView: 3,
    spaceBetween: 10,
      grid: {
      rows:2,
    },
   
  },
  1152: {
    slidesPerView: 4,
    spaceBetween: 10,
      grid: {
      rows:2,
    },
  },
  },
  }); 


  var supprimer = document.querySelectorAll(".supprimer");
  console.log(supprimer);
  supprimer.forEach(element => {
          element.addEventListener("click", (e)=>{
              if(confirm('Est-vous sur de supprimer ?'))
              {
                alert("Suppression effectuez avec succes");
              }else e.preventDefault();
          })
  });
  