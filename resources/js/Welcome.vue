
<template>
   <body>

<header class="header">
    <div class="container">
        <img  src="/img/dents logo.png" alt="Happy Dents" height="80">
        <a href="registro">Registrar pacientes</a>
        <a href="#">Buscar registro</a>
        <a href="#">Visitas</a>
    </div>
</header>
<div id="app"> </div>
<main class="main">

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <img src="/img/dents home.jpg" alt="Happy Dents Clinic" class="img-fluid">
            </div>
            <div class="col-md-6">
                <h1>Happy Dents</h1>
                <p>We are a modern dental clinic located in the heart of the city. Our experienced dentists and friendly staff provide high-quality dental services for patients of all ages. Whether you need a routine check-up, a filling, or a cosmetic procedure, we are here to help you achieve a healthy and beautiful smile.</p>
                <a href="#" class="btn btn-primary btn-lg">Book an Appointment</a>
            </div>
            <footer class="footer">
                <div class="container">
                    <p>&copy; 2023 Happy Dents. All rights reserved.</p>
                    <a href="#">Privacy Policy</a>
                    <a href="#">Terms of Service</a>
                    <a href="#">Contact Us</a>
                </div>
            </footer>
            </div>
            </div>
</main>
   </body>
</template>

<script>
export default {

}
</script>

<style scoped>
	body {
			font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
			font-size: 16px;
			color: #444;
			background-color: #f7f7f7;
			line-height: 1.6;
			margin: 0;
			padding: 0;
		}

.header img{
padding-right: 200px;
	height: 80px;

}


		.header {
			background-color: #00BFFF;
			color: #fff;
			padding: 20px;
			text-align: center;
			position: fixed;
			top: 0;
			left: 0;
			right: 0;

			z-index: 999;
		}
		.header a {
			color: #fff;
			font-weight: bold;
			margin-right: 20px;
			font-size: larger;
			padding-top: 20000000000000000px;
			margin-top: 20000000000px;

		}

		.main {
			margin-top: 90px;
			padding: 40px;
		}
		.footer {
			background-color: #00BFFF;
			color: #fff;
			padding: 20px;
			text-align: center;
			position: fixed;
			bottom: 0;
			left: 0;
			right: 0;
		}
		.footer a {
			color: #fff;
			margin-right: 20px;
		}

</style>
