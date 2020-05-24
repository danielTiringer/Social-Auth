const passport = require('passport');
const GoogleStrategy = require('passport-google-oauth20');
const dotenv = require('dotenv');

const User = require('../models/user-model');

dotenv.config();

passport.serializeUser((user, done) => {
    done(null, user.id);
});

passport.deserializeUser((id, done) => {
    User.findById(id)
        .then(user => {
            done(null, user.id);
        });
});

passport.use(
    new GoogleStrategy({
        callbackURL: '/auth/google/redirect',
        clientID: process.env.GOOGLE_CLIENT_ID,
        clientSecret: process.env.GOOGLE_CLIENT_SECRET
    }, (accessToken, refreshToken, profile, done) => {
        User.findOne({ googleId: profile.id })
            .then((currentUser) => {
                if (currentUser) {
                    console.log(`The user is: ${currentUser}`);
                    done(null, currentUser);
                } else {
                    new User({
                        username: profile.displayName,
                        googleId: profile.id
                    })
                        .save()
                        .then(newUser => {
                            console.log(`New user created: ${newUser}`);
                            done(null ,newUser);
                        })
                        .catch(err => {
                            if (err) throw err;
                        })
                }
            })
            .catch(err => {
                if (err) throw err;
            })

    })
);
