<?php
/**
 * Marketify Child Theme
 *
 * Place any custom functionality/code snippets here.
 *
 * @since Marketify Child 1.0
 */

function marketify_child_styles() {
    wp_enqueue_style( 'marketify-child', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'marketify_child_styles', 210 );

/*========Log in========*/
function my_custom_login() {
echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('stylesheet_directory') . '/style.css" />';
}
add_action('login_head', 'my_custom_login');

/*========change to login link your site instead of wordpress========*/

function my_login_logo_url() {
return get_bloginfo( 'https://lvps84-39-103-248.mammuts-servidor.es' );
}
add_filter( 'login_headerurl', 'my_login_logo_url' );

function my_login_logo_url_title() {
return 'Zeliha Site';
}
add_filter( 'login_headertitle', 'my_login_logo_url_title' );

/*========login error message========*/
function login_error_override()
{
    return 'Incorrect login details.';
}
add_filter('login_errors', 'login_error_override');

/*========Remove the login page========*/
function my_login_head() {
remove_action('login_head', 'wp_shake_js', 12);
}
add_action('login_head', 'my_login_head');

/*========change to redirect users to your homepage instead.========*/

function admin_login_redirect( $redirect_to, $request, $user )
{
global $user;
if( isset( $user->roles ) && is_array( $user->roles ) ) {
	if( in_array( "administrator", $user->roles ) ) {
		return $redirect_to;
	} else {
		return home_url();
		}
	}
else
	{
		return $redirect_to;
	}
}
add_filter("login_redirect", "admin_login_redirect", 10, 3);

/*========Remember check box ========*/

function login_checked_remember_me() {
add_filter( 'login_footer', 'rememberme_checked' );
}
add_action( 'init', 'login_checked_remember_me' );

function rememberme_checked() {
echo "<script>document.getElementById('rememberme').checked = true;</script>";
}
