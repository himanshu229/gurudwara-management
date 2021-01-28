<?php
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header('location: ../login/index.html');
    exit;
}

?>
<?php
    include '../dbconnector.php';
    if(!$conn)
    {
       die("sorry we failed to connect:". mysqli_connect_error());
    }
    else
    {
        $querry = "SELECT * FROM `expenditure` ORDER BY Voucher_number DESC LIMIT 1 ";
        $results = mysqli_query($conn, $querry);   
        $row = mysqli_fetch_array($results);
        $lastid = $row["Voucher_number"];
        if(empty($lastid)){
            $number = "1";
        }    
        else{
            $id = substr($lastid, 0);
            $id = intval($id);
            $number = $id+1;
            
           
        }    
 }
?>
<!-------------------html---------------------->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expenditure</title>
    <link rel="stylesheet" href="expenditure.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>

    <!-----------navigation----------->
    <nav class="navbar" id="home">
        <h2>Expenditure</h2>
        <div class="logout"><a href="../login/logout.php">Logout</a></div>
    </nav>
    <!-----------section-------------->
    <form class="form-section m-5" method="POST">
        <div class="col-md-6 mb-3 ml-4">
            <label for="voucher" class="form-label">Voucher Number:</label>
            <input class="form-control" name="voucher" type="text" id="voucher" value="<?php echo $number; ?>"
                aria-label="Disabled input example" readonly>
        </div>
        <div class="col-md-6 mb-3 ml-4">
            <label for="data" class="form-label">Date:</label>
            <input type="date" name="date" class="form-control" id="date" required>
        </div>
        <div class="col-md-6 mb-3 ml-4">
            <label for="bill" class="form-label">Bill Number:</label>
            <input type="text" class="form-control" name="bill" id="bill" placeholder="Enter Bill Number" required>
        </div>
        <div class="col-md-6 mb-3 ml-4">
            <label for="expence-type" class="form-label">Expence type:</label>
            <select class="form-control" required name="category1" id="expencetype">
                <option value="">Select Category</option>
                <option value="Langar">Langar</option>
                <option value="Agriculture">Agriculture</option>
                <option value="Utility">Utility</option>
                <option value="Employee Payment">Employee Payment</option>
                <option value="Other">Other</option>
            </select>
        </div>
        <div class="col-md-6 mb-3 ml-4">
            <label for="exampleFormControlTextarea1" class="form-label">Expenditure text</label>
            <textarea class="form-control" name="expencetext" id="exampleFormControlTextarea1" rows="3" style="resize: none;"></textarea>
        </div>
        <div class="col-md-6 mb-3 ml-4">
            <label for="payment" class="form-check-label">Payment Mode: <br><br>
                <input type="radio" value="Cash" name="payment_mode"  onClick="show(0)" checked required> Cash
                <input type="radio" value="Cheque" name="payment_mode" onClick="show(1)" required> Cheque
                <input type="radio" value="Cheque and Cash" name="payment_mode" onClick="show(1)" required> Cheque
                and Cash
            </label>
        </div>
        <div class="col-md-6 mb-3 ml-4" id="para" style="display:none;">
            <label for="cheque" class="form-label">Cheque No:</label>
            <input type="number" class="form-control" name="cheque_number" id="cheque" />
            <label for="bank" class="form-label">Bank Name:</label>
            <input type="text" class="form-control" name="bank" id="bank">
        </div>
        <div class="col-md-6 mb-3 ml-4">
            <label for="amount" class="form-label">Amount:</label>
            <input type="number" name="amount" class="form-control" id="amount" min="1" placeholder="Enter Amount" required>
        </div>
        <div class="col-md-6 ml-4">
            <button class="btn btn-secondary pl-4 pr-4 mr-3" onclick="exit1()">Exit</button>
            <button class="btn btn-primary">Submit</button>

        </div>
    </form>

</body>

</html>


<!----------------------------------java script-------------------------------------->
<script>
    function exit1() {
        window.location.href = "../service/service.php";
    }
</script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
    crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
    crossorigin="anonymous"></script>
<script>

    function getDate() {
        var today = new Date();

        document.getElementById("date").value = today.getFullYear() + '-' + ('0' + (today.getMonth() + 1)).slice(-2) + '-' + ('0' + today.getDate()).slice(-2);
    }
    function dropdownlist(listindex) {

        document.formname.category2.options.length = 0;
        switch (listindex) {

            case "Langar":
                document.formname.category2.options[0] = new Option("NA", "NA");
                break;

            case "Agriculture":
                document.formname.category2.options[0] = new Option("Select Category", "");
                document.formname.category2.options[1] = new Option("Fruit", "Fruit");
                document.formname.category2.options[2] = new Option("Guru Vatika", "Guru Vatika");
                document.formname.category2.options[3] = new Option("Field 1", "Field 1");
                document.formname.category2.options[4] = new Option("Field 2", "Field 2");
                document.formname.category2.options[5] = new Option("Field 3", "Field 3");
                document.formname.category2.options[6] = new Option("Field 4", "Field 4");
                document.formname.category2.options[7] = new Option("Field 5", "Field 5");

                break;

            case "Utility":
                document.formname.category2.options[0] = new Option("NA", "NA");
                break;

            case "Employee Payment":
                document.formname.category2.options[0] = new Option("NA", "NA");
                break;

            case "Other":
                document.formname.category2.options[0] = new Option("NA", "NA");
                break;
        }
        return true;
    }
    function show(x) {
        if (x == 1) {
            document.getElementById("para").style.display = "block";
        }
        else {
            document.getElementById("para").style.display = "none";
        }
    }

</script>

<?php

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $voucher = $_POST['voucher'];
    $date = $_POST['date'];
    $bill = $_POST['bill'];
    $expencetype = $_POST['category1'];
    $expencetext = $_POST['expencetext'];
    $payment_mode = $_POST['payment_mode'];
    $cheque_number = $_POST['cheque_number'];
    $bank_name = $_POST['bank'];
    $amount = $_POST['amount'];
    
    

    include '../dbconnector.php';
    if(!$conn)
    {
       die("sorry we failed to connect:". mysqli_connect_error());
    }
    else
    {                     
        $sql = "INSERT INTO `expenditure` (`Voucher_number`, `Date`, `Bill_number`, `Expence_type`, `Expence`, `Payment_mode`, `Cheque_number`, `Bank_name`, `Amount`) VALUES ('$voucher', '$date', '$bill', '$expencetype', '$expencetext',  '$payment_mode', '$cheque_number','$bank_name', '$amount')";
        $result = mysqli_query($conn, $sql);   
        if($result)
        {
             echo '<script> alert("Entry has been Submitted"); window.location = "expenditure.php"</script>';
        }
        else{
            echo '<script> //alert("Entry has not been Submitted.\nVoucher number already exist or Something Went Wrong."); window.location = "expenditure.php"</script>';
        }   
    }    
                  
}                 
?>