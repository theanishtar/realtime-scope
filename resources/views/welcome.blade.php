<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Chat App Socket.io</title>

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

</head>

<body>

  <div class="container">
    <div class="row chat-row">
      <div class="chat-content">
        <ul>

        </ul>
      </div>

      <div class="chat-section">
        <div class="chat-box">
          <label for="id">ID:</label>
          <input type="text" id="id" name="id">

          <label for="scope">Scope:</label>
          <input type="text" id="scope" name="scope">

          <button id="confirmButton">Xác nhận</button>
          </input>
        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous"></script>
  <script src="https://cdn.socket.io/4.0.1/socket.io.min.js"
    integrity="sha384-LzhRnpGmQP+lOvWruF/lgkcqD+WDVt9fU3H4BWmwP5u5LTmkUGafMcpZKNObVMLU" crossorigin="anonymous">
  </script>


  <script>
  $(function() {
    let ip_address = '127.0.0.1';
    let socket_port = '3000';
    let socket = io(ip_address + ':' + socket_port);

    let id = $('#id');
    let scope = $('#scope');

    $(document).ready(function() {
      $('#confirmButton').click(function() {
        var idValue = $('#id').val();
        var scopeValue = $('#scope').val();
        console.log('ID:', idValue);
        console.log('Scope:', scopeValue);
        let message = {
          id: idValue,
          scope: scopeValue
        }
        socket.emit('sendChatToServer', message);
        id.html('');
        scope.html('');
        return false;
      });
    });


    // id.keypress(function(e) {
    //   let message = $(this).html();
    //   console.log(message);
    //   if (e.which === 13 && !e.shiftKey) {
    //     socket.emit('sendChatToServer', message);
    //     id.html('');
    //     scope.html('');
    //     return false;
    //   }
    // });

    socket.on('sendChatToClient', (message) => {
      $('.chat-content ul').append(`<li>${message}</li>`);
    });
  });
  </script>
</body>

</html>