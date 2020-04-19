const bookRepository = require('../book.repository');

describe('Test Suite: Repositories', () => {

  it('Repository - Book', () => {
    // 1. Arrange
    let newBook = {
      id: 1,
      title: 1,
      description: 1,
      price: 1,
      author: 1,
      datePublished: 1
    }

    // 2. Act
    let book = bookRepository.createBook(newBook);

    console.log(book);

    // 3. Assert
    // expect(registerUserRequest).toEqual({ email: undefined, password: undefined });
  });

});