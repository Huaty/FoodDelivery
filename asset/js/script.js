document.addEventListener("DOMContentLoaded", function () {
  const slider = document.querySelector(".slider");
  const btnLeft = document.querySelector(".slider-btn-left");
  const btnRight = document.querySelector(".slider-btn-right");
  const images = slider.querySelectorAll("img");
  let index = 0;

  console.log(images.length);

  btnLeft.addEventListener("click", () => {
    index--;
    if (index < 0) index = images.length - 1;
    updateSlider();
  });

  btnRight.addEventListener("click", () => {
    index++;
    if (index >= images.length) index = 0;
    updateSlider();
  });

  function updateSlider() {
    const offset = -index * 10;
    slider.style.transform = `translateX(${offset}%)`;
  }
});
