<?php
include "header.php";

// Grid container start
echo "<div class='students-container'>";

if (file_exists("students.txt")) {
    $lines = file("students.txt");

    foreach ($lines as $line) {
        list($name, $email, $skills) = explode("|", trim($line));
        $skillsArray = explode(",", $skills);

        echo "<div class='student-card'>";
        echo "<strong class='student-name'>Name:</strong> $name<br>";
        echo "<strong class='student-email'>Email:</strong> $email<br>";
        echo "<strong class='student-skills'>Skills:</strong>";
        echo "<ul class='skills-list'>";
        foreach ($skillsArray as $skill) {
            echo "<li>$skill</li>";
        }
        echo "</ul>";
        echo "</div>";
    }
} else {
    echo "<p class='message'>No students found</p>";
}

// Grid container end
echo "</div>";

include "footer.php";
