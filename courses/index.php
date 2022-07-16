<?php
$courses = json_decode(file_get_contents('./courses.json'), true);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Course Manager</title>
  <!-- Use bahunya.css, a 10kb classless CSS library -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/kimeiga/bahunya/dist/bahunya.min.css">
</head>

<body>
  <div>
    <form action="newcourse.php" method="post">
      <input type="text" name="courseName" placeholder="Enter your course">
      <button>New Course</button>
    </form>
    <br>
    <!-- Loop through each of the courses -->
    <?php foreach ($courses["database"] as $index => $course): ?>
    <div style="margin-bottom: 20px;">

      <!-- Checkbox Form -->
      <form style="display: inline" action="change_status.php" method="post">
        <input type="hidden" name="courseName" value="<?= $course["courseTitle"] ?>">
        <input type="checkbox" name="status" value="1" <?= $course['completed'] ? 'checked' : '' ?>>
      </form>
      <!-- Checkbox Form End  -->

      <!-- Editable Course Title  -->
      <span class="courseTitle" data-originalcoursename="<?= $course["courseTitle"] ?>" contentEditable="true">
        <?php echo $course["courseTitle"]  ?></span>
      <!-- Editable Course Title End  -->

      <!-- Delete Button Form  -->
      <form style="display: inline" action="delete.php" method="post">
        <input type="hidden" name="courseName" value="<?= $course["courseTitle"] ?>">
        <button>Delete</button>
      </form>
      <!-- Delete Button Form End  -->

    </div>
    <?php endforeach; ?>

    <!-- Update Button Form  -->
    <form style="display: none;" id="updateForm" action="updateCourse.php" method="post">
      <input type="hidden" name="courseName" value="<?= $course["courseTitle"] ?>">
      <button id="updateButton">Update</button>
    </form>
    <!-- Update Button Form End  -->
  </div>

  <script>
  /* CODE TO HANDLE CHECKBOX FUNCTIONALITY */
  const checkboxes = document.querySelectorAll('input[type=checkbox]');
  checkboxes.forEach(ch => {
    ch.onclick = function() {
      this.parentNode.submit()
    };
  })

  /* CODE TO HANDLE EDITING TITLES */
  const editedCourses = [];
  const editableCourseTitles = document.querySelectorAll('.courseTitle');
  const updateButton = document.querySelector('#updateButton');

  // Event Handler for when you click out of content-editable
  editableCourseTitles.forEach(course => course.addEventListener("blur", (e) => {
    const updateForm = document.querySelector('#updateForm');
    updateForm.style.display = "block";
    editedCourses.push({
      "originalCourseTitle": e.target.getAttribute("data-originalcoursename"),
      "newCourseTitle": e.target.innerText
    });
  }));

  // Event Handler for when you click on the update button
  updateButton.addEventListener("click", async () => {
    const response = await fetch('/updateCourse.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(editedCourses)
    });
  });
  </script>
</body>

</html>