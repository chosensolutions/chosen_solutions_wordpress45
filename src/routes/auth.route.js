const express = require('express');
const router = express.Router();

const authController = require('../controllers/auth.controller');

router.post('/register', authController.registerUser);
router.post('/login', authController.logUserIn);
router.get('/logout', authController.logUserOut);
router.get('/me', authController.getAuthUser);

module.exports = router;