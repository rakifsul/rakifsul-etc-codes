// script ini tugasnya adalah menghubungkan controllers/admin.js dengan route.

const express = require("express");
const adminController = require("../controllers/admin");

// session checker digunakan untuk authorization
const sessionChecker = require("../middlewares/sessionchecker");

// buat objek router agar bisa memakai get, post, dan lain-lain.
const router = express.Router();

router.get("/", sessionChecker.notLoggedIn, adminController.getIndex);

router.get("/cpu-usage", sessionChecker.notLoggedIn, adminController.getCPUUsage);

router.get("/memory-usage", adminController.getMemoryUsage);

router.get("/settings", sessionChecker.notLoggedIn, adminController.getSettings);

router.post("/settings/edit", sessionChecker.notLoggedIn, adminController.postSettingsEdit);

router.get("/messages", sessionChecker.notLoggedIn, adminController.getMessagesIndex);

router.get("/messages/delete/:id", sessionChecker.notLoggedIn, adminController.getMessagesDelete);

router.get("/texts", sessionChecker.notLoggedIn, adminController.getTextsIndex);

router.post("/texts/edit", sessionChecker.notLoggedIn, adminController.postTextsEdit);

router.get("/skills", sessionChecker.notLoggedIn, adminController.getSkillsIndex);

router.post("/skills/add", sessionChecker.notLoggedIn, adminController.postSkillsAdd);

router.get("/skills/delete/:id", sessionChecker.notLoggedIn, adminController.getSkillsDelete);

router.get("/services", sessionChecker.notLoggedIn, adminController.getServicesIndex);

router.post("/services/add", sessionChecker.notLoggedIn, adminController.postServicesAdd);

router.get("/services/delete/:id", sessionChecker.notLoggedIn, adminController.getServicesDelete);

router.get("/carousels", sessionChecker.notLoggedIn, adminController.getCarouselsIndex);

router.post("/carousels/upload", sessionChecker.notLoggedIn, adminController.postCarouselsUpload);

router.get("/carousels/delete/:id", sessionChecker.notLoggedIn, adminController.getCarouselsDelete);

router.get("/portfolios", sessionChecker.notLoggedIn, adminController.getPortfoliosIndex);

router.post("/portfolios/upload", sessionChecker.notLoggedIn, adminController.postPortfoliosUpload);

router.get("/portfolios/delete/:id", sessionChecker.notLoggedIn, adminController.getPortfoliosDelete);

module.exports = router;
