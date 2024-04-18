
    		<!-- NAVBAR -->
		@include('layouts.sidebar')
		<!-- MAIN -->
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
                
                <a href="#" class="profile">
                    <img src="{{ asset('uploads/client' . session('photo_cl')) }}">
                </a>
            </nav>
		<main>
            
			<div class="table-data">    
             
				<div class="todo" >
                    <div  style="display: flex; flex-direction: row; flex-wrap: nowrap; overflow-x: auto;  background-color: #fff; ">
                   @foreach ($partenaire as $p) 
        <div class="profile-container" >
        <div class="img-container">
            <img src="../alloexpert/assets/images/features/04.png" alt="profile image">
        </div>
        <p class="info full-name">{{$p->nom_par}} {{$p->prenom_par}}</p>
        <p class="info role">
            <i class="fas fa-star"></i>
            {{$p->metier}} / {{$p->domaine_expertise}}
        </p>
        <p class="info place">
            <i class="fas fa-map-marker-alt"></i>
            {{$p->ville}}
        </p>

        <div class="posts-info"> 
            <p><span>{{$p->nbr_experience}} ans</span>  d'expertise</p>  
        </div>

        <button class="action message"> profile</button>
    </div>  <br>
    @endforeach
				</div>
            </div>
			</div>
           
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
	

	
</body>
</html>
