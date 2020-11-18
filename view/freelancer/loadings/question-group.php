
<?php
include '../../../commons/session.php';
include '../../../model/freelancer_model.php';
$freelancerObj = new Freelancer(); /// create feelancer object

$group = $_REQUEST['group'];
$freelancer_id = $_SESSION["freelancer"]["freelancer_id"];

//check if already done
$check_group = $freelancerObj->checkGroup($group,$freelancer_id);

if($_SESSION["freelancer"]) {

    if($check_group->num_rows == 0) {
    ?>
    <form action="../../controller/freelancercontroller.php?status=skill_upgrade" method="post" id="quiz_form_<?php echo $group;?>">
        <input type="hidden" name="group" id="group" value="<?php echo $group;?>">
        <ol>
            <?php
            $i = 0; // questions count
            $questions = $freelancerObj->getQuestionsForGroup($group);
            while($question = $questions->fetch_assoc()) {
                $i++;
            ?>
            <li>
                <h5> <?php echo $question['question'];?> </h5>
                <?php
                $j = 0; // answers count
                $answers = $freelancerObj->getAnswersForQuestion($question['question_id']);
                while($answer = $answers->fetch_assoc()) {
                    $j++
                ?>
                <div>
                    <input type="radio" name="question_<?php echo $i;?>_answer" id="question_<?php echo $i;?>_answer_<?php echo $j;?>" value="<?php echo base64_encode($answer['is_correct']);?>" required/>
                    <label for="question_<?php echo $i;?>_answer_<?php echo $j;?>"> <?php echo $j.") ".$answer['answers'];?> </label>
                </div>
                <?php
                }
                ?>
            </li>
            <?php
            }
            ?>
        </ol>
        <input type="hidden" name="questions_count" id="questions_count" value="<?php echo $i;?>">
        <button type="submit" class="btn btn-success">SUBMIT</button>

    </form>
    <?php
    }
    else {
        ?>
        <div>

            <p>U have already done this quiz. please select another one</p>

        </div>
        <?php
    }

} else {
    echo 'Invalid Freelancer';
}
?>