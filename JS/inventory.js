window.onload = function() {
    var item = document.querySelector("#item"); //stores the first Element within the document that matches the specified selector (item)
    console.log(item);
    var sellingprice = document.querySelector("#sp"); //stores the first Element within the document that matches the specified selector (sp)
    console.log(sellingprice);
    var costprice = document.querySelector("#cp"); //stores the first Element within the document that matches the specified selector (cp)
    console.log(costprice);
    var quantity = document.querySelector("#quantity"); //stores the first Element within the document that matches the specified selector (quantity)
    console.log(quantity);
    var supplier = document.querySelector("#suplier"); //stores the first Element within the document that matches the specified selector (supplier)
    console.log(supplier);
    var quantitysold = document.querySelector("#quantitys"); //stores the first Element within the document that matches the specified selector (quantitys)
    console.log(quantitysold);
    var button = document.querySelector("#addItem"); //stores the first Element within the document that matches the specified selector (addItem)
    console.log(button);

    valid = 1;
    button.addEventListener("click", handleClick); //method attaches an event handler to the specified element(button)

    function handleClick(clickEvent) {
        //Function which carries out other functions when the button is clicked.
        validateText(item.value, supplier.value);
        validateValues(quantity.value, quantitysold.value);
        validateCurrency(sellingprice.value, costprice.value);
        if (valid == 5) {
            valid = 0;
            alert(" ALL THE INFORMATIONS ENTERED ARE VALID PRESS OKAY TO CONTINUE");
        } else {
            console.log("Valid: ", valid)
            valid = 0;
            clickEvent.preventDefault(); //cancels the default action of the event.
        }
    }

    function validateText(item, supplier) {
        //Function used to validate(text) item and supplier entered by the user.
        var pattern = /^[A-Za-z]+$/;
        item.match(pattern);
        if (item.match(pattern) && supplier.match(pattern)) {
            console.log("matching");
            valid += 2;
        }
    }

    function validateValues(quantity, quantitysold) {
        //Function used to validate(values) quantity and quantitysold entered by the user.
        var pattern = /^[0-9]+$/;
        if (quantity.match(pattern) && quantitysold.match(pattern)) {
            console.log("matching");
            valid += 1;
        }
    }

    function validateCurrency(sellingprice, costprice) {
        //Function used to validate(currency values) sellingprice and costprice entered by the user.
        var pattern = /^\d+(?:\.\d{0,2})$/;
        if (sellingprice.match(pattern) && costprice.match(pattern)) {
            console.log("matching");
            valid += 1;
        }
    }
}