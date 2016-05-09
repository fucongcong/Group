seajs-combo
============

A Sea.js plugin for concatenating HTTP requests


Install
-------

Install with spm:

    $ spm install seajs/seajs-combo


Usage
-----

```html
<script src="path/to/sea.js"></script>
<script src="path/to/seajs-combo.js"></script>

<script>
// The requests of a.js and b.js are combined to `http://test.com/path/to/??a.js,b.js`
seajs.use(['a', 'b'], function(a, b) {
    // ...
})
</script>
```

For more details please visit [中文文档](https://github.com/seajs/seajs-combo/issues/3)
