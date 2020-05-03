// const joiErrorMessage = require('../utils/joi-error-message')
// const Joi = require('@hapi/joi')
const mongoose = require('mongoose')
const { productColorSizeSchema } = require('./schema/db')

const ProductColorSize = mongoose.model('ProductColorSize', productColorSizeSchema)

// function validate (params) {
//   const schema = Joi.object({
//     name: Joi.string().required(),
//     hex_color: Joi.string().required(),
//   })
//
//   const result = schema.validate(params, { abortEarly: false })
//   return joiErrorMessage(result)
// }

exports.ProductColorSize = ProductColorSize
// exports.colorValidate = validate