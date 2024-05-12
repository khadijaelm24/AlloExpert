		<!-- NAVBAR -->
		<link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet">

		@include('layouts.sidebar_admin')
		<section id="content">
			<!-- NAVBAR -->
			
		<!-- MAIN -->
		<main>
			<div class="head-title">
				<div class="left">
					<h1>Dashboard</h1>

				</div>

			</div>

			<ul class="box-info">
				<li>
					<i class='bx bx-buildings'></i> <!-- Changed to a suitable alternative -->
					<span class="text">
						<h3>{{ $partenaireCount }}</h3>
						<p>Partners</p>
					</span>
				</li>
				<li>
					<i class='bx bx-user'></i> <!-- Corrected icon class for clients -->
					<span class="text">
						<h3>{{ $clientCount }}</h3>
						<p>Clients</p>
					</span>
				</li>
				<li>
					<i class='bx bx-wrench'></i> <!-- Correct icon for interventions -->
					<span class="text">
						<h3>{{ $interventionCount }}</h3>
						<p>Interventions</p>
					</span>
				</li>
				<li>
					<i class='bx bx-comment-detail'></i> <!-- Correct icon for client comments -->
					<span class="text">
						<h3>{{ $commentCount }}</h3>
						<p>Comments of Client</p>
					</span>
				</li>
				<li>
					<i class='bx bx-comment-detail'></i> <!-- Alternative icon for expert comments -->
					<span class="text">
						<h3>{{ $expertCommentCount }}</h3>
						<p>Comments of Expert</p>
					</span>
				</li>
				<li>
					<i class='bx bx-pointer'></i> <!-- Suitable icon for requests -->
					<span class="text">
						<h3>{{ $demandeCount }}</h3>
						<p>Requests</p>
					</span>
				</li>
			</ul>


			<div class="table-data">

			</div>
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->



</body>
</html>
