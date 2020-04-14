const http = require('http')
const express = require('express');
const path = require('path');

const app = express();

var session = require("express-session");


// Init Middleware
// app.use(express.json());

var bodyParser = require("body-parser");

app.use(express.static("public"));

app.use(
  session({
    secret: 'secret',
    resave: true,
    saveUninitialized: true
  })
);

app.use(bodyParser.urlencoded({ extended: true }));

const passport = require('passport')
app.use(passport.initialize());
app.use(passport.session());

var LocalStrategy = require('passport-local').Strategy;

passport.use(new LocalStrategy(
  function(username, password, done) {
    console.log(username, password);

      return done(null, { name: 'yichen'});
//     User.findOne({ username: username }, function (err, user) {
//       // Finally, if an exception occurred while verifying the credentials (for example, if the database is not available), done should be invoked with an error, in conventional Node style.
//       if (err) { return done(err); }
// 
// 
//       // If the credentials are not valid (for example, if the password is incorrect), done should be invoked with false instead of a user to indicate an authentication failure.
//       if (!user) {
//         return done(null, false, { message: 'Incorrect username.' });
//       }
//       if (!user.validPassword(password)) {
//         return done(null, false, { message: 'Incorrect password.' });
//       }
// 
//       // If the credentials are valid, the verify callback invokes done to supply Passport with the user that authenticated.
//       return done(null, user);
//     });
  }
));


// passport.serializeUser(function(user, done) {
//   done(null, user.id);
// });
// 
// passport.deserializeUser(function(id, done) {
//   User.findById(id, function(err, user) {
//     done(err, user);
//   });
// });


// Define Routes
app.use('/api/auth', require('./routes/auth'));


app.use('/api/test', (req, res) => {
  res.status(200).json({
      message: 'test'
  })
});


// Serve static assets in production
if (process.env.NODE_ENV === 'production') {
  // Set static folder
  app.use(express.static('client/build'));

  app.get('*', (req, res) => {
    res.sendFile(path.resolve(__dirname, 'client', 'build', 'index.html'));
  });
}



module.exports = http.createServer(app)


