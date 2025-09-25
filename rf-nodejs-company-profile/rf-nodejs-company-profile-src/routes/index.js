// script ini tugasnya adalah menghubungkan controllers/index.js dengan route.

const express = require("express");
const indexController = require("../controllers/index");

// buat objek router agar bisa memakai get, post, dan lain-lain.
const router = express.Router();

router.get("/", indexController.getIndex);

router.post("/send-message", indexController.postIndexSendMessage);

module.exports = router;
