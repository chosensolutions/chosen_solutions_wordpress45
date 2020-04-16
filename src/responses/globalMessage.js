/**
 * 
 * @param {*} status Number
 * @param {*} code Number
 * @param {*} message String
 * @param {*} data Object
 */
function responseJSON(status, code, message, data) {
  return {
    status,
    code,
    message,
    data
  }
}