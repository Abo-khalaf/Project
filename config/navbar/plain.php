<?php
/**
 * Supply the basis for the navbar as an array.
 */
return [
    // Use for styling the menu
    "class" => "my-navbar",
 
    // Here comes the menu items/structure
    "items" => [
        [
            "text" => "Home",
            "url" => "",
            "title" => "Första sidan, börja här.",
        ],
        [
            "text" => "Questions",
            "url" => "questions",
            "title" => "Första sidan, börja här.",
        ],
        [
            "text" => "Tags",
            "url" => "tags",
            "title" => "Första sidan, börja här.",
        ],
        [
            "text" => "Profile",
            "url" => "user",
            "title" => "Första sidan, börja här.",
        ],
        [
            "text" => "About",
            "url" => "about",
            "title" => "Om denna webbplats.",
        ],
        [
            "text" => "<i class='fas fa-sign-in-alt'></i>",
            "url" => "user/logout",
            "title" => "Login",
        ],
    ],
];
