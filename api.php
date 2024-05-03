<?php
// Asetetaan sisällön tyyppi JSON-muotoon
header("Content-type: application/json");

// Sisällytetään tietokantayhteys
include('conn.php');

// Sisällytetään tarvittavat funktiot
$action = $_POST["action"];

// Funktio kaikkien opiskelijoiden lukemiseen
function readAll($conn) {
    $data = array();
    $message = array();

    $query = "SELECT * FROM student";
    $result = $conn->query($query);

    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        $message = array("status" => true, "data" => $data);
    } else {
        $message = array("status" => false, "data" => $conn->error);
    }

    echo json_encode($message);
}

// Funktio uuden opiskelijan rekisteröimiseen
function Register($conn) {
    $studentId = $_POST["id"];
    $studentName = $_POST["name"];
    $studentClass = $_POST["class"];

    $query = "INSERT INTO student (id, name, class) VALUES ('$studentId', '$studentName', '$studentClass')";
    $result = $conn->query($query);

    if ($result) {
        $data = array("status" => true, "data" => "Rekisteröinti onnistui");
    } else {
        $data = array("status" => false, "data" => $conn->error);
    }

    echo json_encode($data);
}

// Funktio opiskelijan tiedon päivittämiseen
function update($conn) {
    $message = array();

    if (isset($_POST["id"])) {
        $id = $_POST["id"];

        $query = "UPDATE student SET name = ?, class = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssi", $_POST["name"], $_POST["class"], $id); 
        $result = $stmt->execute();

        if ($result) {
            $message = array("status" => true, "data" => "Päivitys onnistui");
        } else {
            $message = array("status" => false, "data" => $stmt->error);
        }

        $stmt->close();
    } else {
        $message = array("status" => false, "data" => "ID-parametri puuttuu");
    }

    echo json_encode($message);
}

// Funktio opiskelijan poistamiseen
function delete($conn) {
    $message = array();

    if (isset($_POST["id"])) {
        $id = $_POST["id"];

        $query = "DELETE FROM student WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $id); // Olettaen, että 'id' on kokonaisluku
        $result = $stmt->execute();

        if ($result) {
            $message = array("status" => true, "data" => "Poisto onnistui");
        } else {
            $message = array("status" => false, "data" => $stmt->error);
        }

        $stmt->close();
    } else {
        $message = array("status" => false, "data" => "ID-parametri puuttuu");
    }

    echo json_encode($message);
}

// Kutsutaan tarvittavaa toimintoa toiminnon perusteella
if (isset($action)) {
    // Kutsutaan toimintoa suoraan
    $action($conn);
} else {
    // Jos toimintoa ei ole määritetty
    echo json_encode(array("status" => false, "data" => "Toiminto vaaditaan"));
}
?>
