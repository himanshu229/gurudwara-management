<?php
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header('location: ../index.html');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expenditure Report</title>
    <link rel="stylesheet" href="report.css">
</head>

<body class="body_y" id="body">

    <!-----------navigation----------->
    <nav class="navbar" id="home">
        <h2>Expenditure Report</h2>
        <div class="logout"><a href="../login/logout.php">Logout</a></div>
    </nav>
    <!-----------section-------------->
    <div class="select_key">
        <button  onclick="back()" class="back_key">Back</button>
    </div>
    <div class="fetch">
        <form action="" method="POST">
            <label for="from_date" class="name">From:- </label>
            <input type="date" name="from_date" id="from_date">
            <label for="to_date" class="name">To:- </label>
            <input type="date" name="to_date" id="to_date"><br>
            <input type="submit" name="search_date" value="Search the Data" class="d_search">
        </form>

    </div>
    <div>
        <form action="" class="search_form" method="POST">
            <input type="number" name="search" min="1" placeholder="Enter Voucher No" class="search">
            <input type="submit" name="search_data" value="Search the Data" class="v_search">
        </form>
    </div>
    <div class="pdf_download">
        <button onClick="printpage()">Print Report</button>
    </div>
    <script>
        function back() {
            document.location.href = "../service/service.php";
        }
        function printpage(){
        var body = document.getElementById('body').innerHTML;
        var data = document.getElementById('data').innerHTML;
        document.getElementById("body").innerHTML = data;
        window.print();
        document.getElementById('body').innerHTML = body;
       }
    </script>
<div id="data">
<?php
   
   
   if(isset($_POST["search_data"]))
   {
   $voucher = $_POST['search'];
       include '../dbconnector.php';
       if(!$conn)
      {
           die("sorry we failed to connect:". mysqli_connect_error());
       }
       else{
           $sql = "SELECT * FROM `expenditure` WHERE `Voucher_number` = '$voucher'";
           $result = mysqli_query($conn, $sql);       
           if($result->num_rows > 0)
           {
               while($row = $result->fetch_assoc())
               {
                   ?> 
                     
                    <table>
                        <tr><th><h2 class="table1">Gurudwara Gorakhpur Bandol, seoni(M.P)</h2></th></tr>
                    </table>
                    <p class="p1">Expenditure Report</p>
                   <table>
                   <tr>
                   <th class="table">Voucher Number</th>
                   <th class="table">Date</th>
                   <th class="table">Bill Number</th>
                   <th class="table">Expence Type</th>
                   <th class="table_x">Expence Text</th>
                   <th class="table">Payment Mode</th>
                   <th class="table">Cheque Number</th>
                   <th class="table">Bank Name</th>
                   <th class="table">Amount <br>(R.s)</th>
                   </tr>
                   <tr>
                   <td class="table"><?php echo $row["Voucher_number"]?></td>
                   <td class="table"><?php echo date('d-m-yy', strtotime($row["Date"]))?></td> 
                   <td class="table"><?php echo $row["Bill_number"]?></td>
                   <td class="table"><?php echo $row["Expence_type"]?></td>
                   <td class="table_e"><?php echo $row["Expence"]?></td>
                   <td class="table"><?php echo $row["Payment_mode"]?></td>
                   <td class="table"><?php echo $row["Cheque_number"]?></td>
                   <td class="table"><?php echo $row["Bank_name"]?></td>
                   <td class="table"><?php echo $row["Amount"]?></td>
                       
                   </tr>
                   </table>
                   <hr>
                   <?php
               }

           }
           else
           {
               echo "<table>
               <td>0 Record Found </td>
               </table>
               <hr>
               <hr>";
           }  
                  
       }
   }
?>
    <table>
    <?php
   
   if(isset($_POST["search_date"]))
   {
       include '../dbconnector.php';
       if(!$conn)
      {
           die("sorry we failed to connect:". mysqli_connect_error());
       }
       else{


        $sql = "SELECT * FROM `expenditure` WHERE `Date` BETWEEN '".$_POST["from_date"]."' AND '".$_POST["to_date"]."'";
        $result = mysqli_query($conn, $sql);       
        if($result->num_rows > 0)
        {
        ?>
        <table>
            <tr><th><h2 class="table1">Gurudwara Gorakhpur Bandol, seoni(M.P)</h2></th></tr>
        </table>
        <p class="p1">Expenditure Report</p>
        <table>
            <tr>
                   <th class="table">Voucher Number</th>
                   <th class="table">Date</th>
                   <th class="table">Bill Number</th>
                   <th class="table">Expence Type</th>
                   <th class="table_x">Expence Text</th>
                   <th class="table">Payment Mode</th>
                   <th class="table">Cheque Number</th>
                   <th class="table">Bank Name</th>
                   <th class="table">Amount <br>(R.s)</th>
            </tr>
            <?php
            while($row = $result->fetch_assoc())
            {
                ?>   

                <tr>
                   <td class="table"><?php echo $row["Voucher_number"]?></td>
                   <td class="table"><?php echo date('d-m-yy', strtotime($row["Date"]))?></td> 
                   <td class="table"><?php echo $row["Bill_number"]?></td>
                   <td class="table"><?php echo $row["Expence_type"]?></td>
                   <td class="table_e"><?php echo $row["Expence"]?></td>
                   <td class="table"><?php echo $row["Payment_mode"]?></td>
                   <td class="table"><?php echo $row["Cheque_number"]?></td>
                   <td class="table"><?php echo $row["Bank_name"]?></td>
                   <td class="table"><?php echo $row["Amount"]?></td>
                    
                </tr>
        
                
                <?php
            }
        ?>
        </table>
        <hr>
        
        <?php   

        }
        else
        {
            echo "<table>
            <td>0 Record Found </td>
            </table>
            <hr>
            ";
        }  
               
       }
   }
?>
</div>
</body>

</html>