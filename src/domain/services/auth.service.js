const userRepository = require('../repositories/user.repository');

/**
 * @returns User
 */
const registerUser = (user) => {
  return userRepository.createUser(user);
}

/**
 * @returns boolean
 */
const loginUser = () => {
  return;
}

const getCurrentUser = () => {
  return;
}

module.exports = {
  registerUser,
  loginUser,
  logoutUser,
  getCurrentUser
}