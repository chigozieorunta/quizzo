<?php
/**
 * @package Quizzo
 */

namespace Quizzo\Plugin;

/**
 * Menu Class
 */
class Menu {
	/**
	 * Menu Instance.
	 *
	 * @var \Menu
	 */
	private static $instance;

	/**
	 * Get instance of Class (Singleton).
	 *
	 * @return \Menu
	 */
	public static function get_instance(): object {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Set up Menu.
	 *
	 * @return void
	 */
	public function init(): void {
		// Parent Menu
		add_menu_page(
			__( PLUGIN_NAME, PLUGIN_DOMAIN ),
			__( PLUGIN_NAME, PLUGIN_DOMAIN ),
			PLUGIN_ROLE,
			PLUGIN_SLUG,
			false,
			'dashicons-edit-page',
			99
		);

		// Dashboard Sub Menu
		add_submenu_page(
			PLUGIN_SLUG,
			__( PLUGIN_NAME, PLUGIN_DOMAIN ),
			__( 'Dashboard', PLUGIN_DOMAIN ),
			PLUGIN_ROLE,
			PLUGIN_SLUG,
			[ $this, 'register_menu_page' ]
		);
	}

	/**
	 * Register Menu page.
	 *
	 * @return void
	 */
	public function register_menu_page(): void {
		echo '
			<div id="wpbody" role="main">
				<div id="wpbody-content">
					<div class="wrap about__container">
						<div class="about__header">
							<div class="about__header-title">
								<h1>Quizzo</h1>
							</div>

							<div class="about__header-text"></div>

							<nav class="about__header-navigation nav-tab-wrapper wp-clearfix" aria-label="Secondary menu">
								<a href="'. home_url() . '/wp-admin/admin.php?page=quizzo" class="nav-tab nav-tab-active" aria-current="page">What&#8217;s New</a>
								<a target="_open" href="https://github.com/chigozieorunta/quizzo" class="nav-tab">Github</a>
							</nav>
						</div>

						<div class="about__section changelog">
							<div class="column">
								<h2>Maintenance and Security Releases</h2>
								<p>
									<strong>Version 6.1.1</strong> addressed 50 bugs.					For more information, see <a href="https://wordpress.org/support/wordpress-version/version-6-1-1/">the release notes</a>.
								</p>
							</div>
						</div>

						<div class="about__section">
							<div class="column">
								<h2 class="aligncenter">Welcome to Quizzo</h2>
								<p class="is-subheading">
									A simple plugin to help you set up WP Quizzes behind a WooCommerce PayWall.
								</p>
							</div>
						</div>

						<div class="about__section has-2-columns">
							<div class="column">
								<div class="about__image" style="background-color:#353535;">
									<img src="https://s.w.org/images/core/6.1/about-61-style-variations.webp" alt="" />
								</div>
							</div>
							<div class="column is-vertically-aligned-center">
								<h3>A new default theme powered by 10 distinct style variations</h3>
								<p>
									Building on the foundational elements in the 5.9 and 6.0 releases for block themes and style variations, the new default theme, Twenty Twenty-Three, includes <a href="https://make.wordpress.org/design/2022/09/07/tt3-default-theme-announcing-style-variation-selections/">10 different styles</a> and is &#147;<a href="https://make.wordpress.org/themes/handbook/review/accessibility/">Accessibility Ready</a>&#148;.				</p>
							</div>
						</div>

						<div class="about__section has-2-columns">
							<div class="column is-vertically-aligned-center">
								<h3>A better creator experience with refined and additional templates</h3>
								<p>
									<a href="https://make.wordpress.org/core/2022/07/21/core-editor-improvement-deeper-customization-with-more-template-options/">New templates</a> include a custom template for posts and pages in the Site Editor. Search-and-replace tools speed up the design of <a href="https://make.wordpress.org/core/2022/08/25/core-editor-improvement-refining-the-template-creation-experience/">template parts</a>.				</p>
							</div>
							<div class="column">
								<div class="about__image has-subtle-background-color">
									<img src="https://s.w.org/images/core/6.1/about-61-templates.webp" alt="" />
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		';
	}
}
