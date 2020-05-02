const mongoose = require('mongoose')
const jwt = require('jsonwebtoken')
const config = require('config')
const Category = mongoose.Schema({
  name: {
    type: String,
    required: true,
  },
  image: String,
})

const Color = mongoose.Schema({
  name: {
    type: String,
    required: true,
  },
  hex_color: {
    type: String,
    required: true,
  },
})

const Size = mongoose.Schema({
  name: {
    type: String,
    required: true,
  },
})

const ProductColor = mongoose.Schema({
  size: Size,
  sku: {
    type: String,
    required: true,
  },
  quantity: {
    type: Number,
    required: true,
  },
  images: [String],
})

const Product = mongoose.Schema({
  category: {
    type: Category,
  },
  name: {
    type: String,
    required: true,
  },
  price: {
    type: Number,
    required: true,
  },
  price_old: {
    type: Number,
    default: 0,
  },
  description: String,
  colors: [ProductColor],
})

exports.categorySchema = Category
exports.colorSchema = Color
exports.sizeSchema = Size
exports.productSchema = Product
exports.productColorSchema = ProductColor

const User = mongoose.Schema({
  name: {
    type: String,
    required: true,
  },
  email: {
    type: String,
    required: true,
    unique: true,
  },
  password: {
    type: String,
    required: true,
  },
})
User.methods.generateAuthToken = function () {
  const token = jwt.sign({ _id: this._id }, config.get('jwtPrivateKey'))
  return token
}
exports.userSchema = User
