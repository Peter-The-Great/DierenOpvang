<nav class="navbar navbar-expand-md navbar-fixed-top navbar-light bg-light main-nav">
		<div class="container">
			<ul class="nav mx-auto">
				<li class="nav-item active">
					<a class="nav-link text-secondary" href="index.php">Home</a>
				</li>
				<li class="nav-item">
					<a class="nav-link text-secondary" href="projecten.php">Registratie</a>
				</li>
				<li class="nav-item">
					<a class="nav-link text-secondary" href="biografie.php">Reservering</a>
				</li>
				<li class="nav-item">
					<a class="nav-link text-secondary" href="contact.php">Contact</a>
				</li>
				<?php if(!isset($_SESSION["loggedin"])) {
				echo "<li class='nav-item'><a class='nav-link text-secondary' href='admin/'>Login</a></li>";
				} ?>
			</ul>
		</div>
	</nav>