const UserModel = require('../models/user.model');

/**
 * 
 * @param {*} user {
 *  - name
 *  - email
 *  - password
 * }
 * 
 * @returns user
 */
const createUser = async (userData) => {
  let user = new UserModel(userData)
  let userReturn = await user.save(userData);

  return userReturn;
}

/**
 * 
 * @param {*} user {
 *  - name
 *  - email
 *  - password
 * }
 * 
 * @returns boolean
 */
const checkIfUserExistsByEmailAndPassword = async (userData) => {
  const foundUser = await User.findOne(userData);
  
  if (foundUser) {
    return true;
  }
}

/**
 * 
 * @param {*} id
 * 
 * @returns user
 */
const getUserById = async (id) => {
  const foundUser = await User.findOne({ id });
  return foundUser;
}

module.exports = {
  createUser,
  checkIfUserExistsByEmailAndPassword,
  getUserById
}
