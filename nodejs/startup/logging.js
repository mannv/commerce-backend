const config = require('config')
const winston = require('winston')
require('winston-mongodb')
// require('express-async-errors');

module.exports = () => {
  // winston.handleExceptions(
  //   new winston.transports.File({ filename: 'uncaughtExceptions.log' }));
  //
  // process.on('unhandledRejection', (ex) => {
  //   throw ex;
  // });

  const options = {
    level: config.get('log_level'),
    db: config.get('mongodb_connection'),
    filename: 'logs/mongodb.log',
  }
  winston.add(new winston.transports.MongoDB(options))

  winston.add(new winston.transports.File({
    level: config.get('log_level'),
    filename: 'logs/node.log',
  }))

  winston.add(new winston.transports.File({
    level: 'error',
    filename: 'logs/error.log',
  }))
}
