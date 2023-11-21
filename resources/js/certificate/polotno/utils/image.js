"use strict";
Object.defineProperty(exports, "__esModule", {value: !0}), exports.getImageSize = void 0;
const svg_1 = require("./svg");

function getImageSize(e) {
    return new Promise((t => {
        const i = document.createElement("img");
        i.onload = async () => {
            0 === i.width || 0 === i.height ? t(await (0, svg_1.getSvgSize)(e)) : t({width: i.width, height: i.height})
        }, i.src = e
    }))
}

exports.getImageSize = getImageSize;
