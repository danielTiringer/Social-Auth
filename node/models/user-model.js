const mongoose = require('mongoose');
const Schema = mongoose.Schema;

const userSchema = new Schema({
    username: String,
    googleId: String
});

const User = mongoose.Model('user', userSchema);

module.exports = User;
