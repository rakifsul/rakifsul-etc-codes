const express = require('express');
const cors = require("cors");
const path = require('path')

const app = express();
var corsOptions = {
    origin: "http://localhost:1313",
    credentials: true,
};
app.use(cors(corsOptions));

app.use(express.json());
app.use(express.static(path.join(__dirname, 'public')));

let data = [{
    id: 0,
    name: "satu"
}, {
    id: 1,
    name: "dua"
}, {
    id: 2,
    name: "tiga"
}];

app.get("/", (req, res, nexr) => {
    res.json(data);
})

app.post("/", (req, res, nexr) => {
    data.push({
        id: data.length,
        name: req.body.name
    })

    res.json(data);
})

app.delete("/:id", (req, res, nexr) => {
    const result = data.filter((item) => item.id != req.params.id)
    data = result;
    res.json(result)
})

app.listen(3000, () => {
    console.log('Server is running on http://127.0.0.1:3000');
});