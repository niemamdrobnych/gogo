<?php
/**
 * Gogo slider Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during backend preview render.
 * @param   int $post_id The post ID the block is rendering content against.
 *          This is either the post ID currently being displayed inside a query loop,
 *          or the post ID of the post hosting this block.
 * @param   array $context The context provided to the block by the post or it's parent block.
 */
// Support custom "anchor" values.
$anchor = '';
if (!empty($block['anchor'])) {
    $anchor = 'id="' . esc_attr($block['anchor']) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'gogo-slider-block';
if (!empty($block['className'])) {
    $class_name .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $class_name .= ' align' . $block['align'];
}

// Load values and assign defaults.
$heading = get_field('heading') ?: 'Your heading here...';
$subheading = get_field('subheading') ?: 'Subheading';
$heading_2 = get_field('heading_2');
$turn_on_slider = get_field('turn_on_slider');
$boxes = get_field('boxes');
?>
<section id="<?php echo $turn_on_slider ? 'slider' : 'content'; ?>">
    <div class="container">       
        <h1><?php echo esc_html($heading); ?></h1>     
        <div class="subheader">
            <?php echo esc_html($subheading); ?>
        </div>
        <?php if ($heading_2) ; ?>
        <h2><?php echo esc_html($heading_2); ?></h2>
        <div class="row <?php echo $turn_on_slider ? 'slider-items' : ''; ?>">
            <?php if ($boxes) ; ?>
            <?php foreach ($boxes as $box) { ?>
                <div class="col-lg-4 col-md-6">
                    <div class="box">
                        <?php if ($box['heading']) ?>
                        <h3><?php echo esc_html($box['heading']); ?></h3>                                        
                        <?php if ($box['content']) ?>
                        <?php echo apply_filters('the_content', $box['content']); ?>   
                        <?php if ($box['icon']) ?>
                        <div class="icon">
                            <?php echo wp_get_attachment_image($box['icon'], 'medium'); ?>
                        </div>
                    </div>
                </div>                            
            <?php }
            ?>
        </div>
    </div>
</section>