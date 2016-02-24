define(function( require ){
    var s = require( './s' ),
        s2 = require( './duplicate/s' );

    return s + ', ' + s2 + ' is done';
});
