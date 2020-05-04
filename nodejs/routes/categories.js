const express = require('express')
const router = express.Router()
const { CategoryModel } = require('../models/category')
const { ProductModel } = require('../models/product')
const wrapper = require('../modules/data-wrapper')

router.get('/', async (req, res) => {
  const result = await CategoryModel.getAll({ _id: 1 })
  return wrapper.success(res, result)
})

router.get('/:id/products', async (req, res) => {
  const { id } = req.params

  const category = await CategoryModel.getById(id)

  if (!category) {
    return wrapper.error(res, 'Khong tim thay danh muc')
  }

  const page = req.query.page || 1
  const sort = req.query.sort || '';
  const products = await ProductModel.getByCategory(id, page, sort)

  return wrapper.success(res, { category, products })
})

module.exports = router