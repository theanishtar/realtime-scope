const express = require('express');
const axios = require('axios');
const csrf = require('csurf');
const cookieParser = require('cookie-parser');


const app = express();
const server = require('http').createServer(app);
const io = require('socket.io')(server, {
  cors: { origin: "*" }
});


app.use(cookieParser());
app.use(express.urlencoded({ extended: true }));

// Sử dụng csrf middleware
const csrfProtection = csrf({ cookie: true });
app.use(csrfProtection);

// Middleware để gửi CSRF token cho client
app.use((req, res, next) => {
  res.cookie('XSRF-TOKEN', req.csrfToken());
  next();
});


async function sendDataToLaravel(data, req) {
  try {
    const response = await axios.post('http://127.0.0.1:8000/scope?name=6578', data, {
      // headers: {
      //   'X-CSRF-TOKEN': req.cookies['XSRF-TOKEN']
      // }
    });
    console.log('Response from Laravel:', response.data);
    return response.data;
  } catch (error) {
    console.error('Error sending data to Laravel:', error.message);
    throw error;
  }
}

io.on('connection', (socket) => {
  console.log('connection');

  socket.on('sendChatToServer', async (message) => {
    console.log(message);

    try {
      const data = {
        id: 1,
        scope: message
      }
      const responseData = await sendDataToLaravel(data);
      console.log('Data sent to Laravel successfully:', responseData);
    } catch (error) {
      console.error('Failed to send data to Laravel:', error.message);
    }

    socket.broadcast.emit('sendChatToClient', message);
  });

  socket.on('disconnect', () => {
    console.log('Disconnect');
  });
});

server.listen(3000, () => {
  console.log('Server is running');
});
