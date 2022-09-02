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
        <h1>ID: <?php echo get_post_meta(get_the_ID(), 'alfasoftperson-id', true) ?></h1>
        <h2>Name: <?php the_title(); ?></h2>
        <h3>Email: <?php  echo get_post_meta(get_the_ID(), 'alfasoftperson-email', true) ?></h3>
        <h4>Country: <?php  echo get_post_meta(get_the_ID(), 'alfasoftcountry', true) ?></h4>
        <h5>Phone: <?php  echo get_post_meta(get_the_ID(), 'alfasoftphone', true) ?></h5>
        

    </li>
    

<?php
endwhile; endif;
?>
</ul>
<?php
