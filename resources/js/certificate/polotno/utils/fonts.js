"use strict";
var __createBinding = this && this.__createBinding || (Object.create ? function (t, e, o, n) {
    void 0 === n && (n = o), Object.defineProperty(t, n, {
        enumerable: !0, get: function () {
            return e[o]
        }
    })
} : function (t, e, o, n) {
    void 0 === n && (n = o), t[n] = e[o]
}), __setModuleDefault = this && this.__setModuleDefault || (Object.create ? function (t, e) {
    Object.defineProperty(t, "default", {enumerable: !0, value: e})
} : function (t, e) {
    t.default = e
}), __importStar = this && this.__importStar || function (t) {
    if (t && t.__esModule) return t;
    var e = {};
    if (null != t) for (var o in t) "default" !== o && Object.prototype.hasOwnProperty.call(t, o) && __createBinding(e, t, o);
    return __setModuleDefault(e, t), e
};
Object.defineProperty(exports, "__esModule", {value: !0}), exports.injectCustomFont = exports.injectGoogleFont = exports.loadFont = exports.addGlobalFont = exports.globalFonts = exports.getFontsList = exports.setGoogleFonts = exports.isGoogleFontChanged = void 0;
const mobx = __importStar(require("mobx"));

let GOOGLE_FONTS = mobx.observable([
        'Amatic SC','Arial','Bickley','Bodoni','Calibri','Cambria','Century Schoolbook','Frutiger','Futura','Garamond','Georgia','Helvetica','Hind','IBM Plex Mono','Libre Baskerville','Lobster','Lora','Marck Script','Merriweather','Open Sans','Oxygen','Playfair Display','Poppins','Press Start 2P','Proxima Nova','Public Sans','Ramaraja','Roboto','Rubik Mono One','Teko','Times New Roman','Ubuntu','Verdana'
    ]),

    googleFontsChanged = !1;


function isGoogleFontChanged() {
    return googleFontsChanged
}

function setGoogleFonts(t) {
    googleFontsChanged = !0, GOOGLE_FONTS.splice(0, GOOGLE_FONTS.length), GOOGLE_FONTS.push(...t)
}

function getFontsList() {
    return GOOGLE_FONTS
}

function addGlobalFont(t) {
    exports.globalFonts.push(t)
}

exports.isGoogleFontChanged = isGoogleFontChanged, exports.setGoogleFonts = setGoogleFonts, exports.getFontsList = getFontsList, exports.globalFonts = mobx.observable([]), exports.addGlobalFont = addGlobalFont;
var TEXT_TEXT = "Some test text;?#D-ПРИВЕТ!", canvas = document.createElement("canvas"), ctx = canvas.getContext("2d");

function measureArial() {
    return measureFont("Arial")
}

function measureFont(t) {
    return ctx.font = `normal 40px '${t}', Arial`, ctx.measureText(TEXT_TEXT).width
}

const MAX_ATTEMPTS = 100, loadedFonts = {Arial: !0};

async function loadFont(t) {
    var e;
    if (loadedFonts[t]) return;
    const o = !!(null === (e = document.fonts) || void 0 === e ? void 0 : e.load), n = measureArial();
    if (o) try {
        await document.fonts.load(`16px '${t}'`);
        const e = measureFont(t);
        if (n !== e) return void (loadedFonts[t] = !0)
    } catch (t) {
    }
    const s = measureFont(t);
    for (let e = 0; e < 100; e++) {
        const e = measureFont(t);
        if (e !== s || e !== n) return void (loadedFonts[t] = !0);
        await new Promise((t => setTimeout(t, 60)))
    }
    console.warn(`Timeout for loading font "${t}". Looks like polotno can't load it. Is it a correct font family?`)
}

exports.loadFont = loadFont;
const registeredGoogleFonts = {};

function injectGoogleFont(t) {
    if (registeredGoogleFonts[t]) return;
    const e = `https://fonts.googleapis.com/css?family=${t.replace(/ /g, "+")}`, o = document.createElement("link");
    o.type = "text/css", o.href = e, o.rel = "stylesheet", document.getElementsByTagName("head")[0].appendChild(o), registeredGoogleFonts[t] = !0
}

exports.injectGoogleFont = injectGoogleFont;
const registeredCustomFonts = {};

function injectCustomFont(t) {
    const e = t.fontFamily;
    if (registeredCustomFonts[e]) return;
    if (!t.url && !t.styles) return;
    const o = document.createElement("style");
    o.type = "text/css";
    const n = t.styles || (t.url ? [{src: `url("${t.url}")`}] : []);
    let s = "";
    n.forEach((t => {
        s += `\n      @font-face {\n        font-family: '${e}';\n        src: ${t.src};\n        font-style: ${t.fontStyle || "normal"};\n        font-weight: ${t.fontWeight || "normal"};\n      }\n    `
    })), o.innerHTML = s, document.getElementsByTagName("head")[0].appendChild(o), registeredCustomFonts[t.fontFamily] = !0
}

exports.injectCustomFont = injectCustomFont;
