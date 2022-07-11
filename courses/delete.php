<?php

$courseName = $_POST['courseName'];

$courses = json_decode(file_get_contents('./courses.json'), true);


foreach($courses["database"] as $idx => $course) {
  if($course["courseTitle"] == $courseName) {
    array_splice($courses["database"], $idx, 1);
  }
}

file_put_contents('./courses.json', json_encode($courses, JSON_PRETTY_PRINT));
header('Location: index.php');