import { Instance } from 'mobx-state-tree';
export declare const Element: import("mobx-state-tree").IModelType<{
    id: import("mobx-state-tree").ISimpleType<string>;
    type: import("mobx-state-tree").IType<string | undefined, string, string>;
    x: import("mobx-state-tree").IType<number | undefined, number, number>;
    y: import("mobx-state-tree").IType<number | undefined, number, number>;
    rotation: import("mobx-state-tree").IType<number | undefined, number, number>;
    opacity: import("mobx-state-tree").IType<number | undefined, number, number>;
    locked: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
    blurEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
    blurRadius: import("mobx-state-tree").IType<number | undefined, number, number>;
    brightnessEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
    brightness: import("mobx-state-tree").IType<number | undefined, number, number>;
    sepiaEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
    grayscaleEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
    shadowEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
    shadowBlur: import("mobx-state-tree").IType<number | undefined, number, number>;
    shadowOffsetX: import("mobx-state-tree").IType<number | undefined, number, number>;
    shadowOffsetY: import("mobx-state-tree").IType<number | undefined, number, number>;
    shadowColor: import("mobx-state-tree").IType<string | undefined, string, string>;
    custom: import("mobx-state-tree").IType<any, any, any>;
    selectable: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
    alwaysOnTop: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
    showInExport: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
}, {
    readonly page: any;
    readonly store: any;
} & {
    toJSON(): {};
} & {
    clone(attrs: any): {
        id: string;
        type: string;
        x: number;
        y: number;
        rotation: number;
        opacity: number;
        locked: boolean;
        blurEnabled: boolean;
        blurRadius: number;
        brightnessEnabled: boolean;
        brightness: number;
        sepiaEnabled: boolean;
        grayscaleEnabled: boolean;
        shadowEnabled: boolean;
        shadowBlur: number;
        shadowOffsetX: number;
        shadowOffsetY: number;
        shadowColor: string;
        custom: any;
        selectable: boolean;
        alwaysOnTop: boolean;
        showInExport: boolean;
    } & import("mobx-state-tree/dist/internal").NonEmptyObject & {
        readonly page: any;
        readonly store: any;
    } & {
        toJSON(): {};
    } & any & import("mobx-state-tree").IStateTreeNode<import("mobx-state-tree").IModelType<{
        id: import("mobx-state-tree").ISimpleType<string>;
        type: import("mobx-state-tree").IType<string | undefined, string, string>;
        x: import("mobx-state-tree").IType<number | undefined, number, number>;
        y: import("mobx-state-tree").IType<number | undefined, number, number>;
        rotation: import("mobx-state-tree").IType<number | undefined, number, number>;
        opacity: import("mobx-state-tree").IType<number | undefined, number, number>;
        locked: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
        blurEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
        blurRadius: import("mobx-state-tree").IType<number | undefined, number, number>;
        brightnessEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
        brightness: import("mobx-state-tree").IType<number | undefined, number, number>;
        sepiaEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
        grayscaleEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
        shadowEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
        shadowBlur: import("mobx-state-tree").IType<number | undefined, number, number>;
        shadowOffsetX: import("mobx-state-tree").IType<number | undefined, number, number>;
        shadowOffsetY: import("mobx-state-tree").IType<number | undefined, number, number>;
        shadowColor: import("mobx-state-tree").IType<string | undefined, string, string>;
        custom: import("mobx-state-tree").IType<any, any, any>;
        selectable: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
        alwaysOnTop: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
        showInExport: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
    }, {
        readonly page: any;
        readonly store: any;
    } & {
        toJSON(): {};
    } & any, import("mobx-state-tree").ModelCreationType<import("mobx-state-tree/dist/internal").ExtractCFromProps<{
        id: import("mobx-state-tree").ISimpleType<string>;
        type: import("mobx-state-tree").IType<string | undefined, string, string>;
        x: import("mobx-state-tree").IType<number | undefined, number, number>;
        y: import("mobx-state-tree").IType<number | undefined, number, number>;
        rotation: import("mobx-state-tree").IType<number | undefined, number, number>;
        opacity: import("mobx-state-tree").IType<number | undefined, number, number>;
        locked: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
        blurEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
        blurRadius: import("mobx-state-tree").IType<number | undefined, number, number>;
        brightnessEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
        brightness: import("mobx-state-tree").IType<number | undefined, number, number>;
        sepiaEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
        grayscaleEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
        shadowEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
        shadowBlur: import("mobx-state-tree").IType<number | undefined, number, number>;
        shadowOffsetX: import("mobx-state-tree").IType<number | undefined, number, number>;
        shadowOffsetY: import("mobx-state-tree").IType<number | undefined, number, number>;
        shadowColor: import("mobx-state-tree").IType<string | undefined, string, string>;
        custom: import("mobx-state-tree").IType<any, any, any>;
        selectable: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
        alwaysOnTop: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
        showInExport: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
    }>>, {}>>;
    set(attrs: any): void;
    moveUp(): void;
    moveTop(): void;
    moveDown(): void;
    moveBottom(): void;
    beforeDestroy(): void;
}, import("mobx-state-tree").ModelCreationType<import("mobx-state-tree/dist/internal").ExtractCFromProps<{
    id: import("mobx-state-tree").ISimpleType<string>;
    type: import("mobx-state-tree").IType<string | undefined, string, string>;
    x: import("mobx-state-tree").IType<number | undefined, number, number>;
    y: import("mobx-state-tree").IType<number | undefined, number, number>;
    rotation: import("mobx-state-tree").IType<number | undefined, number, number>;
    opacity: import("mobx-state-tree").IType<number | undefined, number, number>;
    locked: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
    blurEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
    blurRadius: import("mobx-state-tree").IType<number | undefined, number, number>;
    brightnessEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
    brightness: import("mobx-state-tree").IType<number | undefined, number, number>;
    sepiaEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
    grayscaleEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
    shadowEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
    shadowBlur: import("mobx-state-tree").IType<number | undefined, number, number>;
    shadowOffsetX: import("mobx-state-tree").IType<number | undefined, number, number>;
    shadowOffsetY: import("mobx-state-tree").IType<number | undefined, number, number>;
    shadowColor: import("mobx-state-tree").IType<string | undefined, string, string>;
    custom: import("mobx-state-tree").IType<any, any, any>;
    selectable: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
    alwaysOnTop: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
    showInExport: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
}>>, {}>;
export declare type ElementType = Instance<typeof Element>;
export declare const TextElement: import("mobx-state-tree").IModelType<{
    id: import("mobx-state-tree").ISimpleType<string>;
    type: import("mobx-state-tree").IType<string | undefined, string, string>;
    x: import("mobx-state-tree").IType<number | undefined, number, number>;
    y: import("mobx-state-tree").IType<number | undefined, number, number>;
    rotation: import("mobx-state-tree").IType<number | undefined, number, number>;
    opacity: import("mobx-state-tree").IType<number | undefined, number, number>;
    locked: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
    blurEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
    blurRadius: import("mobx-state-tree").IType<number | undefined, number, number>;
    brightnessEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
    brightness: import("mobx-state-tree").IType<number | undefined, number, number>;
    sepiaEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
    grayscaleEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
    shadowEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
    shadowBlur: import("mobx-state-tree").IType<number | undefined, number, number>;
    shadowOffsetX: import("mobx-state-tree").IType<number | undefined, number, number>;
    shadowOffsetY: import("mobx-state-tree").IType<number | undefined, number, number>;
    shadowColor: import("mobx-state-tree").IType<string | undefined, string, string>;
    custom: import("mobx-state-tree").IType<any, any, any>;
    selectable: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
    alwaysOnTop: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
    showInExport: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
} & {
    type: import("mobx-state-tree").IType<string | undefined, string, string>;
    text: import("mobx-state-tree").IType<string | undefined, string, string>;
    placeholder: import("mobx-state-tree").IType<string | undefined, string, string>;
    fontSize: import("mobx-state-tree").IType<number | undefined, number, number>;
    fontFamily: import("mobx-state-tree").IType<string | undefined, string, string>;
    fontStyle: import("mobx-state-tree").IType<string | undefined, string, string>;
    fontWeight: import("mobx-state-tree").IType<string | undefined, string, string>;
    textDecoration: import("mobx-state-tree").IType<string | undefined, string, string>;
    fill: import("mobx-state-tree").IType<string | undefined, string, string>;
    align: import("mobx-state-tree").IType<string | undefined, string, string>;
    width: import("mobx-state-tree").IType<number | undefined, number, number>;
    height: import("mobx-state-tree").IType<number | undefined, number, number>;
    strokeWidth: import("mobx-state-tree").IType<number | undefined, number, number>;
    stroke: import("mobx-state-tree").IType<string | undefined, string, string>;
    lineHeight: import("mobx-state-tree").IOptionalIType<import("mobx-state-tree").ITypeUnion<string | number, string | number, string | number>, [undefined]>;
    letterSpacing: import("mobx-state-tree").IType<number | undefined, number, number>;
    _editModeEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
}, {
    readonly page: any;
    readonly store: any;
} & {
    toJSON(): {};
} & {
    clone(attrs: any): {
        id: string;
        type: string;
        x: number;
        y: number;
        rotation: number;
        opacity: number;
        locked: boolean;
        blurEnabled: boolean;
        blurRadius: number;
        brightnessEnabled: boolean;
        brightness: number;
        sepiaEnabled: boolean;
        grayscaleEnabled: boolean;
        shadowEnabled: boolean;
        shadowBlur: number;
        shadowOffsetX: number;
        shadowOffsetY: number;
        shadowColor: string;
        custom: any;
        selectable: boolean;
        alwaysOnTop: boolean;
        showInExport: boolean;
    } & import("mobx-state-tree/dist/internal").NonEmptyObject & {
        readonly page: any;
        readonly store: any;
    } & {
        toJSON(): {};
    } & any & import("mobx-state-tree").IStateTreeNode<import("mobx-state-tree").IModelType<{
        id: import("mobx-state-tree").ISimpleType<string>;
        type: import("mobx-state-tree").IType<string | undefined, string, string>;
        x: import("mobx-state-tree").IType<number | undefined, number, number>;
        y: import("mobx-state-tree").IType<number | undefined, number, number>;
        rotation: import("mobx-state-tree").IType<number | undefined, number, number>;
        opacity: import("mobx-state-tree").IType<number | undefined, number, number>;
        locked: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
        blurEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
        blurRadius: import("mobx-state-tree").IType<number | undefined, number, number>;
        brightnessEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
        brightness: import("mobx-state-tree").IType<number | undefined, number, number>;
        sepiaEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
        grayscaleEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
        shadowEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
        shadowBlur: import("mobx-state-tree").IType<number | undefined, number, number>;
        shadowOffsetX: import("mobx-state-tree").IType<number | undefined, number, number>;
        shadowOffsetY: import("mobx-state-tree").IType<number | undefined, number, number>;
        shadowColor: import("mobx-state-tree").IType<string | undefined, string, string>;
        custom: import("mobx-state-tree").IType<any, any, any>;
        selectable: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
        alwaysOnTop: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
        showInExport: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
    }, {
        readonly page: any;
        readonly store: any;
    } & {
        toJSON(): {};
    } & any, import("mobx-state-tree").ModelCreationType<import("mobx-state-tree/dist/internal").ExtractCFromProps<{
        id: import("mobx-state-tree").ISimpleType<string>;
        type: import("mobx-state-tree").IType<string | undefined, string, string>;
        x: import("mobx-state-tree").IType<number | undefined, number, number>;
        y: import("mobx-state-tree").IType<number | undefined, number, number>;
        rotation: import("mobx-state-tree").IType<number | undefined, number, number>;
        opacity: import("mobx-state-tree").IType<number | undefined, number, number>;
        locked: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
        blurEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
        blurRadius: import("mobx-state-tree").IType<number | undefined, number, number>;
        brightnessEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
        brightness: import("mobx-state-tree").IType<number | undefined, number, number>;
        sepiaEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
        grayscaleEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
        shadowEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
        shadowBlur: import("mobx-state-tree").IType<number | undefined, number, number>;
        shadowOffsetX: import("mobx-state-tree").IType<number | undefined, number, number>;
        shadowOffsetY: import("mobx-state-tree").IType<number | undefined, number, number>;
        shadowColor: import("mobx-state-tree").IType<string | undefined, string, string>;
        custom: import("mobx-state-tree").IType<any, any, any>;
        selectable: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
        alwaysOnTop: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
        showInExport: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
    }>>, {}>>;
    set(attrs: any): void;
    moveUp(): void;
    moveTop(): void;
    moveDown(): void;
    moveBottom(): void;
    beforeDestroy(): void;
} & {
    toggleEditMode(editing?: boolean | undefined): void;
}, import("mobx-state-tree").ModelCreationType<import("mobx-state-tree/dist/internal").ExtractCFromProps<{
    id: import("mobx-state-tree").ISimpleType<string>;
    type: import("mobx-state-tree").IType<string | undefined, string, string>;
    x: import("mobx-state-tree").IType<number | undefined, number, number>;
    y: import("mobx-state-tree").IType<number | undefined, number, number>;
    rotation: import("mobx-state-tree").IType<number | undefined, number, number>;
    opacity: import("mobx-state-tree").IType<number | undefined, number, number>;
    locked: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
    blurEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
    blurRadius: import("mobx-state-tree").IType<number | undefined, number, number>;
    brightnessEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
    brightness: import("mobx-state-tree").IType<number | undefined, number, number>;
    sepiaEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
    grayscaleEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
    shadowEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
    shadowBlur: import("mobx-state-tree").IType<number | undefined, number, number>;
    shadowOffsetX: import("mobx-state-tree").IType<number | undefined, number, number>;
    shadowOffsetY: import("mobx-state-tree").IType<number | undefined, number, number>;
    shadowColor: import("mobx-state-tree").IType<string | undefined, string, string>;
    custom: import("mobx-state-tree").IType<any, any, any>;
    selectable: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
    alwaysOnTop: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
    showInExport: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
}>>, {}>;
export declare type TextElementType = Instance<typeof TextElement>;
export declare const ImageElement: import("mobx-state-tree").IModelType<{
    id: import("mobx-state-tree").ISimpleType<string>;
    type: import("mobx-state-tree").IType<string | undefined, string, string>;
    x: import("mobx-state-tree").IType<number | undefined, number, number>;
    y: import("mobx-state-tree").IType<number | undefined, number, number>;
    rotation: import("mobx-state-tree").IType<number | undefined, number, number>;
    opacity: import("mobx-state-tree").IType<number | undefined, number, number>;
    locked: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
    blurEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
    blurRadius: import("mobx-state-tree").IType<number | undefined, number, number>;
    brightnessEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
    brightness: import("mobx-state-tree").IType<number | undefined, number, number>;
    sepiaEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
    grayscaleEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
    shadowEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
    shadowBlur: import("mobx-state-tree").IType<number | undefined, number, number>;
    shadowOffsetX: import("mobx-state-tree").IType<number | undefined, number, number>;
    shadowOffsetY: import("mobx-state-tree").IType<number | undefined, number, number>;
    shadowColor: import("mobx-state-tree").IType<string | undefined, string, string>;
    custom: import("mobx-state-tree").IType<any, any, any>;
    selectable: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
    alwaysOnTop: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
    showInExport: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
} & {
    type: import("mobx-state-tree").IType<string | undefined, string, string>;
    width: import("mobx-state-tree").IType<number | undefined, number, number>;
    height: import("mobx-state-tree").IType<number | undefined, number, number>;
    src: import("mobx-state-tree").IType<string | undefined, string, string>;
    cropX: import("mobx-state-tree").IType<number | undefined, number, number>;
    cropY: import("mobx-state-tree").IType<number | undefined, number, number>;
    cropWidth: import("mobx-state-tree").IType<number | undefined, number, number>;
    cropHeight: import("mobx-state-tree").IType<number | undefined, number, number>;
    cornerRadius: import("mobx-state-tree").IType<number | undefined, number, number>;
    flipX: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
    flipY: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
    clipSrc: import("mobx-state-tree").IType<string | undefined, string, string>;
    borderColor: import("mobx-state-tree").IType<string | undefined, string, string>;
    borderSize: import("mobx-state-tree").IType<number | undefined, number, number>;
    _cropModeEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
}, {
    readonly page: any;
    readonly store: any;
} & {
    toJSON(): {};
} & {
    clone(attrs: any): {
        id: string;
        type: string;
        x: number;
        y: number;
        rotation: number;
        opacity: number;
        locked: boolean;
        blurEnabled: boolean;
        blurRadius: number;
        brightnessEnabled: boolean;
        brightness: number;
        sepiaEnabled: boolean;
        grayscaleEnabled: boolean;
        shadowEnabled: boolean;
        shadowBlur: number;
        shadowOffsetX: number;
        shadowOffsetY: number;
        shadowColor: string;
        custom: any;
        selectable: boolean;
        alwaysOnTop: boolean;
        showInExport: boolean;
    } & import("mobx-state-tree/dist/internal").NonEmptyObject & {
        readonly page: any;
        readonly store: any;
    } & {
        toJSON(): {};
    } & any & import("mobx-state-tree").IStateTreeNode<import("mobx-state-tree").IModelType<{
        id: import("mobx-state-tree").ISimpleType<string>;
        type: import("mobx-state-tree").IType<string | undefined, string, string>;
        x: import("mobx-state-tree").IType<number | undefined, number, number>;
        y: import("mobx-state-tree").IType<number | undefined, number, number>;
        rotation: import("mobx-state-tree").IType<number | undefined, number, number>;
        opacity: import("mobx-state-tree").IType<number | undefined, number, number>;
        locked: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
        blurEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
        blurRadius: import("mobx-state-tree").IType<number | undefined, number, number>;
        brightnessEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
        brightness: import("mobx-state-tree").IType<number | undefined, number, number>;
        sepiaEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
        grayscaleEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
        shadowEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
        shadowBlur: import("mobx-state-tree").IType<number | undefined, number, number>;
        shadowOffsetX: import("mobx-state-tree").IType<number | undefined, number, number>;
        shadowOffsetY: import("mobx-state-tree").IType<number | undefined, number, number>;
        shadowColor: import("mobx-state-tree").IType<string | undefined, string, string>;
        custom: import("mobx-state-tree").IType<any, any, any>;
        selectable: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
        alwaysOnTop: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
        showInExport: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
    }, {
        readonly page: any;
        readonly store: any;
    } & {
        toJSON(): {};
    } & any, import("mobx-state-tree").ModelCreationType<import("mobx-state-tree/dist/internal").ExtractCFromProps<{
        id: import("mobx-state-tree").ISimpleType<string>;
        type: import("mobx-state-tree").IType<string | undefined, string, string>;
        x: import("mobx-state-tree").IType<number | undefined, number, number>;
        y: import("mobx-state-tree").IType<number | undefined, number, number>;
        rotation: import("mobx-state-tree").IType<number | undefined, number, number>;
        opacity: import("mobx-state-tree").IType<number | undefined, number, number>;
        locked: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
        blurEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
        blurRadius: import("mobx-state-tree").IType<number | undefined, number, number>;
        brightnessEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
        brightness: import("mobx-state-tree").IType<number | undefined, number, number>;
        sepiaEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
        grayscaleEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
        shadowEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
        shadowBlur: import("mobx-state-tree").IType<number | undefined, number, number>;
        shadowOffsetX: import("mobx-state-tree").IType<number | undefined, number, number>;
        shadowOffsetY: import("mobx-state-tree").IType<number | undefined, number, number>;
        shadowColor: import("mobx-state-tree").IType<string | undefined, string, string>;
        custom: import("mobx-state-tree").IType<any, any, any>;
        selectable: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
        alwaysOnTop: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
        showInExport: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
    }>>, {}>>;
    set(attrs: any): void;
    moveUp(): void;
    moveTop(): void;
    moveDown(): void;
    moveBottom(): void;
    beforeDestroy(): void;
} & {
    toggleCropMode(flag?: boolean | undefined): void;
}, import("mobx-state-tree").ModelCreationType<import("mobx-state-tree/dist/internal").ExtractCFromProps<{
    id: import("mobx-state-tree").ISimpleType<string>;
    type: import("mobx-state-tree").IType<string | undefined, string, string>;
    x: import("mobx-state-tree").IType<number | undefined, number, number>;
    y: import("mobx-state-tree").IType<number | undefined, number, number>;
    rotation: import("mobx-state-tree").IType<number | undefined, number, number>;
    opacity: import("mobx-state-tree").IType<number | undefined, number, number>;
    locked: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
    blurEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
    blurRadius: import("mobx-state-tree").IType<number | undefined, number, number>;
    brightnessEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
    brightness: import("mobx-state-tree").IType<number | undefined, number, number>;
    sepiaEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
    grayscaleEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
    shadowEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
    shadowBlur: import("mobx-state-tree").IType<number | undefined, number, number>;
    shadowOffsetX: import("mobx-state-tree").IType<number | undefined, number, number>;
    shadowOffsetY: import("mobx-state-tree").IType<number | undefined, number, number>;
    shadowColor: import("mobx-state-tree").IType<string | undefined, string, string>;
    custom: import("mobx-state-tree").IType<any, any, any>;
    selectable: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
    alwaysOnTop: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
    showInExport: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
}>>, {}>;
export declare type ImageElementType = Instance<typeof ImageElement>;
export declare const SVGElement: import("mobx-state-tree").IModelType<{
    id: import("mobx-state-tree").ISimpleType<string>;
    type: import("mobx-state-tree").IType<string | undefined, string, string>;
    x: import("mobx-state-tree").IType<number | undefined, number, number>;
    y: import("mobx-state-tree").IType<number | undefined, number, number>;
    rotation: import("mobx-state-tree").IType<number | undefined, number, number>;
    opacity: import("mobx-state-tree").IType<number | undefined, number, number>;
    locked: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
    blurEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
    blurRadius: import("mobx-state-tree").IType<number | undefined, number, number>;
    brightnessEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
    brightness: import("mobx-state-tree").IType<number | undefined, number, number>;
    sepiaEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
    grayscaleEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
    shadowEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
    shadowBlur: import("mobx-state-tree").IType<number | undefined, number, number>;
    shadowOffsetX: import("mobx-state-tree").IType<number | undefined, number, number>;
    shadowOffsetY: import("mobx-state-tree").IType<number | undefined, number, number>;
    shadowColor: import("mobx-state-tree").IType<string | undefined, string, string>;
    custom: import("mobx-state-tree").IType<any, any, any>;
    selectable: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
    alwaysOnTop: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
    showInExport: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
} & {
    type: import("mobx-state-tree").IType<string | undefined, string, string>;
    src: import("mobx-state-tree").IType<string | undefined, string, string>;
    maskSrc: import("mobx-state-tree").IType<string | undefined, string, string>;
    __svgString: import("mobx-state-tree").IType<string | undefined, string, string>;
    cropX: import("mobx-state-tree").IType<number | undefined, number, number>;
    cropY: import("mobx-state-tree").IType<number | undefined, number, number>;
    cropWidth: import("mobx-state-tree").IType<number | undefined, number, number>;
    cropHeight: import("mobx-state-tree").IType<number | undefined, number, number>;
    keepRatio: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
    flipX: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
    flipY: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
    width: import("mobx-state-tree").IType<number | undefined, number, number>;
    height: import("mobx-state-tree").IType<number | undefined, number, number>;
    borderColor: import("mobx-state-tree").IType<string | undefined, string, string>;
    borderSize: import("mobx-state-tree").IType<number | undefined, number, number>;
    colorsReplace: import("mobx-state-tree").IMapType<import("mobx-state-tree").ISimpleType<string>>;
}, {
    readonly page: any;
    readonly store: any;
} & {
    toJSON(): {};
} & {
    clone(attrs: any): {
        id: string;
        type: string;
        x: number;
        y: number;
        rotation: number;
        opacity: number;
        locked: boolean;
        blurEnabled: boolean;
        blurRadius: number;
        brightnessEnabled: boolean;
        brightness: number;
        sepiaEnabled: boolean;
        grayscaleEnabled: boolean;
        shadowEnabled: boolean;
        shadowBlur: number;
        shadowOffsetX: number;
        shadowOffsetY: number;
        shadowColor: string;
        custom: any;
        selectable: boolean;
        alwaysOnTop: boolean;
        showInExport: boolean;
    } & import("mobx-state-tree/dist/internal").NonEmptyObject & {
        readonly page: any;
        readonly store: any;
    } & {
        toJSON(): {};
    } & any & import("mobx-state-tree").IStateTreeNode<import("mobx-state-tree").IModelType<{
        id: import("mobx-state-tree").ISimpleType<string>;
        type: import("mobx-state-tree").IType<string | undefined, string, string>;
        x: import("mobx-state-tree").IType<number | undefined, number, number>;
        y: import("mobx-state-tree").IType<number | undefined, number, number>;
        rotation: import("mobx-state-tree").IType<number | undefined, number, number>;
        opacity: import("mobx-state-tree").IType<number | undefined, number, number>;
        locked: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
        blurEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
        blurRadius: import("mobx-state-tree").IType<number | undefined, number, number>;
        brightnessEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
        brightness: import("mobx-state-tree").IType<number | undefined, number, number>;
        sepiaEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
        grayscaleEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
        shadowEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
        shadowBlur: import("mobx-state-tree").IType<number | undefined, number, number>;
        shadowOffsetX: import("mobx-state-tree").IType<number | undefined, number, number>;
        shadowOffsetY: import("mobx-state-tree").IType<number | undefined, number, number>;
        shadowColor: import("mobx-state-tree").IType<string | undefined, string, string>;
        custom: import("mobx-state-tree").IType<any, any, any>;
        selectable: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
        alwaysOnTop: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
        showInExport: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
    }, {
        readonly page: any;
        readonly store: any;
    } & {
        toJSON(): {};
    } & any, import("mobx-state-tree").ModelCreationType<import("mobx-state-tree/dist/internal").ExtractCFromProps<{
        id: import("mobx-state-tree").ISimpleType<string>;
        type: import("mobx-state-tree").IType<string | undefined, string, string>;
        x: import("mobx-state-tree").IType<number | undefined, number, number>;
        y: import("mobx-state-tree").IType<number | undefined, number, number>;
        rotation: import("mobx-state-tree").IType<number | undefined, number, number>;
        opacity: import("mobx-state-tree").IType<number | undefined, number, number>;
        locked: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
        blurEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
        blurRadius: import("mobx-state-tree").IType<number | undefined, number, number>;
        brightnessEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
        brightness: import("mobx-state-tree").IType<number | undefined, number, number>;
        sepiaEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
        grayscaleEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
        shadowEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
        shadowBlur: import("mobx-state-tree").IType<number | undefined, number, number>;
        shadowOffsetX: import("mobx-state-tree").IType<number | undefined, number, number>;
        shadowOffsetY: import("mobx-state-tree").IType<number | undefined, number, number>;
        shadowColor: import("mobx-state-tree").IType<string | undefined, string, string>;
        custom: import("mobx-state-tree").IType<any, any, any>;
        selectable: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
        alwaysOnTop: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
        showInExport: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
    }>>, {}>>;
    set(attrs: any): void;
    moveUp(): void;
    moveTop(): void;
    moveDown(): void;
    moveBottom(): void;
    beforeDestroy(): void;
} & {
    readonly colors: string[];
    readonly __finalSrc: any;
    readonly __isLoaded: boolean;
} & {
    _loadSVG(): Promise<void>;
    afterCreate(): Promise<void>;
    beforeDestroy(): void;
    replaceColor(oldColor: any, newColor: any): void;
}, import("mobx-state-tree").ModelCreationType<import("mobx-state-tree/dist/internal").ExtractCFromProps<{
    id: import("mobx-state-tree").ISimpleType<string>;
    type: import("mobx-state-tree").IType<string | undefined, string, string>;
    x: import("mobx-state-tree").IType<number | undefined, number, number>;
    y: import("mobx-state-tree").IType<number | undefined, number, number>;
    rotation: import("mobx-state-tree").IType<number | undefined, number, number>;
    opacity: import("mobx-state-tree").IType<number | undefined, number, number>;
    locked: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
    blurEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
    blurRadius: import("mobx-state-tree").IType<number | undefined, number, number>;
    brightnessEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
    brightness: import("mobx-state-tree").IType<number | undefined, number, number>;
    sepiaEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
    grayscaleEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
    shadowEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
    shadowBlur: import("mobx-state-tree").IType<number | undefined, number, number>;
    shadowOffsetX: import("mobx-state-tree").IType<number | undefined, number, number>;
    shadowOffsetY: import("mobx-state-tree").IType<number | undefined, number, number>;
    shadowColor: import("mobx-state-tree").IType<string | undefined, string, string>;
    custom: import("mobx-state-tree").IType<any, any, any>;
    selectable: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
    alwaysOnTop: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
    showInExport: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
}>>, {}>;
export declare type SVGElementType = Instance<typeof SVGElement>;
export declare function registerShapeModel(defaultAttributes: any): void;
export declare const Page: import("mobx-state-tree").IModelType<{
    id: import("mobx-state-tree").ISimpleType<string>;
    children: import("mobx-state-tree").IArrayType<import("mobx-state-tree").IAnyType>;
    background: import("mobx-state-tree").IType<string | undefined, string, string>;
    custom: import("mobx-state-tree").IType<any, any, any>;
}, {
    readonly store: any;
} & {
    toJSON(): any;
    clone(attrs?: any): any;
    setZIndex(zIndex: any): void;
    set(attrs: any): void;
    select(): void;
    addElement(attrs: any): any;
    moveElementUp(id: any): void;
    moveElementDown(id: any): void;
    moveElementTop(id: any): void;
    moveElementBottom(id: any): void;
}, import("mobx-state-tree")._NotCustomized, import("mobx-state-tree")._NotCustomized>;
export declare type PageType = Instance<typeof Page>;
export declare const Font: import("mobx-state-tree").IModelType<{
    fontFamily: import("mobx-state-tree").ISimpleType<string>;
    url: import("mobx-state-tree").IOptionalIType<import("mobx-state-tree").ISimpleType<string>, [undefined]>;
    styles: import("mobx-state-tree").IType<any, any, any>;
}, {}, import("mobx-state-tree").ModelCreationType<import("mobx-state-tree/dist/internal").ExtractCFromProps<{
    fontFamily: import("mobx-state-tree").ISimpleType<string>;
    url: import("mobx-state-tree").IOptionalIType<import("mobx-state-tree").ISimpleType<string>, [undefined]>;
    styles: import("mobx-state-tree").IType<any, any, any>;
}>>, import("mobx-state-tree")._NotCustomized>;
interface ExportOptions {
    pixelRatio?: number;
    ignoreBackground?: boolean;
    pageId?: string;
    mimeType?: 'image/png' | 'image/png';
}
export declare const Store: import("mobx-state-tree").IModelType<{
    role: import("mobx-state-tree").IType<string | undefined, string, string>;
    pages: import("mobx-state-tree").IArrayType<import("mobx-state-tree").IModelType<{
        id: import("mobx-state-tree").ISimpleType<string>;
        children: import("mobx-state-tree").IArrayType<import("mobx-state-tree").IAnyType>;
        background: import("mobx-state-tree").IType<string | undefined, string, string>;
        custom: import("mobx-state-tree").IType<any, any, any>;
    }, {
        readonly store: any;
    } & {
        toJSON(): any;
        clone(attrs?: any): any;
        setZIndex(zIndex: any): void;
        set(attrs: any): void;
        select(): void;
        addElement(attrs: any): any;
        moveElementUp(id: any): void;
        moveElementDown(id: any): void;
        moveElementTop(id: any): void;
        moveElementBottom(id: any): void;
    }, import("mobx-state-tree")._NotCustomized, import("mobx-state-tree")._NotCustomized>>;
    fonts: import("mobx-state-tree").IArrayType<import("mobx-state-tree").IModelType<{
        fontFamily: import("mobx-state-tree").ISimpleType<string>;
        url: import("mobx-state-tree").IOptionalIType<import("mobx-state-tree").ISimpleType<string>, [undefined]>;
        styles: import("mobx-state-tree").IType<any, any, any>;
    }, {}, import("mobx-state-tree").ModelCreationType<import("mobx-state-tree/dist/internal").ExtractCFromProps<{
        fontFamily: import("mobx-state-tree").ISimpleType<string>;
        url: import("mobx-state-tree").IOptionalIType<import("mobx-state-tree").ISimpleType<string>, [undefined]>;
        styles: import("mobx-state-tree").IType<any, any, any>;
    }>>, import("mobx-state-tree")._NotCustomized>>;
    width: import("mobx-state-tree").IType<number | undefined, number, number>;
    height: import("mobx-state-tree").IType<number | undefined, number, number>;
    scale: import("mobx-state-tree").IType<number | undefined, number, number>;
    scaleToFit: import("mobx-state-tree").IType<number | undefined, number, number>;
    openedSidePanel: import("mobx-state-tree").IType<string | undefined, string, string>;
    selectedElementsIds: import("mobx-state-tree").IArrayType<import("mobx-state-tree").ISimpleType<string>>;
    history: import("mobx-state-tree").IOptionalIType<import("mobx-state-tree").IModelType<{
        history: import("mobx-state-tree").IArrayType<import("mobx-state-tree").IType<any, any, any>>;
        undoIdx: import("mobx-state-tree").IType<number | undefined, number, number>;
        targetPath: import("mobx-state-tree").IType<string | undefined, string, string>;
    }, {
        readonly canUndo: boolean;
        readonly canRedo: boolean;
    } & {
        startTransaction(): void;
        endTransaction(skipSave?: boolean | undefined): void;
        ignore(func: any): Promise<void>;
        transaction(func: any): Promise<void>;
        requestAddState(state: any): void;
        addUndoState(): void;
        afterCreate(): void;
        clear(): void;
        beforeDestroy(): void;
        undo(): void;
        redo(): void;
        replaceState(): void;
    }, import("mobx-state-tree")._NotCustomized, import("mobx-state-tree")._NotCustomized>, [undefined]>;
    _elementsPixelRatio: import("mobx-state-tree").IType<number | undefined, number, number>;
    _showCredit: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
    _activePageId: import("mobx-state-tree").IType<string | undefined, string, string>;
}, {
    readonly selectedElements: ({
        id: string;
        type: string;
        x: number;
        y: number;
        rotation: number;
        opacity: number;
        locked: boolean;
        blurEnabled: boolean;
        blurRadius: number;
        brightnessEnabled: boolean;
        brightness: number;
        sepiaEnabled: boolean;
        grayscaleEnabled: boolean;
        shadowEnabled: boolean;
        shadowBlur: number;
        shadowOffsetX: number;
        shadowOffsetY: number;
        shadowColor: string;
        custom: any;
        selectable: boolean;
        alwaysOnTop: boolean;
        showInExport: boolean;
    } & import("mobx-state-tree/dist/internal").NonEmptyObject & {
        readonly page: any;
        readonly store: any;
    } & {
        toJSON(): {};
    } & {
        clone(attrs: any): {
            id: string;
            type: string;
            x: number;
            y: number;
            rotation: number;
            opacity: number;
            locked: boolean;
            blurEnabled: boolean;
            blurRadius: number;
            brightnessEnabled: boolean;
            brightness: number;
            sepiaEnabled: boolean;
            grayscaleEnabled: boolean;
            shadowEnabled: boolean;
            shadowBlur: number;
            shadowOffsetX: number;
            shadowOffsetY: number;
            shadowColor: string;
            custom: any;
            selectable: boolean;
            alwaysOnTop: boolean;
            showInExport: boolean;
        } & import("mobx-state-tree/dist/internal").NonEmptyObject & {
            readonly page: any;
            readonly store: any;
        } & {
            toJSON(): {};
        } & any & import("mobx-state-tree").IStateTreeNode<import("mobx-state-tree").IModelType<{
            id: import("mobx-state-tree").ISimpleType<string>;
            type: import("mobx-state-tree").IType<string | undefined, string, string>;
            x: import("mobx-state-tree").IType<number | undefined, number, number>;
            y: import("mobx-state-tree").IType<number | undefined, number, number>;
            rotation: import("mobx-state-tree").IType<number | undefined, number, number>;
            opacity: import("mobx-state-tree").IType<number | undefined, number, number>;
            locked: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
            blurEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
            blurRadius: import("mobx-state-tree").IType<number | undefined, number, number>;
            brightnessEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
            brightness: import("mobx-state-tree").IType<number | undefined, number, number>;
            sepiaEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
            grayscaleEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
            shadowEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
            shadowBlur: import("mobx-state-tree").IType<number | undefined, number, number>;
            shadowOffsetX: import("mobx-state-tree").IType<number | undefined, number, number>;
            shadowOffsetY: import("mobx-state-tree").IType<number | undefined, number, number>;
            shadowColor: import("mobx-state-tree").IType<string | undefined, string, string>;
            custom: import("mobx-state-tree").IType<any, any, any>;
            selectable: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
            alwaysOnTop: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
            showInExport: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
        }, {
            readonly page: any;
            readonly store: any;
        } & {
            toJSON(): {};
        } & any, import("mobx-state-tree").ModelCreationType<import("mobx-state-tree/dist/internal").ExtractCFromProps<{
            id: import("mobx-state-tree").ISimpleType<string>;
            type: import("mobx-state-tree").IType<string | undefined, string, string>;
            x: import("mobx-state-tree").IType<number | undefined, number, number>;
            y: import("mobx-state-tree").IType<number | undefined, number, number>;
            rotation: import("mobx-state-tree").IType<number | undefined, number, number>;
            opacity: import("mobx-state-tree").IType<number | undefined, number, number>;
            locked: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
            blurEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
            blurRadius: import("mobx-state-tree").IType<number | undefined, number, number>;
            brightnessEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
            brightness: import("mobx-state-tree").IType<number | undefined, number, number>;
            sepiaEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
            grayscaleEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
            shadowEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
            shadowBlur: import("mobx-state-tree").IType<number | undefined, number, number>;
            shadowOffsetX: import("mobx-state-tree").IType<number | undefined, number, number>;
            shadowOffsetY: import("mobx-state-tree").IType<number | undefined, number, number>;
            shadowColor: import("mobx-state-tree").IType<string | undefined, string, string>;
            custom: import("mobx-state-tree").IType<any, any, any>;
            selectable: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
            alwaysOnTop: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
            showInExport: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
        }>>, {}>>;
        set(attrs: any): void;
        moveUp(): void;
        moveTop(): void;
        moveDown(): void;
        moveBottom(): void;
        beforeDestroy(): void;
    } & import("mobx-state-tree").IStateTreeNode<import("mobx-state-tree").IModelType<{
        id: import("mobx-state-tree").ISimpleType<string>;
        type: import("mobx-state-tree").IType<string | undefined, string, string>;
        x: import("mobx-state-tree").IType<number | undefined, number, number>;
        y: import("mobx-state-tree").IType<number | undefined, number, number>;
        rotation: import("mobx-state-tree").IType<number | undefined, number, number>;
        opacity: import("mobx-state-tree").IType<number | undefined, number, number>;
        locked: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
        blurEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
        blurRadius: import("mobx-state-tree").IType<number | undefined, number, number>;
        brightnessEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
        brightness: import("mobx-state-tree").IType<number | undefined, number, number>;
        sepiaEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
        grayscaleEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
        shadowEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
        shadowBlur: import("mobx-state-tree").IType<number | undefined, number, number>;
        shadowOffsetX: import("mobx-state-tree").IType<number | undefined, number, number>;
        shadowOffsetY: import("mobx-state-tree").IType<number | undefined, number, number>;
        shadowColor: import("mobx-state-tree").IType<string | undefined, string, string>;
        custom: import("mobx-state-tree").IType<any, any, any>;
        selectable: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
        alwaysOnTop: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
        showInExport: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
    }, {
        readonly page: any;
        readonly store: any;
    } & {
        toJSON(): {};
    } & {
        clone(attrs: any): {
            id: string;
            type: string;
            x: number;
            y: number;
            rotation: number;
            opacity: number;
            locked: boolean;
            blurEnabled: boolean;
            blurRadius: number;
            brightnessEnabled: boolean;
            brightness: number;
            sepiaEnabled: boolean;
            grayscaleEnabled: boolean;
            shadowEnabled: boolean;
            shadowBlur: number;
            shadowOffsetX: number;
            shadowOffsetY: number;
            shadowColor: string;
            custom: any;
            selectable: boolean;
            alwaysOnTop: boolean;
            showInExport: boolean;
        } & import("mobx-state-tree/dist/internal").NonEmptyObject & {
            readonly page: any;
            readonly store: any;
        } & {
            toJSON(): {};
        } & any & import("mobx-state-tree").IStateTreeNode<import("mobx-state-tree").IModelType<{
            id: import("mobx-state-tree").ISimpleType<string>;
            type: import("mobx-state-tree").IType<string | undefined, string, string>;
            x: import("mobx-state-tree").IType<number | undefined, number, number>;
            y: import("mobx-state-tree").IType<number | undefined, number, number>;
            rotation: import("mobx-state-tree").IType<number | undefined, number, number>;
            opacity: import("mobx-state-tree").IType<number | undefined, number, number>;
            locked: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
            blurEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
            blurRadius: import("mobx-state-tree").IType<number | undefined, number, number>;
            brightnessEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
            brightness: import("mobx-state-tree").IType<number | undefined, number, number>;
            sepiaEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
            grayscaleEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
            shadowEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
            shadowBlur: import("mobx-state-tree").IType<number | undefined, number, number>;
            shadowOffsetX: import("mobx-state-tree").IType<number | undefined, number, number>;
            shadowOffsetY: import("mobx-state-tree").IType<number | undefined, number, number>;
            shadowColor: import("mobx-state-tree").IType<string | undefined, string, string>;
            custom: import("mobx-state-tree").IType<any, any, any>;
            selectable: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
            alwaysOnTop: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
            showInExport: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
        }, {
            readonly page: any;
            readonly store: any;
        } & {
            toJSON(): {};
        } & any, import("mobx-state-tree").ModelCreationType<import("mobx-state-tree/dist/internal").ExtractCFromProps<{
            id: import("mobx-state-tree").ISimpleType<string>;
            type: import("mobx-state-tree").IType<string | undefined, string, string>;
            x: import("mobx-state-tree").IType<number | undefined, number, number>;
            y: import("mobx-state-tree").IType<number | undefined, number, number>;
            rotation: import("mobx-state-tree").IType<number | undefined, number, number>;
            opacity: import("mobx-state-tree").IType<number | undefined, number, number>;
            locked: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
            blurEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
            blurRadius: import("mobx-state-tree").IType<number | undefined, number, number>;
            brightnessEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
            brightness: import("mobx-state-tree").IType<number | undefined, number, number>;
            sepiaEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
            grayscaleEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
            shadowEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
            shadowBlur: import("mobx-state-tree").IType<number | undefined, number, number>;
            shadowOffsetX: import("mobx-state-tree").IType<number | undefined, number, number>;
            shadowOffsetY: import("mobx-state-tree").IType<number | undefined, number, number>;
            shadowColor: import("mobx-state-tree").IType<string | undefined, string, string>;
            custom: import("mobx-state-tree").IType<any, any, any>;
            selectable: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
            alwaysOnTop: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
            showInExport: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
        }>>, {}>>;
        set(attrs: any): void;
        moveUp(): void;
        moveTop(): void;
        moveDown(): void;
        moveBottom(): void;
        beforeDestroy(): void;
    }, import("mobx-state-tree").ModelCreationType<import("mobx-state-tree/dist/internal").ExtractCFromProps<{
        id: import("mobx-state-tree").ISimpleType<string>;
        type: import("mobx-state-tree").IType<string | undefined, string, string>;
        x: import("mobx-state-tree").IType<number | undefined, number, number>;
        y: import("mobx-state-tree").IType<number | undefined, number, number>;
        rotation: import("mobx-state-tree").IType<number | undefined, number, number>;
        opacity: import("mobx-state-tree").IType<number | undefined, number, number>;
        locked: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
        blurEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
        blurRadius: import("mobx-state-tree").IType<number | undefined, number, number>;
        brightnessEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
        brightness: import("mobx-state-tree").IType<number | undefined, number, number>;
        sepiaEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
        grayscaleEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
        shadowEnabled: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
        shadowBlur: import("mobx-state-tree").IType<number | undefined, number, number>;
        shadowOffsetX: import("mobx-state-tree").IType<number | undefined, number, number>;
        shadowOffsetY: import("mobx-state-tree").IType<number | undefined, number, number>;
        shadowColor: import("mobx-state-tree").IType<string | undefined, string, string>;
        custom: import("mobx-state-tree").IType<any, any, any>;
        selectable: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
        alwaysOnTop: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
        showInExport: import("mobx-state-tree").IType<boolean | undefined, boolean, boolean>;
    }>>, {}>>)[];
    readonly activePage: ({
        id: string;
        children: import("mobx-state-tree").IMSTArray<import("mobx-state-tree").IAnyType> & import("mobx-state-tree").IStateTreeNode<import("mobx-state-tree").IArrayType<import("mobx-state-tree").IAnyType>>;
        background: string;
        custom: any;
    } & import("mobx-state-tree/dist/internal").NonEmptyObject & {
        readonly store: any;
    } & {
        toJSON(): any;
        clone(attrs?: any): any;
        setZIndex(zIndex: any): void;
        set(attrs: any): void;
        select(): void;
        addElement(attrs: any): any;
        moveElementUp(id: any): void;
        moveElementDown(id: any): void;
        moveElementTop(id: any): void;
        moveElementBottom(id: any): void;
    } & import("mobx-state-tree").IStateTreeNode<import("mobx-state-tree").IModelType<{
        id: import("mobx-state-tree").ISimpleType<string>;
        children: import("mobx-state-tree").IArrayType<import("mobx-state-tree").IAnyType>;
        background: import("mobx-state-tree").IType<string | undefined, string, string>;
        custom: import("mobx-state-tree").IType<any, any, any>;
    }, {
        readonly store: any;
    } & {
        toJSON(): any;
        clone(attrs?: any): any;
        setZIndex(zIndex: any): void;
        set(attrs: any): void;
        select(): void;
        addElement(attrs: any): any;
        moveElementUp(id: any): void;
        moveElementDown(id: any): void;
        moveElementTop(id: any): void;
        moveElementBottom(id: any): void;
    }, import("mobx-state-tree")._NotCustomized, import("mobx-state-tree")._NotCustomized>>) | null;
} & {
    __checkKey(key: string, showCredit: boolean): Promise<void>;
    __(isPaid: any, showCredit: any): void;
    setRole(role: string): void;
    getElementById(id: string): ElementType | undefined;
    addPage(attrs?: any): {
        id: string;
        children: import("mobx-state-tree").IMSTArray<import("mobx-state-tree").IAnyType> & import("mobx-state-tree").IStateTreeNode<import("mobx-state-tree").IArrayType<import("mobx-state-tree").IAnyType>>;
        background: string;
        custom: any;
    } & import("mobx-state-tree/dist/internal").NonEmptyObject & {
        readonly store: any;
    } & {
        toJSON(): any;
        clone(attrs?: any): any;
        setZIndex(zIndex: any): void;
        set(attrs: any): void;
        select(): void;
        addElement(attrs: any): any;
        moveElementUp(id: any): void;
        moveElementDown(id: any): void;
        moveElementTop(id: any): void;
        moveElementBottom(id: any): void;
    } & import("mobx-state-tree").IStateTreeNode<import("mobx-state-tree").IModelType<{
        id: import("mobx-state-tree").ISimpleType<string>;
        children: import("mobx-state-tree").IArrayType<import("mobx-state-tree").IAnyType>;
        background: import("mobx-state-tree").IType<string | undefined, string, string>;
        custom: import("mobx-state-tree").IType<any, any, any>;
    }, {
        readonly store: any;
    } & {
        toJSON(): any;
        clone(attrs?: any): any;
        setZIndex(zIndex: any): void;
        set(attrs: any): void;
        select(): void;
        addElement(attrs: any): any;
        moveElementUp(id: any): void;
        moveElementDown(id: any): void;
        moveElementTop(id: any): void;
        moveElementBottom(id: any): void;
    }, import("mobx-state-tree")._NotCustomized, import("mobx-state-tree")._NotCustomized>>;
    selectPage(id: any): void;
    selectElements(ids: Array<string>): void;
    openSidePanel(panelName: string): void;
    setScale(scale: number): void;
    _setScaleToFit(scale: number): void;
    setElementsPixelRatio(ratio: number): void;

    setSize(width: number, height: number, doMagic?: boolean | undefined): void;
    setPageZIndex(id: any, zIndex: any): void;
    deletePages(ids: Array<string>): void;
    deleteElements(ids: Array<string>): void;
    on(event: any, callback: any): import("mobx-state-tree").IDisposer | undefined;
    toDataURL({ pixelRatio, ignoreBackground, pageId, mimeType, }?: ExportOptions): string;
    saveAsImage({ fileName, ...exportProps }?: ExportOptions & {
        fileName?: string | undefined;
    }): void;
    _toPDF(exportProps: any): Promise<any>;
    toPDFDataURL(exportProps: any): Promise<any>;
    saveAsPDF({ fileName, dpi, ...exportProps }?: ExportOptions & {
        fileName?: string | undefined;
        dpi?: number | undefined;
    }): Promise<void>;
    waitLoading(): Promise<void>;
    toJSON(): {
        width: number;
        height: number;
        fonts: import("mobx-state-tree").ModelSnapshotType<{
            fontFamily: import("mobx-state-tree").ISimpleType<string>;
            url: import("mobx-state-tree").IOptionalIType<import("mobx-state-tree").ISimpleType<string>, [undefined]>;
            styles: import("mobx-state-tree").IType<any, any, any>;
        }>[];
        pages: import("mobx-state-tree").ModelSnapshotType<{
            id: import("mobx-state-tree").ISimpleType<string>;
            children: import("mobx-state-tree").IArrayType<import("mobx-state-tree").IAnyType>;
            background: import("mobx-state-tree").IType<string | undefined, string, string>;
            custom: import("mobx-state-tree").IType<any, any, any>;
        }>[];
    };
    loadJSON(json: any, keepHistory?: boolean): void;
    addFont(font: {
        fontFamily: string;
        url: string;
    }): void;
    removeFont(fontFamily: string): void;
    loadFont(fontFamily: any): Promise<void>;
}, import("mobx-state-tree")._NotCustomized, import("mobx-state-tree")._NotCustomized>;
export declare type StoreType = Instance<typeof Store>;
interface StoreProps {
    key: string;
    showCredit: boolean;
}
export declare function createStore({ key, showCredit }?: StoreProps): StoreType;
export default createStore;
