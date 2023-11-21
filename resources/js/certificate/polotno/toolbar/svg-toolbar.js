"use strict";
var __importDefault = this && this.__importDefault || function (e) {
    return e && e.__esModule ? e : {default: e}
};
Object.defineProperty(exports, "__esModule", {value: !0}), exports.SvgToolbar = void 0;
const react_1 = __importDefault(require("react")), mobx_react_lite_1 = require("mobx-react-lite"),
    core_1 = require("@blueprintjs/core"), l10n_1 = require("../utils/l10n"),
    filters_picker_1 = __importDefault(require("./filters-picker")),
    color_picker_1 = __importDefault(require("./color-picker")),
    flip_button_1 = __importDefault(require("./flip-button"));
exports.SvgToolbar = (0, mobx_react_lite_1.observer)((({store: e}) => {
    const t = e.selectedElements[0];
    return react_1.default.createElement(core_1.Navbar.Group, {align: core_1.Alignment.LEFT}, react_1.default.createElement(flip_button_1.default, {element: t}), react_1.default.createElement(filters_picker_1.default, {
        element: t,
        store: e
    }), t.maskSrc && react_1.default.createElement(core_1.Button, {
        minimal: !0, onClick: () => {
            t.set({maskSrc: ""})
        }
    }, (0, l10n_1.t)("toolbar.removeMask")), !t.maskSrc && t.colors.slice(0, 5).map((r => react_1.default.createElement(color_picker_1.default, {
        key: r,
        value: t.colorsReplace.get(r) || r,
        onChange: e => {
            t.replaceColor(r, e)
        },
        store: e,
        gradientEnabled: !0
    }))))
})), exports.default = exports.SvgToolbar;
