const globalResponseDTO = require('../responses/globalResponseDTO');

/**
 * Description:
 * 
 * @param {*} req 
 * @param {*} res 
 * @param {*} next 
 */
const getAllbooks = (req, res, next) => {

  return res.json(globalResponseDTO(
    status = "success",
    code = 200,
    message = `Test mesage`,
    data = {
      message: `Test mesage`
    }
  ));
}

/**
 * Description:
 * 
 * @param {*} req 
 * @param {*} res 
 * @param {*} next 
 */
const getBookById = (req, res, next) => {
  
  return res.json(globalResponseDTO(
    status = "success",
    code = 200,
    message = `Test mesage`,
    data = {
      message: `Test mesage`
    }
  ));
}

/**
 * Description:
 * 
 * @param {*} req 
 * @param {*} res 
 * @param {*} next 
 */
const createABook = (req, res, next) => {
  
  return res.json(globalResponseDTO(
    status = "success",
    code = 200,
    message = `Test mesage`,
    data = {
      message: `Test mesage`
    }
  ));
}

/**
 * Description:
 * 
 * @param {*} req 
 * @param {*} res 
 * @param {*} next 
 */
const updateABook = (req, res, next) => {
  
  return res.json(globalResponseDTO(
    status = "success",
    code = 200,
    message = `Test mesage`,
    data = {
      message: `Test mesage`
    }
  ));
}

/**
 * Description:
 * 
 * @param {*} req 
 * @param {*} res 
 * @param {*} next 
 */
const deleteABook = (req, res, next) => {
  
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
  getAllbooks,
  getBookById,
  createABook,
  updateABook,
  deleteABook
};