# AlloExpert

AlloExpert is a web application that aims to the management of home services, especially DIY and gardening tasks.

## Group members:

AlloExpert is an academic project that is made by:

- ADBIB Ilham
- BOUGHAIT Farah
- DAHIA Soukaina
- EL MADANI Khadija
- LAMRINI Imane

## Used technologies:

This web application is made using the following technologies:

- **Laravel** (as a framework of the PHP backend technology for the management of the server side, based on MVC (Model, View, Controller) architecture, and so on...)
- **Bootstrap** (the styling framework frequently used for managing the style of the application)
- **MySQL** (for relational database management)
- **Ajax** (for facilitating communication between client side and server side)

## Main Functionalities:

### Customer Space:

- Signup and login to AlloExpert.
- Access to the dashboard.
- Edit profile.
- Check main statistics: Number of: Partners, interventions, comments and requests, the list of requests (accepted, refused, done, in progress), all partners, including their available services, and also comments.
- Submit a reservation for an available service.
- Submit a comment after that intervention is finished, and the customer has just a deadline of 7 days to submit the comment, after specifying the: <i>Rate</i> and <i>Content</i>.
- Submit a complaint, after specifying the: <i>Reason</i> and <i>Partner's full name</i>.

### Expert Space:

- Signup and login to AlloExpert.
- Access to the dashboard.
- Edit profile.
- Check main statistics: Number of: Customers, interventions, comments and requests, the list of requests (accepted, refused, done, in progress), and interventions.
- Accept or refuse a reservation (after confirming the acceptance or refusal, an email will be sent to the customer to notify about the details of the progress of the request).
- Submit a comment after that intervention is finished, and the partner has just a deadline of 7 days to submit the comment, after specifying the: <i>Rate</i> and <i>Content</i>.
- Submit a complaint, after specifying the: <i>Reason</i> and <i>Customer's address</i>.

### Admin Space:

The admin is the key manager of the whole application. Throughout his dashboard, admin has the privilege to:

- Check main statistics: Number of: Partners, Customers, interventions, Client's and Partner's comments and requests.
- Access to details of all done interventions (client name, provided service, duration (per days) and total price).
- Check the list of all clients (full name, email, address and phone), and all partners (full name, email, city and domain of expertise).
- Process diverse complaints via activating or desactivating a customer's or partner's account suit a critical complaint.
