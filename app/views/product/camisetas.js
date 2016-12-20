var $fpd=$('#fpd'),
pluginOpts = {
    stageHeight: '700',
    width:'700',
    copyable:false,
    elementParameters:{
        draggable:false,
        removable:false,
        resizable:false,
        rotatable:false,
        copyable:false,
        boundingBox: "Bounding",
        boundingBoxMode: "clipping",
    },
    actions:  {
        'right': ['zoom'],
    },
    mainBarModules: [''],
    langJSON: '/vendor/fancy_product_designer/source/lang/es.json',
    templatesDirectory: '/vendor/fancy_product_designer/source/html/'
},
fpd = new FancyProductDesigner($fpd, pluginOpts);
