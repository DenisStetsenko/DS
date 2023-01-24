<!--You can change it for current website!-->
<style>
	* {
		margin: 0;
		padding: 0;
	}
	a {
		-webkit-transition: all 0.2s ease-out;
		-moz-transition: all 0.2s ease-out;
		-ms-transition: all 0.2s ease-out;
		-o-transition: all 0.2s ease-out;
		transition: all 0.2s ease-out;
	}
	.lost {
		color: #fff;
		font-family: 'Open Sans', Arial, sans-serif;
		text-align: center;
	}

	.lost h2 {
		margin: 10px 0;
		font-size: 80px;
		line-height: 1;
	}
	.lost h3 {
		font-size: 30px;
		margin-bottom: 20px;
	}

	.lost a {
		color: #fff;
		font-family: 'Open Sans', Arial, sans-serif;
		text-align: center;
		font-weight: 700;
		text-decoration: none;
		border: 2px solid #fff;
		-webkit-border-radius: 5px;
		-moz-border-radius: 5px;
		border-radius: 5px;
		padding: 5px 10px;
		margin-left: 10px;
		outline: none;
		line-height: 60px;
	}

	.lost a:hover {
		text-decoration: none;
		background: #fff;
		color: #000;
	}

	.lost img {
		margin: 0 auto;
		display: block;
		margin-top: 40px;
		margin-bottom: 40px;
		padding-top: 0;
	}
	.lost .container {
		display: inline-block;
		position: absolute;
		left: 50%;
		top: 30%;
	}
	@media (max-width: 650px) {
		.lost .container {
			display: inline-block;
			position: absolute;
			left: 5%;
			right: 5%;
			bottom: 10%;
			top: auto;
		}
	}
</style>
<body class="lost" style="background: url(<?php echo get_template_directory_uri(); ?>/assets/images/404.png) no-repeat center center fixed; background-size: cover;">
<div class="container">
	<h2>404</h2>
	<h3>It looks like you're a little lost</h3>
	<p>Double check the URL or go back to the <a href="<?php bloginfo( 'url' ); ?>">HOMEPAGE</a></p>
</div>
</body>


