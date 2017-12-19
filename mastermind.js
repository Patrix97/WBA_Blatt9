
var colorArray;

/**
 * checkArray defines a 2D-Array which stores the informations about the correct color & the correct position
 *  Color 1     Color 2     Color 3     Color 4
 *  [color]     [color]     [color]     [color]
 * [position]  [position]  [position]  [position]
 */
var checkArray = new Array(4);
for(var i = 0; i < checkArray.length; i++){
    checkArray[i] = new Array(1);
}
var colorEnum = {
    RED: 1,
    GREEN: 2,
    BLUE: 3,
    YELLOW: 4
};

/**
 * init is called when the body of the html-document is loaded.
 * generates an colorArray.
 */
document.onload = function(){
    generateColorArray();

    for(var i = 0; i < colorArray.length; i++){
        console.log(colorArray[i]);
    }

    $("#newColor").click(function(){
        generateColorArray();
    });
    
    $("#c1").change(function(){
        for(var i = 0; i < 4; i++){
            if(i = 0){
                if(colorArray[i] == colorEnum.RED){
                    checkArray[i][0] = true;
                    checkArray[i][1] = true;
                }
            }else if(colorArray[i] == colorEnum.R)
        }
    });
}

var generateColorArray = function(){
    var max = 4;
    var min = 1;
    for(var i = 0; i < 4; i++){
        var rnd = (Math.random() * (max-min)) + min; // Eine Zahl zwischen 1 und 4 auswählen
        colorAray.push(rnd);
    }
}

