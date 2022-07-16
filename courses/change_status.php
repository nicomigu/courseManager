<?php

$courses = json_decode(file_get_contents('./courses.json'), true);

$courseName = $_POST['courseName'];

foreach($courses["database"] as $idx => $course) {
  if($course["courseTitle"] == $courseName) {
    $courses["database"][$idx]["completed"] = isset($_POST['status']);
  }
}

file_put_contents('./courses.json', json_encode($courses, JSON_PRETTY_PRINT));
header('Location: index.php');