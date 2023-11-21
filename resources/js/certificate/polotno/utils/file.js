"use strict";

async function localFileToURL(e) {
    return new Promise(((o, l) => {
        const r = new FileReader;
        r.readAsDataURL(e), r.onload = () => o(r.result), r.onerror = e => l(e)
    }))
}

Object.defineProperty(exports, "__esModule", {value: !0}), exports.localFileToURL = void 0, exports.localFileToURL = localFileToURL;
