export default {
    buildModules: ['@nuxtjs/google-fonts', '@nuxtjs/fontawesome'],
    googleFonts: {
        families: {
            Pridi: true,

            // Raleway: {
            //     wght: [300],
            //     ital: [1],
            // },
        },
    },

    fontawesome: {
        component: 'fa',
        icons: { solid: true, brands: true },
    },
    /*
     ** Nuxt rendering mode
     ** See https://nuxtjs.org/api/configuration-mode
     */
    mode: 'spa',
    /*
     ** Nuxt target
     ** See https://nuxtjs.org/api/configuration-target
     */
    target: 'static',
    /*
     ** Headers of the page
     ** See https://nuxtjs.org/api/configuration-head
     */
    head: {
        title: process.env.npm_package_name || '',
        meta: [
            { charset: 'utf-8' },
            { name: 'viewport', content: 'width=device-width, initial-scale=1' },
            {
                hid: 'description',
                name: 'description',
                content: process.env.npm_package_description || '',
            },
        ],
        link: [
            // { rel: 'icon', type: 'image/x-icon', href: '/favicon.ico' },
            {
                rel: 'stylesheet',
                // href: 'https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css',
                // href: 'http://localhost/dashboard-goal/assets/bootstrap.min.css',
                href: 'http://192.168.4.3/webapp/dashboard-goals/assets/bootstrap.min.css',
            },
            //กรณี เอาfont online
            {
                //rel: 'stylesheet',
                //href: 'https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,200;1,100;1,200&family=Roboto+Mono:ital,wght@1,200&display=swap" ',
            },
            // font -awesome online
            {
                // rel: 'stylesheet',
                // href: 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css',
            },
        ],
    },
    script: [{
            // src: 'https://code.jquery.com/jquery-3.5.1.slim.min.js',
            //src: 'http://localhost/dashboard-goal/assets/jquery-3.5.1.slim.min.js',
            src: 'http://192.168.4.3/webapp/dashboard-goals/assets/jquery-3.5.1.slim.min.js',
            //type: 'text/javascript',
        },
        {
            // src: 'https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js',
            //src: 'http://localhost/dashboard-goal/assets/popper.min.js',
            src: 'http://192.168.4.3/webapp/dashboard-goals/assets/popper.min.js',
            //type: 'text/javascript',
        },
        {
            // src: 'https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js',
            //src: 'http://localhost/dashboard-goal/assets/bootstrap.min.js',
            src: 'http://192.168.4.3/webapp/dashboard-goals/assets/bootstrap.min.js',
            type: 'text/javascript',
        },
        {
            // src: 'https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js',
            //src: 'http://localhost/dashboard-goal/assets/js/all.js',
            src: 'http://192.168.4.3/webapp/dashboard-goals/assets/js/all.js',
            //type: 'text/javascript',
        },
    ],
    /*
     ** Global CSS
     */
    css: [],
    /*
     ** Plugins to load before mounting the App
     ** https://nuxtjs.org/guide/plugins
     */
    plugins: ['@/plugins/loadingskeleton'],
    /*
     ** Auto import components
     ** See https://nuxtjs.org/api/configuration-components
     */
    components: true,
    /*
     ** Nuxt.js dev-modules
     */

    /*
     ** Nuxt.js modules
     */
    modules: [
        // Doc: https://axios.nuxtjs.org/usage
        '@nuxtjs/axios',
    ],
    /*
     ** Axios module configuration
     ** See https://axios.nuxtjs.org/options
     */
    axios: {
        //home
        //baseURL: 'http://localhost/dashboard-goal/backend/',
        // 4.3
        baseURL: 'http://192.168.4.3/webapp/dashboard-goals/backend/',
        //server 5.1
        // baseURL: 'http://192.168.4.3/webapp/dashboardgoals/backend/',
        //takis
        // baseURL: 'http://61.19.25.207/dsonline/backend/',
    },
    /*
     ** Build configuration
     ** See https://nuxtjs.org/api/configuration-build/
     */
    build: {},
    router: {
        base: '/webapp/dashboard-goals',
    },
}