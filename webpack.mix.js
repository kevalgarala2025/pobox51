const mix = require('laravel-mix');



//DEFINE RESOURCE ADMIN COMMON FOLDER PATH VARIABLES
var admin_resource_js_folder = "resources/js/";
var admin_resource_lib_folder = "resources/libs/";
var admin_resource_css_folder = "resources/css/";


//DEFINE RESOURCE USER COMMON FOLDER PATH VARIABLES
var user_resource_js_folder = "resources/js/frontend/";
var user_resource_css_folder = "resources/css/frontend/";
var user_resource_lib_folder = "resources/libs/frontend/";


//DEFINE PUBLIC ADMIN COMMON FOLDER PATH VARIABLES
var admin_public_js_folder = "public/assets/js/";
var admin_public_css_folder = "public/assets/css/";


//DEFINE PUBLIC USER COMMON FOLDER PATH VARIABLES
var user_public_js_folder = "public/assets/js/frontend/";
var user_public_css_folder = "public/assets/css/frontend/";


/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */
mix
    // CUSTOM JS
    .combine([admin_resource_js_folder+'app.min.js',
            admin_resource_js_folder+'custom.js'], admin_public_js_folder+'custom.js')
    // LIBRARY JS
    .combine([admin_resource_js_folder+'sweetalert.min.js',
        admin_resource_js_folder+'sweetalert2@11.js',], admin_public_js_folder+'libraries.js')

    // THEME LIBRARY JS
    .combine([admin_resource_lib_folder+'jquery/jquery.min.js',
        admin_resource_lib_folder+'jquery/jquery-migrate-3.0.0.min.js',
        admin_resource_lib_folder+'jquery/jquery-ui.js',
        admin_resource_lib_folder+'bootstrap/bootstrap.min.js',
        admin_resource_lib_folder+'metismenu/metismenu.min.js',
        admin_resource_lib_folder+'simplebar/simplebar.min.js',
        admin_resource_lib_folder+'node-waves/node-waves.min.js',
        admin_resource_lib_folder+'toastr/toastr.min.js',
        admin_resource_lib_folder+'apexcharts/apexcharts.min.js',
        //admin_resource_js_folder+'pages/dashboard.init.js',
        admin_resource_js_folder+'pages/toastr.init.js'], admin_public_js_folder+'theme_libraries.js')



    // FORM LIBRARY JS
    .combine([admin_resource_lib_folder+'select2/select2.min.js',
        admin_resource_lib_folder+'bootstrap-datepicker/bootstrap-datepicker.min.js',
        admin_resource_lib_folder+'bootstrap-colorpicker/bootstrap-colorpicker.min.js',
        admin_resource_lib_folder+'bootstrap-touchspin/bootstrap-touchspin.min.js',
        admin_resource_lib_folder+'bootstrap-maxlength/bootstrap-maxlength.min.js',
        admin_resource_js_folder+'pages/form-advanced.init.js',
        admin_resource_lib_folder+'parsleyjs/parsleyjs.min.js'], admin_public_js_folder+'form_libraries.js')

    // PULGIN JS
    .combine([admin_resource_js_folder+'pages/form-validation.init.js',
        admin_resource_lib_folder+'tinymce/tinymce.min.js',
        admin_resource_lib_folder+'summernote/summernote.min.js',
        admin_resource_js_folder+'pages/form-editor.init.js'], admin_public_js_folder+'plugins.js')

    // DATATABLE JS
    .combine([admin_resource_lib_folder+'datatables/datatables.min.js',
        admin_resource_lib_folder+'jszip/jszip.min.js',
        admin_resource_lib_folder+'pdfmake/pdfmake.min.js',
        admin_resource_js_folder+'pages/datatables.init.js'], admin_public_js_folder+'datatable.js')

    // RESPONSIVE TABLE JS
    .combine([admin_resource_lib_folder+'rwd-table/rwd-table.min.js',
        admin_resource_js_folder+'pages/table-responsive.init.js'], admin_public_js_folder+'responsive_table.js')


    //USER LIBRARY JS
    .combine([
        user_resource_lib_folder+'bootstrp/jquery-3.5.1.slim.min.js',
        user_resource_lib_folder+'bootstrp/bootstrap.min.js',
        user_resource_js_folder+'jquery-1.12.4.min.js',
        user_resource_lib_folder+'font_awesome/all.min.js',
        user_resource_lib_folder+'jqueryscripttop/jquery.easing.min.js',
        user_resource_js_folder+'iziToast.min.js',
        user_resource_js_folder+'jquery.countdown.min.js',
        user_resource_js_folder+'swipe-btn/jquery.slideToUnlock.js'
    ], user_public_js_folder+'libraries.js')


    //USER CUSTOM JS (FOR HTML)
    .combine(user_resource_js_folder+'script.js', user_public_js_folder+'script.js')

    //USER CUSTOM JS (FOR BACKEND)
    .combine(user_resource_js_folder+'custom.js', user_public_js_folder+'custom.js')


    // CUSTOM CSS
    .postCss(admin_resource_css_folder+'app.min.css', admin_public_css_folder+'custom.css')
    .postCss(admin_resource_css_folder+'custom.css', admin_public_css_folder+'custom.css')

    // LIBRARY CSS
    .combine([admin_resource_css_folder+'bootstrap-dark.min.css',
        admin_resource_css_folder+'bootstrap.min.css',
        admin_resource_css_folder+'icons.min.css',
        admin_resource_css_folder+'jquery-ui.css',
        admin_resource_css_folder+'uniform.default.css'], admin_public_css_folder+'libraries.css')

    // THEME LIBRARY CSS
    .combine(admin_resource_lib_folder+'toastr/toastr.min.css', admin_public_css_folder+'theme_libraries.css')
    .combine(admin_resource_lib_folder+'datatables/datatables.min.css', admin_public_css_folder+'datatable.css')
    .combine(admin_resource_lib_folder+'/rwd-table/rwd-table.min.css', admin_public_css_folder+'responsive_table.css')


    // FORM LIBRARY CSS
    .combine([admin_resource_lib_folder+'select2/select2.min.css',
        admin_resource_lib_folder+'bootstrap-datepicker/bootstrap-datepicker.min.css',
        admin_resource_lib_folder+'bootstrap-colorpicker/bootstrap-colorpicker.min.css',
        admin_resource_lib_folder+'bootstrap-touchspin/bootstrap-touchspin.min.css',
        admin_resource_lib_folder+'summernote/summernote.min.css'], admin_public_css_folder+'form_libraries.css')


    //USER LIBRARY CSS
    .combine([user_resource_lib_folder+'bootstrp/bootstrap.min.css',
        user_resource_lib_folder+'font_awesome/all.min.css',
        user_resource_lib_folder+'jqueryscripttop/jqueryscripttop.css',
        user_resource_css_folder+'swipe-btn/slideToUnlock.css',
        user_resource_css_folder+'swipe-btn/iphone.theme.css',
        user_resource_css_folder+'iziToast.css',
    ], user_public_css_folder+'libraries.css')

    //USER CUSTOM CSS
    .postCss(user_resource_css_folder+'responsive.css',user_public_css_folder+'responsive.css')

     //USER CUSTOM CSS
    .postCss(user_resource_css_folder+'style.css',user_public_css_folder+'style.css')

    .sourceMaps()
    .options({
        processCssUrls: false
    })
    .version()
    .browserSync(process.env.MIX_ASSET_URL);

