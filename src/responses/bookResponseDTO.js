/**
 * Description: ...
 * 
 * @param {*} status Number
 * @param {*} code Number
 * @param {*} message String
 * @param {*} data Object
 */
function bookResponseDTO(status, code, message, data) {
  return {
    status,
    code,
    message,
    data
  }
}

module.exports = bookResponseDTO;