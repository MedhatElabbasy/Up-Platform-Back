"use strict";
Object.defineProperty(exports, "__esModule", {value: !0}), exports.setAPI = exports.iconscoutDownload = exports.iconscoutList = exports.unsplashDownload = exports.unsplashList = exports.textTemplateList = exports.templateList = exports.removeBackground = exports.polotnoShapesList = exports.getGoogleFontImage = exports.getGoogleFontsListAPI = exports.URLS = exports.URL = exports.API = void 0;
const validate_key_1 = require("./validate-key");
var protocol = window.location.protocol;
var host = window.location.host;
var urlString = window.location.href;
var paramString = urlString.split('?')[1];
var queryString = new URLSearchParams(paramString);

var params= '';
var myUId= '';
for (var pair of queryString.entries()) {
    params+='&'+pair[0]+'='+pair[1]
    if("u_id" == pair[0]){
        myUId = pair[1];
    }
}
console.log(params);
var baseUrl = protocol + "//" + host;
var baseUrl = BASEURL;
exports.API = baseUrl+"/api", exports.URL = baseUrl;
var myRequestPath= location.pathname;
var myRequestId= myRequestPath.substring(myRequestPath.lastIndexOf("/") + 1, myRequestPath.length);
const showedWarnings = {}, warn = (e, t) => {
        showedWarnings[e] || (showedWarnings[e] = !0, console.error(t))
    }, replaceAll = (e, t, o) => e.replace(new RegExp(t, "g"), o),
    ICONSCOUT_MESSAGE = "API for iconscout is provided as a demonstration.\nFor production usage you have to use your own API endpoint.\nhttps://iconscout.com/developers, https://iconscout.com/legal/api-license-development-agreement\nhttps://polotno.dev/docs/server-api";
exports.URLS = {
    shortCodeImage: ({
                       query: e,
                       page: t = 1
                   }) => `${exports.API}/get-short-code-image?query=${e}&per_page=20&page=${t}&KEY=${(0, validate_key_1.getKey)()}`,
    unsplashList: ({
                       query: e,
                       page: t = 1
                   }) => `${exports.API}/get-unsplash?query=${e}&per_page=20&page=${t}&KEY=${(0, validate_key_1.getKey)()}`,
    recentUploadList: ({
                           query: e,
                           type: t
                   }) => `${exports.API}/get-unsplash-recent?batch_id=${e}&type=${t}&KEY=${(0, validate_key_1.getKey)()}`,
    unsplashDownload: e => `${exports.API}/download-unsplash?id=${e}&KEY=${(0, validate_key_1.getKey)()}`,
    iconscoutList: ({
                        query: e,
                        page: t = 1
                    }) => (warn("iconscout", ICONSCOUT_MESSAGE), `${exports.API}/get-iconscout?query=${e}&page=${t}&KEY=${(0, validate_key_1.getKey)()}`),
    iconscoutDownload: e => (warn("iconscout", ICONSCOUT_MESSAGE), `${exports.API}/download-iconscout?uuid=${e}&KEY=${(0, validate_key_1.getKey)()}`),
    templateList: ({
                       query: e,
                       page: t = 1,
                       sizeQuery: o
                   }) => `${exports.API}/get-templates?${o}&query=${e}&u_id=${myUId}&r_id=${myRequestId}&per_page=30&page=${t}${params}&KEY=${(0, validate_key_1.getKey)()}`,
};
const getGoogleFontsListAPI = () => `${exports.API}/get-google-fonts?KEY=${(0, validate_key_1.getKey)()}`;
exports.getGoogleFontsListAPI = getGoogleFontsListAPI;
const getGoogleFontImage = e => {
    return `${exports.URL}/public/certificate_pro/google-fonts-previews/black/${t = e, o = " ", s = "-", t.replace(new RegExp(o, "g"), s)}.png`;
    var t, o, s
};
exports.getGoogleFontImage = getGoogleFontImage;
const polotnoShapesList = () => `${exports.API}/get-basic-shapes?KEY=${(0, validate_key_1.getKey)()}`;
exports.polotnoShapesList = polotnoShapesList;
const removeBackground = () => `${exports.API}/remove-image-background?KEY=${(0, validate_key_1.getKey)()}`;
exports.removeBackground = removeBackground;
const templateList = e => exports.URLS.templateList(e);
exports.templateList = templateList;

const shortCodeImage = e => exports.URLS.shortCodeImage(e);
exports.shortCodeImage = shortCodeImage;

const textTemplateList = () => `${exports.API}/get-text-templates?KEY=${(0, validate_key_1.getKey)()}`;
exports.textTemplateList = textTemplateList;

const unsplashList = e => exports.URLS.unsplashList(e);
exports.unsplashList = unsplashList;

const recentUploadList = e => exports.URLS.recentUploadList(e);
exports.recentUploadList = recentUploadList;

const unsplashDownload = e => exports.URLS.unsplashDownload(e);
exports.unsplashDownload = unsplashDownload;
const iconscoutList = e => exports.URLS.iconscoutList(e);
exports.iconscoutList = iconscoutList;
const iconscoutDownload = e => exports.URLS.iconscoutDownload(e);
exports.iconscoutDownload = iconscoutDownload;

const AppUrl = () => `${baseUrl}`;
exports.AppUrl = AppUrl;
const setAPI = (e, t) => {
    exports.URLS[e] = t
};
exports.setAPI = setAPI;
