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
    <title>Service</title>
    <link rel="stylesheet" href="service.css">
</head>

<body>
    <!-----------navigation----------->
    <nav class="navbar" id="home"> 
        <h1 class="heading">WELCOME</h1> 
        <div class="logout"><a href="../login/logout.php">Logout</a></div>          
    </nav>
    <!---------------selection section---------------->

    <div class="ask">Would You Like To Enter..?</div>
    <section class="selection-section">
        <h1 class="entry">ENTRY</h1>
        <div>
            <input type="button" name="button" id="button" value="Income" onclick="income()">
        </div>
        <div>
            <input type="button" name="expenditure" id="expenditure" value="Expenditure" onclick="expenditure()">
        </div>
        <h2 class="report">REPORT</h2>
        <div>
            <input type="button" name="report" id="report" value="Income report" onclick="income_report()">
        </div>
        <div>
            <input type="button" name="report" id="report" value="Expenditure Report" onclick="expenditure_report()">
        </div>
    </section>
    
</body>

</html>
<!---------------javascript--------------->
<script>
    function income() {
        document.location.href = "../income/income.php";
    }
    
    function expenditure() {
        document.location.href = "../expenditure/expenditure.php";
    }

    function income_report() {
        document.location.href = "../report/income_report.php";
    }
    function expenditure_report() {
        document.location.href = "../report/expenditure_report.php";
    }
</script>