"use strict";
var __importDefault = this && this.__importDefault || function (t) {
    return t && t.__esModule ? t : {default: t}
};
Object.defineProperty(exports, "__esModule", {value: !0}), exports.htmlToCanvas = exports.detectSize = void 0;
const html2canvas_1 = __importDefault(require("html2canvas")), pixelRatio = 2;

function detectSize(t) {
    const e = document.createElement("div");
    e.innerHTML = t, e.style.display = "inline-block", e.style.position = "fixed", e.style.top = "0px", e.style.left = "0px", e.style.zIndex = "1000", document.body.appendChild(e);
    const i = e.getBoundingClientRect();
    return document.body.removeChild(e), {width: i.width, height: i.height}
}

async function htmlToCanvas({html: t, width: e, height: i}) {
    const n = document.createElement("div");
    document.body.appendChild(n), n.innerHTML = t, n.style.position = "absolute", n.style.width = e + "px", n.style.height = i + "px", n.style.zIndex = 1e3;
    const o = await (0, html2canvas_1.default)(n, {width: e, height: i});
    return document.body.removeChild(n), o
}

exports.detectSize = detectSize, exports.htmlToCanvas = htmlToCanvas;
