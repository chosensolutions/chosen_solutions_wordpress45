const userRepository = require('../../repositories/user.repository');
const authService = require('../auth.service');

beforeAll(async () => {

});

afterEach(async () => {

});

afterAll(async () => {

});

describe('Test Suite: Auth Service', () => {

  it('Auth Service - registerUser', async () => {
    const user = await authService.registerUser();

    console.log(user);
  });

  it('Auth Service - loginUser', async () => {
    const user = await authService.loginUser({});

    console.log(user);
  });

  it('Auth Service - logoutUser', async () => {
    const user = await authService.logoutUser();

    console.log(user);
  });

  it('Auth Service - getCurrentUser', async () => {
    const user = await authService.getCurrentUser();

    console.log(user);
  });

});