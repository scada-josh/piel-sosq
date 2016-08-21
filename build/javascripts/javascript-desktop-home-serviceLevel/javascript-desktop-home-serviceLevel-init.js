(function ($) {
    "use strict";
 
    ///////////////////////////////////////////////////// Your
    // var venueAddress = "Grand Place, 1000, Brussels"; // Venue

    // Common Partials : Global Constant
    var BASE_URL = "/iel-mis/build/src/desktop";

    
    var API_PATH = "../../../api/restful-api";
    var aciveMenu = "Service Level";


    
    /////////////////////////////////////////////////// Adress
 
    var fn = {

        // Launch Functions
        Launch: function () {
            fn.MenuGenerator();
            fn.Apps();
        },
        
        // Menu Generator
        // ConvertToContext
ConvertToContext: function (data) {
	// console.log('ConvertToContext');

var context = {};

// console.log(data);

context = data;


// $.each(data.rows, function(i, val){

//     console.log(i);
//     console.log(val.main_menu_title);
//     // console.log(pageName);

//     // <li class="">
//     //     <a href=""> Dashboard
//     //     <span class="arrow"></span>
//     //     </a>
//     // </li>

//   context = {
//     rows: [ 
//       { firstName: 'Homer', lastName: 'Simpson' },
//       { firstName: 'Peter', lastName: 'Griffin' },
//       { firstName: 'Eric', lastName: 'Cartman' },
//       { firstName: 'Kenny', lastName: 'McCormick' },
//       { firstName: 'Bart', lastName: 'Simpson' }
//     ]
//   };

// });


return context;
            

},
        MenuGenerator: function () {
	// console.log('MenuGenerator');

            var postParams = {
                                "active_menu": aciveMenu,
                                "baseURL" : BASE_URL
                            };

           $.ajax({
            url: API_PATH + '/menuManager/listMenu/',
            type: 'POST',
            contentType: 'application/json',
            dataType: 'json',
            cache: false,
            data: JSON.stringify(postParams),
            //async: false,
            success: function(data) {
                // console.log(data);

                //window.location.href = '../Admin/';
                // var url = '../Login/';
                // $(location).attr('href',url);

                //console.log(window.location.pathname);

                // $("#home-rmr-menuTile").remove();

                var resultMenuTemplate = Handlebars.compile($("#menu-Template").html());
                // var context = {"test1": "none", "test2": "none", "test3": ""};
                var context = fn.ConvertToContext(data);
                // console.log(context);
                // $("#page-header-menu-render").append(resultMenuTemplate(context));
                $("#page-header-menu-render").html(resultMenuTemplate(context));


                // $("#page-header-menu-render").append("<b>HEllo</b>");


            },
            error: function(jqXHR, textStatus, errorThrown){
                    alert('init error: ' + textStatus);

                    // var url = '../../Login/';
                    // $(location).attr('href',url);
                    fn.Logout();
                }
            });
    
},
        // Logout
        Logout: function () {
	// console.log('Logout');

     $.ajax({
      	url: '../../../api/restful-api/permissionManager/logout/',
      	type: 'POST',
      	contentType: 'application/json',
      	dataType: 'json',
      	cache: false,
        //async: false,
        success: function(data) {
            //console.log(data);

            //window.location.href = '../Admin/';
            var url = '../../Login/';
            $(location).attr('href',url);

            //console.log(window.location.pathname);

        },
        error: function(jqXHR, textStatus, errorThrown){
        	alert('init error: ' + textStatus);
        }
    });
    
},

        // Common Partials
        GetAbsolutePath: function () {
	// console.log('GetAbsolutePath');

	console.log("hostname : " + document.location.hostname);
	console.log("host : " + document.location.host);
	console.log("pathname : " + document.location.pathname);
	var newURL = window.location.protocol + "//" + window.location.host + "/" + window.location.pathname;
	console.log("url :" + newURL);


    var loc = window.location;
    var pathName = loc.pathname.substring(0, loc.pathname.lastIndexOf('/') + 1);
    return loc.href.substring(0, loc.href.length - ((loc.pathname + loc.search + loc.hash).length - pathName.length));
    
},
 		// Apps
        // Apps
Apps: function () {
	// console.log('Apps');



    $('#button-logout').bind('click', function(){
    	fn.Logout();
    });


}

    };
 
    $(document).ready(function () {
        fn.Launch();
    });
 
})(jQuery);


