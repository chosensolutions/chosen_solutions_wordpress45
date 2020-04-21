const globalResponseDTO = require('../responses/globalResponseDTO');
const createBookRequestDTO = require('../requests/createBookRequestDTO');
const bookService = require('../domain/services/book.service');
const bookResponseDTO = require('../responses/bookResponseDTO');

/**
 * Description:
 * 
 * @param {*} req 
 * @param {*} res 
 * @param {*} next 
 */
const getAllbooks = (req, res, next) => {

  let books = bookService.getAllBooks();

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
  const book = bookService.getBookById(req.param.id);

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
  const newBook = createBookRequestDTO(req.body);

  const book = bookService.createBook(req.body);

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
  const book = bookService.updateBookById(req.param.id, req.body);

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
  const book = bookService.deleteBookById(req.param.id);

  const bookDTO = bookResponseDTO(book);

  return res.json(globalResponseDTO(
    status = "success",
    code = 200,
    message = `The book with the id: ${bookDTO.id} was successfully deleted.`,
    data = {
      message: `The book with the id: ${bookDTO.id} was successfully deleted.`
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