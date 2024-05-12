@include('layouts.sidebar')

<section id="content">
    <nav>
        <i class='bx bx-menu'></i>
        <div style="margin-left: 800px;">
            <input type="checkbox" id="switch-mode" hidden>
            <label for="switch-mode" class="switch-mode"></label>
        </div>
    </nav>
    <main>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Reservation Form</div>
                        <div class="card-body">
                            <!-- Display success message if it exists -->
                            @if(session('success'))
                            <div class="alert alert-success" style="background-color: #d4edda; border-color: #c3e6cb; color: #155724; padding: 0.75rem 1.25rem; margin-bottom: 1rem; border-radius: 0.25rem;">
                                {{ session('success') }}
                            </div>
                        @endif

                            <!-- Display error message if it exists -->
                            @if($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ route('make-reservation') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="service">Choose a Service:</label>
                                    <select name="service" id="service" class="form-control">
                                        @foreach ($services as $service )
                                            <option value="{{ $service->id }}">{{ $service->nom_service }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="duree">Duration (in days):</label>
                                    <input type="text" name="duree" id="duree" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="date_debut">Start Date:</label>
                                    <input type="date" name="date_debut" id="date_debut" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="date_fin">End Date:</label>
                                    <input type="date" name="date_fin" id="date_fin" class="form-control">
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</section>
