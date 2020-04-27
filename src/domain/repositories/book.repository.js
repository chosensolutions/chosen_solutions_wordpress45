const Model = require('../models/book.model');

// Retrieve - all
const getAll = async () => {
  return await Model.find({});
}

// Retrieve - one
const getById = async (id) => {
  let item = await Model.findById(id);
  // console.log('item', item);
  return item;
}

// Create
const create = async (newItem) => {
  const item = new Model(newItem);
  return await item.save();
}

// Update
const updateById = async (id, book) => {
  return await Model.findByIdAndUpdate(id, book);
}

// Delete
const deleteById = async (id) => {
  return await Model.findOneAndDelete({ id });
}

module.exports = {
  getAll,
  getById,
  create,
  updateById,
  deleteById
};