<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transfer</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">    <link rel = "stylesheet" href = "css/style.css">
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel = "stylesheet" href = "css/style.CSS">

</head>

<body>

   <header>
     <div class="logo" >The Sparks Bank</div>
      <nav class="topnav">
        <ul id="js-menu">
            <li>
                <a href="index.php#home" class="active">Home</a>
            </li>
            <li>
              <a href="index.php#customers">View Customers</a>
          </li>
            <li>
                <a href="history.php#transactions">Transactions</a>
            </li>
            
        </ul>
      </nav>
    </header>

    
    <?php
include 'config.php';

if(isset($_POST['submit']))
{
    $sender = $_GET['id'];
    $receiver = $_POST['receiver'];
    $amount = $_POST['amount'];

    $sql = "SELECT * from customers where id=$sender";
    $query = mysqli_query($conn,$sql);
    $sql1 = mysqli_fetch_array($query); 

    $sql = "SELECT * from customers where id=$receiver";
    $query = mysqli_query($conn,$sql);
    $sql2 = mysqli_fetch_array($query);



    
    if (($amount)<0)
   {
        echo '<script type="text/javascript">';
        echo ' alert("Error! You can not transfer negative amount")';
        echo '</script>';
    }

    
    else if($amount > $sql1['amount']) 
    {       
        echo '<script type="text/javascript">';
        echo ' alert("Insufficient Balance!!!")'; 
        echo '</script>';
    }
    
 
    else if($amount == 0)
    {
         echo "<script type='text/javascript'>";
         echo "alert('Error! Zero value cannot be transferred')";
         echo "</script>";
    }


    else {
        
                
                $newbalance = $sql1['amount'] - $amount;
                $sql = "UPDATE customers set amount=$newbalance where id=$sender";
                mysqli_query($conn,$sql);
                           
                $newbalance = $sql2['amount'] + $amount;
                $sql = "UPDATE customers set amount=$newbalance where id=$receiver";
                mysqli_query($conn,$sql);
                
                $sender = $sql1['name'];
                $receiver = $sql2['name'];
                $sql = "INSERT INTO transfers (`sender`, `receiver`, `amount`) VALUES ('$sender','$receiver','$amount')";
                $query=mysqli_query($conn,$sql);

                if($query)
                {
                     echo "<script> alert('Successfully Transferred!!!');
                                     window.location='history.php';
                           </script>";
                    
                }

                $newbalance= 0;
                $amount =0;
        }   
}
?>


<body>
 
<section id="transactions">
	<div class="container">
        <br><h2 class="tittle">Make Transaction</h2>
        <h3 > Bank Holder:</h3>

        
            <?php
                include 'config.php';
                $sid=$_GET['id'];
                $sql = "SELECT * FROM  customers where id=$sid";
                $result=mysqli_query($conn,$sql);
                if(!$result)
                {
                    echo "Error : ".$sql."<br>".mysqli_error($conn);
                }
                $rows=mysqli_fetch_assoc($result);
            ?>
            <form method="post" name="tcredit" class="tabletext" ><br>
        <div>
            <table class="table table-striped table-hover">
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Balance</th>
                </tr>
                <tr>
                    <td class="py-2"><?php echo $rows['id'] ?></td>
                    <td class="py-2"><?php echo $rows['name'] ?></td>
                    <td class="py-2"><?php echo $rows['email'] ?></td>
                    <td class="py-2"><?php echo $rows['amount'] ?></td>
                </tr>
            </table>
        </div>

                <br>
          <p> Choose the name of the person you want to transfer money to, input the amount you wish to send them and click on the transfer button</p>
                <br>

          <div class="col-md-6 col-sm-6">     
          <h4>Transfer Money To:</h4>
          <select name="receiver" class="form-control" required>
            <option value="" disabled selected>Choose</option>
            <?php
                include 'config.php';
                $sid=$_GET['id'];
                $sql = "SELECT * FROM customers where id!=$sid";
                $result=mysqli_query($conn,$sql);
                if(!$result)
                {
                    echo "Error ".$sql."<br>".mysqli_error($conn);
                }
                while($rows = mysqli_fetch_assoc($result)) {
            ?>
                <option class="table" value="<?php echo $rows['id'];?>" >
                
                    <?php echo $rows['name'] ;?> (Balance: 
                    <?php echo $rows['amount'] ;?> ) 
               
                </option>
            <?php 
                } 
            ?>
            <div>
        </select>
            </div>
        

            <div class="col-md-6 col-sm-6"> 
            <h4>Amount:</h4>
            <input type="number" class="form-control" name="amount" required>   
            <br><br>
            </div>
            
            <div class="text-center" >
            <button class="btn btn-primary " name="submit" type="submit" >Transfer</button> &nbsp &nbsp
            <a href="index.php#customers" style="text-decoration:none" > <button class="btn btn-secondary ml-2"  >Cancel</a></button>
            </div>

            </div>

        </form>
    
 
</section>

<section> 
       <div class="footer">               
            <div class="col-md-12 text-center">
             © Copyright khuzaymah khalid. All Rights Reserved (The Sparks Internship)
            </div>    
        </div>
</section>    


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>        

   