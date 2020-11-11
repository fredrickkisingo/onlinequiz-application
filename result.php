<?php
require_once 'database.php';

$score = 0;
foreach($_POST['questionId'] as $questionId){
    //Find answer Id correct
    $stm = $conn->prepare("select * from answer where correct = 1 and question_id = ".$questionId);
    $stm->execute();
    $answer = $stm->fetch(PDO::FETCH_OBJ);
    if($answer->id == $_POST['question_'.$questionId]) {
        $score++;
    }
}
?>

<h3>Result</h3>
Score: <?php echo $score; ?>