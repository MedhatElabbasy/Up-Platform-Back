"use strict";
var __rest = this && this.__rest || function (e, t) {
    var r = {};
    for (var n in e) Object.prototype.hasOwnProperty.call(e, n) && t.indexOf(n) < 0 && (r[n] = e[n]);
    if (null != e && "function" == typeof Object.getOwnPropertySymbols) {
        var o = 0;
        for (n = Object.getOwnPropertySymbols(e); o < n.length; o++) t.indexOf(n[o]) < 0 && Object.prototype.propertyIsEnumerable.call(e, n[o]) && (r[n[o]] = e[n[o]])
    }
    return r
}, __importDefault = this && this.__importDefault || function (e) {
    return e && e.__esModule ? e : {default: e}
};
Object.defineProperty(exports, "__esModule", {value: !0}), exports.registerNextDomDrop = exports.registerTransformerAttrs = void 0;
const react_1 = __importDefault(require("react")), mobx_react_lite_1 = require("mobx-react-lite"),
    mobx_1 = require("mobx"), react_konva_1 = require("react-konva"), core_1 = require("@blueprintjs/core"),
    popover2_1 = require("@blueprintjs/popover2"), use_image_1 = __importDefault(require("use-image")),
    konva_1 = __importDefault(require("konva")), element_1 = __importDefault(require("./element")),
    use_transformer_snap_1 = require("./use-transformer-snap"), image_element_1 = require("./image-element"),
    crop_1 = require("../utils/crop"), DEFAULT_TRANSFORMER_ATTRIBUTES = {
        enabledAnchors: ["top-left", "top-center", "top-right", "middle-left", "bottom-left", "bottom-right", "bottom-center", "middle-right"],
        rotateEnabled: !0,
        rotationSnaps: [0, 45, 90, 135, 180, 225, 270, 315],
        ignoreStroke: !0,
        anchorStrokeWidth: 2,
        borderStrokeWidth: 2
    }, transformerAttributes = {
        text: {enabledAnchors: ["top-left", "top-right", "middle-left", "bottom-left", "bottom-right", "middle-right"]},
        svg: {enabledAnchors: ["top-left", "top-right", "bottom-left", "bottom-right"]},
        many: {enabledAnchors: ["top-left", "top-right", "bottom-left", "bottom-right"]}
    };

function registerTransformerAttrs(e, t) {
    transformerAttributes[e] = transformerAttributes[e] || t, Object.assign(transformerAttributes[e], t)
}

exports.registerTransformerAttrs = registerTransformerAttrs;
const Background = e => react_1.default.createElement(react_konva_1.Rect, Object.assign({}, e, {preventDefault: !1})),
    ImageBackground = e => {
        var {url: t} = e, r = __rest(e, ["url"]);
        // const [n, o] = (0, use_image_1.default)(t, "anonymous"),
        //     a = n ? (0, crop_1.getCrop)(n, {width: r.width, height: r.height}, "center-middle") : {};

        const [n, o] = (0, use_image_1.default)(t, "anonymous"),
            a = n ? (0, crop_1.getCrop)(n, {width: "100%", height: "100%"}, "center-middle") : {};

        return (0, image_element_1.useImageLoader)(o), react_1.default.createElement(react_konva_1.Image, Object.assign({image: n}, r, a))
    }, ColorBackground = e => react_1.default.createElement(react_konva_1.Rect, Object.assign({}, e)),
    PageBackground = e => {
        const {background: t, scale: r, borderColor: n} = e, o = __rest(e, ["background", "scale", "borderColor"]),
            a = t.indexOf("http") >= 0 || t.indexOf(".png") >= 0 || t.indexOf(".jpg") >= 0, l = 1 / r;

        return react_1.default.createElement(react_1.default.Fragment, null, react_1.default.createElement(react_konva_1.Rect, {
            name: "page-highlight",
            x: -1.5 * l,
            y: -1.5 * l,
            width: e.width + 3 * l,
            height: e.height + 3 * l,
            stroke: n,
            strokeWidth: 3,
            listening: !1,
            strokeScaleEnabled: !1
        }), a ? react_1.default.createElement(ImageBackground, Object.assign({url: t}, o)) : react_1.default.createElement(ColorBackground, Object.assign({fill: t}, o)))
    },
    Selection = (0, mobx_react_lite_1.observer)((({selection: e}) => e.visible ? react_1.default.createElement(react_konva_1.Rect, {
        name: "selection",
        x: Math.min(e.x1, e.x2),
        y: Math.min(e.y1, e.y2),
        width: Math.abs(e.x1 - e.x2),
        height: Math.abs(e.y1 - e.y2),
        fill: "rgba(0, 161, 255, 0.3)"
    }) : null)), Elements = (0, mobx_react_lite_1.observer)((({elements: e, store: t}) => {
        const r = e.filter((e => e.alwaysOnTop)), n = e.filter((e => !e.alwaysOnTop)).concat(r);
        return react_1.default.createElement(react_1.default.Fragment, null, n.map((e => react_1.default.createElement(element_1.default, {
            key: e.id,
            store: t,
            element: e,
            onClick: () => {
                console.warn("Polotno warning: onClick callback is deprecated. Just stop using it. Polotno will do selection automatically.")
            }
        }))))
    }));
let onDomDrop = null;
const registerNextDomDrop = e => {
    onDomDrop = e
};
exports.registerNextDomDrop = registerNextDomDrop, exports.default = (0, mobx_react_lite_1.observer)((({
                                                                                                           store: e,
                                                                                                           page: t,
                                                                                                           xPadding: r,
                                                                                                           yPadding: n,
                                                                                                           width: o,
                                                                                                           height: a,
                                                                                                           pageControlsEnabled: l,
                                                                                                           backColor: i,
                                                                                                           pageBorderColor: c,
                                                                                                           activePageBorderColor: s
                                                                                                       }) => {
    const d = react_1.default.useRef(null), u = react_1.default.useRef(null), m = react_1.default.useRef(null),
        g = null == l || l, _ = e.pages.length > 1, f = e.pages.indexOf(t),
        p = e.selectedElements.find((e => e._cropModeEnabled)),
        h = e.selectedElements.filter((e => e.locked)).length > 0;
    react_1.default.useEffect((() => {
        var t, r;
        if (!d.current) return;
        const n = d.current.getStage(),
            o = e.selectedElements.map((e => e._cropModeEnabled ? null : n.findOne("#" + e.id))).filter((e => e)),
            a = 1 === e.selectedElements.length && (null === (t = e.selectedElements[0]) || void 0 === t ? void 0 : t.type) || "many";
        h ? (d.current.enabledAnchors([]), d.current.rotateEnabled(!1)) : transformerAttributes[a] ? (d.current.setAttrs(Object.assign(Object.assign({}, DEFAULT_TRANSFORMER_ATTRIBUTES), transformerAttributes[a])), "svg" !== a || e.selectedElements[0].keepRatio || d.current.setAttrs({enabledAnchors: DEFAULT_TRANSFORMER_ATTRIBUTES.enabledAnchors})) : d.current.setAttrs(DEFAULT_TRANSFORMER_ATTRIBUTES), d.current.nodes(o), null === (r = d.current.getLayer()) || void 0 === r || r.batchDraw()
    }), [e.selectedElements, p, h]);
    const v = (0, mobx_react_lite_1.useLocalObservable)((() => ({visible: !1, x1: 0, y1: 0, x2: 0, y2: 0}))),
        b = react_1.default.useRef(!1), E = (0, mobx_1.action)((r => {
            var n, o;
            b.current = !1, e.activePage !== t && t.select();
            const a = r.target.findAncestor(".elements-container"), l = r.target.findAncestor("Transformer"),
                i = r.target.findAncestor(".page-abs-container");
            if (a || l || i) return;
            const c = null === (n = r.target.getStage()) || void 0 === n ? void 0 : n.getPointerPosition();
            c && (v.visible = !0, v.x1 = c.x, v.y1 = c.y, v.x2 = c.x, v.y2 = c.y, (null === (o = r.target.getStage()) || void 0 === o ? void 0 : o.getPointersPositions().length) >= 2 && (v.visible = !1))
        }));
    react_1.default.useEffect((() => {
        const t = (0, mobx_1.action)((e => {
            var t, r;
            if (!v.visible) return;
            null === (t = u.current) || void 0 === t || t.setPointersPositions(e);
            let n = (null === (r = u.current) || void 0 === r ? void 0 : r.getPointerPosition()) || {x: v.x2, y: v.y2};
            v.x2 = n.x, v.y2 = n.y
        })), r = (0, mobx_1.action)((() => {
            if (!v.visible) return;
            if (!u.current) return;
            const t = u.current.findOne(".selection"), r = t ? t.getClientRect() : {width: 0, height: 0, x: 0, y: 0};
            if (r.width && r.height) {
                const t = [];
                u.current.find(".element").forEach((n => {
                    const o = n.getClientRect(), a = e.getElementById(n.id()), l = null == a ? void 0 : a.locked,
                        i = null == a ? void 0 : a.selectable;
                    konva_1.default.Util.haveIntersection(r, o) && !l && i && t.push(n.id())
                })), e.selectElements(t)
            }
            v.visible = !1, b.current = !0
        }));
        return window.addEventListener("mousemove", t), window.addEventListener("touchmove", t), window.addEventListener("mouseup", r), window.addEventListener("touchend", r), () => {
            window.removeEventListener("mousemove", t), window.removeEventListener("touchmove", t), window.removeEventListener("mouseup", r), window.removeEventListener("touchend", r)
        }
    }), []);
    const x = t => {
        if (b.current) return;
        const r = t.evt.ctrlKey || t.evt.metaKey || t.evt.shiftKey, n = t.target.findAncestor(".elements-container"),
            o = t.target.findAncestor(".page-abs-container"), a = t.target.findAncestor("Transformer");
        if (!(r || n || a || o)) return void e.selectElements([]);
        const l = t.target.findAncestor(".element", !0),
            i = e.selectedElementsIds.indexOf(null == l ? void 0 : l.id()) >= 0;
        l && r && !i && e.selectElements(e.selectedElementsIds.concat([l.id()])), l && r && i && e.selectElements(e.selectedElementsIds.filter((e => e !== l.id()))), !l || r || i || e.selectElements([l.id()])
    };
    (0, use_transformer_snap_1.useSnap)(d);
    const w = e.activePage === t;
    return react_1.default.createElement("div", {
        ref: m,
        onDragOver: e => e.preventDefault(),
        onDrop: t => {
            if (t.preventDefault(), !u.current) return;
            u.current.setPointersPositions(t);
            const r = u.current.findOne(".elements-container").getRelativePointerPosition(),
                n = u.current.getPointerPosition(), o = u.current.getIntersection(n),
                a = o && o.findAncestor(".element", !0), l = a ? e.getElementById(a.id()) : void 0;
            onDomDrop && (onDomDrop(r, l), onDomDrop = null)
        },
        style: {position: "relative", width: o + "px"},
        className: "polotno-page-container" + (w ? " active-page" : "")
    }, react_1.default.createElement(react_konva_1.Stage, {
        ref: u,
        width: o,
        height: a,
        onClick: x,
        onTap: x,
        onMouseDown: E,
        onDragStart: t => {
            var r;
            if (t.target.hasName("element")) {
                const n = t.target.id();
                !(e.selectedElementsIds.indexOf(n) >= 0) && n && (e.selectElements([n]), null === (r = d.current) || void 0 === r || r.startDrag(t))
            }
        },
        pageId: t.id,
        style: {position: "relative"}
    }, react_1.default.createElement(react_konva_1.Layer, null, react_1.default.createElement(Background, {
        width: o,
        height: a,
        fill: i
    }), react_1.default.createElement(react_konva_1.Group, {
        x: r,
        y: n,
        scaleX: e.scale,
        scaleY: e.scale,
        name: "page-container"
    }, react_1.default.createElement(PageBackground, {
        width: e.width,
        height: e.height,
        background: t.background,
        shadowBlur: 10,
        shadowColor: "lightgrey",
        name: "page-background",
        preventDefault: !1,
        scale: e.scale,
        active: w && e.pages.length > 1,
        // borderColor: w && e.pages.length > 1 ? s : c
        borderColor: w && e.pages.length > 1 ? '#1099fc' : '#1099fc'
    }), react_1.default.createElement(react_konva_1.Group, {
        clipX: 0,
        clipY: 0,
        clipWidth: e.width,
        clipHeight: e.height,
        name: "elements-container"
    }, react_1.default.createElement(Elements, {
        elements: t.children,
        store: e
    }))), react_1.default.createElement(react_konva_1.Group, {
        x: r,
        y: n,
        scaleX: e.scale,
        scaleY: e.scale,
        name: "page-abs-container"
    }, react_1.default.createElement(react_konva_1.Transformer, {
        ref: d, boundBoxFunc: (e, t) => {
            const r = t.width < 1 || t.height < 1, n = e.width < 1 || e.height < 1;
            return r && !n ? e : t
        }
    })), react_1.default.createElement(Selection, {selection: v}), e._showCredit && react_1.default.createElement(react_konva_1.Text, {
        text: "Powered by polotno.dev",
        fontSize: 14,
        fill: "rgba(0,0,0,0.6)",
        x: o - 170,
        y: a - 18,
        onMouseEnter: e => {
            e.target.getStage().container().style.cursor = "pointer"
        },
        onMouseLeave: e => {
            e.target.getStage().container().style.cursor = ""
        },
        onTouchStart: e => {
            e.cancelBubble = !0
        },
        onMouseDown: e => {
            e.cancelBubble = !0
        },
        onClick: () => {
            window.open("https://polotno.dev")
        },
        onTap: () => {
            window.open("https://polotno.dev")
        }
    }))), g && w && react_1.default.createElement("div", {
            style: {
                position: "absolute",
                top: n - 45 + "px",
                right: r + "px",
                bottom: 20 + "px",
            },
            className: 'in_page_btn_group'
        }, _ && react_1.default.createElement(popover2_1.Tooltip2, {
        content: "Move up",
        disabled: 0 === f
    }, react_1.default.createElement(core_1.Button, {
        icon: "chevron-up",
        minimal: !0,
        disabled: 0 === f,
        onClick: () => {
            t.setZIndex(f - 1)
        }
    })), _ && react_1.default.createElement(popover2_1.Tooltip2, {
        content: "Move down",
        disabled: f === e.pages.length - 1,
        placement: "bottom",
    }, react_1.default.createElement(core_1.Button, {
        icon: "chevron-down",
        minimal: !0,
        disabled: f === e.pages.length - 1,
        placement: "bottom",
        onClick: () => {
            const r = e.pages.indexOf(t);
            t.setZIndex(r + 1)
        }
    })),


        react_1.default.createElement(popover2_1.Tooltip2, {
            content: "Rotate page",
            placement: "bottom"
        },
            react_1.default.createElement(core_1.Button, {
            icon: "rotate-document",
            minimal: !0,
            onClick: () => {
                let width = e.width;
                let height = e.height;
                let vHeight = e.vHeight;
                let vWidth = e.vWidth;
                e.setHeight(width);
                e.setWidth(height);
                e.setVWidth(vHeight);
                e.setVHeight(vWidth);
            },
            className: 'in_page_btn'
        })),


        react_1.default.createElement(popover2_1.Tooltip2, {
            content: "Duplicate page",
            placement: "bottom"
        }, react_1.default.createElement(core_1.Button, {
            icon: "duplicate",
            minimal: !0,
            onClick: () => {
                t.clone()
            },
            className: 'in_page_btn'
        })), _ && react_1.default.createElement(popover2_1.Tooltip2, {
        content: "Remove page",
        placement: "bottom"
    }, react_1.default.createElement(core_1.Button, {
        icon: "trash",
        minimal: !0,
        onClick: () => {
            e.deletePages([t.id])
        }
    })), react_1.default.createElement(popover2_1.Tooltip2, {
            content: "Add new page",
            placement: "bottom"
        }, react_1.default.createElement(core_1.Button, {
            icon: "insert",
            minimal: !0,
            onClick: () => {
                const r = e.addPage(), n = e.pages.indexOf(t);
                r.setZIndex(n + 1)
            }
        }))))
}));
