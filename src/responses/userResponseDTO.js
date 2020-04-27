function userResponseDTO(user) {
  delete user['password'];
  delete user['createdAt'];
  
  return user;
}

module.exports = userResponseDTO;