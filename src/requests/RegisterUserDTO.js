/**
 * 
 * @return {
 *  email,
 *  password
 * }
 */
function RegisterUserDTO(input) {
  return {
    email: input.email,
    password: input.password
  }
}