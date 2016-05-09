
seajs.config({
  base: "./combo/",
  test: true
//  preload: ["../../dist/seajs-combo-debug"]
})

seajs.use("../../dist/seajs-combo-debug", function() {
  seajs.use("init")
});

