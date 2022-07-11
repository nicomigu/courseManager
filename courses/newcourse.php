<?php

$courses = json_decode(file_get_contents('./courses.json'), true);

if (isset($_POST['courseName'])){
    $courseName = $_POST['courseName'];
    array_push($courses["database"], ["courseTitle" => $courseName, "completed" => false]);
}

file_put_contents('./courses.json', json_encode($courses, JSON_PRETTY_PRINT));

header('Location: index.php');