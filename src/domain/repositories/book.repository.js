const Model = require('../models/book.model');

// Retrieve - all
const getAll = async () => {
  return await Model.find({});
}

// Retrieve - one
const getById = async (id) => {
  return await Model.find({ id });
}

// Create
const create = async (newItem) => {
  const item = new Model(newItem);
  return await item.save();
}

// Update
const updateById = async (id, book) => {
  return await Model.find({ id }).save(book);
}

// Delete
const deleteById = async (id) => {
  return await Model.find({ id }).remove();
}

module.exports = {
  getAll,
  getById,
  create,
  updateById,
  deleteById
};