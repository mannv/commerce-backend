const express = require('express');
const router = express.Router();

router.get('/', (req, res) => {
    res.send('List categories');
});

router.get('/demo', (req, res) => {
    res.send('List categories - demo');
});

module.exports = router;