<?php
require_once('./partials/connection.php');
$id = htmlspecialchars($_GET['id']);

$sql = "DELETE FROM `players` WHERE `id` = $id";
if ($connection->query($sql)) {
    header('location: ./');
} else {
    die("Failed to delete");
}
