<?php
@include 'mechconfig.php';

$select = "SELECT * FROM mechanics";
$result = mysqli_query($conn, $select);

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="./style.css">
   <title>Mechanic List</title>

   <style>

    *{
        margin:0;
        padding:0;
        box-sizing:border-box;
    }

      body {
         font-family: Arial, sans-serif;
         background-color: #f5f5f5;
         margin: 0;
      }

      .user-list-container {
         max-width: 800px;
         margin: 0 auto;
         background-color: #fff;
         padding: 20px;
         border-radius: 5px;
         box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      }

      h3 {
         color: #333;
      }

      table {
         width: 100%;
         border-collapse: collapse;
         margin-top: 20px;
      }

      th, td {
         padding: 10px;
         text-align: left;
         border-bottom: 1px solid #ddd;
      }

      th {
         background-color: #f2f2f2;
      }

      tr:hover {
         background-color: #f9f9f9;
      }

      p {
         color: #888;
      }
   </style>


</head>
<body>

      <!-- nav of DashBoard -->

      <?php
        include'nav-bar.html';
      ?>




   <div class="user-list-container">

      <h3>Mechanic List</h3>

      <?php if(mysqli_num_rows($result) > 0): ?>

         <table>
            <tr>
               <th>Name</th>
               <th>Email</th>
               <th>Phone</th>
               <th>Location</th>
            </tr>

            <?php while($row = mysqli_fetch_assoc($result)): ?>
               <tr>
                  <td><?php echo $row['name']; ?></td>
                  <td><?php echo $row['email']; ?></td>
                  <td><?php echo $row['phone']; ?></td>
                  <td><?php echo $row['location']; ?></td>
               </tr>
            <?php endwhile; ?>

         </table>

      <?php else: ?>
         <p>No Mechanics found.</p>
      <?php endif; ?>

   </div>

   <!-- <script src="./index.js"></script>
   <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script> -->
</body>
</html>
