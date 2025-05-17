<?php
include 'db.php';

// Add Shelter
if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST['shelter_id'])) {
    $name = $_POST['name'];
    $location = $_POST['location'];
    $contact_email = $_POST['contact_email'];
    $contact_phone = $_POST['contact_phone'];

    $sql = "INSERT INTO Shelters (name, location, contact_email, contact_phone) 
            VALUES ('$name', '$location', '$contact_email', '$contact_phone')";
    $conn->query($sql);
    header("Location: shelters.php");
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Shelter Management</title>
    <link rel="stylesheet" href="shelters2.css">
</head>
<body>
<div class="container">


    <div class="shelter-list-container">
        <?php
       $sql = "SELECT * FROM shelters";  // This should be above line 83
$result = $conn->query($sql);


        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<div class='shelter-card'>
                        <div class='shelter-id'>ID: {$row["shelter_id"]}</div>
                        <p><strong>Name:</strong> {$row["name"]}</p>
                        <p><strong>Location:</strong> {$row["location"]}</p>
                        <p><strong>Email:</strong> {$row["contact_email"]}</p>
                        <p><strong>Phone:</strong> {$row["contact_phone"]}</p>
                        
                    </div>";
            }
        } else {
            echo "<p style='text-align:center; width:100%;'>No shelters found.</p>";
        }
        ?>
    </div>
</div>

<footer>
    Shelter Management
</footer>
</body>
</html>
