const globalResponseDTO = require('../responses/globalResponseDTO');
const ApiException = require('../utils/ApiException');
/**
 * Description:
 * 
 * @param {*} req 
 * @param {*} res 
 * @param {*} next 
 */
const getHealthCheck = (req, res, next) => {
//  try {
  // throw new ApiException(
  //   status = "failed",
  //   code = 509,
  //   message = "Health Check Failed",
  //   data = {}
  // );
  // }catch(err) {
  //   console.log('error from health check', err)
  // }
  // throw new Error('Could not find the bookstore!');

  return res.status(200).json(globalResponseDTO(
    status = "success",
    code = 200,
    message = `Test mesage`,
    data = {
      message: `Test mesage`
    }
  ));
}

module.exports = {
  getHealthCheck
};