"use strict";
var __importDefault = this && this.__importDefault || function (e) {
    return e && e.__esModule ? e : {default: e}
};
Object.defineProperty(exports, "__esModule", {value: !0}), exports.LockButton = void 0;
const react_1 = __importDefault(require("react")), mobx_react_lite_1 = require("mobx-react-lite"),
    core_1 = require("@blueprintjs/core"), popover2_1 = require("@blueprintjs/popover2"),
    l10n_1 = require("../utils/l10n");
exports.LockButton = (0, mobx_react_lite_1.observer)((({store: e}) => {
    const t = e.selectedElements.length > 0, o = e.selectedElements[0], r = null == o ? void 0 : o.locked,
        l = r ? "lock" : "unlock",
        c = r ? (0, l10n_1.t)(lockedDescription) : (0, l10n_1.t)(unlockedDescription);
    return react_1.default.createElement(popover2_1.Tooltip2, {
        content: c,
        disabled: !t,
        placement:"bottom",
    }, react_1.default.createElement(core_1.Button, {
        minimal: !0, disabled: !t, icon: l, onClick: () => {
            e.selectedElements.forEach((e => e.set({locked: !e.locked})))
        }
    }))
}));
