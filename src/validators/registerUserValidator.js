const Validator = require('validatorjs');

/**
 * @param {*} data {
 *  email: is required
 *  password: is required
 * }
 * 
 * @returns Validator
 */
const registerUserValidation = (data) => {
  // const data = {
  //   email: 'johndoe@gmail.com',
  //   password: 'superduperpassword'
  // };
   
  const rules = {
    email: 'required|email',
    password: 'required|min:6',
    password_confirm: 'required|min:6'
  };
   
  let validation = new Validator(data, rules);
   
  // validation.passes(); // true
  // validation.fails(); // false

  if (validation.fails()) {
    // throw new Error('message', someErrorObjectsHere?)
  }

  return validation;
}

module.exports = registerUserValidation;