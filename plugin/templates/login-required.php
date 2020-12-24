<?php
/**
 * Template file for the Login Required page.
 *
 * @package wp-nox-login-required
 */

$contents           = get_option( 'wp_nox_lr_custom_html_contents' );
$login_btn_disabled = (int) get_option( 'wp_nox_lr_custom_html_login_btn_disabled' ) === 1;

?><!doctype html>
<html class="no-js" <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">

		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<title><?php echo esc_html( get_bloginfo( 'name' ) ); ?></title>

		<?php wp_head(); ?>

		<link rel="canonical" href="<?php echo esc_url( site_url( '/' ) ); ?>">

		<style>
			footer {
				padding-top: 3rem;
				padding-bottom: 3rem;
			}

			footer p {
				margin-bottom: .25rem;
			}
		</style>
	</head>
	<body <?php body_class(); ?>>
		<?php wp_body_open(); ?>

		<header>
			<div class="navbar navbar-dark bg-dark shadow-sm">
				<div class="container d-flex justify-content-between">
					<a href="<?php echo esc_url( site_url( '/' ) ); ?>" class="navbar-brand d-flex align-items-center">
						<strong><?php echo esc_html( get_bloginfo( 'name' ) ); ?></strong>
					</a>
				</div>
			</div>
		</header>
		<main role="main">
			<section class="jumbotron text-center">
				<div class="container">
					<h1><?php echo esc_html( get_bloginfo( 'name' ) ); ?></h1>

					<?php if ( ! empty( $contents ) ) : ?>

						<p class="lead text-muted"><?php echo esc_html( $contents ); ?></p>

					<?php endif; ?>

					<?php if ( ! $login_btn_disabled ) : ?>

						<p>
							<a href="<?php echo esc_url( wp_login_url() ); ?>" title="<?php echo esc_attr( __( 'Login', 'wp-nox-login-required' ) ); ?>" class="btn btn-secondary my-2"><?php echo esc_html( __( 'Login', 'wp-nox-login-required' ) ); ?></a>
						</p>

					<?php endif; ?>

				</div>
			</section>
		</main>
		<footer class="text-muted">
			<div class="container">
				<p class="text-center">&copy; <?php echo esc_attr( gmdate( 'Y' ) ); ?> <?php echo esc_html( get_bloginfo( 'name' ) ); ?></p>
			</div>
		</footer>

		<?php wp_footer(); ?>
	</body>
</html>
