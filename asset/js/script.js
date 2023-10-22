document.addEventListener("DOMContentLoaded", function () {
  signUpvalidation();
  slidingBar(); ///previewmenu slider
  menuQtyBtn(); ///menu quanity button
});
function signUpvalidation() {
  const form = document.getElementById("myForm");
  const nameInput = document.getElementById("name");
  const emailInput = document.getElementById("email");
  const passwordInput = document.getElementById("password");
  const addressInput = document.getElementById("address");
  const nameError = document.getElementById("nameError");
  const emailError = document.getElementById("emailError");
  const passwordError = document.getElementById("passwordError");
  const addressError = document.getElementById("addressError");

  const nameRegex = /^[A-Za-z]+(?: [A-Za-z]+)*$/; // Contain letters (UPPER and lower) no leading and trailing space
  const emailRegex = /^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/; //standard email
  const passwordRegex = /^(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8,}$/; // At least 8 characterslong, at least 1 upper case, 1 number, no special characeters

  if (form) {
    form.addEventListener("submit", function (e) {
      let valid = true;

      if (!nameRegex.test(nameInput.value)) {
        nameError.textContent =
          "Name should only contain letters and should not have leading or trailing spaces.";
        nameError.style.color = "red"; // Set the error message color to red
        valid = false;
      } else {
        nameError.textContent = "";
      }

      if (!emailRegex.test(emailInput.value)) {
        emailError.textContent = "Please enter a valid email address";
        emailError.style.color = "red"; // Set the error message color to red
        valid = false;
      } else {
        emailError.textContent = "";
      }

      if (!passwordRegex.test(passwordInput.value)) {
        passwordError.textContent =
          "Password must be at least 8 characters long and include at least 1 uppercase letter and 1 number. Special characters are not allowed";
        passwordError.style.color = "red"; // Set the error message color to red
        valid = false;
      } else {
        passwordError.textContent = "";
      }

      if (addressInput.value.trim() === "") {
        addressError.textContent = "Address is required";
        addressError.style.color = "red"; // Set the error message color to red
        valid = false;
      } else {
        addressError.textContent = "";
      }
      if (!valid) {
        e.preventDefault(); // Prevent form submission if there are errors
      }
    });
  }
}

function menuQtyBtn() {
  gridContainer = document.querySelector(".image-grid");
  if (gridContainer) {
    food = gridContainer.querySelectorAll("#menuGridclass");
    for (let i = 1; i <= food.length; i++) {
      //// i=1 because ID start from 1
      var qty = 0;

      leftArrow = document.getElementById(`decrement-index-${i}`);
      rightArrow = document.getElementById(`increment-index-${i}`);

      if (leftArrow) {
        leftArrow.addEventListener("click", () => {
          console.log(`Left Arrow Clicked ${i}`);

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

  // console.log(food.length);
}

function slidingBar() {
  let index = 0;
  const slider = document.querySelector(".slider");
  const btnLeft = document.querySelector(".slider-btn-left");
  const btnRight = document.querySelector(".slider-btn-right");
  if (slider) {
    const images = slider.querySelectorAll(".image-item");

    console.log(`Image Length Preview Menu: ${images.length}`);

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
