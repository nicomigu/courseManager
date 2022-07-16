<?php

require_once 'src/Repositories/CourseRepository.php';
require_once 'src/Repositories/UserRepository.php';

use src\Repositories\CourseRepository;
use src\Repositories\UserRepository;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = $_POST['id'];
  $course = (new CourseRepository())->deleteCourse($id);
  if ($course) {
    header('Location: courses.php');
  } else {
    $_SESSION['error_message'] = 'Error creating post';
    header('Location: new_course.php');
  }
  exit(0);
}
