<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package vertuka
 */

get_header();

?>

<div class="page-404">
	<div class="container-fluid">
		<div class="main-box">
			<div class="img-box">
				<div class="text-center">
					<img class="img-fluid" src="<?php vertuka_show_image( 'assets/images/not-found.svg' ); ?>" alt="">
				</div>
			</div>
			<div>
				<h3 class="text-english">404 Not Found</h3>
			</div>

			<div>
				<h2>صفحه مورد نظـــــر یافت نشد!</h2>
			</div>
			<div>
				<p class="description">صفحه ای که دنبالش هستید یا حذف شده و یا کلا وجود نداشته است!</p>
			</div>

            <div class="text-center mt-2">
                <a class="btn btn-success" href="<?php echo esc_url( get_bloginfo( 'url') ); ?>"> بازگشت به سایت </a>
            </div>
		</div>
	</div>

	<div class="footer-404 d-none">
		<div class="container-fluid">
			<div class="d-block d-lg-flex justify-content-between">
				<div class="copyright">
					<p class="m-0 text-center text-lg-start">کپی‌رایت © 2023 ورتوکا مرجع تخصصی فروش و خدمات محصولات دیجیتال</p>
				</div>

				<div>
					<ul>
						<li><a href="#">RSS</a></li>
						<li class="mx-3">-</li>
						<li><a href="#">خوراک سایت</a></li>
						<li class="mx-3">-</li>
						<li><a href="#">درباره ما</a></li>
					</ul>
				</div>
			</div>
			
			<div class="logo-404">
				<a href="<?php echo esc_url( get_bloginfo( 'url') ); ?>" class="d-block text-center">
					<img class="img-fluid" src="<?php vertuka_show_image( 'assets/images/logo.png' ); ?>" alt="<?php echo esc_html( get_bloginfo( 'name' ) ); ?>">
				</a>
			</div>
		</div>
	</div>
</div>
	<style>
		.page-404 {
			position: relative;
			min-height: 100vh;
			padding-bottom: 256px;
		}

		.page-404 .main-box {
			padding-top: 160px;
		}

		.page-404 .img-box {
			margin-bottom: 56px;
		}

		.page-404 .text-english {
			color: #48AE42;
			font-size: 24px;
			font-weight: 500;
			margin-bottom: 8px;
			text-align: center;
		}

		.page-404 h2 {
			color: #000;
			font-size: 48px;
			font-weight: 800;
			line-height: 62px;
			margin-bottom: 8px;
			text-align: center;
		}

		.page-404 .description {
			color: #000;
			text-align: center;
			font-size: 18px;
			font-weight: 500;
			line-height: 24px;
			margin-bottom: 0;
		}

		.page-404 .footer-404 {
			background: #F4F4F4;
			padding: 20px 0;
			position: absolute;
			bottom: 0;
			left: 0;
			right: 0;
		}

		.page-404 .footer-404 .copyright > p {
			color: #686868;
			text-align: justify;
			font-size: 14px;
			font-style: normal;
			font-weight: 500;
			line-height: 24px
		}

		.page-404 .footer-404 ul {
			list-style: none;
			margin: 0;
			padding: 0;
			display: flex;
		}

		.page-404 .footer-404 ul > li {

		}

		.page-404 .footer-404 ul > li > a {
			color: #686868;
			font-size: 14px;
			font-style: normal;
			font-weight: 500;
			line-height: 24px
		}

		.logo-404 {
			border-radius: 49px;
			background: #FFF;
			box-shadow: 0 17px 46px 0 rgba(0, 0, 0, 0.10);
			width: 240px;
			height: 72px;
			text-align: center;
			position: absolute;
			bottom: calc( 100% - 36px );
			left: 50%;
			margin-left: -120px;
			padding-top: 10px;
		}

		@media (max-width: 1270px) {
			.page-404 .footer-404 {
				padding: 40px;
			}
		}
		@media (max-width: 991px) {
			.page-404 h2 {
				font-size: 24px;
				font-weight: 500;
				line-height: 42px;
			}
			.page-404 .text-english {
				color: #48AE42;
				font-size: 20px;
				font-weight: 600;
				line-height: 32px;
			}
			.page-404 .description {
				color: #000;
				font-size: 20px;
				font-weight: 500;
			}
			.page-404 .footer-404 {
				padding: 40px;
			}

			.page-404 .footer-404 {
				padding: 80px 0 20px;
			}
			.page-404 .footer-404 ul {
				text-align: center;
				display: block;
				margin-top: 16px;
			}

			.page-404 .footer-404 ul > li {
				display: inline-block;
			}
		}
		@media (max-width: 767px) {
			.page-404 h2 {
				font-size: 16px;
				font-weight: 600;
				line-height: 32px;
			}
			.page-404 .text-english {
				font-size: 18px;
				font-weight: 500;
				line-height: 22px;
			}
			.page-404 .description {
				color: #000;
				font-size: 18px;
				font-weight: 500;
			}

			.page-404 .main-box {
				padding: 64px 8px 48px;
			}

		}
	</style>
<?php
get_footer();


