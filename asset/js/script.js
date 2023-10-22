document.addEventListener("DOMContentLoaded", function () {
  slidingBar(); ///previewmenu slider
  menuQtyBtn(); ///menu quanity button
});

function menuQtyBtn() {
  gridContainer = document.querySelector(".image-grid");
  food = gridContainer.querySelectorAll("#menuGridclass");
  // console.log(food.length);

  for (let i = 1; i <= food.length; i++) {
    //// i=1 because ID start from 1
    var qty = 0;
    console.log(`decrement-index-${i}`);

    leftArrow = document.getElementById(`decrement-index-${i}`);
    rightArrow = document.getElementById(`increment-index-${i}`);

    if (leftArrow) {
      leftArrow.addEventListener("click", () => {
        console.log(`Left Arrow Clicked ${i}`);
        console.log(`quantity-menu-${i}`);
        if (qty > 0) {
          qtyPlaceHolder = document.getElementById(`quantity-menu-${i}`);
          qty -= 1;
          qtyPlaceHolder.innerText = qty;
        }
      });
    }
    if (rightArrow) {
      rightArrow.addEventListener("click", () => {
        console.log(`Right Arrow Clicked ${i}`);
        qtyPlaceHolder = document.getElementById(`quantity-menu-${i}`);
        qty += 1;
        qtyPlaceHolder.innerText = qty;
      });
    }
  }
}

function slidingBar() {
  let index = 0;
  const slider = document.querySelector(".slider");
  const btnLeft = document.querySelector(".slider-btn-left");
  const btnRight = document.querySelector(".slider-btn-right");
  if (slider) {
    const images = slider.querySelectorAll(".image-item");

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
  }
}
