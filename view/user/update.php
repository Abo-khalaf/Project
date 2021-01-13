<?php
namespace Anax\View;
/**
 * View to create a new book.
 */

$item = isset($item) ? $item : null;
// Create urls for navigation
$urlToView = url("user");
?><h1>Update</h1>

<?= $form ?>

<p>
    <a href="<?= $urlToView ?>">Tillbaka</a>
</p>