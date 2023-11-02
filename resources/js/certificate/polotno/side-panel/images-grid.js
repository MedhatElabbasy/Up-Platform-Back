"use strict";
var __importDefault = this && this.__importDefault || function (e) {
    return e && e.__esModule ? e : {default: e}
};
Object.defineProperty(exports, "__esModule", {value: !0}), exports.ImagesGrid = void 0;
const react_1 = __importDefault(require("react")), styled_1 = __importDefault(require("../utils/styled")),
    core_1 = require("@blueprintjs/core"), l10n_1 = require("../utils/l10n"), page_1 = require("../canvas/page"),
    ImagesListContainer = (0, styled_1.default)("div")`
  height: 100%;
  overflow: auto;
`, ImagesRow = (0, styled_1.default)("div")`
  width: 33%;
  float: left;
`, ImgWrapDiv = (0, styled_1.default)("div")`
  padding: 5px;
  width: 100%;
  &:hover .credit {
    opacity: 1;
  }
  @media screen and (max-width: 500px) {
    .credit {
      opacity: 1;
    }
  }
`, ImgContainerDiv = (0, styled_1.default)("div")`
  border-radius: 5px;
  position: relative;
  overflow: hidden;
  box-shadow: ${e => e["data-shadowenabled"] ? "0 0 5px rgba(16, 22, 26, 0.3)" : ""};
`, Img = (0, styled_1.default)("img")`
  width: 100%;
  cursor: pointer;
  display: block;
`, CreditWrap = (0, styled_1.default)("div")`
  position: absolute;
  bottom: 0px;
  left: 0px;
  font-size: 10px;
  padding: 3px;
  padding-top: 10px;
  text-align: center;
  background: linear-gradient(
    to bottom,
    rgba(0, 0, 0, 0),
    rgba(0, 0, 0, 0.4),
    rgba(0, 0, 0, 0.6)
  );
  width: 100%;
  opacity: 0;
  color: white;
`, NoResults = (0, styled_1.default)("p")`
  text-align: center;
  padding: 30px;
`, Image = ({url: e, credit: t, onSelect: a, crossOrigin: r, shadowEnabled: l, itemHeight: i, className: o}) => {
        const d = null == l || l;
        return react_1.default.createElement(ImgWrapDiv, {
            onClick: () => {
                a()
            }, className: "polotno-close-panel template_div"
        }, react_1.default.createElement(ImgContainerDiv, {"data-shadowenabled": d}, react_1.default.createElement(Img, {
            className: o,
            style: {height: null != i ? i : "auto"},
            src: e,
            draggable: !0,
            crossOrigin: r,
            onDragStart: () => {
                (0, page_1.registerNextDomDrop)((({x: e, y: t}, r) => {
                    a({x: e, y: t}, r)
                }))
            },
            onDragEnd: () => {
                (0, page_1.registerNextDomDrop)(null)
            }
        }), t && react_1.default.createElement(CreditWrap, {className: "credit"}, t)))
    }, ImagesGrid = ({
                         images: e,
                         onSelect: t,
                         isLoading: a,
                         getPreview: r,
                         loadMore: l,
                         getCredit: i,
                         getImageClassName: o,
                         rowsNumber: d,
                         crossOrigin: s,
                         shadowEnabled: n,
                         itemHeight: c
                     }) => {
        const g = d || 2, u = [];
        for (var m = 0; m < g; m++) u.push((e || []).filter(((e, t) => t % g === m)));
        return react_1.default.createElement(ImagesListContainer, {
            onScroll: e => {
                const t = e.target.scrollHeight - e.target.scrollTop - e.target.offsetHeight;
                l && !a && t < 200 && l()
            }
        }, u.map(((e, l) => react_1.default.createElement(ImagesRow, {
            key: l,
            style: {width: 100 / g + "%"}
        }, e.map((e => react_1.default.createElement(Image, {
            url: r(e),
            onSelect: (a, r) => t(e, a, r),
            key: r(e),
            credit: i && i(e),
            crossOrigin: s,
            shadowEnabled: n,
            itemHeight: c,
            className: o && o(e)
        }))), a && react_1.default.createElement("div", {style: {padding: "30px"},className:'emptyDiv'}, react_1.default.createElement(core_1.Spinner, {className:'spinner'}))))), !a && (!e || !e.length) && react_1.default.createElement(NoResults, {className:'no_result'}, (0, l10n_1.t)("sidePanel.noResults")))
    };
exports.ImagesGrid = ImagesGrid;
