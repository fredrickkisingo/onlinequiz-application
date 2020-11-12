<?php
require_once 'database.php';
$stm = $conn-> prepare("select * from question");
$stm->execute();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title> | Online Quiz |</title>
        <link rel="stylesheet" type="text/css" href="style.css"/>
        <link rel="shortcut icon" type="image/png" href="image/logo.png" />
        <style type="text/css">
            body {
                width: 100% !important;
                background: url(skills.jpg) !important;
                background-position: center center !important;
                background-repeat: no-repeat !important;
                background-attachment: fixed;
                background-size: cover !important;
                background-color: rgb(140, 66, 66) ;
            }
        </style>
        <!-- CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

        <!-- jQuery and JS bundle w/ Popper.js -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
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
        <button type="submit" class="btn btn-primary">Submit</button>
    <form>
 </div>  

 <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script> 
</body>
</html>