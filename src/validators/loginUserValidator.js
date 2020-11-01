const Validator = require('validatorjs')
const ApiException = require('../utils/ApiException')

/**
 * @param {*} data {
 *  - email
 *  - password
 * }
 *
 * @returns Validator
 */
const loginUserValidator = (data) => {
  const rules = {
    email: 'required|email',
    password: 'required'
  }

  let validator = new Validator(data, rules)

  if (validator.fails()) {
    throw new ApiException({
      message: 'There were errors with the validation',
      status: 'failed',
      code: 400,
      data: null,
      errors: validator.errors.errors
    })
  }

  return validator
}

module.exports = loginUserValidator
