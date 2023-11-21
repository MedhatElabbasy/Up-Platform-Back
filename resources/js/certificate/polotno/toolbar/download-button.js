"use strict";
var __importDefault = this && this.__importDefault || function (e) {
    return e && e.__esModule ? e : {default: e}
};
Object.defineProperty(exports, "__esModule", {value: !0}), exports.DownloadButton = void 0;
const react_1 = __importDefault(require("react")), core_1 = require("@blueprintjs/core"),
    popover2_1 = require("@blueprintjs/popover2"), l10n_1 = require("../utils/l10n"), DownloadButton = ({store: e}) => {
        const [t, o] = react_1.default.useState(!1);
        return react_1.default.createElement(popover2_1.Popover2, {
            content: react_1.default.createElement(core_1.Menu, null,

                // react_1.default.createElement(core_1.MenuItem, {
                //     icon: "document",
                //     text: (0, l10n_1.t)(SaveToDatabase_LABEL),
                //     onClick: async () => {
                //         o(!0), await e.saveToDatabase(), o(!1)
                //     },
                //     className:'admin_save_btn'
                // }),
                react_1.default.createElement(core_1.MenuItem, {
                icon: "media",
                text: (0, l10n_1.t)(saveAsImage_LABEL),
                onClick: async () => {
                    e.pages.forEach((t => {
                        e.saveAsImage({pageId: t.id})
                    }))
                }
            }), react_1.default.createElement(core_1.MenuItem, {
                icon: "document",
                text: (0, l10n_1.t)(saveAsPDF_LABEL),
                onClick: async () => {
                    o(!0), await e.saveAsPDF(), o(!1)
                }
            }),
            react_1.default.createElement(core_1.MenuItem, {
                icon: "document",
                text: (0, l10n_1.t)(saveAsHDPDF_LABEL),
                onClick: async () => {
                    o(!0), await e.saveAsPDF({dpi: 300}), o(!1)
                }
            })),
            position: core_1.Position.BOTTOM,
            className:'download_btn'
        }, react_1.default.createElement(core_1.Button, {
            icon: "import",
            text: (0, l10n_1.t)(DOWNLOAD_LABEL),
            minimal: !0,
            loading: t
        }))


    };
exports.DownloadButton = DownloadButton, exports.default = exports.DownloadButton;
