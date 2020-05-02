const _ = require('lodash')
const express = require('express')
const router = express.Router()
const { User, userValidate } = require('../models/user')

router.post('/', async (req, res) => {

  const error = userValidate(req.body)
  if (error) {
    return res.status(442).send(error)
  }

  let user = await User.findOne({ email: req.body.email })
  if (user) {
    return res.status(400).send('User already registered.')
  }

  user = new User(_.pick(req.body, ['name', 'email', 'password']))
  await user.save()

  const token = user.generateAuthToken()
  res.header('x-auth-token', token).
    send(_.pick(user, ['name', 'email', 'password']))
})

router.get('/:id', async (req, res) => {
  const user = await User.findById(req.params.id)
  if (!user) {
    return res.status(404).send('User not found.')
  }
  res.send(user);
})

module.exports = router