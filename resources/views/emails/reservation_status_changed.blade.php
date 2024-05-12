<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style>
        .email-body {
            font-family: Arial, sans-serif;
        }
        .email-header {
            background-color: #f2f4f6;
            padding: 20px;
            text-align: center;
        }
        .email-content {
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="email-body">
        <div class="email-header">
            <h2>AlloExpert Reservation Services</h2>
        </div>

        <div class="email-content">
            <p>Hello,</p>
            <p>Your reservation for the service <strong>{{ $reservation->service->nom_service }}</strong> has been <strong>{{ $status }}</strong>.</p>

            @if($status == 'accepted')
            <p>Here are the details of your reservation:</p>
            <ul>
                <li>Start Time: {{ $reservation->date_debut }}</li>
                <li>End Time: {{ $reservation->date_fin }}</li>
            </ul>
            <p>Here is your partner's contact information:</p>
            <ul>
                <li>Name: {{ $reservation->service->partenaire->nom_par }}</li>  <!-- Adjusted path -->
                 <!-- Adjusted path, assuming the Partenaire model has a phone attribute -->
                <li>Email: {{ $reservation->service->partenaire->email }}</li> <!-- Adjusted path, assuming the Partenaire model has an email attribute -->
            </ul>
            @endif
            

            @if($status == 'refused')
            <p>Unfortunately, we had to cancel your reservation. Please contact us to reschedule or to discuss further details.</p>
            @endif

            <p>Thank you for choosing AlloExpert. We look forward to serving you.</p>

            <p>Best regards,</p>
            <p>The AlloExpert Team</p>
        </div>
    </div>
</body>
</html>
