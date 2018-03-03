<div class="estrutPost">
    <header class="headerPost" style="background-image: url(<?php $image_attributes = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), "post-thumbnail"); if($image_attributes){echo $image_attributes[0];} ?>);">
        <!--titulos e infos-->
        <div class="titleInfos">
            <div class="titlePosts"><a itemprop="url" href="<?php the_permalink(); ?>"><span itemprop="name"><?php the_title();  ?></span></a></div>
            <div class="fb-save" data-uri="<?php the_permalink(); ?>" data-size="small"></div>
            <span class="badge right light grey-text text-lighten-3"><i class="fa fa-eye"></i> <?php echo getPostViews($post->ID); ?></span>
        </div>
    </header>
    <div class="divider"></div>
    <div class="infoPosts">
        <i class="fa fa-user"></i> <span itemprop="author" itemscope itemtype="http://schema.org/Person"><span itemprop="name"><?php the_author_posts_link(); ?></span></span>
        -- <i class="fa fa-calendar"></i> <span itemprop="datePublished" content="<?php the_date('Y-m-d');?>T<?php the_time('G:i'); ?>">publicado em <?php the_time(get_option( 'date_format' )); //Data ?></span>
        <?php edit_post_link(__( 'Editar Post'), '&ensp;&ensp; -- &ensp;&ensp;'); ?>
        <span class="badge right"><a href="<?php comments_link(); ?>"><i class="fa fa-comments-o" aria-hidden="true"></i> <?php comments_number( '0', '1', '%' ); ?></a></span>
    </div>
    <div class="corpoPosts"><?php echo get_excerpt(350); ?></div>
</div>