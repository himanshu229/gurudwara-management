<?php
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header('location: ../index.html');
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
        $querry = "SELECT * FROM `income` ORDER BY Raseed DESC LIMIT 1 ";
        $results = mysqli_query($conn, $querry);   
        $row = mysqli_fetch_array($results);
        $lastid = $row["Raseed"];
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
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Income</title>
    <link rel="stylesheet" href="income.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar" id="home">
        <h2>Income</h2>
        <div class="logout"><a href="../login/logout.php">Logout</a></div>
    </nav>
    <form class="form-section m-5" method="POST">
        <div class="col-md-6 mb-3 ml-4">
            <label for="RaseedNumber" class="form-label">Raseed Number:</label>
            <input class="form-control" name="raseed" type="text" id="RaseedNumber" value="<?php echo $number; ?>"
                aria-label="Disabled input example" readonly>
        </div>
        <div class="col-md-6 mb-3 ml-4">
            <label for="data" class="form-label">Date:</label>
            <input type="date" name="date" class="form-control" id="date" required>
        </div>
        <div class="col-md-6 mb-3 ml-4">
            <label for="name" class="form-label">Name:</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" required>
        </div>
        <div class="col-md-6 mb-3 ml-4">
            <label for="category1" class="form-label">Source:</label>
            <select class="form-control" required name="category1" id="category1">
                <option value="">Select Category</option>
                <option value="Seva">Seva</option>
                <option value="Agriculture">Agriculture</option>
                <option value="Milk">Milk</option>
            </select>
        </div>
        <div class="col-md-6 mb-3 ml-4">
            <label for="amount" class="form-label">Amount:</label>
            <input type="number" class="form-control" id="amount" name="amount" min="1" placeholder="Enter Amount" required>
        </div>
        <div class="col-md-6 ml-4">
            <button class="btn btn-secondary pl-4 pr-4 mr-3" onclick="exit1()">Exit</button>
            <button class="btn btn-primary">Submit</button>

        </div>
    </form>

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
</body>

</html>
<?php
if($_SERVER['REQUEST_METHOD'] == 'POST')
{   
    $raseed = $_POST['raseed'];
    $date = $_POST['date'];
    $name = $_POST['name'];
    $source = $_POST['category1'];
    $income = $_POST['amount'];

    
    // //connecting to data base
    include '../dbconnector.php';
        $sql =  "INSERT INTO `income` (`Raseed`, `Date`, `Name`, `Source`, `Amount`) VALUES ('$raseed', '$date', '$name', '$source', '$income')";
        $result = mysqli_query($conn, $sql);  
        if($result){
            echo '<script> alert("Entry has been Submitted"); window.location = "income.php"</script>';
        }
        else{
            echo '<script> alert("Entry has not been Submitted.\nVoucher number already exist or Something Went Wrong."); window.location = "income.php"</script>';
        } 
   }
?>