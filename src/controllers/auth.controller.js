const globalResponseDTO = require('../responses/globalResponseDTO');
const registerUserRequestDTO = require('../requests/registerUserRequestDTO');
const registerUserValidator = require('../validators/registerUserValidator');
const userService = require('../domain/services/auth.service');

// Import events module and Create an eventEmitter object
var events = require('events');
var eventEmitter = new events.EventEmitter();

const registerUser = async (req, res, next) => {
  // 2. request
  const registerUserRequest = registerUserRequestDTO(req.body);

  // 4. validation
  const registerUserValidator = registerUserValidator(registerUserRequest);

  // 5. business logic
  const user = userService.registerUser(registerUserRequest);

  // 6. event
  eventEmitter.emit('userHasRegistered');

  // 7. response
  return res.json(globalResponseDTO(
    status = "success",
    code = 200,
    message = `The email: ${email} has successfully registered.`,
    data = user
  ));
}

module.exports = {
  registerUser
};