// const joiErrorMessage = require('../utils/joi-error-message')
// const Joi = require('@hapi/joi')
const mongoose = require('mongoose')
const { productSchema } = require('./schema/db')
const BaseModel = require('./base-model')
const config = require('config')

const Product = mongoose.model('Product', productSchema)

class ProductModel extends BaseModel {
  async getByCategory (id, page, sort) {

    const limit = config.get('pagination.limit')
    const skip = (page - 1) * limit

    const condition = {
      'category._id': mongoose.Types.ObjectId(id),
    }

    let sortBy = { _id: -1 }

    if (sort === 'price_desc') {
      sortBy = { price: -1 }
    }
    if (sort === 'price_asc') {
      sortBy = { price: 1 }
    }

    return await this.model.find(condition).
      skip(skip).
      limit(limit).
      sort(sortBy).
      select('-category -__v -description -colors.sizes')
  }
}

// function validate (params) {
//   const schema = Joi.object({
//     name: Joi.string().required(),
//     hex_color: Joi.string().required(),
//   })
//
//   const result = schema.validate(params, { abortEarly: false })
//   return joiErrorMessage(result)
// }

exports.ProductModel = new ProductModel(Product)
// exports.colorValidate = validate