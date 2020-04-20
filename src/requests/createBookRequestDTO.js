/**
 * 
 * @return {
 *  title,
 *  description,
 * }
 */

module.exports = (input) => {
  //console.log(input['title'])
  
  if (typeof input['title'] !== 'string') {
    throw new Error(' "title" must be a string');
  }

  if (typeof input['description'] !== 'string') {
    throw new Error(' "description" must be a string');
  }

  return {
    email: input['email'],
    password: input['password']
  }
};