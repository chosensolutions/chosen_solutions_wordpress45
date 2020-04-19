const userRepository = require('../user.repository');
const db = require('../../../utils/db');

beforeAll(() => {
  db.set('users', [])
    .write()
});

describe('Test Suite: User Repository', () => {
  let testUser = {

  };

  it('User Repository - createUser', () => {
    let user = userRepository.createUser(testUser);

    console.log(user);
  });

  it('user Repository - checkIfUserExistsByEmailAndPassword', () => {
    let user = userRepository.checkUserIfExistsByEmailAndPassword(testUser);

    console.log(user);
  });

  it('user Repository - getUserById', () => {
    let user = userRepository.getUserById(testUser);

    console.log(user);
  });

});