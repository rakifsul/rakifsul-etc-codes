const bcrypt = require("bcryptjs");

/**
 * @param { import("knex").Knex } knex
 * @returns { Promise<void> }
 */
exports.up = function (knex) {
    return knex.schema
        .createTable("admins", function (table) {
            table.increments("_id");
            table.string("name", 1000).notNullable();
            table.string("email", 1000).notNullable();
            table.string("password", 1000).notNullable();
            table.timestamps(true, true, true);
        })
        .createTable("messages", function (table) {
            table.increments("_id");
            table.string("name", 1000).notNullable();
            table.string("email", 1000).notNullable();
            table.string("message", 1000).notNullable();
            table.timestamps(true, true, true);
        })
        .createTable("texts", function (table) {
            table.increments("_id");
            table.string("siteTitle", 1000).notNullable();
            table.string("siteSEOTitle", 1000).notNullable();
            table.string("siteDescription", 1000);
            table.string("siteSEODescription", 1000);
            table.string("aboutSubHeading", 1000);
            table.string("aboutSubText", 5000);
            table.string("infoSubHeading", 1000);
            table.string("address", 1000);
            table.string("phone", 1000);
            table.string("email", 1000);
            table.timestamps(true, true, true);
        })
        .createTable("skills", function (table) {
            table.increments("_id");
            table.string("title", 1000).notNullable();
            table.integer("level").notNullable();
            table.timestamps(true, true, true);
        })
        .createTable("services", function (table) {
            table.increments("_id");
            table.string("title", 1000).notNullable();
            table.string("description", 1000).notNullable();
            table.string("svg", 10000).notNullable();
            table.timestamps(true, true, true);
        })
        .createTable("portfolios", function (table) {
            table.increments("_id");
            table.string("title", 1000).notNullable();
            table.string("path", 1000).notNullable();
            table.timestamps(true, true, true);
        })
        .createTable("carousels", function (table) {
            table.increments("_id");
            table.string("title", 1000).notNullable();
            table.string("description", 1000);
            table.string("path", 1000).notNullable();
            table.timestamps(true, true, true);
        })
        .then(() => {
            return knex("admins").insert([
                {
                    name: "admin",
                    email: "admin@example.com",
                    password: bcrypt.hashSync("admin", 12),
                },
            ]);
        })
        .then(() => {
            return knex("texts").insert([
                {
                    siteTitle: "Company Name",
                    siteSEOTitle: "Company Name - A leading software development agency...",
                    siteDescription: "Company Name is a leading software development agency...",
                    siteSEODescription: "Company Name is a leading software development agency...",
                    aboutSubHeading: "Why?",
                    aboutSubText: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit magnam ad doloremque illum iure repellat vero neque dolore consectetur, quidem corporis tenetur perspiciatis mollitia quos nemo architecto! Veniam facilis nesciunt, dignissimos in officia tempora repellat autem ipsum, nostrum accusamus aliquid reiciendis inventore quos aperiam voluptates debitis magni sit laborum obcaecati possimus necessitatibus quasi adipisci ducimus? Adipisci enim accusantium, dignissimos quae asperiores eaque tempore reprehenderit? Quaerat blanditiis sint rerum accusamus aspernatur provident sunt libero quibusdam totam. Magnam doloribus nisi, quas eligendi quasi modi, velit alias nulla quae animi excepturi officiis, ipsam voluptatum? Maxime reprehenderit tenetur facilis, unde obcaecati ratione id magni!",
                    infoSubHeading: "Our Office",
                    address: "Jl. Some Street No. 15, Some City, Some Province, Some Country",
                    phone: "(021) yyy-xxxx",
                    email: "admin@example.com",
                },
            ]);
        });
};

/**
 * @param { import("knex").Knex } knex
 * @returns { Promise<void> }
 */
exports.down = function (knex) {
    return knex.schema.dropTable("skills").dropTable("services").dropTable("portfolios").dropTable("carousels").dropTable("texts").dropTable("messages").dropTable("admins");
};
