const globalResponseDTO = require('../responses/globalResponseDTO');

/**
 * Description:
 * 
 */
const getHealthCheck = (req, res, next) => {
  return res.status(200).json(globalResponseDTO(
    status = 'success',
    code = 200,
    message = `The application is up and running!`,
    data = {},
    errors = null
  ));
}

module.exports = {
  getHealthCheck
};