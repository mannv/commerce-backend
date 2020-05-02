const joiErrorMessage = require('../utils/joi-error-message')
const Joi = require('@hapi/joi')
const mongoose = require('mongoose')
const { userSchema } = require('./schema/db')

const User = mongoose.model('User', userSchema)

function validate (params) {
  const schema = Joi.object({
    name: Joi.string().required(),
    email: Joi.string().email().required(),
    password: Joi.string().required(),
  })

  const result = schema.validate(params, { abortEarly: false })
  return joiErrorMessage(result)
}

exports.User = User
exports.userValidate = validate