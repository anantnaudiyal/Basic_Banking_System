<?php
include 'config.php';

if(isset($_POST['submit']))
{
    $from = $_GET['account'];
    $to = $_POST['to'];
    $amount = $_POST['amount'];

    $sql = "SELECT * from account where account=$from";
    $query = mysqli_query($conn,$sql);
    $sql1 = mysqli_fetch_array($query); 

    $sql = "SELECT * from account where account=$to";
    $query = mysqli_query($conn,$sql);
    $sql2 = mysqli_fetch_array($query);

    if (($amount)<0)
    {
         echo '<script type="text/javascript">';
         echo ' alert("Oops! Negative values cannot be transferred")';  
         echo '</script>';
     }
 
     
     else if($amount > $sql1['balance']) 
     {
         
         echo '<script type="text/javascript">';
         echo ' alert("Bad Luck! Insufficient Balance")';  
         echo '</script>';
     }
     
 

     else if($amount == 0){
 
          echo "<script type='text/javascript'>";
          echo "alert('Oops! Zero value cannot be transferred')";
          echo "</script>";
      }
 
 
     else {
         
                 $newbalance = $sql1['balance'] - $amount;
                 $sql = "UPDATE account set balance=$newbalance where account=$from";
                 mysqli_query($conn,$sql);
              
 
                 $newbalance = $sql2['balance'] + $amount;
                 $sql = "UPDATE account set balance=$newbalance where account=$to";
                 mysqli_query($conn,$sql);
                 
                 $sender = $sql1['hname'];
                 $receiver = $sql2['hname'];
                 $sql = "INSERT INTO transactions(`sender`, `receiver`, `amount`) VALUES ('$sender','$receiver','$amount')";
                 $query=mysqli_query($conn,$sql);
 
                 if($query){
                      echo "<script> alert('Hurray! Transaction is Successful');
                                      window.location='history.php';
                            </script>";
                     
                 }
 
                 $newbalance= 0;
                 $amount =0;
         }
     
 }
 ?>
 
 <!DOCTYPE html>
 <html lang="en">
   <head>
     <meta charset="UTF-8" />
     <meta http-equiv="X-UA-Compatible" content="IE=edge" />
     <meta name="viewport" content="width=device-width, initial-scale=1.0" />
     <title>Transfer Money</title>
     <link rel="stylesheet" href="./style.css">
     <style>
        .transbutton {
    border-radius: 4px;
    background-color: #f4521e;
    border: none;
    color: #FFFFFF;
    text-align: center;
    font-size: 1rem;
    padding: 1rem;
    width: 9rem;
    transition: all 0.5s;
    cursor: pointer;
    margin: 5px;
  }
  
  .transbutton span {
    cursor: pointer;
    display: inline-block;
    position: relative;
    transition: 0.5s;
  }
  
  .transbutton span:after {
    content: '\00bb';
    position: absolute;
    opacity: 0;
    top: 0;
    right: -20px;
    transition: 0.5s;
  }
  
  .transbutton:hover span {
    padding-right: 25px;
  }
  
  .transbutton:hover span:after {
    opacity: 1;
    right: 0;
  }
     </style>
    </head>
   <body>
    <!-- <?php
    echo "<pre>";
    print_r($_GET);
    echo "</pre>";
    ?> -->
     
     <?php include 'navbar.html'; ?>
 
     <body style = "background-color: pink;">   

     <div align= "center"  style="padding: 7rem;padding-top: 1rem;">
        <h2 style="font-size:3rem; margin-top:1rem;">Easy Money Transfer</h2>
            <?php
                include 'config.php';
                $sid=$_GET['account'];
                $sql = "SELECT * FROM  account where account=$sid";
                $result=mysqli_query($conn,$sql);
                if(!$result)
                {
                    echo "Error : ".$sql."<br>".mysqli_error($conn);
                }
                $rows=mysqli_fetch_assoc($result);
            ?>
            <form method="post" name="tcredit" ><br>
        <div>
            <table align= "center" border=1  style="background: rgb(205, 250, 270); margin:4rem; margin:1rem;">
               <thead>
                <tr  style=" background-color:aqua;">
                    <th >Account No.</th>
                    <th >Account Name</th>
                    <th >Phone No.</th>
                    <th >Account Balane(in Rs.)</th>
                </tr>
                </thead>
                <tbody>
                <tr align="center">
                    <td ><?php echo $rows['account'] ?></td>
                    <td ><?php echo $rows['hname'] ?></td>
                    <td ><?php echo $rows['contact'] ?></td>
                    <td ><?php echo $rows['balance'] ?></td>
                </tr>
                </tbody>
            </table>
        </div>
        <br><br><br>
        <label style="color : blue;"><b>Transfer To:</b></label>
        <select required name="to" >
            <option  value="" disabled selected >Choose account</option>
            <?php
                include 'config.php';
                $sid=$_GET['account'];
                $sql = "SELECT * FROM account where account!=$sid";
                $result=mysqli_query($conn,$sql);
                if(!$result)
                {
                    echo "Error ".$sql."<br>".mysqli_error($conn);
                }
                while($rows = mysqli_fetch_assoc($result)) {
            ?>
                <option  value="<?php echo $rows['account'];?>" >
                
                    <?php echo $rows['hname'] ;?> (Balance: 
                    <?php echo $rows['balance'] ;?> ) 
               
                </option>
            <?php 
                } 
            ?>
            <div>
        </select>
        <br>
        <br>
            <label style="color : blue;"><b>Amount:</b></label>
            <input type="number"  name="amount" required >   
            <br><br>
                
            <button  name="submit" type="submit" class="transbutton" >Transfer Money</button>
            
        </form>
    </div>  
   </body>
 </html>