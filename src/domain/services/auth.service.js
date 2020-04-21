const userRepository = require('../repositories/user.repository');

/**
 * @returns User
 */
const registerUser = async (user) => {
  return userRepository.createUser(user);
}

/**
 * @returns boolean
 */
const loginUser = async () => {
  return;
}

/**
 * @returns User
 */
const getCurrentUser = async () => {
  return;
}

module.exports = {
  registerUser,
  loginUser,
  logoutUser,
  getCurrentUser
}