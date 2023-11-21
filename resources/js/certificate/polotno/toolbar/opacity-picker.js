"use strict";
var __importDefault = this && this.__importDefault || function (e) {
    return e && e.__esModule ? e : {default: e}
};
Object.defineProperty(exports, "__esModule", {value: !0}), exports.OpacityPicker = void 0;
const react_1 = __importDefault(require("react")), mobx_react_lite_1 = require("mobx-react-lite"),
    core_1 = require("@blueprintjs/core"), popover2_1 = require("@blueprintjs/popover2"),
    popover2_2 = require("@blueprintjs/popover2"),
    MdOpacity_1 = __importDefault(require("@meronex/icons/md/MdOpacity")), l10n_1 = require("../utils/l10n");
exports.OpacityPicker = (0, mobx_react_lite_1.observer)((({store: e}) => {
    var t;
    const r = e.selectedElements.length > 0;
    return react_1.default.createElement(popover2_2.Popover2, {
        disabled: !r,
        minimal: !1,
        content: react_1.default.createElement("div", {style: {padding: "10px 20px"}}, react_1.default.createElement("div", {style: {textAlign: "center"}}, (0, l10n_1.t)("toolbar.transparency")), react_1.default.createElement(core_1.Slider, {
            value: 100 * (null === (t = e.selectedElements[0]) || void 0 === t ? void 0 : t.opacity),
            labelRenderer: !1,
            onChange: t => {
                e.selectedElements.forEach((e => {
                    e.set({opacity: t / 100})
                }))
            },
            min: 0,
            max: 100
        })),
        position: core_1.Position.BOTTOM
    }, react_1.default.createElement(popover2_1.Tooltip2, {
        content: (0, l10n_1.t)(transparency),
        disabled: !r,
        placement:"bottom",
    }, react_1.default.createElement(core_1.Button, {
        minimal: !0,
        disabled: !r
    }, react_1.default.createElement(MdOpacity_1.default, {className: "bp3-icon", style: {fontSize: "20px"}}))))
}));
