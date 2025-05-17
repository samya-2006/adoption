<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: intro.php");
    exit();
}

$isAdmin = $_SESSION['admin'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pet Adoption Management</title>
    <link rel="stylesheet" href="index.css" />
    <link href="https://fonts.googleapis.com/css2?family=Fira+Code&family=Lato&family=Montserrat&family=Poppins&family=Playfair+Display&family=Roboto&display=swap" rel="stylesheet" />
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
  
</head>
<body>

   

            <?php if ($isAdmin): ?>
                 <header>
        <h1>Welcome to Pet Adoption Management System</h1>
    </header>

    <div class="container">
        
        <div class="inst" align="center">
           
        </div>

        <div class="link-grid">
                <div class="heading"><h2>MANAGE THE FOLLOWING TABLES</h2></div>
               
                 <p>Click on the links below to manage the different sections of the pet adoption database:</p>
                  <div class="card-grid">
                 <a href="pets.php" class="card"><i class="fas fa-paw"></i><span>Manage Pets</span></a>
      <a href="foster_homes.php" class="card"><i class="fas fa-house-user"></i><span>Manage Foster Homes</span></a>
      <a href="shelters.php" class="card"><i class="fas fa-warehouse"></i><span>Manage Shelters</span></a>
      <a href="adopters.php" class="card"><i class="fas fa-users"></i><span>Manage Adopters</span></a>
      <a href="employees.php" class="card"><i class="fas fa-user-tie"></i><span>Manage Employees</span></a>
      <a href="medical_records.php" class="card"><i class="fas fa-notes-medical"></i><span>Manage Medical Records</span></a>
      <a href="supplies.php" class="card"><i class="fas fa-boxes-stacked"></i><span>Manage Supplies</span></a>
      <a href="adoptions.php" class="card"><i class="fas fa-heart"></i><span>Manage Adoptions</span></a>
      </div>
        </div>
    </div>
            <?php else: ?>
                  <header>
        <h1>Welcome to the Adoption Den</h1>
    </header>

    <div class="container">
        
        <div class="inst" align="center">
           
        </div>
<div class="subheading"><h2 >"Your Pet’s Forever Home Starts Here"</h2></div>
<br>
                 <p>Click on the links below to view pet's status: </p>
        
                  <div class="grid">
                <a href="pets2.php" class="card"><i class="fas fa-paw"></i>Pets Available</a>
                <a href="foster_homes2.php" class="card"><i class="fas fa-house-user"></i>Foster Homes</a>
                <a href="shelters2.php" class="card"><i class="fas fa-warehouse"></i>See Shelters</a>
                <a href="medical_records2.php" class="card"><i class="fas fa-notes-medical"></i>Medical Records</a>
                <a href="adopters2.php" class="card"><i class="fas fa-users"></i>Add New Adopter</a>
                </div>
            <?php endif; ?>
        </div>
    </div>

</body>
</html>