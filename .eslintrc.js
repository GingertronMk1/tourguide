module.exports = {
    env: {
        node: true,
    },
    extends: [
        "eslint:recommended",
        "plugin:vue/vue3-recommended",
        "plugin:prettier/recommended",
    ],
    globals: {
        route: true,
        Ziggy: true,
    },
    rules: {
        "vue/multi-word-component-names": "off",
    },
};
