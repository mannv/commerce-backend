const mongoose = require('mongoose');

exports.ClassRoom = mongoose.model('class_room', mongoose.Schema({
    id: Number,
    name: String,
    created_at: {type: Date, default: Date.now}
}))

exports.Student = mongoose.model('student', mongoose.Schema({
    id: Number,
    name: String,
    email: String,
    class_room: [Number],
    created_at: {type: Date, default: Date.now}
}))

