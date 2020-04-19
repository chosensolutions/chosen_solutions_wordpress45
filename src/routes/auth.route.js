const express = require('express');
const router = express.Router();

const authController = require('../controllers/auth.controller');

router.post('/register', authController.registerUser);

router.post('/login', );

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