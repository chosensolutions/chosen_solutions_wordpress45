/**
 * 
 * @return {
 *  email,
 *  password
 * }
 */
registerUserRequestDTO = (input) => {
  if (typeof input != 'object') {
    throw new Error('Yo gotta give us that json!');
  }

  return {
    email: input.email,
    password: input.password
  }
}

module.exports = registerUserRequestDTO;