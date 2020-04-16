const express = require('express');
const router = express.Router();
var path = require('path');

const Datastore = require('nedb');
//  + ' test ' + Math.round((new Date()).getTime() / 1000)
let config = { filename: './storage/db/users.nedb', nodeWebkitAppName: 'nwtest', autoload: true, timestampData: true };
//config = {};
// const db = {
//     users: new Datastore(config)
// }

const low = require('lowdb')
const FileSync = require('lowdb/adapters/FileSync')

const adapter = new FileSync('./storage/db/users.json')
const db = low(adapter)

// Set some defaults (required if your JSON file is empty)
db.defaults({ users: [] })
  .write()

router.post('/register', async (req, res, next) => {
    let email = req.body.email;
    let password = req.body.password;

    try {
        db.get('users')
        .push({ 
            id: Date.now().toString(),
            email,
            password
        })
        .write()
    }
    catch (err) {
        console.log(err)
    }

    req.session.email = email;

    return res.json({
        message: "The email: " + email + " has registered."
    });
});

router.post('/login', (req, res, next) => {
    let email = req.body.email;
    req.session.email = email;

    // db.users.findOne({_id: email}, function (err, user) {
    //     if (err) return res.status(500).end(err);

    //     console.log(user._id)
    //     // req.session.email = email;
    //     return res.json({
    //         "message": "user "  + " signed in"
    //     });
    // });

    res.status(200).json({
        message: `can't find user with that id`
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