<?php
session_start();
//Initializing the host, user, password and database to establish a database connection
$host = 'localhost';                
$username = 'admin';
$password = 'mamab';
$dbname = 'INVENTORY';

$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);// Create connection
$stmt = $conn->query("SELECT * FROM ITEMS;");//select all content from the database
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);//fetches and returns an array containing all of the remaining rows in the result set.


?>

<!-- Creating a HTML Graphic Interface -->
<!DOCTYPE html>
<html lang="en">

<!--TITLE AND ORGANIZATION OF THE PAGE-->
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <title>MAMA B'S ONLINE WHOLESALE</title>
        <link rel="stylesheet" href="../CSS/website.css" />
    </head>

<body>
    <div class="HeaderLayout">
        <!--HEADER SECTION FOR ORDER PAGE-->
        <header>
            <h1>MAMA B'S WHOLESALE</h1>
            <h3>GROCERIES ONLINE STORE</h3>
            <a href="http://localhost/Swen_project1/PHP/complaintSubscriber.php"> SUBSCRIBE TO OUR MAILING LIST</a>
            <a href="http://localhost/Swen_project1/PHP/complaint.php">LOG A COMPLAINT</a>

        </header>
    </div>

    <main>
        <section class="Shopping">
            <h2>Enter the item you wish to purchase below.</h2>
                <form id="FormID" method="post" action="bill.php">
                    <button id="btn" name="SubmitButton">Add Item</button>

                    <h3>GROCERIES LIST</h3>
                    <!--CREATION OF TABLE FOR GROCERIES LIST-->
                    <table>
                        <tr>
                            <th scope="row">CHECK</th>
                            <th scope="row">ITEM</th>
                            <th scope="row">COST ($)</th>
                            <th scope="row">QUANTITY NEEDED</th>
                        </tr>

                        <!--FOR LOOP COLLECTING ORDERING INFORMATION-->
                       <?php foreach($results as $row):?>
                            <tr>
                                <td><input class="checkers" type="checkbox" name="arr[]" value="<?php echo $row['name_item'] ?>"/></td>
                                <td><?=$row['name_item']?></td>
                                <td><?=$row['selling_price']?></td>
                                <td><select class="quantity" name="money[]" size="1">

                                    <?php for($k=0; $k<=$row['quantity_instock']; $k++){
                                        echo "<option value=".$k.">".$k."</option>";
                                    }
                                    ?> 
                                    <option></option>   
                                    </select> 
                                    
                                    <label>out of <?=$row['quantity_instock']?></label>
                                </td>
                            </tr>
                        <?php endforeach; ?>    
                    </table>
                </form>
        </section>

        <section>
            <!--Java script-->
            <script type="text/javascript">
                var button = document.getElementById("btn");//returns and stores an Element object representing the element whose id property matches the specified string(btn)
                var checks = document.querySelectorAll(".checkers");//stores the first Element within the document that matches the specified selector (checkers)
                var quantity = document.querySelectorAll(".quantity");//stores the first Element within the document that matches the specified selector (quantity)
                var count =0;
                button.addEventListener("click", function(event){ //method attaches an event handler to the specified element(button)
                    //function which allows customers to order items
                    for(let x =0;x<checks.length;x++){
                        if(checks[x].checked){
                            count++;
                        }
                        if(checks[x].checked && quantity[x].value==0){
                                alert('Look To See That All Your Items, Or At Least One Item, And Their Quantities Are Selected!');
                                event.preventDefault();
                                break;
                        }

                        if(!checks[x].checked && quantity[x].value!=0){
                                alert('Look To See That All Your Items, Or At Least One Item, And Their Quantities Are Selected!');
                                event.preventDefault();
                                break;
                        }
                    }
                    if(count==0){
                        alert('Look To See That All Your Items, Or At Least One Item, And Their Quantities Are Selected!');
                        event.preventDefault();
                    }
                });
            </script>
        </section> 
    </main>
</body>
</html>