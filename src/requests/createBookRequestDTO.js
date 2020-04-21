const fields = [
  'title',
  'description'
];

const createBookRequestDTO = (input) => {
  if (typeof input['title'] !== 'string') {
    throw new Error(' "title" must be a string');
  }

  if (typeof input['description'] !== 'string') {
    throw new Error(' "description" must be a string');
  }

  return {
    email: input['title'],
    password: input['description']
  }
};

module.exports = createBookRequestDTO;