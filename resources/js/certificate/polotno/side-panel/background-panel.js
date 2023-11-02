"use strict";
var __importDefault = this && this.__importDefault || function (e) {
    return e && e.__esModule ? e : {default: e}
};
Object.defineProperty(exports, "__esModule", {value: !0}), exports.BackgroundPanel = void 0;
const react_1 = __importDefault(require("react")), mobx_react_lite_1 = require("mobx-react-lite"),
    core_1 = require("@blueprintjs/core"),
    IosColorPalette_1 = __importDefault(require("@meronex/icons/ios/IosColorPalette")),
    color_picker_1 = require("../toolbar/color-picker"), images_grid_1 = require("./images-grid"),
    styled_1 = __importDefault(require("../utils/styled")), l10n_1 = require("../utils/l10n"),
    use_api_1 = require("../utils/use-api"), api_1 = require("../utils/api"),
    colors = ["white", "rgb(82, 113, 255)", "rgb(255, 145, 77)", "rgb(126, 217, 87)", "rgb(255, 222, 89)", "rgb(203, 108, 230)", "rgb(255, 87, 87)"],
    Colored = (0, styled_1.default)("div")`
  display: inline-block;
  width: 30px;
  height: 30px;
  border-radius: 2px;
  box-shadow: 0 0 2px rgba(16, 22, 26, 0.3);
  cursor: pointer;
`;
const {AppUrl} = require("../utils/api");
const batch_id = new Date().getTime();

exports.BackgroundPanel = (0, mobx_react_lite_1.observer)((({store: e}) => {
    var t, r;

    const {
        setQuery: a,
        loadMore: l,
        isReachingEnd: o,
        data: i,
        isLoading: u
    } = (0, use_api_1.useInfiniteAPI)({
        defaultQuery: "pattern",
        getAPI: ({page: e, query: t}) => (0, api_1.unsplashList)({page: e, query: t})
    });

    const filesCache = [];


    const [tariq, rubel] = react_1.default.useState(filesCache?? []);




    return react_1.default.createElement("div", {
            style: {
                height: "100%",
                display: "flex",
                flexDirection: "column"
            }
        }, react_1.default.createElement("div", {
            style: {
                display: "flex",
                justifyContent: "space-around",
                paddingBottom: "10px"
            }
        }, react_1.default.createElement(color_picker_1.ColorPicker, {
            value: (null === (t = e.activePage) || void 0 === t ? void 0 : t.background) || "white",
            onChange: t => {
                var r;
                null === (r = e.activePage) || void 0 === r || r.set({background: t})
            },
            store: e
        }, react_1.default.createElement(Colored, {
            style: {
                backgroundColor: null === (r = e.activePage) || void 0 === r ? void 0 : r.background,
                fontSize: "30px"
            }
        }, react_1.default.createElement(IosColorPalette_1.default, {style: {mixBlendMode: "difference"}}))), colors.map((t => react_1.default.createElement(Colored, {
            key: t,
            style: {backgroundColor: t},
            onClick: () => {
                var r;
                null === (r = e.activePage) || void 0 === r || r.set({background: t})
            }
        })))),
        //
        //
        // react_1.default.createElement("label", {
        //         htmlFor: "input-file",
        //         className: 'upload_btn',
        //         style: {marginBottom: "15px"}
        //     },
        //
        //     react_1.default.createElement(core_1.Button, {
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
        //
        //             }
        //             data.append("batch_id", batch_id)
        //             data.append("type", "b")
        //             axios.post(BASEURL+'/api/store-background', data)
        //                 .then(function (e) {
        //                     e = e.data.results;
        //
        //                     e.forEach(function (v){
        //                         filesCache.push(v)
        //                     })
        //                     rubel(filesCache)
        //                     console.log(filesCache)
        //                   /*  console.log(filesCache);
        //                     console.log("i",i);*/
        //                     let recent_uploads = document.querySelectorAll(".recent_uploads")
        //                     for (let i = 0; i < recent_uploads.length; i++) {
        //                         recent_uploads[i].style.display = 'block';
        //                     }
        //                     toastr.success('Background images uploaded Successfully');
        //                 })
        //                 .catch(function (error) {
        //                     console.log(error);
        //                     toastr.error('Something Went Wrong');
        //                 });
        //
        //             // i(!1), t.value = null
        //         },
        //         multiple: !0
        //     })
        // ),
        // react_1.default.createElement("div", {
        //         className: 'recent_uploads',
        //         style: {
        //             color: "white",
        //             display: "none"
        //         }
        //     },
        //     react_1.default.createElement("div", {className: 'background_wrapper'}, 'Recent Uploads'),
        //     react_1.default.createElement(images_grid_1.ImagesGrid, {
        //             images: tariq.map((e => e)).flat(),
        //             getPreview: e => {
        //                 console.log(e)
        //                 return e.urls.small;
        //             },
        //             style: {
        //                 margin: '20px',
        //                 color: 'white',
        //             }, className: 'recent_uploads',
        //             onSelect: async t => {
        //                 var r;
        //                 fetch((0, api_1.unsplashDownload)(t.id)), null === (r = e.activePage) || void 0 === r || r.set({background: t.urls.regular})
        //             },
        //         },
        //     ))
        // ,

        react_1.default.createElement("div", {className: 'background_wrapper'}, 'Background Photos'),
        react_1.default.createElement(images_grid_1.ImagesGrid, {
                images: null == i ? void 0 : i.map((e => e.results)).flat(),
                isLoading: u,
                getPreview: e =>{
                    return  e.urls.small;
                },
                loadMore: !o && l,
                style: {margin: '20px'},
                onSelect: async t => {
                    var r;
                    fetch((0, api_1.unsplashDownload)(t.id)), null === (r = e.activePage) || void 0 === r || r.set({background: t.urls.regular})
                },
            }
        )
    )
}));
