"use strict";
var __importDefault = this && this.__importDefault || function (e) {
    return e && e.__esModule ? e : {default: e}
};
const batch_id = new Date().getTime();
Object.defineProperty(exports, "__esModule", {value: !0}), exports.PhotosPanel = void 0;
const react_1 = __importDefault(require("react")), core_1 = require("@blueprintjs/core"),
    images_grid_1 = require("./images-grid"), image_1 = require("../utils/image"),
    use_api_1 = require("../utils/use-api"), l10n_1 = require("../utils/l10n"), api_1 = require("../utils/api"),
    PhotosPanel = ({store: e}) => {
        const {
            setQuery: t,
            loadMore: a,
            isReachingEnd: r,
            data: l,
            isLoading: s
        } = (0, use_api_1.useInfiniteAPI)({
            defaultQuery: "canvas",
            getAPI: ({page: e, query: t}) => (0, api_1.unsplashList)({page: e, query: t})
        });

        var pFilesCache = [];
        const [pTariq, pRubel] = react_1.default.useState(pFilesCache);
        return react_1.default.createElement("div", {
                style: {
                    height: "100%",
                    display: "flex",
                    flexDirection: "column"
                }
            },
            // ,
            //     react_1.default.createElement(core_1.InputGroup, {
            //     leftIcon: "search",
            //     placeholder: (0, l10n_1.t)("sidePanel.searchPlaceholder"),
            //     onChange: e => {
            //         t(e.target.value)
            //     },
            //     style: {marginBottom: "20px"}
            // })
            //     ,
            //     react_1.default.createElement("p", {style: {textAlign: "center"}}, "Photos by", " ", react_1.default.createElement("a", {
            //     href: "https://unsplash.com/",
            //     target: "_blank"
            // }, "Infix"))
            // react_1.default.createElement("label", {
            //         htmlFor: "input-file",
            //         className: 'upload_btn',
            //         style: {marginBottom: "15px"}
            //     }, react_1.default.createElement(core_1.Button, {
            //         icon: "upload",
            //         style: {width: "100%"},
            //         onClick: () => {
            //             var e;
            //             null === (e = document.querySelector("#input-file")) || void 0 === e || e.click()
            //         }
            //     }, (0, l10n_1.t)("upload")),
            //
            //     react_1.default.createElement("input", {
            //         type: "file",
            //         id: "input-file",
            //         style: {display: "none"},
            //         onChange: async e => {
            //             const {target: t} = e;
            //             let data = new FormData();
            //             var increment = 0;
            //             for (const e of t.files) {
            //                 increment++;
            //                 data.append("images[" + increment + "]", e)
            //             }
            //             data.append("batch_id", batch_id)
            //             data.append("type", "p")
            //             axios.post(BASEURL+'/api/store-background', data)
            //                 .then(function (e) {
            //                     e = e.data;
            //                     pFilesCache.push(e.results)
            //                     pRubel(pFilesCache)
            //                     let recent_uploads = document.querySelectorAll(".p_recent_uploads")
            //                     for (let i = 0; i < recent_uploads.length; i++) {
            //                         recent_uploads[i].style.display = 'block';
            //                     }
            //                     toastr.success('Photos uploaded Successfully');
            //                 })
            //                 .catch(function (error) {
            //                     toastr.error('Something Went Wrong');
            //                 });
            //
            //             // i(!1), t.value = null
            //         },
            //         multiple: !0
            //     })
            // ),
            // react_1.default.createElement("div", {
            //         className: 'p_recent_uploads',
            //         style: {
            //             color: "white",
            //             display: "none"
            //         }
            //     },
            //     react_1.default.createElement("div", {className: 'p_background_wrapper'}, 'Recent Uploads'),
            //     react_1.default.createElement(images_grid_1.ImagesGrid, {
            //             images: pTariq.map((e => e)).flat(),
            //             getPreview: e => e.urls.small,
            //             onSelect: async (t, a, r) => {
            //                 console.log(t, a, r,'safet');
            //                 var l;
            //                 if (fetch((0, api_1.unsplashDownload)(t.id)), r && "svg" === r.type) return void r.set({maskSrc: t.urls.regular});
            //                 const {width: s, height: i} = await (0, image_1.getImageSize)(t.urls.small),
            //                     u = ((null == a ? void 0 : a.x) || e.width / 2) - s / 2,
            //                     n = ((null == a ? void 0 : a.y) || e.height / 2) - i / 2;
            //                 null === (l = e.activePage) || void 0 === l || l.addElement({
            //                     type: "image",
            //                     src: t.urls.regular,
            //                     width: s,
            //                     height: i,
            //                     x: u,
            //                     y: n
            //                 })
            //             },
            //         },
            //     ))
            // ,

            react_1.default.createElement("div", {className: 'background_wrapper'}, 'Photos'),
            react_1.default.createElement(images_grid_1.ImagesGrid, {
                images: null == l ? void 0 : l.map((e => e.results)).flat(),
                getPreview: e => e.urls.small,
                onSelect: async (t, a, r) => {
                    var l;
                    if (fetch((0, api_1.unsplashDownload)(t.id)), r && "svg" === r.type) return void r.set({maskSrc: t.urls.regular});
                    const {width: s, height: i} = await (0, image_1.getImageSize)(t.urls.small),
                        u = ((null == a ? void 0 : a.x) || e.width / 2) - s / 2,
                        n = ((null == a ? void 0 : a.y) || e.height / 2) - i / 2;
                    null === (l = e.activePage) || void 0 === l || l.addElement({
                        type: "image",
                        src: t.urls.regular,
                        width: s,
                        height: i,
                        x: u,
                        y: n
                    })
                },
                isLoading: s,
                loadMore: !r && a,
            }))
    };
exports.PhotosPanel = PhotosPanel;
