const knex = require("knex");
const knexfile = require("./knexfile");
const path = require("path");

let knexEnv;
if (process.env.KNEX_ENV === "development") {
    knexEnv = knexfile.development;
} else if (process.env.KNEX_ENV === "staging") {
    knexEnv = knexfile.staging;
} else if (process.env.KNEX_ENV === "production") {
    knexEnv = knexfile.production;
} else {
    throw Error("invalid environment.");
}

console.log("BUGFIX WORKAROUND !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!");
knexfile.development.connection.filename = path.join(__dirname, knexfile.development.connection.filename);
console.log(knexfile.development.connection.filename);

const db = knex(knexEnv);

module.exports = db;
