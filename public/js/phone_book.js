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
