// script ini akan dipanggil di routes/admin.js

const bcrypt = require("bcryptjs");
const fs = require("fs");
const createError = require("http-errors");
const osu = require("node-os-utils");
const knex = require("../databases/connection");

// render halaman admin index
module.exports.getIndex = async function (req, res, next) {
    try {
        // ambil data text pertama dari tabel texts
        const text = await knex("texts").first();

        // render dan kirimkan data tadi ke front end
        res.render("admin/layout.ejs", {
            child: "admin/index.ejs",
            clientScript: "admin/index.js.ejs",
            data: {
                text: text,
            },
        });
    } catch (err) {
        console.log(err);
        next(createError(500));
    }
};

// dapatkan data penggunaan CPU
module.exports.getCPUUsage = async function (req, res, next) {
    osu.cpu.usage().then((cpuPercentage) => {
        res.status(200).json({
            name: "CPU Usage",
            value: cpuPercentage,
        });
    });
};

// dapatkan data penggunaan memory
module.exports.getMemoryUsage = function (req, res) {
    osu.mem.used().then((memUsed) => {
        res.status(200).json({
            name: "Memory Usage",
            value: (memUsed.usedMemMb / memUsed.totalMemMb) * 100,
        });
    });
};

// render halaman settings
module.exports.getSettings = async function (req, res) {
    try {
        // ambil data text pertama dari tabel texts
        const text = await knex("texts").first();

        // render dan kirimkan data tadi ke front end
        res.render("admin/layout", {
            child: "admin/settings.ejs",
            clientScript: "admin/settings.js.ejs",
            data: {
                adminEmail: req.session.admin.email,
                text: text,
                errors: req.flash("errors"),
            },
        });
    } catch (err) {
        console.log(err);
        next(createError(500));
    }
};

// handle edit settings
module.exports.postSettingsEdit = async function (req, res, next) {
    try {
        // bongkar request body
        const { email, password } = req.body;

        if (password && email) {
            // jika password dan email ada

            // update data admin
            const ret = await knex("admins")
                .where({ email: req.session.admin.email })
                .update({
                    email: email,
                    password: bcrypt.hashSync(password, 12),
                });
        } else if (email) {
            // jika hanya email yang ada

            // update data admin
            const ret = await knex("admins").where({ email: req.session.admin.email }).update({
                email: email,
            });
        }

        // redirect ke settings
        res.redirect("/admin/settings");
    } catch (err) {
        console.log(err);
        next(createError(500));
    }
};

// render halaman messages
module.exports.getMessagesIndex = async function (req, res) {
    try {
        // ambil data text pertama dari tabel texts
        const text = await knex("texts").first();

        // ambil data messages dari tabel messages
        const messages = await knex("messages");

        // render dan kirimkan data tadi ke front end
        res.render("admin/layout", {
            child: "admin/messages.ejs",
            clientScript: "admin/messages.js.ejs",
            data: {
                text: text,
                results: messages,
            },
        });
    } catch (err) {
        console.log(err);
        next(createError(500));
    }
};

// handle delete message
module.exports.getMessagesDelete = async function (req, res, next) {
    try {
        // delete message yang id-nya adalah req.params.id
        // atau dengan kata lain
        // yang id-nya sama dengan yang ada di URL
        await knex("messages")
            .where({
                _id: req.params.id,
            })
            .del();

        // redirect ke messages
        res.redirect("/admin/messages");
    } catch (err) {
        console.log(err);
        next(createError(500));
    }
};

// render halaman texts
module.exports.getTextsIndex = async function (req, res) {
    try {
        // ambil data text pertama dari tabel texts
        const text = await knex("texts").first();

        // render dan kirimkan data tadi ke front end
        res.render("admin/layout", {
            child: "admin/texts.ejs",
            clientScript: "admin/texts.js.ejs",
            data: {
                adminEmail: req.session.admin.email,
                text: text,
                errors: req.flash("errors"),
            },
        });
    } catch (err) {
        console.log(err);
        next(createError(500));
    }
};

// handle edit data dari tabel texts
module.exports.postTextsEdit = async function (req, res, next) {
    try {
        // ambil data text pertama dari tabel texts
        const target = await knex("texts").first();

        // update data tersebut
        const ret = await knex("texts").where({ _id: target._id }).update({
            siteTitle: req.body.siteTitle,
            siteSEOTitle: req.body.siteSEOTitle,
            siteDescription: req.body.siteDescription,
            siteSEODescription: req.body.siteSEODescription,
            aboutSubHeading: req.body.aboutSubHeading,
            aboutSubText: req.body.aboutSubText,
            infoSubHeading: req.body.infoSubHeading,
            address: req.body.address,
            phone: req.body.phone,
            email: req.body.email,
        });

        // redirect ke halaman texts
        res.redirect("/admin/texts");
    } catch (err) {
        console.log(err);
        next(createError(500));
    }
};

// render halaman skills
module.exports.getSkillsIndex = async function (req, res, next) {
    try {
        // ambil data text pertama dari tabel texts
        const text = await knex("texts").first();

        // ambil data skills dari tabel skills
        const allSkills = await knex("skills");

        // render dan kirim data tersebut ke front end
        res.render("admin/layout.ejs", {
            child: "admin/skills.ejs",
            clientScript: "admin/skills.js.ejs",
            data: {
                results: allSkills,
                text: text,
            },
        });
    } catch (err) {
        console.log(err);
        next(createError(500));
    }
};

// handle penambahan skill
module.exports.postSkillsAdd = async function (req, res, next) {
    try {
        // bongkar request body
        const { title, level } = req.body;

        // insert skill baru, judul dan levelnya
        const skillId = await knex("skills").insert({
            title: title,
            level: level,
        });

        // redirect ke halaman skills
        res.redirect("/admin/skills");
    } catch (err) {
        console.log(err);
        next(createError(500));
    }
};

// handle delete skill
module.exports.getSkillsDelete = async function (req, res, next) {
    try {
        // delete skill yang id-nya adalah req.params.id
        // atau dengan kata lain
        // yang id-nya sama dengan yang ada di URL
        await knex("skills")
            .where({
                _id: req.params.id,
            })
            .del();

        // redirect ke halaman skills
        res.redirect("/admin/skills");
    } catch (err) {
        console.log(err);
        next(createError(500));
    }
};

// render halaman services
module.exports.getServicesIndex = async function (req, res, next) {
    try {
        // ambil data text pertama dari tabel texts
        const text = await knex("texts").first();

        // ambil data services dari tabel services
        const allServices = await knex("services");

        // render dan kirim data tersebut ke front end
        res.render("admin/layout.ejs", {
            child: "admin/services.ejs",
            clientScript: "admin/services.js.ejs",
            data: {
                results: allServices,
                text: text,
            },
        });
    } catch (err) {
        console.log(err);
        next(createError(500));
    }
};

// handle tambah service
module.exports.postServicesAdd = async function (req, res, next) {
    try {
        // bongkar request body
        const { title, description, svg } = req.body;

        // insert service baru, judul, deskripsi, dan svg nya
        const serviceId = await knex("services").insert({
            title: title,
            description: description,
            svg: svg,
        });

        // redirect ke halaman services
        res.redirect("/admin/services");
    } catch (err) {
        console.log(err);
        next(createError(500));
    }
};

// handle delete service
module.exports.getServicesDelete = async function (req, res, next) {
    try {
        // delete service yang id-nya adalah req.params.id
        // atau dengan kata lain
        // yang id-nya sama dengan yang ada di URL
        await knex("services")
            .where({
                _id: req.params.id,
            })
            .del();

        // redirect ke halaman services
        res.redirect("/admin/services");
    } catch (err) {
        console.log(err);
        next(createError(500));
    }
};

// render halaman carousel
module.exports.getCarouselsIndex = async function (req, res, next) {
    try {
        // ambil data text pertama dari tabel texts
        const text = await knex("texts").first();

        // ambil data carousels dari tabel carousels
        const allCarousels = await knex("carousels");

        // render dan kirim data tadi ke front end
        res.render("admin/layout.ejs", {
            child: "admin/carousels.ejs",
            clientScript: "admin/carousels.js.ejs",
            data: {
                results: allCarousels,
                text: text,
            },
        });
    } catch (err) {
        console.log(err);
        next(createError(500));
    }
};

// handle upload gambar carousel
module.exports.postCarouselsUpload = async function (req, res, next) {
    try {
        if (req.file) {
            // jika request file ada, yang artinya gambar diupload

            // bongkar request body
            const { title, description } = req.body;

            // insert carousel baru, judul, deskripsi, dan path dari file gambarnya
            const fileId = await knex("carousels").insert({
                title: title,
                description: description,
                path: req.file.path.replace("\\", "/"),
            });
        }

        // redirect ke halaman carousels
        res.redirect("/admin/carousels");
    } catch (err) {
        console.log(err);
        next(createError(500));
    }
};

// handle delete carousel
module.exports.getCarouselsDelete = async function (req, res, next) {
    try {
        // dapatkan dulu datanya
        const willBeDeleted = await knex("carousels").where({
            _id: req.params.id,
        });

        // delete carousel yang id-nya adalah req.params.id
        // atau dengan kata lain
        // yang id-nya sama dengan yang ada di URL
        // ini yang di database
        await knex("carousels")
            .where({
                _id: req.params.id,
            })
            .del();

        // hapus file nya
        // ini yang di folder upload
        fs.unlinkSync("./" + willBeDeleted[0].path);

        // redirect ke halaman carousels
        res.redirect("/admin/carousels");
    } catch (err) {
        console.log(err);
        next(createError(500));
    }
};

// render halaman portfolios
module.exports.getPortfoliosIndex = async function (req, res, next) {
    try {
        // ambil data text pertama dari tabel texts
        const text = await knex("texts").first();

        // ambil data portfolios dari tabel portfolios
        const allPortfolios = await knex("portfolios");

        // render dan kirim data tadi ke front end
        res.render("admin/layout.ejs", {
            child: "admin/portfolios.ejs",
            clientScript: "admin/portfolios.js.ejs",
            data: {
                results: allPortfolios,
                text: text,
            },
        });
    } catch (err) {
        console.log(err);
        next(createError(500));
    }
};

// handle upload gambar portfolio
module.exports.postPortfoliosUpload = async function (req, res, next) {
    try {
        if (req.file) {
            // jika request file ada, yang artinya gambar diupload

            // bongkar request body
            const { title } = req.body;

            // insert portfolio baru, judul, dan path dari file gambarnya
            const fileId = await knex("portfolios").insert({
                title: title,
                path: req.file.path.replace("\\", "/"),
            });
        }

        // redirect ke halaman portfolios
        res.redirect("/admin/portfolios");
    } catch (err) {
        console.log(err);
        next(createError(500));
    }
};

// handle delete portfolio
module.exports.getPortfoliosDelete = async function (req, res, next) {
    try {
        // dapatkan dulu datanya
        const willBeDeleted = await knex("portfolios").where({
            _id: req.params.id,
        });

        // delete portfolio yang id-nya adalah req.params.id
        // atau dengan kata lain
        // yang id-nya sama dengan yang ada di URL
        // ini yang di database
        await knex("portfolios")
            .where({
                _id: req.params.id,
            })
            .del();

        // hapus file nya
        // ini yang di folder upload
        fs.unlinkSync("./" + willBeDeleted[0].path);

        // redirect ke halaman portfolios
        res.redirect("/admin/portfolios");
    } catch (err) {
        console.log(err);
        next(createError(500));
    }
};
