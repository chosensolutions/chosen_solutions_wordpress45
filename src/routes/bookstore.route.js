const express = require('express');
const router = express.Router();

const bookstoreController = require('../controllers/bookstore.controller');

router.get('/', bookstoreController.getBookstoreById);

module.exports = router;