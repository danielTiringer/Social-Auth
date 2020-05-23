const router = require('express').Router();

router.get('/login', (req, res) => {
    res.render('login');
});

router.get('/logout', (req, res) => {
    res.send('Logout in progress');
});

router.get('/google', (req, res) => {
    res.send('Logging in progress');
});

module.exports = router;
