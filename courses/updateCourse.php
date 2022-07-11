<?php

$rawPostBody = file_get_contents("php://input");
/*
Structure will look like this:
(
    [0] => stdClass Object
        (
            [originalCourseTitle] => COMP3015 PHP
            [newCourseTitle] => wefew
        )

    [1] => stdClass Object
        (
            [originalCourseTitle] => COMP3012 Node
            [newCourseTitle] => yyyy
        )

)
*/

$json = (array) json_decode($rawPostBody);

$courses = json_decode(file_get_contents('./courses.json'), true);
/*
Payload looks like this:
(
    [originalCourseTitle] => COMP3015 PHP
    [newCourseTitle] => COMP3040
)
*/
foreach ($json as $index => $payload) {
  $payloadAsArray = json_decode(json_encode($payload), true);
  foreach($courses["database"] as $idx => $course) {
    if($course["courseTitle"] == $payloadAsArray["originalCourseTitle"]) {
      $courses["database"][$idx]["courseTitle"] = $payloadAsArray["newCourseTitle"];
    }
  }
}
file_put_contents('./courses.json', json_encode($courses, JSON_PRETTY_PRINT));
header('Location: index.php');