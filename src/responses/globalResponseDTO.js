/**
 * 
 * @param {*} status Number
 * @param {*} code Number
 * @param {*} message String
 * @param {*} data Object
 */
function globalResponseDTO(status, code, message, data) {
  return {
    status,
    code,
    message,
    data
  }
}

module.exports = globalResponseDTO;