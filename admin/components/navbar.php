<nav class="navbar navbar-expand-md navbar-fixed-top navbar-light bg-success main-nav">
	<div class="container-fluid">
	<a class="navbar-brand text-white" href="/DierenOpvang/"><img class="img-fluid rounded-circle" width="75" height="auto" src="../<?php echo $profilepic; ?>"> Learning Software</a>
	<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
	<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="navbarNav">
		<ul class="nav mx-auto">
			<li class="nav-item">
				<a class="nav-link active text-white" href="dashboard.php"></a>
			</li>
			<li class="nav-item">
				<a class="nav-link text-white" href="info.php">Info over de website</a>
			</li>
			<li class="nav-item">
				<a class="nav-link text-white" href="profile.php">Profiel Info</a>
			</li>
			<li class="nav-item">
				<a class="nav-link text-white" href="../php/login/logout.php">Loguit</a>
			</li>
		</ul>
		<form method="POST" enctype="multipart/form-data" action="search.php" class="d-flex">
        <input class="form-control me-2" name="search" id="search" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-light" type="submit">Search</button>
		</form>
	</div>
	</div>
</nav>