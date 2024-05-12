@include('layouts.sidebar')

<style>
    .containe {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .profile-car {
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        padding: 20px;
        text-align: center;
        max-width: 400px;

        width: 100%;
    }

    .img-cont {
        margin: auto;
        border: 4px solid #fd7e14;
        border-radius: 50%;
        overflow: hidden;
        width: 120px;
        height: 120px;
    }

    .img-cont img {
        width: 100%;
        height: auto;
    }

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

    .actionn {
        background-color: #fd7e14;
        color: #ffffff;
        border: none;
        font-size: 15px;
        border-radius: 5px;
        padding: 10px 15px;
        cursor: pointer;
        margin-top: 15px;
        text-transform: uppercase;
        transition: all 0.2s ease;
    }

    .actionn:hover {
        background-color: #e66912;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
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


        <div class="containe">
            <div class="profile-car">
                <div class="img-cont">
                    <img src="{{ asset('uploads/client/' . session('photo_cl')) }}" alt="photo_cl">
                </div>

                <p class="info full-name">{{ session('nom_cl') }} {{ session('prenom_cl') }}</p>
                <p class="info place"><i class="fas fa-map-marker-alt"></i> {{ session('adresse_cl') }}</p>

                <div class="posts-info">
                    <p><span>Email:</span> {{ session('email_cl') }}</p>
                </div>

                <div class="posts-info">
                    <p><span>Phone:</span> {{ session('telephone_cl') }}</p>
                </div>

                <a href="{{ route('edit-profile') }}">
                    <button class="actionn">Edit</button>
                </a>
            </div>
        </div>
    </main>
</section>
