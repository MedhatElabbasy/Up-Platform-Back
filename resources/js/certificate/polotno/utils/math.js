"use strict";
var __importDefault = this && this.__importDefault || function (t) {
    return t && t.__esModule ? t : {default: t}
};
Object.defineProperty(exports, "__esModule", {value: !0}), exports.getClientRect = void 0;
const konva_1 = __importDefault(require("konva"));

function getCorner(t, e, n, r, o) {
    const i = Math.sqrt(n * n + r * r);
    o += Math.atan2(r, n);
    return {x: t + i * Math.cos(o), y: e + i * Math.sin(o)}
}

function getClientRect(t) {
    const {x: e, y: n, width: r, height: o} = t, i = konva_1.default.Util.degToRad(t.rotation),
        a = getCorner(e, n, 0, 0, i), h = getCorner(e, n, r, 0, i), u = getCorner(e, n, r, o, i),
        x = getCorner(e, n, 0, o, i), s = Math.min(a.x, h.x, u.x, x.x), c = Math.min(a.y, h.y, u.y, x.y);
    return {x: s, y: c, width: Math.max(a.x, h.x, u.x, x.x) - s, height: Math.max(a.y, h.y, u.y, x.y) - c}
}

exports.getClientRect = getClientRect;
