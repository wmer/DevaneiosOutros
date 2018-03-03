<?php get_header(); //inclui o header na página ?>
<?php include "app/Includes/analyticstracking.php"; ?>
<div class="container corpoSite">
    <!--Home-->
    <div class="row">
        <div class="col s9">
            <!--ultimos posts-->
            <?php include "app/templates/ultimosPosts.php"; ?>
            <!--fim ultimos posts-->
        </div>
        <div class="col s3"><?php get_sidebar(); //inclui o sidebar ?></div>
        <div class="col s12">
            <?php include "app/templates/postsMaisVisitados.php"; ?>
        </div>
        <div class="col s10">
            <?php include "app/templates/mangaPosts.php"; ?>
        </div>
        <div class="col s2">
            <div class="portGoogleAdsManga">
                <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                <!-- propManga -->
                <ins class="adsbygoogle"
                     style="display:block;"
                     data-ad-client="ca-pub-6524461249309200"
                     data-ad-slot="5324505304"
                     data-ad-format="auto"></ins>
                <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
            </div>
        </div>
        <div class="col s12">
            <?php include "app/templates/ultimosPoemas.php"; ?>
        </div>
    </div>
    <!--fim home-->
</div>
<?php get_footer(); ?>
