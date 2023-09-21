<?php
session_start();

$alpa = ['A', 'B', 'C', 'D'];
// Define an array of questions and answers
$questions = [
    [
        'question' => 'Cika cikan Musulunci guda nawa ne?',
        'options' => ['11', '20', '5', '6'],
        'correct_answer' => '5',
        
    ],
    [
        'question' => 'Wanne ne ba ya daga cikin Cika cikan Imani?',
        'options' => ['Yadda da qaddara', 'Imani da Allah', 'Imani da mala\'iku', 'Tsaida Salla'],
        'correct_answer' => 'Tsaida Salla',
        
    ],
   
    [
        'question' => 'Shin Annabi Daidai ya ke da Manzo?',
        'options' => ['EH', 'A\'a', 'Ban Tabbatar ba', 'Akwai Shubuha'],
        'correct_answer' => 'A\'a',
        
    ],
    [
        'question' => 'Wanne littafi ne aka saukarwa Annabi Isa A.S?',
        'options' => ['Qur\'ani', 'Injila', 'Zabura', 'Attaura'],
        'correct_answer' => 'Injila',
        
    ],
    [
        'question' => 'Daga cikinnan akwai siffofin da ba\'a siffanta Allah da shi Wanne ne?',
        'options' => ['Alqaadiru', 'Alhayyu', 'Alimu', 'Ajizu'],
        'correct_answer' => 'Ajizu',
        
    ],
    [
        'question' => 'wanda ya tarar ana salla daidai lokacin anyi ruku\'u daga zuwa sai yayi kabbara shima yayi ruku\'u ya ya matsayin sallarsa?',
        'options' => ['Sallarshi tayi', 'Bashi da salla', 'Bashi da salla saboda baiyi kabbarar harama ba', 'Zaiyi Ba\'adi bayan '],
        'correct_answer' => 'Zaiyi Ba\'adi bayan ',
        
    ],
    [
        'question' => 'Me ke Kawo sujudul Ba\'adi a salla?',
        'options' => ['Idan aka yi Kari a salla', 'Idan akayi Ragi', 'Idan mutum ya yi kari ko ragi', 'Babu ko daya'],
        'correct_answer' => 'Idan aka yi Kari a salla',
        
    ],
    [
        'question' => 'Me ke Kawo sujudul Qabli a salla?',
        'options' => ['Idan aka yi Kari a salla', 'Idan akayi Ragi', 'Idan mutum ya yi kari ko ragi', 'Babu ko daya'],
        'correct_answer' => 'Idan akayi Ragi',
        
    ],
    [
        'question' => 'Wanne ne ke sanya janaba anan?',
        'options' => ['Fitowar Maniyy', 'Fitowar Maziyy', 'Fitowar Wadiy', 'Babu ko daya'],
        'correct_answer' => 'Fitowar Maniyy',
        
    ],
    [
        'question' => 'Ya hukuncin mai azumi daya futar da maniy alhalin yana yanayin mafarki cikin barci?',
        'options' => ['Azuminsa ya karye ', 'Azuminsa na nan', 'Azuminsa ya koma na lada', 'Babu ko daya'],
        'correct_answer' => 'Azuminsa na nan',
        
    ],
];

// Initialize variables or retrieve from session
$current_question = isset($_SESSION['current_question']) ? $_SESSION['current_question'] : 0;
$score = isset($_SESSION['score']) ? $_SESSION['score'] : 0;
$message = '';

// Process user's answer
if (isset($_POST['answer'])) {
    $user_answer = $_POST['answer'];
    $correct_answer = $questions[$current_question]['correct_answer'];

    if ($user_answer == $correct_answer) {
        $score++;
        $message = "Correct!";
    } else {
        $message = "Incorrect. The correct answer is: $correct_answer";
    }

    $current_question++;

    // Check if the quiz is finished
    if ($current_question >= count($questions)) {
        $message = "Quiz finished. Your score: $score/" . count($questions);
        // Optionally, you can reset the quiz here.
        // $current_question = 0;
        // $score = 0;
    }

    // Store updated variables in session
    $_SESSION['current_question'] = $current_question;
    $_SESSION['score'] = $score;
}

// Check if the user wants to restart the quiz
if (isset($_POST['restart'])) {
    $current_question = 0;
    $score = 0;
    $_SESSION['current_question'] = $current_question;
    $_SESSION['score'] = $score;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Islamic Quiz</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>


    <div class="quiz-container">
        <h1>Islamic Quiz</h1>
        <?php if ($current_question < count($questions)) : ?>
    <h3>Question <?php echo $current_question + 1; ?>/<?php echo count($questions); ?></h3>
    
    <div class="question">
        <form method="post">
            <p class="question-text"><?= $questions[$current_question]['question'] ?></p>
            <?php foreach ($questions[$current_question]['options'] as $index => $option) : ?>
                <div class="form-control">
                    <input type="radio" id="radio<?= $index ?>" name="answer" value="<?= $option ?>"> 
                    <label for="radio<?= $index ?>" class="custom-radio-label">  <?=$option?>  </label>
                </div>
            <?php endforeach ?>
            <button type="submit" class="submit-button">Submit</button>
        </form>
    </div>
<?php endif ?>

<?php if ($message) : ?>
        <div class="result"><?= $message ?></div>
    
    <?php endif; ?>
    <?php if ($current_question >= count($questions)) : ?>
        <div class="result">
            Thanks for participating in this wonderful quiz.
            <br><br>
              <form method="post">
            <input type="submit" name="restart" value="Restart Quiz" class="submit-button">
        </form> </div>
    <?php endif; ?>
</div>

</body>
</html>































