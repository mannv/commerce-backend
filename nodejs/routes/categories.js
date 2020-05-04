const express = require('express')
const router = express.Router()
const { CategoryModel } = require('../models/category')
const { ProductModel } = require('../models/product')
const wrapper = require('../modules/data-wrapper')
const _ = require('lodash')

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
  const sort = req.query.sort || ''
  let products = await ProductModel.getByCategory(id, page, sort)

  products = _.map(products, function (item) {
    let obj = JSON.parse(JSON.stringify(item))
    let images = []
    obj.colors.forEach(colorItem => {
      const coverImage = _.find(colorItem.images, img => img.cover_image === 1)
      images.push(coverImage)
    })
    _.unset(obj, 'colors')
    _.set(obj, 'images', images)
    return obj
  })

  return wrapper.success(res, { category, products })
})

module.exports = router