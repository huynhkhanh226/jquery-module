<style>
    /* header text color */
    .skin-blue .main-header .logo, .skin-blue .main-header .navbar .sidebar-toggle {
        color: {{ Config::get('display.header_color', '#FFFFFF') }} !important;
    }
    /* text color header item hover */
    .skin-blue .main-header .logo:hover {
        color: {{ Config::get('display.header_color_h', '#FFFFFF') }} !important;
    }
    /* background header color */
    .skin-blue .main-header .navbar, .sidebar-toggle{
        background-color: {{ Config::get('display.header_bgcolor', '#3C8DBC') }} !important;
    }
    /* background header item hover */
    .main-header .dropdown:hover {
        background-color: {{ Config::get('display.header_bgcolor_h', '#2C3B41') }} !important;
    }
    /* sidebar text color (parent) */
    .skin-blue .sidebar a {
        color: {{ Config::get('display.sidebar_fcolor', '#B8C7CE') }} !important;
    }
    /* sidebar text color when hover (parent) */
    .skin-blue .sidebar-menu > li:hover > a, .skin-blue .sidebar-menu > li.active > a {
        color: {{ Config::get('display.sidebar_fcolor_h', '#FFFFFF') }} !important;
        background-color: {{ Config::get('display.sidebar_fbgcolor_h', '#1E282C') }} !important;
    }
    /* sidebar background color (parent) */
    .skin-blue .wrapper, .skin-blue .main-sidebar, .skin-blue .left-side {
        background-color: {{ Config::get('display.sidebar_fbgcolor', '#222D32') }} !important;
    }
    /* sidebar text color (child) */
    .skin-blue .treeview-menu > li > a {
        color: {{ Config::get('display.sidebar_lcolor', '#8AA4AF') }} !important;
    }
    /* sidebar text color when hover (child) */
    .skin-blue .treeview-menu > li.active > a, .skin-blue .treeview-menu > li:hover > a {
        color: {{ Config::get('display.sidebar_lcolor_h', '#FFFFFF') }} !important;
    }
    /* sidebar background color (child) */
    .skin-blue .sidebar-menu > li > .treeview-menu {
        background-color: {{ Config::get('display.sidebar_lbgcolor', '#2C3B41') }} !important;
    }
    /* sidebar background color when hover (child) */
    .sidebar-menu .treeview-menu > li:hover {
        background-color: {{ Config::get('display.sidebar_lbgcolor_h', '') }} !important;
    }

    /* Modal header color */
    .modal-header {
        background-color: {{ Config::get('display.header_bgcolor', '#3C8DBC') }} !important;
    }
    /* Color icon menu sidebar */
    .sidebar-menu > li > a > .fa,
    .sidebar-menu > li > a > .glyphicon,
    .sidebar-menu > li > a > .digi,
    .sidebar-menu > li > a > .ion {
        color: {{ Config::get('display.sidebar_iconcolor', '') }} !important;
    }
    .skin-blue .sidebar-menu > li:hover > a > i,
    .skin-blue .sidebar-menu > li.active > a > i {
        color: {{ Config::get('display.sidebar_iconcolor_h', '') }} !important;
    }

    .sidebar-menu .treeview-menu li i {
        color: {{ Config::get('display.sidebar_iconcolorchild', '') }} !important;
    }
    .sidebar-menu .treeview-menu > li:hover i {
        color: {{ Config::get('display.sidebar_iconcolorchild_h', '') }} !important;
    }
</style>