<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <!-- Styles -->
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
    <!-- Add Modal -->
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
            <div id="validation-errors-create">

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" onclick = "createOneContact()" >Add contact</button>
            </div>
          </div>
        </div>
      </div>
    <!-- Show Infomation Modal -->
      <div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Contact Infomation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label for="">Name</label>
                  <input type="text" class="form-control"  id="show-name" disabled name="" value="">
                </div>
                <div class="form-group">
                  <label for="">PhoneNumber</label>
                  <input type="text" class="form-control" id="show-phone-number" disabled name="" value="">
                </div>
                <div class="form-group">
                  <label for="">Email</label>
                  <input type="text" class="form-control" id="show-email" name="" disabled value="">
                </div>
              </div>
              <div id="validation-errors">

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
    <!-- Edit Infomation Modal -->
      <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Contact Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <input type="hidden" class="form-control"  id="edit-id"  name="" value="">
                    <div class="form-group">
                      <label for="">Name</label>
                      <input type="text" class="form-control"  id="edit-name"  name="" value="">
                    </div>
                    <div class="form-group">
                      <label for="">PhoneNumber</label>
                      <input type="text" class="form-control" id="edit-phone-number"  name="" value="">
                    </div>
                    <div class="form-group">
                      <label for="">Email</label>
                      <input type="text" class="form-control" id="edit-email" name=""  value="">
                    </div>
                  </div>
                  <div id="validation-errors-edit">

                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick = "editOneContact()" >Save</button>
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
                <a class="btn btn-default btn-outline-dark" onclick = "editContact('${contact.id}', '${contact.name}', '${contact.number}', '${contact.email}')" > Edit </a>
                <a class="btn btn-default btn-outline-dark" onclick = "removeOneContact(${contact.id})" > Delete </a>
                <a class="btn btn-default btn-outline-dark" onclick = "showContact( '${contact.name}', '${contact.number}', '${contact.email}' )" > Show</a>
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

        function showContact( name, number, email ) {
          $('#showModal').modal('show');

          $('#show-name').val(name);
          $('#show-phone-number').val(number);
          $('#show-email').val(email);
        }

        function editContact( id, name, number, email ) {
          $('#editModal').modal('show');

          $('#edit-id').val(id);
          $('#edit-name').val(name);
          $('#edit-phone-number').val(number);
          $('#edit-email').val(email);
        }

        function editOneContact() {
          let id = $('#edit-id').val();
          let data = {name: $('#edit-name').val(),  number: $('#edit-phone-number').val(), 'email': $('#edit-email').val()};
          $.ajax({
              type: 'PUT',
              url: '/api/contacts/' + id,
              contentType: 'application/json',
              data: JSON.stringify(data), // access in body
          }).done(function (data) {
              $('#editModal').modal('hide');
              getAllContacts();
          }).fail(function (data) {
            $('#validation-errors-edit').html('');
            $.each(data.responseJSON.errors, function(key,value) {
               $('#validation-errors-edit').append('<div class="alert alert-danger">'+value+'</div');
           });
          });
        }
        function removeOneContact( contactId ) {
          if (confirm('Are you sure ?')) {
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
        }

        function createOneContact() {
          $.post('/api/contacts', {name: $('#add-name').val(), number: $('#add-phone-number').val(), email: $('#add-email').val() })
          .done(function( data ) {
            $("#addModal .close").click();
            getAllContacts();
            resetAddInput();
          })
          .fail(function(data) {
            $('#validation-errors-create').html('');
            $.each(data.responseJSON.errors, function(key,value) {
               $('#validation-errors-create').append('<div class="alert alert-danger">'+value+'</div');
           });
          });
        }

    </script>
</html>
