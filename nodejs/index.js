const express = require('express')
require('express-async-errors')
const app = express()

const error = require('./middleware/error')
// const convert = require('./routes/convert')
const categories = require('./routes/categories')
const users = require('./routes/users')
const products = require('./routes/products')

require('./startup/db')()
require('./startup/logging')()

app.use(express.json()) // for parsing application/json
app.use(express.urlencoded({ extended: true })) // for parsing
                                                // application/x-www-form-urlencoded

app.use(express.static('public'))

app.use('/api/categories', categories)
app.use('/api/users', users)
app.use('/api/products', products)
// app.use('/api/convert', convert)

app.use(error)

app.listen(3000, () => console.log('Listening on port 3000'))
