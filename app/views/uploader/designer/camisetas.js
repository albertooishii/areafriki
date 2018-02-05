var $fpdCamisetas=$('#fpd-camisetas'),
    pluginOpts = {
    //editorMode:true,
    stageHeight: 700,
    width:700,
    hideDialogOnAdd:true,
    customImageParameters: {
        autoCenter: true,
        removable: true,
        maxH:10000,
        maxW:10000,
        minH:400,
        minW:230,
        resizeToW:230,
        resizeToH:400,
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
        copyable:false,
    },
    /*guidedTour: {
        "module:images": "Haz click aquí para añadir tu diseño",
        "#design-info": "Rellena aquí la información sobre tu diseño",
        ".product-info": "Selecciona aquí el precio de venta de tu producto",
        ".color_selector": "Aquí podrás seleccionar el color por defecto de la camiseta"
    },*/
    mainBarModules: ['images'],
    langJSON: '/vendor/fancy_product_designer/source/lang/es.json',
    templatesDirectory: '/vendor/fancy_product_designer/source/html/'
},
fpdCamisetas = new FancyProductDesigner($fpdCamisetas, pluginOpts);

$("#camisetas .color_selector").click(function(e){
    e.preventDefault();
    var color=$(this).data("color");
    var target = fpdCamisetas.getElementByTitle("Base");
    fpdCamisetas.currentViewInstance.changeColor(target,color,false,false);
})
