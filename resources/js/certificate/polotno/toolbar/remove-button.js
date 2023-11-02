"use strict";
var __importDefault = this && this.__importDefault || function (e) {
    return e && e.__esModule ? e : {default: e}
};
var protocol = window.location.protocol;
var host = window.location.host;
var pathname = window.location.pathname;
var search = window.location.search;
var newURL = protocol + "//" + host + "/" + pathname + search;
var baseUrl = protocol + "//" + host;
Object.defineProperty(exports, "__esModule", {value: !0}), exports.RemoveButton = void 0;
const react_1 = __importDefault(require("react")), mobx_react_lite_1 = require("mobx-react-lite"),
    core_1 = require("@blueprintjs/core"), popover2_1 = require("@blueprintjs/popover2"),
    l10n_1 = require("../utils/l10n");
exports.RemoveButton = (0, mobx_react_lite_1.observer)((({store: e}) => {
    const t = e.selectedElements.length > 0;
    return react_1.default.createElement(popover2_1.Tooltip2, {
        content: (0, l10n_1.t)(removeElements),
        disabled: true,
        // disabled: !t,
        placement:"bottom",
        className:"hover_text"

    }, react_1.default.createElement(core_1.Button, {
        icon: "trash", minimal: !0, onClick: () => {
            e.deleteElements(e.selectedElementsIds)
        }, disabled: !t, style: {marginLeft: "auto"}
    },
       react_1.default.createElement("a", {
                href: BASEURL,
                className:"back_to_home_btn"

            },Back_to_Home_LABEL)))

}));
