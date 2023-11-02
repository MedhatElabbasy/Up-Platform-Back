"use strict";
var __importDefault = this && this.__importDefault || function (e) {
    return e && e.__esModule ? e : {default: e}
};
Object.defineProperty(exports, "__esModule", {value: !0}), exports.PagesPanel = void 0;
const react_1 = __importDefault(require("react")), mobx_react_lite_1 = require("mobx-react-lite"),
    images_grid_1 = require("./images-grid");
exports.PagesPanel = (0, mobx_react_lite_1.observer)((({store: e}) => {
    const [t, r] = react_1.default.useState({}), a = () => {
        const t = {};
        e.pages.forEach((r => {
            const a = e.toDataURL({pageId: r.id, pixelRatio: .2});
            t[r.id] = a
        })), r(t)
    };
    return react_1.default.useEffect((() => {
        const e = setInterval(a, 1e3);
        return () => clearInterval(e)
    }), []), react_1.default.createElement("div", {style: {height: "100%"}}, react_1.default.createElement(images_grid_1.ImagesGrid, {
        images: e.pages.slice(),
        getPreview: r => t[r.id] || e.pages.indexOf(r),
        onSelect: async t => {
            e.selectPage(t.id)

        },
        isLoading: !1,
        rowsNumber: 2
    }))
}));
