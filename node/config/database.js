const mongoose = require('mongoose');

const {
  MONGO_USERNAME,
  MONGO_PASSWORD,
  MONGO_HOSTNAME,
  MONGO_PORT,
  MONGO_DB
} = process.env;

const options = {
    useNewUrlParser: true,
    useUnifiedTopology: true
};

const url = `mongodb://${MONGO_USERNAME}:${MONGO_PASSWORD}@${MONGO_HOSTNAME}:${MONGO_PORT}/${MONGO_DB}?authSource=admin`;

async function connect() {
    await mongoose.connect(url, options)
        .then((_, err) => {
            if (err) return (err);
        })
        .catch(err => console.log(err))
}

async function close() {
    return mongoose.disconnect();
}

module.exports = { connect, close };
