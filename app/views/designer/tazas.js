var $fpd=$('#fpd'),
        pluginOpts = {
        //editorMode: true,
        stageHeight: 700,
        width:700,
        hideDialogOnAdd:true,
        customImageParameters: {
            colors: false,
            autoCenter: true,
            removable: true,
            maxH:7000,
            maxW:7000,
            minH:200,
            minW:200,
            resizeToH:371,
            resizeToW:330,
            resizable:true,
            draggable:true,
            opacity:0.9,
            boundingBox: "Bounding",
            boundingBoxMode: "clipping",
            z:1,
        },
        elementParameters:{
            draggable:false,
            removable:false,
            resizable:false,
            rotatable:false,
            opacity:1,
        },
        mainBarModules: ['products','images'],
        langJSON: '/vendor/fancy_product_designer/source/lang/es.json',
        templatesDirectory: '/vendor/fancy_product_designer/source/html/'
    },
    fpd = new FancyProductDesigner($fpd, pluginOpts);

    $(document).ready(function() {
        $("#fpd").bind('elementAdd', function(event, element){
            if(element.hasControls){

                var canvas = document.getElementById("pro");
                var ctx = canvas.getContext("2d");

                var productImg = new Image();
                productImg.src = "https://d2z4fd79oscvvx.cloudfront.net/0018872_inspirational_teacher_mug.jpeg";

                var img = new Image();
                img.onload = start;
                img.src = fpd.getCustomElements()[0]['element']['source'];
//img.src = "http://blog.foreigners.cz/wp-content/uploads/2015/05/Make-new-friends.jpg";

                var pointer = 0;


                function start() {

                    var iw = img.width;
                    console.log(img.width);
                    var ih = img.height;
                    console.log(img.height);

                    var xOffset = 125,
                        yOffset = 122;

                    var a = 122.0;
                    var b = 30.0;

                    var scaleFactor = iw / (2*a);

                    // draw vertical slices
                    for (var X = 0; X < iw; X+=1) {
                      var y = b/a * Math.sqrt(a*a - (X-a)*(X-a)); // ellipsis equation
                      ctx.drawImage(img, X * scaleFactor, 0, 6, ih, X + xOffset, y + yOffset, 1, ih - 605 + y/2);
                    }
                }
            }
        });
    });
