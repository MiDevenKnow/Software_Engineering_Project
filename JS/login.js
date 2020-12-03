window.onload = function() {
    var loginbutton = document.querySelector(".loginButton"); //stores the first Element within the document that matches the specified selector (loginbutton)
    console.log(loginbutton);
    var username1 = document.querySelector("#username1"); //stores the first Element within the document that matches the specified selector (username1)
    console.log(username1);
    valid = 0;

    loginbutton.addEventListener('click', handleClick); //method attaches an event handler to the specified element(loginbutton)

    function handleClick(click) {
        //Function which carries out other functions when the button is clicked.
        validateUserName(username1.value);

        if (valid == 1) {
            // alert(" ALL THE INFORMATIONS ENTERED ARE VALID PRESS OKAY TO CONTINUE");
        } else {
            click.preventDefault(); //cancels the default action of the event.
            console.log("Valid: ", valid)
        }
    }

    function validateUserName(usern) {
        //Function used to validate username enetered by the user.
        var pattern = /^[0-9a-zA-Z]+$/;
        if (usern.match(pattern)) {
            console.log("matching");
            valid += 1;
        }
    }
}