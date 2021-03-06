<?php
/**
 *
 * Plugin Name:       CDN Photon Easy
 * Plugin URI:        https://github.com/moskoweb/CDN-Photon-Easy
 * Description:       Activate Photon's CDN system automatically on your site.
 * Version:           0.1.1
 * Author:            Alan Mosko
 * Author URI:        https://alanmosko.com.br/
 * Text Domain:       cdn-photon-easy
 * License:           GPL-3.0+
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.txt
 * GitHub Plugin URI: https://github.com/moskoweb/CDN-Photon-Easy
 * GitHub Branch:     master
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! function_exists('cdn_photon_easy') ) {
	function cdn_photon_easy( $content ){
		$domain = get_site_url();
		if (is_ssl()) {
			$domain = str_replace('https://', '', $domain);
		} else {
			$domain = str_replace('http://', '', $domain);
		}
		$domain = str_replace('www.', '', $domain);
	
		$url = 'https://i0.wp.com/' . $domain . '/wp-content/uploads';
		
		return str_replace( get_site_url() . '/wp-content/uploads', $url, $content );
	}
}

add_filter('the_content', 'cdn_photon_easy', 99);

function cdn_photon_easy_settings_link( $links ) {
	array_push( $links, '<a target="_blank" href="https://developer.wordpress.com/docs/photon/api/">' . __( 'Documentation' ) . '</a>' );
	return $links;
}
add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'cdn_photon_easy_settings_link' );

?>
