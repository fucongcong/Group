var fs = require( 'fs' ),
    gulp = require( 'gulp' ),
    should = require( 'should' ),
    gutil = require( 'gulp-util' ),
    assert = require( 'stream-assert' ),
    handlebars = require( 'gulp-handlebars' ),
    wrap = require( 'gulp-wrap' ),
    seajsCombo = require( '../index' );

describe( 'gulp-seajs-combo', function(){
    describe( 'seajsCombo()', function(){
        // 测试忽略空文件
        it( 'should ignore null file', function( done ){
            gulp.src( 'hello.js' )
                .pipe( seajsCombo() )
                .pipe( assert.length(0) )
                .pipe( assert.end(done) );
        });

        // 测试普通的模块
        it( 'should combo module a & b, no seajs.use', function( done ){
            fs.readFile( 'build/a.js', function( err, buildData ){
                if( err ){
                    throw err;
                }

                gulp.src( 'src/a.js' )
                    .pipe( seajsCombo() )
                    .pipe( assert.first(function( srcData ){
                        srcData.contents.should.eql( buildData );
                    }))
                    .pipe( assert.end(done));
            });
        });

        // 测试普通的模块
        it( 'should combo module s & duplicate/s, module id is duplicate', function( done ){
            fs.readFile( 'build/r.js', function( err, buildData ){
                if( err ){
                    throw err;
                }

                gulp.src( 'src/r.js' )
                    .pipe( seajsCombo() )
                    .pipe( assert.first(function( srcData ){
                        srcData.contents.should.eql( buildData );
                    }))
                    .pipe( assert.end(done));
            });
        });

        // 测试有seajs.use的情况
        it( 'should combo module f, have seajs.use', function( done ){
            fs.readFile( 'build/f.js', function( err, buildData ){
                if( err ){
                    throw err;
                }

                gulp.src( 'src/f.js' )
                    .pipe( seajsCombo({
                        map : {
                            'src/g' : './g',
                            'src/h' : './h'
                        }
                    }))
                    .pipe( assert.first(function( srcData ){
                        srcData.contents.should.eql( buildData );
                    }))
                    .pipe( assert.end(done));
            });
        });
    });

    describe( 'options', function(){
        // 测试options.ignore
        it( 'should ignore module e', function( done ){
            fs.readFile( 'build/c.js', function( err, buildData ){
                if( err ){
                    throw err;
                }

                gulp.src( 'src/c.js' )
                    .pipe( seajsCombo({
                        ignore : ['./e']
                    }))
                    .pipe( assert.first(function( srcData ){
                        srcData.contents.should.eql( buildData );
                    }))
                    .pipe( assert.end(done) );
            });
        });

        // 测试options.map
        it( 'should use map', function( done ){
            fs.readFile( 'build/f2.js', function( err, buildData ){
                if( err ){
                    throw err;
                }

            gulp.src( 'src/f2.js' )
                .pipe( seajsCombo({
                    map : {
                        'src/g' : './g',
                        'src/h' : './h'
                    }
                }))
                .pipe( assert.first(function( srcData ){
                    srcData.contents.should.eql( buildData );
                }))
                .pipe( assert.end(done) );
            });
        });

        // 测试options.plugins
        it( 'should use plugins for handlebars tpl', function( done ){
            fs.readFile( 'build/q.js', function( err, buildData ){
                if( err ){
                    throw err;
                }

                gulp.src( 'src/q.js' )
                    .pipe( seajsCombo({
                        plugins : [{
                            ext : [ '.tpl' ],
                            use : [{
                                    plugin : handlebars,
                                },{
                                    plugin : wrap,
                                    param : ['define(function(){return Handlebars.template(<%= contents %>)});']
                            }]
                        }]
                    }))
                    .pipe( assert.first(function( srcData ){
                        srcData.contents.should.eql( buildData );
                    }))
                    .pipe( assert.end(done) );
            });
        });
    });

    describe( 'seajs.config', function(){
        // 测试解析seajs.config中的配置
        it( 'should parse alias & paths & vars in seajs.config', function( done ){
            fs.readFile( 'build/m.js', function( err, buildData ){
                if( err ){
                    throw err;
                }

                gulp.src( 'src/m.js' )
                    .pipe( seajsCombo() )
                    .pipe( assert.first(function( srcData ){
                        srcData.contents.should.eql( buildData );
                    }))
                    .pipe( assert.end(done) );
            });
        });

        // 测试解析seajs.config中的配置
        it( 'should parse map & module have modId', function( done ){
            fs.readFile( 'build/k.js', function( err, buildData ){
                if( err ){
                    throw err;
                }

                gulp.src( 'src/k.js' )
                    .pipe( seajsCombo({
                        map : {
                            'src/l' : './l'
                        }
                    }))
                    .pipe( assert.first(function( srcData ){
                        srcData.contents.should.eql( buildData );
                    }))
                    .pipe( assert.end(done) );
            });
        });
    });
});
