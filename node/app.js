const express = require('express');
const authRoutes = require('./routes/auth-routes');
const passportSetup = require('./config/passport-setup');
const mongoose = require('mongoose');
const dotenv = require('dotenv');
const PORT = 8080;

const app = express();

dotenv.config();

app.set('view engine', 'ejs');
app.use(express.static(__dirname));
app.use('/auth', authRoutes);

app.get('/', (req, res) => {
    res.render('home');
});

mongoose.connect(process.env.MONGO_URI, () => {
    console.log(`Connected to MongoDB.`);
})

app.listen(PORT, () => {
    console.log(`Server listening to requests on port ${PORT}.`);
})
