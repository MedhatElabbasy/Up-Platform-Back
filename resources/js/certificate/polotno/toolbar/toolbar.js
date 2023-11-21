"use strict";
var __importDefault = this && this.__importDefault || function (e) {
    return e && e.__esModule ? e : {default: e}
};
Object.defineProperty(exports, "__esModule", {value: !0}), exports.Toolbar = exports.registerToolbarComponent = void 0;
const react_1 = __importDefault(require("react")), mobx_react_lite_1 = require("mobx-react-lite"),
    core_1 = require("@blueprintjs/core"), styled_1 = __importDefault(require("../utils/styled")),
    history_buttons_1 = require("./history-buttons"), text_toolbar_1 = require("./text-toolbar"),
    image_toolbar_1 = require("./image-toolbar"), svg_toolbar_1 = require("./svg-toolbar"),
    download_button_1 = require("./download-button"),
    duplicate_button_1 = require("./duplicate-button"),
    rotate_button_1 = require("./rotate-button"),
    remove_button_1 = require("./remove-button"),
    save_button_1 = require("./save-button"),
    lock_button_1 = require("./lock-button"),
    position_picker_1 = require("./position-picker"), opacity_picker_1 = require("./opacity-picker"),
    admin_button_1 = require("./admin-button"), ComponentsTypes = {
        text: text_toolbar_1.TextToolbar,
        image: image_toolbar_1.ImageToolbar,
        svg: svg_toolbar_1.SvgToolbar
    };

function registerToolbarComponent(e, t) {
    ComponentsTypes[e] = t
}

exports.registerToolbarComponent = registerToolbarComponent;
const NavbarContainer = (0, styled_1.default)("div")`
  @media screen and (max-width: 500px) {
    overflow-x: auto;
    overflow-y: hidden;
    max-width: 100vw;
  }
`, NavInner = (0, styled_1.default)("div")`
  @media screen and (max-width: 500px) {
    display: flex;
  }
`;
exports.Toolbar = (0, mobx_react_lite_1.observer)((({
                                                        store: e,
                                                        downloadButtonEnabled: t,
                                                        hideTextSpacing: o,
                                                        hideTextEffects: r,
                                                        hideImageFlip: a,
                                                        hideImageEffects: i,
                                                        hideImageCrop: n,
                                                        hideImageFit: l,
                                                        hidePosition: _,
                                                        hideOpacity: u,
                                                        hideDuplicate: c,
                                                        hideLock: d,
                                                        hideRemove: s
                                                    }) => {
    const m = 1 === e.selectedElements.length, p = e.selectedElements[0], b = m && ComponentsTypes[p.type],
        f = m && p._cropModeEnabled;
    return react_1.default.createElement(NavbarContainer, {className: "bp3-navbar"},
        react_1.default.createElement(NavInner,{className: "navbar_inner"}, null, !f &&
            react_1.default.createElement(history_buttons_1.HistoryButtons, {store: e}), b

            &&

        react_1.default.createElement(b, {
        store: e,
        hideTextSpacing: o,
        hideTextEffects: r,
        hideImageFlip: a,
        hideImageEffects: i,
        hideImageCrop: n,
        hideImageFit: l,


    }), !f


    &&

        react_1.default.createElement(core_1.Navbar.Group, {align: core_1.Alignment.RIGHT}, "admin" === e.role &&
        react_1.default.createElement(admin_button_1.AdminButton, {store: e}), !_ &&
        react_1.default.createElement(position_picker_1.PositionPicker, {store: e}),
        !u && react_1.default.createElement(opacity_picker_1.OpacityPicker, {store: e}), !d &&
        react_1.default.createElement(lock_button_1.LockButton, {store: e}), !c &&
        react_1.default.createElement(duplicate_button_1.DuplicateButton, {store: e}), !s &&
        react_1.default.createElement(remove_button_1.RemoveButton, {store: e}), t &&
        react_1.default.createElement(react_1.default.Fragment, null, react_1.default.createElement(core_1.Divider, {
        style: {
            height: "100%",
            margin: "0 15px"
        },
        className:'navbar_inner_right'
    }),
        react_1.default.createElement(save_button_1.SaveButton, {store: e}),
        react_1.default.createElement(core_1.Divider, {
                    style: {
                        height: "100%",
                        margin: "0 15px"
                    },
                    className:'navbar_inner_right'
                }),
        react_1.default.createElement(download_button_1.DownloadButton, {store: e})))))
})), exports.default = exports.Toolbar;
