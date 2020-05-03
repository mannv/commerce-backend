const joiErrorMessage = require('../utils/joi-error-message')
const Joi = require('@hapi/joi')
const mongoose = require('mongoose')
const { sizeSchema } = require('./schema/db')

const Size = mongoose.model('Size', sizeSchema)

function validate (params) {
  const schema = Joi.object({
    name: Joi.string().required(),
  })

  const result = schema.validate(params, { abortEarly: false })
  return joiErrorMessage(result)
}

exports.Size = Size
exports.sizeValidate = validate