function auth(req, res, next) {
    console.log('check auth')
    next();
}

module.exports = auth;