<?php
require 'connect.php';
$pdo=connecttoDb();
$statement=$pdo->prepare('SELECT * FROM form');
$statement->execute();
$users=$statement->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>User List</title>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2>User List</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>City</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($users as $user) {
                    echo "<tr>";
                    echo "<td>" . $user['Name'] . "</td>";
                    echo "<td>" . $user['Email'] . "</td>";
                    echo "<td>" . $user['Gender'] . "</td>";
                    echo "<td>" . $user['City'] . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>


