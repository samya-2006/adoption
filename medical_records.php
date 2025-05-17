<?php
include 'db.php';

// Add Medical Record
if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST['record_id'])) {
    $pet_id = $_POST['pet_id'];
    $checkup_date = $_POST['checkup_date'];
    $vaccinations = $_POST['vaccinations'];
    $medical_notes = $_POST['medical_notes'];
    $vet_name = $_POST['vet_name'];
    $sql = "INSERT INTO medical_records  
    (pet_id, checkup_date, vaccinations, medical_notes, vet_name) 
            VALUES ('$pet_id', '$checkup_date', '$vaccinations', '$medical_notes', '$vet_name')";
    $conn->query($sql);
    header("Location: medical_records.php");
    exit();
}

// Update Medical Record
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['record_id'])) {
    $record_id = $_POST['record_id'];
    $pet_id = $_POST['pet_id'];
    $checkup_date = $_POST['checkup_date'];
    $vaccinations = $_POST['vaccinations'];
    $medical_notes = $_POST['medical_notes'];
    $vet_name = $_POST['vet_name'];

    $sql = "UPDATE medical_records




 SET pet_id='$pet_id', checkup_date='$checkup_date', vaccinations='$vaccinations', 
            medical_notes='$medical_notes', vet_name='$vet_name' WHERE record_id='$record_id'";
    $conn->query($sql);
    header("Location: medical_records.php");
    exit();
}

// Delete Medical Record
if (isset($_GET['delete'])) {
    $record_id = $_GET['delete'];
    $sql = "DELETE FROM medical_records




 WHERE record_id = $record_id";
    $conn->query($sql);
    header("Location: medical_records.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Medical Records Management</title>
    <link rel="stylesheet" href="medical_records.css">
</head>
<body>
<div class="container">

    <!-- Form Container -->
    <div class="form-container">
        <h2><?php echo isset($_GET['edit']) ? "Update Medical Record" : "Add Medical Record"; ?></h2>
        <form method="POST">
            <?php
            if (isset($_GET['edit'])) {
                $record_id = $_GET['edit'];
                $sql = "SELECT * FROM medical_records




 WHERE record_id = $record_id";
                $result = $conn->query($sql);
                $record = $result->fetch_assoc();
                echo "<input type='hidden' name='record_id' value='{$record['record_id']}'>";
                echo "<input type='number' name='pet_id' value='{$record['pet_id']}' placeholder='Pet ID' required>";
                echo "<input type='date' name='checkup_date' value='{$record['checkup_date']}' required>";
                echo "<input type='text' name='vaccinations' value='{$record['vaccinations']}' placeholder='Vaccinations'>";
                echo "<input type='text' name='medical_notes' value='{$record['medical_notes']}' placeholder='Medical Notes'>";
                echo "<input type='text' name='vet_name' value='{$record['vet_name']}' placeholder='Vet Name' required>";
                echo "<input type='submit' value='Update Record'>";
            } else {
                echo "<input type='number' name='pet_id' placeholder='Pet ID' required>";
                echo "<input type='date' name='checkup_date' required>";
                echo "<input type='text' name='vaccinations' placeholder='Vaccinations'>";
                echo "<input type='text' name='medical_notes' placeholder='Medical Notes'>";
                echo "<input type='text' name='vet_name' placeholder='Vet Name' required>";
                echo "<input type='submit' value='Add Record'>";
            }
            ?>
        </form>
    </div>

    <!-- Records Display -->
    <div class="medical-list-container">        <?php
        $sql = "SELECT * FROM medical_records";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='medical-card'>";
                echo "<div class='record-id'>Record ID: {$row["record_id"]}</div>";
                echo "<p><strong>Pet ID:</strong> {$row["pet_id"]}</p>";
                echo "<p><strong>Checkup Date:</strong> {$row["checkup_date"]}</p>";
                echo "<p><strong>Vaccinations:</strong> {$row["vaccinations"]}</p>";
                echo "<p><strong>Notes:</strong> {$row["medical_notes"]}</p>";
                echo "<p><strong>Vet:</strong> {$row["vet_name"]}</p>";
                echo "<div class='action-buttons'>";
                echo "<a class='edit-btn' href='medical_records.php?edit={$row["record_id"]}'>Edit</a>";
                echo "<a class='delete-btn' href='medical_records.php?delete={$row["record_id"]}' onclick=\"return confirm('Delete this record?')\">Delete</a>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "<p>No medical records found.</p>";
        }
        ?>
    </div>
</div>

<footer> Medical Records Management </footer>
</body>
</html>