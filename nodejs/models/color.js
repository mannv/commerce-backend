const joiErrorMessage = require('../utils/joi-error-message')
const Joi = require('@hapi/joi')
const mongoose = require('mongoose')
const { colorSchema } = require('./schema/db')

const Color = mongoose.model('Color', colorSchema)

function validate (params) {
  const schema = Joi.object({
    name: Joi.string().required(),
    hex_color: Joi.string().required(),
  })

  const result = schema.validate(params, { abortEarly: false })
  return joiErrorMessage(result)
}

exports.Color = Color
exports.colorValidate = validate