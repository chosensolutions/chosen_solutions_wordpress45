const loginUserRequestDTO = require('../loginUserRequestDTO');
const ApiException = require('../../utils/ApiException');

describe('Test Suite: Request', () => {

  it('Correct request 1 - happy path', () => {
    // 1. Arrange
    let data = {
      email: 'yichen@yichen.com',
      password: 'password123',
    }

    // 2. Act
    let loginUserRequest = loginUserRequestDTO(data);

    // 3. Assert
    expect(loginUserRequest).toEqual({
      email: 'yichen@yichen.com',
      password: 'password123',
    });
  });

  it('Correct request 2 - empty parameters', () => {
    // 1. Arrange
    let data = {}

    // 2. Act
    // 3. Assert
    expect(() => {
      let loginUserRequest = loginUserRequestDTO(data);
    }).toThrow(ApiException);
  });

});