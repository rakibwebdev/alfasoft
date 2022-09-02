<?php
if (!defined('ABSPATH')) {
	exit;
}
wp_head();
?>
<ul>
    <?php
if (have_posts()) : while (have_posts()) : the_post();
	?>
    <li>
        <!-- <img src="#" alt="Title"> -->
        <h1>ID: <?php echo get_post_meta(get_the_ID(), 'alfasoftperson-number', true) ?></h1>
        <h2>Name: <?php the_title(); ?></h2>
        <h3>Email: <?php  echo get_post_meta(get_the_ID(), 'alfasoftperson-email', true) ?></h3>
        

    </li>
    

<?php
endwhile; endif;
?>
</ul>
<?php
