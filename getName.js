var namelist = [];
var vowels = ['a', 'e', 'i', 'o', 'u'];
var approp = ['d', 'g', 'c', 'm', 'n', 's'];
var suffix = ['on', 'ite', 'ium', 'en'];
var material = ['Non-Metal','Metal','Metal','Gas']
var atomicNum = [];
var symbol = [];
var type = [];
var postdata;
var seed;

$.ajax({
  url: 'https://randomuser.me/api/?nat=FI&results=10',
  dataType: 'json',
  async: false,
  success: function(data){
      for(var i = 0; i < data.results.length; i++){
          namelist[i] = data.results[i].user.name.first
      }
      console.log(data);
      console.log(namelist);
      seed = data.seed;
      var rand =  Math.floor(Math.random() * (6 - 0)) + 0;
      var suffixchoice =  Math.floor(Math.random() * (suffix.length - 0)) + 0;

      for (var j in namelist) {
          if (namelist.hasOwnProperty(j)) {
              var lastchar = namelist[j].charAt(namelist[j].length - 1);
              if($.inArray(lastchar, vowels) != -1){
                namelist[j] += approp[rand];
                rand =  Math.floor(Math.random() * (6 - 0 )) + 0;
              }
              suffixchoice =  Math.floor(Math.random() * (suffix.length - 0)) + 0;
              namelist[j] += suffix[suffixchoice];
              type[j] = material[suffixchoice];
              atomicNum[j] = ((parseInt(j) + 1) + (Math.random(99 * 0)/1)).toFixed(2);
          }
      }
      for (var index in namelist) {
          if (namelist.hasOwnProperty(index)) {
              var oneandtwo;
              oneandtwo = namelist[index].substring(0,2);
              symbol[index] = oneandtwo;
              console.log(symbol[index]);
          }
      }
      $("#content").html(toJson());
      postdata = toJson();
  }
});

$.ajax({
    type: "POST",
    url: "beautify.php",
    data: {'elements': postdata},
    cache: false,
    success: function(response){
        console.log("Successfully posted to PHP");
        $("#content").html(response);
    }
});

$.ajax({
    type: "POST",
    url: "createElementSet.php",
    data: {'names': namelist, 'seed': seed, 'atomic': atomicNum, 'symbols': symbol},
    cache: false,
    success: function(response){
        console.log("Sent to create element set with seed: " + response);
    }

});

function toJson () {
    this.names = namelist
    this.abriviations = symbol;
    this.atomic = atomicNum

    var jsonString = '{ "elements":[ ';

    for (var index in names) {
        if (names.hasOwnProperty(index)) {
            if(index == names.length-1){
                jsonString += '{"name":"' + names[index] + '", "abriviation":"' + abriviations[index] + '", "material":"' + type[index] + '", "atomic number":"' + atomic[index] + '"}';
            }else{
                jsonString += '{"name":"' + names[index] + '", "abriviation":"' + abriviations[index] + '", "material":"' + type[index] + '", "atomic number":"' + atomic[index] + '"}, ';
            }
        }
    }

    jsonString += ']}';

    return jsonString;

}
