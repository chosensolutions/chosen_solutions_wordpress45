const registerUserRequestDTO = require('../registerUserRequestDTO');

describe('Test Suite: Request', () => {

  it('Correct request 1 - empty parameters', () => {
    // 1. Arrange
    let apiInputRequest = {}

    // 2. Act
    let registerUserRequest = registerUserRequestDTO(apiInputRequest);

    // 3. Assert
    expect(registerUserRequest).toEqual({ email: undefined, password: undefined });
  });

  it('Correct request 2 - extra useless parameters', () => {
    // 1. Arrange
    let apiInputRequest = {
      email: 'undefined', 
      password: 'undefined',
      extraParam1: null,
      extraParam2: 'whatzup',
      body: 'John Doe is cool'
    }
    // 2. Act
    let registerUserRequest = registerUserRequestDTO(apiInputRequest);

    // 3. Assert
    expect(registerUserRequest).toEqual({ email: 'undefined', password: 'undefined' });
  });

  it('Correct request 3 - happy path', () => {
    // 1. Arrange
    let apiInputRequest = {
      email: 'yichen@yichen.com', 
      password: 'yichen-and-his-awesome-password',
    }
    // 2. Act
    let registerUserRequest = registerUserRequestDTO(apiInputRequest);

    // 3. Assert
    expect(registerUserRequest).toEqual({
      email: 'yichen@yichen.com', 
      password: 'yichen-and-his-awesome-password',
    });
  });


  it('Correct request 4 - we input in the wrong format, some random string format', () => {
    // 1. Arrange
    let apiInputRequest = 'this is awesome!';

    // 2. + 3. Act and Assert
    expect(() => {
      let registerUserRequest = registerUserRequestDTO(apiInputRequest);
    }).toThrow(Error);
  });
});