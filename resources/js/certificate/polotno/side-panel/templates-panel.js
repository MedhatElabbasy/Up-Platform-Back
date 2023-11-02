"use strict";
var __importDefault = this && this.__importDefault || function (e) {
    return e && e.__esModule ? e : {default: e}
};
var protocol = window.location.protocol;
var host = window.location.host;
var pathname = window.location.pathname;
var search = window.location.search;
var newURL = protocol + "//" + host + "/" + pathname + search;
var baseUrl =BASEURL;
Object.defineProperty(exports, "__esModule", {value: !0}), exports.TemplatesPanel = void 0;
const react_1 = __importDefault(require("react")), mobx_react_lite_1 = require("mobx-react-lite"),
    core_1 = require("@blueprintjs/core"), l10n_1 = require("../utils/l10n"), images_grid_1 = require("./images-grid"),
    api_1 = require("../utils/api"), use_api_1 = require("../utils/use-api"),
    Templates = (0, mobx_react_lite_1.observer)((({sizeQuery: e, query: t, store: a}) => {
        const {
            setQuery: r,
            loadMore: i,
            hasMore: l,
            data: s,
            isLoading: o,
            reset: u
        } = (0, use_api_1.useInfiniteAPI)({
            defaultQuery: "pattern",
            getAPI: ({page: t, query: a}) => (0, api_1.templateList)({page: t, query: a, sizeQuery: e}),
            getSize: e => e.totalPages,

        });
        return react_1.default.useEffect((() => {
            u()
        }), [e]), react_1.default.useEffect((() => {
            r(t)
        }), [t]),
            react_1.default.createElement(images_grid_1.ImagesGrid, {
            images: null == s ? void 0 : s.map((e => e.items)).flat(),
            getPreview: e => e.preview,
            isLoading: o,
            onSelect: async e => {
                const t = await fetch(e.json), r = await t.json();
                console.log(t);

                a.loadJSON(r, !0)
            },
            loadMore: l && i
        })
    }));
exports.TemplatesPanel = (0, mobx_react_lite_1.observer)((({store: e}) => {
    const [t, a] = react_1.default.useState(!0), [r, i] = react_1.default.useState(""),
        l = t ? `${e.width}x${e.height}` : "all";
    return react_1.default.createElement("div", {
        style: {
            height: "100%",
            display: "flex",
            flexDirection: "column"
        },
            className:'template'
    }
    ,
    //     react_1.default.createElement("a", {
    //     href: baseUrl,
    //     target: "_blank",
    //     style: {marginBottom: "20px",fontSize:"24px",textDecoration: "none",color:"#5c7080"},
    //         className:'home_link'
    // }, "Home"),


        react_1.default.createElement("h3", {
        style: {marginBottom: "20px",marginTop: "20px"},
            className:'template_header'
    },"Your Certificate Template.Click For Preview & Download")
    //     ,
    //     react_1.default.createElement(core_1.InputGroup, {
    //     leftIcon: "search",
    //     placeholder: (0, l10n_1.t)("sidePanel.searchPlaceholder"),
    //     onChange: e => {
    //         i(e.target.value)
    //     },
    //     style: {marginBottom: "20px"},
    //     class:'template_search_box'
    // })
    //     , react_1.default.createElement(core_1.Switch, {
    //     checked: t, onChange: e => {
    //         a(e.target.checked)
    //     }, alignIndicator: core_1.Alignment.RIGHT, style: {marginTop: "8px", marginBottom: "25px"},class:'template_checkbox'
    // }, (0, l10n_1.t)("sidePanel.searchTemplatesWithSameSize"), " ")
    ,
        react_1.default.createElement(Templates, {
        store: e,
        sizeQuery: "size=" + l,
        query: r,
    })
    )
}));


