const globalResponseDTO = require('../responses/globalResponseDTO');
const registerUserRequestDTO = require('../requests/registerUserRequestDTO');
const loginUserRequestDTO = require('../requests/loginUserRequestDTO');

const registerUserValidator = require('../validators/registerUserValidator');
const authService = require('../domain/services/auth.service');
const userResponseDTO = require('../responses/userResponseDTO');

const EventEmitter = require('events');
const eventEmitter = new EventEmitter();

const catchExceptions = require('../utils/catchExceptions')

/**
 * Inserts the user into the database and fires off an email notification to that user's email if successful.
 * 
 * @param {*} req 
 * @param {*} res 
 * @param {*} next 
 * 
 * @returns globalResponseDTO
 */
const registerUser = catchExceptions(async (req, res, next) => {
  // 1. POST /api/v1/auth/register

  // 2. middleware: none

  // 3. request
  const registerUserRequest = registerUserRequestDTO(req.body);

  // 4. validation
  const registerUserValidation = registerUserValidator(registerUserRequest);

  // 5. business logic
  let user = {};
  //try {
    user = await authService.registerUser(registerUserRequest);
  //}
  //catch (err) {
  //  next(err);
  //}

  // 6. event
  eventEmitter.emit('userHasRegistered', user);

  // 7. response
  const responseDTO = userResponseDTO(user);
  return res.json(globalResponseDTO(
    status = "success",
    code = 200,
    message = `The email: ${responseDTO.email} has successfully registered.`,
    data = responseDTO,
    errors = null
  ));
});

/**
 * Logs the user in and set a session for it.
 * 
 * @param {*} req 
 * @param {*} res 
 * @param {*} next 
 */
const logUserIn = async (req, res, next) => {
  // 1. POST /api/v1/auth/login

  // 2. middleware: none

  // 3. request
  const loginUserRequest = loginUserRequestDTO(req.body);

  // 4. validation
  //const loginUserValidation = loginUserValidator(loginUserRequest);

  // 5. business logic
  // if the user's email and password match in our database then set the current session to that user
  let loggedInUser = {};
  if (await authService.loginUser(loginUserRequest)) {
    req.session.user = loginUserRequest;
    loggedInUser = loginUserRequest
  }
  else {
    // if the user does not log in successfully
    return res.json(globalResponseDTO(
      status = 'failed',
      code = 400,
      message = `Invalid credentials, please try a different email and password combination.`,
      data = {},
      errors = [
        `Invalid credentials, please try a different email and password combination.`
      ]
    ));
  }

  // 6. event
  // eventEmitter.emit('userHasLoggedIn', user);

  // 7. response
  return res.json(globalResponseDTO(
    status = 'success',
    code = 200,
    message = `The user has successfully logged in.`,
    data = loggedInUser,
    errors = null
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
  // 1. GET /api/v1/auth/logout

  // 2. middleware: none

  // 3. request

  // 4. validation

  // 5. business logic
  req.session.destroy();

  // 6. event

  // 7. response
  return res.json(globalResponseDTO(
    status = "success",
    code = 200,
    message = `The user has successfully logged out.`,
    data = {},
    errors = null
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
  // 1. GET /api/v1/auth/user

  // 2. middleware: none

  // 3. request

  // 4. validation

  // 5. business logic
  if (!req.session.user) {
    // throw exception here
  }
  const user = req.session.user;

  // 6. event

  // 7. response
  return res.json(globalResponseDTO(
    status = 'success',
    code = 200,
    message = `Here is the currently authenticated user's information.`,
    data = user,
    errors = null
  ));
}

module.exports = {
  registerUser,
  logUserIn,
  logUserOut,
  getAuthUser
};