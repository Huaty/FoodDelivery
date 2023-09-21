
// function validateForm(){
//     var name = document.getElementById("name").value;
//     var email = document.getElementById("email").value;
//     var password = document.getElementById("password").value;
//     var address = document.getElementById("address").value;

//     if(name == "" || email == "" || password == "" || address == ""){
//         // alert("Please fill all the fields"); // Alert box Way 
//         document.getElementById("error-message").innerHTML = "Please fill all the fields";
//         return false;
//     }

//     if(password.length < 6){
//         document.getElementById("password-short").innerHTML = "Password must be at least 6 characters";
//         return false;
//     }
//     return true;
// }



document.addEventListener('DOMContentLoaded', function () {
    const decreaseButtons = document.querySelectorAll('.decrease-qty');
    const increaseButtons = document.querySelectorAll('.increase-qty');
  
    decreaseButtons.forEach(button => {
      button.addEventListener('click', function (e) {
        let qtyElement = e.target.nextElementSibling;
        let qty = parseInt(qtyElement.innerText, 10); // Base 10 which is decimal
        if (qty > 0) qtyElement.innerText = qty - 1; // Ensures qty never goes below 1.
      });
    });

    ////<button class="increase-qty">+</button> i use nextElementSibling means i am pointing to current QTY
    ////<span class="qty">0</span>
    ////<button class="decrease-qty">-</button> i use previousElementSibling i am point to current qty
  
    increaseButtons.forEach(button => {
      button.addEventListener('click', function (e) {
        let qtyElement = e.target.previousElementSibling;
        let qty = parseInt(qtyElement.innerText, 10);
        qtyElement.innerText = qty + 1;
      });
    });

    let cart = {};

    document.querySelectorAll('.add-to-cart').forEach(button => {
        button.addEventListener('click',function (){
            let menuItem= button.closest('.menu-item');// find the closest parent element with class menu-item    
            let foodName= menuItem.querySelector("h3").innerText;/// use innerText because we just want the text. If we user innerHTMl we bring in markup text which cause XSS attacks
            let qtyElement= menuItem.querySelector(".current-qty");
            let qty = parseInt(qtyElement.innerText, 10); // Get the quantity
        
            if(qty>0){
                if(cart[foodName]){
                    cart[foodName] += qty;
                }
                else{
                    cart[foodName] = qty;
                }
            
            }
            console.log(cart);

        })

    });
});


  

    // if(qty>0){
    //     AddtoCart(foodname,foodqty);
    // }

    // function AddtoCart(foodname,foodqty){
    //     let form = document.getElementById('cart-form');
    
    //     let foodInput = document.createElement('input');
    //     foodInput.type = 'hidden';
    //     foodInput.name = 'foodName[]';
    //     foodInput.value = foodName;
    //     form.appendChild(foodInput);
    
    //     let qtyInput = document.createElement('input');
    //     qtyInput.type = 'hidden';
    //     qtyInput.name = 'qty[]';
    //     qtyInput.value = qty;
    //     form.appendChild(qtyInput);
    // }

