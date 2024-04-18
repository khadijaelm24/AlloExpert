<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Partenaire</title>
</head>
<body>
    <h1>Dashboard Partenaire</h1>
    
    <p>Welcome, {{ session('user_par') }} with ID: {{ session('id_par') }}</p>
    <p>{{ session('nom_par') }}</p>
    <p>{{ session('prenom_par') }}</p>
    <p>{{ session('photo_par') }}</p>
    <img src="{{ asset('uploads/' . session('photo_par')) }}" />
    <p>{{ session('password_par') }}</p>
    <p>{{ session('adresse_par') }}</p>
    <p>{{ session('email_par') }}</p>
    <p>{{ session('telephone_par') }}</p>
    <p>{{ session('id_admin_par') }}</p>
    <p>{{ session('ville_par') }}</p>
    <p>{{ session('metier_par') }}</p>
    <p>{{ session('nbr_experience_par') }}</p>
    <p>{{ session('domaine_expertise_par') }}</p>

    <form action="{{ route('logout') }}" method="post">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">logout</button>
    </form>
</body>
</html>