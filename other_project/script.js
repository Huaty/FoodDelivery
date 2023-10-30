var seats = new Map();
var row = ["A", "B", "C", "D", "E", "F", "G", "H"];

document.addEventListener("DOMContentLoaded", function () {
  adminPage();///
  addToCheckOut();
  submitForm();//



});

function adminPage(){
  const intializeDb  = document.getElementById("initialize-form");
  const uploadNewMovie  = document.getElementById("upload-new-movie-form");
  const createDbMovie  = document.getElementById("submit-button-create-movie");
  const createNewMovie  = document.getElementById("submit-button-create-new-movie"); 
  
  if(createDbMovie){
    createDbMovie.addEventListener("click", function (event) {
      console.log("submit");
      intializeDb .submit();
    });
  }
  if(createNewMovie){
    createNewMovie.addEventListener("click", function (event) {
      console.log("submit");
      uploadNewMovie.submit();
    });
  }
}


function addToCheckOut() {
  const allSeats = document.getElementsByClassName('seat');/// get all the total seat
  console.log(allSeats);
    checkout = document.getElementById("checkout-seats");
  for(let i = 0; i < allSeats.length; i++){
    allSeats[i].addEventListener("click", function () {
      const seatChoosen = document.createElement("div");
      seatChoosen.id = allSeats[i].id + "choosen";
      seatChoosen.className = "seatChoosen";
      allSeats[i].classList.toggle("selected");
      if (allSeats[i].classList.contains("selected")) {
        checkout.appendChild(seatChoosen);
        seatChoosen.innerText = allSeats[i].id;
      } else {
        const existingSeat = document.getElementById(seatChoosen.id);
        if (existingSeat) {
          checkout.removeChild(existingSeat);
        }
      }
    });
  }
}

function submitForm() {
  const postForm = document.getElementById("selectedCheckBoxForm");
  const submitButton = document.getElementById("checkout-button");
if(submitButton){
  submitButton.addEventListener("click", function () {
    console.log("submit");
    postForm.submit();
  });
}

}
