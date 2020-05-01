const config = require('config')
const debugEnv = require('debug')('app:env');
const mongoose = require('mongoose');

const Student = require('./modules/model').Student;

const mongoConfig = config.get('mongodb');
const mongoConnectString = `mongodb://${mongoConfig.server}:${mongoConfig.port}/${mongoConfig.index}`;

debugEnv(`mongoConnectString: ${mongoConnectString}`);

mongoose.connect(mongoConnectString, {useUnifiedTopology: true, useNewUrlParser: true}).then(() => {
    debugEnv('Connect to mongodb success...');
}).catch(err => debugEnv('Can\'t connect to mongodb.'))


async function createStudent() {
    const std = new Student({
        id: 2,
        name: 'Ha Anh Man',
        email: 'anhmantk@gmail.com',
        class_room: [1, 2]
    });
    console.log('Before save student');

    const result = await std.save();
    console.log(result)

    console.log('After save student');
}

async function getStudents() {
    const result = await Student.find().limit(2).sort({id: -1})
        .select('-__v -_id id name');
    console.log('result', result);
}

getStudents();
// createStudent();

