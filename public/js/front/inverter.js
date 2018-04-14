
var opts = {
    angle: -0.1, // The span of the gauge arc
    lineWidth: 0.23, // The line thickness
    radiusScale: 0.99, // Relative radius
    pointer: {
        length: 0.29, // // Relative to gauge radius
        strokeWidth: 0.097, // The thickness
        color: '#ffff' // Fill color
    },
    limitMax: false,     // If false, max value increases automatically if value > maxValue
    limitMin: false,     // If true, the min value of the gauge will be fixed
    colorStart: '#ffff',   // Colors
    colorStop: '#ffff',    // just experiment with them
    strokeColor: '#2E2E2E',  // to see which ones work best for you
    generateGradient: true,
    highDpiSupport: true,     // High resolution support

};
var target = document.getElementById('Battery-Voltage'); // your canvas element
var gauge = new Gauge(target).setOptions(opts); // create sexy gauge!
gauge.maxValue = 3000; // set max gauge value
gauge.setMinValue(0);  // Prefer setter over gauge.minValue = 0
gauge.animationSpeed = 49; // set animation speed (32 is default value)
gauge.set(875); // set actual value

var target = document.getElementById('Battery-Charging-Current'); // your canvas element
var gauge = new Gauge(target).setOptions(opts); // create sexy gauge!
gauge.maxValue = 2000; // set max gauge value
gauge.setMinValue(0);  // Prefer setter over gauge.minValue = 0
gauge.animationSpeed = 49; // set animation speed (32 is default value)
gauge.set(875); // set actual value

var target = document.getElementById('Battery-Discharge-Current'); // your canvas element
var gauge = new Gauge(target).setOptions(opts); // create sexy gauge!
gauge.maxValue = 1000; // set max gauge value
gauge.setMinValue(0);  // Prefer setter over gauge.minValue = 0
gauge.animationSpeed = 49; // set animation speed (32 is default value)
gauge.set(875); // set actual value

var target = document.getElementById('Battery-Capacity'); // your canvas element
var gauge = new Gauge(target).setOptions(opts); // create sexy gauge!
gauge.maxValue = 1500; // set max gauge value
gauge.setMinValue(0);  // Prefer setter over gauge.minValue = 0
gauge.animationSpeed = 49; // set animation speed (32 is default value)
gauge.set(875); // set actual value
var opts = {
    angle: 0.15, // The span of the gauge arc
    lineWidth: 0.44, // The line thickness
    radiusScale: 1, // Relative radius
    pointer: {
        length: 0.54, // // Relative to gauge radius
        strokeWidth: 0.024, // The thickness
        color: '#000000' // Fill color
    },
    limitMax: false,     // If false, max value increases automatically if value > maxValue
    limitMin: false,     // If true, the min value of the gauge will be fixed
    colorStart: '#040305',   // Colors
    colorStop: '#FFFFFF',    // just experiment with them
    strokeColor: '#2E2E2E',  // to see which ones work best for you
    generateGradient: true,
    highDpiSupport: true,     // High resolution support

};
var target = document.getElementById('chart-AC'); // your canvas element
var gauge = new Gauge(target).setOptions(opts); // create sexy gauge!
gauge.maxValue = 3000; // set max gauge value
gauge.setMinValue(0);  // Prefer setter over gauge.minValue = 0
gauge.animationSpeed = 32; // set animation speed (32 is default value)
gauge.set(1250); // set actual value

var target = document.getElementById('chartaof'); // your canvas element
var gauge = new Gauge(target).setOptions(opts); // create sexy gauge!
gauge.maxValue = 3000; // set max gauge value
gauge.setMinValue(0);  // Prefer setter over gauge.minValue = 0
gauge.animationSpeed = 32; // set animation speed (32 is default value)
gauge.set(1250); // set actual value

var target = document.getElementById('chartaopp'); // your canvas element
var gauge = new Gauge(target).setOptions(opts); // create sexy gauge!
gauge.maxValue = 3000; // set max gauge value
gauge.setMinValue(0);  // Prefer setter over gauge.minValue = 0
gauge.animationSpeed = 32; // set animation speed (32 is default value)
gauge.set(1250); // set actual value

var target = document.getElementById('chartaoap'); // your canvas element
var gauge = new Gauge(target).setOptions(opts); // create sexy gauge!
gauge.maxValue = 3000; // set max gauge value
gauge.setMinValue(0);  // Prefer setter over gauge.minValue = 0
gauge.animationSpeed = 32; // set animation speed (32 is default value)
gauge.set(1250); // set actual value
