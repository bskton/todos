$.ajax({
    type: 'POST',
    url: '/demo/ajax',
    data: { name: 'John', location: 'Boston' }
}).done(function(msg) {
    console.log(msg);  
});
