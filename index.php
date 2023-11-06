<?php
require 'connect.php';

$php_errormsg = ''; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $city = $_POST['city'];

    if (empty($name) || empty($email) || empty($gender) || empty($city)) {
        $php_errormsg = "All fields are required";
    } else {
        
        try {
            $pdo = connecttoDb();
            $sql = "INSERT INTO form (name, email, gender, city) VALUES (:name, :email, :gender, :city)";
            $statement = $pdo->prepare($sql);

          
            $statement->bindParam(':name', $name);
            $statement->bindParam(':email', $email);
            $statement->bindParam(':gender', $gender);
            $statement->bindParam(':city', $city);

           
            $statement->execute();
            header("Location: list.php"); 
            exit();
        } catch(PDOException $e) {
            
            $php_errormsg = "Error: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Add User</h2>
        <?php if (isset($error)) {
            echo '<div class="alert alert-danger">' . $error . '</div>';
        } ?>
        <form method="post">
            <div class="form-group">
                <label>Name:</label>
                <input type="text" name="name" class="form-control">
            </div>
            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" class="form-control">
            </div>
            <div class="form-group">
                <label>Gender:</label><br>
                <input type="radio" name="gender" value="Male"> Male
                <input type="radio" name="gender" value="Female"> Female
            </div>
            <div class="form-group">
                <label>City:</label>
                <select name="city" class="form-control">
                    <option value="Nagpur">Nagpur</option>
                    <option value="Mumbai">Mumbai</option>
                    <option value="Delhi">Delhi</option>
                    <option value="Banglore">Banglore</option>
                    <option value="Pune">Pune</option>
                    <option value="Hyderabad">Hyderabad</option>
                
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <?php
   
    if (!empty($php_errormsg)) {
        echo "<p>Error: $php_errormsg</p>";
    }
    ?>
</body>
</html>
