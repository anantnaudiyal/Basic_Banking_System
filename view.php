<?php

$con=mysqli_connect("localhost","root","","customer");
$query="SELECT*FROM account";
$re=mysqli_query($con,$query);
 
?>
<head>

</head>
<body style="background-color: rgb(285, 200, 247);">
 <?php include 'navbar.html'; ?>
 <div style="display:flex; flex-direction:column;">
 <h1 align="center" style=" font-size:3rem; margin-top:1rem;">All Accounts</h1>
 <table style="background: rgb(205, 250, 270); margin:4rem; margin:1rem;" border="2" >
   <tr style=" background-color:aqua;">
     <th>Id</th>
     <th>Holders Name</th>
     <th>Account No.</th>
     <th>Branch Name</th>
     <th>Current Balance</th>
     <th>Account Type</th>
     <th>Contact</th>
     <th>Transfer From</th>
   </tr>

   <?php
   while($row = mysqli_fetch_array($re))
   {
   ?>
   <tr style="text-align:center;">		
      <td><?php echo $row['id']; ?></td>
      <td><?php echo $row['hname']; ?></td>
      <td><?php echo $row['account']; ?></td>
      <td><?php echo $row['branch']; ?></td>
      <td><?php echo $row['balance']; ?></td>
      <td><?php echo $row['atype']; ?></td>
      <td><?php echo $row['contact']; ?></td>
      <td align= "center"  style="width: 7rem;"><a href="transaction.php?account= <?php echo $row['account'] ;?> "> <button type="button" class="btn sbutton ">Transfer money</button></a></td>
   </tr>
   <?php
   }
   ?>
 </table>
</div>
</body>