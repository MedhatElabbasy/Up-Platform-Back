"use strict";
var __createBinding = this && this.__createBinding || (Object.create ? function (e, t, r, a) {
    void 0 === a && (a = r), Object.defineProperty(e, a, {
        enumerable: !0, get: function () {
            return t[r]
        }
    })
} : function (e, t, r, a) {
    void 0 === a && (a = r), e[a] = t[r]
}), __setModuleDefault = this && this.__setModuleDefault || (Object.create ? function (e, t) {
    Object.defineProperty(e, "default", {enumerable: !0, value: t})
} : function (e, t) {
    e.default = t
}), __importStar = this && this.__importStar || function (e) {
    if (e && e.__esModule) return e;
    var t = {};
    if (null != e) for (var r in e) "default" !== r && Object.prototype.hasOwnProperty.call(e, r) && __createBinding(t, e, r);
    return __setModuleDefault(t, e), t
}, __importDefault = this && this.__importDefault || function (e) {
    return e && e.__esModule ? e : {default: e}
};
Object.defineProperty(exports, "__esModule", {value: !0}), exports.ImageElement = exports.useImageLoader = exports.setImageLoaderHook = void 0;
const react_1 = __importDefault(require("react")), mobx_react_lite_1 = require("mobx-react-lite"),
    mobx_1 = require("mobx"), react_konva_1 = require("react-konva"),
    use_image_1 = __importDefault(require("use-image")), konva_1 = __importDefault(require("konva")),
    react_konva_utils_1 = require("react-konva-utils"), highlighter_1 = require("./highlighter"),
    loader_1 = require("../utils/loader"), svg = __importStar(require("../utils/svg")),
    apply_filters_1 = require("./apply-filters"), use_fadein_1 = require("./use-fadein");

async function getFixedUrl(e) {
    if (!(e.indexOf("data:image/svg+xml") >= 0 || e.indexOf(".svg") >= 0)) return e;
    const t = await svg.urlToString(e), r = svg.fixSize(t);
    return svg.svgToURL(r)
}

const useSizeFixer = e => {
    const [t, r] = react_1.default.useState(e);
    return react_1.default.useEffect((() => {
        (async () => {
            const a = await getFixedUrl(e);
            a !== t && r(a)
        })()
    }), [e]), t
}, useFlip = (e, t, r) => react_1.default.useMemo((() => {
    var a, o;
    const {flipX: i, flipY: n} = e,
        h = "svg" === e.type || e.src.indexOf("data:image/svg+xml") >= 0 || e.src.indexOf(".svg") >= 0;
    if (!i && !n && !h) return t;
    if (!t || !t.width || !t.height) return null;
    const c = document.createElement("canvas");
    let d = 1;
    "svg" === e.type && (d = Math.max(e.width / t.width * r, e.height / t.height * r)), c.width = Math.max(t.width * d, 1), c.height = Math.max(t.height * d, 1);
    let l = i ? -c.width : 0, s = n ? -c.height : 0;
    console.log('useFlip')
    return null === (a = c.getContext("2d")) || void 0 === a || a.scale(i ? -1 : 1, n ? -1 : 1), null === (o = c.getContext("2d")) || void 0 === o || o.drawImage(t, l, s, c.width, c.height), c
}), [e.flipX, e.flipY, t, e.width, e.height, r]);

function getCrop(e, t) {

    const r = t.width / t.height;
    let a, o;
    r >= e.width / e.height ? (a = e.width, o = e.width / r) : (a = e.height * r, o = e.height);

    return {x: (e.width - a) / 2, y: (e.height - o) / 2, width: a, height: o}
}

const useMask = (e, t) => {
        const [r] = useImageHook(e.maskSrc, "anonymous");
        return react_1.default.useMemo((() => {
            if (!r) return t;
            if (!t || !t.width || !t.height) return t;
            const a = document.createElement("canvas");
            a.width = Math.max(t.width, 1), a.height = Math.max(t.height, 1);
            const o = a.getContext("2d");
            console.log('useMask')
            if (!o) return t;
            o.drawImage(t, 0, 0), o.globalCompositeOperation = "source-in";
            const i = getCrop(r, e);

            return o.drawImage(r, i.x, i.y, i.width, i.height, 0, 0, t.width, t.height), a
        }), [t, r, e.width, e.height])
    }, useCornerRadius = (e, t, r, a, o = 0) => {
        const i = react_1.default.useMemo((() => {
            if (t && t.width && t.height) return document.createElement("canvas")
        }), [t]);
        return react_1.default.useLayoutEffect((() => {
            if (!i || !t) return;
            const n = Math.max(e.width * a, 1), h = Math.max(e.height * a, 1);
            i.width = n, i.height = h;
            const c = i.getContext("2d");
            console.log('useCornerRadius')
            if (!c) return;
            const d = Math.min(o, e.width / 2, e.height / 2);
            d && (c.beginPath(), c.moveTo(d, 0), c.lineTo(n - d, 0), c.arc(n - d, d, d, 3 * Math.PI / 2, 0, !1), c.lineTo(n, h - d), c.arc(n - d, h - d, d, 0, Math.PI / 2, !1), c.lineTo(d, h), c.arc(d, h - d, d, Math.PI / 2, Math.PI, !1), c.lineTo(0, d), c.arc(d, d, d, Math.PI, 3 * Math.PI / 2, !1), c.clip()), c.drawImage(t, r.x, r.y, r.width, r.height, 0, 0, i.width, i.height)
        }), [i, e.width, e.height, r.x, r.y, r.width, r.height, o]), i
    }, useClip = (e, t, r, a) => {
        const o = useSizeFixer(e.clipSrc || ""), [i] = useImageHook(o, "anonymous"), n = react_1.default.useMemo((() => {
            if (t && i) return document.createElement("canvas")
        }), [t, i]);
        react_1.default.useLayoutEffect((() => {
            var a;
            if (!i) return;
            if (!t || !t.width || !t.height) return;
            if (!i || !i.width || !i.height) return;
            if (!n) return;
            const o = document.createElement("canvas"), h = Math.max(e.width / i.width * r, e.height / i.height * r);
            o.width = i.width * h, o.height = i.height * h, null === (a = o.getContext("2d")) || void 0 === a || a.drawImage(i, 0, 0, o.width, o.height), n.width = Math.max(t.width, 1), n.height = Math.max(t.height, 1);
            const c = n.getContext("2d");
            c && (c.save(), c.drawImage(o, 0, 0, t.width, t.height), c.globalCompositeOperation = "source-in", c.drawImage(t, 0, 0, n.width, n.height), c.restore())
        }), [n, t, i, e.width, e.height, r, ...a]);
        return e.clipSrc && i ? n : t
    }, PLACEHOLDER_CANVAS = document.createElement("canvas"),
    LoadingPlaceholder = (0, mobx_react_lite_1.observer)((({element: e}) => {
        const t = Math.min(30, e.width / 4, e.height / 4), r = react_1.default.useRef(null);
        return react_1.default.useEffect((() => {
            const e = r.current;
            if (!e) return;
            const t = new konva_1.default.Animation((t => {
                e.rotate(((null == t ? void 0 : t.timeDiff) || 0) / 2)
            }), e.getLayer());
            return t.start(), () => {
                t.stop()
            }
        })), react_1.default.createElement(react_konva_1.Group, {
            x: e.x,
            y: e.y,
            rotation: e.rotation,
            listening: !1,
            opacity: e.opacity,
            hideInExport: !e.showInExport
        }, react_1.default.createElement(react_konva_1.Rect, {
            width: e.width,
            height: e.height,
            fill: "rgba(124, 173, 212, 0.8)"
        }), react_1.default.createElement(react_konva_1.Arc, {
            ref: r,
            x: e.width / 2,
            y: e.height / 2,
            fill: "white",
            outerRadius: Math.abs(t),
            innerRadius: Math.max(1, t - 5),
            angle: 270
        }))
    })), ErrorPlaceholder = (0, mobx_react_lite_1.observer)((({element: e}) => {
        const t = "Can not load the image...", r = Math.max(10, Math.min(30, e.width / t.length));
        return react_1.default.createElement(react_konva_1.Group, {
            x: e.x,
            y: e.y,
            rotation: e.rotation,
            listening: !1,
            opacity: e.opacity,
            hideInExport: !e.showInExport
        }, react_1.default.createElement(react_konva_1.Rect, {
            width: e.width,
            height: e.height,
            fill: "rgba(223, 102, 102, 0.8)"
        }), react_1.default.createElement(react_konva_1.Text, {
            text: t,
            fontSize: r,
            width: e.width,
            height: e.height,
            align: "center",
            fill: "white",
            verticalAlign: "middle",
            padding: 5
        }))
    }));
let useImageHook = use_image_1.default;
const setImageLoaderHook = e => {
    useImageHook = e
};
exports.setImageLoaderHook = setImageLoaderHook;
const useImageLoader = e => {
    react_1.default.useEffect((() => {
        "loading" === e ? (0, loader_1.incrementLoader)() : (0, loader_1.decrementLoader)()
    }), [e])
};
exports.useImageLoader = useImageLoader;
const usePreviousImage = ({image: e, status: t, type: r}) => {
    const a = react_1.default.useRef();
    react_1.default.useEffect((() => {
        a.current = e || a.current
    }), [e]);
    return "failed" !== t || "failed" !== t && "svg" === r ? a.current : void 0
};
exports.ImageElement = (0, mobx_react_lite_1.observer)((({element: e, store: t}) => {
    var r;
    const [a, o] = react_1.default.useState(!1), i = react_1.default.useRef(null),
        n = react_1.default.useRef(null), [h, c] = react_1.default.useState(!1),
        d = t.selectedElements.indexOf(e) >= 0, [l, s] = useImageHook(e.__finalSrc || e.src, "anonymous");
    (0, exports.useImageLoader)(s);
    const [u, g] = react_1.default.useState("loading");
    react_1.default.useEffect((() => {
        g(e.__isLoaded ? s : "loading")
    }), [e.__isLoaded, s]), react_1.default.useEffect((() => {
        "svg" === e.type && ("loading" === u ? (0, loader_1.incrementLoader)() : (0, loader_1.decrementLoader)())
    }), [u]);
    const f = usePreviousImage({image: l, status: s, type: e.type}),
        _ = useMask(e, useFlip(e, l || f, t._elementsPixelRatio)) || PLACEHOLDER_CANVAS;
    let {cropX: m, cropY: p, cropWidth: x, cropHeight: w} = e;
    "loaded" !== s && (m = p = 0, x = w = 1);
    const v = _.width * x, y = _.height * w, E = e.width / e.height;
    let M, b;
    const k = v / y, I = "svg" === e.type;
    I ? (M = v, b = y) : E >= k ? (M = v, b = v / E) : (M = y * E, b = y);
    const S = {x: _.width * m, y: _.height * p, width: M, height: b},
        L = null !== (r = e.cornerRadius) && void 0 !== r ? r : 0;
    let C = useClip(e, useCornerRadius(e, _, S, t._elementsPixelRatio, L), t._elementsPixelRatio, [S, L]);
    const R = Math.max(e.width / M, e.height / b);
    react_1.default.useEffect((() => {
        var t;
        if (!e._cropModeEnabled) return;
        const r = null === (t = i.current) || void 0 === t ? void 0 : t.getStage();

        function a(t) {
            e._cropModeEnabled && t.target !== n.current && e.toggleCropMode(!1)
        }

        function o(t) {
            e._cropModeEnabled && "CANVAS" !== t.target.nodeName && e.toggleCropMode(!1)
        }

        return document.body.addEventListener("click", o), null == r || r.on("click", a), null == r || r.on("tap", a), () => {
            document.body.removeEventListener("click", o), document.body.removeEventListener("touchstart", o), null == r || r.off("click", a), null == r || r.off("click", a)
        }
    }), [e._cropModeEnabled]), react_1.default.useLayoutEffect((() => {
        if (a || e._cropModeEnabled) return;
        (0, apply_filters_1.applyFilter)(i.current, e);
        return (0, mobx_1.autorun)((() => {
            (0, apply_filters_1.applyFilter)(i.current, e)
        }), {delay: 100})
    }), [_, a, x, w, e._cropModeEnabled]), react_1.default.useLayoutEffect((() => {
        var t;
        a || e._cropModeEnabled ? null === (t = i.current) || void 0 === t || t.clearCache() : (0, apply_filters_1.applyFilter)(i.current, e)
    }), [a, e.width, e.height, e._cropModeEnabled]), react_1.default.useEffect((() => {
        (0, apply_filters_1.applyFilter)(i.current, e)
    }), [e.shadowEnabled, e.shadowBlur]);
    const P = react_1.default.useRef(null), H = react_1.default.useRef(null), T = react_1.default.useRef(null);
    react_1.default.useLayoutEffect((() => {
        e._cropModeEnabled && (H.current.nodes([P.current]), T.current.nodes([n.current]))
    }), [e._cropModeEnabled]);
    const X = t => {
            Math.round(t.target.x()) > 0 && (t.target.x(0), t.target.scaleX(1)), Math.round(t.target.y()) > 0 && (t.target.y(0), t.target.scaleY(1));
            const r = t.target.width() * t.target.scaleX(), a = t.target.height() * t.target.scaleY(),
                o = Math.min(1, M / r), i = Math.min(1, b / a), n = 1 - o,
                h = Math.min(n, Math.max(0, Math.round(-t.target.x()) / r)), c = 1 - i,
                d = Math.min(c, Math.max(0, Math.round(-t.target.y()) / a));
            t.target.setAttrs({x: -h * _.width, y: -d * _.height, scaleX: 1, scaleY: 1}), e.set({
                cropX: h,
                cropY: d,
                cropWidth: o,
                cropHeight: i
            })
        }, Y = () => {
            "svg" !== e.type && (e.locked || setTimeout((() => {
                e.toggleCropMode(!0)
            })))
        }, O = "svg" === e.type && f, W = "loading" === s && !O, A = "failed" === s, D = !W && !A,
        F = react_1.default.useRef({cropX: 0, cropY: 0, cropWidth: 0, cropHeight: 0}), q = D ? e.opacity : 0;
    (0, use_fadein_1.useFadeIn)(i, q);
    const z = e.selectable || "admin" === t.role;
    return react_1.default.createElement(react_1.default.Fragment, null, W && react_1.default.createElement(LoadingPlaceholder, {element: e}), A && react_1.default.createElement(ErrorPlaceholder, {element: e}), react_1.default.createElement(react_konva_1.Image, {
        ref: i,
        name: "element",
        id: e.id,
        image: C,
        x: e.x,
        y: e.y,
        width: e.width || 1,
        height: e.height || 1,
        rotation: e.rotation,
        opacity: q,
        shadowEnabled: e.shadowEnabled,
        shadowBlur: e.shadowBlur,
        customCrop: S,
        listening: z,
        draggable: !e.locked,
        hideInExport: !e.showInExport,
        onMouseEnter: () => {
            c(!0)
        },
        onMouseLeave: () => {
            c(!1)
        },
        onDragStart: () => {
            t.history.startTransaction()
        },
        onDragMove: t => {
            e.set({x: t.target.x(), y: t.target.y()})
        },
        onDragEnd: r => {
            e.set({x: r.target.x(), y: r.target.y()}), t.history.endTransaction()
        },
        onDblClick: Y,
        onDblTap: Y,
        onTransformStart: () => {
            o(!0), t.history.startTransaction(), F.current = {
                cropX: e.cropX,
                cropY: e.cropY,
                cropWidth: e.cropWidth,
                cropHeight: e.cropHeight
            }
        },
        onTransform: t => {
            var r;
            const a = t.currentTarget, o = Math.abs(a.scaleX() - 1) < 1e-7 ? 1 : a.scaleX(),
                i = Math.abs(a.scaleY() - 1) < 1e-7 ? 1 : a.scaleY();
            a.scaleX(1), a.scaleY(1);
            const n = null === (r = t.target.getStage()) || void 0 === r ? void 0 : r.findOne("Transformer"),
                h = 1 - M / _.width, c = Math.min(h, Math.max(0, e.cropX)), d = 1 - b / _.height,
                l = Math.min(d, Math.max(0, e.cropY)), s = n.getActiveAnchor(),
                u = !(s.indexOf("middle") >= 0 || s.indexOf("center") >= 0),
                g = !u && o < 1 && F.current.cropHeight > b / _.height;
            let f = u ? e.cropWidth : e.cropWidth * o;
            g && (f = e.cropWidth);
            const m = !u && i < 1 && F.current.cropWidth > M / _.width;
            let p = u ? e.cropHeight : e.cropHeight * i;
            m && (p = e.cropHeight), I && (f = e.cropWidth, p = e.cropHeight), e.set({
                cropX: c,
                cropY: l,
                x: a.x(),
                y: a.y(),
                width: a.width() * o,
                height: a.height() * i,
                rotation: t.target.rotation(),
                cropWidth: Math.min(f, 1 - c),
                cropHeight: Math.min(p, 1 - l)
            })
        },
        onTransformEnd: r => {
            const a = r.currentTarget;
            e.set({
                width: a.width(),
                height: a.height(),
                x: a.x(),
                y: a.y(),
                rotation: r.target.rotation(),
                cropWidth: M / _.width,
                cropHeight: b / _.height
            }), o(!1), t.history.endTransaction()
        }
    }), react_1.default.createElement(react_konva_1.Rect, {
        x: e.x,
        y: e.y,
        width: e.width - e.borderSize,
        height: e.height - e.borderSize,
        offsetX: -e.borderSize / 2,
        offsetY: -e.borderSize / 2,
        stroke: e.borderColor,
        strokeWidth: e.borderSize,
        listening: !1,
        visible: !!e.borderSize,
        rotation: e.rotation,
        cornerRadius: Math.max(0, L - e.borderSize),
        hideInExport: !e.showInExport
    }), e._cropModeEnabled && react_1.default.createElement(react_konva_utils_1.Portal, {
        selector: ".page-abs-container",
        enabled: !0
    }, react_1.default.createElement(react_konva_1.Rect, {
        x: -1500,
        y: -1500,
        width: 4500,
        height: 4500,
        fill: "rgba(0,0,0,0.3)"
    }), react_1.default.createElement(react_konva_1.Image, {
        listening: !1,
        image: C,
        x: e.x,
        y: e.y,
        width: e.width,
        height: e.height,
        rotation: e.rotation,
        shadowEnabled: e.shadowEnabled,
        shadowBlur: e.shadowBlur
    }), react_1.default.createElement(react_konva_1.Group, {
        x: e.x,
        y: e.y,
        rotation: e.rotation,
        scaleX: R,
        scaleY: R
    }, react_1.default.createElement(react_konva_1.Image, {
        image: _,
        ref: n,
        opacity: .4,
        draggable: !0,
        x: -e.cropX * _.width,
        y: -e.cropY * _.height,
        onDragMove: X,
        onTransform: X
    }), react_1.default.createElement(react_konva_1.Transformer, {
        ref: T,
        anchorSize: 20,
        enabledAnchors: ["top-left", "top-right", "bottom-left", "bottom-right"],
        boundBoxFunc: (e, t) => t.width < 5 || t.height < 5 ? e : t,
        rotateEnabled: !1,
        borderEnabled: !1,
        anchorCornerRadius: 10,
        anchorStrokeWidth: 2,
        borderStrokeWidth: 2
    }), react_1.default.createElement(react_konva_1.Rect, {
        width: M,
        height: b,
        ref: P,
        listening: !1,
        onTransform: t => {
            t.target.x() < -e.cropX * _.width - 1e-9 && (t.target.x(-e.cropX * _.width), t.target.scaleX(1)), t.target.y() < -e.cropY * _.height - 1e-9 && (t.target.y(-e.cropY * _.height), t.target.scaleY(1));
            const r = Math.min(1, Math.max(0, e.cropX + t.target.x() / _.width)),
                a = Math.min(1, Math.max(0, t.target.y() / _.height + e.cropY)),
                o = t.target.width() * t.target.scaleX(), i = t.target.height() * t.target.scaleY(),
                n = Math.min(1 - r, o / _.width), h = Math.min(1 - a, i / _.height),
                c = t.target.getAbsolutePosition(t.target.getParent().getParent());
            t.target.scale({x: 1, y: 1}), t.target.position({x: 0, y: 0}), e.set({
                x: c.x,
                y: c.y,
                cropX: r,
                cropY: a,
                cropWidth: n,
                cropHeight: h,
                width: Math.min(o * R, _.width * (1 - r) * R),
                height: Math.min(i * R, _.height * (1 - a) * R)
            })
        }
    }), react_1.default.createElement(react_konva_1.Transformer, {
        ref: H,
        enabledAnchors: ["top-left", "top-right", "bottom-left", "bottom-right"],
        boundBoxFunc: (e, t) => t.width < 5 || t.height < 5 ? e : t,
        keepRatio: !1,
        rotateEnabled: !1,
        anchorFill: "rgb(240, 240, 240)",
        anchorStrokeWidth: 2,
        borderStrokeWidth: 2
    }))), !d && h && react_1.default.createElement(highlighter_1.Highlighter, {element: e}))
}));
