<?php
/*
Plugin Name: Login Widget
Plugin URI: http://impulsecreative.com
Description: Custom Login - Gforceshipping
Version: 1.0
Author: Nick Decker
Author URI: http://meepfacedecker.com
License: A "Slug" license name e.g. GPL2
*/

class ipc_login_widget extends WP_Widget {
    function ipc_login_widget() {
        parent::WP_Widget( false, $name= __( 'Gforce Shipping Login Widget', 'ipc_widget_plugin' ) );
    }

    function form( $instance ) {
        if( $instance ) {
            $title = esc_attr( $instance[ 'title' ] );
            $url = esc_attr( $instance[ 'url' ] );
            $username = esc_attr( $instance[ 'username' ] );
            $password = esc_attr( $instance[ 'password' ] );
            $submit = esc_attr( $instance[ 'submit' ] );
            
        } else {
            $title = 'Customer Login';
            $url = '"http://www.myblueship.com/Login/RemoteLogin?userName=" + username + "&password=" + password + "&RedirectURL=http://freight.gforceship.com"';
            $username = 'UserNameBlueShip';
            $password = 'PasswordBlueShip';
            $submit = 'Go';
        }
        ?>
<p>
    <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'ipc_widget_plugin' ); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
</p>
<p>
    <label for="<?php echo $this->get_field_id( 'url' ); ?>"><?php _e( 'Login Url:', 'ipc_widget_plugin' ); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id( 'url' ); ?>" name="<?php echo $this->get_field_name( 'url' ); ?>" type="text" value="<?php echo $url; ?>" />
</p>
<p>
    <label for="<?php echo $this->get_field_id( 'username' ); ?>"><?php _e( 'Username Field ID:', 'ipc_widget_plugin' ); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id( 'username' ); ?>" name="<?php echo $this->get_field_name( 'username' ); ?>" type="text" value="<?php echo $username; ?>" />
</p>
<p>
    <label for="<?php echo $this->get_field_id( 'password' ); ?>"><?php _e( 'Password Field ID:', 'ipc_widget_plugin' ); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id( 'password' ); ?>" name="<?php echo $this->get_field_name( 'password' ); ?>" type="text" value="<?php echo $password; ?>" />
</p>
<p>
    <label for="<?php echo $this->get_field_id( 'submit' ); ?>"><?php _e( 'Submit Button Text:', 'ipc_widget_plugin' ); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id( 'submit' ); ?>" name="<?php echo $this->get_field_name( 'submit' ); ?>" type="text" value="<?php echo $submit; ?>" />
</p>

<?php



    }
    
    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
        $instance[ 'url' ] = strip_tags( $new_instance[ 'url' ] );
        $instance[ 'username' ] = strip_tags( $new_instance[ 'username' ] );
        $instance[ 'password' ] = strip_tags( $new_instance[ 'password' ] );
        $instance[ 'submit' ] = strip_tags( $new_instance[ 'submit' ] );
        return $instance;
    }
    
    function widget( $args, $instance ) {
        extract( $args );
        $title = $instance[ 'title' ];
        $url = $instance[ 'url' ];
        $username = $instance[ 'username' ];
        $password = $instance[ 'password' ];
        $text = $instance[ 'text' ];
        $submit = $instance[ 'submit' ];
        
        echo $before_widget;
        
        echo '<ul class="sub-menu">';
        echo '<li class="menu-item menu-item-login-widget" style="float: left; width: 100%; white-space: normal;">';
        echo '<div id="ipc-login-widget" class="widget carrierrate-login widget-carrierrate-login">';
        echo '<div class="widget-wrap widget-inside">';
        echo '<h3 class="widget-title">' . $title . '</h3>';
        echo '<form id="ipc_login" name="' . $title .'" method="post">';
        echo '<label for="user_name-3">Username</label><input type="text" name="' . $username . '" id="' . $username . '" title="Username" placeholder="Username" value="">';
        echo '<label for="user_pass-3">Password</label><input type="password" name="' . $password . '" id="' . $password . '" title="Password" placeholder="Password" value="">';
        echo '<input type="submit" name="sign-up-submit" id="sign-up-submit-3" value="' . $submit . '">';
        echo '</form>';
        echo '<script type="text/javascript">';
        echo 'jQuery("#ipc_login").submit(function(e) {';
        echo 'ipc_login();';
        echo '     return false;';
        echo '});';
        echo 'function ipc_login() {';
        echo 'var username = jQuery("#' . $username . '").val();';
        echo 'var password = jQuery("#' . $password . '").val();';
        echo 'var url = ' . $url . ';';
        echo 'window.location = url;';
        echo 'return false;';
        echo '}';
        echo '</script>';
        echo '</div></div></li></ul>';
        echo $after_widget;
    }
    
}

add_action( 'widgets_init', create_function( '', 'return register_widget( "ipc_login_widget" );' ) );
