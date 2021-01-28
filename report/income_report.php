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
    <title>Income Report</title>
    <link rel="stylesheet" href="report.css">
</head>

<body class="body_x" id="body">

    <!-----------navigation----------->
    <nav class="navbar" id="home">
        <h2>Income Report</h2>
        <div class="logout"><a href="../login/logout.php">Logout</a></div>
    </nav>
    <!-----------section-------------->
    <div class="select_key">
        <button  onclick="back()" class="back_key2">Back</button>
    </div>
    <div class="fetch"> 
        <form action="" method="POST">
            <label for="from_date" class="name">From:- </label>
            <input type="date" name="from_date" id="from_date">
            <label for="to_date" class="name">To:- </label>
            <input type="date" name="to_date" id="to_date"><br>
            <input type="submit" value="Search the Data" name="search_date" class="d_search">
        </form>

    </div>
    <div>
        <form action="" class="search_form" method="POST">
            <input type="number" name="search" min="1" placeholder="Enter Raseed No" class="search">
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


        $sql = "SELECT * FROM `income` WHERE `Date` BETWEEN '".$_POST["from_date"]."' AND '".$_POST["to_date"]."'";
        $result = mysqli_query($conn, $sql);       
        if($result->num_rows > 0)
        {
        ?>
        <table>
            <tr><th><h2 class="table1">Gurudwara Gorakhpur Bandol, seoni(M.P)</h2></th></tr>
        </table>
        <p class="p1">Income Report</p>
        <table>
            <tr>
            <th class="table">Raseed</th>
            <th class="table">Date</th>
            <th class="table">Name</th>
            <th class="table">Source</th>
            <th class="table">Amount <br>(R.s)</th>
            </tr>
            <?php
            while($row = $result->fetch_assoc())
            {
                ?>   

                <tr>
                <td class="table"><?php echo $row["Raseed"]?></td>
                <td class="table"><?php echo date('d-m-yy', strtotime($row["Date"]))?></td>
                <td class="table"><?php echo $row["Name"]?></td>
                <td class="table"><?php echo $row["Source"]?></td>
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
    <?php
        
       if(isset($_POST["search_data"]))
        {
        $raseed = $_POST['search'];
            include '../dbconnector.php';
            if(!$conn)
           {
                die("sorry we failed to connect:". mysqli_connect_error());
            }
            else{
                $sql = "SELECT * FROM `income` WHERE `Raseed` = '$raseed'";
                $result = mysqli_query($conn, $sql);       
                if($result->num_rows > 0)
                {
                    while($row = $result->fetch_assoc())
                    {
                        ?>   
                        <table>
                            <tr><th><h2 class="table1">Gurudwara Gorakhpur Bandol, seoni(M.P)</h2></th></tr>
                        </table>
                        <p class="p1">Income Report</p>
                        <table>
                        <tr>
                        <th class="table">Raseed</th>
                        <th class="table">Date</th>
                        <th class="table">Name</th>
                        <th class="table">Source</th>
                        <th class="table">Amount <br>(R.s)</th>
                        </tr>
                        <tr>
                        <td class="table"><?php echo $row["Raseed"]?></td>
                        <td class="table"><?php echo date('d-m-yy', strtotime($row["Date"]))?></td>
                        <td class="table"><?php echo $row["Name"]?></td>
                        <td class="table"><?php echo $row["Source"]?></td>
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
                    ";
                }  
                       
            }
        }
    ?>
                  
</div>
</body>

</html>