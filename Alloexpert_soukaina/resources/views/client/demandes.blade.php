
	<!-- SIDEBAR -->
	@include('layouts.sidebar')
	<section id="content">
		<!-- NAVBAR -->
		<nav>
			<i class='bx bx-menu' ></i>
			<a href="#" class="nav-link">Recherche:</a>
			<form action="#">
				<div class="form-input">
					<input type="search" placeholder="">
					<button type="submit" class="search-btn"><i class='bx bx-search' ></i></button>
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
					<h1>Historique des Demandes</h1>
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
                                <th>Service:</th>
                                <th>Statut:</th>
                                <th>date:</th>
                                <th>heure:</th>
                                <th>partenaire:</th>
							
							</tr>
						</thead>
						
						<tbody>
							
                            @foreach ($demande as $d)
                            <tr>
                                <td>{{$d->service}}</td>
                                <td>{{$d->status}}</td>
                                <td>{{$d->date_reservation}}</td>
                                <td>{{$d->heure}}</td>
                                <td>{{$d->partenaire_nom}} {{$d->partenaire_prenom}}</td>
                           
                
                            </tr>
                        @endforeach
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