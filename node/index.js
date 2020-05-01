const express = require('express')
const config = require('config')
const auth = require('./middleware/auth');
const helmet = require('helmet')
const morgan = require('morgan')
const app = express();
const debugEnv = require('debug')('app:env');

const mongoose = require('mongoose');

const mongoConfig = config.get('mongodb');
const mongoConnectString = `mongodb://${mongoConfig.server}:${mongoConfig.port}/${mongoConfig.index}`;

debugEnv(`mongoConnectString: ${mongoConnectString}`);

mongoose.connect(mongoConnectString, {useUnifiedTopology: true, useNewUrlParser: true}).then(() => {
    debugEnv('Connect to mongodb success...');
}).catch(err => debugEnv('Can\'t connect to mongodb.'))


app.use(express.json()) // for parsing application/json
app.use(express.urlencoded({extended: true})) // for parsing application/x-www-form-urlencoded

app.use(auth);
app.use(helmet());

debugEnv(`ENV: ${app.get('env')}`)

debugEnv('APP NAME', config.get('name'), {id: 1, name: "app"})
debugEnv(`APP AUTHOR: ${config.get('author')}`)


if (app.get('env') === 'development') {
    app.use(morgan('tiny'));
    debugEnv('Morgan enable...');
}

app.use(function (req, res, next) {
    Object.keys(req.query).forEach(key => {
        req.query[key] = req.query[key].trim()
    })
    console.log('trim middleware');
    next()
});

app.use('/api/students', require('./routes/students'))

app.listen('3000', () => console.log('Listening on port 3000...'));