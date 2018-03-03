<?php get_header(); //inclui o header na página ?>
<?php include "app/Includes/analyticstracking.php"; ?>
<div class="container corpoSite">
    <div class="row">
        <div class="col s9">
            <?php include "app/templates/arquivo.php"; ?>
        </div>
        <div class="col s3"><?php get_sidebar(); //inclui o sidebar ?></div>
    </div>
</div>
<?php get_footer(); ?>
