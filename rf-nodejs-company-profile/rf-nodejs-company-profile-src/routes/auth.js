// script ini tugasnya adalah menghubungkan controllers/auth.js dengan route.

const express = require("express");
const authController = require("../controllers/auth");

// session checker digunakan untuk authorization
const sessionChecker = require("../middlewares/sessionchecker");

// buat objek router agar bisa memakai get, post, dan lain-lain.
const router = express.Router();

router.get("/login", sessionChecker.loggedIn, authController.getLogin);

router.post("/login", sessionChecker.loggedIn, authController.postLogin);

router.get("/register", authController.getRegister);

router.post("/register", authController.postRegister);

router.get("/logout", authController.getLogout);

module.exports = router;
