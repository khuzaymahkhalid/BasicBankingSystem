<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">    <link rel = "stylesheet" href = "css/style.css">
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel = "stylesheet" href = "css/style.CSS">

</head>

<body>

   <header>
     <div class="logo">The Sparks Bank</div>
      <nav class="topnav">
        <ul id="js-menu">
            <li>
                <a href="index.php#home" class="active">Home</a>
            </li>
            <li>
              <a href="index.php#customers">View Customers</a>
          </li>
            <li>
                <a href="#transactions">Transactions</a>
            </li>
            
        </ul>
      </nav>
    </header>

    <section id="history">

        <div class="container">
            
        <br><h2 class="tittle">History of Transactions </h2><br>
              <table  class="table table-striped table-hover">
                <thead>

                  <tr>
                    <th >Sender </th>
                    <th >Receiver</th>
                    <th >Amount Transferred</th>
                    
                                
                  </tr>
                </thead>
                <?php
                      
                      $conn = new mysqli('localhost', 'root', '', 'banking_system');
                      if($conn->connect_error){
                      die("Connection Failed : ". $conn->connect_error);
                      }
                  
                      $sql= "SELECT sender, receiver, amount from  transfers ORDER BY sender";
                      $result = $conn-> query($sql);
                  
                      if($result-> num_rows > 0){
                        while($row = $result-> fetch_assoc()){
                        echo "<tr>
                         <td>" . $row["sender"]."</td>
                         <td>" . $row["receiver"]."</td>
                         <td>" . $row["amount"]."</td>
                         
                         </tr>";
                      }
                        echo "</table>";
                    }
                    else{
                      echo "o result";
                    }
                    $conn->close();
                        
                ?>
                
        
              </table>
        </div>

      </section>

    </body>
</html>