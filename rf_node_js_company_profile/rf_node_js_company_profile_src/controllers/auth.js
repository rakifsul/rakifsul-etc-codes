// script ini akan dipanggil di routes/auth.js

// begin: import modules
const createError = require("http-errors");
const bcrypt = require("bcryptjs");
const Joi = require("joi");
const knex = require("../databases/connection");
// end: import modules

// render halaman login
module.exports.getLogin = async function (req, res, next) {
    try {
        // ambil data tabel texts
        const text = await knex("texts").first();

        // render dan kirim data tadi ke front end
        res.render("auth/layout.ejs", {
            child: "auth/login.ejs",
            clientScript: "auth/login.js.ejs",
            data: {
                text: text,
                errors: req.flash("errors"),
            },
        });
    } catch (err) {
        console.log(err);
        next(createError(500));
    }
};

// handle form login
module.exports.postLogin = async function (req, res, next) {
    // validasi request body
    const schema = Joi.object({
        email: Joi.string().required(),
        password: Joi.string().required(),
    });

    const validObj = schema.validate(req.body);
    if (validObj.error) {
        // jika ada error dalam request body

        // buat pesan error flash
        req.flash("errors", validObj.error.details);
        res.status(422).redirect("/auth/login");
        res.end();
        return;
    }

    // bongkar request body
    const { email, password } = req.body;

    try {
        // ambil admin dari tabel admins yang emailnya adalah email dari request body tadi
        const admin = await knex("admins").where({ email: email }).first();

        if (admin) {
            // jika admin tadi ada

            if (email == admin.email) {
                // jika email dari request body sama dengan yang di tabel

                // bandingkan passwordnya
                if (bcrypt.compareSync(password, admin.password) == true) {
                    // jika password sama

                    // masukkan data-data ini ke session
                    req.session.isLoggedIn = true;
                    req.session.admin = admin;
                    req.session.save();

                    // redirect ke halaman admin
                    res.redirect("/admin");
                } else {
                    // jika password beda

                    // redirect ke halaman login
                    res.redirect("/auth/login");
                }
            } else {
                // jika email dari request body beda dengan yang di tabel

                // redirect ke halaman login
                res.redirect("/auth/login");
            }
        } else {
            // jika admin tidak ada

            // redirect ke halaman login
            res.redirect("/auth/login");
        }
    } catch (err) {
        console.log(err);
        next(createError(500));
    }
};

// render halaman register
module.exports.getRegister = async function (req, res, next) {
    try {
        // ambil data tabel texts
        const text = await knex("texts").first();

        // render dan kirim data tadi ke front end
        res.render("auth/layout.ejs", {
            child: "auth/register.ejs",
            clientScript: "auth/register.js.ejs",
            data: {
                text: text,
                errors: req.flash("errors"),
            },
        });
    } catch (err) {
        console.log(err);
        next(createError(500));
    }
};

// handle form register
module.exports.postRegister = async function (req, res, next) {
    // validasi request body
    const schema = Joi.object({
        email: Joi.string().required(),
        name: Joi.string().required(),
        password: Joi.string().required(),
        password_repeat: Joi.ref("password"),
    }).with("password", "password_repeat");

    const validObj = schema.validate(req.body);
    if (validObj.error) {
        // jika ada error dalam request body

        // buat pesan error flash
        console.log(validObj.error.details);
        req.flash("errors", validObj.error.details);
        res.status(422).redirect("/auth/register");
        res.end();
        return;
    }

    // bongkar request body
    const { email, name, password } = req.body;
    try {
        // masukkan data admin baru ke tabel admins
        const admin = await knex("admins").insert({
            email: email,
            name: name,
            password: bcrypt.hashSync(password, 12),
        });

        // redirect ke halaman login
        res.redirect("/auth/login");
    } catch (err) {
        console.log(err);
        next(createError(500));
    }
};

// handle logout
module.exports.getLogout = function (req, res, next) {
    req.session.destroy((err) => {
        console.log(err);
        res.clearCookie("connect.sid");
        res.redirect("/auth/login");
    });
};
