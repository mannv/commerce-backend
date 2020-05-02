const winston = require('winston')
const mongoose = require('mongoose')
const config = require('config')

module.exports = function () {
  const options = { useUnifiedTopology: true, useNewUrlParser: true }
  mongoose.connect(config.get('mongodb_connection'), options).
    then(() => winston.info('Connected to MongoDB...'))
}