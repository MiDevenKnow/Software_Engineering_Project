window.onload = function() {
    var firstname = document.querySelector("#firstname"); //stores the first Element within the document that matches the specified selector (firstname)
    console.log(firstname);
    var lastname = document.querySelector("#lastname"); //stores the first Element within the document that matches the specified selector(lastname)
    console.log(lastname);
    var emailaddress = document.querySelector("#email"); //stores the first Element within the document that matches the specified selector(email)
    console.log(emailaddress);
    var username = document.querySelector("#username"); //stores the first Element within the document that matches the specified selector(username)
    console.log(username);
    var password = document.querySelector("#password"); //stores the first Element within the document that matches the specified selector(passwprd)
    console.log(password);
    var button = document.querySelector("#createButton"); //stores the first Element within the document that matches the specified selector(createbutton)
    console.log(button);
    valid = 1;
    button.addEventListener("click", handleClick); //method attaches an event handler to the specified element(button)

    function handleClick(clickEvent) {
        //Function which carries out other functions when the button is clicked.
        validateEmail(emailaddress.value); //validates the emailaddress value
        validateNames(firstname.value, lastname.value); //validates the firstname and lastname values
        validateUserName(username.value); //validates the username value
        if (valid == 5) {
            valid = 0;
            // alert(" ALL THE INFORMATIONS ENTERED ARE VALID PRESS OKAY TO CONTINUE");
        } else {
            console.log("Valid: ", valid)
            valid = 0;
            clickEvent.preventDefault(); //cancels the default action of the event.
        }
    }

    function validateEmail(email) {
        //Function used to validate email entered by user.
        const pattern = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if (email.match(pattern)) {
            console.log("matching");
            valid += 1;
        }
    }

    function validateNames(fname, lname) {
        //Function used to validate(text) fname and lname entered by the user.
        var pattern = /^[A-Za-z]+$/;
        fname.match(pattern);
        if (fname.match(pattern) && lname.match(pattern)) {
            console.log("matching");
            valid += 2;
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