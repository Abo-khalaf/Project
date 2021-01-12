<?php

namespace Moody\Question;
use Anax\DatabaseActiveRecord\ActiveRecordModel;



class Question extends ActiveRecordModel
{
    protected $tableName = "Questions";

    public $id;
    public $title;
    public $question;
    public $userID;
    public $tags;
    public $created;
}