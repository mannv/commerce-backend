// const joiErrorMessage = require('../utils/joi-error-message')
// const Joi = require('@hapi/joi')
const mongoose = require('mongoose')
const { productColorSchema } = require('./schema/db')

const ProductColor = mongoose.model('ProductColor', productColorSchema)

// function validate (params) {
//   const schema = Joi.object({
//     name: Joi.string().required(),
//     hex_color: Joi.string().required(),
//   })
//
//   const result = schema.validate(params, { abortEarly: false })
//   return joiErrorMessage(result)
// }

exports.ProductColor = ProductColor
// exports.colorValidate = validate