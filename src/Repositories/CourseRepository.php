<?php

namespace src\Repositories;

require_once 'Repository.php';
require_once __DIR__ . '/../Models/Course.php';

use src\Models\Course;

class CourseRepository extends Repository
{
  public function getCoursesForUser(int $user_id): array
  {
    $sqlStatement = $this->mysqlConnection->prepare("SELECT id, courseTitle, completed, student_id FROM courses WHERE student_id = ?");
    $sqlStatement->bind_param('i', $user_id);
    $sqlStatement->execute();
    $resultSet = $sqlStatement->get_result();

    $courses = [];
    while ($row = $resultSet->fetch_assoc()) {
      $courses[] = new Course($row);
    }

    return $courses;
  }

  public function getCourseById(int $courseId): Course| false
  {
    $sqlStatement = $this->mysqlConnection->prepare("SELECT id, courseTitle, completed, student_id FROM courses WHERE id = ?");
    $sqlStatement->bind_param('i', $courseId);
    $sqlStatement->execute();
    $resultSet = $sqlStatement->get_result();

    if ($resultSet->num_rows === 1) {
      return (new Course($resultSet->fetch_assoc()));
    }
    return false;
  }

  public function updateCourse(int $id, string $courseTitle, int $completed): bool
  {
    $sqlStatement = $this->mysqlConnection->prepare("UPDATE courses SET courseTitle=?, completed=? where id = ?");
    $sqlStatement->bind_param('sii', $courseTitle, $completed, $id);
    return $sqlStatement->execute();
  }

  public function saveCourse(string $courseTitle, string $completed, int $user_id): bool
  {
    $sqlStatement = $this->mysqlConnection->prepare("INSERT INTO courses VALUES(NULL, ?, ?, ?)");
    $sqlStatement->bind_param('ssi', $courseTitle, $completed, $user_id);
    return $sqlStatement->execute();
  }

  public function deleteCourse(int $courseId)
  {
    $sqlStatement = $this->mysqlConnection->prepare("DELETE FROM courses where id=?");
    $sqlStatement->bind_param('i', $courseId);
    return $sqlStatement->execute();
  }
}
