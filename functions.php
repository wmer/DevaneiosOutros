<?php
//Sidebar
if(function_exists('register_sidebar')){
    register_sidebar(array(
        'id' => 'sidebar-1',
        'before_widget' => '<section class="section widget_estrut">',
        'after_widget' => '</section>',
        'before_title' => '<header class="port_title_widget"><h6 class="title_widget">',
        'after_title' => '</h6></header><div class="divider"></div>'
    ));
}

//Contador de Visitas
function contPostViews(){
    if(!is_single()) return;
    global $post;
    $postID = $post->ID;
    $dataVisita = date('Y-m-d');
    $nomeCookie = 'post' . $_SERVER['REQUEST_URI'];
    if(!isset($_COOKIE[$nomeCookie])){
        //setcookie($nomeCookie, $dataVisita, time()+3600);
        $viewsKey = 'postViews';
        $views = get_post_meta($postID, $viewsKey, true);
        if($views == ""){
            $views = 1;
            delete_post_meta($postID, $viewsKey);
            add_post_meta($postID, $viewsKey, $views);
        }else {
            $views++;
            update_post_meta($postID, $viewsKey, $views);
        }
    }
}
add_action('wp_head', 'contPostViews');

//adicionar coluna
function columnPostViews($defaults){
    $defaults['post_views'] = __('Visualizações');
    return $defaults;
}

function customColumnPostViews($column_name, $id){
    if($column_name === 'post_views'){
        $count = get_post_meta($id, 'postViews', true);
        if( !empty($count) ){
            echo $count. ' visualização(ões)';
        }
    }
}
add_filter('manage_posts_columns', 'columnPostViews');
add_action('manage_posts_custom_column', 'customColumnPostViews',5,2);

//Numero de Visualizações
function getPostViews($postID){
    $views = get_post_meta($postID, 'postViews', true);
    if(!empty($views)){
        return $views;
    }else {
        return '0';
    }
}

//Arquivos adicionais
function add_custom_scripts(){
    //CSS
    wp_enqueue_style('materialize', '/wp-content/themes/DevaneiosOutros/libs/css/materialize.min.css');
    wp_enqueue_style('animate', '/wp-content/themes/DevaneiosOutros/libs/css/animate.css');
    wp_enqueue_style('material-font', '/wp-content/themes/DevaneiosOutros/libs/css/material-fonts.css');
    wp_enqueue_style('font_awesome', '/wp-content/themes/DevaneiosOutros/libs/css/font-awesome.min.css');
    wp_enqueue_style('octIcons', '/wp-content/themes/DevaneiosOutros/libs/css/octicons.css');
    wp_enqueue_style('font-mfizz', '/wp-content/themes/DevaneiosOutros/libs/css/font-mfizz.css');
    //JS
    wp_enqueue_script('jquery', '/wp-content/themes/DevaneiosOutros/libs/js/jquery-1.12.3.min.js', array(), '1.12.3', true);
    wp_enqueue_script('jquery-migrate', '/wp-content/themes/DevaneiosOutros/libs/js/jquery-migrate-1.3.0.min.js', array(), '1.2.1', true);
    wp_enqueue_script('GP', 'https://apis.google.com/js/platform.js?publisherid=111493788324950304166', array(), '', true);
    wp_enqueue_script('materialize-js', '/wp-content/themes/DevaneiosOutros/libs/js/materialize.min.js', array(), '0.97.5', true);
    wp_enqueue_script('app', '/wp-content/themes/DevaneiosOutros/app/scripts/app.js', array(), false, true);
}
add_action('wp_enqueue_scripts', 'add_custom_scripts');

//Sociais
//Facebook
function FB($link, $args){
    if($args == 'default'){
        echo '<fb:like href="' . $link . '" width="250" layout="standard" action="like" show_faces="true" share="false"></fb:like>';
    }else {
        echo '<fb:like href="' . $link . '" ' .  $args . '></fb:like>';
    }
}
//Twitter
function TT($link, $args){
    $script = '<script>!function(d,s,id){ var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?"http":"https";if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document, "script", "twitter-wjs");</script>';
    if($args == 'default'){
        echo '<a href="https://twitter.com/share" class="twitter-share-button" data-count="horizontal" data-url="' . $link . '" data-lang="pt">Tweetar</a>' . $script;
    }else {
        echo '<a href="https://twitter.com/share" class="twitter-share-button" data-url="' . $link . '"' . $args . '>Tweetar</a>' . $script;
    }
}
//Google+
function GP($link, $args) {
    if($args == 'default'){
        echo '<g:plusone data-annotation="inline" data-href="' . $link . '" data-width="150"></g:plusone>';
    }else {
        echo '<g:plusone  data-href="' . $link . '" ' . $args . '></g:plusone>';
    }

}
//share facebook
function fb_share($link, $layout){
    echo '<div class="fb-share-button" data-href="' . $link . '" data-layout="' . $layout . '"></div>';
}
//suporte a menu
function register_menu() {
    register_nav_menu('header-menu',__( 'Header Menu' ));
}
add_action( 'init', 'register_menu' );

//The Excerpt
function custom_excerpt_length( $length ) {
    return 40;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function get_excerpt($limit){
    $excerpt = get_the_content();
    $excerpt = preg_replace(" (\[.*?\])",'',$excerpt);
    $excerpt = strip_shortcodes($excerpt);
    $excerpt = strip_tags($excerpt);
    $excerpt = substr($excerpt, 0, $limit);
    $excerpt = substr($excerpt, 0, strripos($excerpt, " "));
    $excerpt = trim(preg_replace( '/\s+/', ' ', $excerpt));
    $excerpt = $excerpt.' <a class="read-more" style="color: #FF0004" href="'. get_permalink( get_the_ID() ) . '">' . __('...Continue lendo...', 'your-text-domain') . '</a>';
    return $excerpt;
}

function excerpt($limit) {
    $excerpt = explode(' ', get_the_excerpt(), $limit);
    if (count($excerpt)>=$limit) {
        array_pop($excerpt);
        $excerpt = implode(" ",$excerpt).'...';
    } else {
        $excerpt = implode(" ",$excerpt);
    }
    $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
    return $excerpt . ' <a class="read-more" style="color: #FF0004" href="'. get_permalink( get_the_ID() ) . '">' . __('Continue lendo...', 'your-text-domain') . '</a>';
}

function new_excerpt_more( $more ) {
    return ' <a class="read-more" style="color: #FF0004" href="'. get_permalink( get_the_ID() ) . '">' . __('... Continue lendo...', 'your-text-domain') . '</a>';
}
add_filter( 'excerpt_more', 'new_excerpt_more' );

//suporte a thumbnails
add_theme_support('post-thumbnails');
//adicionar the_post_thumbnail(); aonde aparecer a imagem

//suporte a post formats
add_theme_support( 'post-formats', array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio'));

//Infinite Scroll
add_theme_support( 'infinite-scroll', array(
    'type'           => 'scroll',
    'container'      => 'content',
    'posts_per_page' => '5',
));