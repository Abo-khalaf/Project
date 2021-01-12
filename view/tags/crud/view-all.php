<?php
namespace Anax\View;
/**
 * View to display all books.
 */
// Show all incoming variables/functions
//var_dump(get_defined_functions());
//echo showEnvironment(get_defined_vars());
// Gather incoming variables and use default values if not set
$tags = isset($tags) ? $tags : null;
?>
<h1  id="tja" style="text-align: center; border-bottom: 1px solid black !important;">  The Tags </h1>
<p style="text-align:center;">Here is the collection of all tags that used on our forum. Click on any fo these tags
so you can find what you want. </p>
<?php
if (!$tags) : ?>
    <p>There are no tags to show.</p>
    <?php
    return;
endif;
?>
<ul class="tags33">
    <?php foreach ($tags as $tag) : ?>
        <?php $link=htmlentities($tag->tag) ?>
         <li style="text-align:center;"> <i style="color: #ffffff; padding: 4px;
      font-size: 20px;" class="fa fa-tag "></i><a href=<?= url("tags/questions/{$link}") ?> class="tag"><?= $tag->tag ?></a></li>
    <?php  endforeach; ?>
</ul>