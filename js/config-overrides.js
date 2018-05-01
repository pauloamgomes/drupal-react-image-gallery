/* config-overrides.js */

module.exports = function override(config, env) {

  // Use external version of React
  config.externals = {
    "react": "React",
    "react-dom": "ReactDOM"
  };

  return config;
}