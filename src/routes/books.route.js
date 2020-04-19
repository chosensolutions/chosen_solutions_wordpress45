const express = require('express');
const router = express.Router();
const passport = require('passport')

router.get('/', async (req, res) => {
	res.status(200).json({
		message: 'test'
	})
});

module.exports = router