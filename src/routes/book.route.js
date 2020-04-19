const express = require('express');
const router = express.Router();

const bookController = require('../controllers/book.controller');

router.get('/', bookController.getAllbooks);
router.get('/:id', bookController.getBookById);
router.post('/', bookController.createABook);
router.put('/:id', bookController.updateABook);
router.delete('/:id', bookController.deleteABook);

module.exports = router