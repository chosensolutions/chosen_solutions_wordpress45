const globalResponseDTO = require('../responses/globalResponseDTO');
const registerUserRequestDTO = require('../requests/registerUserRequestDTO');
const registerUserValidator = require('../validators/registerUserValidator');
const authService = require('../domain/services/auth.service');
const userResponseDTO = require('../responses/userResponseDTO');

var EventEmitter = require('events').EventEmitter();

/**
 * Inserts the user into the database and fires off an email notification to that user's email if successful.
 * 
 * @param {*} req 
 * @param {*} res 
 * @param {*} next 
 * 
 * @returns globalResponseDTO
 */
const registerUser = async (req, res, next) => {
  // 2. request
  const registerUserRequest = registerUserRequestDTO(req.body);

  // 4. validation
  const registerUserValidator = registerUserValidator(registerUserRequest);

  // 5. business logic
  const user = authService.registerUser(registerUserRequest);

  // 6. event
  EventEmitter.emit('userHasRegistered', user);

  // 7. response
  const responseDTO = userResponseDTO(user);
  return res.json(globalResponseDTO(
    status = "success",
    code = 200,
    message = `The email: ${responseDTO.email} has successfully registered.`,
    data = responseDTO
  ));
}

/**
 * Logs the user in and set a session for it.
 * 
 * @param {*} req 
 * @param {*} res 
 * @param {*} next 
 */
const logUserIn = (req, res, next) => {
  let { email } = req.session.user;

  // if the user's email and password match in our database then set the current session to that user
  req.session.user = {};

  return res.json(globalResponseDTO(
    status = "success",
    code = 200,
    message = `The email: ${email} has successfully logged in.`,
    data = user
  ));
}

/**
 * Logs the currently authenticated user out of the current session.
 * 
 * @param {*} req 
 * @param {*} res 
 * @param {*} next 
 */
const logUserOut = (req, res, next) => {
  const user = (req.session.user) ? user = userResponseDTO(req.session.user) : {};

  req.session.destroy();

  return res.json(globalResponseDTO(
    status = "success",
    code = 200,
    message = `The user has successfully logged out.`,
    data = user
  ));
}

/**
 * Gets the currently authenticated user in the current session.
 * 
 * @param {*} req 
 * @param {*} res 
 * @param {*} next 
 */
const getAuthUser = (req, res, next) => {
  let user;

  if (!req.session.user) {

  }

  user = userResponseDTO(req.session.user)

  return res.json(globalResponseDTO(
    status = "success",
    code = 200,
    message = `The currently authenticated user's session for user: ${user.email}.`,
    data = user
  ));
}

module.exports = {
  registerUser,
  logUserIn,
  logUserOut,
  getAuthUser
};