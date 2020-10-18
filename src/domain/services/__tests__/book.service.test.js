const bookRepository = require('../../repositories/book.repository')
const bookService = require('../book.service')

beforeAll(async () => {})

beforeEach(() => {
  bookRepository.getAll = jest.fn(() => [])
  bookRepository.getById = jest.fn((id) => {})
})

afterEach(async () => {})

afterAll(async () => {})

describe('Book Service Test Suite', () => {
  it('Book Service - getAllBooks', async () => {
    await bookService.getAllBooks()

    expect(bookRepository.getAll).toHaveBeenCalledWith()
    expect(bookRepository.getAll).toHaveBeenCalledTimes(1)
    expect(bookRepository.getAll).toHaveReturnedWith([])
  })
})
