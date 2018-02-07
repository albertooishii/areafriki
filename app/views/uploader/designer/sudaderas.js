var $fpdSudaderas=$('#fpd-sudaderas'),
    pluginOpts = {
    //editorMode:true,
    stageHeight: '700',
    stageWidth: '700',
    hideDialogOnAdd:true,
    customImageParameters: {
        autoCenter: true,
        removable: true,
        maxH:10000,
        maxW:10000,
        minH:400,
        minW:230,
        resizeToW:225,
        resizeToH:225,
        resizable:true,
        draggable:true,
        boundingBox: "Bounding",
        boundingBoxMode: "clipping",
        copyable:false,
        z:3,
        //uploadZoneScaleMode:"cover",
    },
    elementParameters:{
        draggable:false,
        removable:false,
        resizable:false,
        rotatable:false,
        copyable: false
    },
    mainBarModules: ['products', 'images'],
    langJSON: '/vendor/fancy_product_designer/source/lang/es.json',
    templatesDirectory: '/vendor/fancy_product_designer/source/html/'
},
fpdSudaderas = new FancyProductDesigner($fpdSudaderas, pluginOpts);

$("#sudaderas .color_selector").click(function(e){
    e.preventDefault();
    var color=$(this).data("color");
    var target = fpdSudaderas.getElementByTitle("Base");
    fpdSudaderas.currentViewInstance.changeColor(target,color,false,false);
})
