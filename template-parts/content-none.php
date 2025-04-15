<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package vertuka
 */

?>

<div class="page-404 pb-5">
	<div class="container-fluid">
		<div class="main-box pt-5">
			<div class="img-box">
				<div class="text-center">
					<img class="img-fluid" src="<?php vertuka_show_image( 'assets/images/not-found.svg' ); ?>" alt="">
				</div>
			</div>
			<div>
				<h3 class="text-english">404 Not Found</h3>
			</div>

			<div>
				<h2>هیچ نتیجه ای یافت نشد!</h2>
			</div>
			<div>
				<p class="description">محصولی که به دنبالش بودید یافت نشد!</p>
			</div>
		</div>
	</div>

</div>
<style>
	.page-404 {
		position: relative;
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