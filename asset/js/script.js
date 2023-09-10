
function validateForm(){
    var name = document.getElementById("name").value;
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;
    var address = document.getElementById("address").value;

    if(name == "" || email == "" || password == "" || address == ""){
        // alert("Please fill all the fields"); // Alert box Way 
        document.getElementById("error-message").innerHTML = "Please fill all the fields";
        return false;
    }
    return true;
}