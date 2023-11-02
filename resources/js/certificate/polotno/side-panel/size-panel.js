"use strict";
var __importDefault = this && this.__importDefault || function (e) {
    return e && e.__esModule ? e : {default: e}
};
Object.defineProperty(exports, "__esModule", {value: !0}), exports.SizePanel = exports.DEFAULT_SIZES = void 0;
const react_1 = __importDefault(require("react")), mobx_react_lite_1 = require("mobx-react-lite"),
    core_1 = require("@blueprintjs/core"), popover2_1 = require("@blueprintjs/popover2"),
    l10n_1 = require("../utils/l10n"),
    AiOutlineFacebook_1 = __importDefault(require("@meronex/icons/ai/AiOutlineFacebook")),
    AiOutlineInstagram_1 = __importDefault(require("@meronex/icons/ai/AiOutlineInstagram")),
    AiOutlineYoutube_1 = __importDefault(require("@meronex/icons/ai/AiOutlineYoutube")),
    AiOutlineVideoCamera_1 = __importDefault(require("@meronex/icons/ai/AiOutlineVideoCamera"));


exports.DEFAULT_SIZES = [
    ["A0", 841, 1089,react_1.default.createElement('span', {className:'size_text'},'MM')],
    ["A1", 554, 841,react_1.default.createElement('span', {className:'size_text'},'MM')],
    ["A2", 420, 594,react_1.default.createElement('span', {className:'size_text'},'MM')],
    ["A3", 297, 420,react_1.default.createElement('span', {className:'size_text'},'MM')],
    ["A4", 210, 297,react_1.default.createElement('span', {className:'size_text'},'MM')],
    ["A5", 148, 210,react_1.default.createElement('span', {className:'size_text'},'MM')],
    ["A6", 105, 148,react_1.default.createElement('span', {className:'size_text'},'MM')],
    ["A7", 74, 105,react_1.default.createElement('span', {className:'size_text'},'MM')],
    ["1/3 A4", 99, 210,react_1.default.createElement('span', {className:'size_text'},'MM')],
    // ["Instagram Story", 1080, 1920, react_1.default.createElement(AiOutlineInstagram_1.default, null)],
    // ["Instagram Ad", 1080, 1080, react_1.default.createElement(AiOutlineInstagram_1.default, null)],
    // ["Facebook Post", 940, 788, react_1.default.createElement(AiOutlineFacebook_1.default, null)],
    // ["Facebook Cover", 851, 315, react_1.default.createElement(AiOutlineFacebook_1.default, null)],
    // ["Facebook Ad", 1200, 628, react_1.default.createElement(AiOutlineFacebook_1.default, null)],
    // ["Youtube Thumbnail", 1280, 720, react_1.default.createElement(AiOutlineYoutube_1.default, null)],
    // ["Youtube Channel", 2560, 1440, react_1.default.createElement(AiOutlineYoutube_1.default, null)],
    // ["Full HD", 1920, 1080, react_1.default.createElement(AiOutlineVideoCamera_1.default, null)]
],
    exports.SizePanel = (0, mobx_react_lite_1.observer)((({store: e}) => {
        const [t, a] = react_1.default.useState(!0);
        return react_1.default.createElement("div", {
                style: {
                    height: "100%",
                    overflow: "auto"
                }
            },
            //     react_1.default.createElement("div", {style: {paddingBottom: "15px"}}, react_1.default.createElement(core_1.Switch, {
            //     checked: t,
            //     onChange: e => {
            //         a(e.target.checked)
            //     },
            //     alignIndicator: core_1.Alignment.RIGHT,
            //     style: {marginTop: "8px", marginBottom: "25px",
            //         width: "1000%",
            //         display: "block"}
            // },
            //
            //
            //     (0, l10n_1.t)("sidePanel.useMagicResize"), " ", react_1.default.createElement(popover2_1.Tooltip2, {
            //     content: (0, l10n_1.t)("sidePanel.magicResizeDescription"),
            //     position: core_1.Position.BOTTOM,
            //     style:{
            //         width: "1000%",
            //         display: "block"
            //     }
            //
            // },
            //     react_1.default.createElement(core_1.Icon, {icon: "help"}))),

            react_1.default.createElement("div", {
                style: {
                    width: "100%",
                    display: "inline-block",
                    marginTop: "10px",
                    color: "white"
                }
            }, "CUSTOM SIZE"),

            react_1.default.createElement("div", {className:'custom_size'},
                react_1.default.createElement("div", {style: {marginRight: "15px"}},
                    react_1.default.createElement("div", {
                        style: {
                            width: "100%",
                            display: "inline-block",
                            color: "white",
                            marginBottom:"4px"
                        }
                    }, "Width"),
                    react_1.default.createElement("div", {
                            style: {
                                width: "100%",
                                display: "inline-block"
                            }
                        },
                    react_1.default.createElement(core_1.NumericInput, {
                            fill: !0,
                            value: e.vWidth,
                            onValueChange: a =>{
                                e.setVWidth(a);
                                e.setWidth(e.setUnitConverter(e.vWidth,'px',e.unit));
                                e.setSize(e.width, e.height, t);
                            },
                            min: 10,
                            max: 1e4,
                            buttonPosition: "none",
                            selectAllOnFocus: !0
                        }))),

                react_1.default.createElement("div", {style: {marginRight: "15px"}},
                    react_1.default.createElement("div", {
                        style: {
                            width: "100%",
                            display: "inline-block",
                            color: "white",
                            marginBottom:"4px"
                        }
                    }, "Height"),
                    react_1.default.createElement("div", {
                            style: {
                                width: "100%",
                                display: "inline-block"
                            }
                        },
                    react_1.default.createElement(core_1.NumericInput, {
                            fill: !0,
                            value: e.vHeight,
                            onValueChange: a => {
                                e.setVHeight(a);
                                e.setHeight(e.setUnitConverter(e.vHeight,'px',e.unit));
                                e.setSize(e.width, e.height, t);
                                console.log(e);
                            },
                            min: 10,
                            max: 1e4,
                            buttonPosition: "none",
                            selectAllOnFocus: !0
                        }))),


                react_1.default.createElement("div", {style: {marginRight: "15px"}},
                    react_1.default.createElement("div", {
                        style: {
                            width: "100%",
                            display: "inline-block",
                            color: "white",
                            marginBottom:"4px"
                        }
                    }, "Unit"),
                    react_1.default.createElement("div", {
                            style: {
                                width: "100%",
                                display: "inline-block"
                            }
                        },
                        react_1.default.createElement(core_1.HTMLSelect, {
                            options:[ "px","mm", "cm", "in", "pt"],
                            className:'unitSelect',
                            onChange:a => {
                                e.setVHeight(e.setUnitConverter(e.vHeight,a.target.value,e.unit));
                                e.setVWidth(e.setUnitConverter(e.vWidth,a.target.value,e.unit));
                                e.setUnit(a.target.value);
                            },
                        }))),
            ),




            react_1.default.createElement("div", {style: {paddingBottom: "15px"}}, react_1.default.createElement("div", {
                    style: {
                        width: "100%",
                        display: "inline-block",
                        color: "white"
                    }
                }, "PRESET SIZE")),

            exports.DEFAULT_SIZES.map((([a, l, i, n]) => react_1.default.createElement(core_1.Button, {
                key: a,
                style: {width: "100%", paddingTop: "10px", paddingBottom: "10px", fontSize: "16px"},
                minimal: !0,
                onClick: () => {
                    e.setVHeight(e.setUnitConverter(i,e.unit,'mm'));
                    e.setVWidth(e.setUnitConverter(l,e.unit,'mm'));
                    e.setHeight(e.setUnitConverter(i,'px','mm'));
                    e.setWidth(e.setUnitConverter(l,'px','mm'));
                    e.setSize(e.width, e.height, t)
                },
                icon: n,
                alignText: "left",
                className: "size_button"
            }, a, react_1.default.createElement("span", {style: {fontSize: "0.7rem", paddingLeft: "20px"}}, l, " x ", i)))))
    }));



