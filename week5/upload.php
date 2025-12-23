<?php
include "header.php";
require "functions.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {
        $fileName = uploadPortfolioFile($_FILES["portfolio"]);
        $message = "File uploaded: " . $fileName;
    } catch (Exception $e) {
        $message = $e->getMessage();
    }
}
?>

<form method="post" enctype="multipart/form-data">
    <input type="file" name="portfolio"><br><br>
    <button type="submit">Upload File</button>
</form>

<p><?php echo $message; ?></p>

<?php include "footer.php"; ?>
