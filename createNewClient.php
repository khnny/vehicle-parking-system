<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "database1";

// Create a connection
$connection = new mysqli($servername, $username, $password, $database);

// Check for connection errors
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}


$name = $_POST["name"] ?? '';
$vehicle_type = $_POST["vehicle_type"] ?? '';
$registration = $_POST["registration"] ?? '';
$slot_occupied = $_POST["slot_occupied"] ?? '';
$date = $_POST["date"] ?? '';

$errorMesage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    do {
        if (empty($name) || empty($vehicle_type) || empty($registration) || empty($slot_occupied) || empty($date)) {
            $errorMessage = "All the fields are required";
            break;
        }

        // Add new client to the database
        $sql = "INSERT INTO clients (name, vehicle_type, registration, slot_occupied, date) 
                VALUES ('$name', '$vehicle_type', '$registration', '$slot_occupied', '$date')";
        $result = $connection->query($sql);

        if (!$result) {
            $errorMesage = "Invalid query: " . $connection->error;
            break;
        }

        $name = "";
        $vehicle_type = "";
        $registration = "";
        $slot_occupied = "";
        $date = "";

        $successMessage = "Client added correctly";
        header("location: /ps1/costumerMngt.php");
        exit;

    } while (false);

    
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" type="image/icon" href="white.jpeg">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Document</title>
</head>
<body>
<div class="sidebar" id="sidebar">
 <div class="logo">
    <img src="newlogo.png" alt="Parking System Logo" width="200" > 
</div>
<ul class="menu">
        <li class="active">
            <a href="#">
                <i class="fas fa-gauge"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <a href="#">
                <i class="bi bi-car-front-fill"></i>
                <span>Parking Slot</span>
            </a>
        </li>
        <li>
            <a href="/ps1/costumerMngt.php">
                <i class="fa fa-xl fa-car color-blue"></i>
                <span>Vehicles Entry</span>
            </a>
        </li>
        <li>
            <a href="#">
                <i class="fa fa-xl fa-toggle-on color-orange"></i>
                <span>IN Vehicles</span>
            </a>
        </li>
        <li>
            <a href="#">
                <i class="fa fa-xl fa-toggle-off color-teal"></i>
                <span>OUT Vehicles</span>
            </a>
        </li>
        <li>
            <a href="#">
                <i class="fas fa-file-alt"></i>
                <span>View Report</span>                
            </a>
        </li>
        <li>
            <a href="#">
                <i class="fas fa-dollar-sign"></i>
                    <span>Total Income</span>
            </a>
        </li>
        <li class="logout">
            <a href="index.php">
                <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
            </a>
        </li>
    </ul>
</div>
<div class="toggle-btn" id="toggleBtn">
    <i class="fas fa-bars"></i>
</div>
    <div class="container my-5">
        <h2>New Client</h2>
        <?php
        if ( !empty($errorMessage) ){
            echo "
            <div class = 'alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>$errorMessage</strong>
                <button type='button'class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
                ";
        }
        ?>
        <form method="POST">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Vehicle_type</label>
                <div class="col-sm-6">
                    <select type="options" class="form-control" name="vehicle_type" value="<?php echo $vehicle_type; ?>">
                      <option value="0">SELECT VEHICLE TYPE</option>
                      <option value="4wheels">4 wheeler</option>
                      <option value="2wheels">2 wheeler</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Registration</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="registration" value="<?php echo $registration; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Slot occupied</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="slot_occupied" value="<?php echo $slot_occupied; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Date</label>
                <div class="col-sm-6">
                    <input type="date" class="form-control" name="date" value="<?php echo $date; ?>">
                </div>
            </div>
            
            <?php
             if ( !empty($successMessage) ){
                echo "
                <div class='row mb-3'>
                    <div class='offset-sm-3 col-sm-3'>
                        <div class = 'alert alert-warning alert-dismissible fade show' role='alert'>
                            <strong>$successMessage</strong>
                            <button type='button'class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div> 
                    </div>
                </div>
                ";
             }
            ?>

            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-outline-primary">submit</button>    
                </div>
                <div class="col-sm-3 d-grid">
                   <a class="btn btn-outline-primary" href="/ps1/costumerMngt.php" role="button">Cancel</a>    
                </div>
            </div>


        </form>

    </div>
    <script src="scripts.js"></script>
</body>
</html>