<?php
    require('dbconn.php');
    session_start();

    if (isset($_POST['submit'])) {

        $fullName = $_POST['fullName'];
        $email = $_POST['email'];
        $mobileNumber = $_POST['mobileNumber'];
        $birthDate = $_POST['birthDate'];
        $age = $_POST['age'];
        $gender = $_POST['gender'];

        try {
            $stmt = OpenConn()->prepare("INSERT INTO test_user (fullName, email, mobileNumber, birthDate, age, gender) VALUES (:fullName, :email, :mobileNumber, :birthDate, :age, :gender)");
            
            $stmt->bindParam(':fullName', $fullName);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':mobileNumber', $mobileNumber);
            $stmt->bindParam(':birthDate', $birthDate);
            $stmt->bindParam(':age', $age);
            $stmt->bindParam(':gender', $gender);

            $stmt->execute();
            
           echo json_encode(array('saved'));
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
?>