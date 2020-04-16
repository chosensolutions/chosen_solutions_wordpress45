var isAuthenticated = function (req, res, next) {
    if (!req.username) return res.status(401).end("access denied");
    next();
};

module.exports = isAuthenticated;

// app.use(function (req, res, next) {
//     req.user = ('user' in req.session) ? req.session.user : null;
//     next();
// });
// app.use(function (req, res, next) {
//     req.username = req.session.username ? req.session.username : null;
//     console.log("HTTP request", req.username, req.method, req.url, req.body);
//     next();
// });