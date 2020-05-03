const express = require('express')
const router = express.Router()
const { Product } = require('../models/product')
router.get('/', async (req, res) => {
  const result = await Product.find({}).skip(0).limit(15);
  res.send(result)
})

module.exports = router