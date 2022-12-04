<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Transfer History</title>
    
  </head>
  <body style="background-color: rgb(285, 200, 247);" >
    
    <?php include 'navbar.html'; ?>
    <div style="display:flex; flex-direction:column;">
        <h2 align="center" style="font-size:3rem; margin-top:2rem;">Transfer History</h2>
        
       <br>
       
    <table style="background: rgb(205, 250, 270); margin:6rem; margin-top:1rem;" border="2">
        <thead >
            <tr style="height:2rem; background-color:aqua;">
                <th>S.No.</th>
                <th>Sender</th>
                <th>Receiver</th>
                <th>Amount</th>
                <th>Date & Time</th>
            </tr>
        </thead>
      
        <?php

            include 'config.php';
            $conn=mysqli_connect("localhost","root","","customer");
            $sql ="SELECT * FROM transactions";

            $query =mysqli_query($conn, $sql);

            while($rows = mysqli_fetch_assoc($query))
            {
        ?>

            <tr style="text-align:center;">
            <td ><?php echo $rows['sno']; ?></td>
            <td ><?php echo $rows['sender']; ?></td>
            <td ><?php echo $rows['receiver']; ?></td>
            <td ><?php echo $rows['amount']; ?> </td>
            <td ><?php echo $rows['datetime']; ?> </td>
                
        <?php
            }

           ?>
            
          </table>

    </div>   
  </body>
</html>