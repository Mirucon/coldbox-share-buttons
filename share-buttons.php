<?php
/*
Plugin Name: Share Buttons Add-On for the Coldbox Theme
Plugin URI: https://coldbox.miruc.co/addons/share-buttons/
Description: Adds Share Buttons to the Coldbox Theme.
Author: Mirucon
License: GNU General Public License v3.0
Version: 1.0.0
Author URI: https://miruc.co/
*/

/* ----------------------------------------------------------------------------- *
*  Share Buttons add-on for the Coldbox Theme
*  Requires "SNS Count Cache" Plugin installed and enabled
*  Followed SNS : Twitter, Hatena Bookmark, Facebook, Google Plus, Pocket, Feedly.
*  Reference: https://coldbox.miruc.co/addons/share-buttons/
*  JAPANESE:
*    SNS Count Cache プラグインと連携した、Coldbox テーマ用のSNSボタンアドオンです。SNS Count Cache プラグインが必要です。
*    次のSNSに対応しています : Twitter, はてなブックマーク, Facebook, Google Plus, Pocket, Feedly
*    詳細はこちら: https://coldbox.miruc.co/ja/addons/share-buttons/
* ------------------------------------------------------------------------------ */

function cd_addon_sns_buttons_translation() {
  load_plugin_textdomain( 'coldbox' );
}
add_action( 'plugins_loaded', 'cd_addon_sns_buttons_translation' );


function cd_addon_sns_buttons( $wp_customize ) {

  $wp_customize->add_section( 'sns_buttons', array(
    'title'  => __( 'Coldbox Add-on: Social Buttons Settings', 'coldbox' ),
    'priority' => 10,
  ));
  // Twitter
  $wp_customize->add_setting( 'sns_button_twitter', array(
    'default'  => true,
    'sanitize_callback' => 'cd_sanitize_checkbox',
  ));
  $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'sns_button_twitter', array(
    'label'    => __( ' - Twitter', 'coldbox' ),
    'section'  => 'sns_buttons',
    'type'     => 'checkbox',
  )));
  // Facebook
  $wp_customize->add_setting( 'sns_button_facebook', array(
    'default'  => true,
    'sanitize_callback' => 'cd_sanitize_checkbox',
  ));
  $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'sns_button_facebook', array(
    'label'    => __( ' - Facebook', 'coldbox' ),
    'section'  => 'sns_buttons',
    'type'     => 'checkbox',
  )));
  // hatena Bookmark
  $wp_customize->add_setting( 'sns_button_hatena', array(
    'default'  => true,
    'sanitize_callback' => 'cd_sanitize_checkbox',
  ));
  $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'sns_button_hatena', array(
    'label'    => __( ' - Hatena Bookmark', 'coldbox' ),
    'section'  => 'sns_buttons',
    'type'     => 'checkbox',
  )));
  // Google Plus
  $wp_customize->add_setting( 'sns_button_googleplus', array(
    'default'  => true,
    'sanitize_callback' => 'cd_sanitize_checkbox',
  ));
  $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'sns_button_googleplus', array(
    'label'    => __( ' - Google Plus', 'coldbox' ),
    'section'  => 'sns_buttons',
    'type'     => 'checkbox',
  )));
  // Pocket
  $wp_customize->add_setting( 'sns_button_pocket', array(
    'default'  => true,
    'sanitize_callback' => 'cd_sanitize_checkbox',
  ));
  $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'sns_button_pocket', array(
    'label'    => __( ' - Pocket', 'coldbox' ),
    'section'  => 'sns_buttons',
    'type'     => 'checkbox',
  )));
  // Feedly
  $wp_customize->add_setting( 'sns_button_feedly', array(
    'default'  => true,
    'sanitize_callback' => 'cd_sanitize_checkbox',
  ));
  $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'sns_button_feedly', array(
    'label'    => __( ' - Feedly', 'coldbox' ),
    'section'  => 'sns_buttons',
    'type'     => 'checkbox',
  )));
  // Twitter username
  $wp_customize->add_setting( 'twitter_username', array(
    'default'  => '',
    'sanitize_callback' => 'cd_sanitize_text',
  ));
  $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'twitter_username', array(
    'label'    => 'Twitter Username',
    'description' => 'Enter your Twitter username without "@" suffix. The username will be shown in tweets.',
    'section'  => 'sns_buttons',
    'type'     => 'text',
  )));

}
add_action( 'customize_register', 'cd_addon_sns_buttons' );


function cd_use_snsb_twitter() { return ( get_theme_mod( 'sns_button_twitter', true ) ); }
function cd_use_snsb_facebook() { return ( get_theme_mod( 'sns_button_facebook', true ) ); }
function cd_use_snsb_hatena() { return ( get_theme_mod( 'sns_button_hatena', true ) ); }
function cd_use_snsb_googleplus() { return ( get_theme_mod( 'sns_button_googleplus', true ) ); }
function cd_use_snsb_pocket() { return ( get_theme_mod( 'sns_button_pocket', true ) ); }
function cd_use_snsb_feedly() { return ( get_theme_mod( 'sns_button_feedly', true ) ); }
function cd_twitter_username() { return ( get_theme_mod( 'twitter_username', '' ) ); }


function cd_addon_sns_buttons_list() {

  if ( function_exists( 'scc_get_share_total' ) ) :

    wp_enqueue_style ( 'icomoon', get_template_directory_uri() . '/fonts/icomoon/icomoon.min.css' );
    $canonical_url = get_permalink();
    $title = wp_title( '', false, 'right' ).'| '.get_bloginfo('name');
    $canonical_url_encode = urlencode( $canonical_url );
    $title_encode = urlencode( $title );
    $cd_twitter_via_username = cd_twitter_username() ? '&via='.cd_twitter_username() : '' ;
    ?>
    <section id="social-links" class="content-box">
      <h4 id="sns-btn-bottom-head"><?php esc_html_e('Share', 'coldbox') ?></h4>
      <ul class="share-list-container">

        <?php if ( function_exists( 'scc_get_share_twitter' ) && cd_use_snsb_twitter() ): ?>
          <li class="twitter balloon-btn">
            <div class="share">
              <a class="share-inner" href="http://twitter.com/intent/tweet?url=<?php echo esc_attr( $canonical_url_encode ); ?>&text=<?php echo esc_attr( $title_encode ); ?>&tw_p=tweetbutton<?php echo esc_attr( $cd_twitter_via_username ); ?>" target="_blank">
                <i class="icon-twitter"></i>
              </a>
            </div>
            <span class="count">
              <a class="count-inner" href="http://twitter.com/intent/tweet?url=<?php echo esc_attr( $canonical_url_encode ); ?>&text=<?php echo esc_attr( $title_encode ); ?>&tw_p=tweetbutton" target="_blank">
                <?php echo absint( scc_get_share_twitter() ); ?>
              </a>
            </span>
          </li>
        <?php endif; ?>

        <?php if ( function_exists( 'scc_get_share_hatebu' ) && cd_use_snsb_hatena() ): ?>
          <li class="hatena balloon-btn">
            <div class="share">
              <a class="share-inner" href="http://b.hatena.ne.jp/add?mode=confirm&url=<?php echo esc_attr( $canonical_url_encode ); ?>&title=<?php echo esc_attr( $title_encode );?>" target="_blank">
                <i class="icon-hatena"></i>
              </a>
            </div>
            <span class="count">
              <a class="count-inner" href="http://b.hatena.ne.jp/entry/<?php echo esc_attr( $canonical_url_encode ); ?>" target="_blank">
                <?php echo absint( scc_get_share_hatebu() ); ?>
              </a>
            </span>
          </li>
        <?php endif; ?>

        <?php if ( function_exists( 'scc_get_share_facebook' ) && cd_use_snsb_facebook() ): ?>
          <li class="facebook balloon-btn">
            <div class="share">
              <a class="share-inner" href="http://www.facebook.com/sharer.php?src=bm&u=<?php echo esc_attr( $canonical_url_encode ); ?>&t=<?php echo esc_attr( $title_encode ); ?>" target="_blank">
                <i class="icon-facebook"></i>
              </a>
            </div>
            <span class="count">
              <a class="count-inner" href="http://www.facebook.com/sharer.php?src=bm&u=<?php echo esc_attr( $canonical_url_encode ); ?>&t=<?php echo esc_attr( $title_encode ); ?>" target="_blank">
                <?php echo absint( scc_get_share_facebook() ); ?>
              </a>
            </span>
          </li>
        <?php endif; ?>

        <?php if ( function_exists( 'scc_get_share_gplus' ) && cd_use_snsb_googleplus() ): ?>
          <li class="googleplus balloon-btn">
            <div class="share">
              <a class="share-inner" href="https://plus.google.com/share?url=<?php echo esc_attr( $canonical_url_encode ); ?>" target="_blank">
                <i class="icon-googleplus"></i>
              </a>
            </div>
            <span class="count">
              <a class="count-inner" href="https://plus.google.com/share?url=<?php echo esc_attr( $canonical_url_encode ); ?>" target="_blank">
                <?php echo absint( scc_get_share_gplus() ); ?>
              </a>
            </span>
          </li>
        <?php endif; ?>

        <?php if ( function_exists( 'scc_get_share_pocket' ) && cd_use_snsb_pocket() ): ?>
          <li class="pocket balloon-btn">
            <div class="share">
              <a class="share-inner" href="https://getpocket.com/edit?url=<?php echo esc_attr( $canonical_url_encode ); ?>&title=<?php echo esc_attr( $title_encode ); ?>" target="_blank">
                <i class="icon-pocket"></i>
              </a>
            </div>
            <span class="count">
              <a class="count-inner" href="https://getpocket.com/edit?url=<?php echo esc_attr( $canonical_url_encode ); ?>&title=<?php echo esc_attr( $title_encode ); ?>" target="_blank">
                <?php echo absint( scc_get_share_pocket() ); ?>
              </a>
            </span>
          </li>
        <?php endif; ?>

        <?php if ( function_exists( 'scc_get_follow_feedly' ) && cd_use_snsb_feedly() ): ?>
          <li class="feedly balloon-btn">
            <div class="share">
              <a class="share-inner" href="https://cloud.feedly.com/#subscription%2Ffeed%2F<?php bloginfo('rss2_url'); ?>" target="_blank">
                <i class="icon-feedly"></i>
              </a>
            </div>
            <span class="count">
              <a class="count-inner" href="https://cloud.feedly.com/#subscription%2Ffeed%2F<?php bloginfo('rss2_url'); ?>" target="_blank">
                <?php echo absint( scc_get_follow_feedly() ); ?>
              </a>
            </span>
          </li>
        <?php endif; ?>

      </ul>
    </section>
  <?php endif;
}
