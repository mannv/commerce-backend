const joiErrorMessage = require('../utils/joi-error-message')
const Joi = require('@hapi/joi')
const mongoose = require('mongoose')
const { categorySchema } = require('./schema/db')

const Category = mongoose.model('Category', categorySchema)

function validate (params) {
  const schema = Joi.object({
    name: Joi.string().required(),
  })

  const result = schema.validate(params, { abortEarly: false })
  return joiErrorMessage(result)
}

exports.Category = Category
exports.categoryValidate = validate