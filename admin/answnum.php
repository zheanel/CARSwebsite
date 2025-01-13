<?php
include 'dbconf.php';

$unanswered = 0;

$answCount = "SELECT COUNT(id) AS unanswered FROM contact_form WHERE answered = 0";
$stmtanswCount = $conn->prepare($answCount);

if ($stmtanswCount) {
    if ($stmtanswCount->execute()) {
        $result = $stmtanswCount->get_result();
        if ($result) {
            $row = $result->fetch_assoc();
            $unanswered = $row['unanswered'] ?? 0;
            $result->close();
        }
    }
    $stmtanswCount->close();
} else {
    error_log("Failed to prepare statement: " . $conn->error);
}
?>
