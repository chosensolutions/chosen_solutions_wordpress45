const userRepository = require('../repositories/user.repository');

/**
 * @returns User
 */
const registerUser = async (user) => {
  const createdUser = await userRepository.createUser(user);
  return createdUser;
}

/**
 * @returns boolean
 */
const loginUser = async (user) => {
  let loginUser = await userRepository.findUserByEmailAndPassword(user);

  if (loginUser) {
    return true;
  }

  return false;
}

/**
 * @returns boolean
 */
const logoutUser = async () => {
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