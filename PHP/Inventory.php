<?php
//Initializing the host, user, password and database to establish a database connection
$host = 'localhost';
$username = 'admin';
$password = 'mamab';
$dbname = 'INVENTORY';

//Connecting to the Inventory Database
$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
$stmt = $conn->query("SELECT * FROM ITEMS;");
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    <link rel="stylesheet" href="../CSS/inventory.css" /> 
</head>

<body>
    <!--HEADER SECTION INVENTORY PAGE-->
    <header>
        <h1>MAMA B'S WHOLESALE</h1>
        <h3>GROCERIES ONLINE STORE</h3>
        <nav>
            <ul>
                <a href="http://localhost/Swen_project1/PHP/Inventory.php" class="REFRESH" id="REFRESH">REFRESH</a>
                <a href="http://localhost/Swen_project1/PHP/Report.php">REPORTS</a>
                <a href="http://localhost/Swen_project1/PHP/CustomerOrders.php">VIEW CUSTOMER ORDERS</a>
                <a href="http://localhost/Swen_project1/PHP/ViewSubscribers.php">VIEW SUBSCRIBERS</a>
                
            </ul>
        </nav>
    </header>
    <main>
        <section class="updateInventory">
            <div class="firstDiv">
                <!-- Creating a table to display Inventory information -->
                <table>
                    <tr>
                        <th>ITEM</th>
                        <th>SELLING PRICE</th>
                        <th>COST PRICE</th>
                        <th>SUPPLIERS</th>
                        <th>QUANTITY AVAILABLE</th>
                        <th>QUANTITY SOLD</th>
                        <th>PERISHABLES</th>
                        <th>ACTIONS</th>
                    </tr>
                    <!-- FOR LOOP COLLECTING ITEM INFORMATION -->
                    <?php foreach ($results as $row) : ?>
                        <tr>
                            <td><?= $row['name_item'] ?></td>
                            <td><?= $row['selling_price'] ?></td>
                            <td><?= $row['cost_price'] ?></td>
                            <td><?= $row['supplier'] ?></td>
                            <td><?= $row['quantity_instock'] - $row['perishable']?></td>
                            <td><?= $row['quantity_sold'] ?></td>
                            <td><?= $row['perishable'] ?></td>

                            <td>
                                <a href="http://localhost/Swen_project1/PHP/Inventory.php?update=<?php echo $row['Id'];?>" class="Update" name="Update" value="Update">UPDATE</a>
                                <a href="http://localhost/Swen_project1/PHP/Inventory.php?delete=<?php echo $row['Id'];?>" class="Delete" name="Delete" value="Delete">DELETE</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
            <div class="secondDiv">   
<?php
    //set parameters
    $item_name = '';
    $selling_price = '';
    $cost_price = '';
    $quantity_instock = '';
    $supplier = '';
    $quantity_sold = '';
    $perishables = '';
    $update_item = false;

    
    if(isset($_GET['delete'])){
        $id = $_GET['delete'];
        $stmt = $conn->query("DELETE FROM ITEMS WHERE Id='$id';"); 
    }

    if(isset($_GET['update'])){
        $id = $_GET['update'];
        $stmt = $conn->query("SELECT * FROM ITEMS WHERE Id='$id';");
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
        foreach ($results as $row){
            $item_name = $row['name_item'];
            $selling_price = $row['selling_price'];
            $cost_price = $row['cost_price'];
            $quantity_instock = $row['quantity_instock'];
            $supplier = $row['supplier'];
            $quantity_sold = $row['quantity_sold'];
            $perishables = $row['perishable'];
        }     
    }

    if(isset($_POST['UPDATE'])){
        $id = $_GET['update'];
        $item = $_POST['item'];
        $sellprice = $_POST['sell'];
        $costprice = $_POST['cost'];
        $quantityinstock = $_POST['quantity'];
        $supplier = $_POST['supplier'];
        $quantitysold = $_POST['quantityS'];
        $perishable_item = $_POST['perishables'];
    
        $stmt=$conn->query("UPDATE ITEMS SET name_item='$item',selling_price='$sellprice',cost_price='$costprice',quantity_instock='$quantityinstock',supplier='$supplier',quantity_sold='$quantitysold',perishable='$perishable_item' WHERE Id='$id';");
    }


    if (isset($_POST['ADD'])) {
        $item = $_POST['item'];
        $sellprice = $_POST['sell'];
        $costprice = $_POST['cost'];
        $quantityinstock = $_POST['quantity'];
        $supplier = $_POST['supplier'];
        $quantitysold = $_POST['quantityS'];
        $perishable_item = $_POST['perishables'];
    
        $stmt=$conn->query("INSERT INTO ITEMS (name_item,selling_price,cost_price,quantity_instock,supplier,quantity_sold,perishable) VALUES ('$item','$sellprice','$costprice','$quantityinstock','$supplier','$quantitysold','$perishable_item');");
    }

?>
                <p class="message">Enter items you wish to add to inventory below.</p>
                <form method="POST">
                    <label>Item Name:</label>
                    <input type="text" value="<?php echo $item_name; ?>" id="item" name="item">
                    <label>Selling Price:</label>
                    <input type="text" value="<?php echo $selling_price; ?>" id="sell" name="sell">
                    <label>Cost Price:</label>
                    <input type="text" value="<?php echo $cost_price; ?>" id="cost" name="cost">
                    <label>Quantity in Stock:</label>
                    <input type="text" value="<?php echo $quantity_instock; ?>" id="quantity" name="quantity">
                    <label>Supplier:</label>
                    <input type="text" value="<?php echo $supplier; ?>" id="supplier" name="supplier">
                    <label>Quantity Sold:</label>
                    <input type="text" value="<?php echo $quantity_sold; ?>" id="quantityS" name="quantityS">
                    <label>Perishable:</label>
                    <input type="text" value="<?php echo $perishables; ?>" id="perishables" name="perishables">
                 
                    <input type="submit" name="ADD" class="ADD" value="ADD" id="ADD">
                    <input type="submit" name="UPDATE" class="UPDATE" value="UPDATE" id="UPDATE">
                </form>
            </div>    
        </section>
    </main>

</body>
</html>