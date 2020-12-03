"use strict"; //indicates that the code should be executed in "strict mode"

window.onload = function() {
    var button = document.getElementById("custButton"); //stores the Element object retured which represents the element whose id property matches the specified string(custButton).

    button.addEventListener("click", function(event) { //method attaches an event handler to the specified element(button)
        location.href = "/HTML/OrderInterface.php"; //used to create a link to another page.
    });
}