"use strict";
var __importDefault = this && this.__importDefault || function (e) {
    return e && e.__esModule ? e : {default: e}
};
Object.defineProperty(exports, "__esModule", {value: !0}), exports.TextToolbar = exports.SpacingInput = exports.FontColorInput = exports.FontStyleGroup = exports.FontSizeInput = exports.FontFamilyInput = void 0;
const react_1 = __importDefault(require("react")), mobx_react_lite_1 = require("mobx-react-lite"),
    core_1 = require("@blueprintjs/core"), popover2_1 = require("@blueprintjs/popover2"),
    react_window_1 = require("react-window"), swr_1 = __importDefault(require("swr")),
    fonts_1 = require("../utils/fonts"), api_1 = require("../utils/api"), use_api_1 = require("../utils/use-api"),
    color_picker_1 = __importDefault(require("./color-picker")),
    filters_picker_1 = __importDefault(require("./filters-picker")),
    MdcFormatLineSpacing_1 = __importDefault(require("@meronex/icons/mdc/MdcFormatLineSpacing")),
    styled_1 = __importDefault(require("../utils/styled")), Image = (0, styled_1.default)("img")`
  height: 20px;

  .bp3-dark & {
    filter: invert(1);
  }
`, googleFonts = (0, fonts_1.getFontsList)(),
    FontItem = ({fontFamily: e, handleClick: t, modifiers: n, store: o, isCustom: r}) => {
        react_1.default.useEffect((() => {
            r && o.loadFont(e)
        }), [e, r]);
        // const a = r ? e : react_1.default.createElement(Image, {src: (0, api_1.getGoogleFontImage)(e)});
        const a = r ? e : react_1.default.createElement("p", {className:"front_name"},e);
        return react_1.default.createElement(core_1.MenuItem, {
            text: a,
            active: n.active,
            disabled: n.disabled,
            onClick: t,
            style: {fontFamily: '"' + e + '"'},
            className: 'front_name_div'
        })
    }, SearchInput = ({onChange: e}) => {
        const t = react_1.default.useRef(null);
        return react_1.default.useEffect((() => {
            t.current && t.current.focus()
        }), []), react_1.default.createElement(core_1.InputGroup, {
            leftIcon: "search",
            inputRef: t,
            onChange: t => e(t.target.value)
        })
    }, FontMenu = ({store: e, fonts: t, activeFont: n, activeFontLabel: o, onFontSelect: r}) => {
        const [a, l] = react_1.default.useState(""), i = t.filter((e => e.toLowerCase().indexOf(a.toLowerCase()) >= 0));
        return react_1.default.createElement(popover2_1.Popover2, {
            content: react_1.default.createElement("div", null, react_1.default.createElement(SearchInput, {onChange: e => l(e)}), react_1.default.createElement("div", {style: {paddingTop: "5px"}}, react_1.default.createElement(react_window_1.FixedSizeList, {
                innerElementType: react_1.default.forwardRef(((e, t) => react_1.default.createElement(core_1.Menu, Object.assign({ref: t}, e)))),
                height: Math.min(400, 30 * i.length) + 10,
                width: 210,
                itemCount: i.length,
                itemSize: 30,
                className: 'front_div',
                children: ({index: t, style: o}) => {
                    const a = i[t];
                    return react_1.default.createElement("div", {style: o,className:'li_div'}, react_1.default.createElement(FontItem, {
                        key: a,
                        fontFamily: a,
                        modifiers: {active: n === a},
                        handleClick: () => r(a),
                        store: e,
                        className: 'front_li',
                        isCustom: e.fonts.find((e => e.fontFamily === a)) || fonts_1.globalFonts.find((e => e.fontFamily === a))
                    }))
                }
            })))
        }, react_1.default.createElement(core_1.Button, {
            text: o,
            rightIcon: "caret-down",
            minimal: !0,
            style: {marginRight: "5px", fontFamily: '"' + n + '"', overflow: "hidden", whiteSpace: "nowrap"}
        }))
    };
exports.FontFamilyInput = (0, mobx_react_lite_1.observer)((({element: e, store: t}) => {
    const {
        data: n,
        mutate: o
    } = (0, swr_1.default)((0, api_1.getGoogleFontsListAPI)(), use_api_1.fetcher, {
        isPaused: () => (0, fonts_1.isGoogleFontChanged)(),
        fallbackData: []
    });
    react_1.default.useEffect((() => {
        o()
    }), [(0, fonts_1.isGoogleFontChanged)()]);
    const r = t.fonts.concat(fonts_1.globalFonts).map((e => e.fontFamily)).concat((null == n ? void 0 : n.length) ? n : googleFonts);
    let a = e.fontFamily;
    return a.length > 15 && (a = e.fontFamily.slice(0, 15) + "..."), react_1.default.createElement(FontMenu, {
        fonts: r,
        activeFont: e.fontFamily,
        activeFontLabel: a,
        store: t,
        onFontSelect: t => {
            e.set({fontFamily: t})
        }
    })
})), exports.FontSizeInput = (0, mobx_react_lite_1.observer)((({element: e}) => react_1.default.createElement(core_1.NumericInput, {
    onValueChange: t => {
        e.set({fontSize: t})
    }, value: Math.round(e.fontSize), style: {width: "50px"}, min: 5
})));
const ALIGN_OPTIONS = ["left", "center", "right"];
exports.FontStyleGroup = (0, mobx_react_lite_1.observer)((({element: e}) => react_1.default.createElement(core_1.ButtonGroup, null, react_1.default.createElement(core_1.Button, {
    minimal: !0,
    icon: "align-" + e.align,
    onClick: () => {
        const t = (ALIGN_OPTIONS.indexOf(e.align) + 1 + ALIGN_OPTIONS.length) % ALIGN_OPTIONS.length,
            n = ALIGN_OPTIONS[t];
        e.set({align: n})
    }
}), react_1.default.createElement(core_1.Button, {
    minimal: !0,
    icon: "bold",
    active: "bold" === e.fontWeight || "700" === e.fontWeight,
    onClick: () => {
        "bold" === e.fontWeight || "700" === e.fontWeight ? e.set({fontWeight: "normal"}) : e.set({fontWeight: "bold"})
    }
}), react_1.default.createElement(core_1.Button, {
    minimal: !0,
    icon: "italic",
    active: "italic" === e.fontStyle,
    onClick: () => {
        "italic" === e.fontStyle ? e.set({fontStyle: "normal"}) : e.set({fontStyle: "italic"})
    }
}), react_1.default.createElement(core_1.Button, {
    minimal: !0,
    icon: "underline",
    active: e.textDecoration.indexOf("underline") >= 0,
    onClick: () => {
        let t = e.textDecoration.split(" ");
        t.indexOf("underline") >= 0 ? t = t.filter((e => "underline" !== e)) : t.push("underline"), e.set({textDecoration: t.join(" ")})
    }
})))), exports.FontColorInput = (0, mobx_react_lite_1.observer)((({
                                                                      element: e,
                                                                      store: t
                                                                  }) => react_1.default.createElement(color_picker_1.default, {
    value: e.fill,
    onChange: t => e.set({fill: t}),
    store: t
}))), exports.SpacingInput = (0, mobx_react_lite_1.observer)((({element: e}) => react_1.default.createElement(popover2_1.Popover2, {
    content: react_1.default.createElement("div", {
        style: {
            padding: "15px 25px",
            width: "200px"
        }
    }, react_1.default.createElement("p", null, "Line height"), react_1.default.createElement(core_1.Slider, {
        value: "number" == typeof e.lineHeight ? 100 * e.lineHeight : 120,
        labelStepSize: 50,
        onChange: t => {
            e.set({lineHeight: t / 100})
        },
        min: 50,
        max: 250,
        stepSize: 10,
        showTrackFill: !0
    }), react_1.default.createElement("p", null, "Letter spacing"), react_1.default.createElement(core_1.Slider, {
        value: 100 * e.letterSpacing,
        labelStepSize: 50,
        onChange: t => {
            e.set({letterSpacing: t / 100})
        },
        min: -50,
        max: 250,
        stepSize: 10,
        showTrackFill: !1
    })), position: core_1.Position.BOTTOM
}, react_1.default.createElement(core_1.Button, {
    icon: react_1.default.createElement(MdcFormatLineSpacing_1.default, {
        className: "bp3-icon",
        style: {fontSize: "20px"}
    }), minimal: !0
}))));
const PROPS_MAP = {
    font: exports.FontFamilyInput,
    fontSize: exports.FontSizeInput,
    fontVariant: exports.FontStyleGroup,
    filter: filters_picker_1.default,
    fontColor: exports.FontColorInput,
    spacing: exports.SpacingInput
}, Container = (0, styled_1.default)("div")`
  width: calc(100% - 450px);

  @media screen and (max-width: 500px) {
    width: auto;
  }
`;
exports.TextToolbar = (0, mobx_react_lite_1.observer)((({
                                                            store: e,
                                                            hideTextEffects: t,
                                                            hideTextSpacing: n,
                                                            hideTextBold: o,
                                                            hideTextItalic: r,
                                                            hideTextUnderline: a
                                                        }) => {
    const l = e.selectedElements[0],
        i = ["fontColor", "font", "fontSize", "fontVariant", !n && "spacing", !t && "filter"].filter((e => !!e));
    return react_1.default.createElement(Container, {className: "bp3-navbar-group bp3-align-left"},
        react_1.default.createElement(core_1.OverflowList, {
        items: i,
        style: {width: "100%"},
        visibleItemRenderer: t => {
            const n = PROPS_MAP[t];
            return react_1.default.createElement(n, {
                element: l,
                store: e,
                key: t,
                hideTextBold: o,
                hideTextItalic: r,
                hideTextUnderline: a
            })
        },
        collapseFrom: core_1.Boundary.END,

        overflowRenderer: t =>  react_1.default.createElement("div", {
            style: {
                padding: "10px",
                display: "flex"
            }
        }, t.map((t => {
            const n = PROPS_MAP[t];
            return react_1.default.createElement(n, {
                key: t,
                element: l,
                store: e,
                hideTextBold: o,
                hideTextItalic: r,
                hideTextUnderline: a
            })
        }))),
    }))
})), exports.default = exports.TextToolbar;
