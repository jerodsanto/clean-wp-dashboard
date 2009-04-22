<?php
/*
Plugin Name: Clean WP Dashboard
Plugin URI: http://github.com/sant0sk1/clean-wp-dashboard
Description: Easily remove any/all of the default WordPress dashboard widgets
Author: Jerod Santo
Author URI: http://jerodsanto.net
Version: 1.0
*/

// disallow direct access to the plugin file
if (basename($_SERVER['PHP_SELF']) == basename (__FILE__)) {
die("Sorry, but you can't access this page directly.");
}

function clean_wp_dashboard() {
    global $wp_meta_boxes;
    
    if ((bool) get_option('clean_dash_right_now') == false) {
      unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
    }
    
    if ((bool) get_option('clean_dash_incoming_links') == false) {
      unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
    }
    
    if ((bool) get_option('clean_dash_plugins') == false) {
      unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
    }
    
    if ((bool) get_option('clean_dash_recent_comments') == false) {
      unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
    }
    
    if ((bool) get_option('clean_dash_quick_press') == false) {
      unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
    }
    
    if ((bool) get_option('clean_dash_recent_drafts') == false) {
      unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']);
    }
    
    if ((bool) get_option('clean_dash_primary') == false) {
      unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
    }
    
    if ((bool) get_option('clean_dash_secondary') == false) {
      unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);  
    }
    
}

// add options page to wordpress
function clean_wp_dashboard_menu() {
  add_options_page('Dashboard Settings','Dashboard Settings',10,__FILE__,'clean_wp_dashboard_options');
}

// draw options page loaded above
function clean_wp_dashboard_options() {
  $right_now        = (bool) get_option('clean_dash_right_now');
  $incoming_links   = (bool) get_option('clean_dash_incoming_links');
  $plugins          = (bool) get_option('clean_dash_plugins');
  $recent_comments  = (bool) get_option('clean_dash_recent_comments');
  $quick_press      = (bool) get_option('clean_dash_quick_press');
  $recent_drafts    = (bool) get_option('clean_dash_recent_drafts');
  $primary          = (bool) get_option('clean_dash_primary');
  $secondary        = (bool) get_option('clean_dash_secondary');
?>

<div class="wrap">
  <h2>Dashboard Settings</h2>
  <h3>Select which default dashboard widgets you want to show for all users.</h3>
  <form method="post" action="options.php">
  
    <input type="hidden" name="action" value="update" />
    <input type="hidden" name="page_options" 
      value="clean_dash_right_now,clean_dash_incoming_links,clean_dash_plugins,clean_dash_recent_comments,clean_dash_quick_press,clean_dash_recent_drafts,clean_dash_primary,clean_dash_secondary" />
    <?php wp_nonce_field('update-options'); ?>
    
    <table class="form-table">
      <tr valign="top">
        <th scope="row"><?php _e('Right Now')?></th>
        <td>
          <input type="checkbox" name="clean_dash_right_now" <?php if ($right_now) echo'checked="checked""' ?> value="1" />
        </td>
      </tr>
      <tr valign="top">
        <th scope="row"><?php _e('Incoming Links')?></th>
        <td>
          <input type="checkbox" name="clean_dash_incoming_links" <?php if ($incoming_links) echo'checked="checked""' ?> value="1" />
        </td>
      </tr>
      <tr valign="top">
        <th scope="row"><?php _e('Plugins')?></th>
        <td>
          <input type="checkbox" name="clean_dash_plugins" <?php if ($plugins) echo'checked="checked""' ?> value="1" />
        </td>
      </tr>
      <tr valign="top">
        <th scope="row"><?php _e('Recent Comments')?></th>
        <td>
          <input type="checkbox" name="clean_dash_recent_comments" <?php if ($recent_comments) echo'checked="checked""' ?> value="1" />
        </td>
      </tr>
      <tr valign="top">
        <th scope="row"><?php _e('QuickPress')?></th>
        <td>
          <input type="checkbox" name="clean_dash_quick_press" <?php if ($quick_press) echo'checked="checked""' ?> value="1" />
        </td>
      </tr>
      <tr valign="top">
        <th scope="row"><?php _e('Recent Drafts')?></th>
        <td>
          <input type="checkbox" name="clean_dash_recent_drafts" <?php if ($recent_drafts) echo'checked="checked""' ?> value="1" />
        </td>
      </tr>
      <tr valign="top">
        <th scope="row"><?php _e('WP Dev Blog')?></th>
        <td>
          <input type="checkbox" name="clean_dash_primary" <?php if ($primary) echo'checked="checked""' ?> value="1" />
        </td>
      </tr>
      <tr valign="top">
        <th scope="row"><?php _e('Other WP News')?></th>
        <td>
          <input type="checkbox" name="clean_dash_secondary" <?php if ($secondary) echo'checked="checked""' ?> value="1" />
        </td>
      </tr>
    </table>
    
    <p class="submit">
      <input type="submit" name="Submit" value="<?php _e('Save Changes') ?>" />
    </p>
  </form>
</div>
    
  
<?php
}

// hook it in
add_option('clean_dash_right_now',true);
add_option('clean_dash_incoming_links',true);
add_option('clean_dash_plugins',true);
add_option('clean_dash_recent_comments',true);
add_option('clean_dash_quick_press',true);
add_option('clean_dash_recent_drafts',true);
add_option('clean_dash_primary',true);
add_option('clean_dash_secondary',true);
add_action('wp_dashboard_setup','clean_wp_dashboard');
add_action('admin_menu','clean_wp_dashboard_menu');

?>