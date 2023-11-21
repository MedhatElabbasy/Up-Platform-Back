"use strict";
var __importDefault = this && this.__importDefault || function (e) {
    return e && e.__esModule ? e : {default: e}
};
Object.defineProperty(exports, "__esModule", {value: !0}), exports.DuplicateButton = void 0;
const react_1 = __importDefault(require("react")), mobx_react_lite_1 = require("mobx-react-lite"),
    core_1 = require("@blueprintjs/core"), popover2_1 = require("@blueprintjs/popover2"),
    l10n_1 = require("../utils/l10n");
exports.DuplicateButton = (0, mobx_react_lite_1.observer)((({store: e}) => {
    const t = e.selectedElements.length > 0;
    return react_1.default.createElement(popover2_1.Tooltip2, {
        content: (0, l10n_1.t)(duplicateElements),
        disabled: !t,
        placement:"bottom",
    }, react_1.default.createElement(core_1.Button, {
        icon: "duplicate", minimal: !0, onClick: () => {
            const t = [];
            e.selectedElements.forEach((e => {
                t.push(e.clone({x: e.x + 50, y: e.y + 50}).id)
            })), e.selectElements(t)
        }, disabled: !t
    }))
}));
