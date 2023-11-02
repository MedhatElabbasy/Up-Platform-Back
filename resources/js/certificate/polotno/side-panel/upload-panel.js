"use strict";
var __importDefault = this && this.__importDefault || function (e) {
    return e && e.__esModule ? e : {default: e}
};
Object.defineProperty(exports, "__esModule", {value: !0}), exports.UploadPanel = exports.setUploadFunc = void 0;
const react_1 = __importDefault(require("react")), core_1 = require("@blueprintjs/core"),
    image_1 = require("../utils/image"), file_1 = require("../utils/file"), images_grid_1 = require("./images-grid"),
    l10n_1 = require("../utils/l10n");
let uploadFunc = async e => (0, file_1.localFileToURL)(e);

function setUploadFunc(e) {
    uploadFunc = e
}

exports.setUploadFunc = setUploadFunc;
let filesCache = [];
const UploadPanel = ({store: e}) => {
    const [t, l] = react_1.default.useState(filesCache), [a, i] = react_1.default.useState(!1);
    return react_1.default.useEffect((() => {
        filesCache = t
    }), [t]), react_1.default.createElement("div", {
        style: {
            height: "100%",
            display: "flex",
            flexDirection: "column"
        }
    },
        react_1.default.createElement("div", {
        style: {
            height: "45px",
            paddingTop: "5px",
            color: "white"
        }
    },
            (0, l10n_1.t)("Do you want to upload instant images?")),


        react_1.default.createElement("div", {style: {marginBottom: "20px",width: "100%"}},
        react_1.default.createElement("label", {htmlFor: "input-file",className:'upload_btn'}, react_1.default.createElement(core_1.Button, {
        icon: "upload",
        style: {width: "100%"},
        onClick: () => {
            var e;
            null === (e = document.querySelector("#input-file")) || void 0 === e || e.click()
        }
    }, (0, l10n_1.t)("sidePanel.uploadImage")), react_1.default.createElement("input", {
        type: "file",
        id: "input-file",
        style: {display: "none"},
        onChange: async e => {
            const {target: t} = e;
            i(!0);
            for (const e of t.files) {
                const t = await uploadFunc(e);
                l((e => e.concat([t])))
            }
            i(!1), t.value = null
        },
        multiple: !0
    }))),


        react_1.default.createElement(images_grid_1.ImagesGrid, {
        images: t,
        isLoading: a,
        getPreview: e => e,
        onSelect: async (t, l) => {
            var a;
            let {width: i, height: n} = await (0, image_1.getImageSize)(t);
            const r = t.indexOf("svg+xml") >= 0 || t.indexOf(".svg") >= 0 ? "svg" : "image",
                o = Math.min(e.width / i, e.height / n, 1);
            i *= o, n *= o;
            const u = ((null == l ? void 0 : l.x) || e.width / 2) - i / 2,
                c = ((null == l ? void 0 : l.y) || e.height / 2) - n / 2;
            null === (a = e.activePage) || void 0 === a || a.addElement({
                type: r,
                src: t,
                x: u,
                y: c,
                width: i,
                height: n
            })
        }
    }))
};
exports.UploadPanel = UploadPanel;
