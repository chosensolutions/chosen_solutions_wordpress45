const express = require('express');
const router = express.Router();

var Datastore = require('nedb');
var users = new Datastore({filename: '../../db/users.db', autoload: true, timestampData: true});

router.post('/register', async (req, res, next) => {
    let email = req.body.email;
    let password = req.body.password;

    users.update({_id: email}, {_id: email, password: password}, {upsert: true}, function (err) {
        if (err) return res.status(500).end({ message: err });

        req.session.email = email;

        return res.json({
            message: "The email: " + email + " has registered."
        });
    });
});

router.post('/login', function (req, res, next) {
    let email = req.body.email;
    req.session.email = email;
    
    res.status(200).json({
        message: `user: ${email} has logged in`
    })
});

router.get('/logout', function (req, res, next) {
    let email = req.session.email;
    
    req.session.destroy();
    
    res.json({
        message: `user ${email} has successfully logged out`
    });
});

router.get('/me', function (req, res, next) {
    res.json(req.session);
});

module.exports = router;