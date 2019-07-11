<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <!-- Styles -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    </head>
    <body>
    <div class="container">
      <h1>PHONE BOOK</h1>

      <a class="btn btn-primary btn-nueva" data-toggle="modal" data-target="#addModal"><b>+</b> Add contact</a>
      <br>
      <br>
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
    <!-- Modal -->
      <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Add new contact</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <label for="">Name</label>
                <input type="text" class="form-control"  id="add-name" name="" value="">
              </div>
              <div class="form-group">
                <label for="">PhoneNumber</label>
                <input type="text" class="form-control" id="add-phone-number" name="" value="">
              </div>
              <div class="form-group">
                <label for="">Email</label>
                <input type="text" class="form-control" id="add-email" name="" value="">
              </div>
            </div>
            <div id="validation-errors">

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" id="add-contact">Add contact</button>
            </div>
          </div>
        </div>
      </div>
    </body>

    <script type="text/javascript">
        $('document').ready(function() {
          getAllContacts();
        });

        function getAllContacts() {
          $('.table-body').html('');
          $.get('/api/contacts', function( contacts ) {
            contacts.forEach((contact) => {
              $('.table-body').append(`
                <tr>
                <td>${contact.name}</td>
                <td>${contact.number}</td>
                <td>${contact.email}</td>
                <td>
                <a class="btn btn-default btn-outline-dark" onclick = "" > Edit </a>
                <a class="btn btn-default btn-outline-dark" onclick = "removeOneContact(${contact.id})" > Delete </a>
                <a class="btn btn-default btn-outline-dark" onclick = "showContact(${contact.id})" > Show</a>
                </td>
                </tr>`);
            });
          });
        }

        function resetAddInput() {
          $('#add-name').val('');
          $('#add-phone-number').val('');
          $('#add-email').val('');
        }

        function removeOneContact(contactId) {
          $.ajax({
              url: '/api/contacts/' + contactId,
              method: 'DELETE',
              contentType: 'application/json',
              success: function(result) {
                    getAllContacts();
              },
              error: function(request,msg,error) {
                  // handle failure
              }
          });
        }
        $('#add-contact').click(function () {
          $.post('/api/contacts', {name: $('#add-name').val(), number: $('#add-phone-number').val(), email: $('#add-email').val() })
          .done(function( data ) {
            $("#addModal .close").click();
            getAllContacts();
            resetAddInput();
          })
          .fail(function(data) {
            $('#validation-errors').html('');
            $.each(data.responseJSON.errors, function(key,value) {
               $('#validation-errors').append('<div class="alert alert-danger">'+value+'</div');
           });
          });
        });

    </script>
</html>
