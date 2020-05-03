// const joiErrorMessage = require('../utils/joi-error-message')
// const Joi = require('@hapi/joi')
const mongoose = require('mongoose')
const { productSchema } = require('./schema/db')

const Product = mongoose.model('Product', productSchema)

// function validate (params) {
//   const schema = Joi.object({
//     name: Joi.string().required(),
//     hex_color: Joi.string().required(),
//   })
//
//   const result = schema.validate(params, { abortEarly: false })
//   return joiErrorMessage(result)
// }

exports.Product = Product
// exports.colorValidate = validate