const event = require('../userHasRegisteredEvent');

describe('userHasRegisteredEvent', () => {
  it('test the function', () => {
    let user = {
      name: 'John'
    }
    event(user);
  });
})




