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

// Update Pet
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['pet_id'])) {
    $pet_id = $_POST['pet_id'];
    $name = $_POST['name'];
    $species = $_POST['species'];
    $breed = $_POST['breed'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $adoption_status = $_POST['adoption_status'];

    $sql = "UPDATE Pets SET name='$name', species='$species', breed='$breed', age='$age', gender='$gender', adoption_status='$adoption_status' WHERE pet_id='$pet_id'";
    $conn->query($sql);
    header("Location: pets.php");
    exit();
}

// Delete Pet
if (isset($_GET['delete'])) {
    $pet_id = $_GET['delete'];
    $sql = "DELETE FROM Pets WHERE pet_id = $pet_id";
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
    <link rel="stylesheet" href="pets.css"> <!-- Ensure this is the correct path -->
</head>
<body>
    <div class="container">
        <div class="form-container">
            <?php
            if (isset($_GET['edit'])) {
                $pet_id = $_GET['edit'];
                $sql = "SELECT * FROM Pets WHERE pet_id = $pet_id";
                $result = $conn->query($sql);
                $pet = $result->fetch_assoc();
                echo "<h2>Update Pet</h2>
                <form method='POST'>
                    <input type='hidden' name='pet_id' value='{$pet['pet_id']}'>
                    <input type='text' name='name' value='{$pet['name']}' placeholder='Name' required><br>
                    <input type='text' name='species' value='{$pet['species']}' placeholder='Species' required><br>
                    <input type='text' name='breed' value='{$pet['breed']}' placeholder='Breed' required><br>
                    <input type='number' name='age' value='{$pet['age']}' placeholder='Age' required><br>
                    <input type='text' name='gender' value='{$pet['gender']}' placeholder='Gender' required><br>
                    <input type='text' name='adoption_status' value='{$pet['adoption_status']}' placeholder='Adoption Status' required><br>
                    <input type='submit' value='Update Pet'>
                </form><hr>";
            } else {
                echo "<h2>Add New Pet</h2>
                <form method='POST'>
                    <input type='text' name='name' placeholder='Name' required><br>
                    <input type='text' name='species' placeholder='Species' required><br>
                    <input type='text' name='breed' placeholder='Breed' required><br>
                    <input type='number' name='age' placeholder='Age' required><br>
                    <input type='text' name='gender' placeholder='Gender' required><br>
                    <input type='text' name='adoption_status' placeholder='Adoption Status' required><br>
                    <input type='submit' value='Add Pet'>
                </form><hr>";
            }
            ?>
        </div>

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
                        <div class='action-buttons'>
                            <a href='pets.php?edit=" . $row["pet_id"] . "' class='edit-btn'>Edit</a>
                            <a href='pets.php?delete=" . $row["pet_id"] . "' class='delete-btn' onclick=\"return confirm('Delete this pet?')\">Delete</a>
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
