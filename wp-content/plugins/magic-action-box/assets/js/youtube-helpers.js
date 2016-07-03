function mab_get_youtube_id(url){
    var gkey = 'v';

    var returned = null;

    if (url.indexOf("?") != -1){

      var list = url.split("?")[1].split("&"),
              gets = [];

      for (var ind in list){
        var kv = list[ind].split("=");
        if (kv.length>0)
            gets[kv[0]] = kv[1];
    }

    var returned = gets;

    if (typeof gkey != "undefined")
        if (typeof gets[gkey] != "undefined")
            returned = gets[gkey];

    }

    return returned;
};


function mab_create_youtube_embed_code( youtube_id, width, height ){
    var $code = '<iframe width="[width]" height="[height]" src="http://www.youtube.com/embed/[id]?wmode=opaque" frameborder="0" allowfullscreen ></iframe>';
    var $embed = '';

    var $replacements = {
        width : width,
        height : height,
        id : youtube_id
    }

    $embed = $code.replace(/\[(\w+)\]/g, function(s, key) {
       return $replacements[key] || s;
    });

    return $embed;
}