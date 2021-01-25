<?php
namespace Anax\View;
$filter = new \Anax\TextFilter\TextFilter;
?>

<div class="outer-wrap outer-wrap-flash">
    <div class="inner-wrap inner-wrap-flash">
        <div class="row">
            <div class="region-flash">
                <img class="" src="image/theme/main-logo.png?width=1000&height=300&crop-to-fit&area=0,0,0,0">
            </div>
        </div>
    </div>
</div>




<h2 style="text-align: center;">Latest questions</h2>
<h4 style="text-align: center;">Here you can see the last questions that the pepole asked on the website</h4>


<?php foreach ($questions as $question) : ?>
    <?php $answer = $answers->findAllWhere("question_id = ?", $question->id); ?>
    <?php $comments = $comment->findAllWhere("questionID = ?", $question->id); ?>

        <div class="grid-item rank">
        </div>
        <a href="<?= url("questions/view/{$question->id}"); ?>">
        <div class="product -container askBox pros">
                    <h5><?= $question->title ?></h3>
                    <h3><?= $question->question ?></h3>




           
            <p class="author">Posted at: <?= $question->created ?> </p>
           
            <p  style="margin-bottom:0;">Answers:
            <b style="color:#26df26;"><?= count($answer) ?></b></p>



            <div class="tags">
                <?php $tagsQuestion = explode(" ", $question->tags); ?>
                <?php foreach ($tagsQuestion as $tag) : ?>
                    <?php $link=htmlentities($tag) ?>
                     <p class="tags4">Tags: <a href=<?= url("tags/questions/{$link}") ?> class="tag"><i class=""></i> <?= $tag ?></a></p>
                    </div>
                    <hr>
                    <?php endforeach; ?>
                    
                </div>
            </a>
<?php endforeach; ?>
<div class="mostp">
<h2 style="text-align: center;">Most popular tags</h2>
<ul style="text-align: center;" class="tags">
<?php foreach ($tags as $tag) : ?>
    <?php $link=htmlentities($tag->tag) ?>
    <i style="color:#ffffff; padding: 4px;
font-size: 23px;" class="fa fa-tag "></i> <a href=<?= url("tags/questions/{$link}") ?> class="tag"><?= $tag->tag ?></a>

<?php endforeach; ?>
</ul>
</div>
<hr>

<h2 style="text-align: center;">Most active users</h2>

<div style="text-align: center;" class="grid-container">
<?php foreach ($users as $user) : ?>

    
<div class="grid-container">

    <div style="" >
            <a href="<?= url("user/view/{$user->id}"); ?>">
            <img style=" width:50px" alt="<?=$user->firstname ?>" src="https://img.pngio.com/parent-directory-avatar-2png-39689-png-images-pngio-avatarpng-256_256.png"/>
            </a>
            <figcaption style=" margin:5px;"><?= $user->firstname?><br> <?=$user->lastname?><br></figcaption>
            <br>

<?php endforeach; ?>



<div class="borderdown">
    <?php $answer = $answers->findAll(); ?>
    <p style="margin:10px;">Answers: <?= count($answer) ?></p>
<?php $userComments = $comment->findAll() ?>
    <p style="margin:10px;">Comments: <?= count($userComments) ?></p>
<?php $userQues = $question3->findAll() ?>
    <p style="margin:10px;">Questions: <?= count($userQues) ?></p>




    </div>