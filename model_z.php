<?php
require_once 'db_connect.php';



function addTutor($data)       //Done
{
    $conn = db_conn();
    $selectQuery = "INSERT into tutorinfo (Name, Email,  Gender, ProfilePic,Phone,CV,tUsername)
VALUES (:Name, :Email, :Gender,:ProfilePic,:Phone,:CV,:tUsername)";
    try {
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([
            ':Name' => $data['Name'],
            ':Email' => $data['Email'],
            ':Gender' => $data['Gender'],
            ':ProfilePic' => $data['ProfilePic'],
            ':CV' => $data['CV'],
            ':Phone' => $data['Phone'],
            ':tUsername' => $data['tUsername']
        ]);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    $conn2 = db_conn();
    $selectQuery2 = "INSERT into login (Email,Username, Password,Type,Verify) VALUES (:Email, :tUsername, :Password, :Type, :Verify)";
    try {
        $stmt = $conn2->prepare($selectQuery2);
        $stmt->execute([
            ':Email' => $data['Email'],
            ':Password' => $data['Password'],
            ':Type' => $data['Type'],
            ':Verify' => $data['Verify'],
            ':tUsername' => $data['tUsername']

        ]);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    $conn3 = db_conn();
    $selectQuery3 = "INSERT into subject (tUsername,Subject) VALUES (:tUsername,:Subject)";
    try {
        $stmt = $conn3->prepare($selectQuery3);
        $stmt->execute([
            ':Subject' => $data['Subject'],
            ':tUsername' => $data['tUsername']
        ]);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $conn3 = null;
    $conn3 = db_conn();
    $selectQuery3 = "INSERT into salary (Username,Salary) VALUES (:tUsername, :Salary)";
    try {
        $stmt = $conn3->prepare($selectQuery3);
        $stmt->execute([
            ':Salary' => $data['Salary'],
            ':tUsername' => $data['tUsername']
        ]);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }




    $conn3 = null;
    $conn3 = db_conn();
    $selectQuery3 = "INSERT into location (tUsername,Location) VALUES (:tUsername, :Location)";
    try {
        $stmt = $conn3->prepare($selectQuery3);
        $stmt->execute([
            ':Location' => $data['Location'],
            ':tUsername' => $data['tUsername']
        ]);
    } catch (PDOException $e) {
        echo $e->getMessage() . " location";
    }

    $conn3 = null;
    $conn3 = db_conn();
    $selectQuery3 = "INSERT into classlevel (tUsername,Level) VALUES (:tUsername, :Level)";
    try {
        $stmt = $conn3->prepare($selectQuery3);
        $stmt->execute([
            ':Level' => $data['Level'],
            ':tUsername' => $data['tUsername']
        ]);
    } catch (PDOException $e) {
        echo $e->getMessage() . " Class ";
    }



    $conn = null;
    $conn2 = null;
    $conn3 = null;
    return true;
}



function addAdmin($data)       //Done
{
    $conn = db_conn();
    $selectQuery = "INSERT into admininfo (Name, Email, Gender,Phone,Type)  VALUES (:Name, :Email, :Gender,:Phone,:Type)";
    try {
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([
            ':Name' => $data['Name'],
            ':Email' => $data['Email'],
            ':Type' => $data['Type'],
            ':Gender' => $data['Gender'],
            ':Phone' => $data['Phone']
        ]);
    } catch (PDOException $e) {
        echo $e->getMessage() . "tutorinfo";
    }

    $conn2 = db_conn();
    $selectQuery2 = "INSERT into login (Email,Username, Password,Type,Verify) VALUES (:Email, :tUsername, :Password, :Type, :Verify)";
    try {
        $stmt = $conn2->prepare($selectQuery2);
        $stmt->execute([
            ':Email' => $data['Email'],
            ':Password' => $data['Password'],
            ':Type' => $data['Type'],
            ':Verify' => $data['Verify'],
            ':tUsername' => $data['tUsername']

        ]);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    $conn = null;
    $conn2 = null;
    $conn3 = null;
    return true;
}

function checkLogin($data)
{
    $conn = db_conn();
    $selectQuery = "SELECT * FROM login where Email = ? and Password = ? and  Type = ? and  Verify = ?";

    try {
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([
            $data['Email'], $data['Password'], $data['Type'], $data['Verify']
        ]);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    return $row;
}

function checkPass($data)
{
    $conn = db_conn();
    $selectQuery = "SELECT * FROM login where  Password = ?";

    try {
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([
            $data['Password']
        ]);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    return $row;
}

function checkEmail($data)
{
    $conn = db_conn();
    $selectQuery = "SELECT * FROM login where  Email = ?";

    try {
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([
            $data['Email']
        ]);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    return $row;
}

function checkUsername($data)
{
    $conn = db_conn();
    $selectQuery = "SELECT * FROM login where  Username = ?";

    try {
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([
            $data['tUsername']
        ]);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    return $row;
}

function updatePass($data)
{
    $conn = db_conn();
    $selectQuery = "UPDATE login set Password = ? where Email = ?";
    try {
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([
            $data['Password'], $data['Email']
        ]);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    $conn = null;
    return true;
}



function showAll() //admin
{
    $conn = db_conn();
    $selectQuery = 'SELECT * FROM admininfo';
    try {
        $stmt = $conn->query($selectQuery);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}
function deleteAdmin($Email)
{
    $conn = db_conn();
    $selectQuery = "DELETE FROM admininfo WHERE Email = ?";
    try {
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([$Email]);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $conn = null;
    $conn = db_conn();
    $selectQuery = "DELETE FROM login WHERE Email = ?";
    try {
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([$Email]);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $conn = null;


    return true;
}

function updateType($Email, $Type)
{

    $conn = db_conn();
    $selectQuery = "UPDATE login set Type = ? where Email = ?";
    try {
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([
            $Type, $Email
        ]);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    $conn = null;

    $conn = db_conn();
    $selectQuery = "UPDATE admininfo set Type = ? where Email = ?";
    try {
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([
            $Type, $Email
        ]);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    $conn = null;
    return true;
}


function insertHistory($data)       //Done
{
    $conn = db_conn();
    $selectQuery = "INSERT into rangchnagehistory (Updater, Time,  Name, Status)
VALUES (:Updater, :Time, :Name,:Status)";
    try {
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([
            ':Updater' => $data['Updater'],
            ':Time' => $data['Time'],
            ':Name' => $data['Name'],
            ':Status' => $data['Status']
        ]);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}


function showAllHistory() //admin
{
    $conn = db_conn();
    $selectQuery = 'SELECT * FROM rangchnagehistory';
    try {
        $stmt = $conn->query($selectQuery);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}
