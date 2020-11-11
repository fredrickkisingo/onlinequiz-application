<?php
require_once 'database.php';

$stm = $conn-> prepare("select * from question");
$stm->execute();
?>
<h3>Quiz</h3>
<form method="post" action="result.php">
<ol type="1">
    <?php while ($question = $stm->fetch(PDO::FETCH_OBJ)) { ?>
    <li>
    <?php echo $question->content; ?>
    <input type="hidden" name="questionId[]" value="<?php echo $question->id; ?>">
        <ol type = "a">
        <?php
                $stm2 = $conn-> prepare("select * from answer where question_id=:question_id");
                $stm2->bindValue("question_id", $question->id);
                $stm2->execute();
        ?>
            <?php while ($answer = $stm2->fetch(PDO::FETCH_OBJ)) { ?>
            <li>
                <input type="radio" name="question_<?php echo $question->id; ?>"
                    value="<?php echo $answer->id; ?>">
                <?php echo $answer->content; ?>
            </li>
            <?php } ?>
        </ol>
    </li>
    <?php } ?>
    </ol>
    <br>
    <input type="submit" value="Submit">
<form>