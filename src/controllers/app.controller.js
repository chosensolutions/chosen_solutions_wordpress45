const globalResponseDTO = require('../responses/globalResponseDTO');

/**
 * Description:
 * 
 * @param {*} req 
 * @param {*} res 
 * @param {*} next 
 */
const getBookstoreById = (req, res, next) => {

  throw new Error('Could not find the bookstore!');

  return res.json(globalResponseDTO(
    status = "success",
    code = 200,
    message = `Test mesage`,
    data = {
      message: `Test mesage`
    }
  ));
}

module.exports = {
  getBookstoreById
};