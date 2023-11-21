"use strict";
var __importDefault = this && this.__importDefault || function (e) {
    return e && e.__esModule ? e : {default: e}
};
Object.defineProperty(exports, "__esModule", {value: !0}), exports.Workspace = void 0;
const react_1 = __importDefault(require("react")), mobx_react_lite_1 = require("mobx-react-lite"),
    page_1 = __importDefault(require("./page")), hotkeys_1 = require("./hotkeys"),
    ZERO_SIZE_WARNING = "Polotno warning: <Workspace /> component can not automatically detect its size.\nWidth or height of parent elements is equal 0.\nPlease make sure it has non-zero size. You may need to adjust it with your styles. <Workspace /> will automatically fit into parent container.\nFor simpler debugging here is the log of the parent element:",
    useSaveScrollOnScaleChange = (e, t, r, a, o) => {
        const n = react_1.default.useRef({width: t, height: r}), l = react_1.default.useRef({top: 0, left: 0});
        react_1.default.useEffect((() => {
            const t = e.current, r = () => {
                l.current = {top: t.scrollTop, left: t.scrollLeft}
            };
            return t.addEventListener("scroll", r), () => {
                t.removeEventListener("scroll", r)
            }
        }), []), react_1.default.useLayoutEffect((() => {
            if (!e.current) return;
            const a = e.current, o = (l.current.left + a.offsetWidth / 2) / n.current.width,
                c = (l.current.top + a.offsetHeight / 2) / n.current.height;
            a.scrollLeft = o * t - a.offsetWidth / 2, a.scrollTop = c * r - a.offsetHeight / 2, n.current = {
                width: t,
                height: r
            }
        }), [a, t, r])
    }, useScrollOnActiveChange = (e, t, r) => {
        const a = react_1.default.useRef(!1), o = react_1.default.useRef(0);
        react_1.default.useEffect((() => {
            const t = e.current, r = () => {
                a.current = !0, clearTimeout(o.current), o.current = setTimeout((() => {
                    a.current = !1
                }), 300)
            };
            return t.addEventListener("scroll", r), () => {
                t.removeEventListener("scroll", r)
            }
        }), []);
        const n = r.pages.indexOf(r.activePage);
        react_1.default.useLayoutEffect((() => {
            if (!r.activePage) return;
            if (!e.current) return;
            if (a.current) return;
            const o = e.current, n = r.pages.indexOf(r.activePage) * t;
            Math.abs(n - o.scrollTop) > .9 * t && (o.scrollTop = n)
        }), [r.activePage, n])
    };

exports.Workspace = (0, mobx_react_lite_1.observer)((({
                                                          store: e,
                                                          pageControlsEnabled: t,
                                                          backgroundColor: r,
                                                          pageBorderColor: a,
                                                          activePageBorderColor: o
                                                      }) => {
    const [n, l] = react_1.default.useState({width: 100, height: 100}), c = react_1.default.useRef(null),
        s = react_1.default.useRef(null), i = () => {
            if (null === c.current) return;
            const t = c.current.getBoundingClientRect();
            0 !== t.width && 0 !== t.height || (console.warn(ZERO_SIZE_WARNING), console.log(c.current));
            const r = s.current.clientWidth || t.width;
            l({width: r, height: t.height});
            const a = (r - 16) / e.width, o = (t.height - 90) / e.height, n = Math.max(Math.min(a, o), .01);
            e.setScale(n), e._setScaleToFit(n)
        };
    react_1.default.useEffect(i, [e.width, e.height]), react_1.default.useEffect((() => {
        const e = c.current, t = new ResizeObserver(i);
        return t.observe(e), () => t.unobserve(e)
    }), []);
    const u = Math.max(8, (n.width - e.width * e.scale) / 2),
        d = Math.max(45, (n.height - e.height * e.scale * e.pages.length - 45 * (e.pages.length - 1)) / 2);
    react_1.default.useEffect((() => {
        const t = t => {
            (0, hotkeys_1.handleHotkey)(t, e)
        };
        return window.addEventListener("keydown", t), () => window.removeEventListener("keydown", t)
    }), []);
    useSaveScrollOnScaleChange(s, e.width * e.scale + 2 * u, e.height * e.scale + 2 * d, e.scale), useScrollOnActiveChange(s, e.height * e.scale + 2 * d, e);
    const h = n.width >= e.width * e.scale + 2 * u, f = r || panelColor;
    console.log(f);

    return react_1.default.createElement("div", {
        ref: c,
        style: {width: "100%", height: "100%", position: "relative", outline: "none", flex: 1, backgroundColor: f},
        tabIndex: 0,
        className: "polotno-workspace-container"
    }, react_1.default.createElement("div", {
        ref: s,
        onScroll: t => {
            const r = t.currentTarget.childNodes[0].childNodes[0].offsetHeight, a = t.currentTarget.scrollTop,
                o = Math.floor((a + n.height / 2) / r), l = e.pages[o];
            l && l.select()
        },
        style: {
            position: "absolute",
            top: 0,
            left: 0,
            width: "100%",
            height: "100%",
            overflow: "auto",
            overflowX: h ? "hidden" : "auto"
        },
        className: "polotno-workspace-inner"
    }, e.pages.map((r => react_1.default.createElement(page_1.default, {
        key: r.id,
        page: r,
        xPadding: u,
        yPadding: d,
        width: e.width * e.scale + 2 * u,
        height: e.height * e.scale + 2 * d,
        store: e,
        pageControlsEnabled: t,
        backColor: f,
        pageBorderColor: a || "lightgrey",
        activePageBorderColor: o || "rgb(0, 161, 255)"
    }))), 0 === e.pages.length && react_1.default.createElement("div", {
        style: {
            position: "absolute",
            top: "50%",
            left: "50%",
            transform: "translate(-50%, -50%)",
            textAlign: "center"
        }
    }, react_1.default.createElement("p", null, "There are no pages yet... "), react_1.default.createElement("button", {
        onClick: () => {
            e.addPage()
        }
    }, "Add page"))))
})), exports.default = exports.Workspace;
