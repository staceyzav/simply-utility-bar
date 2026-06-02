<?php
if ( ! defined( 'ABSPATH' ) ) exit;

add_action( 'admin_menu', 'simply_utility_bar_admin_menu' );
function simply_utility_bar_admin_menu() {
	add_options_page(
		__( 'Simply Utility Bar', 'simply-utility-bar' ),
		__( 'Utility Bar', 'simply-utility-bar' ),
		'manage_options',
		'simply-utility-bar',
		'simply_utility_bar_settings_page'
	);
}

add_action( 'admin_init', 'simply_utility_bar_register_settings' );
function simply_utility_bar_register_settings() {
	register_setting( 'simply_utility_bar', 'simply_utility_bar_enabled',          array( 'type' => 'integer', 'default' => 1,             'sanitize_callback' => 'absint' ) );
	register_setting( 'simply_utility_bar', 'simply_utility_bar_bg_color',         array( 'type' => 'string',  'default' => '',            'sanitize_callback' => 'sanitize_text_field' ) );
	register_setting( 'simply_utility_bar', 'simply_utility_bar_text_color',       array( 'type' => 'string',  'default' => '',            'sanitize_callback' => 'sanitize_text_field' ) );
	register_setting( 'simply_utility_bar', 'simply_utility_bar_height',           array( 'type' => 'integer', 'default' => 40,            'sanitize_callback' => 'absint' ) );
	register_setting( 'simply_utility_bar', 'simply_utility_bar_scroll_threshold', array( 'type' => 'integer', 'default' => 20,            'sanitize_callback' => 'absint' ) );
}

function simply_utility_bar_settings_page() {
	if ( ! current_user_can( 'manage_options' ) ) return;

	$enabled   = get_option( 'simply_utility_bar_enabled', 1 );
	$bg_color  = get_option( 'simply_utility_bar_bg_color', '' );
	$txt_color = get_option( 'simply_utility_bar_text_color', '' );
	$height    = get_option( 'simply_utility_bar_height', 40 );
	$threshold = get_option( 'simply_utility_bar_scroll_threshold', 20 );
	$has_menu  = has_nav_menu( 'simply-utility-bar' );
	?>
	<div class="wrap" style="max-width:700px;">

		<h1><?php esc_html_e( 'Simply Utility Bar', 'simply-utility-bar' ); ?> <span style="font-size:13px;color:#888;font-weight:400;">v<?php echo esc_html( SIMPLY_UTILITY_BAR_VERSION ); ?></span></h1>

		<?php if ( ! $has_menu ) : ?>
		<div class="notice notice-warning">
			<p><?php printf(
				esc_html__( 'No menu assigned to the Utility Bar location. Go to %s and assign a menu to "Utility Bar".', 'simply-utility-bar' ),
				'<a href="' . esc_url( admin_url( 'nav-menus.php' ) ) . '">' . esc_html__( 'Appearance → Menus', 'simply-utility-bar' ) . '</a>'
			); ?></p>
		</div>
		<?php endif; ?>

		<?php if ( isset( $_GET['settings-updated'] ) ) : ?>
		<div class="notice notice-success is-dismissible"><p><?php esc_html_e( 'Settings saved.', 'simply-utility-bar' ); ?></p></div>
		<?php endif; ?>

		<form method="post" action="options.php">
			<?php settings_fields( 'simply_utility_bar' ); ?>

			<table class="form-table" role="presentation">

				<tr>
					<th scope="row"><?php esc_html_e( 'Enable', 'simply-utility-bar' ); ?></th>
					<td>
						<label>
							<input type="checkbox" name="simply_utility_bar_enabled" value="1" <?php checked( $enabled, 1 ); ?>>
							<?php esc_html_e( 'Show the utility bar', 'simply-utility-bar' ); ?>
						</label>
					</td>
				</tr>

				<tr>
					<th scope="row"><label for="sub_bg"><?php esc_html_e( 'Background Color', 'simply-utility-bar' ); ?></label></th>
					<td>
						<input type="text" id="sub_bg" name="simply_utility_bar_bg_color" value="<?php echo esc_attr( $bg_color ); ?>" class="regular-text" placeholder="<?php esc_attr_e( 'Leave blank to use --sub-bg token (default: transparent)', 'simply-utility-bar' ); ?>">
						<p class="description"><?php esc_html_e( 'Any valid CSS color. Leave blank to inherit from --sub-bg (transparent by default, overridable by client config).', 'simply-utility-bar' ); ?></p>
					</td>
				</tr>

				<tr>
					<th scope="row"><label for="sub_text"><?php esc_html_e( 'Text / Link Color', 'simply-utility-bar' ); ?></label></th>
					<td>
						<input type="text" id="sub_text" name="simply_utility_bar_text_color" value="<?php echo esc_attr( $txt_color ); ?>" class="regular-text" placeholder="<?php esc_attr_e( 'Leave blank to use --sub-text token (inherits --client-nav-text)', 'simply-utility-bar' ); ?>">
						<p class="description"><?php esc_html_e( 'Leave blank to inherit from --client-nav-text (set by Simply Client Config).', 'simply-utility-bar' ); ?></p>
					</td>
				</tr>

				<tr>
					<th scope="row"><label for="sub_height"><?php esc_html_e( 'Bar Height', 'simply-utility-bar' ); ?></label></th>
					<td>
						<input type="number" id="sub_height" name="simply_utility_bar_height" value="<?php echo esc_attr( $height ); ?>" min="20" max="80" step="1" class="small-text"> px
						<p class="description"><?php esc_html_e( 'Default: 40px', 'simply-utility-bar' ); ?></p>
					</td>
				</tr>

				<tr>
					<th scope="row"><label for="sub_threshold"><?php esc_html_e( 'Scroll Threshold', 'simply-utility-bar' ); ?></label></th>
					<td>
						<input type="number" id="sub_threshold" name="simply_utility_bar_scroll_threshold" value="<?php echo esc_attr( $threshold ); ?>" min="0" max="200" step="1" class="small-text"> px
						<p class="description"><?php esc_html_e( 'How far the page scrolls before the bar hides. Default: 20px', 'simply-utility-bar' ); ?></p>
					</td>
				</tr>

			</table>

			<?php submit_button(); ?>
		</form>

		<hr>

		<h2><?php esc_html_e( 'Setup', 'simply-utility-bar' ); ?></h2>
		<ol style="line-height:2.2;">
			<li><?php printf(
				esc_html__( 'Go to %s and assign a menu to the "Utility Bar" location.', 'simply-utility-bar' ),
				'<a href="' . esc_url( admin_url( 'nav-menus.php' ) ) . '">' . esc_html__( 'Appearance → Menus', 'simply-utility-bar' ) . '</a>'
			); ?></li>
			<li><?php esc_html_e( 'Add links, custom links, or plain text labels as menu items.', 'simply-utility-bar' ); ?></li>
			<li><?php esc_html_e( 'Leave colors blank to inherit from Simply Client Config automatically.', 'simply-utility-bar' ); ?></li>
			<li><?php esc_html_e( 'Add class "sub-divider" to any menu item to insert a vertical separator before it.', 'simply-utility-bar' ); ?></li>
		</ol>

		<p style="color:#aaa;font-size:12px;margin-top:32px;text-align:center;">
			Simply Utility Bar <?php echo esc_html( SIMPLY_UTILITY_BAR_VERSION ); ?> by
			<a href="https://simplydesign.com" target="_blank" style="color:#aaa;">Simply Design</a>
		</p>

	</div>
	<?php
}
