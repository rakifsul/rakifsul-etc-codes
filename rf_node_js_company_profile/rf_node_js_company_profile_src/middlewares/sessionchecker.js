// script ini tugasnya adalah menjadi middleware

module.exports.notLoggedIn = (req, res, next) => {
    if (!req.session.isLoggedIn) {
        // jika varieble isLoggedIn dalam session false, null, atau undefined

        // maka redirect ke /auth/login
        return res.redirect("/auth/login");
    }
    next();
};

module.exports.loggedIn = (req, res, next) => {
    if (req.session.isLoggedIn) {
        // jika varieble isLoggedIn dalam session true

        // maka redirect ke /admin
        return res.redirect("/admin");
    }
    next();
};
