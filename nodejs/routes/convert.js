const express = require('express')
const router = express.Router()
const _ = require('lodash')

const knex = require('knex')({
  client: 'mysql',
  connection: {
    host: 'mysql',
    user: 'default',
    password: '123456',
    database: 'db_web',
  },
})

const { Category } = require('../models/category')
const { Color } = require('../models/color')
const { Size } = require('../models/size')
const { Product } = require('../models/product')
const { ProductColor } = require('../models/product-color')
const { ProductColorSize } = require('../models/product-color-size')

let msg = []

const convertCategory = async () => {
  await knex.select().table('categories').then(rows => {
    if (rows.length == 0) {
      return
    }

    rows.forEach(async (item) => {
      let cate = new Category(_.pick(item, ['name', 'image']))
      await cate.save()
    })

    msg.push('Category convert: ' + rows.length)
  })
}

const convertColor = async () => {
  await knex.select().table('colors').then(rows => {
    if (rows.length == 0) {
      return
    }

    rows.forEach(async (item) => {
      let color = new Color(_.pick(item, ['name', 'hex_color']))
      await color.save()
    })

    msg.push('Color convert: ' + rows.length)
  })
}

const sizeConvert = async () => {
  await knex.select().table('sizes').then(rows => {
    if (rows.length == 0) {
      return
    }

    rows.forEach(async (item) => {
      let size = new Size(_.pick(item, ['name']))
      await size.save()
    })

    msg.push('Size convert: ' + rows.length)
  })
}

const getProductColor = async (productId) => {
  let result = []
  await knex.select().
    table('product_groups').
    where({ product_id: productId }).
    then(rows => {
      result = rows
    })
  return result
}

const getProductColorSize = async (productColorId) => {
  let result = []
  await knex.select().
    table('product_group_sizes').
    where({ product_group_id: productColorId }).
    then(rows => {
      result = rows
    })
  return result
}

const getProductColorImage = async (productColorId) => {
  let result = []
  await knex.select(['image', 'cover_image']).
    table('product_group_images').
    where({ product_group_id: productColorId }).
    then(rows => {
      result = rows
    })
  return result
}

const convertProduct = async () => {
  const listCategory = await Category.find({}).select('-__v')
  const listColor = await Color.find({}).select('-__v')
  const listSize = await Size.find({}).select('-__v')

  await knex.select().
    table('products').
    then(async (rows) => {
      if (rows.length == 0) {
        return
      }

      await Promise.all(rows.map(async (item) => {
        let colors = []

        const productColor = await getProductColor(item.id)
        if (productColor.length > 0) {
          await Promise.all(productColor.map(async (row) => {
            const images = await getProductColorImage(row.id)
            const sizeResult = await getProductColorSize(row.id)
            let sizes = []

            if (sizeResult.length > 0) {
              sizeResult.forEach(rowItem => {
                let pColorSize = new ProductColorSize({
                  size: _.find(listSize, x => x.name === rowItem.size_name),
                  sku: rowItem.sku,
                  quantity: rowItem.quantity,
                })
                sizes.push(pColorSize)
              })
            }

            let pColor = new ProductColor({
              color: _.find(listColor, x => x.name === row.color_name),
              sizes: sizes,
              images: images,
            })
            colors.push(pColor)
          }))
        }

        let pro = new Product({
          category: _.find(listCategory, x => x.name === item.cate_name),
          name: item.name,
          price: item.price,
          price_old: item.price_old,
          description: item.description,
          colors: colors,
        })
        await pro.save()
      }))
      msg.push('Size Product: ' + rows.length)
    })
}

router.get('/', async (req, res) => {
  await convertCategory()
  await convertColor()
  await sizeConvert()
  await convertProduct()
  res.send(msg.join('<br />'))
})

module.exports = router