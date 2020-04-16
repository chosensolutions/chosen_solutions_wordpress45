const fetch = require('node-fetch');
const api = require('../src/server');

const apiPort = Math.round(Math.random() * 65535);
const baseURL = `http://localhost:${apiPort}/api/v1`;

beforeAll(async () => {
  await api.listen(apiPort);
})

describe('Books API', () => {

  it('Get /api/v1/books', async () => {
    let response = await (await fetch(`${baseURL}/books`)).json();

    expect(response).toEqual({
      message: 'The email: yichenzhu1337@gmail.com3 has registered.',
      data: [
        {
          id: 1,
          user_id: 1,
          title: 'Harry Potter and the Order of the Phoenix',
          description: 'Buy my book! It\'s awesome!',
          price: 100,
        },
        {
          id: 2,
          user_id: 1,
          title: 'Harry Potter and the Chamber of Secrets',
          description: 'Buy my book! It\'s awesome!',
          price: 90,
        },
        {
          id: 3,
          user_id: 1,
          title: 'Harry Potter and the Half Blood Prince',
          description: 'Buy my book! It\'s awesome!',
          price: 80,
        },
      ]
    });
  });

  xit('Get /api/v1/books/1', async () => {
    let response = await (await fetch(`${baseURL}/books`)).json();

    expect(response).toEqual({
      message: 'The email: yichenzhu1337@gmail.com3 has registered.',
      data: {
        id: 1,
        user_id: 1,
        title: 'Harry Potter and the Order of the Phoenix',
        description: 'Buy my book! It\'s awesome!',
        price: 100,
      }
    });
  });

  xit('POST /api/v1/books', async () => {
    let response = await (await fetch(`${baseURL}/books`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({
        title: 'Harry Potter and the Order of the Phoenix',
        description: 'Buy my book! It\'s awesome!',
        price: 100
      })
    })).json();

    expect(response).toEqual({
      message: 'Book created successful!',
      data: {
        title: 'Harry Potter and the Order of the Phoenix',
        description: 'Buy my book! It\'s awesome!',
        price: 100
      }
    });
  });

  xit('PUT /api/v1/books/1', async () => {
    let response = await (await fetch(`${baseURL}/books`, {
      method: 'PUT',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({
        title: 'Harry Potter and the Order of the Phoenix - new version',
        description: 'Buy my book! This is now super awesome!',
        price: 999
      })
    })).json();

    expect(response).toEqual({
      message: 'Book updated successfully!',
      data: {
        title: 'Harry Potter and the Order of the Phoenix - new version',
        description: 'Buy my book! This is now super awesome!',
        price: 999
      }
    });
  });

  xit('DELETE /api/v1/books/1', async () => {
    let response = await (await fetch(`${baseURL}/books/1`, { method: 'DELETE' })).json();

    expect(response).toEqual({
      message: 'Book deleted successfully!',
      data: {

      }
    })
  });

});

afterAll(async () => {
  await api.close();
})
