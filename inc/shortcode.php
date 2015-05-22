<?php
if(!function_exists("tj_editor_filter_media"))
{
	add_action( 'ajax_query_attachments_args', 'tj_editor_filter_media' );
	function tj_editor_filter_media( $query ) {
		if ( ! current_user_can( 'manage_options' ) )
			$query['author'] = get_current_user_id();
		return $query;
	}
}


if(!function_exists("teditor_shortcode"))
{
	function teditor_shortcode( $atts, $content = null ) {
		return apply_filters('the_content', $content) ;
	}
	add_shortcode( 'teditor', 'teditor_shortcode' );
}


if(!function_exists("th2_shortcode"))
{
	function th2_shortcode( $atts, $content = null ) {
		return '<h2>' . do_shortcode($content) . '</h2>';
	}
	add_shortcode( 'th2', 'th2_shortcode' );
}

if(!function_exists("th3_shortcode"))
{
	function th3_shortcode( $atts, $content = null ) {
		return '<h3>' . do_shortcode($content) . '</h3>';
	}
	add_shortcode( 'th3', 'th3_shortcode' );
}

if(!function_exists("th4_shortcode"))
{
	function th4_shortcode( $atts, $content = null ) {
		return '<h4>' . do_shortcode($content) . '</h4>';
	}
	add_shortcode( 'th4', 'th4_shortcode' );
}
if(!function_exists("th5_shortcode"))
{
	function th5_shortcode( $atts, $content = null ) {
		return '<h5>' . do_shortcode($content) . '</h5>';
	}
	add_shortcode( 'th5', 'th5_shortcode' );
}

if(!function_exists("tcode_shortcode"))
{
	function tcode_shortcode( $atts, $content = null ) {
		return '<pre>' . apply_filters('the_content',$content) . '</pre>';
	}
	add_shortcode( 'tcode', 'tcode_shortcode' );
}

if(!function_exists("th6_shortcode"))
{
	function th6_shortcode( $atts, $content = null ) {
		return '<h6>' . do_shortcode($content) . '</h6>';
	}
	add_shortcode( 'th6', 'th6_shortcode' );
}

if(!function_exists("tbold_shortcode"))
{
	function tbold_shortcode( $atts, $content = null ) {
		return '<b>' . do_shortcode($content) . '</b>';
	}
	add_shortcode( 'tbold', 'tbold_shortcode' );
}

if(!function_exists("titalic_shortcode"))
{
	function titalic_shortcode( $atts, $content = null ) {
		return '<i>' . do_shortcode($content) . '</i>';
	}
	add_shortcode( 'titalic', 'titalic_shortcode' );
}

if(!function_exists("tlist_shortcode"))
{
	function tlist_shortcode( $atts, $content = null ) {
		return '<ul>' . do_shortcode($content)  . '</ul>';
	}
	add_shortcode( 'tlist', 'tlist_shortcode' );
}

if(!function_exists("tnumeric_shortcode"))
{
	function tnumeric_shortcode( $atts, $content = null ) {
		return '<ol>' . do_shortcode($content)  . '</ol>';
	}
	add_shortcode( 'tnumeric', 'tnumeric_shortcode' );
}

if(!function_exists("tlistli_shortcode"))
{
	function tlistli_shortcode( $atts, $content = null ) {
		return '<li>' . do_shortcode($content) . '</li>';
	}
	add_shortcode( 'tli', 'tlistli_shortcode' );
}

if(!function_exists("tunderline_shortcode"))
{
	function tunderline_shortcode( $atts, $content = null ) {
		return '<u>' . do_shortcode($content). '</u>';
	}
	add_shortcode( 'tunderline', 'tunderline_shortcode' );
}

if(!function_exists("timage_shortcode"))
{

	function timage_shortcode( $atts, $content = null ) {
		return '<img title="'. $atts['title'] .'" src="' . $content . '" alt="' . $atts['alt'] . '" caption="' .  $atts['caption'] . '" description="' .   $atts['description'] . '">';
	}
	add_shortcode( 'timage', 'timage_shortcode' );
}

if(!function_exists("thyperlink_shortcode"))
{
	function thyperlink_shortcode( $atts, $content = null ) {
		return '<a href="'. $content .'" alt="'. $content .'"> ' . apply_filters('the_content', $content) . ' </a>';
	}
	add_shortcode( 'thyperlink', 'thyperlink_shortcode' );
}
if(!function_exists("tquote_shortcode"))
{
	function tquote_shortcode($atts, $content = null) {
	     return '<quote>' . do_shortcode($content) . '</quote>';
	}
	add_shortcode('tquote', 'tquote_shortcode');
}

if(!function_exists("talign_left_shortcode"))
{
	function talign_left_shortcode($atts, $content = null) {
	     return '<div style="text-align: left;">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('talignleft', 'talign_left_shortcode');
}

if(!function_exists("talign_right_shortcode"))
{
	function talign_right_shortcode($atts, $content = null) {
	     return '<div style="text-align: right;">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('talignright', 'talign_right_shortcode');
}

if(!function_exists("talign_center_shortcode"))
{
	function talign_center_shortcode($atts, $content = null) {
	     return '<div style="text-align: center;">' . do_shortcode($content) . '</div>';
	}
}