"use strict";

function getCrop(t, e, h = "scale") {
    const i = e.width / e.height;
    let o, r;
    i >= t.width / t.height ? (o = t.width, r = t.width / i) : (o = t.height * i, r = t.height);
    let d = 0, g = 0;
    return "left-top" === h ? (d = 0, g = 0) : "left-middle" === h ? (d = 0, g = (t.height - r) / 2) : "left-bottom" === h ? (d = 0, g = t.height - r) : "center-top" === h ? (d = (t.width - o) / 2, g = 0) : "center-middle" === h ? (d = (t.width - o) / 2, g = (t.height - r) / 2) : "center-bottom" === h ? (d = (t.width - o) / 2, g = t.height - r) : "right-top" === h ? (d = t.width - o, g = 0) : "right-middle" === h ? (d = t.width - o, g = (t.height - r) / 2) : "right-bottom" === h ? (d = t.width - o, g = t.height - r) : "scale" === h ? (d = 0, g = 0, o = t.width, r = t.height) : console.error(new Error("Unknown clip position property - " + h)), {
        cropX: d,
        cropY: g,
        cropWidth: o,
        cropHeight: r
    }
}

Object.defineProperty(exports, "__esModule", {value: !0}), exports.getCrop = void 0, exports.getCrop = getCrop;
