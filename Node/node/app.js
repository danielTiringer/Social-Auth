const express = require('express');
const authRoutes = require('./routes/auth-routes');
const profileRoutes = require('./routes/profile-routes');
const passportSetup = require('./config/passport-setup');
const db = require('./config/database');
const dotenv = require('dotenv');
const cookieSession = require('cookie-session');
const passport = require('passport');

const app = express();

dotenv.config();

const PORT = process.env.PORT || 8080;

app.set('view engine', 'ejs');
app.use(express.static(__dirname));

app.use(cookieSession({
    maxAge: 24 * 60 * 60 * 1000, // in milliseconds
    keys: [process.env.ENCRYPTION_KEY]
}));

app.use(passport.initialize());
app.use(passport.session());


app.use('/auth', authRoutes);
app.use('/profile', profileRoutes);

app.get('/', (req, res) => {
    res.render('home', { user: req.user });
});

db.connect()
    .then(() => {
        app.listen(PORT, () => {
            console.log(`Server listening to requests on port ${PORT}.`);
            console.log('MongoDB connected.');
        })
    })
