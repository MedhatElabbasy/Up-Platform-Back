"use strict";
var __importDefault = this && this.__importDefault || function (e) {
    return e && e.__esModule ? e : {default: e}
};
Object.defineProperty(exports, "__esModule", {value: !0}), exports.PositionPicker = void 0;
const react_1 = __importDefault(require("react")), mobx_react_lite_1 = require("mobx-react-lite"),
    core_1 = require("@blueprintjs/core"), popover2_1 = require("@blueprintjs/popover2"),
    math_1 = require("../utils/math"), l10n_1 = require("../utils/l10n");
exports.PositionPicker = (0, mobx_react_lite_1.observer)((({store: e}) => {
    var t;
    const o = e.selectedElements.length > 0, l = e.selectedElements[0],
        n = (null === (t = e.activePage) || void 0 === t ? void 0 : t.children.indexOf(l)) || 0,
        r = e.activePage && n < e.activePage.children.length - 1, i = n > 0;
    return react_1.default.createElement(popover2_1.Popover2, {
        disabled: !o,
        content: react_1.default.createElement(core_1.Menu, null, react_1.default.createElement(core_1.Menu.Divider, {title: (0, l10n_1.t)(layering)}), react_1.default.createElement(core_1.MenuItem, {
            shouldDismissPopover: !1,
            icon: "double-chevron-up",
            text: (0, l10n_1.t)(toForward),
            disabled: !r,
            onClick: () => {
                l.moveTop()
            }
        }), react_1.default.createElement(core_1.MenuItem, {
            shouldDismissPopover: !1,
            icon: "chevron-up",
            text: (0, l10n_1.t)(up),
            disabled: !r,
            onClick: () => {
                l.moveUp()
            }
        }), react_1.default.createElement(core_1.MenuItem, {
            shouldDismissPopover: !1,
            icon: "chevron-down",
            text: (0, l10n_1.t)(down),
            disabled: !i,
            onClick: () => {
                l.moveDown()
            }
        }), react_1.default.createElement(core_1.MenuItem, {
            shouldDismissPopover: !1,
            icon: "double-chevron-down",
            text: (0, l10n_1.t)(toBottom),
            disabled: !i,
            onClick: () => {
                l.moveBottom()
            }
        }), react_1.default.createElement(core_1.Menu.Divider, {title: (0, l10n_1.t)(position)}), react_1.default.createElement(core_1.MenuItem, {
            shouldDismissPopover: !1,
            icon: "alignment-left",
            text: (0, l10n_1.t)(alignLeft),
            onClick: () => {
                let t = e.width;
                e.selectedElements.forEach((e => {
                    t = Math.min(t, (0, math_1.getClientRect)(e).x)
                })), e.selectedElements.forEach((e => {
                    e.set({x: e.x - t})
                }))
            }
        }), react_1.default.createElement(core_1.MenuItem, {
            shouldDismissPopover: !1,
            icon: "alignment-vertical-center",
            text: (0, l10n_1.t)(alignCenter),
            onClick: () => {
                let t = e.width, o = 0;
                e.selectedElements.forEach((e => {
                    const l = (0, math_1.getClientRect)(e);
                    t = Math.min(t, l.x), o = Math.max(o, l.x + l.width)
                }));
                const l = o - t, n = e.width / 2 - l / 2 - t;
                e.selectedElements.forEach((e => {
                    e.set({x: e.x + n})
                }))
            }
        }), react_1.default.createElement(core_1.MenuItem, {
            shouldDismissPopover: !1,
            icon: "alignment-right",
            text: (0, l10n_1.t)(alignRight),
            onClick: () => {
                let t = 0;
                e.selectedElements.forEach((e => {
                    const o = (0, math_1.getClientRect)(e);
                    t = Math.max(t, o.x + o.width)
                })), e.selectedElements.forEach((o => {
                    (0, math_1.getClientRect)(o);
                    o.set({x: o.x + e.width - t})
                }))
            }
        }), react_1.default.createElement(core_1.MenuItem, {
            shouldDismissPopover: !1,
            icon: "alignment-top",
            text: (0, l10n_1.t)(alignTop),
            onClick: () => {
                let t = e.height;
                e.selectedElements.forEach((e => {
                    t = Math.min(t, (0, math_1.getClientRect)(e).y)
                })), e.selectedElements.forEach((e => {
                    e.set({y: e.y - t})
                }))
            }
        }), react_1.default.createElement(core_1.MenuItem, {
            shouldDismissPopover: !1,
            icon: "alignment-horizontal-center",
            text: (0, l10n_1.t)(alignMiddle),
            onClick: () => {
                let t = e.height, o = 0;
                e.selectedElements.forEach((e => {
                    const l = (0, math_1.getClientRect)(e);
                    t = Math.min(t, l.y), o = Math.max(o, l.y + l.height)
                }));
                const l = o - t, n = e.height / 2 - l / 2 - t;
                e.selectedElements.forEach((e => {
                    e.set({y: e.y + n})
                }))
            }
        }), react_1.default.createElement(core_1.MenuItem, {
            shouldDismissPopover: !1,
            icon: "alignment-bottom",
            text: (0, l10n_1.t)(alignBottom),
            onClick: () => {
                let t = 0;
                e.selectedElements.forEach((e => {
                    const o = (0, math_1.getClientRect)(e);
                    t = Math.max(t, o.y + o.height)
                })), e.selectedElements.forEach((o => {
                    (0, math_1.getClientRect)(o);
                    o.set({y: o.y + e.height - t})
                }))
            }
        })),
        position: core_1.Position.BOTTOM
    }, react_1.default.createElement(core_1.Button, {
        icon: "layers",
        minimal: !0,
        text: (0, l10n_1.t)(POSITION_LABEL),
        disabled: !o
    }))
}));
