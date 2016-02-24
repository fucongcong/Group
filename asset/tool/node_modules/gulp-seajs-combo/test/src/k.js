seajs.config({
    map : [
        ['name/is/l', 'src/l']
    ]
});

seajs.use( 'src/l', function( l ){
    console.log( l );
});
