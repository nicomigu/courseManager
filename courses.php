<?php require_once 'header.php'; ?>

<?php

require_once 'src/Repositories/CourseRepository.php';

use src\Repositories\CourseRepository;

session_start();
$courses = [];
if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
    $coursesRepository = new CourseRepository();
    $courses = $coursesRepository->getCoursesForUser($userId);
} else {
    header('Location: login.php');
}
?>

<body>

    <?php require_once 'nav.php' ?>

    <div class="grid grid-cols-12 mt-20">
        <ul role="list" class="divide-y divide-gray-200 space-y-6 col-start-4 col-span-6">
            <span class="font-extrabold"><?php echo count($courses) === 0 ? 'No courses yet.' : 'Your Courses:' ?></span>

            <?php foreach ($courses as $course) : ?>

                <div style="margin-bottom: 20px;" class="ml-3">
                    <form style="display: inline" action="change_status.php?id=<?= $course->id ?>" method="post">
                        <input type="hidden" name="courseName" value="<?= $course->courseTitle ?>">
                        <input type="checkbox" name="status" value="1" <?= $course->completed ? 'checked' : '' ?>>
                    </form>

                    <!-- Editable Course Title  -->
                    <span class="courseTitle" data-originalcoursename="<?= $course->courseTitle ?>" contentEditable="true">
                        <?php echo $course->courseTitle  ?></span>
                    <!-- Editable Course Title End  -->

                    <form style="display: inline" action="delete.php?id=<?= $course->id ?>" method="post">
                        <input type="hidden" name="id" value="<?= $course->id ?>">
                        <button>Delete</button>
                    </form>

                    <!-- Update Button Form  -->
                    <form style="display: none;" id="updateForm" action="updateCourse.php" method="post">
                        <input type="hidden" name="courseName" value="<?= $course->courseTitle ?>">
                        <button id="updateButton">Update</button>
                    </form>
                </div>



            <?php endforeach; ?>

        </ul>
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