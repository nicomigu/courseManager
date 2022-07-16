<?php

require_once 'src/Repositories/CourseRepository.php';
require_once 'src/Repositories/UserRepository.php';

use src\Repositories\CourseRepository;
use src\Repositories\UserRepository;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = $_GET['id'];
  $newCourseName = $_GET
  $userId = $_SESSION['user_id'];
  $course = (new CourseRepository())->getCourseById(intval($id));
  $newStatus = !$course->completed;
  $updatedCourse = (new CourseRepository())->updateCourse($course->courseTitle, $newStatus, $course->id);
  if ($updatedCourse) {
    header('Location: courses.php');
  } else {
    $_SESSION['error_message'] = 'Error creating post';
    header('Location: courses.php');
  }
  exit(0);
}
