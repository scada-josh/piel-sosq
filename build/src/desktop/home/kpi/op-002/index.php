<?php
session_start(); //start session.
?>

<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

    <head>
        <meta charset="utf-8" />
        <title>MIS - KPI - OP002</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="../../../../../stylesheets/stylesheet-desktop-home-kpi-op002.css" rel="stylesheet" type="text/css" />

    <body class="page-container-bg-solid page-md page-header-top-fixed">
                 

        <div class="page-wrapper">
    <div class="page-wrapper-row">
        <div class="page-wrapper-top">

            <!-- BEGIN HEADER -->
            <div class="page-header">

                <!-- BEGIN HEADER TOP -->
                            <!-- BEGIN HEADER TOP -->
            <div class="page-header-top">
                <div class="container-fluid">
                    <!-- BEGIN LOGO -->
                    <div class="page-logo">
                        <a href="../../">

                            <!-- <img src="../assets/layouts/layout3/img/logo-iel-mis-250x35.png" alt="logo" class="logo-default"> -->
                            <img src="../../../../../images/iel-mis/logo-iel-mis-215x35.png" alt="logo" class="logo-default">
                                                                                 
                        </a>
                    </div>
                    <!-- END LOGO -->
                    <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                    <a href="javascript:;" class="menu-toggler"></a>
                    <!-- END RESPONSIVE MENU TOGGLER -->
                    <!-- BEGIN TOP NAVIGATION MENU -->
                    <div class="top-menu">
                        <ul class="nav navbar-nav pull-right">
                            <!-- BEGIN USER LOGIN DROPDOWN -->
                            <li class="dropdown dropdown-user dropdown-dark">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                    <span class="username username-hide-mobile">Hi, Admin &nbsp;</span>

                                    <img alt="" class="" src="../../../../../images/iel-mis/inter-express-logistics.png">
                                    
                                </a>
                            </li>
                            <!-- END USER LOGIN DROPDOWN -->
                            <!-- BEGIN QUICK SIDEBAR TOGGLER -->
                            <li class="dropdown dropdown-extended quick-sidebar-toggler" id="button-logout">
                                <span class="sr-only">Toggle Quick Sidebar</span>
                                <i class="icon-logout"></i>
                            </li>
                            <!-- END QUICK SIDEBAR TOGGLER -->
                        </ul>
                    </div>
                    <!-- END TOP NAVIGATION MENU -->
                </div>
            </div>
            <!-- END HEADER TOP -->

                <!-- BEGIN HEADER MENU -->
                            <!-- BEGIN HEADER MENU -->
            <div class="page-header-menu">
                <div class="container-fluid">

                    <!-- BEGIN MEGA MENU -->
                    <!-- DOC: Apply "hor-menu-light" class after the "hor-menu" class below to have a horizontal menu with white background -->
                    <!-- DOC: Remove data-hover="dropdown" and data-close-others="true" attributes below to disable the dropdown opening on mouse hover -->
                    <div class="hor-menu  ">
                        <ul class="nav navbar-nav" id="page-header-menu-render">
                                
                                

                        </ul>
                    </div>
                    <!-- END MEGA MENU -->
                </div>
            </div>
            <!-- END HEADER MENU -->

            </div>
            <!-- END HEADER -->

        </div>
    </div>

    <div class="page-wrapper-row full-height">
        <div class="page-wrapper-middle">

            <!-- BEGIN CONTAINER -->
            <div class="page-container">
                <!-- BEGIN CONTENT -->
                <div class="page-content-wrapper">
                    <!-- BEGIN CONTENT BODY -->

                    <!-- BEGIN HEADER MENU -->
                                    <!-- BEGIN PAGE HEAD-->
                <div class="page-head">
                    <div class="container-fluid">
                        <!-- BEGIN PAGE TITLE -->
                        <div class="page-title">
                            <h1> KPI
                                <small>Operation Performance</small>
                            </h1>
                        </div>
                        <!-- END PAGE TITLE -->
                    </div>
                </div>
                <!-- END PAGE HEAD-->

                    <!-- BEGIN PAGE CONTENT BODY -->
                    <div class="page-content">
                        <div class="container-fluid">

                            <!-- PAGE BREADCRUMBS -->
                                                    <!-- BEGIN PAGE BREADCRUMBS -->
                        <ul class="page-breadcrumb breadcrumb">
                            <li>
                                <a href="../../">Home</a>
                                <i class="fa fa-circle"></i>
                            </li>
                            <li>
                                <span>KPI</span>
                                <i class="fa fa-circle"></i>
                            </li>
                            <li>
                                <span>Operation Performance</span>
                                <i class="fa fa-circle"></i>
                            </li>
                            <li>
                                <span>OP002 - หัวหน้าสาย</span>
                            </li>
                        </ul>
                        <!-- END PAGE BREADCRUMBS -->

                            <!-- BEGIN PAGE CONTENT INNER -->
                            <div class="page-content-inner">

                                <div class="row">
                                        <div class="col-md-4 ">
                                                                <div class="portlet light bordered">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-filter font-dark"></i>
                                    <span class="caption-subject bold font-dark uppercase"> Filter </span>
                                    <span class="caption-helper">
                                        <span class="hidden-xs" id="filter-type-label"> Daily</span>
                                    </span>
                                </div>
                                <div class="actions">
                                    <div class="btn-group">
                                        <a class="btn btn-sm green dropdown-toggle" href="javascript:;" data-toggle="dropdown"> Advanced filter
                                            <i class="fa fa-angle-down"></i>
                                        </a>
                                        <ul class="dropdown-menu pull-right">
                                            <li>
                                                <a href="javascript:;" id="dropdown_daily_filter_id">
                                                    <i class="fa fa-filter"></i> Daily 
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;" id="dropdown_weekly_filter_id">
                                                    <i class="fa fa-filter"></i> Weekly 
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;" id="dropdown_monthly_filter_id">
                                                    <i class="fa fa-filter"></i> Monthly 
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;" id="dropdown_quater_filter_id">
                                                    <i class="fa fa-filter"></i> Quater 
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;" id="dropdown_half_year_filter_id"> 
                                                    <i class="fa fa-filter"></i> Half Year 
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="portlet-body form">
                                <!-- BEGIN FORM-->
                                <form action="#" class="horizontal-form">
                                    <div class="form-body">
                                        <!--/row-->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>ศูนย์ : </label>
                                                    <select class="form-control" id="center_selected_id"> 
                                                        <option value="#" selected="">เลือกศูนย์</option>
                                                        <option value="3">ศูนย์ภาคกลาง</option>
                                                        <option value="8">DZ</option>
                                                        <option value="11">ศูนย์นครสวรรค์</option>
                                                        <option value="12">ศูนย์แพร่</option>
                                                        <option value="13">ศูนย์พิษณุโลก</option>
                                                        <option value="14">ศูนย์เชียงใหม่</option>
                                                        <option value="15">ศูนย์โคราช</option>
                                                        <option value="16">ศูนย์ขอนแก่น</option>
                                                        <option value="17">ศูนย์อุบลฯ</option>
                                                        <option value="18">ศูนย์ชุมพร</option>
                                                        <option value="19">ศูนย์สุราษฎร์ฯ</option>
                                                        <option value="20">ศูนย์หาดใหญ่</option>
                                                        <option value="21">เบ็ทเทอร์</option>
                                                        <option value="24">รถรับสินค้า</option>
                                                        <option value="25">ยานพาหนะ</option>
                                                        <option value="27">ศูนย์ภูเก็ต</option>
                                                        <option value="29">BC</option>
                                                        <option value="30">รถส่งสินค้า</option>
                                                        <option value="33">ไบโอฟาร์ม</option> 
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Date Range :</label>
                                                    <div id="reportrange" class="btn default">
                                                        <i class="fa fa-calendar"></i> &nbsp;
                                                        <span> </span>
                                                        <b class="fa fa-angle-down"></b>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <hr/>

                                        <div class="row" id="form_layout_year_select_id">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Select year : </label><br/>
                                                    <select class="form-control" id="year_selected_id"> 
                                                        <option value="2010">2010</option>
                                                        <option value="2011">2011</option>
                                                        <option value="2012">2012</option>
                                                        <option value="2013">2013</option>
                                                        <option value="2014">2014</option>
                                                        <option value="2015">2015</option>
                                                        <option value="2016" selected="true">2016</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" id="form_layout_week_select_id">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Weekly : </label>
                                                     <input type="text" id="ionRangeByWeek" name="example_name" value="" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" id="form_layout_month_select_id">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Month : </label>
                                                     <input type="text" id="ionRangeByMonth" name="example_name" value="" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" id="form_layout_quater_id">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Quater : </label>
                                                     <input type="text" id="ionRangeByQuater" name="example_name" value="" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" id="form_layout_halfYear_id">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Half Year : </label>
                                                     <input type="text" id="ionRangeByHalfYear" name="example_name" value="" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-actions">
                                        <button class="btn green bold uppercase btn-block" id="btnFilterInfo">Filter</button>
                                        <div class="search-filter-divider bg-grey-steel"></div>
                                    </div>
                                </form>
                                <!-- END FORM-->
                            </div>
                        </div>
                                        </div>
                                        <div class="col-md-8 " id="infomation-portlet">

                                                                                <div class="portlet light canvas-information" id="canvas-information-daily">
                                        <div class="portlet-title">
                                            <div class="caption font-dark">
                                                <i class="icon-settings font-dark"></i>
                                                <span class="caption-subject bold uppercase">Operation KPI</span>
                                                <span class="caption-helper">
                                                     <span >Daily</span>
                                                    | <span id="site-name-label-daily">-</span>
                                                    | <span class="hidden-xs" id="date-range-selected-label-daily">28/07/2016 - 01/08/2016 </span>
                                                </span>
                                            </div>
                                            <div class="actions">
                                                <a class="btn btn-circle btn-icon-only btn-default fullscreen" data-container="false" data-placement="bottom" href="javascript:;"> </a>
                                            </div>
                                            <div class="tools"> </div>
                                        </div>
                                        <div class="portlet-body" >

                                    
                                            <!-- TAB Average -->
                                                                                <div class="tabbable-custom nav-justified">
                                                <ul class="nav nav-tabs nav-justified">
                                                    <li class="active">
                                                        <a href="#tab_average_epod" data-toggle="tab"> EPOD </a>
                                                    </li>
                                                    <li>
                                                        <a href="#tab_average_nonEpod" data-toggle="tab"> Non-EPOD </a>
                                                    </li>
                                                </ul>
                                                <div class="tab-content">
                                                    <div class="tab-pane active" id="tab_average_epod">
                                                                                                                <div class="row number-stats margin-bottom-30">
                                                            <div class="col-md-6 col-sm-6 col-xs-6">
                                                                <div class="stat-left">
                                                                    <div class="stat-chart">
                                                                        <!-- do not line break "sparkline_bar" div. sparkline chart has an issue when the container div has line break -->
                                                                        <div id="sparkline_bar_averageBox_Epod"></div>
                                                                    </div>
                                                                    <div class="stat-number">
                                                                        <div class="title"> Average Box </div>
                                                                        <div class="number" id="epod-average-box-id"> - </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-sm-6 col-xs-6">
                                                                <div class="stat-right">
                                                                    <div class="stat-chart">
                                                                        <!-- do not line break "sparkline_bar" div. sparkline chart has an issue when the container div has line break -->
                                                                        <div id="sparkline_bar_averageDrop_Epod"></div>
                                                                    </div>
                                                                    <div class="stat-number">
                                                                        <div class="title"> Average Drop </div>
                                                                        <div class="number" id="epod-average-drop-id"> - </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="tab_average_nonEpod">
                                                        <!-- TAB - Average Non EPOD -->
                                                                                                                <div class="row number-stats margin-bottom-30">
                                                            <div class="col-md-6 col-sm-6 col-xs-6">
                                                                <div class="stat-left">
                                                                    <div class="stat-chart">
                                                                        <!-- do not line break "sparkline_bar" div. sparkline chart has an issue when the container div has line break -->
                                                                        <div id="sparkline_bar_averageBox_nonEpod"></div>
                                                                    </div>
                                                                    <div class="stat-number">
                                                                        <div class="title"> Average Box </div>
                                                                        <div class="number" id="non-epod-average-box-id"> - </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-sm-6 col-xs-6">
                                                                <div class="stat-right">
                                                                    <div class="stat-chart">
                                                                        <!-- do not line break "sparkline_bar" div. sparkline chart has an issue when the container div has line break -->
                                                                        <div id="sparkline_bar_averageDrop_nonEpod"></div>
                                                                    </div>
                                                                    <div class="stat-number">
                                                                        <div class="title"> Average Drop </div>
                                                                        <div class="number" id="non-epod-average-drop-id"> - </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <table class="table table-striped table-bordered table-hover" width="100%" id="datatableOperationKPI">
                                            </table>


                                        </div>
                                    </div>
                                    
                                                                                <div class="portlet light canvas-information" id="canvas-information-weekly" style="display:none">
                                        <div class="portlet-title">
                                            <div class="caption font-dark">
                                                <i class="icon-settings font-dark"></i>
                                                <span class="caption-subject bold uppercase">Operation KPI</span>
                                                <span class="caption-helper">
                                                     <span >Weekly</span>
                                                    | <span id="site-name-label-weekly">-</span>
                                                    | <span class="hidden-xs" id="date-range-selected-label-weekly">Week#01/2016 - Week#52/2016 </span>
                                                </span>
                                            </div>
                                            <div class="actions">
                                                <a class="btn btn-circle btn-icon-only btn-default fullscreen" data-container="false" data-placement="bottom" href="javascript:;"> </a>
                                            </div>
                                            <div class="tools"> </div>
                                        </div>
                                        <div class="portlet-body" >

                                    
                                            
                                            <table class="table table-striped table-bordered table-hover" width="100%" id="datatableOperationKPI_Weekly">
                                            </table>


                                        </div>
                                    </div>
                                    
                                                                                <div class="portlet light canvas-information" id="canvas-information-monthly" style="display:none">
                                        <div class="portlet-title">
                                            <div class="caption font-dark">
                                                <i class="icon-settings font-dark"></i>
                                                <span class="caption-subject bold uppercase">Operation KPI</span>
                                                <span class="caption-helper">
                                                     <span >Monthly</span>
                                                    | <span id="site-name-label-monthly">-</span>
                                                    | <span class="hidden-xs" id="date-range-selected-label-monthly">JAN/2016 - DEC/2016 </span>
                                                </span>
                                            </div>
                                            <div class="actions">
                                                <a class="btn btn-circle btn-icon-only btn-default fullscreen" data-container="false" data-placement="bottom" href="javascript:;"> </a>
                                            </div>
                                            <div class="tools"> </div>
                                        </div>
                                        <div class="portlet-body" >

                                    
                                            
                                            <table class="table table-striped table-bordered table-hover" width="100%" id="datatableOperationKPI_Monthly">
                                            </table>


                                        </div>
                                    </div>
                                    
                                                                                <div class="portlet light canvas-information" id="canvas-information-quater" style="display:none">
                                        <div class="portlet-title">
                                            <div class="caption font-dark">
                                                <i class="icon-settings font-dark"></i>
                                                <span class="caption-subject bold uppercase">Operation KPI</span>
                                                <span class="caption-helper">
                                                     <span >Quater</span>
                                                    | <span id="site-name-label-quater">-</span>
                                                    | <span class="hidden-xs" id="date-range-selected-label-quater">Week#01/2016 - Week#52/2016 </span>
                                                </span>
                                            </div>
                                            <div class="actions">
                                                <a class="btn btn-circle btn-icon-only btn-default fullscreen" data-container="false" data-placement="bottom" href="javascript:;"> </a>
                                            </div>
                                            <div class="tools"> </div>
                                        </div>
                                        <div class="portlet-body" >

                                    
                                            
                                            <table class="table table-striped table-bordered table-hover" width="100%" id="datatableOperationKPI_Quater">
                                            </table>


                                        </div>
                                    </div>
                                    
                                                                                <div class="portlet light canvas-information" id="canvas-information-half-year" style="display:none">
                                        <div class="portlet-title">
                                            <div class="caption font-dark">
                                                <i class="icon-settings font-dark"></i>
                                                <span class="caption-subject bold uppercase">Operation KPI</span>
                                                <span class="caption-helper">
                                                     <span >Half-year</span>
                                                    | <span id="site-name-label-half-year">-</span>
                                                    | <span class="hidden-xs" id="date-range-selected-label-half-year">Week#01/2016 - Week#52/2016 </span>
                                                </span>
                                            </div>
                                            <div class="actions">
                                                <a class="btn btn-circle btn-icon-only btn-default fullscreen" data-container="false" data-placement="bottom" href="javascript:;"> </a>
                                            </div>
                                            <div class="tools"> </div>
                                        </div>
                                        <div class="portlet-body" >

                                    
                                            
                                            <table class="table table-striped table-bordered table-hover" width="100%" id="datatableOperationKPI_Half-year">
                                            </table>


                                        </div>
                                    </div>
                                    
                                            
                                        </div>
                                </div>

                                <button id="botKillLoading" class="btn btn-danger" style="display: none;"><i class="fa fa-trash-o"></i> Stop Loading... </button>
                                
                                


                            </div>
                            <!-- END PAGE CONTENT INNER -->
                        </div>
                    </div>
                    <!-- END PAGE CONTENT BODY -->
                    <!-- END CONTENT BODY -->
                </div>
                <!-- END CONTENT -->
            </div>
            <!-- END CONTAINER -->

        </div>
    </div>

    <div class="page-wrapper-row">
        <div class="page-wrapper-bottom">
            <!-- FOOTER -->

                    <!-- BEGIN FOOTER -->
        <!-- BEGIN INNER FOOTER -->
        <div class="page-footer">
            <div class="container-fluid"> 2016 &copy; iTMS Project by IEL. </div>
        </div>
        <div class="scroll-to-top">
            <i class="icon-arrow-up"></i>
        </div>
        <!-- END INNER FOOTER -->
        <!-- END FOOTER -->
        </div>
    </div>
</div>


        <!--[if lt IE 9]>
        <script src="../../../../../javascripts/javascript-if-it-IE-9.js" type="text/javascript"></script>
        <![endif]-->

        <script src="../../../../../javascripts/javascript-desktop-home-kpi-op002.js" type="text/javascript"></script>

    </body>

        <script id="menu-Template" type="text/x-handlebars-template">

        {{#each rows}}

        <!-- Here the context is each individual person. So we can access its properties directly: -->
        <!-- <p>{{main_menu_title}} - {{main_menu_leaf}}</p> -->

        <li class="{{main_menu_active}} {{#if main_menu_leaf}} menu-dropdown classic-menu-dropdown{{/if}}">
            <a href="{{#if_eq main_menu_leaf 'FALSE'}}{{@root.baseURL}}{{main_menu_url}}{{else}}#{{/if_eq}}"> {{main_menu_title}}</a>

            {{#if main_menu_leaf}}
                <span class="arrow"></span>
                <ul class="dropdown-menu pull-left">
                    {{#each sub_menu_level_01}}
                    <li class=" {{#if_eq sub_menu_level_01_leaf 'TRUE'}}dropdown-submenu{{/if_eq}}">
                        <a href="{{#if_eq sub_menu_level_01_leaf 'FALSE'}}{{@root.baseURL}}{{sub_menu_level_01_url}}{{else}}#{{/if_eq}}" class="nav-link  "> {{sub_menu_level_01_title}} </a>
                        
                        {{#if sub_menu_level_01_leaf}}
                        <span class="arrow"></span>
                        <ul class="dropdown-menu">

                            {{#each sub_menu_level_02}}
                            <li class=" {{#if_eq sub_menu_level_02_leaf 'TRUE'}}dropdown-submenu{{/if_eq}}">
                                <a href="{{#if_eq sub_menu_level_02_leaf 'FALSE'}}{{@root.baseURL}}{{sub_menu_level_02_url}}{{else}}#{{/if_eq}}" class=""> {{sub_menu_level_02_title}} </a>

                                {{#if sub_menu_level_02_leaf}}
                                <span class="arrow"></span>
                                <ul class="dropdown-menu">
                                    {{#each sub_menu_level_03}}
                                    <li class=" {{#if_eq sub_menu_level_03_leaf 'TRUE'}}dropdown-submenu{{/if_eq}}">
                                        <a href="{{#if_eq sub_menu_level_03_leaf 'FALSE'}}{{@root.baseURL}}{{sub_menu_level_03_url}}{{else}}#{{/if_eq}}"> {{sub_menu_level_03_title}} </a>

                                        {{#if sub_menu_level_03_leaf}}
                                        <span class="arrow"></span>
                                        <ul class="dropdown-menu">
                                            {{#each sub_menu_level_04}}
                                            <li class=" ">
                                                <a href="{{#if_eq sub_menu_level_04_leaf 'FALSE'}}{{@root.baseURL}}{{sub_menu_level_04_url}}{{else}}#{{/if_eq}}"> {{sub_menu_level_04_title}} </a>
                                            </li>
                                            {{/each}}
                                        </ul>
                                        {{/if}}
                                        
                                    </li>
                                    {{/each}}
                                </ul>
                                {{/if}}
                            </li>
                            {{/each}}

                        </ul>
                        {{/if}}
                    </li>
                    {{/each}}
                </ul>
            {{/if}}
        </li>

        {{/each}}
    </script>
</html>