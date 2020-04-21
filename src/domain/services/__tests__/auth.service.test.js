const authService = require('../auth.service');

beforeAll(async () => {

});

afterEach(async () => {

});

describe('Test Suite: Auth Service', () => {

  xit('Auth Service - registerUser', async () => {
    const user = await authService.registerUser();

    console.log(user);
  });

});

afterAll(async () => {

});