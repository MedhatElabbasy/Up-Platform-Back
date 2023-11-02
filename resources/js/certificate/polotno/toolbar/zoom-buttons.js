"use strict";
var __importDefault = this && this.__importDefault || function (e) {
    return e && e.__esModule ? e : {default: e}
};
Object.defineProperty(exports, "__esModule", {value: !0}), exports.ZoomButtons = exports.ZoomGroup = void 0;
const react_1 = __importDefault(require("react")), core_1 = require("@blueprintjs/core"),
    styled_1 = __importDefault(require("../utils/styled")), mobx_react_lite_1 = require("mobx-react-lite"),
    l10n_1 = require("../utils/l10n"), Container = (0, styled_1.default)("div")`
  position: absolute;
  bottom: 5px;
  left: 20px;
  width: auto;
  opacity: 0.8;
  border-radius: 5px;
  overflow: hidden;
  box-shadow: none;
  background: none;

  &:hover {
    opacity: 1;
  }

  @media screen and (max-width: 500px) {
    display: none;
  }
`, FACTOR = 1.2;
exports.ZoomGroup = (0, mobx_react_lite_1.observer)((({store: e}) => {
    const t = Math.max(2, e.scaleToFit), o = Math.min(.5, e.scaleToFit), r = e.scale < t, a = e.scale > o;
    return react_1.default.createElement(core_1.Navbar.Group, {align: core_1.Alignment.LEFT,className:'zoom_btn'}, react_1.default.createElement(core_1.Button, {
        icon: "zoom-out",
        minimal: !0,
        onClick: () => {
            e.setScale(e.scale / 1.2)
        },
        disabled: !a
    }), react_1.default.createElement(core_1.Button, {
        minimal: !0, onClick: () => {
            e.setScale(e.scaleToFit)
        }
    }, (0, l10n_1.t)(RESET_LABEL)), react_1.default.createElement(core_1.Button, {
        icon: "zoom-in",
        minimal: !0,
        onClick: () => {
            e.setScale(1.2 * e.scale)
        },
        disabled: !r
    }))
})), exports.ZoomButtons = (0, mobx_react_lite_1.observer)((({store: e}) => react_1.default.createElement(Container, null, react_1.default.createElement(core_1.Navbar, null, react_1.default.createElement(exports.ZoomGroup, {store: e}))))), exports.default = exports.ZoomButtons;
