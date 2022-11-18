<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
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
                <a href="#home" class="active">Home</a>
            </li>
            <li>
              <a href="#customers">View Customers</a>
          </li>
            <li>
                <a href="history.php#transactions">Transactions</a>
            </li>
            
        </ul>
      </nav>
    </header>

    <section id="home">

        <div class="container-home">
          <h1 class="tittle-1">Sparks Bank</h1><br>
          <h2>Welcome! <br> A customer is the most<br> important visitor at <br>  our premises</h2>
        </div>
            
      </section>


      <section id="customers">
        <div class="container">
            
                <br><br><br><h2 class="tittle">Customers </h2><br>
              <table  class="table table-striped table-hover">
                <thead>

                  <tr>
                  <th  > Id</th>  
                  <th  > Name</th>
                    <th >Email</th>
                    <th >Balance</th>
                    <th >Action</th>
                                
                  </tr>
                </thead>
                <?php
                      
                      $conn = new mysqli('localhost', 'root', '', 'banking_system');
                      if($conn->connect_error){
                      die("Connection Failed : ". $conn->connect_error);
                      }
                  
                      $sql= "SELECT id, name, email, amount from  customers ORDER BY id";
                      $result = $conn-> query($sql);
                  
                      if($result-> num_rows > 0){
                        while($row = $result-> fetch_assoc()){
                        echo "<tr>
                        <td>" . $row["id"]."</td>
                        <td>" . $row["name"]."</td>
                         <td>" . $row["email"]."</td>
                         <td>" . $row["amount"]."</td>
                         
                         <td>";
                         // echo '<a href="read.php?id='. $row['id'] .'" class="mr-3" title="View Record" data-toggle="tooltip">
                          echo '<a href="transfer.php?id='. $row['id'] .'" title="Transfer money" data-toggle="tooltip"><button type="button" class="btn">Transfer Money</button></a>';
                      "</td>";

                        " </tr>";
                         
                        
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

      <section> 
       <div class="footer">             
          <div class="col-md-12 text-center">
           © Copyright khuzaymah khalid. All Rights Reserved (The Sparks Internship)
           </div>             
        </div> 
      </section>    

</body>

</html>

