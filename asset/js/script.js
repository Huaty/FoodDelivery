document.addEventListener("DOMContentLoaded", function () {
  signUpvalidation(); /// create validation for sign up form
  slidingBar(); ///Previewmenu slider
  menuFunction(); ///Entire User Menu Page Function
  adminPage();


  // ChangeEmail();
});
//Change Email
// function ChangeEmail() {
//   document.querySelector('form').addEventListener('submit', function(event) {
//       const newEmail = document.getElementById('newEmail').value;
//       const confirmNewEmail = document.getElementById('confirmNewEmail').value;
//       const currentEmail = document.getElementById('currentEmail') // Replace with the PHP variable

//       const newEmailError = document.getElementById('newEmailError');
//       const confirmNewEmailError = document.getElementById('confirmNewEmailError');

//       let isValid = true;

//       const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;

//       if (!emailRegex.test(newEmail)) {
//           newEmailError.textContent = 'Invalid email format for the new email address.';
//           isValid = false;
//       } else {
//           newEmailError.textContent = '';
//       }

//       if (newEmail.toLowerCase() !== currentEmail.toLowerCase()) {
//           newEmailError.textContent = 'The provided current email does not match your account.';
//           isValid = false;
//       } else {
//           newEmailError.textContent = '';
//       }

//       if (newEmail !== confirmNewEmail) {
//           confirmNewEmailError.textContent = 'New email and confirm email do not match.';
//           isValid = false;
//       } else {
//           confirmNewEmailError.textContent = '';
//       }

//       if (!isValid) {
//           event.preventDefault(); // Prevents the form from being submitted
//       } else {
//         errorDisplay.textContent = 'Change email successful!';
//       }
//   });
// }


//// Admin Page 
function adminPage(){
  createMenuButton = document.getElementById("submit-button-create-menu")
  if(createMenuButton){
    createMenuButton.addEventListener("click",function(event){
      console.log("click")
    })
  }

  var adminFoodDetails = new Map();

  const foodAdminNames = document.querySelectorAll(".admin-food-name");


 foodAdminNames.forEach((foodAdminName,index)=>{
  console.log(foodAdminName.innerText);

  adminFoodDetails.set(index+1,{name:foodAdminName.innerText})
 }) 




 adminFoodDetails.forEach((value,key)=>{
  console.log(value['name'])
  var foodAdminNameButton = document.getElementById(`${value['name']}`);
  var foodAdminForm = document.getElementById(`form-${value['name']}`);
  console.log(foodAdminNameButton);
  if(foodAdminNameButton){
    foodAdminNameButton.addEventListener("click",function(event){
      event.preventDefault();
      console.log(event.target.id)
      foodAdminForm.submit();
      console.log("click")
    })
  }


 })

}



/////User Menu Page Function

function menuFunction() {
  searchBar = document.getElementById("searchBar");
  cuisineBtn = document.querySelectorAll(".cuisine-button");
  searchForm  =  document.getElementById("searchForm");
  gridContainer = document.querySelector(".image-grid");
  searchCuisine = document.getElementById("searchCuisine");

  cuisineBtn.forEach((value,key)=>{
    if(value){
      value.addEventListener("click",function(event){
        console.log(event.target.innerText)

        searchCuisine.submit();
      })
    }
  })
  
  if(searchBar){
    let timeout = null;
    searchBar.addEventListener("input",function(event){
      clearTimeout(timeout);

      // Set a new timeout
      timeout = setTimeout(function() {
          searchForm.submit();
      }, 500);  // 500ms delay before submitting
  });

  }





  if (gridContainer) {
    var foodDetails = new Map();
    const idMenu = document.querySelectorAll(".id-menu");
    idMenu.forEach((value,key)=>{
      var i =value.id;
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
            console.log(`This is index is ${i}`)
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
          console.log(`This is index is ${i}`)
          qtyPlaceHolder = document.getElementById(`quantity-menu-${i}`);
          current.quantity += 1;
          qtyPlaceHolder.innerText = current.quantity;
          totalPrice = current.quantity * price;
          current.totalPrice = totalPrice;
          updateOrder(i, foodDetails, totalPrice);
        });
      }
      console.log(value.id)

    })
    // food = gridContainer.querySelectorAll("#menuGridclass");
    // for (let i = 1; i <= food.length; i++) {
     
    // }
    function updateOrder(i, foodDetails, totalPrice) {
      current = foodDetails.get(i);
      console.log(current)
      console.log(`I is ${i}`)
      let foodChoosen = document.getElementById(`food-choosen-${i}`);
      let foodChoosenText = document.getElementById(`food-choosen-text-${i}`);
      let updateOrderContent = document.getElementById("update-order");
      let foodIndexInput = document.getElementById(`index-food-${i}`);
      let quantityInput = document.getElementById(`input-quantity-${i}`);
      let priceInput = document.getElementById(`input-price-${i}`);
      let totalPriceInput = document.getElementById(`input-totalPrice-${i}`);

      if (!foodChoosen) {
        foodChoosen = document.createElement("div");
        foodChoosen.id = `food-choosen-${i}`;
        updateOrderContent.appendChild(foodChoosen);
        foodChoosenText = document.createElement("div");
        foodChoosenText.id = `food-choosen-text-${i}`;
        foodChoosen.appendChild(foodChoosenText);
      }

      const foodTitle = document.getElementById(`food-title-${i}`).innerText;
      foodChoosenText.innerText = `${foodTitle} x${current.quantity}      $${totalPrice}`;
      if (current.quantity === 0) {
        foodChoosenText.innerText = "";
        console.log("remove")
        updateOrderContent.removeChild(foodChoosen);
      }

      
      ////Create input for form to POST
      if (!foodIndexInput) {
        foodIndexInput= document.createElement("input");
        foodIndexInput.type = "hidden";
        foodIndexInput.id = `indexfood_${i}`;
        foodIndexInput.name = `indexfood_${i}`;
        foodChoosen.appendChild(foodIndexInput);
        console.log("success")

      }
      if (!quantityInput) {
        quantityInput = document.createElement("input");
        quantityInput.type = "hidden";
        quantityInput.id = `input-quantity-${i}`;
        quantityInput.name = `quantity_${i}`;
        foodChoosen.appendChild(quantityInput);
        console.log("success")

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
      foodIndexInput.value = i;
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

  toggleButton = document.querySelector('.toggleButton');
  if(toggleButton){
    toggleButton.addEventListener('click', function() {
      var content = document.querySelector(".content");
      if(content.style.display === 'none') {
        content.style.display = 'block';
        this.textContent = '▲';  // Change arrow direction
      } else {
        content.style.display = 'none';
        this.textContent = '▼';  // Change arrow direction
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
  const emailRegex = /^(?:[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+)$/;
  const passwordRegex = /^(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8,}$/; // At least 8 characterslong, at least 1 upper case, 1 number, no special characeters
  const specificEmails = ['f32ee@localhost', 'f31ee@localhost'];

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
      } else if (specificEmails.includes(email)) {
          return 'Specific email: Valid';
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


  //// For Profile Password Vaildation

  const changePasswordForm = document.getElementById("change-password-form");
  const changePasswordInput = document.getElementById("newpwd");
  const changepasswordError = document.getElementById("changepasswordError");



  if(changePasswordForm){

    changePasswordForm.addEventListener("submit", function (event) {
      var flag = true;
      if (!passwordRegex.test(changePasswordInput.value)) {
        changepasswordError.textContent =
          "Password must be at least 8 characters long and include at least 1 uppercase letter and 1 number. Special characters are not allowed";
        changepasswordError.style.color = "red"; // Set the error message color to red
        flag = false;
      } else {
        changepasswordError.textContent = "";
      }

      if(!flag){
        event.preventDefault();
      }

    })
  }
}
