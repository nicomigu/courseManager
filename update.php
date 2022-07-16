<?php require_once 'header.php' ?>

<?php

require_once 'src/Repositories/CourseRepository.php';
require_once 'src/Repositories/UserRepository.php';

use src\Repositories\CourseRepository;
use src\Repositories\UserRepository;


$id = $_POST['id'];
$oldCourse = (new CourseRepository())->getCourseById(intval($id));
$oldCourseTitle = $oldCourse->courseTitle;

?>

<body>

  <?php require_once 'nav.php' ?>

  <div class="grid grid-cols-12 mt-20">

    <form class="space-y-6 col-start-4 col-span-6" action="update()" method="POST">
      <div>
        <label for="title" class="block text-sm font-medium text-gray-700"> Old Course Title </label>
        <div class="mt-1">
          <?php echo $oldCourseTitle  ?>
        </div>
      </div>
      <div>
        <label for="title" class="block text-sm font-medium text-gray-700"> Course Title </label>
        <div class="mt-1">
          <input id="title" name="courseTitle" type="text" placeholder="New Course Title ex COMP3015" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>
      </div>

      <div>
        <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
          Update Course
        </button>
      </div>
    </form>

  </div>

</body>

<?php

function update()
{
  global $id, $oldCourse;
  $title = $_POST['courseTitle'];
  $userId = $_SESSION['user_id'];
  //$course = (new CourseRepository())->getCourseById(intval($id));
  $updatedCourse = (new CourseRepository())->updateCourse($id, $title, $oldCourse->completed);
  if ($updatedCourse) {
    header('Location: courses.php');
  } else {
    $_SESSION['error_message'] = 'Error updating post';
    header('Location: courses.php');
  }
  exit(0);
}
