
	<!-- SIDEBAR -->
	@include('layouts.sidebar')
	<section id="content">
		<!-- NAVBAR -->
		<nav>
			<i class='bx bx-menu' ></i>
			<a href="#" class="nav-link">Search:</a>
			<form  action="{{route('demande_search')}}" method="GET">
				<div class="form-input">
					<input type="search" name="search" placeholder="">
					<button type="submit"  class="search-btn"><i class='bx bx-search' ></i></button>
				</div>
			</form>
			<input type="checkbox" id="switch-mode" hidden>
			<label for="switch-mode" class="switch-mode"></label>


		</nav>
	<!-- CONTENT -->


		<!-- MAIN -->
		<main>
			<div class="head-title">
				<div class="left">
					<h1>Requests History</h1>
			    </div>
				{{-- <a href="add_client.php" class="btn-download ">
					<span class="text" >Add client</span>
				</a> --}}
			</div>

			<div class="table-data">
				<div class="order">
					<table>
						<thead>
							<tr>
                                <th>Partner</th>
                                <th>Service</th>
                                <th>Date</th>
                                <th>Statut</th>
							</tr>
						</thead>

						<tbody>
                            @forelse ($demandes as $demande)
                            <tr>
                                <td>{{ $demande->service->partenaire->nom_par ?? 'Not Available' }}</td>
                                <td>{{ $demande->service->nom_service ?? 'Not Available' }}</td>
                                <td>{{ $demande->date_reservation }}</td>
                                <td>{{ $demande->statut }}</td>

                                <td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">No reservations found.</td>
                            </tr>
                        @endforelse
						</tbody>

					</table>
				</div>

			</div>
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->

</div>


</body>

</html>
