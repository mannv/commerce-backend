module.exports = function (result) {
  let errors = null
  if (result.error) {
    errors = {}
    result.error.details.forEach(item => {
      errors[item.context.key] = item.message
    })
  }
  return errors
}