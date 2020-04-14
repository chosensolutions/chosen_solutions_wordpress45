const express = require('express');
const router = express.Router();
const passport = require('passport')

router
  .post('/register', function (req, res, next) {
    var username = req.body.username;
    var password = req.body.password;
    var salt = generateSalt();
    var hash = generateHash(password, salt);
    users.findOne({_id: username}, function (err, user) {
        if (err) return res.status(500).end(err);
        if (user) return res.status(409).end("username " + username + " already exists");

        users.update({_id: username}, {_id: username, password: hash, salt: salt}, {upsert: true}, function (err) {
            if (err) return res.status(500).end(err);
            // initialize cookie
            res.setHeader('Set-Cookie', cookie.serialize('username', username, {
                path: '/',
                maxAge: 60 * 60 * 24 * 7
            }));
            req.session.username = username;
            return res.json("user " + username + " signed up");
        });
    });
});

// curl -H "Content-Type: application/json" -X POST -d '{"username":"alice","password":"alice"}' -c cookie.txt localhost:3000/signin/
router.post('/api/signin/', function (req, res, next) {
    var username = req.body.username;
    var password = req.body.password;

    // retrieve user from the database
    users.findOne({_id: username}, function (err, user) {
        if (err) return res.status(500).end(err);
        if (!user) return res.status(401).end("access denied");
        if (user.password !== generateHash(password, user.salt)) return res.status(401).end("access denied - that username/password combination is incorrect");

        // initialize cookie
        res.setHeader('Set-Cookie', cookie.serialize('username', username, {
            path: '/',
            maxAge: 60 * 60 * 24 * 7
        }));
        req.session.username = username;
        return res.json({
            "message": "user " + username + " signed in"
        });
    });
});

// curl -b cookie.txt -c cookie.txt localhost:3000/signout/
router.get('/api/signout/', function (req, res, next) {
    res.setHeader('Set-Cookie', cookie.serialize('username', '', {
        path: '/',
        maxAge: 60 * 60 * 24 * 7 // 1 week in number of seconds
    }));
    req.session.destroy();
    //res.redirect('/');

    res.json("user has successfully signed out");
});

// curl -b cookie.txt -c cookie.txt localhost:3000/signout/
router.get('/api/users/auth', function (req, res, next) {
    res.json(req.session);
});