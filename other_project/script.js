var seats = new Map();
var row = ["A", "B", "C", "D", "E", "F", "G", "H"];

document.addEventListener("DOMContentLoaded", function () {
  createSeat(); /////create seats
  addElement(seats, row); ///// add elements like type , id , className ,title to seats
  createEventListener(seats);
  submitForm();


});

function createSeat() {
  for (let i = 0; i < row.length; i++) {
    for (let j = 1; j <= 10; j++) {
      let seat = row[i] + j;
      seats.set(seat, new Map());
    }
  }
}

function addElement(seats, row) {
  const movie = document.getElementById("movie");
  seats.forEach((value, key) => {
    const seat = document.createElement("input");
    const label = document.createElement("label"); // Create a label element
    seat.type = "checkbox";
    seat.id = key;
    seat.className = "seat";
    seat.name = key;
    label.htmlFor = key; // Associate the label with the checkbox
    label.innerText = key; // Add the seat number to the label
    label.className = "seat-label";
    movieseats.appendChild(seat);
    movieseats.appendChild(label); // Append the label to the movie container
  });
}
function createEventListener(seats) {
  checkout = document.getElementById("checkout-seats");
  seats.forEach((value, key) => {
    var seat = document.getElementById(key);
    seat.addEventListener("click", function () {
      const seatChoosen = document.createElement("div");
      seatChoosen.id = key + "choosen";
      seatChoosen.className = "seatChoosen";
      seat.classList.toggle("selected");
      if (seat.classList.contains("selected")) {
        checkout.appendChild(seatChoosen);
        seatChoosen.innerText = key;
      } else {
        const existingSeat = document.getElementById(seatChoosen.id);
        if (existingSeat) {
          checkout.removeChild(existingSeat);
        }
      }
    });
  });
}

function submitForm() {
  const postForm = document.getElementById("selectedCheckBoxForm");
  const submitButton = document.getElementById("checkout-button");

  submitButton.addEventListener("click", function () {
    console.log("submit");
    postForm.submit();
  });
}
