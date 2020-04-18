const express = require('express');
const getAuthRouter = require('./auth.route');
const getListItemsRoutes = require('./test.route');
const router = express.Router()

function getRouter() {
  router.use('/auth', getAuthRouter);
  router.use('/test', getListItemsRoutes);

  return router;
}

module.exports = getRouter;

