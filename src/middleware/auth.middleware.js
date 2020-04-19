const globalResponseDTO = require('../responses/globalResponseDTO');

const isAuthenticated = (req, res, next) => {
    if (!req.user) {
        return res.status(401).json(globalResponseDTO(
            status = "failed",
            code = 401,
            message = "Your must be logged in to access this API endpoint.",
            data = {}
        ));
    }

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