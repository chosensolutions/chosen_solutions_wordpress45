const globalResponseDTO = require('../responses/globalResponseDTO');

/**
 * Description:
 * 
 * @param {*} req 
 * @param {*} res 
 * @param {*} next 
 */
const getBookstoreById = async (req, res, next) => {

  try {
    throw new Error('Could not find todo!');

    return res.json(globalResponseDTO(
      status = "success",
      code = 200,
      message = `Test mesage`,
      data = {
        message: `Test mesage`
      }
    ));
  } catch (e) {
    next(e);
  }
}

module.exports = {
  getBookstoreById
};