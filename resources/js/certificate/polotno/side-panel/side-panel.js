"use strict";
var __importDefault = this && this.__importDefault || function (e) {
    return e && e.__esModule ? e : {default: e}
};
Object.defineProperty(exports, "__esModule", {value: !0}), exports.SidePanel = exports.DEFAULT_SECTIONS = exports.SizeSection = exports.PagesSection = exports.BackgroundSection = exports.UploadSection = exports.ElementsSection = exports.PhotosSection = exports.TextSection = exports.TemplatesSection = exports.ImagesGrid = exports.SectionTab = void 0;
const react_1 = __importDefault(require("react")), mobx_react_lite_1 = require("mobx-react-lite"),
    core_1 = require("@blueprintjs/core"), styled_1 = __importDefault(require("../utils/styled")),
    screen_1 = require("../utils/screen"), FaShapes_1 = __importDefault(require("@meronex/icons/fa/FaShapes")),
    FdPageMultiple_1 = __importDefault(require("@meronex/icons/fd/FdPageMultiple")), l10n_1 = require("../utils/l10n"),
    tab_button_1 = require("./tab-button");
var tab_button_2 = require("./tab-button");
Object.defineProperty(exports, "SectionTab", {
    enumerable: !0, get: function () {
        return tab_button_2.SectionTab
    }
});
var images_grid_1 = require("./images-grid");
Object.defineProperty(exports, "ImagesGrid", {
    enumerable: !0, get: function () {
        return images_grid_1.ImagesGrid
    }
});
const text_panel_1 = require("./text-panel"),
    heading_panel_1 = require("./heading-panel"),
    shortcode_panel_1 = require("./shortcode-panel"),
    size_panel_1 = require("./size-panel"),
    upload_panel_1 = require("./upload-panel"),
    photos_panel_1 = require("./photos-panel"),
    background_panel_1 = require("./background-panel"),
    elements_panel_1 = require("./elements-panel"),
    pages_panel_1 = require("./pages-panel"),
    templates_panel_1 = require("./templates-panel");

exports.TemplatesSection = {
    name: "templates",
    Tab: (0, mobx_react_lite_1.observer)((e => react_1.default.createElement(tab_button_1.SectionTab, Object.assign({name: (0, l10n_1.t)(TEMPLATE_LABEL)}, e), react_1.default.createElement(core_1.Icon, {icon: "control"})))),
    Panel: ({store: e}) => react_1.default.createElement(templates_panel_1.TemplatesPanel, {store: e})
},
    exports.TextSection = {
        name: "text",
        Tab: (0, mobx_react_lite_1.observer)((e => react_1.default.createElement(tab_button_1.SectionTab, Object.assign({name: (0, l10n_1.t)(TEXT_LABEL)}, e),
            react_1.default.createElement(core_1.Icon, {icon: "new-text-box"})
        ))),
        Panel: ({store: e}) => react_1.default.createElement(text_panel_1.TextPanel, {store: e})
    },
    exports.HeadingSection = {
        name: "Heading",
        Tab: (0, mobx_react_lite_1.observer)((e => react_1.default.createElement(tab_button_1.SectionTab, Object.assign({name: (0, l10n_1.t)(HEADING_LABEL)}, e), react_1.default.createElement(core_1.Icon, {icon: "header"})))),
        Panel: ({store: e}) => react_1.default.createElement(heading_panel_1.TextPanel, {store: e})
    },
    exports.ShortcodeSection = {
        name: "ShortCode",
        Tab: (0, mobx_react_lite_1.observer)((e => react_1.default.createElement(tab_button_1.SectionTab, Object.assign({name: (0, l10n_1.t)(SHORTCODE_LABEL)}, e), react_1.default.createElement(core_1.Icon, {icon: "code"})))),
        Panel: ({store: e}) => react_1.default.createElement(shortcode_panel_1.TextPanel, {store: e})
    }


    ,
    exports.PhotosSection = {
        name: "photos",
        Tab: (0, mobx_react_lite_1.observer)((e => react_1.default.createElement(tab_button_1.SectionTab, Object.assign({name: (0, l10n_1.t)(PHOTOS_LABEL)}, e), react_1.default.createElement(core_1.Icon, {icon: "media"})))),
        Panel: ({store: e}) => react_1.default.createElement(photos_panel_1.PhotosPanel, {store: e})
    },
    exports.ElementsSection = {
        name: "elements",
        Tab: (0, mobx_react_lite_1.observer)((e => react_1.default.createElement(tab_button_1.SectionTab, Object.assign({
            name: (0, l10n_1.t)("sidePanel.elements"),
            iconSize: 16
        }, e), react_1.default.createElement(FaShapes_1.default, null)))),
        Panel: ({store: e}) => react_1.default.createElement(elements_panel_1.ElementsPanel, {store: e})
    },
    exports.UploadSection = {
        name: "upload",
        Tab: (0, mobx_react_lite_1.observer)((e => react_1.default.createElement(tab_button_1.SectionTab, Object.assign({name: (0, l10n_1.t)(UPLOAD_LABEL)}, e), react_1.default.createElement(core_1.Icon, {icon: "cloud-upload"})))),
        Panel: ({store: e}) => react_1.default.createElement(upload_panel_1.UploadPanel, {store: e})
    },
    exports.BackgroundSection = {
        name: "background",
        Tab: (0, mobx_react_lite_1.observer)((e => react_1.default.createElement(tab_button_1.SectionTab, Object.assign({name: (0, l10n_1.t)(BACKGROUND_LABEL)}, e), react_1.default.createElement(core_1.Icon, {icon: "layout-grid"})))),
        Panel: ({store: e}) => react_1.default.createElement(background_panel_1.BackgroundPanel, {store: e})
    },
    exports.PagesSection = {
        name: "pages",
        Tab: (0, mobx_react_lite_1.observer)((e => react_1.default.createElement(tab_button_1.SectionTab, Object.assign({name: (0, l10n_1.t)("sidePanel.pages")}, e), react_1.default.createElement(FdPageMultiple_1.default, null)))),
        Panel: ({store: e}) => react_1.default.createElement(pages_panel_1.PagesPanel, {store: e}),
        visibleInList: !1
    },
    exports.SizeSection = {
        name: "size",
        Tab: (0, mobx_react_lite_1.observer)((e => react_1.default.createElement(tab_button_1.SectionTab, Object.assign({name: (0, l10n_1.t)(RESIZE_LABEL)}, e), react_1.default.createElement(core_1.Icon, {icon: "fullscreen"})))),
        Panel: ({store: e}) => react_1.default.createElement(size_panel_1.SizePanel, {store: e})
    };
const MoreTab = (0, mobx_react_lite_1.observer)((e => react_1.default.createElement(tab_button_1.SectionTab, Object.assign({name: (0, l10n_1.t)("sidePanel.more")}, e), react_1.default.createElement(core_1.Icon, {icon: "more"}))));
// exports.DEFAULT_SECTIONS = [exports.TemplatesSection, exports.TextSection,
// exports.PhotosSection, exports.ElementsSection, exports.UploadSection, exports.BackgroundSection, exports.SizeSection];
// original selection
exports.DEFAULT_SECTIONS = [exports.TemplatesSection, exports.HeadingSection, exports.TextSection, exports.ShortcodeSection, exports.PhotosSection, exports.UploadSection, exports.BackgroundSection, exports.SizeSection];
const SidePanelContainer = (0, styled_1.default)("div")`
  display: flex;
  height: 100%;
  padding: 0px;
  background-color: '#252c48';

  @media screen and (max-width: 500px) {
    height: auto;
    width: 100%;
    position: relative;
  }
`, TabsWrap = (0, styled_1.default)("div", react_1.default.forwardRef)`
  @media screen and (min-width: 501px) {
    overflow-y: auto;
    overflow-x: hidden;
    min-width: 72px;
  }
  @media screen and (max-width: 500px) {
    width: 100%;
    overflow: auto;
  }
`, TabsContainer = (0, styled_1.default)("div", react_1.default.forwardRef)`
  display: flex;
  flex-direction: column;

  @media screen and (max-width: 500px) {
    flex-direction: row;
    min-width: min-content;
  }
`, PanelContainer = (0, styled_1.default)("div")`
  padding: 10px;
  width: 100%;
  height: 100% !important;

  @media screen and (max-width: 500px) {
     position: absolute;
    bottom: 54px;
     z-index: 100;
     height: 50vh !important;
  }
`, MobileOverlay = (0, styled_1.default)("div")`
  display: none;
  className: mobile;

  @media screen and (max-width: 500px) {
    position: absolute;
    bottom: 72px;
    display: block;
    width: 100vw;
    height: 100vh;
    background-color: '#252c48';
  }
`;
exports.SidePanel = (0, mobx_react_lite_1.observer)((({store: e, sections: t, defaultSection: a}) => {
    var n;
    react_1.default.useLayoutEffect((() => {
        e.openSidePanel(a || "templates")
    }), []);
    const o = t || exports.DEFAULT_SECTIONS, r = o.filter((e => {
            var t;
            return null === (t = e.visibleInList) || void 0 === t || t
        })), l = null === (n = o.find((t => t.name === e.openedSidePanel))) || void 0 === n ? void 0 : n.Panel,
        i = (0, screen_1.useMobile)();
    react_1.default.useEffect((() => {
        // i ? e.openSidePanel("") : e.openSidePanel(a || "templates") // for mobile
        e.openSidePanel(a || "templates")
    }), [i]);
    const s = react_1.default.useRef(null);
    return react_1.default.createElement(SidePanelContainer, {className: "bp3-navbar polotno-side-panel"}, react_1.default.createElement(TabsWrap, {
        ref: s,
        className: "polotno-side-tabs-container"
    }, react_1.default.createElement(TabsContainer, {className: "polotno-side-tabs-inner sidebar_panel"}, r.map((({
                                                                                                                      name: t,
                                                                                                                      Tab: a
                                                                                                                  }) => react_1.default.createElement(a, {
        key: t,
        active: t === e.openedSidePanel,
        onClick: () => {
            e.openSidePanel(t)
        }
    }))))), l && react_1.default.createElement(PanelContainer, {
        className: "bp3-navbar polotno-panel-container",
        onClick: t => {
            t.target.closest(".polotno-close-panel") && i && e.openSidePanel("")
        }
    }, react_1.default.createElement(l, {store: e})), e.openedSidePanel && react_1.default.createElement(MobileOverlay, {onClick: () => e.openSidePanel("")}))
})), exports.default = exports.SidePanel;
