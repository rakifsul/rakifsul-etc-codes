// script ini adalah script utama dari aplikasi ini.
// tugasnya adalah melakukan konfigurasi umum pada aplikasi ini.

// begin: import modules
const createError = require("http-errors");
const express = require("express");
const path = require("path");
const cookieParser = require("cookie-parser");
const logger = require("morgan");
const session = require("express-session");
const FileStore = require("session-file-store")(session);
const flash = require("connect-flash");
const multer = require("multer");
const { v4: uuidv4 } = require("uuid");
const url = require("url");
require("dotenv").config();

const indexRouter = require("./routes/index");
const adminRouter = require("./routes/admin");
const authRouter = require("./routes/auth");
// end: import modules

// inisialisasi expressjs
const app = express();

// set view folder ke folder "views"
app.set("views", path.join(__dirname, "views"));

// set view engine yang digunakan adalah EJS
app.set("view engine", "ejs");

// inisialisasi morgan
app.use(logger("dev"));

// parse body json
app.use(express.json({ limit: "100mb" }));

// parse body urlencoded
app.use(
    express.urlencoded({
        limit: "100mb",
        extended: true,
        parameterLimit: 100000,
    })
);

// setup multer agar bisa upload gambar
app.use(
    multer({
        storage: multer.diskStorage({
            destination: (req, file, callback) => {
                callback(null, "./uploads");
            },
            filename: (req, file, callback) => {
                callback(null, uuidv4() + "-" + file.originalname);
            },
        }),
        fileFilter: (req, file, callback) => {
            if (file.mimetype == "image/png" || file.mimetype == "image/jpg" || file.mimetype == "image/jpeg" || file.mimetype == "image/gif") {
                callback(null, true);
            } else {
                callback(null, false);
            }
        },
    }).single("upload")
);

// parse cookie header
app.use(cookieParser());

// agar bisa menggunakan session
app.use(
    session({
        secret: process.env.SESSION_SECRET,
        // store: new FileStore(), // jika di-enable simpan session di file (ada bug nya)
        resave: false,
        saveUninitialized: false,
    })
);

// inisialisasi connect-flash
app.use(flash());

// setup folder statis untuk menyimpan resources
app.use("/public", express.static(path.join(__dirname, "public")));
app.use("/uploads", express.static(__dirname + "/uploads"));

// route admin ada di path "/admin" nantinya pada URL.
app.use("/admin", adminRouter);

// route auth ada di path "/auth" nantinya pada URL.
app.use("/auth", authRouter);

// route "/" ada di path "/" nantinya pada URL.
app.use("/", indexRouter);

// setup halaman error 404 jika terjadi
app.use(function (req, res, next) {
    next(createError(404));
});

// setup halaman error lainnya jika terjadi
app.use(function (err, req, res, next) {
    res.status(err.status || 500);
    res.render("error", {
        error: {
            message: err.message,
            status: err.status,
            stack: err.stack,
        },
    });
});

// jalankan server pada port yang ada di BASE_URL atau 3000 jika tidak ada
const port = url.parse(process.env.BASE_URL).port | 3000;
app.listen(port, function () {
    console.log(`server berjalan di port ${port}`);
});
