const globalResponseDTO = require('../responses/globalResponseDTO');

const bookPermission = (req, res, next) => {
    /*
    When updating or deleting a book, the book must belong to the user that created it
    */
    // let bookId = req.params.bookId;
    // let book = bookService.getByBookId(bookId);
    // if (req.session.user.id === book.userId) {
    //     next();
    // }

    // return res
    //     .status(401)
    //     .json(globalResponseDTO(
    //         status = 'failed',
    //         code = 401,
    //         message = 'Access denied: you must be the owner of this book when updating or deleting it.',
    //         data = {},
    //         errors = [
    //             'Access denied: you must be the owner of this book when updating or deleting it.',
    //         ]
    //     ));
};

module.exports = bookPermission;