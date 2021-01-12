<?php
/**
 * Routes for controller.
 */
 return [
     "routes" => [
         [
             "info" => "Controller for answer.",
             "mount" => "questions",
             "handler" => "\Moody\Question\QuestionController",
         ],
     ]
 ];