"use strict";
var __createBinding = this && this.__createBinding || (Object.create ? function (e, t, o, s) {
    void 0 === s && (s = o), Object.defineProperty(e, s, {
        enumerable: !0, get: function () {
            return t[o]
        }
    })
} : function (e, t, o, s) {
    void 0 === s && (s = o), e[s] = t[o]
}), __setModuleDefault = this && this.__setModuleDefault || (Object.create ? function (e, t) {
    Object.defineProperty(e, "default", {enumerable: !0, value: t})
} : function (e, t) {
    e.default = t
}), __importStar = this && this.__importStar || function (e) {
    if (e && e.__esModule) return e;
    var t = {};
    if (null != e) for (var o in e) "default" !== o && Object.prototype.hasOwnProperty.call(e, o) && __createBinding(t, e, o);
    return __setModuleDefault(t, e), t
}, __rest = this && this.__rest || function (e, t) {
    var o = {};
    for (var s in e) Object.prototype.hasOwnProperty.call(e, s) && t.indexOf(s) < 0 && (o[s] = e[s]);
    if (null != e && "function" == typeof Object.getOwnPropertySymbols) {
        var r = 0;
        for (s = Object.getOwnPropertySymbols(e); r < s.length; r++) t.indexOf(s[r]) < 0 && Object.prototype.propertyIsEnumerable.call(e, s[r]) && (o[s[r]] = e[s[r]])
    }
    return o
}, __importDefault = this && this.__importDefault || function (e) {
    return e && e.__esModule ? e : {default: e}
};
Object.defineProperty(exports, "__esModule", {value: !0}), exports.createStore = exports.Store = exports.Font = exports.Page = exports.registerShapeModel = exports.SVGElement = exports.ImageElement = exports.TextElement = exports.Element = void 0;
const mobx_state_tree_1 = require("mobx-state-tree"), undo_manager_1 = require("./undo-manager"),
    nanoid_1 = require("nanoid"), konva_1 = __importDefault(require("konva")),
    download_1 = require("../utils/download"), pdf_1 = require("../utils/pdf"),
    validate_key_1 = require("../utils/validate-key"), fonts = __importStar(require("../utils/fonts")),
    svg_1 = require("../utils/svg"),
    loader_1 = require("../utils/loader");
(0, mobx_state_tree_1.setLivelinessChecking)("ignore"), exports.Element = mobx_state_tree_1.types.model("Element", {
    id: mobx_state_tree_1.types.identifier,
    type: "none",
    x: 0,
    y: 0,
    rotation: 0,
    opacity: 1,
    locked: !1,
    blurEnabled: !1,
    blurRadius: 10,
    brightnessEnabled: !1,
    brightness: 0,
    sepiaEnabled: !1,
    grayscaleEnabled: !1,
    shadowEnabled: !1,
    shadowBlur: 5,
    shadowOffsetX: 0,
    shadowOffsetY: 0,
    shadowColor: "black",
    custom: mobx_state_tree_1.types.frozen(),
    selectable: !0,
    alwaysOnTop: !1,
    showInExport: !0
}).preProcessSnapshot((e => {
    const t = Object.assign(Object.assign({}, e), {x: e.x || 0, y: e.y || 0});
    return "width" in e && (t.width = t.width || 1), "height" in e && (t.height = t.height || 1), t
})).postProcessSnapshot((e => {
    const t = Object.assign({}, e), o = {};
    for (var s in t) "_" !== s[0] && (o[s] = e[s]);
    return o
})).views((e => ({
    get page() {
        return (0, mobx_state_tree_1.getParentOfType)(e, exports.Page)
    }, get store() {
        return (0, mobx_state_tree_1.getParentOfType)(e, exports.Store)
    }
}))).actions((e => ({toJSON: () => Object.assign({}, (0, mobx_state_tree_1.getSnapshot)(e))}))).actions((e => ({
    clone(t) {
        const o = e.toJSON();
        return t.id = t.id || (0, nanoid_1.nanoid)(10), Object.assign(o, t), e.page.addElement(o)
    }, set(t) {

        Object.assign(e, t)
    }, moveUp() {
        e.page.moveElementUp(e.id)
    }, moveTop() {
        e.page.moveElementTop(e.id)
    }, moveDown() {
        e.page.moveElementDown(e.id)
    }, moveBottom() {
        e.page.moveElementBottom(e.id)
    }, beforeDestroy() {
        e.store.history.endTransaction()
    }
}))), exports.TextElement = exports.Element.named("Text").props({
    type: "text",
    text: "",
    placeholder: "",
    fontSize: 14,
    fontFamily: "Roboto",
    fontStyle: "normal",
    fontWeight: "normal",
    textDecoration: "",
    fill: "black",
    align: "center",
    width: 100,
    height: 14,
    strokeWidth: 0,
    stroke: "black",
    lineHeight: mobx_state_tree_1.types.optional(mobx_state_tree_1.types.union(mobx_state_tree_1.types.number, mobx_state_tree_1.types.string), 1.2),
    letterSpacing: 0,
    _editModeEnabled: !1
}).actions((e => ({
    toggleEditMode(t) {
        e._editModeEnabled = null != t ? t : !e._editModeEnabled, e._editModeEnabled ? e.store.history.startTransaction() : e.store.history.endTransaction()
    }
}))), exports.ImageElement = exports.Element.named("Image").props({
    type: "image",
    width: 100,
    height: 100,
    src: "",
    cropX: 0,
    cropY: 0,
    cropWidth: 1,
    cropHeight: 1,
    cornerRadius: 0,
    flipX: !1,
    flipY: !1,
    clipSrc: "",
    borderColor: "black",
    borderSize: 0,
    _cropModeEnabled: !1
}).actions((e => ({
    toggleCropMode(t) {
        e._cropModeEnabled = null != t ? t : !e._cropModeEnabled, e._cropModeEnabled ? e.store.history.startTransaction() : e.store.history.endTransaction()
    }
}))), exports.SVGElement = exports.Element.named("SVG").props({
    type: "svg",
    src: "",
    maskSrc: "",
    __svgString: "",
    cropX: 0,
    cropY: 0,
    cropWidth: 1,
    cropHeight: 1,
    keepRatio: !0,
    flipX: !1,
    flipY: !1,
    width: 100,
    height: 100,
    borderColor: "black",
    borderSize: 0,
    colorsReplace: mobx_state_tree_1.types.map(mobx_state_tree_1.types.string)
}).preProcessSnapshot((e => Object.assign(Object.assign({}, e), {src: e.src || e.svgSource}))).views((e => ({
    get colors() {
        return e.__svgString ? (0, svg_1.getColors)(e.__svgString) : []
    }, get __finalSrc() {
        return e.__svgString ? (0, svg_1.replaceColors)(e.__svgString, e.colorsReplace) : this.src
    }, get __isLoaded() {
        if (!e.__svgString) return !1;
        return !(Array.from(e.colorsReplace.keys()).length > 0) || e.__finalSrc !== e.src
    }
}))).actions((e => {
    let t = () => {
    };
    return {
        async _loadSVG() {
            if (!e.src) return;
            const t = await (0, svg_1.urlToString)(e.src);
            (0, mobx_state_tree_1.isAlive)(e) && e.store.history.ignore((() => {
                e.set({__svgString: (0, svg_1.fixSize)(t)})
            }))
        }, async afterCreate() {
            e._loadSVG();
            let o = e.src;
            t = (0, mobx_state_tree_1.onSnapshot)(e, (t => {
                t.src === o && e.__svgString || (e._loadSVG(), o = e.src)
            }))
        }, beforeDestroy() {
            t()
        }, replaceColor(t, o) {
            e.colorsReplace.set(t, o)
        }
    }
}));
const TYPES_MAP = {svg: exports.SVGElement, text: exports.TextElement, image: exports.ImageElement},
    ADDITIONAL_TYPES = [];

function registerShapeModel(e) {
    const t = e.type;
    if (!t) throw new Error('You must pass "type" attribute to custom model.');
    const o = exports.Element.named(t).props(e);
    TYPES_MAP[t] = o, ADDITIONAL_TYPES.push(o)
}

exports.registerShapeModel = registerShapeModel;
const additionalTypesUnion = [...new Array(20)].map(((e, t) => mobx_state_tree_1.types.late((() => ADDITIONAL_TYPES[t])))),
    ElementTypes = mobx_state_tree_1.types.union({dispatcher: e => TYPES_MAP[e.type]}, exports.SVGElement, exports.TextElement, exports.ImageElement, ...additionalTypesUnion),
    ChildrenType = mobx_state_tree_1.types.array(ElementTypes);

function createStore({key: e, showCredit: t} = {key: "", showCredit: !1}) {
    const o = exports.Store.create();
    return o.__checkKey(e, t), o
}

exports.Page = mobx_state_tree_1.types.model("Page", {
    id: mobx_state_tree_1.types.identifier,
    children: ChildrenType,
    background: "#E7DADA",
    custom: mobx_state_tree_1.types.frozen()
}).views((e => ({
    get store() {
        return (0, mobx_state_tree_1.getParentOfType)(e, exports.Store)
    }
}))).actions((e => ({
    toJSON: () => Object.assign({}, (0, mobx_state_tree_1.getSnapshot)(e)), clone(t) {

        const o = e.children.map((e => {
                const t = e.toJSON();
                return t.id = (0, nanoid_1.nanoid)(10), t
            })), s = Object.assign({id: (0, nanoid_1.nanoid)(10), children: o, background: e.background}, t),
            r = e.store.addPage(s), n = e.store.pages.indexOf(e);
        r.setZIndex(n + 1), r.select()
    }, setZIndex(t) {
        e.store.setPageZIndex(e.id, t)
    }, set(t) {
        Object.assign(e, t)
    }, select() {
        e.store.selectPage(e.id)
    }, addElement(t) {
        const o = TYPES_MAP[t.type];
        if (!o) return void console.error("Can not find model with type " + t.type);
        const s = o.create(Object.assign({id: (0, nanoid_1.nanoid)(10)}, t));
        return e.children.push(s), s.selectable && e.store.selectElements([s.id]), s
    }, moveElementUp(t) {
        const o = e.children.findIndex((e => e.id === t)), s = e.children[o];
        (0, mobx_state_tree_1.detach)(s), e.children.remove(s), e.children.splice(o + 1, 0, s)
    }, moveElementDown(t) {
        const o = e.children.findIndex((e => e.id === t)), s = e.children[o];
        (0, mobx_state_tree_1.detach)(s), e.children.remove(s), e.children.splice(o - 1, 0, s)
    }, moveElementTop(t) {
        const o = e.children.findIndex((e => e.id === t)), s = e.children[o];
        (0, mobx_state_tree_1.detach)(s), e.children.remove(s), e.children.push(s)
    }, moveElementBottom(t) {
        const o = e.children.findIndex((e => e.id === t)), s = e.children[o];
        (0, mobx_state_tree_1.detach)(s), e.children.remove(s), e.children.splice(0, 0, s)
    }
}))), exports.Font = mobx_state_tree_1.types.model("Font", {
    fontFamily: mobx_state_tree_1.types.string,
    url: mobx_state_tree_1.types.optional(mobx_state_tree_1.types.string, ""),
    styles: mobx_state_tree_1.types.frozen()
}).preProcessSnapshot((e => Object.assign(Object.assign({}, e), {fontFamily: e.fontFamily || e.name}))), exports.Store = mobx_state_tree_1.types.model("Store", {
    role: "",
    pages: mobx_state_tree_1.types.array(exports.Page),
    fonts: mobx_state_tree_1.types.array(exports.Font),
    width: 1080,
    height: 1080,
    vHeight: 1080,
    vWidth: 1080,
    unit: 'px',
    preUnit: 'px',
    scale: 1,
    scaleToFit: 1,
    openedSidePanel: "",
    selectedElementsIds: mobx_state_tree_1.types.array(mobx_state_tree_1.types.string),
    history: mobx_state_tree_1.types.optional(undo_manager_1.UndoManager, {targetPath: "../pages"}),
    _elementsPixelRatio: 2,
    _showCredit: !1,
    _activePageId: ""
}).views((e => ({
    get selectedElements() {
        return e.selectedElementsIds.map((t => {
            for (const o of e.pages) for (const e of o.children) if (e.id === t) return e
        })).filter((e => !!e))
    }, get activePage() {
        return e.pages.slice().find((t => t.id === e._activePageId)) || (e.pages.length ? e.pages[0] : null)
    }
}))).actions((e => ({
    async __checkKey(t, o) {
        const s = await (0, validate_key_1.validateKey)(t);
        e.__(s, o)
    },
    __(t, o) {
        e._showCredit = !t || o
    },
    setRole(t) {
        e.role = t
    },
    getElementById(t) {
        for (const o of e.pages) for (const e of o.children) if (e.id === t) return e
    },
    addPage(t) {
        const o = exports.Page.create(Object.assign({id: (0, nanoid_1.nanoid)(10)}, t));
        return e.pages.push(o), e._activePageId = o.id, o
    },
    selectPage(t) {
        e._activePageId = t
    },
    selectElements(t) {
        e.selectedElementsIds = (0, mobx_state_tree_1.cast)(t)
    },
    openSidePanel(t) {
        e.openedSidePanel = t

    },
    setScale(t) {
        e.scale = t
    },

    setUnit(t) {
        e.unit = t
        // this.setSize(e.width, e.height, true);
        e.preUnit = t
    },

    setPreUnit(t) {
        e.preUnit = t
    },

    setVHeight(t) {
        e.vHeight = t
    },

    setVWidth(t) {
        e.vWidth = t
    },

    setHeight(t) {
        e.height = t
    },

    setWidth(t) {
        e.width = t
    },

    _setScaleToFit(t) {
        e.scaleToFit = t
    },
    setElementsPixelRatio(t) {
        e._elementsPixelRatio = t
    },
    setSize(t, o, s) {
        console.log('t='+t,'o='+o,'s='+s,'ew='+e.width,'eh'+e.height,'unit='+e.unit)
        // var width = this.unitConverter(t,e.unit,e.preUnit);
        // var height = this.unitConverter(o,e.unit,e.preUnit);
        // console.log(width,height);
        if (s) {
            const s = t / e.width, r = o / e.height;
            for (const t of e.pages) for (const e of t.children) e.set({
                x: e.x * s,
                y: e.y * r
            }), "text" === e.type ? e.set({
                fontSize: e.fontSize * s,
                width: Math.max(e.width * s, 2)
            }) : e.set({width: Math.max(e.width * s, 2), height: Math.max(e.height * r, 2)})
        }
        e.width = t, e.height = o

        // if (s) {
        //     const s = t / width, r = o / height;
        //     for (const t of e.pages) for (const e of t.children) e.set({
        //         x: e.x * s,
        //         y: e.y * r
        //     }), "text" === e.type ? e.set({
        //         fontSize: e.fontSize * s,
        //         width: Math.max(width * s, 2)
        //     }) : e.set({width: Math.max(width * s, 2), height: Math.max(height * r, 2)})
        // }
        //
        // e.width = width, e.height = height
    },
     unitToPX(value, unit){
         var pxValue = 0;
         if(unit === 'cm'){
             pxValue = value *  37.79;
         }
         else if(unit === 'mm'){
             pxValue = value *  3.77;
         }
         else if(unit === 'in'){
             pxValue = value *  96;
         }
         else if(unit === 'pt'){
             pxValue = value *  1.33;
         }
         else {
             pxValue = value;
         }
         return Math.round(pxValue);

     },
     setUnitConverter(value, unit,preUnit) {
            // if(unit === preUnit){
            //     return value;
            // }
         console.log(value, unit,preUnit,e)
            var dpi = 32;
            var pxValue = 0;
            if(preUnit === 'cm'){
                pxValue = value * (dpi / 2.54);
            }
            else if(preUnit === 'mm'){
                pxValue =  value * (dpi / 25.4);
            }
            else if(preUnit === 'in'){
                pxValue = value * dpi;
            }
            else if(preUnit === 'pt'){
                pxValue = value * (dpi / 72);
            }
            else {
                pxValue = value;
            }

         console.log(pxValue);

            switch (unit) {
                case"px":
                    return Math.round(pxValue);
                case"mm":
                    return Math.round(pxValue * (25.4 / dpi));
                case"cm":
                    return Math.round(pxValue * (2.54 / dpi));
                case"in":
                    return Math.round(pxValue /  dpi);
                case"pt":
                    return Math.round(pxValue * ( 72/dpi));
            }
     },



    setPageZIndex(t, o) {
        const s = e.pages.find((e => e.id === t));
        s && ((0, mobx_state_tree_1.detach)(s), e.pages.remove(s), e.pages.splice(o, 0, s))
    },
    deletePages(t) {
        t.forEach((t => {
            const o = e.pages.find((e => e.id === t));
            (0, mobx_state_tree_1.destroy)(o)
        })), e.selectedElementsIds = e.selectedElementsIds.filter((t => e.getElementById(t)))
    },
    deleteElements(t) {
        t.forEach((t => {
            e.pages.forEach((e => {
                const o = e.children.find((e => e.id === t));
                o && (0, mobx_state_tree_1.destroy)(o)
            }))
        })), e.selectedElementsIds = (0, mobx_state_tree_1.cast)([])
    },
    on(t, o) {
        if ("change" === t) return (0, mobx_state_tree_1.onSnapshot)(e, (e => {
            o(e)
        }))
    },
    toDataURL({pixelRatio: t, ignoreBackground: o, pageId: s, mimeType: r} = {}) {
        const n = t || 1,
            a = konva_1.default.stages.find((e => e.getAttr("pageId") === s)) || konva_1.default.stages[0];
        if (!a) throw new Error("Export is failed. Looks like <Workspace /> component is not mounted, but it is required in order to process the export.");
        const i = a.findOne(".page-container");
        a.find("Transformer").forEach((e => e.visible(!1))), i.findOne(".page-background").shadowEnabled(!1), i.findOne(".page-background").strokeEnabled(!1), i.find(".highlighter").forEach((e => e.visible(!1)));
        const d = i.find((e => e.getAttr("hideInExport")));
        d.forEach((e => {
            e.setAttr("oldVisible", e.visible()), e.hide()
        })), o && i.findOne(".page-background").hide();
        console.log(e);
        const l = i.toDataURL({
            x: i.x(),
            y: i.y(),
            // unit:'cm', //not working
            height: e.height  * i.scaleY(),
            width: e.width * i.scaleX(),
            pixelRatio: 1 / i.scaleX() * n,
            mimeType: r
        });

        return o && i.findOne(".page-background").show(), d.forEach((e => {
            e.visible(e.getAttr("oldVisible"))
        })), i.findOne(".page-background").shadowEnabled(!0), i.findOne(".page-background").strokeEnabled(!0), a.find("Transformer").forEach((e => e.visible(!0))), i.find(".highlighter").forEach((e => e.visible(!0))), l
    },
    saveAsImage(t = {}) {
        var {fileName: o} = t, s = __rest(t, ["fileName"]);
        const r = s.mimeType || "image/png", n = r.split("/")[1];
        (0, download_1.downloadFile)(e.toDataURL(s), o || "certificate." + n, r)
    },
    async _toPDF(t) {
        const o = (t.dpi || 72) / 72, s = e => .75 * e;
        var r = new (await (0, pdf_1.getJsPDF)())({
            unit:e.unit,
            orientation: e.width > e.height ? "landscape" : "portrait",
            format: [s(e.width), s(e.height)]
        }), n = r.internal.pageSize.getWidth(), a = r.internal.pageSize.getHeight();
        const i = e._elementsPixelRatio;
        return e.setElementsPixelRatio(o), e.pages.forEach(((s, i) => {
            0 !== i && r.addPage(), r.addImage(e.toDataURL(Object.assign(Object.assign({}, t), {
                pageId: s.id,
                pixelRatio: o
            })), 0, 0, n, a, void 0, "SLOW")
        })), e.setElementsPixelRatio(i), r
    },
    toPDFDataURL: async t => (await e._toPDF(Object.assign({mimeType: "image/jpg"}, t))).output("datauristring"),
    async saveAsPDF(t = {}) {
        var {fileName: o, dpi: s} = t, r = __rest(t, ["fileName", "dpi"]);
        (await e._toPDF(Object.assign({mimeType: "image/jpg"}, r))).save(o || "certificate.pdf")
    },
    async saveToDatabase(t = {}) {

        const { value: templateName } = await Swal.fire({
            title: 'Enter your template name',
            input: 'text',
            // inputLabel: 'Template Name',
            inputValue: 'Template Name',
            showCancelButton: true,
            inputValidator: (value) => {
                if (!value) {
                    return 'You need to write something!'
                }
            }
        })

        if (templateName) {
            let data = {
                json : e.toJSON(),
                image_url : e.toDataURL(),
                template_name : templateName,
            }
            axios.post(BASEURL+'/api/store-template',data)
                .then(function (response) {
                    location.reload();
                    toastr.success('Template Save Successfully');
                })
                .catch(function (error) {
                    toastr.error('Something Went Wrong');
                });

        }

    },
    async waitLoading() {
        await (0, loader_1.whenLoaded)()
    },
    toJSON:  function (){
       return {
           unit: e.unit,
           width: e.width,
           height: e.height,
           fonts: (0, mobx_state_tree_1.getSnapshot)(e.fonts),
           pages: (0, mobx_state_tree_1.getSnapshot)(e.pages)
       }
    },
    loadJSON(t, o = !1) {
        console.log(t,"load")
        var s;

        e.pages.forEach((e => e.children.forEach((e => (0, mobx_state_tree_1.detach)(e))))), e.pages = (0, mobx_state_tree_1.cast)([]), t._activePageId = null === (s = t.pages[0]) || void 0 === s ? void 0 : s.id, t.scale = e.scale, t._isKeyValid = e._isKeyValid, t.openedSidePanel = e.openedSidePanel, o && (t.history = e.history.toJSON()), (0, mobx_state_tree_1.applySnapshot)(e, t)
        e.vHeight = t.height;
        e.vWidth = t.width;
        console.log(e+'after load');
    },
    addFont(t) {
        e.removeFont(t.fontFamily), e.fonts.push(t), e.loadFont(t.fontFamily)
    },
    removeFont(t) {
        e.fonts.filter((e => e.fontFamily === t)).forEach((e => (0, mobx_state_tree_1.destroy)(e)))
    },

    stringToSlug(str) {
        str = str.replace(/^\s+|\s+$/g, ''); // trim
        str = str.toLowerCase();

        // remove accents, swap ñ for n, etc
        const from = "àáäâèéëêìíïîòóöôùúüûñç·/_,:;";
        const to   = "aaaaeeeeiiiioooouuuunc------";
        for (let i = 0, l = from.length; i < l; i++) {
            str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
        }

        str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
            .replace(/\s+/g, '_') // collapse whitespace and replace by -
            .replace(/-+/g, '_'); // collapse dashes

        return str;
    },

    async loadFont(t) {

        const GLOBAL_FONTS = [
            'Times New Roman',
            'Verdana',
            'Bickley',
            'Cambria',
            'Georgia',
            'Garamond',
            'Bodoni',
            'Century Schoolbook',
            'Arial',
            'Calibri',
            'Proxima Nova',
            'Helvetica',
            'Futura',
            'Frutiger',
        ];
        const fontsData = {
            frutiger:{
                fontFamily:'Frutiger',
                styles:'',
                url:BASEURL+'/Modules/CertificatePro/Resources/assets/certificate_pro/fonts/FTLC.ttf'
            },
            futura:{
                fontFamily:'Futura',
                styles:'',
                url:BASEURL+'/Modules/CertificatePro/Resources/assets/certificate_pro/fonts/futur.ttf'
            },
            helvetica:{
                fontFamily:'Helvetica',
                styles:'',
                url:BASEURL+'/Modules/CertificatePro/Resources/assets/certificate_pro/fonts/Helvetica.ttf'
            },
            times_new_roman:{
                fontFamily:'Times New Roman',
                styles:'',
                url:BASEURL+'/Modules/CertificatePro/Resources/assets/certificate_pro/fonts/times_new_roman.ttf'
            },
            verdana:{
                fontFamily:'Verdana',
                styles:'',
                url:BASEURL+'/Modules/CertificatePro/Resources/assets/certificate_pro/fonts/verdana.ttf'
            },
            bickley:{
                fontFamily:'Bickley',
                styles:'',
                url:BASEURL+'/Modules/CertificatePro/Resources/assets/certificate_pro/fonts/BickleyScript.ttf'
            },
            cambria:{
                fontFamily:'Cambria',
                styles:'',
                url:BASEURL+'/Modules/CertificatePro/Resources/assets/certificate_pro/fonts/Cambria-Font-For-Windows.ttf'
            },
            georgia:{
                fontFamily:'Georgia',
                styles:'',
                url:BASEURL+'/Modules/CertificatePro/Resources/assets/certificate_pro/fonts/Georgia.ttf'
            },
            garamond:{
                fontFamily:'Garamond',
                styles:'',
                url:BASEURL+'/Modules/CertificatePro/Resources/assets/certificate_pro/fonts/GaramondRegular.ttf'
            },
            bodoni:{
                fontFamily:'Bodoni',
                styles:'',
                url:BASEURL+'/Modules/CertificatePro/Resources/assets/certificate_pro/fonts/bodoni.ttf'
            },
            century_schoolbook:{
                fontFamily:'Century Schoolbook',
                styles:'',
                url:BASEURL+'/Modules/CertificatePro/Resources/assets/certificate_pro/fonts/CENSCBK.TTF'
            },
            arial:{
                fontFamily:'Arial',
                styles:'',
                url:BASEURL+'/Modules/CertificatePro/Resources/assets/certificate_pro/fonts/arial.ttf'
            },
            calibri:{
                fontFamily:'Calibri',
                styles:'',
                url:BASEURL+'/Modules/CertificatePro/Resources/assets/certificate_pro/fonts/Calibri.ttf'
            },
            proxima_nova:{
                fontFamily:'Proxima Nova',
                styles:'',
                url:BASEURL+'/Modules/CertificatePro/Resources/assets/certificate_pro/fonts/ProximaNovaFont.otf'
            },

        }
        var processT = this.stringToSlug(t);

        if (GLOBAL_FONTS.includes(t)) {
            const o = true;
            o ? fonts.injectCustomFont(fontsData[processT]) : fonts.injectGoogleFont({fontFamily:'Times New Roman',styles:'',url:BASEURL+'/Modules/CertificatePro/Resources/assets/certificate_pro/fonts/times_new_roman.ttf'}), await fonts.loadFont(t)
        } else {
            const o = e.fonts.find((e => e.fontFamily === t)) || fonts.globalFonts.find((e => e.fontFamily === t));
            o ? fonts.injectCustomFont(o) : fonts.injectGoogleFont(t), await fonts.loadFont(t)
        }


    }
}))), exports.createStore = createStore, exports.default = createStore;
