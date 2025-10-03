// script ini akan dipanggil di routes/index.js

// begin: import modules
const createError = require("http-errors");
const knex = require("../databases/connection");
// end: import modules

// merender homepage
module.exports.getIndex = async function (req, res, next) {
    try {
        // ambil isi masing-masing tabel dan simpan ke variabel
        const text = await knex("texts").first();
        const skills = await knex("skills");
        const services = await knex("services");
        const carousels = await knex("carousels");
        const portfolios = await knex("portfolios");

        // render dan kirimkan datanya yang berupa isi tabel
        res.render("index/index.ejs", {
            text: text,
            skills: skills,
            services: services,
            carousels: carousels,
            portfolios: portfolios,
        });
    } catch (err) {
        console.log(err);
        next(createError(500));
    }
};

// meng-handle form kontak post
module.exports.postIndexSendMessage = async function (req, res, next) {
    try {
        // bongkar request body
        const { name, email, message } = req.body;

        // insert data pesan form kontak
        const messageId = await knex("messages").insert({
            name: name,
            email: email,
            message: message,
        });

        // refresh halaman
        res.redirect("/");
    } catch (err) {
        console.log(err);
        next(createError(500));
    }
};
