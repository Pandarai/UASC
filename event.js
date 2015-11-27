$('#content').on('click','.element', function(){
    focusOnElement(this);
});

//Pass an element html object to focus on
function focusOnElement (elementHTML) {
    var element = elementHTML;
    var name = $(element).attr('name');
    window.alert(name);
}
