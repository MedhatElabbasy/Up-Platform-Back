"use strict";
var __rest = this && this.__rest || function (e, t) {
    var o = {};
    for (var a in e) Object.prototype.hasOwnProperty.call(e, a) && t.indexOf(a) < 0 && (o[a] = e[a]);
    if (null != e && "function" == typeof Object.getOwnPropertySymbols) {
        var n = 0;
        for (a = Object.getOwnPropertySymbols(e); n < a.length; n++) t.indexOf(a[n]) < 0 && Object.prototype.propertyIsEnumerable.call(e, a[n]) && (o[a[n]] = e[a[n]])
    }
    return o
}, __importDefault = this && this.__importDefault || function (e) {
    return e && e.__esModule ? e : {default: e}
};
Object.defineProperty(exports, "__esModule", {value: !0}), exports.TextPanel = void 0;
const react_1 = __importDefault(require("react")), mobx_react_lite_1 = require("mobx-react-lite"),
    core_1 = require("@blueprintjs/core"), swr_1 = __importDefault(require("swr")), l10n_1 = require("../utils/l10n"),
    styled_1 = __importDefault(require("../utils/styled")), screen_1 = require("../utils/screen"),
    images_grid_1 = require("./images-grid"), api_1 = require("../utils/api"), use_api_1 = require("../utils/use-api"),
    page_1 = require("../canvas/page"), Container = (0, styled_1.default)("div")`
  height: calc(100% - 40px);
  display: flex;
  flex-direction: column;

  .bp3-dark & .polotno-text-preview-plain {
    filter: invert(1);
  }
`, toBase64 = e => new Promise(((t, o) => {
        const a = new FileReader;
        a.readAsDataURL(e), a.onload = () => t(a.result), a.onerror = e => o(e)
    })), FontItem = (0, mobx_react_lite_1.observer)((({
                                                          onSelect: e,
                                                          onRemove: t,
                                                          font: o
                                                      }) => react_1.default.createElement("div", {
        style: {
            height: "100px",
            cursor: "pointer",
            boxShadow: "0 0 5px rgba(16, 22, 26, 0.3)",
            borderRadius: "5px",
            backgroundColor: "rgba(0, 0, 0, 0.4)",
            position: "relative",
            fontFamily: o.fontFamily,
            fontSize: 25,
            display: "flex",
            justifyContent: "center",
            alignContent: "center",
            flexDirection: "column",
            textAlign: "center",
            color: "white",
            marginBottom: "10px"
        }, onClick: e
    }, o.fontFamily, " text ", react_1.default.createElement(core_1.Button, {
        style: {
            position: "absolute",
            right: 0,
            bottom: 0
        }, minimal: !0, icon: "trash", onClick: e => {
            e.stopPropagation(), t()
        }
    })))), DragButton = e => {
        var {onSelect: t} = e, o = __rest(e, ["onSelect"]);
        return react_1.default.createElement(core_1.Button, Object.assign({}, o, {
            draggable: !0,
            className: "polotno-close-panel",
            onClick: () => t(),
            onDragStart: () => {
                (0, page_1.registerNextDomDrop)((({x: e, y: o}) => {
                    t({x: e, y: o})
                }))
            },
            onDragEnd: e => {
                (0, page_1.registerNextDomDrop)(null)
            }
        }))
    };
const {shortCodeImage, AppUrl} = require("../utils/api");
exports.TextPanel = (0, mobx_react_lite_1.observer)((({store: e}) => {
    react_1.default.useEffect((() => {
        e.loadFont("Roboto")
    }), []);
    const t = t => {
        var o;
        const a = t.width || e.width / 2, n = ((null == t ? void 0 : t.x) || e.width / 2) - a / 2,
            l = ((null == t ? void 0 : t.y) || e.height / 2) - t.fontSize / 2,
            i = null === (o = e.activePage) || void 0 === o ? void 0 : o.addElement(Object.assign(Object.assign({
                type: "text",
                fontFamily: "Roboto"
            }, t), {x: n, y: l, width: a}));
        (0, screen_1.isMobile)() || null == i || i.toggleEditMode(!0)
    };
    react_1.default.useEffect((() => {
        e.fonts.forEach((t => e.loadFont(t.fontFamily)))
    }), [e.fonts]);
    const {
        data: o,
        error: a
    } = (0, swr_1.default)((0, api_1.textTemplateList)(), use_api_1.fetcher), [n, l] = react_1.default.useState("text");
    return react_1.default.createElement("div", {
            style: {
                height: "100%",
                display: "flex",
                flexDirection: "column"
            }
        }, react_1.default.createElement(core_1.Tabs, {
                large: !0,
                onChange: e => l(e)
            },
            // react_1.default.createElement(core_1.Tab, {id: "text"}, (0, l10n_1.t)("sidePanel.text")),
            // react_1.default.createElement(core_1.Tab, {id: "font"}, (0, l10n_1.t)("sidePanel.myFonts"))),
            // "text" === n &&
            // react_1.default.createElement(Container, null,


            react_1.default.createElement("div", {className: 'single_code_box'},
                react_1.default.createElement("div", {className: 'single_code'},
                    react_1.default.createElement(DragButton, {
                        style: {
                            marginBottom: "5px",
                            width: "100%",
                            fontSize: "14px",
                            fontFamily: "Roboto"
                        }, minimal: !0, onSelect: e => {
                            t(Object.assign(Object.assign({}, e), {fontSize: 12, text: "Body text", fontFamily: "Roboto"}))
                        }
                    }, react_1.default.createElement(core_1.Icon, {
                        icon: "new-text-box",
                        style: {display: 'block', textAlign: 'center', marginBottom: "4px", fontSize: "16px"}
                    }), "Body Text")),
            )),

        "font" === n && react_1.default.createElement("div", {
            style: {
                display: "flex",
                flexDirection: "column",
                height: "calc(100% - 50px)"
            }
        }, react_1.default.createElement("label", {htmlFor: "polotno-font-upload"}, react_1.default.createElement(core_1.Button, {
            icon: "upload",
            style: {width: "100%"},
            onClick: () => {
                var e;
                null === (e = document.querySelector("#polotno-font-upload")) || void 0 === e || e.click()
            }
        }, (0, l10n_1.t)("sidePanel.uploadFont")), react_1.default.createElement("input", {
            type: "file",
            accept: ".ttf, .otf, .woff, .woff2, .eot",
            id: "polotno-font-upload",
            style: {display: "none"},
            onChange: async t => {
                const {target: o} = t;
                for (const t of o.files) {
                    const o = await toBase64(t), a = t.name.split(".")[0];
                    e.addFont({fontFamily: a, url: o})
                }
                o.value = null
            }
        })), react_1.default.createElement("div", {
            style: {
                paddingTop: "20px",
                overflow: "auto",
                height: "100%"
            }
        }, e.fonts.map(((o, a) => react_1.default.createElement(FontItem, {
            font: o, key: a, onSelect: () => {
                t({fontSize: 80, text: "Cool curved text", fontFamily: o.fontFamily})
            }, onRemove: () => {
                e.removeFont(o.fontFamily)
            }
        }))))))
}));
