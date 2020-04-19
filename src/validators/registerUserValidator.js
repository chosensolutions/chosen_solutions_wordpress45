const Validator = require('validatorjs');

// email: is required
// password: is required
// password: is rsquired and (password and password_confirm must match)
const registerUserValidation = (input) => {
  const data = {
    name: 'John',
    email: 'johndoe@gmail.com',
    age: 28
  };
   
  const rules = {
    name: 'required',
    email: 'required|email',
    age: 'min:18',
    password: 'required|min:6'
  };
   
  let validation = new Validator(data, rules);
   
  validation.passes(); // true
  validation.fails(); // false
}

module.exports = registerUserValidation;