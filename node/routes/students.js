const express = require('express')
const router = express.Router();
const _ = require('lodash');
const Joi = require('@hapi/joi');

const students = [
    {id: 1, name: "Nguyen Van A", email: "nguyenvana@gmail.com"},
    {id: 2, name: "Nguyen Van B", email: "nguyenvanb@gmail.com"},
    {id: 3, name: "Nguyen Van C", email: "nguyenvanc@gmail.com"},
    {id: 4, name: "Nguyen Van D", email: "nguyenvand@gmail.com"},
]

router.get('/', (req, res) => {
    console.log('query:', req.query);
    res.send(students);
})

router.get('/:id', (req, res) => {
    const student = _.find(students, item => item.id === parseInt(req.params.id))
    if (!student) {
        res.status(404).send('Khong tim thay du lieu')
    }
    res.send(student);
})

router.post('/', (req, res) => {

    const schema = Joi.object({
        name: Joi.string().min(3).max(10).required(),
        email: Joi.string().email().required()
    });

    // const validateResult = schema.validate(req.body);
    const validateResult = schema.validate(req.body, {abortEarly: false});
    if (validateResult.error) {
        let errors = {};
        validateResult.error.details.forEach(item => {
            errors[item.context.key] = item.message
        })
        res.status(442).send(errors);
        return;
    }

    let student = {
        id: students.length + 1,
        name: req.body.name,
        email: req.body.email
    }
    res.send(student);
});

module.exports = router;

