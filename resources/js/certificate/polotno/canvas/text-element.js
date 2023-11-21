"use strict";
var __importDefault = this && this.__importDefault || function (e) {
    return e && e.__esModule ? e : {default: e}
};
Object.defineProperty(exports, "__esModule", {value: !0}), exports.TextElement = void 0;
const react_1 = __importDefault(require("react")), mobx_react_lite_1 = require("mobx-react-lite"),
    react_konva_1 = require("react-konva"), react_konva_utils_1 = require("react-konva-utils"),
    mobx_1 = require("mobx"), konva_1 = __importDefault(require("konva")), loader_1 = require("../utils/loader"),
    apply_filters_1 = require("./apply-filters"), use_fadein_1 = require("./use-fadein"),
    highlighter_1 = require("./highlighter"), styleNode = document.createElement("style");
styleNode.type = "text/css", document.head.appendChild(styleNode);
const initialStyles = {
    border: "none",
    padding: "0px",
    overflow: "hidden",
    background: "none",
    outline: "none",
    resize: "none",
    overflowWrap: "break-word",
    whiteSpace: "normal",
    userSelect: "text",
    wordBreak: "normal"
}, TextInput = (0, mobx_react_lite_1.observer)((({
                                                     textNodeRef: e,
                                                     element: t,
                                                     onBlur: r,
                                                     selectAll: n,
                                                     cursorPosition: o
                                                 }) => {
    const [a, i] = react_1.default.useState(initialStyles), l = e.current;
    react_1.default.useLayoutEffect((() => {
        const e = {};
        e.width = l.width() - 2 * l.padding() + "px", e.height = l.height() - 2 * l.padding() + 10 + "px", e.fontSize = l.fontSize() + "px", e.lineHeight = l.lineHeight() + .01, e.fontFamily = '"' + l.fontFamily() + '"', e.textAlign = l.align(), e.color = l.fill(), e.fontWeight = t.fontWeight, e.fontStyle = t.fontStyle;
        const r = `\n        .polotno-input::placeholder {\n          color: ${a.color};\n          opacity: 0.6;\n        }\n      `;
        styleNode.innerHTML = "", styleNode.appendChild(document.createTextNode(r)), JSON.stringify(e) !== JSON.stringify(a) && i(e)
    }));
    const s = react_1.default.useRef(null);
    return react_1.default.useEffect((() => {
        var e;
        const t = s.current;
        if (!t) return;
        null === (e = s.current) || void 0 === e || e.focus();
        const r = o || t.value.length;
        t.selectionStart = t.selectionEnd = r, n && (null == t || t.select(), document.execCommand("selectAll", !1, null))
    }), []), react_1.default.createElement(react_konva_utils_1.Html, null, react_1.default.createElement("textarea", {
        className: "polotno-input",
        ref: s,
        style: Object.assign(Object.assign({}, initialStyles), a),
        value: t.text,
        onChange: e => {
            t.set({text: e.target.value})
        },
        placeholder: t.placeholder,
        onBlur: r
    }))
})), useEditor = e => {
    const [t, r] = react_1.default.useState(!1), n = react_1.default.useRef(!1);
    return react_1.default.useEffect((() => {
        var t = !0;
        return setTimeout((() => {
            t && (e._editModeEnabled && (n.current = !0), r(!0), setTimeout((() => {
                n.current = !1
            }), 50))
        }), 50), () => {
            t = !1
        }
    }), []), {editorEnabled: t && e._editModeEnabled, selectAll: n.current}
}, useFontLoader = (e, t) => {
    const [r, n] = react_1.default.useState(!1);
    return react_1.default.useLayoutEffect((() => {
        let o = !0;
        return (async () => {
            r && n(!1), (0, loader_1.incrementLoader)(), await e.loadFont(t), konva_1.default.Util.requestAnimFrame(loader_1.decrementLoader), o && n(!0)
        })(), () => {
            o = !1
        }
    }), [t]), [r]
}, getLineHeight = ({fontLoaded: e, fontFamily: t, fontSize: r, lineHeight: n}) => react_1.default.useMemo((() => {
    if ("number" == typeof n) return n;
    const e = document.createElement("div");
    e.style.fontFamily = t, e.style.fontSize = r + "px", e.style.lineHeight = n, e.innerText = "Test text", document.body.appendChild(e);
    const o = e.offsetHeight;
    return document.body.removeChild(e), o / r
}), [e, t, r, n]);

function getRelativePointerPosition(e) {
    var t = e.getAbsoluteTransform().copy();
    t.invert();
    var r = e.getStage().getPointerPosition();
    return t.point(r)
}

function getCursorPosition(e) {
    var t;
    const r = e.target, n = getRelativePointerPosition(r), o = r.textArr,
        a = Math.floor(n.y / (r.fontSize() * r.lineHeight())),
        i = o.slice(0, a).reduce(((e, t) => e + t.text.length), a), l = null !== (t = o[a]) && void 0 !== t ? t : o[0];
    let s = 0;
    "right" === r.align() ? s = r.width() - l.width : "center" === r.align() && (s = r.width() / 2 - l.width / 2);
    return i + Math.round((n.x - s) / l.width * l.text.length)
}

exports.TextElement = (0, mobx_react_lite_1.observer)((({element: e, store: t}) => {
    const r = react_1.default.useRef(null), {
        editorEnabled: n,
        selectAll: o
    } = useEditor(e), [a, i] = react_1.default.useState(!1), l = t.selectedElements.indexOf(e) >= 0;
    react_1.default.useEffect((() => {
        if (e.width) return;
        const t = r.current;
        t.width(600), e.set({width: 1.4 * t.getTextWidth()})
    }), []), react_1.default.useEffect((() => {
        const t = r.current;
        e.height !== t.height() && e.set({height: t.height()})
    })), react_1.default.useLayoutEffect((() => (0, mobx_1.autorun)((() => {
        const t = r.current;
        (0, apply_filters_1.applyFilter)(t, e)
    }))));
    const [s] = useFontLoader(t, e.fontFamily);
    react_1.default.useLayoutEffect((() => {
        const t = r.current;
        t && (t.width(t.width() + 1e-8), t._setTextData(), (0, apply_filters_1.applyFilter)(t, e))
    }), [s]);
    const d = react_1.default.useRef(null), c = react_1.default.useRef(0), u = r => {
        t.selectedElements.find((t => t === e)) && !e.locked && (c.current = getCursorPosition(r), e.toggleEditMode())
    }, f = !e.text && e.placeholder, h = e._editModeEnabled ? 0 : f ? .6 : e.opacity;
    (0, use_fadein_1.useFadeIn)(r, h);
    const g = getLineHeight({fontLoaded: s, fontFamily: e.fontFamily, fontSize: e.fontSize, lineHeight: e.lineHeight}),
        _ = e.selectable || "admin" === t.role;
    return react_1.default.createElement(react_1.default.Fragment, null, react_1.default.createElement(react_konva_1.Text, {
        ref: r,
        id: e.id,
        name: "element",
        hideOnExport: !e.showInExport,
        x: e.x,
        y: e.y,
        rotation: e.rotation,
        width: e.width,
        text: e.text || e.placeholder,
        fill: e.fill,
        stroke: e.stroke,
        strokeWidth: e.strokeWidth,
        fillAfterStrokeEnabled: !0,
        fontSize: e.fontSize,
        fontFamily: e.fontFamily,
        fontStyle: e.fontStyle + " " + e.fontWeight,
        textDecoration: e.textDecoration,
        align: e.align,
        draggable: !e.locked,
        opacity: h,
        shadowEnabled: e.shadowEnabled,
        shadowBlur: e.shadowBlur,
        lineHeight: g,
        letterSpacing: e.letterSpacing * e.fontSize,
        listening: _,
        onDragStart: () => {
            t.history.startTransaction()
        },
        onDragEnd: r => {
            e.set({x: r.target.x(), y: r.target.y()}), t.history.endTransaction()
        },
        onMouseEnter: () => {
            i(!0)
        },
        onMouseLeave: () => {
            i(!1)
        },
        onClick: u,
        onTap: u,
        onTransformStart: () => {
            t.history.startTransaction()
        },
        onTransform: t => {
            var r;
            const n = (null === (r = t.target.getStage()) || void 0 === r ? void 0 : r.findOne("Transformer")).getActiveAnchor();
            if ("middle-left" === n || "middle-right" === n) {
                const r = t.target.scaleX(), n = t.target.width() * r, o = e.fontSize;
                let a = n;
                n < o && (a = o, d.current && t.target.position(d.current)), t.target.width(a), t.target.scaleX(1), (0, apply_filters_1.applyFilter)(t.target, e)
            }
            t.target.strokeWidth(e.strokeWidth / t.target.scaleX()), d.current = t.target.position()
        },
        onTransformEnd: r => {
            const n = r.target.scaleX();
            r.target.scaleX(1), r.target.scaleY(1), r.target.strokeWidth(e.strokeWidth), e.set({
                fontSize: Math.round(e.fontSize * n),
                width: Math.ceil(r.target.width() * n),
                x: r.target.x(),
                y: r.target.y(),
                rotation: r.target.rotation()
            }), t.history.endTransaction()
        }
    }), n && react_1.default.createElement(react_konva_1.Group, {
        x: e.x,
        y: e.y,
        rotation: e.rotation
    }, react_1.default.createElement(TextInput, {
        textNodeRef: r,
        element: e,
        selectAll: o,
        cursorPosition: c.current,
        onBlur: () => {
            e.toggleEditMode(!1)
        }
    })), !l && a && react_1.default.createElement(highlighter_1.Highlighter, {element: e}))
}));
