document.addEventListener("DOMContentLoaded", function () {
  signUpvalidation(); /// create validation for sign up form
  slidingBar(); ///Previewmenu slider
  menuFunction(); ///Entire User Menu Page Function
});

/////User Menu Page Function

function menuFunction() {
  gridContainer = document.querySelector(".image-grid");
  if (gridContainer) {
    var foodDetails = new Map();
    food = gridContainer.querySelectorAll("#menuGridclass");
    for (let i = 1; i <= food.length; i++) {
      priceText = document.getElementById(`price-${i}`).innerText;
      priceText = priceText.replace("$", ""); // Remove the $ sign. Result: "10.50"
      let price = parseFloat(priceText);
      //// i=1 because ID start from 1
      foodDetails.set(i, { quantity: 0, price: price, totalPrice: 0 });

      leftArrow = document.getElementById(`decrement-index-${i}`);
      rightArrow = document.getElementById(`increment-index-${i}`);

      if (leftArrow) {
        leftArrow.addEventListener("click", () => {
          console.log(`Left Arrow Clicked ${i}`);
          current = foodDetails.get(i);
          if (current.quantity > 0) {
            qtyPlaceHolder = document.getElementById(`quantity-menu-${i}`);
            current.quantity -= 1;
            qtyPlaceHolder.innerText = current.quantity;
            totalPrice = current.quantity * price;
            current.totalPrice = totalPrice;
            updateOrder(i, foodDetails, totalPrice);
          }
        });
      }
      if (rightArrow) {
        rightArrow.addEventListener("click", () => {
          current = foodDetails.get(i);
          console.log(`Right Arrow Clicked ${i}`);
          qtyPlaceHolder = document.getElementById(`quantity-menu-${i}`);
          current.quantity += 1;
          qtyPlaceHolder.innerText = current.quantity;
          totalPrice = current.quantity * price;
          current.totalPrice = totalPrice;
          updateOrder(i, foodDetails, totalPrice);
        });
      }
    }
    function updateOrder(i, foodDetails, totalPrice) {
      current = foodDetails.get(i);
      let foodChoosen = document.getElementById(`food-choosen-${i}`);
      updateOrderContent = document.getElementById("update-order");
      let quantityInput = document.getElementById(`input-quantity-${i}`);
      let priceInput = document.getElementById(`input-price-${i}`);
      let totalPriceInput = document.getElementById(`input-totalPrice-${i}`);

      if (!foodChoosen) {
        foodChoosen = document.createElement("div");
        foodChoosen.id = `food-choosen-${i}`;
        updateOrderContent.appendChild(foodChoosen);
      }

      const foodTitle = document.getElementById(`food-title-${i}`).innerText;
      foodChoosen.innerText = `${foodTitle} x${current.quantity}      $${totalPrice}`;
      if (current.quantity == 0) {
        foodChoosen.innerText = "";
        updateOrderContent.removeChild(foodChoosen);
      }

      ////Create input for form to POST
      if (!quantityInput) {
        quantityInput = document.createElement("input");
        quantityInput.type = "hidden";
        quantityInput.id = `input-quantity-${i}`;
        quantityInput.name = `quantity_${i}`;
        foodChoosen.appendChild(quantityInput);
      }

      if (!priceInput) {
        priceInput = document.createElement("input");
        priceInput.type = "hidden";
        priceInput.id = `input-price-${i}`;
        priceInput.name = `price_${i}`;
        foodChoosen.appendChild(priceInput);
      }

      if (!totalPriceInput) {
        totalPriceInput = document.createElement("input");
        totalPriceInput.type = "hidden";
        totalPriceInput.id = `input-totalPrice-${i}`;
        totalPriceInput.name = `totalPrice_${i}`;
        foodChoosen.appendChild(totalPriceInput);
      }
      quantityInput.value = current.quantity;
      priceInput.value = current.price;
      totalPriceInput.value = totalPrice;
      updateTotalAmount(i, foodDetails);
    }
  }

  function updateTotalAmount(i, foodDetails) {
    var totalAmount = 0;
    totalAmountPlaceHolder = document.getElementById("total-amount");
    foodDetails.forEach((value, key) => {
      console.log(`Key: ${key} Value: ${value.quantity}`);
      totalAmount += parseFloat(value.totalPrice);
    });

    totalAmountPlaceHolder.innerText = totalAmount;
    submitButton(totalAmount);
  }
  function submitButton(totalAmount) {
    payNowBtn = document.getElementById("pay-button");
    form = document.getElementById("form-menu");
    var validState = false;
    if (totalAmount == 0) {
      document.getElementById("pay-button").disabled = true;
      validState = false;
    } else {
      document.getElementById("pay-button").disabled = false;
      validState = true;
    }
    payNowBtn.addEventListener("click", function (event) {
      if (validState === true) {
        form.submit();
        event.preventDefault();
      } else {
        event.preventDefault();
      }
    });
  }
}

/////Preview Menu Slider

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
//// Sign Up Form Validation

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
