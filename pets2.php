<?php
include 'db.php'; // Include the database connection file

// Add Pet
if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST['pet_id'])) {
    $name = $_POST['name'];
    $species = $_POST['species'];
    $breed = $_POST['breed'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $adoption_status = $_POST['adoption_status'];

    $sql = "INSERT INTO Pets (name, species, breed, age, gender, adoption_status) 
            VALUES ('$name', '$species', '$breed', '$age', '$gender', '$adoption_status')";
    $conn->query($sql);
    header("Location: pets.php");
    exit();
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pet Management</title>
    <link rel="stylesheet" href="pets2.css"> <!-- Ensure this is the correct path -->
</head>
<body>
    <div class="container">
      
        <div class="pet-list-container">
            <?php
            $sql = "SELECT * FROM Pets";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $adoption_status = $row["adoption_status"];

                    echo "<div class='pet-card'>
                        <p class='pet-id'>ID: " . $row["pet_id"] . "</p>
                        <div class='pet-card-grid'>
                            <p><strong>Name:</strong> " . $row["name"] . "</p>
                            <p><strong>Species:</strong> " . $row["species"] . "</p>
                            <p><strong>Breed:</strong> " . $row["breed"] . "</p>
                            <p><strong>Age:</strong> " . $row["age"] . "</p>
                            <p><strong>Gender:</strong> " . $row["gender"] . "</p>
                            <p><strong>Status:</strong> " . ($adoption_status ? $adoption_status : 'N/A') . "</p>
                        </div>
                    
                    </div>";
                }
            } else {
                echo "No pets found.";
            }
            ?>
        </div>
    </div>
</body>
<footer>
  Pet Management &nbsp;&nbsp;&nbsp; Quick Reference: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Adoption Status 1: Available / 2: Adopted / 3: Pending / 4: Fostered / &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Gender: 1: Male / 2: Female
</footer>
</html>
