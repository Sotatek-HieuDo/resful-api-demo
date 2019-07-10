<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta.2/css/bootstrap.css">
        <!-- Styles -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    </head>
    <body>
    <div class="container">
      <h1>phone book</h1>

      <a class="btn btn-primary btn-nueva" href="d"><b>+</b> Add contact</a>
      <table class="table table-bordered grocery-crud-table table-hover">
        <thead>
          <tr>
            <th>Name</th>
            <th>Phone number</th>
            <th>Email</th>
            <th></th>
          </tr>
        </thead>
        <tbody class="table-body">
        </tbody>
      </table>
    </div>
    </body>

    <script type="text/javascript">
        $.get('/api/contacts', function( contacts ) {
          contacts.forEach((contact) => {
            $('.table-body').append(`
              <tr>
              <td>${contact.name}</td>
              <td>${contact.number}</td>
              <td>${contact.email}</td>
              <td>
              <a class="btn btn-default btn-outline-dark" href=""> Edit </a>
              <a class="btn btn-default btn-outline-dark" href=""> Delete </a>
              </td>
              </tr>`);
          });
        });
    </script>
</html>
