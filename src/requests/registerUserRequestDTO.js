const fields = [
  'first_name',
  'last_name',
  'email',
  'password',
  'password_confirmation',
  'phone_number'
];

registerUserRequestDTO = (input) => {
  if (typeof input['email'] != 'string') {
    throw new Error('Yo gotta give us that json!');
  }

  return {
    email: input.email,
    password: input.password,
    password_confirmation: input.password_confirmation
  }
}

module.exports = registerUserRequestDTO;