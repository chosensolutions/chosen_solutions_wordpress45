const express = require('express');
const router = express.Router();
var path = require('path');
const globalResponseDTO = require('../responses/globalResponseDTO');
const low = require('lowdb')
const FileSync = require('lowdb/adapters/FileSync')

const adapter = new FileSync('./storage/db/users.json')
const db = low(adapter)

// Set some defaults (required if your JSON file is empty)
db.defaults({ users: [] })
    .write()

router.post('/register', async (req, res, next) => {
    // let registerUserDTO = registerUserDTO(req.body);

    // let { email, password } = registerUserDTO;

    // let validator.validateInput({ email, password });

    let user = {
        id: Date.now().toString(),
        email,
        password
    };
    // let userResponse = userService.registerUser(user);

    // event.emit('userHasRegistered')

    try {
        db.get('users')
            .push(user)
            .write()
    }
    catch (err) {
        console.log(err)
    }

    req.session.email = email;

    return res.json(globalResponseDTO(
        status = "success",
        code = 200,
        message = `The email: ${email} has registered.`,
        data = user
    ));
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