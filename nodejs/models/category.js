const joiErrorMessage = require('../utils/joi-error-message')
const Joi = require('@hapi/joi')
const mongoose = require('mongoose')
const { categorySchema } = require('./schema/db')
const BaseModel = require('./base-model')

const Category = mongoose.model('Category', categorySchema)

class CategoryModel extends BaseModel {}

function validate (params) {
  const schema = Joi.object({
    name: Joi.string().required(),
  })

  const result = schema.validate(params, { abortEarly: false })
  return joiErrorMessage(result)
}

exports.CategoryModel = new CategoryModel(Category)
exports.categoryValidate = validate