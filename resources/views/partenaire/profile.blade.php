@include('layouts.sidebar_par')

<style>


    .profile-container {
        max-width: 900px;
        margin: 0 auto;
        background-color: #ffffff;
        border-radius: 12px;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        padding: 30px;
        text-align: center;
    }

    .img-contain {
        margin: 0 auto 20px;
        width: 150px;
        height: 150px;
        border: 4px solid #fd7e14;
        border-radius: 50%;
        overflow: hidden;
    }

    .img-contain img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .info {
        margin: 10px 0;
        font-weight: bold;
        color: #343a40;
    }

    .posts-info {
        margin: 15px 0;
        color: #666666;
    }

    .posts-info span {
        font-weight: bold;
        color: #343a40;
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

    .action {
        background-color: #fd7e14;
        color: #ffffff;
        border: none;
        border-radius: 6px;
        padding: 10px 20px;
        cursor: pointer;
        text-transform: uppercase;
        transition: all 0.2s ease;
    }

    .action:hover {
        background-color: #e66912;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .button-container {
        display: flex;
        justify-content: center;
        margin-top: 10px;
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
        <div class="profile-container">
            <div class="img-contain">
                <img src="{{ asset('uploads/partenaire/' . session('photo_par')) }}" alt="Partner Photo">
            </div>

            <div class="posts-info">
                <p class="info full-name">{{ session('nom_par') }} {{ session('prenom_par') }}</p>
                <p><span>City:</span> {{ session('ville_par') }}</p>
                <p><span>Email:</span> {{ session('email_par') }}</p>
                <p><span>Number of years of experience:</span> {{ session('nbr_experience') }} years</p>
                <p><span>Field of expertise:</span> {{ session('domaine_expertise') }}</p>
            </div>

            <div class="services-container">
                <h3 style="color:#fd7e14;">Services</h3>
                <div class="service-columns">
                    @foreach ($services as $service)
                    <div class="service-box">
                        <p><strong>Service's name:</strong> {{ $service->nom_service }}</p>
                        <p><strong>Availability:</strong> {{ $service->crenau_dispo }}</p>
                        <p><strong>Price:</strong> {{ $service->prix }} DH </p>
                        <form action="{{ route('services.destroy', $service->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="action">  <i class="fas fa-trash"></i></button>
                        </form>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="button-container">
                <a href="{{ route('edit-profile_par') }}">
                    <button class="action">Edit</button>
                </a>
            </div>
        </div>
    </main>
</section>
