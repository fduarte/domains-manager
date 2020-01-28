// elixir(function(mix) {
//     mix.sass('app.scss');
// });

var elixir = require('laravel-elixir');
// require('laravel-elixir-vue-2'); // recommended for vue 2

elixir(function(mix) {
    // Mixes
    mix.sass('app.scss');
    mix.webpack('app.js');
});