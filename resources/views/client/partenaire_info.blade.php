@include('layouts.sidebar')

<style>
    /* Styles généraux */

    /* Conteneur principal pour le contenu */
    .main-container {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 20px;
    }

    /* Boîte de profil avec ombre et bordure arrondie */
    .profile-box {
        background-color: #ffffff;
        border-radius: 12px;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        padding: 30px;
        text-align: center;
        max-width: 900px;
        width: 100%;
    }

    /* Image avec un cercle et une bordure */
    .img-cont {
        width: 150px;
        height: 150px;
        border: 4px solid #fd7e14;
        border-radius: 50%;
        overflow: hidden;
        margin: 0 auto 20px;
    }

    .img-cont img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Texte d'informations avec une mise en page améliorée */
    .info {
        margin: 10px 0;
        font-weight: bold;
        color: #343a40;
    }

    .posts-info {
        margin: 10px 0;
        color: #666666;
    }

    .posts-info span {
        font-weight: bold;
        color: #343a40;
    }
    .button-container {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }
    /* Bouton d'action */
    .action {

        background-color: #fd7e14;
        color: #ffffff;
        border: none;
        border-radius: 6px;
        padding: 10px 20px;
        cursor: pointer;
        margin-top: 20px;
        text-transform: uppercase;
        transition: all 0.2s ease;
    }

    .action:hover {
        background-color: #e66912;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    /* Conteneur des services */
    .services-container {
        margin-top: 30px;
        text-align: left;
        margin-left: 30px;
    }

    .service-columns {
        display: flex;
        flex-direction:row;
        gap: 15px;
    }

    .service-box {
        background-color: #f8f681;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        padding: 15px;
    }

    .service-box p {
        margin: 5px 0;
    }
</style>

<section id="content">
    <nav>
        <i class='bx bx-menu'></i>
        <div style="margin-left: 800px;">
            <input type="checkbox" id="switch-mode" hidden>
            <label for="switch-mode" class="switch-mode"></label>
        </div>
    </nav>
    <main>
        <div class="main-container">
            <div class="profile-box">
                <div class="img-cont">
                    <img src="{{ asset('uploads/partenaire/' . $partenaire->photo_par) }}" alt="Partner Photo">
                </div>
                <p class="info full-name">{{ $partenaire->nom_par }} {{ $partenaire->prenom_par }}</p>
                <p class="posts-info"><span> Rating:</span> {{ $averageRating }}</p>

                <div class="posts-info">
                    <p><span>City:</span> {{ $partenaire->ville }}</p>
                </div>

                <div class="posts-info">
                    <p><span>Number of years of experience:</span> {{ $partenaire->nbr_experience  }} years </p>
                </div>

                <div class="posts-info">
                    <p><span>Expertise field:</span> {{ $partenaire->domaine_expertise }}</p>
                </div>

                <div class="services-container">
                    {{-- <h3>Services</h3> --}}
                    <div class="service-columns">
                        @foreach ($services as $service)
                        <div class="service-box">
                            <p><strong>Service:</strong> {{ $service->nom_service }}</p>
                            <p><strong>Availability:</strong> {{ $service->crenau_dispo }}</p>
                            <p><strong>Price:</strong> {{ $service->prix }} DH</p>
                        </div>
                        @endforeach
                    </div>
                    <div class="button-container">
                    <a href="{{ route('reservation-form', $service->id_expert) }}">

                        <button class="action message">Reserve</button>
                    </a>
                </div>
            </div>

            </div>
        </div>
    </main>
</section>
