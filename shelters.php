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

// Update Shelter
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['shelter_id'])) {
    $shelter_id = $_POST['shelter_id'];
    $name = $_POST['name'];
    $location = $_POST['location'];
    $contact_email = $_POST['contact_email'];
    $contact_phone = $_POST['contact_phone'];

    $sql = "UPDATE Shelters SET name='$name', location='$location', contact_email='$contact_email', contact_phone='$contact_phone' WHERE shelter_id='$shelter_id'";
    $conn->query($sql);
    header("Location: shelters.php");
    exit();
}

// Delete Shelter
if (isset($_GET['delete'])) {
    $shelter_id = $_GET['delete'];
    $sql = "DELETE FROM Shelters WHERE shelter_id = $shelter_id";
    $conn->query($sql);
    header("Location: shelters.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Shelter Management</title>
    <link rel="stylesheet" href="shelters.css">
</head>
<body>
<div class="container">

    <div class="form-container">
        <?php
        if (isset($_GET['edit'])) {
            $shelter_id = $_GET['edit'];
            $sql = "SELECT * FROM Shelters WHERE shelter_id = $shelter_id";
            $result = $conn->query($sql);
            $shelter = $result->fetch_assoc();
            echo "<h2>Update Shelter</h2>
            <form method='POST'>
                <input type='hidden' name='shelter_id' value='{$shelter['shelter_id']}'>
                <input type='text' name='name' value='{$shelter['name']}' placeholder='Name' required>
                <input type='text' name='location' value='{$shelter['location']}' placeholder='Location' required>
                <input type='text' name='contact_email' value='{$shelter['contact_email']}' placeholder='Contact Email' required>
                <input type='text' name='contact_phone' value='{$shelter['contact_phone']}' placeholder='Contact Phone' required>
                <input type='submit' value='Update Shelter'>
            </form>";
        } else {
            echo "<h2>Add New Shelter</h2>
            <form method='POST'>
                <input type='text' name='name' placeholder='Name' required>
                <input type='text' name='location' placeholder='Location' required>
                <input type='text' name='contact_email' placeholder='Contact Email' required>
                <input type='text' name='contact_phone' placeholder='Contact Phone' required>
                <input type='submit' value='Add Shelter'>
            </form>";
        }
        ?>
    </div>

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
                        <div class='action-buttons'>
                            <a class='edit-btn' href='shelters.php?edit={$row["shelter_id"]}'>Edit</a>
                            <a class='delete-btn' href='shelters.php?delete={$row["shelter_id"]}' onclick=\"return confirm('Delete this shelter?')\">Delete</a>
                        </div>
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
