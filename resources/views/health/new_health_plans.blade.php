 @extends($layout)
@section('content')
<style>


.hero.is-medium .hero-body {
 padding-bottom:1rem;
 padding-top:2rem
}
.logo-box {
 margin:9px 0 0
}
.main-box {
 background:#fff;
 border-radius:8px;
 -webkit-box-shadow:0 2px 13px 0 hsla(0,0%,62.7%,.8);
 -moz-box-shadow:0 2px 13px 0 hsla(0,0%,62.7%,.8);
 box-shadow:0 2px 13px 0 hsla(0,0%,62.7%,.8)
}
.green-box {
 background:-moz-linear-gradient(268deg,#5bd6c7 0,#32b39c 100%);
 background:-webkit-gradient(linear,left top,left bottom,color-stop(0,#5bd6c7),color-stop(100%,#32b39c));
 background:-webkit-linear-gradient(268deg,#5bd6c7,#32b39c);
 background:-o-linear-gradient(268deg,#5bd6c7 0,#32b39c 100%);
 background:-ms-linear-gradient(268deg,#5bd6c7 0,#32b39c 100%);
 background:linear-gradient(182deg,#5bd6c7,#32b39c);
 filter:progid:DXImageTransform.Microsoft.gradient(startColorstr="#5BD6C7",endColorstr="#32B39C",GradientType=0);
 position:relative;
 border-radius:8px 0 0 8px;
 min-height:560px;
 padding-bottom:0
}
.gray-box {
 background-color:#eee;
 background-image:linear-gradient(90deg,#eee,#f5f5f5,#eee);
 background-size:200px 100%;
 display:inline-block;
 line-height:1;
 width:100%;
 background-repeat:no-repeat;
 border-radius:4px
}
.mg-text {
 margin-top:12px
}
.md-stepper-horizontal {
 display:table;
 width:100%;
 margin:0 auto;
 background-color:#fff
}
.md-stepper-horizontal .md-step {
 display:table-cell;
 position:relative;
 padding:24px 24px 14px
}
.md-stepper-horizontal .md-step:active,
.md-stepper-horizontal .md-step:hover {
 background-color:transparent
}
.md-stepper-horizontal .md-step:active {
 border-radius:15%/75%
}
.md-stepper-horizontal .md-step:first-child:active {
 border-top-left-radius:0;
 border-bottom-left-radius:0
}
.md-stepper-horizontal .md-step:last-child:active {
 border-top-right-radius:0;
 border-bottom-right-radius:0
}
.md-stepper-horizontal .md-step:hover .md-step-circle {
 background-color:#d8d8d8
}
.md-stepper-horizontal .md-step:first-child .md-step-bar-left,
.md-stepper-horizontal .md-step:last-child .md-step-bar-right {
 display:none
}
.md-stepper-horizontal .md-step .md-step-circle {
 width:24px;
 height:auto;
 margin:0 auto;
 background-color:#d8d8d8;
 border-radius:50%;
 text-align:center;
 line-height:24.5px;
 font-size:.8rem;
 font-weight:400;
 color:#9b9b9b
}
.md-stepper-horizontal.green .md-step.active .md-step-circle {
 background:-moz-linear-gradient(265deg,#5bd6c7 0,#32b39c 100%);
 background:-webkit-gradient(linear,left top,left bottom,color-stop(0,#5bd6c7),color-stop(100%,#32b39c));
 background:-webkit-linear-gradient(265deg,#5bd6c7,#32b39c);
 background:-o-linear-gradient(265deg,#5bd6c7 0,#32b39c 100%);
 background:-ms-linear-gradient(265deg,#5bd6c7 0,#32b39c 100%);
 background:linear-gradient(185deg,#5bd6c7,#32b39c);
 filter:progid:DXImageTransform.Microsoft.gradient(startColorstr="#5BD6C7",endColorstr="#32B39C",GradientType=0);
 -webkit-box-shadow:0 0 6px 3px #bef7ee;
 -moz-box-shadow:0 0 6px 3px #bef7ee;
 box-shadow:0 0 6px 3px #bef7ee;
 position:relative
}
.md-stepper-horizontal.orange .md-step.active .md-step-circle {
 background-color:#f96302
}
.md-stepper-horizontal .md-step.active .md-step-circle {
 background-color:#2196f3
}
.md-stepper-horizontal .md-step.done .md-step-circle *,
.md-stepper-horizontal .md-step.editable .md-step-circle * {
 display:inline-block
}
.md-stepper-horizontal .md-step.editable .md-step-circle {
 -moz-transform:scaleX(-1);
 -o-transform:scaleX(-1);
 -webkit-transform:scaleX(-1);
 transform:scaleX(-1)
}
.md-stepper-horizontal .md-step.editable .md-step-circle:before {
 font-family:FontAwesome;
 font-weight:100;
 content:"\f040"
}
.md-stepper-horizontal .md-step .md-step-optional {
 font-size:.75rem
}
.md-stepper-horizontal .md-step.active .md-step-optional {
 color:rgba(0,0,0,.54)
}
.md-stepper-horizontal .md-step .md-step-bar-left,
.md-stepper-horizontal .md-step .md-step-bar-right {
 position:absolute;
 top:36px;
 height:1px;
 border-top:1px solid #ddd
}
.md-stepper-horizontal .md-step.active .md-step-circle {
 color:#fff
}
.md-step.done .md-step-circle:before {
 position:absolute;
 top:0;
 left:0;
 background:-moz-linear-gradient(265deg,#5bd6c7 0,#32b39c 100%);
 background:-webkit-gradient(linear,left top,left bottom,color-stop(0,#5bd6c7),color-stop(100%,#32b39c));
 background:-webkit-linear-gradient(265deg,#5bd6c7,#32b39c);
 background:-o-linear-gradient(265deg,#5bd6c7 0,#32b39c 100%);
 background:-ms-linear-gradient(265deg,#5bd6c7 0,#32b39c 100%);
 background:linear-gradient(185deg,#5bd6c7,#32b39c);
 filter:progid:DXImageTransform.Microsoft.gradient(startColorstr="#5BD6C7",endColorstr="#32B39C",GradientType=0);
 content:"";
 width:24px;
 border-radius:50%;
 height:24px;
 -webkit-box-shadow:0 0 6px 3px #bef7ee;
 -moz-box-shadow:0 0 6px 3px #bef7ee;
 box-shadow:0 0 6px 3px #bef7ee
}
.md-stepper-horizontal.green .md-step.active.done .md-step-circle {
 box-shadow:none
}
.divider-desk-active {
 display:flex;
 left:66%;
 position:absolute;
 top:51%!important
}
.divider-desk-active span {
 width:20px!important;
 height:8px!important;
 background:url("data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iOSIgaGVpZ2h0PSI5IiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIj48ZGVmcz48bGluZWFyR3JhZGllbnQgeDE9IjAlIiB5MT0iMCUiIHgyPSIxMDAlIiB5Mj0iMTE0LjE3MiUiIGlkPSJjIj48c3RvcCBzdG9wLWNvbG9yPSIjNUJENkM3IiBvZmZzZXQ9IjAlIi8+PHN0b3Agc3RvcC1jb2xvcj0iIzMyQjM5QyIgb2Zmc2V0PSIxMDAlIi8+PC9saW5lYXJHcmFkaWVudD48ZmlsdGVyIHg9Ii02MCUiIHk9Ii02MCUiIHdpZHRoPSIyMjAlIiBoZWlnaHQ9IjIyMCUiIGZpbHRlclVuaXRzPSJvYmplY3RCb3VuZGluZ0JveCIgaWQ9ImEiPjxmZU9mZnNldCBpbj0iU291cmNlQWxwaGEiIHJlc3VsdD0ic2hhZG93T2Zmc2V0T3V0ZXIxIi8+PGZlR2F1c3NpYW5CbHVyIHN0ZERldmlhdGlvbj0iMSIgaW49InNoYWRvd09mZnNldE91dGVyMSIgcmVzdWx0PSJzaGFkb3dCbHVyT3V0ZXIxIi8+PGZlQ29sb3JNYXRyaXggdmFsdWVzPSIwIDAgMCAwIDAuNDEyMzY1ODQ2IDAgMCAwIDAgMSAwIDAgMCAwIDAuODk1MDY1MzMgMCAwIDAgMSAwIiBpbj0ic2hhZG93Qmx1ck91dGVyMSIvPjwvZmlsdGVyPjxjaXJjbGUgaWQ9ImIiIGN4PSIzMS41IiBjeT0iOS41IiByPSIyLjUiLz48L2RlZnM+PGcgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoLTI3IC01KSIgZmlsbD0ibm9uZSIgZmlsbC1ydWxlPSJldmVub2RkIj48dXNlIGZpbGw9IiMwMDAiIGZpbHRlcj0idXJsKCNhKSIgeGxpbms6aHJlZj0iI2IiLz48dXNlIGZpbGw9InVybCgjYykiIHhsaW5rOmhyZWY9IiNiIi8+PC9nPjwvc3ZnPg==") 0 0 no-repeat!important
}
.divider-desk {
 display:flex;
 left:66%;
 position:absolute;
 top:55%
}
.divider-desk span {
 width:20px;
 height:8px;
 background:url("data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNSIgaGVpZ2h0PSI1IiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPjxjaXJjbGUgY3g9IjEyNS41IiBjeT0iOS41IiByPSIyLjUiIHRyYW5zZm9ybT0idHJhbnNsYXRlKC0xMjMgLTcpIiBmaWxsPSIjRDhEOEQ4IiBmaWxsLXJ1bGU9ImV2ZW5vZGQiLz48L3N2Zz4=") 0 0 no-repeat
}
.button-box {
 background-color:#fc4804!important;
 font-weight:400;
 height:50px;
 border-radius:5px;
 color:#fff!important;
 width:304px!important;
 font-size:.875rem!important;
 position:relative;
 text-align:left;
 padding-left:104px
}
.arrow-icon-port {
 background-image:url("data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTUiIGhlaWdodD0iMTIiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PHBhdGggZD0iTS43NSA1LjI1N2gxMS42OUw4LjQxNiAxLjI2OWEuNzM5LjczOSAwIDAxMC0xLjA1MS43NTUuNzU1IDAgMDExLjA2IDBsNS4zMDMgNS4yNTZhLjc0NC43NDQgMCAwMS4wOTQuMTE0Yy4wMTIuMDE5LjAyMS4wMzkuMDMyLjA1OC4wMTIuMDIzLjAyNi4wNDUuMDM2LjA3LjAxLjAyNS4wMTcuMDUuMDI1LjA3Ny4wMDYuMDIuMDE0LjA0LjAxOC4wNjEuMDEuMDQ5LjAxNS4wOTcuMDE1LjE0NnYuMDAyYS43MjkuNzI5IDAgMDEtLjAxNS4xNDRjLS4wMDQuMDIyLS4wMTMuMDQzLS4wMi4wNjQtLjAwNy4wMjUtLjAxMi4wNS0uMDIyLjA3NC0uMDExLjAyNi0uMDI2LjA1LS4wNC4wNzQtLjAxLjAxOC0uMDE3LjAzNy0uMDMuMDU0YS43NDQuNzQ0IDAgMDEtLjA5My4xMTRsLTUuMzAzIDUuMjU2YS43NTUuNzU1IDAgMDEtMS4wNiAwIC43NC43NCAwIDAxMC0xLjA1MWw0LjAyMi0zLjk4N0guNzVBLjc0Ny43NDcgMCAwMTAgNmMwLS40MS4zMzYtLjc0My43NS0uNzQzeiIgZmlsbD0iI0ZGRiIgZmlsbC1ydWxlPSJldmVub2RkIi8+PC9zdmc+");
 background-repeat:no-repeat;
 width:31px;
 height:20px;
 left:inherit!important;
 transform:inherit!important;
 background-position:10px 5px!important;
 position:absolute
}
.top-heading-desk {
 line-height:38px;
 font-size:1.5rem;
 color:#212121;
 position:relative;
 height:auto
}
.top-heading-desk span {
 display:block;
 font-weight:600;
 font-size:1.5rem;
 color:#212121
}
.mt-4 {
 margin-top:24px!important
}
.top-heading-desk span:before {
 content:"";
 position:absolute;
 width:56px;
 height:3px;
 background:#f8e71c;
 bottom:-7px
}
.inner-left-desk3 {
 padding:15px;
 display:block;
 font-size:.75rem;
 color:#fff;
 text-align:left;
 font-weight:600
}
.inner-left-desk3 p:first-child {
 display:block;
 position:relative;
 font-size:1.125rem;
 color:#fff;
 margin-bottom:23px
}
.inner-left-desk3 p {
 margin-bottom:15px
}
.inner-left-desk3 p:first-child:before {
 content:"";
 position:absolute;
 width:38px;
 height:3px;
 background:#fff;
 bottom:-11px
}
.box-search {
 width:98%
}
.search-input {
 color:#363636;
 border:1px solid #979797!important;
 border-radius:8px!important;
 height:48px;
 box-shadow:none
}
.search-input::placeholder {
 color:#c2c2c2;
 font-weight:600
}
.input.is-primary.is-active,
.input.is-primary.is-focused,
.input.is-primary:active,
.input.is-primary:focus {
 box-shadow:0 0 5px #43ceb3!important;
 border:1px solid #43ceb3!important;
 outline:none!important
}
.input.is-primary {
 border-color:#d6d6d6
}
.button-search {
 height:48px;
 background-color:#51b9a3!important;
 text-transform:uppercase;
 font-size:.875rem!important;
 border-radius:0 8px 8px 0
}
.insurer-logo-box {
 margin-right:8px;
 margin-bottom:15px
}
.insurer-logo-box,
.insurer-logo-box-loading {
 box-shadow:0 0 5px #e1e6e5;
 border:1px solid #efefef;
 padding:0 10px;
 height:80px;
 width:158px;
 align-items:center;
 justify-content:center;
 display:flex;
 border-radius:8px;
 cursor:pointer
}
.insurer-logo-box img {
 max-width:100%;
 max-height:100%
}
.insurer-logo-box.active {
 position:relative;
 box-shadow:0 0 5px #43ceb3!important;
 border:1px solid #43ceb3;
 cursor:inherit
}
.insurer-logo-box.active:after {
 content:"";
 position:absolute;
 width:22px;
 height:22px;
 right:-8px;
 top:-8px;
 background:url("data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjIiIGhlaWdodD0iMjIiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiPjxkZWZzPjxwYXRoIGQ9Ik0xMSAwYzYuMDc2IDAgMTEgNC45MjQgMTEgMTFzLTQuOTI0IDExLTExIDExUzAgMTcuMDc2IDAgMTEgNC45MjQgMCAxMSAweiIgaWQ9ImEiLz48L2RlZnM+PGcgZmlsbD0ibm9uZSIgZmlsbC1ydWxlPSJldmVub2RkIj48bWFzayBpZD0iYiIgZmlsbD0iI2ZmZiI+PHVzZSB4bGluazpocmVmPSIjYSIvPjwvbWFzaz48dXNlIGZpbGw9IiM1QkNGQjMiIGZpbGwtcnVsZT0ibm9uemVybyIgeGxpbms6aHJlZj0iI2EiLz48cGF0aCBzdHJva2U9IiNGRkYiIGZpbGw9IiNGRkYiIGZpbGwtcnVsZT0ibm9uemVybyIgbWFzaz0idXJsKCNiKSIgZD0iTTE2LjQwOCA3bC03LjA1NiA3LjY5OS0zLjc1Ni00LjA5Ny0uNTk2LjY1TDkuMzUyIDE2IDE3IDcuNjV6Ii8+PC9nPjwvc3ZnPg==") 0 0 no-repeat!important
}
.port-more {
 color:#2255c9;
 font-size:.875rem;
 font-weight:600;
 cursor:pointer
}
.card-upper-desk {
 font-weight:600;
 margin-bottom:15px;
 color:#7f8185
}
.title-dropdown2 {
 background-position:96% 20px;
 background-size:4%;
 font-size:.875rem;
 color:#000!important;
 font-weight:600;
 background-image:url("data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTEiIGhlaWdodD0iOCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cGF0aCBkPSJNMS4yOTcuNDJMNS41IDQuNjQzIDkuNzAzLjQyIDExIDEuNzIzIDUuNSA3LjI1IDAgMS43MjN6IiBmaWxsPSIjOTc5Nzk3IiBmaWxsLXJ1bGU9ImV2ZW5vZGQiLz48L3N2Zz4=");
 background-repeat:no-repeat;
 background-color:transparent;
 -webkit-appearance:none;
 -moz-appearance:none;
 appearance:none;
 -webkit-transition:all .3s ease-in-out;
 -moz-transition:all .3s ease-in-out;
 -ms-transition:all .3s ease-in-out;
 -o-transition:all .3s ease-in-out;
 outline:none;
 border:1px solid #979797;
 border-radius:8px;
 width:98%;
 padding:0 0 0 10px;
 float:left;
 margin:0 59px 22px 0;
 height:48px;
 line-height:48px
}
.custom_btn {
 background:#fff;
 border:1px solid #979797;
 color:#979797;
 border-radius:20px;
 text-transform:capitalize;
 padding:0 12px;
 font-size:.875rem;
 min-width:90px;
 height:35px;
 line-height:35px;
 margin-bottom:12px!important;
 box-shadow:none!important;
 font-weight:700;
 margin:0 12px 0 0;
 cursor:pointer
}
.custom_btn.active {
 background:#32b39c;
 color:#fff;
 border:1px solid #32b39b
}
.or-text {
 color:#7f8185
}
.error-text {
 color:red
}
.area-back {
 top:31px
}
.back-desk-2 {
 background-image:url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiP…I+PC9wYXRoPgogICAgICAgICAgICA8L2c+CiAgICAgICAgPC9nPgogICAgPC9nPgo8L3N2Zz4=)
}
.form-box label {
 color:#7f8185;
 font-weight:400;
 font-size:14px;
 margin:0 0 6px
}
.form-box input[type=tel],
.form-box input[type=text] {
 width:91.5%;
 border:1px solid #979797;
 box-shadow:none;
 font-size:14px;
 height:48px;
 border-radius:8px;
 font-weight:700;
 margin:6px 0 0
}
.info-complete-desk {
 width:16px;
 height:12px;
 background:url("data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTYiIGhlaWdodD0iMTIiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PHBhdGggZD0iTTE0LjgyNyAxLjE3NGEuNTg2LjU4NiAwIDAwLS44MzIgMGwtOC4zMjkgOC40LTMuNjYxLTMuNjY2YS41ODYuNTg2IDAgMDAtLjgzMyAwIC41OTQuNTk0IDAgMDAwIC44MzdsNC4wOCA0LjA4NGEuNTkyLjU5MiAwIDAwLjgzMyAwbDguNzQyLTguODE5YS41OTMuNTkzIDAgMDAwLS44MzZjLS4yMy0uMjMyLjIzLjIzIDAgMHoiIGZpbGw9IiMzNkMyQTkiIHN0cm9rZT0iIzM2QzJBOSIgc3Ryb2tlLXdpZHRoPSIuNSIgZmlsbC1ydWxlPSJldmVub2RkIi8+PC9zdmc+") 0 0 no-repeat;
 text-indent:-9999px
}
.info-complete-edit {
 right:11%;
 top:56%
}
.tick-pos-name {
 right:3%!important;
 top:58%!important;
 position:absolute
}
.tick-pos-name-mob {
 right:8%!important;
 top:47%!important;
 position:absolute
}
.country-code {
 left:2%!important;
 color:#212121!important;
 top:50%!important;
 font-size:14px;
 font-weight:700
}
.form-box .control.has-icons-left .input {
 padding-left:3.25em
}
.area-back {
 position:absolute;
 top:43px;
 left:-48px;
 cursor:pointer
}
.back-desk-2 {
 width:29px;
 opacity:.6;
 height:24px;
 background-image:url("data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjkiIGhlaWdodD0iMjQiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PHBhdGggZD0iTTI3LjU1IDEwLjUxNEg0Ljk1bDcuNzc4LTcuOTc2YTEuNTE0IDEuNTE0IDAgMDAwLTIuMTAzIDEuNDI1IDEuNDI1IDAgMDAtMi4wNSAwTC40MjQgMTAuOTVjLS4wNjguMDY5LS4xMjguMTQ1LS4xOC4yMjctLjAyNS4wMzctLjA0Mi4wNzgtLjA2My4xMTctLjAyNC4wNDYtLjA1MS4wOS0uMDcuMTM4LS4wMjEuMDUtLjAzMy4xMDMtLjA0Ny4xNTUtLjAxMi4wNDEtLjAyOC4wOC0uMDM2LjEyM0ExLjUxNiAxLjUxNiAwIDAwMCAxMnYuMDAzYzAgLjA5Ny4wMS4xOTMuMDI5LjI4OC4wMDguMDQ1LjAyNS4wODYuMDM3LjEzLjAxNC4wNS4wMjYuMS4wNDUuMTQ3LjAyMS4wNTIuMDUuMDk5LjA3NS4xNDguMDIuMDM2LjAzNS4wNzMuMDU4LjEwOC4wNTMuMDgyLjExNC4xNTkuMTgyLjIyOGwxMC4yNTIgMTAuNTEyYy41NjYuNTgxIDEuNDg0LjU4MSAyLjA1IDBhMS41MTQgMS41MTQgMCAwMDAtMi4xMDJsLTcuNzc3LTcuOTc1SDI3LjU1Yy44IDAgMS40NS0uNjY2IDEuNDUtMS40ODcgMC0uODItLjY1LTEuNDg2LTEuNDUtMS40ODZ6IiBmaWxsPSIjQThBNUE1IiBmaWxsLXJ1bGU9ImV2ZW5vZGQiLz48L3N2Zz4=");
 text-indent:-999999px
}
.plan-label {
 display:block;
 margin-bottom:7px
}
.error-step {
 position:absolute;
 right:2%;
 font-size:.7rem;
 font-weight:500;
 color:red!important;
 top:74px
}
.plan-input {
 width:93%
}
.error-2 {
 right:8.5%;
 top:76px
}
.mb-5 {
 margin-bottom:5px!important
}
.btn-skelenton {
 margin-top:100px!important;
 display:block!important
}
.txtsearch-skelenton {
 margin-top:35px!important;
 display:block!important
}
.card-upper-desk-port {
 font-weight:600;
 margin-bottom:15px;
 font-size:1rem;
 color:#7f8185
}
.mb-0 {
 margin-bottom:0!important
}
.city-box {
 position:absolute;
 z-index:1;
 background:#fff;
 top:99px;
 width:44.5%;
 overflow-y:scroll;
 border:1px solid #cdc7c7;
 border-radius:4px;
 left:53%
}
.city-box-list-4 {
 overflow-y:inherit
}
.city-box ul {
 margin:0;
 padding:0
}
.city-box ul li {
 margin:0;
 padding:7px 0 7px 9px;
 list-style-type:none;
 font-size:14px;
 color:#504d4d;
 cursor:pointer;
 font-weight:600
}
.city-box ul li.active,
.city-box ul li:hover {
 background:#e2e0e0;
 color:#504d4d
}
.close-city {
 cursor:pointer;
 position:absolute;
 right:3%;
 top:52%;
 color:#36c2a9;
 font-weight:600
}
.scrollbar-new::-webkit-scrollbar-track {
 border-radius:10px;
 background-color:#f0eeee
}
.scrollbar-new::-webkit-scrollbar {
 width:12px;
 background-color:#f0eeee
}
.scrollbar-new::-webkit-scrollbar-thumb {
 border-radius:10px;
 background-color:#969393
}
.city-number-box {
 height:179px
}
.head-city {
 font-size:14px;
 padding:12px 8px 8px;
 color:#36c2a9;
 font-weight:400
}
ul.circle-slider {
 margin-top:14px;
 padding:0;
 text-align:center
}
ul.circle-slider li {
 margin:0 5px;
 display:inline-block;
 padding:5px;
 background:#fff;
 border:1px solid #ccc;
 cursor:pointer;
 border-radius:100%;
 text-indent:-99999px;
 width:14px;
 height:14px
}
ul.circle-slider li.active {
 background:#77dac3;
 border:1px solid #3caf95
}
.box-gender {
 width:auto;
 margin:0 19px
}
.loader_ctrl .loader {
 left:9px;
 position:absolute;
 top:12px
}
.loader {
 padding:10px;
 border-radius:50%;
 border:4px solid #fc5e22;
 border-top-color:#ccc;
 width:15px;
 height:15px;
 -webkit-animation:spin 1s linear infinite;
 animation:spin 1s linear infinite
}
button.button-box2:disabled,
button.button-box2[disabled],
button.button-box:disabled,
button.button-box[disabled] {
 border:0 solid #999!important;
 background-color:#ccc!important;
 color:#666!important
}
.disableCityArea {
 position:absolute;
 top:0;
 width:100%;
 height:50%;
 z-index:1
}
.info-complete-edit {
 width:19px;
 height:19px;
 background:url("data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTkiIGhlaWdodD0iMTkiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PHBhdGggZD0iTS43MzYgMTQuNEwwIDE5bDQuNTkyLS43MzguNDU2LS40OTFMMTkgMy44MjggMTUuMTQ0IDAgMS4yMjcgMTMuOTQzbC0uNDkuNDU2em0xLjAzNS42NjlsMi4xNiAyLjE5Ni0yLjYyLjQyNS40Ni0yLjYyMXpNMTcuNjkgMy43NThsLTEuNDYgMS40ODMtMi40NzEtMi40ODQgMS40OTctMS40NDcgMi40MzQgMi40NDh6bS00LjMyNi0uNDgybDIuMzYgMi4zNkw0Ljk0NSAxNi4zNzlsLTIuMzI0LTIuMzZMMTMuMzY0IDMuMjc2eiIgZmlsbD0iIzM2QzJBOSIgZmlsbC1ydWxlPSJub256ZXJvIi8+PC9zdmc+") 0 0 no-repeat;
 text-indent:-9999px;
 position:absolute;
 right:4%;
 top:59%
}
.img-port-left {
 margin:0;
 position:absolute;
 bottom:0;
 left:10%
}
.port-main-box {
 margin:0 0 0 2px
}
.close-port-box {
 position:absolute;
 top:16px;
 right:23px;
 background-image:url("data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGcgZmlsbD0iI0ZGRiIgZmlsbC1ydWxlPSJub256ZXJvIj48cGF0aCBkPSJNMTkuMzMzIDBMMTAgOS4zNjcuNjMzIDAgMCAuNjMzIDkuMzMzIDEwIDAgMTkuMzY3LjYzMyAyMCAxMCAxMC42MzMgMTkuMzMzIDIwbC42NjctLjYzM0wxMC42MzMgMTAgMjAgLjYzM3oiLz48cGF0aCBkPSJNMTkuMzMzIDBMMTAgOS4zNjcuNjMzIDAgMCAuNjMzIDkuMzMzIDEwIDAgMTkuMzY3LjYzMyAyMCAxMCAxMC42MzMgMTkuMzMzIDIwbC42NjctLjYzM0wxMC42MzMgMTAgMjAgLjYzM3oiLz48cGF0aCBkPSJNMTkuMzMzIDBMMTAgOS4zNjcuNjMzIDAgMCAuNjMzIDkuMzMzIDEwIDAgMTkuMzY3LjYzMyAyMCAxMCAxMC42MzMgMTkuMzMzIDIwbC42NjctLjYzM0wxMC42MzMgMTAgMjAgLjYzM3oiLz48L2c+PC9zdmc+");
 background-repeat:no-repeat;
 background-position:0 0;
 text-indent:-99999px;
 width:20px;
 height:20px;
 cursor:pointer
}
.add_plan_port {
 padding-right:38px
}
.button-box2.is-active,
.button-box2.is-focused,
.button-box2:active,
.button-box2:focus,
.button-box.is-active,
.button-box.is-focused,
.button-box:active,
.button-box:focus,
.button-port.is-active,
.button-port.is-focused,
.button-port:active,
.button-port:focus {
 border-color:transparent!important
}
.button-box2.is-focused:not(:active),
.button-box2:focus:not(:active) {
 box-shadow:none!important
}
.button-box2.is-hovered,
.button-box2:hover {
 border-color:#fc4804!important
}
.pt-0 {
 padding-bottom:0!important
}
.term-desk {
 color:#979797;
 font-size:12.5px
}
p.term-desk {
 margin-bottom:10px
}
.pa-4 {
 padding:24px!important
}
.know-box {
 border-bottom:1px solid #36c2a9
}
.know-more-desk {
 display:inline-block;
 font-weight:700;
 border-radius:8px 8px 0 0;
 background-color:#36c2a9;
 color:#fff;
 width:277px;
 text-align:center;
 padding:9px;
 height:34px;
 border:1px solid #36c2a9;
 border-bottom:none;
 font-size:14px;
 cursor:pointer
}
.know-box-open h2 {
 font-size:12px;
 color:#212121;
 font-weight:600;
 margin:0 0 0 21px;
 padding:9px 0 0
}
.know-box-open ul {
 margin:10px 0 20px;
 padding:0
}
.know-box-open ul li {
 margin:0 0 0 37px;
 padding:0;
 line-height:18px;
 font-size:12px;
 color:#4a4a4a;
 list-style-type:disc
}
.know-box-open {
 border-radius:0 0 8px 8px;
 border:1px solid #36c2a9;
 border-top:none
}
.term-desk a:hover {
 color:#1f84f8!important;
 text-decoration:none
}
.mb-50 {
 margin-bottom:50px
}
@media screen and (min-width:320px) and (max-width:767px) and (orientation:landscape) {
 .info-complete-edit {
  right:4%;
  top:59%
 }
 .tick-pos-name-mob {
  right:0!important;
  top:26%!important;
  position:absolute
 }
 .mob-main-box {
  background:none;
  border-radius:4px;
  box-shadow:none
 }
 .port-more {
  cursor:inherit!important
 }
 .insurer-logo-box {
  width:100%;
  cursor:inherit
 }
 .title-dropdown2 {
  background-position:96% 20px;
  margin:0
 }
 .form-box input[type=tel],
 .form-box input[type=text],
 .title-dropdown2 {
  width:100%;
  border:none;
  border-bottom:1px solid #ececec;
  border-radius:0
 }
 .country-code {
  left:2%!important;
  top:27%!important
 }
 .top-heading-desk {
  line-height:23px;
  font-size:16px;
  margin:0 0 -8px!important
 }
 .top-heading-desk span {
  font-size:16px;
  font-weight:700
 }
 .top-heading-desk span:before {
  content:"";
  width:38px;
  height:3px;
  bottom:-8px
 }
 .mobile-main-container {
  background:#fff;
  box-shadow:0 2px 1px -1px rgba(0,0,0,.2),0 1px 1px 0 rgba(0,0,0,.14),0 1px 3px 0 rgba(0,0,0,.12);
  border-radius:4px;
  padding:15px 15px 0
 }
 .hero.is-medium .hero-body {
  padding-top:1rem
 }
 .box-btn {
  padding:2rem 0!important
 }
 .button-box {
  width:100%!important;
  padding-left:35%
 }
 .card-upper-desk {
  font-size:.875rem;
  padding-top:1rem;
  margin-bottom:-12px
 }
 .plan-input {
  width:100%
 }
 .mobile-main-container2 {
  padding:15px 0
 }
 .box-mob-sp {
  padding:0 .75rem
 }
 .bdr-none {
  border:none!important
 }
 .input.is-primary.is-active,
 .input.is-primary.is-focused,
 .input.is-primary:active,
 .input.is-primary:focus {
  box-shadow:none!important;
  outline:none!important;
  border:none!important;
  border-bottom:1px solid #ececec!important
 }
 .input.bdr-none.is-active,
 .input.bdr-none.is-focused,
 .input.bdr-none:active,
 .input.bdr-none:focus {
  box-shadow:none!important;
  border-bottom:0 solid #ececec!important;
  outline:none!important;
  border-left:none;
  border-right:none;
  border-top:none
 }
 .tick-pos-name {
  right:1%!important;
  top:26%!important
 }
 .mob-name-sp {
  padding-left:11px
 }
 .error-2 {
  right:2.5%;
  top:32px
 }
 .error-step {
  top:35px
 }
 .mob-grid.is-mobile>.column.is-one-quarter {
  width:50%!important;
  display:inline-block!important
 }
 .card-upper-desk-port {
  margin-bottom:0
 }
 .city-box {
  width:88%
 }
 .insurer-logo-box img {
  max-height:45px
 }
 .input.box-city-in.is-active,
 .input.box-city-in.is-focused,
 .input.box-city-in:active,
 .input.box-city-in:focus {
  box-shadow:0 0 5px #43ceb3!important;
  border:1px solid #43ceb3!important;
  outline:none!important
 }
 .box-search {
  width:100%
 }
 .insurer-logo-box {
  border-radius:4px
 }
 .mob-logo-container2 {
  width:100%;
  display:inline-flex
 }
 .mob-row {
  display:flex!important;
  flex-direction:row
 }
 .close-port-box {
  cursor:inherit;
  top:18px;
  right:10px
 }
 .mob-footer-box {
  margin:0
 }
 .mb-1 {
  margin-bottom:4px!important
 }
 .mb-3 {
  margin-bottom:16px!important
 }
 .call-icon {
  background-image:url("data:image/svg+xml;charset=utf-8,%3Csvg width='17' height='29' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M14.816.667H2.184C1.132.667.27 1.527.27 2.58v24.505A1.92 1.92 0 002.184 29h12.632c1.052 0 1.914-.86 1.914-1.914V2.58A1.919 1.919 0 0014.816.667zm-8.337 1.38h4.042a.232.232 0 010 .463H6.479a.231.231 0 110-.464zM8.5 28.042a.957.957 0 110-1.914.957.957 0 010 1.914zm6.898-2.585H1.602V3.702h13.796v21.756z' fill='%23FC4804' fill-rule='nonzero'/%3E%3C/svg%3E");
  background-repeat:no-repeat;
  width:auto;
  padding-left:24px;
  align-items:center;
  line-height:29px!important
 }
 .bottom-text span {
  display:block;
  line-height:17px
 }
 .bottom-text span:nth-child(1n) {
  font-size:16px;
  color:#212121
 }
 .bottom-text span:nth-child(2n) {
  font-size:14px;
  color:#979797
 }
 .bottom-text span:nth-child(3n) {
  font-size:13px;
  color:#fc4804
 }
 .bottom-text span:nth-child(4n) {
  font-size:12px;
  color:#9d9d9d
 }
 .bottom-text span:nth-child(5n),
 .bottom-text span:nth-child(6n) {
  font-size:10px;
  color:#9d9d9d
 }
 .bottom-text a {
  color:#9d9d9d;
  text-decoration:underline
 }
 .call-icon a {
  color:#fc4804;
  text-decoration:none
 }
 .bottom-text {
  padding-bottom:10px
 }
 .term-desk a:hover {
  color:#1f84f8!important;
  text-decoration:none
 }
}
@media screen and (min-width:320px) and (max-width:768px) {
 .info-complete-edit {
  right:4%;
  top:58%
 }
 .tick-pos-name-mob {
  right:0!important;
  top:26%!important;
  position:absolute
 }
 .mob-main-box {
  background:none;
  border-radius:4px;
  box-shadow:none
 }
 .port-more {
  cursor:inherit!important
 }
 .insurer-logo-box {
  width:100%;
  cursor:inherit
 }
 .title-dropdown2 {
  background-position:96% 20px;
  margin:0
 }
 .form-box input[type=tel],
 .form-box input[type=text],
 .title-dropdown2 {
  width:100%;
  border:none;
  border-bottom:1px solid #ececec;
  border-radius:0
 }
 .country-code {
  left:2%!important;
  top:27%!important
 }
 .top-heading-desk {
  line-height:23px;
  font-size:16px;
  margin:0 0 -8px!important
 }
 .top-heading-desk span {
  font-size:16px;
  font-weight:700
 }
 .top-heading-desk span:before {
  content:"";
  width:38px;
  height:3px;
  bottom:-8px
 }
 .mobile-main-container {
  background:#fff;
  box-shadow:0 2px 1px -1px rgba(0,0,0,.2),0 1px 1px 0 rgba(0,0,0,.14),0 1px 3px 0 rgba(0,0,0,.12);
  border-radius:4px;
  padding:15px 15px 0
 }
 .hero.is-medium .hero-body {
  padding-top:1rem
 }
 .box-btn {
  padding:2rem 0!important
 }
 .button-box {
  width:100%!important;
  padding-left:35%
 }
 .card-upper-desk {
  font-size:.875rem;
  padding-top:1rem;
  margin-bottom:-12px
 }
 .plan-input {
  width:100%
 }
 .mobile-main-container2 {
  padding:15px 0
 }
 .box-mob-sp {
  padding:0 .75rem
 }
 .bdr-none {
  border:none!important
 }
 .input.is-primary.is-active,
 .input.is-primary.is-focused,
 .input.is-primary:active,
 .input.is-primary:focus {
  box-shadow:none!important;
  outline:none!important;
  border:none!important;
  border-bottom:1px solid #ececec!important
 }
 .input.search-input.is-active,
 .input.search-input.is-focused,
 .input.search-input:active,
 .input.search-input:focus {
  box-shadow:none!important;
  outline:none!important;
  border:1px solid #979797!important
 }
 .input.bdr-none.is-active,
 .input.bdr-none.is-focused,
 .input.bdr-none:active,
 .input.bdr-none:focus {
  box-shadow:none!important;
  border-bottom:0 solid #ececec!important;
  outline:none!important;
  border-left:none;
  border-right:none;
  border-top:none
 }
 .tick-pos-name {
  right:3%!important;
  top:59%!important
 }
 .box-search {
  width:100%
 }
 .mob-name-sp {
  padding-left:11px
 }
 .error-2 {
  right:2.5%;
  top:32px
 }
 .error-step {
  top:35px
 }
 .mob-grid.is-mobile>.column.is-one-quarter {
  width:50%!important;
  display:inline-block!important
 }
 .card-upper-desk-port {
  margin-bottom:0
 }
 .city-box {
  width:90%;
  left:5%;
  top:185px
 }
 .insurer-logo-box img {
  max-height:45px
 }
 .input.box-city-in.is-active,
 .input.box-city-in.is-focused,
 .input.box-city-in:active,
 .input.box-city-in:focus {
  box-shadow:0 0 5px #43ceb3!important;
  border:1px solid #43ceb3!important;
  outline:none!important
 }
 .mob-logo-container {
  width:50%;
  display:inline-flex
 }
 .mob-logo-container2 {
  width:100%;
  display:inline-flex
 }
 .insurer-logo-box {
  border-radius:4px
 }
 .mob-row {
  display:flex!important;
  flex-direction:row
 }
 .close-port-box {
  cursor:inherit;
  top:18px;
  right:10px
 }
 .mob-footer-box {
  margin:0
 }
 .mb-1 {
  margin-bottom:4px!important
 }
 .mb-3 {
  margin-bottom:16px!important
 }
 .call-icon {
  background-image:url("data:image/svg+xml;charset=utf-8,%3Csvg width='17' height='29' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M14.816.667H2.184C1.132.667.27 1.527.27 2.58v24.505A1.92 1.92 0 002.184 29h12.632c1.052 0 1.914-.86 1.914-1.914V2.58A1.919 1.919 0 0014.816.667zm-8.337 1.38h4.042a.232.232 0 010 .463H6.479a.231.231 0 110-.464zM8.5 28.042a.957.957 0 110-1.914.957.957 0 010 1.914zm6.898-2.585H1.602V3.702h13.796v21.756z' fill='%23FC4804' fill-rule='nonzero'/%3E%3C/svg%3E");
  background-repeat:no-repeat;
  width:auto;
  padding-left:24px;
  align-items:center;
  line-height:29px!important
 }
 .bottom-text {
  padding-bottom:10px
 }
 .bottom-text span {
  display:block;
  line-height:17px
 }
 .bottom-text span:nth-child(1n) {
  font-size:16px;
  color:#212121
 }
 .bottom-text span:nth-child(2n) {
  font-size:14px;
  color:#979797
 }
 .bottom-text span:nth-child(3n) {
  font-size:13px;
  color:#fc4804
 }
 .bottom-text span:nth-child(4n) {
  font-size:12px;
  color:#9d9d9d
 }
 .bottom-text span:nth-child(5n),
 .bottom-text span:nth-child(6n) {
  font-size:10px;
  color:#9d9d9d
 }
 .bottom-text a {
  color:#9d9d9d;
  text-decoration:underline
 }
 .call-icon a {
  color:#fc4804;
  text-decoration:none
 }
 .term-desk a:hover {
  color:#1f84f8!important;
  text-decoration:none
 }
}
@media screen and (min-width:375px) and (max-width:376px) {
 body {
  zoom:.98
 }
}
@media screen and (min-width:1440px) and (max-width:1920px) {
 .insurer-logo-box {
  width:165px;
  margin-right:16px
 }
 .box-search {
  width:97%
 }
}
.memberform {
 min-height:324px;
 width:100%;
 overflow:hidden
}
#slide1 {
 position:absolute;
 left:-600px;
 width:100%;
 height:307px;
 -webkit-animation:slide1 .5s forwards;
 -webkit-animation-delay:.05s;
 animation:slide1 .5s forwards;
 animation-delay:.05s
}
@-webkit-keyframes slide1 {
 to {
  left:0
 }
}
@keyframes slide1 {
 to {
  left:0
 }
}
#slide2 {
 position:absolute;
 left:-600px;
 width:100%;
 height:307px;
 -webkit-animation:slide2 .5s forwards;
 -webkit-animation-delay:.05s;
 animation:slide2 .5s forwards;
 animation-delay:.05s
}
@-webkit-keyframes slide2 {
 to {
  left:0
 }
}
@keyframes slide2 {
 to {
  left:0
 }
}
#slide3 {
 position:absolute;
 left:-600px;
 width:100%;
 height:307px;
 -webkit-animation:slide3 .5s forwards;
 -webkit-animation-delay:.05s;
 animation:slide3 .5s forwards;
 animation-delay:.05s
}
@-webkit-keyframes slide3 {
 to {
  left:0
 }
}
@keyframes slide3 {
 to {
  left:0
 }
}
@media screen and (min-width:800px) and (max-width:950px) {
 .img-port-left {
  left:16%;
  max-width:70%
 }
}
@media screen and (min-width:700px) and (max-width:1023px) {
 .none-tablet {
  display:none!important
 }
 .mob-logo-container {
  width:33%;
  display:inline-flex
 }
 .mob-logo-container2 {
  width:100%;
  display:inline-flex
 }
 .insurer-logo-box {
  border-radius:4px
 }
 .mob-row {
  flex-direction:row
 }
 .desk-v,
 .mob-row {
  display:flex!important
 }
 .img-port-left {
  left:11%;
  width:64%
 }
}
.quotes_toolbar {
 background-color:#fff;
 border-top:1px solid #e6efff;
 box-shadow:0 2px 9px 0 hsla(0,0%,87.1%,.3)
}
.quotes_toolbar .quotes_toolbar_wrapper {
 display:flex;
 flex-direction:row;
 max-width:1170px;
 margin:0 auto;
 width:100%
}
.insured_members_div {
 position:relative
}
.group_members_div,
.insured_members_div {
 display:flex;
 flex-direction:row;
 width:100%;
 min-height:57px;
 align-items:center
}
.group_members_div {
 justify-content:flex-end;
 float:right
}
.span_insured_heading {
 color:#253858;
 font-size:18px;
 font-weight:500;
 overflow:hidden;
 display:-webkit-box;
 -webkit-line-clamp:1;
 -webkit-box-orient:vertical
}
.span_insured_text {
 color:#253858;
 font-size:14px;
 padding-left:10px;
 padding-right:10px;
 font-weight:500
}
.span_insured_text.selected {
 color:#36b37e
}
.edit_info_svg {
 margin-left:10px;
 width:11px;
 height:11px;
 margin-right:10px
}
.edit_insured_member {
 color:#253858;
 cursor:pointer;
 font-size:12px;
 font-weight:500;
 border-radius:3px
}
.group_container {
 align-items:flex-start;
 padding-left:20px
}
.group_container,
.group_container2 {
 position:relative;
 width:40%;
 cursor:pointer;
 height:100%;
 display:flex;
 flex-direction:column;
 justify-content:center;
 text-align:center
}
.group_container2 {
 align-items:center;
 box-shadow:0 2px 9px 0 hsla(0,0%,87.1%,.3);
 background-color:#e6efff
}
.group_container_selected {
 width:40%;
 height:100%;
 border-bottom:2px solid #253858;
 display:flex;
 flex-direction:column;
 justify-content:center;
 align-items:flex-start;
 padding-left:20px;
 text-align:center
}
.span_profile_selected {
 color:#253858;
 font-size:16px;
 font-weight:700;
 overflow:hidden;
 text-align:left;
 display:-webkit-box;
 -webkit-line-clamp:1;
 -webkit-box-orient:vertical
}
.edit_modify {
 height:15px;
 width:15px
}
.span_profile {
 color:#253858;
 font-size:16px;
 overflow:hidden;
 text-align:left;
 display:-webkit-box;
 -webkit-line-clamp:1;
 -webkit-box-orient:vertical
}
.modify_group_div {
 width:100%;
 max-height:50vh;
 overflow-y:auto;
 padding:20px 0 0;
 display:flex;
 flex-direction:column
}
.modify_group_div.cart_mobile {
 max-height:calc(100% - 130px)
}
.modify_group_grid {
 width:100%;
 display:flex;
 flex-direction:row;
 align-items:center
}
.modify_group_group_container {
 width:100%;
 display:flex;
 flex-direction:column;
 align-items:center
}
.modify_group_group_content {
 width:100%;
 height:50px;
 align-items:center;
 display:flex;
 flex-direction:row;
 justify-content:center;
 padding:9px 7px 11px
}
.modify_group_group_content:nth-child(2n) {
 background:#fbf8f8
}
.modify_group_group_content.first {
 min-width:165px;
 padding-left:20px;
 text-align:left;
 justify-content:flex-start
}
.modify_group_group_content1 {
 width:100%;
 display:flex;
 flex-direction:row;
 justify-content:center;
 padding:11px 12px 13px
}
.span_modify_group_group_content {
 font-size:14px;
 color:#253858;
 font-weight:500
}
.div_add_group_container {
 border-radius:18px;
 width:21%;
 margin-left:auto;
 align-items:center;
 cursor:pointer;
 background-color:#36b37e;
 padding:8px;
 justify-content:center;
 display:flex;
 flex-direction:row
}
.edit_profile_div_toolbar {
 display:flex;
 flex-direction:column;
 position:relative;
 align-items:center;
 padding-left:15px
}
.img_edit_profile {
 height:20px;
 width:20px;
 cursor:pointer
}
.sp12 {
 font-size:12px
}
.small_chat_container {
 display:flex;
 flex-direction:column;
 height:225px;
 margin-bottom:15px;
 width:100%;
 border-radius:4px;
 box-shadow:0 1px 6px 0 hsla(0,0%,85.9%,.5);
 background-color:#fefefe
}
.small_chat_container.cr_promotion {
 background:transparent;
 box-shadow:none;
 height:auto;
 cursor:pointer;
 margin-bottom:0
}
.small_chat_buttons {
 display:flex;
 flex-direction:row;
 margin-top:auto;
 padding-left:12px;
 padding-bottom:17px;
 padding-right:12px
}
.small_chat_ask_query_button {
 border-radius:4px;
 background-color:#36b37e;
 margin-right:12px
}
.small_chat_ask_query_button,
.small_chat_request_call {
 cursor:pointer;
 width:100%;
 box-shadow:0 1px 6px 0 hsla(0,0%,69.4%,.5);
 padding:10px;
 display:flex;
 flex-direction:row;
 align-items:center;
 justify-content:center
}
.small_chat_request_call {
 border-radius:4px;
 border:1px solid #36b37e;
 background-color:#fff
}
.span_ask_query {
 font-size:14px;
 font-weight:500;
 color:#fff;
 letter-spacing:-.2px
}
@media screen and (max-width:420px) {
 .span_ask_query {
  font-size:3.8vw
 }
}
.span_request_call {
 font-size:14px;
 font-weight:500;
 color:#36b37e;
 letter-spacing:-.2px
}
@media screen and (max-width:420px) {
 .span_request_call {
  font-size:3.8vw
 }
}
.small_chat_name_container {
 display:flex;
 flex-direction:column;
 justify-content:center;
 align-items:center;
 height:100%;
 padding:12px
}
.span_chat_name {
 font-size:14px;
 font-weight:500;
 letter-spacing:-.2px;
 color:#253858
}
.span_chat_sub_name {
 font-size:18px;
 letter-spacing:-.2px;
 color:#253858
}
.span_chat_sub_name.agent_sub_name {
 color:#253858
}
.small_chat_svg {
 width:15px;
 height:15px;
 margin-right:9px;
 margin-top:0
}
.advisor_svg {
 width:45px;
 height:45px;
 margin:10px
}
.small_chat_promo_container {
 width:100%;
 position:relative;
 height:225px
}
.small_chat_promo_container1 {
 width:105%;
 position:relative;
 top:-5px;
 left:-9px
}
.full_chat_container {
 display:flex;
 flex-direction:column;
 border-radius:10px;
 box-shadow:0 0 15px 0 rgba(0,0,0,.16);
 height:450px;
 margin-bottom:15px;
 width:100%;
 background-color:#fefefe
}
.iframe_container {
 height:93%;
 width:100%;
 -webkit-transition-timing-function:cubic-bezier(.7,0,.3,1);
 transition-timing-function:cubic-bezier(.7,0,.3,1);
 -webkit-transition:width .4s .1s,height .4s .1s,top .4s .1s,left .4s .1s,margin .4s .1s;
 transition:width .4s .1s,height .4s .1s,top .4s .1s,left .4s .1s,margin .4s .1s
}
.img_iframe_close {
 height:48px;
 display:flex;
 background:#fff;
 border-radius:10px 10px 0 0;
 padding:10px;
 align-items:center;
 position:relative
}
.img_iframe_close .chat_pop {
 right:8px!important;
 top:8px!important;
 border:none;
 position:absolute;
 width:32px;
 height:32px;
 background:#f4f5f7
}
.img_iframe_close .chat_pop:after,
.img_iframe_close .chat_pop:before {
 width:1px;
 height:15px
}
.advisor_chat {
 width:20px;
 height:20px;
 margin-left:10px;
 margin-right:10px
}
.img_arrow {
 background-image:url(data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTQiIGhlaWdodD0iNyIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cGF0aCBkPSJNMTIuMjczIDBMMTMgLjc1NSA3IDcgMSAuNzU1IDEuNzI0IDAgNyA1LjQ4N3oiIGZpbGw9IiM3RjgxODUiIHN0cm9rZT0iIzdGODE4NSIgZmlsbC1ydWxlPSJldmVub2RkIi8+PC9zdmc+);
 -webkit-appearance:none;
 -moz-appearance:none;
 background-position:100%;
 appearance:none;
 height:15px;
 width:15px;
 background-repeat:no-repeat
}
.div_cross_chat,
.img_arrow {
 margin:auto 0 auto auto
}
.small_chat_success_call {
 display:flex;
 flex-direction:column;
 justify-content:center;
 align-items:center;
 height:100%;
 padding:12px;
 background-color:#36b37e
}
.span_success_call {
 font-size:14px;
 color:#fff;
 font-weight:500
}
.call-me-fixed-quote {
 position:fixed;
 top:40%;
 right:-109px;
 transition:all .3s ease-in-out 0s;
 height:70px;
 z-index:9
}
.md-whiteframe-z1 {
 box-shadow:0 3px 1px -2px rgba(0,0,0,.14),0 2px 2px 0 rgba(0,0,0,.098),0 1px 5px 0 rgba(0,0,0,.084)
}
.call-me-fixed-quote button em.callback-icon {
 background:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFAAAAAtCAYAAAA5reyyAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyBpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMC1jMDYwIDYxLjEzNDc3NywgMjAxMC8wMi8xMi0xNzozMjowMCAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNSBXaW5kb3dzIiB4bXBNTTpJbnN0YW5jZUlEPSJ4bXAuaWlkOjU0RTA2MzRGMzk2OTExRTdCNEFBQzBCQTQ5M0Y0MDk2IiB4bXBNTTpEb2N1bWVudElEPSJ4bXAuZGlkOjU0RTA2MzUwMzk2OTExRTdCNEFBQzBCQTQ5M0Y0MDk2Ij4gPHhtcE1NOkRlcml2ZWRGcm9tIHN0UmVmOmluc3RhbmNlSUQ9InhtcC5paWQ6NTRFMDYzNEQzOTY5MTFFN0I0QUFDMEJBNDkzRjQwOTYiIHN0UmVmOmRvY3VtZW50SUQ9InhtcC5kaWQ6NTRFMDYzNEUzOTY5MTFFN0I0QUFDMEJBNDkzRjQwOTYiLz4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz4U6lglAAADJklEQVR42mL8//8/wyggHzCNBsFoAI4G4GgAjgbgKBgNwAECLLgkdB394WzOog2yej+uh4HYz5gEDz6eknGGFo65vH/j8AlAGHjvXhUVx3rZ+4ioWhSIzwrEKrnTLO9Mzjoxmv4IZGFQyjN20F96RAASeDDwT0r4uGzODJPR4MMTgKDAC2W93IFLnlVa8PRoIOIJQKf/V/PRUx46cOR+XQjK4szMzKMBiA6ui6kUE9IMCuB8A05vtvy1sqMBSCYABaLshxt+owFIAbi7sHrqaACSCc4euBg9WolgAeov7nQSbETevp8jsqdz2d+/f0d7IhjZ8jPzYwYJ/ClPcGfbstFmDA7wWEBjEz6Neqpyt0ab0XgC8HtfwGNQFsUlb8X5JhXU2B4NQDzgO5fASVxyp4VU00DNl5HciCYYgM+mZ5/Blwr/qCpOeeNSHjUagDgAqHYlVBaCeiIjuU9MsB0IKguZnr21xNcTAZWHd40yEgiZBcruwy3LM+KaF0YeUAUB86z24teySj24DLL5cGvZsW/Ck3GNE4JSqdS/9/ZCrP9Er/wVXoNtUHYoDqgS3ROZu+Pcc81Xd3rxpUTQOKFaUkc2eioDpU7QyA0oAm5KqJQPp6EwogNQ597qZZd+C68gpA5UsSjHt2Yjp7xGV2lX9KExUCAOh2YQ0VkYBkCelhT9+YiQwaAsfeI16zFQgOJT9/vpe1NYdh6KWZjkAIRVBvIty6i2qAZUSYHKzmFdBqI3b56/ZpczfXd7FjUcYcX1Nneo1s5kD2eBmjdte58cx1exEAtA5eNQHdWmaDxQ+dyMBfsYtSeKPr5XQqlDQBEyFAOQhRoeB3aYe9+7Vz2P0eI2ImYuBcMReLqLwzoFIgPQwOqkg4+vgAIDVAOTEni35lUM2SkBFmoZBKpYQFn61jkGhnVKoe+DHFiPWYj+tsI3NTrUA4/sZgyx4IpSaFSAt+M9Vab3AXxs/wVBQ2Cg1Pn2F9PzJde+nkMf0R4x7UCSA5LHMYzh2s2nOnLPjoLYpmn5x7FVGsMqAEcBnSuR0QAcBaMBOBqAowE4GoCjYDQA6QsAAgwARYFIbSDos68AAAAASUVORK5CYII=) no-repeat scroll 8px 14px;
 border-right:1px solid #172431;
 box-shadow:1px 0 0 #455a6d;
 float:left;
 height:69px;
 width:55px;
 font-size:18px
}
.call-me-fixed-quote button em {
 font-style:normal
}
.call-me-open {
 right:0!important
}
.call-me-fixed-quote button em.now {
 font-size:18px;
 display:block
}
.call-me-fixed-quote button span {
 float:left;
 width:100px;
 color:#5cc8f3;
 height:70px;
 font-size:12px;
 text-transform:uppercase;
 font-weight:700;
 letter-spacing:1px;
 font-style:normal;
 line-height:22px;
 padding-top:1em
}
.call-me-fixed-quote button {
 border-radius:4px;
 background:#005387;
 height:70px;
 border:none;
 cursor:pointer;
 text-shadow:1px 1px #0e3249
}
.greenChannelContainer {
 width:100%
}
.greenChannelBanner {
 background:#fff url(https://static.pbcdn.in/health-cdn/images/insurer-logo/quotes-logos/claimAssistanceBanner.svg) no-repeat right 0!important;
 border-radius:10px;
 margin:0 0 16px;
 display:flex;
 background-size:contain;
 box-shadow:0 2px 4px 0 rgba(0,0,0,.16)
}
.greenChannelBanner .textGreenBanner {
 padding:12px 0 10px 12px;
 width:220px;
 font-size:14px
}
.greenChannelBanner .textGreenBanner h4 {
 font-size:24px;
 font-weight:700;
 font-style:italic;
 color:#36b37e;
 margin-bottom:4px
}
.greenChannelBanner .textGreenBanner h4 span {
 display:block;
 font-size:18px;
 font-style:normal;
 color:#253858
}
.linkMoreGreen {
 color:#f8572f;
 font-size:14px;
 display:inline-block;
 margin-left:5px;
 cursor:pointer
}
.linkMoreGreen:after {
 content:"";
 border:solid #f8572f;
 border-width:0 1.5px 1.5px 0;
 display:inline-block;
 padding:2px;
 transform:rotate(-45deg);
 margin-left:3px;
 vertical-align:middle
}
.linkGreenWidget {
 color:#ff5630;
 font-size:14px;
 font-weight:600;
 display:inline-block;
 margin-left:5px;
 cursor:pointer
}
.linkGreenWidget:after {
 content:"";
 border:solid #ff5630;
 border-width:0 1px 1px 0;
 display:inline-block;
 padding:2px;
 transform:rotate(-45deg);
 margin-left:3px;
 vertical-align:middle
}
@media screen and (max-width:1023px) {
 .div_quotes_mobile_small_chat {
  bottom:0;
  height:100%;
  z-index:-800;
  position:fixed;
  width:100%;
  transition:all .3s ease-in
 }
 .advisor_chat {
  width:27px;
  height:20px;
  margin-left:0;
  margin-right:16px
 }
 .div_transparent_chat {
  height:100%;
  transition:opacity .3s ease-in;
  background:rgba(0,0,0,.8)
 }
 .div_quotes_mobile_small_chat[style="visibility: visible; height: 100%;"] .div_transparent_chat {
  opacity:1
 }
 .div_quotes_mobile_small_chat[style="visibility: visible; height: 0px;"] .div_transparent_chat {
  opacity:0
 }
 .div_quotes_iframe_container {
  background:#fff
 }
 .full_chat_mobile .div_iframe {
  height:222px;
  width:100%;
  position:fixed;
  border-top-left-radius:20px;
  border-top-right-radius:20px;
  bottom:-222px;
  transition:bottom .3s ease-in;
  overflow:hidden
 }
 .div_quotes_mobile_small_chat[style="visibility: visible;"] .div_iframe {
  bottom:0
 }
 .div_quotes_mobile.full_chat_mobile_small_chat[style="visibility: visible; "] .div_iframe {
  bottom:-222px
 }
 .iframe_container {
  height:100%;
  border-top-left-radius:10px;
  border-top-right-radius:10px
 }
 .span_chat_sub_name {
  font-size:18px;
  font-weight:300;
  color:#253858
 }
 .div_quotes_mobile_small_chat[style="visibility: visible;"] .full_chat_mobile {
  bottom:0;
  bottom:-100%
 }
 .img_iframe_close {
  background:#fff;
  height:48px;
  box-shadow:0 2px 4px rgba(0,0,0,.16);
  position:relative
 }
 .iframe_container_full {
  height:calc(100% - 48px);
  background:#fff
 }
 .iframe_container_full1 {
  height:100%
 }
 .chatShow {
  z-index:99999
 }
 .mask {
  background:rgba(0,0,0,.8);
  border-radius:0;
  opacity:0;
  height:100%;
  width:100%;
  transition:opacity .3s ease-in
 }
 .full_chat_mobile.div_iframe {
  transition:all .3s ease-in;
  position:absolute;
  bottom:-100%;
  width:100%;
  height:100%
 }
 .chatShow .mask {
  opacity:1
 }
 .chatShow .full_chat_mobile.div_iframe {
  bottom:0
 }
 .greenChannelContainer {
  background:#fff;
  margin-top:12px
 }
 .greenChannelContainer .greenChannelBanner {
  background-color:#ebf3ff;
  margin:16px;
  box-shadow:none;
  background-position:100% 0
 }
 .greenNoCompare {
  margin:12px -16px 0;
  width:calc(100% + 32px)
 }
 .claimSupportCard {
  background:none
 }
 .claimSupportCard .greenChannelBanner {
  margin:0 16px
 }
 .p0 .claimSupportCard {
  padding:0 16px
 }
}
.fullscreen_popup_desktop {
 background:#fff;
 z-index:101
}
.fullscreen_popup_desktop .fullscreen_popup_desktop_wrapper {
 width:100%;
 display:flex
}
.fullscreen_popup_desktop .fullscreen_popup_desktop_wrapper .fullscreen_popup_left_col {
 width:30%;
 height:100vh;
 background:#172b4d;
 padding:90px 40px 0 70px
}
.fullscreen_popup_desktop .fullscreen_popup_desktop_wrapper .fullscreen_popup_right_col {
 position:relative;
 width:70%
}
.fullscreen_popup_desktop .fullscreen_popup_desktop_wrapper .fullscreen_popup_right_col .div_features_popup_mobile {
 padding:0 70px 20px 0;
 margin-top:70px;
 overflow:auto;
 max-height:calc(100vh - 159px)
}
.fullscreen_popup_desktop .fullscreen_popup_desktop_wrapper * {
 letter-spacing:.016em
}
.feature_popup_top_bar {
 padding:0 18px 0 0
}
.div_feature_popup_supplier {
 width:140px;
 height:70px;
 background:#fff;
 border:1px solid #dfe1e6;
 border-radius:8px;
 padding:6px
}
.features_skeleton_loading {
 display:flex;
 flex-direction:column;
 width:100%;
 padding:20px
}
.features_popup_table1 {
 background:#fff;
 padding-left:32px;
 padding-top:16px
}
.features_popup_table1:after {
 content:"";
 display:block;
 clear:both
}
.features_popup_table1.skeleton {
 height:100vh
}
.span_feature_popup_heading {
 color:#253858;
 font-weight:700;
 font-size:16px
}
.tabs-feature ul {
 border:none!important
}
.features_popup_mobile {
 top:0;
 bottom:0;
 height:100%;
 z-index:999;
 position:fixed;
 width:100%;
 -webkit-transform:translateZ(0);
 background:#f4f5f7;
 line-height:21px
}
.cross_chat_popup {
 font-size:18px;
 color:#000;
 padding:0;
 width:16px;
 height:16px;
 margin-top:4px
}
.features_popup_top {
 width:100%;
 height:60px;
 position:static;
 background:#fff;
 display:flex;
 align-items:center;
 justify-content:flex-end
}
.cross_features_popup {
 position:relative;
 right:6px!important;
 top:6px!important
}
.compare_remove {
 font-size:12px;
 margin:0 0 0 auto;
 color:#7a869a
}
@media screen and (max-width:420px) {
 .compare_remove {
  font-size:3.2vw
 }
}
.div_feature_popup_cover {
 margin-top:28px
}
.feature_plan_name {
 display:-webkit-box;
 -webkit-box-orient:vertical;
 -webkit-line-clamp:2;
 overflow:hidden;
 height:fit-content;
 font-size:30px;
 font-weight:600;
 color:#fff
}
.feature_cover_premium {
 display:flex;
 position:relative;
 width:100%;
 border-top:1px solid #505f79;
 border-bottom:1px solid #505f79;
 padding:10px 0;
 margin-top:28px;
 justify-content:space-between
}
.feature_cover_premium .feature_block {
 font-size:24px;
 color:#fff;
 font-weight:600
}
.feature_cover_premium .feature_block em {
 font-size:20px;
 font-style:normal
}
.feature_cover_premium .feature_block p {
 font-size:14px;
 color:#fff;
 font-weight:400
}
.feature_cover_premium .feature_block p.annual {
 font-size:12px;
 color:#dfe1e6
}
.feature_cover_premium .feature_block .coverSelectBox {
 height:auto
}
.feature_cover_premium .feature_block .coverSelectBox:after {
 border-color:#fff;
 top:10px
}
.feature_cover_premium .feature_block .quotes_select {
 font-weight:600;
 color:#fff;
 font-size:24px
}
.coveredHead {
 color:#36b37e;
 margin:12px 0 0
}
.coveredHead,
.notCoveredHead {
 font-size:18px;
 font-weight:700;
 padding:0
}
.notCoveredHead {
 color:#de350b;
 margin:22px 0 0
}
.shortlistRow {
 margin-top:18px;
 display:flex;
 justify-content:space-between
}
.shortlistRow .claimSettlement {
 font-size:24px;
 color:#fff;
 font-weight:600
}
.shortlistRow .claimSettlement p {
 font-size:14px;
 font-weight:400
}
.shortlistRow .shortlist {
 width:90px;
 text-align:center
}
.shortlistRow .shortlist>p {
 width:48px;
 height:48px;
 background:transparent;
 border-radius:50%;
 margin:0 auto;
 display:flex;
 align-items:center;
 justify-content:center;
 cursor:pointer;
 transition:all .3s ease-in
}
.shortlistRow .shortlist>p:before {
 content:"";
 display:inline-block;
 width:14px;
 height:18px;
 background:url(https://static.pbcdn.in/health-cdn/images/insurer-logo/quotes-logos/shortlist.svg) no-repeat -5px -3px
}
.shortlistRow .shortlist.shortlisted>p:before {
 background:url(https://static.pbcdn.in/health-cdn/images/insurer-logo/quotes-logos/shortlist_selected.svg) no-repeat -5px -3px
}
.shortlistRow .shortlist.shortlisted>span:before {
 content:"Remove shortlist";
 white-space:nowrap
}
.shortlistRow .shortlist>span {
 font-size:12px;
 font-weight:600;
 color:#fff;
 display:block;
 margin-top:5px
}
.shortlistRow .shortlist>span:before {
 content:"Add to shortlist";
 display:block;
 visibility:hidden;
 opacity:0;
 transition:all .3s ease-in;
 white-space:nowrap
}
.shortlistRow .shortlist>p {
 background:#505f79
}
.shortlistRow .shortlist>p+span:before {
 visibility:visible;
 opacity:1
}
.accordionSection_features {
 position:relative;
 z-index:2
}
.accordionSection_features input[type=checkbox] {
 position:absolute;
 opacity:0;
 z-index:-1
}
.accordionSection_features label {
 width:100%;
 display:block;
 font-size:14px;
 font-weight:400;
 color:#253858;
 cursor:pointer;
 position:relative
}
@media screen and (max-width:420px) {
 .accordionSection_features label {
  font-size:3.8vw
 }
}
.accordionSection_features label:after {
 content:"";
 border:solid #253858;
 border-width:0 2px 2px 0;
 display:inline-block;
 padding:3px;
 transform:rotate(45deg);
 vertical-align:middle;
 position:absolute;
 right:0;
 top:50%;
 transition:all .3s ease-in;
 margin-top:-6px;
 transform-origin:center center
}
.accordionSection_features .accordionContent {
 max-height:0;
 transition:all .35s;
 opacity:0;
 display:none
}
.accordionSection_features input[type=checkbox]:checked+label {
 font-weight:700
}
.accordionSection_features input[type=checkbox]:checked+label:after {
 transform:rotate(-135deg);
 margin-top:-2px
}
.accordionSection_features input[type=checkbox]:checked~.accordionContent {
 max-height:100%;
 opacity:1;
 display:block;
 margin-bottom:10px
}
.multi_faq .accordionSection_features {
 background:#f4f5f7;
 border-radius:8px;
 margin-bottom:8px
}
.multi_faq .accordionSection_features:last-child {
 margin-bottom:0
}
.multi_faq .accordionSection_features label {
 padding:16px 30px 16px 12px
}
.multi_faq .accordionSection_features label:after {
 right:14px
}
.multi_faq .accordionSection_features .accordionContent {
 padding:0 12px 16px;
 font-size:14px;
 color:#505f79;
 margin-bottom:0!important;
 margin-top:-10px
}
@media screen and (max-width:420px) {
 .multi_faq .accordionSection_features .accordionContent {
  font-size:3.8vw
 }
}
.multi_faq .viewAll {
 font-size:14px;
 color:#ff5630;
 font-weight:600;
 margin-top:8px;
 text-align:right;
 cursor:pointer
}
@media screen and (max-width:420px) {
 .multi_faq .viewAll {
  font-size:3.8vw
 }
}
.notCoveredFeatureWrapper {
 width:100%;
 position:relative;
 top:-6px
}
.notCoveredFeatureWrapper .featureRecommend {
 width:calc(100% - 66px);
 float:right;
 background:#e6fcff;
 padding:5px 0 10px;
 line-height:18px
}
.notCoveredFeatureWrapper .featureRecommend .featureRecommendTitle {
 font-size:14px;
 font-weight:700;
 margin:16px 0 0 16px
}
@media screen and (max-width:420px) {
 .notCoveredFeatureWrapper .featureRecommend .featureRecommendTitle {
  font-size:3.8vw
 }
}
.notCoveredFeatureWrapper .featureRecommend .featureRecommendTitle span {
 font-size:14px;
 font-weight:400;
 display:block
}
@media screen and (max-width:420px) {
 .notCoveredFeatureWrapper .featureRecommend .featureRecommendTitle span {
  font-size:3.8vw
 }
}
.notCoveredFeatureWrapper .featureRecommend .box-mob-slider1 {
 margin-top:12px
}
.notCoveredFeatureWrapper .featureRecommend .box-mob-slider1 .slider-new {
 padding:10px 16px
}
.notCoveredFeatureWrapper .featureRecommend .clickToRecommend {
 text-align:center;
 font-size:14px;
 font-weight:700;
 background:#e6fcff;
 padding:0 16px;
 cursor:pointer
}
@media screen and (max-width:420px) {
 .notCoveredFeatureWrapper .featureRecommend .clickToRecommend {
  font-size:3.8vw
 }
}
.notCoveredFeatureWrapper .featureRecommend .clickToRecommend a {
 text-transform:uppercase;
 margin-left:5px;
 font-weight:700;
 color:#ff5630;
 display:block;
 margin-top:4px
}
.notCoveredFeatureWrapper .featureRecommend .clickToRecommend a:after {
 content:"";
 border:solid #ff5630;
 border-width:0 1.5px 1.5px 0;
 display:inline-block;
 padding:2px;
 transform:rotate(45deg);
 margin-left:5px;
 vertical-align:middle;
 position:relative;
 top:-2px
}
.notCoveredFeatureWrapper .featureRecommend .clickToRecommend.show_less a:after {
 transform:rotate(-135deg);
 top:2px
}
.notCoveredFeatureWrapper:after {
 content:"";
 display:block;
 clear:both
}
.noPlans {
 text-align:center;
 margin:16px auto 6px
}
.noPlans,
.noPlans span {
 font-size:14px;
 font-weight:500
}
.noPlans span {
 background:#fff;
 border-radius:4px;
 box-shadow:0 0 3px rgba(0,0,0,.16);
 padding:16px;
 display:inline-block
}
.similarBtmRow {
 overflow:hidden;
 float:left;
 width:100%;
 text-align:center
}
.similarBtmRow .infoBox {
 font-size:18px;
 font-weight:500;
 color:#253858;
 float:left
}
.similarBtmRow .infoBox span {
 display:block;
 font-size:12px;
 color:#7a869a;
 font-weight:400
}
.slider-new1 .similar_plan_ul1 {
 width:100%;
 float:left;
 padding:0;
 list-style:none;
 margin-top:0
}
.slider-new1 .similar_plan_ul1 li {
 width:100%;
 float:left;
 background:#fff;
 border-radius:8px;
 padding:16px 12px;
 box-shadow:0 0 4px rgba(0,0,0,.16)
}
.slider-new1 .similar_plan_ul1 li:nth-child(2) {
 margin:0 2%;
 cursor:pointer
}
.slider-new1 .similar_plans {
 padding:30px 30px 20px;
 width:100%;
 float:left;
 background-color:#f4f5f7
}
.slider-new1 .similar_plans h3 {
 font-size:16px;
 color:#253858;
 font-weight:600
}
.slider-new1 .similar_plans h4 {
 font-size:14px;
 color:#253858;
 font-weight:600
}
.slider-new1 .similar_plan_ul1 span {
 display:block;
 font-size:16px;
 font-weight:400;
 text-overflow:ellipsis;
 overflow:hidden
}
.slider-new1 .similar_plan_ul1 p {
 background-color:#f7f7f7;
 min-height:38px;
 font-size:16px;
 color:#253858;
 font-weight:600;
 line-height:38px
}
.slider-new1 .similar_plan_ul1 ul {
 width:100%;
 float:left;
 border-bottom:1px solid #dfe1e6;
 border-top:1px solid #dfe1e6;
 padding:8px 0;
 margin:16px 0
}
.slider-new1 .similar_plan_ul1 ul li {
 width:40%;
 float:left;
 font-size:18px;
 font-weight:500;
 color:#253858;
 min-height:auto;
 margin:0!important;
 border-radius:0;
 box-shadow:none;
 padding:0;
 line-height:28px
}
.slider-new1 .similar_plan_ul1 ul li span {
 display:block;
 font-size:12px;
 color:#7a869a;
 font-weight:400;
 line-height:14px
}
.slider-new1 .similar_plan_ul1 ul li em {
 font-style:normal
}
.slider-new1 .similarBtmRow {
 overflow:hidden;
 float:left;
 width:100%;
 text-align:center
}
.slider-new1 .similarBtmRow .infoBox {
 font-size:18px;
 font-weight:500;
 color:#253858;
 float:left
}
.slider-new1 .similarBtmRow .infoBox span {
 display:block;
 font-size:12px;
 color:#7a869a;
 font-weight:400
}
.slider-new1 .similar_plan_ul1 h6 {
 font-size:15px;
 font-weight:600;
 color:#253858
}
.slider-new1 .similar_plan_ul1 button {
 width:140px;
 height:42px;
 font-size:14px;
 font-weight:500;
 border-radius:4px;
 background-color:#fff;
 border:1px solid #ff5630!important;
 color:#ff5630!important
}
@media screen and (max-width:420px) {
 .slider-new1 .similar_plan_ul1 button {
  font-size:3.8vw
 }
}
.slider-new1 .similar_plan_ul1 button.disabled {
 background-color:#fff;
 border:1px solid #cacaca!important;
 color:#cacaca!important;
 cursor:not-allowed
}
.slider-new1 .similar_plan_ul1 button .fa-plus {
 position:relative;
 left:-10px;
 top:-1px
}
.slider-new1 .box_block {
 height:auto!important
}
.feature_popup_bottom {
 height:76px;
 width:100%;
 box-shadow:3px -3px 6px rgba(0,0,0,.16);
 background:#fff;
 z-index:9;
 padding-right:70px;
 position:relative
}
.feature_popup_bottom .feature_popup_button {
 float:right;
 margin-top:21px
}
.bottom_fix_feature {
 position:absolute!important;
 bottom:0;
 height:86px!important;
 background:#fff
}
.feature_apply_button {
 height:48px;
 background:#ff5630;
 color:#fff;
 padding:0 40px;
 display:inline-block;
 border-radius:4px;
 font-size:14px;
 font-weight:600;
 line-height:48px;
 cursor:pointer
}
@media screen and (max-width:420px) {
 .feature_apply_button {
  font-size:3.8vw
 }
}
.feature_close_button {
 height:48px;
 background:#fff;
 color:#ff5630;
 padding:0 40px;
 display:inline-block;
 border-radius:4px;
 font-size:14px;
 font-weight:600;
 line-height:48px;
 cursor:pointer
}
.tabs-feature {
 width:100%;
 margin:0!important;
 background:#fff;
 -ms-overflow-style:none;
 scrollbar-width:none;
 box-shadow:none!important;
 border-bottom:1px solid #97a0af!important;
 padding:0 0 0 30px!important
}
.tabs-feature::-webkit-scrollbar {
 display:none
}
.tabs-feature ul {
 width:100%;
 display:block
}
.tabs-feature ul li {
 padding:0;
 width:100%;
 font-size:16px;
 width:auto;
 display:inline-block;
 margin-right:47px
}
.tabs-feature ul li:last-child {
 margin-right:0
}
.tabs-feature ul li:before {
 content:none!important
}
.tabs-feature ul li a {
 padding:15px 16px;
 color:#253858;
 border-bottom:4px solid transparent
}
.tabs-feature ul li a:hover {
 border-bottom-color:#fff;
 color:#253858
}
.tabs-feature ul li.is-active a {
 color:#253858!important;
 font-weight:700;
 border-bottom:4px solid #253858!important
}
.div_features_covered_inside,
.div_features_covered_main {
 flex-direction:row;
 display:flex;
 width:100%;
 flex-wrap:wrap;
 padding:0;
 border:none!important
}
.features_icons {
 width:48px;
 padding:16px 0
}
.feature-icon1 {
 display:flex;
 justify-content:center;
 align-items:center;
 background-color:#deebff;
 width:48px;
 height:48px;
 border-radius:50%;
 text-align:center;
 margin:0 auto
}
.feature-icon1 img {
 padding:0
}
.feature-icon1.fiveStarPartnerIcon {
 background-color:#fff7d9
}
.feature-icon1.fiveStarPartnerIcon img {
 width:32px;
 height:auto
}
.span_claim_percentage {
 font-size:14px;
 font-weight:700;
 color:#253858
}
.div_features_covered_border {
 width:calc(100% - 66px);
 border-bottom:1px solid #b3bac5;
 padding:16px 40px 16px 0;
 position:relative;
 line-height:24px;
 margin-left:18px
}
.div_features_covered_border:after {
 content:"";
 border:solid #253858;
 border-width:0 2px 2px 0;
 display:inline-block;
 padding:3px;
 transform:rotate(45deg);
 position:absolute;
 right:16px;
 transition:all .3s ease-in;
 top:50%;
 margin-top:-5px
}
.div_features_covered_border.expanded:after {
 transform:rotate(-135deg);
 margin-top:-2px
}
.div_features_covered_border.noArrow {
 width:100%;
 margin-left:0;
 border-bottom:none
}
.div_features_covered_border.noArrow:after,
.div_features_covered_border.noArrowMain:after {
 content:none
}
.span_feature_popup_sub_heading {
 color:#505f79;
 font-weight:400;
 font-size:16px;
 opacity:1
}
.span_feature_popup_sub_heading.protip {
 color:#00c7e6
}
.div_features_covered_main:last-child .claim_popup_white,
.div_features_covered_main:last-child .div_features_covered_border {
 border:none
}
.widgetsCard {
 padding-left:32px;
 margin-top:60px
}
.portabilityWidgetsCard {
 padding-left:32px;
 margin-top:24px
}
.widgetHead {
 font-size:24px;
 font-weight:700;
 color:#253858;
 margin-bottom:20px
}
@media screen and (max-width:1023px) {
 .head_box_city {
  padding:6px 16px 0
 }
}
.head_box_city .topText {
 font-size:24px;
 font-weight:700
}
@media screen and (max-width:1023px) {
 .head_box_city .topText {
  font-size:16px
 }
}
@media screen and (max-width:1023px) and (max-width:420px) {
 .head_box_city .topText {
  font-size:4.5vw
 }
}
.head_box_city p {
 font-size:16px;
 padding:8px 0 0
}
@media screen and (max-width:1023px) {
 .head_box_city p {
  font-size:14px
 }
}
@media screen and (max-width:1023px) and (max-width:420px) {
 .head_box_city p {
  font-size:3.8vw
 }
}
.selectCashlessBox {
 width:100%;
 margin:24px 0;
 position:relative
}
.selectCashlessBox .mainBoxCity {
 display:flex
}
@media screen and (max-width:1023px) {
 .selectCashlessBox .mainBoxCity {
  margin:0 16px;
  flex-direction:column
 }
}
.selectCashlessBox .mainBoxCity .selctCityArea {
 position:relative;
 width:270px
}
@media screen and (max-width:1023px) {
 .selectCashlessBox .mainBoxCity .selctCityArea {
  width:100%
 }
}
.selectCashlessBox .mainBoxCity .selctCityArea .selectCity {
 width:100%;
 height:56px;
 border-radius:8px 0 0 8px;
 border:1px solid #36b37e;
 font-size:16px;
 font-weight:600;
 color:#36b37e;
 padding:0 0 0 16px;
 outline:none;
 -webkit-appearance:none;
 background:#f2fcf8
}
@media screen and (max-width:420px) {
 .selectCashlessBox .mainBoxCity .selctCityArea .selectCity {
  font-size:4.5vw
 }
}
@media screen and (max-width:1023px) {
 .selectCashlessBox .mainBoxCity .selctCityArea .selectCity {
  border-radius:8px 8px 0 0;
  font-size:14px;
  height:50px;
  line-height:50px
 }
}
@media screen and (max-width:1023px) and (max-width:420px) {
 .selectCashlessBox .mainBoxCity .selctCityArea .selectCity {
  font-size:3.8vw
 }
}
.selectCashlessBox .mainBoxCity .selctCityArea .selectCity .selectedCity {
 margin:15px 26px 15px 7px
}
.selectCashlessBox .mainBoxCity .selctCityArea:after {
 content:"";
 border:solid #36b37e;
 border-width:0 2px 2px 0;
 display:inline-block;
 padding:4px;
 -webkit-transform:rotate(45deg) translateY(-50%);
 transform:rotate(45deg) translateY(-50%);
 position:absolute;
 right:18px;
 top:50%;
 margin-top:-3px;
 transition:all .3s ease-in
}
.selectCashlessBox .mainBoxCity .noHospitalfound:after {
 -webkit-transform:rotate(-136deg) translateY(-50%);
 transform:rotate(-136deg) translateY(-50%);
 margin-top:-5px;
 right:14px
}
.searchNoFound {
 display:flex;
 flex-direction:column;
 margin:60px 0 0;
 align-items:center
}
@media screen and (max-width:1023px) {
 .searchNoFound {
  margin:40px 0 0
 }
}
.searchNoFound .iconHospital {
 background:url(https://static.pbcdn.in/health-cdn/images/insurer-logo/quotes-logos/hospital-cash.svg) no-repeat 0 0;
 width:114px;
 height:96px
}
.searchNoFound p {
 font-size:16px;
 font-weight:600;
 margin:24px 0 20px;
 text-align:center
}
@media screen and (max-width:420px) {
 .searchNoFound p {
  font-size:4.5vw
 }
}
@media screen and (max-width:1023px) {
 .searchNoFound p {
  margin:20px 32px 0;
  line-height:26px
 }
 .searchNoFound p br {
  display:none
 }
}
.process_listing_tabs {
 margin:0 0 30px;
 height:38px
}
.process_listing_tabs li {
 border:1px solid #253858;
 font-size:14px;
 font-weight:600;
 padding:0 54px;
 height:38px;
 display:inline-flex;
 margin:0 16px 0 0;
 align-items:center;
 border-radius:40px;
 cursor:pointer
}
@media screen and (max-width:420px) {
 .process_listing_tabs li {
  font-size:3.8vw
 }
}
.process_listing_tabs li:last-child {
 margin:0
}
.process_listing_tabs li.active {
 cursor:inherit;
 border:1px solid #36b37e;
 color:#36b37e;
 font-weight:700
}
.steps_claim_process {
 margin:8px 16px
}
.steps_claim_process li {
 margin:0;
 font-size:16px;
 padding:0 0 30px 74px;
 position:relative
}
.steps_claim_process li:last-child {
 padding:0 0 0 74px
}
.steps_claim_process li:last-child:before {
 display:none
}
.steps_claim_process li:before {
 width:1px;
 height:100%;
 background-color:#b3bac5;
 content:"";
 position:absolute;
 top:7px;
 left:25px
}
.steps_claim_process li:after {
 width:48px;
 height:48px;
 background-color:#deebff;
 border-radius:30px;
 content:"";
 position:absolute;
 top:0;
 left:0;
 background-position:0 0;
 background-repeat:no-repeat;
 background-image:url(https://static.pbcdn.in/health-cdn/images/insurer-logo/quotes-logos/claim_steps_icons.svg)
}
.steps_claim_process li a {
 word-break:break-all
}
.steps_claim_process li h3 {
 font-size:18px;
 font-weight:700;
 margin:0 0 8px;
 padding:0
}
.steps_claim_process li ul {
 margin:12px 0 0
}
.steps_claim_process li ul li {
 list-style-type:disc;
 margin:0 0 16px 20px;
 padding:0 0 0 12px
}
.steps_claim_process li ul li:after,
.steps_claim_process li ul li:before {
 display:none
}
.steps_claim_process li ul li:last-child {
 margin-bottom:0;
 padding-left:12px
}
.steps_claim_process li:first-child:after {
 background-image:url(https://static.pbcdn.in/health-cdn/images/insurer-logo/quotes-logos/feature27.svg);
 background-position:50%
}
.steps_claim_process li:nth-child(2):after {
 background-position:12px 15px
}
.steps_claim_process li:nth-child(3):after {
 background-position:12px -51px
}
.steps_claim_process li:nth-child(4):after {
 background-position:12px -130px
}
.steps_claim_process li:nth-child(5):after {
 background-position:12px -200px
}
.steps_claim_process .link_claim {
 color:#ff5630;
 font-weight:400
}
.steps_claim_process p {
 margin:30px 0 0
}
.steps_claim_process .claim_address {
 margin:0;
 font-style:italic;
 color:#505f79
}
.steps_claim_process .claim_address p {
 margin:0
}
.steps_claim_process .link_claim_box {
 font-size:14px;
 margin-left:34px
}
@media screen and (max-width:420px) {
 .steps_claim_process .link_claim_box {
  font-size:3.8vw
 }
}
.steps_claim_process .link_claim_box a {
 font-size:14px
}
@media screen and (max-width:420px) {
 .steps_claim_process .link_claim_box a {
  font-size:3.8vw
 }
}
.steps_claim_process .link_claim_box span {
 margin:0 16px
}
.steps_claim_process .claim_advantage_widget {
 display:flex;
 color:#253858
}
.steps_claim_process .claim_advantage_widget div {
 flex:1 1 50%;
 display:inline-flex;
 flex-direction:column
}
.steps_claim_process .claim_advantage_widget h4 {
 font-size:16px;
 font-weight:700
}
@media screen and (max-width:420px) {
 .steps_claim_process .claim_advantage_widget h4 {
  font-size:4.5vw
 }
}
.steps_claim_process .claim_advantage_widget p {
 font-size:14px;
 line-height:1.5;
 margin:0
}
@media screen and (max-width:420px) {
 .steps_claim_process .claim_advantage_widget p {
  font-size:3.8vw
 }
}
.steps_claim_process .claim_advantage_widget ul li {
 list-style-type:none!important;
 background:url(https://static.pbcdn.in/health-cdn/images/insurer-logo/quotes-logos/claim_steps_icons.svg) no-repeat 0 -360px;
 font-size:14px;
 font-weight:700;
 padding:0 0 0 38px!important;
 margin:0 0 6px 20px!important;
 display:flex;
 align-items:center;
 color:#253858
}
@media screen and (max-width:420px) {
 .steps_claim_process .claim_advantage_widget ul li {
  font-size:3.8vw
 }
}
.steps_claim_process .claim_advantage_widget ul li:last-child {
 margin:0 0 0 20px!important;
 background:url(https://static.pbcdn.in/health-cdn/images/insurer-logo/quotes-logos/claim_steps_icons.svg) no-repeat 0 -430px
}
.reimbursement_process li:first-child:after {
 background-position:12px 15px;
 background-image:url(https://static.pbcdn.in/health-cdn/images/insurer-logo/quotes-logos/claim_steps_icons.svg)
}
.reimbursement_process li:nth-child(2):after {
 background-position:12px -277px
}
.reimbursement_process li:nth-child(3):after {
 background-position:12px -199px
}
.searchCityBoxWrapper {
 position:absolute;
 left:0;
 width:100%;
 border-radius:8px;
 box-shadow:0 6px 16px rgba(0,0,0,.16);
 background-color:#fff;
 padding:16px;
 top:73px;
 z-index:9;
 display:none
}
@media screen and (max-width:1023px) {
 .searchCityBoxWrapper {
  position:fixed;
  left:0;
  width:100%;
  border-radius:0;
  box-shadow:none;
  background-color:#fff;
  top:0;
  z-index:9999;
  height:100vh;
  padding:60px 16px 16px;
  display:none;
  -webkit-transform:translateZ(0)
 }
}
.searchCityBoxWrapper:after {
 content:"";
 position:absolute;
 top:-14px;
 left:70px;
 width:0;
 height:0;
 border-left:14px solid transparent;
 border-right:14px solid transparent;
 border-bottom:14px solid #fff
}
.searchCityBoxWrapper .input_enter_city {
 position:relative
}
.searchCityBoxWrapper label {
 position:absolute;
 left:8px;
 padding:0 8px;
 background:#fff;
 -webkit-transform:translateY(-50%);
 transform:translateY(-50%);
 -webkit-transition:all .3s ease-in;
 transition:all .3s ease-in;
 top:50%
}
.searchCityBoxWrapper .input_city_cash {
 width:100%;
 -webkit-appearance:none;
 outline:none;
 height:100%;
 font-size:16px;
 padding:16px;
 border-radius:8px;
 background:#fff;
 border:1px solid #172b4d;
 height:56px;
 transition:all .3s ease-in
}
@media screen and (max-width:420px) {
 .searchCityBoxWrapper .input_city_cash {
  font-size:4.5vw
 }
}
.searchCityBoxWrapper .input_city_cash.valid+label,
.searchCityBoxWrapper .input_city_cash:focus+label,
.searchCityBoxWrapper .input_city_cash:valid+label {
 font-size:12px;
 -webkit-transform:none;
 transform:none;
 top:-10px;
 color:#5e6c84
}
.searchCityBoxWrapper .popularCity h2 {
 font-size:16px;
 font-weight:700;
 margin-top:24px
}
@media screen and (max-width:420px) {
 .searchCityBoxWrapper .popularCity h2 {
  font-size:4.5vw
 }
}
.searchCityBoxWrapper .list-city {
 margin:10px 0 0;
 padding:0;
 list-style:none;
 border-radius:8px;
 border:1px solid #dfe1e6;
 background-color:#fff;
 max-height:216px;
 overflow-x:auto
}
@media screen and (max-width:1023px) {
 .searchCityBoxWrapper .list-city {
  max-height:calc(100vh - 208px);
  overflow-x:auto
 }
}
.searchCityBoxWrapper .list-city li {
 padding:16px;
 border-bottom:1px solid #dfe1e6;
 font-size:14px;
 font-weight:600;
 cursor:pointer
}
@media screen and (max-width:420px) {
 .searchCityBoxWrapper .list-city li {
  font-size:3.8vw
 }
}
.searchCityBoxWrapper .list-city li:last-child {
 border-bottom:none
}
.searchCityBoxWrapper .searchBoxListing {
 max-height:216px;
 overflow-x:auto
}
@media screen and (max-width:1023px) {
 .searchCityBoxWrapper .searchBoxListing {
  max-height:calc(100vh - 158px);
  overflow-x:auto
 }
}
.claim_protip {
 color:#00c7e6;
 font-size:16px;
 padding:10px 16px!important;
 margin-top:30px!important
}
@media screen and (max-width:420px) {
 .claim_protip {
  font-size:4.5vw
 }
}
.claim_protip strong {
 color:#00c7e6
}
.advatange_claim_sp {
 margin:60px 16px 0!important
}
.arClaim:after {
 content:"";
 border:solid #ff5630;
 border-width:0 2px 2px 0;
 display:inline-block;
 padding:2.5px;
 transform:rotate(-45deg);
 margin-left:3px;
 vertical-align:middle;
 position:relative
}
.claim_why_buy {
 margin:24px 0 0
}
.claim_why_buy .link {
 color:#ff5630;
 cursor:pointer
}
.claim_why_buy p {
 margin-top:10px;
 padding-left:30px
}
@media only screen and (max-width:1023px) {
 .claim_why_buy p {
  padding-left:12px
 }
}
.claim_why_buy .bold {
 font-weight:700
}
.claim_why_buy .med {
 font-weight:600
}
.claim_why_buy .label_cl {
 border:1px solid #79e2f2;
 background:#fff;
 padding:5px 16px;
 font-size:16px;
 font-weight:700;
 border-radius:8px;
 display:inline-block;
 position:absolute;
 top:-21px
}
@media screen and (max-width:420px) {
 .claim_why_buy .label_cl {
  font-size:4.5vw
 }
}
.claim_why_buy .claimInnerBuy {
 display:flex
}
.claim_why_buy .claimInnerBuy .img_buy {
 background:url(https://static.pbcdn.in/health-cdn/images/insurer-logo/quotes-logos/sprite_green_why.png) no-repeat 0 -600px;
 min-width:80px;
 height:80px;
 display:block;
 background-size:cover;
 margin-top:5px
}
.claim_why_buy .claimInnerBuy h3 {
 font-size:16px;
 font-weight:700;
 margin-left:12px
}
@media screen and (max-width:420px) {
 .claim_why_buy .claimInnerBuy h3 {
  font-size:4.5vw
 }
}
@media screen and (max-width:1023px) {
 .claim_why_buy .claimInnerBuy h3 {
  font-size:14px;
  padding:0
 }
}
@media screen and (max-width:1023px) and (max-width:420px) {
 .claim_why_buy .claimInnerBuy h3 {
  font-size:3.8vw
 }
}
.claim_why_buy .claimInnerBuy ul {
 margin:7px 0 0 30px
}
@media screen and (max-width:1023px) {
 .claim_why_buy .claimInnerBuy ul {
  margin:36px 0 0 -80px
 }
}
.claim_why_buy .claimInnerBuy ul li {
 font-size:16px;
 margin-bottom:12px;
 display:flex
}
@media screen and (max-width:420px) {
 .claim_why_buy .claimInnerBuy ul li {
  font-size:4.5vw
 }
}
.claim_why_buy .claimInnerBuy ul li:before {
 content:"-";
 margin-right:12px
}
@media screen and (max-width:1023px) {
 .claim_why_buy .claimInnerBuy ul li {
  font-size:14px
 }
}
@media screen and (max-width:1023px) and (max-width:420px) {
 .claim_why_buy .claimInnerBuy ul li {
  font-size:3.8vw
 }
}
.head_box_claim.remb_box {
 margin-top:64px
}
.head_box_claim .topText {
 font-size:24px
}
@media screen and (max-width:1023px) {
 .head_box_claim .topText {
  font-size:16px
 }
}
@media screen and (max-width:1023px) and (max-width:420px) {
 .head_box_claim .topText {
  font-size:4.5vw
 }
}
.head_box_claim p {
 font-size:16px;
 padding:8px 16px 16px
}
@media screen and (max-width:420px) {
 .head_box_claim p {
  font-size:4.5vw
 }
}
@media screen and (max-width:1023px) {
 .head_box_claim p {
  font-size:14px;
  padding-top:4px
 }
}
@media screen and (max-width:1023px) and (max-width:420px) {
 .head_box_claim p {
  font-size:3.8vw
 }
}
@media screen and (max-width:1023px) {
 .tabs-feature {
  margin-top:-20px!important;
  padding:0!important
 }
 .tabs-feature ul {
  display:flex
 }
 .tabs-feature ul li {
  font-size:14px;
  margin-right:0
 }
}
@media screen and (max-width:1023px) and (max-width:420px) {
 .tabs-feature ul li {
  font-size:3.8vw
 }
}
@media screen and (max-width:1023px) {
 .tabs-feature ul li a {
  padding:15px 16px 16px
 }
 .features_popup_table1 {
  padding-top:10px;
  padding-left:0
 }
 .features_popup_table1.whyPolicyFeature {
  padding:16px
 }
 .features_icons {
  width:70px
 }
 .feature-icon1 {
  width:42px;
  height:42px
 }
 .div_feature_plan_name {
  padding-right:20px;
  display:flex;
  height:52px;
  align-items:center
 }
 .div_feature_plan_name .feature_plan_name {
  font-size:16px;
  color:#253858;
  font-weight:700
 }
}
@media screen and (max-width:1023px) and (max-width:420px) {
 .div_feature_plan_name .feature_plan_name {
  font-size:4.5vw
 }
}
@media screen and (max-width:1023px) {
 .div_features_covered_border {
  width:calc(100% - 70px);
  margin-left:0;
  line-height:21px
 }
 .div_features_covered_border:after {
  transform:rotate(-45deg) translateY(-50%)
 }
 .feature_cover_premium {
  border:none;
  padding:0;
  margin:0;
  justify-content:normal
 }
 .feature_cover_premium .feature_block {
  font-size:16px;
  color:#253858
 }
}
@media screen and (max-width:1023px) and (max-width:420px) {
 .feature_cover_premium .feature_block {
  font-size:4.5vw
 }
}
@media screen and (max-width:1023px) {
 .feature_cover_premium .feature_block em {
  font-size:14px;
  font-style:normal
 }
}
@media screen and (max-width:1023px) and (max-width:420px) {
 .feature_cover_premium .feature_block em {
  font-size:3.8vw
 }
}
@media screen and (max-width:1023px) {
 .feature_cover_premium .feature_block:first-child {
  margin-right:30px
 }
 .feature_cover_premium .feature_block p {
  font-size:12px;
  color:#7a869a
 }
}
@media screen and (max-width:1023px) and (max-width:420px) {
 .feature_cover_premium .feature_block p {
  font-size:3.2vw
 }
}
@media screen and (max-width:1023px) {
 .feature_cover_premium .feature_block p.annual {
  color:#505f79
 }
 .feature_cover_premium .feature_block .coverSelectBox:after {
  border-color:#253858;
  top:6px
 }
 .feature_cover_premium .feature_block .quotes_select {
  font-weight:400;
  color:#253858;
  font-size:16px
 }
}
@media screen and (max-width:1023px) and (max-width:420px) {
 .feature_cover_premium .feature_block .quotes_select {
  font-size:4.5vw
 }
}
@media screen and (max-width:1023px) {
 .span_claim_percentage {
  font-size:12px
 }
}
@media screen and (max-width:1023px) and (max-width:420px) {
 .span_claim_percentage {
  font-size:3.2vw
 }
}
@media screen and (max-width:1023px) {
 .features_popup_top {
  width:36px;
  height:36px;
  position:absolute;
  right:8px;
  top:8px
 }
 .feature_card {
  background:#fff
 }
 .top_features_popup {
  box-shadow:0 3px 2px 0 rgba(0,0,0,.1);
  background:#fff;
  position:sticky;
  position:-webkit-sticky;
  top:0;
  z-index:99
 }
 .feature_popup_top_bar {
  padding:8px 16px;
  display:flex;
  flex-direction:row
 }
 .feature_popup_bottom {
  height:72px;
  position:static;
  box-shadow:none
 }
 .div_feature_popup_cover {
  flex-direction:column;
  width:calc(100% - 72px)!important;
  align-items:flex-start;
  padding:0 20px 0 11px;
  margin:0
 }
 .span_cover_mobile {
  font-size:12px;
  font-weight:500;
  color:#b0b0b0;
  padding:0 0 0 20px;
  width:100%
 }
 .span_cover_content_mobile {
  font-weight:500;
  color:#253858;
  font-size:14px;
  width:100%;
  padding:10px 0 0 20px
 }
 .div_feature_popup_supplier {
  width:72px;
  height:52px;
  border:1px solid #dfe1e6;
  border-radius:4px;
  flex-grow:1;
  justify-content:center
 }
 .div_feature_popup_supplier img {
  height:100%
 }
 .span_feature_popup_heading {
  font-size:14px
 }
}
@media screen and (max-width:1023px) and (max-width:420px) {
 .span_feature_popup_heading {
  font-size:3.8vw
 }
}
@media screen and (max-width:1023px) {
 .span_feature_popup_sub_heading {
  font-size:14px
 }
}
@media screen and (max-width:1023px) and (max-width:420px) {
 .span_feature_popup_sub_heading {
  font-size:3.8vw
 }
}
@media screen and (max-width:1023px) {
 .features_popup_table {
  padding:0;
  max-height:calc(100% - 58px);
  height:-moz-calc(100% - 18px);
  height:-webkit-calc(100% - 18px);
  height:-o-calc(100% - 18px);
  height:calc(100% - 18px)
 }
 .feature_popup_button {
  bottom:0;
  position:fixed;
  box-shadow:0 -3px 6px 0 rgba(0,0,0,.16);
  background:#fff;
  z-index:9;
  padding:12px;
  height:72px;
  justify-content:space-between;
  display:flex;
  flex-direction:row;
  align-items:center;
  width:100%!important;
  margin-top:0!important
 }
 .feature_close_button {
  display:inline-block;
  font-size:14px;
  color:#ff5630;
  font-weight:600;
  text-transform:uppercase;
  width:140px;
  text-align:center;
  height:auto;
  padding:0;
  line-height:21px
 }
}
@media screen and (max-width:1023px) and (max-width:420px) {
 .feature_close_button {
  font-size:3.8vw
 }
}
@media screen and (max-width:1023px) {
 .feature_apply_button {
  display:inline-block;
  width:calc(100% - 150px);
  height:48px;
  background:#ff5630;
  color:#fff;
  font-size:14px;
  font-weight:600;
  text-transform:uppercase;
  border-radius:4px;
  text-align:center;
  line-height:48px;
  padding:0;
  outline:none
 }
}
@media screen and (max-width:1023px) and (max-width:420px) {
 .feature_apply_button {
  font-size:3.8vw
 }
}
@media screen and (max-width:1023px) {
 .feature_apply_button.corona,
 .feature_apply_button.segment_apply {
  width:100%!important
 }
 .feature_apply_button.added_to_cart {
  border:1px solid #253858;
  color:#253858!important;
  background:#fff
 }
 .feature_apply_button img {
  display:none
 }
 .feature_apply_button.disabled {
  background:#ccc;
  cursor:none;
  pointer-events:none
 }
 .tabs:not(:last-child) {
  margin-bottom:0;
  position:static
 }
 .features_popup_mobile.white_bg {
  background:#fff!important
 }
 .features_popup_mobile .div_features_popup_mobile {
  height:calc(100% - 72px);
  overflow-y:auto
 }
 .features_hospital_catHead {
  background:#f4f5f7;
  padding:8px 16px;
  font-size:16px;
  color:#253858;
  font-weight:700
 }
}
@media screen and (max-width:1023px) and (max-width:420px) {
 .features_hospital_catHead {
  font-size:4.5vw
 }
}
@media screen and (max-width:1023px) {
 .features_hosp_list {
  margin:0 16px
 }
 .features_hosp_list li {
  font-size:14px;
  color:#253858;
  padding:16px 0;
  border-bottom:1px solid #dfe1e6;
  font-weight:600
 }
}
@media screen and (max-width:1023px) and (max-width:420px) {
 .features_hosp_list li {
  font-size:3.8vw
 }
}
@media screen and (max-width:1023px) {
 .features_hosp_list li span {
  display:block
 }
 .features_hosp_list li:last-child {
  border:none
 }
 .claim_popup_main {
  width:100%;
  z-index:10000;
  position:fixed;
  height:100%
 }
 .claim_popup_black {
  height:100%;
  background:rgba(0,0,0,.6);
  opacity:0;
  width:100%;
  position:absolute;
  z-index:1;
  animation:maskFade .3s ease-in-out 0s forwards
 }
 .claim_popup_white {
  background:#fff;
  width:100%;
  position:absolute;
  bottom:-100%;
  z-index:2;
  border-radius:10px 10px 0 0;
  line-height:21px;
  max-height:90%;
  overflow:auto;
  animation:slideup .5s ease-in-out 0s forwards;
  padding-bottom:32px
 }
 .claim_popup_white .div_features_covered_border {
  border-bottom:none
 }
 .claim_popup_white .div_features_covered_border:after {
  display:none
 }
 .claim_popup_white .features_popup_top {
  right:6px
 }
 .claim_popup_white .features_popup_top .cross_features_popup {
  position:relative;
  top:0!important;
  right:0!important
 }
 .claim_popup_white ul {
  margin:16px 0
 }
 .claim_popup_white ul li {
  margin:10px 0
 }
 @keyframes slideup {
  0% {
   bottom:-100%
  }
  to {
   bottom:0
  }
 }
 @keyframes maskFade {
  0% {
   opacity:0
  }
  to {
   opacity:1
  }
 }
 .div_feature_clicked_main {
  margin:0 16px 16px
 }
 .widgetsCard {
  padding:16px;
  margin-top:12px
 }
 .widgetsCard .widgetHead {
  font-size:16px;
  font-weight:600;
  color:#253858;
  margin-bottom:16px
 }
}
@media screen and (max-width:1023px) and (max-width:420px) {
 .widgetsCard .widgetHead {
  font-size:4.5vw
 }
}
@media screen and (max-width:1023px) {
 .notCoveredFeatureWrapper .featureRecommend {
  width:100%;
  float:none;
  box-shadow:none;
  margin-top:4px;
  padding:12px 0
 }
 .notCoveredFeatureWrapper .featureRecommend .featureRecommendTitle {
  margin:16px 0 8px 8px
 }
 .notCoveredFeatureWrapper .box-mob-slider1 .slider-new {
  padding:0!important
 }
 .similarBtmRow {
  width:calc(100% - 82px);
  float:right
 }
 .similarBtmRow .infoBox {
  display:none
 }
 .slider-new1 .similar_plans {
  padding:15px 0!important;
  width:100vw
 }
 .slider-new1 .similar_plans h3 {
  font-size:14px;
  font-weight:600;
  padding-right:12px;
  padding-left:12px;
  border-top:2px solid #f7f7f7;
  padding-top:15px
 }
 .slider-new1 .similar_plans h4 {
  font-size:12px;
  font-weight:600;
  padding-right:12px;
  padding-left:12px;
  padding-bottom:15px
 }
 .slider-new1 .similar_plan_ul1 li {
  width:100%;
  box-shadow:none;
  border:1px solid #dfe1e6;
  margin:0
 }
 .slider-new1 .similar_plan_ul1 span.grey-mob {
  width:calc(100% - 72px);
  float:none;
  padding:0 10px;
  font-size:14px;
  font-weight:700;
  height:auto!important;
  background:none
 }
 .slider-new1 .similar_plan_ul1 ul li span {
  font-size:14px;
  display:inline-block;
  color:#505f79;
  vertical-align:middle
 }
 .slider-new1 .similar_plan_ul1 ul li em {
  font-style:normal;
  vertical-align:middle;
  display:inline-block
 }
 .slider-new1 .similar_plan_ul1 ul li {
  width:100%;
  float:none;
  border:none;
  font-size:14px;
  color:#505f79;
  font-weight:400
 }
 .slider-new1 .similar_plan_ul1 ul {
  border:none;
  margin:-38px 0 0;
  padding:0
 }
 .slider-new1 .similar_plan_ul1 ul,
 .slider-new1 .similarBtmRow {
  width:calc(100% - 82px);
  float:right
 }
 .slider-new1 .similarBtmRow .infoBox {
  display:none
 }
 .slider-new1 .similar_plan_ul1 button {
  width:156px;
  border-radius:4px;
  margin-top:10px;
  font-size:14px;
  margin-bottom:0;
  height:36px;
  float:left
 }
}
@media screen and (max-width:1023px) and (max-width:420px) {
 .slider-new1 .similar_plan_ul1 button {
  font-size:3.8vw
 }
}
@media screen and (max-width:1023px) {
 .slider-new1 .similar_plan_ul1 h6 {
  font-size:10px
 }
 .slider-new1 .box_block {
  display:flex;
  align-items:flex-start
 }
 .slider-new1 .img-box-logo-similar {
  width:72px;
  height:60px;
  border-radius:4px;
  border:1px solid #dfe1e6;
  position:relative;
  margin-bottom:0;
  overflow:hidden;
  padding:4px
 }
 .slider-new1 .img-box-logo-similar img {
  width:100%;
  height:100%;
  position:absolute;
  top:50%;
  transform:translate(-50%,-50%);
  object-fit:scale-down;
  left:50%;
  max-width:64px;
  max-height:52px
 }
 .similar_plan_feature_popup_div {
  margin:15px auto
 }
 .feature_popup_save_amount {
  font-size:12px;
  text-align:center;
  background:#e6fcff;
  padding:4px 0;
  color:#36b37e;
  font-weight:700
 }
}
@media screen and (max-width:1023px) and (max-width:420px) {
 .feature_popup_save_amount {
  font-size:3.2vw
 }
}
@media screen and (max-width:1023px) {
 .feature_cover_premium .shortlist {
  position:absolute;
  width:24px;
  height:24px;
  right:-24px;
  top:10px
 }
 .feature_cover_premium .shortlist:before {
  content:"";
  display:block;
  width:14px;
  height:18px;
  background:url(https://static.pbcdn.in/health-cdn/images/insurer-logo/quotes-logos/shortlist.svg) no-repeat -5px -3px;
  margin:3px auto 0
 }
 .feature_cover_premium .shortlist.shortlisted:before {
  background:url(https://static.pbcdn.in/health-cdn/images/insurer-logo/quotes-logos/shortlist_selected.svg) no-repeat -5px -3px
 }
 .claim_popup_white .div_features_covered_border,
 .claim_popup_white .features_icons {
  padding-top:0
 }
 .hospitalSearchWrapper {
  transition:all .5s ease-in-out;
  position:relative
 }
 .searchAnim {
  overflow-y:auto;
  height:100%;
  z-index:9999;
  position:fixed;
  width:100%
 }
 .searchAnim .searchIcon:before {
  width:2px!important;
  height:16px!important;
  border:none!important;
  background:#253858!important;
  border-radius:0!important;
  transform:rotate(45deg)!important;
  left:11px!important;
  top:3px!important
 }
 .searchAnim .searchIcon:after {
  height:16px!important;
  transform:rotate(-45deg)!important;
  left:11px!important;
  top:3px!important
 }
 .coveredHead {
  font-size:16px;
  padding:0 16px 10px
 }
}
@media screen and (max-width:1023px) and (max-width:420px) {
 .coveredHead {
  font-size:4.5vw
 }
}
@media screen and (max-width:1023px) {
 .notCoveredHead {
  font-size:16px;
  padding:0 16px 10px
 }
}
@media screen and (max-width:1023px) and (max-width:420px) {
 .notCoveredHead {
  font-size:4.5vw
 }
}
@media screen and (max-width:1023px) {
 .whyChooseWrapper {
  margin-top:12px
 }
 .whyChooseWrapper>ul>li:first-child {
  background:none;
  box-shadow:none;
  font-size:16px;
  line-height:27px;
  font-weight:700;
  white-space:normal;
  padding:0 0 0 12px;
  width:unset
 }
}
@media screen and (max-width:1023px) and (max-width:420px) {
 .whyChooseWrapper>ul>li:first-child {
  font-size:4.5vw
 }
}
@media screen and (max-width:1023px) {
 .whyChooseWrapper>ul>li:first-child span {
  position:relative;
  top:50%;
  transform:translateY(-50%);
  display:block
 }
 .whyPolicyCertificateWrapper {
  position:fixed;
  background:#fff;
  width:100%;
  height:100%;
  left:0;
  bottom:0;
  z-index:999;
  overflow:auto;
  cursor:default;
  animation:certificatePopMob .3s ease-in-out
 }
 @keyframes certificatePopMob {
  0% {
   bottom:-100%
  }
  to {
   bottom:0
  }
 }
 .whyPolicyCertificateWrapper .popHeadWrap {
  position:sticky;
  top:0;
  position:-webkit-sticky;
  background:#fff
 }
 .whyPolicyCertificateWrapper .closeCertificate {
  height:36px;
  width:36px;
  cursor:pointer;
  text-align:center;
  position:absolute;
  overflow:hidden;
  display:block;
  right:6px;
  top:6px
 }
 .whyPolicyCertificateWrapper .closeCertificate:after,
 .whyPolicyCertificateWrapper .closeCertificate:before {
  content:"";
  width:2px;
  height:20px;
  display:block;
  position:absolute;
  left:50%;
  top:50%;
  background:#253858
 }
 .whyPolicyCertificateWrapper .closeCertificate:before {
  transform:translate(-50%,-50%) rotate(45deg)
 }
 .whyPolicyCertificateWrapper .closeCertificate:after {
  transform:translate(-50%,-50%) rotate(-45deg)
 }
 .whyPolicyCertificateWrapper .popHeading {
  font-size:16px;
  font-weight:700;
  padding:16px 50px 16px 16px;
  margin-bottom:20px
 }
}
@media screen and (max-width:1023px) and (max-width:420px) {
 .whyPolicyCertificateWrapper .popHeading {
  font-size:4.5vw
 }
}
@media screen and (max-width:1023px) {
 .whyPolicyCertificateWrapper .cities .popHeading {
  margin-bottom:0
 }
 .whyPolicyCertificateWrapper .certificateImage {
  width:100%;
  margin-bottom:36px
 }
 .whyPolicyCertificateWrapper .certificateImage img {
  display:block;
  width:100%;
  height:auto
 }
 .whyPolicyCertificateWrapper .certificateImage iframe {
  width:100%;
  height:260px
 }
 .whyPolicyCertificateWrapper .dataPoints {
  padding:0 12px
 }
 .whyPolicyCertificateWrapper .dataPoints .dataHead {
  font-size:16px;
  font-weight:700;
  margin-bottom:22px
 }
}
@media screen and (max-width:1023px) and (max-width:420px) {
 .whyPolicyCertificateWrapper .dataPoints .dataHead {
  font-size:4.5vw
 }
}
@media screen and (max-width:1023px) {
 .whyPolicyCertificateWrapper .dataPoints .dataWrapper {
  display:flex;
  flex-wrap:wrap;
  justify-content:space-between
 }
 .whyPolicyCertificateWrapper .dataPoints .dataWrapper .dataBlocks {
  width:45%;
  margin-bottom:32px
 }
 .whyPolicyCertificateWrapper .dataPoints .dataWrapper .dataBlocks.full {
  width:100%
 }
 .whyPolicyCertificateWrapper .dataPoints .dataWrapper .dataBlocks .dataIcon {
  width:32px;
  height:32px;
  margin-bottom:8px
 }
 .whyPolicyCertificateWrapper .dataPoints .dataWrapper .dataBlocks .dataIcon img {
  display:block;
  width:100%;
  height:100%
 }
 .whyPolicyCertificateWrapper .dataPoints .dataWrapper .dataBlocks .dataTitle {
  font-size:12px;
  color:#505f79;
  font-weight:400
 }
}
@media screen and (max-width:1023px) and (max-width:420px) {
 .whyPolicyCertificateWrapper .dataPoints .dataWrapper .dataBlocks .dataTitle {
  font-size:3.2vw
 }
}
@media screen and (max-width:1023px) {
 .whyPolicyCertificateWrapper .dataPoints .dataWrapper .dataBlocks .dataValue {
  font-size:16px;
  color:#253858;
  font-weight:700
 }
}
@media screen and (max-width:1023px) and (max-width:420px) {
 .whyPolicyCertificateWrapper .dataPoints .dataWrapper .dataBlocks .dataValue {
  font-size:4.5vw
 }
}
@media screen and (max-width:1023px) {
 .process_listing_tabs {
  margin:0 0 30px;
  overflow:hidden;
  overflow-x:auto;
  white-space:nowrap;
  padding:0 16px;
  height:38px
 }
 .process_listing_tabs::-webkit-scrollbar {
  display:none
 }
 .process_listing_tabs li {
  padding:0 20px;
  height:36px;
  margin:0 10px 0 0
 }
 .steps_claim_process {
  margin-left:16px;
  margin-right:16px
 }
 .steps_claim_process li {
  margin:0;
  font-size:14px;
  padding:0 0 28px 74px
 }
}
@media screen and (max-width:1023px) and (max-width:420px) {
 .steps_claim_process li {
  font-size:3.8vw
 }
}
@media screen and (max-width:1023px) {
 .steps_claim_process li:last-child {
  padding:0 0 0 74px
 }
 .steps_claim_process li h3 {
  font-size:14px;
  margin:0 0 4px;
  padding:0
 }
}
@media screen and (max-width:1023px) and (max-width:420px) {
 .steps_claim_process li h3 {
  font-size:3.8vw
 }
}
@media screen and (max-width:1023px) {
 .steps_claim_process li ul {
  margin:16px 0 0
 }
 .steps_claim_process li ul li {
  margin:0 0 16px;
  padding:0;
  list-style-type:none
 }
 .steps_claim_process li ul li:last-child {
  padding-left:0
 }
 .steps_claim_process p {
  margin:24px 0 0
 }
 .steps_claim_process .claim_address {
  margin:0
 }
 .steps_claim_process .claim_address p {
  margin:24px 0 0
 }
 .steps_claim_process .link_claim {
  word-break:break-word
 }
 .steps_claim_process .link_claim_box {
  display:flex;
  flex-direction:column;
  margin-top:8px;
  margin-left:0
 }
 .steps_claim_process .link_claim_box span {
  display:none
 }
 .steps_claim_process .link_claim_box a {
  margin-bottom:12px
 }
 .steps_claim_process .claim_address {
  font-style:normal;
  margin:-12px 0 0
 }
 .steps_claim_process .mob_claim {
  color:#253858
 }
 .steps_claim_process .claim_advantage_widget {
  flex-direction:column
 }
 .steps_claim_process .claim_advantage_widget p {
  margin:6px 0 0
 }
 .steps_claim_process .claim_advantage_widget ul li {
  margin:0 0 16px!important;
  background-position:0 -366px
 }
 .steps_claim_process .claim_advantage_widget ul li:last-child {
  margin:0!important;
  background-position:0 -435px
 }
 .advatange_claim_sp {
  margin:60px 16px 30px!important
 }
 .claim_protip {
  font-size:14px;
  margin:20px 16px 0!important
 }
}
@media screen and (max-width:1023px) and (max-width:420px) {
 .claim_protip {
  font-size:3.8vw
 }
}
@media screen and (max-width:1023px) {
 .claimWallWrapper .widgetHead {
  font-size:16px
 }
}
@media screen and (max-width:1023px) and (max-width:420px) {
 .claimWallWrapper .widgetHead {
  font-size:4.5vw
 }
}
@media screen and (max-width:1023px) and (max-width:1023px) {
 .claimWallWrapper .widgetHead {
  margin-bottom:0
 }
}
@media screen and (max-width:1023px) {
 .claimWallWrapper .widgetHead span {
  font-size:14px
 }
}
@media screen and (max-width:1023px) and (max-width:420px) {
 .claimWallWrapper .widgetHead span {
  font-size:3.8vw
 }
}
.features_search_hosp {
 position:relative;
 height:56px;
 width:calc(100% - 270px)
}
@media screen and (max-width:1023px) {
 .features_search_hosp {
  width:100%;
  height:50px
 }
}
.features_search_hosp input[type=text] {
 position:absolute;
 width:100%;
 height:100%;
 font-size:16px;
 color:#253858;
 -webkit-appearance:none;
 outline:none;
 border-radius:0 8px 8px 0;
 padding:0 16px;
 z-index:1;
 border:1px solid rgba(37,56,88,.5);
 border-left:none
}
@media screen and (max-width:420px) {
 .features_search_hosp input[type=text] {
  font-size:4.5vw
 }
}
@media screen and (max-width:1023px) {
 .features_search_hosp input[type=text] {
  font-size:14px
 }
}
@media screen and (max-width:1023px) and (max-width:420px) {
 .features_search_hosp input[type=text] {
  font-size:3.8vw
 }
}
.features_search_hosp input[type=text]::-webkit-input-placeholder {
 font-size:16px;
 color:#253858
}
@media screen and (max-width:420px) {
 .features_search_hosp input[type=text]::-webkit-input-placeholder {
  font-size:4.5vw
 }
}
@media screen and (max-width:1023px) {
 .features_search_hosp input[type=text]::-webkit-input-placeholder {
  font-size:14px
 }
}
@media screen and (max-width:1023px) and (max-width:420px) {
 .features_search_hosp input[type=text]::-webkit-input-placeholder {
  font-size:3.8vw
 }
}
.features_search_hosp input[type=text]:-ms-input-placeholder {
 font-size:16px;
 color:#253858
}
@media screen and (max-width:420px) {
 .features_search_hosp input[type=text]:-ms-input-placeholder {
  font-size:4.5vw
 }
}
@media screen and (max-width:1023px) {
 .features_search_hosp input[type=text]:-ms-input-placeholder {
  font-size:14px
 }
}
@media screen and (max-width:1023px) and (max-width:420px) {
 .features_search_hosp input[type=text]:-ms-input-placeholder {
  font-size:3.8vw
 }
}
.features_search_hosp input[type=text]::placeholder {
 font-size:16px;
 color:#253858
}
@media screen and (max-width:420px) {
 .features_search_hosp input[type=text]::placeholder {
  font-size:4.5vw
 }
}
@media screen and (max-width:1023px) {
 .features_search_hosp input[type=text]::placeholder {
  font-size:14px
 }
}
@media screen and (max-width:1023px) and (max-width:420px) {
 .features_search_hosp input[type=text]::placeholder {
  font-size:3.8vw
 }
}
.features_search_hosp input[type=text]:disabled {
 background:transparent
}
@media screen and (max-width:1023px) {
 .features_search_hosp input[type=text] {
  border-left:1px solid rgba(37,56,88,.5);
  border-top:none;
  border-radius:0 0 8px 8px
 }
}
.features_search_hosp .searchIcon {
 position:absolute;
 z-index:2;
 width:24px;
 height:24px;
 right:12px;
 top:50%;
 transform:translateY(-50%)
}
.features_search_hosp .searchIcon:before {
 content:"";
 width:14px;
 height:14px;
 border:2px solid #253858;
 border-radius:50%;
 position:absolute;
 top:3px;
 left:3px
}
.features_search_hosp .searchIcon:after {
 content:"";
 width:2px;
 height:8px;
 background:#253858;
 position:absolute;
 transform:rotate(-45deg);
 bottom:3px;
 right:6px
}
.whyChooseWrapper {
 margin-top:12px;
 background:#fff;
 padding:16px 0
}
.whyChooseWrapper>ul {
 font-size:0;
 overflow-x:auto;
 white-space:nowrap;
 height:210px;
 padding-right:12px;
 -ms-overflow-style:none;
 scrollbar-width:none
}
.whyChooseWrapper>ul::-webkit-scrollbar {
 display:none
}
.whyChooseWrapper>ul>li {
 width:190px;
 height:186px;
 background:#fff;
 box-shadow:0 0 4px 0 rgba(0,0,0,.16);
 display:inline-block;
 padding:14px 12px 18px;
 white-space:normal;
 margin-top:4px;
 font-size:14px;
 font-weight:700;
 color:#253858;
 vertical-align:middle;
 margin-left:12px;
 border-radius:4px;
 position:relative
}
@media screen and (max-width:420px) {
 .whyChooseWrapper>ul>li {
  font-size:3.8vw
 }
}
.whyChooseWrapper>ul>li.trust {
 border-left:2px solid #5c4cb5
}
.whyChooseWrapper>ul>li.gc {
 border-left:2px solid #5dbd93
}
@media only screen and (max-width:1023px) {
 .whyChooseWrapper>ul>li.gc {
  width:200px
 }
}
.whyChooseWrapper>ul>li.peace {
 border-left:2px solid #33a9c7
}
.whyChooseWrapper>ul>li.ceo {
 border-left:2px solid #0052cc
}
.whyChooseWrapper>ul>li.offices {
 border-left:2px solid #3f8fc4
}
.whyChooseWrapper>ul>li .img {
 width:68px;
 height:68px;
 border-radius:50%;
 background:#f0f7ff;
 margin-bottom:8px
}
.whyChooseWrapper>ul>li .tagline {
 text-transform:uppercase;
 font-weight:700;
 font-size:10px;
 color:#253858
}
.whyChooseWrapper>ul>li .desc {
 font-weight:600;
 font-size:14px;
 color:#253858
}
@media screen and (max-width:420px) {
 .whyChooseWrapper>ul>li .desc {
  font-size:3.8vw
 }
}
.whyChooseWrapper>ul>li .link {
 text-transform:uppercase;
 font-weight:600;
 font-size:12px;
 color:#ff5630;
 margin-bottom:7px
}
@media screen and (max-width:420px) {
 .whyChooseWrapper>ul>li .link {
  font-size:3.2vw
 }
}
.whyChooseWrapper>ul>li .link .videoIcon {
 width:17px;
 height:17px;
 border-radius:50%;
 background:#ff5630;
 display:inline-block;
 vertical-align:middle;
 margin-left:4px;
 position:relative
}
.whyChooseWrapper>ul>li .link .videoIcon:before {
 content:"";
 border-top:4px solid transparent;
 border-bottom:4px solid transparent;
 border-left:4px solid #fff;
 position:absolute;
 left:50%;
 top:50%;
 transform:translate(-50%,-50%)
}
.greenChannelImg:before {
 background:url(https://static.pbcdn.in/health-cdn/images/insurer-logo/quotes-logos/sprite_green_why.png) no-repeat 0 -480px;
 background-size:cover
}
.greenChannelImg:before,
.officesImg:before {
 content:"";
 width:64px;
 height:64px;
 display:block
}
.officesImg:before {
 background:url(https://static.pbcdn.in/health-cdn/images/insurer-logo/quotes-logos/officeAddressIcons.svg) no-repeat 0 0;
 background-size:cover
}
.aboutInsurer .accordionSection_features label,
.brochure .accordionSection_features label {
 font-size:16px;
 font-weight:600
}
@media screen and (max-width:420px) {
 .aboutInsurer .accordionSection_features label,
 .brochure .accordionSection_features label {
  font-size:4.5vw
 }
}
.aboutInsurer .accordionSection_features .accordionContent,
.brochure .accordionSection_features .accordionContent {
 margin-top:8px;
 font-size:14px;
 color:#253858
}
@media screen and (max-width:420px) {
 .aboutInsurer .accordionSection_features .accordionContent,
 .brochure .accordionSection_features .accordionContent {
  font-size:3.8vw
 }
}
.aboutInsurer .accordionSection_features input[type=checkbox]:checked+label,
.brochure .accordionSection_features input[type=checkbox]:checked+label {
 font-weight:600
}
.brochure .accordionSection_features .accordionContent>p {
 color:#505f79
}
.brochure .accordionSection_features .accordionContent ul>li {
 padding:16px 0;
 border-bottom:1px solid #b3bac5;
 font-size:14px;
 font-weight:600;
 position:relative;
 cursor:pointer
}
@media screen and (max-width:420px) {
 .brochure .accordionSection_features .accordionContent ul>li {
  font-size:3.8vw
 }
}
.brochure .accordionSection_features .accordionContent ul>li span {
 position:absolute;
 right:10px;
 width:14px;
 height:20px;
 border-bottom:2px solid #ff5630
}
.brochure .accordionSection_features .accordionContent ul>li span i:before {
 content:"";
 width:2px;
 height:14px;
 background:#ff5630;
 display:inline-block;
 position:absolute;
 left:50%;
 margin-left:-1px
}
.brochure .accordionSection_features .accordionContent ul>li span i:after {
 content:"";
 border:solid #ff5630;
 border-width:0 2px 2px 0;
 display:inline-block;
 padding:4px;
 transform:rotate(45deg);
 position:absolute;
 left:50%;
 margin-left:-5px;
 top:4px
}
.claim_process {
 font-size:14px;
 color:#253858;
 padding:16px 0;
 line-height:24px
}
@media screen and (max-width:420px) {
 .claim_process {
  font-size:3.8vw
 }
}
.claim_process h3 {
 color:#253858;
 font-weight:700;
 font-size:16px;
 padding:0 16px
}
@media screen and (max-width:420px) {
 .claim_process h3 {
  font-size:4.5vw
 }
}
.claim_process .claim_process_text {
 padding:0 16px
}
.claim_process .claim_process_text h4 {
 font-size:14px;
 font-weight:700;
 color:#253858;
 margin-bottom:4px;
 margin-top:16px
}
@media screen and (max-width:420px) {
 .claim_process .claim_process_text h4 {
  font-size:3.8vw
 }
}
.claim_process .claim_process_text>ul {
 padding-left:16px
}
.claim_process .claim_process_text>ul,
.claim_process .claim_process_text>ul>li {
 margin-bottom:8px;
 list-style-type:disc
}
.claim_process .claim_process_text>ul>li>ul {
 list-style-type:circle;
 padding-left:16px;
 margin-top:8px
}
.claim_process .claim_process_text>ul>li>ul>li {
 margin-bottom:8px;
 list-style-type:circle
}
.claim_process .claim_process_text>ul>li>ul>li>ul {
 list-style-type:circle;
 padding-left:0;
 margin-top:8px
}
.claim_process .claim_process_text>ul>li>ul>li>ul>li {
 margin-bottom:8px
}
.claim_process .claim_process_text>ul>li>ul>li>ul>li:before {
 content:"✓";
 margin-right:16px
}
.claim_process .claim_process_text .claimProcess_protip,
.claim_process .claim_process_text .claimProcess_protip strong {
 color:#00a3bf
}
.more_faq {
 position:relative;
 padding:0 0 0 135px;
 display:flex;
 align-items:flex-start;
 height:110px;
 flex-direction:column;
 justify-content:center
}
.more_faq:before {
 content:"";
 background:url(https://static.pbcdn.in/health-cdn/images/insurer-logo/quotes-logos/feature_popup_sprite.png) no-repeat 0 -199px;
 background-size:105px;
 width:114px;
 height:105px;
 position:absolute;
 left:0;
 top:50%;
 transform:translateY(-50%)
}
.more_faq .widgetHead {
 margin-bottom:4px
}
.more_faq .faqTxt {
 font-size:14px;
 color:#505f79
}
@media screen and (max-width:420px) {
 .more_faq .faqTxt {
  font-size:3.8vw
 }
}
.more_faq .faqLinks {
 margin-top:8px
}
.more_faq .faqLinks a {
 color:#ff5630;
 font-size:14px;
 font-weight:600;
 display:inline-block;
 padding-right:16px;
 line-height:normal
}
@media screen and (max-width:420px) {
 .more_faq .faqLinks a {
  font-size:3.8vw
 }
}
.more_faq .faqLinks a:last-child {
 border-left:1px solid #253858;
 padding-left:16px;
 padding-right:0
}
.div_claim_popup_heading {
 padding:16px 56px 16px 16px;
 position:sticky;
 position:-webkit-sticky;
 top:0;
 background:#fff
}
.claim_popup_heading {
 font-size:16px;
 font-weight:700;
 color:#253858
}
@media screen and (max-width:420px) {
 .claim_popup_heading {
  font-size:4.5vw
 }
}
.div_feature_explain {
 margin:0 16px 16px;
 font-size:14px;
 color:#505f79
}
@media screen and (max-width:420px) {
 .div_feature_explain {
  font-size:3.8vw
 }
}
.div_feature_what {
 margin:0 16px;
 font-size:14px;
 color:#505f79
}
@media screen and (max-width:420px) {
 .div_feature_what {
  font-size:3.8vw
 }
}
.div_feature_what>p {
 font-size:16px;
 color:#253858;
 font-weight:600;
 margin-bottom:8px
}
@media screen and (max-width:420px) {
 .div_feature_what>p {
  font-size:4.5vw
 }
}
.div_feature_tip {
 margin:16px 16px 0;
 font-size:14px;
 color:#00a3bf
}
@media screen and (max-width:420px) {
 .div_feature_tip {
  font-size:3.8vw
 }
}
.div_feature_tip strong {
 color:#00a3bf
}
.wallTagline {
 font-size:16px;
 color:#505f79;
 display:block;
 font-weight:400
}
@media screen and (max-width:420px) {
 .wallTagline {
  font-size:4.5vw
 }
}
.claimWallWrapper {
 margin-top:40px;
 padding-left:32px;
 position:relative
}
.claimWallWrapper .arrowWalls {
 position:absolute;
 right:-16px;
 top:6px
}
@media screen and (max-width:1023px) {
 .claimWallWrapper {
  margin-top:12px;
  padding:16px;
  background:#fff
 }
}
.wrapperWalls {
 margin-bottom:0;
 padding-right:0;
 height:210px;
 white-space:nowrap;
 display:list-item;
 overflow:auto;
 -ms-overflow-style:none;
 scrollbar-width:none;
 transition:transform .3s;
 margin-left:0
}
.wrapperWalls::marker {
 display:none;
 color:#fff
}
@media screen and (max-width:1023px) {
 .wrapperWalls {
  height:206px;
  margin-left:0;
  background:#fff;
  padding:20px 0 0
 }
}
.wrapperWalls .innerCardWall {
 box-shadow:0 0 4px rgba(0,0,0,.16);
 height:200px;
 width:calc(45.45455% - 12px);
 margin:4px 16px 0 2px;
 padding:20px;
 border-radius:4px;
 min-width:325px;
 display:inline-block;
 vertical-align:top
}
@media screen and (max-width:1023px) {
 .wrapperWalls .innerCardWall {
  min-width:294px;
  margin:4px 16px 0 2px;
  height:174px
 }
}
.wrapperWalls .innerCardWall.videoWidget {
 padding:0
}
.wrapperWalls .innerCardWall.thumbVideo {
 padding:0;
 position:relative
}
.wrapperWalls .innerCardWall.thumbVideo img {
 width:100%;
 height:100%;
 border-radius:4px;
 cursor:pointer
}
.wrapperWalls .innerCardWall.thumbVideo .play {
 background:#172b4d;
 border-radius:50%/10%;
 color:#fff;
 font-size:1em;
 height:3em;
 margin:20px auto;
 padding:0;
 position:relative;
 text-align:center;
 text-indent:.1em;
 transition:all .15s ease-out;
 width:4em;
 position:absolute;
 top:52px;
 left:40%
}
@media screen and (max-width:1023px) {
 .wrapperWalls .innerCardWall.thumbVideo .play {
  top:38px;
  left:36%
 }
}
.wrapperWalls .innerCardWall.thumbVideo .play:before {
 background:inherit;
 border-radius:5%/50%;
 bottom:9%;
 content:"";
 left:-5%;
 position:absolute;
 right:-5%;
 top:9%
}
.wrapperWalls .innerCardWall.thumbVideo .play:after {
 border-color:transparent transparent transparent hsla(0,0%,100%,.75);
 border-style:solid;
 border-width:1em 0 1em 1.732em;
 content:" ";
 font-size:.75em;
 height:0;
 margin:-1em 0 0 -.75em;
 top:50%;
 position:absolute;
 width:0
}
.wrapperWalls .innerCardWall.thumbVideo:hover .play {
 background:red
}
.wrapperWalls .innerCardWall.moreStory {
 display:inline-flex;
 align-items:center;
 justify-content:center
}
@media screen and (max-width:1023px) {
 .wrapperWalls .innerCardWall.moreStory .linkStory {
  font-size:16px
 }
}
@media screen and (max-width:1023px) and (max-width:420px) {
 .wrapperWalls .innerCardWall.moreStory .linkStory {
  font-size:4.5vw
 }
}
.wrapperWalls .innerCardWall.moreStory:after {
 content:"";
 border:solid #ff5630;
 border-width:0 2px 2px 0;
 display:inline-block;
 padding:3px;
 transform:rotate(-45deg);
 margin-left:6px;
 vertical-align:middle;
 position:relative;
 margin-top:3px
}
.wrapperWalls .innerCardWall .wallProfile {
 display:flex;
 width:100%
}
.wrapperWalls .innerCardWall .wallProfile .profileBox {
 min-width:48px;
 width:48px;
 height:48px;
 border:1px solid #dfe1e6;
 border-radius:29px;
 overflow:hidden
}
.wrapperWalls .innerCardWall .wallProfile .profileBox img {
 width:100%;
 height:100%;
 border-radius:100%;
 object-fit:contain
}
.wrapperWalls .innerCardWall .wallProfile .profileContent {
 margin-left:20px
}
.wrapperWalls .innerCardWall .wallProfile .profileContent .nameWall {
 font-size:16px;
 color:#172b4d;
 font-weight:700;
 text-overflow:ellipsis;
 overflow:hidden;
 width:230px
}
@media screen and (max-width:420px) {
 .wrapperWalls .innerCardWall .wallProfile .profileContent .nameWall {
  font-size:4.5vw
 }
}
@media screen and (max-width:1023px) {
 .wrapperWalls .innerCardWall .wallProfile .profileContent .nameWall {
  width:200px
 }
}
.wrapperWalls .innerCardWall .wallProfile .profileContent .postWall {
 font-size:14px;
 color:#172b4d;
 font-weight:400;
 text-overflow:ellipsis;
 overflow:hidden;
 width:230px
}
@media screen and (max-width:420px) {
 .wrapperWalls .innerCardWall .wallProfile .profileContent .postWall {
  font-size:3.8vw
 }
}
@media screen and (max-width:1023px) {
 .wrapperWalls .innerCardWall .wallProfile .profileContent .postWall {
  width:200px
 }
}
.wrapperWalls .innerCardWall .wallQuote {
 color:#172b4d;
 font-size:16px;
 padding:14px 0 0;
 white-space:normal;
 display:block;
 display:-webkit-box;
 max-width:100%;
 height:86px;
 margin:0 0 8px;
 -webkit-line-clamp:3;
 -webkit-box-orient:vertical;
 overflow:hidden;
 text-overflow:ellipsis;
 line-height:24px
}
@media screen and (max-width:420px) {
 .wrapperWalls .innerCardWall .wallQuote {
  font-size:4.5vw
 }
}
@media screen and (max-width:1023px) {
 .wrapperWalls .innerCardWall .wallQuote {
  font-size:14px;
  -webkit-line-clamp:2;
  height:60px
 }
}
@media screen and (max-width:1023px) and (max-width:420px) {
 .wrapperWalls .innerCardWall .wallQuote {
  font-size:3.8vw
 }
}
.wrapperWalls .innerCardWall .linkStory {
 color:#ff5630;
 font-size:14px;
 font-weight:600;
 text-transform:uppercase;
 cursor:pointer
}
@media screen and (max-width:420px) {
 .wrapperWalls .innerCardWall .linkStory {
  font-size:3.8vw
 }
}
@media screen and (max-width:1023px) {
 .wrapperWalls .innerCardWall .linkStory {
  font-size:14px;
  font-weight:600
 }
}
@media screen and (max-width:1023px) and (max-width:420px) {
 .wrapperWalls .innerCardWall .linkStory {
  font-size:3.8vw
 }
}
.wrapperWalls .innerCardWall .wallWidgetVideo iframe {
 width:100%;
 height:200px;
 border-radius:4px
}
@media screen and (max-width:1023px) {
 .wrapperWalls .innerCardWall .wallWidgetVideo iframe {
  height:174px
 }
}
.wrapperWalls::-webkit-scrollbar {
 display:none
}
.hosp_city_name {
 font-size:14px;
 color:#505f79;
 font-weight:400
}
@media screen and (max-width:420px) {
 .hosp_city_name {
  font-size:3.8vw
 }
}
.hosp_city_name1 {
 font-weight:600
}
#cashless a,
#reimbursement a {
 display:block
}
.cities .popHeading span.onGroundCityList {
 font-size:16px;
 color:#172b4d
}
@media screen and (max-width:420px) {
 .cities .popHeading span.onGroundCityList {
  font-size:4.5vw
 }
}
@media screen and (max-width:1023px) {
 .cities .popHeading span.onGroundCityList {
  font-size:14px
 }
}
@media screen and (max-width:1023px) and (max-width:420px) {
 .cities .popHeading span.onGroundCityList {
  font-size:3.8vw
 }
}
@media screen and (min-width:1024px) {
 .accordionSection_features label {
  font-size:16px
 }
 .showContent {
  display:block!important;
  opacity:1!important;
  max-height:inherit!important
 }
 .whyChooseWrapper {
  margin-top:60px;
  padding-left:32px
 }
 .whyChooseWrapper>ul {
  margin-bottom:0;
  padding-right:0;
  height:210px
 }
 .whyChooseWrapper>ul>li {
  box-shadow:0 0 4px rgba(0,0,0,.16);
  height:200px;
  width:280px;
  margin-right:16px;
  margin-left:0;
  font-size:18px;
  cursor:pointer
 }
 .whyChooseWrapper>ul>li.ceo,
 .whyChooseWrapper>ul>li.gc,
 .whyChooseWrapper>ul>li.offices,
 .whyChooseWrapper>ul>li.peace,
 .whyChooseWrapper>ul>li.trust {
  border-width:0 0 0 4px
 }
 .whyChooseWrapper>ul>li span {
  font-size:16px;
  font-weight:400;
  display:block;
  margin-top:4px
 }
 .whyChooseWrapper>ul>li .tagline {
  margin-bottom:4px
 }
 .whyChooseWrapper>ul>li .link {
  margin-top:20px
 }
 .whyChooseWrapper>ul>li .link .videoIcon:before {
  margin-left:1px
 }
 .whyChooseWrapper>ul>li .desc {
  min-height:42px
 }
 .brochure_desktop>p {
  margin-top:-15px;
  font-size:16px
 }
 .brochure_desktop>ul {
  display:flex;
  justify-content:space-between;
  flex-wrap:wrap;
  margin-top:16px
 }
 .brochure_desktop>ul>li {
  width:45%;
  font-size:16px!important;
  padding-right:30px!important
 }
 .brochure_desktop>ul>li span {
  bottom:16px
 }
 .claim_process {
  padding:16px 0 24px 16px!important;
  font-size:16px;
  line-height:24px
 }
 .claim_process .claim_process_text h4 {
  font-size:16px
 }
 .features_hospital_catHead {
  font-size:18px;
  font-weight:700;
  color:#253858
 }
 .features_hosp_list {
  display:flex;
  justify-content:space-between;
  flex-wrap:wrap;
  margin-bottom:40px
 }
 .features_hosp_list>li {
  width:45%;
  border-bottom:1px solid #dfe1e6;
  padding:16px 0;
  display:flex;
  flex-direction:column;
  text-align:left;
  font-weight:600;
  font-size:16px
 }
}
@media screen and (min-width:1024px) and (max-width:420px) {
 .features_hosp_list>li {
  font-size:4.5vw
 }
}
@media screen and (min-width:1024px) {
 .about_desktop {
  font-size:16px!important;
  line-height:30px
 }
 .tabs-feature {
  z-index:9;
  position:sticky;
  position:-webkit-sticky;
  top:0
 }
 .more_faq {
  background:#fff;
  box-shadow:0 0 4px rgba(0,0,0,.16);
  border-radius:8px;
  height:130px;
  border:1px solid #dfe1e6;
  margin-left:32px;
  padding-left:185px;
  flex-direction:row;
  align-items:center
 }
 .more_faq>div {
  width:calc(100% - 180px)
 }
 .more_faq .widgetHead {
  margin-bottom:0
 }
 .more_faq .faqLinks {
  border:1px solid #ff5630;
  border-radius:4px;
  font-size:12px;
  font-weight:600;
  text-transform:uppercase;
  height:42px;
  width:140px;
  display:flex;
  align-items:center;
  justify-content:center;
  margin-right:40px;
  margin-top:0
 }
 .more_faq .faqLinks a {
  padding-right:0
 }
 .more_faq .faqLinks a:last-child {
  border-left:none;
  padding-left:0;
  padding-right:0
 }
 .more_faq:before {
  background-position:0 -239px;
  background-size:125px;
  width:124px;
  height:122px
 }
 .notCoveredFeatureWrapper .featureRecommend {
  position:relative
 }
 .notCoveredFeatureWrapper .featureRecommend:after {
  content:"";
  display:block;
  border-bottom:1px solid #b3bac5;
  position:absolute;
  bottom:-4px;
  width:100%
 }
 .notCoveredFeatureWrapper .featureRecommend .clickToRecommend a {
  display:inline-block
 }
 .claim_popup_white {
  width:calc(100% - 66px);
  margin-left:auto;
  background:#fff;
  position:relative;
  top:-1px;
  border-bottom:1px solid #b3bac5;
  animation:slideDown .5s ease-in-out 0s forwards
 }
 .claim_popup_white:after {
  content:"";
  display:block;
  height:16px
 }
 .div_feature_what {
  font-size:16px
 }
 .div_claim_popup_heading,
 .div_feature_explain,
 .div_feature_tip,
 .div_feature_what {
  margin:0
 }
 .div_feature_what>p {
  margin-bottom:0
 }
 .div_feature_tip {
  margin-top:16px
 }
 .div_features_covered_inside,
 .div_features_covered_main {
  cursor:pointer
 }
 .cursor-normal {
  cursor:default
 }
 .slider-new1 {
  padding:4px 0!important;
  overflow:auto!important;
  font-size:inherit!important
 }
 .slider-new1 .similar_plan_ul1>li {
  box-shadow:0 0 4px 0 rgba(0,0,0,.16)!important
 }
 .slider-new1>div {
  margin:0 10px!important
 }
 .slider-new1>div:first-child {
  margin-left:0!important
 }
 .feature_popup_save_amount {
  font-size:14px;
  text-align:center;
  background:#e6fcff;
  padding:4px 0;
  color:#36b37e;
  font-weight:600;
  border-radius:8px;
  margin-right:18px;
  margin-top:16px
 }
}
@media screen and (min-width:1024px) and (max-width:420px) {
 .feature_popup_save_amount {
  font-size:3.8vw
 }
}
@media screen and (min-width:1024px) {
 .cross_features_popup {
  position:absolute;
  top:26px;
  right:80px
 }
 .featureRecommend .slider-new1 {
  padding:4px 7px 4px 0!important
 }
 .featureRecommend .slider-new1>div {
  margin:0 16px!important
 }
 .featureRecommend .slider-new1>div:first-child {
  margin-left:0!important
 }
 .whyPolicyCertificateWrapper {
  position:fixed;
  background:transparent;
  left:0;
  top:0;
  right:0;
  bottom:0;
  z-index:999;
  overflow:hidden;
  cursor:default;
  animation:certificatePopDesktop .3s ease-in-out
 }
 @keyframes certificatePopDesktop {
  0% {
   opacity:0
  }
  to {
   opacity:1
  }
 }
 .whyPolicyCertificateWrapper:before {
  content:"";
  position:absolute;
  top:0;
  right:0;
  bottom:0;
  left:0;
  background:rgba(23,43,77,.9)
 }
 .whyPolicyCertificateWrapper>div {
  width:650px;
  min-height:425px;
  background:#fff;
  border-radius:8px;
  position:absolute;
  left:50%;
  top:50%;
  transform:translate(-50%,-50%);
  overflow:hidden
 }
 .whyPolicyCertificateWrapper>div.greenChannelWrapper {
  width:800px
 }
 .whyPolicyCertificateWrapper>div.officeAddress {
  min-height:200px
 }
 .whyPolicyCertificateWrapper>div.cities {
  width:800px
 }
 .whyPolicyCertificateWrapper .closeCertificate {
  height:36px;
  width:36px;
  cursor:pointer;
  text-align:center;
  position:absolute;
  overflow:hidden;
  display:block;
  right:6px;
  top:6px
 }
 .whyPolicyCertificateWrapper .closeCertificate:after,
 .whyPolicyCertificateWrapper .closeCertificate:before {
  content:"";
  width:2px;
  height:20px;
  display:block;
  position:absolute;
  left:50%;
  top:50%;
  background:#253858
 }
 .whyPolicyCertificateWrapper .closeCertificate:before {
  transform:translate(-50%,-50%) rotate(45deg)
 }
 .whyPolicyCertificateWrapper .closeCertificate:after {
  transform:translate(-50%,-50%) rotate(-45deg)
 }
 .whyPolicyCertificateWrapper .popHeading {
  font-size:18px;
  font-weight:700;
  padding:16px 50px 16px 16px
 }
 .whyPolicyCertificateWrapper .certificateImage {
  width:100%;
  padding:0 16px
 }
 .whyPolicyCertificateWrapper .certificateImage img {
  display:block;
  width:100%;
  height:auto;
  max-width:485px;
  margin:0 auto 16px
 }
 .whyPolicyCertificateWrapper .certificateImage iframe {
  width:100%;
  height:350px
 }
 .whyPolicyCertificateWrapper .dataPoints {
  padding:0 16px 16px
 }
 .whyPolicyCertificateWrapper .dataPoints .dataHead {
  font-size:18px;
  font-weight:700;
  margin-bottom:16px
 }
 .whyPolicyCertificateWrapper .dataPoints .dataWrapper {
  display:flex;
  flex-wrap:wrap
 }
 .whyPolicyCertificateWrapper .dataPoints .dataWrapper .dataBlocks {
  width:28%;
  margin-bottom:0
 }
 .whyPolicyCertificateWrapper .dataPoints .dataWrapper .dataBlocks.full {
  width:44%
 }
 .whyPolicyCertificateWrapper .dataPoints .dataWrapper .dataBlocks .dataIcon {
  width:32px;
  height:32px;
  margin-bottom:8px
 }
 .whyPolicyCertificateWrapper .dataPoints .dataWrapper .dataBlocks .dataIcon img {
  display:block;
  width:100%;
  height:100%
 }
 .whyPolicyCertificateWrapper .dataPoints .dataWrapper .dataBlocks .dataTitle {
  font-size:12px;
  color:#505f79;
  font-weight:400
 }
}
@media screen and (min-width:1024px) and (max-width:420px) {
 .whyPolicyCertificateWrapper .dataPoints .dataWrapper .dataBlocks .dataTitle {
  font-size:3.2vw
 }
}
@media screen and (min-width:1024px) {
 .whyPolicyCertificateWrapper .dataPoints .dataWrapper .dataBlocks .dataValue {
  font-size:16px;
  color:#253858;
  font-weight:700
 }
}
@media screen and (min-width:1024px) and (max-width:420px) {
 .whyPolicyCertificateWrapper .dataPoints .dataWrapper .dataBlocks .dataValue {
  font-size:4.5vw
 }
}
@keyframes slideDown {
 0% {
  max-height:0;
  opacity:0
 }
 to {
  max-height:400px;
  opacity:1
 }
}
@media screen and (min-width:1024px) and (max-width:1279px) {
 .fullscreen_popup_left_col {
  padding:90px 16px 0!important
 }
}
.align-center-flex {
 display:flex;
 align-items:center
}
.div_features_covered_border.align-center-flex:after {
 content:none
}
.featurePopupSupplierImg {
 width:126px;
 height:58px;
 object-fit:contain
}
.whyPolicyCertificateWrapper .popHeading span {
 font-size:14px;
 color:#505f79;
 font-weight:400;
 display:block;
 margin-top:4px
}
@media screen and (max-width:420px) {
 .whyPolicyCertificateWrapper .popHeading span {
  font-size:3.8vw
 }
}
.whyPolicyCertificateWrapper .topTag {
 border-radius:4px 0 0 4px;
 background:#00b8d9;
 padding:5px 6px 5px 8px;
 font-size:12px;
 font-weight:700;
 color:#fff;
 display:inline-block;
 margin:16px 0 -16px 16px;
 position:relative;
 height:28px
}
@media screen and (max-width:420px) {
 .whyPolicyCertificateWrapper .topTag {
  font-size:3.2vw
 }
}
.whyPolicyCertificateWrapper .topTag:after {
 content:"";
 background:url(https://static.pbcdn.in/health-cdn/images/insurer-logo/quotes-logos/tag_green_newLaunch.svg) no-repeat -16px 0;
 width:18px;
 height:28px;
 position:absolute;
 right:-16px;
 top:0
}
.whyPolicyCertificateWrapper .citysearchWrap {
 position:relative;
 width:calc(100% - 32px);
 padding:0 16px
}
.whyPolicyCertificateWrapper .citysearchWrap .citysearchbar {
 border:1px solid #b3bac5!important;
 border-radius:8px!important
}
.whyPolicyCertificateWrapper .citysearchWrap .searchIcon {
 right:0
}
.whyPolicyCertificateWrapper .greenChannelDataPoints {
 padding:16px;
 max-height:67vh;
 overflow:auto;
 margin-bottom:16px
}
@media screen and (max-width:1023px) {
 .whyPolicyCertificateWrapper .greenChannelDataPoints {
  margin-bottom:0
 }
}
.whyPolicyCertificateWrapper .greenChannelDataPoints .noCity {
 font-size:14px;
 color:#ff5630;
 margin-left:10px
}
.whyPolicyCertificateWrapper .greenChannelDataPoints>ul>li {
 display:flex;
 align-items:flex-start;
 margin-bottom:50px;
 align-items:center
}
@media screen and (max-width:1023px) {
 .whyPolicyCertificateWrapper .greenChannelDataPoints>ul>li {
  margin-bottom:32px
 }
}
.whyPolicyCertificateWrapper .greenChannelDataPoints>ul>li:last-child {
 margin-bottom:0
}
.whyPolicyCertificateWrapper .greenChannelDataPoints>ul>li i {
 width:64px;
 height:64px;
 margin-right:20px;
 background:url(https://static.pbcdn.in/health-cdn/images/insurer-logo/quotes-logos/sprite_green_why.png) no-repeat 0 0;
 background-size:cover
}
.whyPolicyCertificateWrapper .greenChannelDataPoints>ul>li i.greenChannel_icon {
 background-position:0 -480px
}
.whyPolicyCertificateWrapper .greenChannelDataPoints>ul>li i.greenChannel_icon1 {
 background-position:0 0
}
.whyPolicyCertificateWrapper .greenChannelDataPoints>ul>li i.greenChannel_icon2 {
 background-position:0 -80px
}
.whyPolicyCertificateWrapper .greenChannelDataPoints>ul>li i.greenChannel_icon3 {
 background-position:0 -160px
}
.whyPolicyCertificateWrapper .greenChannelDataPoints>ul>li i.greenChannel_icon4 {
 background-position:0 -240px
}
.whyPolicyCertificateWrapper .greenChannelDataPoints>ul>li i.greenChannel_icon5 {
 background-position:0 -320px
}
.whyPolicyCertificateWrapper .greenChannelDataPoints>ul>li i.greenChannel_icon6 {
 background-position:0 -400px
}
.whyPolicyCertificateWrapper .greenChannelDataPoints>ul>li p {
 width:calc(100% - 84px);
 color:#505f79;
 font-size:14px
}
@media screen and (max-width:420px) {
 .whyPolicyCertificateWrapper .greenChannelDataPoints>ul>li p {
  font-size:3.8vw
 }
}
.whyPolicyCertificateWrapper .greenChannelDataPoints>ul>li p strong {
 font-size:16px;
 font-weight:700;
 color:#253858;
 display:block
}
@media screen and (max-width:420px) {
 .whyPolicyCertificateWrapper .greenChannelDataPoints>ul>li p strong {
  font-size:4.5vw
 }
}
@media screen and (max-width:1023px) {
 .whyPolicyCertificateWrapper .greenChannelDataPoints>ul>li p strong {
  font-size:14px
 }
}
@media screen and (max-width:1023px) and (max-width:420px) {
 .whyPolicyCertificateWrapper .greenChannelDataPoints>ul>li p strong {
  font-size:3.8vw
 }
}
.whyPolicyCertificateWrapper .cities .greenChannelDataPoints {
 padding:16px;
 max-height:67vh;
 overflow:auto;
 margin-bottom:16px
}
@media screen and (max-width:1023px) {
 .whyPolicyCertificateWrapper .cities .greenChannelDataPoints {
  margin-bottom:0
 }
}
.whyPolicyCertificateWrapper .cityListWrapper ul {
 display:flex;
 flex-wrap:wrap
}
.whyPolicyCertificateWrapper .cityListWrapper ul li {
 width:33.33%;
 margin-bottom:16px;
 font-size:14px
}
@media screen and (max-width:420px) {
 .whyPolicyCertificateWrapper .cityListWrapper ul li {
  font-size:3.8vw
 }
}
@media screen and (max-width:1023px) {
 .whyPolicyCertificateWrapper .cityListWrapper ul li {
  width:50%
 }
}
.pl-16 {
 padding-left:16px!important
}
.mr-0 {
 margin-right:0!important
}
.gc_head {
 margin:32px 0 32px 16px
}
@media screen and (max-width:1023px) {
 .gc_head {
  margin:16px 0 32px 16px
 }
}
.greenChannel_widget_wrapper {
 background:#fff;
 padding:8px 0 4px;
 border-radius:4px
}
@media screen and (max-width:1023px) {
 .greenChannel_widget_wrapper {
  padding:4px 0;
  border-radius:0;
  margin-top:12px
 }
}
.greenChannel_widget {
 background:rgba(230,252,255,.5);
 border:1px solid #79e2f2;
 padding:16px 24px 16px 16px;
 border-radius:8px;
 margin:16px;
 position:relative
}
@media screen and (max-width:1023px) {
 .greenChannel_widget {
  margin:32px 16px 16px
 }
}
.greenChannel_widget .newLaunchTag {
 border-radius:4px 0 0 4px;
 background:#00b8d9;
 font-size:12px;
 font-weight:700;
 color:#fff;
 display:inline-block;
 position:relative;
 height:28px;
 margin:0;
 position:absolute;
 left:16px;
 top:-15px;
 line-height:normal;
 padding:6px 6px 5px 8px
}
@media screen and (max-width:420px) {
 .greenChannel_widget .newLaunchTag {
  font-size:3.2vw
 }
}
.greenChannel_widget .newLaunchTag:after {
 content:"";
 background:url(https://static.pbcdn.in/health-cdn/images/insurer-logo/quotes-logos/tag_green_newLaunch.svg) no-repeat -16px 0;
 width:18px;
 height:28px;
 position:absolute;
 right:-16px;
 top:0
}
@media screen and (max-width:1023px) {
 .greenChannel_widget .newLaunchTag {
  padding-top:7px
 }
}
.greenChannel_widget .widgetWrapper {
 display:flex;
 align-items:center
}
@media screen and (max-width:1023px) {
 .greenChannel_widget .widgetWrapper {
  flex-direction:column;
  align-items:unset
 }
}
.greenChannel_widget .widgetWrapper .gc_txt {
 width:calc(100% - 180px)
}
@media screen and (max-width:1023px) {
 .greenChannel_widget .widgetWrapper .gc_txt {
  width:100%
 }
}
.greenChannel_widget .widgetWrapper .gc_txt p {
 font-size:16px;
 color:#36b37e;
 font-weight:700
}
@media screen and (max-width:420px) {
 .greenChannel_widget .widgetWrapper .gc_txt p {
  font-size:4.5vw
 }
}
@media screen and (max-width:1023px) {
 .greenChannel_widget .widgetWrapper .gc_txt p {
  margin-bottom:8px
 }
}
.greenChannel_widget .widgetWrapper .gc_txt span {
 font-size:14px;
 color:#253858;
 font-weight:400;
 display:block;
 line-height:1.5
}
@media screen and (max-width:420px) {
 .greenChannel_widget .widgetWrapper .gc_txt span {
  font-size:3.8vw
 }
}
.greenChannel_widget .widgetWrapper .gc_txt .ongroundCitiCta {
 font-size:16px;
 font-weight:600;
 margin-top:16px
}
@media screen and (max-width:420px) {
 .greenChannel_widget .widgetWrapper .gc_txt .ongroundCitiCta {
  font-size:4.5vw
 }
}
.greenChannel_widget .widgetWrapper .gc_txt .ongroundCitiCta a {
 color:#ff5630;
 font-weight:700
}
.greenChannel_widget .widgetWrapper .gc_txt .ongroundCitiCta a:after {
 content:"";
 border:solid #ff5630;
 border-width:0 2px 2px 0;
 display:inline-block;
 padding:2px;
 transform:rotate(-45deg);
 position:relative;
 top:-1px;
 margin-left:4px
}
@media only screen and (max-width:1023px) {
 .greenChannel_widget .widgetWrapper .gc_txt .ongroundCitiCta {
  font-size:14px
 }
}
@media only screen and (max-width:1023px) and (max-width:420px) {
 .greenChannel_widget .widgetWrapper .gc_txt .ongroundCitiCta {
  font-size:3.8vw
 }
}
.greenChannel_widget .widgetWrapper .gc_btn {
 width:140px;
 margin-left:40px;
 -webkit-appearance:none;
 background:#fff;
 border-radius:4px;
 color:#ff5630!important;
 font-size:14px;
 font-weight:600;
 height:42px;
 border:1px solid #ff5630;
 cursor:pointer
}
@media screen and (max-width:420px) {
 .greenChannel_widget .widgetWrapper .gc_btn {
  font-size:3.8vw
 }
}
@media screen and (max-width:1023px) {
 .greenChannel_widget .widgetWrapper .gc_btn {
  margin-left:0;
  align-self:flex-end;
  margin-top:16px;
  width:100%
 }
}
.greenChannel_widget_mrgn {
 margin:32px 16px
}
.gc_product_head {
 margin:0 0 32px 16px
}
@media screen and (max-width:1023px) {
 .productBtmMargn {
  margin-bottom:12px
 }
}
.whyPolicyCertificateWrapper .addressWrapper {
 padding:0 16px 16px;
 overflow:auto
}
@media only screen and (min-width:1024px) {
 .whyPolicyCertificateWrapper .addressWrapper {
  max-height:570px
 }
}
@media only screen and (max-width:1023px) {
 .whyPolicyCertificateWrapper .addressWrapper {
  max-height:calc(100vh - 80px)
 }
}
.whyPolicyCertificateWrapper .addressWrapper .addressBlock {
 display:flex;
 flex-wrap:wrap;
 border-top:1px solid #dfe1e6;
 padding-top:24px;
 margin-top:24px
}
.whyPolicyCertificateWrapper .addressWrapper .addressBlock:first-child {
 padding-top:0;
 border:none;
 margin-top:0
}
.whyPolicyCertificateWrapper .addressWrapper .addressBlock__title {
 font-size:14px;
 color:#7a869a;
 font-weight:400
}
@media screen and (max-width:420px) {
 .whyPolicyCertificateWrapper .addressWrapper .addressBlock__title {
  font-size:3.8vw
 }
}
.whyPolicyCertificateWrapper .addressWrapper .addressBlock__val {
 font-size:20px;
 color:#253858;
 font-weight:700
}
.whyPolicyCertificateWrapper .addressWrapper .addressBlock>div {
 width:45%;
 margin-top:30px;
 position:relative;
 padding-left:58px;
 line-height:1.3
}
@media only screen and (max-width:1023px) {
 .whyPolicyCertificateWrapper .addressWrapper .addressBlock>div {
  width:100%
 }
}
.whyPolicyCertificateWrapper .addressWrapper .addressBlock>div:first-child {
 margin-top:0
}
.whyPolicyCertificateWrapper .addressWrapper .addressBlock>div i {
 width:40px;
 height:40px;
 position:absolute;
 left:0;
 top:0;
 background:#eae6ff;
 border-radius:4px;
 background:url(https://static.pbcdn.in/health-cdn/images/insurer-logo/quotes-logos/officeAddressIcons.svg) no-repeat 0 -82px
}
.whyPolicyCertificateWrapper .addressWrapper .addressBlock>div i.add {
 background-position:0 -82px
}
.whyPolicyCertificateWrapper .addressWrapper .addressBlock>div i.call {
 background-position:0 -138px
}
.whyPolicyCertificateWrapper .addressWrapper .addressBlock>div i.email {
 background-position:0 -194px
}
.whyPolicyCertificateWrapper .addressWrapper .addressBlock .address {
 width:100%;
 line-height:1.5
}
.whyPolicyCertificateWrapper .addressWrapper .addressBlock .address .addressBlock__val {
 font-size:16px;
 font-weight:400
}
@media screen and (max-width:420px) {
 .whyPolicyCertificateWrapper .addressWrapper .addressBlock .address .addressBlock__val {
  font-size:4.5vw
 }
}
.listingCheck ul li {
 margin:0 12px 8px 34px;
 list-style-type:disc!important
}
.edit_profile_container {
 display:flex;
 flex-direction:column;
 padding:20px 20px 0;
 max-height:63vh;
 overflow-y:auto
}
.edit_profile_city {
 display:flex;
 flex-direction:row;
 align-items:center
}
.edit_profile_div {
 display:flex;
 flex-direction:column
}
.span_edit_profile_city {
 font-size:14px;
 font-weight:500;
 color:#253858;
 padding-right:20px
}
.select_edit_profile {
 width:85%;
 color:#253858;
 font-weight:500;
 font-size:14px;
 text-align:left
}
.input_edit_profile_city {
 outline:none;
 border:none;
 border-bottom:1px solid rgba(0,0,0,.25);
 width:80%;
 font-size:14px;
 color:#253858;
 font-weight:500
}
.edit_profile_members {
 padding-top:20px;
 padding-bottom:15px
}
.div_members_covered {
 padding-top:15px;
 display:flex;
 flex-direction:column
}
.div_members_row {
 display:flex;
 flex-direction:row;
 margin-bottom:15px
}
.div_members_row_edit {
 display:flex;
 flex-direction:row;
 margin-right:10px
}
.div_members_error_row {
 display:flex;
 flex-direction:row;
 margin-bottom:5px;
 padding:10px
}
.div_members_error_row.epMobile {
 padding:0
}
.div_members_row:last-child {
 margin-bottom:0
}
.div_members_container {
 border:1px solid #d6d6d6;
 width:280px;
 border-radius:8px;
 background:#fff;
 padding:10px;
 display:flex;
 flex-direction:row;
 justify-content:space-between
}
.div_members_container_child {
 width:100%;
 padding:10px 0;
 display:flex;
 flex-direction:row
}
.child_container:first-child,
.div_members_container:first-child {
 margin-right:20px
}
.div_add_member_container {
 border-radius:18px;
 margin-right:20px;
 align-items:center;
 cursor:pointer;
 background-color:#36b37e;
 padding:8px;
 justify-content:center;
 display:flex;
 flex-direction:row
}
.span_add_member {
 font-size:14px;
 font-weight:500;
 color:#fff
}
.select_modify_age {
 background:none
}
.span_member_type {
 font-size:14px;
 font-weight:500;
 color:#253858
}
.label_checkbox_member_cover {
 display:flex;
 flex-direction:row;
 align-items:center;
 width:55%
}
.label_checkbox_member_cover.child_modify {
 margin-right:10px;
 width:100%
}
.checkbox_member_cover {
 -webkit-appearance:none;
 outline:none;
 width:20px;
 height:20px;
 margin:0 10px 0 0;
 border-radius:4px;
 background-color:#eaeaea
}
.checkbox_member_cover:after {
 -webkit-transform:rotate(45deg);
 transform:rotate(45deg);
 border-spacing:0;
 display:block;
 border:2px solid #fff;
 border-top:0;
 border-left:0;
 content:"";
 height:11px;
 margin-left:7px;
 margin-top:3px;
 width:5px
}
.checkbox_member_cover:checked {
 background:#36b37e;
 border:1px solid #36b37e
}
.checkbox_member_cover:checked:after {
 -webkit-transform:rotate(45deg);
 transform:rotate(45deg);
 border-spacing:0;
 display:block;
 border:2px solid #fff;
 border-top:0;
 border-left:0;
 content:"";
 height:11px;
 margin-left:7px;
 margin-top:3px;
 width:5px
}
.select_members_age {
 width:40%;
 display:flex;
 flex-direction:row;
 align-items:center
}
.select_members_age.child_dropdown {
 width:77%
}
.select_members_age.child_dropdown1 {
 width:100%
}
.add_button_member {
 color:#fff;
 margin-right:10px
}
.edit_profile_error {
 text-align:left;
 width:100%;
 font-size:12px;
 padding:5px 0;
 font-weight:500;
 color:#ff5630
}
.edit_profile_error.edit_popup_error {
 text-align:right;
 margin-right:27px
}
.edit_profile_error_city {
 width:100%;
 font-size:14px;
 margin-left:80px;
 font-weight:500;
 color:#ff5630
}
.select_members_age select {
 background-color:transparent;
 padding-top:4px;
 padding-bottom:4px;
 width:100%;
 background-size:8%;
 background-image:url("data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjQiIGhlaWdodD0iMTIiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PHBhdGggZD0iTTAgMGwxMiAxMkwyNCAweiIgZmlsbD0iIzAwMCIgZmlsbC1ydWxlPSJub256ZXJvIi8+PC9zdmc+");
 -webkit-appearance:none;
 -moz-appearance:none;
 appearance:none;
 background-repeat:no-repeat;
 background-position:99% 12px;
 padding-left:8px;
 border:none;
 outline:none
}
.child_span,
.select_members_age select {
 font-size:14px;
 color:#253858;
 font-weight:500
}
.child_span {
 margin-left:12px
}
@media screen and (max-width:1024px) {
 .field_wrapper_family {
  padding:16px
 }
 .box-container {
  display:flex;
  margin-bottom:12px;
  transition:all .5s ease-in;
  grid-template-columns:75% auto
 }
 .box-container>.field_container {
  background-color:#fff;
  height:48px;
  box-shadow:none;
  border-radius:3px;
  font-size:14px;
  color:#253858;
  position:relative;
  border:1px solid rgba(37,56,88,.2);
  width:calc(60% - 10px);
  margin-right:10px
 }
 .box-container.full>.field_container {
  width:100%;
  margin-right:0
 }
 .checkbox-family {
  display:flex
 }
 .checkbox-family label {
  position:relative;
  height:50px;
  width:100%;
  cursor:pointer
 }
 .checkbox-family label input[type=checkbox] {
  opacity:0;
  visibility:hidden;
  position:absolute;
  z-index:1
 }
 .checkbox-family label input[type=checkbox]+span {
  width:100%;
  height:48px;
  padding:10px 10px 10px 40px;
  border:1px solid transparent;
  font-style:normal;
  display:block;
  color:#253858;
  line-height:25px
 }
 .checkbox-family label input[type=checkbox]+span:before {
  content:"";
  width:18px;
  height:18px;
  background:#fff;
  border-radius:50%;
  position:absolute;
  left:9px;
  top:15px;
  border:1px solid #7a869a
 }
 .checkbox-family label input[type=checkbox]:checked+span:before {
  content:"";
  background:#36b37e;
  border:1px solid #36b37e
 }
 .checkbox-family label input[type=checkbox]:checked+span:after {
  content:"";
  display:block;
  width:5px;
  height:9px;
  border:solid #fff;
  border-width:0 2px 2px 0;
  transform:rotate(45deg);
  position:absolute;
  left:16px;
  top:19px
 }
 .box_family {
  width:40%;
  position:relative
 }
 .box_family select {
  background:#fff;
  border-radius:3px;
  box-shadow:none;
  display:block;
  width:100%;
  height:50px;
  padding:10px 30px 10px 13px;
  border:1px solid rgba(37,56,88,.2);
  font-size:14px;
  color:#253858;
  line-height:27px;
  transition:border .3s ease-in;
  -webkit-appearance:none;
  outline:none
 }
 .box_family .error {
  border:1px solid #ff5630!important
 }
 .box_family:after {
  content:"";
  border:solid #253858;
  border-width:0 1.5px 1.5px 0;
  display:inline-block;
  padding:3px;
  transform:rotate(45deg);
  margin-left:3px;
  vertical-align:middle;
  position:absolute;
  top:20px;
  right:11px;
  z-index:1
 }
 .box-container.kids {
  display:block
 }
 .kids_box-container .field_container {
  font-size:14px;
  color:#212121;
  align-items:center;
  display:inline-block;
  position:relative;
  background:#fff;
  box-shadow:none;
  border-radius:3px;
  padding-left:13px;
  border:1px solid rgba(37,56,88,.2);
  width:calc(70% - 10px);
  line-height:48px;
  margin-right:10px
 }
 .kids_box-container .select_box {
  width:calc(100% - 10px);
  margin-left:10px
 }
 .checklist_son {
  position:absolute;
  right:0;
  top:0;
  padding-top:12px;
  width:115px;
  height:48px
 }
 .radio_kids label {
  margin:0 2px 9px;
  display:inline-block;
  cursor:pointer
 }
 .radio_kids .click_add_2 {
  margin-left:48px!important
 }
 .radio_kids .circle_kids {
  background:#fff;
  border-radius:40px;
  box-shadow:0 2px 4px rgba(0,0,0,.1);
  display:inline-block;
  align-items:center;
  border:1px solid #b3bac5;
  font-style:normal;
  font-size:18px;
  color:#b3bac5;
  width:24px;
  height:24px;
  line-height:21px;
  text-align:center
 }
 .radio_kids .circle_active {
  border:1px solid #253858;
  color:#253858;
  background:#fff
 }
 .checklist_son .input_kid {
  width:36px;
  height:24px;
  border:1px solid #b3bac5;
  top:12px;
  left:32px;
  position:absolute;
  border-radius:4px;
  font-size:14px;
  color:#b3bac5;
  text-align:center;
  line-height:22px
 }
 .checklist_son .active {
  border:1px solid #253858;
  color:#253858;
  background:#fff
 }
 .box-container.kids>.field_container {
  width:100%
 }
 .kids_box-container {
  display:flex;
  margin:10px 10px 0;
  height:48px
 }
 .navbarWrapper {
  position:sticky;
  top:0;
  z-index:39;
  box-shadow:0 3px 2px 0 rgba(0,0,0,.1);
  background:#fff
 }
 .header_container {
  background:#fff;
  margin:0 auto;
  width:100%;
  padding:0 16px;
  justify-content:space-between;
  min-height:55px;
  align-items:center
 }
 .arrow-back {
  margin-right:10px
 }
 .close_cart {
  width:32px;
  height:32px;
  background:none;
  border-radius:30px;
  text-indent:-999999px;
  position:relative
 }
 .close_cart:after,
 .close_cart:before {
  content:"";
  width:2px;
  height:21px;
  display:block;
  position:absolute;
  left:50%;
  top:50%;
  background:#253858;
  border-radius:2px
 }
 .close_cart:after {
  transform:translate(-50%,-50%) rotate(-45deg)
 }
 .close_cart:before {
  transform:translate(-50%,-50%) rotate(45deg)
 }
 .flexRow {
  display:flex
 }
 .wrapper-product {
  margin:0
 }
 .product-container .rowWrapper {
  padding:0
 }
 .cart_wrapper_inner {
  padding:0;
  overflow-y:auto;
  height:calc(100vh - 55px);
  position:fixed;
  width:100%
 }
 .relationship_dd {
  width:calc(70% - 10px);
  margin-right:10px
 }
 .edit_apply_button {
  display:inline-block;
  width:100%;
  height:48px;
  background:#ff5630;
  color:#fff;
  font-size:14px;
  font-weight:600;
  text-transform:uppercase;
  border-radius:4px;
  text-align:center;
  line-height:48px;
  padding:0;
  cursor:pointer
 }
}
@media screen and (max-width:1024px) and (max-width:420px) {
 .edit_apply_button {
  font-size:3.8vw
 }
}
@media screen and (max-width:1024px) {
 .edit_popup_button {
  bottom:0;
  position:fixed;
  box-shadow:0 -3px 6px 0 rgba(0,0,0,.16);
  background:#fff;
  z-index:9;
  padding:0 12px 12px;
  height:auto;
  display:flex;
  flex-direction:column;
  width:100%!important;
  margin-top:0!important
 }
 .editMemberWrapperMobile {
  animation:slideupEditMembers .3s ease-out forwards
 }
 @keyframes slideupEditMembers {
  0% {
   transform:translateY(100%)
  }
  to {
   transform:translateY(0)
  }
 }
}
@media screen and (min-width:1024px) {
 .editMemberWrapperDesktop {
  width:100%;
  left:0;
  background:transparent
 }
 .editMemberWrapperDesktop .editmembersWrapper {
  width:450px;
  right:0;
  height:100%;
  animation:slideinEditMembers .3s ease-out forwards;
  position:fixed
 }
 .editMemberWrapperDesktop #overlay_check {
  position:fixed;
  width:100%;
  height:100%;
  background:rgba(23,43,77,.9);
  animation:maskOpacity .3s ease-out forwards
 }
 .editMemberWrapperDesktop .edit_popup_button {
  bottom:0;
  position:fixed;
  box-shadow:0 -3px 6px 0 rgba(0,0,0,.16);
  background:#fff;
  z-index:9;
  height:auto;
  display:flex;
  flex-direction:column;
  width:450px!important;
  margin-top:0!important
 }
 .editMemberWrapperDesktop .edit_apply_button {
  display:inline-block;
  width:100%;
  height:48px;
  background:#ff5630;
  color:#fff;
  font-size:14px;
  font-weight:500;
  text-transform:uppercase;
  border-radius:4px;
  text-align:center;
  line-height:48px;
  padding:0;
  cursor:pointer
 }
}
@media screen and (min-width:1024px) and (max-width:420px) {
 .editMemberWrapperDesktop .edit_apply_button {
  font-size:3.8vw
 }
}
@media screen and (min-width:1024px) {
 @keyframes maskOpacity {
  0% {
   opacity:0
  }
  to {
   opacity:1
  }
 }
 @keyframes slideinEditMembers {
  0% {
   transform:translateX(100%)
  }
  to {
   transform:translateX(0)
  }
 }
}
.quotes_filterBar {
 display:flex;
 flex-direction:row;
 width:100%;
 padding-top:20px;
 padding-bottom:20px;
 max-width:1170px;
 margin:0 auto
}
.quotes_sorting {
 position:relative;
 cursor:pointer;
 display:flex;
 flex-direction:column;
 justify-content:center;
 padding:0 11px;
 background:#fff;
 border-radius:3px;
 box-shadow:0 2px 9px 0 hsla(0,0%,87.1%,.3);
 border:1px solid #e6efff
}
.quotes_sorting.selected {
 border:1px solid #36b37e
}
.img_filter {
 width:16px
}
.img_filter_popup {
 width:16px;
 margin-left:5px
}
.insurer_checkbox_label {
 display:flex;
 flex-direction:row;
 width:100%
}
.insurer_checkbox_container {
 align-items:flex-start;
 padding:10px 10px 0;
 width:100%
}
.quotes_filter_insurer {
 width:22%
}
.quotes_filter_insurer,
.quotes_filter_insurer1 {
 position:relative;
 display:flex;
 flex-direction:row;
 margin-left:15px;
 cursor:pointer;
 padding:12px 17px;
 background:#fff;
 border-radius:3px;
 box-shadow:0 2px 9px 0 hsla(0,0%,87.1%,.3);
 border:1px solid #e6efff;
 align-items:center
}
.quotes_filter_insurer1 {
 width:14%
}
.quotes_filter_insurer2 {
 width:20%
}
.quotes_filter_insurer2,
.quotes_filter_insurer3 {
 position:relative;
 display:flex;
 flex-direction:row;
 margin-left:15px;
 cursor:pointer;
 padding:12px 17px;
 background:#fff;
 border-radius:3px;
 box-shadow:0 2px 9px 0 hsla(0,0%,87.1%,.3);
 border:1px solid #e6efff;
 align-items:center
}
.quotes_filter_insurer3 {
 width:14%
}
.quotes_filter_insurer4 {
 width:25%
}
.quotes_filter_insurer4,
.quotes_filter_insurer5 {
 position:relative;
 display:flex;
 flex-direction:row;
 margin-left:15px;
 cursor:pointer;
 padding:12px 17px;
 background:#fff;
 border-radius:3px;
 box-shadow:0 2px 9px 0 hsla(0,0%,87.1%,.3);
 border:1px solid #e6efff;
 align-items:center
}
.quotes_filter_insurer5 {
 width:19%
}
.quotes_filter_insurer_other {
 position:relative;
 margin-left:15px;
 cursor:pointer;
 display:flex;
 flex-direction:row;
 padding:12px 17px;
 width:15%;
 background:#fff;
 border-radius:3px;
 box-shadow:0 2px 9px 0 hsla(0,0%,87.1%,.3);
 border:1px solid #e6efff;
 align-items:center
}
.quotes_filter_insurer1.selected,
.quotes_filter_insurer2.selected,
.quotes_filter_insurer3.selected,
.quotes_filter_insurer4.selected,
.quotes_filter_insurer5.selected,
.quotes_filter_insurer.selected {
 border:1px solid #36b37e!important;
 color:#36b37e!important
}
.quotes_filter_insurer_other.selected {
 border:1px solid #36b37e;
 color:#36b37e!important
}
.span_quotes_filter_insurer {
 color:#253858;
 font-size:14px
}
.span_quotes_filter_insurer.selected {
 color:#36b37e
}
.info_svg {
 margin-left:10px;
 width:11px;
 height:11px
}
.insurer_popup {
 min-width:500px;
 width:500px
}
.insurer_popup,
.insurer_popup1 {
 overflow:hidden;
 border-radius:3px;
 display:flex;
 flex-direction:column;
 box-shadow:0 0 10px 0 rgba(0,0,0,.25);
 position:absolute;
 background:#fff;
 z-index:101;
 top:0;
 left:0
}
.insurer_popup1 {
 min-width:420px;
 width:420px
}
.byop_popup {
 max-width:100%;
 min-width:100%;
 overflow:hidden;
 border-radius:3px;
 display:flex;
 flex-direction:column;
 position:static;
 background:#fff;
 z-index:101;
 top:0;
 right:0
}
.byop_popup_checkPremium {
 max-width:inherit;
 min-width:625px;
 top:2%;
 right:50%;
 position:absolute;
 box-shadow:0 3px 10px 0 rgba(0,0,0,.16);
 border-radius:10px;
 background-color:#fff;
 transform:translateX(50%)
}
.cart_popup {
 max-width:600px;
 min-width:600px;
 border-radius:3px;
 right:0
}
.cart_popup,
.compare_popup {
 overflow:hidden;
 display:flex;
 flex-direction:column;
 box-shadow:0 0 10px 0 rgba(0,0,0,.25);
 position:absolute;
 background:#fff;
 z-index:101;
 top:0
}
.compare_popup {
 max-width:250px;
 min-width:250px;
 border-radius:10px;
 right:-42px
}
.cart_top_bar {
 display:flex;
 flex-direction:row;
 width:100%;
 padding:10px
}
.compare_feature_button {
 width:100%;
 margin:5px
}
.span_cross_compare {
 margin-left:auto;
 float:right;
 padding:2px;
 cursor:pointer
}
.cart_top_bar1 {
 display:flex;
 flex-direction:column;
 width:100%;
 padding:10px
}
.cart_top_bar_span {
 font-size:14px;
 font-weight:500;
 color:#253858
}
.cart_top_bar_span.plan {
 width:40%
}
.cart_top_bar_span.term {
 width:15%;
 text-align:right
}
.dropDown_filterBar {
 background-image:url(data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjQiIGhlaWdodD0iMTIiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PHBhdGggZD0iTTAgMGwxMiAxMkwyNCAweiIgZmlsbD0iIzAwMCIgZmlsbC1ydWxlPSJub256ZXJvIi8+PC9zdmc+);
 -webkit-appearance:none;
 margin:auto 0 auto auto
}
.cart_top_bar_span.premium,
.cart_top_bar_span.sum {
 width:22.5%;
 text-align:right
}
.cart_top_bar_span.member {
 width:84%;
 padding-bottom:5px;
 border-bottom:1px solid #efefef
}
.cart_top_bar_span.delete_member {
 width:16%;
 padding-bottom:5px;
 border-bottom:1px solid #efefef;
 cursor:pointer;
 text-align:right;
 color:#ff5630
}
.cart_top_bar_span_table {
 font-size:14px;
 color:#253858
}
.cart_plan_container {
 width:40%;
 display:flex;
 flex-direction:column
}
.cart_top_bar_span_table.plan {
 width:100%;
 padding-top:5px
}
.cart_top_bar_span_table.sum {
 width:22.5%;
 text-align:right
}
.cart_top_bar_span_table.term {
 width:15%;
 text-align:right
}
.cart_top_bar_span_table.premium {
 width:22.5%;
 text-align:right
}
.cart_top_bar_span_table.member {
 width:100%
}
.sort_popup {
 min-width:370px;
 overflow:hidden;
 width:370px
}
.feature_popup,
.sort_popup {
 border-radius:3px;
 display:flex;
 flex-direction:column;
 box-shadow:0 0 10px 0 rgba(0,0,0,.25);
 position:absolute;
 background:#fff;
 z-index:101;
 top:0;
 left:0
}
.feature_popup {
 min-width:320px;
 width:320px
}
.edit_popup {
 min-width:640px;
 width:640px;
 right:0
}
.edit_popup,
.plan_popup {
 overflow:hidden;
 border-radius:3px;
 display:flex;
 flex-direction:column;
 box-shadow:0 0 10px 0 rgba(0,0,0,.25);
 position:absolute;
 background:#fff;
 z-index:101;
 top:0
}
.plan_popup {
 min-width:200px;
 max-height:350px;
 width:200px;
 left:0
}
.span_insurer_popup_heading {
 color:#253858;
 font-size:14px;
 font-weight:500
}
.span_insurer_popup_heading.selected {
 color:#36b37e
}
.span_insurer_popup_heading_checkPremium {
 color:#212121;
 font-size:16px;
 padding-left:14px;
 line-height:1.5;
 padding-top:17px
}
.div_insurer_popup_heading {
 padding:10px 10px 10px 20px;
 width:20%;
 cursor:pointer
}
.div_insurer_popup_heading.selected {
 border-bottom:2px solid #36b37e
}
.insurer_popup_heading {
 padding:10px
}
.byop_popup_heading,
.insurer_popup_heading,
.insurer_popup_heading1 {
 border-bottom:1px solid #dcdcdc;
 display:flex;
 flex-direction:row
}
.byop_popup_heading {
 justify-content:flex-start;
 align-items:center;
 text-align:left;
 width:100%;
 padding:10px
}
.checkPremiumHeading {
 border-bottom:none!important;
 margin:16px 0 0 16px;
 font-weight:700
}
.seniorCitizen_error {
 text-align:center;
 font-weight:300;
 width:100%;
 padding-left:0
}
.seniorCitizen_error .errorHead {
 font-size:20px;
 margin-bottom:20px
}
.seniorCitizen_error .errorMsg {
 font-size:14px;
 line-height:1.5
}
.sort_popup_heading {
 border-bottom:1px solid #dcdcdc;
 padding:10px;
 align-items:center;
 display:flex;
 flex-direction:row
}
.insurer_div {
 display:flex;
 flex-direction:row;
 width:100%
}
.cover_div {
 overflow-y:auto
}
.cover_div,
.deductible-div {
 width:100%;
 max-height:50vh
}
.supplier_icon {
 width:10%;
 position:relative;
 background-repeat:no-repeat;
 height:30px;
 padding:5px;
 margin-left:10px;
 background-image:url(https://static.pbcdn.in/health-cdn/images/insurer-logo/quotes-logos/sprite-logo.png)
}
.Aditya_Birla_icon {
 background-position:2px 10px
}
.Apollo_Munich_icon {
 background-position:1px -46px
}
.Bajaj_Allianz_icon {
 background-position:0 -95px
}
.Bharti_Axa_icon {
 background-position:0 -1352px
}
.CignaTTK_icon,
.ManipalCigna_icon {
 background-position:2px -138px
}
.DIGIT_icon {
 background-position:-1px -195px
}
.Edelweiss_icon {
 background-position:0 -255px
}
.Future_Generali_icon {
 background-position:1px -323px
}
.HDFC_ERGO_icon {
 background-position:1px -392px
}
.Iffco_Tokio_icon {
 background-position:-2px -458px
}
.Kotak_General_Insurance_icon {
 background-position:1px -529px
}
.Liberty_Videocon_icon {
 background-position:1px -598px
}
.Max_Bupa_icon {
 background-position:3px -670px
}
.New_India_Assurance_icon {
 background-position:3px -1310px
}
.Oriental_icon {
 background-position:4px -751px
}
.Reliance_icon {
 background-position:3px -829px
}
.HDFC_ERGO_General_icon,
.HDFC_ERGO_Health_icon {
 background-position:-3px -1603px
}
.Reliance_Health_Insurance_icon,
.Reliance_Health_insurance_icon {
 background-position:1px -1480px
}
.Care_Health_icon {
 background-position:0 -904px
}
.Religare_icon {
 background-position:2px -901px
}
.Royal_Sundaram_icon {
 background-position:-1px -970px
}
.SBI_icon {
 background-position:-1px -1045px
}
.Raheja_QBE_icon {
 background-position:1px -1542px
}
.Star_Health_icon {
 background-position:2px -1108px
}
.Tata_AIG_icon {
 background-position:3px -1155px
}
.United_Insurance_icon {
 background-position:2px -1202px
}
.Universal_Sompo_icon {
 background-position:0 -1251px
}
.HDFC_Life_icon {
 background-position:0 -1416px
}
.Liberty_General_Insurance_icon {
 background-position:3px -598px
}
.Cholamandalam_icon {
 background-position:-3px -1776px
}
.MAGMA_HDI_icon {
 background-position:0 -1660px
}
.supplier_name {
 width:70%;
 display:flex;
 align-items:center;
 padding:5px 10px 10px
}
.span_supplier_name {
 font-size:14px;
 font-weight:500;
 color:#253858;
 margin-left:-6px
}
@media screen and (max-width:420px) {
 .span_supplier_name {
  font-size:3.8vw
 }
}
.cover_range {
 padding:25px 25px 0
}
.cover_range_show {
 display:flex;
 flex-direction:row;
 align-items:center;
 justify-content:center;
 width:100%;
 padding-top:10px
}
.span_cover_range {
 font-size:24px;
 color:#253858;
 padding:10px;
 text-align:center;
 font-weight:500
}
.input-range {
 width:95%
}
.input_cover_range {
 width:90%;
 text-align:center;
 border-radius:2px;
 font-size:14px;
 padding:5px;
 outline:none;
 border:1px solid #d8d8d8;
 border-bottom-color:#cacaca;
 font-size:24px;
 font-weight:500;
 align-items:center;
 color:#253858
}
input[type=number]::-webkit-inner-spin-button,
input[type=number]::-webkit-outer-spin-button {
 -webkit-appearance:none;
 margin:0
}
input[type=number] {
 -moz-appearance:textfield
}
.div_members_row1 {
 width:calc(50% - 20px);
 margin-bottom:20px
}
.cover_buttons {
 display:flex;
 flex-direction:row;
 align-items:center;
 width:100%
}
.close_button {
 width:100%;
 border:1px solid #666;
 border-radius:4px;
 margin:20px;
 color:#666
}
.close_button,
.close_button_checkPremium {
 cursor:pointer;
 padding:10px;
 font-size:16px;
 text-align:center;
 font-weight:500
}
.close_button_checkPremium {
 width:50%;
 border:1px solid #c9c9c9;
 border-radius:4px;
 margin:0 0 0 26%;
 color:#bababa
}
.apply_button {
 background:#ff5630;
 border-radius:4px
}
.apply_button,
.checkPremium_apply_button {
 width:100%;
 cursor:pointer;
 padding:10px;
 font-size:16px;
 text-align:center;
 font-weight:500;
 margin:20px;
 color:#fff;
 display:flex;
 justify-content:center;
 height:48px
}
.checkPremium_apply_button {
 border-radius:8px;
 background-color:#ff5630;
 position:relative
}
.select_members_age1 {
 position:relative;
 width:100%
}
.select_members_age1:after {
 content:"";
 border:solid #212121;
 border-width:0 1.5px 1.5px 0;
 display:inline-block;
 padding:3px;
 transform:rotate(45deg);
 vertical-align:middle;
 position:absolute;
 top:20px;
 right:20px;
 z-index:1
}
.select_members_age1.child_select:after {
 top:30px
}
.checkPremium_Selectbox {
 border-radius:3px;
 border:1px solid rgba(37,56,88,.2);
 padding:17px 10px;
 width:100%;
 display:flex;
 flex-direction:row;
 align-items:center;
 -webkit-appearance:none;
 background:transparent;
 margin-top:8px;
 font-size:14px;
 font-weight:500;
 color:#253858;
 outline:none;
 position:relative;
 z-index:2
}
.checkPremium_Selectbox.select_color {
 color:#999
}
.checkPremiumMembers {
 font-size:14px;
 font-weight:500;
 color:#253858;
 margin-left:12px
}
.checkPremium_modify_group_div {
 width:100%;
 padding:14px 30px 0 24px;
 display:flex;
 flex-direction:row;
 justify-content:space-between;
 flex-flow:wrap
}
.apply_button.disabled {
 background:#ccc;
 cursor:none;
 pointer-events:none
}
.input-range__slider {
 background:#36b37e;
 border:1px solid #36b37e
}
.input-range__track {
 background:#d8d8d8;
 opacity:.59;
 height:3px
}
.input-range__track--active {
 background:#36b37e
}
.filter_plan_name {
 display:flex;
 flex-direction:column;
 width:100%;
 margin:0 10px;
 padding:10px;
 align-items:center;
 border-bottom:1px solid #ededed
}
.span_filter_plan_name {
 font-size:14px;
 font-weight:500;
 color:#253858
}
.span_filter_plan_name.selected {
 color:#36b37e
}
.filter_sort_type {
 display:flex;
 flex-direction:row;
 padding:10px;
 width:65%
}
.img_sort {
 width:40px;
 height:40px;
 margin-bottom:12px
}
.img_sort_mobile {
 width:24px;
 height:24px;
 margin:0 10px
}
.filter_sort_relevance {
 display:flex;
 margin-left:10px;
 flex-direction:column;
 align-items:center;
 width:100%;
 padding:10px 0 0 10px;
 border:1px solid #253858;
 border-radius:5px
}
.filter_sort_relevance.selected {
 border:1px solid #36b37e
}
.filter_sort_most {
 display:flex;
 margin-right:10px;
 margin-left:10px;
 flex-direction:column;
 align-items:center;
 width:100%;
 padding:10px;
 border:1px solid #253858;
 border-radius:5px
}
.filter_sort_most.selected {
 border:1px solid #36b37e
}
.span_filter_sort {
 font-size:12px;
 color:#253858;
 text-align:center
}
.span_filter_sort.selected {
 color:#36b37e
}
.filter_pre_existing {
 padding:20px;
 display:flex;
 flex-direction:column
}
.span_filter_pre_existing {
 font-size:14px;
 font-weight:500;
 color:#253858;
 width:100%;
 padding-bottom:14px;
 padding-top:10px
}
.label_special_feature {
 display:flex;
 flex-direction:row;
 align-items:center;
 padding-bottom:10px
}
input:checked~span.span_special_feature {
 color:#36b37e
}
.span_special_feature {
 font-size:12px;
 font-weight:500;
 color:#253858
}
.checkbox_filter {
 -webkit-appearance:none;
 outline:none;
 width:15px;
 height:15px;
 margin:0 10px 0 0;
 border:1px solid #979797;
 border-radius:3px
}
.checkbox_filter:checked {
 background:#36b37e;
 border:1px solid #36b37e
}
.checkbox_filter:checked:after {
 -webkit-transform:rotate(45deg);
 transform:rotate(45deg);
 border-spacing:0;
 display:block;
 border:2px solid #fff;
 border-top:0;
 border-left:0;
 content:"";
 height:11px;
 margin-left:4px;
 width:5px
}
.radio_filter {
 width:16px;
 height:16px;
 margin:0 10px 0 0
}
.filter_mobile_drop {
 padding:10px
}
.filter_mobile_drop,
.filter_mobile_drop1 {
 display:flex;
 flex-direction:row;
 width:100%
}
.filter_mobile_drop1 {
 padding:0 10px 10px
}
.span_filter_cover_min {
 font-size:12px;
 text-align:center;
 color:#253858;
 font-weight:500;
 opacity:.95;
 width:30.33%;
 -webkit-backdrop-filter:blur(3px);
 backdrop-filter:blur(3px);
 border-radius:20px;
 border:1px solid #253858;
 background-color:#fff;
 padding:5px 12px;
 margin-left:5px;
 margin-right:5px
}
.span_filter_cover_min.selected {
 color:#fff;
 opacity:.95;
 background:#36b37e;
 border:1px solid #36b37e
}
.filter_mobile_input_div {
 display:flex;
 margin-left:10px;
 margin-right:10px;
 flex-direction:column;
 width:26%
}
.span_min_cover_mobile {
 font-size:12px;
 font-weight:500;
 color:#253858
}
input[type=radio]:checked:before {
 content:"";
 display:block;
 position:relative;
 top:3px;
 left:3px;
 width:9px;
 height:9px;
 border-radius:50%;
 border-color:#36b37e;
 background:#36b37e
}
.container-radio {
 display:block;
 position:relative;
 padding-left:24px;
 margin-bottom:12px;
 cursor:pointer;
 font-size:12px;
 -webkit-user-select:none;
 -moz-user-select:none;
 -ms-user-select:none;
 user-select:none;
 color:#253858;
 font-weight:500
}
.container-radio input {
 position:absolute;
 opacity:0;
 cursor:pointer
}
.checkmark-radio {
 position:absolute;
 top:0;
 left:0;
 height:16px;
 width:16px;
 background-color:#fff;
 border-radius:50%
}
.checkmark-radio,
.checkmark-radio:checked {
 border:1px solid #9d9d9d
}
.container-radio:hover input~.checkmark-radio,
.container-radio input:checked~.checkmark-radio {
 background-color:#fff
}
.checkmark-radio:after {
 content:"";
 position:absolute;
 display:none
}
.container-radio input:checked~.checkmark-radio:after {
 display:block
}
.container-radio .checkmark-radio:after {
 top:3px;
 left:3px;
 width:8px;
 height:8px;
 border-radius:50%;
 background:#55c2a9
}
.container-radio input:checked~span.special_filter {
 color:#36b37e
}
.error_modify {
 text-align:right!important;
 margin-right:30px
}
.isModifyGroupButtonClass {
 display:flex!important
}
select,
select option {
 color:#000
}
select:invalid,
select option[value=""] {
 color:#999
}
.modifyGroupMobileAction {
 position:static;
 margin:20px 16px;
 width:auto;
 text-align:right;
 display:block
}
.modifyGroupMobileAction .close_button_checkPremium {
 margin:0;
 color:#999
}
.modifyGroupMobileAction .checkPremium_apply_button,
.modifyGroupMobileAction .close_button_checkPremium {
 height:48px;
 font-size:14px;
 text-transform:uppercase;
 width:auto;
 padding:16px 24px;
 border-radius:8px;
 display:inline-block;
 vertical-align:middle;
 line-height:14px
}
.modifyGroupMobileAction .checkPremium_apply_button {
 margin:0 0 0 12px
}
.close-box-byop {
 display:none
}
@media screen and (max-width:1023px) {
 .filter_mobile_top {
  display:flex;
  flex-direction:row;
  width:100%;
  align-items:center;
  height:56px;
  box-shadow:0 2px 4px rgba(0,0,0,.16)
 }
 .white_bg .cross_features_popup {
  top:inherit;
  right:8px;
  background:none
 }
 .filter_mobile_heading {
  width:50%;
  padding-left:20px;
  font-size:18px;
  font-weight:500;
  color:#253858
 }
 .filter_mobile_reset {
  width:50%;
  justify-content:flex-end;
  display:flex;
  flex-direction:row;
  align-items:center
 }
 .span_filter_mobile_reset {
  font-size:14px;
  color:#253858;
  height:48px;
  font-weight:500;
  display:flex;
  width:100%;
  padding:0 20px;
  align-items:center
 }
}
@media screen and (max-width:1023px) and (max-width:420px) {
 .span_filter_mobile_reset {
  font-size:3.8vw
 }
}
@media screen and (max-width:1023px) {
 .filter_mobile_apply_button {
  width:60%;
  background:#ff5630;
  cursor:pointer;
  padding:0 20px;
  font-size:14px;
  text-align:center;
  font-weight:600;
  color:#fff;
  display:flex;
  justify-content:center;
  height:48px;
  border-radius:4px;
  align-items:center;
  text-transform:uppercase
 }
}
@media screen and (max-width:1023px) and (max-width:420px) {
 .filter_mobile_apply_button {
  font-size:3.8vw
 }
}
@media screen and (max-width:1023px) {
 .filter_mobile_table {
  max-height:73%;
  overflow-y:auto;
  overflow-x:hidden;
  padding:25px 0 0
 }
 .insurer_checkbox_label {
  border-bottom:1px solid #efefef
 }
 .filter_sort_type {
  width:65%
 }
 .cart_top_bar_span.sum,
 .cart_top_bar_span.term,
 .cart_top_bar_span_table.sum,
 .cart_top_bar_span_table.term {
  text-align:left
 }
 .cover_buttons {
  position:fixed;
  bottom:0
 }
 .span_cover_range {
  font-size:12px;
  padding:0;
  line-height:46px
 }
 .filter_mobile_drop {
  padding:10px
 }
 .filter_mobile_drop,
 .filter_mobile_drop1 {
  display:flex;
  flex-direction:row;
  width:100%
 }
 .filter_mobile_drop1 {
  padding:0 10px 10px
 }
 .filter_mobile_hospital,
 .filter_mobile_preExist {
  margin-left:10px;
  outline:none;
  padding:10px 10px 10px 0;
  font-size:14px;
  font-weight:500;
  color:#253858;
  background:none;
  width:100%;
  border:none;
  border-bottom:1px solid #36b37e
 }
 .span_filter_select_insurer {
  padding-left:20px;
  font-size:14px;
  font-weight:700;
  color:#253858;
  padding-bottom:25px
 }
}
@media screen and (max-width:1023px) and (max-width:420px) {
 .span_filter_select_insurer {
  font-size:3.8vw
 }
}
@media screen and (max-width:1023px) {
 .span_filter_mobile_maternity {
  font-size:14px;
  color:#253858;
  padding:0 0 0 34px;
  margin:12px 22px 0 0;
  position:relative
 }
}
@media screen and (max-width:1023px) and (max-width:420px) {
 .span_filter_mobile_maternity {
  font-size:3.8vw
 }
}
@media screen and (max-width:1023px) {
 .span_filter_mobile_maternity:after {
  width:22px;
  height:22px;
  content:"";
  position:absolute;
  left:0;
  top:0;
  border:2px solid #5e6c84;
  border-radius:3px
 }
 .span_filter_mobile_maternity.selected {
  color:#36b37e
 }
 .span_filter_mobile_maternity.selected:after {
  border:2px solid #36b37e;
  background:#36b37e
 }
 .span_filter_mobile_maternity.selected:before {
  -webkit-transform:rotate(45deg);
  transform:rotate(45deg);
  border:2px solid #fff;
  border-top:0;
  border-left:0;
  content:"";
  height:14px;
  margin-left:3px;
  width:7px;
  position:absolute;
  left:5px;
  top:2px;
  z-index:1
 }
 .input_cover_range {
  border:1px solid #5e6c84;
  width:100%;
  text-align:center;
  border-radius:4px;
  font-size:16px;
  padding:5px;
  outline:none;
  height:46px
 }
 .filter_mobile_input_div {
  display:flex;
  margin-left:0;
  margin-right:0;
  flex-direction:column;
  width:44%
 }
 .span_min_cover_mobile {
  font-size:12px;
  font-weight:500;
  color:#253858
 }
 .byop_popup_checkPremium {
  max-width:100%;
  min-width:100%;
  top:auto;
  right:0;
  left:0;
  box-shadow:0 3px 10px 0 rgba(0,0,0,.16);
  border-radius:10px 10px 0 0;
  background-color:#fff;
  transform:none;
  bottom:0;
  height:auto;
  position:fixed;
  overflow:auto
 }
 .span_insurer_popup_heading_checkPremium {
  font-size:14px
 }
 .label_checkbox_member_cover {
  width:100%;
  margin-right:10px
 }
 .select_members_age {
  width:50%
 }
 .white_filter_bg {
  background:#fff!important
 }
 .filter_sort_section {
  display:flex;
  justify-content:space-between;
  margin:8px 16px 26px
 }
 .sort_section_new {
  background:#fff;
  border:1px solid #5e6c84;
  height:48px;
  font-size:16px;
  font-weight:600;
  color:#253858;
  display:flex;
  align-items:center;
  border-radius:4px;
  width:48%
 }
}
@media screen and (max-width:1023px) and (max-width:420px) {
 .sort_section_new {
  font-size:4.5vw
 }
}
@media screen and (max-width:1023px) {
 .sort_section_new.active {
  background:#f2fcf8;
  border:1px solid #36b37e;
  color:#36b37e
 }
 .filter_select_box {
  border:1px solid #5e6c84;
  padding:0!important;
  margin:15px 16px 26px;
  width:calc(100% - 32px)!important;
  height:56px;
  border-radius:4px;
  position:relative
 }
 .filter_select_box .filter_mobile_hospital,
 .filter_select_box .filter_mobile_preExist {
  border-bottom:none;
  padding-top:15px;
  font-size:16px;
  -webkit-appearance:none;
  -moz-appearance:none;
  appearance:none;
  margin-left:16px;
  font-weight:400
 }
}
@media screen and (max-width:1023px) and (max-width:420px) {
 .filter_select_box .filter_mobile_hospital,
 .filter_select_box .filter_mobile_preExist {
  font-size:4.5vw
 }
}
@media screen and (max-width:1023px) {
 .filter_select_box .filter_select_label {
  color:#5e6c84;
  font-size:12px;
  position:absolute;
  top:-12px;
  left:11px;
  background:#fff;
  padding:0 5px
 }
}
@media screen and (max-width:1023px) and (max-width:420px) {
 .filter_select_box .filter_select_label {
  font-size:3.2vw
 }
}
@media screen and (max-width:1023px) {
 .filter_select_box:after {
  content:"";
  border:solid #253858;
  border-width:0 1.5px 1.5px 0;
  display:inline-block;
  padding:3.5px;
  transform:rotate(45deg);
  margin-left:3px;
  vertical-align:middle;
  position:absolute;
  top:20px;
  right:12px
 }
 .filter_special_box {
  display:flex;
  flex-direction:column;
  margin:0 22px 30px
 }
 .filter_mobile_new1 {
  max-height:calc(100% - 130px)!important
 }
 .white_filter_bg .cross_features_popup {
  background:#fff
 }
 .filter_si_premium {
  padding:0;
  width:calc(100% - 35px);
  justify-content:space-between;
  margin:10px 5px 20px 20px
 }
 .child_container_check_premium {
  display:flex;
  justify-content:space-between
 }
 .child_container_check_premium .checkPremium_members {
  width:48%
 }
 .modifyGroupMobileAction .close_button_checkPremium {
  display:none!important
 }
 .filter_mobile_table .insurer_div:last-child {
  margin-bottom:40px
 }
}
@media screen and (min-width:1024px) and (max-width:1280px) {
 .quotes_filter_insurer {
  padding:12px
 }
 .span_insured_text,
 .span_quotes_filter_insurer {
  font-size:13px
 }
}
@media screen and (max-width:1023px) {
 .byop_class_mobile {
  max-height:400px;
  overflow:hidden;
  overflow-y:auto
 }
 .checkPremiumMembers {
  margin-left:0;
  margin-top:5px;
  display:inline-block
 }
 .div_members_row1 {
  width:100%;
  margin-bottom:10px
 }
 .checkPremium_Selectbox {
  padding:8px 10px;
  margin-top:0
 }
 .select_members_age1:after {
  padding:2px;
  top:15px;
  right:8px
 }
 .select_members_age1 {
  width:110px;
  float:right
 }
 .select_members_age1.child_select {
  width:100%
 }
 .select_members_age1.child_select:after {
  top:15px
 }
 .div_members_row {
  width:100%
 }
 .div_members_row .edit_profile_error {
  text-align:right;
  margin-right:32px;
  margin-left:0!important
 }
 .div_members_row.check_premium {
  margin-bottom:5px
 }
 .modifyGroupMobileAction {
  position:static;
  margin:0 16px 20px;
  width:auto;
  text-align:right;
  display:block
 }
 .modifyGroupMobileAction .close_button_checkPremium {
  color:#999;
  width:auto;
  padding:10px 20px
 }
 .modifyGroupMobileAction .checkPremium_apply_button,
 .modifyGroupMobileAction .close_button_checkPremium {
  height:36px;
  margin:0;
  font-size:12px;
  text-transform:uppercase;
  border-radius:4px;
  display:inline-block;
  vertical-align:middle
 }
 .modifyGroupMobileAction .checkPremium_apply_button {
  width:100%;
  padding:10px 15px
 }
 .checkPremiumHeading {
  font-size:16px;
  font-weight:500;
  color:#253858;
  justify-content:space-between;
  align-items:center;
  padding:16px;
  margin:0
 }
}
@media screen and (max-width:1023px) and (max-width:420px) {
 .checkPremiumHeading {
  font-size:4.5vw
 }
}
@media screen and (max-width:1023px) {
 .close-box-byop {
  width:24px;
  height:20px;
  border-radius:50%;
  text-indent:-99999px;
  display:block
 }
 .close-box-byop:before {
  transform:rotate(45deg)
 }
 .close-box-byop:after,
 .close-box-byop:before {
  content:"";
  position:absolute;
  height:20px;
  width:2px;
  right:21px;
  top:18px;
  background:#253858;
  border-radius:10px
 }
 .close-box-byop:after {
  transform:rotate(-45deg)
 }
 .checkPremium_modify_group_div {
  padding:0 16px;
  max-height:100%!important
 }
 .checkPremium_members {
  display:flex;
  flex-direction:column;
  border:1px solid #97a0af;
  border-radius:4px;
  padding:0 12px;
  height:56px
 }
 .checkPremium_members .select_members_age1 {
  width:100%
 }
 .checkPremium_members .select_members_age1:after {
  top:8px
 }
 .checkPremium_members .select_members_age1 .checkPremium_Selectbox {
  padding:3px 0;
  margin-top:0;
  border:none
 }
 .checkPremium_members .checkPremiumMembers {
  font-size:12px;
  color:#7a869a
 }
}
@media screen and (max-width:1023px) and (max-width:420px) {
 .checkPremium_members .checkPremiumMembers {
  font-size:3.2vw
 }
}
@media screen and (max-width:1023px) {
 .div_members_row1 {
  margin-bottom:15px
 }
}
.text-center {
 text-align:center
}
@media screen and (min-width:320px) and (max-width:359px) {
 .filter_mobile_table {
  max-height:62%
 }
 .span_filter_mobile_reset {
  padding-right:0
 }
 .img_sort_mobile {
  margin:0 7px 0 10px
 }
}
.p0 {
 padding:0!important
}
.group {
 border:1px solid #ece2e2;
 height:192px;
 width:400px;
 margin-top:117px;
 margin-left:900px;
 position:absolute;
 z-index:9;
 background-color:#e4dddd
}
.multi-box-new {
 float:right;
 color:#64717e;
 font-size:12px;
 margin-bottom:0;
 padding-left:45px
}
.member-group {
 float:left;
 width:133px;
 border:1px solid #c3b7b7
}
.btngroup {
 margin-top:55px
}
.main_quotes_div {
 background:#f4f5f7;
 max-width:1170px;
 margin:0 auto
}
.main_quotes_div,
.main_quotes_mobile_div {
 display:flex;
 flex-direction:row;
 width:100%
}
.main_quotes_mobile_div {
 padding-right:16px;
 padding-left:16px
}
@media only screen and (min-width:1024px) {
 .main_quotes_container {
  width:calc(100% - 352px)
 }
 .main_quotes_container .greenChannel_widget_wrapper {
  margin-bottom:15px
 }
}
.div_quotes_desktop_filter {
 display:flex;
 flex-direction:row;
 padding:0 12px 12px 0;
 margin-top:-4px
}
.span_quotes_desktop_filter {
 font-size:14px;
 color:#253858
}
.span_quotes_desktop_reset_filter {
 font-size:14px;
 margin-left:10px;
 color:#ff5630;
 cursor:pointer;
 font-style:italic
}
.span_quotes_desktop_reset_filter.term_filter {
 font-weight:500;
 font-style:normal
}
.main_quotes_mobile_container {
 display:flex;
 flex-direction:column;
 width:100%
}
@media only screen and (min-width:1024px) {
 .dynamic_offer {
  width:328px
 }
}
.quotes_content_container {
 cursor:pointer;
 display:flex;
 flex-direction:column;
 width:calc(100% - 120px);
 background:#fff;
 border-radius:10px;
 padding:0;
 box-shadow:0 2px 4px 0 rgba(0,0,0,.16);
 position:relative;
 left:-10px
}
.quotes_content_container.disabled {
 pointer-events:none
}
.quotes_content_container1 {
 position:relative;
 cursor:pointer
}
.quotes_content_container1,
.quotes_content_container_skeleton {
 display:flex;
 flex-direction:column;
 width:100%;
 background:#fff;
 border-radius:4px;
 padding:0;
 box-shadow:0 1px 6px 0 hsla(0,0%,85.9%,.5)
}
.quotes_content_container_skeleton {
 margin-bottom:15px
}
.quotes_content_container_skeleton.with-padding {
 padding:6px 8px
}
.quotes_content_container_skeleton_shortlist {
 background:#fff;
 border-radius:10px;
 box-shadow:0 2px 4px 0 rgba(0,0,0,.16);
 padding:6px
}
.quotes_content_container_skeleton_shortlist,
.quotes_stack_content_container {
 display:flex;
 flex-direction:column;
 width:100%;
 margin-bottom:15px
}
.quotes_stack_content_mobile_container {
 margin-bottom:16px
}
.top_quotes_content {
 display:flex;
 flex-direction:row;
 margin-left:10px;
 margin-right:10px;
 border-bottom:1px solid #dfe1e6;
 padding-bottom:5px;
 padding-top:8px
}
.top_quotes_content.disabled {
 filter:grayscale(1);
 opacity:.3
}
.quotes_content_container1:hover .hover_container,
.quotes_content_container:hover .click_to_compare_tooltip {
 opacity:1
}
.click_to_compare_tooltip {
 left:-11px;
 position:absolute;
 opacity:0;
 bottom:-44px;
 width:64px;
 z-index:49;
 margin-top:7px;
 background:#36b37e;
 font-size:12px;
 color:#fff;
 line-height:16px;
 font-weight:500;
 padding:4px 9px;
 border-radius:4px
}
.click_to_compare_tooltip:before {
 top:-16px;
 left:20px;
 border-color:transparent currentcolor #36b37e;
 border-style:solid;
 border-width:8px;
 position:absolute;
 content:""
}
.rc-swipeout {
 overflow:visible!important
}
.top_quotes_heading_mobile {
 display:flex;
 flex-direction:row;
 width:100%;
 align-items:center;
 position:relative
}
.top_quotes_heading_mobile.disabled {
 filter:grayscale(1);
 opacity:.3
}
.top_quotes_heading1_mobile {
 display:flex;
 flex-direction:row;
 width:100%;
 align-items:center;
 visibility:hidden;
 opacity:0;
 display:none;
 transition:visibility 3s linear .33s,opacity .33s linear
}
.top_quotes_heading1_mobile.disabled {
 filter:grayscale(1);
 opacity:.3
}
.top_quotes_heading1_mobile.active {
 visibility:visible;
 opacity:1;
 transition-delay:0s;
 display:flex;
 padding-top:10px
}
.bottom_quotes_content {
 display:flex;
 flex-direction:row;
 width:100%;
 padding-top:0;
 align-items:center
}
.bottom_quotes_content.disabled {
 filter:grayscale(1);
 opacity:.3
}
.bottom_quotes_content1 {
 display:flex;
 flex-direction:row;
 width:100%;
 padding-top:0;
 padding-bottom:7px;
 visibility:hidden;
 opacity:0;
 display:none;
 align-items:center;
 justify-content:center;
 transition:visibility 3s linear 2s,opacity 2s linear
}
.bottom_quotes_content1.active {
 visibility:visible;
 opacity:1;
 transition-delay:0s;
 display:flex
}
.check_features_cont {
 width:50%
}
.checkbox_container {
 display:inline-block;
 margin:0 20px 0 0;
 vertical-align:middle;
 position:relative
}
.checkbox_container .request-loader {
 position:absolute;
 left:13px;
 margin:0;
 top:11px;
 z-index:1;
 display:none
}
.checkbox_container1 {
 align-items:flex-start;
 width:30%
}
.property_stack .quotes_content_desktop .quotes_content_container {
 border-radius:10px 10px 0 0
}
.quotes_stack_desktop_more .quotes_content_desktop .quotes_content_container {
 border-radius:0
}
.quotes_stack_desktop_more .quotes_content_desktop:nth-child(odd) .quotes_content_container {
 background:#eefef5
}
.quotes_stack_desktop_more .quotes_content_desktop:nth-child(2n) .quotes_content_container:before {
 content:"";
 position:absolute;
 width:100%;
 height:2px;
 background:#eefef5;
 top:-2px;
 left:0
}
.quotes_stack_desktop_more .quotes_content_desktop:nth-child(2n) .quotes_content_container:after {
 content:"";
 position:absolute;
 width:100%;
 height:2px;
 background:#eefef5;
 bottom:-2px;
 left:0
}
.quotes_stack_desktop_more .quotes_content_desktop:nth-last-child(2) .quotes_content_container {
 border-radius:0 0 10px 10px
}
.quotes_stack_desktop_more .quotes_content_desktop:nth-last-child(2) .quotes_content_container:after,
.quotes_stack_desktop_more .quotes_content_desktop:nth-last-child(2) .quotes_content_container:before {
 content:none
}
.checkbox_container_mobile {
 align-items:center;
 text-align:center;
 padding-bottom:0;
 height:100%;
 display:flex;
 justify-content:center
}
.checkbox_container_special {
 align-items:flex-start;
 width:100%
}
.bottom_checkbox_container {
 align-items:flex-start;
 padding:0;
 width:7%
}
.planContent_container {
 display:flex;
 flex-direction:column;
 width:calc(40% - 40px);
 justify-content:center
}
.planContent_container.disabled {
 filter:grayscale(1);
 opacity:.3
}
.features_container {
 display:flex;
 flex-direction:column;
 padding:0;
 cursor:pointer;
 margin-top:5px
}
.cover_container {
 padding-left:10px;
 width:40%
}
.bottom_cover_container,
.cover_container {
 display:flex;
 flex-direction:row;
 align-items:center
}
.bottom_cover_container {
 padding:0 10px;
 width:50%
}
.premium_container {
 display:flex;
 flex-direction:column;
 justify-content:center;
 align-items:center;
 width:20%
}
.premium_container.disabled {
 filter:grayscale(1);
 opacity:.3
}
.premium_topup {
 width:25%
}
.cover_topup {
 width:43%
}
.bottom_premium_container {
 display:flex;
 flex-direction:row;
 padding:0 10px;
 align-items:center;
 width:25%;
 text-align:center
}
.quotes_logo_container {
 width:100%;
 height:30px
}
.quotes_logo_container,
.quotes_logo_container1 {
 position:relative;
 overflow:hidden
}
@media only screen and (max-width:1023px) {
 .quotes_logo_container1 {
  width:80px;
  height:40px;
  border-radius:8px;
  border:1px solid #dfe1e6;
  display:flex;
  align-items:center;
  justify-content:center;
  padding:5px 10px
 }
 .quotes_logo_container1 picture {
  display:flex
 }
 .quotes_logo_container1 picture img {
  height:100%!important;
  width:unset!important
 }
}
.quotes_logo_container2,
.quotes_logo_containertopup {
 position:relative;
 overflow:hidden
}
.quotes_logo_container2 {
 width:50%;
 justify-content:center
}
.img_contain {
 width:90px;
 height:45px
}
.img_contain,
img.contain {
 object-fit:contain
}
.quotes_plan_name {
 font-size:14px;
 color:#253858;
 padding:0;
 font-weight:500
}
.quotes_plan_name.disabled {
 font-weight:400;
 opacity:.6
}
.quotes_plan_name_mobile {
 font-size:14px;
 color:#253858;
 width:100%;
 font-weight:500;
 letter-spacing:.2px
}
@media screen and (max-width:420px) {
 .quotes_plan_name_mobile {
  font-size:3.8vw
 }
}
.div_cover {
 width:40%;
 align-items:flex-start;
 align-self:flex-start
}
.div_cover,
.div_cover_usp {
 display:flex;
 flex-direction:column
}
.div_cover_usp {
 width:50%;
 align-items:flex-end;
 justify-content:center
}
.div_usp {
 padding-right:45px;
 line-height:14px;
 text-align:center
}
.div_network {
 display:flex;
 flex-direction:column;
 width:60%;
 align-items:flex-start;
 cursor:pointer
}
.div_network.disabled {
 filter:grayscale(1);
 opacity:.3
}
.div_features {
 display:inline-block
}
.div_features_mobile {
 display:flex;
 flex-direction:row;
 cursor:pointer;
 width:100%;
 flex:0.25;
 align-items:center;
 border-right:1px solid #f0f4f5
}
.span_cover {
 font-size:12px;
 color:#7a869a
}
.span_cover_content {
 font-size:18px;
 font-weight:500;
 color:#253858;
 line-height:20px
}
.span_cover_content.disabled {
 filter:grayscale(1);
 opacity:.3
}
.span_cover_content1 {
 font-size:24px;
 font-weight:500;
 color:#253858;
 width:50%;
 border-right:1px solid #ededed
}
.span_network_content {
 font-size:18px;
 font-weight:500;
 color:#253858;
 line-height:20px
}
.span_network {
 font-size:12px;
 color:#7a869a
}
.quotes_features {
 font-size:12px;
 font-weight:500;
 color:#36b37e
}
.quotes_features_mobile {
 font-size:14px;
 font-weight:500;
 color:#36b37e;
 width:200px
}
@media screen and (max-width:420px) {
 .quotes_features_mobile {
  font-size:3.8vw
 }
}
.quotes_features_mobile:after {
 content:"";
 border:solid #36b37e;
 border-width:0 1.5px 1.5px 0;
 display:inline-block;
 padding:2px;
 transform:rotate(-45deg);
 margin-left:3px;
 vertical-align:middle
}
.features_svg {
 margin-left:10px;
 width:12px;
 height:12px
}
.features_svg_mobile {
 margin-left:2px;
 width:9px;
 height:9px
}
.usp_svg {
 width:12px;
 vertical-align:middle
}
.usp_svg1 {
 width:12px;
 height:12px;
 margin-top:3px
}
.quotes_more_plans {
 font-size:12px;
 font-weight:500;
 color:#36b37e;
 text-align:center
}
.quotes_more_plans>span {
 display:block
}
.quotes_more_plans.more:after {
 transform:rotate(45deg)
}
.quotes_more_plans.less:after,
.quotes_more_plans.more:after {
 content:"";
 display:inline-block;
 border:solid #36b37e;
 border-width:0 2px 2px 0;
 padding:2px
}
.quotes_more_plans.less:after {
 transform:rotate(-135deg)
}
.span_usp {
 font-size:12px;
 font-weight:500;
 color:#36b37e;
 padding:0 4px 0 5px
}
.premium_button {
 border-radius:8px;
 cursor:pointer;
 font-weight:500;
 justify-content:center;
 width:100%;
 padding:6px 10px;
 border:1px solid #ff5630;
 font-size:14px;
 display:flex;
 flex-direction:row;
 align-items:center;
 white-space:nowrap
}
.premium_button,
.premium_button:hover {
 background-color:#ff5630;
 color:#fff
}
.annually_premium {
 font-size:12px;
 color:#7a869a
}
.annually_premium.save_amount {
 color:#36b37e;
 display:block;
 white-space:nowrap;
 font-weight:500;
 margin-top:4px
}
.div_effective {
 display:flex;
 flex-direction:row;
 width:100%;
 justify-content:center;
 align-items:center
}
.effective_tooltip span {
 margin-left:5px;
 background-image:url(https://static.pbcdn.in/health-cdn/images/insurer-logo/quotes-logos/info.svg);
 background-repeat:no-repeat;
 width:14px;
 height:14px;
 text-indent:-999999px;
 display:block
}
.span_effective_price {
 font-size:12px;
 font-weight:500;
 color:#7a869a;
 align-items:center;
 text-align:center;
 text-decoration:line-through
}
.span_effective_price.price_hike {
 text-decoration:none;
 color:#36b37e
}
.span_term_price {
 font-size:12px;
 color:#253858;
 align-items:center;
 width:100%
}
.arrow_right {
 padding-left:6px
}
.close_stack {
 background:#f3f7fb;
 height:28px;
 box-shadow:0 2px 4px 0 rgba(0,0,0,.16);
 border-radius:0 0 10px 10px;
 z-index:-1;
 text-align:center;
 margin:0 50px 0 150px;
 cursor:pointer
}
.close_stack img {
 display:none
}
.close_stack:before {
 content:"Hide Plans";
 font-size:12px;
 font-weight:700;
 color:#36b37e
}
.close_stack:after {
 content:"";
 border:solid #36b37e;
 border-width:0 2px 2px 0;
 display:inline-block;
 padding:2px;
 transform:rotate(-135deg);
 margin-left:10px;
 position:relative;
 top:1px
}
.close_compare {
 margin-top:-36px;
 align-items:center;
 float:right;
 text-align:center
}
.div_usp_mobile {
 display:flex;
 flex-direction:row;
 width:100%;
 align-items:center
}
.checkbox_quotes {
 -webkit-appearance:none;
 outline:none;
 width:18px;
 height:18px;
 margin:10px;
 border:1px solid #979797;
 border-radius:50%;
 background:#fff;
 display:inline-block;
 vertical-align:middle!important
}
.checkbox_quotes:checked {
 background:#36b37e;
 border:none
}
.checkbox_quotes:checked:after {
 -webkit-transform:rotate(45deg);
 transform:rotate(45deg);
 border-spacing:0;
 display:block;
 border:2px solid #fff;
 border-top:0;
 border-left:0;
 content:"";
 height:11px;
 margin-left:6px;
 margin-top:2.5px;
 width:5px
}
.Path_shortlist {
 width:24px;
 position:absolute;
 height:24px;
 right:0;
 top:0;
 text-align:center
}
.quotes_select {
 background-color:transparent;
 outline:none;
 border:none;
 font-size:18px;
 font-weight:500;
 color:#253858;
 -webkit-appearance:none;
 -moz-appearance:none;
 appearance:none;
 padding-right:5px;
 padding-left:0
}
.span_blank_plans {
 font-size:22px;
 font-weight:500;
 color:#212121;
 padding:15px;
 text-align:center
}
.promise-box1 img {
 display:block;
 width:100%;
 height:auto
}
.promise-box {
 background-image:url(https://static.pbcdn.in/health-cdn/images/insurer-logo/quotes-logos/right-bg.png);
 width:100%;
 height:225px;
 background-size:78%;
 background-position:0 100%;
 background-repeat:no-repeat
}
.right-box-banner {
 display:inline-flex;
 flex-direction:column;
 padding:11px 0 15px 38px;
 color:#000
}
.right-box-banner h2 {
 font-weight:600;
 font-size:20px;
 position:relative;
 padding:0 0 5px;
 margin:0 0 5px
}
.right-box-banner h2:before {
 content:"";
 position:absolute;
 width:43px;
 height:3px;
 background:#f8e71c;
 bottom:0
}
.right-box-banner p {
 font-size:14px;
 font-style:italic
}
ul.right-box-bottom {
 width:55%;
 font-size:14px;
 margin-left:45%;
 display:flex;
 flex-direction:column;
 margin-top:3px;
 color:#000
}
ul.right-box-bottom li:first-child {
 font-size:14px;
 font-style:italic
}
ul.right-box-bottom li {
 font-size:12px;
 line-height:24px;
 font-weight:500
}
.checkbox_container_mobile label {
 z-index:11
}
.quotes_content_container1 .hover_container {
 max-height:inherit;
 opacity:0;
 transition:opacity .3s ease-in
}
.quotes_content_container1 .hover_container a {
 background:rgba(0,0,0,.6039215686274509);
 position:absolute;
 border-radius:4px;
 left:0;
 top:0;
 width:70%;
 height:100%;
 color:#fff;
 font-size:14px;
 text-align:right;
 padding-right:40px;
 text-decoration:none;
 transition:all .3s ease-in
}
.max_condition1 {
 font-size:12px;
 color:#36b37e;
 padding:5px 45px 5px 0;
 font-weight:500;
 text-align:right;
 line-height:14px
}
.label_checkbox_plan {
 cursor:pointer;
 font-size:12px;
 font-weight:500;
 color:#253858;
 display:inline-block;
 align-items:center;
 position:relative;
 z-index:2
}
.faq_card {
 min-height:160px;
 background:#fff
}
.call_schedule_container {
 display:flex;
 flex-direction:column;
 width:100%;
 background:#fff;
 border-radius:4px;
 padding:0;
 box-shadow:0 1px 6px 0 hsla(0,0%,85.9%,.7);
 position:relative;
 overflow:hidden;
 margin-bottom:10px
}
.call_schedule {
 min-height:205px;
 background:#fff;
 padding-bottom:5px;
 width:350px
}
.call_heading {
 margin:6px 0 18px 81px
}
.call_heading h3 {
 font-size:14px;
 font-weight:500;
 letter-spacing:.2px;
 color:#212121;
 padding-top:5px;
 border-top:none!important
}
.call_heading p {
 font-size:12px;
 line-height:1.5;
 letter-spacing:-.2px;
 color:#696969;
 padding-top:5px;
 padding-right:10px;
 font-weight:500
}
.call_heading p span {
 font-weight:750
}
.call_tabs {
 margin:13px auto 0;
 display:flex;
 flex-direction:row;
 color:rgba(37,56,88,.8);
 font-size:12px;
 justify-content:center
}
.call_tabs .active {
 color:#253858;
 position:relative
}
.call_tabs .active:after {
 color:#253858;
 width:21px;
 height:2px;
 border-radius:1px;
 background-color:#253858;
 position:absolute;
 bottom:-3px;
 left:15%;
 content:""
}
.tabs_link {
 margin:0 10px;
 cursor:pointer
}
.call_tabs .tabs_link:nth-child(2).active:after {
 left:24%
}
.call_tabs .tabs_link:nth-child(3).active:after {
 left:15%
}
.call_time {
 margin:18px 0;
 display:flex;
 justify-content:center;
 align-items:center
}
.call_time::-webkit-scrollbar {
 display:none
}
.compare_time_slot {
 width:100px!important
}
.call_time .callleft {
 left:3%;
 transform:rotate(90deg)
}
.call_time .callleft,
.call_time .callright {
 position:absolute;
 background-image:url("data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTQiIGhlaWdodD0iNyIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cGF0aCBkPSJNMTIuMjczIDBMMTMgLjc1NSA3IDcgMSAuNzU1IDEuNzI0IDAgNyA1LjQ4N3oiIGZpbGw9IiM3RjgxODUiIHN0cm9rZT0iIzdGODE4NSIgZmlsbC1ydWxlPSJldmVub2RkIi8+PC9zdmc+");
 background-position:100%;
 height:15px;
 width:15px;
 background-repeat:no-repeat;
 top:66%;
 text-indent:-9999px;
 cursor:pointer
}
.call_time .callright {
 right:3%;
 transform:rotate(-90deg)
}
.slot_section {
 display:flex;
 cursor:pointer;
 flex-direction:column;
 justify-content:center;
 height:67px
}
.time_slot {
 width:61px;
 border-radius:4px;
 border:1px solid rgba(94,108,132,.8);
 margin-right:14px;
 font-size:14px;
 font-weight:500;
 letter-spacing:.28px;
 color:#253858;
 text-align:center
}
.time_slot:last-child {
 margin-right:0
}
.show_call_slot {
 font-size:9px;
 font-weight:300;
 font-style:italic;
 color:#253858
}
.time_slot.active {
 box-shadow:0 2px 4px 0 rgba(57,84,131,.5);
 background:#253858;
 color:#fff;
 border:1px solid #253858
}
.time_slot.active2 {
 background:#253858 url("data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAiIGhlaWdodD0iMzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PHBhdGggZD0iTTEyLjcwOCAyNC40MThMMzYuNjY3IDAgNDAgMy4yOTEgMTIuNzA4IDMxIDAgMTguMDQ4bDMuMzMzLTMuMjkxeiIgZmlsbD0iI0ZGRiIgZmlsbC1ydWxlPSJub256ZXJvIi8+PC9zdmc+") no-repeat center 18px;
 font-size:0
}
.call_schedule_success {
 background-position:1px 39px
}
.call_heading_success {
 margin:0;
 flex-flow:row nowrap;
 align-items:center;
 justify-content:center
}
.call_heading_success h3 {
 font-size:24px;
 font-weight:400;
 letter-spacing:.28px;
 color:#253858;
 border-top:none!important
}
.call_heading_success p {
 font-size:14px;
 letter-spacing:.13px;
 color:#253858;
 margin-top:7px
}
.button-reshedule {
 border:1px solid #253858;
 background:#fff;
 font-size:14px;
 color:#253858!important;
 border-radius:5px;
 width:130px;
 padding:10px;
 margin-top:10px;
 margin-bottom:17px;
 transition:.15s;
 transform:translateX(180%);
 opacity:0
}
.step2_schedule {
 opacity:0;
 display:none;
 overflow:hidden;
 text-align:center
}
.step2_schedule_show {
 opacity:1;
 display:block;
 z-index:9;
 margin:70px auto 0;
 text-align:center;
 padding:0 10px
}
.circle {
 background:#d9eff5;
 width:74px;
 height:74px;
 position:absolute;
 left:-15px;
 top:-15px;
 border-radius:50%;
 transition:all .3s ease-in
}
.call_schedule-animate {
 z-index:1;
 width:100%;
 height:100%;
 left:0;
 top:0;
 border-radius:4px
}
.circle:after {
 background:url("data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjIiIGhlaWdodD0iMjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PHBhdGggZD0iTTEyLjE0IDIuNjY4QzEzLjc4OCAxLjM5OCAxNC4yMTUuNDI0IDE0LjI3LjNjLjc1MS0xLjY3LTIuNTA2IDMuNjk2LTUuNzA4IDMuODE1LS45MzcuMDM1LTMuNjQ4LS40MDItMy4xMjMtLjA2My4xMTQuMDc0LTExLjQ0OSAyLjEyLS42MTMuOTA3IDEuMjQ3LS4xNC01LjA1OCAxLjMxOC0zLjA3IDEuNTA0IDguNzY3LjgxNi0xLjg1NyA4Ljk1IDUuMjAzIDUuMjM4IDIuNDM3IDMuODIxIDcuMDA0IDguMyAxNS4wNCA4LjMgMCAwLS44Mi0xLjYxMi0xLjQ3NC00LjQxNC0xLjYyNC02Ljk5NC00Ljg2Ny03LjIwMy0xLjM2My0xMy41MTMgMS4wMzkuMTIxLTcuNDE2Ljg5OS03LjAyMS41OTR6IiBmaWxsPSIjRDlFRkY1IiBmaWxsLXJ1bGU9Im5vbnplcm8iLz48L3N2Zz4=") no-repeat 0 0;
 position:absolute;
 bottom:5px;
 left:71%;
 content:"";
 width:22px;
 height:20px
}
.circle:before {
 background:url("data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDUiIGhlaWdodD0iNDUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGcgZmlsbC1ydWxlPSJub256ZXJvIiBmaWxsPSJub25lIj48cGF0aCBkPSJNNDEuNzYgMjMuMjVIMzZjLS4xOTQuMDA0LS4zNTUtLjE2My0uMzYtLjM3NSAwLS4yMDcuMTYyLS4zNzUuMzYtLjM3NWg1Ljc2Yy4xOTggMCAuMzYuMTY4LjM2LjM3NS0uMDA1LjIxMi0uMTY2LjM4LS4zNi4zNzV6bTIuODggMEg0My4yYy0uMTk0LjAwNC0uMzU1LS4xNjMtLjM2LS4zNzUgMC0uMjA3LjE2Mi0uMzc1LjM2LS4zNzVoMS40NGMuMTk4IDAgLjM2LjE2OC4zNi4zNzUtLjAwNS4yMTItLjE2Ni4zOC0uMzYuMzc1ek05IDIzLjI1SDMuMjRjLS4xOTQuMDA0LS4zNTUtLjE2My0uMzYtLjM3NSAwLS4yMDcuMTYyLS4zNzUuMzYtLjM3NUg5Yy4xOTggMCAuMzYuMTY4LjM2LjM3NS0uMDA1LjIxMi0uMTY2LjM4LS4zNi4zNzV6bS03LjIgMEguMzZjLS4xOTQuMDA0LS4zNTUtLjE2My0uMzYtLjM3NSAwLS4yMDcuMTYyLS4zNzUuMzYtLjM3NUgxLjhjLjE5OCAwIC4zNi4xNjguMzYuMzc1LS4wMDUuMjEyLS4xNjYuMzgtLjM2LjM3NXptMjAuNy0zYy0zLjc3NCAwLTcuMDE2LTIuNjA2LTcuOTg5LTYuMzc2LTEuMTU5LS4wMzgtMi4wOTEtMS4wMzItMi4wOTEtMi4yNDlzLjkzMS0yLjIxMSAyLjA5MS0yLjI1QzE1LjQ4NCA1LjYwNyAxOC43MjYgMyAyMi41IDNzNy4wMTYgMi42MDYgNy45ODkgNi4zNzZjMS4xNi4wMzggMi4wOTEgMS4wMzIgMi4wOTEgMi4yNDlzLS45MzEgMi4yMTEtMi4wOTEgMi4yNWMtLjk3MiAzLjc3LTQuMjE0IDYuMzc1LTcuOTg5IDYuMzc1em0tNy43NjUtNy4xNGMuMTc0IDAgLjM2Ny4xMTIuNDA0LjI4NC43OTMgMy41OTUgMy44MiA2LjEwNiA3LjM2MSA2LjEwNiAzLjU0IDAgNi41NjgtMi41MTEgNy4zNjItNi4xMDcuMDQ1LS4xOS4yMTMtLjMxMy4zOTItLjI4Ny4wOTcuMDEzLjEzMS4wMTkuMTY2LjAxOS43OTQgMCAxLjQ0LS42NzMgMS40NC0xLjVzLS42NDYtMS41LTEuNDQtMS41Yy0uMDM2IDAtLjA3LjAwNi0uMTA1LjAxMS0uMTg5LjAyMy0uNDEyLS4wOTItLjQ1My0uMjhDMjkuMDY4IDYuMjYxIDI2LjA0IDMuNzUgMjIuNSAzLjc1cy02LjU2OCAyLjUxMS03LjM2MiA2LjEwNmMtLjA0Ni4xODktLjIxMy4zMTItLjM5Mi4yODgtLjA5Ni0uMDEzLS4xMy0uMDE5LS4xNjYtLjAxOS0uNzk0IDAtMS40NC42NzMtMS40NCAxLjVzLjY0NiAxLjUgMS40NCAxLjVjLjAzNSAwIC4wNjktLjAwNi4xMDItLjAxYS4zMTguMzE4IDAgMDEuMDUzLS4wMDR2LS4wMDF6IiBmaWxsPSIjMjYzMjM4Ii8+PHBhdGggZD0iTTIyLjUgMTUuNzQ4Yy0xLjA0Mi4wMDYtMi4wNDUtLjQyNi0yLjgwMS0xLjIwNmEuMzguMzggMCAwMS0uMTA1LS4yNjVjMC0uMS4wMzgtLjE5Ni4xMDUtLjI2NWEuMzUuMzUgMCAwMS41MSAwIDMuMTUzIDMuMTUzIDAgMDA0LjU4MiAwIC4zNS4zNSAwIDAxLjUxIDAgLjM4LjM4IDAgMDEuMTA0LjI2NS4zOC4zOCAwIDAxLS4xMDUuMjY1Yy0uNzU2Ljc4LTEuNzU5IDEuMjEyLTIuOCAxLjIwNnoiIGZpbGw9IiMyNjMyMzgiLz48cGF0aCBkPSJNMjUuMzggMjAuNjI1bDIuNDY0IDEuMSA0LjAxNi0xLjI4OC0xLjA0NS02Ljk4NmExLjcxIDEuNzEgMCAwMS0uMzk1LjA0OWMtLjA3MiAwLS4xMzktLjAxNC0uMjA4LS4wMjItLjU5IDIuNjcyLTIuNDI1IDQuODQ0LTQuODMyIDUuODI3djEuMzJ6IiBmaWxsPSIjN0E4NjlBIi8+PHBhdGggZD0iTTI3Ljg0NCAyMi4xYS4zNDQuMzQ0IDAgMDEtLjE0Mi0uMDMxbC0yLjQ2My0xLjFhLjM3NC4zNzQgMCAwMS0uMjE5LS4zNDR2LTEuMzJjMC0uMTU1LjA5LS4yOTQuMjMtLjM1IDIuMzI5LS45NSA0LjA1Mi0zLjAzIDQuNjEyLTUuNTYyLjA0NS0uMTkuMjEzLS4zMTMuMzkyLS4yODcuMDk3LjAxMy4xMzEuMDE5LjE2Ni4wMTkuMTAxIDAgLjIwMy0uMDEzLjMxNS0uMDRhLjM0NC4zNDQgMCAwMS4yODIuMDU2Yy4wODMuMDU4LjEzOC4xNS4xNTMuMjUybDEuMDQ1IDYuOTg2Yy4wMjYuMTg3LS4wODIuMzY2LS4yNS40MTZsLTQuMDE1IDEuMjg3YS4zMi4zMiAwIDAxLS4xMDYuMDE3di4wMDF6bS0yLjEwNC0xLjcyM2wyLjEyNC45NDkgMy41OTItMS4xNTItLjk0My02LjMwMWgtLjAyNWMtLjY2IDIuNTUtMi40MDkgNC42NDQtNC43NDggNS42ODN2LjgyMXoiIGZpbGw9IiMyNjMyMzgiLz48cGF0aCBkPSJNMTkuNjIgMjAuNjI1di0xLjMyYy0yLjQwOC0uOTgyLTQuMjQzLTMuMTU0LTQuODMyLTUuODI3LS4wNy4wMDgtLjEzNy4wMjItLjIwOC4wMjJhMS43MSAxLjcxIDAgMDEtLjM5NS0uMDQ5bC0xLjA0NSA2Ljk4NiA0LjAxNiAxLjI4NyAyLjQ2NC0xLjA5OXoiIGZpbGw9IiM3QTg2OUEiLz48cGF0aCBkPSJNMTcuMTU3IDIyLjFhLjMzOC4zMzggMCAwMS0uMTA2LS4wMTdsLTQuMDE3LTEuMjg3Yy0uMTY3LS4wNS0uMjc0LS4yMjktLjI1LS40MTZsMS4wNDYtNi45ODdhLjM3Ni4zNzYgMCAwMS4xNTMtLjI1Mi4zNDMuMzQzIDAgMDEuMjgyLS4wNTVjLjE1LjAzNS4yODcuMDQ3LjQxNy4wMy4xOS0uMDI4LjQxNi4wOS40NTcuMjc5LjU2IDIuNTMxIDIuMjgzIDQuNjEgNC42MTMgNS41NjFhLjM3Ny4zNzcgMCAwMS4yMjkuMzV2MS4zMTljMCAuMTUtLjA4Ni4yODYtLjIxOS4zNDRsLTIuNDYzIDEuMWEuMzM3LjMzNyAwIDAxLS4xNDIuMDN2LjAwMXptLTMuNjEzLTEuOTI2bDMuNTkzIDEuMTUyIDIuMTI0LS45NDl2LS44MjFjLTIuMzQtMS4wNC00LjA5LTMuMTMzLTQuNzQ4LTUuNjgybC0uMDI2LS4wMDEtLjk0MyA2LjMwMXoiIGZpbGw9IiMyNjMyMzgiLz48cGF0aCBkPSJNMjIuNS4zNzVjLTQuMzc0IDAtNy45MiAzLjY5NC03LjkyIDguMjV2Mi4yNUwxOC45IDQuNWwuMTc2LjIzNGMyLjM4OSAzLjE2NyA2LjA0MiA1LjAxNiA5LjkwOSA1LjAxNmgxLjQzNVY4LjYyNWMwLTQuNTU2LTMuNTQ2LTguMjUtNy45Mi04LjI1eiIgZmlsbD0iIzVFNkM4NCIvPjxnIGZpbGw9IiMyNjMyMzgiPjxwYXRoIGQ9Ik0xNC41OCAxMS4yNWEuMzU3LjM1NyAwIDAxLS4xMDgtLjAxNy4zNzQuMzc0IDAgMDEtLjI1Mi0uMzU4di0yLjI1QzE0LjIyIDMuODY5IDE3LjkzNSAwIDIyLjUgMGM0LjU2NSAwIDguMjggMy44NyA4LjI4IDguNjI1VjkuNzVjLS4wMDUuMjEyLS4xNjYuMzgtLjM2LjM3NWgtMS40MzVjLTMuOTM3IDAtNy41OTUtMS44MTktMTAuMDY4LTVsLTQuMDQyIDUuOTY2Yy0uMDcuMS0uMTguMTYtLjI5NS4xNTl6TTIyLjUuNzVjLTQuMTcgMC03LjU2IDMuNTMyLTcuNTYgNy44NzV2MS4wNjlsMy42NjUtNS40MWEuMzU3LjM1NyAwIDAxLjI4NS0uMTU4Yy4xMTMtLjAwMy4yMi4wNS4yOTQuMTQzbC4xNzUuMjM0YzIuMzM3IDMuMDk3IDUuODQ1IDQuODczIDkuNjI1IDQuODczaDEuMDc2di0uNzVDMzAuMDYgNC4yODIgMjYuNjY4Ljc1IDIyLjUuNzV6bS0yLjkyOCAyNS44NzVhLjM1Ni4zNTYgMCAwMS0uMzM3LS4yNDRsLTEuNzQtNC44MjhjLS4wNjUtLjE5LjAyMi0uNDAzLjE5Ni0uNDc2bDEuNzg3LS43OTdhLjM1LjM1IDAgMDEuMzk1LjA4bDIuODggM2MuMDcuMDcyLjEwOS4xNzQuMTA1LjI3OWEuMzc2LjM3NiAwIDAxLS4xMjQuMjY5bC0yLjkyOCAyLjYyNWEuMzQ1LjM0NSAwIDAxLS4yMzQuMDkyem0tMS4yOC00Ljk5OWwxLjQzNiAzLjk5IDIuMjQzLTIuMDExLTIuNDM0LTIuNTM1LTEuMjQ2LjU1NnoiLz48cGF0aCBkPSJNMjUuNDIgMjYuNjI1YS4zNS4zNSAwIDAxLS4yMzUtLjA5MmwtMi45Mi0yLjYyNWEuMzg0LjM4NCAwIDAxLS4wMi0uNTQ5bDIuODgtM2EuMzUuMzUgMCAwMS4zOTYtLjA3OWwxLjc4Ny43OTdjLjE3NC4wNzQuMjYxLjI4Ny4xOTQuNDc3bC0xLjc0NSA0LjgyOGEuMzY1LjM2NSAwIDAxLS4zMzcuMjQzem0tMi4zOTItMy4wMmwyLjIzNyAyLjAxIDEuNDQ0LTMuOTg5LTEuMjQ2LS41NTYtMi40MzQgMi41MzV6Ii8+PHBhdGggZD0iTTM1LjQ2IDMwYy0uMTk0LjAwNC0uMzU1LS4xNjMtLjM2LS4zNzV2LS43OTFjMC0yLjEwMy0xLjE5OC0zLjk5OC0zLjA1NC00LjgyNmwtNi44MDctMy4wMzlhLjM3NC4zNzQgMCAwMS0uMjE5LS4zNDR2LS43ODlhNy45MTggNy45MTggMCAwMS01LjA0IDB2Ljc4OWMwIC4xNS0uMDg1LjI4Ni0uMjE5LjM0NGwtNi44MDYgMy4wNEMxMS4xIDI0LjgzNiA5LjkgMjYuNzMxIDkuOSAyOC44MzR2Ljc5MWMtLjAwNS4yMTItLjE2Ni4zOC0uMzYuMzc1LS4xOTQuMDA0LS4zNTUtLjE2My0uMzYtLjM3NXYtLjc5MWMwLTIuNDA0IDEuMzctNC41NjggMy40OTItNS41MTVsNi41ODgtMi45NDJ2LTEuMDczYzAtLjEyMy4wNTktLjI0LjE1Ni0uMzEuMS0uMDcuMjI0LS4wODUuMzM1LS4wMzlhNy4yNCA3LjI0IDAgMDA1LjQ5OCAwIC4zNDYuMzQ2IDAgMDEuMzM0LjA0LjM3OS4zNzkgMCAwMS4xNTcuMzF2MS4wNzJsNi41ODggMi45NDJjMi4xMjIuOTQ3IDMuNDkyIDMuMTExIDMuNDkyIDUuNTE1di43OTFjLS4wMDUuMjEyLS4xNjYuMzgtLjM2LjM3NXoiLz48cGF0aCBkPSJNMzcuOTggNDVINy4wMmMtMS4xOTEgMC0yLjE2LTEuMDEtMi4xNi0yLjI1VjMzYzAtMS4yNC45NjktMi4yNSAyLjE2LTIuMjVoNC40OGwxLjY5Ny0yLjgyOGMuMTMyLS4yMTkuNDc4LS4yMTkuNjEgMGwxLjY5NiAyLjgyOEgzNy45OGMxLjE5MSAwIDIuMTYgMS4wMSAyLjE2IDIuMjV2OS43NWMwIDEuMjQtLjk2OSAyLjI1LTIuMTYgMi4yNXpNNy4wMiAzMS41Yy0uNzk0IDAtMS40NC42NzMtMS40NCAxLjV2OS43NWMwIC44MjcuNjQ2IDEuNSAxLjQ0IDEuNWgzMC45NmMuNzk0IDAgMS40NC0uNjczIDEuNDQtMS41VjMzYzAtLjgyNy0uNjQ2LTEuNS0xLjQ0LTEuNUgxNS4zMDRhLjM1Ny4zNTcgMCAwMS0uMzA1LS4xNzZsLTEuNDk3LTIuNDk1LTEuNDk3IDIuNDk1YS4zNTUuMzU1IDAgMDEtLjMwNS4xNzZINy4wMnoiLz48cGF0aCBkPSJNMTYuMDIgMzUuMjVoLTcuMmMtLjE5NC4wMDQtLjM1NS0uMTYzLS4zNi0uMzc1IDAtLjIwNy4xNjItLjM3NS4zNi0uMzc1aDcuMmMuMTk4IDAgLjM2LjE2OC4zNi4zNzUtLjAwNS4yMTItLjE2Ni4zOC0uMzYuMzc1ek0yNi44MiAzOWgtMThjLS4xOTQuMDA0LS4zNTUtLjE2My0uMzYtLjM3NSAwLS4yMDcuMTYyLS4zNzUuMzYtLjM3NWgxOGMuMTk4IDAgLjM2LjE2OC4zNi4zNzUtLjAwNS4yMTItLjE2Ni4zOC0uMzYuMzc1em0tMy42IDIuMjVIOC44MmMtLjE5NC4wMDQtLjM1NS0uMTYzLS4zNi0uMzc1IDAtLjIwNy4xNjItLjM3NS4zNi0uMzc1aDE0LjRjLjE5OCAwIC4zNi4xNjguMzYuMzc1LS4wMDUuMjEyLS4xNjYuMzgtLjM2LjM3NXoiLz48L2c+PHBhdGggZD0iTTM2LjE4IDM3Ljg3NWMwIDEuNjU3LTEuMjkgMy0yLjg4IDMtMS41OSAwLTIuODgtMS4zNDMtMi44OC0zczEuMjktMyAyLjg4LTNjMS41OSAwIDIuODggMS4zNDMgMi44OCAzeiIgZmlsbD0iIzAwNjVGRiIvPjxwYXRoIGQ9Ik0zMy4zIDQxLjI1Yy0xLjc4NiAwLTMuMjQtMS41MTQtMy4yNC0zLjM3NSAwLTEuODYgMS40NTQtMy4zNzUgMy4yNC0zLjM3NSAxLjc4NiAwIDMuMjQgMS41MTQgMy4yNCAzLjM3NSAwIDEuODYtMS40NTQgMy4zNzUtMy4yNCAzLjM3NXptMC02Yy0xLjM5IDAtMi41MiAxLjE3Ny0yLjUyIDIuNjI1UzMxLjkxIDQwLjUgMzMuMyA0MC41YzEuMzkgMCAyLjUyLTEuMTc3IDIuNTItMi42MjVzLTEuMTMtMi42MjUtMi41Mi0yLjYyNXpNNDIuMyA2aC0yLjg4Yy0uMTk0LjAwNC0uMzU1LS4xNjMtLjM2LS4zNzUgMC0uMjA3LjE2Mi0uMzc1LjM2LS4zNzVoMi44OGMuMTk4IDAgLjM2LjE2OC4zNi4zNzUtLjAwNS4yMTItLjE2Ni4zOC0uMzYuMzc1eiIgZmlsbD0iIzI2MzIzOCIvPjxwYXRoIGQ9Ik00MC44NiA3LjVjLS4xOTQuMDA0LS4zNTUtLjE2My0uMzYtLjM3NXYtM2MwLS4yMDcuMTYyLS4zNzUuMzYtLjM3NS4xOTggMCAuMzYuMTY4LjM2LjM3NXYzYy0uMDA1LjIxMi0uMTY2LjM4LS4zNi4zNzV6TTM4LjcgOS43NWgtMi44OGMtLjE5NC4wMDQtLjM1NS0uMTYzLS4zNi0uMzc1IDAtLjIwNy4xNjItLjM3NS4zNi0uMzc1aDIuODhjLjE5OCAwIC4zNi4xNjguMzYuMzc1LS4wMDUuMjEyLS4xNjYuMzgtLjM2LjM3NXoiIGZpbGw9IiMyNjMyMzgiLz48cGF0aCBkPSJNMzcuMjYgMTEuMjVjLS4xOTQuMDA0LS4zNTUtLjE2My0uMzYtLjM3NXYtM2MwLS4yMDcuMTYyLS4zNzUuMzYtLjM3NS4xOTggMCAuMzYuMTY4LjM2LjM3NXYzYy0uMDA1LjIxMi0uMTY2LjM4LS4zNi4zNzV6IiBmaWxsPSIjMjYzMjM4Ii8+PC9nPjwvc3ZnPg==") no-repeat 0 0;
 position:absolute;
 top:19px;
 left:22%;
 content:"";
 width:45px;
 height:45px;
 z-index:1
}
.call_schedule-animate .circle:before {
 left:43.5%
}
.quotes_content_container .Path_shortlist.coachMark,
.quotes_stack_content_mobile_container .Path_shortlist.coachMark {
 opacity:0;
 animation-name:bounceIn;
 animation-duration:2s;
 animation-timing-function:linear;
 animation-fill-mode:forwards;
 animation-delay:1s
}
.quotes_content_container .Path_shortlist.noAnimation,
.quotes_stack_content_mobile_container .Path_shortlist.noAnimation {
 animation:none;
 opacity:1
}
@keyframes bounceIn {
 0% {
  opacity:0;
  transform:scale(.3) translateZ(0)
 }
 15% {
  opacity:.9;
  transform:scale(1.1)
 }
 25% {
  opacity:1;
  transform:scale(.89)
 }
 40% {
  opacity:1;
  transform:scale(1) translateZ(0)
 }
 65% {
  opacity:1;
  transform:scale(1) translateZ(0)
 }
 75% {
  opacity:1;
  transform:scale(.3) translateZ(0)
 }
 85% {
  opacity:.9;
  transform:scale(1.1)
 }
 to {
  opacity:1;
  transform:scale(.89)
 }
}
.quotes_content_container .newFeature_msg,
.quotes_stack_content_mobile_container .newFeature_msg {
 position:absolute;
 font-size:12px;
 color:#fff;
 background:#253858;
 padding:4px 8px;
 border-radius:4px;
 white-space:nowrap;
 right:32px;
 top:-1px;
 opacity:0;
 animation:showTip 4s ease-in 3s forwards
}
.quotes_content_container .newFeature_msg:after,
.quotes_stack_content_mobile_container .newFeature_msg:after {
 content:"";
 width:0;
 height:0;
 border-top:5px solid transparent;
 border-bottom:5px solid transparent;
 border-left:8px solid #253858;
 position:absolute;
 right:-8px;
 top:50%;
 transform:translateY(-50%)
}
@keyframes showTip {
 0% {
  opacity:0;
  transform:translateX(-3px)
 }
 20% {
  opacity:1;
  transform:translateX(0)
 }
 40% {
  opacity:1;
  transform:translateX(0)
 }
 60% {
  opacity:1;
  transform:translateX(0)
 }
 80% {
  opacity:1;
  transform:translateX(0)
 }
 90% {
  opacity:1;
  transform:translateX(0)
 }
 to {
  opacity:0;
  transform:translateX(3px)
 }
}
.compare_desktop_schedule {
 width:auto!important;
 margin:30px 30px 20px
}
.call_schedule_hospitals {
 clear:both
}
.shortlist_cards {
 margin-top:20px
}
.quotes_stack_desktop_more {
 position:relative
}
.quotes_content_desktop {
 display:flex;
 flex-direction:row;
 width:100%;
 justify-content:flex-end;
 position:relative
}
.quotes_content_desktop:hover .request-loader {
 display:block
}
.newLaunchedTag {
 line-height:17px;
 z-index:8;
 display:flex;
 position:relative;
 margin-bottom:-16px
}
.newLaunchedTag span {
 height:17px;
 font-size:10px;
 font-weight:600;
 color:#fff;
 background:#36b37e;
 padding:0 10px 0 5px;
 border-radius:8px 0 0 0;
 position:relative
}
@media screen and (max-width:420px) {
 .newLaunchedTag span {
  font-size:2.8vw
 }
}
.newLaunchedTag span:after {
 content:"";
 border-top:8px solid transparent;
 border-bottom:9px solid transparent;
 border-right:8px solid #fff;
 position:absolute;
 right:-1px
}
@media (max-width:1023px) {
 .newLaunchedTag+.top_quotes_heading_mobile {
  margin-top:10px
 }
}
.new_quotes_plan_container {
 width:120px;
 height:115px;
 background:#fff;
 border-radius:10px 0 0 10px;
 padding:18px 17px 11px 11px
}
.new_quotes_plan_container,
.no_plans_filters {
 display:flex;
 flex-direction:column;
 align-items:center;
 justify-content:center
}
.no_plans_filters {
 height:386px
}
.no_plans_filters .no-found {
 font-size:18px;
 color:#253858;
 font-weight:700
}
.no_plans_filters .no-plan-CTA {
 width:300px;
 height:48px;
 background:#fff;
 border-radius:4px;
 color:#ff5630;
 font-size:16px;
 font-weight:700;
 display:flex;
 align-items:center;
 justify-content:center;
 cursor:pointer;
 border:1px solid #ff5630
}
@media screen and (max-width:420px) {
 .no_plans_filters .no-plan-CTA {
  font-size:4.5vw
 }
}
.no_plans_filters .no-plan-CTA:focus,
.no_plans_filters .no-plan-CTA:hover {
 background:#fff;
 outline:none
}
.no_plans_filters .no-plan-text {
 font-size:16px;
 font-weight:400;
 color:#505f79;
 padding:8px 0 16px
}
@media screen and (max-width:420px) {
 .no_plans_filters .no-plan-text {
  font-size:4.5vw
 }
}
.no_plans_filters .no-plan-text span {
 display:block;
 text-align:center
}
.no_plans_filters .icon-no-filter {
 width:136px;
 height:102px;
 background:url("data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxMzYiIGhlaWdodD0iMTAyLjg1NSI+PGcgZGF0YS1uYW1lPSJHcm91cCA2ODU2IiB0cmFuc2Zvcm09InRyYW5zbGF0ZSgtNDc2IC0yNDcuMTQ1KSI+PGcgZmlsbC1ydWxlPSJldmVub2RkIiBkYXRhLW5hbWU9IjI4NTk3MDQiPjxwYXRoIGQ9Ik01ODguNTk4IDI2OC44NjVhMjguODUxIDI4Ljg1MSAwIDAwNC4yNDUtOC40MzMgNS44MTEgNS44MTEgMCAwMC0yLjktNi4xNTNjLTQuODg1LTIuNjgzLTE3LjEzNC02LjI4My00Ny42NzctNi4yODMtMjUuNzMxIDAtMzcuMzMxIDIuOTcyLTQyLjU1IDUuNzcyYTcuMDg0IDcuMDg0IDAgMDAtMy41MjYgNy44NjggMTQuMDg0IDE0LjA4NCAwIDAwMy4zNjMgNi4zMjlsMzUuNDQ0IDM4LjM3NyAzLjg5OCAzMC45NTQgMTAuNDU0LTQuMTEzIDQuNjYtMjYuODQxczMwLjk0NS0zMy4xMzYgMzQuNTg5LTM3LjQ3N3oiIGZpbGw9IiNmMmYyZjIiIHN0cm9rZT0iI2U4ZWFlZCIgc3Ryb2tlLXdpZHRoPSIxLjcxMSIvPjxwYXRoIGQ9Ik01MDIuNTExIDI1Ni40MDFhMS43NDcgMS43NDcgMCAwMC0uMjcgMy4xYzcuMzE3IDQuNjg5IDE2LjUxNyA1Ljk0OCAyNS4yOTcgNi41MjEgMTkuNzAxIDEuMjg4IDUwLjQ3OS41MDYgNTkuNjEyLTcuNDExYTEuMDQ2IDEuMDQ2IDAgMDAtLjMzMy0xLjc4NGMtMy4xODUtMS4xMDYtMTIuNjIzLTQuOC00MS44MzUtNC41NzYtMjUuNTMxLjE5Mi0zNy42MzIgMi4xODgtNDIuNDY4IDQuMTUiIGZpbGw9IiNlZGViZWIiLz48L2c+PGVsbGlwc2UgZGF0YS1uYW1lPSJFbGxpcHNlIDEiIGN4PSI2OCIgY3k9IjQiIHJ4PSI2OCIgcnk9IjQiIHRyYW5zZm9ybT0idHJhbnNsYXRlKDQ3NiAzNDIpIiBmaWxsPSIjZmFmYWZhIiBvcGFjaXR5PSIuODc2Ii8+PC9nPjwvc3ZnPg==") no-repeat 0 0;
 margin:0 0 26px
}
@media screen and (min-width:1700px) and (max-width:2400px) {
 .promise-box1 {
  height:240px
 }
 .promise-box {
  background-size:57%
 }
}
@media screen and (min-width:2400px) and (max-width:3000px) {
 .promise-box {
  background-size:37%
 }
 .small_chat_promo_container1 {
  left:-17px
 }
 .promise-box1 {
  height:340px
 }
}
@media screen and (min-width:3000px) {
 .promise-box {
  background-size:27%
 }
 .small_chat_promo_container1 {
  left:-17px
 }
 .promise-box1 {
  height:550px
 }
}
.coverSelectBox {
 height:20px;
 line-height:1.25;
 position:relative
}
.coverSelectBox.disabled {
 pointer-events:auto
}
.coverSelectBox .quotes_select {
 padding-right:15px;
 position:relative;
 z-index:2
}
.coverSelectBox:after {
 content:"";
 border:solid #253858;
 border-width:0 1.5px 1.5px 0;
 display:inline-block;
 padding:2px;
 transform:rotate(45deg);
 margin-left:3px;
 vertical-align:middle;
 position:absolute;
 top:6px;
 right:2px;
 z-index:1
}
.coverSelectBox.super_topup {
 margin-left:auto;
 border:1px solid rgba(37,56,88,.2);
 border-radius:4px;
 height:inherit;
 line-height:normal;
 padding:10px 6px
}
.coverSelectBox.super_topup:after {
 border-color:#253858;
 padding:2px;
 top:-1px!important;
 left:-1px;
 position:relative
}
.span_cover_content2:after {
 content:"";
 border:solid #253858;
 border-width:0 1.5px 1.5px 0;
 display:inline-block;
 padding:2px;
 transform:rotate(-45deg);
 margin-left:3px;
 vertical-align:middle;
 position:relative;
 top:-2px
}
.span_cover_content2.no_arrow_hospital:after {
 content:none
}
.span_network_content:after {
 content:"";
 border:solid #253858;
 border-width:0 1.5px 1.5px 0;
 display:inline-block;
 padding:2px;
 transform:rotate(-45deg);
 margin-left:3px;
 vertical-align:middle;
 position:relative
}
.span_network_content.no_arrow_hospital:after {
 content:none
}
.request-loader {
 position:relative;
 display:flex;
 flex-direction:row;
 justify-content:center;
 align-items:center;
 height:30px;
 width:30px;
 margin:21px -5px 0 -25px;
 z-index:10
}
.request-loader:after {
 animation-delay:0s;
 animation-iteration-count:infinite;
 animation-timing-function:cubic-bezier(.65,0,.34,1)
}
.request-loader:after,
.request-loader:before {
 opacity:0;
 display:flex;
 flex-direction:row;
 justify-content:center;
 align-items:center;
 position:absolute;
 top:-7px;
 left:-9px;
 right:0;
 bottom:0;
 content:"";
 height:100%;
 width:100%;
 border:8px solid rgba(54,179,126,.3);
 border-radius:100%;
 animation-name:ripple;
 animation-duration:3s;
 z-index:-1
}
.request-loader:before {
 animation-delay:.5s;
 animation-iteration-count:infinite;
 animation-timing-function:cubic-bezier(.65,0,.34,1)
}
@keyframes ripple {
 0% {
  opacity:1;
  transform:scale3d(.75,.75,1)
 }
 to {
  opacity:0;
  transform:scale3d(1.5,1.5,1)
 }
}
@media screen and (max-width:1023px) {
 .span_medical {
  font-size:12px;
  margin:12px 0 0;
  color:#36b37e;
  font-weight:800;
  text-align:center
 }
}
@media screen and (max-width:1023px) and (max-width:420px) {
 .span_medical {
  font-size:3.2vw
 }
}
@media screen and (max-width:1023px) {
 .p0 .span_medical {
  margin:12px 16px 0
 }
 .newFeature_msg {
  top:9px!important;
  right:40px!important
 }
 .annually_premium.save_amount {
  padding-right:4px;
  margin-top:0;
  white-space:inherit
 }
 .close_stack {
  position:absolute;
  background:#f3f7fb;
  height:28px;
  width:95%;
  bottom:-28px;
  left:50%;
  box-shadow:0 2px 4px 0 rgba(0,0,0,.16);
  border-radius:0 0 10px 10px;
  z-index:-1;
  transform:translateX(-50%);
  text-align:center;
  margin:0
 }
 .close_stack.disabled {
  pointer-events:auto
 }
 .close_stack img {
  display:none
 }
 .close_stack:before {
  content:"";
  font-size:12px;
  font-weight:700;
  color:#36b37e
 }
 .close_stack:after {
  content:"";
  border:solid #36b37e;
  border-width:0 2px 2px 0;
  display:inline-block;
  padding:2px;
  transform:rotate(-135deg);
  margin-left:10px;
  position:relative;
  top:1px
 }
 .Path_shortlist_Mobile {
  width:32px;
  text-align:center;
  margin-left:auto
 }
 .quotes_main_container {
  background:#f2f7ff!important
 }
 .quotes_plan_name_div {
  display:flex;
  flex-direction:column;
  width:calc(100% - 94px)
 }
 .span_cover1 {
  font-size:12px;
  color:#7a869a;
  line-height:1.67
 }
}
@media screen and (max-width:1023px) and (max-width:420px) {
 .span_cover1 {
  font-size:3.2vw
 }
}
@media screen and (max-width:1023px) {
 .span_cover_content2 {
  font-size:16px;
  color:#253858;
  font-weight:700;
  line-height:1.25
 }
}
@media screen and (max-width:1023px) and (max-width:420px) {
 .span_cover_content2 {
  font-size:4.5vw
 }
}
@media screen and (max-width:1023px) {
 .span_cover_content2.disabled {
  filter:grayscale(1);
  opacity:.3
 }
 .span_cover_content2:after {
  content:"";
  border:solid #253858;
  border-width:0 1.5px 1.5px 0;
  display:inline-block;
  padding:2px;
  transform:rotate(-45deg);
  margin-left:3px;
  vertical-align:middle;
  position:relative;
  top:-2px
 }
 .span_cover_content2.no_arrow_hospital:after {
  content:none
 }
 .coverSelectBox .quotes_select {
  padding-top:0
 }
 .coverSelectBox:after {
  top:6px
 }
 .call_heading h3 {
  font-size:16px;
  letter-spacing:.16px;
  color:#253858;
  padding-top:0
 }
 .call_heading p {
  font-size:14px;
  font-weight:400;
  letter-spacing:.12px;
  color:#253858
 }
 .call_heading p span {
  font-weight:600
 }
 .call_heading {
  margin:6px 0 0 66px
 }
 .checkbox_quotes {
  border-radius:100%
 }
 .span_cover {
  font-size:12px;
  padding:0 0 0 12px;
  width:80%
 }
 .quotes_select {
  font-size:16px;
  color:#253858;
  font-weight:700;
  border:none;
  padding-top:0;
  padding-bottom:0;
  width:auto;
  background:none;
  padding-right:0
 }
}
@media screen and (max-width:1023px) and (max-width:420px) {
 .quotes_select {
  font-size:4.5vw
 }
}
@media screen and (max-width:1023px) {
 .span_cover_content {
  font-size:16px;
  width:100%
 }
 .span_network {
  font-size:12px;
  padding:0 0 0 2px;
  width:100%
 }
 .planContent_container {
  width:70px
 }
 .planContent_container .img_contain {
  width:60px;
  height:30px
 }
 .span_blank_plans {
  font-size:16px
 }
 .span_usp {
  font-size:12px
 }
 .max_condition {
  display:block;
  font-size:14px;
  color:#36b37e;
  width:100%;
  line-height:1.33;
  text-align:center
 }
}
@media screen and (max-width:1023px) and (max-width:420px) {
 .max_condition {
  font-size:3.8vw
 }
}
@media screen and (max-width:1023px) {
 .max_condition_usp {
  padding-left:5px
 }
 .usp_div a {
  color:#36b37e;
  font-size:14px
 }
}
@media screen and (max-width:1023px) and (max-width:420px) {
 .usp_div a {
  font-size:3.8vw
 }
}
@media screen and (max-width:1023px) {
 .usp_div a img {
  vertical-align:middle;
  filter:none
 }
 .max_condition.active {
  visibility:visible;
  opacity:1;
  transition-delay:0s
 }
 .div_feature_popup_cover {
  width:100%
 }
 .usp_svg {
  width:10px;
  height:10px
 }
 .div_effective {
  width:100%;
  margin-top:4px
 }
 .div_effective.save_amount {
  justify-content:flex-end;
  align-items:flex-end;
  margin-right:4px
 }
 .effective_tooltip span {
  width:17px;
  height:22px;
  margin-left:5px
 }
 .checkbox_quotes {
  margin:5px 10px 0
 }
 .span_network_content {
  font-size:16px;
  width:100%;
  padding-left:10px
 }
}
@media screen and (max-width:1023px) and (max-width:420px) {
 .span_network_content {
  font-size:4.5vw
 }
}
@media screen and (max-width:1023px) {
 .div_cover {
  min-width:70px;
  width:auto;
  margin-right:10px;
  flex-direction:column;
  align-items:flex-start
 }
 .div_cover .span_cover_content2:after {
  content:none
 }
 .usp_div {
  display:flex;
  justify-content:center;
  font-size:14px;
  color:#36b37e;
  width:100%;
  align-items:center;
  text-align:center;
  padding:7px 0 0;
  border-top:1px solid #dfe1e6;
  line-height:1.33
 }
}
@media screen and (max-width:1023px) and (max-width:420px) {
 .usp_div {
  font-size:3.8vw
 }
}
@media screen and (max-width:1023px) {
 .div_network {
  width:calc(100% - 190px);
  border:none;
  flex-direction:column;
  align-items:flex-start
 }
 .div_network.disabled {
  filter:grayscale(1);
  opacity:.3
 }
 .div_network.save_amount {
  align-items:flex-end
 }
 .span_effective_price {
  font-size:12px
 }
 .span_effective_price.save_amount {
  text-align:right
 }
 .premium_container {
  width:115px;
  padding:0;
  justify-content:center;
  flex-direction:column;
  align-items:center
 }
 .premium_button {
  border-radius:8px;
  padding:7px 0;
  font-size:14px;
  font-weight:600;
  width:100%;
  color:#fff;
  border:1px solid #ff5630;
  background-color:#ff5630
 }
}
@media screen and (max-width:1023px) and (max-width:420px) {
 .premium_button {
  font-size:3.8vw
 }
}
@media screen and (max-width:1023px) {
 .premium_button.check_premium_button {
  font-size:12px
 }
 .quotes_stack_content_container {
  margin-top:15px
 }
 .profile_group_mobile_select {
  background-color:transparent;
  outline:none;
  border:none;
  -webkit-appearance:none;
  -moz-appearance:none;
  appearance:none;
  font-size:14px;
  color:#253858;
  font-weight:500;
  width:140px
 }
 .profile_option_group {
  font-size:12px;
  color:#253858
 }
 .quotes_content_container {
  position:relative;
  -webkit-transform:translateZ(0);
  border-radius:10px;
  box-shadow:none;
  width:100%;
  left:0
 }
 .quotes_content_container_skeleton {
  margin-bottom:0;
  margin-top:15px
 }
 .quotes_content_container_skeleton_shortlist {
  margin-bottom:0;
  margin-top:0
 }
 .quotes_mobile_row {
  display:flex;
  flex-direction:row;
  width:100%;
  flex:1
 }
 .quotes_mobile_compare {
  flex:0.1;
  background:#f0f4f5
 }
 .quotes_mobile_compare.disabled {
  pointer-events:none
 }
 .quotes_stack {
  flex:1;
  box-shadow:0 1px 2px 0 rgba(0,0,0,.16);
  border-radius:10px;
  background:#fff;
  padding:10px;
  position:relative
 }
 .quotes_stack.stack_expanded_div {
  border-radius:10px 10px 0 0;
  box-shadow:0 0 4px 0 rgba(0,0,0,.16)
 }
 .quotes_stack.stack_expanded_div .max_condition,
 .quotes_stack.stack_expanded_div .usp_div {
  border:none;
  padding:0
 }
 .quotes_stack_mobile_more {
  margin-bottom:12px
 }
 .quotes_stack_mobile_more .quotes_stack {
  border-radius:0;
  box-shadow:0 0 4px 0 rgba(0,0,0,.16);
  overflow:visible
 }
 .quotes_stack_mobile_more>div {
  background-color:transparent!important
 }
 .quotes_stack_mobile_more>div:last-child .quotes_stack {
  border-radius:0 0 10px 10px
 }
 .quotes_stack_mobile_more .max_condition,
 .quotes_stack_mobile_more .usp_div {
  border:none;
  padding:0
 }
 .call_schedule,
 .faq_card {
  margin-top:12px
 }
 .shortlist_box {
  display:flex;
  flex-direction:column;
  width:100%;
  background:#fff;
  border-radius:4px;
  padding:0;
  box-shadow:0 1px 6px 0 hsla(0,0%,85.9%,.5);
  margin-bottom:15px;
  margin-top:74px;
  height:100px
 }
 .swipe-more-box {
  background:#fff;
  width:100%;
  position:absolute;
  height:100%;
  justify-content:flex-end;
  color:#fff;
  z-index:9;
  top:1px
 }
 .swipe-more-box,
 .swipe_text {
  display:inline-flex;
  align-items:center
 }
 .swipe_text {
  background-color:#36b37e;
  height:99%;
  width:45%;
  justify-content:center
 }
 .swipe-zindex {
  z-index:10
 }
 .quotes-swipe {
  left:0;
  -webkit-animation:slide .5s forwards;
  -webkit-animation-delay:.5s;
  animation:slide .5s forwards;
  animation-delay:.5s
 }
 .quotes-swipes-right {
  left:-45%;
  -webkit-animation:slide2 .5s forwards;
  -webkit-animation-delay:.5s;
  animation:slide2 .5s forwards;
  animation-delay:.5s
 }
 @-webkit-keyframes slide {
  to {
   left:-45%
  }
 }
 @keyframes slide {
  to {
   left:-45%
  }
 }
 @-webkit-keyframes slide2 {
  to {
   left:-45%
  }
 }
 @keyframes slide2 {
  to {
   left:0
  }
 }
 .chat-count {
  background:red;
  border-radius:100%;
  width:19px;
  height:21px;
  color:#fff;
  font-size:11px;
  position:absolute;
  right:11px;
  bottom:72px;
  line-height:21px;
  z-index:10;
  text-align:center
 }
 .no-shake {
  bottom:27px
 }
 .chat-box-shake2,
 .chat-box-shake2_compare {
  animation:shakeanim 1s cubic-bezier(.36,.07,.19,.97) both;
  transform:translateZ(0);
  backface-visibility:hidden;
  perspective:1000px;
  animation-iteration-count:infinite
 }
 .chat-box-shake2_compare {
  width:100%
 }
 @keyframes shakeanim {
  10%,
  90% {
   transform:translate3d(-1px,0,0)
  }
  20%,
  80% {
   transform:translate3d(2px,0,0)
  }
  30%,
  50%,
  70% {
   transform:translate3d(-4px,0,0)
  }
  40%,
  60% {
   transform:translate3d(4px,0,0)
  }
 }
 .span_range {
  width:100%!important;
  font-size:12px
 }
}
@media screen and (max-width:1023px) and (max-width:420px) {
 .span_range {
  font-size:3.2vw
 }
}
@media screen and (max-width:1023px) {
 .max_cover_text {
  font-size:12px;
  color:#5e6c84;
  border-top:1px solid #dfe1e6;
  display:flex;
  align-items:center;
  justify-content:center;
  margin-top:16px;
  padding-top:8px
 }
}
@media screen and (max-width:1023px) and (max-width:420px) {
 .max_cover_text {
  font-size:3.2vw
 }
}
@media screen and (max-width:1023px) {
 .top_range {
  margin-left:12px
 }
 .quotes_content_filter_mobile {
  box-shadow:none;
  border-radius:0
 }
 .no_plans_filters {
  height:74vh
 }
 .no_plans_filters .no-plan-text {
  padding:8px 16px 16px;
  text-align:center
 }
 .no_plans_filters .no-plan-text span {
  display:inline-block
 }
 .new_quotes_stack_wrapper {
  flex:1;
  background:#f0f4f5
 }
 .viewPlansTags {
  background:#f3f7fb;
  height:24px;
  width:95%;
  box-shadow:0 1px 2px 0 rgba(0,0,0,.16);
  border-radius:0 0 10px 10px;
  margin:0 0 0 2.5%;
  display:flex;
  align-items:center;
  justify-content:center;
  font-size:12px;
  color:#36b37e;
  font-weight:600
 }
}
@media screen and (max-width:1023px) and (max-width:420px) {
 .viewPlansTags {
  font-size:3.2vw
 }
}
@media screen and (max-width:1023px) {
 .viewPlansTags span {
  position:relative;
  margin-right:13px
 }
 .viewPlansTags span:after {
  content:"";
  border:solid #36b37e;
  border-width:0 1.5px 1.5px 0;
  display:inline-block;
  padding:2px;
  transform:rotate(45deg);
  margin-left:3px;
  vertical-align:middle;
  position:absolute;
  top:5px;
  right:-13px;
  transition:all .3s ease-in
 }
 .hidePlanTags span:after {
  transform:rotate(-135deg);
  top:9px
 }
}
.tick_content:after {
 display:none
}
@media screen and (min-width:320px) and (max-width:340px) {
 .premium_container {
  width:100px
 }
 .div_cover {
  width:70px;
  margin-right:0
 }
 .span_cover {
  width:57%
 }
 .quotes_select {
  font-size:16px;
  color:#253858;
  font-weight:700
 }
}
@media screen and (min-width:320px) and (max-width:340px) and (max-width:420px) {
 .quotes_select {
  font-size:4.5vw
 }
}
@media screen and (min-width:320px) and (max-width:340px) {
 .span_cover_content {
  font-size:12px;
  font-weight:300
 }
}
@media screen and (min-width:340px) and (max-width:380px) {
 .span_cover {
  width:44%
 }
}
@media screen and (min-width:380px) and (max-width:1023px) {
 .span_cover {
  width:60%
 }
}
@media screen and (min-width:1024px) and (max-width:1080px) {
 .right-box-banner h2 {
  font-size:17px
 }
 ul.right-box-bottom {
  width:auto;
  margin-left:28%
 }
 .promise-box1 {
  background-size:100%
 }
 .promise-box {
  background-size:84%
 }
}
@media screen and (min-width:1440px) and (max-width:1920px) {
 .quotes_filter_insurer5 {
  width:17%
 }
 .click_to_compare_tooltip {
  left:28px
 }
}
.rc-swipeout,
.rc-swipeout-content {
 border-radius:10px;
 background:transparent!important
}
.rc-swipeout-actions {
 border-radius:0 10px 10px 0;
 visibility:hidden
}
.pt-10 {
 padding-top:10px
}
.rc-swipeout-cover[style="display: none; left: 0px;"]+div {
 visibility:hidden!important
}
@media screen and (min-width:320px) and (max-width:340px) {
 .span_cover {
  width:57%
 }
 .small_chat_ask_query_button {
  padding:0
 }
 .quotes_select {
  font-size:12px;
  font-weight:300
 }
 .faq_protip_content span {
  font-size:10px!important
 }
 .annually_premium,
 .span_effective_price {
  font-size:10px
 }
 .faq_protip_content h3 {
  font-size:12px!important
 }
 .span_cover_content {
  font-size:12px;
  font-weight:300
 }
}
.rc-swipeout-actions {
 width:158px
}
.rc-swipeout-actions .rc-swipeout-btn {
 width:100%
}
@media screen and (min-width:375px) and (max-width:1023px) {
 .premium_container {
  width:135px
 }
}
.mt-10 {
 margin-top:10px
}
.mt-20 {
 margin-top:20px
}
.priceHikeWrap {
 position:absolute;
 right:-190px;
 height:78px;
 width:175px;
 text-align:center;
 cursor:default;
 pointer-events:none;
 top:4px;
 z-index:39;
 background:#f4f5f7;
 border-radius:2px;
 padding:4px
}
.priceHikeWrap i {
 display:block;
 width:28px;
 height:28px;
 background-color:#ffab04;
 border-radius:50%;
 margin:0 auto 5px;
 background-repeat:no-repeat;
 background-position:6px 8px;
 box-shadow:0 2px 4px rgba(0,0,0,.16)
}
.priceHikeWrap i.priceHikeIcon-warningRed {
 background-color:transparent;
 border-radius:0;
 background-position:0;
 box-shadow:none
}
.priceHikeWrap p {
 font-size:10px;
 color:#253858
}
.priceHikeWrap p strong {
 color:#253858
}
.priceHikeWrap div {
 background-color:#253858;
 color:#fff;
 font-size:12px;
 padding:1px 0;
 border-radius:2px;
 margin-top:2px;
 position:relative;
 box-shadow:0 2px 4px rgba(0,0,0,.16)
}
.priceHikeWrap div strong {
 color:#fff
}
.priceHikeWrap div:before {
 content:"";
 border-top:5px solid transparent;
 border-bottom:5px solid transparent;
 border-right:5px solid #253858;
 position:absolute;
 left:-5px;
 top:50%;
 margin-top:-5px
}
.priceHikeWrapMobile {
 white-space:nowrap;
 font-size:12px;
 font-weight:500;
 color:#253858;
 margin-bottom:3px
}
@media screen and (max-width:420px) {
 .priceHikeWrapMobile {
  font-size:3.2vw
 }
}
.priceHikeWrapMobile i {
 display:inline-block;
 width:17px;
 height:13px;
 vertical-align:middle;
 margin-right:2px
}
.priceHikeMobileAlert {
 background:#253858;
 border-radius:10px 10px 0 0;
 color:#fff;
 font-size:12px;
 margin:0 -10px;
 padding:3px 0;
 text-align:center;
 position:relative;
 top:-10px
}
.priceHikeMobileAlert.physical {
 background:red;
 font-weight:700
}
@media screen and (max-width:420px) {
 .priceHikeMobileAlert {
  font-size:3.2vw
 }
}
.priceHikeMobileAlert strong {
 color:#fff
}
.priceHikeMobileAlert i {
 margin-right:2px
}
.div_effective i,
.priceHikeMobileAlert i {
 display:inline-block;
 width:17px;
 height:13px;
 vertical-align:middle;
 background-repeat:no-repeat
}
.div_effective i {
 margin-right:5px
}
.priceHikeIcon {
 background-image:url("data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxNi44ODEiIGhlaWdodD0iMTIuOTU1Ij48ZyBkYXRhLW5hbWU9Ikdyb3VwIDMiPjxwYXRoIGRhdGEtbmFtZT0iUGF0aCAyIiBkPSJNOS44NjEgOC4xNTlsMy41NjgtNS4xMDUtMS4yMzQtLjg2MyA0LjY4Ni0yLjE5LS40NDYgNS4xNTQtMS4yMzQtLjg2NC00LjcwNyA2LjczNS01LjAzMy0yLjkyNy0zLjc0NCA0Ljg1Ni0xLjcxMi0xLjMyIDQuOS02LjM1OHoiIGZpbGw9IiMyNTM4NTgiLz48L2c+PC9zdmc+")
}
.priceHikeIcon-white {
 background-image:url("data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxNCIgaGVpZ2h0PSIxMC45ODIiPjxwYXRoIGQ9Ik04LjE3OSA2LjkxNmwyLjk1OS00LjMyOC0xLjAyNC0uNzMxTDE0IDBsLS4zNjkgNC4zNzEtMS4wMjQtLjczMS0zLjkgNS43MS00LjE3OS0yLjQ4Mi0zLjEwNSA0LjExNi0xLjQyLTEuMTE5IDQuMDU4LTUuMzk0eiIgZmlsbD0iI2ZmZiIvPjwvc3ZnPg==")
}
.priceHikeIcon-warning {
 background-image:url("data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxOCIgaGVpZ2h0PSIxNi4xNSI+PGRlZnM+PHN0eWxlPi5wcmVmaXhfX2Nscy0ye2ZpbGw6I2Y2MDYwMH08L3N0eWxlPjwvZGVmcz48ZyBpZD0icHJlZml4X19Hcm91cF82NTc0IiBkYXRhLW5hbWU9Ikdyb3VwIDY1NzQiIHRyYW5zZm9ybT0idHJhbnNsYXRlKDAgLTI2LjMxNSkiPjxnIGlkPSJwcmVmaXhfX0dyb3VwXzY1NjkiIGRhdGEtbmFtZT0iR3JvdXAgNjU2OSIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoMCAyNi4zMTUpIj48ZyBpZD0icHJlZml4X19Hcm91cF82NTY4IiBkYXRhLW5hbWU9Ikdyb3VwIDY1NjgiPjxwYXRoIGlkPSJwcmVmaXhfX1BhdGhfOTY2MCIgZmlsbD0iI2ZmZiIgZD0iTTE3LjcxMyAzOS4yOWwtNi44OC0xMS45MTdhMi4xMTcgMi4xMTcgMCAwMC0zLjY2NiAwTC4yODcgMzkuMjlhMi4xMTcgMi4xMTcgMCAwMDEuODMzIDMuMTc1aDEzLjc2YTIuMTE3IDIuMTE3IDAgMDAxLjgzMy0zLjE3NXoiIGRhdGEtbmFtZT0iUGF0aCA5NjYwIiB0cmFuc2Zvcm09InRyYW5zbGF0ZSgwIC0yNi4zMTUpIi8+PC9nPjwvZz48ZyBpZD0icHJlZml4X19Hcm91cF82NTcxIiBkYXRhLW5hbWU9Ikdyb3VwIDY1NzEiIHRyYW5zZm9ybT0idHJhbnNsYXRlKDguNDcyIDMxLjU3OCkiPjxnIGlkPSJwcmVmaXhfX0dyb3VwXzY1NzAiIGRhdGEtbmFtZT0iR3JvdXAgNjU3MCI+PHBhdGggaWQ9InByZWZpeF9fUmVjdGFuZ2xlXzM2NTkiIGQ9Ik0wIDBoMS4wNTV2NS4yNzNIMHoiIGNsYXNzPSJwcmVmaXhfX2Nscy0yIiBkYXRhLW5hbWU9IlJlY3RhbmdsZSAzNjU5Ii8+PC9nPjwvZz48ZyBpZD0icHJlZml4X19Hcm91cF82NTczIiBkYXRhLW5hbWU9Ikdyb3VwIDY1NzMiIHRyYW5zZm9ybT0idHJhbnNsYXRlKDguMjk3IDM3LjkwNSkiPjxnIGlkPSJwcmVmaXhfX0dyb3VwXzY1NzIiIGRhdGEtbmFtZT0iR3JvdXAgNjU3MiI+PHBhdGggaWQ9InByZWZpeF9fUGF0aF85NjYxIiBkPSJNMjM2LjcwNSAzNTUuOTlhLjcuNyAwIDEwLjcuNy43LjcgMCAwMC0uNy0uN3oiIGNsYXNzPSJwcmVmaXhfX2Nscy0yIiBkYXRhLW5hbWU9IlBhdGggOTY2MSIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoLTIzNi4wMDIgLTM1NS45OSkiLz48L2c+PC9nPjwvZz48L3N2Zz4=")
}
.priceHikeIcon-warningRed {
 background-image:url("data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyOCIgaGVpZ2h0PSIyNS4xMjIiPjxkZWZzPjxzdHlsZT4ucHJlZml4X19jbHMtMntmaWxsOiNmZmZ9PC9zdHlsZT48L2RlZnM+PGcgaWQ9InByZWZpeF9fR3JvdXBfNjU3NCIgZGF0YS1uYW1lPSJHcm91cCA2NTc0IiB0cmFuc2Zvcm09InRyYW5zbGF0ZSgwIC0yNi4zMTUpIj48ZyBpZD0icHJlZml4X19Hcm91cF82NTY5IiBkYXRhLW5hbWU9Ikdyb3VwIDY1NjkiIHRyYW5zZm9ybT0idHJhbnNsYXRlKDAgMjYuMzE1KSI+PGcgaWQ9InByZWZpeF9fR3JvdXBfNjU2OCIgZGF0YS1uYW1lPSJHcm91cCA2NTY4Ij48cGF0aCBpZD0icHJlZml4X19QYXRoXzk2NjAiIGZpbGw9InJlZCIgZD0iTTI3LjU1MyA0Ni41bC0xMC43LTE4LjUzN2EzLjI5MiAzLjI5MiAwIDAwLTUuNyAwTC40NDYgNDYuNUEzLjI5MiAzLjI5MiAwIDAwMy4zIDUxLjQzN2gyMS40YTMuMjkyIDMuMjkyIDAgMDAyLjg1My00LjkzN3oiIGRhdGEtbmFtZT0iUGF0aCA5NjYwIiB0cmFuc2Zvcm09InRyYW5zbGF0ZSgwIC0yNi4zMTUpIi8+PC9nPjwvZz48ZyBpZD0icHJlZml4X19Hcm91cF82NTcxIiBkYXRhLW5hbWU9Ikdyb3VwIDY1NzEiIHRyYW5zZm9ybT0idHJhbnNsYXRlKDEzLjE3OSAzNC41MDEpIj48ZyBpZD0icHJlZml4X19Hcm91cF82NTcwIiBkYXRhLW5hbWU9Ikdyb3VwIDY1NzAiPjxwYXRoIGlkPSJwcmVmaXhfX1JlY3RhbmdsZV8zNjU5IiBkPSJNMCAwaDEuNjR2OC4yMDJIMHoiIGNsYXNzPSJwcmVmaXhfX2Nscy0yIiBkYXRhLW5hbWU9IlJlY3RhbmdsZSAzNjU5Ii8+PC9nPjwvZz48ZyBpZD0icHJlZml4X19Hcm91cF82NTczIiBkYXRhLW5hbWU9Ikdyb3VwIDY1NzMiIHRyYW5zZm9ybT0idHJhbnNsYXRlKDEyLjkwNiA0NC4zNDQpIj48ZyBpZD0icHJlZml4X19Hcm91cF82NTcyIiBkYXRhLW5hbWU9Ikdyb3VwIDY1NzIiPjxwYXRoIGlkPSJwcmVmaXhfX1BhdGhfOTY2MSIgZD0iTTIzNy4xIDM1NS45OWExLjA5NCAxLjA5NCAwIDEwMS4wOTQgMS4wOTQgMS4wOTUgMS4wOTUgMCAwMC0xLjA5NC0xLjA5NHoiIGNsYXNzPSJwcmVmaXhfX2Nscy0yIiBkYXRhLW5hbWU9IlBhdGggOTY2MSIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoLTIzNi4wMDIgLTM1NS45OSkiLz48L2c+PC9nPjwvZz48L3N2Zz4=")
}
.priceHikeIcon_green {
 background-image:url("data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxNi44ODEiIGhlaWdodD0iMTIuOTU1Ij48ZyBkYXRhLW5hbWU9Ikdyb3VwIDMiPjxwYXRoIGQ9Ik05Ljg2MSA4LjE1OWwzLjU2OC01LjEwNS0xLjIzNC0uODYzIDQuNjg2LTIuMTktLjQ0NiA1LjE1NC0xLjIzNC0uODY0LTQuNzA3IDYuNzM1LTUuMDMzLTIuOTI3LTMuNzQ0IDQuODU2LTEuNzEyLTEuMzIgNC45LTYuMzU4eiIgZGF0YS1uYW1lPSJQYXRoIDIiIGZpbGw9IiMzNmIzN2UiLz48L2c+PC9zdmc+")
}
.coronaBannerWrapper {
 background:#fff;
 box-shadow:0 2px 4px rgba(0,0,0,.16);
 border-radius:8px;
 padding-right:30px;
 width:calc(100% - 10px);
 margin-bottom:16px;
 cursor:pointer;
 height:110px
}
.coronaBannerWrapper,
.coronaBannerWrapper>div {
 display:flex;
 justify-content:space-between;
 align-items:center
}
.coronaBannerWrapper>div {
 width:calc(100% - 149px);
 padding-left:45px
}
.coronaBannerWrapper .bannerTxt {
 font-size:20px;
 font-weight:500;
 color:#253858
}
.coronaBannerWrapper .bannerTxt span {
 display:block;
 font-weight:700;
 font-size:26px
}
.coronaBannerWrapper .bannerCta p {
 padding:12px 22px;
 border:1px solid #ff5630;
 border-radius:4px;
 font-size:14px;
 color:#ff5630;
 text-transform:uppercase;
 font-weight:500
}
.coronaBannerWrapper picture {
 width:149px
}
.coronaBannerWrapper picture img {
 width:100%;
 display:block
}
.coronaBannerWrapper.coronaPlans .bannerTxt span {
 font-size:20px
}
.coronaBannerWrapper.coronaPlans picture {
 width:169px;
 align-self:flex-end
}
@media (min-width:1024px) {
 .hideBig {
  display:none
 }
}
@media (max-width:1023px) {
 .hideSmall {
  display:none
 }
 .coronaBannerWrapper {
  width:100%;
  margin-bottom:0;
  margin-top:12px;
  padding:0;
  position:relative
 }
 .coronaBannerWrapper>div {
  order:1;
  flex-direction:column;
  padding-left:14px;
  align-items:flex-start;
  width:100%
 }
 .coronaBannerWrapper .bannerTxt {
  font-size:15px;
  font-weight:500;
  margin-bottom:8px
 }
 .coronaBannerWrapper .bannerTxt span {
  font-size:15px;
  font-weight:700
 }
 .coronaBannerWrapper .bannerCta p {
  padding:7px 16px
 }
 .coronaBannerWrapper picture {
  order:2;
  align-self:flex-end;
  position:absolute;
  right:0
 }
 .coronaBannerWrapper picture img {
  width:100%;
  display:block
 }
 .coronaBannerWrapper.coronaPlans .bannerTxt {
  white-space:nowrap
 }
 .coronaBannerWrapper.coronaPlans .bannerTxt span {
  font-size:15px
 }
}
.strike_amount_quotes {
 font-size:12px;
 color:#7a869a;
 text-decoration:line-through
}
.quotes_heading_mobile {
 border-bottom:1px solid #dfe1e6
}
@media only screen and (max-width:1023px) {
 .quotes_heading_mobile {
  margin-left:-10px;
  padding-left:10px;
  width:calc(100% + 20px);
  padding-bottom:10px
 }
}
.quotes_heading_supplier {
 margin:0 0 0 10px;
 font-size:16px;
 font-weight:600
}
@media screen and (max-width:420px) {
 .quotes_heading_supplier {
  font-size:4.5vw
 }
}
.discountTag {
 height:17px;
 font-size:13px;
 font-weight:700;
 color:#fff;
 background:#36b37e;
 position:absolute;
 left:0;
 top:0;
 padding:0 14px 0 9px;
 border-radius:0 10px 0 0;
 line-height:17px;
 z-index:8;
 margin-left:211px
}
.discountTag:after {
 content:"";
 border-top:8px solid transparent;
 border-bottom:9px solid transparent;
 border-left:8px solid #fff;
 position:absolute;
 right:134px
}
@media (max-width:1023px) {
 .discountTag+.top_quotes_heading_mobile {
  margin-top:10px
 }
}
.quotes_top_div {
 display:flex;
 flex-direction:row;
 position:relative
}
.cover_container_new {
 display:flex;
 flex-direction:column;
 padding-left:20px;
 width:30%
}
.planContent_container_new_desktop {
 display:flex;
 flex-direction:column;
 width:calc(40% - 40px);
 justify-content:center;
 margin-top:14px
}
.planContent_container_new_desktop.disabled {
 filter:grayscale(1);
 opacity:.3
}
.quotes_new_plan_name_div {
 display:flex;
 flex-direction:column;
 width:calc(100% - 55px);
 padding-top:5px
}
.quotes_new_plan_name_mobile {
 font-size:14px;
 color:#253858;
 width:100%;
 font-weight:500;
 letter-spacing:.2px
}
@media screen and (max-width:420px) {
 .quotes_new_plan_name_mobile {
  font-size:3.8vw
 }
}
.quotes_online_discount_Tag {
 height:20px;
 font-size:10px;
 font-weight:600;
 color:#fff;
 background:#36b37e;
 position:relative;
 left:0;
 padding:0 10px 0 5px;
 line-height:20px;
 z-index:8;
 margin:5px 0 0 -10px
}
@media screen and (max-width:420px) {
 .quotes_online_discount_Tag {
  font-size:2.8vw
 }
}
.quotes_online_discount_Tag:after {
 content:"";
 border-top:10px solid transparent;
 border-bottom:12px solid transparent;
 border-right:7px solid #fff;
 position:absolute;
 right:-1px
}
.new_launched_tag {
 display:flex;
 margin-top:4px
}
@media only screen and (max-width:1023px) {
 .new_launched_tag {
  display:inline-block;
  margin-top:0
 }
}
.new_launched_tag .newLaunchedTag_name {
 font-size:10px;
 font-weight:600;
 color:#00c7e6;
 background-color:#e6fcff;
 padding:0 4px 0 18px;
 border-radius:4px;
 position:relative;
 height:16px;
 line-height:16px
}
@media screen and (max-width:420px) {
 .new_launched_tag .newLaunchedTag_name {
  font-size:2.8vw
 }
}
.new_launched_tag .newLaunchedTag_name:before {
 content:"";
 background:url("data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxMCIgaGVpZ2h0PSI5LjUzNiI+PHBhdGggZD0iTTkuNzY0IDMuNDQ1bC0zLjIzOS0uM0w1LjIzOC4xNTdhLjI2LjI2IDAgMDAtLjQ3NyAwTDMuNDc0IDMuMTQ1bC0zLjIzOS4zYS4yNi4yNiAwIDAwLS4xNDcuNDUzbDIuNDQ0IDIuMTQ3LS43MTUgMy4xNzNhLjI2LjI2IDAgMDAuMzg2LjI4bDIuOC0xLjY2MSAyLjggMS42NjFhLjI2LjI2IDAgMDAuMzg2LS4yOGwtLjcxNS0zLjE3MyAyLjQ0NC0yLjE0N2EuMjYuMjYgMCAwMC0uMTU0LS40NTN6IiBmaWxsPSIjMDBjN2U2Ii8+PHBhdGggZD0iTTUuNzA2IDEuMjQ0TDUuMjM4LjE1OGEuMjYuMjYgMCAwMC0uNDc3IDBMMy40NzQgMy4xNDZsLTMuMjM5LjNhLjI2LjI2IDAgMDAtLjE0Ny40NTNsMi40NDQgMi4xNDctLjcxNSAzLjE3M2EuMjYuMjYgMCAwMC4zODYuMjhsLjM3Mi0uMjIxYTIwLjE1IDIwLjE1IDAgMDEzLjEzMS04LjAzNHoiIGZpbGw9IiMwMGI4ZDkiLz48L3N2Zz4=") no-repeat;
 width:10px;
 height:10px;
 position:absolute;
 left:4px;
 top:50%;
 margin-top:-5px
}
.premiumColumn {
 display:flex;
 flex-direction:column;
 width:60%;
 align-items:flex-start;
 cursor:pointer
}
.premiumColumn .span_network_content {
 margin:2px 0
}
.premiumColumn .span_network_content:after {
 content:none
}
.newPremColCont {
 align-items:flex-start
}
@media only screen and (max-width:1023px) {
 .newPremColMob {
  padding-left:0
 }
}
.shineAnim {
 position:relative;
 background:#6554c0!important
}
.shineAnim:before {
 content:"";
 top:0;
 transform:translateX(100%);
 width:100%;
 height:100%;
 position:absolute;
 z-index:1;
 animation:shineAnim 1.5s infinite;
 opacity:.5;
 background:-moz-linear-gradient(left,hsla(0,0%,100%,0) 0,hsla(0,0%,100%,.8) 50%,rgba(128,186,232,0) 99%,rgba(125,185,232,0) 100%);
 background:-webkit-gradient(linear,left top,right top,color-stop(0,hsla(0,0%,100%,0)),color-stop(50%,hsla(0,0%,100%,.8)),color-stop(99%,rgba(128,186,232,0)),color-stop(100%,rgba(125,185,232,0)));
 background:-webkit-linear-gradient(left,hsla(0,0%,100%,0),hsla(0,0%,100%,.8) 50%,rgba(128,186,232,0) 99%,rgba(125,185,232,0));
 background:-o-linear-gradient(left,hsla(0,0%,100%,0) 0,hsla(0,0%,100%,.8) 50%,rgba(128,186,232,0) 99%,rgba(125,185,232,0) 100%);
 background:-ms-linear-gradient(left,hsla(0,0%,100%,0) 0,hsla(0,0%,100%,.8) 50%,rgba(128,186,232,0) 99%,rgba(125,185,232,0) 100%);
 background:linear-gradient(90deg,hsla(0,0%,100%,0) 0,hsla(0,0%,100%,.8) 50%,rgba(128,186,232,0) 99%,rgba(125,185,232,0));
 filter:progid:DXImageTransform.Microsoft.gradient(startColorstr="#00ffffff",endColorstr="#007db9e8",GradientType=1)
}
@keyframes shineAnim {
 0% {
  transform:translateX(-100%)
 }
 to {
  transform:translateX(100%)
 }
}
.div_effective_exp {
 justify-content:flex-start!important
}
.quotes_compare_container {
 position:fixed;
 box-shadow:0 -5px 6px 0 rgba(0,0,0,.16);
 bottom:0;
 width:100%;
 padding-top:20px;
 padding-bottom:20px;
 background:#fff;
 z-index:98
}
.quotes_compare_container .quotes_compare_container_wrapper {
 display:flex;
 flex-direction:row;
 align-items:center;
 width:100%;
 max-width:1170px;
 margin:0 auto
}
.quotes_compare_div {
 display:flex;
 flex-direction:row;
 width:70%;
 align-items:center
}
.quotes_compare_plan_add {
 justify-content:center;
 border:1px dashed #dfe1e6;
 border-radius:4px;
 box-shadow:0 2px 9px 0 hsla(0,0%,87.1%,.3)
}
.quotes_compare_plan_add,
.quotes_compare_plan_name {
 padding:10px;
 height:70px;
 width:100%;
 margin-left:16px;
 margin-right:16px;
 display:flex;
 flex-direction:row;
 align-items:center
}
.quotes_compare_plan_name {
 position:relative;
 border:1px solid #dfe1e6;
 background-color:#fff;
 border-radius:8px
}
.quotes_compare_span_add_plan {
 font-size:14px;
 color:#7a869a;
 font-weight:500;
 text-align:center
}
.quotes_compare_span_plan_name {
 font-size:14px;
 color:#253858;
 width:100%;
 margin-left:16px;
 width:calc(100% - 86px);
 font-weight:600
}
.quotes_compare_span_plan_name1 {
 font-size:14px;
 color:#253858;
 width:100%;
 margin-left:17px
}
.quotes_compare_image {
 width:70px
}
.quotes_compare_image picture {
 width:70px;
 height:35px;
 border:1px solid #dfe1e6;
 border-radius:8px;
 display:flex;
 align-items:center;
 justify-content:center;
 padding:8px;
 background:#fff
}
.quotes_compare_image picture img {
 max-height:19px
}
.quotes_compare_image1 {
 width:70px;
 height:50px;
 display:flex;
 flex-direction:column;
 justify-content:center;
 align-items:center;
 border:1px solid #dfe1e6;
 background-color:#fff;
 border-radius:50%
}
.quotes_img_compare {
 width:39px
}
.quotes_img_compare1 {
 width:48px;
 height:24px;
 object-fit:contain
}
.quotes_compare_buttons_div {
 width:30%;
 display:flex;
 flex-direction:row;
 align-items:center
}
.quotes_compare_button {
 border-radius:4.5px;
 cursor:pointer;
 background-color:#ff5630;
 color:#fff;
 width:100%;
 margin-left:15px;
 margin-right:15px;
 padding:10px 15px;
 border:none;
 font-size:16px;
 font-weight:500;
 display:flex;
 flex-direction:column;
 align-items:center;
 text-align:center
}
.quotes_compare_button.disabled {
 pointer-events:none;
 background-color:#dfe1e6;
 color:#7a869a
}
.quotes_compare_remove_button {
 font-size:16px;
 cursor:pointer;
 font-weight:500;
 color:#b6b6b6;
 margin:16px;
 width:100%;
 display:flex;
 flex-direction:column;
 align-items:center
}
.div_remove_compare {
 height:19px;
 width:19px;
 display:flex;
 cursor:pointer;
 justify-content:center;
 border:1px solid #253858;
 text-align:center;
 border-radius:100%;
 background:#fff;
 z-index:1;
 position:absolute;
 right:-6px;
 top:-8px
}
.span_cross {
 color:#253858;
 font-weight:500;
 font-size:14px;
 overflow:hidden;
 line-height:500%;
 position:relative;
 display:block;
 width:100%;
 height:100%
}
.span_cross:before {
 transform:translate(-50%,-50%) rotate(45deg)
}
.span_cross:after,
.span_cross:before {
 content:"";
 width:1px;
 height:10px;
 display:block;
 position:absolute;
 left:50%;
 top:50%;
 background:#253858
}
.span_cross:after {
 transform:translate(-50%,-50%) rotate(-45deg)
}
.div_quote_add_compare {
 color:#b3b3b3;
 padding-left:6px;
 padding-right:6px;
 margin-right:0;
 display:flex;
 justify-content:center
}
.span_quote_add {
 color:#b3b3b3;
 font-size:20px;
 margin-top:-8px
}
.cover_compare {
 font-size:12px;
 color:#7a869a;
 font-weight:400;
 display:block;
 margin-top:4px
}
@media screen and (max-width:420px) {
 .cover_compare {
  font-size:3.2vw
 }
}
.cover_compare span {
 color:#7a869a;
 font-size:12px
}
.compare_plan_name2 {
 display:inline-block;
 display:-webkit-box;
 overflow:hidden;
 -webkit-line-clamp:2;
 -webkit-box-orient:vertical
}
@media screen and (max-width:1023px) {
 .div_remove_compare {
  border:1px solid #253858;
  background:#fff
 }
 .span_cross {
  color:#253858
 }
 .quotes_img_compare {
  width:30px
 }
 .quotes_compare_plan_main {
  display:flex;
  flex-direction:row;
  width:100%;
  justify-content:center;
  padding:6px
 }
 .quotes_compare_container {
  border-radius:0;
  flex-direction:column;
  padding:22px 0 0;
  border-top-left-radius:10px;
  border-top-right-radius:10px;
  box-shadow:0 -3px 6px 0 rgba(0,0,0,.16)
 }
 .div_compare_plans_heading {
  display:flex;
  justify-content:flex-start;
  padding:0 16px;
  align-items:flex-start;
  flex-direction:row;
  width:100%
 }
 .compare_plans_heading {
  font-size:16px;
  font-weight:700;
  color:#253858
 }
}
@media screen and (max-width:1023px) and (max-width:420px) {
 .compare_plans_heading {
  font-size:4.5vw
 }
}
@media screen and (max-width:1023px) {
 .span_compare_text_mobile {
  font-size:12px;
  line-height:1.17;
  color:#fff;
  width:70%
 }
 .span_compare_bold {
  color:#fff;
  font-size:16px;
  font-weight:500
 }
 .quotes_compare_div {
  width:100%
 }
 .quotes_compare_plan_add {
  width:50%;
  height:66px;
  padding:0;
  margin-right:0;
  margin-left:10px;
  border-radius:10px;
  border:1px dashed #dfe1e6;
  flex-direction:column
 }
 .quotes_compare_plan_add,
 .quotes_compare_row {
  display:flex;
  align-items:center;
  justify-content:center
 }
 .quotes_compare_row {
  flex-direction:row;
  width:100%;
  padding:23px 16px 16px
 }
 .quotes_compare_plan_name {
  width:50%;
  height:66px;
  background:#fff;
  border-radius:8px;
  border:1px solid #dfe1e6;
  padding:0;
  margin-right:0;
  margin-left:0;
  flex-direction:column
 }
 .quotes_compare_plan_name:nth-child(2) {
  margin-left:10px
 }
 .quotes_compare_image {
  width:50px
 }
 .quotes_compare_image picture {
  width:50px;
  height:25px;
  border-radius:8px;
  padding:4px
 }
 .quotes_compare_image picture img {
  max-height:17px
 }
 .close_compare {
  margin:auto 0 auto auto;
  color:#ff5630;
  width:27px;
  height:27px;
  background-image:url("data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjciIGhlaWdodD0iMjciIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGcgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoMSAxKSIgc3Ryb2tlPSIjMjEyMTIxIiBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiIHN0cm9rZS1saW5lY2FwPSJyb3VuZCIgc3Ryb2tlLWxpbmVqb2luPSJyb3VuZCI+PGNpcmNsZSBjeD0iMTIuNSIgY3k9IjEyLjUiIHI9IjEyLjUiLz48cGF0aCBkPSJNNy41IDE4LjMzM0wxOC4zMzMgNy41TTcuNSA3LjVsMTAuODMzIDEwLjgzMyIgc3Ryb2tlLXdpZHRoPSIyIi8+PC9nPjwvc3ZnPg==");
  background-repeat:no-repeat;
  background-position:0 0;
  text-indent:-999999px
 }
 .quotes_compare_span_add_plan {
  font-size:14px;
  font-weight:500;
  color:#7a869a;
  text-align:center
 }
}
@media screen and (max-width:1023px) and (max-width:420px) {
 .quotes_compare_span_add_plan {
  font-size:3.8vw
 }
}
@media screen and (max-width:1023px) {
 .quotes_compare_span_plan_name {
  font-size:14px;
  margin-left:0;
  text-align:left;
  line-height:1.23;
  overflow:hidden;
  display:-webkit-box;
  color:#253858;
  -webkit-line-clamp:2;
  -webkit-box-orient:vertical;
  width:unset
 }
}
@media screen and (max-width:1023px) and (max-width:420px) {
 .quotes_compare_span_plan_name {
  font-size:3.8vw
 }
}
@media screen and (max-width:1023px) {
 .compare_quotes_button {
  width:100%;
  padding:18px 0;
  color:#ff5630;
  border-top:1px solid #f0f4f5;
  text-align:center;
  font-size:14px;
  border-radius:6px;
  background:#fff;
  font-weight:500
 }
}
@media screen and (max-width:1023px) and (max-width:420px) {
 .compare_quotes_button {
  font-size:3.8vw
 }
}
@media screen and (max-width:1023px) {
 .compare_quotes_button.disabled {
  pointer-events:none;
  color:#7a869a
 }
 .quotes_compare_plan_block {
  width:calc(100% - 58px);
  margin-left:8px
 }
 .cover_compare {
  font-size:12px;
  color:#7a869a
 }
}
@media screen and (max-width:1023px) and (max-width:420px) {
 .cover_compare {
  font-size:3.2vw
 }
}
@media screen and (max-width:1023px) {
 .span_cross:after,
 .span_cross:before {
  background:#253858
 }
 .shortlist_compare_plans .quotes_compare_div {
  align-items:flex-start
 }
 .shortlist_compare_plans .quotes_compare_row {
  padding:18px 6px!important;
  min-height:132px!important;
  position:relative
 }
 .shortlist_compare_plans .quotes_compare_plan_name {
  background:none;
  box-shadow:none;
  width:calc(50% - 20px)!important;
  margin-right:0!important;
  height:auto
 }
 .shortlist_compare_plans .quotes_compare_plan_name:nth-child(2) {
  margin-left:0!important;
  margin-right:0!important
 }
 .shortlist_compare_plans .quotes_compare_plan_name:nth-child(2) .quotes_compare_plan_main {
  align-items:flex-end
 }
 .shortlist_compare_plans .quotes_compare_plan_name:nth-child(2) .quotes_compare_plan_main .quotes_compare_span_plan_name {
  text-align:right
 }
 .shortlist_compare_plans .quotes_compare_plan_main {
  padding:0;
  justify-content:flex-start;
  flex-direction:column
 }
 .shortlist_compare_plans .shortlist_compare_planName {
  width:calc(100% - 48px);
  white-space:normal
 }
 .shortlist_compare_plans .compare_shortlist_button {
  padding:14px 0
 }
}
* {
 scroll-behavior:auto!important
}
body,
html {
 height:unset
}
.checkboxUi label {
 cursor:pointer;
 display:flex;
 align-items:center;
 font-size:14px;
 color:#253858;
 font-weight:400
}
@media screen and (max-width:420px) {
 .checkboxUi label {
  font-size:3.8vw
 }
}
@media only screen and (min-width:1024px) {
 .checkboxUi label {
  font-size:16px
 }
}
@media only screen and (min-width:1024px) and (max-width:420px) {
 .checkboxUi label {
  font-size:4.5vw
 }
}
.checkboxUi label input {
 cursor:pointer;
 width:18px;
 height:18px;
 margin:0 8px 0 0;
 border-radius:4px;
 border:1px solid #5e6c84;
 background:#fff;
 -webkit-appearance:none;
 outline:none;
 transition:all .2s ease-in
}
.checkboxUi label input:checked {
 background:#36b37e;
 border-color:#36b37e
}
.checkboxUi label input:checked:before {
 content:"";
 transform:rotate(45deg);
 border-spacing:0;
 display:block;
 border:2px solid #fff;
 border-top:0;
 border-left:0;
 width:6px;
 height:12px;
 margin:0 0 0 5px
}
.compareRow {
 display:flex;
 width:100%
}
@media only screen and (max-width:1023px) {
 .compareRow {
  margin-top:8px;
  background:#fff;
  padding:14px 0
 }
}
@media only screen and (max-width:1023px) {
 .compareRow__col {
  width:calc(50% - 11px);
  margin-left:22px
 }
 .compareRow__col:first-child {
  margin-left:0
 }
}
@media only screen and (min-width:1024px) {
 .compareRow__col {
  width:calc(33.33333% - 4px);
  margin-right:8px
 }
 .compareRow__col:last-child {
  margin-right:0
 }
}
@media only screen and (max-width:1023px) {
 .compareRow__col:nth-of-type(3) {
  display:none
 }
}
.compareRow--planCol {
 position:relative;
 display:flex;
 flex-direction:column;
 justify-content:space-between;
 align-items:flex-start
}
@media only screen and (max-width:1023px) {
 .compareRow--planCol {
  justify-content:flex-start
 }
 .compareRow--planCol>div {
  margin-top:auto
 }
}
@media only screen and (min-width:1024px) {
 .compareRow--planCol>div {
  width:100%
 }
}
.compareRow--planCol .changePlan {
 width:12px;
 height:12px;
 position:absolute;
 right:0;
 top:0
}
.compareRow--planCol .changePlan:after,
.compareRow--planCol .changePlan:before {
 content:"";
 width:2px;
 height:100%;
 background:#253858;
 position:absolute;
 left:50%;
 top:50%;
 margin:-6px 0 0 -1px
}
.compareRow--planCol .changePlan:before {
 transform:rotate(-45deg)
}
.compareRow--planCol .changePlan:after {
 transform:rotate(45deg)
}
.compareRow--planCol>picture {
 width:80px;
 height:40px;
 border:1px solid #dfe1e6;
 border-radius:8px;
 display:flex;
 align-items:center;
 justify-content:center;
 margin-bottom:10px;
 padding:8px;
 background:#fff
}
@media only screen and (min-width:1024px) {
 .compareRow--planCol>picture {
  width:120px;
  height:60px;
  margin:0
 }
 .compareRow--planCol>picture img {
  max-height:44px
 }
}
@media only screen and (max-width:1023px) {
 .compareRow--planCol>picture img {
  max-height:24px
 }
}
.compareRow--planCol .planName {
 padding-right:16px;
 font-size:16px;
 font-weight:700;
 display:-webkit-box;
 -webkit-line-clamp:2;
 -webkit-box-orient:vertical;
 overflow:hidden;
 text-overflow:ellipsis
}
@media screen and (max-width:420px) {
 .compareRow--planCol .planName {
  font-size:4.5vw
 }
}
.compareRow--planCol .planVal {
 font-size:14px;
 margin-top:8px
}
@media screen and (max-width:420px) {
 .compareRow--planCol .planVal {
  font-size:3.8vw
 }
}
.compareRow--planCol .planVal i {
 font-style:normal
}
@media only screen and (max-width:1023px) {
 .compareRow--planCol .planVal.premiumAmt {
  white-space:nowrap
 }
}
.compareRow--planCol .userViewsCount {
 color:#00a3bf;
 font-size:12px;
 font-weight:600;
 text-align:left;
 margin-top:4px
}
@media screen and (max-width:420px) {
 .compareRow--planCol .userViewsCount {
  font-size:3.2vw
 }
}
@media only screen and (max-width:1023px) {
 .compareRow--planCol .userViewsCount {
  width:90%
 }
}
.compareRow--planCol button {
 -webkit-appearance:none;
 height:33px;
 width:100%;
 border-radius:8px;
 background:#ff5630;
 color:#fff;
 font-size:14px;
 font-weight:700;
 border:none;
 outline:none;
 margin-top:12px;
 cursor:pointer;
 position:relative
}
@media screen and (max-width:420px) {
 .compareRow--planCol button {
  font-size:3.8vw
 }
}
.compareRow__desktopRemCol {
 display:flex;
 width:100%
}
@media only screen and (max-width:1023px) {
 .compareRow__desktopRemCol {
  padding:0 12px
 }
}
.compareRow--addPlanCol {
 cursor:pointer;
 display:flex;
 flex-direction:column;
 justify-content:space-between
}
.compareRow--addPlanCol .plusIcon {
 width:78px;
 height:78px;
 border-radius:50%;
 border:1px dashed #97a0af;
 margin:auto;
 position:relative
}
.compareRow--addPlanCol .plusIcon:after,
.compareRow--addPlanCol .plusIcon:before {
 content:"";
 width:24px;
 height:3px;
 background:#97a0af;
 position:absolute;
 left:50%;
 top:50%;
 transform:translate(-50%,-50%)
}
.compareRow--addPlanCol .plusIcon:after {
 transform:translate(-50%,-50%) rotate(90deg)
}
.compareRow--addPlanCol button {
 background:#fff!important;
 border:1px solid #ff5630!important;
 color:#ff5630!important;
 white-space:nowrap
}
.compareRow--addPlanCol button:hover {
 color:#ff5630!important
}
.topPlanRow {
 position:sticky;
 position:-webkit-sticky;
 top:0;
 margin-bottom:0;
 z-index:9;
 border-bottom:4px solid #f4f5f7;
 background:#fff;
 border-radius:8px 8px 0 0
}
@media only screen and (max-width:1023px) {
 .topPlanRow {
  padding:12px 0 8px;
  border-radius:0
 }
}
.categoryAccordion {
 position:relative;
 width:100%
}
.categoryAccordion>input {
 position:absolute;
 opacity:0;
 visibility:hidden
}
.categoryAccordion>label {
 width:100%;
 display:flex;
 justify-content:space-between;
 align-items:center;
 font-size:16px;
 font-weight:700;
 padding:0 12px
}
@media screen and (max-width:420px) {
 .categoryAccordion>label {
  font-size:4.5vw
 }
}
.categoryAccordion>label span {
 display:block;
 font-size:14px;
 font-weight:400;
 margin-top:4px;
 color:#505f79
}
@media screen and (max-width:420px) {
 .categoryAccordion>label span {
  font-size:3.8vw
 }
}
.categoryAccordion>label i {
 width:32px;
 height:32px;
 position:relative;
 background:#fff;
 border:1px solid #dfe1e6;
 border-radius:50%;
 display:flex;
 align-items:center;
 justify-content:center;
 transition:all .3s ease-in-out
}
.categoryAccordion>label i:before {
 content:"";
 border:solid #253858;
 border-width:0 1px 1px 0;
 display:inline-block;
 padding:4px;
 transform:rotate(45deg);
 position:relative;
 top:-2px
}
.categoryAccordion__contWrapper {
 display:none;
 margin-top:16px
}
.categoryAccordion>input:checked+label i {
 transform:rotate(-180deg)
}
.categoryAccordion>input:checked~.categoryAccordion__contWrapper {
 display:block
}
.featureAccordion {
 position:relative;
 width:calc(100% + 24px);
 padding:0 12px 16px;
 margin-bottom:16px;
 border-bottom:1px solid #dfe1e6;
 margin-left:-12px
}
.featureAccordion.people-buying {
 cursor:default;
 background-color:#e6fcff;
 margin-top:16px;
 border:1px solid #79e2f2!important
}
.featureAccordion:last-child {
 border-bottom:none;
 margin-bottom:0;
 padding-bottom:0
}
@media only screen and (max-width:1023px) {
 .featureAccordion {
  border-radius:8px;
  background:#fff;
  box-shadow:0 6px 16px rgba(37,56,88,.16);
  margin:12px 12px 16px;
  width:auto;
  padding:12px;
  border-bottom:none
 }
 .featureAccordion:last-child {
  padding-bottom:12px
 }
}
.featureAccordion>div>input {
 position:absolute;
 opacity:0;
 visibility:hidden
}
.featureAccordion>div>label {
 width:100%;
 display:flex;
 align-items:center;
 font-size:14px;
 font-weight:700;
 color:#253858
}
@media screen and (max-width:420px) {
 .featureAccordion>div>label {
  font-size:3.8vw
 }
}
@media only screen and (min-width:1024px) {
 .featureAccordion>div>label {
  font-size:16px;
  font-weight:600
 }
}
@media only screen and (min-width:1024px) and (max-width:420px) {
 .featureAccordion>div>label {
  font-size:4.5vw
 }
}
@media only screen and (max-width:1023px) {
 .featureAccordion>div>label {
  justify-content:space-between
 }
}
.featureAccordion>div>label i {
 width:16px;
 height:16px;
 position:relative;
 margin-left:8px;
 display:flex;
 align-items:center;
 justify-content:center;
 transition:all .3s ease-in
}
@media only screen and (min-width:1024px) {
 .featureAccordion>div>label i {
  margin-top:4px
 }
}
.featureAccordion>div>label i:before {
 content:"";
 border:solid #253858;
 border-width:0 1px 1px 0;
 display:inline-block;
 padding:4px;
 transform:rotate(45deg);
 position:relative;
 top:-1px
}
.featureAccordion>div .featureAccordion__contWrapper {
 height:0;
 overflow:hidden;
 transition:height .3s ease-in;
 font-size:14px;
 color:#505f79
}
@media screen and (max-width:420px) {
 .featureAccordion>div .featureAccordion__contWrapper {
  font-size:3.8vw
 }
}
.featureAccordion>div .featureAccordion__contWrapper:before {
 content:"";
 display:block;
 margin-top:4px;
 clear:both
}
.featureAccordion>div>input:checked+label i {
 transform:rotate(-180deg)
}
.featureAccordion>div>input:checked~.featureAccordion__contWrapper {
 height:auto
}
.featureValRow {
 display:flex;
 margin-top:16px
}
.featureValRow__col {
 font-size:16px;
 font-weight:400
}
@media only screen and (max-width:1023px) {
 .featureValRow__col {
  width:calc(50% - 11px);
  margin-left:22px
 }
 .featureValRow__col:first-child {
  margin-left:0
 }
}
@media only screen and (min-width:1024px) {
 .featureValRow__col {
  width:calc(33.33333% - 4px);
  margin-right:8px
 }
 .featureValRow__col:last-child {
  margin-right:0
 }
}
@media screen and (max-width:420px) {
 .featureValRow__col {
  font-size:4.5vw
 }
}
@media only screen and (max-width:1023px) {
 .featureValRow__col {
  color:#253858;
  -webkit-hyphens:auto;
  -moz-hyphens:auto;
  -ms-hyphens:auto;
  hyphens:auto
 }
 .featureValRow__col:nth-child(3n) {
  display:none
 }
}
.featureValRow__col .subLimits {
 font-size:14px;
 margin-top:4px;
 height:0;
 transition:height .3s ease-in;
 overflow:hidden
}
@media screen and (max-width:420px) {
 .featureValRow__col .subLimits {
  font-size:3.8vw
 }
}
.featureValRow__col .subLimits.shown {
 height:auto
}
.featureValRow__col .subLimits.compSumm {
 height:auto;
 transition:none
}
.featureValRow__col__link {
 color:#ff5630;
 cursor:pointer;
 margin-top:6px;
 display:inline-block
}
.featureValRow__col__link:after {
 content:"";
 border:solid #ff5630;
 border-width:0 1px 1px 0;
 display:inline-block;
 padding:2px;
 transform:rotate(-45deg);
 position:relative;
 top:-2px;
 margin-left:4px
}
.featureValRow__col__featNoAvail {
 width:16px;
 height:16px;
 position:relative
}
@media only screen and (min-width:1024px) {
 .featureValRow__col__featNoAvail {
  top:4px
 }
 .featureValRow__col__featNoAvail+.featureValRow__col__link {
  margin-top:14px
 }
}
.featureValRow__col__featNoAvail:after,
.featureValRow__col__featNoAvail:before {
 content:"";
 width:2px;
 height:100%;
 background:red;
 position:absolute;
 left:50%;
 top:50%;
 margin:-8px 0 0 -1px
}
.featureValRow__col__featNoAvail:before {
 transform:rotate(45deg)
}
.featureValRow__col__featNoAvail:after {
 transform:rotate(-45deg)
}
.summaryCard {
 border-top:1px solid #dfe1e6;
 margin-top:16px;
 padding-top:16px
}
.summaryCard:first-child {
 border-top:none;
 margin-top:0;
 padding-top:0
}
@media only screen and (max-width:1023px) {
 .summaryCard:nth-child(3n) {
  display:none
 }
}
.summaryCard__insurer {
 display:flex;
 align-items:center;
 margin-bottom:16px
}
.summaryCard__insurer picture {
 width:80px;
 height:40px;
 border:1px solid #dfe1e6;
 border-radius:8px;
 display:flex;
 align-items:center;
 justify-content:center;
 padding:8px;
 background:#fff;
 margin-bottom:0
}
@media only screen and (min-width:1024px) {
 .summaryCard__insurer picture {
  width:120px;
  height:60px;
  margin:0
 }
 .summaryCard__insurer picture img {
  max-height:44px
 }
}
@media only screen and (max-width:1023px) {
 .summaryCard__insurer picture img {
  max-height:24px
 }
}
.summaryCard__insurer__name {
 margin-left:12px;
 width:calc(100% - 92px);
 font-size:16px;
 font-weight:700
}
@media screen and (max-width:420px) {
 .summaryCard__insurer__name {
  font-size:4.5vw
 }
}
.summaryCard__insurer__name span {
 color:#505f79;
 font-size:14px;
 font-weight:400;
 display:block;
 margin-top:4px
}
@media screen and (max-width:420px) {
 .summaryCard__insurer__name span {
  font-size:3.8vw
 }
}
.summaryCard__planVal {
 display:flex;
 align-items:center;
 margin-bottom:16px
}
.summaryCard__planVal__col {
 width:calc(50% - 11px);
 font-size:16px;
 font-weight:600
}
@media screen and (max-width:420px) {
 .summaryCard__planVal__col {
  font-size:4.5vw
 }
}
.summaryCard__planVal__col:first-child {
 margin-right:22px
}
.summaryCard__planVal__col span {
 font-size:12px;
 color:#7a869a;
 font-weight:400;
 display:block
}
@media screen and (max-width:420px) {
 .summaryCard__planVal__col span {
  font-size:3.2vw
 }
}
.summaryCard__usp {
 margin-bottom:16px
}
.summaryCard__usp p {
 font-size:14px;
 font-weight:600;
 margin-bottom:8px
}
@media screen and (max-width:420px) {
 .summaryCard__usp p {
  font-size:3.8vw
 }
}
.summaryCard__usp ul li {
 font-size:14px;
 font-weight:400;
 color:#505f79;
 margin-bottom:8px;
 position:relative;
 padding-left:12px
}
@media screen and (max-width:420px) {
 .summaryCard__usp ul li {
  font-size:3.8vw
 }
}
.summaryCard__usp ul li:before {
 content:"- ";
 position:absolute;
 left:0
}
.summaryCard__cta {
 -webkit-appearance:none;
 height:48px;
 box-shadow:none;
 border:1px solid #ff5630;
 color:#fff!important;
 font-size:16px;
 font-weight:700;
 width:100%;
 border-radius:8px;
 background:#fff;
 position:relative
}
@media screen and (max-width:420px) {
 .summaryCard__cta {
  font-size:4.5vw
 }
}
.summaryCard__cta:hover {
 color:#fff!important
}
.compareHeader {
 height:58px;
 background:#fff;
 box-shadow:0 3px 6px rgba(37,56,88,.16)
}
@media only screen and (max-width:1023px) {
 .compareHeader {
  height:unset;
  box-shadow:0 1px 4px rgba(37,56,88,.16)
 }
}
.compareHeader__row {
 max-width:1170px;
 padding:0 15px;
 margin:0 auto;
 height:100%;
 display:flex;
 justify-content:space-between;
 align-items:center
}
@media only screen and (max-width:1023px) {
 .compareHeader__row {
  padding:0;
  width:100%;
  display:block
 }
}
.compareHeader__row__pageHeading {
 font-size:18px;
 color:#253858;
 font-weight:700;
 display:flex;
 align-items:center;
 cursor:pointer
}
@media screen and (max-width:420px) {
 .compareHeader__row__pageHeading {
  font-size:5.1vw
 }
}
.compareHeader__row__pageHeading i {
 width:32px;
 height:32px;
 margin-right:8px;
 display:flex;
 align-items:center;
 justify-content:center;
 cursor:pointer
}
.compareHeader__row__pageHeading i:before {
 content:"";
 border:solid #253858;
 border-width:0 3px 3px 0;
 display:inline-block;
 padding:6px;
 transform:rotate(135deg);
 position:relative;
 left:4px
}
.compareHeader__row__tabs {
 height:100%
}
.compareHeader__row__tabs ul {
 height:100%;
 display:flex
}
@media only screen and (max-width:1023px) {
 .compareHeader__row__tabs ul {
  width:100%
 }
}
.compareHeader__row__tabs ul li {
 margin-right:32px
}
@media only screen and (max-width:1023px) {
 .compareHeader__row__tabs ul li {
  margin:0;
  width:50%
 }
}
.compareHeader__row__tabs ul li:last-child {
 margin-right:0
}
.compareHeader__row__tabs ul li a {
 height:100%;
 display:flex;
 align-items:center;
 padding:0 16px;
 font-size:18px;
 font-weight:400;
 color:#6b778c;
 text-transform:none;
 border-bottom:3px solid transparent
}
@media screen and (max-width:420px) {
 .compareHeader__row__tabs ul li a {
  font-size:5.1vw
 }
}
@media only screen and (max-width:1023px) {
 .compareHeader__row__tabs ul li a {
  font-size:14px;
  justify-content:center;
  padding:15px 0;
  color:#253858
 }
}
@media only screen and (max-width:1023px) and (max-width:420px) {
 .compareHeader__row__tabs ul li a {
  font-size:3.8vw
 }
}
.compareHeader__row__tabs ul li.active a {
 color:#253858;
 font-weight:600;
 border-bottom:3px solid #253858
}
@media only screen and (max-width:1023px) {
 .hideSimilar {
  padding:16px
 }
 .hideSimilar label {
  font-size:16px
 }
}
@media only screen and (max-width:1023px) and (max-width:420px) {
 .hideSimilar label {
  font-size:4.5vw
 }
}
@media only screen and (max-width:1023px) {
 .comparisonSummaryWrapper .compareRow {
  background:#f0fdff;
  padding-bottom:0
 }
 .comparisonSummaryWrapper input,
 .comparisonSummaryWrapper label i {
  display:none
 }
 .comparisonSummaryWrapper .categoryAccordion__contWrapper {
  display:block;
  margin-top:4px
 }
 .comparisonSummaryWrapper .categoryAccordion .categoryHeadBlankRow {
  display:flex;
  margin-top:4px;
  position:sticky;
  position:-webkit-sticky;
  top:0;
  z-index:9;
  background:#f0fdff;
  padding:12px 0
 }
}
@media only screen and (max-width:1023px) and (max-width:1023px) {
 .comparisonSummaryWrapper .categoryAccordion .categoryHeadBlankRow {
  padding-left:12px;
  padding-right:12px
 }
}
@media only screen and (max-width:1023px) {
 .comparisonSummaryWrapper .categoryAccordion .categoryHeadBlankRow>div {
  display:flex;
  flex-direction:column;
  font-size:16px;
  font-weight:700
 }
 .comparisonSummaryWrapper .categoryAccordion .categoryHeadBlankRow>div:nth-child(3n) {
  display:none
 }
}
@media only screen and (max-width:1023px) and (max-width:420px) {
 .comparisonSummaryWrapper .categoryAccordion .categoryHeadBlankRow>div {
  font-size:4.5vw
 }
}
@media only screen and (max-width:1023px) and (max-width:1023px) {
 .comparisonSummaryWrapper .categoryAccordion .categoryHeadBlankRow>div {
  width:calc(50% - 11px);
  margin-left:22px
 }
 .comparisonSummaryWrapper .categoryAccordion .categoryHeadBlankRow>div:first-child {
  margin-left:0
 }
}
@media only screen and (max-width:1023px) and (min-width:1024px) {
 .comparisonSummaryWrapper .categoryAccordion .categoryHeadBlankRow>div {
  width:calc(33.33333% - 4px);
  margin-right:8px
 }
 .comparisonSummaryWrapper .categoryAccordion .categoryHeadBlankRow>div:last-child {
  margin-right:0
 }
}
@media only screen and (max-width:1023px) {
 .comparisonSummaryWrapper .categoryAccordion .categoryHeadBlankRow>div picture {
  width:80px;
  height:40px;
  border:1px solid #dfe1e6;
  border-radius:8px;
  display:flex;
  align-items:center;
  justify-content:center;
  margin-bottom:10px;
  padding:8px;
  background:#fff
 }
}
@media only screen and (max-width:1023px) and (min-width:1024px) {
 .comparisonSummaryWrapper .categoryAccordion .categoryHeadBlankRow>div picture {
  width:120px;
  height:60px;
  margin:0
 }
 .comparisonSummaryWrapper .categoryAccordion .categoryHeadBlankRow>div picture img {
  max-height:44px
 }
}
@media only screen and (max-width:1023px) and (max-width:1023px) {
 .comparisonSummaryWrapper .categoryAccordion .categoryHeadBlankRow>div picture img {
  max-height:24px
 }
}
@media only screen and (max-width:1023px) {
 .comparisonSummaryWrapper .categoryAccordion .categoryHeadBlankRow>div p {
  display:-webkit-box;
  -webkit-line-clamp:2;
  -webkit-box-orient:vertical;
  overflow:hidden;
  text-overflow:ellipsis
 }
 .comparisonSummaryWrapper .categoryAccordion .compSummFixHead>label {
  width:100%;
  display:flex;
  justify-content:space-between;
  align-items:center;
  font-size:16px;
  font-weight:700;
  padding:0 12px
 }
}
@media only screen and (max-width:1023px) and (max-width:420px) {
 .comparisonSummaryWrapper .categoryAccordion .compSummFixHead>label {
  font-size:4.5vw
 }
}
@media only screen and (max-width:1023px) {
 .comparisonSummaryWrapper .categoryAccordion .compSummFixHead>label span {
  display:block;
  font-size:14px;
  font-weight:400;
  margin-top:4px;
  color:#505f79
 }
}
@media only screen and (max-width:1023px) and (max-width:420px) {
 .comparisonSummaryWrapper .categoryAccordion .compSummFixHead>label span {
  font-size:3.8vw
 }
}
@media only screen and (max-width:1023px) {
 .comparisonSummaryCta {
  background:#fff!important;
  margin-top:16px;
  padding-bottom:14px!important
 }
 .protipRow {
  margin-top:16px
 }
}
@media only screen and (min-width:1024px) {
 body,
 html {
  background:#253858
 }
 .compareRow__col {
  background:#fff;
  padding:16px;
  border-radius:8px 8px 0 0;
  border-bottom:1px solid #dfe1e6
 }
 .compareRow__desktopFirstCol {
  width:276px;
  margin-left:16px
 }
 .compareRow__desktopRemCol {
  width:calc(100% - 276px)
 }
 .compareRow--planCol .changePlan {
  right:12px;
  top:12px;
  cursor:pointer
 }
 .compareRow--planCol>picture {
  width:80px;
  height:40px;
  border:1px solid #dfe1e6;
  border-radius:8px;
  display:flex;
  align-items:center;
  justify-content:center;
  margin-bottom:10px;
  padding:8px;
  background:#fff
 }
}
@media only screen and (min-width:1024px) and (min-width:1024px) {
 .compareRow--planCol>picture {
  width:120px;
  height:60px;
  margin:0
 }
 .compareRow--planCol>picture img {
  max-height:44px
 }
}
@media only screen and (min-width:1024px) and (max-width:1023px) {
 .compareRow--planCol>picture img {
  max-height:24px
 }
}
@media only screen and (min-width:1024px) {
 .compareRow--planCol .planName {
  margin-top:14px
 }
 .compareRow--planCol .planValWrap {
  overflow:hidden
 }
 .compareRow--planCol .planVal {
  width:50%;
  float:left;
  font-size:16px;
  font-weight:600
 }
}
@media only screen and (min-width:1024px) and (max-width:420px) {
 .compareRow--planCol .planVal {
  font-size:4.5vw
 }
}
@media only screen and (min-width:1024px) {
 .compareRow--planCol .planVal span {
  display:block;
  font-size:12px;
  font-weight:400;
  color:#505f79
 }
}
@media only screen and (min-width:1024px) and (max-width:420px) {
 .compareRow--planCol .planVal span {
  font-size:3.2vw
 }
}
@media only screen and (min-width:1024px) {
 .compareRow--planCol .planVal i {
  display:none
 }
 .compareRow--planCol button {
  height:48px;
  font-size:16px
 }
}
@media only screen and (min-width:1024px) and (max-width:420px) {
 .compareRow--planCol button {
  font-size:4.5vw
 }
}
@media only screen and (min-width:1024px) {
 .topPlanRow {
  border-bottom:none
 }
 .categoryAccordion {
  display:flex;
  flex-wrap:wrap
 }
 .categoryAccordion>input {
  display:none
 }
 .categoryAccordion>label {
  width:276px;
  padding-top:28px;
  font-size:24px;
  margin-bottom:16px
 }
 .categoryAccordion>label i {
  display:none
 }
 .categoryAccordion .categoryHeadBlankRow {
  width:calc(100% - 276px);
  display:flex;
  padding-left:12px
 }
 .categoryAccordion .categoryHeadBlankRow>div {
  background:#fff;
  height:100%
 }
}
@media only screen and (min-width:1024px) and (max-width:1023px) {
 .categoryAccordion .categoryHeadBlankRow>div {
  width:calc(50% - 11px);
  margin-left:22px
 }
 .categoryAccordion .categoryHeadBlankRow>div:first-child {
  margin-left:0
 }
}
@media only screen and (min-width:1024px) and (min-width:1024px) {
 .categoryAccordion .categoryHeadBlankRow>div {
  width:calc(33.33333% - 4px);
  margin-right:8px
 }
 .categoryAccordion .categoryHeadBlankRow>div:last-child {
  margin-right:0
 }
}
@media only screen and (min-width:1024px) {
 .categoryAccordion__contWrapper {
  display:block;
  margin-top:0;
  width:100%
 }
 .featureAccordion {
  width:100%;
  border-bottom:none;
  margin-bottom:0;
  margin-left:0;
  display:flex;
  padding:0 12px;
  flex-wrap:wrap;
  cursor:pointer
 }
 .featureAccordion:nth-child(odd) {
  background:#f5f5f5
 }
 .featureAccordion__desktopFirstCol {
  width:276px;
  padding:24px 12px 24px 0;
  cursor:pointer
 }
 .featureAccordion .featureValRow {
  width:calc(100% - 276px);
  margin-top:0
 }
 .featureAccordion .featureValRow__col {
  padding:24px 16px
 }
 .featureAccordion:last-child .featureAccordion__desktopFirstCol,
 .featureAccordion:last-child .featureValRow__col {
  border-bottom:none
 }
 .featureAccordion>div label {
  justify-content:space-between;
  align-items:flex-start;
  cursor:pointer
 }
 .summaryCard {
  background:#fff;
  padding:16px;
  display:flex;
  flex-direction:column;
  justify-content:space-between;
  margin-top:0;
  border-top:none
 }
}
@media only screen and (min-width:1024px) and (max-width:1023px) {
 .summaryCard {
  width:calc(50% - 11px);
  margin-left:22px
 }
 .summaryCard:first-child {
  margin-left:0
 }
}
@media only screen and (min-width:1024px) and (min-width:1024px) {
 .summaryCard {
  width:calc(33.33333% - 4px);
  margin-right:8px
 }
 .summaryCard:last-child {
  margin-right:0
 }
}
@media only screen and (min-width:1024px) {
 .summaryCard:first-child {
  padding-top:16px
 }
 .summaryCard__insurer,
 .summaryCard__planVal {
  display:none
 }
 .summaryCard__cta {
  background:#ff5630;
  cursor:pointer
 }
 .summaryRow {
  display:flex!important;
  width:100%
 }
 .summaryRow__desktopFirstCol {
  width:262px;
  background:#f4f5f7;
  padding:16px 12px
 }
 .summaryRow__desktopRemCol {
  width:calc(100% - 262px);
  background:#f4f5f7;
  display:flex;
  margin-top:-40px
 }
 .topPlanRow+.compareRow .categoryAccordion>label {
  padding-top:18px
 }
 .compareMainCard {
  max-width:1140px;
  margin:24px auto;
  background:#fff;
  box-shadow:0 6px 16px rgba(37,56,88,.1);
  border-radius:8px
 }
 .compareMainCard .compareRow:last-child {
  border-radius:0 0 8px 8px;
  overflow:hidden
 }
 .comparisonSummaryWrapper {
  background:#f0fdff
 }
 .comparisonSummaryWrapper .featureAccordion:nth-child(odd) {
  background:#defbff
 }
 .comparisonSummaryWrapper .categoryAccordion .categoryHeadBlankRow>div {
  background:#f0fdff;
  display:flex;
  flex-direction:column;
  justify-content:flex-start;
  font-size:16px;
  font-weight:700;
  padding:0 16px
 }
}
@media only screen and (min-width:1024px) and (max-width:420px) {
 .comparisonSummaryWrapper .categoryAccordion .categoryHeadBlankRow>div {
  font-size:4.5vw
 }
}
@media only screen and (min-width:1024px) {
 .comparisonSummaryWrapper .categoryAccordion .categoryHeadBlankRow>div p {
  margin:8px 0 16px
 }
 .comparisonSummaryWrapper .categoryAccordion .categoryHeadBlankRow>div picture {
  width:80px;
  height:40px;
  border:1px solid #dfe1e6;
  border-radius:8px;
  display:flex;
  align-items:center;
  justify-content:center;
  margin-bottom:10px;
  padding:8px;
  background:#fff
 }
}
@media only screen and (min-width:1024px) and (min-width:1024px) {
 .comparisonSummaryWrapper .categoryAccordion .categoryHeadBlankRow>div picture {
  width:120px;
  height:60px;
  margin:0
 }
 .comparisonSummaryWrapper .categoryAccordion .categoryHeadBlankRow>div picture img {
  max-height:44px
 }
}
@media only screen and (min-width:1024px) and (max-width:1023px) {
 .comparisonSummaryWrapper .categoryAccordion .categoryHeadBlankRow>div picture img {
  max-height:24px
 }
}
@media only screen and (min-width:1024px) {
 .comparisonSummaryWrapper .compareRow__col {
  border-radius:0;
  background:#f0fdff;
  border-top:1px solid #dfe1e6;
  border-bottom:none
 }
 .comparisonSummaryWrapper .compareRow__col .planVal {
  margin-top:0
 }
 .comparisonSummaryWrapper .featureValRow__col {
  color:#253858;
  position:relative
 }
 .comparisonSummaryWrapper .categoryAccordion .compSummFixHead {
  display:flex;
  width:100%;
  position:sticky;
  position:-webkit-sticky;
  top:0;
  z-index:2;
  background:#f0fdff;
  padding-top:16px
 }
 .comparisonSummaryWrapper .categoryAccordion .compSummFixHead input {
  display:none
 }
 .comparisonSummaryWrapper .categoryAccordion .compSummFixHead>label {
  align-items:flex-start;
  width:276px;
  font-size:24px;
  margin-bottom:16px;
  display:flex;
  justify-content:space-between;
  font-weight:700;
  padding:0 12px
 }
 .comparisonSummaryWrapper .categoryAccordion .compSummFixHead>label span {
  display:block;
  font-size:14px;
  font-weight:400;
  margin-top:4px;
  color:#505f79
 }
}
@media only screen and (min-width:1024px) and (max-width:420px) {
 .comparisonSummaryWrapper .categoryAccordion .compSummFixHead>label span {
  font-size:3.8vw
 }
}
@media only screen and (min-width:1024px) {
 .comparisonSummaryWrapper .featureAccordion,
 .comparisonSummaryWrapper .featureAccordion>div label,
 .comparisonSummaryWrapper .featureAccordion__desktopFirstCol {
  cursor:default
 }
 .comparisonSummaryWrapper .compareRow {
  overflow:unset!important
 }
 .comparisonSummaryWrapper .categoryAccordion__contWrapper {
  position:relative;
  z-index:1
 }
}
.comparePopupWrapper {
 top:0;
 left:0;
 height:100%;
 z-index:99;
 position:fixed;
 width:100%
}
.comparePopupWrapper:before {
 content:"";
 position:fixed;
 width:100%;
 height:100%;
 background:rgba(23,43,77,.9);
 animation:comparePopMaskOpacity .3s ease-out forwards
}
@keyframes comparePopMaskOpacity {
 0% {
  opacity:0
 }
 to {
  opacity:1
 }
}
.comparePopupWrapper__sidePopupBlock {
 top:0;
 right:0;
 z-index:99;
 box-shadow:0 3px 2px 0 #000;
 background:#fff;
 width:400px;
 height:100%;
 animation:slideInComparePop .3s ease-out forwards;
 position:fixed
}
@media only screen and (min-width:1024px) {
 @keyframes slideInComparePop {
  0% {
   right:-100%
  }
  to {
   right:0
  }
 }
}
@media only screen and (max-width:1023px) {
 .comparePopupWrapper__sidePopupBlock {
  width:100%;
  top:unset;
  bottom:0;
  display:flex;
  flex-direction:column
 }
 @keyframes slideInComparePop {
  0% {
   bottom:-100%
  }
  to {
   bottom:0
  }
 }
}
.comparePopupWrapper__heading {
 height:56px;
 box-shadow:0 1px 4px rgba(37,56,88,.16);
 margin-bottom:16px;
 padding:16px 16px 16px 8px;
 font-size:18px;
 font-weight:700;
 color:#253858;
 display:flex;
 align-items:center
}
@media screen and (max-width:420px) {
 .comparePopupWrapper__heading {
  font-size:5.1vw
 }
}
.comparePopupWrapper__heading i {
 width:24px;
 height:24px;
 margin-right:8px;
 display:flex;
 align-items:center;
 justify-content:center;
 cursor:pointer
}
.comparePopupWrapper__heading i:before {
 content:"";
 border:solid #253858;
 border-width:0 3px 3px 0;
 display:inline-block;
 padding:6px;
 transform:rotate(135deg);
 position:relative;
 left:4px
}
.comparePopupWrapper__content {
 height:calc(100vh - 128px)
}
.comparePopupWrapper__content__cta {
 height:72px;
 box-shadow:0 -3px 6px rgba(37,56,88,.16);
 padding:12px 16px
}
.comparePopupWrapper__content__cta button {
 height:48px;
 width:100%;
 background:#ff5630!important;
 border-radius:8px;
 text-align:center;
 -webkit-appearance:none;
 outline:none;
 border:none!important;
 cursor:pointer;
 font-size:16px;
 font-weight:700;
 color:#fff!important;
 margin-top:0!important
}
@media screen and (max-width:420px) {
 .comparePopupWrapper__content__cta button {
  font-size:4.5vw
 }
}
.comparePopupWrapper__content__cta button:hover {
 color:#fff!important
}
.comparePopupWrapper__content__cta button:disabled {
 background:#dfe1e6!important;
 color:#7a869a!important;
 pointer-events:none;
 cursor:not-allowed
}
.selectInsurer {
 display:flex;
 flex-direction:column;
 padding:0 16px
}
.selectInsurer .searchBox {
 height:56px;
 border:1px solid #253858;
 border-radius:8px;
 padding:2px;
 position:relative
}
.selectInsurer .searchBox input[type=text] {
 -webkit-appearance:none;
 border:none;
 width:90%;
 height:100%;
 padding:16px;
 outline:none;
 font-size:16px;
 color:#253858
}
@media screen and (max-width:420px) {
 .selectInsurer .searchBox input[type=text] {
  font-size:4.5vw
 }
}
.selectInsurer .searchBox input[type=text] ::-webkit-input-placeholder {
 color:#5e6c84
}
.selectInsurer .searchBox input[type=text] ::-moz-placeholder {
 color:#5e6c84
}
.selectInsurer .searchBox input[type=text] :-ms-input-placeholder {
 color:#5e6c84
}
.selectInsurer .searchBox input[type=text] :-moz-placeholder {
 color:#5e6c84
}
.selectInsurer .searchBox:after {
 content:"";
 width:24px;
 height:24px;
 background:url(https://static.pbcdn.in/health-cdn/images/insurer-logo/quotes-logos/search_icon.svg) no-repeat 50%;
 position:absolute;
 right:14px;
 top:50%;
 margin-top:-12px
}
.selectInsurer .insurerWrapper {
 margin-top:28px;
 max-height:calc(100% - 84px);
 overflow:auto;
 padding:10px 10px 0;
 display:flex;
 flex-wrap:wrap;
 justify-content:flex-start;
 -ms-overflow-style:none;
 scrollbar-width:none
}
.selectInsurer .insurerWrapper::-webkit-scrollbar {
 display:none
}
.selectInsurer .insurerWrapper .insurerBlock {
 width:96px;
 box-shadow:0 6px 16px rgba(37,56,88,.1);
 margin-right:30px;
 margin-bottom:32px;
 padding:12px 0;
 text-align:center;
 cursor:pointer;
 background:#fff;
 border-radius:8px
}
.selectInsurer .insurerWrapper .insurerBlock:nth-child(3n+3) {
 margin-right:0
}
.selectInsurer .insurerWrapper .insurerBlock picture {
 display:block;
 margin-bottom:8px
}
.selectInsurer .insurerWrapper .insurerBlock p {
 font-size:12px;
 color:#505f79
}
@media screen and (max-width:420px) {
 .selectInsurer .insurerWrapper .insurerBlock p {
  font-size:3.2vw
 }
}
@media only screen and (max-width:1023px) {
 .selectInsurer .insurerWrapper .insurerBlock {
  width:calc(33.33333% - 10.66667px);
  margin-right:16px
 }
}
@media only screen and (max-width:1023px) {
 .compareHospitalList {
  padding:0
 }
}
.compareHospitalList .selectCashlessBox {
 margin-top:0
}
.compareHospitalList .compareHospitalList_scroll {
 overflow:auto;
 max-height:calc(100vh - 170px)
}
@media only screen and (max-width:1023px) {
 .compareHospitalList .compareHospitalList_scroll {
  max-height:calc(100vh - 220px)
 }
}
.compareHospitalList .features_hosp_list>li {
 width:100%;
 font-size:14px;
 font-weight:500
}
@media screen and (max-width:420px) {
 .compareHospitalList .features_hosp_list>li {
  font-size:3.8vw
 }
}
@media only screen and (min-width:1024px) {
 .compareHospitalList .selectCashlessBox .mainBoxCity .selctCityArea {
  width:172px
 }
}
.compareHospitalList .selectCashlessBox .mainBoxCity .selctCityArea .selectCity .selectedCity {
 margin-left:0
}
@media only screen and (max-width:1023px) {
 .compareHospitalList .selectCashlessBox .mainBoxCity .selctCityArea .selectCity .selectedCity {
  margin:0
 }
}
@media only screen and (min-width:1024px) {
 .compareHospitalList .features_search_hosp {
  width:calc(100% - 130px)
 }
}
.selectPlan__insurerRow {
 border-bottom:1px solid #dfe1e6;
 padding:0 16px 16px;
 display:flex;
 align-items:center
}
.selectPlan__insurerRow picture {
 width:80px;
 height:64px;
 border-radius:8px;
 box-shadow:0 6px 16px rgba(37,56,88,.1);
 display:flex;
 align-items:center;
 justify-content:center;
 margin-right:16px
}
.selectPlan__insurerRow>p {
 font-size:16px;
 font-weight:700
}
@media screen and (max-width:420px) {
 .selectPlan__insurerRow>p {
  font-size:4.5vw
 }
}
.selectPlan__planWrapper {
 padding:16px 16px 0;
 overflow:auto
}
@media only screen and (max-width:1023px) {
 .selectPlan__planWrapper {
  height:calc(100% - 112px)
 }
}
@media only screen and (min-width:1024px) {
 .selectPlan__planWrapper {
  height:calc(100% - 58px)
 }
}
.selectPlan__planWrapper>p {
 font-size:16px;
 font-weight:700;
 margin-bottom:16px
}
@media screen and (max-width:420px) {
 .selectPlan__planWrapper>p {
  font-size:4.5vw
 }
}
.selectPlan__planWrapper__radioBlocks {
 margin-bottom:16px;
 width:100%;
 position:relative
}
.selectPlan__planWrapper__radioBlocks input[type=radio] {
 position:absolute;
 opacity:0;
 visibility:hidden
}
.selectPlan__planWrapper__radioBlocks input[type=radio]+label {
 padding:10px 12px 12px;
 display:flex;
 align-items:center;
 cursor:pointer;
 border:1px solid rgba(37,56,88,.1);
 height:64px;
 border-radius:8px;
 transition:border-color .3s ease-out
}
.selectPlan__planWrapper__radioBlocks input[type=radio]+label .radioIcon {
 width:18px;
 height:18px;
 border-radius:50%;
 border:1px solid #5e6c84;
 margin-right:12px;
 position:relative;
 background-color:#fff;
 transition:background-color .3s ease-out,border-color .3s ease-out
}
.selectPlan__planWrapper__radioBlocks input[type=radio]+label .radioLabel {
 width:calc(100% - 30px);
 font-size:14px
}
@media screen and (max-width:420px) {
 .selectPlan__planWrapper__radioBlocks input[type=radio]+label .radioLabel {
  font-size:3.8vw
 }
}
.selectPlan__planWrapper__radioBlocks input[type=radio]+label .radioLabel>p {
 font-weight:600;
 transition:color .3s ease-out
}
.selectPlan__planWrapper__radioBlocks input[type=radio]+label .radioLabel>span {
 font-weight:400;
 color:#505f79
}
.selectPlan__planWrapper__radioBlocks input[type=radio]:checked+label {
 border-color:#36b37e
}
.selectPlan__planWrapper__radioBlocks input[type=radio]:checked+label .radioIcon {
 background-color:#36b37e;
 border-color:#36b37e
}
.selectPlan__planWrapper__radioBlocks input[type=radio]:checked+label .radioIcon:before {
 content:"";
 width:8px;
 height:8px;
 border-radius:50%;
 background:#fff;
 position:absolute;
 left:50%;
 top:50%;
 transform:translate(-50%,-50%)
}
.selectPlan__planWrapper__radioBlocks input[type=radio]:checked+label .radioLabel>p {
 color:#36b37e
}
.selectCover .radioLabel {
 display:flex;
 justify-content:space-between
}
.selectCover__coverData {
 font-size:14px;
 font-weight:600;
 color:#253858
}
@media screen and (max-width:420px) {
 .selectCover__coverData {
  font-size:3.8vw
 }
}
.selectCover__coverData>p {
 color:#929bab;
 font-size:12px;
 font-weight:400
}
@media screen and (max-width:420px) {
 .selectCover__coverData>p {
  font-size:3.2vw
 }
}
.selectCover__coverData:last-child {
 text-align:right
}
@media only screen and (max-width:1023px) {
 .selectCover .selectPlan__planWrapper {
  height:calc(100% - 207px)
 }
}
@media only screen and (min-width:1024px) {
 .selectCover .selectPlan__planWrapper {
  height:calc(100% - 150px)
 }
}
.compare_hospitalListWrapper {
 position:relative
}
@media only screen and (max-width:1023px) {
 .compare_hospitalListWrapper {
  padding:0!important
 }
}
.compare_hospitalListWrapper .compare_hospitalList.w-100 {
 width:100%
}
.compare_hospitalListWrapper .compare_hospitalList li {
 font-size:16px;
 border-bottom:1px solid #dfe1e6;
 padding:16px 0
}
@media screen and (max-width:420px) {
 .compare_hospitalListWrapper .compare_hospitalList li {
  font-size:4.5vw
 }
}
.hideOnScroll {
 display:none!important
}
.compareSimilar {
 display:block;
 margin:48px auto;
 max-width:1140px
}
@media only screen and (max-width:1023px) {
 .compareSimilar {
  margin:24px auto
 }
}
.compareSimilar__head {
 font-size:24px;
 font-weight:700;
 color:#253858;
 margin-bottom:16px
}
@media only screen and (max-width:1023px) {
 .compareSimilar__head {
  font-size:16px;
  padding-left:12px
 }
}
@media only screen and (max-width:1023px) and (max-width:420px) {
 .compareSimilar__head {
  font-size:4.5vw
 }
}
.compareSimilar .box-mob-slider1 {
 width:100%
}
.compareSimilar .box-mob-slider1 .slider-new1 {
 padding:0 12px!important
}
@media only screen and (min-width:1024px) {
 .compareSimilar .box-mob-slider1 .slider-new1 {
  display:flex!important;
  justify-content:space-between;
  padding:18px 10px!important;
  margin:-18px 0 0 -10px!important;
  width:calc(100% + 20px)
 }
}
.compareSimilar .box-mob-slider1 .slider-new1 .box-new:first-child {
 margin-left:0
}
.compareSimilar .box-mob-slider1 .slider-new1>div {
 width:32%;
 box-shadow:0 6px 16px rgba(37,56,88,.1)!important
}
@media only screen and (max-width:1023px) {
 .compareSimilar .box-mob-slider1 .slider-new1>div {
  width:280px;
  box-shadow:none!important
 }
}
@media only screen and (min-width:1024px) {
 .compareSimilar .box-mob-slider1 .slider-new1>div {
  margin:0!important
 }
}
.compareSimilar .box-mob-slider1 .slider-new1 .similar_plan_ul1>li {
 box-shadow:none!important;
 background:#fff
}
.compareSimilar .box-mob-slider1 .slider-new1 .similar_plan_ul1 button {
 border-radius:8px;
 font-weight:700;
 text-transform:lowercase;
 display:inline-block;
 padding:0 16px
}
.compareSimilar .box-mob-slider1 .slider-new1 .similar_plan_ul1 button:first-letter {
 text-transform:uppercase!important
}
@media only screen and (min-width:1024px) {
 .compareSimilar .box-mob-slider1 .slider-new1 .similar_plan_ul1 button {
  width:220px;
  height:48px;
  font-size:16px
 }
}
@media only screen and (min-width:1024px) and (max-width:420px) {
 .compareSimilar .box-mob-slider1 .slider-new1 .similar_plan_ul1 button {
  font-size:4.5vw
 }
}
@media only screen and (max-width:1023px) {
 .compareSimilar .box-mob-slider1 .slider-new1 .similar_plan_ul1 button {
  width:100%;
  height:33px;
  font-size:14px
 }
}
@media only screen and (max-width:1023px) and (max-width:420px) {
 .compareSimilar .box-mob-slider1 .slider-new1 .similar_plan_ul1 button {
  font-size:3.8vw
 }
}
@media only screen and (max-width:1023px) {
 .compareSimilar .box-mob-slider1 .slider-new1 .similar_plan_ul1 .img-box-logo-similar {
  border:none;
  width:80px;
  height:40px;
  border-radius:0;
  padding:0
 }
 .compareSimilar .box-mob-slider1 .slider-new1 .similar_plan_ul1 .img-box-logo-similar picture {
  width:80px;
  height:40px;
  border:1px solid #dfe1e6;
  border-radius:8px;
  display:flex;
  align-items:center;
  justify-content:center;
  margin-bottom:10px;
  padding:8px;
  background:#fff
 }
}
@media only screen and (max-width:1023px) and (min-width:1024px) {
 .compareSimilar .box-mob-slider1 .slider-new1 .similar_plan_ul1 .img-box-logo-similar picture {
  width:120px;
  height:60px;
  margin:0
 }
 .compareSimilar .box-mob-slider1 .slider-new1 .similar_plan_ul1 .img-box-logo-similar picture img {
  max-height:44px
 }
}
@media only screen and (max-width:1023px) and (max-width:1023px) {
 .compareSimilar .box-mob-slider1 .slider-new1 .similar_plan_ul1 .img-box-logo-similar picture img {
  max-height:24px
 }
}
@media only screen and (max-width:1023px) {
 .compareSimilar .box-mob-slider1 .slider-new1 .similar_plan_ul1 .img-box-logo-similar picture img {
  width:64px
 }
 .compareSimilar .box-mob-slider1 .slider-new1 .similar_plan_ul1 span.grey-mob {
  width:calc(100% - 80px)
 }
 .compareSimilar .box-mob-slider1 .slider-new1 .similar_plan_ul1 ul {
  width:calc(100% - 90px);
  margin-top:-20px
 }
}
@media only screen and (min-width:1024px) {
 .compareSimilar .box-mob-slider1 .slider-new1 .similar_plan_ul1 .img-box-logo-similar {
  height:unset
 }
 .compareSimilar .box-mob-slider1 .slider-new1 .similar_plan_ul1 .img-box-logo-similar picture {
  width:80px;
  height:40px;
  border:1px solid #dfe1e6;
  border-radius:8px;
  display:flex;
  align-items:center;
  justify-content:center;
  margin-bottom:10px;
  padding:8px;
  background:#fff
 }
}
@media only screen and (min-width:1024px) and (min-width:1024px) {
 .compareSimilar .box-mob-slider1 .slider-new1 .similar_plan_ul1 .img-box-logo-similar picture {
  width:120px;
  height:60px;
  margin:0
 }
 .compareSimilar .box-mob-slider1 .slider-new1 .similar_plan_ul1 .img-box-logo-similar picture img {
  max-height:44px
 }
}
@media only screen and (min-width:1024px) and (max-width:1023px) {
 .compareSimilar .box-mob-slider1 .slider-new1 .similar_plan_ul1 .img-box-logo-similar picture img {
  max-height:24px
 }
}
@media only screen and (min-width:1024px) {
 .compareSimilar .box-mob-slider1 .slider-new1 .similar_plan_ul1 .img-box-logo-similar picture img {
  max-height:44px
 }
 .compareSimilar .box-mob-slider1 .slider-new1 .similar_plan_ul1 span.grey-mob {
  font-size:16px;
  font-weight:700
 }
}
@media only screen and (min-width:1024px) and (max-width:420px) {
 .compareSimilar .box-mob-slider1 .slider-new1 .similar_plan_ul1 span.grey-mob {
  font-size:4.5vw
 }
}
@media only screen and (min-width:1024px) {
 .compareSimilar .box-mob-slider1 .slider-new1 .similar_plan_ul1 ul li {
  font-size:16px;
  font-weight:600
 }
}
@media only screen and (min-width:1024px) and (max-width:420px) {
 .compareSimilar .box-mob-slider1 .slider-new1 .similar_plan_ul1 ul li {
  font-size:4.5vw
 }
}
@media only screen and (max-width:1023px) {
 .compareSimilar .box-mob-slider1 .slider-new1 .similarBtmRow {
  width:calc(100% - 90px)
 }
}
.compare-segment .segment_question_popup_mobile {
 top:0;
 left:0
}
.loader_btn.center-loader {
 text-indent:-9999px;
 pointer-events:none
}
.compareHeaderClass .navbar {
 z-index:10
}
.visibility-hidden {
 visibility:hidden
}
.compareRow.topPlanRow #overlay {
 animation:checkPremiumPopMaskOpacity .3s ease-out forwards
}
@media only screen and (min-width:1024px) {
 .compareRow.topPlanRow .byop_popup_checkPremium {
  animation:checkPremiumPopMaskOpacity .3s ease-out forwards
 }
}
@media only screen and (max-width:1023px) {
 .compareRow.topPlanRow .byop_popup_checkPremium {
  animation:slideUpcheckPremium .3s ease-out forwards
 }
 .compareRow.topPlanRow .byop_popup_checkPremium .checkPremium_apply_button {
  height:48px;
  font-size:16px;
  display:flex;
  align-items:center;
  border-radius:8px
 }
}
@media only screen and (max-width:1023px) and (max-width:420px) {
 .compareRow.topPlanRow .byop_popup_checkPremium .checkPremium_apply_button {
  font-size:4.5vw
 }
}
@keyframes checkPremiumPopMaskOpacity {
 0% {
  opacity:0
 }
 to {
  opacity:1
 }
}
@keyframes slideUpcheckPremium {
 0% {
  bottom:-100%
 }
 to {
  bottom:0
 }
}
.fixed-check-premium-modal .byop_popup_checkPremium {
 position:fixed
}
.compare_middleCards {
 margin:16px 50px 16px auto;
 display:flex;
 width:811px
}
@media only screen and (max-width:1023px) {
 .compare_middleCards {
  width:auto;
  margin:16px 12px
 }
}
.compare_middleCards .segmentationBanner {
 margin:0;
 width:100%;
 border-radius:8px
}
.compare_middleCards .segmentationBanner .segment_banner_questionsWrapper .bannerQuestion .bannerOptions .bannerOptions__optionsModule {
 margin-right:10px
}
.compare_middleCards .segmentationBanner .segment_banner_questionsWrapper .bannerQuestion .bannerOptions .bannerOptions__optionsModule input+label {
 padding:7px 18px
}
.bestBuy {
 font-size:14px;
 color:#36b37e;
 font-weight:500;
 font-style:normal;
 display:flex;
 align-items:center;
 margin-bottom:4px
}
@media screen and (max-width:420px) {
 .bestBuy {
  font-size:3.8vw
 }
}
@media only screen and (max-width:1023px) {
 .bestBuy {
  font-size:12px;
  margin:4px 0 0
 }
}
@media only screen and (max-width:1023px) and (max-width:420px) {
 .bestBuy {
  font-size:3.2vw
 }
}
.bestBuy i {
 width:16px;
 height:16px;
 background:#36b37e;
 border-radius:50%;
 margin-left:8px;
 display:flex;
 align-items:center;
 justify-content:center
}
@media only screen and (max-width:1023px) {
 .bestBuy i {
  width:14px;
  height:14px;
  margin-left:0;
  position:relative;
  right:-4px
 }
}
.bestBuy i:before {
 content:"";
 width:10px;
 height:5px;
 border:solid #fff;
 border-width:0 0 1px 1px;
 transform:rotate(-45deg);
 position:relative;
 top:-1px
}
@media only screen and (max-width:1023px) {
 .bestBuy i:before {
  width:8px;
  height:4px
 }
}
.compareProtip {
 width:100%;
 font-size:16px;
 color:#00a3bf;
 border-radius:8px;
 border:1px solid #00a3bf;
 padding:16px 24px 16px 66px;
 margin:16px 16px 32px;
 background:#f2fdff url(https://static.pbcdn.in/health-cdn/images/insurer-logo/quotes-logos/protip.svg) no-repeat 24px 16px
}
@media screen and (max-width:420px) {
 .compareProtip {
  font-size:4.5vw
 }
}
@media only screen and (min-width:1024px) {
 .compareProtip {
  width:735px;
  margin:24px auto 16px
 }
}
@media only screen and (max-width:1023px) {
 .compareProtip {
  font-size:14px;
  padding:16px 12px 16px 44px;
  background-position:12px 12px;
  margin:0
 }
}
@media only screen and (max-width:1023px) and (max-width:420px) {
 .compareProtip {
  font-size:3.8vw
 }
}
.recommendedPlan {
 margin-top:22px;
 border-top:1px solid #dfe1e6;
 padding-top:12px;
 font-size:14px;
 font-weight:600;
 text-align:center
}
@media screen and (max-width:420px) {
 .recommendedPlan {
  font-size:3.8vw
 }
}
.recommendedPlan a {
 color:#ff5630
}
.recommendedPlan a:after {
 content:"";
 border:solid #ff5630;
 border-width:0 1px 1px 0;
 display:inline-block;
 padding:2px;
 transform:rotate(-45deg);
 position:relative;
 top:-1px;
 margin-left:4px
}
@media only screen and (min-width:1024px) {
 .recommendedPlan {
  border-radius:8px;
  align-items:center;
  justify-content:center;
  cursor:pointer;
  padding:8px 0;
  width:calc(100% - 292px);
  margin:0 0 16px auto;
  border:1px dashed #dfe1e6
 }
}
.recPlans {
 overflow:auto;
 padding-top:6px;
 height:calc(100vh - 72px)
}
.recPlans .categoryCards {
 margin-left:0;
 margin-right:0
}
.recPlans .categoryCards .segment_btn {
 border-radius:8px;
 text-transform:none
}
@media only screen and (min-width:1024px) {
 .recPlans .plansCard {
  padding:8px 12px 12px!important;
  margin-bottom:20px!important;
  display:block!important
 }
 .recPlans .plansCard .insurer_plan {
  margin-bottom:20px;
  order:unset!important;
  width:unset;
  display:block
 }
 .recPlans .plansCard .planFeatures {
  border-top:none!important;
  margin-top:0!important;
  padding:0!important;
  order:unset!important;
  width:unset!important;
  margin:0;
  border:none
 }
 .recPlans .plansCard .ctaBar {
  border-top:1px solid #dfe1e6;
  padding-top:12px;
  margin-top:24px;
  display:flex;
  justify-content:space-between;
  align-items:center;
  order:unset!important;
  width:unset;
  flex-direction:unset
 }
 .recPlans .plansCard .ctaBar .buy {
  width:200px
 }
 .recPlans .plansCard .ctaBar .premiumColumn {
  text-align:left
 }
 .recPlans .plansCard .ctaBar .premiumColumn span {
  font-size:24px
 }
}
@media only screen and (min-width:1024px) {
 .compSummFixHead {
  display:flex;
  width:100%
 }
 .compSummFixHead input {
  display:none
 }
}
.compareChat {
 z-index:9!important
}
.compareRecPlans {
 padding:16px;
 margin-bottom:16px
}
.compareRecPlans,
.compareRecPlans picture {
 border-radius:8px;
 border:1px solid #dfe1e6
}
.compareRecPlans picture {
 width:80px;
 height:40px;
 display:flex;
 align-items:center;
 justify-content:center;
 margin-bottom:10px;
 padding:8px;
 background:#fff
}
@media only screen and (min-width:1024px) {
 .compareRecPlans picture {
  width:120px;
  height:60px;
  margin:0
 }
 .compareRecPlans picture img {
  max-height:44px
 }
}
@media only screen and (max-width:1023px) {
 .compareRecPlans picture img {
  max-height:24px
 }
}
.compareRecPlans__name {
 font-size:16px;
 font-weight:700;
 margin:8px 0 16px
}
@media screen and (max-width:420px) {
 .compareRecPlans__name {
  font-size:4.5vw
 }
}
.compareRecPlans__premCover {
 border:1px solid #dfe1e6;
 border-width:1px 0;
 padding:12px 0;
 margin-bottom:12px;
 display:flex;
 justify-content:space-between
}
.compareRecPlans__premCover__block {
 width:45%;
 font-size:16px;
 font-weight:600
}
@media screen and (max-width:420px) {
 .compareRecPlans__premCover__block {
  font-size:4.5vw
 }
}
.compareRecPlans__premCover__block p {
 font-size:12px;
 font-weight:400;
 color:#7a869a
}
@media screen and (max-width:420px) {
 .compareRecPlans__premCover__block p {
  font-size:3.2vw
 }
}
.compareRecPlans__cta {
 text-align:center
}
.compareRecPlans__cta button {
 margin:0 auto;
 text-transform:none;
 width:220px;
 border-radius:8px;
 color:#ff5630!important;
 border:1px solid #ff5630;
 background:#fff
}
.compareRecPlans__cta button:hover {
 color:#ff5630!important
}
.quotes_multi_year_container {
 display:flex;
 flex-direction:row;
 margin-bottom:15px;
 width:99%;
 border-radius:8px;
 box-shadow:0 3px 6px 0 rgba(0,0,0,.16);
 background:#e6fcff;
 padding:16px 20px
}
.div_multi_year_text {
 display:flex;
 flex-direction:column;
 width:40%
}
.div_multi_year_term {
 display:flex;
 flex-direction:row;
 width:60%;
 margin-left:10px
}
.span_multi_year_text1 {
 font-size:14px;
 font-weight:700;
 color:#253858
}
.span_multi_year_text2 {
 font-size:12px;
 color:#253858
}
.div_multi_year_term_option {
 display:flex;
 flex-direction:column;
 width:100%;
 padding:0 10px;
 cursor:pointer
}
.div_multi_year_term_option1 {
 border-radius:40px;
 border:1px solid #253858;
 background:#fff;
 padding:10px;
 font-size:12px;
 font-weight:700;
 color:#253858;
 text-align:center
}
.div_multi_year_term_option1.selected {
 color:#ff5630;
 border:1px solid #ff5630
}
.span_multi_year_term_saving {
 font-size:10px;
 font-weight:500;
 color:#253858;
 text-align:center;
 width:100%;
 padding-top:7px
}
.span_multi_year_term_saving.selected {
 color:#36b37e
}
.div_multi_year_main_heading {
 display:flex;
 flex-direction:row;
 width:100%;
 align-items:center
}
.div_multi_year_main_heading>div {
 width:50%
}
.div_multi_year_main_heading>div:last-child {
 text-align:right
}
.selectBox {
 margin-left:5px;
 border:1px solid rgba(37,56,88,.2);
 border-radius:4px;
 height:inherit;
 line-height:normal;
 display:inline-block;
 background:#fff;
 position:relative
}
.selectBox select {
 background-color:transparent;
 outline:none;
 border:none;
 -webkit-appearance:none;
 -moz-appearance:none;
 appearance:none;
 font-size:14px;
 color:#253858;
 font-weight:500;
 width:75px;
 padding:8px 6px;
 position:relative;
 z-index:2
}
.selectBox:after {
 content:"";
 border:solid #253858;
 border-width:0 1.5px 1.5px 0;
 display:inline-block;
 padding:2px;
 transform:rotate(45deg);
 margin-left:3px;
 vertical-align:middle;
 position:absolute;
 top:13px;
 right:8px;
 z-index:1
}
@media screen and (max-width:1023px) {
 .quotes_multi_year_container {
  flex-direction:column;
  margin-bottom:0;
  margin-top:12px;
  margin-left:-16px;
  width:110%;
  border-radius:0
 }
 .quotes_multi_year_container.compare_class {
  margin-left:0;
  width:100%
 }
 .quotes_multi_year_container.sticky {
  margin-top:0;
  position:sticky;
  top:0;
  z-index:51
 }
 .div_multi_year_text {
  width:100%
 }
 .div_multi_year_term {
  width:100%;
  margin-left:0;
  margin-top:10px
 }
 .div_multi_year_term_option {
  padding:0 10px 0 0
 }
}
body,
html {
 height:100%
}
body {
 font-family:BlinkMacSystemFont,-apple-system,Segoe UI,Roboto,Oxygen,Ubuntu,Cantarell,Fira Sans,Droid Sans,Helvetica Neue,Helvetica,Arial,sans-serif;
 background:#f4f5f7
}
.app {
 min-height:100%
}
.articleWidget {
 width:320px;
 padding:12px;
 background:#fff;
 box-shadow:0 3px 6px rgba(0,0,0,.16);
 position:fixed;
 z-index:9;
 left:20px;
 bottom:20px;
 border-radius:8px;
 overflow:hidden;
 display:flex;
 justify-content:space-between;
 animation:slideArticleWidget .6s ease-out forwards
}
.articleWidget .logo {
 width:60px;
 height:45px;
 float:left;
 margin-right:12px
}
.articleWidget .logo img {
 object-fit:contain;
 width:60px;
 height:45px;
 border-radius:4px
}
.articleWidget .closeWidget {
 position:absolute;
 right:8px;
 width:12px;
 height:12px;
 top:8px;
 cursor:pointer;
 transition:all .3s ease-in
}
.articleWidget .closeWidget:before,
.closeWidget:after {
 content:"";
 width:1px;
 height:12px;
 top:50%;
 margin-top:-6px;
 position:absolute;
 background:#253858;
 left:50%;
 margin-left:-1px
}
.articleWidget .closeWidget:before {
 transform:rotate(45deg)
}
.articleWidget .closeWidget:after {
 transform:rotate(-45deg)
}
.articleWidget .articleData {
 width:calc(100% - 72px)
}
.articleWidget .articleDate {
 font-size:12px;
 color:#7a869a;
 line-height:1.5;
 margin-top:8px
}
.articleWidget .articleTitle {
 font-size:14px;
 color:#253858;
 line-height:1.5;
 font-weight:500
}
.articleWidget .cta {
 cursor:pointer;
 color:#ff5630;
 margin-top:12px;
 font-size:12px;
 font-weight:500;
 text-transform:uppercase
}
.articleWidget .cta:after {
 content:"";
 border:solid #ff5630;
 border-width:0 1px 1px 0;
 display:inline-block;
 padding:3px;
 transform:rotate(-45deg);
 vertical-align:middle;
 position:relative;
 top:0;
 margin-left:6px
}
@keyframes slideArticleWidget {
 0% {
  transform:translateX(-100%)
 }
 to {
  transform:translateX(0)
 }
}
.slideOutWidget {
 animation:slideOutArticleWidget .6s ease-out forwards
}
@keyframes slideOutArticleWidget {
 0% {
  transform:translateX(0)
 }
 to {
  transform:translateX(-120%)
 }
}
.articleDetailWrapper {
 position:fixed;
 width:100%;
 height:100%;
 left:0;
 top:0;
 z-index:99999;
 transition:all .5s ease-in;
 visibility:hidden;
 opacity:0
}
.articleDetailWrapper:before {
 content:"";
 position:absolute;
 background:rgba(0,0,0,.5);
 width:100%;
 height:100%;
 top:0;
 left:0
}
.articleDetailWrapper .articleDetailBox {
 position:absolute;
 background:#fff;
 border-radius:10px;
 padding:14px 0 0;
 min-height:200px;
 width:1000px;
 left:50%;
 top:50%;
 transform:translate(-50%,-50%);
 overflow:hidden
}
.articleDetailWrapper .close {
 width:36px;
 height:36px;
 position:absolute;
 top:8px!important;
 right:16px;
 cursor:pointer;
 background:#dfe1e6;
 border-radius:50%
}
.articleDetailWrapper .close:after,
.articleDetailWrapper .close:before {
 content:"";
 width:2px;
 height:20px;
 top:50%;
 margin-top:-10px;
 position:absolute;
 background:#052f5f;
 left:50%;
 margin-left:-1px
}
.articleDetailWrapper .close:before {
 transform:rotate(45deg)
}
.articleDetailWrapper .close:after {
 transform:rotate(-45deg)
}
.articleDetailWrapper .articleDetailBox .frame {
 margin-top:0;
 height:550px
}
.articleDetailWrapper .articleDetailBox .frame iframe {
 height:100%
}
.articleDetailWrapper.show {
 opacity:1;
 visibility:visible
}
.articleWidgetCard {
 background:#fff;
 border-radius:8px;
 box-shadow:0 3px 6px rgba(0,0,0,.16);
 height:110px;
 margin-top:12px;
 display:flex;
 align-items:center;
 overflow:hidden
}
.articleWidgetCard .image {
 width:111px;
 height:110px
}
.articleWidgetCard .image img {
 width:auto;
 display:block;
 height:110px
}
.articleWidgetCard .desc {
 width:calc(100% - 111px);
 padding:10px 12px
}
.articleWidgetCard .desc .title {
 font-size:14px;
 font-weight:700;
 color:#253858;
 line-height:20px;
 margin:0;
 padding:0
}
.articleWidgetCard .desc .date {
 font-size:10px;
 font-weight:600;
 color:#7a869a;
 line-height:20px;
 margin:3px 0 0;
 padding:0
}
.articleWidgetCard .desc .cta {
 font-size:14px;
 font-weight:500;
 color:#ff5630;
 line-height:20px;
 margin:7px 0 0;
 padding:0
}
.articleWidgetCard .desc .cta span {
 font-size:18px;
 font-weight:300
}
.p0 .articleWidgetCard {
 margin:12px 0 0 38px
}
.tabs-article {
 width:100%;
 margin:0!important;
 border-bottom:1px solid #97a0af!important;
 padding:0 0 0 30px!important;
 display:flex;
 font-size:16px;
 justify-content:space-between
}
.tabs-article ul {
 width:100%;
 display:block;
 height:38px
}
.tabs-article ul li {
 padding:0;
 width:100%;
 font-size:16px;
 width:auto;
 display:inline-block;
 margin-right:47px
}
.tabs-article ul li:last-child {
 margin-right:0
}
.tabs-article ul li a {
 padding:15px 16px;
 color:#253858;
 border-bottom:4px solid transparent
}
.tabs-article ul li a:hover {
 color:#36b37e
}
.tabs-article ul li.is-active a {
 color:#36b37e;
 font-weight:700;
 border-bottom:2px solid #36b37e
}
@media (max-width:1023px) {
 .articleWidget {
  display:none
 }
}
@media (max-width:1023px) {
 .articleDetailWrapper .articleDetailBox {
  padding:0;
  width:90%;
  overflow:hidden
 }
 .articleDetailWrapper .articleDetailBox .frame {
  margin-top:52px;
  height:calc(90vh - 52px)
 }
 .tabs-article {
  padding:57px 0 0 8px!important
 }
 .tabs-article ul {
  width:98%;
  display:flex;
  height:34px;
  justify-content:space-between
 }
 .tabs-article ul li {
  margin-right:0;
  font-size:14px
 }
 .tabs-article ul li a {
  padding:15px 0
 }
}
@media screen and (orientation:landscape) and (max-width:1023px) {
 .tabs-article ul {
  justify-content:flex-start
 }
 .tabs-article ul li {
  margin-right:50px
 }
}
.multiArticlesWrapper {
 position:fixed;
 left:0;
 top:0;
 right:0;
 bottom:0;
 z-index:101
}
.multiArticlesWrapper:before {
 content:"";
 position:fixed;
 background:rgba(23,43,77,.9);
 left:0;
 top:0;
 right:0;
 bottom:0;
 animation:articleMask .3s ease-in-out forwards
}
@keyframes articleMask {
 0% {
  opacity:0
 }
 to {
  opacity:1
 }
}
.multiArticlesWrapper .multiArticlesSideBlock {
 position:absolute;
 width:435px;
 background:#fff;
 right:0;
 top:0;
 height:100%;
 animation:articleSideBar .3s ease-in-out forwards
}
.multiArticlesWrapper .multiArticlesSideBlock .blockHead {
 font-size:18px;
 font-weight:700;
 color:#253858;
 margin:8px 0 35px;
 padding:16px 16px 0
}
.multiArticlesWrapper .multiArticlesSideBlock .articleListWrapper {
 overflow:auto;
 max-height:calc(100% - 80px);
 padding:0 16px
}
.multiArticlesWrapper .multiArticlesSideBlock .articleBlock {
 display:flex;
 margin-bottom:3.1vh
}
.multiArticlesWrapper .multiArticlesSideBlock .articleBlock:last-child {
 margin-bottom:0
}
.multiArticlesWrapper .multiArticlesSideBlock .articleBlock .articleImage {
 width:90px;
 height:51px;
 margin-right:12px;
 display:flex;
 align-items:center
}
.multiArticlesWrapper .multiArticlesSideBlock .articleBlock .articleData {
 width:calc(100% - 102px)
}
.multiArticlesWrapper .multiArticlesSideBlock .articleBlock .articleData .articleTitle {
 font-size:14px;
 color:#253858;
 line-height:21px;
 font-weight:500;
 display:-webkit-box;
 -webkit-box-orient:vertical;
 -webkit-line-clamp:2;
 overflow:hidden
}
.multiArticlesWrapper .multiArticlesSideBlock .articleBlock .articleData .articleSrc {
 font-size:10px;
 font-weight:500;
 color:#5e6c84;
 margin-top:8px
}
.multiArticlesWrapper .multiArticlesSideBlock .articleBlock .articleData .articleSrc strong {
 font-weight:700;
 color:#253858
}
.multiArticlesWrapper .multiArticlesSideBlock .articleBlock .articleData .articleSrc.articleContent {
 display:-webkit-box;
 overflow:hidden;
 -webkit-line-clamp:1;
 -webkit-box-orient:vertical;
 font-size:12px
}
.multiArticlesWrapper .multiArticlesSideBlock .articleBlock .articleData .articleReadMore {
 margin-top:12px;
 font-size:12px
}
.multiArticlesWrapper .multiArticlesSideBlock .articleBlock .articleData .articleReadMore a {
 color:#ff5630;
 font-weight:500;
 text-decoration:none
}
.multiArticlesWrapper .multiArticlesSideBlock .articleBlock .articleData .articleReadMore a:after {
 content:"";
 border:solid #ff5630;
 border-width:0 1px 1px 0;
 display:inline-block;
 padding:3px;
 transform:rotate(-45deg);
 vertical-align:middle;
 position:relative;
 top:-1px;
 margin-left:6px
}
@keyframes articleSideBar {
 0% {
  transform:translateX(100%)
 }
 to {
  transform:translateX(0)
 }
}
.cross_features_popup {
 height:36px;
 width:36px;
 cursor:pointer;
 text-align:center;
 border-radius:50%;
 position:fixed;
 overflow:hidden;
 display:block;
 right:16px;
 top:16px
}
.cross_features_popup:after,
.cross_features_popup:before {
 content:"";
 width:2px;
 height:20px;
 display:block;
 position:absolute;
 left:50%;
 top:50%;
 background:#253858
}
.cross_features_popup:after {
 transform:translate(-50%,-50%) rotate(-45deg)
}
.cross_features_popup:before {
 transform:translate(-50%,-50%) rotate(45deg)
}
@media (max-width:1023px) {
 .multiArticlesWrapper {
  position:static;
  z-index:0;
  margin:0 -16px
 }
 .multiArticlesWrapper:before {
  content:none
 }
 .multiArticlesWrapper .multiArticlesSideBlock {
  position:static;
  width:100%;
  background:none
 }
 .multiArticlesWrapper .multiArticlesSideBlock .blockHead,
 .multiArticlesWrapper .multiArticlesSideBlock .cross_features_popup {
  display:none
 }
 .multiArticlesWrapper .multiArticlesSideBlock .articleListWrapper {
  width:100%;
  overflow:auto;
  max-height:inherit;
  white-space:nowrap;
  margin:12px 0 0;
  -ms-overflow-style:none;
  scrollbar-width:none;
  padding:0 0 0 16px
 }
 .multiArticlesWrapper .multiArticlesSideBlock .articleListWrapper::-webkit-scrollbar {
  display:none
 }
 .multiArticlesWrapper .multiArticlesSideBlock .articleListWrapper .articleBlock {
  width:90%;
  display:inline-block;
  white-space:normal;
  background:#fff;
  border-radius:8px;
  height:130px;
  box-shadow:0 3px 6px rgba(0,0,0,.16);
  margin:0 16px 0 0;
  padding:12px
 }
 .multiArticlesWrapper .multiArticlesSideBlock .articleListWrapper .articleBlock .articleImage {
  width:60px;
  height:45px;
  float:left
 }
 .multiArticlesWrapper .multiArticlesSideBlock .articleListWrapper .articleBlock .articleImage img {
  object-fit:contain;
  width:60px;
  height:45px;
  border-radius:4px
 }
 .multiArticlesWrapper .multiArticlesSideBlock .articleListWrapper .articleBlock .articleData {
  width:calc(100% - 72px);
  float:right
 }
 .multiArticlesWrapper .multiArticlesSideBlock .articleListWrapper .articleBlock .articleData .articleSrc {
  display:block
 }
 .multiArticlesWrapper .multiArticlesSideBlock .why_1cr {
  overflow:hidden;
  padding:0 16px
 }
 .multiArticlesWrapper .multiArticlesSideBlock .why_1cr .articleBlock {
  margin:0;
  width:100%!important;
  height:unset!important
 }
 .multiArticlesWrapper .multiArticlesSideBlock .why_1cr .articleBlock .articleSrc {
  font-size:14px
 }
}
@media screen and (max-width:1023px) and (max-width:420px) {
 .multiArticlesWrapper .multiArticlesSideBlock .why_1cr .articleBlock .articleSrc {
  font-size:3.8vw
 }
}
@media screen and (min-width:320px) and (max-width:330px) {
 .articleBlock {
  width:90%!important;
  height:150px!important
 }
}
.segmentationBanner {
 background:#e6fcff;
 margin:12px 0 0;
 width:auto;
 padding:16px;
 border-radius:0;
 position:relative;
 min-height:115px;
 box-sizing:border-box;
 font-size:16px;
 line-height:20px;
 display:flex;
 align-items:center
}
@media screen and (max-width:420px) {
 .segmentationBanner {
  font-size:4.5vw
 }
}
.segmentationBanner .segment_banner_questionsWrapper .bannerQuestion {
 text-align:left
}
.segmentationBanner .segment_banner_questionsWrapper .bannerQuestion>p {
 font-size:16px;
 font-weight:700;
 color:#253858;
 margin-bottom:8px;
 line-height:1.5
}
@media screen and (max-width:420px) {
 .segmentationBanner .segment_banner_questionsWrapper .bannerQuestion>p {
  font-size:4.5vw
 }
}
.segmentationBanner .segment_banner_questionsWrapper .bannerQuestion .bannerOptions {
 font-size:0;
 white-space:nowrap;
 overflow:auto;
 -ms-overflow-style:none;
 scrollbar-width:none;
 max-width:407px
}
.segmentationBanner .segment_banner_questionsWrapper .bannerQuestion .bannerOptions::-webkit-scrollbar {
 display:none
}
.segmentationBanner .segment_banner_questionsWrapper .bannerQuestion .bannerOptions .bannerOptions__optionsModule {
 position:relative;
 display:inline-block;
 margin-right:12px
}
.segmentationBanner .segment_banner_questionsWrapper .bannerQuestion .bannerOptions .bannerOptions__optionsModule:last-child {
 margin-right:0
}
.segmentationBanner .segment_banner_questionsWrapper .bannerQuestion .bannerOptions .bannerOptions__optionsModule input {
 position:absolute;
 opacity:0;
 visibility:hidden
}
.segmentationBanner .segment_banner_questionsWrapper .bannerQuestion .bannerOptions .bannerOptions__optionsModule input+label {
 border:1px solid #253858;
 border-radius:4px;
 padding:7px 20px;
 font-size:14px;
 font-weight:600;
 color:#253858;
 display:block;
 transition:all .3s ease-in;
 cursor:pointer;
 background:#fff;
 display:inline-block
}
@media screen and (max-width:420px) {
 .segmentationBanner .segment_banner_questionsWrapper .bannerQuestion .bannerOptions .bannerOptions__optionsModule input+label {
  font-size:3.8vw
 }
}
.segmentationBanner .segment_banner_questionsWrapper .bannerQuestion .bannerOptions .bannerOptions__optionsModule input:checked+label {
 border-color:#36b37e;
 background:#f2fffa;
 color:#36b37e
}
.segmentCategoryCardsWrapper {
 padding:0 0 4px 4px;
 margin-top:12px;
 margin-left:-4px;
 font-size:0;
 white-space:nowrap;
 overflow:auto;
 -ms-overflow-style:none;
 scrollbar-width:none
}
.segmentCategoryCardsWrapper::-webkit-scrollbar {
 display:none
}
.segmentCategoryCardsWrapper .segmentCatQuotesHeading {
 font-size:16px;
 font-weight:700;
 color:#253858
}
@media screen and (max-width:420px) {
 .segmentCategoryCardsWrapper .segmentCatQuotesHeading {
  font-size:4.5vw
 }
}
.segmentCategoryCardsWrapper .segmentCategoryCards {
 font-size:14px;
 display:inline-block;
 width:300px;
 margin-right:16px;
 background:#fff;
 box-shadow:0 0 4px rgba(0,0,0,.16);
 border-radius:8px;
 padding:16px;
 overflow:hidden
}
@media screen and (max-width:420px) {
 .segmentCategoryCardsWrapper .segmentCategoryCards {
  font-size:3.8vw
 }
}
.segmentCategoryCardsWrapper .segmentCategoryCards img {
 height:34px;
 width:auto;
 display:block;
 float:left
}
.segmentCategoryCardsWrapper .segmentCategoryCards .categoryDetails {
 float:right;
 margin-left:16px;
 width:calc(100% - 56px)
}
.segmentCategoryCardsWrapper .segmentCategoryCards .categoryDetails .categoryName {
 font-size:16px;
 font-weight:700;
 margin-bottom:8px
}
@media screen and (max-width:420px) {
 .segmentCategoryCardsWrapper .segmentCategoryCards .categoryDetails .categoryName {
  font-size:4.5vw
 }
}
.segmentCategoryCardsWrapper .segmentCategoryCards .categoryDetails .categoryCover {
 font-weight:600;
 margin-bottom:8px
}
.segmentCategoryCardsWrapper .segmentCategoryCards .categoryDetails .categoryPremium {
 font-weight:600;
 margin-bottom:16px
}
.segmentCategoryCardsWrapper .segmentCategoryCards .categoryDetails a {
 font-size:14px;
 font-weight:600;
 text-transform:uppercase
}
@media screen and (max-width:420px) {
 .segmentCategoryCardsWrapper .segmentCategoryCards .categoryDetails a {
  font-size:3.8vw
 }
}
.segmentCategoryCardsWrapper .segmentCategoryCards .categoryDetails a:after {
 content:"";
 border:solid #ff5630;
 border-width:0 1px 1px 0;
 display:inline-block;
 padding:2px;
 -webkit-transform:rotate(-45deg);
 transform:rotate(-45deg);
 vertical-align:middle;
 margin-left:6px;
 position:relative;
 top:-1px
}
.segmentCategoryCardsWrapper .segmentCategoryCards .categoryDetails a:hover {
 color:#ff5630
}
.segmentCategoryCardsWrapper .segmentCategoryStartAgain {
 font-size:14px;
 text-transform:uppercase;
 color:#ff5630;
 font-weight:600;
 display:inline-block;
 vertical-align:top;
 margin-top:55px;
 margin-left:20px;
 margin-right:32px
}
@media screen and (max-width:420px) {
 .segmentCategoryCardsWrapper .segmentCategoryStartAgain {
  font-size:3.8vw
 }
}
.segmentCategoryCardsWrapper .segmentCategoryStartAgain i {
 display:block;
 width:14px;
 height:14px;
 background:url(https://static.pbcdn.in/health-cdn/images/insurer-logo/quotes-logos/segment_startAgain.svg) no-repeat;
 background-size:cover;
 margin:0 auto 8px
}
.segmentCategoryCardsWrapper .segmentCategoryStartAgain.desktop {
 display:none
}
.segmentCategoryCardsWrapper .segmentCatQuotesHeader {
 display:flex;
 align-items:center;
 position:sticky;
 position:-webkit-sticky;
 left:0;
 margin-bottom:12px
}
@media only screen and (max-width:1023px) {
 .segmentationBanner {
  margin-left:-16px;
  margin-right:-16px;
  display:block;
  padding-top:12px
 }
 .segmentationBanner .bannerTxt {
  font-size:12px;
  font-weight:600;
  color:#5e6c84;
  margin-bottom:3px
 }
}
@media only screen and (max-width:1023px) and (max-width:420px) {
 .segmentationBanner .bannerTxt {
  font-size:3.2vw
 }
}
@media only screen and (max-width:1023px) {
 .p0 .segmentationBanner {
  padding-left:32px;
  padding-right:32px
 }
}
@media only screen and (min-width:1024px) {
 .segmentationBanner {
  box-shadow:0 0 4px rgba(0,0,0,.1);
  border-radius:10px;
  padding:16px 0 16px 120px;
  display:flex;
  align-items:center;
  justify-content:space-between;
  margin-top:0;
  margin-bottom:16px;
  width:calc(100% - 10px);
  min-height:112px;
  overflow:hidden
 }
 .segmentationBanner:before {
  content:"";
  position:absolute;
  right:inherit;
  left:22px;
  width:89px;
  height:108px;
  background:url(https://static.pbcdn.in/health-cdn/images/insurer-logo/quotes-logos/segment_quotesBannerIcon.svg) no-repeat;
  background-size:contain;
  bottom:-4px
 }
 .segmentationBanner p {
  font-size:20px;
  font-weight:600;
  line-height:27px
 }
}
@media only screen and (min-width:1024px) and (max-width:420px) {
 .segmentationBanner p {
  font-size:5.6vw
 }
}
@media only screen and (min-width:1024px) {
 .segmentationBanner p span {
  font-weight:700;
  display:block;
  font-size:20px
 }
}
@media only screen and (min-width:1024px) and (max-width:420px) {
 .segmentationBanner p span {
  font-size:5.6vw
 }
}
@media only screen and (min-width:1024px) {
 .segmentationBanner .button {
  margin-top:0;
  height:43px;
  font-size:16px;
  padding:0 20px;
  line-height:43px;
  max-width:inherit
 }
 .segmentationBanner .segment_banner_questionsWrapper {
  display:flex;
  justify-content:flex-start;
  width:100%
 }
 .segmentationBanner .segment_banner_questionsWrapper .bannerQuestion {
  padding-right:16px;
  width:calc(100% - 250px)
 }
 .segmentationBanner .segment_banner_questionsWrapper .bannerTxt {
  font-size:14px;
  color:#253858;
  border-right:1px solid #c1f8ff;
  padding-right:22px;
  width:225px;
  font-weight:400;
  display:flex;
  align-items:center;
  margin-right:25px
 }
}
@media only screen and (min-width:1024px) and (max-width:420px) {
 .segmentationBanner .segment_banner_questionsWrapper .bannerTxt {
  font-size:3.8vw
 }
}
@media only screen and (min-width:1024px) {
 .segmentCategoryCardsWrapper {
  overflow:hidden;
  margin-bottom:12px;
  margin-top:0;
  white-space:normal;
  padding:4px 0 4px 4px
 }
 .segmentCategoryCardsWrapper .segmentCatQuotesHeading {
  font-size:18px
 }
 .segmentCategoryCardsWrapper .segmentCatQuotesHeader+div {
  padding-right:12px;
  display:flex
 }
 .segmentCategoryCardsWrapper .segmentCategoryCards {
  margin-right:0;
  margin-left:12px;
  width:100%
 }
 .segmentCategoryCardsWrapper .segmentCategoryCards:first-child {
  margin-left:0
 }
 .segmentCategoryCardsWrapper .segmentCategoryCards img {
  float:none;
  margin-bottom:15px
 }
 .segmentCategoryCardsWrapper .segmentCategoryCards .categoryDetails {
  float:none;
  width:100%;
  margin-left:0
 }
 .segmentCategoryCardsWrapper .segmentCatQuotesHeader {
  position:static;
  justify-content:space-between
 }
 .segmentCategoryCardsWrapper .segmentCategoryStartAgain {
  cursor:pointer;
  margin:0 16px 0 0
 }
 .segmentCategoryCardsWrapper .segmentCategoryStartAgain i {
  display:inline-block;
  margin-bottom:0;
  vertical-align:middle;
  position:relative;
  top:-1px;
  margin-right:6px
 }
 .segmentCategoryCardsWrapper .segmentCategoryStartAgain.mobile {
  display:none
 }
 .segmentCategoryCardsWrapper .segmentCategoryStartAgain.desktop {
  display:block
 }
}
.popupWrapper .popupBoxRight {
 position:absolute;
 width:378px;
 padding:24px;
 background:#fff;
 right:0;
 top:0;
 height:100vh
}
.popupWrapper .popupBoxRight .pedScroll {
 height:75vh
}
.popupWrapper .popupBoxRight .ped_bottom_button {
 bottom:0;
 position:fixed;
 padding:8px 16px;
 box-shadow:0 1px 5px 0 hsla(0,0%,45.5%,.5);
 background:#fff;
 height:64px;
 width:378px;
 right:0
}
.popupWrapper .popupBox {
 padding:24px
}
.popupWrapper .popupBox .close {
 width:36px;
 height:36px;
 position:absolute;
 top:8px!important;
 right:16px;
 cursor:pointer;
 background:#dfe1e6;
 border-radius:50%
}
.popupWrapper .popupBox .close:after,
.popupWrapper .popupBox .close:before {
 content:"";
 width:2px;
 height:20px;
 top:50%;
 margin-top:-10px;
 position:absolute;
 background:#052f5f;
 left:50%;
 margin-left:-1px
}
.popupWrapper .popupBox .close:before {
 transform:rotate(45deg)
}
.popupWrapper .popupBox .close:after {
 transform:rotate(-45deg)
}
.pedPopUp .pedQues_subTxt {
 font-size:14px;
 font-weight:400;
 color:#253858;
 display:block;
 margin-top:4px
}
@media screen and (max-width:420px) {
 .pedPopUp .pedQues_subTxt {
  font-size:3.8vw
 }
}
.siOptions {
 position:relative;
 margin-bottom:16px
}
.siOptions input {
 position:absolute;
 opacity:0
}
.siOptions label {
 display:block;
 position:relative;
 border:1px solid #253858;
 border-radius:24px;
 padding:6px 16px 7px;
 font-size:14px;
 font-weight:500;
 color:#253858;
 line-height:21px;
 cursor:pointer;
 display:flex;
 justify-content:space-between;
 align-items:center;
 transition:all .3s ease-in
}
@media screen and (max-width:420px) {
 .siOptions label {
  font-size:3.8vw
 }
}
.siOptions label:hover {
 border-color:#36b37e;
 color:#36b37e
}
.siOptions label:hover em {
 color:#36b37e
}
.siOptions label em {
 font-style:normal;
 font-size:14px;
 color:#505f79;
 margin-left:8px;
 font-weight:400;
 transition:all .3s ease-in
}
@media screen and (max-width:420px) {
 .siOptions label em {
  font-size:3.8vw
 }
}
.siOptions label .popular {
 color:#00b8d9;
 font-weight:600;
 font-size:12px
}
.siOptions label .popular .star {
 position:relative;
 display:inline-block;
 width:0;
 height:0;
 margin-left:.9em;
 margin-right:.9em;
 margin-bottom:1.2em;
 border-right:.3em solid transparent;
 border-bottom:.7em solid #00b8d9;
 border-left:.3em solid transparent;
 font-size:7px;
 vertical-align:middle;
 top:-1px
}
.siOptions label .popular .star:after,
.siOptions label .popular .star:before {
 content:"";
 display:block;
 width:0;
 height:0;
 position:absolute;
 top:.6em;
 left:-1em;
 border-right:1em solid transparent;
 border-bottom:.7em solid #00b8d9;
 border-left:1em solid transparent;
 transform:rotate(-35deg)
}
.siOptions label .popular .star:after {
 transform:rotate(35deg)
}
.siOptions input:checked+label {
 border-color:#36b37e;
 background:#36b37e;
 color:#fff
}
.siOptions input:checked+label em {
 color:#fff
}
.btn {
 cursor:pointer;
 text-align:center;
 font-size:14px;
 font-weight:500
}
@media screen and (max-width:420px) {
 .btn {
  font-size:3.8vw
 }
}
.btn:disabled {
 background:#dfe1e6;
 color:#7a869a!important;
 cursor:not-allowed
}
.btn.txtLink {
 background:transparent;
 color:#253858!important;
 width:auto;
 margin:0 auto;
 display:block
}
.dF {
 display:flex;
 padding-top:8px
}
.dF .siOptions {
 width:100%;
 margin-right:14px
}
.dF .siOptions:last-child {
 margin-right:0
}
.dF .siOptions label {
 justify-content:center
}
.dF .siOptions input:checked+label {
 color:#36b37e;
 font-weight:700
}
.startingPrice {
 font-style:normal;
 font-size:12px;
 color:#7a869a;
 font-weight:400;
 text-align:center;
 margin-top:4px
}
@media screen and (max-width:420px) {
 .startingPrice {
  font-size:3.2vw
 }
}
@media (max-width:1024px) {
 .popupWrapper .popupBox {
  width:100%;
  padding:20px 16px 16px;
  background:#fff;
  border-radius:8px 8px 0 0;
  left:0;
  top:inherit;
  bottom:0;
  transform:none
 }
 .popupWrapper .ped_bottom_button {
  bottom:0;
  position:fixed;
  padding:8px 16px;
  box-shadow:0 1px 5px 0 hsla(0,0%,45.5%,.5);
  background:#fff;
  height:64px;
  width:100%;
  left:0
 }
 .pedPopUp .pedPopUpHead {
  font-size:12px;
  margin-bottom:5px
 }
}
@media screen and (max-width:1024px) and (max-width:420px) {
 .pedPopUp .pedPopUpHead {
  font-size:3.2vw
 }
}
@media (max-width:1024px) {
 .pedPopUp .pedQues {
  font-size:16px
 }
}
@media screen and (max-width:1024px) and (max-width:420px) {
 .pedPopUp .pedQues {
  font-size:4.5vw
 }
}
@media (max-width:1024px) {
 .siOptions label {
  font-size:14px
 }
}
@media screen and (max-width:1024px) and (max-width:420px) {
 .siOptions label {
  font-size:3.8vw
 }
}
@media (max-width:1024px) {
 .btn {
  font-size:14px
 }
}
@media screen and (max-width:1024px) and (max-width:420px) {
 .btn {
  font-size:3.8vw
 }
}
.close-box_ped {
 width:36px;
 height:36px;
 background:none;
 border-radius:50%;
 position:relative
}
.headbar-break .close-box_ped:before {
 transform:rotate(45deg)
}
.close-box_ped:after,
.headbar-break .close-box_ped:before {
 content:"";
 position:absolute;
 height:20px;
 width:2px;
 left:17px;
 top:10px;
 background:#253858
}
.close-box_ped:after {
 transform:rotate(-45deg)
}
.headbar-break {
 justify-content:space-between;
 color:#253858;
 display:flex;
 flex-direction:row;
 margin:0 0 16px;
 padding-right:24px;
 align-items:center
}
.headbar-break.single {
 padding-right:0
}
.popupWrapper {
 position:fixed;
 width:100%;
 height:100%;
 z-index:9999
}
.popupWrapper:before {
 content:"";
 width:100%;
 height:100%;
 position:absolute;
 background:rgba(0,0,0,.8)
}
.popupWrapper .pedScroll {
 height:75vh
}
.popupWrapper .ped_bottom_button {
 width:378px;
 right:0
}
.popupWrapper .ped_bottom_button,
.popupWrapper .ped_bottom_button2 {
 bottom:0;
 position:fixed;
 padding:8px 16px;
 box-shadow:0 1px 5px 0 hsla(0,0%,45.5%,.5);
 background:#fff;
 height:64px
}
.popupWrapper .ped_bottom_button2 {
 width:100%;
 left:0
}
.popupWrapper .popupBox {
 position:absolute;
 width:405px;
 padding:24px 0 24px 24px;
 background:#fff;
 border-radius:8px;
 left:50%;
 top:50%;
 transform:translate(-50%,-50%)
}
.enbleClass {
 background-color:#ff5630!important
}
.pedPopUp * {
 letter-spacing:.014em
}
.pedPopUp .pedPopUpHead {
 font-size:14px;
 font-weight:400;
 color:#253858
}
@media screen and (max-width:420px) {
 .pedPopUp .pedPopUpHead {
  font-size:3.8vw
 }
}
.pedPopUp .pedQues {
 font-size:18px;
 font-weight:700;
 color:#253858;
 margin-bottom:20px;
 padding-right:16px
}
.pedPopUp .ped-block {
 display:block;
 font-size:14px;
 font-weight:400
}
@media screen and (max-width:420px) {
 .pedPopUp .ped-block {
  font-size:3.8vw
 }
}
.pedOptions {
 position:relative;
 margin-bottom:16px
}
.pedOptions input {
 position:absolute;
 opacity:0
}
.pedOptions label {
 display:block;
 position:relative;
 border:1px solid #dfe1e6;
 border-radius:24px;
 padding:6px 16px 7px;
 font-size:14px;
 font-weight:500;
 color:#253858;
 line-height:21px;
 cursor:pointer;
 display:flex;
 justify-content:space-between;
 align-items:center;
 transition:all .5s;
 -webkit-transition:all .5s
}
@media screen and (max-width:420px) {
 .pedOptions label {
  font-size:3.8vw
 }
}
.pedOptions label i {
 position:relative;
 width:18px;
 height:18px;
 border:1px solid #dfe1e6;
 border-radius:50%;
 display:flex;
 align-items:center;
 justify-content:center;
 transition:all .3s ease-in
}
.pedOptions label i:after {
 content:none;
 height:4px;
 width:8px;
 border-left:1px solid #fff;
 border-bottom:1px solid #fff;
 transform:rotate(-45deg);
 margin-top:-2px
}
.pedOptions input:checked+label {
 border-color:#36b37e
}
.pedOptions input:checked+label i {
 border-color:transparent;
 background:#36b37e
}
.pedOptions input:checked+label i:after {
 content:""
}
.ped-radio-container {
 display:flex
}
.pedOptions_radio {
 position:relative;
 margin-bottom:26px;
 width:40%;
 margin-right:20px
}
.pedOptions_radio input {
 position:absolute;
 opacity:0
}
.pedOptions_radio label {
 display:block;
 position:relative;
 border:1px solid #dfe1e6;
 border-radius:24px;
 padding:6px 16px 7px;
 font-size:14px;
 font-weight:500;
 color:#253858;
 line-height:21px;
 cursor:pointer;
 display:flex;
 justify-content:center;
 align-items:center;
 transition:all .5s;
 -webkit-transition:all .5s
}
@media screen and (max-width:420px) {
 .pedOptions_radio label {
  font-size:3.8vw
 }
}
.pedOptions_radio input:checked+label {
 border-color:#36b37e;
 color:#36b37e
}
.btnPed {
 background:#dfe1e6;
 height:48px;
 border-radius:4px;
 width:100%;
 -webkit-appearance:none;
 outline:none;
 cursor:pointer;
 text-align:center;
 font-size:14px;
 font-weight:500;
 color:#fff;
 text-transform:uppercase;
 border:none
}
@media screen and (max-width:420px) {
 .btnPed {
  font-size:3.8vw
 }
}
.btnPed:disabled {
 background:#dfe1e6;
 color:#7a869a!important;
 cursor:not-allowed
}
.pedScroll3 {
 height:auto;
 overflow-y:scroll;
 overflow-y:hidden;
 padding-right:16px;
 margin-bottom:34px
}
.pedScroll3 .headingText {
 color:#5e6c84;
 font-size:16px;
 font-weight:700;
 margin-bottom:6px
}
@media screen and (max-width:420px) {
 .pedScroll3 .headingText {
  font-size:4.5vw
 }
}
.pedScroll3 .pedMember {
 margin-bottom:30px
}
.pedScroll2 {
 height:355px;
 overflow-y:scroll;
 padding-right:16px;
 margin-bottom:34px
}
.pedScroll2 .headingText {
 color:#5e6c84;
 font-size:16px;
 font-weight:700;
 margin-bottom:6px
}
@media screen and (max-width:420px) {
 .pedScroll2 .headingText {
  font-size:4.5vw
 }
}
.pedScroll2 .pedMember {
 margin-bottom:30px
}
.quotes_ped_container {
 background:#e6fcff;
 border-radius:8px;
 box-shadow:0 3px 6px 0 rgba(0,0,0,.16);
 margin-bottom:16px;
 width:98.5%;
 display:flex;
 justify-content:space-between;
 padding:0 32px;
 align-items:center
}
.quotes_ped_container .quotes_ped_inner {
 display:flex;
 flex-direction:row;
 align-items:center;
 width:70%
}
.quotes_ped_container .quotes_ped_inner h3 {
 font-weight:700;
 font-size:16px;
 color:#253858;
 line-height:26px
}
@media screen and (max-width:420px) {
 .quotes_ped_container .quotes_ped_inner h3 {
  font-size:4.5vw
 }
}
.quotes_ped_container .quotes_ped_inner h3 span {
 display:block;
 font-size:14px;
 font-weight:400
}
@media screen and (max-width:420px) {
 .quotes_ped_container .quotes_ped_inner h3 span {
  font-size:3.8vw
 }
}
.quotes_ped_container .ped_icon {
 background:url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFMAAABNCAYAAADabljrAAAAAXNSR0IArs4c6QAADARJREFUeAHtXXlwE9cZ/9a6fUiyLRsbX/IBToyJzREw4MR2mhQInU5CQtIptJApU5LpEZpp0/7RYcJMj/TIlCRNW2hDocBkwDSQkECT1NgcoeVoMGBOY2wFG4xv2bLlQ9L2eytLlnZX3tVqZcygj3net9/73vd976d379sFIMxksw0X9/UP7LP122lb/8DZPru9XG6TE2FDjM+UGCGpMjRNGxHERoqijOcvXocuax8snFsIapV2VmysulaqXt98drvd7HDSZz02bAN2mPNQvjVapy7W6XRNvrLhjkeF00C/fWgNKaTHxs2WO9DQ1AI05XzKwwv16qSpp3xtEP03LLcMDhesCVV3sPnDCiapmWyHRkYcADSUs/lS7wPakKowhHxhBTMEv+7JrEopXufOXzGHohRxQnkvXWsyz5hu5oj1WPuMeSXfKOckSGAEskH4gjYoih4Ex4Xm/1R2STDNySIazJwFK2bGamLeTk6KXxQTrRWV70q9BfjAvN3WVTQjP7ua440ERiAbyF+NNlaLUVmQ8Yq1o7NnyxdVW18VIx9IRhCUvLylGjAZNkxJiP9pbnaaIpAiPr5Wo+Zjg1KpAENcDG9asMxANghfrA2UM6QkJ/wkMWH9yhuNtxc3nNldF6wfRF6wz3QmGvOnJBqDBlKKM3c7T+oU09S83PT3pPohCGacTr01KzM1qBop5EzLrTtCInctfUpSfOH8JetWSXFgXDDN5jVagz52tlIhDctzddf9fFKrlJCelgzXbjT78UO54bORY06D5lttktUmJxlelpJ5XDCVU+zFCfF6yauk5tttUHmghvGLFPDpJ8vgXF09nMPVkFzEZ+P02Ush2VCp1DlS/Bt/AKIorRSlvnmqj/8Pzl+sh4QEA3R1WaGzu9c3WZa43DZ0WpVeimPjgylFI08eAmA4QPQ1JacNRZRCEi7jNnNfZyNxYQQiYApjJFoiAqZoqIQFI2AKYyRaQrCjvXnzS2iOojkKHystgZkF0zn8e4nRZGmGDz45zHEZByBJGx+CYNps3UBRTo7BkeFB6Mdd7XuZnK4RsPV1copAu0DSxkGkmXOglM4QrJk0pcONcS49kJ8NSypKuAn3EOd07WVwQSzHYzrKdYXDFMEQBBMoFa+aRKMBsjJSeNPuFaalGTdc+MvXLaUMkWYuBbUAeSJgBgBGCjsCphTUAuSJgBkAGCnsCJhSUAuQJwJmAGCksCNgSkEtQJ4ImAGAkcIWnrRL0Tqa51ibFd652sLRkBOrhV/NyuHwHQ4nbPj9Zg6fMH784ipIMHKfJvxj70G4cr2Jk2dJ+QJ4tGQWhx9ORljBbLINwm4L9ynh7IRYXjCdLhd8dvQkb3m/t/pZAB4wz9ZdheOnuKcT83OzJhzMSDPn/emkMcNaM+eZ4uCth6dxPEvW8q/3ybEZ0pz5yGjgPye2fGkFlMwu5GQpKuDa5QjJzAgrmPn6aCBBLCmiouD5rz8hVpyRe2R+cVDy4RSONHMZ0Y2AGQFTRgRkVBXWPlNGP2VX1d7VA4kmPdTsfxuSEo2gUvpBUQ7wHt8DBmjr6IYrDY1by0rmfIftlJ8GdmKo9/V9dqi6zd20TsLR/JnMJI56Ms/cf6iGwyeMJRULAU8sc9JOnDkPt+90cPiFD+QCmWvy0eDQMHQgmFEUBdY+GxPYcvsOVbNZ3nsE/gW8mVgw/9veCy+duuZ1whMhk3Y+MMkK6PV3tnvE/K5k+sMHZuVHVbyT9u+/8FxAMF34oxFq7+yGxi9bYN6sQrD22uDCletQOm9sdkB+XIulHXKypzDyDTfuQLY5CUYcDt6Tgff1AETAGh4eYYBy4fNdUmP9CBs6+YE9ROK8bX9UIKzNPAvX4MszTB5fvNfcOJ037hsh88yKhXN8Wd64Tsdt4iSRTM5VONlnU1b6xD/sCyuYjyYbgASxRFZAv/35D8WKM3JrnvtaUPLhFL6vm7ncwN6XYEZhdxIKBTrjH9ZmHorD4cxL3hHKzpgKG9qd0Juqgb91K0Hp0EOcuQB2YhwooBPziigaz3uoTJlw3JTIuKOKT4PTJlPvtxxdy/j8uy/BJEAUXu6BBgo3YaIxkAGbwkFMp3HHCZyq0b4+JX4MtxSGpz+gMf0SmWVjCe7YpAIT39AFS3Mr20fmPj01mXmzjZ1IViQD9kE2G+KNcfiGGvccERHMq22DhsGxKQ8nM2E4x0l3Oh+Fw5Yj8FiWH6CTCsxhfH16xbqf8ZZt/7u/gzQElE2//uO2gJP21Su4rVEUkGwjfPfDgxxAQ+uJ+YxMYt7aG1bhGhmM/wTQoze9L69OqpqJS2XQx/KfM41S8P/uZInJl0ej9t/N33S7H95tGwgGKnGydvtv4ETrIViYcmFSgalWqaBqz5/EFWJU6hevviRK/rUWmyi5oIWwn4fBgQOYz8z/cwetcXJnsAy7wIof7QgbOZyZRLfkmjnegr8Z39r9pOYEJMTHQ3PLLfjB2m+GrRxiFO/rDPPZe5eL2UWSXDP59qDI1GbPh5/CsZO1DJCkoOlpU2HTlp0wxN6REYOCTDI1vazdIDF6ySqJ9NNiw7Gbr0uumS7SV/hQfUMTHP78DCQnmQC7Pj/KykiHP2+vhBfxIIFWgxPjCabiGCV8wNqjLterx91OWxSNW3P+RfR6fRbnqId63Ft3Xuawo1UymC2t7V49OyoPgEKhYoD0MlmRrIw02Lx9L7z83ZWslIm/JUBWF7iXiGzrpBYfwXCxtR/WGWiYiotKNq2KoRBMNjeEPvMv296Hjo42bM6JuBPN9L9c7SxOJgL65pZdkwJQlmve29ea+xgwwUpWVVrYaOSC6RVmRSTXTJpWwd4Dn5I9AVy6GeDB/Gkwt3gmpKa4t/hZdry3HkDXfRubvHbim7zXkTBEJIOJr60BTWsRTDt091jhxMkzTBADLAF0885/wsrlS8GU4LOREIYCTqRK6WASL/FDCS78AA1FDzA1lLDEApuJo/y+j6vhK2XzICcznWS9K1Q74IBZ58f6f18nKjsHoXL0bUD83hxczGGNrL7CGA8NTEaZGlz4YhIFw0C5BrHCjk2OhYA1mRLgyIkv4PLVBlj2RBnLtYm57RE5mSfTPiGSAUyy+UdmnRqgozDgUz6AETe4eCWphMYDdthBw1t/3QVrVy2HaB3/wzZGyST/IwuYfmWkyDoAQWWCC7sAAihOmvFKmgqhQMDuqDwIBdPN8EgJ/xNKJrPMf8g06Q9ZeuhxulvUtjY7WIbde5mpGiWUxrohelhHfB9njxNT5QfTr7BR+K1MMmJjwOZP09gVkO7Axyk+YM9dqmdO/T5UkO+nLVw361PHdqrIPNMDJgFyo3Gs2xKy7wfm6LcoizyZtu0+WPTZkTOeW+baMuRg4PBj+tw48B30nqabPhxPFGssDlg0zt1o/Md0BaTWMjXW3R/5Artrzz4oLZkLj5cthMUVizxKJvWVARNBJGdC/o5h7GwI3qx5/kkm+Jbglc8vg1bE6Fv/8b/h0t6PYKSfbw+RNBlczlH44T2M0jQ2HzJw0Y7RWutguoID/6oCEuJwj/OrFaVQvmgezJ9TBPoAjyN8/ZQaL452j9jXBpWQqyZdVhA1E4E0Y45qDEYMstG0ZY+DwZwBRze+IayTPMwCDDgrcNdRLAKOnhQWhHQJVpsLFwjVsPfDKpShsV/NgQcx5OVkQq45E1KSTbhw0EPy6FNEIYNkBCdLRj56OkELJCSr+zDZwScC9TSpg9z8hLsJg6xAejxInpEPWeULwYLbccGSe7BSILgEaKy05I97/IKL9R1MADhFuILUuWQxwGIMo0TmluWXuJ+T8KQzVysXrLF0/jRSj8vHhOSPGbF23i+kvHy9sQd/8tGHxMLF3tHWDx0K8Y8AjD1DwD2JKWxHTglNc4uc6vh1aTX7yNylhj9VHm5MXZ08ikLQorl1K4TcYrLi53UWTbVE6VSwHnskq5gswcrEXKiD6Ovyfd4xWPseeVVXF+gawuiHSkUeqLm79MuNjWaXAzbhPlC5UJMvvWFv7dIbxz38qLD2DsWer21Nen9/EzEyWajtmWezexfMz8Cd7NGhbBzP8H87ECQFfj1LrX4TyrJ+JCgbEQgOgf8DFrbcw7KsNBEAAAAASUVORK5CYII=") no-repeat 0 0;
 width:83px;
 height:77px;
 text-indent:-99999px;
 display:inline-block;
 margin:8px 40px 8px 0
}
.quotes_ped_container button {
 width:82px;
 height:36px;
 border:1px solid #253858;
 display:inline-flex;
 align-items:center;
 border-radius:4px;
 color:#253858!important;
 justify-content:center;
 font-size:14px;
 font-weight:500;
 cursor:pointer;
 margin-left:12px;
 outline:none;
 background-color:#fff
}
@media screen and (max-width:420px) {
 .quotes_ped_container button {
  font-size:3.8vw
 }
}
.quotes_ped_container button:hover {
 color:#253858!important;
 outline:none;
 background-color:#fff
}
.autoHeight {
 height:auto
}
.autoHeight,
.ped_scroll_center {
 overflow:auto;
 margin-bottom:40px;
 padding-right:24px
}
.ped_scroll_center {
 height:250px
}
.popupBoxRight {
 position:absolute;
 width:378px;
 padding:24px 0 24px 24px;
 background:#fff;
 right:0;
 top:0;
 height:100%
}
.popupBoxRight .ped_right_scroll {
 height:calc(100vh - 190px);
 overflow:auto;
 padding-right:24px
}
.popupBoxRight .ped_right_scroll .headingText {
 color:#5e6c84;
 font-size:16px;
 font-weight:700;
 margin-bottom:6px
}
@media screen and (max-width:420px) {
 .popupBoxRight .ped_right_scroll .headingText {
  font-size:4.5vw
 }
}
.popupBoxRight .ped_right_scroll .pedMember {
 margin-bottom:30px
}
.popupBoxRight .pedQues {
 margin-top:30px
}
.pedClose_right {
 background:#dfe1e6;
 width:36px;
 height:36px;
 display:block;
 border-radius:30px;
 text-indent:-999999px;
 top:12px;
 position:absolute;
 right:11px;
 cursor:pointer
}
.pedClose_right:after,
.pedClose_right:before {
 content:"";
 position:absolute;
 height:22px;
 width:2px;
 background:#253858;
 transform:rotate(-45deg);
 left:17px;
 top:8px;
 border-radius:3px
}
.pedClose_right:before {
 transform:rotate(45deg)
}
.right-box {
 padding-right:24px!important
}
@media (min-width:1024px) {
 .pedOptions_radio label:hover,
 .pedOptions label:hover {
  border:1px solid #253858
 }
}
@media (max-width:1023px) {
 .popupWrapper .popupBox {
  width:100%;
  padding:20px 16px 16px;
  background:#fff;
  border-radius:8px 8px 0 0;
  left:0;
  top:inherit;
  bottom:0;
  transform:none
 }
 .popupWrapper .ped_bottom_button {
  bottom:0;
  position:fixed;
  padding:8px 16px;
  box-shadow:0 1px 5px 0 hsla(0,0%,45.5%,.5);
  background:#fff;
  height:64px;
  width:100%;
  left:0
 }
 .headbar-break {
  padding-right:0
 }
 .pedPopUp {
  margin-bottom:0;
  padding-left:0
 }
 .pedPopUp .pedPopUpHead {
  font-size:12px;
  margin-bottom:5px
 }
}
@media screen and (max-width:1023px) and (max-width:420px) {
 .pedPopUp .pedPopUpHead {
  font-size:3.2vw
 }
}
@media (max-width:1023px) {
 .pedPopUp .pedQues {
  font-size:16px
 }
}
@media screen and (max-width:1023px) and (max-width:420px) {
 .pedPopUp .pedQues {
  font-size:4.5vw
 }
}
@media (max-width:1023px) {
 .pedOptions label {
  font-size:14px
 }
}
@media screen and (max-width:1023px) and (max-width:420px) {
 .pedOptions label {
  font-size:3.8vw
 }
}
@media (max-width:1023px) {
 .btnPed {
  font-size:14px
 }
}
@media screen and (max-width:1023px) and (max-width:420px) {
 .btnPed {
  font-size:3.8vw
 }
}
@media (max-width:1023px) {
 .pedScroll {
  margin-bottom:60px
 }
 .quotes_ped_container {
  border-radius:0;
  box-shadow:0 3px 6px 0 rgba(0,0,0,.16);
  margin-bottom:5px;
  width:110%;
  justify-content:left;
  padding:16px 22px;
  align-items:flex-start;
  flex-direction:column;
  margin-top:16px;
  margin-left:-16px
 }
 .quotes_ped_container button {
  background:#fff;
  margin:6px 12px 0 0
 }
 .quotes_ped_container .arrow-link {
  content:"";
  border:solid #253858;
  border-width:0 1.5px 1.5px 0;
  display:inline-block;
  padding:3px;
  transform:rotate(-45deg);
  margin-left:3px;
  top:-2px
 }
 .quotes_ped_container .quotes_ped_inner {
  width:100%
 }
 .card-2 {
  align-items:center;
  flex-direction:row
 }
 .ped-radio-container {
  flex-direction:column
 }
 .ped-radio-container .pedOptions_radio {
  width:100%;
  margin-right:0;
  margin-bottom:16px
 }
 .ped-radio-container .pedOptions_radio label {
  justify-content:left
 }
 .popupBoxRight {
  width:100%;
  padding:20px 16px 16px;
  background:#fff;
  border-radius:8px 8px 0 0;
  left:0;
  top:inherit;
  bottom:0;
  transform:none;
  height:auto
 }
 .popupBoxRight .ped_right_scroll {
  height:auto;
  margin-bottom:64px
 }
 .popupBoxRight .pedQues {
  margin-top:0
 }
}
.quotes_filterBar_topup .quotes_filter_insurer1,
.quotes_filterBar_topup .quotes_filter_insurer2,
.quotes_filterBar_topup .quotes_filter_insurer4,
.quotes_filterBar_topup .quotes_filter_insurer5 {
 border:1px solid #dfe1e6
}
.quotes_filterBar_topup .quotes_filter_insurer3 {
 position:relative;
 display:flex;
 flex-direction:row;
 margin-left:15px;
 cursor:pointer;
 padding:3px 17px;
 width:23%;
 background:#fff;
 border-radius:3px;
 box-shadow:0 2px 9px 0 hsla(0,0%,87.1%,.3);
 border:1px solid #dfe1e6;
 align-items:center
}
.quotes_filterBar_topup .quotes_filter_insurer4 {
 width:17%
}
.quotes_filterBar_topup .span_insured_text {
 font-weight:400
}
.topup_right_banner {
 width:100%;
 box-shadow:0 2px 4px 0 rgba(0,0,0,.16);
 border-radius:10px;
 background:#fff;
 margin:0 0 20px;
 display:flex;
 justify-content:space-between;
 height:129px
}
.topup_banner_text {
 font-size:14px;
 font-weight:700;
 color:#253858;
 padding:16px 0 0 16px
}
@media screen and (max-width:420px) {
 .topup_banner_text {
  font-size:3.8vw
 }
}
.topup_banner_text span {
 font-size:20px;
 display:block
}
.topup_banner_text button {
 background:#fff;
 border:1px solid #ff5630;
 width:110px;
 height:34px;
 border-radius:4px;
 margin:10px 0 16px;
 color:#ff5630!important;
 font-size:12px;
 font-weight:600;
 cursor:pointer
}
@media screen and (max-width:420px) {
 .topup_banner_text button {
  font-size:3.2vw
 }
}
.topup_banner_text button:hover {
 color:#ff5630!important
}
.topup_banner_right img {
 border-radius:0 10px 10px 0;
 height:129px
}
#overlay_topup {
 position:fixed;
 top:0;
 left:0;
 bottom:0;
 right:0;
 height:100%;
 width:100%;
 margin:0;
 padding:0;
 background:rgba(23,43,77,.9)!important;
 opacity:1;
 z-index:99
}
.topup_modal {
 max-width:600px;
 height:auto;
 left:50%;
 top:50%;
 transform:translate(-50%,-50%);
 bottom:auto;
 border-radius:10px;
 box-shadow:0 2px 4px 0 rgba(0,0,0,.16);
 padding:16px;
 width:100%;
 background-color:#fff;
 position:fixed;
 z-index:999;
 font-size:14px;
 color:#505f79
}
@media screen and (max-width:420px) {
 .topup_modal {
  font-size:3.8vw
 }
}
.existing_modal {
 max-width:445px
}
.existing_select {
 border:1px solid #5e6c84;
 height:56px;
 border-radius:4px;
 width:100%;
 padding:0 12px;
 position:relative
}
.existing_select span {
 font-size:12px;
 color:#5e6c84;
 position:absolute;
 left:11px;
 top:-9px;
 background:#fff;
 padding:0 7px
}
@media screen and (max-width:420px) {
 .existing_select span {
  font-size:3.2vw
 }
}
.existing_select select {
 width:100%;
 height:40px;
 margin:9px 0 0 7px;
 border:none;
 font-size:16px;
 outline:none;
 -webkit-appearance:none;
 -moz-appearance:none;
 appearance:none;
 background:#fff
}
.existing_select:after {
 content:"";
 border:solid #253858;
 border-width:0 1.5px 1.5px 0;
 display:inline-block;
 padding:4px;
 transform:rotate(45deg);
 margin-left:3px;
 vertical-align:middle;
 position:absolute;
 top:23px;
 right:15px
}
.topup_modal h2 {
 margin:0;
 padding:0 0 12px;
 list-style:none;
 position:relative;
 line-height:1.64;
 letter-spacing:.2px;
 font-size:18px;
 font-weight:700;
 color:#253858
}
.topup_modal p {
 margin-bottom:12px
}
.close_topup_modal {
 position:absolute;
 right:37px;
 top:1px;
 cursor:pointer;
 z-index:1
}
.close_topup_modal:after,
.close_topup_modal:before {
 content:"";
 position:absolute;
 height:20px;
 width:2px;
 transform:rotate(45deg);
 left:17px;
 top:10px;
 background:#253858;
 border-radius:10px
}
.close_topup_modal:after {
 transform:rotate(-45deg)
}
ul.lisiting-topup {
 margin:0;
 padding:0
}
ul.lisiting-topup li {
 margin:0;
 padding:0 0 12px 30px;
 list-style:none;
 position:relative;
 line-height:1.64;
 letter-spacing:.2px;
 font-size:14px;
 color:#505f79
}
@media screen and (max-width:420px) {
 ul.lisiting-topup li {
  font-size:3.8vw
 }
}
ul.lisiting-topup li:after {
 width:12px;
 height:12px;
 background-color:#deebff;
 border-radius:30px;
 content:"";
 position:absolute;
 top:5px;
 left:0
}
ul.lisiting-topup li:before {
 width:1px;
 height:100%;
 background-color:#b3bac5;
 content:"";
 position:absolute;
 top:7px;
 left:5px
}
ul.lisiting-topup li:last-child:before {
 display:none
}
.topup_modal button {
 width:183px;
 height:48px;
 border:none;
 margin:25px 0 0;
 border-radius:4px;
 float:right;
 background:#ff5630;
 font-size:16px;
 color:#fff!important;
 font-weight:500;
 text-transform:uppercase;
 cursor:pointer
}
.special_filter_deductible {
 font-size:14px;
 padding:12px;
 display:flex;
 color:#253858
}
@media screen and (max-width:420px) {
 .special_filter_deductible {
  font-size:3.8vw
 }
}
.range_deductible {
 position:relative;
 margin:36px 16px 0
}
.range_deductible output {
 position:absolute;
 background:#fff;
 width:72px;
 height:34px;
 text-align:center;
 display:inline-block;
 font-size:14px;
 left:0;
 top:-30px;
 color:#253858;
 border:1px solid #dfe1e6;
 border-radius:4px
}
@media screen and (max-width:420px) {
 .range_deductible output {
  font-size:3.8vw
 }
}
.range_deductible output:after {
 top:100%;
 left:50%;
 margin-left:-5px;
 margin-top:-2px;
 content:"";
 border:solid #dfe1e6;
 border-width:0 1px 1px 0;
 display:inline-block;
 padding:3px;
 transform:rotate(45deg);
 vertical-align:middle;
 position:absolute;
 z-index:1;
 background:#fff
}
.range_deductible input[type=range] {
 margin:18px 0;
 width:100%
}
.deductible_select {
 margin:12px 16px 0;
 width:calc(100% - 32px)
}
.deductible_select select {
 background:none;
 margin-left:6px
}
@media only screen and (max-width:1023px) {
 .topup_modal button {
  width:100%
 }
 .topup_modal {
  max-width:100%;
  bottom:0;
  transform:inherit;
  left:0;
  border-radius:10px 10px 0 0;
  overflow:auto;
  top:auto;
  height:400px
 }
 .existing_modal {
  height:auto
 }
 .tabs-feature {
  margin-top:0!important
 }
 .feature_popup_button_topup {
  justify-content:flex-end
 }
 .existing_select {
  margin-top:18px;
  float:left
 }
}
.cart_header_new {
 background:#fff;
 margin:0 auto;
 width:100%;
 padding:0 12px;
 justify-content:space-between;
 min-height:55px;
 align-items:center;
 position:absolute;
 top:0;
 left:0;
 display:flex;
 box-shadow:0 3px 2px 0 rgba(0,0,0,.1);
 z-index:99
}
.cart_header_new .inner_header {
 background:url(https://static.pbcdn.in/health-cdn/images/insurer-logo/quotes-logos/cart.svg) no-repeat 0 0;
 padding-left:36px;
 font-size:18px;
 font-weight:600
}
.close_cart-new {
 text-indent:-999999px;
 position:relative;
 width:24px;
 height:24px
}
.close_cart-new:after,
.close_cart-new:before {
 content:"";
 width:2px;
 height:21px;
 display:block;
 position:absolute;
 left:50%;
 top:50%;
 background:#253858;
 border-radius:2px
}
.close_cart-new:before {
 transform:translate(-50%,-50%) rotate(45deg)
}
.close_cart-new:after {
 transform:translate(-50%,-50%) rotate(-45deg)
}
.cart_inner_details {
 padding:60px 0 0!important;
 height:calc(100% - 160px);
 overflow:auto;
 position:fixed;
 width:100%
}
.cart_inner_details.allProfiles {
 height:calc(100% - 80px)
}
.cart_inner_details::-webkit-scrollbar {
 display:none
}
.cart_inner_product {
 margin:0 0 12px;
 background:#fff;
 padding:16px 16px 10px;
 border-radius:0
}
.cart_inner_product:last-child {
 border-bottom:none
}
.cart_inner_product .logo_name_box_1 {
 display:flex;
 flex-direction:row;
 width:100%;
 margin:0 0 20px
}
.cart_inner_product .logo_name_box_1 .logo_pr_box_1 {
 min-width:80px;
 margin-right:10px;
 width:80px
}
.cart_inner_product .logo_name_box_1 .logo_pr_box_1 img {
 margin-top:4px
}
.cart_inner_product .logo_name_box_1 .plan_pr_box_1 {
 font-size:14px;
 font-weight:700;
 width:calc(100% - 124px)
}
@media screen and (max-width:420px) {
 .cart_inner_product .logo_name_box_1 .plan_pr_box_1 {
  font-size:3.8vw
 }
}
.cart_inner_product .logo_name_box_1 .amountCoverBox {
 display:block;
 font-size:14px;
 color:#505f79;
 font-weight:400
}
@media screen and (max-width:420px) {
 .cart_inner_product .logo_name_box_1 .amountCoverBox {
  font-size:3.8vw
 }
}
.cart_inner_product .delete_cart_new {
 background:url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAA0AAAAPCAYAAAA/I0V3AAAAAXNSR0IArs4c6QAAAV1JREFUKBXtkqtPA0EQxmd2ry2iDhBFkODRGDAITD11BFNoBQSBumsvqbheMRhCaFISSCApsn8ACaKCkOBIMKCaQhA8JIV7zDAH1wupwzNmvv3tfLuzD4RfYbqHeWY2FcJCghm7yGjXq8XukOFQbLpHk1nw2w2rtDRkUa7Vjsc+0t67T/7MbnWjFzGsOK0yI88DQgYYZwE4wwg5ZGCZBmS9TRhsCb+RkacILg1W0JRiC5j6irgShCFj2siLUUJ8QB1AvEDmOWHTpPFA2leO7FQgZVw5dvn+LWf0Mt7TvrS59zoOzbT/+Nyw1u8Upa7lbMtM4Ki6VbRlAIooG6098YInXmqqMKoDg7JSFjaq67aKJv8a/6b4xuKL4H5AehCzTqj5dlTjpx4ww0PEv9/ddFsroguo4JQYUrEhSTpkjzWuAnHbrZTayYf9MfKirJNOqmMh38sLtTrfMdfOIvQFTmaVdqM2nrMAAAAASUVORK5CYII=") no-repeat 4px 4px;
 width:18px;
 height:25px;
 text-indent:-999999px
}
.cart_inner_product .plan_for_name {
 color:#253858;
 font-size:12px;
 margin:0 0 12px;
 font-weight:400
}
@media screen and (max-width:420px) {
 .cart_inner_product .plan_for_name {
  font-size:3.2vw
 }
}
.cart_inner_product .plan_for_name span {
 font-size:16px;
 font-weight:700;
 display:block
}
@media screen and (max-width:420px) {
 .cart_inner_product .plan_for_name span {
  font-size:4.5vw
 }
}
.cart_inner_product .no_plan_msg {
 font-size:14px;
 color:#253858;
 margin:0 0 16px
}
@media screen and (max-width:420px) {
 .cart_inner_product .no_plan_msg {
  font-size:3.8vw
 }
}
.cart_inner_product .button_browse {
 width:100%;
 margin-bottom:10px;
 text-align:center
}
.cart_inner_product .feature_apply_button_grey {
 border:1px solid #253858!important;
 color:#253858!important;
 background:#fff!important
}
.cart_inner_product .riders_pr_new h2 {
 font-weight:700;
 font-size:14px;
 margin-bottom:15px
}
@media screen and (max-width:420px) {
 .cart_inner_product .riders_pr_new h2 {
  font-size:3.8vw
 }
}
.cart_inner_product .riders_box_new {
 display:flex;
 flex-direction:row;
 width:100%;
 justify-content:space-between;
 margin-bottom:12px;
 font-size:14px;
 color:#505f79
}
@media screen and (max-width:420px) {
 .cart_inner_product .riders_box_new {
  font-size:3.8vw
 }
}
.cart_inner_product .riders_box_new .blk {
 display:block
}
.cart_inner_product .riders_box_new .bold {
 font-weight:600;
 margin-left:20px;
 color:#253858;
 white-space:nowrap
}
.total_cart_amount {
 font-size:16px;
 color:#253858;
 font-weight:600;
 margin-top:-7px
}
@media screen and (max-width:420px) {
 .total_cart_amount {
  font-size:4.5vw
 }
}
.total_cart_amount span {
 color:#7a869a;
 font-size:12px
}
@media screen and (max-width:420px) {
 .total_cart_amount span {
  font-size:3.2vw
 }
}
.cart_popup_button {
 bottom:0;
 position:fixed;
 box-shadow:0 -3px 6px 0 rgba(0,0,0,.16);
 z-index:9;
 padding:12px;
 height:72px;
 justify-content:space-between;
 flex-direction:row;
 width:100%!important;
 margin-top:0!important
}
.cart_popup_button,
.skip_proposal_button {
 background:#fff;
 display:flex;
 align-items:center
}
.skip_proposal_button {
 width:calc(100% - 24px);
 border:1px solid #253858;
 color:#253858;
 font-size:14px;
 justify-content:center;
 height:48px;
 border-radius:4px;
 margin:0 auto 16px
}
@media screen and (max-width:420px) {
 .skip_proposal_button {
  font-size:3.8vw
 }
}
.cartNextBottom {
 position:fixed;
 bottom:70px;
 box-shadow:0 -1px 3px 0 rgba(0,0,0,.16)!important;
 margin:0!important;
 z-index:9;
 border-radius:0!important;
 border-top:1px solid #dfe1e6!important;
 left:0
}
.cartNextBottom .plan_for_name {
 margin:0
}
.multiprofileCart {
 z-index:101
}
.multiprofileCart,
.multiprofileCart:before {
 position:fixed;
 left:0;
 top:0;
 right:0;
 bottom:0
}
.multiprofileCart:before {
 content:"";
 background:rgba(23,43,77,.9);
 animation:articleMask .3s ease-in-out forwards
}
.multiprofileCart .web_cart {
 animation:articleSideBar .3s ease-in-out forwards
}
.web_cart .cart_inner_product {
 border-radius:0;
 box-shadow:none!important;
 padding:12px 12px 1px!important;
 margin:0 0 12px!important
}
.cart_inner_product.cartNextBottom {
 padding-bottom:12px!important;
 margin-bottom:0!important
}
@media screen and (min-width:1024px) {
 .web_cart {
  right:0;
  width:435px;
  background:#fff
 }
 .web_cart .feature_popup_bottom {
  box-shadow:none
 }
 .web_cart .close_cart-new {
  cursor:pointer
 }
 .web_cart .cart_inner_product {
  padding:12px 0!important
 }
 .cart_inner_details {
  padding:60px 16px 0!important
 }
 .cart_inner_product {
  border-bottom:1px solid #dfe1e6!important;
  padding:16px 0!important;
  box-shadow:none!important;
  border-radius:0!important
 }
 .delete_cart_new {
  cursor:pointer
 }
 .cart_inner_product.cartNextBottom {
  padding-left:16px!important
 }
 .skip_proposal_button {
  cursor:pointer;
  width:100%
 }
}
.mobile_filter_top {
 width:100%;
 padding:0;
 justify-content:space-between;
 background:#fff;
 font-weight:600;
 color:#253858;
 font-size:14px;
 margin-bottom:8px;
 box-shadow:0 1px 3px 0 rgba(114,148,188,.29)
}
@media screen and (max-width:420px) {
 .mobile_filter_top {
  font-size:3.8vw
 }
}
.mobile_filter_top .topFilterBox {
 display:flex;
 justify-content:space-between;
 width:100%;
 min-height:56px;
 align-items:center;
 padding:0 16px
}
.mobile_filter_top .clearAll {
 color:#ff5630
}
.mobile_filter_top .heading {
 font-size:18px;
 font-weight:700;
 margin:0;
 text-transform:none;
 display:flex;
 letter-spacing:normal;
 align-items:center
}
.mobile_filter_top .heading .arrowFilter {
 display:none
}
@media only screen and (max-width:1023px) {
 .mobile_filter_top .heading .arrowFilter {
  display:block
 }
}
.mobile_filter_top .arrowFilter {
 text-indent:-9999px;
 position:relative;
 width:18px;
 height:18px;
 margin-right:5px
}
.mobile_filter_top .arrowFilter:before {
 border:solid #253858;
 border-width:0 2px 2px 0;
 display:inline-block;
 padding:4px;
 transform:rotate(135deg);
 top:5px;
 margin-top:0;
 left:2px;
 content:"";
 position:absolute
}
.filterBoxMain {
 overflow:auto;
 height:calc(100% - 64px);
 position:relative
}
.filterInnerScroll {
 height:calc(100% - 112px)!important
}
.selectionBoxWrapper {
 margin:0
}
.selectionBoxWrapper .SelectionInner {
 position:relative
}
.selectionBoxWrapper .SelectionInner input+label {
 display:flex;
 flex-direction:row;
 width:100%;
 border:1px solid #dfe1e6;
 padding:0 0 0 46px;
 margin:0 0 12px;
 align-items:center;
 border-radius:8px;
 height:56px;
 font-weight:600;
 font-size:14px;
 color:#253858;
 cursor:pointer
}
@media screen and (max-width:420px) {
 .selectionBoxWrapper .SelectionInner input+label {
  font-size:3.8vw
 }
}
.selectionBoxWrapper .SelectionInner input:checked+label {
 border-color:#36b37e;
 color:#36b37e
}
.selectionBoxWrapper .SelectionInner .inputRadio {
 -webkit-appearance:none;
 outline:none;
 width:18px;
 height:18px;
 margin:0 5px 0 0;
 border-radius:30px;
 background-color:#fff;
 border:1px solid #5e6c84;
 vertical-align:middle;
 position:absolute;
 top:19px;
 left:16px
}
.selectionBoxWrapper .SelectionInner .inputRadio:checked {
 background-color:#36b37e;
 border:1px solid #36b37e
}
.selectionBoxWrapper .SelectionInner .inputRadio:checked:before {
 background:#fff;
 border:1px solid #fff;
 top:4px;
 left:4px;
 width:8px;
 height:8px;
 content:"";
 display:block;
 position:relative;
 border-radius:50%
}
.selectionBoxWrapper .SelectionInner .inputCheckbox {
 -webkit-appearance:none;
 outline:none;
 width:18px;
 height:18px;
 margin:0 5px 0 0;
 border-radius:4px;
 background-color:#fff;
 border:1px solid #5e6c84;
 vertical-align:middle;
 position:absolute;
 top:20px;
 left:16px
}
.selectionBoxWrapper .SelectionInner .inputCheckbox:checked {
 background-color:#36b37e;
 border:1px solid #36b37e
}
.selectionBoxWrapper .SelectionInner .inputCheckbox:checked:before {
 content:"";
 display:block;
 width:5px;
 height:9px;
 border:solid #fff;
 border-width:0 2px 2px 0;
 transform:rotate(45deg);
 position:absolute;
 left:5px;
 top:3px
}
@media only screen and (max-width:1023px) {
 .selectionBoxWrapper .SelectionInner:last-child input+label {
  margin-bottom:0
 }
}
.selectionBoxWrapper .infoTiptext {
 font-size:12px;
 color:#505f79;
 display:block;
 font-weight:400
}
@media screen and (max-width:420px) {
 .selectionBoxWrapper .infoTiptext {
  font-size:3.2vw
 }
}
.selectionBoxWrapper .infoTiptext.saveText {
 color:#00a3bf
}
.selectionBoxWrapper.heightB .SelectionInner input+label {
 height:66px
}
.selectionBoxWrapper.heightB .SelectionInner .inputRadio {
 top:50%;
 margin-top:-15px
}
.coverAmountWrapper .SelectionInner input+label {
 justify-content:space-between;
 padding-right:16px
}
.coverAmountWrapper .SelectionInner input+label .flexBox {
 display:flex;
 flex-direction:column;
 font-size:12px;
 color:#7a869a
}
@media screen and (max-width:420px) {
 .coverAmountWrapper .SelectionInner input+label .flexBox {
  font-size:3.2vw
 }
}
.coverAmountWrapper .SelectionInner input+label .flexBox .amountCover {
 font-size:14px;
 color:#253858;
 font-weight:600
}
@media screen and (max-width:420px) {
 .coverAmountWrapper .SelectionInner input+label .flexBox .amountCover {
  font-size:3.8vw
 }
}
.coverAmountWrapper .SelectionInner input+label .flexBox:nth-child(2) {
 text-align:right
}
.coverAmountWrapper .SelectionInner input:checked+label .amountCover {
 color:#36b37e
}
.FilterAccordionSection {
 position:relative;
 z-index:2;
 background:#fff;
 padding:23px 16px;
 margin-bottom:8px
}
.FilterAccordionSection .checkselection {
 position:absolute;
 opacity:0;
 z-index:-1
}
.FilterAccordionSection label.accordianTop {
 padding:0;
 width:100%;
 display:block;
 font-size:16px;
 color:#253858;
 position:relative;
 font-weight:600
}
@media screen and (max-width:420px) {
 .FilterAccordionSection label.accordianTop {
  font-size:4.5vw
 }
}
.FilterAccordionSection label.accordianTop:after {
 content:"";
 border:solid #172b4d;
 border-width:0 1.5px 1.5px 0;
 display:inline-block;
 padding:4px;
 transform:rotate(45deg);
 vertical-align:middle;
 position:absolute;
 right:3px;
 top:10px;
 transition:all .3s ease-in;
 margin-top:-7px;
 transform-origin:center center
}
.FilterAccordionSection .accordionContentFilter {
 max-height:0;
 transition:all .35s;
 opacity:0;
 display:none
}
.FilterAccordionSection .checkselection:checked+label:after {
 transform:rotate(-135deg);
 margin-top:-2px
}
.FilterAccordionSection .checkselection:checked~.accordionContentFilter {
 max-height:100%;
 opacity:1;
 display:block;
 padding-bottom:5px
}
.FilterAccordionSection .checkselection:checked~.accordionContentFilter.flexRow {
 display:flex
}
.FilterAccordionSection .descriptionFilter {
 font-size:14px;
 color:#505f79;
 margin:5px 0 16px;
 display:block
}
@media screen and (max-width:420px) {
 .FilterAccordionSection .descriptionFilter {
  font-size:3.8vw
 }
}
.bottomFilterModal {
 width:100%;
 height:auto;
 box-shadow:0 -3px 6px 0 rgba(0,0,0,.16);
 background-color:transparent;
 position:fixed;
 bottom:0;
 left:0;
 border-radius:5px 5px 0 0;
 padding:0;
 z-index:99;
 top:0
}
.bottomFilterModal .bottomFilterModalInner {
 width:100%;
 z-index:99;
 bottom:0;
 max-height:95vh;
 position:fixed;
 background-color:#fff;
 left:0;
 border-radius:24px 24px 0 0;
 padding:0 12px 24px
}
.bottomFilterModal .bottomFilterModalInner .headerBottom {
 width:100%;
 padding:12px 0 6px;
 display:flex;
 justify-content:space-between;
 align-items:center;
 color:#253858;
 font-size:16px;
 font-weight:700
}
@media screen and (max-width:420px) {
 .bottomFilterModal .bottomFilterModalInner .headerBottom {
  font-size:4.5vw
 }
}
.bottomFilterModal .bottomFilterModalInner .headerBottom .closeBottom {
 text-indent:-999999px;
 position:relative;
 width:25px
}
.bottomFilterModal .bottomFilterModalInner .headerBottom .closeBottom:after,
.bottomFilterModal .bottomFilterModalInner .headerBottom .closeBottom:before {
 content:"";
 width:2px;
 height:18px;
 display:block;
 position:absolute;
 left:50%;
 top:54%;
 background:#253858;
 border-radius:2px
}
.bottomFilterModal .bottomFilterModalInner .headerBottom .closeBottom:before {
 transform:translate(-50%,-50%) rotate(45deg)
}
.bottomFilterModal .bottomFilterModalInner .headerBottom .closeBottom:after {
 transform:translate(-50%,-50%) rotate(-45deg)
}
.bottomFilterModal .bottomFilterModalInner .textFilterBox {
 font-size:14px;
 color:#505f79
}
@media screen and (max-width:420px) {
 .bottomFilterModal .bottomFilterModalInner .textFilterBox {
  font-size:3.8vw
 }
}
.bottomFilterModal .bottomFilterModalInner .dataScrollBox {
 padding:0;
 overflow:auto;
 max-height:calc(95vh - 88px);
 scrollbar-width:none
}
.bottomFilterModal .bottomFilterModalInner .dataScrollBox::-webkit-scrollbar {
 display:none
}
.btnFilter {
 width:100%;
 text-align:center;
 color:#fff;
 margin:28px 0 0;
 background:#ff5630;
 height:48px;
 border-radius:8px;
 align-items:center;
 display:flex;
 justify-content:center;
 font-size:16px;
 font-weight:700
}
@media screen and (max-width:420px) {
 .btnFilter {
  font-size:4.5vw
 }
}
.btnFilter:focus,
.btnFilter:hover {
 background:#e04624;
 outline:none
}
.recommendTags {
 background:#5243aa;
 border-radius:4px;
 color:#fff;
 font-size:10px;
 padding:0 8px;
 height:14px;
 position:absolute;
 top:-6px;
 left:13px;
 display:flex;
 align-items:center;
 font-weight:600
}
.recommendTags.valueMoney {
 background:#36b37e
}
.mostPopularOptions {
 background:#edfdff;
 border-radius:0 0 8px 8px;
 height:34px;
 color:#00b8d9;
 font-size:12px;
 font-weight:600;
 text-align:center;
 margin:-12px 8px 12px;
 width:calc(100% - 16px);
 display:flex;
 align-items:center;
 justify-content:center
}
@media screen and (max-width:420px) {
 .mostPopularOptions {
  font-size:3.2vw
 }
}
@media only screen and (max-width:767px) {
 .mostPopularOptions {
  margin:0 8px;
  position:relative;
  top:-12px
 }
}
.mostPopularOptions .ideaIcon {
 background:url("data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjYiIGhlaWdodD0iMjgiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGcgc3Ryb2tlPSIjMDBCOEQ5IiBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxwYXRoIGQ9Ik01LjY0MiA2LjY0Mkw0LjA3NyA1LjA3N2wxLjU2NSAxLjU2NXpNMTcuMDYzIDIzLjY0OXYxLjQxM2ExLjk4OCAxLjk4OCAwIDAxLTEuOTc5IDEuOTc5aC0yLjgyNmEyLjA2MSAyLjA2MSAwIDAxLTEuOTc5LTIuMzA3di0xLjA4NWg2Ljc4NHpNMTguNjU2IDcuMzIyYTcuOTE2IDcuOTE2IDAgMTAtOS43NDUgMTIuNDcyYy42OS41MyAxLjE1IDEuMzA1IDEuMjg5IDIuMTY0di4wMTFhLjE5Mi4xOTIgMCAwMS4wNzktLjAxMWg2Ljc4NGEuMS4xIDAgMDEuMDU3LjAxMXYtLjAxMWEzLjc3MiAzLjc3MiAwIDAxMS40NDctMi4yNjEgNy45MTkgNy45MTkgMCAwMC4wOS0xMi4zN2wtLjAwMS0uMDA1eiIvPjxwYXRoIGQ9Ik0xMC4yIDIxLjk1M2guMDc5YS4xOTIuMTkyIDAgMDAtLjA3OS4wMTF2LS4wMTF6TTE3LjEyIDIxLjk1M3YuMDExYS4xLjEgMCAwMC0uMDU3LS4wMTFoLjA1N3pNMjIuNjQyIDIxLjY0MmwtMS41NjUtMS41NjUgMS41NjUgMS41NjV6TTEzLjg2MiAyLjk3TDEzLjgyNS43NTlsLjAzNyAyLjIxM3pNLjcyMSAxMi44NjJsMi4yMTMtLjAzNy0yLjIxMy4wMzd6TTIzLjcyMSAxMi44NjFsMi4yMTMtLjAzNy0yLjIxMy4wMzd6TTIwLjAzOCA1LjYzMmwxLjU5MS0xLjUzOWMuMzM3LS4zMjUtMS43NiAxLjctMS41OTEgMS41Mzl6TTQuMDM4IDIxLjYzMmwxLjU5MS0xLjUzOWMuMzM3LS4zMjUtMS43NiAxLjctMS41OTEgMS41Mzl6Ii8+PC9nPjwvc3ZnPg==") no-repeat 0 0;
 width:20px;
 height:20px;
 background-size:20px 20px;
 margin-right:10px
}
.logoFilter {
 width:80px;
 display:flex;
 align-items:center
}
.logoFilter img {
 max-width:60px;
 max-height:30px
}
.appliedFilter {
 width:6px;
 height:6px;
 border-radius:30px;
 background:#36b37e;
 display:inline-block;
 text-indent:-999999px
}
.quickFiltersBox {
 margin:0;
 overflow:auto;
 white-space:nowrap;
 padding:0 16px;
 -ms-overflow-style:none;
 scrollbar-width:none
}
.quickFiltersBox::-webkit-scrollbar {
 display:none
}
.quickFiltersBox .innerQuickFilters {
 height:36px;
 border-radius:20px;
 background-color:#fff;
 align-items:center;
 display:inline-flex;
 justify-content:center;
 font-size:14px;
 position:relative;
 margin-right:10px;
 padding:0 12px;
 width:auto;
 box-shadow:0 1px 4px 0 rgba(0,0,0,.16);
 vertical-align:middle
}
@media screen and (max-width:420px) {
 .quickFiltersBox .innerQuickFilters {
  font-size:3.8vw
 }
}
@media only screen and (max-width:1023px) {
 .quickFiltersBox .innerQuickFilters {
  box-shadow:none;
  border:1px solid #dfe1e6;
  margin-right:8px
 }
}
.quickFiltersBox .innerQuickFilters span {
 font-weight:600;
 padding-left:4px
}
.quickFiltersBox .innerQuickFilters:last-child {
 margin-right:0
}
.quickFiltersBox .innerQuickFilters.selected {
 border:1px solid #36b37e;
 color:#36b37e
}
.quickFiltersBox .innerQuickFilters.selected:before {
 content:"";
 transform:rotate(45deg);
 display:block;
 border:2px solid #36b37e;
 border-top:0;
 border-left:0;
 height:12px;
 width:6px;
 margin-right:8px;
 position:relative;
 top:-1px;
 margin-left:4px
}
@media only screen and (min-width:1024px) {
 .quickFiltersBox .innerQuickFilters.selected:before {
  height:14px;
  width:7px;
  margin-right:12px
 }
}
.quickFiltersBox .innerQuickFilters.selected:after {
 border-color:#36b37e
}
.quickFiltersBox .innerQuickFilters .popular {
 background:#5243aa
}
.quickFiltersBox .innerQuickFilters .popular,
.quickFiltersBox .innerQuickFilters .valueMoneyTag {
 border-radius:4px;
 color:#fff;
 font-size:10px;
 padding:0 8px;
 height:12px;
 position:absolute;
 top:-6px;
 left:8px;
 display:flex;
 align-items:center;
 font-weight:600
}
.quickFiltersBox .innerQuickFilters .valueMoneyTag {
 background:#36b37e
}
.quickFiltersBox .quickArrow {
 position:relative
}
.quickFiltersBox .quickArrow:after {
 content:"";
 border:solid #172b4d;
 border-width:0 1.5px 1.5px 0;
 display:inline-block;
 padding:2px;
 transform:rotate(45deg);
 vertical-align:middle;
 margin-left:8px;
 transition:all .3s ease-in;
 position:relative;
 top:-1px
}
.quickFiltersBox .quickArrow .medium {
 font-weight:600;
 margin-left:2px
}
.innerAppliedBox {
 overflow:hidden;
 overflow-x:auto;
 white-space:nowrap;
 height:48px;
 -ms-overflow-style:none;
 scrollbar-width:none
}
.innerAppliedBox::-webkit-scrollbar {
 display:none
}
.innerAppliedBox .innerApplied {
 height:36px;
 border-radius:4px;
 align-items:center;
 display:inline-flex;
 justify-content:center;
 font-size:14px;
 margin-right:10px;
 padding:0 12px;
 width:auto;
 background:#fafbfc;
 border:1px solid #dfe1e6;
 border-radius:40px;
 color:#505f79;
 font-weight:400
}
@media screen and (max-width:420px) {
 .innerAppliedBox .innerApplied {
  font-size:3.8vw
 }
}
.innerAppliedBox .innerApplied:last-child {
 margin:0
}
.innerAppliedBox .innerApplied .closeApplied {
 width:12px;
 height:12px;
 text-indent:-999999px;
 position:relative;
 margin-left:8px;
 cursor:pointer
}
.innerAppliedBox .innerApplied .closeApplied:after,
.innerAppliedBox .innerApplied .closeApplied:before {
 content:"";
 width:1px;
 height:12px;
 display:block;
 position:absolute;
 left:50%;
 top:50%;
 background:#505f79;
 border-radius:2px;
 transform:translate(-50%,-50%) rotate(45deg)
}
.innerAppliedBox .innerApplied .closeApplied:after {
 transform:translate(-50%,-50%) rotate(-45deg)
}
.sortPopupFilter {
 width:100%;
 overflow:hidden;
 border-radius:24px 24px 0 0;
 display:flex;
 position:fixed;
 background:#fff;
 z-index:101;
 top:unset;
 left:0;
 padding:16px;
 flex-direction:column;
 bottom:0;
 animation:sortFilterPopMob .3s ease-out
}
@keyframes sortFilterPopMob {
 0% {
  bottom:-100%
 }
 to {
  bottom:0
 }
}
.headerFilterWeb {
 width:100%;
 padding:0;
 display:flex;
 justify-content:space-between;
 align-items:center;
 color:#253858;
 font-size:16px;
 font-weight:700;
 margin-bottom:16px
}
@media screen and (max-width:420px) {
 .headerFilterWeb {
  font-size:4.5vw
 }
}
.headerFilterWeb .closeBottom {
 text-indent:-999999px;
 position:relative;
 width:25px;
 cursor:pointer
}
.headerFilterWeb .closeBottom:after,
.headerFilterWeb .closeBottom:before {
 content:"";
 width:2px;
 height:18px;
 display:block;
 position:absolute;
 left:50%;
 top:54%;
 background:#253858;
 border-radius:2px
}
.headerFilterWeb .closeBottom:before {
 transform:translate(-50%,-50%) rotate(45deg)
}
.headerFilterWeb .closeBottom:after {
 transform:translate(-50%,-50%) rotate(-45deg)
}
.dataScrollBox_web {
 padding:0;
 overflow:auto;
 max-height:calc(95vh - 300px)
}
@media screen and (max-width:1023px) {
 .dataScrollBox_web {
  padding-right:0;
  -ms-overflow-style:none;
  scrollbar-width:none
 }
 .dataScrollBox_web::-webkit-scrollbar {
  display:none
 }
}
.button_box_wrapper {
 display:flex;
 justify-content:space-between;
 align-items:center
}
.button_box_wrapper>div {
 width:48%;
 text-align:right
}
.button_box_wrapper .reset-text {
 font-size:16px;
 color:#ff5630;
 cursor:pointer;
 display:inline-flex;
 align-items:center;
 margin:14px 20px 0 0
}
@media screen and (max-width:420px) {
 .button_box_wrapper .reset-text {
  font-size:4.5vw
 }
}
@media only screen and (max-width:1023px) {
 .quickFiltersBoxMob {
  margin:0;
  overflow:auto;
  white-space:nowrap;
  padding:0;
  -ms-overflow-style:none;
  scrollbar-width:none;
  background:#f4f5f7;
  box-shadow:none;
  position:sticky;
  position:-webkit-sticky;
  top:0;
  z-index:9;
  border-top:none
 }
 .quickFiltersBoxMob::-webkit-scrollbar {
  display:none
 }
 .quickFiltersBox {
  padding:4px 0 12px 8px;
  margin:2px 0 0;
  position:relative
 }
 .apply_button {
  margin:20px 0 0
 }
 .selectionBoxWrapper.heightB .SelectionInner input+label {
  height:66px
 }
 .selectionBoxWrapper.heightB .SelectionInner .inputRadio {
  margin-top:-9px
 }
 .selectionBoxWrapper.heightB .infoTiptext {
  line-height:18px
 }
 .textFilterQMob {
  font-size:10px;
  white-space:nowrap;
  font-weight:700;
  text-transform:uppercase;
  padding:8px 0 0 12px;
  position:relative;
  z-index:10
 }
}
.quotesFilterWeb {
 justify-content:space-between;
 align-items:center
}
.filterWebMain {
 position:fixed;
 width:100%;
 height:100%;
 background:rgba(23,43,77,.9);
 z-index:99;
 animation:filterWebFade .3s ease-out
}
.filterWebMain .filterInnerWeb {
 width:90%;
 max-width:1080px;
 background:#fff;
 border-radius:8px;
 z-index:99;
 margin:4vh auto;
 max-height:92vh;
 overflow:hidden
}
@media only screen and (max-width:1023px) {
 .filterWebMain .filterInnerWeb {
  max-height:unset;
  margin:0;
  border-radius:0;
  width:100%;
  height:100%;
  animation:filterSlideUp .3s ease-out;
  background:#f4f5f7
 }
}
@keyframes filterSlideUp {
 0% {
  transform:translateY(100%)
 }
 to {
  transform:translateY(0)
 }
}
.filter_box_main {
 display:flex;
 flex-direction:row;
 justify-content:left;
 margin:12px 0
}
@media only screen and (max-width:1023px) {
 .filter_box_main {
  overflow:auto;
  height:calc(100% - 64px);
  position:relative;
  display:block;
  margin:0
 }
}
.filter_box_main .category_area {
 display:flex;
 flex-direction:column;
 margin-right:10px;
 color:#253858;
 font-size:14px;
 overflow:auto;
 height:calc(92vh - 128px);
 min-width:360px
}
@media only screen and (max-width:1023px) {
 .filter_box_main .category_area {
  display:none
 }
}
.filter_box_main .category_area::-webkit-scrollbar {
 width:6px
}
.filter_box_main .category_area::-webkit-scrollbar-track {
 background:transparent
}
.filter_box_main .category_area::-webkit-scrollbar-thumb {
 visibility:hidden;
 background:#dfe1e6;
 border-radius:20px;
 transition:all .3s ease-in
}
.filter_box_main .category_area::-webkit-scrollbar-thumb:hover {
 background:#b3bac5
}
.filter_box_main .category_area:hover::-webkit-scrollbar-thumb {
 visibility:visible
}
.filter_box_main .category_area .lisitngWebFilter {
 padding:21px 16px;
 width:100%;
 background:#f4f5f7;
 margin-bottom:8px;
 font-size:16px;
 font-weight:600;
 color:#172b4d;
 position:relative;
 cursor:pointer
}
@media screen and (max-width:420px) {
 .filter_box_main .category_area .lisitngWebFilter {
  font-size:4.5vw
 }
}
.filter_box_main .category_area .active {
 background:#fff;
 cursor:inherit;
 color:#36b37e;
 font-weight:700
}
.filter_box_main .category_area .active:before {
 content:"";
 position:absolute;
 background:#36b37e;
 width:4px;
 height:100%;
 top:0;
 left:0;
 border-radius:2px
}
.filter_box_main .filter-details-box {
 padding-right:16px;
 padding-left:24px;
 display:flex;
 flex-flow:column wrap;
 justify-content:space-between;
 width:calc(100% - 370px);
 margin-top:8px
}
@media only screen and (max-width:1023px) {
 .filter_box_main .filter-details-box {
  width:100%;
  margin-top:0;
  padding:0;
  height:calc(100vh - 64px);
  flex-direction:row
 }
}
.filter_box_main .filter-details-box .leftContentFilter {
 height:calc(92vh - 200px);
 overflow-y:auto;
 scrollbar-width:none
}
.filter_box_main .filter-details-box .leftContentFilter::-webkit-scrollbar {
 display:none
}
@media only screen and (max-width:1023px) {
 .filter_box_main .filter-details-box .leftContentFilter {
  height:unset;
  width:100%;
  padding:18px 16px;
  margin-bottom:8px;
  background:#fff
 }
}
.filter_box_main .filter-details-box .bottomFilterApply {
 height:60px
}
@media only screen and (max-width:1023px) {
 .filter_box_main .filter-details-box .bottomFilterApply {
  bottom:0;
  position:sticky;
  position:-webkit-sticky;
  height:74px;
  font-size:16px;
  width:100%;
  font-weight:700;
  z-index:999;
  padding:22px 16px 0;
  background:transparent linear-gradient(180deg,hsla(0,0%,100%,0),#fff 20%,#fff) 0 0 no-repeat padding-box
 }
}
@media only screen and (max-width:1023px) and (max-width:420px) {
 .filter_box_main .filter-details-box .bottomFilterApply {
  font-size:4.5vw
 }
}
.filter_box_main .filter-details-box .bottomFilterApply .buttonContainer {
 display:flex;
 flex-flow:row wrap;
 justify-content:flex-end;
 align-items:center
}
@media only screen and (max-width:1023px) {
 .filter_box_main .filter-details-box .bottomFilterApply .buttonContainer>div {
  width:100%
 }
}
.filter_box_main .filter-details-box .bottomFilterApply .buttonContainer .clearAll {
 color:#de350b;
 font-size:14px;
 font-weight:600;
 cursor:pointer
}
@media screen and (max-width:420px) {
 .filter_box_main .filter-details-box .bottomFilterApply .buttonContainer .clearAll {
  font-size:3.8vw
 }
}
@media only screen and (max-width:1023px) {
 .filter_box_main .filter-details-box .bottomFilterApply .buttonContainer .clearAll {
  display:none
 }
}
.filter_box_main .filter-details-box .bottomFilterApply .buttonContainer button {
 text-align:center;
 color:#fff;
 margin:0 0 0 80px;
 background:#ff5630;
 border-radius:4px;
 align-items:center;
 display:flex;
 justify-content:center;
 outline:none;
 border:none;
 font-size:16px;
 font-weight:700;
 padding:15px 44px;
 cursor:pointer
}
@media screen and (max-width:420px) {
 .filter_box_main .filter-details-box .bottomFilterApply .buttonContainer button {
  font-size:4.5vw
 }
}
.filter_box_main .filter-details-box .bottomFilterApply .buttonContainer button:focus,
.filter_box_main .filter-details-box .bottomFilterApply .buttonContainer button:hover {
 background:#ff5630;
 outline:none
}
@media only screen and (max-width:1023px) {
 .filter_box_main .filter-details-box .bottomFilterApply .buttonContainer button {
  margin-left:0;
  width:100%;
  text-align:center;
  color:#fff;
  background:#ff5630;
  height:44px;
  border-radius:8px;
  align-items:center;
  display:flex;
  justify-content:center
 }
}
.selectionBoxWrapper {
 display:flex;
 flex-flow:row wrap;
 justify-content:space-between
}
.selectionBoxWrapper .SelectionInner {
 width:calc(50% - 10px)
}
@media only screen and (max-width:1023px) {
 .selectionBoxWrapper .SelectionInner {
  width:100%
 }
}
.selectionBoxWrapper .plan1cr {
 margin-top:8px;
 width:100%
}
.headingFilterLeft {
 font-size:18px;
 font-weight:700;
 margin-bottom:4px
}
@media only screen and (max-width:1023px) {
 .headingFilterLeft {
  font-size:16px;
  font-weight:600;
  position:relative
 }
}
@media only screen and (max-width:1023px) and (max-width:420px) {
 .headingFilterLeft {
  font-size:4.5vw
 }
}
@media only screen and (max-width:1023px) {
 .headingFilterLeft:after {
  content:"";
  border:solid #172b4d;
  border-width:0 1.5px 1.5px 0;
  display:inline-block;
  padding:4px;
  transform:rotate(45deg);
  vertical-align:middle;
  position:absolute;
  right:3px;
  top:10px;
  transition:all .3s ease-in;
  margin-top:-5px;
  transform-origin:center center
 }
 .headingFilterLeft+.descriptionFilter,
 .headingFilterLeft~.selectionBoxWrapper {
  display:none
 }
 .headingFilterLeft.active+.descriptionFilter,
 .headingFilterLeft.active~.selectionBoxWrapper {
  display:block
 }
 .headingFilterLeft.active:after {
  transform:rotate(-135deg);
  margin-top:-2px
 }
}
.descriptionFilter {
 font-size:14px;
 color:#505f79;
 display:block;
 margin-bottom:20px
}
@media screen and (max-width:420px) {
 .descriptionFilter {
  font-size:3.8vw
 }
}
.closeWebFilter {
 width:24px;
 height:24px;
 position:relative;
 cursor:pointer;
 text-indent:-99999px
}
.closeWebFilter:after,
.closeWebFilter:before {
 content:"";
 width:2px;
 height:100%;
 display:block;
 background:#253858;
 border-radius:2px;
 position:absolute;
 left:50%;
 top:0
}
.closeWebFilter:before {
 transform:translateX(-50%) rotate(45deg)
}
.closeWebFilter:after {
 transform:translateX(-50%) rotate(-45deg)
}
.recommendTags {
 top:-7px
}
.selectionQuick {
 flex-flow:column wrap
}
.selectionQuick .SelectionInner {
 width:100%
}
.nextScroll {
 width:64px;
 height:42px;
 text-indent:-99999px;
 cursor:pointer;
 position:absolute;
 right:150px;
 top:12px;
 background:#fff;
 background:linear-gradient(90deg,hsla(0,0%,100%,0),#fff 50%,#fff)
}
.nextScroll:before {
 content:"";
 width:24px;
 height:24px;
 border:1px solid #dfe1e6;
 border-radius:50%;
 background:#fff;
 box-shadow:0 3px 6px rgba(0,0,0,.16);
 position:absolute;
 right:5px;
 top:50%;
 margin-top:-12px
}
.nextScroll:after {
 content:"";
 border:solid #253858;
 border-width:0 2px 2px 0;
 display:block;
 padding:3px;
 transform:rotate(-45deg);
 font-size:0;
 position:absolute;
 right:14px;
 top:50%;
 margin-top:-4px
}
.nextScroll.innerScroll {
 width:64px!important;
 right:0;
 top:56px;
 height:36px!important;
 background:#fff;
 background:linear-gradient(90deg,hsla(0,0%,100%,0),#fff 30%,#fff)
}
.nextScroll.innerScroll:before {
 right:14px
}
.nextScroll.innerScroll:after {
 right:23px;
 top:50%;
 margin-top:-4px
}
.previousScroll {
 width:64px!important;
 height:42px!important;
 text-indent:-99999px;
 cursor:pointer;
 position:absolute;
 left:102px;
 top:12px;
 background:#fff;
 background:linear-gradient(270deg,hsla(0,0%,100%,0),#fff 80%,#fff)
}
.previousScroll:before {
 content:"";
 width:24px;
 height:24px;
 border:1px solid #dfe1e6;
 border-radius:50%;
 background:#fff;
 box-shadow:0 3px 6px rgba(0,0,0,.16);
 position:absolute;
 left:0;
 top:50%;
 margin-top:-12px
}
.previousScroll:after {
 content:"";
 border:solid #253858;
 border-width:0 2px 2px 0;
 display:block;
 padding:3px;
 transform:rotate(138deg);
 font-size:0;
 position:absolute;
 left:9px;
 top:50%;
 margin-top:-4px
}
.previousScroll.innerScroll {
 width:64px!important;
 left:0;
 top:56px;
 height:36px!important;
 background:#fff;
 background:linear-gradient(270deg,hsla(0,0%,100%,0),#fff 30%,#fff)
}
.previousScroll.innerScroll:before {
 left:14px
}
.previousScroll.innerScroll:after {
 left:23px;
 top:50%;
 margin-top:-4px
}
.cart-circle-web {
 top:-6px!important;
 right:0!important
}
.apply_button_filter {
 margin:16px 0 0
}
.quickInner {
 flex:1 1 100%;
 overflow:hidden
}
.quickInner,
.textFilterQ {
 display:flex;
 align-items:center
}
.textFilterQ {
 font-size:14px;
 white-space:nowrap;
 font-weight:600;
 position:absolute;
 left:0;
 top:0;
 z-index:2;
 height:100%;
 background:#fff;
 background:linear-gradient(-90deg,hsla(0,0%,100%,0),#fff 15%,#fff);
 padding-right:24px
}
.innerAppliedBox {
 margin:0;
 padding:0 16px
}
@media only screen and (min-width:1024px) {
 .textFilterQMob {
  display:none
 }
 .mobile_filter_top {
  border-radius:8px 8px 0 0;
  margin-bottom:0;
  position:relative
 }
 .quickFiltersBoxMob {
  margin-bottom:16px;
  position:sticky;
  position:-webkit-sticky;
  top:57px;
  z-index:9
 }
 .pos-rel {
  position:relative
 }
 .quickFiltersBox {
  padding:0;
  overflow:auto;
  margin:0 0 12px 120px;
  width:calc(100% - 275px)
 }
 .quickFiltersBox .innerQuickFilters {
  height:42px;
  font-size:14px;
  margin-right:12px;
  padding:0 16px;
  box-shadow:none;
  margin-top:12px;
  border:1px solid #b3bac5;
  cursor:pointer
 }
}
@media only screen and (min-width:1024px) and (max-width:420px) {
 .quickFiltersBox .innerQuickFilters {
  font-size:3.8vw
 }
}
@media only screen and (min-width:1024px) {
 .quickFiltersBox .innerQuickFilters span {
  font-weight:600
 }
 .quickFiltersBox .innerQuickText {
  border:none;
  font-weight:600;
  padding:0 24px 0 0
 }
 .quickFiltersBox .quickArrow:after {
  margin-left:12px;
  margin-right:0
 }
 .quotes_toolbar_wrapper.quotesFilterWeb {
  position:relative
 }
 .quickFiltersBox.allfilterBoxCol {
  position:absolute;
  right:15px;
  top:0;
  overflow:visible;
  display:block;
  flex:none;
  margin-left:0;
  padding-left:12px;
  padding-right:0;
  width:unset;
  background:#fff;
  background:linear-gradient(90deg,hsla(0,0%,100%,0),#fff 10%,#fff)
 }
 .allFilter {
  background:url("data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyNCIgaGVpZ2h0PSIyMy41MDEiPjxnIGRhdGEtbmFtZT0iR3JvdXAgOCI+PGcgZGF0YS1uYW1lPSJHcm91cCA3Ij48ZyBkYXRhLW5hbWU9Ikdyb3VwIDQiPjxnIGRhdGEtbmFtZT0iR3JvdXAgMyI+PHBhdGggZGF0YS1uYW1lPSJQYXRoIDc0MzUiIGQ9Ik0xLjAxNyAxaDB6IiBmaWxsPSJub25lIiBzdHJva2U9IiM3YTg2OWEiIHN0cm9rZS13aWR0aD0iMiIvPjwvZz48L2c+PGcgZGF0YS1uYW1lPSJHcm91cCA2Ij48ZyBkYXRhLW5hbWU9Ikdyb3VwIDUiPjxwYXRoIGRhdGEtbmFtZT0iUGF0aCA3NDM2IiBkPSJNMjIuNjc2IDQuMzA1bC04LjIzMyAxMS43djQuM2EuMzM2LjMzNiAwIDAxLS4yMzEuMzQ2bC00LjA3OCAxLjgwOGEuMjMxLjIzMSAwIDAxLS4xNTQuMDM4Yy0uMDc3IDAtLjE1NCAwLS4xOTItLjA3N2EuMzkyLjM5MiAwIDAxLS4xOTItLjMwOHYtNi4xMDdsLTguMjMzLTExLjd6IiBmaWxsPSJub25lIiBzdHJva2U9IiM3YTg2OWEiIHN0cm9rZS1saW5lY2FwPSJyb3VuZCIgc3Ryb2tlLWxpbmVqb2luPSJyb3VuZCIgc3Ryb2tlLXdpZHRoPSIyIi8+PC9nPjwvZz48L2c+PC9nPjwvc3ZnPg==") no-repeat 0 0;
  width:16px;
  height:16px;
  background-size:16px 16px;
  margin-right:10px
 }
 .sortPopupFilter {
  width:360px;
  overflow:hidden;
  border-radius:8px;
  display:flex;
  position:absolute;
  background:#fff;
  z-index:101;
  padding:16px;
  flex-direction:column;
  bottom:inherit;
  animation:sortFilterPopWeb .3s ease-in
 }
 @keyframes sortFilterPopWeb {
  0% {
   opacity:0
  }
  to {
   opacity:1
  }
 }
 .allfilterBoxWrapper {
  position:absolute;
  right:0;
  top:12px;
  background:#fff;
  padding-left:8px
 }
 .allfilterBox {
  width:142px;
  height:42px;
  font-size:14px;
  padding:0 16px;
  box-shadow:none;
  border:1px solid #b3bac5;
  cursor:pointer;
  border-radius:20px;
  background-color:#fff;
  align-items:center;
  display:inline-flex;
  justify-content:center
 }
}
@media only screen and (min-width:1024px) and (max-width:420px) {
 .allfilterBox {
  font-size:3.8vw
 }
}
@media only screen and (min-width:1024px) {
 .allfilterBox .cart-circle {
  width:20px;
  height:20px;
  display:flex;
  align-items:center;
  justify-content:center
 }
}
.search-pill-button-count {
 align-items:center;
 background-color:#36b37e;
 border-radius:100%;
 color:#fff;
 display:inline-flex;
 font-size:12px;
 height:20px;
 justify-content:center;
 margin:1px 0 0 5px;
 min-width:20px;
 padding-left:0!important
}
@media screen and (max-width:420px) {
 .search-pill-button-count {
  font-size:3.2vw
 }
}
.filterSkeleton {
 margin-bottom:0
}
.filterSkeleton span {
 margin-right:12px
}
.resetFilterLink {
 font-size:14px;
 color:#ff5630;
 font-weight:600;
 margin-left:auto;
 white-space:nowrap
}
@media screen and (max-width:420px) {
 .resetFilterLink {
  font-size:3.8vw
 }
}
.mr-16 {
 margin-right:16px
}
.allFilterMobFixed {
 position:sticky!important;
 position:-webkit-sticky!important;
 right:0;
 display:inline-flex;
 background:#f4f5f7;
 border-radius:20px 0 0 20px!important;
 box-shadow:0 1px 4px 0 rgba(0,0,0,.16)!important;
 border-color:#d1d4db!important
}
.allFilterMobFixed .cart-circle {
 top:-5px!important;
 right:2px!important
}
@media only screen and (min-width:1024px) {
 .allFilterMobFixed {
  display:none!important
 }
}
.crWrapper {
 left:0;
 background:transparent;
 top:0;
 bottom:0;
 z-index:99
}
.crWrapper,
.crWrapper #overlay {
 width:100%;
 height:100%;
 position:fixed
}
.crWrapper #overlay {
 background:rgba(23,43,77,.9);
 animation:maskOpacity .3s ease-out forwards
}
@keyframes maskOpacity {
 0% {
  opacity:0
 }
 to {
  opacity:1
 }
}
.crInnerWrapper {
 width:450px;
 right:0;
 height:100%;
 animation:slideinMonthly .3s ease-out forwards;
 position:fixed;
 background-color:#fff;
 flex-flow:column nowrap
}
.crInnerWrapper,
.headerCR {
 z-index:99;
 display:flex;
 justify-content:space-between
}
.headerCR {
 width:100%;
 align-items:flex-start;
 padding:16px 16px 0;
 color:#253858;
 font-size:16px;
 font-weight:700
}
@media screen and (max-width:420px) {
 .headerCR {
  font-size:4.5vw
 }
}
.headerCR .closeCR {
 width:32px;
 height:32px;
 text-indent:-999999px;
 position:relative;
 margin-right:-8px;
 cursor:pointer
}
.headerCR .closeCR:after {
 transform:translate(-50%,-50%) rotate(-45deg)
}
.headerCR .closeCR:after,
.headerCR .closeCR:before {
 content:"";
 width:2px;
 height:18px;
 display:block;
 position:absolute;
 left:50%;
 top:54%;
 background:#253858;
 border-radius:2px
}
.headerCR .closeCR:before {
 transform:translate(-50%,-50%) rotate(45deg)
}
.footerCR {
 background:transparent linear-gradient(179deg,hsla(0,0%,100%,0),hsla(0,0%,100%,.4235294117647059) 15%,#fff) 0 0 no-repeat;
 width:100%;
 padding:16px
}
.footerCR button {
 display:inline-block;
 width:100%;
 height:48px;
 background:#ff5630;
 color:#fff;
 font-size:14px;
 font-weight:700;
 border-radius:4px;
 text-align:center;
 line-height:48px;
 padding:0;
 outline:none;
 border:none;
 cursor:pointer
}
@media screen and (max-width:420px) {
 .footerCR button {
  font-size:3.8vw
 }
}
.cr_wrapper {
 padding:0 0 16px;
 letter-spacing:.016em;
 font-weight:400;
 overflow:auto;
 height:calc(100% - 150px)
}
.cr_wrapper::-webkit-scrollbar {
 width:6px
}
.cr_wrapper::-webkit-scrollbar-track {
 background:#f1f1f1
}
.cr_wrapper::-webkit-scrollbar-thumb {
 background:#b3bac5
}
@keyframes slideinMonthly {
 0% {
  transform:translateX(100%)
 }
 to {
  transform:translateX(0)
 }
}
.CrAccordionSection {
 position:relative;
 z-index:2;
 background:#fff;
 padding:0 16px 16px;
 margin-top:16px;
 border-bottom:1px solid #dfe1e6
}
.CrAccordionSection .checkselection {
 position:absolute;
 opacity:0;
 z-index:-1
}
.CrAccordionSection label.accordianTop {
 padding:0;
 width:100%;
 display:block;
 font-size:14px;
 color:#253858;
 position:relative;
 font-weight:600;
 cursor:pointer;
 transition:font-weight .3s ease-in
}
@media screen and (max-width:420px) {
 .CrAccordionSection label.accordianTop {
  font-size:3.8vw
 }
}
.CrAccordionSection label.accordianTop .blkSpan {
 display:block;
 margin-right:28px
}
.CrAccordionSection label.accordianTop:after {
 content:"";
 border:solid #172b4d;
 border-width:0 1.5px 1.5px 0;
 display:inline-block;
 padding:4px;
 transform:rotate(45deg);
 vertical-align:middle;
 position:absolute;
 right:3px;
 top:2px;
 transition:all .3s ease-in;
 transform-origin:center center
}
.CrAccordionSection .accordionContentCR {
 max-height:0;
 transition:all .35s;
 opacity:0;
 display:none
}
.CrAccordionSection .accordionContentCR p {
 font-size:14px;
 padding:10px 0 0
}
@media screen and (max-width:420px) {
 .CrAccordionSection .accordionContentCR p {
  font-size:3.8vw
 }
}
.CrAccordionSection .checkselection:checked+label {
 font-weight:700
}
.CrAccordionSection .checkselection:checked+label:after {
 transform:rotate(-135deg);
 top:10px
}
.CrAccordionSection .checkselection:checked~.accordionContentCR {
 max-height:100%;
 opacity:1;
 display:block
}
ul.lisitingFaqCr {
 margin:15px 0 0;
 padding:0
}
ul.lisitingFaqCr li {
 margin:0;
 padding:0 0 12px 30px;
 list-style:none;
 position:relative;
 font-size:14px;
 line-height:21px;
 letter-spacing:.2px
}
@media screen and (max-width:420px) {
 ul.lisitingFaqCr li {
  font-size:3.8vw
 }
}
ul.lisitingFaqCr li:last-child {
 padding-bottom:0
}
ul.lisitingFaqCr li:after {
 width:12px;
 height:12px;
 background-color:#deebff;
 border-radius:30px;
 content:"";
 position:absolute;
 top:5px;
 left:0
}
ul.lisitingFaqCr li:before {
 width:1px;
 height:100%;
 background-color:#b3bac5;
 content:"";
 position:absolute;
 top:7px;
 left:5px
}
ul.lisitingFaqCr li:last-child:before {
 display:none
}
.gridLisiting {
 border-top:1px solid #dfe1e6;
 margin:16px -16px 0
}
.SectionGrid {
 display:flex;
 justify-content:space-between
}
.SectionGrid .boxGrid {
 display:flex;
 flex-direction:column;
 text-align:left;
 padding:16px;
 font-size:14px;
 font-weight:400;
 color:#505f79;
 line-height:1.5;
 flex:1 1 33%;
 border-bottom:1px solid #dfe1e6
}
@media screen and (max-width:420px) {
 .SectionGrid .boxGrid {
  font-size:3.8vw
 }
}
.SectionGrid .boxGrid .font12 {
 font-size:12px;
 font-weight:400
}
@media screen and (max-width:420px) {
 .SectionGrid .boxGrid .font12 {
  font-size:3.2vw
 }
}
.SectionGrid .boxGrid .heading1 {
 font-weight:700;
 font-size:16px
}
@media screen and (max-width:420px) {
 .SectionGrid .boxGrid .heading1 {
  font-size:4.5vw
 }
}
.SectionGrid .boxGrid:first-child {
 font-weight:700
}
.SectionGrid .boxGrid:nth-child(2) {
 border-left:1px solid #dfe1e6;
 border-right:1px solid #dfe1e6
}
.InfoTextBox {
 border-radius:8px;
 width:100%;
 background:#f2fdff;
 border:1px solid #00a3bf;
 color:#00c7e6;
 display:flex;
 align-items:center;
 font-size:12px;
 justify-content:center;
 padding:10px;
 margin-top:16px
}
@media screen and (max-width:420px) {
 .InfoTextBox {
  font-size:3.2vw
 }
}
.InfoTextBox .ideaBulb {
 background:url(https://static.pbcdn.in/health-cdn/images/insurer-logo/quotes-logos/mode_icon_pr.svg) no-repeat 0 0;
 padding-left:40px;
 height:30px;
 display:flex;
 align-items:center
}
.linkMore {
 color:#ff5630;
 font-size:14px
}
.linkMore:after {
 content:"";
 border:solid #ff5630;
 border-width:0 1.5px 1.5px 0;
 display:inline-block;
 padding:2px;
 transform:rotate(-45deg);
 margin-left:3px;
 vertical-align:middle
}
.certificateBlock {
 display:grid
}
ul.certificateWrapper {
 font-size:0;
 overflow-x:auto;
 white-space:nowrap;
 margin:16px 0 0;
 padding-left:8px
}
ul.certificateWrapper::-webkit-scrollbar {
 display:none
}
ul.certificateWrapper li {
 width:auto;
 border-radius:8px;
 padding:6px;
 display:inline-block;
 box-shadow:0 0 4px 0 rgba(0,0,0,.16);
 margin-right:16px;
 margin-top:6px;
 margin-bottom:6px
}
ul.certificateWrapper .blockCerti img {
 object-fit:contain;
 height:118px
}
@media only screen and (max-width:1023px) {
 .crBannerWidget {
  background:#fff;
  margin-top:12px
 }
 .innerBannerCr {
  background:#ebf3ff url(https://static.pbcdn.in/health-cdn/images/insurer-logo/quotes-logos/1crWidgetImg.svg) no-repeat 100% 0;
  border-radius:10px;
  margin:16px;
  display:flex;
  background-size:contain
 }
 .innerBannerCr .text1cr {
  padding:12px 0 10px 12px;
  width:200px
 }
 .innerBannerCr .text1cr h3 {
  font-size:16px;
  font-weight:700
 }
 .crWrapper {
  height:auto;
  box-shadow:0 -3px 6px 0 rgba(0,0,0,.16);
  background-color:#fff;
  position:fixed;
  left:0;
  border-radius:5px 5px 0 0;
  padding:12px
 }
 .crInnerWrapper,
 .crWrapper {
  width:100%;
  bottom:0;
  z-index:99
 }
 .crInnerWrapper {
  animation:slideinMonthlyMob .3s ease-out forwards;
  height:96%;
  border-radius:24px 24px 0 0
 }
 .headerCR {
  box-shadow:none
 }
 .cr_wrapper::-webkit-scrollbar {
  display:none
 }
}
@keyframes slideinMonthlyMob {
 0% {
  transform:translateY(100%)
 }
 to {
  transform:translateY(0)
 }
}
@media screen and (min-width:1024px) {
 .crBannerWidget {
  position:fixed;
  left:0;
  top:300px;
  z-index:999
 }
 .crBannerWidget .innerBannerCr {
  background:#fff;
  border-radius:0 10px 10px 0;
  padding:16px 12px;
  font-size:12px;
  font-weight:700;
  width:120px;
  box-shadow:0 1px 2px 0 rgba(112,128,250,.2)
 }
 .crBannerWidget .innerBannerCr h3 {
  font-weight:700
 }
 .crBannerWidget .innerBannerCr .linkMore {
  font-size:12px;
  margin:5px 0 0;
  display:block;
  cursor:pointer
 }
 .crBannerWidget .innerBannerCr .webCr {
  text-align:center;
  margin:5px 0 12px
 }
 .closeButton {
  position:absolute;
  right:8px;
  width:12px;
  height:12px;
  top:8px;
  cursor:pointer;
  transition:all .3s ease-in;
  font-size:0
 }
 .closeButton:after,
 .closeButton:before {
  content:"";
  width:1.5px;
  height:12px;
  top:50%;
  margin-top:-6px;
  position:absolute;
  background:#253858;
  left:50%;
  margin-left:-1px;
  transform:rotate(45deg)
 }
 .closeButton:after {
  transform:rotate(-45deg)
 }
}
.whyOneCrBannerWrapper {
 height:108px;
 background:#fff;
 border-radius:10px;
 display:flex;
 align-items:center;
 margin-right:10px;
 margin-bottom:16px;
 box-shadow:0 2px 4px rgba(0,0,0,.2)
}
.whyOneCrBannerWrapper .bannerImg {
 width:205px;
 height:108px;
 background:url(https://static.pbcdn.in/health-cdn/images/insurer-logo/quotes-logos/covid_info_banner_img@2x.png) no-repeat 0 -177px;
 background-size:cover
}
.whyOneCrBannerWrapper .bannerTxt_cta {
 width:calc(100% - 205px);
 display:flex;
 align-items:center;
 justify-content:space-between;
 padding:0 16px 0 10px
}
.whyOneCrBannerWrapper .bannerTxt_cta .bannerTxt {
 font-size:18px;
 font-weight:600;
 color:#253858;
 max-width:330px
}
.whyOneCrBannerWrapper .bannerTxt_cta .bannerTxt span {
 font-size:12px;
 color:#6b778c;
 display:block
}
@media screen and (max-width:420px) {
 .whyOneCrBannerWrapper .bannerTxt_cta .bannerTxt span {
  font-size:3.2vw
 }
}
.whyOneCrBannerWrapper .bannerTxt_cta .bannerCta {
 font-size:16px;
 font-weight:700;
 color:#ff5630;
 background:#fff;
 border-radius:4px;
 border:1px solid #ff5630;
 height:48px;
 display:inline-flex;
 align-items:center;
 width:166px;
 justify-content:center;
 white-space:nowrap;
 padding:0 8px
}
@media screen and (max-width:420px) {
 .whyOneCrBannerWrapper .bannerTxt_cta .bannerCta {
  font-size:4.5vw
 }
}
@media (max-width:1023px) {
 .whyOneCrBannerWrapper {
  margin-top:16px;
  flex-wrap:wrap;
  margin-right:0;
  margin-bottom:0;
  height:153px;
  position:relative
 }
 .whyOneCrBannerWrapper .bannerImg {
  width:169px;
  height:153px;
  background:url(https://static.pbcdn.in/health-cdn/images/insurer-logo/quotes-logos/covid_info_banner_img@2x.png) no-repeat -36px 0;
  background-size:205px 285px;
  position:absolute;
  right:0;
  top:0;
  z-index:1
 }
 .whyOneCrBannerWrapper .bannerTxt_cta {
  width:100%;
  padding:0 145px 0 12px;
  order:1;
  flex-direction:column;
  justify-content:flex-start;
  align-items:flex-start;
  position:relative;
  z-index:2
 }
 .whyOneCrBannerWrapper .bannerTxt_cta .bannerTxt {
  font-size:14px;
  max-width:unset
 }
}
@media screen and (max-width:1023px) and (max-width:420px) {
 .whyOneCrBannerWrapper .bannerTxt_cta .bannerTxt {
  font-size:3.8vw
 }
}
@media (max-width:1023px) {
 .whyOneCrBannerWrapper .bannerTxt_cta .bannerCta {
  font-size:14px;
  height:36px;
  width:140px;
  padding:0 10px;
  margin-top:8px
 }
}
@media screen and (max-width:1023px) and (max-width:420px) {
 .whyOneCrBannerWrapper .bannerTxt_cta .bannerCta {
  font-size:3.8vw
 }
}
@media (max-width:1023px) {
 .main_quotes_mobile_div.p0 .whyOneCrBannerWrapper {
  margin-left:16px;
  margin-right:16px
 }
}
.quotes_main_container {
 display:flex;
 flex-direction:column;
 background:#f4f5f7;
 height:100%
}
.quotes_main_container.sticky {
 position:fixed;
 overflow:hidden;
 height:4000px;
 width:100%
}
#overlay {
 position:fixed;
 top:0;
 left:0;
 bottom:0;
 right:0;
 height:100%;
 width:100%;
 margin:0;
 padding:0;
 background:rgba(23,43,77,.9);
 z-index:99;
 animation:overlayFade .3s ease-in
}
@keyframes overlayFade {
 0% {
  opacity:0
 }
 to {
  opacity:1
 }
}
.popup_quotes_features {
 z-index:101;
 vertical-align:middle;
 padding:20px;
 background:#fff;
 display:inline-block
}
.bottom_mobile_bar {
 display:flex;
 flex-direction:row;
 align-items:center
}
.filter_mobile_chat_icon {
 bottom:38px
}
.filter_mobile_chat_icon,
.filter_mobile_chat_icon-no-shake {
 position:fixed;
 right:13px;
 z-index:2;
 background:url(https://static.pbcdn.in/health-cdn/images/insurer-logo/quotes-logos/bottom_chat.svg) 50% no-repeat #36b37e;
 box-shadow:0 3px 6px rgba(0,0,0,.3);
 border-radius:50%;
 width:48px;
 height:48px;
 text-align:center;
 font-size:0;
 color:#36b37e
}
.filter_mobile_chat_icon-no-shake {
 bottom:69px
}
.filter_mobile_chat_icon-no-shake_compare {
 position:fixed;
 bottom:38px;
 right:13px;
 z-index:2;
 background:url(https://static.pbcdn.in/health-cdn/images/insurer-logo/quotes-logos/bottom_chat.svg) 50% no-repeat #36b37e;
 box-shadow:0 3px 6px rgba(0,0,0,.3);
 border-radius:50%;
 width:48px;
 height:48px;
 text-align:center;
 font-size:0;
 color:#36b37e
}
.filter_mobile_quote_icon {
 display:flex;
 position:relative
}
.mobile_bottom_bar {
 flex-direction:row;
 box-shadow:0 -3px 6px 0 rgba(0,0,0,.16);
 background:#fff;
 height:60px;
 z-index:40
}
.mobile_bottom_bar,
.mobile_bottom_bar_compare {
 display:flex;
 width:100%;
 bottom:0;
 position:fixed
}
.mobile_bottom_bar_compare {
 z-index:9
}
.chat_count1 {
 background:red;
 border-radius:50%;
 width:20px;
 height:20px;
 color:#fff;
 font-size:11px;
 position:absolute;
 right:-5px;
 top:-5px;
 line-height:21px
}
.info-complete-edit-quote {
 width:100%;
 height:50px;
 background:url("data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTkiIGhlaWdodD0iMTkiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PHBhdGggZD0iTS43MzYgMTQuNEwwIDE5bDQuNTkyLS43MzguNDU2LS40OTFMMTkgMy44MjggMTUuMTQ0IDAgMS4yMjcgMTMuOTQzbC0uNDkuNDU2em0xLjAzNS42NjlsMi4xNiAyLjE5Ni0yLjYyLjQyNS40Ni0yLjYyMXpNMTcuNjkgMy43NThsLTEuNDYgMS40ODMtMi40NzEtMi40ODQgMS40OTctMS40NDcgMi40MzQgMi40NDh6bS00LjMyNi0uNDgybDIuMzYgMi4zNkw0Ljk0NSAxNi4zNzlsLTIuMzI0LTIuMzZMMTMuMzY0IDMuMjc2eiIgZmlsbD0iIzM2QzJBOSIgZmlsbC1ydWxlPSJub256ZXJvIi8+PC9zdmc+") 370px 15px no-repeat;
 text-indent:-9999px;
 position:relative;
 left:0;
 top:-98%
}
.city-box-label {
 position:relative;
 width:400px;
 font-size:.875rem;
 height:48px;
 border-radius:4px;
 box-shadow:none
}
.city-box-label input {
 border:1px solid #d3d3d3;
 border-radius:5px;
 box-shadow:none;
 font-size:14px!important;
 padding:10px;
 height:45px;
 color:#4f4f4f;
 font-weight:500
}
.city-box-quote ul li.active,
.city-box-quote ul li:hover {
 background:#ebf7f5;
 color:#36b37e;
 background:#ebf7f5 url("data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTMiIGhlaWdodD0iMjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGcgZmlsbD0iIzM2QzJBOSIgZmlsbC1ydWxlPSJub256ZXJvIj48cGF0aCBkPSJNNi41IDBDMi45MTYgMCAwIDIuNjIgMCA1LjkyNGMwIC43MzIuMTcgMS41MzEuNDc1IDIuMjVILjQ3bC4wMjkuMDU0LjA3My4xNDdMNi41IDIwbDUuOS0xMS41NjcuMDI4LS4wNTRjLjAyNS0uMDQ5LjA1NC0uMDk4LjA3OC0uMTUxbC4wMi0uMDVBNS41NzggNS41NzggMCAwMDEzIDUuOTM0QzEzIDIuNjIxIDEwLjA4NCAwIDYuNSAwem01LjI4NCA3LjkybC0uMDEuMDIyYy0uMDE0LjAyNy0uMDI4LjA1OC0uMDQzLjA4NWwtLjA0OC4wOTRMNi41IDE4LjI3MiAxLjMxMyA4LjEyMWwtLjA0NC0uMDlhNS4xMzUgNS4xMzUgMCAwMS0uNDgtMi4xMDdjMC0yLjkwMiAyLjU2My01LjIgNS43MTYtNS4yczUuNzE1IDIuMjk0IDUuNzE1IDUuMmE1IDUgMCAwMS0uNDM2IDEuOTk2eiIvPjxwYXRoIGQ9Ik02LjUgM0M0LjU3IDMgMyA0LjU3IDMgNi41UzQuNTcgMTAgNi41IDEwIDEwIDguNDMgMTAgNi41IDguNDMgMyA2LjUgM3ptMCA2LjA2NWEyLjU2NSAyLjU2NSAwIDExMC01LjEzIDIuNTY1IDIuNTY1IDAgMDEwIDUuMTN6Ii8+PC9nPjwvc3ZnPg==") no-repeat 10px 14px
}
.city-number-box-quote {
 height:350px
}
.city-box-quote ul li {
 margin:0;
 padding:0 0 0 35px;
 list-style-type:none;
 font-size:14px;
 color:#504d4d;
 cursor:pointer;
 font-weight:600;
 border-bottom:1px solid #dcdcdc;
 height:50px;
 line-height:50px;
 background:url("data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTMiIGhlaWdodD0iMjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGcgZmlsbD0iIzRGNEY0RiIgZmlsbC1ydWxlPSJub256ZXJvIj48cGF0aCBkPSJNNi41IDBDMi45MTYgMCAwIDIuNjIgMCA1LjkyNGMwIC43MzIuMTcgMS41MzEuNDc1IDIuMjVILjQ3bC4wMjkuMDU0LjA3My4xNDdMNi41IDIwbDUuOS0xMS41NjcuMDI4LS4wNTRjLjAyNS0uMDQ5LjA1NC0uMDk4LjA3OC0uMTUxbC4wMi0uMDVBNS41NzggNS41NzggMCAwMDEzIDUuOTM0QzEzIDIuNjIxIDEwLjA4NCAwIDYuNSAwem01LjI4NCA3LjkybC0uMDEuMDIyYy0uMDE0LjAyNy0uMDI4LjA1OC0uMDQzLjA4NWwtLjA0OC4wOTRMNi41IDE4LjI3MiAxLjMxMyA4LjEyMWwtLjA0NC0uMDlhNS4xMzUgNS4xMzUgMCAwMS0uNDgtMi4xMDdjMC0yLjkwMiAyLjU2My01LjIgNS43MTYtNS4yczUuNzE1IDIuMjk0IDUuNzE1IDUuMmE1IDUgMCAwMS0uNDM2IDEuOTk2eiIvPjxwYXRoIGQ9Ik02LjUgM0M0LjU3IDMgMyA0LjU3IDMgNi41UzQuNTcgMTAgNi41IDEwIDEwIDguNDMgMTAgNi41IDguNDMgMyA2LjUgM3ptMCA2LjA2NWEyLjU2NSAyLjU2NSAwIDExMC01LjEzIDIuNTY1IDIuNTY1IDAgMDEwIDUuMTN6Ii8+PC9nPjwvc3ZnPg==") no-repeat 10px 14px
}
.city-box-quote {
 position:absolute;
 z-index:1;
 background:#fff;
 top:110px;
 width:350px;
 overflow-y:scroll;
 border:0 solid #cdc7c7;
 border-radius:4px;
 left:16.5%;
 box-shadow:0 0 10px 0 rgba(0,0,0,.25)
}
.mobile_bottom_chat {
 width:100%;
 height:100%;
 display:flex;
 flex-direction:column;
 justify-content:center;
 align-items:center
}
.mobile_bottom_chat img {
 height:24px;
 width:auto;
 display:block
}
.mobile_compare {
 color:#fff;
 font-size:.875rem;
 font-weight:400;
 border-radius:17px;
 box-shadow:0 1px 4px 0 rgba(0,0,0,.5);
 background:url(https://static.pbcdn.in/health-cdn/images/insurer-logo/quotes-logos/sprite.svg) 13px -242px no-repeat rgba(93,93,93,.87);
 text-shadow:none;
 width:120px;
 height:34px;
 position:fixed;
 bottom:34px;
 z-index:2;
 padding:0 0 0 47px;
 line-height:34px
}
.inner-border::-webkit-scrollbar {
 display:none
}
.span_edit_profile_city {
 margin-top:-3px
}
.header_quote {
 display:flex;
 flex-direction:column;
 width:100%
}
.header_plans_count {
 color:#7a869a;
 font-size:14px;
 font-weight:500
}
@media screen and (max-width:420px) {
 .header_plans_count {
  font-size:3.8vw
 }
}
.header_plans_profile {
 color:#253858;
 font-size:16px;
 line-height:1.2
}
@media screen and (max-width:420px) {
 .header_plans_profile {
  font-size:4.5vw
 }
}
.header_plans_profile.quotes_header {
 display:-webkit-box;
 overflow:hidden;
 -webkit-line-clamp:1;
 -webkit-box-orient:vertical
}
.tabs-plans {
 padding:0!important;
 width:100%;
 min-height:58px
}
.tabs-plans,
.tabs-plans ul {
 border:none!important
}
.tabs-plans li {
 font-size:1rem;
 color:#2a2a2a;
 padding:0 16px;
 position:relative
}
.tabs-plans li a {
 border:none!important
}
.tabs-plans li.is-active a {
 color:#36b37e!important
}
.tabs-plans li.is-active.red a {
 color:#ff5630!important
}
.plans_tab.is-active:after {
 height:2px;
 background:#36b37e;
 bottom:-18px
}
.plans_tab.is-active.red:after {
 width:50px;
 height:2px;
 background:#ff5630;
 content:"";
 position:absolute;
 bottom:-8px;
 left:35%
}
.header_group_heading {
 font-size:10px;
 color:#253858;
 font-weight:500
}
.header_group_heading.selected {
 color:#253858;
 font-weight:700
}
.header_group_content {
 font-size:16px;
 color:#253858;
 font-weight:500
}
.header_group_content.selected {
 color:#253858;
 font-weight:700
}
.bottom_bar_span {
 font-size:14px;
 color:#7a869a;
 font-weight:500
}
@media screen and (max-width:420px) {
 .bottom_bar_span {
  font-size:3.8vw
 }
}
.plans_tab.is-active:after {
 border-bottom:3px solid #253858;
 content:"";
 position:absolute;
 left:0;
 bottom:-12px;
 width:100%;
 background:none
}
.mobile_bottom_toast {
 bottom:78px;
 position:fixed;
 display:flex;
 z-index:10000;
 flex-direction:column;
 align-items:center;
 width:100%;
 justify-content:center;
 animation:progressSavedToastMob .3s ease-out forwards
}
@keyframes progressSavedToastMob {
 0% {
  transform:translateY(20px);
  opacity:0
 }
 to {
  transform:translateY(0);
  opacity:1
 }
}
@media screen and (min-width:1024px) {
 .mobile_bottom_toast {
  bottom:24px;
  align-items:flex-start;
  padding-left:24px;
  animation:progressSavedToastDesktop .3s ease-out forwards
 }
 @keyframes progressSavedToastDesktop {
  0% {
   transform:translateY(-20px);
   opacity:0
  }
  to {
   transform:translateY(0);
   opacity:1
  }
 }
}
.span_mobile_toast {
 border-radius:96px;
 font-size:14px;
 font-weight:500;
 color:#fff;
 padding:12px 17px;
 box-shadow:0 2px 4px 0 rgba(0,0,0,.16);
 background-color:rgba(23,43,77,.8)
}
@media screen and (min-width:1024px) {
 .span_mobile_toast {
  padding:12px 48px
 }
}
.navbar_blue {
 background-color:#36b37e
}
.nav_no_padding {
 padding-right:0!important
}
.header_groups_toast {
 font-size:12px;
 color:#fff;
 font-weight:500;
 padding-right:130px;
 padding-left:16px
}
@media screen and (max-width:420px) {
 .header_groups_toast {
  font-size:3.2vw
 }
}
.tabs-plans_shortlist {
 border:none!important;
 padding:0!important;
 min-height:38px;
 width:100%;
 height:19px;
 font-family:SFProText;
 font-size:16px;
 font-weight:500;
 font-style:normal;
 font-stretch:normal;
 line-height:1.19;
 letter-spacing:.32px;
 text-align:left;
 color:#36b37e;
 margin-left:128px
}
.profile_group_shortlist {
 margin-right:70px
}
.renewalHeadBar {
 background:#e6fcff;
 height:48px;
 align-items:center;
 display:flex;
 justify-content:center;
 font-size:14px;
 line-height:21px;
 font-weight:600;
 position:relative
}
@media screen and (max-width:420px) {
 .renewalHeadBar {
  font-size:3.8vw
 }
}
.renewalHeadBar button {
 background:#fff;
 border:1px solid #ff5630;
 border-radius:4px;
 width:110px;
 height:32px;
 text-transform:uppercase;
 color:#ff5630!important;
 margin-left:16px
}
.renewalHeadBar button:hover {
 color:#ff5630!important;
 cursor:pointer
}
.renewalHeadBar .closeRenewal {
 position:absolute;
 width:20px;
 height:20px;
 right:10px;
 text-indent:-9999px;
 top:13px;
 cursor:pointer
}
.renewalHeadBar .closeRenewal:after,
.renewalHeadBar .closeRenewal:before {
 content:"";
 width:2px;
 height:16px;
 display:block;
 position:absolute;
 left:50%;
 top:54%;
 background:#253858;
 border-radius:2px
}
.renewalHeadBar .closeRenewal:after {
 transform:translate(-50%,-50%) rotate(-45deg)
}
.renewalHeadBar .closeRenewal:before {
 transform:translate(-50%,-50%) rotate(45deg)
}
@media screen and (min-width:1024px) {
 .main_quotes_div,
 .navbar,
 .navbar_shortlist {
  padding-left:15px;
  padding-right:15px
 }
 .shortlist_compare {
  padding-left:15px!important;
  padding-right:15px!important
 }
 .quotes_filterBar,
 .quotes_toolbar_wrapper,
 .rowWrapper {
  padding-left:15px;
  padding-right:15px
 }
 .iframe_container iframe {
  height:0;
  width:0;
  min-height:100%;
  max-height:100%;
  min-width:100%;
  max-width:100%
 }
}
.call_schedule_new {
 width:auto;
 border-radius:10px;
 box-shadow:0 2px 4px 0 rgba(0,0,0,.16)
}
.toast_header {
 display:block;
 height:65px;
 min-height:auto!important;
 overflow:hidden
}
.toast_header>span {
 float:left;
 width:80%;
 padding-right:0;
 padding-left:0;
 padding-top:8px
}
.toast_header.toast_hide {
 animation:toast_hide .3s ease-in 0s forwards
}
.toast_header_desktop {
 display:block;
 height:50px;
 margin:0 10px 15px 0;
 padding:0 16px;
 border-radius:10px;
 min-height:auto!important;
 overflow:hidden
}
.toast_header_desktop>span {
 float:left;
 width:80%;
 padding-right:0;
 padding-left:0;
 padding-top:8px
}
.toast_header_desktop.toast_hide {
 animation:toast_hide .3s ease-in 0s forwards;
 margin:0
}
@keyframes toast_hide {
 0% {
  height:50px
 }
 to {
  height:0
 }
}
.countdown {
 width:20px;
 height:20px;
 position:relative;
 background:#36b37e;
 transform:rotate(180deg);
 float:right;
 margin-top:22px
}
.toast_header_desktop .countdown {
 margin-top:11px
}
.pie {
 width:50%;
 height:100%;
 transform-origin:100% 50%;
 position:absolute;
 background:#9ce1d4;
 border:1px solid #fff
}
.spinner {
 border-radius:100% 0 0 100%/50% 0 0 50%;
 z-index:200;
 border-right:none;
 animation:rota 5s linear forwards
}
.countdown:hover .countdown_mask,
.countdown:hover .filler,
.countdown:hover .spinner {
 animation-play-state:running
}
.spinner:after {
 position:absolute;
 width:10px;
 height:10px;
 background:#fff;
 border:1px solid rgba(0,0,0,.5);
 box-shadow:inset 0 0 3px rgba(0,0,0,.2);
 border-radius:50%;
 top:10px;
 right:10px;
 content:"";
 display:none
}
.filler {
 border-radius:0 100% 100% 0/0 50% 50% 0;
 left:50%;
 opacity:0;
 z-index:100;
 animation:fill 5s steps(1) reverse;
 border-left:none
}
.countdown_mask {
 width:50%;
 height:100%;
 position:absolute;
 background:inherit;
 opacity:1;
 z-index:300;
 animation:countdown_mask 5s steps(1) reverse
}
.whatsapp_share {
 bottom:74px;
 position:fixed;
 right:16px;
 width:132px;
 height:56px;
 border-radius:56px;
 background:#25d366;
 box-shadow:0 8px 10px rgba(0,0,0,.15);
 display:flex;
 align-items:center;
 transition:all .3s ease-in-out;
 overflow:hidden
}
.whatsapp_share img {
 position:absolute;
 left:16px
}
.whatsapp_share p {
 font-size:14px;
 font-weight:700;
 text-shadow:1px 1px 1px rgba(0,0,0,.16);
 color:#fff;
 line-height:16px;
 margin-left:12px;
 transition:all .3s ease-in-out;
 padding-left:35px
}
.whatsapp_share p span {
 font-size:10px;
 display:block
}
.whatsapp_share.small {
 width:56px
}
.whatsapp_share.small p {
 opacity:0;
 visibility:hidden
}
@keyframes rota {
 0% {
  transform:rotate(0deg)
 }
 to {
  transform:rotate(1turn)
 }
}
@keyframes countdown_mask {
 0% {
  opacity:1
 }
 50%,
 to {
  opacity:0
 }
}
@keyframes fill {
 0% {
  opacity:0
 }
 50%,
 to {
  opacity:1
 }
}
.loader_btn:before {
 content:"";
 position:absolute;
 right:10px;
 top:10px;
 border-right:3px solid hsla(0,0%,95.3%,.3);
 border-top:3px solid hsla(0,0%,95.3%,.3);
 border-radius:50%;
 border-color:#fff #fff hsla(0,0%,95.3%,.3) hsla(0,0%,95.3%,.3);
 border-style:solid;
 border-width:3px;
 width:28px;
 height:28px;
 -webkit-animation:spin 1.2s linear infinite;
 animation:spin 1.2s linear infinite
}
.loader_btn.center-loader:before {
 left:45%
}
.loader_btn.blockBtn {
 position:absolute;
 left:0;
 top:0;
 right:0;
 bottom:0;
 border-radius:8px
}
@media screen and (max-width:1023px) {
 .loader_btn:before {
  top:4px
 }
 .renewalHeadBar {
  padding:0 12px 0 42px;
  height:58px
 }
 .renewalHeadBar .closeRenewal {
  left:10px;
  right:inherit;
  top:18px
 }
 .renewalHeadBar button {
  font-size:12px
 }
}
@media screen and (max-width:1023px) and (max-width:420px) {
 .renewalHeadBar button {
  font-size:3.2vw
 }
}
.inboundCallWrapper_parent:before {
 content:"";
 position:fixed;
 width:100%;
 height:100%;
 left:0;
 top:0;
 background:rgba(0,0,0,.9);
 animation:inboundMask .5s ease-in forwards
}
.inboundCallWrapper {
 padding:18px 16px 14px;
 background:#fff;
 border-radius:10px 10px 0 0;
 box-shadow:0 -4px 10px rgba(0,0,0,.16);
 position:absolute;
 width:100%;
 height:185px;
 bottom:-185px;
 left:0;
 z-index:99;
 animation:showInboundCall .5s ease-in-out forwards;
 transition:all 1s ease-in
}
.inboundCallWrapper .msg {
 font-size:16px;
 font-weight:700;
 color:#253858;
 line-height:24px;
 margin-bottom:8px
}
@media screen and (max-width:420px) {
 .inboundCallWrapper .msg {
  font-size:4.5vw
 }
}
.inboundCallWrapper .call_number {
 font-size:20px;
 font-weight:700;
 color:#253858;
 margin-bottom:18px
}
.inboundCallWrapper .actions {
 display:flex;
 justify-content:space-between
}
.inboundCallWrapper .actions .btn {
 background:#ff5630;
 color:#fff;
 font-size:14px;
 font-weight:500;
 height:48px;
 outline:none;
 -webkit-appearance:none;
 border:none;
 box-shadow:none;
 border-radius:4px;
 width:calc(100% - 148px)!important
}
@media screen and (max-width:420px) {
 .inboundCallWrapper .actions .btn {
  font-size:3.8vw
 }
}
.inboundCallWrapper .actions .btn.outlined {
 background:transparent;
 border:1px solid #253858;
 color:#253858!important;
 width:140px!important
}
.closeInboundPop.inboundCallWrapper_parent:before {
 animation:inboundMaskHide .5s ease-in forwards
}
.closeInboundPop .inboundCallWrapper {
 animation:circle 1s forwards;
 bottom:0!important;
 transform-origin:right bottom
}
.call_greenDot,
.call_greenDot>span {
 position:relative
}
.call_greenDot>span:after {
 content:"";
 width:6px;
 height:6px;
 border-radius:50%;
 background:#36b37e;
 position:absolute;
 left:-10px;
 top:7px
}
@keyframes inboundMask {
 0% {
  opacity:0
 }
 to {
  opacity:1
 }
}
@keyframes inboundMaskHide {
 0% {
  opacity:1
 }
 to {
  opacity:0
 }
}
@keyframes circle {
 0% {
  clip-path:circle(75%);
  opacity:1
 }
 to {
  clip-path:circle(0 at 90% 85%);
  opacity:0
 }
}
@keyframes showInboundCall {
 0% {
  bottom:-185px
 }
 to {
  bottom:0
 }
}
.callAnim {
 animation:phonering-anim 8s ease-in-out infinite
}
@keyframes phonering-anim {
 0% {
  -webkit-transform:rotate(0)
 }
 18% {
  -webkit-transform:rotate(0)
 }
 20% {
  -webkit-transform:rotate(-25deg)
 }
 21% {
  -webkit-transform:rotate(25deg)
 }
 22% {
  -webkit-transform:rotate(-25deg)
 }
 23% {
  -webkit-transform:rotate(25deg)
 }
 24% {
  -webkit-transform:rotate(0)
 }
 30% {
  -webkit-transform:rotate(0)
 }
 50% {
  -webkit-transform:rotate(0)
 }
 to {
  -webkit-transform:rotate(0)
 }
}
.scheduledCallModule {
 background:#fff;
 margin:0 0 12px;
 padding:12px 16px 16px;
 border-radius:8px;
 box-shadow:0 0 4px rgba(0,0,0,.16)
}
@media screen and (max-width:1023px) {
 .scheduledCallModule {
  box-shadow:none;
  border-radius:0;
  width:109.7%;
  margin:12px 0 0 -16px
 }
}
.scheduledCallModule>p {
 font-size:16px;
 font-weight:400;
 margin-bottom:7px
}
@media screen and (max-width:420px) {
 .scheduledCallModule>p {
  font-size:4.5vw
 }
}
.scheduledCallModule>p span {
 font-weight:600
}
.scheduledCallModule .callNowWrapper {
 display:flex;
 justify-content:space-between;
 align-items:center
}
.scheduledCallModule .callNowWrapper .leftBlock {
 width:176px
}
.scheduledCallModule .callNowWrapper .leftBlock>p {
 font-size:14px;
 font-weight:600;
 color:#505f79;
 margin-bottom:8px
}
@media screen and (max-width:420px) {
 .scheduledCallModule .callNowWrapper .leftBlock>p {
  font-size:3.8vw
 }
}
.scheduledCallModule .callNowWrapper .leftBlock .schCallCta {
 -webkit-appearance:none;
 border-radius:4px;
 border:1px solid #ff5630;
 height:36px;
 background:transparent;
 color:#ff5630!important;
 font-size:14px;
 font-weight:600;
 display:flex;
 align-items:center;
 justify-content:center;
 cursor:pointer
}
@media screen and (max-width:420px) {
 .scheduledCallModule .callNowWrapper .leftBlock .schCallCta {
  font-size:3.8vw
 }
}
.scheduledCallModule .callNowWrapper .thankMsg {
 width:calc(100% - 115px);
 font-size:16px;
 padding:10px 0;
 font-weight:600
}
@media screen and (max-width:420px) {
 .scheduledCallModule .callNowWrapper .thankMsg {
  font-size:4.5vw
 }
}
.scheduledCallModule .callNowWrapper .icon {
 width:109px;
 height:64px;
 margin-right:6px;
 background:url("data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxMDguMTM2IiBoZWlnaHQ9IjYzLjg3NyI+PGRlZnM+PGNsaXBQYXRoIGlkPSJhIj48cGF0aCBkPSJNMzEyLjQ2MSAyMzUuNDQ1Yy0zLjc1Ni05LjE3Ni04LjAzMS0xMC44OTQtOC4wMzEtMTAuODk0cy4xMzMtLjE3OS4zNDktLjVhOS4zOCA5LjM4IDAgMDE0LjIgMy43MjEuMTE1LjExNSAwIDAwLjItLjExNSA5LjYzMyA5LjYzMyAwIDAwLTQuMjY0LTMuOGMuMDkyLS4xNC4xOTQtLjMuMy0uNDc1YTE1LjgzOSAxNS44MzkgMCAwMTMuODE3IDEuMzY5Yy4xMzIuMDY1LjI0OS0uMTMzLjExNi0uMmExNi4yNDQgMTYuMjQ0IDAgMDAtMy44MDYtMS4zNzdjMi4zMjUtMy44MjIgNy4zMjItMTQuMzUxLTcuMzA5LTE1LjU1NmE4LjQgOC40IDAgMDEzLjQzNC0yLjA2N2MuMTM4LS4wNDkuMDc5LS4yNzEtLjA2MS0uMjIxYTguNzY0IDguNzY0IDAgMDAtMy40NDEgMi4wMjcgMTEuOCAxMS44IDAgMDEuNi0xLjg4N2MuMDU1LS4xMzctLjE2Ny0uMi0uMjIxLS4wNjFhMTEuNTM3IDExLjUzNyAwIDAwLS42MzkgMi4wNjhjLS4yMjgtLjIxNS0uNzUtLjY4OS0xLjUtMS4yODNhMTEuODg5IDExLjg4OSAwIDAwLTEuMzM2LTEuNjQ1IDExLjM2NiAxMS4zNjYgMCAwMC05LjQ4OS0zLjA5My4xMTcuMTE3IDAgMDAtLjEuMDg1IDkuMzI4IDkuMzI4IDAgMDAtNi4yMjUgMi4yNWMtMi40NDkgMi4wNDctMi44IDUuMTg0LTIuMTc0IDguMi4wMzcuNDc5LjEyNC45NDMuMTc0IDEuMjUyYTE3LjQ5MiAxNy40OTIgMCAwMDIuNTU3IDYuMzI1Yy0xLjUuMjUzLTQuMiAxLjE1NS0zLjYzMyA0LjM2Ny43NjkgNC40IDQuMzg3IDkuOTQuMSAxMC41MTdzLTYuMzUyIDEwLjM5NSA4LjgyOCAxOS41NjIgMjkuNjE2LjQ4NyAyMy42MjctNi43NzRjMCAwIDcuNjg0LTIuNjIgMy45MjctMTEuNzk1em0tMzUuMDE4LTIxLjQzNWExNi4zMzEgMTYuMzMxIDAgMDAzLjExIDUuNDYxIDYuMzMxIDYuMzMxIDAgMDAtLjY5My4wNiAxOC40NDUgMTguNDQ1IDAgMDEtMi40MTctNS41MjJ6bTE3LjM1Ny05LjIxYTEyIDEyIDAgMDEuNzY3Ljg5NWMtMi4xMTQtMS41ODYtNS40NzQtMy42NTEtOS4wNjQtNC4wNzhhMTAuOCAxMC44IDAgMDE4LjI5NyAzLjE4M3oiIHRyYW5zZm9ybT0idHJhbnNsYXRlKC0yNzIuOTYxIC0yMDEuMzg2KSIgZmlsbD0iIzQzNzVmMSIvPjwvY2xpcFBhdGg+PGNsaXBQYXRoIGlkPSJiIj48cGF0aCBkPSJNMjcxLjI1IDI2Ni43MzNsLTEuMzc3LTIuNDQ3cy0zLjk5NC4zOTUtNS40NDUgMi4wODgtMTAuNjU3IDE4LjUzNi0xMC42NTcgMTguNTM2LTMuOTg3IDEuODkzLTcuMjY5IDMuNTA3YTUuNDMyIDUuNDMyIDAgMDEyLjI5MyAzLjI2MiA0NS4wMDcgNDUuMDA3IDAgMDA4LjAxLTMuNnM4Ljg4OC02LjggOS44NTUtMTEuNCA0LjU5LTkuOTQ2IDQuNTktOS45NDZ6IiB0cmFuc2Zvcm09InRyYW5zbGF0ZSgtMjQ2LjUwMyAtMjY0LjI4NSkiIGZpbGw9IiNlMmIxODciLz48L2NsaXBQYXRoPjxjbGlwUGF0aCBpZD0iYyI+PHBhdGggZD0iTTMwMC41MTIgMjQzLjQ4N3MuNzI2IDIuNjYtMi40MTkgNS44MDVsLTEuNjkzIDMuMTQ0IDMuNjI4IDQuMTEyIDMuNjI4IDEuMjA5IDcuNzQtOC45NS0zLjM4Ni0yLjE3Ny0uOTY3LTkuOTE3eiIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoLTI5Ni40IC0yMzYuNzE0KSIgZmlsbD0iI2VkYmE4ZiIvPjwvY2xpcFBhdGg+PGNsaXBQYXRoIGlkPSJkIj48cGF0aCBkPSJNMjkwLjU4IDI1OS4zMTRzMS40MzYgNC4xMTUgOC42OTMtMS4yMDZjMCAwIDQuNTIyIDIuNDEzIDUuNzYxIDMuMTY5IDIuNzUzIDEuNjgzIDMuMzM4IDEuNCA0LjA2NCA0LjA2MmwtNi40MzggMjEuMzExIDIuMTc3IDguNDY2LTIzLjIyOS4wMzkgMi4wNjEtOS40MTJhNy43IDcuNyAwIDAwLTIuMzg3LTYuMjY1Yy0zLjMyLTMuMjExIDEuMTMzLTguNTI1IDQuNjM0LTE4LjIuMjg0LS44IDQuNjY0LTEuOTY0IDQuNjY0LTEuOTY0eiIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoLTI4MC4xMTIgLTI1OC4xMDgpIiBmaWxsPSIjZGM0NjZmIi8+PC9jbGlwUGF0aD48Y2xpcFBhdGggaWQ9ImUiPjxwYXRoIGQ9Ik0zMDEuMjgzIDIxMS44MjNzLTYuNzMgNS4wNDgtNS44NDQgMTIuODEzYy40MDUgMy41NDkgMS4yMDcgNC42NTkgMi42MzIgNS42OTQgMS42ODIgMS4yMjQgNy4yODkuNDYyIDguNzUzLTIuMzYzbC43NzMtMi4yOTJzMS4zNzIgMS4yMjkgMi43NTYtLjYgMS4wODgtNC43MzgtLjkwNS0zLjM2OWwxLjIzOC0zLjY2Ny0xLjIxMi0zLjIxN3oiIHRyYW5zZm9ybT0idHJhbnNsYXRlKC0yOTUuMzU4IC0yMTEuODIzKSIgZmlsbD0iI2VkYmE4ZiIvPjwvY2xpcFBhdGg+PGNsaXBQYXRoIGlkPSJmIj48cGF0aCBkPSJNMTU2LjkxOSAyNTcuMzg3bC45IDI2LjJhMy4wMTcgMy4wMTcgMCAwMDMuMDE1IDIuOTE0SDE5OC41YTMuMDE3IDMuMDE3IDAgMDAzLjAxNS0zLjEybC0uOS0yNi4yYTMuMDE3IDMuMDE3IDAgMDAtMy4wMTUtMi45MTNoLTM3LjY2NmEzLjAxNyAzLjAxNyAwIDAwLTMuMDE1IDMuMTE5eiIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoLTE1Ni45MTcgLTI1NC4yNjcpIiBmaWxsPSIjODM4YmMwIi8+PC9jbGlwUGF0aD48L2RlZnM+PHBhdGggZD0iTTEwMS41MDUgMzQuMDU5Yy0zLjc1Ni05LjE3Ni04LjAzMS0xMC44OTQtOC4wMzEtMTAuODk0cy4xMzMtLjE3OS4zNDktLjVjLjAxNS0uMDU2LjEtLjAzNy4xMy0uMi4wOTItLjE0LjE5NC0uMy4zLS40NzUuMTItLjE5NC4xMzUtLjE4OS4xMjctLjIwNiAyLjMyNS0zLjgyMiA3LjMyMi0xNC4zNTEtNy4zMDktMTUuNTU2YTguNCA4LjQgMCAwMTMuNDM0LTIuMDY3Yy4xMzgtLjA0OS4wNzktLjI3MS0uMDYxLS4yMjFhOC43NjQgOC43NjQgMCAwMC0zLjQ0MSAyLjAyNyAxMS44IDExLjggMCAwMS42LTEuODg3Yy4wNTUtLjEzNy0uMTY3LS4yLS4yMjEtLjA2MWExMS41MzcgMTEuNTM3IDAgMDAtLjYzOSAyLjA2OGMtLjIyOC0uMjE1LS43NS0uNjg5LTEuNS0xLjI4M2ExMS44ODkgMTEuODg5IDAgMDAtMS4zMzYtMS42NDVBMTEuMzY2IDExLjM2NiAwIDAwNzQuNDE4LjA2NmEuMTE3LjExNyAwIDAwLS4xLjA4NSA5LjMyOCA5LjMyOCAwIDAwLTYuMjI1IDIuMjVjLTIuNDQ5IDIuMDQ3LTIuOCA1LjE4NC0yLjE3NCA4LjIuMDM3LjQ3OS4xMjQuOTQzLjE3NCAxLjI1MmExNy40OTIgMTcuNDkyIDAgMDAyLjU1NyA2LjMyNWMtMS41LjI1My00LjIgMS4xNTUtMy42MzMgNC4zNjcuNzY5IDQuNCA0LjM4NyA5Ljk0LjEgMTAuNTE3cy02LjM1MiAxMC4zOTUgOC44MjggMTkuNTYyIDI5LjYxNi40ODcgMjMuNjI3LTYuNzc0Yy4wMDYuMDA0IDcuNjktMi42MTYgMy45MzMtMTEuNzkxek02Ni40ODcgMTIuNjI0YTE2LjMzMSAxNi4zMzEgMCAwMDMuMTEgNS40NjEgNi4zMzEgNi4zMzEgMCAwMC0uNjkzLjA2IDE4LjQ0NSAxOC40NDUgMCAwMS0yLjQxNy01LjUyMnptMTcuMzU3LTkuMjFhMTIgMTIgMCAwMS43NjcuODk1QzgyLjQ5NyAyLjcyMyA3OS4xMzcuNjU4IDc1LjU0Ny4yMzFhMTAuOCAxMC44IDAgMDE4LjI5NyAzLjE4M3oiIGZpbGw9IiM1ZTZjODQiLz48ZyBjbGlwLXBhdGg9InVybCgjYSkiIHRyYW5zZm9ybT0idHJhbnNsYXRlKDYyLjAwNSkiPjxwYXRoIGQ9Ik0yNC45NyAxOC41NHMtMS42NTYuODQzLTIuMDI3IDEuNi4zOTQgNS41LjM5NCA1LjVsOS42MzYgNy42NDdzMi42IDE5Ljg4NC0zLjgyNCAyNS4yMzdTLS45ODIgMzkuNzExLS45ODIgMzkuNzExbDYuNzMtOC41NjUgNi4yNzEtMS45ODkgMS4wNzEtNC41ODhzLTYuNzI4LTMuMTg2LTEuMy0xNC4xMzVsMTMuMTc5IDguMTA2IiBmaWxsPSIjNTA3Y2M3IiBvcGFjaXR5PSIuNCIgc3R5bGU9Im1peC1ibGVuZC1tb2RlOm11bHRpcGx5O2lzb2xhdGlvbjppc29sYXRlIi8+PHBhdGggZD0iTTEyLjc4OSA4LjY1OEw5LjQyNCA4LjA1czEuMjIzIDEuODM2IDQuNTg4IDEuMDcxLTEuMjIzLS40NjMtMS4yMjMtLjQ2MyIgZmlsbD0iIzQzNzVmMSIgb3BhY2l0eT0iLjUiIHN0eWxlPSJtaXgtYmxlbmQtbW9kZTptdWx0aXBseTtpc29sYXRpb246aXNvbGF0ZSIvPjwvZz48cGF0aCBkPSJNNzQuNDg3IDMxLjYwNWwtMS4zNzctMi40NDdzLTMuOTk0LjM5NS01LjQ0NSAyLjA4OC0xMC42NTcgMTguNTM2LTEwLjY1NyAxOC41MzYtMy45ODcgMS44OTMtNy4yNjkgMy41MDdhNS40MzIgNS40MzIgMCAwMTIuMjkzIDMuMjYyIDQ1LjAwNyA0NS4wMDcgMCAwMDguMDEtMy42czguODg4LTYuOCA5Ljg1NS0xMS40IDQuNTktOS45NDYgNC41OS05Ljk0NnoiIGZpbGw9IiNlMmIxODciLz48ZyBjbGlwLXBhdGg9InVybCgjYikiIHRyYW5zZm9ybT0idHJhbnNsYXRlKDQ5Ljc0IDI5LjE1NykiPjxwYXRoIGQ9Ik0xNi4wMjkgMTkuNDI1cy0zLjY3MS0yLjkwNiAxLjk4OC0xMC40YzUuMTU4LTYuODMyIDQuMjgzIDIuMTQxIDQuMjgzIDIuMTQxbC0zLjc2NyA4LjIwNXoiIGZpbGw9IiNlMmIxODciIG9wYWNpdHk9Ii4zMSIgc3R5bGU9Im1peC1ibGVuZC1tb2RlOm11bHRpcGx5O2lzb2xhdGlvbjppc29sYXRlIi8+PC9nPjxwYXRoIGQ9Ik00OS43NCA1My4yODljLTQuMSAyLjAxNy04Ljc3MiA0LjMxNS05LjA0IDQuNDUtLjQ4NC4yNDItNC4zNTQtLjk2Ny00LjgzOC0uNzI1YTMzLjIxNiAzMy4yMTYgMCAwMS00LjEwOCAxLjkzM2MtLjk2Ny4yNDIgMi40MTkuNzI2IDMuODcgMHMxLjkzNS43MjYgMy4xNDQuOTY4IDEuOTM1LjQ4NCAyLjY2MSAwYzAgMCA1LjU4MS0xLjU0OCAxMC42MDgtMy4zNjVhNS40MzIgNS40MzIgMCAwMC0yLjI5Ny0zLjI2MXoiIGZpbGw9IiNlMmIxODciLz48cGF0aCBkPSJNNzYuOTgyIDIzLjE1cy43MjYgMi42Ni0yLjQxOSA1LjgwNWwtMS42OTMgMy4xNDQgMy42MjggNC4xMTIgMy42MjggMS4yMDkgNy43NC04Ljk1LTMuMzg2LTIuMTc3LS45NjctOS45MTd6IiBmaWxsPSIjZWRiYThmIi8+PGcgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoNzIuODcgMTYuMzc3KSIgY2xpcC1wYXRoPSJ1cmwoI2MpIj48cGF0aCBkPSJNMy42MDYgOC40OThzNi43My0uMzA2IDYuODgzLTQuNDM2LTcuNjQ4IDIuNzUzLTYuODgzIDQuNDM2eiIgZmlsbD0iI2FmNzAzZiIgb3BhY2l0eT0iLjI4IiBzdHlsZT0ibWl4LWJsZW5kLW1vZGU6bXVsdGlwbHk7aXNvbGF0aW9uOmlzb2xhdGUiLz48L2c+PHBhdGggZD0iTTc1Ljc4OCAyNy41czEuNDM2IDQuMTE1IDguNjkzLTEuMjA2YzAgMCA0LjUyMiAyLjQxMyA1Ljc2MSAzLjE2OSAyLjc1MyAxLjY4MyAzLjMzOCAxLjQgNC4wNjQgNC4wNjJsLTYuNDM4IDIxLjMxMSAyLjE3NyA4LjQ2Ni0yMy4yMjkuMDM5IDIuMDYxLTkuNDEyYTcuNyA3LjcgMCAwMC0yLjM4Ny02LjI2NWMtMy4zMi0zLjIxMSAxLjEzMy04LjUyNSA0LjYzNC0xOC4yLjI4NC0uOCA0LjY2NC0xLjk2NCA0LjY2NC0xLjk2NHoiIGZpbGw9IiNkYzQ2NmYiLz48ZyB0cmFuc2Zvcm09InRyYW5zbGF0ZSg2NS4zMiAyNi4yOTQpIiBjbGlwLXBhdGg9InVybCgjZCkiPjxwYXRoIGQ9Ik0yMi4zMjEgMTEuMTJzLTQuMTI5IDUuMzUzLTMuNjcgMTUuNmMwIDAtMTIuNzM5IDQuMzg1LTE4LjE0NiA0LjFzLjcxIDMuNy43MSAzLjcgMTUuMyAxLjE2MyAyMi4zMzEtMy43LTEuMjI0LTE5LjctMS4yMjQtMTkuNyIgZmlsbD0iI2ExNzJhZSIgb3BhY2l0eT0iLjMxIiBzdHlsZT0ibWl4LWJsZW5kLW1vZGU6bXVsdGlwbHk7aXNvbGF0aW9uOmlzb2xhdGUiLz48L2c+PHBhdGggZD0iTTY3LjAwNiA1Ny42MjZsLTUuOTg5LTIuNTQ3LTIuNS0xLjg3NmEuOC44IDAgMDAtLjU1MS0uMTU2bC0yLjg4Mi4yNjJhLjYzLjYzIDAgMDAtLjMyMS4xMjRjLS41LjM4My0yLjE0IDEuNjQ2LTEuNzMgMS42NDZhNC41OTMgNC41OTMgMCAwMDIuMTc3LS43MjYgOS4wNyA5LjA3IDAgMDAyLjQxOS0uMjQyIDkuMTk0IDkuMTk0IDAgMDAxLjQ1MSAxLjIwOWMuNDg0LjI0Mi4yNDIgMCAuMjQyIDBsLTMuMjM4Ljk4NWEuNzY1Ljc2NSAwIDAwLS40MS4zYy0uNDA3LjU5MS0xLjUyMiAyLjE5NC0xLjkxNSAyLjU4NmExLjg1IDEuODUgMCAwMDIuMTc3LS45NjdjLjk2Ny0xLjQ1MSAzLjYyOC0xLjQ1MSAzLjg3LTEuMjA5IDAgMC0zLjM4NiAxLjkzNS00LjM1NCAzLjg3IDAgMCAuNDU3IDEuMTg5IDEuMjA5LjI0MmE4LjI3NCA4LjI3NCAwIDAxNC4xMTItMi42NmwtMS4zNzggMS41NzVhLjQ3NC40NzQgMCAwMC4wNDguNjcybDEuMzMgMS4xNHMuMjQyLS45NjctLjI0Mi0xLjQ1MWwxLjIwOS0xLjIwOXMxLjMzNSAyLjY2IDUuMjYzIDEuMDg4eiIgZmlsbD0iI2VkYmE4ZiIvPjxwYXRoIGQ9Ik03Ny41NTkgNTUuNzIzYy01LjE2MyAxLjA3OC0xMC45NjMgMS45NjYtMTAuOTYzIDEuOTY2bC4xIDIuNTgyYTc2LjgzMSA3Ni44MzEgMCAwMDEyLjkwNy0uNzA4IDQuODcxIDQuODcxIDAgMDAtMi4wNDQtMy44NHoiIGZpbGw9IiNlZGJhOGYiLz48cGF0aCBkPSJNOTMuMyAzMS4yOTljLTMuMTI2LTEuMzU1LTUuNzY4IDYuMS01Ljc2OCA2LjEtMy4zODYgNy4wMTUtMi41NjkgMTYuMjMxLTIuNTY5IDE2LjIzMS0xLjEyNS42NTYtNC4xMzcgMS40MTQtNy40IDIuMWE0Ljg3MiA0Ljg3MiAwIDAxMi4wNDggMy44NDFjNi45NjktMS4wMzMgOS45NTItMi43OTMgOS45NTItMi43OTMgMi44OTktNC4zNiA2Ljg2My0yNC4xMjMgMy43MzctMjUuNDc5ek03OC4zMTIgNC44MzhzLTYuNzMgNS4wNDgtNS44NDQgMTIuODEzYy40MDUgMy41NDkgMS4yMDcgNC42NTkgMi42MzIgNS42OTQgMS42ODIgMS4yMjQgNy4yODkuNDYyIDguNzUzLTIuMzYzbC43NzMtMi4yOTJzMS4zNzIgMS4yMjkgMi43NTYtLjYgMS4wODgtNC43MzgtLjkwNS0zLjM2OWwxLjIzOC0zLjY2Ny0xLjIxMi0zLjIxN3oiIGZpbGw9IiNlZGJhOGYiLz48ZyBjbGlwLXBhdGg9InVybCgjZSkiIHRyYW5zZm9ybT0idHJhbnNsYXRlKDcyLjM4NyA0LjgzOCkiPjxwYXRoIGQ9Ik0xLjEwMSA0LjE2NnMyLjUyOCAxLjAzNSA0LjgyMy0zLjRjMCAwIC42MTEgNy4xODkgNS4zNTMgNy4wMzZMOS45IDYuNTc4cy41NDUgNS4wNDggMy43MTQgMy4yMTJTNy4xNDctMS42ODEgNy4xNDctMS42ODFMLjcxNC42MTNsLjM4NyAzLjU1NCIgZmlsbD0iI2FmNzAzZiIgb3BhY2l0eT0iLjI4IiBzdHlsZT0ibWl4LWJsZW5kLW1vZGU6bXVsdGlwbHk7aXNvbGF0aW9uOmlzb2xhdGUiLz48L2c+PHBhdGggZD0iTTg3LjY0MSA4LjJsLTQuODk0LTIuNDQ3LTYuODgzLTEuNjgycy04LjQxMiAyLjkwNi00LjU4OCA0LjU4OGMzLjM1NSAxLjQ3NiA2LjIzOS0xLjg3NiA2LjktMi43MTlhNi41MDYgNi41MDYgMCAwMC45ODYgNC4wNzYgNi4xODEgNi4xODEgMCAwMDMuODc3IDIuNDE2Yy0uMDg0IDIuMzc2IDIuNzcyIDIuOCAyLjc3MiAyLjhsMS4yMjQtLjkxOCAyLjQ0Ny0uNzY0em0tOC4zNTcgMS43M2E1LjcgNS43IDAgMDEtLjkyNS0yLjU2MmMuNzQ1IDIuODM0IDQuNjk0IDQuODA5IDQuNjk0IDQuODA5IDAgLjAzNC0uMDA1LjA2Ny0uMDA4LjFhNi4wMiA2LjAyIDAgMDEtMy43NjEtMi4zNDR6IiBmaWxsPSIjNWU2Yzg0Ii8+PHBhdGggZD0iTTgzLjA1MiAzLjIyNXMxLjgzNS0uODM0IDMuNjcxIDIuODM3YzAgMCAyLjI5NCA1LjM1MyAwIDEwLjI0OGgtLjQ1OXMuOTIyLTkuMDM5LTMuMjEyLTEzLjA4NXoiIGZpbGw9IiM0MzQ2NGEiLz48Y2lyY2xlIGN4PSIyLjE0MSIgY3k9IjIuMTQxIiB0cmFuc2Zvcm09InRyYW5zbGF0ZSg4NC41ODIgMTQuNjI3KSIgZmlsbD0iI2MyMjM3MyIgcj0iMi4xNDEiLz48cGF0aCBkPSJNNzkuMDcxIDE1LjAwN2MtLjEyMy40OTItLjM1NS44NTctLjUxOS44MTZzLS4yLS40NzMtLjA3NS0uOTY1LjM1NS0uODU3LjUxOS0uODE2LjE5My40NzMuMDc1Ljk2NXpNNzQuOTQ1IDE0LjE5M2MtLjA0MS41MDUtLjIxMS45LS4zOC44OXMtLjI3MS0uNDM0LS4yMy0uOTQuMjExLS45LjM4LS44OS4yNy40MzUuMjMuOTR6IiBmaWxsPSIjNDM0NjRhIi8+PHBhdGggZD0iTTc0LjQ4NyAyMC40MTVhNS40MjEgNS40MjEgMCAwMDUuMDQ3LTEuNDEzczAgMi42MjUtMy42MzQgMy4wMjhjLS4wMDIgMC0uNjAyIDAtMS40MTMtMS42MTV6IiBmaWxsPSIjZmZmIi8+PHBhdGggZD0iTTc0LjA4IDExLjgxMWEuOTg5Ljk4OSAwIDAxLjItLjM4Ni45NDguOTQ4IDAgMDEuMzcxLS4yNjguNzgzLjc4MyAwIDAxLjQ2LS4wNzQuODQxLjg0MSAwIDAxLjIxNi4wODEuNzMzLjczMyAwIDAxLjE3OS4xNWwtLjAxMS4wMjlhLjk2Ni45NjYgMCAwMS0uMjE4LjAzMmMtLjA2OC4wMTItLjEzMi4wMS0uMTkzLjAxNmExLjQzNSAxLjQzNSAwIDAxLS4xNzkgMCAuNjUxLjY1MSAwIDAwLS4xOCAwIC44OTQuODk0IDAgMDAtLjMzOS4xNDYgMS4wMjQgMS4wMjQgMCAwMC0uMjc3LjI4NHpNODAuMjQ3IDExLjgxMWEuOTg4Ljk4OCAwIDAwLS4yLS4zODYuOTUuOTUgMCAwMC0uMzcxLS4yNjguNzgyLjc4MiAwIDAwLS40Ni0uMDc0Ljg0MS44NDEgMCAwMC0uMjE2LjA4MS43MzEuNzMxIDAgMDAtLjE3OS4xNWwuMDExLjAyOWEuOTU4Ljk1OCAwIDAwLjIxOC4wMzJjLjA2OC4wMTIuMTMyLjAxLjE5My4wMTZhMS40MjcgMS40MjcgMCAwMC4xNzkgMCAuNjU0LjY1NCAwIDAxLjE4IDAgLjg5MS44OTEgMCAwMS4zMzkuMTQ2IDEuMDE3IDEuMDE3IDAgMDEuMjc3LjI4NHoiIGZpbGw9IiM1ZTZjODQiLz48cGF0aCBkPSJNNzUuNzQ1IDE4LjU0cy0yLjA5MS0uOC0xLjYwOS0xLjEyNmE4LjYgOC42IDAgMDAxLjYyMi0yLjQxOC4xMDEuMTAxIDAgMDEuMi4wMzMgMTAuMzA5IDEwLjMwOSAwIDAxLS4yMTMgMy41MTF6IiBmaWxsPSIjZTc5ZDkwIi8+PGcgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoNzYuNjI4IDE1Ljg1MSkiPjxjaXJjbGUgY3g9Ii45MTgiIGN5PSIuOTE4IiB0cmFuc2Zvcm09InRyYW5zbGF0ZSg5LjE3NykiIGZpbGw9IiM0MzQ2NGEiIHI9Ii45MTgiLz48cGF0aCBkPSJNOC4xNCA1LjM1M0gxLjIyNHYtLjM1NGg2LjczM2MuMjc3LS41MzQgMS43MTQtMy4zMDkgMS44NTQtMy42MjNsLjI4NC4xNTljLS4xNTkuMzU1LTEuODM4IDMuNTkyLTEuOTA5IDMuNzN6IiBmaWxsPSIjNDM0NjRhIi8+PGVsbGlwc2UgY3g9Ii45MTgiIGN5PSIuMzgyIiByeD0iLjkxOCIgcnk9Ii4zODIiIHRyYW5zZm9ybT0idHJhbnNsYXRlKDAgNC43NDEpIiBmaWxsPSIjNDM0NjRhIi8+PC9nPjxwYXRoIGQ9Ik0xMDYuNzYgNjMuODc5SDEuMzc3QTEuMzc3IDEuMzc3IDAgMDEwIDYyLjUwM2ExLjM3NyAxLjM3NyAwIDAxMS4zNzctMS4zNzdIMTA2Ljc2YTEuMzc3IDEuMzc3IDAgMDExLjM3NyAxLjM3NyAxLjM3NyAxLjM3NyAwIDAxLTEuMzc3IDEuMzc2eiIgZmlsbD0iI2NiY2ZkNiIvPjxnPjxwYXRoIGQ9Ik04LjIxNCAyNy42MzNsLjkgMjYuMmEzLjAxNyAzLjAxNyAwIDAwMy4wMTUgMi45MTRoMzcuNjY2YTMuMDE3IDMuMDE3IDAgMDAzLjAxNS0zLjEybC0uOS0yNi4yYTMuMDE3IDMuMDE3IDAgMDAtMy4wMTUtMi45MTNIMTEuMjI5YTMuMDE3IDMuMDE3IDAgMDAtMy4wMTUgMy4xMTl6IiBmaWxsPSIjODM4YmMwIi8+PGcgY2xpcC1wYXRoPSJ1cmwoI2YpIiB0cmFuc2Zvcm09InRyYW5zbGF0ZSg4LjIxMiAyNC41MTMpIj48cGF0aCBkPSJNMjUuMTMyIDIwLjI0NXMtMi45MDYgMTEuMzE5IDAgMTQuNTMxLTE2LjA2LTEuMjI0LTE2LjA2LTEuMjI0IDIuNi05LjMzIDkuNzg5LTEzLjMwN2wzLjM2NSAyLjE0MiAyLjkwNi0yLjE0MiIgZmlsbD0iIzgzOGJjMCIgb3BhY2l0eT0iLjYxIiBzdHlsZT0ibWl4LWJsZW5kLW1vZGU6bXVsdGlwbHk7aXNvbGF0aW9uOmlzb2xhdGUiLz48L2c+PC9nPjxwYXRoIGQ9Ik0yNy4wNzIgNDQuNzU4aDYuMjcxcy05LjQ4MyAxNS4zLS45OTQgMTYuMzY2SDE5LjI3MnMtMi42LTYuMTE4IDcuOC0xNi4zNjZ6IiBmaWxsPSIjODM4YmMwIi8+PC9zdmc+")
}
.coachMarkCallNow {
 display:none
}
@media screen and (max-width:1023px) {
 .p0 .scheduledCallModule {
  margin-left:0;
  width:100%
 }
 .coachMarkCont {
  z-index:99
 }
 .coachMarkCallNow {
  display:block;
  position:fixed;
  width:100%;
  height:100%;
  left:0;
  top:0;
  z-index:99
 }
 .coachMarkCallNow:before {
  content:"";
  position:absolute;
  width:100%;
  height:100%;
  left:0;
  top:0;
  background:rgba(37,56,88,.9);
  clip-path:polygon(0 0,100% 0,100% 92%,74% 92%,74% 100%,0 100%);
  animation:fadeCoachMask .5s ease-in-out 0s forwards
 }
 @keyframes fadeCoachMask {
  0% {
   opacity:0
  }
  to {
   opacity:1
  }
 }
 .coachMarkCallNow .pointer {
  position:absolute;
  width:16px;
  height:16px;
  border-radius:50%;
  background:#fff;
  top:87%;
  left:85%;
  transform:scale(0);
  animation:coachPointerScale .5s ease-in-out .5s forwards
 }
 @keyframes coachPointerScale {
  0% {
   transform:scale(0)
  }
  to {
   transform:scale(1)
  }
 }
 .coachMarkCallNow .pointer:before {
  content:"";
  position:absolute;
  width:12px;
  height:12px;
  border-radius:50%;
  border:1px solid #253858;
  left:50%;
  top:50%;
  transform:translate(-50%,-50%)
 }
 .coachMarkCallNow .pointer:after {
  content:"";
  position:absolute;
  width:1px;
  height:100px;
  background:#fff;
  bottom:140%;
  left:50%;
  transform:translateX(-50%);
  clip-path:inset(100% 0 0 0);
  animation:coachLineDraw .5s ease-in-out .5s forwards
 }
 @keyframes coachLineDraw {
  0% {
   clip-path:inset(100% 0 0 0)
  }
  to {
   clip-path:inset(0 0 0 0)
  }
 }
 .coachMarkCallNow .coachBox {
  width:90%;
  left:50%;
  transform:translateX(-50%);
  position:absolute;
  background:#fff;
  border-radius:8px;
  padding:16px;
  bottom:30%;
  font-size:14px;
  color:#253858;
  font-weight:400;
  opacity:0;
  visibility:hidden;
  animation:fadeCoachBox .5s ease-in-out 1s forwards
 }
}
@media screen and (max-width:1023px) and (max-width:420px) {
 .coachMarkCallNow .coachBox {
  font-size:3.8vw
 }
}
@media screen and (max-width:1023px) {
 @keyframes fadeCoachBox {
  0% {
   opacity:0;
   visibility:hidden
  }
  to {
   opacity:1;
   visibility:visible
  }
 }
 .coachMarkCallNow .coachBox span {
  font-size:16px;
  font-weight:700;
  display:block;
  margin-bottom:8px
 }
}
@media screen and (max-width:1023px) and (max-width:420px) {
 .coachMarkCallNow .coachBox span {
  font-size:4.5vw
 }
}
@media screen and (max-width:1023px) {
 .coachMarkCallNow .coachBox a {
  display:block;
  float:right;
  margin-top:16px;
  font-size:16px;
  font-weight:600
 }
}
@media screen and (max-width:1023px) and (max-width:420px) {
 .coachMarkCallNow .coachBox a {
  font-size:4.5vw
 }
}
.pb_exitIntent {
 position:fixed;
 left:0;
 top:0;
 width:100%;
 height:100%;
 z-index:9999
}
.pb_exitIntent:before {
 content:"";
 position:absolute;
 background:rgba(37,56,88,.9);
 left:0;
 top:0;
 width:100%;
 height:100%
}
.pb_exitIntent__box {
 position:absolute;
 width:1024px;
 min-height:508px;
 background:#fff;
 border-radius:8px;
 padding:32px;
 left:50%;
 top:50%;
 transform:translate(-50%,-50%);
 z-index:1;
 display:flex;
 align-items:center
}
.pb_exitIntent__box:after {
 content:"";
 background:url(https://static.pbcdn.in/health-cdn/images/insurer-logo/quotes-logos/exit-intent-claimAssistance.png) no-repeat 0 0;
 position:absolute;
 right:0;
 top:0;
 width:534px;
 height:461px;
 background-size:cover
}
.pb_exitIntent__box__close {
 width:24px;
 height:24px;
 position:absolute;
 right:32px;
 top:32px;
 cursor:pointer;
 z-index:2
}
.pb_exitIntent__box__close:after,
.pb_exitIntent__box__close:before {
 content:"";
 width:2px;
 height:100%;
 background:#253858;
 transform:rotate(45deg);
 position:absolute;
 right:10px;
 top:0
}
.pb_exitIntent__box__close:after {
 transform:rotate(-45deg)
}
.pb_exitIntent__box__heading {
 font-size:24px;
 font-weight:700;
 margin-bottom:24px
}
.pb_exitIntent__box__heading p {
 font-size:20px;
 font-weight:600;
 margin-bottom:6px
}
.pb_exitIntent__box ul {
 width:350px
}
.pb_exitIntent__box ul li {
 font-size:16px;
 font-weight:600;
 margin-bottom:24px;
 position:relative;
 padding-left:40px
}
.pb_exitIntent__box ul li strong {
 font-size:18px;
 color:#253858!important
}
.pb_exitIntent__box ul li span {
 color:#ff5630;
 display:block
}
.pb_exitIntent__box ul li:last-child {
 margin-bottom:0
}
.pb_exitIntent__box ul li:before {
 content:"";
 width:32px;
 height:32px;
 position:absolute;
 left:0;
 background:url(https://static.pbcdn.in/health-cdn/images/insurer-logo/quotes-logos/exit-intent-claimAssistance.png) no-repeat -557px 0;
 background-size:646px
}
.pb_exitIntent__box ul li:first-child:before {
 background-position:-557px 0
}
.pb_exitIntent__box ul li:nth-child(2):before {
 background-position:-614px 0
}
.pb_exitIntent__box__cta {
 width:360px;
 height:56px;
 border-radius:8px;
 outline:none;
 -webkit-appearance:none;
 box-shadow:none;
 background:#ff5630;
 color:#fff;
 font-size:16px;
 font-weight:700;
 border:none;
 margin-top:32px;
 cursor:pointer;
 transition:background .3s ease-in
}
.pb_exitIntent__box__cta:hover {
 background:#fc2e00
}
.pb_exitIntent__boxCont {
 width:460px
}
.pb_exitIntent__boxCont__disclaimer {
 width:360px;
 font-size:10px;
 color:#7a869a;
 padding-left:7px;
 position:relative;
 top:20px
}
@media screen and (max-width:420px) {
 .pb_exitIntent__boxCont__disclaimer {
  font-size:2.8vw
 }
}
.pb_exitIntent__boxCont__disclaimer:before {
 content:"*";
 position:absolute;
 left:0
}
.intermediateMain {
 width:100%;
 background:#fff
}
.wrapperIntermediate {
 width:100%;
 max-width:1140px;
 margin:32px auto;
 display:flex;
 justify-content:space-between
}
.leftIntermediate {
 width:328px
}
.leftHeadingInter {
 font-size:32px;
 line-height:48px;
 font-weight:700
}
.rightIntermediate {
 width:calc(100% - 328px);
 margin-left:58px
}
.didKnow {
 font-size:12px;
 position:relative
}
.didKnow:after {
 width:84px;
 height:1px;
 background:#dfe1e6;
 content:"";
 display:inline-block;
 margin:0 0 0 8px;
 position:absolute;
 top:8px
}
.headingKnowledge {
 font-size:24px;
 font-weight:700;
 line-height:32px;
 margin-bottom:16px
}
.lisitngAdvatageBox {
 display:flex;
 flex-flow:row wrap
}
.lisitngInnerAdvatageBox {
 box-shadow:0 6px 16px 0 rgba(37,56,88,.16);
 background:#fff;
 border-radius:8px;
 justify-content:space-between;
 width:26%;
 text-align:center;
 display:flex;
 flex-direction:column;
 padding:20px;
 cursor:pointer;
 margin-bottom:32px
}
.lisitngInnerAdvatageBox .imgBox {
 width:72px;
 height:72px;
 margin:0 auto;
 object-fit:contain
}
.lisitngInnerAdvatageBox .innerText {
 font-size:16px;
 font-weight:500;
 line-height:24px;
 margin:12px 0 0;
 padding:0
}
.buttonInter {
 background:#ff5630;
 color:#fff;
 border-radius:8px;
 width:328px;
 height:48px;
 display:flex;
 align-items:center;
 justify-content:center;
 border:none;
 outline:none;
 font-size:16px;
 font-weight:700;
 cursor:pointer;
 margin:0 auto;
 position:relative
}
.AdvatageBoxButton {
 width:668px
}
.overlay {
 position:fixed;
 top:0;
 left:0;
 bottom:0;
 right:0;
 height:100%;
 width:100%;
 margin:0;
 padding:0;
 background:rgba(23,43,77,.9);
 z-index:999;
 animation:overlayEmiMask .3s ease-out forwards
}
@keyframes overlayEmiMask {
 0% {
  opacity:0
 }
}
.intermediateModal {
 width:100%;
 height:auto;
 box-shadow:0 -3px 6px 0 rgba(0,0,0,.16);
 background-color:#fff;
 position:fixed;
 bottom:0;
 left:0;
 border-radius:24px 24px 0 0;
 padding:8px 16px 16px;
 z-index:999;
 animation:intermediateModalSlide .3s ease-out forwards
}
@keyframes intermediateModalSlide {
 0% {
  bottom:-100%
 }
 to {
  bottom:0
 }
}
.intermediateModal .headbar-break {
 justify-content:space-between;
 color:#253858;
 display:flex;
 flex-direction:row;
 margin:0 0 10px;
 align-items:center;
 padding-right:0
}
.intermediateModal .headbar-break>div:first-child {
 font-size:16px;
 color:#253858;
 font-weight:700;
 line-height:24px
}
.intermediateModal .headbar-break .close-box {
 width:32px;
 height:32px;
 border-radius:50%;
 position:relative;
 transition:all .2s ease-in;
 margin-right:-6px;
 cursor:pointer
}
.intermediateModal .headbar-break .close-box:after,
.intermediateModal .headbar-break .close-box:before {
 content:"";
 position:absolute;
 height:20px;
 width:2px;
 transform:rotate(-45deg);
 left:15px;
 top:6px;
 background:#253858
}
.intermediateModal .headbar-break .close-box:before {
 transform:rotate(45deg)
}
.crm-info-msg {
 color:#505f79;
 font-size:14px;
 line-height:22px;
 margin:0;
 padding:0
}
.contentModal {
 display:flex;
 justify-content:space-between
}
.imgBoxModal {
 min-width:64px;
 min-height:64px;
 margin:0 20px 0 0;
 object-fit:contain
}
@media only screen and (min-width:1024px) {
 .lisitngAdvatageBox .lisitngInnerAdvatageBox:not(:nth-child(3n)) {
  margin-right:32px
 }
 .intermediateModal {
  max-width:360px;
  height:auto;
  left:50%;
  top:50%;
  transform:translate(-50%,-50%);
  bottom:auto;
  border-radius:8px;
  box-shadow:0 2px 4px 0 rgba(0,0,0,.16);
  padding:8px 16px 16px;
  animation:intermediateModalFade .3s ease-out forwards
 }
 @keyframes intermediateModalFade {
  0% {
   opacity:0
  }
  to {
   opacity:1
  }
 }
}
@media only screen and (max-width:1023px) {
 .leftIntermediate {
  width:100%
 }
 .rightIntermediate {
  width:100%;
  margin:0
 }
 .AdvatageBoxButton {
  bottom:0;
  position:sticky;
  position:-webkit-sticky;
  padding:0;
  height:74px;
  display:flex;
  width:calc(100% + 32px);
  align-items:center;
  z-index:999;
  background:transparent linear-gradient(179deg,hsla(0,0%,100%,0),hsla(0,0%,100%,.4235294117647059) 15%,#fff) 0 0 no-repeat;
  margin:0 -16px
 }
 .wrapperIntermediate {
  max-width:100%;
  margin:12px auto;
  justify-content:left;
  flex-direction:column;
  padding:0 16px
 }
 .leftHeadingInter {
  font-size:24px;
  line-height:32px;
  margin-bottom:32px
 }
 .headingKnowledge {
  font-size:16px;
  line-height:24px;
  margin-bottom:16px
 }
 .lisitngAdvatageBox {
  margin-bottom:64px
 }
 .lisitngInnerAdvatageBox {
  flex:1 1 47%;
  padding:22px 20px;
  margin-bottom:24px
 }
 .lisitngInnerAdvatageBox .innerText {
  font-size:14px;
  line-height:21px
 }
 .lisitngAdvatageBox .lisitngInnerAdvatageBox:nth-child(2n) {
  margin-left:16px;
  transform:translateY(43px)
 }
 .buttonInter {
  width:100%;
  margin:0 16px
 }
}
@media (max-width:1023px) {
 .crmCampaignHeader {
  width:150px!important;
  height:24px!important;
  margin:0!important;
  display:block!important
 }
 .crmCampaignHeader+.fl.content-h {
  display:none
 }
}
@media (min-width:1024px) {
 .crmCampaignHeader {
  display:none
 }
}
.shortlist_blank_page {
 display:flex;
 flex-direction:column;
 width:100%;
 height:100%;
 justify-content:center;
 align-items:center
}
.shortlist_main {
 height:calc(100vh - 116px)
}
.span_shortlist_blank {
 padding:24px 50px;
 font-size:16px;
 color:#7a869a;
 text-align:center
}
@media screen and (max-width:420px) {
 .span_shortlist_blank {
  font-size:4.5vw
 }
}
.button_shortlist_blank {
 padding:0 20px;
 cursor:pointer;
 background:#ff5630;
 display:flex;
 border-radius:8px;
 flex-direction:row;
 align-items:center;
 justify-content:center
}
.span_shortlist_blank_button {
 color:#fff;
 padding:16px 46px
}
.shortlist_blank_image {
 height:35px;
 width:20%;
 background:#7a869a;
 opacity:.1
}
.shortlist_blank_image1 {
 height:34px;
 width:60%;
 margin-left:10px
}
.shortlist_blank_image3 {
 height:32px;
 width:20%
}
.shortlist_blank_image6 {
 height:32px;
 width:40%;
 margin-left:10px
}
.shortlist_blank_image7 {
 height:32px;
 width:25%;
 margin-left:auto;
 border-radius:4px;
 border:1px solid #f1f3f5
}
.shortlist_blank_image2 {
 height:16px
}
.shortlist_blank_image2,
.shortlist_blank_image4 {
 width:100%;
 background:#7a869a;
 opacity:.1;
 margin-bottom:3px
}
.shortlist_blank_image4 {
 height:10px
}
.shortlist_blank_image5 {
 height:20px;
 width:50%;
 background:#7a869a;
 opacity:.1;
 margin-bottom:3px
}
.shortlist_compare {
 display:flex;
 flex-direction:column;
 padding:0;
 width:100%;
 background:#f4f5f7;
 max-width:1170px;
 margin:0 auto 20px
}
.shortlist_compare_heading {
 font-size:18px;
 color:#253858
}
.shortlist_icon {
 height:24px;
 width:100%;
 position:relative;
 top:50%;
 transform:translateY(-50%)
}
.shortlist_compare_plans {
 padding:10px 0;
 white-space:nowrap;
 width:100%
}
.shortlist_compare_plans::-webkit-scrollbar {
 display:none
}
.shortlist_compare_plan_main {
 background:#fff;
 margin-right:12px;
 border-radius:10px;
 width:372px;
 display:inline-block;
 border:1px solid #dfe1e6
}
.isOneCoutshortlist {
 width:100%!important
}
.compare_shortlist_button {
 width:100%;
 padding:10px 0;
 color:#ff5630;
 border-top:1px solid #f0f4f5;
 text-align:center;
 font-size:14px;
 border-radius:6px;
 background:#fff;
 font-weight:500
}
@media screen and (max-width:420px) {
 .compare_shortlist_button {
  font-size:3.8vw
 }
}
.shortlist_container {
 width:24px;
 align-items:center;
 justify-content:center;
 display:flex;
 flex-direction:column;
 position:relative;
 margin-left:auto
}
.shortlist_container.disabled {
 filter:grayscale(1);
 opacity:.3
}
.shortlist_compare_plans .quotes_compare_div {
 align-items:flex-start;
 width:100%;
 justify-content:space-between;
 position:relative
}
.shortlist_compare_plans .quotes_compare_div:before {
 content:"VS";
 width:30px;
 height:30px;
 border-radius:50%;
 background:#dfe1e6;
 color:#253858;
 font-size:14px;
 text-align:center;
 line-height:30px;
 position:absolute;
 left:148px;
 top:50px;
 z-index:9
}
.shortlist_compare_plans .quotes_compare_row {
 padding:16px;
 min-height:86px
}
.shortlist_compare_plans .quotes_compare_plan_name {
 background:none;
 box-shadow:none;
 width:140px;
 margin-right:16px;
 margin-left:0;
 padding:0;
 height:auto;
 border:none;
 border-radius:0;
 display:block
}
.shortlist_compare_plans .quotes_compare_plan_name:nth-child(2) {
 margin-left:20px;
 margin-right:0;
 text-align:right;
 justify-content:flex-end
}
.shortlist_compare_plans .quotes_compare_plan_name:nth-child(2) .quotes_compare_image1 {
 float:right
}
.shortlist_compare_plans .quotes_compare_plan_main {
 padding:0;
 justify-content:flex-start
}
.shortlist_compare_plans .shortlist_compare_planName {
 width:100%;
 white-space:normal
}
.shortlist_compare_plans .compare_shortlist_button {
 padding:14px 0;
 cursor:pointer;
 background:transparent
}
.shortlist_compare_plans .quotes_compare_span_plan_name1 {
 max-height:40px;
 display:inline-block;
 display:-webkit-box;
 overflow:hidden;
 -webkit-line-clamp:2;
 -webkit-box-orient:vertical;
 margin-left:0;
 margin-bottom:5px;
 max-width:96px
}
.shortlist_compare_plans .quotes_compare_image1 {
 border-radius:0;
 border:none
}
.shortlist_compare_plans .quotes_img_compare1 {
 width:100%
}
@media screen and (max-width:1023px) {
 .shortlist_compare {
  display:flex;
  flex-direction:column;
  width:100%;
  padding:23px 0
 }
 .shortlist_compare_heading {
  font-size:16px;
  color:#253858
 }
}
@media screen and (max-width:1023px) and (max-width:420px) {
 .shortlist_compare_heading {
  font-size:4.5vw
 }
}
@media screen and (max-width:1023px) {
 .shortlist_compare_plan_main {
  background:#fff;
  margin-right:10px;
  border-radius:10px;
  box-shadow:0 3px 6px 0 rgba(0,0,0,.16);
  width:90%;
  display:inline-block
 }
 .shortlist_compare_plans {
  width:auto;
  overflow-y:auto;
  scroll-behavior:smooth
 }
 .quotes_compare_div:before {
  width:24px!important;
  height:24px!important;
  font-size:12px!important;
  line-height:24px!important;
  left:50%!important;
  top:45px!important;
  margin-left:-12px
 }
}
.segment_bottomSheet {
 position:fixed;
 left:0;
 right:0;
 top:0;
 z-index:100;
 bottom:0
}
.segment_bottomSheet:before {
 content:"";
 position:fixed;
 left:0;
 right:0;
 top:0;
 bottom:0;
 background:rgba(37,56,88,.9);
 animation:bottomSheetMask .3s ease-in
}
.segment_bottomSheet .bottomSheetBox {
 position:absolute;
 max-height:580px;
 bottom:0;
 width:100%;
 border-radius:15px 15px 0 0;
 padding:16px;
 background:#fff;
 animation:bottomSheetSlideUp .5s ease-out
}
.segment_bottomSheet .bottomSheetBox h6 {
 font-size:18px;
 margin-bottom:8px
}
.segment_bottomSheet .bottomSheetBox .closeIcon {
 width:20px;
 height:20px;
 position:absolute;
 right:16px;
 top:16px;
 cursor:pointer
}
.segment_bottomSheet .bottomSheetBox .closeIcon:after,
.segment_bottomSheet .bottomSheetBox .closeIcon:before {
 content:"";
 position:absolute;
 width:2px;
 height:100%;
 background:#253858;
 left:50%;
 top:50%;
 margin:-10px 0 0 -1px
}
.segment_bottomSheet .bottomSheetBox .closeIcon:before {
 transform:rotate(45deg)
}
.segment_bottomSheet .bottomSheetBox .closeIcon:after {
 transform:rotate(-45deg)
}
@keyframes bottomSheetMask {
 0% {
  opacity:0
 }
 to {
  opacity:1
 }
}
@keyframes bottomSheetSlideUp {
 0% {
  transform:translateY(100%)
 }
 to {
  transform:translateY(0)
 }
}
@media only screen and (min-width:1024px) {
 .segment_bottomSheet {
  z-index:99999
 }
 .segment_bottomSheet .bottomSheetBox {
  padding-top:32px;
  border-radius:0;
  width:400px;
  left:auto;
  bottom:auto;
  top:0;
  right:0;
  height:100vh;
  max-height:inherit;
  animation:rightPanelSlideDesktop .5s ease-out
 }
 .infoBoxPopupDesktop.segment_bottomSheet {
  z-index:99999
 }
 .infoBoxPopupDesktop.segment_bottomSheet .bottomSheetBox {
  padding:16px;
  border-radius:10px;
  width:auto;
  max-width:500px;
  top:50%;
  left:50%;
  bottom:unset;
  height:auto;
  transform:translate(-50%,-50%);
  animation:bottomSheetSlideUpDesktop .5s ease-out
 }
}
@keyframes rightPanelSlideDesktop {
 0% {
  transform:translateX(100%);
  opacity:0
 }
 to {
  transform:translateX(0);
  opacity:1
 }
}
@keyframes bottomSheetSlideUpDesktop {
 0% {
  transform:translate(-50%,-40%);
  opacity:0
 }
 to {
  transform:translate(-50%,-50%);
  opacity:1
 }
}
.segment_close {
 position:fixed;
 width:100%;
 height:40px;
 top:0;
 opacity:0;
 z-index:9;
 animation:fade .3s ease-in .3s forwards
}
.segment_close .segment_closeIcon {
 width:20px;
 height:20px;
 position:absolute;
 right:16px;
 top:12px
}
.segment_close .segment_closeIcon:after,
.segment_close .segment_closeIcon:before {
 content:"";
 position:absolute;
 width:2px;
 height:100%;
 background:#253858;
 left:50%;
 top:50%;
 margin:-10px 0 0 -1px
}
.segment_close .segment_closeIcon:before {
 transform:rotate(45deg)
}
.segment_close .segment_closeIcon:after {
 transform:rotate(-45deg)
}
.segment_close.faded {
 background:transparent linear-gradient(180deg,#fff,hsla(0,0%,100%,.7686274509803922) 25%,hsla(0,0%,100%,.13725490196078433) 83%,hsla(0,0%,100%,0)) 0 0 no-repeat padding-box;
 height:60px
}
.segment_question_popup_mobile {
 height:100%;
 z-index:9999;
 position:fixed;
 width:100%;
 background:#fff;
 overflow:auto;
 animation:segment_question_popup_mobile .5s ease-out forwards
}
@keyframes segment_question_popup_mobile {
 0% {
  bottom:-100%
 }
 to {
  bottom:0
 }
}
.pedQuestionsWrapper article {
 height:100vh;
 position:relative
}
.pedQuestionsWrapper article.firstScroll {
 padding-top:0
}
.pedQuestionsWrapper article.firstScroll .questionBlock {
 display:block
}
.pedQuestionsWrapper article .questionBlock {
 padding:0 16px;
 height:100%;
 display:flex;
 flex-direction:column;
 justify-content:space-around
}
.pedQuestionsWrapper article .questionBlock img {
 height:78px;
 width:auto;
 display:block;
 margin-bottom:12px
}
.pedQuestionsWrapper article .questionBlock h6 {
 font-size:16px;
 font-weight:700
}
@media screen and (max-width:420px) {
 .pedQuestionsWrapper article .questionBlock h6 {
  font-size:4.5vw
 }
}
.pedQuestionsWrapper article .questionBlock .hint {
 font-size:14px;
 color:#505f79;
 margin-bottom:16px
}
@media screen and (max-width:420px) {
 .pedQuestionsWrapper article .questionBlock .hint {
  font-size:3.8vw
 }
}
.pedQuestionsWrapper article .questionBlock .psych {
 margin:16px 0;
 font-size:12px;
 font-weight:600;
 color:#505f79;
 position:relative;
 padding-left:35px;
 animation:psychAnim .3s ease-out forwards
}
@media screen and (max-width:420px) {
 .pedQuestionsWrapper article .questionBlock .psych {
  font-size:3.2vw
 }
}
@keyframes psychAnim {
 0% {
  transform:translateY(30%);
  opacity:0
 }
 to {
  transform:translateY(0);
  opacity:1
 }
}
.pedQuestionsWrapper article .questionBlock .psych p {
 margin-bottom:10px
}
.pedQuestionsWrapper article .questionBlock .psych p:last-child {
 margin:0
}
.pedQuestionsWrapper article .questionBlock .psych:before {
 content:"";
 width:25px;
 height:25px;
 background:url(https://static.pbcdn.in/health-cdn/images/insurer-logo/quotes-logos/segment_question-icon-sprite.svg) no-repeat 0 -232px;
 background-size:90px;
 position:absolute;
 left:0;
 top:0
}
.pedQuestionsWrapper article .questionBlock .segment_btn {
 display:none;
 animation:slideBtnShow .3s ease-out forwards
}
.pedQuestionsWrapper article .questionBlock .segment_btn.slideUp {
 display:block
}
@keyframes slideBtnShow {
 0% {
  transform:translateY(30%);
  opacity:0
 }
 to {
  transform:translateY(0);
  opacity:1
 }
}
.pedQuestionsWrapper article .questionBlock .finalStepMsg {
 line-height:21px;
 color:#505f79;
 margin:16px 0;
 display:none;
 animation:finalStepMsgShow .3s ease-out forwards
}
.pedQuestionsWrapper article .questionBlock .finalStepMsg strong {
 font-size:16px;
 font-weight:700;
 display:block
}
.pedQuestionsWrapper article .questionBlock .finalStepMsg p {
 font-size:14px
}
@media screen and (max-width:420px) {
 .pedQuestionsWrapper article .questionBlock .finalStepMsg p {
  font-size:3.8vw
 }
}
.pedQuestionsWrapper article .questionBlock .finalStepMsg.show {
 display:block
}
@keyframes finalStepMsgShow {
 0% {
  transform:translateY(30%);
  opacity:0
 }
 to {
  transform:translateY(0);
  opacity:1
 }
}
.pedQuestionsWrapper article .questionBlock .medical_cta_wrapper {
 height:auto;
 position:relative;
 margin-bottom:24px
}
@media only screen and (min-device-width:375px) and (min-device-height:812px) and (-webkit-device-pixel-ratio:3) and (orientation:portrait) {
 .pedQuestionsWrapper article .questionBlock .medical_cta_wrapper {
  margin-bottom:74px
 }
}
@media only screen and (min-device-width:414px) and (min-device-height:896px) and (-webkit-device-pixel-ratio:2) and (orientation:portrait) {
 .pedQuestionsWrapper article .questionBlock .medical_cta_wrapper {
  margin-bottom:74px
 }
}
.pedQuestionsWrapper article .welcomeText+.questionBlock {
 height:calc(100% - 188px)
}
.pedQuestionsWrapper article .nextQuestionSubdue {
 position:absolute;
 bottom:-10px;
 opacity:.1;
 z-index:-1
}
.pedQuestionsWrapper .welcomeText {
 height:140px;
 background:#e3fcef url(https://static.pbcdn.in/health-cdn/images/insurer-logo/quotes-logos/segment_curve.png) no-repeat bottom;
 background-size:contain;
 padding:30px 16px 38px;
 font-size:16px;
 color:#253858;
 margin-bottom:8px
}
@media screen and (max-width:420px) {
 .pedQuestionsWrapper .welcomeText {
  font-size:4.5vw
 }
}
.pedQuestionsWrapper .welcomeText h5 {
 font-size:20px;
 color:#253858;
 font-weight:700;
 margin-bottom:4px
}
.optionsModule {
 margin-bottom:20px
}
.optionsModule:last-child {
 margin-bottom:0
}
.optionsModule input+label {
 padding:14px 24px;
 font-weight:600;
 display:block;
 transition:all .3s ease-in;
 cursor:pointer
}
.segment_leftCol {
 display:none
}
@media only screen and (min-width:1024px) {
 .segment_close {
  position:static;
  height:auto;
  cursor:pointer;
  animation:none;
  opacity:1
 }
 .segment_close .segment_closeIcon {
  right:97px;
  top:28px;
  width:24px;
  height:24px
 }
 .segment_question_popup_desktop {
  display:flex;
  overflow:hidden;
  animation:segment_pop_desktop_fadeIn .3s ease-in forwards
 }
 @keyframes segment_pop_desktop_fadeIn {
  0% {
   opacity:0;
   visibility:hidden
  }
  to {
   opacity:1;
   visibility:visible
  }
 }
 .segment_question_popup_desktop .segment_leftCol {
  background:#172b4d;
  height:100vh;
  width:30%;
  padding:130px 100px 0 70px;
  display:block
 }
 .segment_question_popup_desktop .segment_leftCol h3 {
  font-size:30px;
  font-weight:700;
  color:#fff;
  line-height:45px;
  margin-bottom:20px
 }
 .segment_question_popup_desktop .segment_leftCol h6 {
  font-size:18px;
  line-height:27px;
  color:#fff;
  font-weight:400
 }
 .segment_question_popup_desktop .segment_rightCol {
  width:70%;
  height:100vh
 }
 .pedQuestionsWrapper {
  min-height:100vh;
  height:100%;
  overflow:auto
 }
 .pedQuestionsWrapper article {
  height:100%;
  width:450px;
  margin-left:100px
 }
 .pedQuestionsWrapper article .questionBlock {
  justify-content:space-evenly
 }
 .pedQuestionsWrapper article .questionBlock h6 {
  font-size:18px
 }
}
@media only screen and (min-width:1024px) and (max-width:420px) {
 .pedQuestionsWrapper article .questionBlock h6 {
  font-size:5.1vw
 }
}
@media only screen and (min-width:1024px) {
 .pedQuestionsWrapper article .questionBlock .hint {
  font-size:14px
 }
}
@media only screen and (min-width:1024px) and (max-width:420px) {
 .pedQuestionsWrapper article .questionBlock .hint {
  font-size:3.8vw
 }
}
@media only screen and (min-width:1024px) {
 .pedQuestionsWrapper article .welcomeText+.questionBlock {
  height:100%
 }
 .pedQuestionsWrapper .welcomeText {
  display:none
 }
}
.categoryHeader {
 padding:19px 16px 0;
 display:flex;
 flex-direction:column;
 position:relative
}
.categoryHeader .back {
 width:24px;
 height:24px;
 position:relative
}
.categoryHeader .back:before {
 content:"";
 border:solid #253858;
 border-width:0 2px 2px 0;
 display:inline-block;
 padding:4px;
 transform:rotate(135deg);
 position:absolute;
 left:2px;
 top:7px
}
.categoryHeader .back:after {
 content:"";
 height:2px;
 width:14px;
 position:absolute;
 left:2px;
 top:50%;
 margin-top:-1px;
 background:#253858
}
.categoryHeader h4 {
 font-size:20px;
 color:#253858;
 font-weight:700;
 margin-top:25px;
 transition:all .3s ease-in
}
.categoryHeader h4#planScrollHead {
 display:none
}
.categoryHeader .shareIcon {
 position:absolute;
 right:16px;
 top:15px;
 cursor:pointer
}
.categoryHeader .shareIcon i {
 width:24px;
 height:24px;
 background:url(https://static.pbcdn.in/health-cdn/images/insurer-logo/quotes-logos/segment_miscIcons.svg) no-repeat -5px -140px;
 display:block;
 margin:0 auto
}
.categoryHeader .shareIcon:after {
 content:"SHARE";
 font-size:10px;
 color:#253858;
 font-weight:700;
 display:block
}
.categoryHeader .planTabs {
 width:110%;
 margin:10px -16px 0;
 display:none
}
.categoryHeader .planTabs ul {
 font-size:0;
 padding-left:6px;
 white-space:nowrap;
 overflow:hidden
}
.categoryHeader .planTabs ul li {
 display:inline-block
}
.categoryHeader .planTabs ul li a {
 font-size:14px;
 display:block;
 padding:13px 12px;
 color:#253858;
 position:relative
}
@media screen and (max-width:420px) {
 .categoryHeader .planTabs ul li a {
  font-size:3.8vw
 }
}
.categoryHeader .planTabs ul li:last-child {
 margin-right:0
}
.categoryHeader .planTabs ul li.active a {
 font-weight:700
}
.categoryHeader .planTabs ul li.active a:after {
 content:"";
 width:100%;
 height:2px;
 border-radius:2px;
 background:#253858;
 position:absolute;
 bottom:0;
 left:0
}
.categoryHeader.scrollable {
 background:#fff;
 box-shadow:0 2px 2px rgba(0,0,0,.16);
 flex-direction:row;
 align-items:center;
 padding:0 16px;
 position:sticky;
 position:-webkit-sticky;
 top:0;
 z-index:99;
 flex-wrap:wrap
}
.categoryHeader.scrollable .categoryHeaderTopBar {
 height:56px;
 flex-direction:row;
 align-items:center;
 display:flex;
 width:100%
}
.categoryHeader.scrollable h4 {
 margin-top:0;
 font-size:18px;
 font-weight:600;
 margin-left:12px
}
@media screen and (max-width:420px) {
 .categoryHeader.scrollable h4 {
  font-size:5.1vw
 }
}
.categoryHeader.scrollable h4#planScrollHead {
 display:block
}
.categoryHeader.scrollable h4#planHead {
 display:none
}
.categoryHeader.scrollable .planTabs {
 display:block
}
.subtext {
 font-size:14px;
 color:#253858;
 padding:0 16px;
 margin:0 0 16px
}
@media screen and (max-width:420px) {
 .subtext {
  font-size:3.8vw
 }
}
.categoryCards {
 margin:0 16px 32px;
 background:#fff;
 border-radius:10px;
 box-shadow:0 0 4px rgba(0,0,0,.16);
 padding:16px 0 24px;
 position:relative
}
.categoryCards img {
 height:72px;
 width:auto;
 display:block;
 margin:0 auto
}
.categoryCards h4 {
 padding:0 8px;
 margin:8px 0 10px;
 font-size:24px
}
.categoryCards h3,
.categoryCards h4 {
 text-align:center;
 font-weight:600;
 color:#253858
}
.categoryCards h3 {
 padding:0 12px;
 font-size:30px;
 line-height:25px
}
.categoryCards h3 strong {
 font-weight:700
}
.categoryCards h3 span {
 font-size:16px;
 font-weight:700
}
@media screen and (max-width:420px) {
 .categoryCards h3 span {
  font-size:4.5vw
 }
}
.categoryCards h3 p {
 font-size:16px;
 color:#6b778c;
 font-weight:400;
 margin-bottom:4px
}
@media screen and (max-width:420px) {
 .categoryCards h3 p {
  font-size:4.5vw
 }
}
.categoryCards h3.expertAdvice strong {
 color:#36b37e
}
.categoryCards .cta {
 padding:0 40px;
 margin:25px 0 0
}
.categoryCards .features {
 border-top:1px solid #dfe1e6;
 margin-top:24px;
 padding:24px 16px 0
}
.categoryCards .features p {
 font-weight:700;
 margin-bottom:8px
}
.categoryCards .features ul li {
 position:relative;
 margin-bottom:12px;
 padding-left:26px
}
.categoryCards .features ul li:last-child {
 margin-bottom:0
}
.categoryCards .features ul li:before {
 content:"";
 width:18px;
 height:18px;
 border-radius:50%;
 border:1px solid #36b37e;
 position:absolute;
 left:0;
 top:3px
}
.categoryCards .features ul li:after {
 content:"";
 width:10px;
 height:5px;
 border:solid #36b37e;
 border-width:0 0 1px 1px;
 position:absolute;
 transform:rotate(-45deg);
 left:4px;
 top:8px
}
.categoryCards .popularTag {
 padding:7px 16px;
 background:#e6fcff;
 border:1px solid #00b8d9;
 color:#00b8d9;
 text-transform:uppercase;
 font-size:12px;
 font-weight:700;
 border-radius:75px;
 position:absolute;
 right:-11px;
 top:-11px
}
@media screen and (max-width:420px) {
 .categoryCards .popularTag {
  font-size:3.2vw
 }
}
.whyPb {
 padding:0 16px
}
.whyPb p {
 font-weight:700;
 margin-bottom:12px
}
.whyPb img {
 width:100%;
 display:block
}
.segmentFooter>div {
 max-width:1170px;
 margin:0 auto!important;
 width:100%;
 padding:0;
 color:#253858;
 text-align:left
}
.segmentFooter .disclaimer {
 line-height:18px;
 text-align:center
}
.segmentFooter .footer-desk-gap {
 margin-top:0
}
.segmentFooter .footer-desk a {
 color:#253858
}
.saveEmail {
 margin-bottom:60px
}
.saveEmail h6 {
 font-size:18px
}
.saveEmail p {
 margin-top:5px;
 font-size:16px
}
@media screen and (max-width:420px) {
 .saveEmail p {
  font-size:4.5vw
 }
}
.saveEmail button {
 width:100%;
 height:48px;
 -webkit-appearance:none;
 background:transparent;
 color:#253858!important;
 font-size:16px;
 font-weight:600;
 text-transform:uppercase;
 border:1px solid #253858;
 box-shadow:none;
 border-radius:4px;
 font-family:-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Oxygen-Sans,Ubuntu,Cantarell,Helvetica Neue,sans-serif;
 margin-top:16px;
 text-align:left;
 padding:0 16px;
 position:relative;
 outline:none;
 cursor:pointer
}
.saveEmail button .callIcon,
.saveEmail button .mailIcon {
 position:absolute;
 right:16px;
 top:50%;
 transform:translateY(-50%)
}
.saveEmail button:hover {
 color:#253858!important
}
.mailIcon {
 width:18px;
 height:14px;
 position:relative;
 background:url(https://static.pbcdn.in/health-cdn/images/insurer-logo/quotes-logos/segment_miscIcons.svg) no-repeat -9px -47px
}
.callIcon {
 width:20px;
 height:20px;
 position:relative;
 background:url(https://static.pbcdn.in/health-cdn/images/insurer-logo/quotes-logos/segment_miscIcons.svg) no-repeat -8px -90px
}
.loadAnimation {
 animation:slideIn .5s ease-out forwards
}
@keyframes slideIn {
 0% {
  transform:translateX(100%)
 }
 to {
  transform:translateX(0)
 }
}
@media only screen and (min-width:1024px) {
 .loadAnimation {
  animation:none
 }
 .segmentWrapper .segmentContainerDesktop {
  display:flex;
  justify-content:space-between
 }
 .segmentWrapper .desktopLeftCol {
  width:calc(100% - 356px)
 }
 .segmentWrapper .desktopRightCol {
  width:336px
 }
 .categoryHeader {
  margin-top:30px;
  padding:0;
  display:flex;
  flex-direction:column
 }
 .categoryHeader .back {
  display:none
 }
 .categoryHeader h4 {
  font-size:24px;
  margin-top:0
 }
 .categoryHeader h4#planScrollHead {
  display:none
 }
 .categoryHeader .planTabs {
  display:none;
  position:fixed;
  background:#fff;
  left:0;
  width:100%;
  top:57px;
  z-index:9;
  margin:0;
  height:58px;
  box-shadow:0 2px 3px rgba(0,0,0,.16)
 }
 .categoryHeader .planTabs>div {
  max-width:1170px;
  margin:0 auto;
  display:flex;
  justify-content:space-between;
  align-items:center
 }
 .categoryHeader .planTabs ul {
  font-size:0;
  padding:0 15px
 }
 .categoryHeader .planTabs ul li a {
  font-size:16px;
  padding:17px 16px
 }
}
@media only screen and (min-width:1024px) and (max-width:420px) {
 .categoryHeader .planTabs ul li a {
  font-size:4.5vw
 }
}
@media only screen and (min-width:1024px) {
 .categoryHeader .planTabs ul li.active a:after {
  height:4px
 }
 .categoryHeader .planTabs .shareIcon {
  position:static
 }
 .categoryHeader.scrollable {
  background:transparent;
  box-shadow:none;
  padding:0
 }
 .categoryHeader.scrollable .categoryHeaderTopBar {
  height:auto;
  width:100%;
  display:none
 }
 .categoryHeader.scrollable h4 {
  margin-top:0;
  font-size:24px;
  font-weight:700;
  margin-left:0
 }
 .categoryHeader.scrollable h4#planScrollHead {
  display:block
 }
 .categoryHeader.scrollable h4#planHead {
  display:none
 }
 .categoryHeader.scrollable .planTabs {
  display:block
 }
 .subtext {
  font-size:16px;
  padding:0;
  margin:0 0 32px
 }
}
@media only screen and (min-width:1024px) and (max-width:420px) {
 .subtext {
  font-size:4.5vw
 }
}
@media only screen and (min-width:1024px) {
 .categoryCards {
  margin:0 0 24px;
  padding:16px 20px;
  display:flex
 }
 .categoryCards article {
  display:flex;
  flex-direction:column;
  justify-content:center
 }
 .categoryCards article:first-child {
  order:1;
  width:160px
 }
 .categoryCards article:nth-child(2) {
  order:3;
  width:182px
 }
 .categoryCards article:nth-child(3) {
  order:2
 }
 .categoryCards h4 {
  font-size:18px;
  margin-bottom:0
 }
}
@media only screen and (min-width:1024px) and (max-width:420px) {
 .categoryCards h4 {
  font-size:5.1vw
 }
}
@media only screen and (min-width:1024px) {
 .categoryCards .cta {
  padding:0;
  margin:12px 0 0
 }
 .categoryCards .features {
  width:calc(100% - 388px);
  margin:0 20px 0 26px;
  border-top:none;
  border-right:1px solid #dfe1e6;
  padding:0 56px 0 0
 }
 .categoryCards img {
  margin:0
 }
 .whyPb {
  padding:0
 }
 .whyPb p {
  display:none
 }
 .whyPb img {
  border-radius:8px;
  box-shadow:0 0 4px rgba(0,0,0,.16)
 }
 .saveEmail {
  display:flex;
  padding:0 185px 20px;
  justify-content:space-between;
  border-bottom:1px solid #dfe1e6;
  margin-bottom:32px
 }
 .saveEmail p {
  font-size:14px;
  font-weight:600
 }
}
@media only screen and (min-width:1024px) and (max-width:420px) {
 .saveEmail p {
  font-size:3.8vw
 }
}
@media only screen and (min-width:1024px) {
 .saveEmail>div {
  width:calc(100% - 325px)
 }
 .saveEmail button {
  width:250px;
  margin-top:0
 }
 .segmentFooter {
  padding:24px 0
 }
 .segmentFooter>div {
  padding:10px 15px;
  text-align:center
 }
 .segmentHeader {
  position:sticky;
  top:0;
  z-index:10;
  box-shadow:0 3px 6px rgba(0,0,0,.16)
 }
}
.plansCard {
 padding:8px 12px 12px
}
.plansCard,
.plansCard .insurer_plan {
 margin-bottom:20px
}
.plansCard .insurer_plan .insurerLogo {
 margin-bottom:8px
}
.plansCard .insurer_plan .insurerLogo img {
 max-width:120px;
 height:auto;
 margin:0
}
.plansCard .insurer_plan h6 {
 font-size:18px;
 font-weight:700;
 color:#253858
}
.plansCard .viewMoreFeatures {
 margin-top:12px;
 padding-left:26px;
 margin-bottom:0!important
}
.plansCard .ctaBar {
 border-top:1px solid #dfe1e6;
 padding-top:12px;
 margin-top:24px;
 display:flex;
 justify-content:space-between;
 align-items:center
}
.plansCard .ctaBar .premiumColumn {
 font-size:14px;
 font-weight:400;
 color:#6b778c;
 line-height:22px
}
@media screen and (max-width:420px) {
 .plansCard .ctaBar .premiumColumn {
  font-size:3.8vw
 }
}
.plansCard .ctaBar .premiumColumn span {
 display:block;
 font-size:24px;
 font-weight:600;
 color:#253858
}
.plansCard .ctaBar .premiumColumn span strong {
 font-weight:700
}
.plansCard .ctaBar .premiumColumn span em {
 font-style:normal;
 font-size:12px
}
@media screen and (max-width:420px) {
 .plansCard .ctaBar .premiumColumn span em {
  font-size:3.2vw
 }
}
.plansCard .ctaBar .buy {
 width:160px
}
.planFeatures {
 border-top:none!important;
 margin-top:0!important;
 padding:0!important
}
.planFeatures ul li {
 font-size:14px;
 margin-bottom:12px
}
@media screen and (max-width:420px) {
 .planFeatures ul li {
  font-size:3.8vw
 }
}
.planFeatures ul li:before {
 top:2px!important
}
.planFeatures ul li:after {
 top:7px!important
}
.planFeatures ul li.featured {
 font-weight:600
}
.planFeatures ul li.featured:after {
 content:none
}
.planFeatures ul li.featured:before {
 background:url(https://static.pbcdn.in/health-cdn/images/insurer-logo/quotes-logos/segment_miscIcons.svg) no-repeat -9px 0;
 width:18px;
 height:17px;
 border:none;
 border-radius:0
}
.viewAllPlans {
 margin:32px 16px
}
.linkGreenArrow {
 font-size:14px;
 font-weight:600;
 text-transform:uppercase;
 color:#36b37e
}
@media screen and (max-width:420px) {
 .linkGreenArrow {
  font-size:3.8vw
 }
}
.linkGreenArrow:after {
 content:"";
 border:solid #36b37e;
 border-width:0 1px 1px 0;
 display:inline-block;
 padding:2px;
 transform:rotate(-45deg);
 vertical-align:middle;
 margin-left:6px;
 position:relative;
 top:-1px
}
.linkGreenArrow:hover {
 color:#36b37e
}
.progressSaved {
 height:24px;
 background:#97a0af;
 position:relative;
 text-align:center;
 overflow:hidden;
 animation:hideProgressBar 0s ease-in-out 4s forwards
}
.progressSaved .bar {
 position:absolute;
 left:0;
 height:100%;
 width:0;
 background:#253858;
 animation:progressBar 3s ease-in-out forwards
}
.progressSaved:before {
 content:"Your progress is being saved";
 font-size:12px;
 font-weight:700;
 color:#fff;
 position:absolute;
 z-index:2;
 left:50%;
 top:50%;
 transform:translate(-50%,-50%);
 animation:progressTxt 0s ease-in-out 1s forwards
}
@media screen and (max-width:420px) {
 .progressSaved:before {
  font-size:3.2vw
 }
}
@keyframes progressBar {
 0% {
  width:0
 }
 to {
  width:100%
 }
}
@keyframes progressTxt {
 0% {
  content:"Your progress is being saved"
 }
 to {
  content:"Your progress has been saved"
 }
}
@keyframes hideProgressBar {
 0% {
  height:24px
 }
 to {
  height:0
 }
}
.toastMessages {
 background:#fff7d5;
 border-radius:34px;
 padding:16px;
 box-shadow:0 2px 4px rgba(0,0,0,.16),0 12px 28px rgba(0,0,0,.16);
 display:flex;
 position:fixed;
 left:50%;
 transform:translateX(-50%);
 width:90%;
 z-index:9;
 animation:showToast .3s ease-out 1s forwards,hideToast .3s ease-out 6s forwards
}
.toastMessages i {
 width:36px;
 height:36px;
 background:url(https://static.pbcdn.in/health-cdn/images/insurer-logo/quotes-logos/segment_miscIcons.svg) no-repeat 0 -241px;
 background-size:cover
}
.toastMessages .msg {
 width:calc(100% - 46px);
 margin-left:10px;
 font-size:14px;
 font-weight:600
}
@media screen and (max-width:420px) {
 .toastMessages .msg {
  font-size:3.8vw
 }
}
.toastMessages .msg strong {
 font-weight:700
}
@keyframes showToast {
 0% {
  bottom:0;
  opacity:0
 }
 to {
  bottom:20px;
  opacity:1
 }
}
@keyframes hideToast {
 0% {
  bottom:20px;
  opacity:1
 }
 to {
  bottom:0;
  opacity:0
 }
}
.claim_popup_main {
 bottom:0
}
.claim_popup_main .cross_features_popup {
 position:absolute;
 right:0;
 top:0
}
@keyframes featureSlideAnim {
 0% {
  transform:translateY(100%)
 }
 to {
  transform:translateY(0)
 }
}
@media only screen and (min-width:1024px) {
 .viewAllPlans {
  margin:40px auto;
  max-width:328px
 }
 .plansCard {
  margin:0 0 24px!important;
  padding:16px 20px!important;
  display:flex!important
 }
 .plansCard .insurer_plan {
  order:1!important
 }
 .plansCard .planFeatures {
  order:2!important;
  width:calc(100% - 388px)!important;
  margin:0 20px 0 26px;
  border-top:none;
  border-right:1px solid #dfe1e6;
  padding:0 56px 0 0!important
 }
 .plansCard .ctaBar {
  order:3!important;
  border-top:none;
  padding-top:0;
  margin-top:0;
  width:182px;
  justify-content:center
 }
 .plansCard .ctaBar .buy {
  width:100%;
  margin-top:12px
 }
 .plansCard .ctaBar .premiumColumn {
  text-align:center
 }
 .plansCard .ctaBar .premiumColumn span {
  margin-top:4px;
  font-size:30px
 }
 .plansCard .ctaBar .premiumColumn span em {
  font-size:14px
 }
}
@media only screen and (min-width:1024px) and (max-width:420px) {
 .plansCard .ctaBar .premiumColumn span em {
  font-size:3.8vw
 }
}
@media only screen and (min-width:1024px) {
 .plansCard .viewMoreFeatures.hideSmall {
  padding-left:0
 }
 .toastMessages {
  left:16px;
  transform:none;
  width:328px
 }
}
.whyTxt {
 font-size:14px;
 color:#505f79
}
@media screen and (max-width:420px) {
 .whyTxt {
  font-size:3.8vw
 }
}
.whychoosepb {
 margin-top:24px;
 position:relative
}
.whychoosepb li {
 padding-bottom:35px;
 position:relative;
 padding-left:60px;
 font-size:16px;
 font-weight:700
}
@media screen and (max-width:420px) {
 .whychoosepb li {
  font-size:4.5vw
 }
}
.whychoosepb li i {
 position:absolute;
 width:48px;
 height:48px;
 background:#deebff;
 border-radius:50%;
 left:0;
 z-index:2
}
.whychoosepb li i:before {
 content:"";
 position:absolute;
 width:100%;
 height:100%;
 background:url(https://static.pbcdn.in/health-cdn/images/insurer-logo/quotes-logos/segment_whypbSprite.svg) no-repeat;
 background-size:cover
}
.whychoosepb li:first-child i:before {
 background-position:0 0
}
.whychoosepb li:nth-child(2) i:before {
 background-position:0 -48px
}
.whychoosepb li:nth-child(3) i:before {
 background-position:0 -96px
}
.whychoosepb li:nth-child(4) i:before {
 background-position:0 -144px
}
.whychoosepb li span {
 color:#505f79;
 font-size:14px;
 font-weight:400
}
@media screen and (max-width:420px) {
 .whychoosepb li span {
  font-size:3.8vw
 }
}
.whychoosepb:after {
 content:"";
 width:1px;
 height:85%;
 position:absolute;
 background:#b3bac5;
 left:24px;
 top:0;
 z-index:1
}
@media only screen and (min-width:1024px) {
 .whychoosepb li:last-child {
  padding-bottom:0
 }
}
.segment_planTermWrapper .infoTxt {
 font-size:14px;
 color:#505f79;
 margin-bottom:12px
}
@media screen and (max-width:420px) {
 .segment_planTermWrapper .infoTxt {
  font-size:3.8vw
 }
}
.segment_planTermWrapper .termFieldsWrapper {
 margin-bottom:12px
}
.segment_planTermWrapper .termFieldsWrapper .termBlock {
 position:relative;
 margin-bottom:12px
}
.segment_planTermWrapper .termFieldsWrapper .termBlock:last-child {
 margin-bottom:0
}
.segment_planTermWrapper .termFieldsWrapper .termBlock input {
 position:absolute;
 opacity:0;
 visibility:hidden
}
.segment_planTermWrapper .termFieldsWrapper .termBlock label {
 display:flex;
 border:1px solid #b3bac5;
 height:60px;
 border-radius:4px;
 padding:0 12px;
 justify-content:space-between;
 align-items:center;
 transition:all .3s ease-in
}
.segment_planTermWrapper .termFieldsWrapper .termBlock label .radioButton {
 display:flex;
 align-items:center;
 font-size:16px;
 font-weight:600
}
@media screen and (max-width:420px) {
 .segment_planTermWrapper .termFieldsWrapper .termBlock label .radioButton {
  font-size:4.5vw
 }
}
.segment_planTermWrapper .termFieldsWrapper .termBlock label .radioButton .radio {
 width:18px;
 height:18px;
 border:1px solid #97a0af;
 border-radius:50%;
 margin-right:12px;
 position:relative;
 transition:all .3s ease-in
}
.segment_planTermWrapper .termFieldsWrapper .termBlock label .radioButton .radio:before {
 content:"";
 width:8px;
 height:8px;
 border-radius:50%;
 background:#36b37e;
 position:absolute;
 left:50%;
 top:50%;
 transform:translate(-50%,-50%);
 opacity:0;
 transition:all .3s ease-in
}
.segment_planTermWrapper .termFieldsWrapper .termBlock label .premium {
 font-size:16px;
 font-weight:700;
 text-align:right;
 line-height:20px
}
@media screen and (max-width:420px) {
 .segment_planTermWrapper .termFieldsWrapper .termBlock label .premium {
  font-size:4.5vw
 }
}
.segment_planTermWrapper .termFieldsWrapper .termBlock label .premium .save {
 font-weight:600;
 font-size:14px;
 color:#00b8d9;
 display:block
}
@media screen and (max-width:420px) {
 .segment_planTermWrapper .termFieldsWrapper .termBlock label .premium .save {
  font-size:3.8vw
 }
}
.segment_planTermWrapper .termFieldsWrapper .termBlock input:checked+label {
 border-color:#36b37e;
 background:#effcf7
}
.segment_planTermWrapper .termFieldsWrapper .termBlock input:checked+label .radio {
 border-color:#36b37e;
 background:#fff
}
.segment_planTermWrapper .termFieldsWrapper .termBlock input:checked+label .radio:before {
 opacity:1
}
.segment_planTermWrapper .emiOption {
 font-size:14px;
 margin-bottom:18px
}
@media screen and (max-width:420px) {
 .segment_planTermWrapper .emiOption {
  font-size:3.8vw
 }
}
.segment_planTermWrapper .emiOption a {
 display:block
}
.segment_planTermWrapper .segment_benefitsToggle {
 position:relative;
 margin-bottom:16px
}
.segment_planTermWrapper .segment_benefitsToggle input {
 position:absolute;
 opacity:0;
 visibility:hidden
}
.segment_planTermWrapper .segment_benefitsToggle label {
 display:block;
 font-size:14px
}
@media screen and (max-width:420px) {
 .segment_planTermWrapper .segment_benefitsToggle label {
  font-size:3.8vw
 }
}
.segment_planTermWrapper .segment_benefitsToggle label:after {
 content:"";
 border:solid #253858;
 border-width:0 2px 2px 0;
 display:inline-block;
 padding:3px;
 transform:rotate(45deg);
 vertical-align:middle;
 position:relative;
 top:-2px;
 margin-left:8px;
 transition:all .3s ease-out
}
.segment_planTermWrapper .segment_benefitsToggle ul {
 margin-top:12px;
 transition:all .3s ease-in;
 display:none
}
.segment_planTermWrapper .segment_benefitsToggle ul li {
 position:relative;
 padding-left:16px;
 margin-bottom:8px;
 font-size:14px
}
@media screen and (max-width:420px) {
 .segment_planTermWrapper .segment_benefitsToggle ul li {
  font-size:3.8vw
 }
}
.segment_planTermWrapper .segment_benefitsToggle ul li:before {
 content:"";
 width:6px;
 height:6px;
 background:#7a869a;
 border-radius:50%;
 position:absolute;
 left:0;
 top:8px
}
.segment_planTermWrapper .segment_benefitsToggle input:checked+label:after {
 transform:rotate(-135deg);
 top:2px
}
.segment_planTermWrapper .segment_benefitsToggle input:checked~ul {
 display:block
}
.segment_planTermWrapper .term_button {
 position:relative
}
.segment_planTermWrapper .term_button .loader_btn:before {
 top:10px
}
.shareOptionsWrapper {
 margin-top:24px
}
.shareOptionsWrapper .shareMsg {
 display:flex;
 justify-content:space-between;
 align-items:center;
 border-bottom:1px solid #dfe1e6;
 padding-bottom:22px;
 margin-bottom:32px
}
.shareOptionsWrapper .shareMsg .infoTxt {
 width:220px;
 word-break:break-all;
 font-size:14px
}
@media screen and (max-width:420px) {
 .shareOptionsWrapper .shareMsg .infoTxt {
  font-size:3.8vw
 }
}
.shareOptionsWrapper .shareMsg .infoTxt span {
 display:-webkit-box;
 -webkit-box-orient:vertical;
 -webkit-line-clamp:1;
 overflow:hidden;
 height:fit-content
}
.shareOptionsWrapper .shareMsg .copyIcon {
 width:32px;
 font-size:10px;
 color:#6b778c;
 text-align:center;
 cursor:pointer
}
.shareOptionsWrapper .shareMsg .copyIcon i {
 width:24px;
 height:24px;
 background:url(https://static.pbcdn.in/health-cdn/images/insurer-logo/quotes-logos/segment_miscIcons.svg) no-repeat -6px -193px;
 display:block;
 margin:0 auto 6px
}
.shareOptionsWrapper .shareOptions {
 display:flex;
 margin-bottom:10px
}
.shareOptionsWrapper .shareOptions li {
 font-size:14px;
 display:flex;
 flex-direction:column;
 margin-right:40px;
 text-align:center;
 cursor:pointer
}
@media screen and (max-width:420px) {
 .shareOptionsWrapper .shareOptions li {
  font-size:3.8vw
 }
}
.shareOptionsWrapper .shareOptions li:last-child {
 margin-right:0
}
.shareOptionsWrapper .shareOptions li i {
 width:48px;
 height:48px;
 margin:0 auto 10px
}
.shareOptionsWrapper .shareOptions li i.whatsapp {
 background:url(https://static.pbcdn.in/health-cdn/images/insurer-logo/quotes-logos/segment_whatsappIcon.svg) no-repeat 50%
}
.shareOptionsWrapper .shareOptions li i.email {
 background:url(https://static.pbcdn.in/health-cdn/images/insurer-logo/quotes-logos/segment_gmailIcon.svg) no-repeat 50%
}
@media only screen and (min-width:1024px) {
 .shareOptionsWrapper .shareOptions li:first-child {
  display:none
 }
}
.shareHeading img {
 vertical-align:middle;
 margin-right:12px
}
.share_infotxt {
 font-size:14px;
 margin-bottom:16px
}
@media screen and (max-width:420px) {
 .share_infotxt {
  font-size:3.8vw
 }
}
.fieldBlock {
 margin-top:20px;
 margin-bottom:20px
}
.fieldBlock .field {
 position:relative
}
.fieldBlock .field input {
 width:100%;
 -webkit-appearance:none;
 outline:none;
 height:100%;
 font-size:16px;
 color:#253858;
 padding:16px;
 font-weight:600;
 background:#fff;
 border:1px solid #5e6c84;
 border-radius:4px;
 height:56px
}
@media screen and (max-width:420px) {
 .fieldBlock .field input {
  font-size:4.5vw
 }
}
.fieldBlock .field label {
 position:absolute;
 font-size:16px;
 color:#5e6c84;
 top:50%;
 left:8px;
 transform:translateY(-50%);
 transition:all .3s ease-in;
 background:#fff;
 padding:0 8px
}
@media screen and (max-width:420px) {
 .fieldBlock .field label {
  font-size:4.5vw
 }
}
.fieldBlock .field input:focus+label,
.fieldBlock .field input:valid+label {
 font-size:12px;
 transform:none;
 top:-10px;
 color:#253858;
 letter-spacing:normal
}
@media screen and (max-width:420px) {
 .fieldBlock .field input:focus+label,
 .fieldBlock .field input:valid+label {
  font-size:3.2vw
 }
}
.callScheduleWrapper {
 margin-top:20px
}
.callScheduleWrapper .callScheduleTabs {
 margin-bottom:16px
}
.callScheduleWrapper .callScheduleTabs>ul {
 list-style:none;
 border-bottom:1px solid rgba(37,56,88,.3)
}
.callScheduleWrapper .callScheduleTabs>ul>li {
 position:relative;
 display:inline-block;
 margin-right:30px;
 padding-bottom:10px
}
.callScheduleWrapper .callScheduleTabs>ul>li:last-child {
 margin-right:0
}
.callScheduleWrapper .callScheduleTabs>ul>li input {
 position:absolute;
 opacity:0
}
.callScheduleWrapper .callScheduleTabs>ul>li input+label {
 font-size:14px;
 color:#253858;
 font-weight:400;
 text-transform:uppercase;
 cursor:pointer;
 position:relative;
 transition:all .3s ease-in;
 -webkit-tap-highlight-color:transparent
}
@media screen and (max-width:420px) {
 .callScheduleWrapper .callScheduleTabs>ul>li input+label {
  font-size:3.8vw
 }
}
.callScheduleWrapper .callScheduleTabs>ul>li input:checked+label {
 color:#253858;
 font-weight:700
}
.callScheduleWrapper .callScheduleTabs>ul>li input:checked+label:after {
 content:"";
 position:absolute;
 height:2px;
 width:100%;
 background:#253858;
 bottom:-14px;
 left:0
}
.callScheduleWrapper .callScheduleTabsContent>ul {
 list-style:none;
 font-size:0;
 white-space:nowrap;
 overflow:auto;
 margin-bottom:20px;
 -ms-overflow-style:none;
 scrollbar-width:none
}
.callScheduleWrapper .callScheduleTabsContent>ul::-webkit-scrollbar {
 display:none
}
.callScheduleWrapper .callScheduleTabsContent>ul>li {
 position:relative;
 display:inline-block
}
.callScheduleWrapper .callScheduleTabsContent>ul>li input {
 position:absolute;
 opacity:0
}
.callScheduleWrapper .callScheduleTabsContent>ul>li input+label {
 padding:8px 16px;
 border:1px solid #253858;
 display:inline-block;
 border-radius:4px;
 font-size:14px;
 text-align:center;
 color:#253858;
 transition:all .3s ease-in;
 position:relative;
 background:#fff;
 margin:3px 5px
}
@media screen and (max-width:420px) {
 .callScheduleWrapper .callScheduleTabsContent>ul>li input+label {
  font-size:3.8vw
 }
}
.callScheduleWrapper .callScheduleTabsContent>ul>li input+label span {
 transition:all .3s ease-in
}
.callScheduleWrapper .callScheduleTabsContent>ul>li input:checked+label {
 border-color:#36b37e;
 color:#36b37e;
 background:#f2fffa;
 font-weight:600
}
.callScheduleWrapper .callScheduleTabsContent>ul>li:first-child label {
 margin-left:0
}
body.modal_open {
 overflow:hidden;
 position:fixed
}
button,
button:active,
button:hover {
 color:#fff!important
}
.compare_parent h1,
.compare_parent h2 {
 color:#212121
}
.compare_parent .top_fixed_box {
 background-color:#f4f5f7;
 padding-top:35px;
 color:#253858;
 border-radius:8px 8px 0 0;
 -webkit-box-shadow:0 2px 13px 0 hsla(0,0%,62.7%,.8);
 -moz-box-shadow:0 2px 13px 0 hsla(0,0%,62.7%,.8);
 box-shadow:0 2px 13px 0 hsla(0,0%,62.7%,.8)
}
.top_fixed_box img {
 margin-left:0
}
.top_fixed_box .column.add_plan {
 padding-bottom:10px
}
.back_btn {
 width:223px;
 height:41px;
 border-radius:8px;
 box-shadow:none;
 border:none;
 background-color:transparent;
 font-size:16px;
 font-family:Nunito,sans-serif;
 top:-2px!important;
 justify-content:inherit;
 padding-left:27px!important
}
.back_btn,
.top_fixed_box a {
 font-weight:400;
 color:#253858
}
.top_fixed_box a {
 font-size:15px;
 padding-left:5px;
 position:relative;
 top:-30px;
 text-decoration:none
}
.top_fixed_box p {
 font-size:16px;
 font-weight:600;
 padding-bottom:10px
}
.top_fixed_box .column {
 text-align:center;
 padding-bottom:10px
}
.difference_column button {
 width:223px;
 height:41px;
 border-radius:7px;
 background-color:#ff5630;
 font-size:14px;
 font-weight:600;
 color:#fff;
 border:none
}
.difference_column button .fa-rupee-sign {
 position:relative;
 left:-5px
}
.difference_column button .fa-arrow-right {
 position:relative;
 left:35px
}
.difference_column select {
 width:274px;
 height:41px!important;
 border-radius:4px;
 font-size:14px;
 color:#6b6767;
 border:none;
 padding-left:10px;
 display:block;
 background-color:#fff;
 margin-bottom:10px;
 font-family:Nunito,sans-serif;
 background-image:url("data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTQiIGhlaWdodD0iNyIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cGF0aCBkPSJNMTIuMjczIDBMMTMgLjc1NSA3IDcgMSAuNzU1IDEuNzI0IDAgNyA1LjQ4N3oiIGZpbGw9IiM3RjgxODUiIHN0cm9rZT0iIzdGODE4NSIgZmlsbC1ydWxlPSJldmVub2RkIi8+PC9zdmc+");
 -webkit-appearance:none;
 -moz-appearance:none;
 appearance:none;
 background-repeat:no-repeat;
 background-position:97% 17px;
 padding-right:23px
}
.difference_column .column {
 padding:0 0 27px;
 position:relative
}
.difference_column .column picture {
 display:block;
 height:40px
}
.checkbox_custm {
 transition:.24s;
 position:absolute;
 top:0;
 left:-26px;
 border-radius:4px;
 height:24px;
 width:24px;
 background:#fff;
 box-shadow:0 0 2px 0 rgba(0,0,0,.4)
}
.checkbox_label {
 position:absolute;
 cursor:pointer;
 top:121px;
 left:20%;
 text-transform:capitalize
}
.checkbox_label input {
 visibility:hidden
}
.checkbox_custm:after {
 content:"";
 position:absolute;
 display:none
}
.checkbox_label input:checked~.checkbox_custm:after {
 display:block;
 -webkit-transform:rotate(45deg);
 transform:rotate(45deg);
 position:absolute;
 border-spacing:0;
 border:2px solid #fff;
 border-top:0;
 border-left:0;
 content:"";
 height:15px;
 left:9px;
 top:3px;
 width:7px
}
.checkbox_label input:checked~.checkbox_custm {
 background:#36b37e
}
.checkbox_label .checkbox_custm:after {
 left:9px;
 top:5px;
 width:5px;
 height:10px;
 border:solid #fff;
 border-width:0 3px 3px 0;
 -webkit-transform:rotate(45deg);
 -ms-transform:rotate(45deg);
 transform:rotate(45deg)
}
.top_fixed_box a:hover,
.top_fixed_box button:hover {
 color:#253858
}
.top_fixed_box .add_plan a {
 border:1px solid #fff;
 border-radius:50%
}
.top_fixed_box .add_plan .plus-icon,
.top_fixed_box .add_plan a {
 top:4px;
 text-decoration:none;
 font-size:32px;
 padding:0;
 width:64px;
 height:64px;
 display:inline-block;
 text-align:center;
 align-items:center
}
.top_fixed_box .add_plan .plus-icon {
 border:1px solid #ff5630;
 border-radius:50%
}
.top_fixed_box .add_plan .plus-icon span {
 position:relative;
 top:3px;
 color:#ff5630
}
.top_fixed_box .add_plan p {
 margin-top:18px
}
.top_fixed_box .fa-angle-left {
 position:absolute;
 left:19px;
 font-size:28px
}
.content_section {
 padding:0;
 background:#fff;
 border-radius:8px;
 border-top-left-radius:0;
 box-shadow:0 2px 13px 0 hsla(0,0%,62.7%,.5);
 border-top-right-radius:0;
 width:100%;
 float:left;
 margin-bottom:0
}
.content_section .columns {
 padding:0;
 margin:0
}
.green_background {
 background-color:#dfe1e6;
 font-size:16px;
 color:#253858;
 font-weight:600
}
.green_background select {
 background-color:transparent;
 border:none;
 font-size:20px;
 color:#253858;
 font-weight:600;
 font-family:Nunito,sans-serif;
 background-image:url("data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTQiIGhlaWdodD0iNyIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cGF0aCBkPSJNMTIuMjczIDBMMTMgLjc1NSA3IDcgMSAuNzU1IDEuNzI0IDAgNyA1LjQ4N3oiIGZpbGw9IiMyNTM4NTgiIGZpbGwtcnVsZT0ibm9uemVybyIgc3Ryb2tlPSIjMjUzODU4Ii8+PC9zdmc+");
 -webkit-appearance:none;
 -moz-appearance:none;
 appearance:none;
 background-repeat:no-repeat;
 background-position:100% 10px;
 padding-right:23px;
 padding-left:10px
}
.grey_background {
 background-color:#dfe1e6;
 text-align:left!important;
 color:#253858;
 font-size:16px;
 font-weight:600;
 border-radius:0
}
.content_section .column {
 border-left:1px solid #eeeef0;
 text-align:center;
 border-bottom:1px solid #eeeef0;
 position:relative
}
.content_section .column p {
 font-size:13px;
 font-weight:400;
 margin-bottom:45px;
 color:#505f79;
 text-align:left
}
.content_section .columns .column:first-child {
 text-align:left
}
.content_section .column p.subtitle {
 color:#253858;
 font-size:14px;
 font-weight:600;
 margin:0!important
}
.content_section .columns .column:first-child a {
 font-size:12px;
 text-decoration:underline;
 color:#253858;
 position:relative;
 top:-6px
}
.content_section ul.progress_bar {
 width:93%;
 height:40px;
 margin-top:10px;
 border-radius:2px;
 background-color:#f4f5f7;
 position:absolute;
 left:3%;
 bottom:10px
}
.content_section .column p span {
 display:block;
 font-size:25px;
 font-weight:400;
 text-align:center
}
.content_section ul.progress_bar li {
 width:20%;
 padding:15px 6px;
 float:left
}
.content_section ul.progress_bar li span {
 width:100%;
 float:left;
 background:#ccd2d8;
 height:10px;
 position:relative;
 border-radius:2px;
 border:1px solid #ccd2d8
}
.content_section ul.progress_bar li.green span:before {
 content:"";
 background-color:#36b37e;
 position:absolute;
 height:10px;
 left:-2px;
 width:110%;
 border-radius:2px;
 top:-1px
}
.content_section ul.progress_bar li.yellow span:before {
 background-color:#ffab00
}
.content_section ul.progress_bar li.red span:before {
 background-color:#ff5630
}
.content_section ul.progress_bar li.green.half span:before {
 width:57%;
 border-radius:2px 0 0 2px
}
.content_section .column a {
 color:#36b37e;
 font-size:14px;
 text-decoration:underline
}
.subtitle_h1 {
 font-size:24px;
 color:#212121;
 font-weight:400
}
.title_h2 {
 margin-bottom:30px;
 position:relative;
 font-weight:600;
 font-size:24.3px;
 color:#212121
}
.title_h2 span:before {
 content:"";
 position:absolute;
 bottom:-6px;
 width:60px;
 height:3px;
 background:#f8e71c
}
.similar_plan_ul {
 width:100%;
 float:left;
 padding:0;
 list-style:none;
 margin-top:22px
}
.similar_plan_ul li {
 width:100%;
 float:left;
 background:#fff;
 border-radius:8px;
 padding:10px 0 20px;
 box-shadow:0 4px 16px -7px #565555;
 min-height:332px;
 text-align:center
}
.similar_plan_ul li:nth-child(2) {
 margin:0 2%;
 cursor:pointer
}
.similar_plans {
 padding:30px 30px 20px;
 width:100%;
 float:left;
 background-color:#f4f5f7
}
.similar_plans h3 {
 font-size:16px;
 color:#253858;
 font-weight:600
}
.similar_plans h4 {
 font-size:14px;
 color:#253858;
 font-weight:600
}
.similar_plan_ul span {
 display:block;
 font-size:14px;
 font-weight:600
}
.similar_plan_ul p {
 background-color:#f7f7f7;
 min-height:38px;
 font-size:16px;
 color:#253858;
 font-weight:600;
 line-height:38px
}
.similar_plan_ul ul {
 width:100%;
 float:left;
 padding:28px 0 10px
}
.similar_plan_ul ul li {
 width:50%;
 float:left;
 font-size:22px;
 font-weight:400;
 color:#253858;
 min-height:auto;
 margin:0!important;
 border-radius:0;
 box-shadow:none;
 padding:0
}
.similar_plan_ul ul li:first-child {
 border-right:1px solid #e0e0e0
}
.similar_plan_ul ul li span {
 display:block;
 font-size:13px;
 color:#253858;
 font-weight:700
}
.similar_plan_ul h6 {
 font-size:15px;
 font-weight:600;
 color:#253858
}
.similar_plan_ul button {
 width:223px;
 height:41px;
 font-size:15px;
 margin-top:18px;
 font-family:Nunito,sans-serif;
 font-weight:500;
 line-height:29px;
 border-radius:7px;
 background-color:#fff;
 border:1px solid #ff5630!important;
 color:#ff5630!important
}
.similar_plan_ul button.disabled {
 background-color:#fff;
 border:1px solid #cacaca!important;
 color:#cacaca!important;
 cursor:not-allowed
}
.similar_plan_ul button .fa-plus {
 position:relative;
 left:-10px;
 top:-1px
}
.navbarWrapper {
 background-color:#fff
}
.navbar {
 position:relative;
 z-index:unset;
 min-height:57px;
 width:100%
}
.navbar,
.navbar_shortlist {
 max-width:1170px;
 margin:0 auto
}
.navbar_shortlist {
 border-top:1px solid #e6efff
}
.shortlist_plan_bar {
 height:57px;
 padding-top:15px;
 max-width:1170px;
 margin:0 auto
}
.heading_Shortlist {
 font-size:20px;
 font-weight:500;
 color:var(--dark-grey-blue);
 cursor:pointer
}
.claim-link {
 font-weight:600;
 font-size:14px;
 color:#0065ff;
 background:url("data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTciIGhlaWdodD0iMTYiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGcgZmlsbD0iIzAwNjVGRiIgZmlsbC1ydWxlPSJub256ZXJvIj48cGF0aCBkPSJNMTYuNjM3IDEyLjY1YTEuNDY0IDEuNDY0IDAgMDAtLjU3MS0uNzQ3IDEuMTYyIDEuMTYyIDAgMDAtMS4wMTUtLjEyMmwtMy41NzMuOTFjLjE0OC0uNjIyLS4xMDgtMS4xODktLjY1OC0xLjM5N2EuMzkuMzkgMCAwMC0uMDQ1LS4wMTRsLTQuNDMtMS4wODNhMy4yNTggMy4yNTggMCAwMC0yLjAyMi4xNmwtLjg5OC4zNzd2LS41MzJhLjM4Ni4zODYgMCAwMC0uMzg3LS4zODRILjM4OGEuMzg2LjM4NiAwIDAwLS4zODguMzg0djUuMjY5YzAgLjIxMi4xNzQuMzg0LjM4OC4zODRoMi42NWEuMzg2LjM4NiAwIDAwLjM4Ny0uMzg0di0uMjFsLjg2Ny0uMDk4YTMuNjY4IDMuNjY4IDAgMDExLjE1Ny4wNTNsMy4zNTUuNjkyYTQuNDUyIDQuNDUyIDAgMDAyLjE5Mi0uMDk5bDQuOTE4LTEuNDlhLjM5Ni4zOTYgMCAwMC4wMTUtLjAwNWMuNzU5LS4yNjMuOTMtMS4wMzcuNzA4LTEuNjY1ek0yLjY1IDE1LjA4NkguNzc2di00LjVIMi42NXY0LjV6bTEzLjAyOS0xLjVsLTQuOTEgMS40ODhhMy42ODMgMy42ODMgMCAwMS0xLjgwNy4wODJsLTMuMzU0LS42OTNhNC40NSA0LjQ1IDAgMDAtMS40MDUtLjA2M2wtLjc3OC4wODh2LTIuOTJsMS4yLS41MDVhMi40NyAyLjQ3IDAgMDExLjUzNS0uMTIybDQuNDAyIDEuMDc3Yy4zMDUuMTM1LjEzMi41OTUuMTI0LjYxNWEuNzExLjcxMSAwIDAxLS4yNTIuMzM4LjI3OC4yNzggMCAwMS0uMjY2LjAzNC4zOTQuMzk0IDAgMDAtLjA1Mi0uMDE3bC0yLjQ1Mi0uNmEuMzg0LjM4NCAwIDEwLS4xODYuNzQ2bDIuNDMuNTk0Yy4xMjEuMDQzLjI0My4wNjQuMzYzLjA2NC4xOSAwIC4zNzItLjA1Mi41MzgtLjE0OGEuMzkzLjM5MyAwIDAwLjA4LS4wMTJsNC4zNy0xLjExMmEuMzk3LjM5NyAwIDAwLjAzMi0uMDEuMzgyLjM4MiAwIDAxLjM1Mi4wMzYuNzA0LjcwNCAwIDAxLjI2Mi4zNTZjLjAyLjA1NS4xNzguNTM5LS4yMjYuNjg0ek05LjA5IDBhMi4xODQgMi4xODQgMCAwMC0yLjE4IDIuMTgyYzAgMS4yMDMuOTc4IDIuMTgyIDIuMTggMi4xODJhMi4xODQgMi4xODQgMCAwMDIuMTgzLTIuMTgyQTIuMTg0IDIuMTg0IDAgMDA5LjA5IDB6bTAgMy41NzdjLS43NjkgMC0xLjM5NS0uNjI2LTEuMzk1LTEuMzk1IDAtLjc3LjYyNi0xLjM5NiAxLjM5Ni0xLjM5Ni43NyAwIDEuMzk1LjYyNiAxLjM5NSAxLjM5NiAwIC43Ny0uNjI2IDEuMzk1LTEuMzk1IDEuMzk1ek0xMy44MTggMy4yNzNhMi4xODQgMi4xODQgMCAwMC0yLjE4MiAyLjE4MmMwIDEuMjAzLjk4IDIuMTgxIDIuMTgyIDIuMTgxQTIuMTg0IDIuMTg0IDAgMDAxNiA1LjQ1NWEyLjE4NCAyLjE4NCAwIDAwLTIuMTgyLTIuMTgyem0wIDMuNTc3Yy0uNzcgMC0xLjM5NS0uNjI2LTEuMzk1LTEuMzk1IDAtLjc3LjYyNi0xLjM5NiAxLjM5NS0xLjM5Ni43NyAwIDEuMzk2LjYyNiAxLjM5NiAxLjM5NiAwIC43Ny0uNjI2IDEuMzk1LTEuMzk2IDEuMzk1ek05LjA5IDUuNDU1YTIuMTg0IDIuMTg0IDAgMDAtMi4xOCAyLjE4MWMwIDEuMjAzLjk3OCAyLjE4MiAyLjE4IDIuMTgyYTIuMTg0IDIuMTg0IDAgMDAyLjE4My0yLjE4MkEyLjE4NCAyLjE4NCAwIDAwOS4wOSA1LjQ1NXptMCAzLjU3N2MtLjc2OSAwLTEuMzk1LS42MjYtMS4zOTUtMS4zOTYgMC0uNzcuNjI2LTEuMzk1IDEuMzk2LTEuMzk1Ljc3IDAgMS4zOTUuNjI2IDEuMzk1IDEuMzk1IDAgLjc3LS42MjYgMS4zOTYtMS4zOTUgMS4zOTZ6Ii8+PC9nPjwvc3ZnPg==") 3px 18px no-repeat;
 text-transform:none;
 padding:18px 0 18px 31px;
 width:179px
}
.cart-link {
 padding:0;
 height:21px;
 margin-top:16px;
 width:62px
}
.callUsWrapper,
.callUsWrapper .toll-link {
 position:relative;
 display:flex
}
.callUsWrapper .toll-link {
 padding-left:32px;
 text-align:right;
 color:#253858;
 font-weight:600;
 font-size:12px;
 align-items:center
}
.callUsWrapper .toll-link:before {
 content:"";
 width:17px;
 height:18px;
 margin-right:8px;
 background:url("data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxNC45MjUiIGhlaWdodD0iMTYuMDE4Ij48cGF0aCBkPSJNLjAwNiAxMC4wNzRhNzYuOTI5IDc2LjkyOSAwIDAxMC0xLjkyMiAxLjE4MSAxLjE4MSAwIDAxLjQ2Ny0uOTI2IDYuOTE4IDYuOTE4IDAgMDExLjgyNS00LjkzQTYuNTQzIDYuNTQzIDAgMDE2LjAwNy4xNzNhNi44IDYuOCAwIDAxNi43ODUgMi4zMTggNi43IDYuNyAwIDAxMS42NjIgNC43NDUgMS4yMiAxLjIyIDAgMDEuNDcxLjk4NXYxLjc4NmExLjIyNSAxLjIyNSAwIDAxLS42MTkgMS4wNzMgMi4xNSAyLjE1IDAgMDEtMS4wMzQuMzIyaC0uMDg5YTEuMDU1IDEuMDU1IDAgMDEtMS0uNjYxIDEuOTc3IDEuOTc3IDAgMDEtLjE1OS0uNjc1di0uMDFsLjAzNS0yLjE5NGExLjE2NCAxLjE2NCAwIDAxLjgtLjk5MiA1LjA3MiA1LjA3MiAwIDAwLS41NDUtMi4yMzEgNS4yNzQgNS4yNzQgMCAwMC00LjEtMi45NzggNS4zNjEgNS4zNjEgMCAwMC02LjA3OSA0LjQxNiA1Ljc2OCA1Ljc2OCAwIDAwLS4wNjIuN3YuMWExLjEyNCAxLjEyNCAwIDAxLjc0Ny43NzYgMS44NjggMS44NjggMCAwMS4wODMuNTQzdjEuODE0YTEuOTU1IDEuOTU1IDAgMDEtLjEuNTcyIDEuMTgxIDEuMTgxIDAgMDEtLjQwOC41ODkgMy4wNjkgMy4wNjkgMCAwMDMuMDU0IDIuODExaC40YS43OTMuNzkzIDAgMDEuNjkyLS40aDEuNTI4YS44LjggMCAwMS44Ljh2LjgzNmEuOC44IDAgMDEtLjguOEg2LjU0MmEuNzkzLjc5MyAwIDAxLS42OS0uNDEyaC0uNEE0LjY4NyA0LjY4NyAwIDAxLjc4IDExLjE4NGExLjcxNSAxLjcxNSAwIDAxLS4yNC0uMTQ3IDEuMiAxLjIgMCAwMS0uNTM1LS45NjN6IiBmaWxsPSIjMjUzODU4Ii8+PC9zdmc+") 0 0 no-repeat
}
.callUsWrapper .toll-link+.toll_wrapper_web {
 display:none;
 position:absolute;
 right:-5px;
 width:285px;
 border-radius:0 0 4px 4px;
 box-shadow:0 8px 19px -1px rgba(0,0,0,.3);
 background-color:#fff;
 padding:0 20px 20px;
 top:60px
}
.callUsWrapper .toll-link+.toll_wrapper_web:after {
 content:"";
 position:absolute;
 top:-14px;
 right:19px;
 width:0;
 height:0;
 border-left:14px solid transparent;
 border-right:14px solid transparent;
 border-bottom:14px solid #fff
}
.callUsWrapper .toll-link+.toll_wrapper_web .toll_inner_wrapper {
 display:grid;
 grid-template-columns:inherit;
 text-align:left;
 color:#979797;
 font-size:14px;
 line-height:22px;
 margin-top:20px;
 font-weight:400
}
.callUsWrapper .toll-link+.toll_wrapper_web .toll_inner_wrapper a {
 font-size:16px;
 font-weight:600;
 color:#1f84f8
}
.callUsWrapper:hover .toll_wrapper_web {
 display:block
}
.claim-link:hover {
 color:#253858
}
.toll-open {
 width:200px;
 background:#fff;
 left:inherit;
 right:-2%;
 border-radius:0 0 8px 8px;
 border-top:none
}
.inner-toll-box {
 text-transform:capitalize;
 padding:6px 12px 13px;
 margin:0;
 line-height:17px;
 border-bottom:0 solid #4289b2;
 font-size:12px
}
.bdr-none-toll {
 border-bottom:none
}
.inner-toll-box a {
 color:#ff5630;
 display:block;
 text-decoration:none;
 font-weight:600;
 font-size:14px;
 letter-spacing:1px
}
.inner-toll-box span {
 display:block
}
.call_me_now,
.inner-toll-box span {
 text-transform:none;
 font-size:12px
}
.call_me_now {
 font-weight:600;
 color:#253858;
 background:url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAADhlWElmTU0AKgAAAAgAAYdpAAQAAAABAAAAGgAAAAAAAqACAAQAAAABAAAAGKADAAQAAAABAAAAGAAAAADB/VeXAAADXklEQVRIDe1UW0hUXRRea+99zhnNybFyFEdLpyuOEaYlQURP9RA/labdiJ6CLhI9RFQP1WNFLxH0GgSVXbVJqIT+XqL/L9IuaGbkDdGpLHS8zuWcs9pjnWnGiXAo6KXDgbX2unzf3mvtvQD+4Ie/g/uHIO6Sqt2EsIL00PGuF3Vdv0LEJicXLN98mgk8BUDpXNUa5pRWFE+OSWYdR1BQVrWPI+0xQuaOzmfXywHBKxi/8isk3NpNXvGWHMHhsmHg0a6ma5elnQZ6Wxpm5Bblc8aO2GfNfez/0Pbeip+qjJ6Ac1oFhDgyGvbGJrc/uXrQBPifa9rZTM/qtFjfVPQoAUPIMMH06Zo5npiILkQ23M9VSvT93CIst0HULRCz7WimDgLIf+LDuWWbG4DMvFAgvAleNYxa8VOV0RMA6c9lU0kRKRus5ILSqr0SPN8YH9/Q86q22bInI6ME3Y23fGRQHSJtBU/lRK1l7dMJcISpNl8yoLGxUYIJI9F5QJznTmU7IuvR4cA5uQbkvCan5J/U2MTvukf9ridq0WsacQ34Xn90uDwaQ9prd8x/4Gv19mbMWvAQBa9WuLJGOArrxvpfh77BYMGyqjOOXOcWLc39cvTzW6tvcSyJo8JTqbrT+B3ZDt0IBrfLUTGYU7Q+L2Wa7YG8xu0QCO40hgaGWFbWbWbCbB3pjdxloW7oW2WZm+LQ5SK+RBFvy/WQPhbeA4DzmapegNzKlL7m2z3BoL4OkOxgUx8xp/M+EuSHdLOi6+m1ctmnekUol+aUlC+dTBBXIsvp/9g6MC1z4T0hxIGM6bhScxY+7Htxoycl213DUbhlV8JD5uA2X5O3M5ITefEOV5FbcDxsz170n9/XGr0UiSWyWKR0L9m4AG1avexzW1gPH+t+dvP5V3eJAtAYjgmdUOWgvAhEmZ297RXQ1zgWMSaWKCar42XtWyMYWENENoWLeglQPXvxuowfgU/3rJ0hp0Ge3HGHBA9YMD89gRUEcILlL2s5xBnfL2egj4BuyMdXQ2Qf1FXiAvViBdlJ+VD7/f7xyk9t3mErd4oEX8NdZeW5GolqmbRJls1pEnZIPU3qWbLRtfjZv+vdu7tBCzwikyKwEl3LN85kulLKGMxjgoX0Efq3p/lqu+X/K5OqwBfA+TKNZ+30lAAAAABJRU5ErkJggg==") 5px 18px no-repeat;
 padding-left:34px;
 align-items:center;
 display:flex;
 margin:0 30px;
 cursor:pointer
}
.logo-box {
 width:200px;
 height:36px;
 background:url("data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNzA3IiBoZWlnaHQ9IjExNSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsLXJ1bGU9Im5vbnplcm8iIGZpbGw9Im5vbmUiPjxwYXRoIGQ9Ik0uMyAzMi44YzEuNyAwIDMuNS4xIDUuMi4xaDEyLjJjLjcgMCAuOS4yLjkuOXY4LjZjLjEgMCAuMi4xLjIuMS4yLS4zLjQtLjUuNi0uOCAyLjgtNC4xIDYuMi03LjUgMTEtOSA4LjktMi45IDE4LjMuMSAyMi41IDExLjEgMiA1LjQgMi41IDExIDIuMSAxNi43LS40IDUuNS0xLjYgMTAuOS00LjQgMTUuOEM0Ni41IDgzLjQgNDAuMiA4Ni43IDMyIDg2Yy00LjctLjQtOC42LTIuNS0xMi01LjctLjQtLjQtLjctLjgtMS0xLjItLjEuMS0uMi4xLS4zLjJ2MjQuOEg5LjRjMC0uMy0uMS0uNS0uMS0uN1Y0NC44YzAtMS41LS4xLTMtLjMtNC40LS40LTIuNS0xLjYtMy43LTQuMS00LjEtMS4yLS4yLTIuNC0uMy0zLjYtLjQtLjYgMC0uOC0uMy0uOC0uOSAwLS42LS4xLTEuMi0uMi0xLjh2LS40em0xOC4zIDI3Ljd2MTRjMCAuNS4zIDEuMS43IDEuMyAzLjUgMi42IDcuMyA0LjUgMTEuNiA1LjEgMy40LjUgNi41LS4yIDkuMS0yLjYgMi0xLjkgMy4yLTQuNCAzLjktNyAxLjgtNi42IDEuOS0xMy4zLjctMjAtLjYtMy40LTEuNy02LjctMy44LTkuNy0yLjgtMy45LTYuNS01LjQtMTEtNC4xLTQuNiAxLjMtOC4xIDQuMS0xMC45IDcuOS0uMi4zLS4zLjgtLjMgMS4ydjEzLjl6IiBmaWxsPSIjMDA2NUZGIi8+PHBhdGggZD0iTTI3Mi4zIDExLjlWOWgxOC4zdjMzLjRjMS4zLTEuNSAyLjQtMyAzLjctNC40IDUuNy01LjkgMTIuNy03LjggMjAuNi01LjUgNSAxLjQgOC4yIDUgMTAuNSA5LjUgMS45IDMuOCAyLjggNy44IDMuMSAxMiAuNCA2LjItLjEgMTIuNC0yLjUgMTguMy0xLjkgNC44LTQuOCA4LjgtOS40IDExLjUtNy40IDQuMy0xNy4yIDMuMi0yMy44LTIuNS0uNi0uNi0xLjItMS4yLTEuOC0xLjctLjItLjItLjUtLjMtLjctLjMtLjEgMC0uMy40LS4zLjYtLjMgMS43LS42IDMuNC0xIDUuMS0uMS4zLS40LjctLjYuN2gtNy4zdi0xLjEtNjMuNWMwLTItLjItNC0uNS02LjEtLjEtMS4yLS45LTItMi0yLjItMS43LS4zLTMuNS0uNi01LjItLjloLTEuMXptMTguMyA0OC43djE0LjFjMCAuNC4yLjkuNCAxLjEgMy40IDIuNSA3LjEgNC41IDExLjQgNS4xIDYuOSAxLjEgMTEuOC0xLjYgMTQuMi04LjIgMS4yLTMuNCAxLjYtNi45IDEuNy0xMC41LjEtNC45IDAtOS43LTEuMy0xNC40LS44LTIuOC0xLjktNS40LTQuMS03LjQtMy4xLTIuNy02LjctMy4xLTEwLjUtMi40LTQuNi45LTguMSAzLjUtMTEuMSA3LS41LjYtLjcgMS4yLS43IDJ2MTMuNnpNMzc4LjUgODEuN2MwIC40LjEuNy4xIDEgLjIgMi41LjIgMi42LTIuMyAzLjEtMS41LjMtMyAuNS00LjUuNC0zLjktLjItNi4xLTIuNi03LjQtNi4xLS4yLS43LS40LTEuNC0uNy0yLjEtMSAuOS0yIDEuOC0zIDIuNi0zLjIgMi42LTYuOCA0LjctMTEgNS41LTYuOCAxLjMtMTMuNi0xLjgtMTYuNy03LjQtMy4zLTYtMi40LTE1LjYgNS45LTIwLjUgMy41LTIgNy4zLTMgMTEuMy0zLjQgMy4zLS4zIDYuNy0uNCAxMC0uNmgxLjNjLS4xLTQuNC40LTguNy0uOS0xMy0xLjMtMy45LTQuMy02LjEtOC40LTUuOS0xLjYuMS0zLjMuMy00LjguOC0zLjYgMS4xLTUuMyAzLjgtNS42IDcuNC0uMS42LS4xIDEuMy0uMSAyaC02LjV2LTEuMi03LjZjMC0uMy4yLS44LjUtMSA2LjYtMi45IDEzLjUtNC42IDIwLjgtNC4xIDIuOS4yIDUuNi44IDguMSAyLjMgMy42IDIuMSA1LjQgNS41IDYgOS41LjIgMS42LjMgMy4zLjMgNC45djIyLjVjMCAyLjUuMiA1IC43IDcuNC40IDIuNCAxLjggMy41IDMuOSAzLjcgMSAuMiAyLS4xIDMtLjJ6bS0xNi45LTI0LjZjLTQuNSAwLTguOS4xLTEzIDItNS4xIDIuNC03LjQgNi4zLTcuMiAxMS45LjIgNiA1LjggMTAuNSAxMS43IDkuNiAyLjktLjUgNS40LTEuOCA3LjktMy4zLjUtLjMuNy0uNy43LTEuMlY1OC45Yy0uMS0uNi0uMS0xLjEtLjEtMS44ek01MDAuOSA0NS41aC02LjRjMC0uMy0uMS0uNS0uMS0uOHYtOGMwLS4zLjItLjguNS0xIDYuNi0yLjkgMTMuNS00LjcgMjAuOC00LjEgMS45LjIgMy45LjYgNS43IDEuMiA1LjEgMS44IDcuNyA1LjYgOC40IDEwLjcuMiAxLjMuMiAyLjYuMiAzLjl2MjMuOGMwIDIuMi4yIDQuNS43IDYuNy43IDMuMyAyLjYgNC40IDUuOSAzLjcuMi0uMS41LS4xLjktLjIuMSAxLjEuMiAyLjEuMyAzLjEgMCAuMi0uMi41LS40LjUtMi42LjgtNS4yIDEuNC03LjkuOC0yLjktLjctNC43LTIuNi01LjgtNS4zLS4zLS45LS42LTEuOC0uOS0yLjgtMSAuOS0xLjkgMS43LTIuOSAyLjUtMy4zIDIuNy02LjggNC45LTExIDUuNS02LjUgMS0xMi4xLS44LTE2LTYuNC00LTUuNi0zLjgtMTYuNCA1LjYtMjEuNyAzLjQtMS45IDcuMS0yLjggMTEtMy4yIDMuNC0uMyA2LjgtLjQgMTAuMi0uNmguOGwuMi0uMmMtLjEtMy40IDAtNi43LS4zLTEwLjEtLjMtMy4zLTEuNS02LjItNC43LTcuNy0yLjgtMS4zLTUuNy0xLjItOC41LS4zLTQuOSAxLjctNS45IDQuMS02LjMgOXYxem0xOS43IDExLjZjLTQuMSAwLTguMS4xLTExLjkgMS43LTUuMiAyLjEtOC4xIDUuNy04LjIgMTEuNi0uMSA2LjMgNS42IDExLjMgMTEuNyAxMC4zIDIuOC0uNSA1LjMtMS44IDcuNy0zLjIuNS0uMy43LS43LjctMS4zVjU4LjNjLjEtLjUgMC0uOCAwLTEuMnpNNDY2LjkgNTQuMWMtLjItNC40LjUtOC44LS45LTEzLTEuMy0zLjktNC4yLTUuOS04LjQtNS45LTIuMiAwLTQuMy41LTYuMiAxLjUtMi41IDEuMy0zLjcgMy4zLTQuMSA2LS4xLjktLjIgMS44LS4zIDIuOGgtNi4yYzAtLjItLjEtLjQtLjEtLjZ2LTguMmMwLS4zLjMtLjguNi0uOSA1LjEtMi4yIDEwLjMtMy44IDE1LjgtNC4xIDMtLjIgNi4xLS4xIDkgLjcgNS45IDEuNiA5LjUgNS44IDEwIDExLjkuMSAxLjQuMiAyLjkuMiA0LjMgMCA4LjMgMCAxNi43LjEgMjUgMCAxLjUuMiAzIC42IDQuNC43IDMuMSAyLjUgNC4zIDUuNyAzLjguMy0uMS42LS4xIDEuMS0uMi4xIDEuMi4yIDIuMy4zIDMuNS0zLjIgMS02LjMgMS44LTkuNi41LTMuNC0xLjQtNC42LTQuNC01LjQtNy42LTEuNSAxLjItMi45IDIuNS00LjQgMy42LTMuNCAyLjYtNy4xIDQuMy0xMS40IDQuNi04LjYuNi0xNS4yLTQuOS0xNi40LTExLjktMS4yLTcuMSAxLjgtMTMuNiA5LjEtMTcuMSAzLjYtMS43IDcuNC0yLjQgMTEuMi0yLjcgMi45LS4yIDUuOS0uMyA4LjgtLjQuMy4xLjYgMCAuOSAwem0wIDNjLTQuNCAwLTguNi4xLTEyLjYgMS45LTQuOSAyLjItNy42IDUuOS03LjYgMTEuNSAwIDYuMyA1LjYgMTEuMSAxMS43IDEwLjEgMi44LS40IDUuMi0xLjcgNy42LTMuMi42LS40LjgtLjcuOC0xLjVWNTguMWMuMS0uMy4xLS42LjEtMXoiIGZpbGw9IiMyNTM4NTgiLz48cGF0aCBkPSJNODQuNSA4Ni4xYy0xMi4zLjEtMjEuNy03LjYtMjQuMy0xOS45LTEuOC04LjQtLjgtMTYuNSAzLjktMjMuOSA0LTYuMyA5LjktOS43IDE3LjQtMTAuNCA1LjYtLjYgMTAuOS4yIDE1LjggMy4xIDYgMy41IDkuNSA5IDExLjIgMTUuNiAyLjEgOC40IDEuMyAxNi41LTMgMjQtMy44IDYuNi05LjYgMTAuMy0xNy4yIDExLjMtLjQgMC0uNy4xLTEuMS4xLS45LjEtMS44LjEtMi43LjF6bTE1LjMtMjguMmMtLjEtMS4zLS4zLTMuNy0uNy02LS43LTQuNi0yLjItOC45LTUuMS0xMi42LTQuMy01LjUtMTEuMy02LjYtMTYuNy0yLjUtMi41IDItNC4yIDQuNi01LjQgNy41LTMgNy41LTMuNCAxNS4yLTEuOSAyMy4xLjkgNC4zIDIuNCA4LjMgNS40IDExLjcgMy45IDQuNiAxMC4zIDUuNiAxNS4yIDIuNSAyLjUtMS42IDQuMi0zLjkgNS41LTYuNSAyLjctNSAzLjYtMTAuNSAzLjctMTcuMnoiIGZpbGw9IiMwMDY1RkYiLz48cGF0aCBkPSJNMzk4LjIgODEuNWgzNC4yVjg1aC00NS42YzAtMS42LS4xLTIuOS45LTQuNCAxMC43LTE0LjcgMjEuMi0yOS41IDMxLjgtNDQuMy4xLS4yLjItLjMuNS0uN2gtMjAuOWMtMS4zIDAtMi42LjItMy45LjMtMSAuMS0xLjUuNy0xLjcgMS42LS4xIDEtLjIgMS45LS4yIDIuOVY0NGgtNS4xVjMyLjdoNDIuOWMuMiAxLjYgMCAzLTEgNC40LTEwLjUgMTQuNS0yMC45IDI5LTMxLjMgNDMuNS0uMS40LS4zLjYtLjYuOXpNNTQxLjIgMzUuNXYtMi43aDE4LjR2OS41YzQuOC03LjQgMTEtMTEuOSAyMC4zLTEwLjN2MTQuNGgtNS4yYy0uMi0xLjQtLjMtMi45LS42LTQuMy0uNC0yLjMtLjgtMi42LTMuMS0yLjYtNC4zLjEtNy40IDIuMy0xMCA1LjUtMSAxLjMtMS41IDIuNi0xLjUgNC4zLjEgNy44IDAgMTUuNS4xIDIzLjMgMCAxLjkuMiAzLjkuNCA1LjguMSAxLjggMS4xIDMgMi45IDMuMiAxLjcuMyAzLjQuNCA1LjEuNi42LjEgMS4xLjEgMS43LjF2Mi45aC0yOC41YzAtLjgtLjEtMS43IDAtMi41IDAtLjIuNS0uNS44LS41bDQuOC0uNmMxLjgtLjMgMi44LTEuMyAzLTMuMS4xLTEuOC4zLTMuNi4zLTUuNHYtMjhjMC0yLS4zLTQtLjUtNi0uMS0xLjItLjktMi4xLTIuMS0yLjMtMi0uNi00LjEtLjktNi4zLTEuM3oiIGZpbGw9IiMyNTM4NTgiLz48cGF0aCBkPSJNMTA4LjkgMTEuN1Y5LjFoMTdjLjkgMCAxLjEuMyAxLjEgMS4yIDAgMTEuNy4xIDIzLjMuMSAzNSAwIDEyLjguMSAyNS42LjEgMzguNCAwIDEuNCAwIDEuNC0xLjQgMS40aC04LjZjMC0uNC0uMS0uNy0uMS0xIDAtNyAuMS0xNC4xLjEtMjEuMSAwLTUgLjEtMTAuMS4yLTE1LjFsLjMtMjguM2MwLTEuMi0uMi0yLjQtLjQtMy41LS40LTEuOC0xLjUtMy4xLTMuNC0zLjUtMS42LS41LTMuMy0uNy01LS45ek0yNjQgMzIuOWMtMS4xIDItMi4xIDMuOS0zIDUuOC01LjIgMTEuNC0xMC40IDIyLjgtMTUuNSAzNC4xLTMuOCA4LjMtNy41IDE2LjYtMTEuMyAyNC44LTEuNCAzLTMuMyA1LjUtNi45IDYtMS40LjItMi44LjItNC4yLjItMi43IDAtNS41LS4xLTguMi0uMi0uNiAwLTEuMi0uMS0xLjctLjEtLjQtMS41LS4zLTEuNyAxLjEtMS42bDUuNC4zYzIuOS4yIDUuOC0uMiA4LjUtMS41IDEuNy0uOCAzLTIgMy43LTMuNiAxLjEtMi40IDItNSAyLjktNy41LjUtMS4yLjktMi41IDEuNS0zLjcuMy0uNi4zLTEuMSAwLTEuNy01LjQtMTMtMTAuOS0yNi0xNi4zLTM5LS43LTEuNy0xLjMtMy40LTIuMS01LjEtMS4yLTIuNS0zLTQuMi02LTQuNS0uMiAwLS40LS40LS41LS42di0uMmMwLTIuNC0uMy0xLjkgMS45LTJoMTQuNWMwIDEuMi4xIDIuMyAwIDMuNC0uMiAyLjEuNCA0LjEgMS4yIDYgNC4zIDEwLjEgOC41IDIwLjMgMTIuNyAzMC40LjEuMy4zLjYuNCAxIC4yLS4zLjMtLjQuNC0uNSA0LjMtOS44IDguNy0xOS41IDEyLjktMjkuNCAxLjQtMy4yIDIuMy02LjYgMy40LTEwIC4yLS43LjUtLjkgMS4yLS45IDEuNC4xIDIuNy4xIDQgLjF6TTIwNi4xIDc5LjR2My4yYzAgLjMtLjMuNy0uNS44LTcuMiAyLjctMTQuNiAzLjktMjIuMSAxLjYtNy43LTIuMy0xMi45LTcuNi0xNS42LTE1LjEtMy41LTkuNi0zLTE4LjkgMi41LTI3LjcgNC02LjMgOS45LTkuNiAxNy4zLTEwLjQgNi0uNyAxMS45LjcgMTcuNyAyIC41LjEuNy40LjcuOXYxMC44YzAgLjYtLjIuOS0uOS44aC0zLjljLS44IDAtMS0uMi0xLTEtLjEtMS40LS4zLTIuOC0uNi00LjItMS40LTUtNC43LTYuOC05LjgtNi41LTUuNi4zLTkuMiAzLjUtMTEuNiA4LjMtMS43IDMuMy0yLjQgNi45LTIuNyAxMC42LS41IDUuNC4xIDEwLjggMS44IDE1LjkgMi4xIDYuNSA2LjQgMTAuNyAxMy4zIDEyIDQuOS45IDkuNi4yIDE0LjItMS42LjQgMCAuNy0uMiAxLjItLjR6TTEzOS45IDM1LjZWMzNIMTU4Yy4yIDE3LjMuMyAzNC42LjUgNTEuOWgtMTB2LTIuNGMuMS03LjQuMS0xNC44LjItMjIuMi4xLTUuNi4xLTExLjEuMS0xNi43IDAtMS4yLS4xLTIuMy0uMy0zLjUtLjUtMi41LTEuNy0zLjctNC4yLTQuMWwtMi4xLS4zYy0uOCAwLTEuNSAwLTIuMy0uMXpNMTU4IDEzLjlWMjNoLTkuMXYtOS4xaDkuMXpNNzA2LjggNTcuMmMwIDMxLjUtMjUuNSA1Ny4xLTU3LjEgNTcuMS0zMS41IDAtNTcuMS0yNS41LTU3LjEtNTcuMSAwLTMxLjUgMjUuNS01Ny4xIDU3LjEtNTcuMSAzMS41IDAgNTcuMSAyNS41IDU3LjEgNTcuMXoiIGZpbGw9IiMwMDY1RkYiLz48ZyBmaWxsPSIjRkZGIj48cGF0aCBkPSJNNjI5LjIgNzEuN2wzLjktMWMuNiAyLjcuNCA1LjEtLjYgNy4yLTEuMSAyLjEtMi44IDMuNy01LjIgNC42LTMgMS4yLTUuOCAxLjMtOC41IDAtMi42LTEuMi00LjctMy43LTYuMi03LjMtMS0yLjQtMS40LTQuNi0xLjQtNi43LjEtMi4xLjctMy45IDEuOS01LjVzMi44LTIuNyA0LjctMy41YzIuNC0xIDQuNi0xLjIgNi42LS42czMuNyAxLjkgNSAzLjlsLTMuNCAyLjFjLTEtMS4zLTItMi4yLTMuMi0yLjYtMS4yLS40LTIuNC0uMy0zLjYuMi0xLjkuOC0zLjEgMi4xLTMuNyAzLjktLjYgMS44LS4zIDQuMi45IDcuMSAxLjIgMyAyLjcgNC45IDQuMyA1LjcgMS42LjggMy40LjkgNS4zLjIgMS41LS42IDIuNS0xLjYgMy4xLTIuOS42LTEuMy42LTIuOS4xLTQuOHpNNjMzLjQgNjYuNWMtMS43LTQuMS0xLjgtNy42LS4zLTEwLjQgMS4yLTIuNCAzLjItNC4yIDUuOS01LjMgMy0xLjIgNS45LTEuMyA4LjYtLjEgMi43IDEuMiA0LjggMy41IDYuMyA3IDEuMiAyLjggMS43IDUuMiAxLjUgNy4yLS4yIDItLjkgMy43LTIuMiA1LjMtMS4zIDEuNi0yLjggMi43LTQuOCAzLjUtMy4xIDEuMy02IDEuMy04LjcuMS0yLjYtMS4xLTQuNy0zLjYtNi4zLTcuM3ptMy45LTEuNmMxLjIgMi44IDIuNiA0LjcgNC40IDUuNiAxLjguOSAzLjYgMSA1LjUuMiAxLjgtLjggMy4xLTIuMSAzLjctNCAuNi0xLjkuNC00LjMtLjgtNy4yLTEuMS0yLjctMi42LTQuNS00LjQtNS40LTEuOC0uOS0zLjYtMS01LjUtLjJzLTMuMSAyLjEtMy44IDRjLS41IDEuOC0uMyA0LjIuOSA3ek02NjIuOSA2Ny4ybC05LjEtMjIgMy4zLTEuNCAxLjMgMy4xYy4yLTEuNC44LTIuNiAxLjctMy43LjktMS4xIDItMiAzLjUtMi42IDEuNi0uNyAzLjEtLjkgNC40LS42IDEuMy4yIDIuNC45IDMuNCAxLjkuNy0zLjMgMi40LTUuNSA1LjItNi43IDIuMi0uOSA0LjEtMSA1LjgtLjMgMS43LjcgMyAyLjMgNC4xIDQuOWw2LjIgMTUuMS0zLjcgMS41LTUuNy0xMy45Yy0uNi0xLjUtMS4yLTIuNS0xLjctMy4xLS41LS42LTEuMi0uOS0yLTEtLjgtLjEtMS42IDAtMi41LjMtMS41LjYtMi42IDEuNy0zLjIgMy4xLS42IDEuNS0uNCAzLjMuNSA1LjZsNS4zIDEyLjgtMy43IDEuNS01LjktMTQuM2MtLjctMS43LTEuNS0yLjgtMi40LTMuNC0uOS0uNi0yLjEtLjYtMy41IDAtMSAuNC0xLjkgMS4xLTIuNiAyLS43LjktMSAyLS45IDMuMiAwIDEuMi41IDIuOCAxLjMgNC44bDQuNyAxMS40LTMuOCAxLjh6Ii8+PC9nPjwvZz48L3N2Zz4=") 0 0 no-repeat;
 text-indent:-99999px;
 background-size:contain;
 margin:11px 0 0
}
.slider-new {
 display:inline-flex;
 margin:30px 0;
 overflow:auto;
 width:100%;
 padding-bottom:10px
}
.slider-new div {
 padding:0;
 width:340px;
 margin-right:35px
}
.slider-new1 {
 overflow:hidden;
 width:100%;
 padding:10px;
 white-space:nowrap;
 overflow:auto;
 -ms-overflow-style:none;
 scrollbar-width:none;
 font-size:0
}
.slider-new1::-webkit-scrollbar {
 display:none
}
.slider-new1>div {
 padding:0;
 width:32%;
 margin-right:16px;
 min-width:230px;
 display:inline-block
}
.sp-left-pic {
 padding-left:250px;
 position:relative
}
.sp-left-pic img {
 position:absolute;
 top:-66px;
 left:27px;
 z-index:99
}
.sp-top-main {
 padding-top:24px
}
.footerWrapper {
 background:#fff;
 padding:16px 0
}
.footer-desk {
 width:100%;
 margin:0 auto!important;
 text-align:center;
 color:#505f79;
 font-size:12px;
 max-width:1170px;
 padding:0 15px!important
}
.footer-desk.is-stu-compare {
 margin-top:0!important
}
.footer-desk p {
 margin-bottom:10px!important
}
.footer-desk p.info {
 font-size:12px;
 line-height:18px;
 text-align:center;
 margin-bottom:8px!important;
 color:#505f79
}
.footer-desk-gap {
 margin-top:-10px
}
.footer-desk-algin {
 text-align:left;
 color:#505f79
}
.footer-desk a {
 color:#505f79;
 text-decoration:underline
}
.footer-desk a:hover {
 color:#505f79
}
ul.listing-hospital-category {
 margin:0;
 padding:0;
 float:left;
 width:100%
}
ul.listing-hospital-category li {
 margin:0 0 10px;
 height:30px;
 padding:3px 10px 5px 31px;
 float:left;
 width:50%;
 background:url("data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjIiIGhlaWdodD0iMjIiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGcgZmlsbD0iIzdBODI4MiIgZmlsbC1ydWxlPSJldmVub2RkIj48cGF0aCBkPSJNMy45MjkgMy45MjlBOS45NyA5Ljk3IDAgMDExMSAxYTkuOTcgOS45NyAwIDAxNy4wNzEgMi45MjlBOS45NyA5Ljk3IDAgMDEyMSAxMC45OTlhOS45NyA5Ljk3IDAgMDEtMi45MjkgNy4wNzJBOS45NyA5Ljk3IDAgMDExMS4wMDEgMjFhOS45NjkgOS45NjkgMCAwMS03LjA3Mi0yLjkyOUE5Ljk2OSA5Ljk2OSAwIDAxMSAxMWE5Ljk2OSA5Ljk2OSAwIDAxMi45MjktNy4wNzF6TTExIDIyYzYuMDc1IDAgMTEtNC45MjUgMTEtMTFTMTcuMDc1IDAgMTEgMCAwIDQuOTI1IDAgMTFzNC45MjUgMTEgMTEgMTF6IiBmaWxsLXJ1bGU9Im5vbnplcm8iLz48cGF0aCBkPSJNNSA5LjA5M3YzLjgxNGMwIC4yNTQuMjA4LjQ2MS40NjIuNDYxaDMuMTd2My4xN2MwIC4yNTQuMjA3LjQ2Mi40NjEuNDYyaDMuODE0YS40NjMuNDYzIDAgMDAuNDYxLS40NjJ2LTMuMTdoMy4xN2EuNDYzLjQ2MyAwIDAwLjQ2Mi0uNDYxVjkuMDkzYS40NjMuNDYzIDAgMDAtLjQ2Mi0uNDYyaC0zLjE3di0zLjE3QS40NjMuNDYzIDAgMDAxMi45MDcgNUg5LjA5M2EuNDYzLjQ2MyAwIDAwLS40NjEuNDYydjMuMTdoLTMuMTdBLjQ2My40NjMgMCAwMDUgOS4wOTIiLz48L2c+PC9zdmc+") no-repeat 0 0;
 font-size:12px;
 list-style-type:none;
 color:#414446;
 line-height:15px
}
.hospital-box {
 overflow-x:hidden;
 height:304px;
 margin:15px 0;
 background:#fff
}
.hospital-box-scroll {
 overflow-y:scroll
}
.hospital-category {
 width:231px;
 height:40px;
 border-radius:4px;
 background-color:#d8d8d8;
 font-size:16px;
 float:left;
 font-weight:400;
 color:#36b37e;
 padding-left:15px;
 margin:0 0 18px;
 line-height:40px
}
.modal-card-new {
 background-color:#36b37e;
 padding:12px 19px
}
h3.header-hospital {
 color:#fff;
 font-size:21px;
 font-weight:400;
 background:url("data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMzciIGhlaWdodD0iMzciIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGcgZmlsbD0iI0ZGRiIgZmlsbC1ydWxlPSJldmVub2RkIj48cGF0aCBkPSJNMzUuNDU4IDEyLjMzM2gtNi4xNjZWMS41NDJjMC0uOTI1LTEuMDgtMS41NDItMS44NS0xLjU0MmgtMTguNWMtLjkyNSAwLTEuMjM0LjYxNy0xLjIzNCAxLjU0MnYxMC43OTFIMS41NDJDLjYxNyAxMi4zMzMgMCAxMi45NSAwIDEzLjg3NVYzN2gzN1YxMy44NzVjMC0uOTI1LS42MTctMS41NDItMS41NDItMS41NDJ6TTIxLjU4MyAzMy45MTdoLTYuMTY2VjI3Ljc1aDYuMTY2djYuMTY3em0xMi4zMzQgMEgyMy4xMjV2LTcuNzA5aC05LjI1djcuNzA5SDMuMDgzdi0xOC41aDcuNzA5VjMuMDgzaDE1LjQxNnYxMi4zMzRoNy43MDl2MTguNXoiIGZpbGwtcnVsZT0ibm9uemVybyIvPjxwYXRoIGQ9Ik0yMCAyMGgzdjNoLTN6TTE0IDIwaDN2M2gtM3pNOCAyMGgzdjNIOHpNMjYgMjBoM3YzaC0zek0yNiAyNmgzdjNoLTN6TTggMjZoM3YzSDh6TTIwIDZoLTN2M2gtM3YzaDN2M2gzdi0zaDNWOWgtM3oiLz48L2c+PC9zdmc+") no-repeat 0 0;
 height:37px;
 width:auto;
 padding:0 0 0 51px;
 line-height:36px
}
.mt-top {
 margin-bottom:40px
}
.sp-loading-top {
 height:187px;
 align-items:center;
 display:flex
}
.sp-left-pic.sp-loading-top img {
 top:0
}
.link-bottom {
 position:absolute;
 left:-44px;
 width:100%;
 bottom:30px
}
.content_section .column p.sp-more {
 margin-bottom:62px
}
.yearly-text {
 display:block;
 padding-top:5px;
 font-size:12px
}
.suminsuredspan,
.yearly-text {
 font-weight:600;
 color:#253858
}
.suminsuredspan {
 font-size:20px;
 font-family:Nunito,sans-serif
}
.filterBar {
 display:flex;
 flex-direction:row;
 width:100%;
 margin-bottom:10px;
 box-shadow:0 4px 12px 0 rgba(0,0,0,.1);
 padding:10px;
 background-color:#fff;
 text-align:center;
 border-radius:5px;
 align-items:center
}
.planLoading:empty {
 margin:80px auto 20px;
 width:100%;
 height:200px;
 background-image:radial-gradient(circle 50px at 50px 50px,#d3d3d3 99%,transparent 0),linear-gradient(100deg,rgba(240,244,245,0),rgba(240,244,245,.5) 50%,rgba(240,244,245,0) 80%),linear-gradient(#d3d3d3 20px,transparent 0),linear-gradient(#d3d3d3 20px,transparent 0),linear-gradient(#d3d3d3 20px,transparent 0);
 background-repeat:repeat-y;
 background-size:100px 200px,50px 200px,350px 200px,350px 200px,350px 200px;
 background-position:50% 0,0 0,0 110px,0 145px,0 180px;
 animation:shine 1s infinite
}
@keyframes shine {
 to {
  background-position:50% 0,100% 0,0 110px,0 145px,0 180px
 }
}
.arrow-icon {
 background-image:url("data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTUiIGhlaWdodD0iMTIiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PHBhdGggZD0iTS43NSA1LjI1N2gxMS42OUw4LjQxNiAxLjI2OWEuNzM5LjczOSAwIDAxMC0xLjA1MS43NTUuNzU1IDAgMDExLjA2IDBsNS4zMDMgNS4yNTZhLjc0NC43NDQgMCAwMS4wOTQuMTE0Yy4wMTIuMDE5LjAyMS4wMzkuMDMyLjA1OC4wMTIuMDIzLjAyNi4wNDUuMDM2LjA3LjAxLjAyNS4wMTcuMDUuMDI1LjA3Ny4wMDYuMDIuMDE0LjA0LjAxOC4wNjEuMDEuMDQ5LjAxNS4wOTcuMDE1LjE0NnYuMDAyYS43MjkuNzI5IDAgMDEtLjAxNS4xNDRjLS4wMDQuMDIyLS4wMTMuMDQzLS4wMi4wNjQtLjAwNy4wMjUtLjAxMi4wNS0uMDIyLjA3NC0uMDExLjAyNi0uMDI2LjA1LS4wNC4wNzQtLjAxLjAxOC0uMDE3LjAzNy0uMDMuMDU0YS43NDQuNzQ0IDAgMDEtLjA5My4xMTRsLTUuMzAzIDUuMjU2YS43NTUuNzU1IDAgMDEtMS4wNiAwIC43NC43NCAwIDAxMC0xLjA1MWw0LjAyMi0zLjk4N0guNzVBLjc0Ny43NDcgMCAwMTAgNmMwLS40MS4zMzYtLjc0My43NS0uNzQzeiIgZmlsbD0iIzI1Mzg1OCIgZmlsbC1ydWxlPSJub256ZXJvIi8+PC9zdmc+");
 background-position:10px 4px;
 left:-7px;
 -ms-transform:rotate(180deg);
 -webkit-transform:rotate(180deg);
 transform:rotate(180deg)
}
.arrow-icon,
.arrow-icon-right {
 background-repeat:no-repeat;
 width:31px;
 height:20px;
 position:absolute
}
.arrow-icon-right {
 background-image:url("data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTUiIGhlaWdodD0iMTIiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PHBhdGggZD0iTS43NSA1LjI1N2gxMS42OUw4LjQxNiAxLjI2OWEuNzM5LjczOSAwIDAxMC0xLjA1MS43NTUuNzU1IDAgMDExLjA2IDBsNS4zMDMgNS4yNTZhLjc0NC43NDQgMCAwMS4wOTQuMTE0Yy4wMTIuMDE5LjAyMS4wMzkuMDMyLjA1OC4wMTIuMDIzLjAyNi4wNDUuMDM2LjA3LjAxLjAyNS4wMTcuMDUuMDI1LjA3Ny4wMDYuMDIuMDE0LjA0LjAxOC4wNjEuMDEuMDQ5LjAxNS4wOTcuMDE1LjE0NnYuMDAyYS43MjkuNzI5IDAgMDEtLjAxNS4xNDRjLS4wMDQuMDIyLS4wMTMuMDQzLS4wMi4wNjQtLjAwNy4wMjUtLjAxMi4wNS0uMDIyLjA3NC0uMDExLjAyNi0uMDI2LjA1LS4wNC4wNzQtLjAxLjAxOC0uMDE3LjAzNy0uMDMuMDU0YS43NDQuNzQ0IDAgMDEtLjA5My4xMTRsLTUuMzAzIDUuMjU2YS43NTUuNzU1IDAgMDEtMS4wNiAwIC43NC43NCAwIDAxMC0xLjA1MWw0LjAyMi0zLjk4N0guNzVBLjc0Ny43NDcgMCAwMTAgNmMwLS40MS4zMzYtLjc0My43NS0uNzQzeiIgZmlsbD0iI0ZGRiIgZmlsbC1ydWxlPSJldmVub2RkIi8+PC9zdmc+");
 background-position:10px 5px;
 right:6px
}
div.sticky {
 position:-webkit-sticky;
 position:sticky;
 top:0;
 z-index:9
}
.like-covers {
 display:flex;
 font-size:14px;
 margin-left:20px;
 width:calc(100% - 40px)!important;
 margin-right:20px!important;
 align-items:center;
 justify-content:center;
 flex-direction:row;
 line-height:26px
}
.no-usp {
 height:26px;
 float:left
}
.span_compare_usp {
 display:inline-block!important;
 float:left
}
.usp_image {
 float:left;
 background:url("data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyOSIgaGVpZ2h0PSIyOSI+PGcgZmlsbD0ibm9uZSIgZGF0YS1uYW1lPSJrYXRtYW4gMiI+PHBhdGggZGF0YS1uYW1lPSJQYXRoIDIiIGQ9Ik0xNS41NjkgMjQuNzU1djEuMTNhLjg5Ljg5IDAgMDEtLjg5Ljg5aC0uODlhLjg5Ljg5IDAgMDEtLjg5LS44OXYtMS4xM2ExLjc3OSAxLjc3OSAwIDAwLjg5LjI0aC44OWExLjc3OSAxLjc3OSAwIDAwLjg5LS4yNHoiIHN0cm9rZT0iIzQzNGE1NCIgc3Ryb2tlLWxpbmVjYXA9InJvdW5kIiBzdHJva2UtbGluZWpvaW49InJvdW5kIi8+PHBhdGggZGF0YS1uYW1lPSJQYXRoIDMiIGQ9Ik0xNi40NTkgMjEuNDM3djEuNzc5YTEuNzc5IDEuNzc5IDAgMDEtMS43NzkgMS43NzloLS44OWExLjc3OSAxLjc3OSAwIDAxLTEuNzc5LTEuNzc5di0xLjc3OXoiIHN0cm9rZT0iIzQzNGE1NCIgc3Ryb2tlLWxpbmVjYXA9InJvdW5kIiBzdHJva2UtbGluZWpvaW49InJvdW5kIi8+PHBhdGggZGF0YS1uYW1lPSJQYXRoIDQiIGQ9Ik0yMC45MDcgMTIuMDE1YTYuNjczIDYuNjczIDAgMDEtMi41IDUuMjg5IDUgNSAwIDAwLTEuOTQ1IDMuODg0di4yNDlIMTIuMDF2LS4yNDlhNC43MzggNC43MzggMCAwMC0xLjgxNS0zLjc4MSA2LjY3MyA2LjY3MyAwIDExMTAuNzEyLTUuMzkxeiIgc3Ryb2tlPSIjNDM0YTU0IiBzdHJva2UtbGluZWNhcD0icm91bmQiIHN0cm9rZS1saW5lam9pbj0icm91bmQiLz48cGF0aCBkYXRhLW5hbWU9IkxpbmUgMiIgc3Ryb2tlPSIjNDM0YTU0IiBzdHJva2UtbGluZWNhcD0icm91bmQiIHN0cm9rZS1saW5lam9pbj0icm91bmQiIGQ9Ik0xMyAyMC45OTl2LTUiLz48cGF0aCBkYXRhLW5hbWU9IkxpbmUgMyIgc3Ryb2tlPSIjNDM0YTU0IiBzdHJva2UtbGluZWNhcD0icm91bmQiIHN0cm9rZS1saW5lam9pbj0icm91bmQiIGQ9Ik0xNSAyMC45OTl2LTUiLz48cGF0aCBkYXRhLW5hbWU9IkxpbmUgNCIgc3Ryb2tlPSIjNDM0YTU0IiBzdHJva2UtbGluZWNhcD0icm91bmQiIHN0cm9rZS1saW5lam9pbj0icm91bmQiIGQ9Ik0xMyAxNS45OTlsLTMtMyIvPjxwYXRoIGRhdGEtbmFtZT0iTGluZSA1IiBzdHJva2U9IiM0MzRhNTQiIHN0cm9rZS1saW5lY2FwPSJyb3VuZCIgc3Ryb2tlLWxpbmVqb2luPSJyb3VuZCIgZD0iTTE1IDE1Ljk5OWwzLTMiLz48cGF0aCBkYXRhLW5hbWU9IkxpbmUgNiIgc3Ryb2tlPSIjNDM0YTU0IiBzdHJva2UtbGluZWNhcD0icm91bmQiIHN0cm9rZS1saW5lam9pbj0icm91bmQiIGQ9Ik0xNSAzLjk5OXYtMiIvPjxwYXRoIGRhdGEtbmFtZT0iTGluZSA3IiBzdHJva2U9IiM0MzRhNTQiIHN0cm9rZS1saW5lY2FwPSJyb3VuZCIgc3Ryb2tlLWxpbmVqb2luPSJyb3VuZCIgZD0iTTguNTcyIDYuNDMyTDcuMzEzIDUuMTczIi8+PHBhdGggZGF0YS1uYW1lPSJMaW5lIDgiIHN0cm9rZT0iIzQzNGE1NCIgc3Ryb2tlLWxpbmVjYXA9InJvdW5kIiBzdHJva2UtbGluZWpvaW49InJvdW5kIiBkPSJNNiAxMi45OTlINCIvPjxwYXRoIGRhdGEtbmFtZT0iTGluZSA5IiBzdHJva2U9IiM0MzRhNTQiIHN0cm9rZS1saW5lY2FwPSJyb3VuZCIgc3Ryb2tlLWxpbmVqb2luPSJyb3VuZCIgZD0iTTIzIDEyLjk5OWgxIi8+PHBhdGggZGF0YS1uYW1lPSJMaW5lIDEwIiBzdHJva2U9IiM0MzRhNTQiIHN0cm9rZS1saW5lY2FwPSJyb3VuZCIgc3Ryb2tlLWxpbmVqb2luPSJyb3VuZCIgZD0iTTE5Ljg5OCA2LjQzMmwxLjI1OS0xLjI1OSIvPjxwYXRoIGRhdGEtbmFtZT0iUmVjdGFuZ2xlIDEiIGQ9Ik0wLS4wMDFoMjl2MjlIMHoiLz48L2c+PC9zdmc+") no-repeat 0 -2px;
 margin-right:5px!important;
 width:26px!important;
 height:26px
}
.add-plan-button {
 background-color:#ff5630!important;
 margin-top:12px
}
.close {
 position:absolute!important;
 right:41px;
 font-size:29px!important;
 top:74px!important
}
.not-cover {
 font-size:35px!important;
 margin-bottom:0!important;
 color:#e6274b!important;
 margin-top:-18px
}
.close_plan {
 top:-8px!important;
 font-size:19px!important
}
.greybg-win {
 background-color:#e2e2e2
}
.shrink_box .top_fixed_box p {
 font-size:13px;
 font-weight:400;
 padding-bottom:0;
 padding-left:10px;
 padding-right:10px
}
.shrink_box .top_fixed_box a {
 font-size:12px;
 top:sticky -23px
}
.shrink_box .top_fixed_box {
 padding-top:26px
}
.shrink_box .difference_column .column {
 padding:0 0 10px
}
.shrink_box .difference_column button {
 width:192px;
 height:36px
}
.shrink_box .tip-plan {
 display:none
}
.shrink_box .checkbox_label {
 bottom:36px
}
.shrink_box .add-plan-button {
 margin-top:0
}
.edit-plan {
 background-image:url("data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTkiIGhlaWdodD0iMTkiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PHBhdGggZD0iTS43MzYgMTQuNEwwIDE5bDQuNTkyLS43MzguNDU2LS40OTFMMTkgMy44MjggMTUuMTQ0IDAgMS4yMjcgMTMuOTQzbC0uNDkuNDU2em0xLjAzNS42NjlsMi4xNiAyLjE5Ni0yLjYyLjQyNS40Ni0yLjYyMXpNMTcuNjkgMy43NThsLTEuNDYgMS40ODMtMi40NzEtMi40ODQgMS40OTctMS40NDcgMi40MzQgMi40NDh6bS00LjMyNi0uNDgybDIuMzYgMi4zNkw0Ljk0NSAxNi4zNzlsLTIuMzI0LTIuMzZMMTMuMzY0IDMuMjc2eiIgZmlsbD0iI0ZGRiIgZmlsbC1ydWxlPSJub256ZXJvIi8+PC9zdmc+");
 background-repeat:no-repeat;
 width:19px;
 height:19px;
 background-position:0 0;
 text-indent:-999999px;
 left:11px;
 padding:0;
 top:-10px!important
}
.modal-card,
.modal-content {
 width:800px
}
.box_block {
 height:95px
}
.img-box-logo {
 height:45px
}
.img-box-logo .compare_logo {
 max-height:100%;
 width:auto!important
}
.edit-plan-close {
 width:19px;
 height:19px;
 right:31px;
 padding:0;
 top:-71px!important;
 font-size:29px!important;
 position:absolute!important
}
.box-plan-2 {
 position:relative
}
.tooltip.is-tooltip-active:before,
.tooltip.is-tooltip-active:not(.is-loading):after,
.tooltip:hover:before,
.tooltip:hover:not(.is-loading):after {
 z-index:10!important;
 white-space:pre-line
}
.tooltip.is-tooltip-active:before,
.tooltip:hover:before {
 font-size:12px;
 line-height:18px
}
.tooltip.is-tooltip-multiline:before {
 min-width:14rem!important;
 white-space:pre-line!important
}
.button.is-loading {
 color:#fff!important;
 pointer-events:none
}
.button.is-loading:after {
 left:5px
}
.has-text-weight-bold {
 font-weight:400!important
}
.tip-plan {
 position:absolute!important;
 top:159px!important;
 right:45px
}
.tip-plan span {
 background-image:url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAA4AAAAOCAYAAAFoTx1HAAAAAXNSR0IArs4c6QAAAU1JREFUKBVdkj9LA0EQxe9CwIufQiSVrRCx09Z8BFvF1i8iYmVhIyksbYxgZ20hooUGcjEWYmmjMf4p1t+bm70sGXg3b9682bvdvSwjQggX9oCUIntSc0gQMQX+Dn5TUbxyuOuJumi4OkKcatYsyg2UNRfUtZW/XJCzFCc6KrSY4s6NsRnULKwVQt+WqVaSVFoNaYE+GIDdaNLkOlAMJFY0TMRn+82yS9VgSw1iJzo1sCnFJ5UetK8Yx5F4Hso5ki02oFeqiQXTIM9Wzh6r0RwN+uqx9z/IR46Ja3pDJw41KVoUj2ApiuQ/8OK1uGIZ3OAfk1f0rTq0NOoTlptGfQ2J6Vwn0JYhiS4GO+REm6dtDR7Mqa/UvUQ7hb8ltehhM8/zE95wT3ENFsEU6HfaJys+wbexim8wc6trrQNzQbENuiBuYQjXvs8Y+CFb/AMVT16BbbD17AAAAABJRU5ErkJggg==");
 background-repeat:no-repeat;
 width:16px;
 height:19px;
 background-position:0 2px;
 text-indent:-999999px;
 display:block
}
.tooltip.tip-plan.is-tooltip-multiline:before {
 min-width:15rem
}
.select:not(.is-multiple) {
 height:1.25em
}
.blk-footer {
 display:block
}
.select-top {
 width:250px;
 color:#212121;
 font-size:14px;
 padding:0 5px;
 margin-top:12px;
 text-align:left
}
span.plan-2 {
 height:52px;
 display:block;
 padding-right:10px;
 padding-left:10px
}
.css-15k3avv {
 width:97%!important;
 top:80%!important
}
.add_plan {
 height:90px;
 cursor:pointer
}
.css-wqgs6e {
 background-color:#e7faf7
}
.shrink_box .add_plan {
 height:93px;
 cursor:pointer
}
.shrink_box .close {
 top:66px!important
}
.img-box-logo-similar {
 height:50px;
 margin-bottom:8px
}
.img-box-logo-similar img {
 width:100px;
 height:50px;
 object-fit:contain
}
.button[disabled] {
 border:1px solid #cacaca!important;
 color:#cacaca!important
}
select.select:focus {
 outline:none
}
.span_saves {
 display:block;
 font-size:12px;
 font-weight:400;
 padding-top:2px;
 color:#f87753
}
.top_fixed_box_port {
 background-color:#fff;
 border-radius:8px 8px 0 0
}
.title_port_h2 {
 font-size:2.5rem;
 color:#000;
 margin:10px 0 0;
 font-weight:500
}
.subtitle_port_h1 {
 font-size:1.125rem;
 font-style:italic;
 margin:0 0 15px
}
.footer-desk {
 padding:15px 0
}
.port-box {
 margin-bottom:30px;
 box-shadow:none
}
.checkbox_label_port {
 position:absolute;
 cursor:pointer;
 top:9px;
 left:37px;
 text-transform:capitalize
}
.checkbox_label_port input {
 visibility:hidden
}
.checkbox_label_port:hover input~.checkbox_custm_port {
 background-color:#fff
}
.checkbox_custm_port:after {
 content:"";
 position:absolute;
 display:none
}
.checkbox_label_port input:checked~.checkbox_custm_port:after {
 display:block;
 -webkit-transform:rotate(45deg);
 transform:rotate(45deg);
 position:absolute;
 border-spacing:0;
 border:2px solid #35b8a5;
 border-top:0;
 border-left:0;
 content:"";
 height:15px;
 left:8px;
 top:2px;
 width:7px
}
.checkbox_label_port .checkbox_custm_port:after {
 left:9px;
 top:5px;
 width:5px;
 height:10px;
 border:solid #fff;
 border-width:0 3px 3px 0;
 -webkit-transform:rotate(45deg);
 -ms-transform:rotate(45deg);
 transform:rotate(45deg)
}
.checkbox_custm_port {
 transition:.24s;
 position:absolute;
 top:4px;
 left:-21px;
 border-radius:4px;
 height:24px;
 width:24px;
 background:#fff;
 border:1px solid #35b8a5
}
.checkbox_port {
 width:15px;
 height:15px;
 margin:9px 0;
 border:1px solid #979797;
 border-radius:3px
}
.img-box-port {
 height:50px
}
.add_plan_port a {
 color:#35b8a5;
 top:20px;
 text-decoration:none;
 font-size:32px;
 border:1px solid #35b8a5;
 padding:0;
 border-radius:50%;
 width:57px;
 height:57px;
 display:inline-block;
 text-align:center;
 align-items:center;
 line-height:49px
}
.mt5 {
 margin-top:5px
}
.add_plan_port a:hover {
 color:#35b8a5
}
.bdr-select {
 border:1px solid #7d7979!important;
 margin-bottom:15px!important
}
.difference_column_port .column {
 padding:0!important
}
.close-port {
 right:10px;
 font-size:29px!important;
 top:-3px!important;
 color:#50b8a5!important;
 position:absolute!important
}
.port-bot-fixed {
 background:#e3fbf8;
 width:100%;
 height:105px;
 position:fixed;
 box-shadow:6px 8px 16px 0 rgba(0,0,0,.25);
 bottom:0;
 display:flex;
 align-items:center;
 justify-content:center;
 color:#232222;
 font-size:1.3125rem;
 font-style:italic;
 font-weight:400
}
.port-compare-button {
 background:#f87753;
 border:0;
 width:225px;
 margin:0 0 0 79px;
 height:42px
}
.footer-desk {
 clear:both;
 padding:15px 0 0
}
.sticky-port {
 position:-webkit-sticky;
 position:sticky;
 top:0;
 z-index:9
}
.button-port {
 width:223px;
 height:41px;
 border-radius:7px;
 background-color:#f87753;
 font-size:14px;
 font-weight:600;
 color:#fff;
 border:none;
 position:relative
}
.pb-dialog-content {
 background-color:#fff;
 margin:auto;
 width:635px;
 height:auto;
 border-radius:5px;
 padding:0;
 position:relative
}
.card-upper-desk {
 background:#36c2a9;
 color:#fff;
 font-size:1rem;
 border-radius:5px 5px 0 0;
 padding:16px 19px;
 text-align:left;
 margin:0
}
.members-box {
 padding:20px 17px 0;
 position:relative
}
.listing-member-desk {
 position:relative;
 border:1px solid #979797;
 border-radius:4px;
 width:45%;
 padding:0 6px 0 10px;
 line-height:24px;
 height:48px;
 align-items:center;
 float:left;
 margin:0 20px 20px 0
}
.listing-member-desk:nth-child(2n) {
 margin:0 0 20px;
 float:right
}
.listing-member-desk [type=checkbox]:checked,
.listing-member-desk [type=checkbox]:not(:checked) {
 position:absolute;
 left:-9999px
}
.listing-member-desk [type=checkbox]:checked+label,
.listing-member-desk [type=checkbox]:not(:checked)+label {
 position:relative;
 padding-left:35px;
 cursor:pointer;
 padding-top:6px
}
.listing-member-desk [type=checkbox]:not(:checked)+label:before {
 content:"";
 position:absolute;
 left:0;
 top:0;
 width:32px;
 height:32px;
 border:0 solid #ccc;
 background:#fff;
 border-radius:4px;
 background:#eaeaea
}
.listing-member-desk [type=checkbox]:checked+label:before {
 content:"";
 position:absolute;
 left:0;
 top:0;
 width:32px;
 height:32px;
 border:0 solid #ccc;
 border-radius:4px;
 background:#36c2a9
}
.listing-member-desk [type=checkbox]:checked+label:after,
.listing-member-desk [type=checkbox]:not(:checked)+label:after {
 position:absolute;
 top:0;
 left:6px;
 background-image:url("data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTYiIGhlaWdodD0iMTIiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PHBhdGggZD0iTTE0LjgyNyAxLjE3NGEuNTg2LjU4NiAwIDAwLS44MzIgMGwtOC4zMjkgOC40LTMuNjYxLTMuNjY2YS41ODYuNTg2IDAgMDAtLjgzMyAwIC41OTQuNTk0IDAgMDAwIC44MzdsNC4wOCA0LjA4NGEuNTkyLjU5MiAwIDAwLjgzMyAwbDguNzQyLTguODE5YS41OTMuNTkzIDAgMDAwLS44MzZjLS4yMy0uMjMyLjIzLjIzIDAgMHoiIGZpbGw9IiNGRkYiIHN0cm9rZT0iI0ZGRiIgc3Ryb2tlLXdpZHRoPSIuNSIgZmlsbC1ydWxlPSJldmVub2RkIi8+PC9zdmc+");
 background-repeat:no-repeat;
 width:20px;
 height:31px;
 background-position:2px 10px;
 content:""
}
.listing-member-desk [type=checkbox]:disabled:checked+label:before,
.listing-member-desk [type=checkbox]:disabled:not(:checked)+label:before {
 box-shadow:none;
 border-color:#bbb;
 background-color:#ddd
}
.listing-member-desk [type=checkbox]:disabled:checked+label:after {
 color:#999
}
.listing-member-desk [type=checkbox]:disabled+label {
 color:#aaa
}
.listing-member-desk [type=checkbox]:checked:focus+label:before,
.listing-member-desk [type=checkbox]:not(:checked):focus+label:before {
 border:0 dotted #00f
}
label:hover:before {
 border:0 solid #4778d9!important
}
.listing-member-desk .media-content {
 line-height:48px;
 font-size:.875rem;
 color:#979797;
 font-weight:600
}
.listing-member-desk .media-right {
 line-height:44px
}
.pointer {
 cursor:pointer
}
.box-in {
 width:25px;
 height:27px;
 text-align:center
}
.add-child {
 font-weight:600;
 position:absolute;
 top:10%;
 right:17%;
 border:1px solid #eaeaea;
 border-radius:4px;
 font-size:14px;
 padding:4px;
 z-index:9
}
.add-child input {
 width:25px;
 height:27px;
 background:none;
 border:none;
 outline:none;
 cursor:pointer
}
.members-box2 {
 padding:0 20px 10px;
 overflow:hidden;
 text-align:center;
 float:left;
 width:100%;
 margin-top:20px
}
.button-box2 {
 background-color:#fc4804!important;
 font-weight:400;
 height:45px;
 border-radius:4px;
 color:#fff!important;
 width:250px!important;
 font-size:14px!important;
 text-align:center
}
.title-dropdown-age {
 float:left;
 margin-top:-2px;
 background-position:98px 24px;
 width:118px;
 height:50px;
 background-size:8%;
 font-size:12px;
 color:#000!important;
 border:none;
 font-weight:700;
 background-image:url("data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTEiIGhlaWdodD0iOCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cGF0aCBkPSJNMS4yOTcuNDJMNS41IDQuNjQzIDkuNzAzLjQyIDExIDEuNzIzIDUuNSA3LjI1IDAgMS43MjN6IiBmaWxsPSIjOTc5Nzk3IiBmaWxsLXJ1bGU9ImV2ZW5vZGQiLz48L3N2Zz4=");
 background-repeat:no-repeat;
 background-color:transparent;
 outline:0;
 -webkit-appearance:none;
 -moz-appearance:none;
 appearance:none;
 -webkit-transition:all .3s ease-in-out;
 -moz-transition:all .3s ease-in-out;
 -ms-transition:all .3s ease-in-out;
 -o-transition:all .3s ease-in-out;
 outline:none
}
.font-light {
 color:#979797!important
}
.font-dark {
 color:#000!important
}
.cityinput {
 width:47%;
 float:left;
 margin:0;
 position:relative
}
.cityinput:nth-child(2n) {
 float:right
}
.cityinput label {
 color:#212121;
 font-weight:450;
 font-size:.875rem;
 margin:0 0 6px
}
.blk {
 display:block
}
.pb10 {
 padding-bottom:10px
}
.cityinput input[type=text] {
 font-size:.875rem;
 height:48px;
 border-radius:4px;
 box-shadow:none;
 padding-left:12px
}
.min-box {
 min-height:354px!important
}
.mt50 {
 margin-top:50px
}
.green-text {
 color:#35b8a5;
 margin-bottom:5px!important
}
.add-member {
 background-repeat:no-repeat;
 background-position:1px 6px;
 width:36px;
 margin-left:-2px;
 height:38px;
 text-indent:-99999px;
 background-image:url("data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMzIiIGhlaWdodD0iMzIiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGcgZmlsbD0ibm9uZSIgZmlsbC1ydWxlPSJldmVub2RkIj48cmVjdCBmaWxsPSIjRUFFQUVBIiB3aWR0aD0iMzIiIGhlaWdodD0iMzIiIHJ4PSI0Ii8+PHRleHQgZm9udC1mYW1pbHk9IkF2ZW5pci1IZWF2eSwgQXZlbmlyIiBmb250LXNpemU9IjE4IiBmb250LXdlaWdodD0iNjAwIiBmaWxsPSIjRkZGIj48dHNwYW4geD0iMTAiIHk9IjIyIj4rPC90c3Bhbj48L3RleHQ+PC9nPjwvc3ZnPg==");
 cursor:pointer
}
.error-port-prequote {
 float:right;
 color:red;
 font-size:11px;
 margin-top:-7px;
 margin-right:21px;
 width:100%;
 text-align:right;
 margin-bottom:10px
}
.error-port-2 {
 margin-right:-6px
}
.error-port-3 {
 margin-right:1px;
 margin-top:0;
 margin-bottom:0
}
.mt31 {
 margin-top:31px
}
.modal-box-new {
 width:auto!important
}
.button-gender {
 background:#fff;
 width:46.5%;
 height:45px;
 color:#fff;
 border:1px solid #979797;
 border-radius:4px;
 margin-left:0;
 margin-top:30px;
 line-height:44px;
 font-size:16px;
 color:#a5a5a5
}
.button-gender:hover {
 color:#a5a5a5
}
.button-gender.active {
 background-image:-webkit-linear-gradient(20deg,#5bd6c7,#32b39c);
 background-image:-o-linear-gradient(20deg,#5bd6c7,#32b39c);
 background-image:linear-gradient(110deg,#5bd6c7,#32b39c);
 margin-top:30px;
 color:#fff;
 border:none;
 line-height:44px
}
.button-gender:hover.active {
 color:#fff
}
.mr-35 {
 margin-right:7%
}
.male-icon {
 background:url("data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PHBhdGggZD0iTTEuNDM2IDI0aDE3LjEyOGwuMDQ5LS4yNTFjLjA5LS40NzIuODYtNC42NDMtLjA2Mi01LjgwNC0uNTYxLS43MDYtMi4yMTYtMS4xODUtNC45MTgtMS40MjNhMS41NzIgMS41NzIgMCAwMS0uOTQtLjQyNi4zMDYuMzA2IDAgMDAtLjA3My0uMDc0bC0uMDA0LS4wMDNhMS42MDggMS42MDggMCAwMS0uNDI2LS45NTJsLS4wOC0uODljMS4xMzQtLjY3OCAxLjk5MS0xLjg1NiAyLjM0My0zLjI2OC4wMjUuMDA2LjA0OC4wMTUuMDc0LjAxNWExLjIxNyAxLjIxNyAwIDAwMS4wODctMS43NDkuMzEuMzEgMCAwMC4wODYtLjEzIDYuMTI0IDYuMTI0IDAgMDAuMzIxLTEuOTY0QzE2LjAyMSAzLjcyOCAxMy4zMjEgMSAxMCAxIDYuNjggMSAzLjk3OSAzLjcyOCAzLjk3OSA3LjA4MWMwIC42NDUuMSAxLjI4LjI5OCAxLjg5YTEuMjE2IDEuMjE2IDAgMDAuOTk5IDEuOWwuMDItLjAwMWMuMzY4IDEuNTI0IDEuMzI1IDIuNzc1IDIuNTgzIDMuNDMybC0uMDY5Ljc2NWMtLjAzMy4zNjktLjE5LjY5OC0uNDI2Ljk1MmwtLjAwNC4wMDNhLjMwNi4zMDYgMCAwMC0uMDcyLjA3NCAxLjU3MiAxLjU3MiAwIDAxLS45NC40MjZjLTIuNzAzLjIzOC00LjM1OC43MTctNC45MTkgMS40MjMtLjkyMiAxLjE2LS4xNTMgNS4zMzItLjA2MiA1LjgwNGwuMDQ5LjI1MXptOC4xOTctLjYyMlYxOC42NWwuMzY3LS4zMTYuMzY3LjMxNnY0LjcyOGgtLjczNHptLTEuMTEtNC41OWwtLjQ2Mi0xLjc5MiAxLjQxOC45Ny0uOTU1LjgyMnptMS45OTgtLjgyMmwxLjQxOC0uOTctLjQ2MyAxLjc5Mi0uOTU1LS44MjJ6bTcuNTUuMzY4Yy41MzQuNjcyLjI4NyAzLjM0Ni0uMDE2IDUuMDQ0aC03LjA3M1YxOS4xOGwuNDY5LjQwNGEuMzA2LjMwNiAwIDAwLjQ5Ny0uMTU5bC42NzItMi42MDNjLjI4My4xNzYuNjA5LjI5Ljk2LjMyIDIuNDIuMjE0IDQuMDU4LjY0OSA0LjQ5IDEuMTkzem0tMy41MDEtOC4wMzZjLjAzNS0uMjU1LjA1OC0uNTE0LjA2LS43NzlsLjEwNS0uMzc3YS42LjYgMCAwMS0uMTY1IDEuMTU2ek0xMCAxLjYyMmMyLjk4IDAgNS40MDYgMi40NDkgNS40MDYgNS40NiAwIC40NjEtLjA1Ny45MTctLjE3IDEuMzZhMS41MjEgMS41MjEgMCAwMC0uNzQ2LS4wNjUuMzA5LjMwOSAwIDAwLS4yNDMuMjIybC0uMTU4LjU3LS4yMDUtMS4xODdhLjMxLjMxIDAgMDAtLjI1NS0uMjU0Yy0uMjM3LS4wMzgtLjUzNS0uNjE4LS42Ni0xLjAyMmEuMzA2LjMwNiAwIDAwLS41MS0uMTNjLS43NjYuNzU3LTEuNzA4LjkyNi0yLjI1OC45NTQuMDc2LS4xOC4xMy0uMzM2LjE0LS4zNjdhLjMxMy4zMTMgMCAwMC0uMDk1LS4zNC4zMDUuMzA1IDAgMDAtLjM0OS0uMDNjLS4wMi4wMTEtMS45ODQgMS4xMjgtMy43NTguOTYyYS4zMDcuMzA3IDAgMDAtLjMzNS4yNzdsLS4xMiAxLjE0LS4yMTctLjYyMmEuMzEuMzEgMCAwMC0uMjktLjIwNy4zMDUuMzA1IDAgMDAtLjE1LjA0bC0uMjQzLjEzNWE1LjUwNyA1LjUwNyAwIDAxLS4xOS0xLjQzN2MwLTMuMDEgMi40MjUtNS40NiA1LjQwNi01LjQ2ek00LjkwOCAxMC4xMmEuNjAxLjYwMSAwIDAxLjEwMy0xLjAwNWwuMTIuMzRjMCAuMDEtLjAwNS4wMTgtLjAwNS4wMjggMCAuMjU3LjAyMi41MDguMDUzLjc1NmEuNTg1LjU4NSAwIDAxLS4yNy0uMTE5em0uOTAxLjE5aC4wMDlhLjQ2OS40NjkgMCAwMC40MS0uNDJsLjE1OC0xLjQ5OGMxLjE1LjAzIDIuMjkzLS4zNTggMy4wMjYtLjY3M2EuMzE0LjMxNCAwIDAwLjAwNC4yMy4zMDguMzA4IDAgMDAuMjQxLjE4OGMuMDcuMDEgMS41NzcuMjA0IDIuODg4LS44MTQuMTUyLjM0LjQwNS43Ny43NjQuOTQ3bC4yODQgMS42NDljLjAzMy4xOS4xNzYuMzMuMzU3LjM3My0uMjM1IDEuNTI3LTEuMTIgMi44LTIuMzIgMy40NGEzLjg5NSAzLjg5NSAwIDAxLS4zNzYuMTc2bC0uMDIuMDA4YTMuNzcgMy43NyAwIDAxLS4zOC4xMjdsLS4wMzQuMDFhMy42ODQgMy42ODQgMCAwMS0uMzU3LjA3NWwtLjA3LjAxMmEzLjYzOCAzLjYzOCAwIDAxLS4zMTguMDI5Yy0uMDM5LjAwMi0uMDc3LjAwNi0uMTE2LjAwN2EzLjYyNiAzLjYyNiAwIDAxLS4yOTItLjAwOGMtLjA0NC0uMDAyLS4wODktLjAwMy0uMTMzLS4wMDhhMy42NiAzLjY2IDAgMDEtLjI5Ni0uMDQyYy0uMDQtLjAwNy0uMDc5LS4wMTItLjExNy0uMDJhMy43MTIgMy43MTIgMCAwMS0uMzEzLS4wODNjLS4wMy0uMDEtLjA2Mi0uMDE3LS4wOTMtLjAyN2EzLjgwMiAzLjgwMiAwIDAxLS4zMy0uMTNjLS4wMjgtLjAxMi0uMDU3LS4wMjItLjA4NS0uMDM1bC0uMDQ1LS4wMmMtMS4yNjEtLjYxNC0yLjE5OC0xLjkyLTIuNDQ2LTMuNDkzem0yLjc3IDQuMjg1Yy4xLjAzMS4xOTguMDYyLjI5OC4wODYuMDYuMDE0LjEyLjAyNC4xOC4wMzZhNC4yNCA0LjI0IDAgMDAuNDQyLjA2M2MuMDg3LjAwOC4xNzMuMDEzLjI2LjAxNS4wNC4wMDEuMDc5LjAwNy4xMi4wMDcuMDIyIDAgLjA0NC0uMDA0LjA2Ny0uMDA0LjA5MS0uMDAxLjE4Mi0uMDA4LjI3My0uMDE1YTQuMjYgNC4yNiAwIDAwLjI4Mi0uMDMyYy4wOTQtLjAxNC4xODctLjAyOC4yOC0uMDQ4LjA4NC0uMDE4LjE2Ni0uMDQyLjI0OS0uMDY1bC4xNTgtLjA0NmMuMDktLjAyOS4xNzctLjA2Mi4yNjQtLjA5Ni4wMjItLjAwOS4wNDUtLjAxNS4wNjYtLjAyNGwuMDU5LjY1Yy4wMzYuNDA4LjE4Ljc4Mi40MDEgMS4wOTZMMTAgMTcuNTcybC0xLjk3OC0xLjM1NGMuMjIyLS4zMTQuMzY1LS42ODguNDAxLTEuMDk1bC4wNS0uNTU5Yy4wMzUuMDEyLjA3Mi4wMi4xMDcuMDMxem0tNi42NSAzLjc0Yy40MzMtLjU0NSAyLjA3LS45OCA0LjQ5Mi0xLjE5My4zNS0uMDMxLjY3Ni0uMTQ1Ljk2LS4zMjFsLjY3IDIuNjAzYS4zMS4zMSAwIDAwLjI5OS4yMzMuMzA2LjMwNiAwIDAwLjItLjA3NGwuNDY4LS40MDR2NC4ySDEuOTQ1Yy0uMzAzLTEuNy0uNTUtNC4zNzMtLjAxNi01LjA0NXoiIGZpbGw9IiM5Nzk3OTciIGZpbGwtcnVsZT0ibm9uemVybyIgc3Ryb2tlPSIjOTc5Nzk3IiBzdHJva2Utd2lkdGg9Ii41Ii8+PC9zdmc+") 0 0 no-repeat!important;
 width:20px;
 height:24px;
 margin:0 7px 0 0
}
.button-gender.active .male-icon {
 background:url("data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PHBhdGggZD0iTTEuNDM2IDI0aDE3LjEyOGwuMDQ5LS4yNTFjLjA5LS40NzIuODYtNC42NDMtLjA2Mi01LjgwNC0uNTYxLS43MDYtMi4yMTYtMS4xODUtNC45MTgtMS40MjNhMS41NzIgMS41NzIgMCAwMS0uOTQtLjQyNi4zMDYuMzA2IDAgMDAtLjA3My0uMDc0bC0uMDA0LS4wMDNhMS42MDggMS42MDggMCAwMS0uNDI2LS45NTJsLS4wOC0uODljMS4xMzQtLjY3OCAxLjk5MS0xLjg1NiAyLjM0My0zLjI2OC4wMjUuMDA2LjA0OC4wMTUuMDc0LjAxNWExLjIxNyAxLjIxNyAwIDAwMS4wODctMS43NDkuMzEuMzEgMCAwMC4wODYtLjEzIDYuMTI0IDYuMTI0IDAgMDAuMzIxLTEuOTY0QzE2LjAyMSAzLjcyOCAxMy4zMjEgMSAxMCAxIDYuNjggMSAzLjk3OSAzLjcyOCAzLjk3OSA3LjA4MWMwIC42NDUuMSAxLjI4LjI5OCAxLjg5YTEuMjE2IDEuMjE2IDAgMDAuOTk5IDEuOWwuMDItLjAwMWMuMzY4IDEuNTI0IDEuMzI1IDIuNzc1IDIuNTgzIDMuNDMybC0uMDY5Ljc2NWMtLjAzMy4zNjktLjE5LjY5OC0uNDI2Ljk1MmwtLjAwNC4wMDNhLjMwNi4zMDYgMCAwMC0uMDcyLjA3NCAxLjU3MiAxLjU3MiAwIDAxLS45NC40MjZjLTIuNzAzLjIzOC00LjM1OC43MTctNC45MTkgMS40MjMtLjkyMiAxLjE2LS4xNTMgNS4zMzItLjA2MiA1LjgwNGwuMDQ5LjI1MXptOC4xOTctLjYyMlYxOC42NWwuMzY3LS4zMTYuMzY3LjMxNnY0LjcyOGgtLjczNHptLTEuMTEtNC41OWwtLjQ2Mi0xLjc5MiAxLjQxOC45Ny0uOTU1LjgyMnptMS45OTgtLjgyMmwxLjQxOC0uOTctLjQ2MyAxLjc5Mi0uOTU1LS44MjJ6bTcuNTUuMzY4Yy41MzQuNjcyLjI4NyAzLjM0Ni0uMDE2IDUuMDQ0aC03LjA3M1YxOS4xOGwuNDY5LjQwNGEuMzA2LjMwNiAwIDAwLjQ5Ny0uMTU5bC42NzItMi42MDNjLjI4My4xNzYuNjA5LjI5Ljk2LjMyIDIuNDIuMjE0IDQuMDU4LjY0OSA0LjQ5IDEuMTkzem0tMy41MDEtOC4wMzZjLjAzNS0uMjU1LjA1OC0uNTE0LjA2LS43NzlsLjEwNS0uMzc3YS42LjYgMCAwMS0uMTY1IDEuMTU2ek0xMCAxLjYyMmMyLjk4IDAgNS40MDYgMi40NDkgNS40MDYgNS40NiAwIC40NjEtLjA1Ny45MTctLjE3IDEuMzZhMS41MjEgMS41MjEgMCAwMC0uNzQ2LS4wNjUuMzA5LjMwOSAwIDAwLS4yNDMuMjIybC0uMTU4LjU3LS4yMDUtMS4xODdhLjMxLjMxIDAgMDAtLjI1NS0uMjU0Yy0uMjM3LS4wMzgtLjUzNS0uNjE4LS42Ni0xLjAyMmEuMzA2LjMwNiAwIDAwLS41MS0uMTNjLS43NjYuNzU3LTEuNzA4LjkyNi0yLjI1OC45NTQuMDc2LS4xOC4xMy0uMzM2LjE0LS4zNjdhLjMxMy4zMTMgMCAwMC0uMDk1LS4zNC4zMDUuMzA1IDAgMDAtLjM0OS0uMDNjLS4wMi4wMTEtMS45ODQgMS4xMjgtMy43NTguOTYyYS4zMDcuMzA3IDAgMDAtLjMzNS4yNzdsLS4xMiAxLjE0LS4yMTctLjYyMmEuMzEuMzEgMCAwMC0uMjktLjIwNy4zMDUuMzA1IDAgMDAtLjE1LjA0bC0uMjQzLjEzNWE1LjUwNyA1LjUwNyAwIDAxLS4xOS0xLjQzN2MwLTMuMDEgMi40MjUtNS40NiA1LjQwNi01LjQ2ek00LjkwOCAxMC4xMmEuNjAxLjYwMSAwIDAxLjEwMy0xLjAwNWwuMTIuMzRjMCAuMDEtLjAwNS4wMTgtLjAwNS4wMjggMCAuMjU3LjAyMi41MDguMDUzLjc1NmEuNTg1LjU4NSAwIDAxLS4yNy0uMTE5em0uOTAxLjE5aC4wMDlhLjQ2OS40NjkgMCAwMC40MS0uNDJsLjE1OC0xLjQ5OGMxLjE1LjAzIDIuMjkzLS4zNTggMy4wMjYtLjY3M2EuMzE0LjMxNCAwIDAwLjAwNC4yMy4zMDguMzA4IDAgMDAuMjQxLjE4OGMuMDcuMDEgMS41NzcuMjA0IDIuODg4LS44MTQuMTUyLjM0LjQwNS43Ny43NjQuOTQ3bC4yODQgMS42NDljLjAzMy4xOS4xNzYuMzMuMzU3LjM3My0uMjM1IDEuNTI3LTEuMTIgMi44LTIuMzIgMy40NGEzLjg5NSAzLjg5NSAwIDAxLS4zNzYuMTc2bC0uMDIuMDA4YTMuNzcgMy43NyAwIDAxLS4zOC4xMjdsLS4wMzQuMDFhMy42ODQgMy42ODQgMCAwMS0uMzU3LjA3NWwtLjA3LjAxMmEzLjYzOCAzLjYzOCAwIDAxLS4zMTguMDI5Yy0uMDM5LjAwMi0uMDc3LjAwNi0uMTE2LjAwN2EzLjYyNiAzLjYyNiAwIDAxLS4yOTItLjAwOGMtLjA0NC0uMDAyLS4wODktLjAwMy0uMTMzLS4wMDhhMy42NiAzLjY2IDAgMDEtLjI5Ni0uMDQyYy0uMDQtLjAwNy0uMDc5LS4wMTItLjExNy0uMDJhMy43MTIgMy43MTIgMCAwMS0uMzEzLS4wODNjLS4wMy0uMDEtLjA2Mi0uMDE3LS4wOTMtLjAyN2EzLjgwMiAzLjgwMiAwIDAxLS4zMy0uMTNjLS4wMjgtLjAxMi0uMDU3LS4wMjItLjA4NS0uMDM1bC0uMDQ1LS4wMmMtMS4yNjEtLjYxNC0yLjE5OC0xLjkyLTIuNDQ2LTMuNDkzem0yLjc3IDQuMjg1Yy4xLjAzMS4xOTguMDYyLjI5OC4wODYuMDYuMDE0LjEyLjAyNC4xOC4wMzZhNC4yNCA0LjI0IDAgMDAuNDQyLjA2M2MuMDg3LjAwOC4xNzMuMDEzLjI2LjAxNS4wNC4wMDEuMDc5LjAwNy4xMi4wMDcuMDIyIDAgLjA0NC0uMDA0LjA2Ny0uMDA0LjA5MS0uMDAxLjE4Mi0uMDA4LjI3My0uMDE1YTQuMjYgNC4yNiAwIDAwLjI4Mi0uMDMyYy4wOTQtLjAxNC4xODctLjAyOC4yOC0uMDQ4LjA4NC0uMDE4LjE2Ni0uMDQyLjI0OS0uMDY1bC4xNTgtLjA0NmMuMDktLjAyOS4xNzctLjA2Mi4yNjQtLjA5Ni4wMjItLjAwOS4wNDUtLjAxNS4wNjYtLjAyNGwuMDU5LjY1Yy4wMzYuNDA4LjE4Ljc4Mi40MDEgMS4wOTZMMTAgMTcuNTcybC0xLjk3OC0xLjM1NGMuMjIyLS4zMTQuMzY1LS42ODguNDAxLTEuMDk1bC4wNS0uNTU5Yy4wMzUuMDEyLjA3Mi4wMi4xMDcuMDMxem0tNi42NSAzLjc0Yy40MzMtLjU0NSAyLjA3LS45OCA0LjQ5Mi0xLjE5My4zNS0uMDMxLjY3Ni0uMTQ1Ljk2LS4zMjFsLjY3IDIuNjAzYS4zMS4zMSAwIDAwLjI5OS4yMzMuMzA2LjMwNiAwIDAwLjItLjA3NGwuNDY4LS40MDR2NC4ySDEuOTQ1Yy0uMzAzLTEuNy0uNTUtNC4zNzMtLjAxNi01LjA0NXoiIGZpbGw9IiNGRkYiIGZpbGwtcnVsZT0ibm9uemVybyIgc3Ryb2tlPSIjRkZGIiBzdHJva2Utd2lkdGg9Ii41Ii8+PC9zdmc+") 0 0 no-repeat!important
}
.female-icon {
 background:url("data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PHBhdGggZD0iTTEuNzA2IDI0SDE4Ljg5YS4zMTEuMzExIDAgMDAuMzA1LS4yNTFjLjA5NC0uNDgzLjg5LTQuNzQ1LS4wNjItNS45My0uNTE3LS42NDMtMS45MzgtMS4xMDEtNC4yMjMtMS4zNjVWMTQuNDZjMC0xIC4yNTgtMS45OTQuNzQ2LTIuODczLjUtLjkwMi43NjUtMS45MjYuNzY1LTIuOTYzYTYuMTMzIDYuMTMzIDAgMDAtMi45NzgtNS4yNDhBMy4yNTcgMy4yNTcgMCAwMDEwLjI5OCAxYy0xLjQ3NCAwLTIuNzQ5Ljk3LTMuMTQ2IDIuMzc3YTYuMTMzIDYuMTMzIDAgMDAtMi45NzcgNS4yNDhjMCAxLjAzNy4yNjQgMi4wNjEuNzY1IDIuOTYzLjQ4OC44OC43NDYgMS44NzMuNzQ2IDIuODczdjEuOTkzYy0yLjI4NS4yNjQtMy43MDYuNzIyLTQuMjIzIDEuMzY1LS45NTIgMS4xODUtLjE1NiA1LjQ0Ny0uMDYzIDUuOTNhLjMxMS4zMTEgMCAwMC4zMDYuMjUxem0zLjc3OC0xMi43MTNhNS40OTYgNS40OTYgMCAwMS0uNjg3LTIuNjYyQTUuNTEgNS41MSAwIDAxNy41NzUgMy44NWEuMzEuMzEgMCAwMC4xNDktLjE5NyAyLjYzOCAyLjYzOCAwIDAxMi41NzQtMi4wMzFjMS4yMyAwIDIuMjg4LjgzNSAyLjU3NCAyLjAzYS4zMS4zMSAwIDAwLjE0OC4xOThBNS41MSA1LjUxIDAgMDExNS44IDguNjI1YzAgLjkzMi0uMjM4IDEuODUyLS42ODcgMi42NjJhNi41NTcgNi41NTcgMCAwMC0uODI1IDMuMTc0djEuOTI4bC0uMjM0LS4wMjJhMS42NDMgMS42NDMgMCAwMS0uNTMtLjE0IDMuMjkyIDMuMjkyIDAgMDAtLjgwNS0uNzc3IDEuNjQ3IDEuNjQ3IDAgMDEtLjE2My0uNTc4bC0uMDYzLS42OTdjMS4xMzQtLjc3NyAyLjQ2NC0yLjI4IDIuNDY0LTUuMDVhLjMxMS4zMTEgMCAwMC0uMy0uMzFjLTIuNjE3LS4wODgtNC4xMzQtMi4wMDktNC4xNS0yLjAyOGEuMzEyLjMxMiAwIDAwLS40NjUtLjAzYy0uMDIuMDItMi4wMzMgMi0zLjk3NSAyLjA1N2EuMzEuMzEgMCAwMC0uMjk2LjI1Yy0uMDA3LjAzNS0uNjI4IDMuMzEgMi4zMyA1LjE2MmwtLjA1OS42NDZhMS42NDcgMS42NDcgMCAwMS0uMTYzLjU3OWMtLjM0MS4yNC0uNjEuNS0uODA1Ljc3NmExLjY0NCAxLjY0NCAwIDAxLS41My4xNGwtLjIzNS4wMjJ2LTEuOTI4YTYuNTU3IDYuNTU3IDAgMDAtLjgyNC0zLjE3NHptNy43OTggNi4wMjRjLjAzOS42NjgtLjQ0NSAxLjI3LS43MDEgMS41NGwtMS40MzUtLjgyNGMuOTYyLS4zNCAxLjM1LTEuMDcxIDEuNTA4LTEuNjM4LjEzMS4xMjEuMjc2LjIyOC40MzMuMzE1LjExNC4xOTYuMTgzLjM5OC4xOTUuNjA3em0tMi45ODQuMjY0Yy0xLjc1OC0uMTczLTEuODQzLTEuNjMxLTEuODQ0LTEuODg0LjExLS4yMzUuMTgyLS40OTIuMjA3LS43NjNsLjAzMy0uMzcyYy4wNjYuMDMyLjEzMi4wNjMuMTk5LjA5My4xMTMuMDUuMjMuMDk0LjM0Ni4xMzIuMDM2LjAxMS4wNzMuMDE4LjExLjAyOS4wOC4wMjMuMTYyLjA0Ny4yNDUuMDY0LjA0NC4wMDkuMDg5LjAxMy4xMzMuMDIuMDc1LjAxMy4xNS4wMjcuMjI2LjAzNC4wNDguMDA1LjA5Ny4wMDUuMTQ1LjAwOC4wNi4wMDMuMTIyLjAxLjE4My4wMS4wMTEgMCAuMDIyLS4wMDMuMDMyLS4wMDMuMDY5IDAgLjEzNy0uMDA3LjIwNi0uMDExLjA1Ny0uMDA0LjExMy0uMDA2LjE3LS4wMTMuMDcyLS4wMDkuMTQzLS4wMjQuMjE0LS4wMzcuMDUyLS4wMS4xMDUtLjAxNy4xNTctLjAyOS4wNzktLjAxOS4xNTctLjA0NC4yMzUtLjA3LjA0My0uMDEzLjA4Ni0uMDIzLjEyOC0uMDM4YTMuMzg1IDMuMzg1IDAgMDAuNDc2LS4yMTJsLjAzNi4zOTVjLjAyNC4yNzEuMDk2LjUyOS4yMDcuNzY0LjAwMS4yNTUtLjA3NCAxLjcwOS0xLjg0NCAxLjg4M3ptLTIuNzg5LS44N2MuMTU3LS4wODkuMzAxLS4xOTUuNDMyLS4zMTYuMTU4LjU2Ny41NDYgMS4yOTggMS41MDggMS42MzhsLTEuNDM0LjgyM2MtLjI1Ny0uMjctLjc0LS44Ny0uNzAxLTEuNTM5LjAxMi0uMjA5LjA4LS40MS4xOTUtLjYwN3ptNC40OTMtMi45NWwtLjAwMy4wMDJhNS40OTUgNS40OTUgMCAwMS0uNDk5LjI4MSAyLjc0NiAyLjc0NiAwIDAxLTEuMTY5LjI4NSAyLjc4NCAyLjc4NCAwIDAxLTEuMTg1LS4yNDJsLS4wMDMtLjAwMmMtLjE1Ni0uMDctLjMtLjE0NC0uNDQtLjIyMWwtLjEwNS0uMDU3Yy0yLjM2LTEuMzU4LTIuMzMtMy42NDYtMi4yNTEtNC4zODMgMS42OS0uMTcgMy4yOTMtMS40NjEgMy44OS0xLjk5NC41Mi41NTQgMS45MjYgMS44MTUgNC4wOTIgMS45OTQtLjA4NyAyLjM0Ni0xLjIxNCAzLjYzNC0yLjMyNyA0LjMzOHpNMS45NDggMTguMjA5Yy40NS0uNTU4IDIuMTQzLTEuMDA0IDQuNjQ5LTEuMjIyLjA0OC0uMDA0LjA5NS0uMDEyLjE0Mi0uMDE5LS4wMjMuMTAyLS4wNC4yMDYtLjA0Ny4zMTItLjA2OCAxLjIxIDEuMDI3IDIuMTU1IDEuMDczIDIuMTk0YS4zMTEuMzExIDAgMDAuMzU3LjAzM2wyLjE3Ni0xLjI1IDIuMTc2IDEuMjVhLjMxMS4zMTEgMCAwMC4zNTYtLjAzM2MuMDQ3LS4wNCAxLjE0Mi0uOTgzIDEuMDczLTIuMTk0YTEuOTE3IDEuOTE3IDAgMDAtLjA0Ni0uMzEyYy4wNDcuMDA3LjA5NC4wMTUuMTQyLjAxOSAyLjUwNS4yMTggNC4yLjY2NCA0LjY0OCAxLjIyMi41NTQuNjkuMjk4IDMuNDMyLS4wMTUgNS4xN0gxLjk2NGMtLjMxMy0xLjczOC0uNTctNC40OC0uMDE2LTUuMTd6IiBmaWxsPSIjOTc5Nzk3IiBmaWxsLXJ1bGU9Im5vbnplcm8iIHN0cm9rZT0iIzk3OTc5NyIgc3Ryb2tlLXdpZHRoPSIuNSIvPjwvc3ZnPg==") 0 0 no-repeat!important;
 width:20px;
 height:24px;
 margin:0 7px 0 0
}
.button-gender.active .female-icon {
 background:url("data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PHBhdGggZD0iTTEuNzA2IDI0SDE4Ljg5YS4zMTEuMzExIDAgMDAuMzA1LS4yNTFjLjA5NC0uNDgzLjg5LTQuNzQ1LS4wNjItNS45My0uNTE3LS42NDMtMS45MzgtMS4xMDEtNC4yMjMtMS4zNjVWMTQuNDZjMC0xIC4yNTgtMS45OTQuNzQ2LTIuODczLjUtLjkwMi43NjUtMS45MjYuNzY1LTIuOTYzYTYuMTMzIDYuMTMzIDAgMDAtMi45NzgtNS4yNDhBMy4yNTcgMy4yNTcgMCAwMDEwLjI5OCAxYy0xLjQ3NCAwLTIuNzQ5Ljk3LTMuMTQ2IDIuMzc3YTYuMTMzIDYuMTMzIDAgMDAtMi45NzcgNS4yNDhjMCAxLjAzNy4yNjQgMi4wNjEuNzY1IDIuOTYzLjQ4OC44OC43NDYgMS44NzMuNzQ2IDIuODczdjEuOTkzYy0yLjI4NS4yNjQtMy43MDYuNzIyLTQuMjIzIDEuMzY1LS45NTIgMS4xODUtLjE1NiA1LjQ0Ny0uMDYzIDUuOTNhLjMxMS4zMTEgMCAwMC4zMDYuMjUxem0zLjc3OC0xMi43MTNhNS40OTYgNS40OTYgMCAwMS0uNjg3LTIuNjYyQTUuNTEgNS41MSAwIDAxNy41NzUgMy44NWEuMzEuMzEgMCAwMC4xNDktLjE5NyAyLjYzOCAyLjYzOCAwIDAxMi41NzQtMi4wMzFjMS4yMyAwIDIuMjg4LjgzNSAyLjU3NCAyLjAzYS4zMS4zMSAwIDAwLjE0OC4xOThBNS41MSA1LjUxIDAgMDExNS44IDguNjI1YzAgLjkzMi0uMjM4IDEuODUyLS42ODcgMi42NjJhNi41NTcgNi41NTcgMCAwMC0uODI1IDMuMTc0djEuOTI4bC0uMjM0LS4wMjJhMS42NDMgMS42NDMgMCAwMS0uNTMtLjE0IDMuMjkyIDMuMjkyIDAgMDAtLjgwNS0uNzc3IDEuNjQ3IDEuNjQ3IDAgMDEtLjE2My0uNTc4bC0uMDYzLS42OTdjMS4xMzQtLjc3NyAyLjQ2NC0yLjI4IDIuNDY0LTUuMDVhLjMxMS4zMTEgMCAwMC0uMy0uMzFjLTIuNjE3LS4wODgtNC4xMzQtMi4wMDktNC4xNS0yLjAyOGEuMzEyLjMxMiAwIDAwLS40NjUtLjAzYy0uMDIuMDItMi4wMzMgMi0zLjk3NSAyLjA1N2EuMzEuMzEgMCAwMC0uMjk2LjI1Yy0uMDA3LjAzNS0uNjI4IDMuMzEgMi4zMyA1LjE2MmwtLjA1OS42NDZhMS42NDcgMS42NDcgMCAwMS0uMTYzLjU3OWMtLjM0MS4yNC0uNjEuNS0uODA1Ljc3NmExLjY0NCAxLjY0NCAwIDAxLS41My4xNGwtLjIzNS4wMjJ2LTEuOTI4YTYuNTU3IDYuNTU3IDAgMDAtLjgyNC0zLjE3NHptNy43OTggNi4wMjRjLjAzOS42NjgtLjQ0NSAxLjI3LS43MDEgMS41NGwtMS40MzUtLjgyNGMuOTYyLS4zNCAxLjM1LTEuMDcxIDEuNTA4LTEuNjM4LjEzMS4xMjEuMjc2LjIyOC40MzMuMzE1LjExNC4xOTYuMTgzLjM5OC4xOTUuNjA3em0tMi45ODQuMjY0Yy0xLjc1OC0uMTczLTEuODQzLTEuNjMxLTEuODQ0LTEuODg0LjExLS4yMzUuMTgyLS40OTIuMjA3LS43NjNsLjAzMy0uMzcyYy4wNjYuMDMyLjEzMi4wNjMuMTk5LjA5My4xMTMuMDUuMjMuMDk0LjM0Ni4xMzIuMDM2LjAxMS4wNzMuMDE4LjExLjAyOS4wOC4wMjMuMTYyLjA0Ny4yNDUuMDY0LjA0NC4wMDkuMDg5LjAxMy4xMzMuMDIuMDc1LjAxMy4xNS4wMjcuMjI2LjAzNC4wNDguMDA1LjA5Ny4wMDUuMTQ1LjAwOC4wNi4wMDMuMTIyLjAxLjE4My4wMS4wMTEgMCAuMDIyLS4wMDMuMDMyLS4wMDMuMDY5IDAgLjEzNy0uMDA3LjIwNi0uMDExLjA1Ny0uMDA0LjExMy0uMDA2LjE3LS4wMTMuMDcyLS4wMDkuMTQzLS4wMjQuMjE0LS4wMzcuMDUyLS4wMS4xMDUtLjAxNy4xNTctLjAyOS4wNzktLjAxOS4xNTctLjA0NC4yMzUtLjA3LjA0My0uMDEzLjA4Ni0uMDIzLjEyOC0uMDM4YTMuMzg1IDMuMzg1IDAgMDAuNDc2LS4yMTJsLjAzNi4zOTVjLjAyNC4yNzEuMDk2LjUyOS4yMDcuNzY0LjAwMS4yNTUtLjA3NCAxLjcwOS0xLjg0NCAxLjg4M3ptLTIuNzg5LS44N2MuMTU3LS4wODkuMzAxLS4xOTUuNDMyLS4zMTYuMTU4LjU2Ny41NDYgMS4yOTggMS41MDggMS42MzhsLTEuNDM0LjgyM2MtLjI1Ny0uMjctLjc0LS44Ny0uNzAxLTEuNTM5LjAxMi0uMjA5LjA4LS40MS4xOTUtLjYwN3ptNC40OTMtMi45NWwtLjAwMy4wMDJhNS40OTUgNS40OTUgMCAwMS0uNDk5LjI4MSAyLjc0NiAyLjc0NiAwIDAxLTEuMTY5LjI4NSAyLjc4NCAyLjc4NCAwIDAxLTEuMTg1LS4yNDJsLS4wMDMtLjAwMmMtLjE1Ni0uMDctLjMtLjE0NC0uNDQtLjIyMWwtLjEwNS0uMDU3Yy0yLjM2LTEuMzU4LTIuMzMtMy42NDYtMi4yNTEtNC4zODMgMS42OS0uMTcgMy4yOTMtMS40NjEgMy44OS0xLjk5NC41Mi41NTQgMS45MjYgMS44MTUgNC4wOTIgMS45OTQtLjA4NyAyLjM0Ni0xLjIxNCAzLjYzNC0yLjMyNyA0LjMzOHpNMS45NDggMTguMjA5Yy40NS0uNTU4IDIuMTQzLTEuMDA0IDQuNjQ5LTEuMjIyLjA0OC0uMDA0LjA5NS0uMDEyLjE0Mi0uMDE5LS4wMjMuMTAyLS4wNC4yMDYtLjA0Ny4zMTItLjA2OCAxLjIxIDEuMDI3IDIuMTU1IDEuMDczIDIuMTk0YS4zMTEuMzExIDAgMDAuMzU3LjAzM2wyLjE3Ni0xLjI1IDIuMTc2IDEuMjVhLjMxMS4zMTEgMCAwMC4zNTYtLjAzM2MuMDQ3LS4wNCAxLjE0Mi0uOTgzIDEuMDczLTIuMTk0YTEuOTE3IDEuOTE3IDAgMDAtLjA0Ni0uMzEyYy4wNDcuMDA3LjA5NC4wMTUuMTQyLjAxOSAyLjUwNS4yMTggNC4yLjY2NCA0LjY0OCAxLjIyMi41NTQuNjkuMjk4IDMuNDMyLS4wMTUgNS4xN0gxLjk2NGMtLjMxMy0xLjczOC0uNTctNC40OC0uMDE2LTUuMTd6IiBmaWxsPSIjRkZGIiBmaWxsLXJ1bGU9Im5vbnplcm8iIHN0cm9rZT0iI0ZGRiIgc3Ryb2tlLXdpZHRoPSIuNSIvPjwvc3ZnPg==") 0 0 no-repeat!important
}
.city-label {
 position:absolute;
 left:20px;
 top:13px;
 z-index:11
}
.cart-box {
 position:relative;
 background:url(https://static.pbcdn.in/health-cdn/images/insurer-logo/quotes-logos/cart.svg) no-repeat 3px 17px;
 margin-right:26px;
 width:30px;
 height:17px;
 padding:25px 0 18px 36px;
 font-weight:600;
 font-size:12px;
 color:#253858;
 line-height:7px;
 cursor:pointer;
 margin-left:29px
}
.cart-circle {
 right:7px;
 top:9px
}
.cart-circle,
.cart-circle_shortlist {
 background-color:#36b37e;
 border-radius:100%;
 color:#fff;
 cursor:pointer;
 font-size:10px;
 font-weight:700;
 text-align:center;
 position:absolute;
 width:16px;
 height:16px;
 padding:1px;
 display:flex;
 align-items:center;
 justify-content:center
}
.cart-circle_shortlist {
 right:-8px;
 top:-8px
}
.compare-circle {
 background-color:#ff5630;
 border-radius:100%;
 color:#fff;
 cursor:pointer;
 font-size:12px;
 padding:2px 6px;
 position:absolute;
 right:-7px;
 top:-6px;
 width:20px;
 height:20px;
 line-height:18px
}
.call-shortly-box {
 width:auto;
 position:fixed;
 background:#185488;
 font-size:16px;
 padding:15px 55px;
 color:#fff;
 text-align:center;
 top:41%;
 left:36%;
 border-radius:5px;
 box-shadow:0 1px 6px 0 hsla(0,0%,85.9%,.5)
}
.call_scheduling_compare {
 padding:0 16px!important
}
.arrow-back {
 text-indent:-9999px;
 position:relative;
 width:24px;
 height:24px;
 margin-right:8px!important
}
.arrow-back:before {
 content:"";
 border:solid #253858;
 border-width:0 3px 3px 0;
 display:inline-block;
 padding:6px;
 transform:rotate(135deg);
 top:5px;
 margin-top:0;
 position:absolute;
 left:2px;
 text-indent:0
}
.arrow_web {
 width:14px;
 text-indent:-99999px;
 display:inline-block;
 cursor:pointer;
 height:19px;
 margin-right:12px
}
.compareHeaderClass {
 position:static!important;
 z-index:10!important
}
.call_scheduling_compare.similar_plans .segmentationBanner {
 max-width:768px;
 margin:16px auto
}
@media screen and (max-width:1023px) {
 .footer-desk {
  padding:0 16px 60px
 }
 .call_scheduling_compare.similar_plans .segmentationBanner {
  max-width:unset;
  margin:0
 }
 .header_group_content {
  font-size:14px
 }
 .green_theme {
  box-shadow:0 2px 4px rgba(0,0,0,.1);
  background:#fff!important
 }
 .cart-box {
  margin:auto 0 auto auto;
  background:none
 }
 .cart-box1 {
  display:flex;
  flex-direction:column;
  align-items:center;
  height:34px;
  width:34px;
  position:relative;
  justify-content:center;
  margin-left:auto;
  background:#f3f7fb;
  border-radius:50%
 }
 .cart-circle {
  top:-4px;
  right:-9px
 }
 .like-covers {
  margin-left:10px!important;
  margin-right:10px!important;
  width:calc(100% - 20px)!important
 }
 .compare_parent .top_fixed_box,
 .green_background,
 .grey_background,
 .w_100 {
  width:100%;
  float:left
 }
 .w_50 {
  width:50%;
  float:left
 }
 .section,
 .w_50 {
  position:relative
 }
 .section {
  padding:0
 }
 .difference_column button {
  width:147px;
  position:inherit;
  left:inherit;
  bottom:inherit;
  margin-bottom:10px
 }
 .arrow-icon-right {
  right:-1px
 }
 .difference_column button .fa-arrow-right {
  left:10px
 }
 .top_fixed_box p {
  font-size:12px;
  font-weight:400;
  padding-bottom:0;
  line-height:16px
 }
 .difference_column .column .mobile_diff {
  padding:0;
  position:absolute;
  top:-64px;
  color:#212121;
  background:#fff;
  height:41px;
  text-align:left;
  left:0
 }
 .compare_parent .top_fixed_box {
  margin-top:36px;
  position:relative
 }
 .checkbox_label {
  top:10px;
  left:38px;
  cursor:inherit
 }
 .difference_column .column {
  padding:5px 0 0
 }
 .content_section .columns .column:first-child,
 .grey_background {
  font-size:14px;
  font-weight:600;
  text-align:left!important
 }
 .green_background select {
  font-size:16px;
  font-weight:400
 }
 .content_section .column {
  padding:5px 8px
 }
 .content_section .column p.subtitle {
  font-size:12px;
  font-weight:600
 }
 .content_section .column a,
 .content_section .column p {
  font-size:12px;
  text-align:left
 }
 .content_section ul.progress_bar li {
  padding:8px 3px
 }
 .content_section ul.progress_bar {
  height:26px
 }
 .content_section .column {
  border:1px solid #eeeef0;
  border-right:none;
  border-bottom:none
 }
 .content_section .green_background .column {
  border:1px solid #fff;
  text-align:left
 }
 .similar_plans {
  padding:15px 0!important;
  width:100vw
 }
 .similar_plans h3 {
  font-size:14px;
  font-weight:600;
  padding-right:12px;
  padding-left:12px;
  border-top:2px solid #f7f7f7;
  padding-top:15px
 }
 .similar_plan_ul span,
 .similar_plans h4 {
  font-size:12px;
  font-weight:600
 }
 .similar_plans h4 {
  padding-right:12px;
  padding-left:12px;
  padding-bottom:15px
 }
 .similar_plan_ul li {
  width:100%;
  margin:0 0 20px 2px;
  box-shadow:0 1px 5px -2px rgba(0,0,0,.92);
  padding:10px 0 0;
  min-height:auto
 }
 .similar_plan_ul li:nth-child(2) {
  margin:0 0 20px;
  cursor:pointer
 }
 .similar_plan_ul span {
  width:100%;
  float:none;
  padding:8px;
  background-color:#f7f7f7;
  height:auto;
  display:inline-grid;
  align-items:center;
  text-align:center
 }
 .similar_plan_ul ul li span {
  background-color:#fff;
  padding:0;
  font-size:10px;
  font-weight:600
 }
 .similar_plan_ul ul li {
  font-size:12px;
  font-weight:600
 }
 .similar_plan_ul ul {
  padding:6px 0
 }
 .similar_plan_ul button {
  width:68%;
  border-radius:7px;
  margin-top:8px;
  font-size:12px;
  margin-bottom:12px
 }
 .similar_plan_ul h6 {
  font-size:10px
 }
 .content_section .column p span {
  font-weight:600;
  font-size:17px;
  display:block
 }
 .difference_column button {
  font-size:13px;
  font-weight:400;
  margin-top:0
 }
 .top_fixed_box a.close {
  display:block!important;
  position:relative;
  right:13px;
  top:-8px;
  text-decoration:none
 }
 .difference_column .w_50,
 .top_fixed_box .w_50 {
  padding:0 7px
 }
 .compare_parent .top_fixed_box:after {
  content:"";
  position:absolute;
  width:1px;
  height:100%;
  left:50%;
  top:0;
  background:#c3f6ee
 }
 .columns.no-plans:not(.is-desktop),
 .columns:not(.is-desktop) {
  display:block
 }
 .navbar {
  padding-left:0;
  background:#36b37e;
  box-shadow:none;
  color:#253858;
  padding-right:0;
  position:sticky;
  top:0;
  z-index:11;
  position:-webkit-sticky
 }
 .content-h {
  margin-left:10px;
  font-size:18px;
  font-weight:700
 }
}
@media screen and (max-width:1023px) and (max-width:420px) {
 .content-h {
  font-size:5.1vw
 }
}
@media screen and (max-width:1023px) {
 .compareHeaderClass .content-h {
  max-width:unset
 }
 .contentHealthHeader {
  max-width:calc(100% - 114px)!important
 }
 .navbar-brand,
 .navbar-tabs {
  align-items:center;
  padding-left:15px;
  padding-right:16px;
  min-height:58px
 }
 .profiles_navbar {
  padding-left:0!important;
  padding-right:0!important
 }
 .slider-new {
  display:grid;
  grid-auto-flow:column;
  grid-gap:5px;
  margin:0 auto 15px;
  overflow:auto
 }
 .slider-new .box-new {
  padding:0;
  width:253px;
  margin-left:15px;
  margin-right:0
 }
 .slider-new1 {
  padding:0
 }
 .slider-new1 .box-new {
  padding:0;
  width:300px;
  margin-left:12px;
  margin-right:0
 }
 .green_background select {
  background-position:100% 7px
 }
 ul.listing-hospital-category li {
  height:auto;
  width:100%
 }
 .top_fixed_box img {
  margin-left:4px
 }
 .top_fixed_box .add_plan a {
  top:0;
  width:50px;
  height:50px
 }
 .top_fixed_box .add_plan p {
  margin-top:9px;
  margin-bottom:8px
 }
 .difference_column select {
  padding-left:8px;
  font-size:13px;
  margin:0 auto 10px
 }
 .top_fixed_box .add_plan a span {
  top:-1px
 }
 .top_fixed_box .column.add_plan {
  padding-bottom:24px;
  height:102px
 }
 .content_section ul.progress_bar li.green span:before {
  content:"";
  background-color:#36b37e;
  position:absolute;
  height:10.5px;
  left:0;
  width:100%;
  border-radius:2px;
  top:-.5px
 }
 .content_section ul.progress_bar li span {
  border:0 solid #7f8184
 }
 .content_section ul.progress_bar li.green.half span:before {
  width:50%
 }
 .content_section ul.progress_bar li.yellow span:before {
  background-color:#ffab00
 }
 .content_section ul.progress_bar li.red span:before {
  background-color:#ff5630
 }
 .content_section ul.progress_bar li.green.half span:before {
  width:57%;
  border-radius:2px 0 0 2px
 }
 .content_section .column a {
  margin-left:9px
 }
 .slider-new-2 div.box-new:nth-child(2n) {
  margin-left:0
 }
 img {
  height:auto;
  max-width:100%
 }
 .modal-card,
 .modal-content {
  width:100%
 }
 .slider-new div {
  padding:0;
  width:100%
 }
 .image img {
  width:87%
 }
 .edit-plan {
  left:3px
 }
 .edit-plan-close {
  position:absolute;
  right:0;
  z-index:99;
  top:-49px!important
 }
 .tip-box {
  margin-left:0!important;
  font-weight:400;
  display:inline-block
 }
 .tooltip.is-tooltip-multiline.first:before,
 .tooltip.is-tooltip-multiline:before {
  min-width:11rem!important;
  min-height:6rem!important
 }
 .box-plan-2 {
  height:50px
 }
 .shrink_box_mob .plan-2 {
  height:0!important;
  display:none!important
 }
 .shrink_box_mob .edit-plan-close {
  top:-76px!important
 }
 .shrink_box_mob .difference_column button {
  height:32px;
  margin-top:12px
 }
 .shrink_box_mob .top_fixed_box .column.add_plan {
  padding-bottom:0;
  height:auto
 }
 .shrink_box_mob .img-box-logo {
  height:67px
 }
 .shrink_box_mob .two-plans .img-box-logo {
  height:44px
 }
 .shrink_box_mob .two-plans .edit-plan-close {
  top:-54px!important
 }
 .shrink_box_mob .box-plan-2 {
  height:auto
 }
 .shrink_box_mob .tip-plan {
  display:none
 }
 .link-bottom {
  left:0
 }
 .feature-box {
  height:45px
 }
 .shrink_box_mob .top_fixed_box .add_plan .plus-icon {
  margin-bottom:10px
 }
 p.blank-box {
  height:50px
 }
 .img-box-logo {
  height:39px
 }
 .tip-plan {
  top:146px!important;
  right:3px
 }
 .tooltip.tip-plan.is-tooltip-multiline:before {
  min-width:8rem!important;
  padding:5px!important
 }
 .grey-mob {
  height:48px!important
 }
 .yearly-text {
  display:block;
  padding-top:0;
  font-size:12px;
  font-weight:600;
  color:#253858
 }
 .add-plan-button {
  margin-top:12px!important
 }
 .shrink_box_mob .add-plan-button {
  margin-top:14px!important
 }
 .add_plan {
  height:84px;
  cursor:pointer
 }
 .close {
  top:46px!important
 }
 .select-top {
  width:166px;
  font-size:13px;
  margin-right:auto;
  margin-left:auto
 }
 .css-15k3avv {
  width:93%!important
 }
 .shrink_box_mob .add_plan {
  height:60px;
  cursor:pointer
 }
 .shrink_box_mob .close {
  top:34px!important
 }
 .img-box-logo-similar {
  height:50px
 }
 .box_block {
  height:106px
 }
 .suminsuredspan {
  font-size:16px;
  font-weight:400;
  font-family:Nunito,sans-serif
 }
 .span_saves,
 .suminsuredspan {
  padding-left:10px
 }
 .port-bot-fixed span {
  display:block;
  margin:0 0 10px
 }
 .port-bot-fixed {
  height:135px;
  display:block;
  font-size:1.125rem;
  text-align:center;
  padding:10px 17px
 }
 .port-compare-button {
  margin:0
 }
 .bg-mob-port {
  background:#fff;
  padding:10px 0!important;
  min-height:172px
 }
 .top_fixed_box_port p {
  font-weight:600
 }
 .show-dif-col {
  padding:0 0 32px;
  border-bottom:1px solid #eeeef0
 }
 .checkbox_label_port {
  cursor:inherit;
  top:10px;
  left:41px
 }
 .pb-dialog-content {
  width:94%;
  margin:0 3%
 }
 .listing-member-desk {
  width:100%
 }
 .button-box2 {
  width:100%!important
 }
 .cityinput {
  width:100%;
  margin:0 0 7px
 }
 .button-port {
  width:139px;
  margin:10px 0 0;
  height:34px;
  font-size:12px;
  padding:0
 }
 .button-port .arrow-icon-right {
  top:7px
 }
 .subtitle_port_h1 {
  font-size:.875rem;
  margin:0 0 15px 13px
 }
 .title_port_h2 {
  font-size:1.5rem;
  margin:10px 0 0 13px
 }
 .green-text {
  margin-bottom:15px!important
 }
 .modal-box-new {
  width:100%!important
 }
 .memberform {
  min-height:487px
 }
 .members-box2 {
  width:90%;
  margin:0 auto;
  padding:0;
  float:none
 }
 ul.circle-slider {
  margin-top:0
 }
 .button-gender {
  width:42%;
  margin-left:0
 }
 .cityinput:nth-child(2n) {
  margin-bottom:22px
 }
 .port-box .tooltip.is-tooltip-right:before {
  z-index:9!important
 }
 .rc-swipeout {
  overflow:inherit
 }
 .tooltip.is-tooltip-right:before {
  bottom:40px!important
 }
 .tooltip.is-tooltip-multiline:before {
  min-height:5rem!important
 }
 .grey_background {
  background:#fff
 }
 .box-mob-slider {
  border-bottom:2px solid #f7f7f7;
  margin-bottom:15px
 }
 .content_section {
  box-shadow:none
 }
 .box-new:nth-child(3n) .similar_plan_ul li {
  margin-left:-2px
 }
 .call_scheduling_compare {
  padding:0 16px 16px!important
 }
 .navbarWrapper {
  position:static;
  top:0;
  z-index:39;
  box-shadow:0 3px 2px 0 rgba(0,0,0,.1)!important
 }
}
@media screen and (min-device-width:1367px) and (max-width:1920px) {
 .container.is-fullhd {
  max-width:100%;
  width:auto;
  box-shadow:0 3px 6px 0 rgba(0,0,0,.15)
 }
 .top_fixed_box .add_plan .plus-icon span {
  position:relative;
  top:4px
 }
}
@media screen and (min-width:320px) and (max-width:1023px) and (orientation:landscape) {
 .slider-new {
  width:558px
 }
}
@media screen and (min-width:800px) and (max-width:900px) and (orientation:landscape) {
 .slider-new {
  width:741px
 }
}
@media screen and (min-width:901px) and (max-width:1023px) and (orientation:landscape) {
 .slider-new {
  width:800px
 }
}
@media screen and (min-width:320px) and (max-width:330px) {
 .select-top {
  width:146px
 }
 .port-bot-fixed {
  height:131px;
  font-size:1rem
 }
}
@media screen and (min-width:375px) and (max-width:380px) {
 .similar_plans {
  width:102vw
 }
}
@media screen and (min-width:400px) and (max-width:414px) {
 .select-top {
  width:184px
 }
}
@media screen and (min-width:768px) and (max-width:1023px) {
 .select-top {
  width:365px
 }
 .css-15k3avv {
  width:98%!important
 }
}
@media screen and (min-width:611px) and (max-width:1023px) {
 .shrink_box .difference_column .column .mobile_diff {
  top:-55px
 }
}
@media screen and (max-width:1023px) and (min-width:769px) {
 .is-hidden-tablet-only-custom {
  display:none!important
 }
}
@media screen and (max-width:1023px) {
 .is-hidden-custom {
  display:none!important
 }
}
@media screen and (min-width:1024px) {
 .is-hidden-desktop-custom {
  display:none!important
 }
}
@media screen and (max-width:420px) {
 body {
  font-size:4.5vw
 }
}
.errorWrapper {
 width:100%;
 max-width:1000px;
 display:flex;
 align-items:center;
 justify-content:space-between;
 margin:66px auto 0
}
.errorWrapper .errorIcon {
 width:480px
}
.errorWrapper .errorMsg {
 width:calc(100% - 605px)
}
.errorWrapper .errorMsg p {
 font-size:24px;
 color:#253858;
 font-weight:500;
 line-height:36px;
 margin-bottom:36px
}
.errorWrapper .errorMsg button {
 padding:0 42px;
 height:48px;
 -webkit-appearance:none;
 background:#ff5630;
 color:#fff;
 font-size:16px;
 font-weight:700;
 border:none;
 box-shadow:none;
 border-radius:4px;
 cursor:pointer;
 outline:none
}
@media screen and (max-width:1023px) {
 .errorWrapper {
  flex-direction:column;
  margin-top:48px
 }
 .errorWrapper .errorIcon,
 .errorWrapper .errorIcon img {
  width:100%
 }
 .errorWrapper .errorMsg {
  width:100%;
  padding:0 16px;
  text-align:center;
  margin-top:65px
 }
 .errorWrapper .errorMsg p {
  font-size:18px;
  margin-bottom:24px;
  line-height:27px
 }
}
body,
html {
 background-color:#f4f5f7
}
body {
 font-size:16px
}
ul {
 list-style:none
}
h1,
h2,
h3,
h4,
h5,
h6 {
 font-weight:400
}
.row {
 flex-direction:row
}
.col-flex {
 flex-direction:column
}
.flow {
 flex-flow:wrap
}
button:focus {
 outline:none
}
.rowWrapper {
 max-width:1140px;
 margin:0 auto
}
.navbarWrapper {
 position:sticky;
 position:-webkit-sticky;
 top:0;
 z-index:99;
 box-shadow:0 3px 2px 0 rgba(0,0,0,.1);
 background:#fff
}
.header_container {
 background:#fff;
 margin:0 auto;
 width:100%;
 padding:0 16px;
 justify-content:space-between;
 min-height:55px;
 align-items:center
}
.arrow_product {
 margin-right:10px;
 background-position:0 9px!important
}
.cart-product {
 background:url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAAAXNSR0IArs4c6QAAADhlWElmTU0AKgAAAAgAAYdpAAQAAAABAAAAGgAAAAAAAqACAAQAAAABAAAAIKADAAQAAAABAAAAIAAAAACPTkDJAAAFA0lEQVRYCa1Xa2gcVRT+Znb2MdvNw7R5NGvMrlaJKCRYULRiEvrDWqEEpSAopiCIf6QFi9RISaL4AP0RRawgQuoP/xUigiBKE8XmR1FbK1pSSrN57yZNkzRpZrO72fGcm53tzOzM7kZ7Yffee853Hvfce869I6HMput69Wpqsx3ZbJcEKaJDj3APajSO0TjGPWR5qMLn+VmSpGXmlWpSKYCm6ZE00r1k4EgprJlPzgx64e1XVSlmptvHrg7wite0TC8kHLMLbXPeFwoon7hFxNGBLePpYUhS2zaNOcN1/WJI9XY6OVHgwFpKb8tmMsOShGpnbbep8wtLuL60tdW1NdWo3XXXbaZtpOtYlhWlM+STLppZFgfEQdMy4+UYP/vrb/jy628xPjEr9EWbG/Fqdxc69+0167eM2YkKVYmaIyEbCCPs5Rg/d/4S3n7vFAJ+L15+4aD4qQEvet75HKPEc2use01LD7MtA5OPwOp6eoAO3FGD4dYvLq3g+MlPkclu4rMPj6OqMiSgKzfX8PqJj7GRzuDUR2+iprrSTQXT+ytUbx8PFP7jVMsgU9T42NUJzCUWkZi/gfHJWbTvewQX/rrC4vkWbQ7jl9EL+HHkPOpra9C4uxYP3NuU55sGvWRzkFNUROCmlhqkPO82ASzDq9emxOriZJyiBCpGyNJAlvMBFPhsVodMZYkYYs7R+WqgB/dFC52gOnG6UvUdUcTeJzOuxlnTrfUk4gs38NLhp9EUbsD7A4M4fGg/ntn/uDBk/H3/0yjOfHcWbx3txuR0HN+c+QG3tA2Dbel5wWT7mELltcO6DgtOTLTklpInHm1FMKjC5/Eg2rQbe1tbLOB/rozD5/WiZU8z7m6sEw5oWtKCMU/YtsK1fSuuZpZ1PD03Lwiq6kfrQ3vQ88YrOHTgSSuIZi8+fwA7gkG0Pnw//rg0JvjTcwt4rACZI5BthUIRyU1duzgdPr/PCzXgF5iug085YvlMPPdsu+AxlmXmEtcdsUxk2zIdhghPirWNVBp1dKqDaqAYzMJjLGdCimRdm65Xkc9Ssysgx5iaSfDZRiAXgVJ45vN2UeXD1HTCHU53Tb4SuqM4CzRUhYL5LSiGNXhqwIfKih1YI9lijbdgohgguZGCxyPTigLb2gKBDwZI1gPW4dh0/U/egpgjM0fkNJqlk8xO2AtPMTmFDNOlgxnKICONC/D0auIIxAoYJoIQJkXhhloTtbxhuGEXZJJ1qwVsm5c1VEwdO0BREvtZDOfE4zOwkcq4R4Bsy/SAHHESNmjrVEonZ+Lw+30GqeyeZRILi2AdTq3SrwxRhKRlCsVpJwDTdLpgOJ/q63a6QVzpDfU7RSpubmYLMIZNcR3T67WPruPuAhQRwnSlcmnliyVBFfHBlqgTrID29+VrGDn3O9pItilcV8Bnm0yUDM6qlmZCrzE399Oz8zj5wRe4PDaOFD04ymk+ryKcfffEa+JissnkHyR5B8S1rKVHKHdabWAx5WI0MRV3P1A2Ib4L7mlqQIhuT0uj3KcXcofxLsw7wCB2YjWZiRGxyiJ0hyZ0mlYqAkrEMM5qLaWYGbJH6WDgHbKZV8M6WbfZODMtETDQpbbDwJXd28JulrNEwGCwl7xPNO83aP+j7zfvuV2PYwTMoNzHaR9Vw24zvdSY85xT7T9/nNoNiANKbzjj85xObHU+YyjENOaCZnyej9j32q7PmP8LNXrhFSwrPwcAAAAASUVORK5CYII=") 0 5px no-repeat;
 width:32px;
 text-indent:-99999px;
 height:42px
}
.edit-box {
 background:url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAVCAYAAABG1c6oAAAAAXNSR0IArs4c6QAAADhlWElmTU0AKgAAAAgAAYdpAAQAAAABAAAAGgAAAAAAAqACAAQAAAABAAAAFKADAAQAAAABAAAAFQAAAACsdft3AAABbklEQVQ4Ee2UzVHDMBCFVxkg15SQEkQHSQfmwM8RV0DSganAoQLnGOCAOyAdoBJSQnIEZhDvLbHGzjC2nBluKLPR3+7nJ2klI0cWf2UTMZKLlxFsbp7dkqjBMTx/aW8Be0HsAyxFe6Fj6Ji+QA0cSIG4tXl0U8ZjzIK0htJZL4UB5uUewef+2hIsWK5DRdV5NDDAviQ1Ty4DcAK7qKCAjWG7qCU3YPvNp7KwVCNv6OoHON5aCIMKr9BfPHHaWdt8I6QT1vGxf1hjB7TTtad0Cnmop/hzAzbyKeUhLswzD2upc+inQH9jmZQ5JuewnZzJq0/sqHKOhdFfExu5tER7jBswUdBQ76WXD5nKqSRYRyEdyghjqZacoL3ggCndVt6R9Qa/IW5ADxjjhe8abKud2h+yfxZ9A2pxJ2hTXVmN8QPQdsfXBNZ6AFVMvTZ7dQUgfHkJ576WWGpmVm5Td45pUyHVpYBpjYMJamMAf+7zDUvO0ShFVYGeAAAAAElFTkSuQmCC") 5px 0 no-repeat;
 width:27px;
 text-indent:-99999px;
 height:27px
}
.tabs-members {
 width:100%;
 min-height:auto;
 padding:0 16px 0 0
}
.tabs-box,
.tabs-members {
 align-items:center;
 display:flex;
 justify-content:space-between;
 overflow:hidden
}
.tabs-box {
 overflow-x:auto;
 white-space:nowrap;
 width:85%
}
.tabs-box::-webkit-scrollbar {
 display:none
}
.tabs-box ul {
 align-items:center;
 display:flex;
 flex-grow:1;
 flex-shrink:0;
 justify-content:flex-start
}
.tabs-box ul li {
 padding:0 16px 13px;
 position:relative;
 color:#7a869a
}
.tabs-box ul li .header_group_heading {
 font-size:10px;
 font-weight:600
}
.tabs-box ul li .header_group_content {
 font-size:14px
}
@media screen and (max-width:420px) {
 .tabs-box ul li .header_group_content {
  font-size:3.8vw
 }
}
.tabs-box ul .is-active .selected {
 color:#253858;
 font-weight:700
}
.tabs-box ul .is-active {
 border-bottom:2px solid #253858
}
.wrapper-product {
 margin:0
}
.wrapper-inner {
 background:#fff;
 margin:0 0 12px;
 width:100%;
 display:flex;
 padding:16px;
 align-items:center;
 border-radius:0
}
.wrapper-inner-similar {
 display:block;
 padding:16px 0
}
.wrapper-inner-similar .heading_section {
 margin-left:16px;
 width:auto
}
.alignTop {
 align-items:flex-start
}
.alignCenter {
 align-items:center
}
.logo-detais {
 margin-right:12px
}
.logo-detais img {
 width:100px;
 height:50px;
 object-fit:contain
}
.plan-name {
 flex:1
}
.plan-name h2 {
 font-size:16px;
 font-weight:700;
 line-height:28px
}
@media screen and (max-width:420px) {
 .plan-name h2 {
  font-size:4.5vw
 }
}
.plan-name span {
 display:inline-block;
 font-size:14px;
 color:#ff5630;
 font-weight:600;
 margin:0;
 position:relative;
 text-transform:uppercase
}
@media screen and (max-width:420px) {
 .plan-name span {
  font-size:3.8vw
 }
}
.plan-name span:after {
 content:"";
 border:solid #ff5630;
 border-width:0 1.5px 1.5px 0;
 display:inline-block;
 padding:2px;
 transform:rotate(-45deg);
 margin-left:3px;
 vertical-align:middle;
 position:relative;
 top:-1px
}
.plan-name .dot-blk {
 width:4px;
 height:4px;
 background-color:#253858;
 border-radius:30px;
 position:relative;
 top:14px;
 left:-20px;
 content:"";
 opacity:.5
}
.heading_section {
 width:100%
}
.heading_section h3 {
 font-size:16px;
 font-weight:700;
 padding-right:20px
}
@media screen and (max-width:420px) {
 .heading_section h3 {
  font-size:4.5vw
 }
}
.heading_section h3 span {
 font-size:14px;
 display:block;
 font-weight:400;
 color:#505f79;
 margin-top:4px
}
@media screen and (max-width:420px) {
 .heading_section h3 span {
  font-size:3.8vw
 }
}
.pills-box {
 margin:20px 0 0;
 overflow:hidden;
 overflow-x:auto;
 white-space:nowrap;
 display:flex;
 height:50px
}
.pills-box::-webkit-scrollbar {
 display:none
}
.pills-box .pills-button {
 height:36px;
 border-radius:40px;
 border:1px solid #253858;
 background-color:#fff;
 align-items:center;
 display:flex;
 justify-content:center;
 font-size:14px;
 position:relative;
 margin-right:10px;
 padding:0 20px;
 width:auto;
 font-weight:600
}
@media screen and (max-width:420px) {
 .pills-box .pills-button {
  font-size:3.8vw
 }
}
.pills-box .pills-button span {
 font-size:10px;
 text-transform:uppercase;
 font-weight:600;
 color:#00a3bf;
 position:absolute;
 bottom:-19px
}
.pills-box .pills-select {
 outline:none;
 -webkit-appearance:none;
 width:80px;
 padding-left:18px;
 padding-right:15px;
 text-overflow:ellipsis
}
.pills-box .is-active {
 border:1px solid #36b37e;
 color:#36b37e;
 font-weight:700;
 background-color:#f2fffa
}
.policy-period {
 margin:15px 0 0
}
.policy-period .policy_period_inner {
 display:flex;
 flex-direction:row;
 width:100%;
 justify-content:space-between;
 border:1px solid #b3bac5;
 padding:7px 10px;
 margin:0 0 15px;
 align-items:center;
 border-radius:4px;
 height:60px;
 font-weight:600;
 font-size:16px
}
@media screen and (max-width:420px) {
 .policy-period .policy_period_inner {
  font-size:4.5vw
 }
}
.policy-period .policy_period_inner .save-text {
 color:#00b8d9;
 font-size:14px;
 display:block;
 font-weight:600!important
}
@media screen and (max-width:420px) {
 .policy-period .policy_period_inner .save-text {
  font-size:3.8vw
 }
}
.policy-period .policy_period_inner .text_right {
 text-align:right;
 font-weight:700
}
.policy-period .policy_period_inner .text_right span {
 font-weight:400
}
.policy-period .policy_period_inner .label-radiobox-term {
 margin-top:0
}
.policy-period .policy_period_inner .label-radiobox-term label {
 font-size:16px;
 margin-right:15px
}
@media screen and (max-width:420px) {
 .policy-period .policy_period_inner .label-radiobox-term label {
  font-size:4.5vw
 }
}
.policy-period .policy_period_inner .label-radiobox-term label .input-radio {
 -webkit-appearance:none;
 outline:none;
 width:18px;
 height:18px;
 margin:-3px 5px 0 0;
 border-radius:30px;
 background-color:#fff;
 border:1px solid #97a0af;
 vertical-align:middle
}
.policy-period .policy_period_inner .label-radiobox-term label .input-radio:checked {
 background:#fff;
 border:1px solid #36b37e
}
.policy-period .policy_period_inner .label-radiobox-term label .input-radio:checked:before {
 background:#36b37e;
 border:1px solid #36b37e;
 top:4px;
 left:4px;
 width:8px;
 height:8px
}
.policy-period .selected_term {
 border:1px solid #36b37e;
 background:#f2fffa
}
.multi-year-box {
 margin:15px 0 0
}
.multi_box_inner {
 display:flex;
 flex-direction:row;
 width:100%;
 justify-content:space-between;
 border:1px solid #b3bac5;
 padding:7px 10px;
 margin:0 0 15px;
 align-items:center;
 border-radius:4px
}
.multi_box_inner .multi-first {
 display:block;
 flex-direction:column;
 font-size:12px;
 line-height:20px
}
@media screen and (max-width:420px) {
 .multi_box_inner .multi-first {
  font-size:3.2vw
 }
}
.multi_box_inner .multi-first .blk {
 display:block
}
.multi_box_inner .multi-first span.bold-font {
 font-weight:700;
 font-size:14px;
 display:block
}
@media screen and (max-width:420px) {
 .multi_box_inner .multi-first span.bold-font {
  font-size:3.8vw
 }
}
.multi_box_inner .multi-first span.amount-green {
 display:inline-block;
 color:#00a3bf;
 font-weight:700;
 font-size:12px
}
@media screen and (max-width:420px) {
 .multi_box_inner .multi-first span.amount-green {
  font-size:3.2vw
 }
}
.multi_box_inner .multi-first span.amount-low {
 display:inline-block;
 font-size:14px;
 text-decoration:line-through;
 color:#7a869a;
 font-weight:400;
 margin-right:5px
}
@media screen and (max-width:420px) {
 .multi_box_inner .multi-first span.amount-low {
  font-size:3.8vw
 }
}
.multi_box_inner .multi-second {
 font-size:12px;
 font-weight:700
}
@media screen and (max-width:420px) {
 .multi_box_inner .multi-second {
  font-size:3.2vw
 }
}
.selected-box {
 border:1px solid #36b37e
}
.selected-box .multi-check {
 transform:rotate(45deg);
 border-spacing:0;
 display:block;
 border:2px solid #36b37e;
 border-top:0;
 border-left:0;
 height:18px;
 margin-left:7px;
 margin-top:-6px;
 width:9px;
 font-size:0;
 margin-right:8px
}
.info_tooltip {
 background:url("data:image/svg;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxMiIgaGVpZ2h0PSIxMiIgdmlld0JveD0iMCAwIDEyIDEyIj4KICA8ZyBpZD0iR3JvdXBfNjczMSIgZGF0YS1uYW1lPSJHcm91cCA2NzMxIiB0cmFuc2Zvcm09InRyYW5zbGF0ZSgtMTU5IC0zNzMpIj4KICAgIDxjaXJjbGUgaWQ9IkVsbGlwc2VfMTUwIiBkYXRhLW5hbWU9IkVsbGlwc2UgMTUwIiBjeD0iNiIgY3k9IjYiIHI9IjYiIHRyYW5zZm9ybT0idHJhbnNsYXRlKDE1OSAzNzMpIiBmaWxsPSIjNmI3NzhjIi8+CiAgICA8dGV4dCBpZD0iXyIgZGF0YS1uYW1lPSI/IiB0cmFuc2Zvcm09InRyYW5zbGF0ZSgxNjIgMzgzKSIgZmlsbD0iI2ZmZiIgZm9udC1zaXplPSIxMCIgZm9udC1mYW1pbHk9IlNGUHJvVGV4dC1Cb2xkLCBTRiBQcm8gVGV4dCIgZm9udC13ZWlnaHQ9IjcwMCI+PHRzcGFuIHg9IjAiIHk9IjAiPj88L3RzcGFuPjwvdGV4dD4KICA8L2c+Cjwvc3ZnPgo=") 0 0 no-repeat;
 width:12px;
 height:12px;
 text-indent:-999999px
}
.product-container .rowWrapper {
 padding:0;
 display:block
}
.emi_box {
 display:flex;
 font-size:14px
}
@media screen and (max-width:420px) {
 .emi_box {
  font-size:3.8vw
 }
}
.emi_box span {
 font-weight:700
}
.emi_box img {
 margin-right:10px;
 margin-top:4px
}
.emi_box .link {
 display:block;
 color:#ff5630;
 text-transform:uppercase;
 font-weight:600
}
.members-section {
 font-size:14px;
 margin:8px 0 0;
 position:relative;
 padding-right:10px
}
@media screen and (max-width:420px) {
 .members-section {
  font-size:3.8vw
 }
}
.members-section:after {
 content:"";
 border:solid #253858;
 border-width:0 2px 2px 0;
 display:inline-block;
 padding:4px;
 transform:rotate(-45deg);
 vertical-align:middle;
 position:absolute;
 right:2px;
 top:3px
}
.rider-box {
 border-radius:10px;
 border:1px solid #dfe1e6;
 background-color:#fff;
 padding:12px 0;
 margin:10px 0 0;
 justify-content:space-between
}
.rider-box .sp-rider {
 padding:0 12px;
 justify-content:space-between
}
.rider-box .sp-rider h3 {
 font-size:16px;
 font-weight:700;
 color:#253858
}
@media screen and (max-width:420px) {
 .rider-box .sp-rider h3 {
  font-size:4.5vw
 }
}
.rider-box.disable {
 pointer-events:none;
 cursor:not-allowed;
 border-color:rgba(223,225,230,.6)
}
.rider-box.disable .sp-rider .save_smart .save,
.rider-box.disable .sp-rider .save_smart .save_amount,
.rider-box.disable .sp-rider h3 {
 opacity:.4
}
.rider-box.disable button {
 border-color:#dfe1e6;
 color:#b2bdd0!important
}
.rider-box button {
 width:78px;
 height:36px;
 border-radius:4px;
 border:1px solid #ff5630;
 background-color:#fff;
 color:#ff5630!important;
 font-weight:700;
 line-height:30px;
 position:relative;
 margin-top:5px;
 display:flex;
 align-items:center;
 justify-content:center
}
.rider-box button:after {
 position:absolute;
 top:-8px;
 right:-2px;
 border-spacing:0;
 display:block;
 height:9px;
 width:5px;
 font-size:15px;
 margin-right:8px;
 content:"+";
 outline:none
}
.rider-box button:hover {
 color:#ff5630!important
}
.rider-box button:focus {
 outline:none
}
.rider-box button:disabled {
 background:#dfe1e6;
 border-color:#dfe1e6;
 color:#7a869a!important;
 cursor:inherit
}
.rider-box .button_rider_apply.active-button:after,
.rider-box .button_rider_apply:after {
 content:none
}
.rider-box .active-button {
 border:1px solid #36b37e;
 color:#36b37e!important
}
.rider-box .active-button:after {
 position:absolute;
 top:8px;
 right:-3px;
 transform:rotate(45deg);
 border-spacing:0;
 display:block;
 border:2px solid #36b37e;
 border-top:0;
 border-left:0;
 height:9px;
 margin-left:7px;
 margin-top:-6px;
 width:5px;
 font-size:0;
 margin-right:8px;
 content:""
}
.rider-box .active-button:hover {
 color:#36b37e!important
}
.rider-box .button-premium:after {
 content:none
}
.rider-box .button-premium {
 width:127px;
 line-height:28px;
 font-weight:600;
 text-transform:uppercase
}
.daily-cash {
 border-top:1px solid #dfe1e6;
 font-size:14px;
 margin-top:10px;
 padding:10px 12px 0
}
@media screen and (max-width:420px) {
 .daily-cash {
  font-size:3.8vw
 }
}
.daily-cash .amount-2 {
 font-weight:700;
 padding-left:4px;
 position:relative
}
.daily-cash .amount-2 select {
 color:#253858;
 font-weight:700;
 width:57px;
 outline:none;
 -webkit-appearance:none;
 border:none;
 background:#fff
}
.daily-cash .amount-2:after {
 content:"";
 border:solid #253858;
 border-width:0 1.5px 1.5px 0;
 display:inline-block;
 padding:2px;
 transform:rotate(45deg);
 margin-left:3px;
 vertical-align:middle;
 position:absolute;
 top:5px;
 right:1px;
 z-index:1
}
.addon-main {
 display:block
}
.addon-box1 {
 display:flex;
 width:100%;
 position:relative;
 padding:0 12px
}
.addon-box1 h3 {
 font-weight:700;
 overflow:hidden;
 font-size:14px;
 line-height:22px;
 margin-bottom:0
}
@media screen and (max-width:420px) {
 .addon-box1 h3 {
  font-size:3.8vw
 }
}
.addon-box1 .logo_add {
 width:100px;
 margin-right:10px
}
.addon-box1 .name-addon {
 width:calc(100% - 64px)
}
.addon-box1 .name-addon .heading-span {
 font-size:14px;
 line-height:18px;
 -webkit-box-orient:vertical;
 overflow:hidden;
 -webkit-line-clamp:2;
 max-height:70px;
 margin-bottom:5px;
 text-overflow:ellipsis;
 display:-webkit-box
}
@media screen and (max-width:420px) {
 .addon-box1 .name-addon .heading-span {
  font-size:3.8vw
 }
}
.addon-box1 .popularadd-on {
 width:110px;
 height:19px;
 border-radius:10px;
 border:1px solid #00b8d9;
 background-color:#e6fcff;
 text-align:center;
 color:#00a3bf;
 font-weight:700;
 font-size:10px;
 line-height:19px;
 position:absolute;
 right:10px;
 top:-22px;
 text-transform:uppercase
}
.addon-box1 .si_add {
 width:128px
}
.addon-box1 .si_add.room_rent {
 width:400px
}
.addon-box1 .si_add .label-add {
 font-size:12px;
 color:#7a869a
}
@media screen and (max-width:420px) {
 .addon-box1 .si_add .label-add {
  font-size:3.2vw
 }
}
.addon-box1 .si_add .div_select_add {
 position:relative;
 width:80%
}
.addon-box1 .si_add .div_select_add select {
 font-size:16px;
 color:#253858;
 -webkit-appearance:none;
 -moz-appearance:none;
 appearance:none;
 border:none;
 background:none;
 outline:none;
 width:100%;
 z-index:2;
 position:relative;
 display:inline-block;
 font-weight:600
}
@media screen and (max-width:420px) {
 .addon-box1 .si_add .div_select_add select {
  font-size:4.5vw
 }
}
.addon-box1 .si_add .div_select_add:after {
 content:"";
 border:solid #253858;
 border-width:0 1.5px 1.5px 0;
 display:inline-block;
 padding:2px;
 transform:rotate(45deg);
 margin-left:5px;
 vertical-align:middle;
 position:absolute;
 top:7px;
 z-index:1;
 right:0
}
.addon-box1 .si_add .wid-70 {
 width:84%
}
.addon-box1 .si_add2 {
 width:100%
}
.addon-box1 .si_add2 span {
 font-size:16px;
 font-weight:600
}
@media screen and (max-width:420px) {
 .addon-box1 .si_add2 span {
  font-size:4.5vw
 }
}
.addon-box1 .link-add {
 color:#ff5630;
 display:inline-block;
 margin-left:3px;
 margin-top:0
}
.deductible-box {
 border-top:1px solid #dfe1e6;
 font-size:14px;
 margin-top:10px;
 padding:10px 12px 0
}
@media screen and (max-width:420px) {
 .deductible-box {
  font-size:3.8vw
 }
}
.deductible-box a {
 margin-top:2px
}
.noright {
 padding:0!important;
 width:165px!important
}
.label-checkbox {
 margin-top:14px
}
.label-checkbox label {
 font-size:14px
}
@media screen and (max-width:420px) {
 .label-checkbox label {
  font-size:3.8vw
 }
}
.label-checkbox label .input-check {
 -webkit-appearance:none;
 outline:none;
 width:20px;
 height:20px;
 margin:-2px 10px 0 0;
 border-radius:3px;
 background-color:#fff;
 border:2px solid rgba(37,56,88,.4);
 vertical-align:middle
}
.label-checkbox label .input-check:checked {
 background:#36b37e;
 border:1px solid #36b37e
}
.label-checkbox label .input-check:checked:after {
 -webkit-transform:rotate(45deg);
 transform:rotate(45deg);
 border-spacing:0;
 display:block;
 border:2px solid #fff;
 border-top:0;
 border-left:0;
 content:"";
 height:11px;
 margin-left:7px;
 margin-top:2px;
 width:5px
}
.link_port {
 color:#ff5630;
 display:block;
 font-size:14px;
 font-weight:600
}
@media screen and (max-width:420px) {
 .link_port {
  font-size:3.8vw
 }
}
.link_port:hover {
 color:#ff5630
}
.label-buyBack label {
 display:flex
}
.label-buyBack label .input-check {
 margin:0 8px 0 0
}
.label-buyBack label .input-check:disabled {
 background:#b3bac5;
 border:#b3bac5;
 position:relative
}
.label-buyBack label .input-check:disabled:after {
 content:"";
 background:#fff;
 height:2px;
 width:10px;
 position:absolute;
 top:9px;
 left:5px
}
.label-buyBack .buyBackContent {
 color:#505f79
}
.save_amount {
 color:#253858!important;
 font-weight:500!important;
 margin-top:5px!important
}
.link_required {
 color:#ff5630;
 display:block;
 text-align:right;
 font-size:12px
}
.port_info {
 position:absolute;
 right:0;
 top:1px
}
.pos-rel {
 position:relative
}
.total_product_amount {
 display:inline-block;
 position:relative;
 font-size:16px;
 font-weight:500;
 width:140px
}
@media screen and (max-width:420px) {
 .total_product_amount {
  font-size:4.5vw
 }
}
.total_product_amount span {
 font-size:12px;
 color:#7a869a;
 display:block
}
.total_product_amount .break_modal_icon {
 display:flex
}
.total_product_amount .break_modal_icon .arrow_premiumbreakup {
 position:relative
}
.total_product_amount .break_modal_icon .arrow_premiumbreakup:after {
 width:16px;
 height:16px;
 background-color:#dfe1e6;
 content:"";
 position:absolute;
 left:9px;
 top:5px;
 border-radius:30px
}
.total_product_amount .break_modal_icon .arrow_premiumbreakup:before {
 content:"";
 border:solid #253858;
 border-width:0 1px 1px 0;
 display:inline-block;
 padding:2px;
 transform:rotate(225deg);
 margin-left:3px;
 vertical-align:middle;
 position:absolute;
 top:12px;
 left:12px;
 z-index:1
}
.label-radiobox {
 margin-top:14px
}
.label-radiobox label {
 font-size:14px;
 margin-right:15px
}
@media screen and (max-width:420px) {
 .label-radiobox label {
  font-size:3.8vw
 }
}
.label-radiobox label .input-radio {
 -webkit-appearance:none;
 outline:none;
 width:20px;
 height:20px;
 margin:-2px 5px 0 0;
 border-radius:30px;
 background-color:#fff;
 border:2px solid rgba(37,56,88,.4);
 vertical-align:middle
}
.label-radiobox label .input-radio:checked {
 background:#36b37e;
 border:1px solid #36b37e
}
.label-radiobox label .input-radio:checked:after {
 -webkit-transform:rotate(45deg);
 transform:rotate(45deg);
 border-spacing:0;
 display:block;
 border:2px solid #fff;
 border-top:0;
 border-left:0;
 content:"";
 height:11px;
 margin-left:7px;
 margin-top:3px;
 width:5px
}
.label-radiobox label .input-radio:checked:before {
 background:#ff5630;
 border:1px solid #ff5630
}
.banner-card {
 width:100%;
 min-height:100px;
 border-radius:10px;
 box-shadow:0 2px 4px 0 rgba(0,0,0,.16);
 background-color:#fff;
 margin:0;
 flex-direction:column;
 padding:12px 16px 0
}
.help-box {
 margin:20px 16px 30px;
 background:#fff url(https://static.pbcdn.in/health-cdn/images/images/help-chat-right-new.png) no-repeat 100%;
 font-weight:700;
 width:calc(100% - 32px);
 font-size:16px
}
@media screen and (max-width:420px) {
 .help-box {
  font-size:4.5vw
 }
}
.help-box span {
 display:block;
 font-weight:600;
 margin:0 0 10px;
 font-size:14px
}
@media screen and (max-width:420px) {
 .help-box span {
  font-size:3.8vw
 }
}
.help-box button {
 width:auto;
 -webkit-appearance:none;
 background:#fff;
 color:#ff5630!important;
 font-weight:600;
 border-radius:4px;
 height:35px;
 text-align:center;
 border:1px solid #ff5630;
 -webkit-box-shadow:none;
 box-shadow:none;
 outline:none;
 padding:0 15px;
 min-width:85px;
 margin:0 10px 10px 0;
 font-size:12px
}
@media screen and (max-width:420px) {
 .help-box button {
  font-size:3.2vw
 }
}
.help-box button:hover {
 color:#ff5630!important
}
.info_icon {
 width:12px;
 height:12px;
 background-color:#6b778c;
 border-radius:100%;
 display:inline-flex;
 font-size:10px;
 justify-content:center;
 align-items:center;
 margin:0 0 0 8px;
 color:#fff;
 font-weight:700
}
.info_icon2 {
 background:url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAA4AAAAOCAYAAAAfSC3RAAAAAXNSR0IArs4c6QAAAbFJREFUKBVjZEAD1W2zSri4OUJ//fqjAZJiY2O58eXrj9XtVWk9yEoZYZyyztkyXMwsp9zsTASEhfk5JcVFwFLPX75hePv24/fdh868+/r3n1lXefIzmB4GkKZJc9a+ePPu439c4PWbD/8nzF7zrKp1piRIIxOIANkUFeQiLizIB+KCweylWxjmADEMiAjzM0QFOkuyc7CdBokxg/zk6WjupaYsywJTBKLPXb4F5hrrqcGFubk4GFhZWFjFlIx+sIACAugnDrgslJEa7YMuBOYLC/Fz8nFxhDL9/vVHExYQyCqfvnjD8PT5a2QhMFtKQoTh16/fWijOQ1Z1884jBmBAMUhLiiILw9lMrGws10FBTix4BnQJGxvrNSZQ5ALj6QexGt8A1X768m0lWH1jz/wnoHhCBnsPn/2/59AZZKH/L16/+9/Yu+AhSBM4HkEpYvn63S9ev/0At1hDVZ5BE4hh4OWb9wyrNu5/+fPHbzOQGDzJgVIEKHKdbU2FRYT4OEChBwIgP4Gct/fI2VcgTW3VqS9B4nCNIA4IVLTPLgbFEyjIQXxQQID81FGd3g/iwwAA+BfexQ9gyzcAAAAASUVORK5CYII=") no-repeat 0 0;
 width:14px;
 height:14px;
 margin-right:10px;
 text-indent:-999999px;
 margin-top:4px
}
.deduct-info {
 margin-left:5px;
 margin-top:2px
}
.info_ped_rider {
 margin-left:0;
 margin-top:0
}
.none-box {
 display:none!important
}
.premium-box {
 width:100%;
 height:auto;
 box-shadow:0 -3px 6px 0 rgba(0,0,0,.16);
 background-color:#fff;
 position:fixed;
 bottom:-30px;
 left:0;
 border-radius:5px 5px 0 0;
 padding:15px;
 z-index:999
}
.premium-box button {
 display:inline-block;
 width:100%;
 height:48px;
 background:#ff5630;
 color:#fff!important;
 font-size:14px;
 font-weight:600;
 text-transform:uppercase;
 border-radius:4px;
 text-align:center;
 line-height:48px;
 border:none
}
@media screen and (max-width:420px) {
 .premium-box button {
  font-size:3.8vw
 }
}
.premium-box button.added_to_cart {
 border:1px solid #ff5630;
 color:#ff5630!important;
 background:#fff
}
.premium-box .buttonContainerCart {
 display:flex;
 justify-content:space-between
}
.premium-box .buttonContainerCart button.added_to_cart {
 margin-right:16px;
 border:1px solid #253858;
 color:#253858!important;
 font-weight:600
}
.premium-box .headbar-break {
 justify-content:space-between;
 color:#253858;
 display:flex;
 flex-direction:row;
 margin:0 0 10px;
 align-items:center;
 padding-right:0
}
.premium-box .headbar-break h2 {
 font-weight:700
}
.premium-box .headbar-break>div:first-child {
 font-size:16px;
 color:#253858;
 font-weight:700
}
.premium-box .headbar-break .close-box {
 width:32px;
 height:32px;
 border-radius:50%;
 position:relative;
 transition:all .2s ease-in;
 margin-right:-6px
}
.premium-box .headbar-break .close-box:hover {
 background:none
}
.premium-box .headbar-break .close-box:before {
 content:"";
 position:absolute;
 height:20px;
 width:2px;
 transform:rotate(45deg);
 left:15px;
 top:6px;
 background:#253858
}
.premium-box .headbar-break .close-box:after {
 content:"";
 position:absolute;
 height:20px;
 width:2px;
 transform:rotate(-45deg);
 left:15px;
 top:6px;
 background:#253858
}
.total-row {
 font-size:16px;
 color:#253858;
 border-bottom:1px solid #dfe1e6;
 border-top:1px solid #dfe1e6;
 padding:8px 0;
 justify-content:space-between;
 margin-bottom:15px;
 font-weight:700
}
@media screen and (max-width:420px) {
 .total-row {
  font-size:4.5vw
 }
}
.total-row span {
 font-size:14px;
 font-weight:600
}
@media screen and (max-width:420px) {
 .total-row span {
  font-size:3.8vw
 }
}
.amount-breakup-card {
 overflow:scroll;
 max-height:394px;
 position:relative;
 width:100%;
 bottom:0;
 top:0;
 background:#fff;
 left:0
}
.amount-breakup-card::-webkit-scrollbar {
 display:none
}
.breakup_inner_product {
 width:100%;
 margin:10px 0 0;
 border-bottom:1px solid #dfe1e6
}
.breakup_inner_product:last-child {
 border-bottom:none
}
.breakup_inner_product .logo_name_box {
 display:flex;
 flex-direction:row;
 width:100%;
 margin:0 0 20px
}
.breakup_inner_product .logo_name_box .logo_pr_box {
 min-width:90px;
 margin-right:15px;
 width:90px
}
.breakup_inner_product .logo_name_box .logo_pr_box img {
 margin-top:4px
}
.breakup_inner_product .logo_name_box .plan_pr_box {
 font-size:14px;
 font-weight:700;
 width:calc(100% - 124px)
}
@media screen and (max-width:420px) {
 .breakup_inner_product .logo_name_box .plan_pr_box {
  font-size:3.8vw
 }
}
.breakup_inner_product .delete_cart {
 background:url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAA0AAAAPCAYAAAA/I0V3AAAAAXNSR0IArs4c6QAAAV1JREFUKBXtkqtPA0EQxmd2ry2iDhBFkODRGDAITD11BFNoBQSBumsvqbheMRhCaFISSCApsn8ACaKCkOBIMKCaQhA8JIV7zDAH1wupwzNmvv3tfLuzD4RfYbqHeWY2FcJCghm7yGjXq8XukOFQbLpHk1nw2w2rtDRkUa7Vjsc+0t67T/7MbnWjFzGsOK0yI88DQgYYZwE4wwg5ZGCZBmS9TRhsCb+RkacILg1W0JRiC5j6irgShCFj2siLUUJ8QB1AvEDmOWHTpPFA2leO7FQgZVw5dvn+LWf0Mt7TvrS59zoOzbT/+Nyw1u8Upa7lbMtM4Ki6VbRlAIooG6098YInXmqqMKoDg7JSFjaq67aKJv8a/6b4xuKL4H5AehCzTqj5dlTjpx4ww0PEv9/ddFsroguo4JQYUrEhSTpkjzWuAnHbrZTayYf9MfKirJNOqmMh38sLtTrfMdfOIvQFTmaVdqM2nrMAAAAASUVORK5CYII=") no-repeat 4px 1px;
 width:18px;
 height:17px;
 text-indent:-999999px
}
.breakup_inner_product .inner_box_2 {
 display:flex;
 flex-direction:row;
 justify-content:space-between;
 margin:15px 0
}
.breakup_inner_product .inner_box_2 .label_cart {
 flex-direction:column;
 display:flex;
 color:#253858
}
.breakup_inner_product .inner_box_2 .label_cart .label-1 {
 color:#7a869a;
 font-size:12px
}
@media screen and (max-width:420px) {
 .breakup_inner_product .inner_box_2 .label_cart .label-1 {
  font-size:3.2vw
 }
}
.breakup_inner_product .inner_box_2 .label_cart .label-2 {
 font-size:14px;
 font-weight:700
}
@media screen and (max-width:420px) {
 .breakup_inner_product .inner_box_2 .label_cart .label-2 {
  font-size:3.8vw
 }
}
.breakup_inner_product .riders_pr h2 {
 font-weight:700;
 font-size:14px;
 margin-bottom:4px;
 display:inline-block
}
@media screen and (max-width:420px) {
 .breakup_inner_product .riders_pr h2 {
  font-size:3.8vw
 }
}
.breakup_inner_product .riders_box_pr {
 display:flex;
 flex-direction:row;
 width:100%;
 justify-content:space-between;
 margin-bottom:15px;
 font-size:14px;
 color:#7a869a
}
@media screen and (max-width:420px) {
 .breakup_inner_product .riders_box_pr {
  font-size:3.8vw
 }
}
.breakup_inner_product .riders_box_pr .blk {
 display:block
}
.breakup_inner_product .riders_box_pr .bold {
 font-weight:700;
 margin-left:20px;
 color:#253858
}
.modal_product {
 display:table;
 height:100vh;
 width:100%;
 position:fixed;
 top:0;
 bottom:0;
 left:0;
 right:0;
 background:rgba(0,0,0,.7);
 z-index:9999
}
.modal_product .modal_inside {
 display:table-cell;
 vertical-align:middle;
 width:100%
}
.modal_product .modal_wrap {
 border-radius:10px;
 box-shadow:0 2px 4px 0 rgba(0,0,0,.16);
 background-color:#fff;
 padding:16px;
 width:90%;
 margin:7px auto;
 max-width:328px
}
.modal_product .modal_wrap h2 {
 font-size:16px;
 color:#253858;
 font-weight:700;
 margin:0 0 12px
}
@media screen and (max-width:420px) {
 .modal_product .modal_wrap h2 {
  font-size:4.5vw
 }
}
.modal_product .modal_wrap p {
 font-size:14px;
 margin:0 0 20px;
 line-height:1.5
}
@media screen and (max-width:420px) {
 .modal_product .modal_wrap p {
  font-size:3.8vw
 }
}
.modal_product .modal-bottom {
 justify-content:flex-end
}
.modal_product .modal-bottom button {
 display:inline-block;
 width:140px;
 height:36px;
 background:#ff5630;
 color:#fff;
 font-size:14px;
 font-weight:600;
 text-transform:uppercase;
 border-radius:4px;
 text-align:center;
 line-height:36px;
 padding:0 16px;
 margin:0 0 0 8px;
 border:none;
 cursor:pointer;
 position:relative
}
@media screen and (max-width:420px) {
 .modal_product .modal-bottom button {
  font-size:3.8vw
 }
}
.modal_product .modal-bottom .cancel-link {
 font-size:14px;
 font-weight:600;
 color:#ff5630;
 text-transform:uppercase;
 cursor:pointer;
 white-space:nowrap
}
@media screen and (max-width:420px) {
 .modal_product .modal-bottom .cancel-link {
  font-size:3.8vw
 }
}
.wid-100 {
 width:100%!important
}
.field_wrapper_family {
 padding:75px 16px 0!important;
 height:calc(100% - 100px);
 overflow:auto;
 position:fixed;
 width:100%
}
.box-container {
 display:flex;
 margin-bottom:12px;
 transition:all .5s ease-in;
 grid-template-columns:75% auto
}
.box-container>.field_container {
 background-color:#fff;
 height:48px;
 box-shadow:none;
 border-radius:3px;
 font-size:14px;
 color:#253858;
 position:relative;
 border:1px solid rgba(37,56,88,.2);
 width:calc(60% - 10px);
 margin-right:10px
}
.box-container.full>.field_container {
 width:100%;
 margin-right:0
}
.checkbox-family {
 display:flex
}
.checkbox-family label {
 position:relative;
 height:50px;
 width:100%;
 cursor:pointer
}
.checkbox-family label input[type=checkbox] {
 opacity:0;
 visibility:hidden;
 position:absolute;
 z-index:1
}
.checkbox-family label input[type=checkbox]+span {
 width:100%;
 height:48px;
 padding:10px 10px 10px 40px;
 border:1px solid transparent;
 font-style:normal;
 display:block;
 color:#253858;
 line-height:25px
}
.checkbox-family label input[type=checkbox]+span:before {
 content:"";
 width:18px;
 height:18px;
 background:#fff;
 border-radius:50%;
 position:absolute;
 left:9px;
 top:15px;
 border:1px solid #7a869a
}
.checkbox-family label input[type=checkbox]:checked+span:before {
 content:"";
 background:#36b37e;
 border:1px solid #36b37e
}
.checkbox-family label input[type=checkbox]:checked+span:after {
 content:"";
 display:block;
 width:5px;
 height:9px;
 border:solid #fff;
 border-width:0 2px 2px 0;
 transform:rotate(45deg);
 position:absolute;
 left:16px;
 top:19px
}
.box_family {
 width:40%;
 position:relative
}
.box_family select {
 background:#fff;
 border-radius:3px;
 box-shadow:none;
 display:block;
 width:100%;
 height:50px;
 padding:10px 30px 10px 13px;
 border:1px solid rgba(37,56,88,.2);
 font-size:14px;
 color:#253858;
 line-height:27px;
 transition:border .3s ease-in;
 -webkit-appearance:none;
 outline:none
}
.box_family .error {
 border:1px solid #ff5630!important
}
.box_family:after {
 content:"";
 border:solid #253858;
 border-width:0 1.5px 1.5px 0;
 display:inline-block;
 padding:3px;
 transform:rotate(45deg);
 margin-left:3px;
 vertical-align:middle;
 position:absolute;
 top:20px;
 right:11px;
 z-index:1
}
.box-container.kids {
 display:block
}
.kids_box-container .field_container {
 font-size:14px;
 color:#212121;
 align-items:center;
 display:inline-block;
 position:relative;
 background:#fff;
 box-shadow:none;
 border-radius:3px;
 padding-left:13px;
 border:1px solid rgba(37,56,88,.2);
 width:calc(70% - 10px);
 line-height:48px;
 margin-right:10px
}
.kids_box-container .select_box {
 width:calc(100% - 10px);
 margin-left:10px
}
.checklist_son {
 position:absolute;
 right:0;
 top:0;
 padding-top:12px;
 width:115px;
 height:48px
}
.radio_kids label {
 margin:0 2px 9px;
 display:inline-block;
 cursor:pointer
}
.radio_kids .click_add_2 {
 margin-left:48px!important
}
.radio_kids .circle_kids {
 background:#fff;
 border-radius:40px;
 box-shadow:0 2px 4px rgba(0,0,0,.1);
 display:inline-block;
 align-items:center;
 border:1px solid #b3bac5;
 font-style:normal;
 font-size:18px;
 color:#b3bac5;
 width:24px;
 height:24px;
 line-height:21px;
 text-align:center
}
.radio_kids .circle_active {
 border:1px solid #253858;
 color:#253858;
 background:#fff
}
.checklist_son .input_kid {
 width:36px;
 height:24px;
 border:1px solid #253858;
 top:12px;
 left:32px;
 position:absolute;
 border-radius:4px;
 font-size:14px;
 color:#253858;
 text-align:center;
 line-height:22px
}
.checklist_son .active {
 border:1px solid #253858;
 color:#253858;
 background:#fff
}
.box-container.kids>.field_container {
 width:100%
}
.kids_box-container {
 display:flex;
 margin:10px 10px 0;
 height:48px
}
.info-msg {
 color:#253858;
 font-size:14px;
 line-height:20px
}
@media screen and (max-width:420px) {
 .info-msg {
  font-size:3.8vw
 }
}
.multiplan_card {
 width:100%;
 margin-bottom:25px
}
.multiplan_card h2 {
 font-weight:600;
 font-size:12px;
 color:#6b778c;
 border-bottom:1px solid #b3bac5;
 padding-bottom:10px;
 margin-bottom:15px
}
@media screen and (max-width:420px) {
 .multiplan_card h2 {
  font-size:3.2vw
 }
}
.multiplan_card .plan-individual {
 font-size:14px;
 font-weight:600;
 color:#253858;
 line-height:1.8
}
@media screen and (max-width:420px) {
 .multiplan_card .plan-individual {
  font-size:3.8vw
 }
}
.multiplan_card .plan-individual span {
 display:block
}
.multiplan_card .plan-individual strong {
 color:#253858
}
.logo-detais-cart {
 max-width:80px;
 margin-right:20px;
 min-width:80px
}
.logo-detais-cart img {
 object-fit:contain
}
.term_wrapper {
 max-height:75vh;
 overflow-y:auto;
 margin-bottom:20px
}
.term_wrapper::-webkit-scrollbar {
 display:none
}
.term_wrapper h3 {
 font-size:14px;
 font-weight:700
}
@media screen and (max-width:420px) {
 .term_wrapper h3 {
  font-size:3.8vw
 }
}
.term_wrapper ul.term_listing {
 display:block;
 width:100%;
 margin:0 0 34px;
 padding:0
}
.term_wrapper ul.term_listing li {
 width:100%
}
.term_wrapper ul.term_listing li label {
 display:block;
 position:relative;
 cursor:pointer;
 -webkit-user-select:none;
 -moz-user-select:none;
 -ms-user-select:none;
 user-select:none;
 font-size:16px;
 border-bottom:1px solid #b3bac5;
 padding:16px 0
}
@media screen and (max-width:420px) {
 .term_wrapper ul.term_listing li label {
  font-size:4.5vw
 }
}
.term_wrapper ul.term_listing li label input {
 position:absolute;
 opacity:0;
 cursor:none
}
.term_wrapper ul.term_listing li label .checkmark {
 position:absolute;
 top:17px;
 right:0;
 border-radius:50%;
 width:18px;
 height:18px;
 border:1px solid rgba(37,56,88,.5);
 background-color:#fff
}
.term_wrapper ul.term_listing li label input:checked~.checkmark {
 background-color:#fff;
 border:1px solid #36b37e
}
.term_wrapper ul.term_listing li label .checkmark:after {
 content:"";
 position:absolute;
 display:none
}
.term_wrapper ul.term_listing li label input:checked~.checkmark:after {
 display:block
}
.term_wrapper ul.term_listing li label .checkmark:after {
 top:3px;
 right:3px;
 width:10px;
 height:10px;
 border-radius:50%;
 background:#36b37e
}
.term_wrapper .last-box {
 margin:0!important
}
.button-term {
 width:100%!important;
 margin-left:0!important;
 height:48px!important
}
.emi-wrap {
 background:#fff;
 height:100vh!important
}
.emi-inner {
 padding:16px 0!important;
 margin-top:44px
}
.emi-inner p {
 color:#253858;
 font-size:14px;
 margin-bottom:20px;
 padding:16px 16px 0
}
@media screen and (max-width:420px) {
 .emi-inner p {
  font-size:3.8vw
 }
}
.emi-inner p a {
 color:#ff5630;
 font-size:12px;
 display:block
}
@media screen and (max-width:420px) {
 .emi-inner p a {
  font-size:3.2vw
 }
}
.emiAccordionSection {
 position:relative;
 z-index:2
}
.emiAccordionSection input[type=checkbox] {
 position:absolute;
 opacity:0;
 z-index:-1
}
.emiAccordionSection label {
 padding:15px 16px;
 width:100%;
 display:block;
 font-size:14px;
 color:#253858;
 cursor:pointer;
 position:relative;
 border-top:1px solid #b3bac5
}
@media screen and (max-width:420px) {
 .emiAccordionSection label {
  font-size:3.8vw
 }
}
.emiAccordionSection label:after {
 content:"";
 border:solid #253858;
 border-width:0 .5px .5px 0;
 display:inline-block;
 padding:4px;
 transform:rotate(45deg);
 vertical-align:middle;
 position:absolute;
 right:20px;
 top:50%;
 transition:all .3s ease-in;
 margin-top:-7px;
 transform-origin:center center
}
.emiAccordionSection .accordionContent {
 max-height:0;
 transition:all .35s;
 opacity:0;
 display:none
}
.emiAccordionSection input[type=checkbox]:checked+label {
 background:#f4f5f7;
 font-weight:700
}
.emiAccordionSection input[type=checkbox]:checked+label:after {
 transform:rotate(-135deg);
 margin-top:-2px
}
.emiAccordionSection input[type=checkbox]:checked~.accordionContent {
 max-height:100%;
 opacity:1;
 display:block;
 padding-bottom:5px
}
.emiAccordionSection input[type=checkbox]:checked~.accordionContent.flexRow {
 display:flex
}
.tabs_emi_box {
 border-bottom:1px solid #d4d8e3;
 background:#fff;
 display:flex;
 width:100%;
 align-items:center
}
.tabs_emi_box .inner_cc_box {
 width:50%;
 height:40px;
 align-items:center;
 display:flex;
 justify-content:center;
 font-size:16px;
 font-weight:600;
 color:#253858;
 cursor:pointer
}
@media screen and (max-width:420px) {
 .tabs_emi_box .inner_cc_box {
  font-size:4.5vw
 }
}
.tabs_emi_box .inner_cc_box.active {
 font-size:16px;
 font-weight:700;
 color:#253858;
 border-bottom:2px solid #253858;
 cursor:inherit
}
@media screen and (max-width:420px) {
 .tabs_emi_box .inner_cc_box.active {
  font-size:4.5vw
 }
}
.debit_card_box {
 padding:10px;
 text-align:left;
 line-height:17px;
 font-size:14px
}
@media screen and (max-width:420px) {
 .debit_card_box {
  font-size:3.8vw
 }
}
.debit_card_box p {
 margin:0;
 padding:0 0 16px!important
}
.debit_card_box .debit_bank_inner {
 width:100%;
 border:1px solid #eaedf4;
 background-color:#fff;
 margin-top:15px
}
.debit_card_box .bank_name {
 height:30px;
 background-color:#eaedf4;
 font-size:12px;
 font-weight:700;
 color:#25292f;
 display:flex;
 align-items:center;
 padding-left:12px
}
.debit_card_box .sp_bank {
 padding:12px 12px 0;
 font-size:12px
}
.debit_card_box .sp_bank p {
 font-weight:500;
 padding:0
}
.debit_card_box .deatils_bank_info {
 display:flex;
 flex-direction:column;
 margin:0 0 20px;
 font-size:14px;
 line-height:20px
}
@media screen and (max-width:420px) {
 .debit_card_box .deatils_bank_info {
  font-size:3.8vw
 }
}
.debit_card_box .deatils_bank_info div {
 font-weight:700;
 font-size:16px
}
@media screen and (max-width:420px) {
 .debit_card_box .deatils_bank_info div {
  font-size:4.5vw
 }
}
.debit_card_box .debit_buttons {
 width:160px;
 height:36px;
 border-radius:4px;
 background-color:#ff5630;
 font-size:14px!important;
 font-weight:600!important;
 color:#fff;
 display:flex;
 align-items:center;
 justify-content:center;
 text-transform:uppercase;
 margin:8px 0 0
}
.main-amount-box {
 display:flex;
 flex-direction:column;
 color:#253858
}
.main-amount-box strong {
 color:#253858
}
.main-amount-box .row-box {
 display:flex;
 width:100%;
 margin-bottom:16px;
 font-weight:500;
 font-size:14px;
 padding:0 16px
}
@media screen and (max-width:420px) {
 .main-amount-box .row-box {
  font-size:3.8vw
 }
}
.main-amount-box .row-header {
 background:#f4f5f6;
 padding:10px 16px 14px;
 border-bottom:1px solid #b3bac5;
 text-transform:uppercase
}
.main-amount-box .col-box {
 width:48%
}
.main-amount-box .col-box2 {
 width:30%
}
.main-amount-box .col-box3 {
 width:30%;
 text-align:right
}
.main-amount-box .blk-in {
 display:block
}
.proposal_button {
 width:200px
}
.bag_icon {
 background:url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABEAAAAVCAYAAACg/AXsAAAAAXNSR0IArs4c6QAAADhlWElmTU0AKgAAAAgAAYdpAAQAAAABAAAAGgAAAAAAAqACAAQAAAABAAAAEaADAAQAAAABAAAAFQAAAABY2xf7AAACuElEQVQ4EZVTTUhUURQ+59w7zxnHfhDKFhPiqC2LNDR3LooWUlAytGrRQqpNQcuiTbsgyIjW0W5sCKOVtaqw8ochiCIER2m0FiKVfznOvHdP3zMlGWVo7uLde8857zvnft85TDusRFcqVqNyh5W7VN1uYjPNGtybHHvyYodwknJjCBANeAgAF+H7wcQTpG6/Eg8mO1I95fHhfRuI58wtIm5XR9cnR9OnJscGzswtzp8kprfC8iB55PyhciAODQ2HL8Rro8UWcq7GGO5XZlsquivGir/5A57VbcT0k+pVR/TGSbH4dWTwS+gHSHskebz5kZC0qZJl0gMo/Td8C5sAGzuLUquS5pGkoETO94O+fDYzbJs6D9WDtE5SWkK21yrUK0zzpDy0FQS+eoC3OtZP4Okbsvd5xpxAzLD1fVfnWVaw86q0JncjVnsCobnp0fSNrSAHO3qPeRS5hEqy4nhAxXWTcDSMEWv9OJBjTqkw8yH9HbanzhVubwUIzzMr8pHEPS4uRO/7RldABOP59aHPGpU4qkiAsEJomBofuIkN3JWtz5lijiiUXVuOpkRrICxTMowSJxwHHySqoxu/bQfYcGBDJFEhSssoZBpXIKUMOJSmUCMQtvIvtvJp9n1mVVUtIHcl26kOSNoIw2oQmP8GCVMg7yI+e0vOxAWdGYNp1hhZrpy/zMuUQyUaiWid4D3N4JnRoVVVAnJWUU0CcqMS4j3I8TMiQVUgaMY8McfQU+CE2YdhaSpLVT3HrasTqopKWF3DettQJih7dcWruL9qQuQOnAMPrQXNq1sswS91Ou+cbyyz5EBSZ2Pb2XNqZMJageyVl645xphcRlQtG8paKuk1tvIs4nmYGc5jFNfbvyKMlUQ4OOiTh1MjmedQiQizsI88Pg1zE4uxFQHgdIGuIdnL3Hj6XRj7B78YIaLX8SPDAAAAAElFTkSuQmCC") no-repeat 0 0;
 width:30px;
 height:22px;
 text-indent:-999999px
}
.close_cart {
 width:32px;
 height:32px;
 background:none;
 border-radius:30px;
 text-indent:-999999px;
 position:relative
}
.close_cart:after,
.close_cart:before {
 content:"";
 width:2px;
 height:16px;
 display:block;
 position:absolute;
 left:70%!important;
 top:54%;
 background:#253858;
 border-radius:2px
}
.close_cart:after {
 transform:translate(-50%,-50%) rotate(-45deg)
}
.close_cart:before {
 transform:translate(-50%,-50%) rotate(45deg)
}
.cart_box_product {
 margin:16px
}
.cart_box_product h2 {
 font-size:14px;
 font-weight:700;
 color:#253858
}
@media screen and (max-width:420px) {
 .cart_box_product h2 {
  font-size:3.8vw
 }
}
.cart_inner_product {
 border-radius:10px;
 box-shadow:0 2px 4px 0 rgba(0,0,0,.16);
 background-color:#fff;
 width:100%;
 margin:10px 0 24px;
 padding:12px
}
.cart_inner_product .logo_name_box {
 display:flex;
 flex-direction:row;
 width:100%
}
.cart_inner_product .logo_name_box .logo_pr_box {
 min-width:90px;
 margin-right:15px;
 width:90px
}
.cart_inner_product .logo_name_box .logo_pr_box img {
 margin-top:4px
}
.cart_inner_product .logo_name_box .plan_pr_box {
 font-size:14px;
 font-weight:700;
 width:calc(100% - 124px)
}
@media screen and (max-width:420px) {
 .cart_inner_product .logo_name_box .plan_pr_box {
  font-size:3.8vw
 }
}
.cart_inner_product .delete_cart {
 background:url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAA0AAAAPCAYAAAA/I0V3AAAAAXNSR0IArs4c6QAAAV1JREFUKBXtkqtPA0EQxmd2ry2iDhBFkODRGDAITD11BFNoBQSBumsvqbheMRhCaFISSCApsn8ACaKCkOBIMKCaQhA8JIV7zDAH1wupwzNmvv3tfLuzD4RfYbqHeWY2FcJCghm7yGjXq8XukOFQbLpHk1nw2w2rtDRkUa7Vjsc+0t67T/7MbnWjFzGsOK0yI88DQgYYZwE4wwg5ZGCZBmS9TRhsCb+RkacILg1W0JRiC5j6irgShCFj2siLUUJ8QB1AvEDmOWHTpPFA2leO7FQgZVw5dvn+LWf0Mt7TvrS59zoOzbT/+Nyw1u8Upa7lbMtM4Ki6VbRlAIooG6098YInXmqqMKoDg7JSFjaq67aKJv8a/6b4xuKL4H5AehCzTqj5dlTjpx4ww0PEv9/ddFsroguo4JQYUrEhSTpkjzWuAnHbrZTayYf9MfKirJNOqmMh38sLtTrfMdfOIvQFTmaVdqM2nrMAAAAASUVORK5CYII=") no-repeat 4px 1px;
 width:18px;
 height:17px;
 text-indent:-999999px
}
.cart_inner_product .inner_box_2 {
 display:flex;
 flex-direction:row;
 justify-content:space-between;
 margin:15px 0
}
.cart_inner_product .inner_box_2 .label_cart {
 flex-direction:column;
 display:flex;
 color:#253858
}
.cart_inner_product .inner_box_2 .label_cart .label-1 {
 color:#7a869a;
 font-size:12px
}
@media screen and (max-width:420px) {
 .cart_inner_product .inner_box_2 .label_cart .label-1 {
  font-size:3.2vw
 }
}
.cart_inner_product .inner_box_2 .label_cart .label-2 {
 font-size:14px;
 font-weight:700
}
@media screen and (max-width:420px) {
 .cart_inner_product .inner_box_2 .label_cart .label-2 {
  font-size:3.8vw
 }
}
.cart_inner_product .riders_pr {
 margin-bottom:15px
}
.cart_inner_product .riders_pr h2 {
 font-weight:700;
 font-size:12px
}
@media screen and (max-width:420px) {
 .cart_inner_product .riders_pr h2 {
  font-size:3.2vw
 }
}
.cart_inner_product .riders_box_pr {
 display:flex;
 flex-direction:row;
 width:100%;
 justify-content:space-between;
 font-size:14px
}
@media screen and (max-width:420px) {
 .cart_inner_product .riders_box_pr {
  font-size:3.8vw
 }
}
.cart_inner_product .riders_box_pr .blk {
 display:block
}
.cart_inner_product .riders_box_pr .bold {
 font-weight:700;
 margin-left:20px
}
.cart_wrapper_inner {
 padding:0;
 overflow-y:auto;
 height:calc(100vh - 55px);
 position:fixed;
 width:100%
}
.cart-blank {
 font-size:14px;
 text-align:center;
 line-height:22px
}
@media screen and (max-width:420px) {
 .cart-blank {
  font-size:3.8vw
 }
}
.cart-blank span {
 color:#ff5630;
 text-transform:uppercase;
 font-weight:600;
 display:block
}
.feature_popup_button {
 height:auto
}
.cig_box {
 align-items:center
}
.cig_box .button {
 width:auto;
 -webkit-appearance:none;
 background:#fff;
 color:#ff5630!important;
 font-weight:600;
 border-radius:4px;
 height:35px;
 text-align:center;
 border:1px solid #ff5630;
 -webkit-box-shadow:none;
 box-shadow:none;
 outline:none;
 padding:0 15px;
 min-width:85px;
 font-size:12px
}
@media screen and (max-width:420px) {
 .cig_box .button {
  font-size:3.2vw
 }
}
.cig-wrap {
 background:#f4f5f7
}
.cig-inner {
 padding:0
}
.cig-inner .cig-multi {
 font-size:12px;
 display:block;
 font-weight:400;
 color:#505f79;
 margin-top:4px
}
@media screen and (max-width:420px) {
 .cig-inner .cig-multi {
  font-size:3.2vw
 }
}
.cig-inner .cig-multi span {
 font-size:14px;
 font-weight:700;
 padding-right:20px;
 display:block;
 color:#253858
}
@media screen and (max-width:420px) {
 .cig-inner .cig-multi span {
  font-size:3.8vw
 }
}
.cig-inner .cig-multi span .lower-pre {
 display:inline-block;
 color:#7a869a;
 text-decoration:line-through;
 padding-right:5px
}
.cig-inner .recommend {
 color:#36b37e
}
.cig-inner .button-main {
 width:100%;
 height:48px;
 background:#ff5630;
 color:#fff;
 font-size:14px;
 font-weight:600;
 text-transform:uppercase;
 border-radius:4px;
 text-align:center;
 line-height:48px;
 margin:30px 0 10px
}
@media screen and (max-width:420px) {
 .cig-inner .button-main {
  font-size:3.8vw
 }
}
.cig-inner .view-break {
 text-align:center
}
.cig-inner .view-break span {
 font-size:12px;
 font-weight:600;
 line-height:1.83;
 color:#ff5630;
 text-transform:uppercase
}
@media screen and (max-width:420px) {
 .cig-inner .view-break span {
  font-size:3.2vw
 }
}
.cig-inner .how-cig {
 margin:16px 0 0
}
.cig-inner .how-cig h3 {
 font-size:14px;
 font-weight:700;
 margin-bottom:5px
}
@media screen and (max-width:420px) {
 .cig-inner .how-cig h3 {
  font-size:3.8vw
 }
}
.cig-inner .how-cig p {
 font-size:14px
}
@media screen and (max-width:420px) {
 .cig-inner .how-cig p {
  font-size:3.8vw
 }
}
.cig-inner .sp-bot {
 margin-bottom:0
}
.cig-inner .view-breakup-box {
 display:flex;
 flex-direction:column;
 border-top:1px solid #dfe1e6;
 padding-top:8px;
 margin-top:10px
}
.cig-inner .view-breakup-box .row-box {
 display:flex;
 width:100%;
 margin-bottom:8px;
 font-size:14px;
 font-weight:600
}
@media screen and (max-width:420px) {
 .cig-inner .view-breakup-box .row-box {
  font-size:3.8vw
 }
}
.cig-inner .view-breakup-box .col-box {
 width:52%
}
.cig-inner .view-breakup-box .col-box2 {
 width:44%
}
.cig-inner .view-breakup-box .col-box3 {
 width:20%;
 text-align:right
}
.cig-inner .break-total {
 border-top:1px solid rgba(33,33,33,.2);
 border-bottom:1px solid rgba(33,33,33,.2);
 display:flex;
 justify-content:space-between;
 padding:12px 0;
 font-size:14px;
 font-weight:600;
 align-items:center
}
@media screen and (max-width:420px) {
 .cig-inner .break-total {
  font-size:3.8vw
 }
}
.cig-inner .break-total span,
.link-cig-box {
 font-weight:700
}
.link-cig-box {
 font-size:12px;
 color:#ff5630;
 text-transform:uppercase
}
@media screen and (max-width:420px) {
 .link-cig-box {
  font-size:3.2vw
 }
}
.link-cig-box:after {
 content:"";
 border:solid #ff5630;
 border-width:0 1.5px 1.5px 0;
 display:inline-block;
 padding:2px;
 transform:rotate(-45deg);
 margin-left:3px;
 vertical-align:middle;
 position:relative;
 top:-1px
}
.wrapper-product .filter_mobile_chat_icon,
.wrapper-product .filter_mobile_chat_icon-no-shake_compare {
 bottom:121px
}
.wrapper-product .chat-count {
 bottom:158px
}
.product-container .claim_popup_main {
 top:0;
 bottom:0
}
.product-container .claim_popup_white {
 padding-bottom:10px
}
.product-container .feature_apply_button {
 border:none;
 font-size:14px
}
@media screen and (max-width:420px) {
 .product-container .feature_apply_button {
  font-size:3.8vw
 }
}
.product-container .feature_popup_bottom {
 background:#f4f5f7;
 height:auto;
 position:fixed
}
.wrapper_left_product {
 width:100%
}
.wrapper_left_product .whyChooseProductMod .whyChooseWrapper {
 margin-bottom:12px
}
.relationship_dd {
 width:calc(70% - 10px);
 margin-right:10px
}
.label_child {
 font-size:14px;
 margin:0 0 5px;
 font-weight:500
}
.label_check2 {
 display:flex;
 align-items:center;
 padding-left:13px
}
.check_premium_wrapper {
 top:110px!important;
 height:calc(100% - 110px)!important
}
.check_premium_wrapper .header_container {
 border-radius:8px 8px 0 0
}
.check_premium_wrapper .product-container .editmembersWrapper {
 box-shadow:none!important
}
.check_premium_wrapper #overlay_check {
 position:fixed;
 top:-110px;
 left:0;
 bottom:0;
 right:0;
 height:100vh;
 width:100%;
 margin:0;
 padding:0;
 background:#000;
 opacity:.4;
 filter:alpha(opacity=30);
 -moz-opacity:.4;
 z-index:1
}
.check_premium_wrapper .product-container .rowWrapper {
 z-index:9;
 background:#fff;
 border-radius:8px
}
.check_premium_wrapper .navbarWrapper {
 box-shadow:none!important;
 border-radius:8px
}
.check_premium_wrapper .cart_wrapper_inner {
 height:calc(100vh - 110px)
}
.infinty_box {
 margin:0;
 width:100%;
 display:flex;
 flex-direction:column
}
.infinty_box .infinty_inner {
 width:100%;
 padding:16px 0 0;
 display:flex;
 flex-direction:row;
 color:#253858;
 font-size:12px;
 line-height:20px
}
@media screen and (max-width:420px) {
 .infinty_box .infinty_inner {
  font-size:3.2vw
 }
}
.infinty_box .infinty_inner h3 {
 text-align:left;
 color:#253858;
 font-weight:700;
 font-size:14px;
 padding:0
}
@media screen and (max-width:420px) {
 .infinty_box .infinty_inner h3 {
  font-size:3.8vw
 }
}
.infinty_box .infinty_inner p {
 margin:4px 10px 0 0
}
.infinty_box .infinty_inner a {
 color:#ff5630;
 font-weight:700;
 display:block
}
.infinty_box .infinty_inner .infinty_right {
 width:calc(100% - 45px)
}
.infinty_box .infinty1 {
 margin:0 16px 0 0
}
.infinty_box .infinty1 img {
 width:24px;
 height:24px
}
.modal_head_text {
 font-size:16px;
 font-weight:700
}
@media screen and (max-width:420px) {
 .modal_head_text {
  font-size:4.5vw
 }
}
ul.lisiting-infinty {
 margin:15px 0 0;
 padding:0
}
ul.lisiting-infinty li {
 margin:0;
 padding:0 0 12px 30px;
 list-style:none;
 position:relative;
 font-size:14px;
 line-height:1.64;
 letter-spacing:.2px
}
@media screen and (max-width:420px) {
 ul.lisiting-infinty li {
  font-size:3.8vw
 }
}
ul.lisiting-infinty li:after {
 width:12px;
 height:12px;
 background-color:#00a3bf;
 border-radius:30px;
 content:"";
 position:absolute;
 top:5px;
 left:0
}
ul.lisiting-infinty li:before {
 width:1px;
 height:100%;
 background-color:#00a3bf;
 content:"";
 position:absolute;
 top:7px;
 left:5px
}
ul.lisiting-infinty li:last-child:before {
 display:none
}
.inner_header {
 font-size:20px;
 font-weight:600
}
.inner_header.product_align_centre {
 align-items:center
}
.label-checkbox-rider {
 margin-top:0
}
.label-checkbox-rider label .input-check {
 margin:-2px 0 0
}
.label-checkbox-rider label .amount-smart {
 display:block;
 margin-top:5px
}
.emi_wrapper_header {
 position:absolute!important;
 width:100%;
 top:0!important;
 left:0
}
.cover_si_select {
 height:56px;
 width:100%;
 border:1px solid #b3bac5;
 border-radius:4px;
 display:flex;
 align-items:center;
 font-weight:700;
 margin:16px 0 0;
 position:relative
}
.cover_si_select .sp-right {
 padding-left:12px
}
.cover_si_select:after {
 content:"";
 border:solid #253858;
 border-width:0 1.5px 1.5px 0;
 display:inline-block;
 padding:4px;
 transform:rotate(45deg);
 margin-left:5px;
 vertical-align:middle;
 position:absolute;
 top:20px;
 z-index:1;
 right:14px
}
.arrow_none:after {
 content:none
}
.product-container #overlay {
 background:rgba(23,43,77,.9)!important;
 opacity:1;
 z-index:99
}
.product-container .footer-desk {
 padding:47px 0 110px;
 clear:both
}
.editmembersWrapper .navbarWrapper {
 position:absolute!important;
 width:100%;
 top:0!important;
 left:0
}
.editmembersWrapper .cart_wrapper_inner {
 height:calc(100vh - 65px)
}
.editmembersWrapper .edit_popup_button {
 padding:12px
}
.value_money {
 width:110px;
 height:19px;
 border-radius:10px;
 border:1px solid #00b8d9;
 background-color:#e6fcff;
 text-align:center;
 color:#00a3bf;
 font-weight:700;
 font-size:10px;
 line-height:19px;
 text-transform:uppercase;
 display:inline-block;
 position:absolute;
 right:10px;
 top:18px
}
.in-blk {
 display:inline-block!important
}
.cover_web p {
 display:inline-block
}
.slider-new1 {
 padding:4px 7px!important
}
.editMemberWrapperMobile .edit_profile_error {
 padding:0
}
.text_cover_am {
 font-size:14px;
 margin:10px 0 0
}
@media screen and (max-width:420px) {
 .text_cover_am {
  font-size:3.8vw
 }
}
.text_cover_am span {
 color:#ff5630;
 text-transform:uppercase
}
.valid-year {
 display:inline-block;
 font-size:14px
}
@media screen and (max-width:420px) {
 .valid-year {
  font-size:3.8vw
 }
}
.wrapper_left_product .call-shortly-box {
 background:#253858;
 z-index:9
}
.product-container .monthlyModeBox {
 background:#f4f5f7;
 height:32px;
 display:flex;
 align-items:center;
 justify-content:center;
 font-size:12px;
 color:#505f79;
 bottom:83px;
 width:100%;
 position:fixed;
 box-shadow:0 -3px 6px 0 rgba(0,0,0,.16);
 z-index:9
}
@media screen and (max-width:420px) {
 .product-container .monthlyModeBox {
  font-size:3.2vw
 }
}
.product-container .monthlyModeBox a {
 text-transform:uppercase;
 color:#ff5630
}
.product-container .monthlyModeBox a:hover {
 color:#ff5630
}
.product-container .yearBasis {
 bottom:71px
}
.product-container .feature_popup_bottom,
.product-container .feature_popup_button {
 box-shadow:none
}
.mode_wrapper {
 padding:16px
}
.mode_wrapper h4 {
 font-size:16px;
 font-weight:700;
 line-height:24px;
 margin:0 0 8px
}
@media screen and (max-width:420px) {
 .mode_wrapper h4 {
  font-size:4.5vw
 }
}
.mode_wrapper p {
 margin:0 0 14px;
 padding:0!important;
 color:#505f79;
 font-size:14px;
 line-height:21px
}
@media screen and (max-width:420px) {
 .mode_wrapper p {
  font-size:3.8vw
 }
}
.mode_wrapper .alertModeText {
 color:#de350b;
 font-size:12px;
 margin-bottom:20px
}
@media screen and (max-width:420px) {
 .mode_wrapper .alertModeText {
  font-size:3.2vw
 }
}
.mode_wrapper .modeBreakupBox {
 display:flex;
 width:100%;
 flex-direction:column
}
.mode_wrapper .modeBreakupBox .innerModeBreak {
 display:flex;
 justify-content:space-between;
 margin-bottom:16px;
 font-size:14px;
 flex-direction:row;
 font-weight:600
}
@media screen and (max-width:420px) {
 .mode_wrapper .modeBreakupBox .innerModeBreak {
  font-size:3.8vw
 }
}
.mode_wrapper .modeBreakupBox .innerModeBreak:last-child {
 font-weight:700;
 border-top:1px solid #dfe1e6;
 border-bottom:1px solid #dfe1e6;
 padding:16px 0;
 margin-bottom:20px
}
.mode_wrapper .modeBreakupBox .innerModeBreak span {
 display:block;
 text-align:right;
 font-size:12px;
 color:#505f79
}
@media screen and (max-width:420px) {
 .mode_wrapper .modeBreakupBox .innerModeBreak span {
  font-size:3.2vw
 }
}
.mode_wrapper .modeBreakupBox .innerModeBreak>div:nth-child(2) {
 text-align:right
}
.savePayingBox {
 border-radius:8px;
 width:100%;
 height:52px;
 background:#f2fdff;
 border:1px solid #00a3bf;
 color:#00c7e6;
 display:flex;
 align-items:center;
 font-size:14px;
 justify-content:center;
 line-height:26px
}
@media screen and (max-width:420px) {
 .savePayingBox {
  font-size:3.8vw
 }
}
.savePayingBox .ideaBulb {
 background:url(https://static.pbcdn.in/health-cdn/images/insurer-logo/quotes-logos/mode_icon_pr.svg) no-repeat 0 0;
 padding-left:36px;
 height:30px;
 display:flex;
 align-items:center
}
.link_right_see {
 font-size:12px;
 color:#505f79;
 margin-top:10px
}
@media screen and (max-width:420px) {
 .link_right_see {
  font-size:3.2vw
 }
}
.link_right_see a:hover {
 color:#ff5630
}
.lowerTrade {
 margin:8px 0 0 124px;
 display:flex
}
.lowerTrade .tradeOffLower {
 color:#00b8d9;
 font-size:14px;
 margin:0 16px 0 0
}
.lowerTrade .linkDiffernce {
 color:#ff5630;
 font-size:14px;
 cursor:pointer;
 display:flex;
 flex-flow:row nowrap;
 align-items:center
}
.lowerTrade .linkDiffernce:before {
 width:4px;
 height:4px;
 background-color:#253858;
 border-radius:30px;
 content:"";
 opacity:.5;
 margin-right:16px
}
.SectionGridLower {
 display:flex;
 justify-content:space-between;
 border-top:1px solid #dfe1e6
}
.SectionGridLower .boxGridLower {
 display:flex;
 flex-direction:column;
 text-align:left;
 padding:16px 12px;
 line-height:1.5;
 flex:1 1 33%
}
.SectionGridLower .boxGridLower .heading1 {
 font-weight:700;
 font-size:16px
}
.headerLower {
 background:#fff;
 width:100%
}
.headerLower .boxGridLower {
 padding:16px 0 16px 12px
}
.lisitingLowerData {
 border-bottom:1px solid #dfe1e6
}
.boxLowerScroll {
 margin:0;
 border-top:1px solid #dfe1e6;
 height:57vh;
 overflow:auto
}
.SectionGridInner {
 display:flex;
 justify-content:space-between
}
.SectionGridInner .boxGridLower {
 display:flex;
 flex-direction:column;
 text-align:left;
 line-height:1.5;
 flex:1 1 33%;
 padding:8px 12px 12px
}
.SectionGridInner .boxGridLower .heading1 {
 font-size:16px;
 color:#505f79
}
.LowerAccordionSection {
 position:relative;
 z-index:2
}
.LowerAccordionSection input[type=checkbox] {
 position:absolute;
 opacity:0;
 z-index:-1
}
.LowerAccordionSection label {
 padding:12px 12px 0;
 width:100%;
 display:block;
 font-size:16px;
 color:#253858;
 cursor:pointer;
 position:relative;
 font-weight:700
}
.LowerAccordionSection label:after {
 content:"";
 border:solid #253858;
 border-width:0 .5px .5px 0;
 display:inline-block;
 padding:4px;
 transform:rotate(45deg);
 vertical-align:middle;
 position:absolute;
 right:20px;
 top:70%;
 transition:all .3s ease-in;
 margin-top:-7px;
 transform-origin:center center
}
.LowerAccordionSection .accordionContent {
 max-height:0;
 transition:all .35s;
 opacity:0;
 display:none
}
.LowerAccordionSection input[type=checkbox]:checked+label:after {
 transform:rotate(-135deg);
 margin-top:-2px
}
.LowerAccordionSection input[type=checkbox]:checked~.accordionContent {
 max-height:100%;
 opacity:1;
 display:block;
 padding:4px 12px;
 font-size:14px
}
.boxLowerScroll .lisitingLowerData:last-child {
 border:none
}
.headerLower,
.headerOneLower {
 z-index:9
}
@media only screen and (max-width:1023px) {
 .hideSmall {
  display:none!important
 }
 .slideScreenTop {
  animation:slidescreenTopMob .3s ease-in-out forwards
 }
 @keyframes slidescreenTopMob {
  0% {
   transform:translateY(100%)
  }
  to {
   transform:translateY(0)
  }
 }
 .editMemberWrapperMobile .navbarWrapper {
  position:fixed;
  width:100%
 }
 .modal_mobile {
  bottom:0
 }
 .wrapper_left_product .call-shortly-box {
  background:#253858;
  margin:0 16px;
  left:0
 }
 .info_ped_rider {
  margin-top:4px;
  width:24px
 }
 .premium-box .headbar-break .close-box:hover {
  background:none
 }
 .modeWrap {
  height:97%;
  background:#fff
 }
 .LowerlDataPoints {
  max-height:calc(100vh - 70px)
 }
 .gridLisitingLower .SectionGrid .boxGrid:first-child {
  min-width:135px
 }
 .popHeadingLower {
  margin:0!important
 }
 .lowerTrade {
  margin:12px 0 0;
  flex-flow:column;
  border-top:1px solid #dfe1e6;
  padding:8px 12px 0
 }
 .lowerTrade .tradeOffLower {
  margin:0 0 4px
 }
 .lowerTrade .linkDiffernce:before {
  display:none
 }
 .boxLowerScroll {
  height:calc(100vh - 140px);
  margin-top:114px
 }
 .headerLower {
  position:fixed;
  z-index:9;
  top:57px
 }
 .headerOneLower {
  z-index:9;
  position:fixed!important;
  width:100%
 }
}
@media only screen and (min-width:1024px) {
 .hideBig {
  display:none!important
 }
 .modeWrap {
  height:calc(100% - 24px)!important
 }
 .wrapper-max {
  padding:15px 0!important;
  margin:0 auto!important;
  width:100%
 }
 .text_cover_am span {
  cursor:pointer
 }
 .backtoQuotes_web {
  margin:13px auto 0!important;
  width:100%;
  max-width:1170px;
  padding-left:15px
 }
 .backtoQuotes_web span {
  font-size:14px;
  font-weight:600;
  background:url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAA8AAAANCAYAAAEBGQTXAAAABGdBTUEAALGPC/xhBQAAAPtJREFUKBVj/PL1+38GIGACESDACBNh/sUm3uBgbczAABJRtwr7D6JBGK4EogNJD0wAbhpcYPOuwzA2hAYZtHz9LrihYFtgNiDbBhMD22rsGs9grK+BahSQN6unEuFykF1nL95gaChNRVGI4W5kWbiTQbrru2Yhy0FCByRx5sJ1hsayNBRJRpA3GrrnYDgM5CiMwIN5B0TD/YzNv3AHnd29kAE9+HB6BZffkV0MNxkmCNIEClmQ79ADDaYGRrPAGCBNIF/7uFozgJxIDAA7G6YRpMFYT52gvlm9VWA1KH6GGeLrZkPQySDdKH72dbMFOxmUkkD+buiejdcVAH0B2aflXOLIAAAAAElFTkSuQmCC") no-repeat -1px 3px;
  cursor:pointer;
  padding-left:21px
 }
}
@media only screen and (min-width:1024px) and (max-width:420px) {
 .backtoQuotes_web span {
  font-size:3.8vw
 }
}
@media only screen and (min-width:1024px) {
 .value_money {
  position:inherit;
  margin-left:10px
 }
 .product-container .footer-desk {
  padding:15px 0 24px;
  width:100%
 }
 .product-container .footer-desk p {
  margin-bottom:10px!important
 }
 .multi-year-box {
  display:flex;
  justify-content:space-between;
  width:100%
 }
 .wrapper_left_product {
  width:calc(100% - 390px)
 }
 .wrapper_left_product .whyChooseProductMod .whyChooseWrapper {
  margin-top:0;
  padding-left:16px;
  padding-right:16px;
  border-radius:4px;
  margin-bottom:12px
 }
 .wrapper_left_product .whyChooseProductMod .whyChooseWrapper .widgetHead {
  font-size:18px
 }
 .wrapper_left_product .fullscreen_popup_right_col .whyChooseWrapper {
  padding-left:32px;
  padding-right:0
 }
 .wrapper-inner {
  border-radius:4px
 }
 .plan-name h2 {
  font-size:18px
 }
 .plan-name span {
  margin:0 36px 0 0;
  cursor:pointer;
  font-weight:500
 }
 .plan-name span:after {
  content:none
 }
 .pills-button {
  width:auto!important;
  padding:0 26px!important;
  cursor:pointer
 }
 .pills-select {
  width:85px!important;
  padding-left:22px!important
 }
 .multi_box_inner {
  width:225px;
  flex-direction:row-reverse
 }
 .multi_box_inner .multi-first {
  font-size:14px;
  padding-left:9px;
  width:170px
 }
}
@media only screen and (min-width:1024px) and (max-width:420px) {
 .multi_box_inner .multi-first {
  font-size:3.8vw
 }
}
@media only screen and (min-width:1024px) {
 .multi_box_inner .multi-first span.amount-green {
  font-size:14px
 }
}
@media only screen and (min-width:1024px) and (max-width:420px) {
 .multi_box_inner .multi-first span.amount-green {
  font-size:3.8vw
 }
}
@media only screen and (min-width:1024px) {
 .emi_box .link {
  display:inline-block;
  padding-left:8px;
  cursor:pointer
 }
 .emi_box .info_icon2 {
  margin-top:4px
 }
 .members-section {
  font-size:16px
 }
}
@media only screen and (min-width:1024px) and (max-width:420px) {
 .members-section {
  font-size:4.5vw
 }
}
@media only screen and (min-width:1024px) {
 .members-section:after {
  content:none
 }
 .members-section .edit-member-web {
  position:absolute;
  right:-120px;
  color:#ff5630;
  font-weight:600;
  text-transform:uppercase;
  cursor:pointer;
  font-size:14px;
  top:0
 }
}
@media only screen and (min-width:1024px) and (max-width:420px) {
 .members-section .edit-member-web {
  font-size:3.8vw
 }
}
@media only screen and (min-width:1024px) {
 .wrapper_right_product {
  width:370px;
  margin-left:18px;
  position:relative;
  z-index:1
 }
 .wrapper_right_product .inner_right_section {
  width:100%;
  border-radius:4px;
  box-shadow:0 3px 6px 0 rgba(0,0,0,.16);
  background-color:#fff;
  height:auto;
  padding:8px 0 0;
  position:sticky;
  position:-webkit-sticky;
  top:74px
 }
 .wrapper_right_product .inner_right_section h3 {
  font-weight:700;
  font-size:18px;
  border-bottom:1px solid #b3bac5;
  padding-bottom:7px;
  padding-left:16px
 }
 .wrapper_right_product .inner_right_section .section_right {
  justify-content:space-between;
  font-size:14px;
  padding:10px 0 0
 }
}
@media only screen and (min-width:1024px) and (max-width:420px) {
 .wrapper_right_product .inner_right_section .section_right {
  font-size:3.8vw
 }
}
@media only screen and (min-width:1024px) {
 .wrapper_right_product .inner_right_section .section_right>div:first-child {
  width:calc(100% - 90px)
 }
 .wrapper_right_product .inner_right_section .section_right span {
  font-weight:700
 }
 .wrapper_right_product .port_section {
  margin:16px 0 0;
  padding:0
 }
 .wrapper_right_product .port_section h3 {
  font-size:16px;
  font-weight:700;
  border-bottom:none;
  padding:0
 }
}
@media only screen and (min-width:1024px) and (max-width:420px) {
 .wrapper_right_product .port_section h3 {
  font-size:4.5vw
 }
}
@media only screen and (min-width:1024px) {
 .wrapper_right_product .port_section .label-checkbox {
  margin-top:0
 }
 .wrapper_right_product .port_section .label-radiobox {
  margin-top:6px
 }
 .info_icon_port {
  background:url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAAAAXNSR0IArs4c6QAAAoRJREFUOBFjZMABKttmhDAwMBrzcHM6/fr1RwOkjI2N5caXr9/3/WdkPNNRmbYWm1ZGdMGGhqk8LPy8B7U1FWUE+XjEJMWFGSTFRcDKnr98w/D85VuG9x+/vLp+88HD1//Y7fuLwr4jm4FiYEX7bCc2JqbtcWHubMoK0sjqMNi37z1hWLRm5+//v/+4tNZkHMJQ0Dttld+cZVs+/CcRzF665UNl2yx7FANB3qzrnPuTRLPgyms6Zv9uaJjPATKUCUSAwgzkTRAbHbz/+Jlhytx1DN3TloPDD10exI8LdWdhFWABe5sZFJuGuqpRViY63NgUHzt9heHy9XsMP37+YpCVEgNGkDCGMmFBfobX7z+wqWra3gG6kNFYkJ9XFEMVVEBLTYFBQkyIQYCPh0FRXhKXMgYhPl7R/4z/jFlA6QybrTCdILnc5GAYFyctJSHCwMPN4cL0+9cfTVg6w6X63qPnDNduPcAlDRaXBBr46/dvLRa8qqCSc5duYeBgZ2PQKlIgqJyJlY3lOigHEAKgSMEHnr14A8yarNeYQHkTlJ0oBc+BBn758mMPEyijv//05RWlBgLNeM34/+9pJlCpcf3Gg4egvEkuuHn3EcPN2w/vAvP0RnBOAZUaoIyOz0B2dlac0otX7/p7n+ObHYqC6pYZdnOAGR2eQZEYdx8++3/15n0kEQQTVDhUt8y0gRmGUnyBSg1mJsY9oLypqiQLU4OVBnkT5DKGv/8cWmvSj8AUoRgIEgSVGqCMrqkmpyAIzE6gHABKtCAAShqg2Hz/+cvrm7ce3gV5c1Z6OkpQYRgI1gkkqltmBQJTALAK4HAB5QCQOCidgZIG43+G0601qRthapFpAG+FhtdAN6SfAAAAAElFTkSuQmCC") no-repeat 0 0;
  width:20px;
  height:20px;
  text-indent:-999999px;
  position:absolute;
  right:0;
  top:0
 }
 .rider_head {
  margin-top:12px
 }
 .rider_head h4 {
  font-weight:700;
  font-size:14px;
  display:inline-block
 }
}
@media only screen and (min-width:1024px) and (max-width:420px) {
 .rider_head h4 {
  font-size:3.8vw
 }
}
@media only screen and (min-width:1024px) {
 .rider_head .section_right {
  padding:5px 0 0!important
 }
 .rider_head .valid-year {
  display:inline-block;
  font-size:14px
 }
}
@media only screen and (min-width:1024px) and (max-width:420px) {
 .rider_head .valid-year {
  font-size:3.8vw
 }
}
@media only screen and (min-width:1024px) {
 .select_benefits {
  border:1px dashed #b3bac5;
  height:48px;
  align-items:center;
  padding:0 16px!important;
  border-radius:4px;
  justify-content:space-between;
  font-size:14px;
  color:#505f79;
  margin-top:6px
 }
}
@media only screen and (min-width:1024px) and (max-width:420px) {
 .select_benefits {
  font-size:3.8vw
 }
}
@media only screen and (min-width:1024px) {
 .select_benefits .link_select {
  color:#ff5630;
  font-weight:700;
  cursor:pointer
 }
 .premium_right {
  background:#fff;
  border-radius:0 0 4px 4px;
  margin-top:0;
  padding:16px
 }
 .premium_right .section_premium {
  justify-content:space-between;
  font-size:16px;
  font-weight:700;
  background:#f4f5f7;
  margin-left:-16px;
  margin-right:-16px;
  padding:8px 16px;
  border-bottom:1px solid #dfe1e6
 }
}
@media only screen and (min-width:1024px) and (max-width:420px) {
 .premium_right .section_premium {
  font-size:4.5vw
 }
}
@media only screen and (min-width:1024px) {
 .premium_right button {
  display:inline-block;
  width:100%;
  height:48px;
  background:#ff5630;
  color:#fff;
  font-size:14px;
  font-weight:500;
  text-transform:uppercase;
  border-radius:4px;
  text-align:center;
  line-height:48px;
  padding:0;
  outline:none;
  border:none;
  margin:16px 0 0;
  cursor:pointer
 }
 .premium_right button.added_to_cart {
  border:1px solid #253858;
  color:#253858!important;
  background:#fff
 }
 .premium_right .rightWebNext {
  font-size:16px;
  font-weight:700;
  margin-top:16px
 }
}
@media only screen and (min-width:1024px) and (max-width:420px) {
 .premium_right .rightWebNext {
  font-size:4.5vw
 }
}
@media only screen and (min-width:1024px) {
 .premium_right .rightWebNext .nextStepRelation {
  display:block;
  color:#253858;
  font-size:12px;
  font-weight:400
 }
}
@media only screen and (min-width:1024px) and (max-width:420px) {
 .premium_right .rightWebNext .nextStepRelation {
  font-size:3.2vw
 }
}
@media only screen and (min-width:1024px) {
 .cover_si_select {
  width:328px
 }
 .policy-period {
  margin:15px 0 0;
  display:flex
 }
 .policy-period .policy_period_inner {
  margin:0 20px 15px 0;
  cursor:pointer;
  align-items:flex-start;
  justify-content:left;
  flex-direction:column;
  height:auto;
  padding:11px 10px
 }
 .policy-period .policy_period_inner .text_right {
  text-align:left;
  margin-left:33px
 }
 .policy-period .policy_period_inner .input-radio {
  margin:-3px 14px 0 0!important
 }
 .policy-period .policy-period-one {
  justify-content:space-between;
  flex-direction:row;
  padding:20px 10px;
  margin-right:0
 }
 .addon-main {
  padding:6px 0;
  justify-content:left;
  min-height:80px;
  display:flex;
  align-items:center;
  flex-wrap:wrap
 }
 .addon-box1 {
  align-items:center;
  width:50%
 }
 .addon-box1.align-center {
  margin-top:-5px;
  float:right
 }
 .deductible-box {
  width:100%
 }
 .addon-box1 .logo_add {
  min-width:100px;
  margin-right:14px
 }
 .addon-box1 h3 {
  line-height:22px;
  font-size:16px!important;
  -webkit-line-clamp:inherit;
  max-height:100%
 }
 .save_smart {
  flex-direction:column;
  display:flex;
  font-size:18px;
  font-weight:600
 }
 .save_smart .save {
  font-size:12px;
  color:#505f79;
  font-weight:600
 }
}
@media only screen and (min-width:1024px) and (max-width:420px) {
 .save_smart .save {
  font-size:3.2vw
 }
}
@media only screen and (min-width:1024px) {
 .save_smart .save_amount {
  margin-top:0!important
 }
 .rider-box {
  margin:12px 0 0
 }
 .rider-box button {
  margin-top:0;
  cursor:pointer
 }
 .sp-rider {
  align-items:center
 }
 .heading_section {
  position:relative
 }
 .cover_web #overlay {
  display:none
 }
 .cover_web .premium-box {
  width:328px;
  max-height:250px;
  box-shadow:0 4px 6px 0 rgba(0,0,0,.16);
  background-color:#fff;
  position:absolute;
  top:50px;
  left:0;
  border-radius:0 0 5px 5px;
  z-index:9;
  border:1px solid #b3bac5;
  border-top:none;
  padding:0;
  overflow:auto;
  transform:none
 }
 .cover_web .premium-box .headbar-break {
  display:none
 }
 #wrapper-product>.rowWrapper {
  display:flex
 }
 .chat_icon_web {
  width:90px;
  height:80px;
  background:url(https://static.pbcdn.in/health-cdn/images/images/product-img/product_chat_icon.png) no-repeat 0 0;
  text-indent:-99999px;
  display:block;
  bottom:-100px;
  z-index:9999
 }
 .chat_icon_web,
 .chat_with_us {
  position:absolute;
  right:0;
  cursor:pointer
 }
 .chat_with_us {
  width:148px;
  height:48px;
  border-radius:30px;
  box-shadow:0 8px 10px 0 rgba(0,0,0,.15);
  background:#50b47e url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB0AAAAWCAYAAAA8VJfMAAAAAXNSR0IArs4c6QAAADhlWElmTU0AKgAAAAgAAYdpAAQAAAABAAAAGgAAAAAAAqACAAQAAAABAAAAHaADAAQAAAABAAAAFgAAAACKYwV6AAACT0lEQVRIDWNgIBP8///fAIjvAzGx4D1QYQKZ1kG0AQ04QKxtyOpAullgNptubTBg/P9Pn+E/gwJMDB8959YBe5g8DysHg5GwAoManwRMCCcNdIADI0jWbHNdA5Cql+UW+iLCzssDEiMVnH/3kMFeQoOhVj+QgRfoCDzAkcFkS22B3bbm32fe3EMOBZLZT7+9/x99cOr/3ivbCOl1YOJiYs0s1fFmMRZWxOM4wlJSnAIMhdqeDCvvnyComOnH3z9qklwCBBUSowDm8LNv7+NVzoRXljaSH+ht6UNGRsYLNLH0x9/fd9EC6SKQvxCIHUDiNLG04NTiFKDZiSALoKAA6MMEIH4A4tPEUpDBQAsWAClki0HCYAAvkWAC1KRBFgMz7QWgmQ+QzaWppSCLgBaDLEUBTGxMLC+//P6BIkgu59n3D2Ctf/6wYFiEbCYwThn3Lb57lCq2rrh3nIGNifn6hcAGiO3INiGxWb78+pt14+Mzh4iDU4QD5EzYQDUFqMZABp+BIXH70wtkIRT2c6AP9z2/+vv4qzu//zAyRKFIYuEwgsQM1jcIsLH8K+BgZokEFYsnfRrhSm8BLSs6ueTXt78/H7MwMn+BS6AxPvz+fuE3C1PDBc+GB2hS+Lkmm2scgNUcvJa4+fH5f4dtrX9stjYvw6+TNFmU1MvIxPKB4d8/BlBwgoIs5cicXz/+/V5+2rcpgTRj8asGBy+yEuutjc/4WDkF3/78wvGfgWEi0MICZHlqsFF8CjLw66//Wj//f05gZGI+cNq7AW/SJ9cBALWsjBeuexRVAAAAAElFTkSuQmCC") no-repeat 10px 15px;
  bottom:0;
  display:flex;
  align-items:center;
  font-weight:700;
  color:#fff;
  padding-left:47px;
  font-size:14px
 }
 .heading_section h3 {
  font-size:18px
 }
 .term_web {
  height:auto
 }
 .term_web_scroll {
  height:67vh
 }
 .term_wrapper {
  margin-bottom:0;
  max-height:inherit;
  overflow:visible
 }
 .term_wrapper ul.term_listing {
  margin:0
 }
 .term_wrapper ul.term_listing li label {
  border-bottom:none;
  padding:12px
 }
 .term_wrapper ul.term_listing li label .checkmark {
  display:none
 }
 .addon-box1 .popularadd-on {
  right:241px
 }
 .term_wrapper ul.term_listing li label.active,
 .term_wrapper ul.term_listing li label:hover {
  background:#f4f5f7
 }
 .scroll_right_box {
  max-height:357px;
  overflow-y:scroll;
  padding:0 16px
 }
 .chat-web-product {
  position:fixed;
  bottom:0;
  margin-bottom:0!important;
  right:18px;
  width:336px!important;
  z-index:99999999
 }
 .chat-web-product.full_chat_container {
  height:70%
 }
 .cover_web .premium-box::-webkit-scrollbar,
 .scroll_right_box::-webkit-scrollbar,
 .term_wrapper::-webkit-scrollbar {
  width:6px
 }
 .cover_web .premium-box::-webkit-scrollbar-track,
 .scroll_right_box::-webkit-scrollbar-track,
 .term_wrapper::-webkit-scrollbar-track {
  background:#f1f1f1
 }
 .cover_web .premium-box::-webkit-scrollbar-thumb,
 .scroll_right_box::-webkit-scrollbar-thumb,
 .term_wrapper::-webkit-scrollbar-thumb {
  background:#b3bac5
 }
 .scroll_space {
  padding:0 16px
 }
 .premium-box {
  max-width:328px;
  height:auto;
  left:50%;
  top:50%;
  transform:translate(-50%,-50%);
  bottom:auto;
  border-radius:10px;
  box-shadow:0 2px 4px 0 rgba(0,0,0,.16);
  padding:16px
 }
 .premium-box .headbar-break .close-box {
  cursor:pointer
 }
 .slideScreenTop {
  position:fixed!important;
  height:100%!important;
  background:#fff!important;
  z-index:9999!important;
  top:0!important;
  max-width:450px!important;
  right:0!important;
  animation:slidescreenTopDesktop .3s ease-in-out forwards
 }
 @keyframes slidescreenTopDesktop {
  0% {
   transform:translateX(100%)
  }
  to {
   transform:translateX(0)
  }
 }
 .emi-wrap {
  height:calc(100vh - 30px)!important
 }
 .debit_card_box {
  padding:20px 16px 0
 }
 .close_cart {
  cursor:pointer
 }
 .emi-inner p {
  padding:16px 16px 0
 }
 #overlay-emi {
  position:fixed;
  top:0;
  left:0;
  bottom:0;
  right:0;
  height:100%;
  width:100%;
  margin:0;
  padding:0;
  background:rgba(23,43,77,.9);
  z-index:100;
  animation:overlayEmiMask .3s ease-out forwards
 }
 @keyframes overlayEmiMask {
  0% {
   opacity:0
  }
 }
 .wrapper-inner-similar {
  padding:16px 0;
  background:none
 }
 .wrapper-inner-similar .heading_section {
  margin:20px 0 16px
 }
 .wrapper-inner-similar .heading_section h3 {
  font-size:24px;
  font-weight:700;
  padding-right:0
 }
 .wrapper-inner-similar .slider-new1 .similar_plan_ul1 button {
  width:232px
 }
 .wrapper-inner-similar .slider-new1>div {
  width:32.5%
 }
 .wrapper-inner-similar .slider-new1 {
  overflow:unset!important
 }
 .term_wrapper::-webkit-scrollbar {
  display:block
 }
 .width-full {
  width:100%
 }
 .editmembersWrapper .cart_wrapper_inner {
  height:calc(100vh - 100px)
 }
 .chat-box-shake2_product {
  animation:shakeanim 1s cubic-bezier(.36,.07,.19,.97) both;
  transform:translateZ(0);
  backface-visibility:hidden;
  perspective:1000px;
  animation-iteration-count:infinite
 }
 .chat-count-product {
  background:#ff5630;
  border-radius:30px;
  width:19px;
  height:21px;
  color:#fff;
  font-size:11px;
  position:absolute;
  right:-1px;
  bottom:34px;
  line-height:21px;
  z-index:10;
  text-align:center
 }
 @keyframes shakeanim {
  10%,
  90% {
   transform:translate3d(-1px,0,0)
  }
  20%,
  80% {
   transform:translate3d(2px,0,0)
  }
  30%,
  50%,
  70% {
   transform:translate3d(-4px,0,0)
  }
  40%,
  60% {
   transform:translate3d(4px,0,0)
  }
 }
 .pay_web {
  text-align:right;
  font-size:12px;
  margin:5px 0 0
 }
 .pay_web span {
  display:inline-block;
  color:#ff5630;
  text-transform:uppercase;
  font-weight:600;
  cursor:pointer
 }
 .slider-new1 {
  padding:0
 }
 .product-container .feature_popup_bottom {
  background:#fff;
  position:relative;
  height:76px
 }
 .editmembersWrapper .feature_popup_bottom {
  height:auto
 }
 .call_me_now_footer {
  width:100%;
  border-bottom:1px solid #dfe1e6;
  font-weight:700;
  font-size:18px;
  color:#253858;
  height:70px;
  display:flex;
  align-items:center;
  justify-content:center;
  margin-bottom:25px;
  padding-bottom:14px
 }
 .call_me_now_footer .button {
  width:147px;
  height:48px;
  color:#ff5630;
  font-size:14px;
  border-radius:4px;
  border:1px solid #ff5630;
  background-color:#fff;
  font-weight:600;
  display:flex;
  align-items:center;
  margin:0 0 0 35px;
  cursor:pointer
 }
 .infinty_box {
  flex-direction:row
 }
 .infinty_box .infinty_inner {
  width:50%
 }
 .navbar-end .call_me_now_footer {
  width:auto;
  border-bottom:0 solid #dfe1e6;
  height:auto;
  display:flex;
  align-items:center;
  justify-content:center;
  margin-bottom:0;
  padding-bottom:0
 }
 .navbar-end .call_me_now_footer .button {
  width:119px;
  height:32px;
  line-height:36px
 }
 .wrapper-inner-similar .slider-new1 {
  padding:4px 0!important
 }
 .addon-box1 .name-addon .heading-span {
  font-size:14px;
  line-height:22px;
  max-height:100%;
  margin-bottom:5px;
  text-overflow:inherit;
  display:block;
  margin-top:4px
 }
 .addon-box1 .name-addon {
  width:calc(100% - 70px)
 }
 .addon-box1 .si_add .wid-70 {
  width:80%
 }
 .addon-box1 .si_add {
  margin-right:13px
 }
 .wrapper_left_product .byop_popup_checkPremium {
  top:5%
 }
 .discount_heading {
  width:450px
 }
 .discount_save {
  width:300px
 }
 .rider-box .button-premium {
  width:135px
 }
 .members-section {
  margin-right:120px
 }
 .buttonContainerCart button {
  cursor:pointer
 }
}
.productPageChatIcon {
 position:fixed;
 right:20px;
 bottom:20px;
 z-index:98
}
.productPageChatIcon .chat_icon_web {
 position:static
}
.dis-i-b {
 display:inline-block
}
.mb-16 {
 margin-bottom:16px
}
.loader_btn.blockBtn {
 position:static!important;
 left:inherit!important;
 top:inherit!important;
 right:inherit!important;
 bottom:inherit!important;
 background-color:#ff5630;
 border-radius:4px!important;
 pointer-events:none;
 cursor:default
}
.loader_btn.center-loader:before {
 right:inherit
}
.loader_btn.center-loader:before,
.loader_btn:before {
 left:50%!important;
 top:50%!important;
 margin:-14px 0 0 -14px
}
.loader_btn.blockBtn.productUpdateMember {
 position:absolute!important;
 left:0!important;
 top:0!important;
 right:0!important;
 bottom:0!important;
 background-color:#ff5630!important;
 border-radius:8px!important
}
.lowerPremiumPlan .heading-span {
 color:#505f79;
 margin-top:2px
}
.lowerPremiumPlan .button_rider_apply {
 width:108px
}
.lowerPremiumPlan .addon-box1 {
 width:55%
}
.lowerPremiumPlan .addon-box1.align-center {
 justify-content:space-between;
 width:45%
}
.lowerPremiumPlan .addon-box1 .name-addon,
.lowerPremiumPlan .addon-box1 .si_add {
 width:auto
}
@media screen and (max-width:1023px) {
 .lowerPremiumPlan .heading-span {
  color:#505f79;
  margin-top:2px
 }
 .lowerPremiumPlan .button_rider_apply {
  width:108px
 }
 .lowerPremiumPlan .addon-box1 {
  width:100%;
  align-items:center
 }
 .lowerPremiumPlan .addon-box1.align-center {
  justify-content:space-between;
  width:100%
 }
 .lowerPremiumPlan .addon-box1 .name-addon,
 .lowerPremiumPlan .addon-box1 .si_add {
  width:auto
 }
}
.starPartnerStrip {
 background:#e6fcff;
 font-size:12px;
 font-weight:600;
 color:#00a3bf;
 cursor:pointer;
 text-align:center;
 width:110%;
 margin:0 -16px;
 position:relative;
 bottom:-16px;
 padding:4px 16px
}
@media screen and (max-width:420px) {
 .starPartnerStrip {
  font-size:3.2vw
 }
}
.starPartnerStrip img {
 vertical-align:middle;
 width:18px;
 margin-right:8px
}
@media screen and (min-width:320px) and (max-width:767px) and (orientation:landscape) {
 .modeWrap {
  height:93%
 }
}
@media only screen and (max-width:1023px) {
 .dailyAllowanceRider {
  flex-direction:column
 }
}
.dailyAllowanceRider>div:first-child {
 width:65%
}
@media only screen and (max-width:1023px) {
 .dailyAllowanceRider>div:first-child {
  width:100%
 }
}
.dailyAllowanceRider>div:nth-child(2n) {
 width:35%;
 display:flex;
 align-items:center;
 justify-content:flex-end
}
@media only screen and (max-width:1023px) {
 .dailyAllowanceRider>div:nth-child(2n) {
  width:100%;
  justify-content:space-between;
  margin-top:8px
 }
}
@media only screen and (max-width:1023px) {
 .dailyAllowanceRider .addon-box1 {
  width:unset;
  padding:0
 }
}
@media only screen and (min-width:1024px) {
 .dailyAllowanceRider .addon-box1 {
  width:165px
 }
}
@media only screen and (min-width:1024px) {
 .coPayRider>div:first-child {
  width:357px
 }
 .coPayRider>div:nth-child(2) {
  width:calc(100% - 357px);
  justify-content:space-between
 }
}
@media only screen and (max-width:1023px) {
 .roomRentRider {
  flex-direction:column
 }
}
.roomRentRider>div:first-child {
 width:50%
}
@media only screen and (max-width:1023px) {
 .roomRentRider>div:first-child {
  width:100%
 }
}
.roomRentRider>div:nth-child(2n) {
 width:50%;
 display:flex;
 align-items:center;
 justify-content:flex-end
}
@media only screen and (max-width:1023px) {
 .roomRentRider>div:nth-child(2n) {
  width:100%;
  justify-content:space-between;
  margin-top:8px
 }
}
@media only screen and (max-width:1023px) {
 .roomRentRider .addon-box1 {
  width:unset;
  padding:0
 }
}
@media only screen and (min-width:1024px) {
 .roomRentRider .addon-box1 {
  width:220px
 }
 .roomRentRider .addon-box1 .si_add {
  width:183px
 }
 .roomRentRider .addon-box1 .si_add .div_select_add {
  width:90%
 }
}
.skeleton_wrapper .bg {
 background-image:linear-gradient(90deg,#f4f4f4,hsla(0,0%,89.8%,.8) 40px,#f4f4f4 80px);
 width:100%;
 animation:shine-lines 2s ease-out infinite;
 border:none!important;
 color:transparent!important;
 text-indent:-9999px
}
.skeleton_wrapper .bg .arrow-back {
 background:none
}
.skeleton_wrapper p.bg {
 margin-bottom:5px;
 width:80%
}
.skeleton_wrapper .plan-name {
 width:80%
}
.skeleton_wrapper span.bg:after {
 content:none
}
.skeleton_wrapper .logo-detais {
 width:30%;
 height:62px
}
.skeleton_wrapper .multi_box_inner {
 border:1px solid #ececec
}
.skeleton_wrapper .tabs-box ul .is-active {
 border-bottom:1px solid #ececec
}
.skeleton_wrapper .multi_box_inner {
 border:0 solid #b3bac5;
 padding:0;
 margin:0
}
.skeleton_wrapper .pills-box {
 margin:10px 0 0
}
.skeleton_wrapper .pills-box .pills-button {
 height:56px;
 width:100%;
 border-radius:4px;
 padding:0;
 margin:0
}
.emi_box_skeleton {
 width:100%;
 display:flex;
 flex-direction:column
}
.emi_box_skeleton span {
 margin:15px 0 0;
 height:36px
}
@keyframes shine-lines {
 0% {
  background-position:-100px
 }
 40%,
 to {
  background-position:95%
 }
}
@media only screen and (min-width:1024px) {
 .skeleton_wrapper .pills-box .pills-button {
  width:300px!important;
  justify-content:space-between;
  margin:0 5px
 }
 .skeleton_wrapper .web_box {
  flex-direction:row;
  display:flex
 }
 .skeleton_wrapper .inner_right_section {
  height:auto!important;
  padding:16px 16px 0!important
 }
 .skeleton_wrapper .inner_right_section h3 {
  border-bottom:0 solid #b3bac5
 }
 .skeleton_wrapper .section_right {
  margin-top:20px
 }
 .skeleton_wrapper .premium_right {
  margin-left:-16px;
  margin-right:-16px;
  background:#dcddde
 }
 .skeleton_wrapper button {
  background-color:#ccc!important
 }
 .skeleton_wrapper .section_premium {
  margin-left:0;
  margin-right:0
 }
}
a {
 font-weight:600
}
a,
a:hover {
 color:#ff5630
}
.btn {
 width:100%;
 height:48px;
 -webkit-appearance:none;
 background:#ff5630;
 color:#fff;
 font-size:16px;
 font-weight:600;
 text-transform:uppercase;
 border:none;
 box-shadow:none;
 border-radius:4px;
 font-family:-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Oxygen-Sans,Ubuntu,Cantarell,Helvetica Neue,sans-serif;
 margin-top:32px;
 outline:none
}
.btmCta {
 position:fixed;
 width:100%;
 left:0;
 bottom:0;
 background:#fff;
 padding:8px 16px;
 box-shadow:0 -2px 4px rgba(0,0,0,.16);
 z-index:99
}
.btmCta .btn {
 margin-top:0
}
.header {
 box-shadow:0 2px 4px rgba(0,0,0,.16);
 padding:8px 16px;
 margin-bottom:24px;
 position:sticky;
 top:0;
 background:#fff;
 z-index:99
}
.header .back {
 width:24px;
 height:24px;
 position:relative
}
.header .back:before {
 border:solid #253858;
 border-width:0 2px 2px 0;
 display:inline-block;
 padding:5px;
 transform:rotate(135deg);
 margin-top:-6px
}
.header .back:after,
.header .back:before {
 content:"";
 position:absolute;
 left:5px;
 top:50%
}
.header .back:after {
 height:2px;
 width:15px;
 background:#253858;
 margin-top:-1px
}
.header .pageTitle {
 font-size:20px;
 color:#253858;
 font-weight:600;
 margin-left:12px
}
@media screen and (max-width:420px) {
 .header .pageTitle {
  font-size:5.6vw
 }
}
.callIconProposal {
 width:32px;
 height:32px;
 background:url(https://static.pbcdn.in/health-cdn/images/images/call-icon.svg) no-repeat 0 0;
 margin-left:auto;
 filter:none
}
.stepper {
 padding:0 16px;
 margin-bottom:34px
}
.stepper ul {
 display:flex;
 align-items:center;
 counter-reset:stepCount;
 width:100%
}
.stepper ul li {
 counter-increment:stepCount;
 font-size:12px;
 flex:1 1 auto;
 text-align:center;
 font-weight:600;
 color:#b3bac5;
 position:relative
}
@media screen and (max-width:420px) {
 .stepper ul li {
  font-size:3.2vw
 }
}
.stepper ul li:before {
 content:counter(stepCount);
 width:18px;
 height:18px;
 border:1px solid #b3bac5;
 border-radius:50%;
 background:#fff;
 display:block;
 font-size:10px;
 color:#b3bac5;
 font-weight:700;
 text-align:center;
 line-height:16px;
 margin:0 auto 2px;
 position:relative;
 z-index:3;
 outline:4px solid #fff
}
@media screen and (max-width:420px) {
 .stepper ul li:before {
  font-size:2.8vw
 }
}
.stepper ul li:after {
 content:"";
 position:absolute;
 width:100%;
 height:1px;
 background:#b3bac5;
 left:50%;
 top:9px
}
.stepper ul li:last-child:after {
 content:none
}
.stepper ul li.current {
 color:#253858
}
.stepper ul li.current:before {
 animation:currentStep .3s ease-in 1.1s forwards
}
@keyframes currentStep {
 0% {
  transform:scale(1);
  border-color:#b3bac5;
  background:#fff;
  color:#b3bac5
 }
 to {
  transform:scale(1.2);
  border-color:#36b37e;
  background:#36b37e;
  color:#fff
 }
}
.stepper ul li.current.click:before {
 animation-delay:0s
}
.stepper ul li.completed:before {
 animation:completedStep .3s ease-in forwards;
 border-color:#36b37e;
 background:#36b37e;
 color:#fff;
 content:""
}
@keyframes completedStep {
 0% {
  transform:scale(1.5)
 }
 to {
  transform:scale(1)
 }
}
.stepper ul li.completed span:before {
 content:"";
 position:absolute;
 width:10px;
 height:5px;
 border:solid #fff;
 border-width:0 0 2px 2px;
 transform:rotate(-45deg);
 top:5px;
 left:50%;
 z-index:3;
 margin-left:-5px;
 animation:completedStepTick .3s ease-in forwards
}
@keyframes completedStepTick {
 0% {
  transform:scale(1.5) rotate(-45deg)
 }
 to {
  transform:scale(1) rotate(-45deg)
 }
}
.stepper ul li.completed span:after {
 content:"";
 position:absolute;
 width:100%;
 height:1px;
 background:#36b37e;
 left:50%;
 top:9px;
 z-index:2;
 animation:lineFill 1s ease-in forwards
}
@keyframes lineFill {
 0% {
  width:0
 }
 to {
  width:100%
 }
}
@media only screen and (max-width:1023px) {
 .stepper {
  padding:5px 0 0;
  align-items:center;
  margin:20px 0;
  overflow:hidden;
  overflow-x:auto;
  white-space:nowrap;
  display:flex;
  height:40px;
  width:auto
 }
 .stepper::-webkit-scrollbar {
  display:none
 }
 .stepper ul li {
  padding:0 20px
 }
}
@media screen and (min-width:600px) and (max-width:1023px) and (orientation:landscape) {
 .stepper {
  justify-content:space-around
 }
}
.containerAnim,
.greatChoice {
 position:fixed;
 z-index:9
}
.greatChoice {
 background:#fff;
 border-radius:40px;
 box-shadow:0 0 30px 0 rgba(0,0,0,.16);
 bottom:100px;
 height:80px;
 width:calc(100% - 32px);
 display:flex;
 align-items:center;
 justify-content:center;
 margin:0 16px;
 font-size:18px;
 color:#253858;
 font-weight:700
}
@media screen and (max-width:420px) {
 .greatChoice {
  font-size:5.1vw
 }
}
.greatChoice .likeAnim.tilt {
 transform:rotate(-45deg) scale(1)
}
.greatChoice .likeAnim {
 display:flex;
 margin:-15px 20px -15px 0;
 animation:animateHand 2.5s ease-out;
 transform:scale(1.3)
}
.greatChoice .greatText.faded {
 opacity:0
}
.greatChoice .greatText {
 transform:translate(1%);
 animation:animateGreatText 2.5s ease-out
}
.greatChoice .greatText span {
 font-size:14px;
 display:block;
 font-weight:400
}
@media screen and (max-width:420px) {
 .greatChoice .greatText span {
  font-size:3.8vw
 }
}
.greatChoice.hideButton {
 animation:hideButton .5s ease-out 1s
}
@keyframes hideButton {
 to {
  transform:translateY(35%);
  opacity:0
 }
}
@keyframes animateGreatText {
 1% {
  transform:translate(45%)
 }
 20% {
  transform:translate(-7%)
 }
 80% {
  transform:translate(-7%)
 }
 to {
  opacity:1;
  transform:translate(1%)
 }
}
@keyframes animateHand {
 1% {
  transform:rotate(-45deg) scale(1)
 }
 20% {
  transform:rotate(0)
 }
 80% {
  transform:scale(1)
 }
 to {
  transform:scale(1.3)
 }
}
.animBlock {
 position:fixed;
 bottom:65px;
 width:calc(100vw - 32px);
 height:300px;
 margin:0 16px;
 overflow:hidden;
 left:16px
}
[class|=confetti] {
 position:absolute
}
.confettiRibbon1.confettiRibbon1 {
 background-image:url(https://static.pbcdn.in/health-cdn/images/images/anim1.svg)
}
.confettiRibbon1.confettiRibbon1,
.confettiRibbon2.confettiRibbon2 {
 width:18px;
 height:28px;
 background-repeat:no-repeat;
 background-color:transparent
}
.confettiRibbon2.confettiRibbon2 {
 background-image:url(https://static.pbcdn.in/health-cdn/images/images/anim2.svg)
}
.confettiRibbon3.confettiRibbon3 {
 background-image:url(https://static.pbcdn.in/health-cdn/images/images/anim3.svg)
}
.confettiRibbon3.confettiRibbon3,
.confettiStar.confettiStar {
 width:18px;
 height:28px;
 background-repeat:no-repeat;
 background-color:transparent
}
.confettiStar.confettiStar {
 background-image:url(https://static.pbcdn.in/health-cdn/images/images/anim4.svg)
}
.confetti-0 {
 width:8px;
 height:8px;
 border-radius:50%;
 background-color:#e374db;
 opacity:1;
 transform:rotate(98.43588deg) translate(90%);
 animation:drop-0 3s .60679s;
 top:70%;
 left:50%
}
@keyframes drop-0 {
 1% {
  top:75%;
  left:5%;
  transform:rotate(35.66477deg) translate(90%)
 }
 50% {
  top:4%;
  opacity:.7
 }
 80% {
  top:100%;
  left:22%;
  transform:rotate(69.64361deg) translate(90%);
  opacity:0
 }
}
.confetti-1 {
 width:8px;
 height:3.2px;
 border-radius:"";
 background-color:#e52315;
 opacity:1;
 transform:rotate(188.76729deg) translate(18%);
 animation:drop-1 3s .56948s;
 top:70%;
 left:50%
}
@keyframes drop-1 {
 1% {
  top:75%;
  left:59%;
  transform:rotate(158.10917deg) translate(18%)
 }
 50% {
  top:7%;
  opacity:.7
 }
 80% {
  top:100%;
  left:94%;
  transform:rotate(268.59367deg) translate(18%);
  opacity:0
 }
}
.confetti-2 {
 width:3px;
 height:3px;
 border-radius:50%;
 background-color:#e374db;
 opacity:1;
 transform:rotate(212.17117deg) translate(73%);
 animation:drop-2 3s .89788s;
 top:70%;
 left:50%
}
@keyframes drop-2 {
 1% {
  top:75%;
  left:16%;
  transform:rotate(116.90161deg) translate(73%)
 }
 50% {
  top:5%;
  opacity:.7
 }
 80% {
  top:100%;
  left:50%;
  transform:rotate(282.23435deg) translate(73%);
  opacity:0
 }
}
.confetti-3 {
 width:7px;
 height:2.8px;
 border-radius:"";
 background-color:#e52315;
 opacity:.58094;
 transform:rotate(152.84498deg) translate(29%);
 animation:drop-3 3s .56988s;
 top:70%;
 left:50%
}
@keyframes drop-3 {
 1% {
  top:75%;
  left:73%;
  transform:rotate(186.89788deg) translate(29%)
 }
 50% {
  top:23%;
  opacity:.7
 }
 80% {
  top:100%;
  left:72%;
  transform:rotate(337.43368deg) translate(29%);
  opacity:0
 }
}
.confetti-4 {
 width:7px;
 height:7px;
 border-radius:50%;
 background-color:#e52315;
 opacity:.78981;
 transform:rotate(139.37133deg) translate(24%);
 animation:drop-4 3s .63328s;
 top:70%;
 left:50%
}
@keyframes drop-4 {
 1% {
  top:75%;
  left:23%;
  transform:rotate(306.75109deg) translate(24%)
 }
 50% {
  top:1%;
  opacity:.7
 }
 80% {
  top:100%;
  left:13%;
  transform:rotate(.6073turn) translate(24%);
  opacity:0
 }
}
.confetti-5 {
 width:9px;
 height:3.6px;
 border-radius:"";
 background-color:#15dde5;
 opacity:1;
 transform:rotate(136.29194deg) translate(74%);
 animation:drop-5 3s .24212s;
 top:70%;
 left:50%
}
@keyframes drop-5 {
 1% {
  top:75%;
  left:73%;
  transform:rotate(9.2131deg) translate(74%)
 }
 50% {
  top:34%;
  opacity:.7
 }
 80% {
  top:100%;
  left:75%;
  transform:rotate(236.57386deg) translate(74%);
  opacity:0
 }
}
.confetti-6 {
 width:2px;
 height:2px;
 border-radius:50%;
 background-color:#e374db;
 opacity:.59622;
 transform:rotate(323.55993deg) translate(65%);
 animation:drop-6 3s .46956s;
 top:70%;
 left:50%
}
@keyframes drop-6 {
 1% {
  top:75%;
  left:47%;
  transform:rotate(190.19942deg) translate(65%)
 }
 50% {
  top:24%;
  opacity:.7
 }
 80% {
  top:100%;
  left:16%;
  transform:rotate(274.80393deg) translate(65%);
  opacity:0
 }
}
.confetti-7 {
 width:10px;
 height:4px;
 border-radius:"";
 background-color:#15dde5;
 opacity:1;
 transform:rotate(196.08173deg) translate(57%);
 animation:drop-7 3s .84184s;
 top:70%;
 left:50%
}
@keyframes drop-7 {
 1% {
  top:75%;
  left:77%;
  transform:rotate(22.44183deg) translate(57%)
 }
 50% {
  top:1%;
  opacity:.7
 }
 80% {
  top:100%;
  left:51%;
  transform:rotate(349.29646deg) translate(57%);
  opacity:0
 }
}
.confetti-8 {
 width:10px;
 height:10px;
 border-radius:50%;
 background-color:#ea9d2d;
 opacity:.65402;
 transform:rotate(109.27896deg) translate(41%);
 animation:drop-8 3s .08963s;
 top:70%;
 left:50%
}
@keyframes drop-8 {
 1% {
  top:75%;
  left:32%;
  transform:rotate(358.64039deg) translate(41%)
 }
 50% {
  top:42%;
  opacity:.7
 }
 80% {
  top:100%;
  left:28%;
  transform:rotate(236.61724deg) translate(41%);
  opacity:0
 }
}
.confetti-9 {
 width:10px;
 height:4px;
 border-radius:"";
 background-color:#ea9d2d;
 opacity:.89351;
 transform:rotate(257.52156deg) translate(35%);
 animation:drop-9 3s .33361s;
 top:70%;
 left:50%
}
@keyframes drop-9 {
 1% {
  top:75%;
  left:70%;
  transform:rotate(205.70621deg) translate(35%)
 }
 50% {
  top:1%;
  opacity:.7
 }
 80% {
  top:100%;
  left:82%;
  transform:rotate(166.29922deg) translate(35%);
  opacity:0
 }
}
.confetti-10 {
 width:1px;
 height:1px;
 border-radius:50%;
 background-color:#15dde5;
 opacity:1;
 transform:rotate(272.90806deg) translate(83%);
 animation:drop-10 3s .34924s;
 top:70%;
 left:50%
}
@keyframes drop-10 {
 1% {
  top:75%;
  left:37%;
  transform:rotate(326.20994deg) translate(83%)
 }
 50% {
  top:9%;
  opacity:.7
 }
 80% {
  top:100%;
  left:10%;
  transform:rotate(79.74183deg) translate(83%);
  opacity:0
 }
}
.confetti-11 {
 width:5px;
 height:2px;
 border-radius:"";
 background-color:#02a437;
 opacity:1;
 transform:rotate(7.05589deg) translate(43%);
 animation:drop-11 3s .50786s;
 top:70%;
 left:50%
}
@keyframes drop-11 {
 1% {
  top:75%;
  left:53%;
  transform:rotate(52.12824deg) translate(43%)
 }
 50% {
  top:28%;
  opacity:.7
 }
 80% {
  top:100%;
  left:53%;
  transform:rotate(136.88824deg) translate(43%);
  opacity:0
 }
}
.confetti-12 {
 width:7px;
 height:7px;
 border-radius:50%;
 background-color:#e52315;
 opacity:.6105;
 transform:rotate(251.07122deg) translate(63%);
 animation:drop-12 3s .28438s;
 top:70%;
 left:50%
}
@keyframes drop-12 {
 1% {
  top:75%;
  left:28%;
  transform:rotate(125.51998deg) translate(63%)
 }
 50% {
  top:8%;
  opacity:.7
 }
 80% {
  top:100%;
  left:5%;
  transform:rotate(41.87234deg) translate(63%);
  opacity:0
 }
}
.confetti-13 {
 width:9px;
 height:3.6px;
 border-radius:"";
 background-color:#e52315;
 opacity:.78256;
 transform:rotate(233.73073deg) translate(9%);
 animation:drop-13 3s .01471s;
 top:70%;
 left:50%
}
@keyframes drop-13 {
 1% {
  top:75%;
  left:71%;
  transform:rotate(221.60969deg) translate(9%)
 }
 50% {
  top:31%;
  opacity:.7
 }
 80% {
  top:100%;
  left:95%;
  transform:rotate(61.68502deg) translate(9%);
  opacity:0
 }
}
.confetti-14 {
 width:5px;
 height:5px;
 border-radius:50%;
 background-color:#e52315;
 opacity:1;
 transform:rotate(74.63777deg) translate(55%);
 animation:drop-14 3s .12293s;
 top:70%;
 left:50%
}
@keyframes drop-14 {
 1% {
  top:75%;
  left:50%;
  transform:rotate(1.35166deg) translate(55%)
 }
 50% {
  top:2%;
  opacity:.7
 }
 80% {
  top:100%;
  left:22%;
  transform:rotate(298.3857deg) translate(55%);
  opacity:0
 }
}
.confetti-15 {
 width:2px;
 height:.8px;
 border-radius:"";
 background-color:#e52315;
 opacity:1;
 transform:rotate(83.32913deg) translate(4%);
 animation:drop-15 3s .69772s;
 top:70%;
 left:50%
}
@keyframes drop-15 {
 1% {
  top:75%;
  left:99%;
  transform:rotate(243.96259deg) translate(4%)
 }
 50% {
  top:38%;
  opacity:.7
 }
 80% {
  top:100%;
  left:95%;
  transform:rotate(266.77738deg) translate(4%);
  opacity:0
 }
}
.confetti-16 {
 width:7px;
 height:7px;
 border-radius:50%;
 background-color:#e52315;
 opacity:1;
 transform:rotate(111.64295deg) translate(22%);
 animation:drop-16 3s .82934s;
 top:70%;
 left:50%
}
@keyframes drop-16 {
 1% {
  top:75%;
  left:16%;
  transform:rotate(20.00472deg) translate(22%)
 }
 50% {
  top:25%;
  opacity:.7
 }
 80% {
  top:100%;
  left:6%;
  transform:rotate(321.13996deg) translate(22%);
  opacity:0
 }
}
.confetti-17 {
 width:8px;
 height:3.2px;
 border-radius:"";
 background-color:#e374db;
 opacity:1;
 transform:rotate(209.96074deg) translate(82%);
 animation:drop-17 3s .74465s;
 top:70%;
 left:50%
}
@keyframes drop-17 {
 1% {
  top:75%;
  left:59%;
  transform:rotate(207.42123deg) translate(82%)
 }
 50% {
  top:7%;
  opacity:.7
 }
 80% {
  top:100%;
  left:78%;
  transform:rotate(317.2149deg) translate(82%);
  opacity:0
 }
}
.confetti-18 {
 width:1px;
 height:1px;
 border-radius:50%;
 background-color:#e52315;
 opacity:1;
 transform:rotate(6.72612deg) translate(83%);
 animation:drop-18 3s .3215s;
 top:70%;
 left:50%
}
@keyframes drop-18 {
 1% {
  top:75%;
  left:46%;
  transform:rotate(248.07145deg) translate(83%)
 }
 50% {
  top:13%;
  opacity:.7
 }
 80% {
  top:100%;
  left:40%;
  transform:rotate(63.31773deg) translate(83%);
  opacity:0
 }
}
.confetti-19 {
 width:3px;
 height:1.2px;
 border-radius:"";
 background-color:#e52315;
 opacity:1;
 transform:rotate(129.65586deg) translate(59%);
 animation:drop-19 3s .18847s;
 top:70%;
 left:50%
}
@keyframes drop-19 {
 1% {
  top:75%;
  left:53%;
  transform:rotate(112.21581deg) translate(59%)
 }
 50% {
  top:17%;
  opacity:.7
 }
 80% {
  top:100%;
  left:55%;
  transform:rotate(96.16164deg) translate(59%);
  opacity:0
 }
}
.confetti-20 {
 width:2px;
 height:2px;
 border-radius:50%;
 background-color:#ea9d2d;
 opacity:.71481;
 transform:rotate(156.33098deg) translate(97%);
 animation:drop-20 3s .27908s;
 top:70%;
 left:50%
}
@keyframes drop-20 {
 1% {
  top:75%;
  left:46%;
  transform:rotate(11.96017deg) translate(97%)
 }
 50% {
  top:15%;
  opacity:.7
 }
 80% {
  top:100%;
  left:9%;
  transform:rotate(29.17959deg) translate(97%);
  opacity:0
 }
}
.confetti-21 {
 width:2px;
 height:.8px;
 border-radius:"";
 background-color:#15dde5;
 opacity:1;
 transform:rotate(75.78374deg) translate(35%);
 animation:drop-21 3s .51754s;
 top:70%;
 left:50%
}
@keyframes drop-21 {
 1% {
  top:75%;
  left:66%;
  transform:rotate(119.31321deg) translate(35%)
 }
 50% {
  top:19%;
  opacity:.7
 }
 80% {
  top:100%;
  left:79%;
  transform:rotate(82.31203deg) translate(35%);
  opacity:0
 }
}
.confetti-22 {
 width:2px;
 height:2px;
 border-radius:50%;
 background-color:#e52315;
 opacity:.52375;
 transform:rotate(58.83283deg) translate(7%);
 animation:drop-22 3s .67973s;
 top:70%;
 left:50%
}
@keyframes drop-22 {
 1% {
  top:75%;
  left:43%;
  transform:rotate(33.10496deg) translate(7%)
 }
 50% {
  top:28%;
  opacity:.7
 }
 80% {
  top:100%;
  left:24%;
  transform:rotate(65.75615deg) translate(7%);
  opacity:0
 }
}
.confetti-23 {
 width:5px;
 height:2px;
 border-radius:"";
 background-color:#15dde5;
 opacity:.94561;
 transform:rotate(119.13123deg) translate(86%);
 animation:drop-23 3s .5153s;
 top:70%;
 left:50%
}
@keyframes drop-23 {
 1% {
  top:75%;
  left:55%;
  transform:rotate(157.00143deg) translate(86%)
 }
 50% {
  top:11%;
  opacity:.7
 }
 80% {
  top:100%;
  left:67%;
  transform:rotate(229.27807deg) translate(86%);
  opacity:0
 }
}
.confetti-24 {
 width:1px;
 height:1px;
 border-radius:50%;
 background-color:#e374db;
 opacity:.67041;
 transform:rotate(344.5857deg) translate(81%);
 animation:drop-24 3s .22303s;
 top:70%;
 left:50%
}
@keyframes drop-24 {
 1% {
  top:75%;
  left:42%;
  transform:rotate(63.90373deg) translate(81%)
 }
 50% {
  top:27%;
  opacity:.7
 }
 80% {
  top:100%;
  left:46%;
  transform:rotate(292.6413deg) translate(81%);
  opacity:0
 }
}
.confetti-25 {
 width:1px;
 height:.4px;
 border-radius:"";
 background-color:#ea9d2d;
 opacity:.81904;
 transform:rotate(219.80316deg) translate(74%);
 animation:drop-25 3s .75326s;
 top:70%;
 left:50%
}
@keyframes drop-25 {
 1% {
  top:75%;
  left:89%;
  transform:rotate(294.16413deg) translate(74%)
 }
 50% {
  top:33%;
  opacity:.7
 }
 80% {
  top:100%;
  left:61%;
  transform:rotate(276.92286deg) translate(74%);
  opacity:0
 }
}
.confetti-26 {
 width:5px;
 height:5px;
 border-radius:50%;
 background-color:#15dde5;
 opacity:1;
 transform:rotate(227.36885deg) translate(98%);
 animation:drop-26 3s .66903s;
 top:70%;
 left:50%
}
@keyframes drop-26 {
 1% {
  top:75%;
  left:5%;
  transform:rotate(138.05695deg) translate(98%)
 }
 50% {
  top:22%;
  opacity:.7
 }
 80% {
  top:100%;
  left:48%;
  transform:rotate(217.64701deg) translate(98%);
  opacity:0
 }
}
.confetti-27 {
 width:7px;
 height:2.8px;
 border-radius:"";
 background-color:#02a437;
 opacity:.94918;
 transform:rotate(52.81889deg) translate(6%);
 animation:drop-27 3s .18927s;
 top:70%;
 left:50%
}
@keyframes drop-27 {
 1% {
  top:75%;
  left:56%;
  transform:rotate(12.04268deg) translate(6%)
 }
 50% {
  top:24%;
  opacity:.7
 }
 80% {
  top:100%;
  left:59%;
  transform:rotate(213.12044deg) translate(6%);
  opacity:0
 }
}
.confetti-28 {
 width:9px;
 height:9px;
 border-radius:50%;
 background-color:#e374db;
 opacity:.88573;
 transform:rotate(98.44086deg) translate(69%);
 animation:drop-28 3s .93296s;
 top:70%;
 left:50%
}
@keyframes drop-28 {
 1% {
  top:75%;
  left:9%;
  transform:rotate(266.3392deg) translate(69%)
 }
 50% {
  top:32%;
  opacity:.7
 }
 80% {
  top:100%;
  left:34%;
  transform:rotate(271.71033deg) translate(69%);
  opacity:0
 }
}
.confetti-29 {
 width:2px;
 height:.8px;
 border-radius:"";
 background-color:#e52315;
 opacity:1;
 transform:rotate(267.48315deg) translate(99%);
 animation:drop-29 3s .65814s;
 top:70%;
 left:50%
}
@keyframes drop-29 {
 1% {
  top:75%;
  left:80%;
  transform:rotate(123.66618deg) translate(99%)
 }
 50% {
  top:24%;
  opacity:.7
 }
 80% {
  top:100%;
  left:79%;
  transform:rotate(242.12707deg) translate(99%);
  opacity:0
 }
}
.confetti-30 {
 width:7px;
 height:7px;
 border-radius:50%;
 background-color:#02a437;
 opacity:.65721;
 transform:rotate(184.0173deg) translate(99%);
 animation:drop-30 3s .83063s;
 top:70%;
 left:50%
}
@keyframes drop-30 {
 1% {
  top:75%;
  left:9%;
  transform:rotate(119.22653deg) translate(99%)
 }
 50% {
  top:37%;
  opacity:.7
 }
 80% {
  top:100%;
  left:32%;
  transform:rotate(166.09497deg) translate(99%);
  opacity:0
 }
}
.confetti-31 {
 width:9px;
 height:3.6px;
 border-radius:"";
 background-color:#15dde5;
 opacity:.65291;
 transform:rotate(194.62332deg) translate(41%);
 animation:drop-31 3s .10759s;
 top:70%;
 left:50%
}
@keyframes drop-31 {
 1% {
  top:75%;
  left:56%;
  transform:rotate(307.20645deg) translate(41%)
 }
 50% {
  top:43%;
  opacity:.7
 }
 80% {
  top:100%;
  left:54%;
  transform:rotate(14.74268deg) translate(41%);
  opacity:0
 }
}
.confetti-32 {
 width:6px;
 height:6px;
 border-radius:50%;
 background-color:#e52315;
 opacity:1;
 transform:rotate(32.86143deg) translate(55%);
 animation:drop-32 3s .68231s;
 top:70%;
 left:50%
}
@keyframes drop-32 {
 1% {
  top:75%;
  left:40%;
  transform:rotate(185.84168deg) translate(55%)
 }
 50% {
  top:30%;
  opacity:.7
 }
 80% {
  top:100%;
  left:44%;
  transform:rotate(145.56812deg) translate(55%);
  opacity:0
 }
}
.confetti-33 {
 width:3px;
 height:1.2px;
 border-radius:"";
 background-color:#ea9d2d;
 opacity:.93029;
 transform:rotate(57.12501deg) translate(4%);
 animation:drop-33 3s .76871s;
 top:70%;
 left:50%
}
@keyframes drop-33 {
 1% {
  top:75%;
  left:88%;
  transform:rotate(285.35121deg) translate(4%)
 }
 50% {
  top:42%;
  opacity:.7
 }
 80% {
  top:100%;
  left:71%;
  transform:rotate(56.84796deg) translate(4%);
  opacity:0
 }
}
.confetti-34 {
 width:5px;
 height:5px;
 border-radius:50%;
 background-color:#ea9d2d;
 opacity:.54832;
 transform:rotate(34.74845deg) translate(8%);
 animation:drop-34 3s .04964s;
 top:70%;
 left:50%
}
@keyframes drop-34 {
 1% {
  top:75%;
  left:5%;
  transform:rotate(289.98709deg) translate(8%)
 }
 50% {
  top:37%;
  opacity:.7
 }
 80% {
  top:100%;
  left:28%;
  transform:rotate(302.04837deg) translate(8%);
  opacity:0
 }
}
.confetti-35 {
 width:8px;
 height:3.2px;
 border-radius:"";
 background-color:#e374db;
 opacity:1;
 transform:rotate(53.94278deg) translate(47%);
 animation:drop-35 3s .65208s;
 top:70%;
 left:50%
}
@keyframes drop-35 {
 1% {
  top:75%;
  left:86%;
  transform:rotate(271.46714deg) translate(47%)
 }
 50% {
  top:26%;
  opacity:.7
 }
 80% {
  top:100%;
  left:77%;
  transform:rotate(349.87541deg) translate(47%);
  opacity:0
 }
}
.confetti-36 {
 width:3px;
 height:3px;
 border-radius:50%;
 background-color:#15dde5;
 opacity:1;
 transform:rotate(310.77417deg) translate(85%);
 animation:drop-36 3s .71505s;
 top:70%;
 left:50%
}
@keyframes drop-36 {
 1% {
  top:75%;
  left:26%;
  transform:rotate(319.25395deg) translate(85%)
 }
 50% {
  top:14%;
  opacity:.7
 }
 80% {
  top:100%;
  left:2%;
  transform:rotate(253.89709deg) translate(85%);
  opacity:0
 }
}
.confetti-37 {
 width:4px;
 height:1.6px;
 border-radius:"";
 background-color:#15dde5;
 opacity:.78466;
 transform:rotate(278.80162deg) translate(21%);
 animation:drop-37 3s .23334s;
 top:70%;
 left:50%
}
@keyframes drop-37 {
 1% {
  top:75%;
  left:93%;
  transform:rotate(333.21449deg) translate(21%)
 }
 50% {
  top:38%;
  opacity:.7
 }
 80% {
  top:100%;
  left:51%;
  transform:rotate(124.03303deg) translate(21%);
  opacity:0
 }
}
.confetti-38 {
 width:2px;
 height:2px;
 border-radius:50%;
 background-color:#ea9d2d;
 opacity:.68103;
 transform:rotate(49.22694deg) translate(84%);
 animation:drop-38 3s .35552s;
 top:70%;
 left:50%
}
@keyframes drop-38 {
 1% {
  top:75%;
  left:36%;
  transform:rotate(190.82512deg) translate(84%)
 }
 50% {
  top:33%;
  opacity:.7
 }
 80% {
  top:100%;
  left:11%;
  transform:rotate(12.42223deg) translate(84%);
  opacity:0
 }
}
.confetti-39 {
 width:3px;
 height:1.2px;
 border-radius:"";
 background-color:#ea9d2d;
 opacity:.59104;
 transform:rotate(19.98941deg) translate(85%);
 animation:drop-39 3s .87115s;
 top:70%;
 left:50%
}
@keyframes drop-39 {
 1% {
  top:75%;
  left:84%;
  transform:rotate(160.92355deg) translate(85%)
 }
 50% {
  top:16%;
  opacity:.7
 }
 80% {
  top:100%;
  left:80%;
  transform:rotate(148.25155deg) translate(85%);
  opacity:0
 }
}
.confetti-40 {
 width:10px;
 height:10px;
 border-radius:50%;
 background-color:#e374db;
 opacity:.72091;
 transform:rotate(316.47719deg) translate(21%);
 animation:drop-40 3s .95622s;
 top:70%;
 left:50%
}
@keyframes drop-40 {
 1% {
  top:75%;
  left:26%;
  transform:rotate(244.26046deg) translate(21%)
 }
 50% {
  top:24%;
  opacity:.7
 }
 80% {
  top:100%;
  left:7%;
  transform:rotate(62.75821deg) translate(21%);
  opacity:0
 }
}
.confetti-41 {
 width:5px;
 height:2px;
 border-radius:"";
 background-color:#e52315;
 opacity:.63003;
 transform:rotate(14.41994deg) translate(96%);
 animation:drop-41 3s .79182s;
 top:70%;
 left:50%
}
@keyframes drop-41 {
 1% {
  top:75%;
  left:94%;
  transform:rotate(241.3544deg) translate(96%)
 }
 50% {
  top:37%;
  opacity:.7
 }
 80% {
  top:100%;
  left:82%;
  transform:rotate(6.47798deg) translate(96%);
  opacity:0
 }
}
.confetti-42 {
 width:4px;
 height:4px;
 border-radius:50%;
 background-color:#e52315;
 opacity:1;
 transform:rotate(351.97374deg) translate(73%);
 animation:drop-42 3s .48167s;
 top:70%;
 left:50%
}
@keyframes drop-42 {
 1% {
  top:75%;
  left:17%;
  transform:rotate(95.54803deg) translate(73%)
 }
 50% {
  top:42%;
  opacity:.7
 }
 80% {
  top:100%;
  left:17%;
  transform:rotate(77.5489deg) translate(73%);
  opacity:0
 }
}
.confetti-43 {
 width:9px;
 height:3.6px;
 border-radius:"";
 background-color:#ea9d2d;
 opacity:1;
 transform:rotate(215.23827deg) translate(59%);
 animation:drop-43 3s .49293s;
 top:70%;
 left:50%
}
@keyframes drop-43 {
 1% {
  top:75%;
  left:80%;
  transform:rotate(187.35458deg) translate(59%)
 }
 50% {
  top:12%;
  opacity:.7
 }
 80% {
  top:100%;
  left:73%;
  transform:rotate(122.99049deg) translate(59%);
  opacity:0
 }
}
.confetti-44 {
 width:5px;
 height:5px;
 border-radius:50%;
 background-color:#ea9d2d;
 opacity:1;
 transform:rotate(130.40331deg) translate(97%);
 animation:drop-44 3s .35018s;
 top:70%;
 left:50%
}
@keyframes drop-44 {
 1% {
  top:75%;
  left:12%;
  transform:rotate(352.78989deg) translate(97%)
 }
 50% {
  top:11%;
  opacity:.7
 }
 80% {
  top:100%;
  left:34%;
  transform:rotate(337.88424deg) translate(97%);
  opacity:0
 }
}
.confetti-45 {
 width:5px;
 height:2px;
 border-radius:"";
 background-color:#e374db;
 opacity:1;
 transform:rotate(320.40503deg) translate(66%);
 animation:drop-45 3s .30062s;
 top:70%;
 left:50%
}
@keyframes drop-45 {
 1% {
  top:75%;
  left:68%;
  transform:rotate(85.84734deg) translate(66%)
 }
 50% {
  top:22%;
  opacity:.7
 }
 80% {
  top:100%;
  left:60%;
  transform:rotate(272.57314deg) translate(66%);
  opacity:0
 }
}
.confetti-46 {
 width:6px;
 height:6px;
 border-radius:50%;
 background-color:#02a437;
 opacity:.91664;
 transform:rotate(150.07244deg) translate(71%);
 animation:drop-46 3s .79559s;
 top:70%;
 left:50%
}
@keyframes drop-46 {
 1% {
  top:75%;
  left:17%;
  transform:rotate(230.6138deg) translate(71%)
 }
 50% {
  top:17%;
  opacity:.7
 }
 80% {
  top:100%;
  left:9%;
  transform:rotate(240.0931deg) translate(71%);
  opacity:0
 }
}
.confetti-47 {
 width:1px;
 height:.4px;
 border-radius:"";
 background-color:#ea9d2d;
 opacity:1;
 transform:rotate(252.8698deg) translate(43%);
 animation:drop-47 3s .64488s;
 top:70%;
 left:50%
}
@keyframes drop-47 {
 1% {
  top:75%;
  left:69%;
  transform:rotate(56.1981deg) translate(43%)
 }
 50% {
  top:23%;
  opacity:.7
 }
 80% {
  top:100%;
  left:61%;
  transform:rotate(14.51589deg) translate(43%);
  opacity:0
 }
}
.confetti-48 {
 width:9px;
 height:9px;
 border-radius:50%;
 background-color:#02a437;
 opacity:1;
 transform:rotate(184.82406deg) translate(78%);
 animation:drop-48 3s .02606s;
 top:70%;
 left:50%
}
@keyframes drop-48 {
 1% {
  top:75%;
  left:8%;
  transform:rotate(206.41246deg) translate(78%)
 }
 50% {
  top:38%;
  opacity:.7
 }
 80% {
  top:100%;
  left:10%;
  transform:rotate(324.75808deg) translate(78%);
  opacity:0
 }
}
.confetti-49 {
 width:4px;
 height:1.6px;
 border-radius:"";
 background-color:#02a437;
 opacity:.60762;
 transform:rotate(189.74332deg) translate(29%);
 animation:drop-49 3s .99239s;
 top:70%;
 left:50%
}
@keyframes drop-49 {
 1% {
  top:75%;
  left:100%;
  transform:rotate(276.59978deg) translate(29%)
 }
 50% {
  top:23%;
  opacity:.7
 }
 80% {
  top:100%;
  left:90%;
  transform:rotate(207.78128deg) translate(29%);
  opacity:0
 }
}
.confetti-50 {
 width:6px;
 height:6px;
 border-radius:50%;
 background-color:#02a437;
 opacity:1;
 transform:rotate(4.44564deg) translate(45%);
 animation:drop-50 3s .94028s;
 top:70%;
 left:50%
}
@keyframes drop-50 {
 1% {
  top:75%;
  left:17%;
  transform:rotate(247.16444deg) translate(45%)
 }
 50% {
  top:14%;
  opacity:.7
 }
 80% {
  top:100%;
  left:26%;
  transform:rotate(256.38087deg) translate(45%);
  opacity:0
 }
}
.confetti-51 {
 width:2px;
 height:.8px;
 border-radius:"";
 background-color:#ea9d2d;
 opacity:.55207;
 transform:rotate(246.83181deg) translate(76%);
 animation:drop-51 3s .6425s;
 top:70%;
 left:50%
}
@keyframes drop-51 {
 1% {
  top:75%;
  left:82%;
  transform:rotate(258.9799deg) translate(76%)
 }
 50% {
  top:11%;
  opacity:.7
 }
 80% {
  top:100%;
  left:62%;
  transform:rotate(135.82009deg) translate(76%);
  opacity:0
 }
}
.confetti-52 {
 width:1px;
 height:1px;
 border-radius:50%;
 background-color:#02a437;
 opacity:.87052;
 transform:rotate(144.59514deg) translate(72%);
 animation:drop-52 3s .09768s;
 top:70%;
 left:50%
}
@keyframes drop-52 {
 1% {
  top:75%;
  left:25%;
  transform:rotate(196.95082deg) translate(72%)
 }
 50% {
  top:17%;
  opacity:.7
 }
 80% {
  top:100%;
  left:14%;
  transform:rotate(28.81218deg) translate(72%);
  opacity:0
 }
}
.confetti-53 {
 width:6px;
 height:2.4px;
 border-radius:"";
 background-color:#e52315;
 opacity:.56167;
 transform:rotate(50.11538deg) translate(40%);
 animation:drop-53 3s .08604s;
 top:70%;
 left:50%
}
@keyframes drop-53 {
 1% {
  top:75%;
  left:62%;
  transform:rotate(180.78529deg) translate(40%)
 }
 50% {
  top:41%;
  opacity:.7
 }
 80% {
  top:100%;
  left:82%;
  transform:rotate(208.26563deg) translate(40%);
  opacity:0
 }
}
.confetti-54 {
 width:10px;
 height:10px;
 border-radius:50%;
 background-color:#e374db;
 opacity:1;
 transform:rotate(114.94846deg) translate(48%);
 animation:drop-54 3s .44042s;
 top:70%;
 left:50%
}
@keyframes drop-54 {
 1% {
  top:75%;
  left:22%;
  transform:rotate(100.58093deg) translate(48%)
 }
 50% {
  top:27%;
  opacity:.7
 }
 80% {
  top:100%;
  left:47%;
  transform:rotate(222.48722deg) translate(48%);
  opacity:0
 }
}
.confetti-55 {
 width:6px;
 height:2.4px;
 border-radius:"";
 background-color:#ea9d2d;
 opacity:.5228;
 transform:rotate(283.26946deg) translate(73%);
 animation:drop-55 3s .37566s;
 top:70%;
 left:50%
}
@keyframes drop-55 {
 1% {
  top:75%;
  left:95%;
  transform:rotate(81.35844deg) translate(73%)
 }
 50% {
  top:19%;
  opacity:.7
 }
 80% {
  top:100%;
  left:85%;
  transform:rotate(21.39616deg) translate(73%);
  opacity:0
 }
}
.confetti-56 {
 width:9px;
 height:9px;
 border-radius:50%;
 background-color:#e374db;
 opacity:.71102;
 transform:rotate(262.33206deg) translate(47%);
 animation:drop-56 3s .1064s;
 top:70%;
 left:50%
}
@keyframes drop-56 {
 1% {
  top:75%;
  left:34%;
  transform:rotate(132.89392deg) translate(47%)
 }
 50% {
  top:3%;
  opacity:.7
 }
 80% {
  top:100%;
  left:24%;
  transform:rotate(11.05644deg) translate(47%);
  opacity:0
 }
}
.confetti-57 {
 width:7px;
 height:2.8px;
 border-radius:"";
 background-color:#15dde5;
 opacity:.74909;
 transform:rotate(184.79311deg) translate(69%);
 animation:drop-57 3s .09542s;
 top:70%;
 left:50%
}
@keyframes drop-57 {
 1% {
  top:75%;
  left:73%;
  transform:rotate(27.33822deg) translate(69%)
 }
 50% {
  top:6%;
  opacity:.7
 }
 80% {
  top:100%;
  left:95%;
  transform:rotate(78.2631deg) translate(69%);
  opacity:0
 }
}
.confetti-58 {
 width:1px;
 height:1px;
 border-radius:50%;
 background-color:#02a437;
 opacity:1;
 transform:rotate(301.56897deg) translate(92%);
 animation:drop-58 3s .08768s;
 top:70%;
 left:50%
}
@keyframes drop-58 {
 1% {
  top:75%;
  left:12%;
  transform:rotate(105.43483deg) translate(92%)
 }
 50% {
  top:8%;
  opacity:.7
 }
 80% {
  top:100%;
  left:15%;
  transform:rotate(2.37066deg) translate(92%);
  opacity:0
 }
}
.confetti-59 {
 width:8px;
 height:3.2px;
 border-radius:"";
 background-color:#e52315;
 opacity:1;
 transform:rotate(353.08356deg) translate(72%);
 animation:drop-59 3s .64826s;
 top:70%;
 left:50%
}
@keyframes drop-59 {
 1% {
  top:75%;
  left:98%;
  transform:rotate(116.6502deg) translate(72%)
 }
 50% {
  top:10%;
  opacity:.7
 }
 80% {
  top:100%;
  left:79%;
  transform:rotate(95.9168deg) translate(72%);
  opacity:0
 }
}
.confetti-60 {
 width:4px;
 height:4px;
 border-radius:50%;
 background-color:#02a437;
 opacity:1;
 transform:rotate(46.39428deg) translate(38%);
 animation:drop-60 3s .51358s;
 top:70%;
 left:50%
}
@keyframes drop-60 {
 1% {
  top:75%;
  left:16%;
  transform:rotate(299.5666deg) translate(38%)
 }
 50% {
  top:13%;
  opacity:.7
 }
 80% {
  top:100%;
  left:39%;
  transform:rotate(248.93086deg) translate(38%);
  opacity:0
 }
}
.confetti-61 {
 width:4px;
 height:1.6px;
 border-radius:"";
 background-color:#ea9d2d;
 opacity:.76213;
 transform:rotate(279.75143deg) translate(55%);
 animation:drop-61 3s .94531s;
 top:70%;
 left:50%
}
@keyframes drop-61 {
 1% {
  top:75%;
  left:92%;
  transform:rotate(94.41389deg) translate(55%)
 }
 50% {
  top:26%;
  opacity:.7
 }
 80% {
  top:100%;
  left:70%;
  transform:rotate(306.50862deg) translate(55%);
  opacity:0
 }
}
.confetti-62 {
 width:7px;
 height:7px;
 border-radius:50%;
 background-color:#15dde5;
 opacity:1;
 transform:rotate(314.40165deg) translate(64%);
 animation:drop-62 3s .27908s;
 top:70%;
 left:50%
}
@keyframes drop-62 {
 1% {
  top:75%;
  left:26%;
  transform:rotate(277.5195deg) translate(64%)
 }
 50% {
  top:4%;
  opacity:.7
 }
 80% {
  top:100%;
  left:43%;
  transform:rotate(81.84154deg) translate(64%);
  opacity:0
 }
}
.confetti-63 {
 width:8px;
 height:3.2px;
 border-radius:"";
 background-color:#ea9d2d;
 opacity:1;
 transform:rotate(5.89412deg) translate(15%);
 animation:drop-63 3s .26469s;
 top:70%;
 left:50%
}
@keyframes drop-63 {
 1% {
  top:75%;
  left:85%;
  transform:rotate(69.59058deg) translate(15%)
 }
 50% {
  top:27%;
  opacity:.7
 }
 80% {
  top:100%;
  left:80%;
  transform:rotate(158.16466deg) translate(15%);
  opacity:0
 }
}
.confetti-64 {
 width:2px;
 height:2px;
 border-radius:50%;
 background-color:#15dde5;
 opacity:.96902;
 transform:rotate(267.20492deg) translate(24%);
 animation:drop-64 3s .528s;
 top:70%;
 left:50%
}
@keyframes drop-64 {
 1% {
  top:75%;
  left:45%;
  transform:rotate(159.06411deg) translate(24%)
 }
 50% {
  top:1%;
  opacity:.7
 }
 80% {
  top:100%;
  left:5%;
  transform:rotate(334.06395deg) translate(24%);
  opacity:0
 }
}
.confetti-65 {
 width:1px;
 height:.4px;
 border-radius:"";
 background-color:#02a437;
 opacity:1;
 transform:rotate(118.55399deg) translate(73%);
 animation:drop-65 3s .81652s;
 top:70%;
 left:50%
}
@keyframes drop-65 {
 1% {
  top:75%;
  left:90%;
  transform:rotate(269.75547deg) translate(73%)
 }
 50% {
  top:31%;
  opacity:.7
 }
 80% {
  top:100%;
  left:77%;
  transform:rotate(178.20955deg) translate(73%);
  opacity:0
 }
}
.confetti-66 {
 width:2px;
 height:2px;
 border-radius:50%;
 background-color:#02a437;
 opacity:.94773;
 transform:rotate(219.67429deg) translate(45%);
 animation:drop-66 3s .62364s;
 top:70%;
 left:50%
}
@keyframes drop-66 {
 1% {
  top:75%;
  left:8%;
  transform:rotate(319.01657deg) translate(45%)
 }
 50% {
  top:15%;
  opacity:.7
 }
 80% {
  top:100%;
  left:23%;
  transform:rotate(165.21203deg) translate(45%);
  opacity:0
 }
}
.confetti-67 {
 width:2px;
 height:.8px;
 border-radius:"";
 background-color:#15dde5;
 opacity:.97983;
 transform:rotate(332.04774deg) translate(29%);
 animation:drop-67 3s .91833s;
 top:70%;
 left:50%
}
@keyframes drop-67 {
 1% {
  top:75%;
  left:72%;
  transform:rotate(319.18501deg) translate(29%)
 }
 50% {
  top:3%;
  opacity:.7
 }
 80% {
  top:100%;
  left:97%;
  transform:rotate(156.28288deg) translate(29%);
  opacity:0
 }
}
.confetti-68 {
 width:1px;
 height:1px;
 border-radius:50%;
 background-color:#e52315;
 opacity:1;
 transform:rotate(299.83658deg) translate(28%);
 animation:drop-68 3s .47772s;
 top:70%;
 left:50%
}
@keyframes drop-68 {
 1% {
  top:75%;
  left:19%;
  transform:rotate(244.33229deg) translate(28%)
 }
 50% {
  top:15%;
  opacity:.7
 }
 80% {
  top:100%;
  left:39%;
  transform:rotate(347.69678deg) translate(28%);
  opacity:0
 }
}
.confetti-69 {
 width:2px;
 height:.8px;
 border-radius:"";
 background-color:#e52315;
 opacity:1;
 transform:rotate(336.20157deg) translate(37%);
 animation:drop-69 3s .64396s;
 top:70%;
 left:50%
}
@keyframes drop-69 {
 1% {
  top:75%;
  left:64%;
  transform:rotate(183.48003deg) translate(37%)
 }
 50% {
  top:14%;
  opacity:.7
 }
 80% {
  top:100%;
  left:79%;
  transform:rotate(26.33584deg) translate(37%);
  opacity:0
 }
}
.confetti-70 {
 width:7px;
 height:7px;
 border-radius:50%;
 background-color:#ea9d2d;
 opacity:1;
 transform:rotate(2.866deg) translate(90%);
 animation:drop-70 3s .8658s;
 top:70%;
 left:50%
}
@keyframes drop-70 {
 1% {
  top:75%;
  left:27%;
  transform:rotate(32.49433deg) translate(90%)
 }
 50% {
  top:8%;
  opacity:.7
 }
 80% {
  top:100%;
  left:10%;
  transform:rotate(134.61562deg) translate(90%);
  opacity:0
 }
}
.confetti-71 {
 width:10px;
 height:4px;
 border-radius:"";
 background-color:#02a437;
 opacity:.72944;
 transform:rotate(32.21107deg) translate(59%);
 animation:drop-71 3s .8777s;
 top:70%;
 left:50%
}
@keyframes drop-71 {
 1% {
  top:75%;
  left:68%;
  transform:rotate(125.69208deg) translate(59%)
 }
 50% {
  top:40%;
  opacity:.7
 }
 80% {
  top:100%;
  left:56%;
  transform:rotate(249.12905deg) translate(59%);
  opacity:0
 }
}
.confetti-72 {
 width:7px;
 height:7px;
 border-radius:50%;
 background-color:#15dde5;
 opacity:1;
 transform:rotate(248.99821deg) translate(29%);
 animation:drop-72 3s .17996s;
 top:70%;
 left:50%
}
@keyframes drop-72 {
 1% {
  top:75%;
  left:24%;
  transform:rotate(2.17586deg) translate(29%)
 }
 50% {
  top:10%;
  opacity:.7
 }
 80% {
  top:100%;
  left:24%;
  transform:rotate(210.34204deg) translate(29%);
  opacity:0
 }
}
.confetti-73 {
 width:10px;
 height:4px;
 border-radius:"";
 background-color:#ea9d2d;
 opacity:.99876;
 transform:rotate(151.9874deg) translate(66%);
 animation:drop-73 3s .23962s;
 top:70%;
 left:50%
}
@keyframes drop-73 {
 1% {
  top:75%;
  left:78%;
  transform:rotate(46.23627deg) translate(66%)
 }
 50% {
  top:43%;
  opacity:.7
 }
 80% {
  top:100%;
  left:97%;
  transform:rotate(307.89346deg) translate(66%);
  opacity:0
 }
}
.confetti-74 {
 width:8px;
 height:8px;
 border-radius:50%;
 background-color:#15dde5;
 opacity:1;
 transform:rotate(291.62828deg) translate(7%);
 animation:drop-74 3s .30531s;
 top:70%;
 left:50%
}
@keyframes drop-74 {
 1% {
  top:75%;
  left:1%;
  transform:rotate(42.50644deg) translate(7%)
 }
 50% {
  top:43%;
  opacity:.7
 }
 80% {
  top:100%;
  left:5%;
  transform:rotate(255.72968deg) translate(7%);
  opacity:0
 }
}
.confetti-75 {
 width:4px;
 height:1.6px;
 border-radius:"";
 background-color:#15dde5;
 opacity:1;
 transform:rotate(6.00589deg) translate(60%);
 animation:drop-75 3s .62233s;
 top:70%;
 left:50%
}
@keyframes drop-75 {
 1% {
  top:75%;
  left:57%;
  transform:rotate(221.50916deg) translate(60%)
 }
 50% {
  top:25%;
  opacity:.7
 }
 80% {
  top:100%;
  left:95%;
  transform:rotate(167.31513deg) translate(60%);
  opacity:0
 }
}
.confetti-76 {
 width:7px;
 height:7px;
 border-radius:50%;
 background-color:#e374db;
 opacity:.75004;
 transform:rotate(110.70056deg) translate(76%);
 animation:drop-76 3s .29699s;
 top:70%;
 left:50%
}
@keyframes drop-76 {
 1% {
  top:75%;
  left:31%;
  transform:rotate(36.17414deg) translate(76%)
 }
 50% {
  top:22%;
  opacity:.7
 }
 80% {
  top:100%;
  left:10%;
  transform:rotate(187.25202deg) translate(76%);
  opacity:0
 }
}
.confetti-77 {
 width:8px;
 height:3.2px;
 border-radius:"";
 background-color:#e52315;
 opacity:1;
 transform:rotate(116.57214deg) translate(84%);
 animation:drop-77 3s .97596s;
 top:70%;
 left:50%
}
@keyframes drop-77 {
 1% {
  top:75%;
  left:82%;
  transform:rotate(352.97556deg) translate(84%)
 }
 50% {
  top:18%;
  opacity:.7
 }
 80% {
  top:100%;
  left:85%;
  transform:rotate(45.20635deg) translate(84%);
  opacity:0
 }
}
.confetti-78 {
 width:9px;
 height:9px;
 border-radius:50%;
 background-color:#e52315;
 opacity:.95694;
 transform:rotate(300.93206deg) translate(44%);
 animation:drop-78 3s .67174s;
 top:70%;
 left:50%
}
@keyframes drop-78 {
 1% {
  top:75%;
  left:21%;
  transform:rotate(99.71126deg) translate(44%)
 }
 50% {
  top:22%;
  opacity:.7
 }
 80% {
  top:100%;
  left:41%;
  transform:rotate(99.02499deg) translate(44%);
  opacity:0
 }
}
.confetti-79 {
 width:7px;
 height:2.8px;
 border-radius:"";
 background-color:#ea9d2d;
 opacity:.57696;
 transform:rotate(120.33883deg) translate(79%);
 animation:drop-79 3s .02907s;
 top:70%;
 left:50%
}
@keyframes drop-79 {
 1% {
  top:75%;
  left:86%;
  transform:rotate(156.50043deg) translate(79%)
 }
 50% {
  top:31%;
  opacity:.7
 }
 80% {
  top:100%;
  left:51%;
  transform:rotate(.817782turn) translate(79%);
  opacity:0
 }
}
.confetti-80 {
 width:9px;
 height:9px;
 border-radius:50%;
 background-color:#ea9d2d;
 opacity:1;
 transform:rotate(346.23953deg) translate(25%);
 animation:drop-80 3s .46253s;
 top:70%;
 left:50%
}
@keyframes drop-80 {
 1% {
  top:75%;
  left:25%;
  transform:rotate(203.53369deg) translate(25%)
 }
 50% {
  top:44%;
  opacity:.7
 }
 80% {
  top:100%;
  left:17%;
  transform:rotate(273.00805deg) translate(25%);
  opacity:0
 }
}
.confetti-81 {
 width:4px;
 height:1.6px;
 border-radius:"";
 background-color:#15dde5;
 opacity:1;
 transform:rotate(357.98236deg) translate(34%);
 animation:drop-81 3s .98423s;
 top:70%;
 left:50%
}
@keyframes drop-81 {
 1% {
  top:75%;
  left:66%;
  transform:rotate(90.36935deg) translate(34%)
 }
 50% {
  top:30%;
  opacity:.7
 }
 80% {
  top:100%;
  left:84%;
  transform:rotate(114.90503deg) translate(34%);
  opacity:0
 }
}
.confetti-82 {
 width:7px;
 height:7px;
 border-radius:50%;
 background-color:#15dde5;
 opacity:1;
 transform:rotate(245.84057deg) translate(95%);
 animation:drop-82 3s .91034s;
 top:70%;
 left:50%
}
@keyframes drop-82 {
 1% {
  top:75%;
  left:23%;
  transform:rotate(222.02494deg) translate(95%)
 }
 50% {
  top:43%;
  opacity:.7
 }
 80% {
  top:100%;
  left:31%;
  transform:rotate(250.45386deg) translate(95%);
  opacity:0
 }
}
.confetti-83 {
 width:7px;
 height:2.8px;
 border-radius:"";
 background-color:#e374db;
 opacity:.50422;
 transform:rotate(207.7102deg) translate(66%);
 animation:drop-83 3s .46322s;
 top:70%;
 left:50%
}
@keyframes drop-83 {
 1% {
  top:75%;
  left:82%;
  transform:rotate(210.87077deg) translate(66%)
 }
 50% {
  top:10%;
  opacity:.7
 }
 80% {
  top:100%;
  left:63%;
  transform:rotate(185.4577deg) translate(66%);
  opacity:0
 }
}
.confetti-84 {
 width:10px;
 height:10px;
 border-radius:50%;
 background-color:#e374db;
 opacity:.9197;
 transform:rotate(260.10389deg) translate(68%);
 animation:drop-84 3s .87028s;
 top:70%;
 left:50%
}
@keyframes drop-84 {
 1% {
  top:75%;
  left:9%;
  transform:rotate(333.59543deg) translate(68%)
 }
 50% {
  top:4%;
  opacity:.7
 }
 80% {
  top:100%;
  left:26%;
  transform:rotate(199.08038deg) translate(68%);
  opacity:0
 }
}
.confetti-85 {
 width:4px;
 height:1.6px;
 border-radius:"";
 background-color:#ea9d2d;
 opacity:.73519;
 transform:rotate(269.96908deg) translate(25%);
 animation:drop-85 3s .0569s;
 top:70%;
 left:50%
}
@keyframes drop-85 {
 1% {
  top:75%;
  left:69%;
  transform:rotate(72.11939deg) translate(25%)
 }
 50% {
  top:22%;
  opacity:.7
 }
 80% {
  top:100%;
  left:87%;
  transform:rotate(109.27522deg) translate(25%);
  opacity:0
 }
}
.confetti-86 {
 width:5px;
 height:5px;
 border-radius:50%;
 background-color:#15dde5;
 opacity:1;
 transform:rotate(89.91929deg) translate(59%);
 animation:drop-86 3s .21314s;
 top:70%;
 left:50%
}
@keyframes drop-86 {
 1% {
  top:75%;
  left:37%;
  transform:rotate(127.51279deg) translate(59%)
 }
 50% {
  top:1%;
  opacity:.7
 }
 80% {
  top:100%;
  left:29%;
  transform:rotate(54.68478deg) translate(59%);
  opacity:0
 }
}
.confetti-87 {
 width:4px;
 height:1.6px;
 border-radius:"";
 background-color:#e374db;
 opacity:.5779;
 transform:rotate(143.45658deg) translate(83%);
 animation:drop-87 3s .80585s;
 top:70%;
 left:50%
}
@keyframes drop-87 {
 1% {
  top:75%;
  left:87%;
  transform:rotate(164.80862deg) translate(83%)
 }
 50% {
  top:15%;
  opacity:.7
 }
 80% {
  top:100%;
  left:87%;
  transform:rotate(81.2872deg) translate(83%);
  opacity:0
 }
}
.confetti-88 {
 width:10px;
 height:10px;
 border-radius:50%;
 background-color:#e52315;
 opacity:1;
 transform:rotate(200.66323deg) translate(73%);
 animation:drop-88 3s .67662s;
 top:70%;
 left:50%
}
@keyframes drop-88 {
 1% {
  top:75%;
  left:2%;
  transform:rotate(256.83271deg) translate(73%)
 }
 50% {
  top:44%;
  opacity:.7
 }
 80% {
  top:100%;
  left:27%;
  transform:rotate(210.4398deg) translate(73%);
  opacity:0
 }
}
.confetti-89 {
 width:3px;
 height:1.2px;
 border-radius:"";
 background-color:#ea9d2d;
 opacity:1;
 transform:rotate(83.94404deg) translate(27%);
 animation:drop-89 3s .06467s;
 top:70%;
 left:50%
}
@keyframes drop-89 {
 1% {
  top:75%;
  left:61%;
  transform:rotate(55.23368deg) translate(27%)
 }
 50% {
  top:33%;
  opacity:.7
 }
 80% {
  top:100%;
  left:60%;
  transform:rotate(196.81206deg) translate(27%);
  opacity:0
 }
}
.confetti-90 {
 width:3px;
 height:3px;
 border-radius:50%;
 background-color:#02a437;
 opacity:1;
 transform:rotate(209.86852deg) translate(37%);
 animation:drop-90 3s .29948s;
 top:70%;
 left:50%
}
@keyframes drop-90 {
 1% {
  top:75%;
  left:41%;
  transform:rotate(162.39187deg) translate(37%)
 }
 50% {
  top:8%;
  opacity:.7
 }
 80% {
  top:100%;
  left:47%;
  transform:rotate(168.06041deg) translate(37%);
  opacity:0
 }
}
.confetti-91 {
 width:10px;
 height:4px;
 border-radius:"";
 background-color:#15dde5;
 opacity:.71845;
 transform:rotate(221.64415deg) translate(73%);
 animation:drop-91 3s .73619s;
 top:70%;
 left:50%
}
@keyframes drop-91 {
 1% {
  top:75%;
  left:76%;
  transform:rotate(78.66277deg) translate(73%)
 }
 50% {
  top:32%;
  opacity:.7
 }
 80% {
  top:100%;
  left:92%;
  transform:rotate(232.86253deg) translate(73%);
  opacity:0
 }
}
.confetti-92 {
 width:2px;
 height:2px;
 border-radius:50%;
 background-color:#e52315;
 opacity:.99236;
 transform:rotate(135.32258deg) translate(76%);
 animation:drop-92 3s .03358s;
 top:70%;
 left:50%
}
@keyframes drop-92 {
 1% {
  top:75%;
  left:3%;
  transform:rotate(.814406turn) translate(76%)
 }
 50% {
  top:43%;
  opacity:.7
 }
 80% {
  top:100%;
  left:35%;
  transform:rotate(354.1196deg) translate(76%);
  opacity:0
 }
}
.confetti-93 {
 width:6px;
 height:2.4px;
 border-radius:"";
 background-color:#e52315;
 opacity:1;
 transform:rotate(223.56502deg) translate(27%);
 animation:drop-93 3s .32453s;
 top:70%;
 left:50%
}
@keyframes drop-93 {
 1% {
  top:75%;
  left:57%;
  transform:rotate(333.41295deg) translate(27%)
 }
 50% {
  top:42%;
  opacity:.7
 }
 80% {
  top:100%;
  left:66%;
  transform:rotate(92.9863deg) translate(27%);
  opacity:0
 }
}
.confetti-94 {
 width:10px;
 height:10px;
 border-radius:50%;
 background-color:#e374db;
 opacity:1;
 transform:rotate(322.79928deg) translate(84%);
 animation:drop-94 3s .90681s;
 top:70%;
 left:50%
}
@keyframes drop-94 {
 1% {
  top:75%;
  left:2%;
  transform:rotate(277.17243deg) translate(84%)
 }
 50% {
  top:2%;
  opacity:.7
 }
 80% {
  top:100%;
  left:49%;
  transform:rotate(217.55654deg) translate(84%);
  opacity:0
 }
}
.confetti-95 {
 width:3px;
 height:1.2px;
 border-radius:"";
 background-color:#ea9d2d;
 opacity:1;
 transform:rotate(68.28864deg) translate(92%);
 animation:drop-95 3s .01452s;
 top:70%;
 left:50%
}
@keyframes drop-95 {
 1% {
  top:75%;
  left:56%;
  transform:rotate(36.46412deg) translate(92%)
 }
 50% {
  top:28%;
  opacity:.7
 }
 80% {
  top:100%;
  left:53%;
  transform:rotate(26.97029deg) translate(92%);
  opacity:0
 }
}
.confetti-96 {
 width:9px;
 height:9px;
 border-radius:50%;
 background-color:#e374db;
 opacity:.78925;
 transform:rotate(279.45671deg) translate(1%);
 animation:drop-96 3s .73266s;
 top:70%;
 left:50%
}
@keyframes drop-96 {
 1% {
  top:75%;
  left:4%;
  transform:rotate(233.4169deg) translate(1%)
 }
 50% {
  top:11%;
  opacity:.7
 }
 80% {
  top:100%;
  left:36%;
  transform:rotate(291.60773deg) translate(1%);
  opacity:0
 }
}
.confetti-97 {
 width:4px;
 height:1.6px;
 border-radius:"";
 background-color:#02a437;
 opacity:.52293;
 transform:rotate(131.74388deg) translate(8%);
 animation:drop-97 3s .02838s;
 top:70%;
 left:50%
}
@keyframes drop-97 {
 1% {
  top:75%;
  left:85%;
  transform:rotate(181.94475deg) translate(8%)
 }
 50% {
  top:23%;
  opacity:.7
 }
 80% {
  top:100%;
  left:75%;
  transform:rotate(239.70136deg) translate(8%);
  opacity:0
 }
}
.confetti-98 {
 width:9px;
 height:9px;
 border-radius:50%;
 background-color:#e374db;
 opacity:1;
 transform:rotate(94.03052deg) translate(21%);
 animation:drop-98 3s .7131s;
 top:70%;
 left:50%
}
@keyframes drop-98 {
 1% {
  top:75%;
  left:28%;
  transform:rotate(60.21919deg) translate(21%)
 }
 50% {
  top:43%;
  opacity:.7
 }
 80% {
  top:100%;
  left:21%;
  transform:rotate(60.25954deg) translate(21%);
  opacity:0
 }
}
.confetti-99 {
 width:10px;
 height:4px;
 border-radius:"";
 background-color:#e374db;
 opacity:.73228;
 transform:rotate(270.02332deg) translate(1%);
 animation:drop-99 3s .3686s;
 top:70%;
 left:50%
}
@keyframes drop-99 {
 1% {
  top:75%;
  left:84%;
  transform:rotate(51.12381deg) translate(1%)
 }
 50% {
  top:33%;
  opacity:.7
 }
 80% {
  top:100%;
  left:56%;
  transform:rotate(151.62664deg) translate(1%);
  opacity:0
 }
}
.confetti-100 {
 width:5px;
 height:5px;
 border-radius:50%;
 background-color:#15dde5;
 opacity:1;
 transform:rotate(94.31176deg) translate(80%);
 animation:drop-100 3s .68827s;
 top:70%;
 left:50%
}
@keyframes drop-100 {
 1% {
  top:75%;
  left:15%;
  transform:rotate(262.49871deg) translate(80%)
 }
 50% {
  top:40%;
  opacity:.7
 }
 80% {
  top:100%;
  left:11%;
  transform:rotate(64.35135deg) translate(80%);
  opacity:0
 }
}
.confetti-101 {
 width:8px;
 height:3.2px;
 border-radius:"";
 background-color:#ea9d2d;
 opacity:1;
 transform:rotate(139.10246deg) translate(59%);
 animation:drop-101 3s .80682s;
 top:70%;
 left:50%
}
@keyframes drop-101 {
 1% {
  top:75%;
  left:61%;
  transform:rotate(6.83168deg) translate(59%)
 }
 50% {
  top:28%;
  opacity:.7
 }
 80% {
  top:100%;
  left:83%;
  transform:rotate(197.99876deg) translate(59%);
  opacity:0
 }
}
.confetti-102 {
 width:7px;
 height:7px;
 border-radius:50%;
 background-color:#e374db;
 opacity:.62877;
 transform:rotate(276.36817deg) translate(17%);
 animation:drop-102 3s .85456s;
 top:70%;
 left:50%
}
@keyframes drop-102 {
 1% {
  top:75%;
  left:28%;
  transform:rotate(336.08929deg) translate(17%)
 }
 50% {
  top:23%;
  opacity:.7
 }
 80% {
  top:100%;
  left:32%;
  transform:rotate(167.02484deg) translate(17%);
  opacity:0
 }
}
.confetti-103 {
 width:9px;
 height:3.6px;
 border-radius:"";
 background-color:#15dde5;
 opacity:1;
 transform:rotate(139.14707deg) translate(29%);
 animation:drop-103 3s .57303s;
 top:70%;
 left:50%
}
@keyframes drop-103 {
 1% {
  top:75%;
  left:53%;
  transform:rotate(188.469deg) translate(29%)
 }
 50% {
  top:35%;
  opacity:.7
 }
 80% {
  top:100%;
  left:85%;
  transform:rotate(68.65734deg) translate(29%);
  opacity:0
 }
}
.confetti-104 {
 width:6px;
 height:6px;
 border-radius:50%;
 background-color:#15dde5;
 opacity:.62718;
 transform:rotate(166.38098deg) translate(6%);
 animation:drop-104 3s .40887s;
 top:70%;
 left:50%
}
@keyframes drop-104 {
 1% {
  top:75%;
  left:1%;
  transform:rotate(341.14519deg) translate(6%)
 }
 50% {
  top:43%;
  opacity:.7
 }
 80% {
  top:100%;
  left:21%;
  transform:rotate(319.35782deg) translate(6%);
  opacity:0
 }
}
.confetti-105 {
 width:10px;
 height:4px;
 border-radius:"";
 background-color:#ea9d2d;
 opacity:1;
 transform:rotate(358.84069deg) translate(76%);
 animation:drop-105 3s .69379s;
 top:70%;
 left:50%
}
@keyframes drop-105 {
 1% {
  top:75%;
  left:53%;
  transform:rotate(152.85491deg) translate(76%)
 }
 50% {
  top:28%;
  opacity:.7
 }
 80% {
  top:100%;
  left:56%;
  transform:rotate(337.38339deg) translate(76%);
  opacity:0
 }
}
.confetti-106 {
 width:1px;
 height:1px;
 border-radius:50%;
 background-color:#15dde5;
 opacity:1;
 transform:rotate(287.11837deg) translate(56%);
 animation:drop-106 3s .69975s;
 top:70%;
 left:50%
}
@keyframes drop-106 {
 1% {
  top:75%;
  left:7%;
  transform:rotate(42.14263deg) translate(56%)
 }
 50% {
  top:25%;
  opacity:.7
 }
 80% {
  top:100%;
  left:49%;
  transform:rotate(293.47587deg) translate(56%);
  opacity:0
 }
}
.confetti-107 {
 width:2px;
 height:.8px;
 border-radius:"";
 background-color:#15dde5;
 opacity:1;
 transform:rotate(71.14294deg) translate(51%);
 animation:drop-107 3s .1541s;
 top:70%;
 left:50%
}
@keyframes drop-107 {
 1% {
  top:75%;
  left:94%;
  transform:rotate(324.85543deg) translate(51%)
 }
 50% {
  top:43%;
  opacity:.7
 }
 80% {
  top:100%;
  left:67%;
  transform:rotate(115.39491deg) translate(51%);
  opacity:0
 }
}
.confetti-108 {
 width:10px;
 height:10px;
 border-radius:50%;
 background-color:#15dde5;
 opacity:1;
 transform:rotate(20.85483deg) translate(28%);
 animation:drop-108 3s .55839s;
 top:70%;
 left:50%
}
@keyframes drop-108 {
 1% {
  top:75%;
  left:48%;
  transform:rotate(172.36498deg) translate(28%)
 }
 50% {
  top:29%;
  opacity:.7
 }
 80% {
  top:100%;
  left:32%;
  transform:rotate(358.60938deg) translate(28%);
  opacity:0
 }
}
.confetti-109 {
 width:2px;
 height:.8px;
 border-radius:"";
 background-color:#e374db;
 opacity:.82745;
 transform:rotate(27.83743deg) translate(81%);
 animation:drop-109 3s .34091s;
 top:70%;
 left:50%
}
@keyframes drop-109 {
 1% {
  top:75%;
  left:97%;
  transform:rotate(164.30248deg) translate(81%)
 }
 50% {
  top:5%;
  opacity:.7
 }
 80% {
  top:100%;
  left:74%;
  transform:rotate(224.49644deg) translate(81%);
  opacity:0
 }
}
.confetti-110 {
 width:10px;
 height:10px;
 border-radius:50%;
 background-color:#e52315;
 opacity:1;
 transform:rotate(331.92155deg) translate(84%);
 animation:drop-110 3s .94036s;
 top:70%;
 left:50%
}
@keyframes drop-110 {
 1% {
  top:75%;
  left:23%;
  transform:rotate(253.24968deg) translate(84%)
 }
 50% {
  top:22%;
  opacity:.7
 }
 80% {
  top:100%;
  left:22%;
  transform:rotate(233.37053deg) translate(84%);
  opacity:0
 }
}
.confetti-111 {
 width:6px;
 height:2.4px;
 border-radius:"";
 background-color:#e52315;
 opacity:.73027;
 transform:rotate(313.27189deg) translate(38%);
 animation:drop-111 3s .34752s;
 top:70%;
 left:50%
}
@keyframes drop-111 {
 1% {
  top:75%;
  left:81%;
  transform:rotate(257.15038deg) translate(38%)
 }
 50% {
  top:42%;
  opacity:.7
 }
 80% {
  top:100%;
  left:68%;
  transform:rotate(358.58918deg) translate(38%);
  opacity:0
 }
}
.confetti-112 {
 width:4px;
 height:4px;
 border-radius:50%;
 background-color:#15dde5;
 opacity:1;
 transform:rotate(56.23986deg) translate(1%);
 animation:drop-112 3s .70883s;
 top:70%;
 left:50%
}
@keyframes drop-112 {
 1% {
  top:75%;
  left:13%;
  transform:rotate(187.68513deg) translate(1%)
 }
 50% {
  top:2%;
  opacity:.7
 }
 80% {
  top:100%;
  left:3%;
  transform:rotate(226.78376deg) translate(1%);
  opacity:0
 }
}
.confetti-113 {
 width:3px;
 height:1.2px;
 border-radius:"";
 background-color:#02a437;
 opacity:.93851;
 transform:rotate(31.10847deg) translate(12%);
 animation:drop-113 3s .8687s;
 top:70%;
 left:50%
}
@keyframes drop-113 {
 1% {
  top:75%;
  left:66%;
  transform:rotate(100.09567deg) translate(12%)
 }
 50% {
  top:16%;
  opacity:.7
 }
 80% {
  top:100%;
  left:83%;
  transform:rotate(355.85386deg) translate(12%);
  opacity:0
 }
}
.confetti-114 {
 width:7px;
 height:7px;
 border-radius:50%;
 background-color:#15dde5;
 opacity:.81895;
 transform:rotate(190.04348deg) translate(4%);
 animation:drop-114 3s .33996s;
 top:70%;
 left:50%
}
@keyframes drop-114 {
 1% {
  top:75%;
  left:49%;
  transform:rotate(34.93324deg) translate(4%)
 }
 50% {
  top:27%;
  opacity:.7
 }
 80% {
  top:100%;
  left:7%;
  transform:rotate(302.08821deg) translate(4%);
  opacity:0
 }
}
.confetti-115 {
 width:7px;
 height:2.8px;
 border-radius:"";
 background-color:#e374db;
 opacity:1;
 transform:rotate(193.84635deg) translate(42%);
 animation:drop-115 3s .40423s;
 top:70%;
 left:50%
}
@keyframes drop-115 {
 1% {
  top:75%;
  left:82%;
  transform:rotate(348.16337deg) translate(42%)
 }
 50% {
  top:36%;
  opacity:.7
 }
 80% {
  top:100%;
  left:63%;
  transform:rotate(196.75083deg) translate(42%);
  opacity:0
 }
}
.confetti-116 {
 width:5px;
 height:5px;
 border-radius:50%;
 background-color:#02a437;
 opacity:.87315;
 transform:rotate(70.98481deg) translate(77%);
 animation:drop-116 3s .91428s;
 top:70%;
 left:50%
}
@keyframes drop-116 {
 1% {
  top:75%;
  left:4%;
  transform:rotate(136.02357deg) translate(77%)
 }
 50% {
  top:29%;
  opacity:.7
 }
 80% {
  top:100%;
  left:24%;
  transform:rotate(298.71781deg) translate(77%);
  opacity:0
 }
}
.confetti-117 {
 width:2px;
 height:.8px;
 border-radius:"";
 background-color:#15dde5;
 opacity:.54143;
 transform:rotate(222.54904deg) translate(14%);
 animation:drop-117 3s .23908s;
 top:70%;
 left:50%
}
@keyframes drop-117 {
 1% {
  top:75%;
  left:72%;
  transform:rotate(63.0619deg) translate(14%)
 }
 50% {
  top:30%;
  opacity:.7
 }
 80% {
  top:100%;
  left:80%;
  transform:rotate(300.38638deg) translate(14%);
  opacity:0
 }
}
.confetti-118 {
 width:9px;
 height:9px;
 border-radius:50%;
 background-color:#15dde5;
 opacity:1;
 transform:rotate(341.89864deg) translate(88%);
 animation:drop-118 3s .82733s;
 top:70%;
 left:50%
}
@keyframes drop-118 {
 1% {
  top:75%;
  left:23%;
  transform:rotate(308.68356deg) translate(88%)
 }
 50% {
  top:23%;
  opacity:.7
 }
 80% {
  top:100%;
  left:3%;
  transform:rotate(.480359turn) translate(88%);
  opacity:0
 }
}
.confetti-119 {
 width:1px;
 height:.4px;
 border-radius:"";
 background-color:#02a437;
 opacity:1;
 transform:rotate(333.19118deg) translate(11%);
 animation:drop-119 3s .58631s;
 top:70%;
 left:50%
}
@keyframes drop-119 {
 1% {
  top:75%;
  left:64%;
  transform:rotate(254.59988deg) translate(11%)
 }
 50% {
  top:15%;
  opacity:.7
 }
 80% {
  top:100%;
  left:52%;
  transform:rotate(256.93432deg) translate(11%);
  opacity:0
 }
}
.confetti-120 {
 width:8px;
 height:8px;
 border-radius:50%;
 background-color:#ea9d2d;
 opacity:1;
 transform:rotate(131.30255deg) translate(43%);
 animation:drop-120 3s .77965s;
 top:70%;
 left:50%
}
@keyframes drop-120 {
 1% {
  top:75%;
  left:8%;
  transform:rotate(209.99128deg) translate(43%)
 }
 50% {
  top:5%;
  opacity:.7
 }
 80% {
  top:100%;
  left:12%;
  transform:rotate(242.00977deg) translate(43%);
  opacity:0
 }
}
@media only screen and (min-width:1024px) {
 .containerAnim {
  left:24%
 }
 .greatChoice {
  width:370px;
  bottom:40%
 }
 .animBlock {
  width:370px;
  left:23%;
  bottom:35%
 }
}
.dobChangePopWrapper {
 position:fixed;
 left:0;
 right:0;
 top:0;
 bottom:0;
 z-index:99;
 cursor:default
}
.dobChangePopWrapper:before {
 content:"";
 position:fixed;
 left:0;
 right:0;
 top:0;
 bottom:0;
 z-index:1;
 background:rgba(23,43,77,.9);
 height:100vh
}
.dobChangePopWrapper .popupBlock {
 position:absolute;
 max-height:90%;
 background:#fff;
 border-radius:10px 10px 0 0;
 padding:0;
 bottom:0;
 width:100%;
 z-index:2
}
.dobChangePopWrapper .popupBlock .innerBlockContainer {
 display:flex;
 flex-flow:column wrap;
 justify-content:space-between
}
.dobChangePopWrapper .popupBlock .innerBlockContainer .popContent {
 max-height:calc(90vh - 360px);
 overflow-y:auto;
 text-align:left;
 padding:0 16px
}
.dobChangePopWrapper .popupBlock .innerBlockContainer .popContent>div:first-child {
 margin-top:0
}
.dobChangePopWrapper .popupBlock .innerBlockContainer .popHeader {
 padding:16px
}
.dobChangePopWrapper .popupBlock .close_box {
 width:20px;
 height:20px;
 position:absolute;
 cursor:pointer;
 right:16px;
 top:16px
}
.dobChangePopWrapper .popupBlock .close_box:before {
 transform:translateX(-50%) rotate(45deg)
}
.dobChangePopWrapper .popupBlock .close_box:after,
.dobChangePopWrapper .popupBlock .close_box:before {
 content:"";
 width:2px;
 height:100%;
 display:block;
 background:#253858;
 border-radius:2px;
 position:absolute;
 left:50%
}
.dobChangePopWrapper .popupBlock .close_box:after {
 transform:translateX(-50%) rotate(-45deg)
}
.dobChangePopWrapper .popupBlock .popHeading {
 font-size:16px;
 font-weight:700;
 color:#de350b;
 padding-right:32px;
 margin-bottom:8px;
 text-align:left
}
@media screen and (max-width:420px) {
 .dobChangePopWrapper .popupBlock .popHeading {
  font-size:4.5vw
 }
}
.dobChangePopWrapper .popupBlock .pop_subTxt {
 color:#505f79;
 font-size:14px;
 font-weight:400;
 line-height:21px;
 text-align:left
}
@media screen and (max-width:420px) {
 .dobChangePopWrapper .popupBlock .pop_subTxt {
  font-size:3.8vw
 }
}
.dobChangePopWrapper .popupBlock .popContent .memName {
 font-size:16px;
 font-weight:700;
 color:#253858;
 margin-bottom:8px
}
@media screen and (max-width:420px) {
 .dobChangePopWrapper .popupBlock .popContent .memName {
  font-size:4.5vw
 }
}
.dobChangePopWrapper .popupBlock .popContent .col_block {
 width:50%;
 font-size:16px;
 font-weight:600;
 color:#253858
}
@media screen and (max-width:420px) {
 .dobChangePopWrapper .popupBlock .popContent .col_block {
  font-size:4.5vw
 }
}
.dobChangePopWrapper .popupBlock .popContent .col_block p {
 padding:0;
 font-size:12px;
 color:#253858;
 margin:0 0 4px;
 font-weight:400;
 text-align:left
}
@media screen and (max-width:420px) {
 .dobChangePopWrapper .popupBlock .popContent .col_block p {
  font-size:3.2vw
 }
}
.dobChangePopWrapper .popupBlock .popContent .col_block span.oldAmount {
 color:#505f79
}
.dobChangePopWrapper .popupBlock .popContent .col_block span.newAmount {
 color:#253858;
 font-size:16px;
 font-weight:700
}
@media screen and (max-width:420px) {
 .dobChangePopWrapper .popupBlock .popContent .col_block span.newAmount {
  font-size:4.5vw
 }
}
.dobChangePopWrapper .popupBlock .popContent .premiumRow {
 padding:16px 0
}
.dobChangePopWrapper .popupBlock .popContent .col_plan_block {
 width:83px;
 margin-right:12px
}
.dobChangePopWrapper .popupBlock .popContent .col_plan_block img {
 height:auto;
 max-width:100%
}
.dobChangePopWrapper .popupBlock .popContent .col_planName_block {
 width:calc(100% - 106px);
 font-size:14px;
 font-weight:700;
 color:#253858;
 line-height:21px
}
@media screen and (max-width:420px) {
 .dobChangePopWrapper .popupBlock .popContent .col_planName_block {
  font-size:3.8vw
 }
}
.dobChangePopWrapper .popupBlock .popContent .block_dob_revised {
 margin:20px 0 0;
 border:solid #dfe1e6;
 border-width:0 0 1px
}
.dobChangePopWrapper .popupBlock .popContent::-webkit-scrollbar-track {
 border-radius:4px;
 background-color:#f1f1f1
}
.dobChangePopWrapper .popupBlock .popContent::-webkit-scrollbar {
 width:6px;
 background-color:#f0eeee
}
.dobChangePopWrapper .popupBlock .popContent::-webkit-scrollbar-thumb {
 border-radius:4px;
 background-color:#b3bac5
}
.dobChangePopWrapper .popupBlock .popContent .member_sp_dob {
 margin-top:20px
}
.dobChangePopWrapper .popupBlock .two_col_row {
 display:flex;
 align-items:center;
 justify-content:space-between
}
.dobChangePopWrapper .popupBlock .btn {
 width:100%;
 height:48px;
 border-radius:4px;
 -webkit-appearance:none;
 cursor:pointer;
 font-size:16px;
 font-weight:600;
 background:transparent;
 margin-top:10px;
 border:none;
 color:#fff;
 background:#ff5630;
 outline:none
}
@media screen and (max-width:420px) {
 .dobChangePopWrapper .popupBlock .btn {
  font-size:4.5vw
 }
}
.dobChangePopWrapper .popupBlock .total_premium_dob {
 background:#f4f5f7;
 margin:0 -16px 10px;
 height:56px;
 padding:0 16px;
 font-size:16px;
 color:#5e6c84
}
@media screen and (max-width:420px) {
 .dobChangePopWrapper .popupBlock .total_premium_dob {
  font-size:4.5vw
 }
}
.dobChangePopWrapper .popupBlock .total_premium_dob .strike_premium {
 font-size:14px;
 text-decoration:line-through
}
@media screen and (max-width:420px) {
 .dobChangePopWrapper .popupBlock .total_premium_dob .strike_premium {
  font-size:3.8vw
 }
}
.dobChangePopWrapper .popupBlock .total_premium_dob .grand_premium {
 font-size:16px;
 font-weight:700;
 color:#253858;
 margin-left:10px
}
@media screen and (max-width:420px) {
 .dobChangePopWrapper .popupBlock .total_premium_dob .grand_premium {
  font-size:4.5vw
 }
}
.dobChangePopWrapper .popupBlock .bottom_fixed {
 padding:16px;
 background:#fff
}
.body-fixed {
 overflow:hidden;
 position:fixed;
 width:100%
}
.linkviewDob {
 color:#ff5630;
 font-size:16px;
 font-weight:600;
 text-align:center;
 cursor:pointer
}
@media screen and (max-width:420px) {
 .linkviewDob {
  font-size:4.5vw
 }
}
.linkviewDob:focus,
.linkviewDob:hover {
 color:#ff5630;
 outline:none
}
.rowviewBox {
 justify-content:center!important;
 margin:20px 0 0
}
@media screen and (min-width:1024px) {
 .dobChangePopWrapper .popupBlock {
  width:450px;
  right:0;
  max-height:100%;
  top:0;
  position:fixed;
  background-color:#fff;
  border-radius:0
 }
 .dobChangePopWrapper .popupBlock .bottom_fixed {
  width:450px
 }
 .dobChangePopWrapper .popupBlock .popHeader {
  padding:0!important
 }
 .dobChangePopWrapper .popupBlock .popHeading {
  box-shadow:0 3px 2px 0 rgba(0,0,0,.1);
  height:56px;
  padding:0 16px;
  width:100%;
  background:#fff;
  display:flex;
  align-items:center
 }
 .dobChangePopWrapper .popupBlock .close_box {
  top:18px
 }
 .dobChangePopWrapper .popupBlock .innerBlockContainer {
  height:100vh
 }
 .dobChangePopWrapper .popupBlock .popContent {
  height:calc(100vh - 340px)!important;
  margin-right:0!important;
  max-height:inherit!important
 }
 .dobChangePopWrapper .popupBlock .pop_subTxt {
  text-align:left;
  padding:16px
 }
}
.proposalSection {
 padding:0 16px 24px
}
.proposalSection>article {
 margin-top:40px
}
.proposalSection .pageHead {
 font-size:20px;
 font-weight:700;
 line-height:1.5;
 margin-bottom:4px
}
@media screen and (max-width:420px) {
 .proposalSection .pageHead {
  font-size:5.6vw
 }
}
.proposalSection .pageSubhead {
 font-size:16px;
 color:#505f79;
 line-height:1.5;
 margin-bottom:30px;
 font-weight:600
}
@media screen and (max-width:420px) {
 .proposalSection .pageSubhead {
  font-size:4.5vw
 }
}
.proposalSection .sectionHead {
 font-size:16px;
 font-weight:700;
 line-height:1.5;
 margin-bottom:4px
}
@media screen and (max-width:420px) {
 .proposalSection .sectionHead {
  font-size:4.5vw
 }
}
.proposalSection .sectionHead ul {
 margin-left:20px
}
.proposalSection .sectionHead ul li {
 list-style:disc;
 padding:4px 0;
 font-weight:400
}
.proposalSection .sectionHead .memberHead {
 font-size:16px;
 font-weight:600
}
@media screen and (max-width:420px) {
 .proposalSection .sectionHead .memberHead {
  font-size:4.5vw
 }
}
.proposalSection .sectionHead .memberSubHead {
 font-size:14px;
 font-weight:600;
 color:#505f79;
 margin-top:4px
}
@media screen and (max-width:420px) {
 .proposalSection .sectionHead .memberSubHead {
  font-size:3.8vw
 }
}
.proposalSection .sectionHead .memberDiseaseBlock {
 margin-top:20px
}
.proposalSection .sectionHead .otherTxtBox {
 transition:all .3s ease-out;
 margin-top:20px;
 display:none;
 animation:showDiseaseTxtBox .3s ease-out forwards
}
.proposalSection .sectionHead .otherTxtBox .fieldBlockProposal {
 margin-top:12px
}
.proposalSection .sectionHead .otherTxtBox.showBox,
.proposalSection .sectionHead.showBox {
 display:block
}
.proposalSection .sectionSubhead {
 font-size:14px;
 font-weight:400;
 color:#505f79;
 margin-bottom:32px
}
@media screen and (max-width:420px) {
 .proposalSection .sectionSubhead {
  font-size:3.8vw
 }
}
.proposalSection .fieldTitle {
 font-size:14px;
 font-weight:600;
 color:#505f79
}
@media screen and (max-width:420px) {
 .proposalSection .fieldTitle {
  font-size:3.8vw
 }
}
.questionTitle {
 font-size:16px;
 font-weight:600;
 color:#253858;
 word-break:break-word
}
@media screen and (max-width:420px) {
 .questionTitle {
  font-size:4.5vw
 }
}
.questionTitle:first-letter {
 text-transform:uppercase
}
.questionTitle__hint {
 font-size:14px;
 font-weight:400;
 color:#505f79;
 margin-top:4px
}
@media screen and (max-width:420px) {
 .questionTitle__hint {
  font-size:3.8vw
 }
}
.questionTitle__hint:first-letter {
 text-transform:uppercase
}
.btn {
 transition:all .3s ease-out;
 position:relative
}
.mb-32 {
 margin-bottom:32px!important
}
.tncAnim {
 animation:tnc-anim 1s cubic-bezier(.36,.07,.19,.97)
}
@keyframes tnc-anim {
 10%,
 90% {
  transform:translate3d(-1px,0,0)
 }
 20%,
 80% {
  transform:translate3d(2px,0,0)
 }
 30%,
 50%,
 70% {
  transform:translate3d(-4px,0,0)
 }
 40%,
 60% {
  transform:translate3d(4px,0,0)
 }
}
@keyframes showDiseaseTxtBox {
 0% {
  transform:translateY(30%)
 }
 to {
  transform:translateY(0)
 }
}
.fieldBlockProposal {
 margin-top:20px
}
.fieldBlockProposal .field {
 position:relative;
 margin-bottom:0
}
.fieldBlockProposal .field input,
.fieldBlockProposal .field textarea {
 width:100%;
 -webkit-appearance:none;
 outline:none;
 height:100%;
 font-size:16px;
 color:#253858;
 padding:16px;
 font-weight:400;
 background:#fff;
 border:1px solid #5e6c84;
 border-radius:4px;
 height:56px
}
@media screen and (max-width:420px) {
 .fieldBlockProposal .field input,
 .fieldBlockProposal .field textarea {
  font-size:4.5vw
 }
}
.fieldBlockProposal .field label {
 transition:all .3s ease-in;
 position:absolute;
 left:8px;
 padding:0 8px;
 background:#fff;
 background:linear-gradient(180deg,hsla(0,0%,100%,0),hsla(0,0%,100%,0) 50%,#fff 0,#fff);
 font-size:12px;
 transform:none;
 top:-10px;
 color:#253858;
 max-width:calc(100% - 10px)
}
@media screen and (max-width:420px) {
 .fieldBlockProposal .field label {
  font-size:3.2vw
 }
}
.fieldBlockProposal .field label.nonHoverClass {
 font-size:16px;
 color:#5e6c84;
 top:50%;
 transform:translateY(-50%)
}
@media screen and (max-width:420px) {
 .fieldBlockProposal .field label.nonHoverClass {
  font-size:4.5vw
 }
}
.fieldBlockProposal .field textarea {
 font-family:-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Oxygen-Sans,Ubuntu,Cantarell,Helvetica Neue,sans-serif;
 height:100px
}
.fieldBlockProposal .field textarea+label.nonHoverClass {
 transform:none;
 top:8px
}
.fieldBlockProposal .field input[disabled],
.fieldBlockProposal .field select[disabled],
.fieldBlockProposal .field textarea[disabled] {
 -webkit-text-fill-color:currentcolor!important;
 opacity:1!important;
 color:#7a869a;
 -webkit-opacity:1!important;
 cursor:not-allowed
}
.fieldBlockProposal .field input:disabled,
.fieldBlockProposal .field select:disabled {
 border:1px solid #97a0af;
 color:#7a869a;
 font-weight:400;
 opacity:1!important
}
.fieldBlockProposal .field input:focus,
.fieldBlockProposal .field select:focus {
 border:1px solid #253858
}
.fieldBlockProposal .field input:disabled+label,
.fieldBlockProposal .field select:disabled+label {
 color:#7a869a
}
.fieldBlockProposal .errorHighlighter {
 border:1px solid #ff5630!important
}
.fieldBlockProposal .errorPage {
 font-size:12px;
 color:#ff5630;
 position:relative;
 padding-left:22px;
 margin-top:10px;
 display:block
}
@media screen and (max-width:420px) {
 .fieldBlockProposal .errorPage {
  font-size:3.2vw
 }
}
.fieldBlockProposal .errorPage:after {
 content:"!";
 width:16px;
 height:16px;
 background:#ff5630;
 border-radius:30px;
 position:absolute;
 top:0;
 left:0;
 color:#fff;
 text-align:center;
 font-size:12px;
 font-weight:700;
 line-height:18px
}
.errorHighlighter {
 border:1px solid #ff5630!important
}
.errorPage {
 font-size:12px;
 color:#ff5630;
 position:relative;
 padding-left:22px;
 margin-top:10px;
 display:block
}
@media screen and (max-width:420px) {
 .errorPage {
  font-size:3.2vw
 }
}
.errorPage:after {
 content:"!";
 width:16px;
 height:16px;
 background:#ff5630;
 border-radius:30px;
 position:absolute;
 top:0;
 left:0;
 color:#fff;
 text-align:center;
 font-size:12px;
 font-weight:700;
 line-height:18px
}
.select_proposal .field {
 background:#fff
}
.select_proposal .field:after {
 content:"";
 border:solid #253858;
 border-width:0 2px 2px 0;
 display:inline-block;
 padding:3px;
 transform:rotate(45deg) translateY(-50%);
 position:absolute;
 right:18px;
 top:50%;
 margin-top:-3px
}
.select_proposal .field select {
 width:100%;
 -webkit-appearance:none;
 outline:none;
 height:100%;
 font-size:16px;
 color:#253858;
 padding:16px 46px 16px 16px;
 font-weight:400;
 position:relative;
 background:transparent;
 border:1px solid #5e6c84;
 border-radius:4px;
 height:56px;
 text-transform:capitalize;
 z-index:2
}
@media screen and (max-width:420px) {
 .select_proposal .field select {
  font-size:4.5vw
 }
}
.select_proposal .field select option {
 text-transform:capitalize
}
.select_proposal .field select+label {
 z-index:2
}
.select_proposal .field select+label.nonHoverClass {
 z-index:1;
 background:transparent
}
.field[disabled]:after {
 border-color:#97a0af
}
.fieldBlockHeight .flexRow {
 justify-content:space-between
}
.fieldBlockHeight .fieldBlockProposal {
 width:calc(50% - 8px);
 margin-top:0
}
@media only screen and (min-width:1024px) {
 .fieldBlockHeight {
  width:48%;
  display:inline-block
 }
 .fieldBlockHeight .flexRow {
  width:100%
 }
 .fieldBlockHeight .flexRow .fieldBlockProposal {
  width:calc(50% - 8px)
 }
}
.optionsModule {
 margin-bottom:0;
 position:relative;
 margin-top:16px
}
.optionsModule input {
 position:absolute;
 opacity:0;
 visibility:hidden
}
.optionsModule input+label {
 width:100%;
 height:48px;
 border:1px solid #253858;
 border-radius:4px;
 padding:0 16px!important;
 font-size:16px;
 font-weight:400;
 color:#253858;
 display:flex;
 transition:none!important;
 text-overflow:ellipsis;
 white-space:nowrap;
 overflow:hidden;
 text-transform:capitalize;
 align-items:center;
 background:#fff
}
.optionsModule input+label:after {
 content:"";
 width:18px;
 height:9px;
 border:solid #36b37e;
 border-width:0 0 2px 2px;
 position:absolute;
 right:20px;
 top:19px;
 transform:rotate(-45deg);
 opacity:0;
 transition:opacity .3s ease-in
}
.optionsModule input+label span {
 font-size:12px;
 font-weight:600;
 color:#7a869a;
 margin-left:10px;
 text-align:left;
 position:relative;
 top:1px
}
@media screen and (max-width:420px) {
 .optionsModule input+label span {
  font-size:3.2vw
 }
}
.optionsModule input:checked+label {
 border-color:#36b37e;
 background:#f2fffa;
 color:#36b37e
}
.optionsModule input:checked+label:after {
 opacity:1
}
.optionsModule input:disabled+label {
 border:1px solid #b3bac5;
 color:#5e6c84;
 font-weight:400;
 cursor:not-allowed
}
.optionsModule .InputLabelBox {
 text-overflow:ellipsis;
 white-space:nowrap;
 overflow:hidden;
 max-width:50%
}
.statusOptions .optionsModule .InputLabelBox {
 max-width:100%
}
.radios {
 position:relative
}
.radios>input[type=radio] {
 outline:none;
 width:18px;
 height:18px;
 border-radius:50%;
 background-color:#fff;
 border:1px solid #5e6c84;
 vertical-align:middle;
 position:absolute;
 top:3px;
 left:0;
 -webkit-appearance:none;
 cursor:pointer
}
.radios>input[type=radio]+label {
 padding-left:30px;
 display:block;
 width:100%;
 cursor:pointer
}
.radios>input[type=radio]+label .radioLabel {
 font-size:16px;
 color:#253858;
 font-weight:600
}
@media screen and (max-width:420px) {
 .radios>input[type=radio]+label .radioLabel {
  font-size:4.5vw
 }
}
.radios>input[type=radio]:checked {
 background-color:#fff;
 border-color:#36b37e
}
.radios>input[type=radio]:checked:before {
 content:"";
 display:block;
 width:10px;
 height:10px;
 background:#36b37e
}
.subQuestionCheckBoxWrap {
 padding-left:30px
}
.subQuestionCheckBox {
 position:relative;
 margin-left:-30px
}
.subQuestionCheckBox>input[type=checkbox] {
 outline:none;
 width:18px;
 height:18px;
 border-radius:4px;
 background-color:#fff;
 border:1px solid #5e6c84;
 vertical-align:middle;
 position:absolute;
 top:5px;
 left:0;
 -webkit-appearance:none;
 cursor:pointer
}
.subQuestionCheckBox>input[type=checkbox]+label {
 padding-left:30px;
 display:block;
 width:100%;
 cursor:pointer
}
.subQuestionCheckBox>input[type=checkbox]+label .questionTitle {
 color:#505f79;
 transition:color .3s ease-in
}
.subQuestionCheckBox>input[type=checkbox]:checked {
 background-color:#36b37e;
 border-color:#36b37e
}
.subQuestionCheckBox>input[type=checkbox]:checked:before {
 content:"";
 display:block;
 width:6px;
 height:12px;
 border:solid #fff;
 border-width:0 2px 2px 0;
 transform:rotate(45deg);
 position:absolute;
 left:5px;
 top:0
}
.subQuestionCheckBox>input[type=checkbox]:checked+label .questionTitle {
 color:#253858
}
.subQuestionCheckBox>input[type=checkbox]:checked:disabled {
 border-color:#b3bac5;
 background-color:#b3bac5;
 cursor:not-allowed
}
.subQuestionCheckBox>input[type=checkbox]:checked:disabled+label .questionTitle {
 color:#7a869a;
 cursor:not-allowed
}
.subQuestionCheckBox>input[type=checkbox]:disabled {
 border-color:#b3bac5;
 cursor:not-allowed
}
.subQuestionCheckBox>input[type=checkbox]:disabled+label .questionTitle {
 color:#7a869a;
 cursor:not-allowed
}
.segmentFooter {
 background:#fff;
 padding:24px 16px;
 margin-top:42px
}
.segmentFooter .disclaimer {
 font-size:12px;
 line-height:1.5;
 padding-bottom:0
}
@media screen and (max-width:420px) {
 .segmentFooter .disclaimer {
  font-size:3.2vw
 }
}
.segmentFooter .disclaimer p {
 margin-bottom:20px
}
.segmentFooter .disclaimer p:last-child {
 margin-bottom:0
}
.requestCallWrapper {
 margin-bottom:60px
}
.requestCallWrapper h6 {
 font-size:18px
}
.requestCallWrapper p {
 margin-top:5px
}
.requestCallWrapper button {
 width:100%;
 height:48px;
 -webkit-appearance:none;
 background:transparent;
 color:#253858!important;
 font-size:16px;
 font-weight:600;
 text-transform:uppercase;
 border:1px solid #253858;
 box-shadow:none;
 border-radius:4px;
 font-family:-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Oxygen-Sans,Ubuntu,Cantarell,Helvetica Neue,sans-serif;
 margin-top:16px;
 text-align:left;
 padding:0 16px;
 position:relative;
 outline:none
}
.requestCallWrapper button:hover {
 color:#253858!important
}
.requestCallWrapper button .requestCallIcon {
 position:absolute;
 right:16px;
 top:50%;
 transform:translateY(-50%)
}
.requestCallIcon {
 width:18px;
 height:18px;
 background:url(https://static.pbcdn.in/health-cdn/images/insurer-logo/quotes-logos/segment_miscIcons.svg) no-repeat -9px -91px
}
.hideCta {
 visibility:hidden;
 opacity:0;
 transform:translateY(30%)
}
.showCta {
 visibility:visible;
 opacity:1;
 transform:translateY(0)
}
.tips_box {
 color:#505f79;
 display:flex;
 font-size:12px;
 line-height:1.5;
 padding-top:16px;
 margin-bottom:16px
}
@media screen and (max-width:420px) {
 .tips_box {
  font-size:3.2vw
 }
}
.tips_box img {
 margin-right:30px
}
.declare_box {
 margin:18px 0 0;
 display:flex;
 align-items:flex-start
}
.declare_box>div {
 width:calc(100% - 30px)
}
.declare_box .checkbox_filter {
 -webkit-appearance:none;
 -moz-appearance:none;
 appearance:none;
 outline:none;
 width:22px;
 height:22px;
 margin:2px 10px 0 0;
 border:1px solid #505f79;
 border-radius:3px
}
.declare_box .checkbox_filter:checked {
 background:#36b37e;
 border:1px solid #36b37e
}
.declare_box .checkbox_filter:checked:checked:after {
 -webkit-transform:rotate(45deg);
 transform:rotate(45deg);
 border-spacing:0;
 display:block;
 border:2px solid #fff;
 border-top:0;
 border-left:0;
 content:"";
 height:14px;
 margin:1px 0 0 6px;
 width:7px
}
.declare_box .checkbox_filter:disabled {
 border-color:#b3bac5;
 cursor:not-allowed
}
.declare_box label {
 display:inline;
 color:#253858;
 font-size:14px;
 line-height:1.5;
 cursor:pointer
}
@media screen and (max-width:420px) {
 .declare_box label {
  font-size:3.8vw
 }
}
.declare_box a {
 font-size:14px;
 margin-left:4px
}
@media screen and (max-width:420px) {
 .declare_box a {
  font-size:3.8vw
 }
}
.disabled_declaration {
 pointer-events:none
}
.disabled_declaration,
.disabled_declaration a {
 color:#7a869a!important
}
.labelQuesNumber {
 color:#505f79;
 font-size:12px;
 font-weight:600;
 display:block;
 margin-top:40px
}
@media screen and (max-width:420px) {
 .labelQuesNumber {
  font-size:3.2vw
 }
}
.otherTxt3 .fieldTitle {
 font-weight:400
}
.pageGreenHead {
 color:#36b37e;
 font-size:16px;
 font-weight:700;
 margin-bottom:16px
}
@media screen and (max-width:420px) {
 .pageGreenHead {
  font-size:4.5vw
 }
}
.skeletonWrapperProposal {
 padding:0 16px
}
.skeletonWrapperProposal .box1,
.skeletonWrapperProposal .box2,
.skeletonWrapperProposal .box3,
.skeletonWrapperProposal .box4 {
 margin:0 0 12px
}
.skeletonWrapperProposal h2 {
 width:50%
}
.skeletonWrapperProposal h4 {
 width:70%
}
.wrapperRightProposal .skeletonWrapperProposal {
 padding-bottom:16px
}
.disclaimer a {
 color:#253858;
 text-decoration:underline
}
.loaderButton:before {
 content:"";
 position:absolute;
 right:10px;
 top:10px;
 border-right:3px solid hsla(0,0%,95.3%,.3);
 border-top:3px solid hsla(0,0%,95.3%,.3);
 border-radius:50%;
 border-color:#fff #fff hsla(0,0%,95.3%,.3) hsla(0,0%,95.3%,.3);
 border-style:solid;
 border-width:3px;
 width:28px;
 height:28px;
 -webkit-animation:spin 1.2s linear infinite;
 animation:spin 1.2s linear infinite
}
@-webkit-keyframes spin {
 0% {
  -webkit-transform:rotate(0deg)
 }
 to {
  -webkit-transform:rotate(1turn)
 }
}
@keyframes spin {
 0% {
  transform:rotate(0deg)
 }
 to {
  transform:rotate(1turn)
 }
}
.editName {
 width:22px;
 height:22px;
 position:absolute;
 top:17px;
 right:17px;
 cursor:pointer;
 background:url(https://static.pbcdn.in/health-cdn/images/images/icn-edit.svg) no-repeat 0 0;
 text-indent:-999999px
}
.overlay_proposal {
 position:fixed;
 top:0;
 left:0;
 bottom:0;
 right:0;
 height:100%;
 width:100%;
 margin:0;
 padding:0;
 background:rgba(23,43,77,.9);
 opacity:1;
 z-index:99;
 animation:fadeIn .3s ease-out forwards
}
@keyframes fadeIn {
 0% {
  opacity:0
 }
 to {
  opacity:1
 }
}
.proposal_modal {
 max-width:100%;
 height:auto;
 left:0;
 top:auto;
 transform:inherit;
 bottom:0;
 border-radius:10px 10px 0 0;
 box-shadow:0 2px 4px 0 rgba(0,0,0,.16);
 padding:16px;
 width:100%;
 background-color:#fff;
 position:fixed;
 z-index:999
}
.proposal_modal h2 {
 margin:0;
 padding:0 0 10px;
 list-style:none;
 position:relative;
 line-height:1.5;
 letter-spacing:.2px;
 font-size:18px;
 font-weight:700
}
@media screen and (max-width:420px) {
 .proposal_modal h2 {
  font-size:5.1vw
 }
}
.proposal_modal p {
 margin-bottom:12px;
 font-size:14px
}
@media screen and (max-width:420px) {
 .proposal_modal p {
  font-size:3.8vw
 }
}
.proposal_modal .btn {
 width:100%!important;
 margin-top:0
}
.proposal_modal .buttonMedicalContainer {
 display:flex;
 justify-content:flex-end
}
.proposal_modal .buttonMedicalContainer .btn_white {
 background:#fff;
 color:#253858!important;
 border:1px solid #253858;
 margin-right:16px
}
.proposal_modal .buttonMedicalContainer button {
 margin-top:16px
}
.infoPopup {
 height:50vh!important;
 max-width:754px!important;
 overflow-y:hidden
}
.infoPopup .close_proposal {
 right:42px;
 top:11px
}
.close_proposal {
 position:absolute;
 right:37px;
 top:1px;
 cursor:pointer;
 z-index:1
}
.close_proposal:after,
.close_proposal:before {
 content:"";
 position:absolute;
 height:20px;
 width:2px;
 transform:rotate(45deg);
 left:17px;
 top:10px;
 background:#253858;
 border-radius:10px
}
.close_proposal:after {
 transform:rotate(-45deg)
}
.premiumUpdateBox {
 display:flex;
 justify-content:space-between;
 border-top:1px solid #dfe1e6;
 border-bottom:1px solid #dfe1e6;
 padding:18px 0;
 margin:26px 0
}
.premiumUpdateBox .firstAmount {
 text-decoration:line-through;
 color:#7a869a;
 font-size:16px;
 padding-right:16px
}
@media screen and (max-width:420px) {
 .premiumUpdateBox .firstAmount {
  font-size:4.5vw
 }
}
.premiumUpdateBox .secondAmount {
 color:#253858;
 font-weight:700;
 font-size:18px
}
@media screen and (max-width:420px) {
 .premiumUpdateBox .secondAmount {
  font-size:5.1vw
 }
}
.msgsuccessBox {
 display:flex;
 padding:0 16px;
 margin-bottom:15px;
 width:100%;
 align-content:center;
 color:#36b37e;
 position:relative;
 line-height:22px
}
.msgsuccessBox:before {
 height:9px;
 width:20px;
 left:25px;
 top:19px;
 border-left:2px solid #36b37e;
 border-bottom:2px solid #36b37e;
 transform:rotate(-45deg);
 margin-top:-2px;
 position:absolute;
 z-index:1;
 content:""
}
.msgsuccessBox:after {
 width:38px;
 height:38px;
 left:16px;
 border:2px solid #36b37e;
 position:absolute;
 top:4px;
 border-radius:30px;
 background:#fff;
 content:""
}
.msgsuccessBox h3 {
 font-size:16px;
 padding-left:56px;
 padding-top:2px;
 font-weight:700
}
@media screen and (max-width:420px) {
 .msgsuccessBox h3 {
  font-size:4.5vw
 }
}
.innerBorder {
 border:0 solid #dfe1e6;
 border-radius:4px;
 padding:12px 0;
 margin-top:20px;
 margin-bottom:40px
}
.innerBorder .memberName {
 font-size:16px
}
@media screen and (max-width:420px) {
 .innerBorder .memberName {
  font-size:4.5vw
 }
}
.memberStart .memberName {
 font-weight:600;
 font-size:16px;
 text-transform:capitalize;
 color:#36b37e
}
@media screen and (max-width:420px) {
 .memberStart .memberName {
  font-size:4.5vw
 }
}
.pageHead.portHead {
 margin-bottom:24px
}
.amountCoverProposal {
 display:block;
 font-size:14px;
 color:#505f79;
 font-weight:400
}
@media screen and (max-width:420px) {
 .amountCoverProposal {
  font-size:3.8vw
 }
}
.mb-16 {
 margin-bottom:16px!important
}
.paidTotal {
 color:#36b37e;
 text-transform:uppercase;
 position:relative;
 padding-left:32px
}
.paidTotal:before {
 height:6px;
 width:12px;
 left:6px;
 top:10px;
 border-left:2px solid #36b37e;
 border-bottom:2px solid #36b37e;
 transform:rotate(-45deg);
 margin-top:-2px;
 position:absolute;
 z-index:1;
 content:""
}
.paidTotal:after {
 width:24px;
 height:24px;
 left:0;
 border:2px solid #36b37e;
 position:absolute;
 top:0;
 border-radius:30px;
 background:#fff;
 content:""
}
.paidText {
 color:#36b37e
}
.infoPopup .wrapperTerms {
 height:40vh;
 overflow-y:scroll;
 margin-bottom:20px;
 padding-right:12px
}
.disable-resize {
 resize:none
}
.capsMember {
 text-transform:capitalize
}
.disable-screen {
 position:absolute;
 left:0;
 right:0;
 top:0;
 bottom:0;
 z-index:9
}
.wrapperLeftProposal {
 position:relative
}
.spTop {
 margin-top:32px!important
}
.nextStepBox {
 border-top:1px solid #dfe1e6;
 padding:24px 16px 0;
 margin:40px -16px 0
}
.nextStepBox.portabilityStep {
 margin:24px 0
}
.nextStepBox span {
 display:block;
 color:#5e6c84;
 font-weight:700
}
.nextStepBox .nextText {
 font-size:14px
}
@media screen and (max-width:420px) {
 .nextStepBox .nextText {
  font-size:3.8vw
 }
}
.nextStepBox .nextStepMedical {
 font-size:16px
}
@media screen and (max-width:420px) {
 .nextStepBox .nextStepMedical {
  font-size:4.5vw
 }
}
.answerSavedBox {
 display:flex;
 justify-content:space-between;
 align-items:center;
 border-top:none;
 border-bottom:1px solid #dfe1e6;
 padding:0 16px 24px;
 margin:24px -16px
}
.answerSavedBox .editSaveMember {
 color:#ff5630;
 position:relative;
 font-size:14px;
 cursor:pointer;
 text-transform:uppercase;
 padding-right:20px;
 margin-left:10px
}
@media screen and (max-width:420px) {
 .answerSavedBox .editSaveMember {
  font-size:3.8vw
 }
}
.answerSavedBox .editSaveMember:before {
 content:"";
 border:solid #ff5630;
 border-width:2px 0 0 2px;
 display:inline-block;
 padding:2px;
 transform:rotate(135deg);
 position:absolute;
 left:38px;
 top:8px
}
.pageSubhead+.answerSavedBox {
 margin-top:40px
}
.headiingGreenMob {
 font-size:16px;
 font-weight:700;
 color:#36b37e;
 margin-bottom:-30px
}
@media screen and (max-width:420px) {
 .headiingGreenMob {
  font-size:4.5vw
 }
}
.headingGreen {
 font-size:18px;
 font-weight:700;
 color:#36b37e
}
@media screen and (max-width:420px) {
 .headingGreen {
  font-size:5.1vw
 }
}
.review_nomineeBlock {
 margin-bottom:24px
}
.review_nomineeBlock:last-child {
 margin-bottom:0
}
.blockHead+.review_nomineeBlock {
 margin-top:8px
}
@media screen and (max-width:1023px) {
 .headingGreen {
  font-size:16px;
  font-weight:700;
  color:#36b37e
 }
}
@media screen and (max-width:1023px) and (max-width:420px) {
 .headingGreen {
  font-size:4.5vw
 }
}
@media screen and (max-width:1023px) {
 .allMemberMedical .headiingGreen {
  font-size:16px;
  font-weight:700;
  color:#36b37e;
  width:unset
 }
}
@media screen and (max-width:1023px) and (max-width:420px) {
 .allMemberMedical .headiingGreen {
  font-size:4.5vw
 }
}
@media screen and (max-width:1023px) {
 .wrapperMainSection {
  min-height:calc(100vh - 78px)
 }
 .proposalWrapper .navbarWrapper {
  z-index:9
 }
 .answerSavedBox {
  padding:0 16px 16px;
  margin-bottom:16px
 }
 .answerSavedBox:nth-child(2n) {
  margin-top:0
 }
 .requestCallWrapper h6 {
  font-weight:700!important;
  font-size:16px
 }
}
@media screen and (max-width:1023px) and (max-width:420px) {
 .requestCallWrapper h6 {
  font-size:4.5vw
 }
}
@media screen and (max-width:1023px) {
 .requestCallWrapper button {
  margin-top:10px;
  position:static;
  display:flex;
  justify-content:space-between;
  align-items:center
 }
 .requestCallWrapper button .requestCallIcon {
  position:static;
  transform:none
 }
 .port-declare {
  line-height:20px!important
 }
 .infoPopup .wrapperTerms {
  height:90%
 }
 .buttonStickyMobile {
  bottom:0;
  position:fixed;
  box-shadow:0 -3px 6px 0 rgba(0,0,0,.16);
  background:#fff;
  z-index:9;
  padding:12px;
  justify-content:space-between;
  display:flex;
  flex-direction:row;
  align-items:center;
  width:100%!important;
  left:0
 }
 .buttonStickyMobile .btn {
  margin-top:0;
  font-size:16px
 }
}
@media screen and (max-width:1023px) and (max-width:420px) {
 .buttonStickyMobile .btn {
  font-size:4.5vw
 }
}
@media screen and (max-width:1023px) {
 .buttonStickyMobile .total_proposal_amount {
  display:inline-block;
  position:relative;
  font-size:16px;
  font-weight:500;
  width:192px
 }
}
@media screen and (max-width:1023px) and (max-width:420px) {
 .buttonStickyMobile .total_proposal_amount {
  font-size:4.5vw
 }
}
@media screen and (max-width:1023px) {
 .buttonStickyMobile .total_proposal_amount span {
  font-size:12px;
  color:#7a869a;
  display:block
 }
}
@media screen and (max-width:1023px) and (max-width:420px) {
 .buttonStickyMobile .total_proposal_amount span {
  font-size:3.2vw
 }
}
@media screen and (max-width:1023px) {
 .buttonStickyMobile .total_proposal_amount .break_modal_icon {
  display:flex
 }
 .buttonStickyMobile .total_proposal_amount .break_modal_icon .arrow_premiumbreakup {
  position:relative
 }
 .buttonStickyMobile .total_proposal_amount .break_modal_icon .arrow_premiumbreakup:after {
  width:16px;
  height:16px;
  background-color:#dfe1e6;
  content:"";
  position:absolute;
  left:9px;
  top:5px;
  border-radius:30px
 }
 .buttonStickyMobile .total_proposal_amount .break_modal_icon .arrow_premiumbreakup:before {
  content:"";
  border:solid #253858;
  border-width:0 1px 1px 0;
  display:inline-block;
  padding:2px;
  transform:rotate(225deg);
  margin-left:3px;
  vertical-align:middle;
  position:absolute;
  top:12px;
  left:12px;
  z-index:1
 }
 .content-h {
  margin-left:0!important
 }
 .proposalWrapper .content-h {
  max-width:unset
 }
 .proposalSection .pageHeadMember {
  margin-bottom:30px
 }
 article.portabiltySection {
  margin-top:32px
 }
 .pageHead.portHead {
  margin-bottom:0
 }
 .yearWiseBox .pageHead {
  margin-bottom:32px
 }
 .yearWiseBox .sectionHead {
  margin-top:32px
 }
 .yearWiseBox div.yearText {
  margin-top:32px;
  font-size:14px;
  text-transform:capitalize
 }
}
@media screen and (max-width:1023px) and (max-width:420px) {
 .yearWiseBox div.yearText {
  font-size:3.8vw
 }
}
@media screen and (max-width:1023px) {
 .yearWiseDetailsBlock div.yearText {
  margin-top:0
 }
 .childQuestionBox {
  margin-top:32px
 }
 .childQuestionBox .memberStart article .sectionHead {
  margin-bottom:6px
 }
 .wrapperLeftProposal .span_mobile_toast {
  padding:12px 26px
 }
 .callNowProposal .call-shortly-box {
  position:fixed;
  background:#185488;
  font-size:16px;
  padding:15px;
  color:#fff;
  text-align:center;
  top:41%;
  border-radius:5px;
  box-shadow:0 1px 6px 0 hsla(0,0%,85.9%,.5);
  z-index:9;
  width:calc(100% - 32px);
  left:16px
 }
 .callNowProposal {
  padding-bottom:80px
 }
 .wrapperLeftProposal .mobile_bottom_toast {
  left:0!important;
  bottom:200px!important
 }
 .premium-box .headbar-break .close-box:hover {
  background:none!important
 }
 .infoPopup {
  height:95%!important;
  max-width:100%!important
 }
 .leftStarPortabilty {
  margin-top:20px
 }
 .overlay_proposal {
  animation:fadeInMob .3s ease-out forwards
 }
 @keyframes fadeInMob {
  0% {
   opacity:0
  }
  to {
   opacity:1
  }
 }
 .proposal_modal {
  top:unset;
  animation:slideUp .3s ease-out forwards
 }
 @keyframes slideUp {
  0% {
   transform:translateY(100%)
  }
  to {
   transform:translateY(0)
  }
 }
 .proposalSection {
  opacity:0;
  animation:sectionLoadMob .5s ease-in forwards
 }
 .proposalSection>article {
  opacity:0;
  animation:sectionLoadMob .5s ease-in .2s forwards
 }
 @keyframes sectionLoadMob {
  0% {
   opacity:0
  }
  to {
   opacity:1
  }
 }
 .proposalSection>article#propserDetails {
  animation-delay:0s
 }
 .questionLeftBdr>div {
  opacity:0;
  animation:loadQuestionsMob .5s ease-out .5s forwards
 }
 @keyframes loadQuestionsMob {
  0% {
   opacity:0
  }
  to {
   opacity:1
  }
 }
 .emailBlock {
  width:100%!important
 }
 .memberStart {
  margin-bottom:32px
 }
 .memberStart:last-child {
  margin-bottom:0
 }
 .mt-32-mob {
  margin-top:32px
 }
 .riders_pr_new h2 {
  font-weight:700;
  font-size:14px;
  margin-bottom:8px;
  padding:0
 }
 .riders_box_new {
  display:flex;
  flex-direction:row;
  width:100%;
  justify-content:flex-start;
  align-items:center;
  margin-bottom:15px;
  font-size:14px;
  color:#505f79
 }
}
@media screen and (max-width:1023px) and (max-width:420px) {
 .riders_box_new {
  font-size:3.8vw
 }
}
@media screen and (max-width:1023px) {
 .riders_box_new picture {
  margin-right:8px
 }
 .riders_box_new .blk {
  display:block
 }
 .riders_box_new .bold {
  font-weight:600;
  color:#253858;
  margin-left:auto
 }
}
@media only screen and (min-width:1024px) {
 body,
 html {
  background:#f4f5f7
 }
 .msgsuccessBox {
  line-height:48px
 }
 .msgsuccessBox h3 {
  font-size:20px
 }
}
@media only screen and (min-width:1024px) and (max-width:420px) {
 .msgsuccessBox h3 {
  font-size:5.6vw
 }
}
@media only screen and (min-width:1024px) {
 .segmentFooter {
  background:#fff;
  padding:16px 0
 }
 .segmentFooter .disclaimer {
  font-size:12px;
  text-align:center;
  color:#979797;
  width:80%;
  margin:0 auto
 }
}
@media only screen and (min-width:1024px) and (max-width:420px) {
 .segmentFooter .disclaimer {
  font-size:3.2vw
 }
}
@media only screen and (min-width:1024px) {
 .segmentFooter .disclaimer p {
  margin-bottom:6px
 }
 .segmentFooter .disclaimer a {
  color:#979797
 }
 .wrapperMainSection {
  max-width:1140px;
  margin:20px auto 0!important;
  display:flex
 }
 .wrapperLeftProposal {
  width:calc(100% - 390px);
  background:#fff;
  border-radius:4px;
  padding-top:16px
 }
 .wrapperLeftProposal .mobile_bottom_toast {
  bottom:inherit;
  animation:showToast .3s ease-out 0s forwards,hideToast .3s ease-out 2.5s forwards;
  left:-170px;
  top:0
 }
 .leftStarPortabilty {
  width:100%
 }
 .leftStarPortabilty .proposalSection {
  width:750px
 }
 @keyframes showToast {
  0% {
   bottom:0;
   opacity:0
  }
  to {
   bottom:20px;
   opacity:1
  }
 }
 @keyframes hideToast {
  0% {
   bottom:20px;
   opacity:1
  }
  to {
   bottom:0;
   opacity:0
  }
 }
 .wrapperRightProposal {
  width:370px;
  position:relative;
  z-index:1;
  margin-left:18px
 }
 .wrapperRightProposal .innerRightSection {
  width:100%;
  border-radius:4px;
  box-shadow:0 3px 6px 0 rgba(0,0,0,.16);
  background-color:#fff;
  height:auto;
  padding:16px 0 0;
  position:sticky;
  position:-webkit-sticky;
  top:74px
 }
 .wrapperRightProposal .innerRightSection h3 {
  font-weight:700;
  font-size:18px;
  border-bottom:0 solid #b3bac5;
  padding-bottom:7px;
  padding-left:16px;
  box-shadow:0 1px 2px 0 rgba(0,0,0,.16)
 }
}
@media only screen and (min-width:1024px) and (max-width:420px) {
 .wrapperRightProposal .innerRightSection h3 {
  font-size:5.1vw
 }
}
@media only screen and (min-width:1024px) {
 .headbarWrapper {
  position:sticky;
  position:-webkit-sticky;
  top:0;
  z-index:99;
  box-shadow:0 3px 2px 0 rgba(0,0,0,.1);
  background:#fff;
  height:57px
 }
 .headbarWrapper .header_inner_web {
  max-width:1140px;
  margin:0 auto;
  display:flex;
  justify-content:space-between;
  height:57px
 }
 .headbarWrapper .header_inner_web .logo-box {
  width:200px;
  height:36px;
  text-indent:-99999px;
  background-size:contain;
  margin:11px 0 0;
  display:flex
 }
 .headbarWrapper .header_inner_web .toll-link {
  padding-left:30px;
  text-align:right;
  position:relative;
  display:flex;
  align-items:center;
  font-size:12px;
  font-weight:700;
  margin:0 32px 0 0
 }
}
@media only screen and (min-width:1024px) and (max-width:420px) {
 .headbarWrapper .header_inner_web .toll-link {
  font-size:3.2vw
 }
}
@media only screen and (min-width:1024px) {
 .headbarWrapper .header_inner_web .toll-link .toll_wrapper_web {
  display:none
 }
 .headbarWrapper .header_inner_web .toll_inner_wrapper {
  text-align:left;
  color:#505f79;
  font-size:14px;
  line-height:1.5;
  margin-top:20px;
  font-weight:400
 }
}
@media only screen and (min-width:1024px) and (max-width:420px) {
 .headbarWrapper .header_inner_web .toll_inner_wrapper {
  font-size:3.8vw
 }
}
@media only screen and (min-width:1024px) {
 .headbarWrapper .header_inner_web .toll_inner_wrapper .toll_inner_wrapper a {
  font-size:16px;
  font-weight:600;
  color:#ff5630
 }
}
@media only screen and (min-width:1024px) and (max-width:420px) {
 .headbarWrapper .header_inner_web .toll_inner_wrapper .toll_inner_wrapper a {
  font-size:4.5vw
 }
}
@media only screen and (min-width:1024px) {
 .headbarWrapper .header_inner_web .toll-link:hover .toll_wrapper_web {
  display:block;
  position:absolute;
  right:0;
  width:285px;
  border-radius:0 0 4px 4px;
  box-shadow:0 8px 19px -1px rgba(0,0,0,.3);
  background-color:#fff;
  padding:0 20px 20px;
  top:57px;
  z-index:9
 }
 .headbarWrapper .header_inner_web .right_toll_section {
  display:flex;
  align-items:stretch
 }
 .headbarWrapper .header_inner_web .call_me_now_head {
  display:flex;
  align-items:center
 }
 .headbarWrapper .header_inner_web .call_me_now_head .button {
  width:119px;
  height:32px;
  border:1px solid #ff5630;
  color:#ff5630;
  font-size:12px;
  border-radius:4px;
  justify-content:center;
  display:flex;
  align-items:center;
  cursor:pointer
 }
}
@media only screen and (min-width:1024px) and (max-width:420px) {
 .headbarWrapper .header_inner_web .call_me_now_head .button {
  font-size:3.2vw
 }
}
@media only screen and (min-width:1024px) {
 .stepper {
  padding:16px;
  border-bottom:1px solid #dfe1e6
 }
 .formBoxMain {
  width:100%;
  display:flex;
  flex-wrap:wrap
 }
 .formBoxMain>div {
  width:100%
 }
 .formBoxMain>.fieldBlockProposal {
  width:calc(50% - 12px)
 }
 .formBoxMain .fieldBlockProposal:nth-child(2n),
 .formBoxMain .optionsModule:nth-child(2n) {
  margin-left:24px
 }
 .formBoxMain .optionsModule {
  width:calc(50% - 12px);
  margin-bottom:0
 }
 .proposalSection .btn {
  width:352px;
  margin:64px auto 0;
  display:flex;
  align-items:center;
  justify-content:center;
  cursor:pointer
 }
 .cart_inner_product_proposal {
  width:100%;
  background:#fff;
  padding:16px 0 10px;
  border-bottom:1px solid #dfe1e6;
  margin:4px 0 0
 }
 .cart_inner_product_proposal:last-child {
  border-bottom:none
 }
 .cart_inner_product_proposal .logo_name_box_1 {
  display:flex;
  flex-direction:row;
  width:100%;
  margin:0 0 20px
 }
 .cart_inner_product_proposal .logo_name_box_1 .logo_pr_box_1 {
  margin-right:15px;
  width:100px
 }
 .cart_inner_product_proposal .logo_name_box_1 .logo_pr_box_1 img {
  margin-top:4px;
  width:100px
 }
 .cart_inner_product_proposal .logo_name_box_1 .plan_pr_box_1 {
  font-size:14px;
  font-weight:700;
  width:calc(100% - 124px)
 }
}
@media only screen and (min-width:1024px) and (max-width:420px) {
 .cart_inner_product_proposal .logo_name_box_1 .plan_pr_box_1 {
  font-size:3.8vw
 }
}
@media only screen and (min-width:1024px) {
 .cart_inner_product_proposal .riders_pr_new h2 {
  font-weight:700;
  font-size:14px;
  margin-bottom:8px
 }
}
@media only screen and (min-width:1024px) and (max-width:420px) {
 .cart_inner_product_proposal .riders_pr_new h2 {
  font-size:3.8vw
 }
}
@media only screen and (min-width:1024px) {
 .cart_inner_product_proposal .riders_box_new {
  display:flex;
  flex-direction:row;
  width:100%;
  justify-content:flex-start;
  align-items:center;
  margin-bottom:15px;
  font-size:14px;
  color:#505f79
 }
}
@media only screen and (min-width:1024px) and (max-width:420px) {
 .cart_inner_product_proposal .riders_box_new {
  font-size:3.8vw
 }
}
@media only screen and (min-width:1024px) {
 .cart_inner_product_proposal .riders_box_new picture {
  margin-right:8px
 }
 .cart_inner_product_proposal .riders_box_new .blk {
  display:block
 }
 .cart_inner_product_proposal .riders_box_new .bold {
  font-weight:600;
  color:#253858;
  margin-left:auto
 }
 .cart_inner_product_proposal .add-ons .riders_box_new:last-child {
  margin-bottom:0
 }
 .scroll_right_box {
  max-height:357px;
  overflow-y:scroll;
  padding:0 16px;
  margin-top:16px
 }
 .scroll_right_box .cart_inner_product_proposal:first-child {
  padding-top:0
 }
 .cover_web .premium-box::-webkit-scrollbar,
 .scroll_right_box::-webkit-scrollbar,
 .term_wrapper::-webkit-scrollbar,
 .wrapperTerms::-webkit-scrollbar {
  width:6px
 }
 .cover_web .premium-box::-webkit-scrollbar-track,
 .scroll_right_box::-webkit-scrollbar-track,
 .term_wrapper::-webkit-scrollbar-track,
 .wrapperTerms::-webkit-scrollbar-track {
  background:transparent
 }
 .scroll_space {
  padding:0 16px
 }
 .premium_right_proposal {
  display:flex;
  justify-content:space-between;
  border-radius:0 0 4px 4px;
  padding:16px;
  box-shadow:0 -1px 4px 0 rgba(0,0,0,.12);
  margin-top:16px;
  font-size:16px;
  font-weight:700
 }
}
@media only screen and (min-width:1024px) and (max-width:420px) {
 .premium_right_proposal {
  font-size:4.5vw
 }
}
@media only screen and (min-width:1024px) {
 .proposal_modal {
  height:auto;
  left:50%;
  top:50%;
  transform:translate(-50%,-50%);
  bottom:auto;
  border-radius:10px;
  max-width:360px;
  animation:fadeIn .3s ease-out forwards
 }
 @keyframes fadeIn {
  0% {
   opacity:0
  }
  to {
   opacity:1
  }
 }
 .proposal_modal .buttonMedicalContainer .btn_white {
  background:#fff;
  color:#253858!important;
  border:1px solid #253858
 }
 .proposal_modal.bmiRejectionPop {
  max-width:435px
 }
 .proposal_modal.edewiessDeclarePop {
  max-width:680px
 }
 .proposal_modal.edewiessDeclarePop .buttonMedicalContainer {
  max-width:360px;
  margin:0 auto
 }
 .questionLeftBdr {
  position:relative;
  margin-bottom:40px
 }
 .questionLeftBdr:after {
  content:"";
  display:block;
  clear:both
 }
 .questionLeftBdr:before {
  width:3px;
  height:100%;
  background-color:#b3bac5;
  content:"";
  position:absolute;
  top:7px;
  left:-16px
 }
 .questionLeftBdr .sectionHead {
  margin-bottom:4px
 }
 .questionLeftBdr .pageSubhead2 {
  margin-bottom:0
 }
 .questionLeftBdr:hover:before {
  background-color:#36b37e
 }
 .childQuestionBox {
  border:0 solid #dfe1e6;
  border-radius:4px;
  padding:0
 }
 .childQuestionBox .sectionHead {
  margin-top:0;
  margin-bottom:4px
 }
 .childQuestionBox .memberName {
  font-weight:700;
  font-size:16px;
  text-transform:capitalize
 }
}
@media only screen and (min-width:1024px) and (max-width:420px) {
 .childQuestionBox .memberName {
  font-size:4.5vw
 }
}
@media only screen and (min-width:1024px) {
 .childQuestionBox .questionSpec {
  color:#505f79;
  font-size:14px;
  padding-bottom:16px
 }
}
@media only screen and (min-width:1024px) and (max-width:420px) {
 .childQuestionBox .questionSpec {
  font-size:3.8vw
 }
}
@media only screen and (min-width:1024px) {
 .childQuestionBox .formBoxMain .optionsModule {
  margin-bottom:0
 }
 .childQuestionBox .memberStart {
  margin-bottom:32px
 }
 .childQuestionBox .memberStart:last-child {
  margin-bottom:0
 }
 .childQuestionBox article.otherInfochild {
  flex:1 1 100%
 }
 .childQuestionBox article.otherInfochild .otherTxt3 {
  margin-bottom:12px
 }
 .childQuestionBox article.otherInfochild .otherTxt3 .fieldBlockProposal {
  margin-left:0;
  width:100%
 }
 .goBack {
  font-size:14px;
  color:#253858;
  font-weight:600;
  cursor:pointer;
  position:relative;
  padding-left:30px
 }
}
@media only screen and (min-width:1024px) and (max-width:420px) {
 .goBack {
  font-size:3.8vw
 }
}
@media only screen and (min-width:1024px) {
 .goBack:before {
  border:solid #253858;
  border-width:0 2px 2px 0;
  display:inline-block;
  padding:4px;
  transform:rotate(135deg);
  top:56%;
  margin-top:-6px
 }
 .goBack:after,
 .goBack:before {
  content:"";
  position:absolute;
  left:5px
 }
 .goBack:after {
  height:2px;
  width:12px;
  background:#253858;
  top:53.5%;
  margin-top:-1px
 }
 .declare_box label .checkbox_filter {
  cursor:pointer
 }
 .proposalSection .pageHead {
  font-size:24px;
  line-height:1.5
 }
 .proposalSection .pageSubhead {
  margin-bottom:4px;
  font-size:18px;
  line-height:1.5;
  font-weight:600
 }
}
@media only screen and (min-width:1024px) and (max-width:420px) {
 .proposalSection .pageSubhead {
  font-size:5.1vw
 }
}
@media only screen and (min-width:1024px) {
 .proposalSection .pageHeadMember {
  margin-bottom:32px
 }
 .portabiltySection .questionTitle {
  margin-bottom:0
 }
 .yearWiseBox {
  border:0 solid #dfe1e6;
  border-radius:4px
 }
 .yearWiseBox .yearText {
  font-size:14px;
  text-transform:capitalize
 }
}
@media only screen and (min-width:1024px) and (max-width:420px) {
 .yearWiseBox .yearText {
  font-size:3.8vw
 }
}
@media only screen and (min-width:1024px) {
 .yearWiseBox .sectionHead {
  font-size:14px
 }
}
@media only screen and (min-width:1024px) and (max-width:420px) {
 .yearWiseBox .sectionHead {
  font-size:3.8vw
 }
}
@media only screen and (min-width:1024px) {
 .yearWiseBox h6.sectionHead {
  margin-bottom:0
 }
 .yearWiseBox .formBoxMain .optionsModule {
  margin-bottom:0;
  margin-top:16px
 }
 .yearWiseBox__block {
  margin-bottom:32px
 }
 .yearWiseBox__block .formBoxMain {
  margin-bottom:24px
 }
 .yearWiseBox__block .questionTitle {
  margin-bottom:0
 }
 .allMemberMedical {
  display:flex;
  justify-content:space-between;
  margin:40px 0 16px;
  align-items:center
 }
 .allMemberMedical .headiingGreen {
  font-size:18px;
  font-weight:700;
  color:#36b37e;
  width:550px
 }
}
@media only screen and (min-width:1024px) and (max-width:420px) {
 .allMemberMedical .headiingGreen {
  font-size:5.1vw
 }
}
@media only screen and (min-width:1024px) {
 .allMemberMedical .declare_box {
  margin:0;
  cursor:pointer
 }
 .allMemberMedical .declare_box label {
  align-items:center
 }
 .allMemberMedical .declare_box label .checkbox_filter {
  margin:0 10px 0 0
 }
 .flex-dir-col {
  flex-direction:column;
  align-items:flex-start
 }
 .flex-dir-col .questionTitle {
  margin-top:4px
 }
 .innerBorder .memberName {
  font-size:18px
 }
}
@media only screen and (min-width:1024px) and (max-width:420px) {
 .innerBorder .memberName {
  font-size:5.1vw
 }
}
@media only screen and (min-width:1024px) {
 .port-declare {
  line-height:24px!important
 }
 .proposalSection {
  opacity:0;
  animation:sectionLoad .5s ease-in .5s forwards
 }
 @keyframes sectionLoad {
  0% {
   opacity:0
  }
  to {
   opacity:1
  }
 }
 .proposalSection .sectionHead {
  font-size:18px;
  font-weight:700;
  margin-bottom:4px;
  margin-top:0
 }
}
@media only screen and (min-width:1024px) and (max-width:420px) {
 .proposalSection .sectionHead {
  font-size:5.1vw
 }
}
@media only screen and (min-width:1024px) {
 .proposalSection .sectionSubhead {
  font-size:14px;
  font-weight:400;
  color:#505f79;
  margin-bottom:0
 }
}
@media only screen and (min-width:1024px) and (max-width:420px) {
 .proposalSection .sectionSubhead {
  font-size:3.8vw
 }
}
@media only screen and (min-width:1024px) {
 article.otherInfochild {
  margin-bottom:0!important
 }
 article.otherInfochild .sectionHead {
  margin-bottom:0
 }
 article.otherInfochild .memberStart {
  margin-top:8px
 }
}
.breakup_inner_product .plan_for_name,
.cart_inner_product_proposal .plan_for_name {
 color:#253858;
 font-size:14px;
 margin:0 0 12px
}
@media screen and (max-width:420px) {
 .breakup_inner_product .plan_for_name,
 .cart_inner_product_proposal .plan_for_name {
  font-size:3.8vw
 }
}
.mb-0 {
 margin-bottom:0
}
.pb-0 {
 padding-bottom:0
}
.mt-32,
.otherInfochild>div,
.quesType1,
.quesType2,
.quesType3,
.quesType4,
.quesType5 {
 margin-top:32px
}
.secondLevel .thirdLevel {
 flex:1 1 100%
}
.secondLevel .thirdLevel .questionTitle {
 margin-bottom:8px!important
}
.secondLevel .quesType1,
.secondLevel .quesType2,
.secondLevel .quesType3,
.secondLevel .quesType4,
.secondLevel .quesType5 {
 flex:1 1 100%
}
.secondLevel .quesType1 .questionTitle,
.secondLevel .quesType2 .questionTitle,
.secondLevel .quesType3 .questionTitle,
.secondLevel .quesType4 .questionTitle,
.secondLevel .quesType5 .questionTitle {
 margin-bottom:0
}
.secondLevel .formBoxMain>div[class^=quesType]:first-child {
 margin-top:16px
}
.secondLevel .childQuestionBox>.questionTitle,
.secondLevel>.questionTitle {
 margin-bottom:16px
}
.thirdLevel {
 width:100%
}
.thirdLevel>.otherTxt3 .fieldBlockProposal {
 margin-top:0
}
.thirdLevel>.questionTitle {
 margin-bottom:16px
}
.quesType5.secondLevel .childQuestionBox .memberStart .formBoxMain {
 margin-bottom:32px
}
.quesType5.secondLevel .childQuestionBox .memberStart .formBoxMain .questionTitle,
.quesType5.secondLevel .childQuestionBox .memberStart .formBoxMain:last-child {
 margin-bottom:0
}
.secondLevel {
 background:#f9fafc;
 padding:16px;
 border-radius:8px;
 animation:fade .3s ease-in
}
.secondLevel .secondLevel {
 background:none;
 padding:0;
 border-radius:0;
 animation:none;
 margin-top:16px
}
.secondLevel .thirdLevel {
 background:#f2f3f5
}
.thirdLevel {
 background:#f9fafc;
 padding:16px;
 border-radius:8px;
 animation:fade .3s ease-in
}
.addressOptionsWrapper__option {
 margin:20px 0;
 border-bottom:1px solid #dfe1e6;
 padding-bottom:20px
}
.addressOptionsWrapper__option:last-child {
 border-bottom:none;
 padding-bottom:0
}
.addressOptionsWrapper__option:first-child {
 margin-top:0
}
.cdpHint {
 font-size:12px;
 color:#7a869a;
 margin-bottom:4px
}
@media screen and (max-width:420px) {
 .cdpHint {
  font-size:3.2vw
 }
}
.psychMsg {
 font-size:12px;
 font-weight:400;
 color:#505f79;
 margin-top:8px
}
@media screen and (max-width:420px) {
 .psychMsg {
  font-size:3.2vw
 }
}
.text-capitalize {
 text-transform:capitalize
}
.yearWiseDetailsBlock {
 margin-bottom:32px
}
.yearWiseDetailsBlock:last-child {
 margin-bottom:0
}
.mt-40 {
 margin-top:40px
}
.mb-40 {
 margin-bottom:40px
}
.mt-0 {
 margin-top:0!important
}
.mt-16 {
 margin-top:16px
}
.o-h {
 overflow:hidden
}
.claimDetailsWrapper .addClaimBtn {
 font-size:14px;
 text-transform:uppercase;
 color:#ff5630!important;
 font-weight:600;
 background:none;
 border:none;
 margin:16px auto 0;
 display:block;
 cursor:pointer;
 display:flex;
 align-items:center
}
@media screen and (max-width:420px) {
 .claimDetailsWrapper .addClaimBtn {
  font-size:3.8vw
 }
}
.claimDetailsWrapper .addClaimBtn:before {
 content:"+";
 width:16px;
 height:16px;
 border-radius:50%;
 border:1px solid #ff5630;
 margin-right:6px;
 padding-left:0;
 line-height:12px
}
.claimDetailsWrapper .removeClaimBtn {
 font-size:14px;
 text-transform:uppercase;
 color:#253858!important;
 font-weight:600;
 background:none;
 border:none;
 margin:16px auto 0;
 display:block;
 cursor:pointer;
 display:flex;
 align-items:center
}
@media screen and (max-width:420px) {
 .claimDetailsWrapper .removeClaimBtn {
  font-size:3.8vw
 }
}
.claimDetailsWrapper .removeClaimBtn:before {
 content:"-";
 width:16px;
 height:16px;
 border-radius:50%;
 border:1px solid #253858;
 margin-right:6px;
 padding-left:0;
 line-height:12px
}
.quesType6 {
 margin-top:16px
}
.quesType6 .quesType3 {
 margin-top:0
}
.fieldHint {
 font-size:12px;
 font-weight:400;
 color:#253858;
 margin-top:8px;
 position:relative;
 padding-left:12px
}
@media screen and (max-width:420px) {
 .fieldHint {
  font-size:3.2vw
 }
}
.fieldHint:before {
 content:"";
 width:4px;
 height:4px;
 border-radius:50%;
 background:#253858;
 position:absolute;
 left:0;
 top:7px
}
.addOnSegment {
 margin-bottom:24px
}
.addOnSegment__heading {
 font-size:18px;
 font-weight:700;
 margin-bottom:16px
}
@media screen and (max-width:420px) {
 .addOnSegment__heading {
  font-size:5.1vw
 }
}
.addOnSegment__heading span {
 display:block;
 font-size:14px;
 color:#505f79;
 font-weight:400
}
@media screen and (max-width:420px) {
 .addOnSegment__heading span {
  font-size:3.8vw
 }
}
.addOnSegment__planName {
 border:1px solid #dfe1e6;
 border-radius:8px;
 padding:16px;
 display:flex;
 align-items:center
}
.addOnSegment__planName picture {
 margin-right:16px
}
.addOnSegment__planName>p {
 font-size:14px;
 font-weight:700
}
@media screen and (max-width:420px) {
 .addOnSegment__planName>p {
  font-size:3.8vw
 }
}
.bmiRejectionPlanWrapper {
 overflow:hidden
}
.bmiRejectionPlanWrapper>div {
 border-bottom:1px solid #dfe1e6;
 padding-bottom:16px;
 margin-bottom:16px
}
.bmiRejectionPlanWrapper>div:last-child {
 border-bottom:none;
 padding-bottom:0;
 margin-bottom:0
}
.bmiRejectionPlanWrapper>div>div {
 display:flex;
 align-items:center;
 font-size:16px;
 font-weight:700
}
@media screen and (max-width:420px) {
 .bmiRejectionPlanWrapper>div>div {
  font-size:4.5vw
 }
}
.bmiRejectionPlanWrapper>div>div picture {
 margin-right:12px
}
.alert-container {
 padding:0 16px 24px
}
.errorMsgBox {
 font-size:14px;
 font-weight:400;
 padding:12px 16px;
 border-radius:8px;
 color:#ff5630;
 border:1px solid #ff5630;
 background:#ffebe6;
 margin:0 0 12px
}
@media screen and (max-width:420px) {
 .errorMsgBox {
  font-size:3.8vw
 }
}
@media only screen and (max-width:1023px) {
 .errorMsgBox {
  margin-left:16px;
  margin-right:16px
 }
}
.successMsgBox {
 font-size:14px;
 font-weight:400;
 padding:12px 16px;
 border-radius:8px;
 color:#36b37e;
 border:1px solid #36b37e;
 background:#e3fcef;
 margin:0 0 12px
}
@media screen and (max-width:420px) {
 .successMsgBox {
  font-size:3.8vw
 }
}
@media only screen and (max-width:1023px) {
 .successMsgBox {
  margin-left:16px;
  margin-right:16px
 }
}
.planCardReview {
 background:#fffcf2;
 border:1px solid #ffc710;
 padding:12px;
 border-radius:10px;
 margin-bottom:16px
}
.planCardReview .planName {
 display:flex;
 align-items:center;
 margin-bottom:16px
}
.planCardReview .planName .insurer {
 width:54px;
 margin-right:12px
}
.planCardReview .planName .insurer img {
 width:54px;
 object-fit:cover
}
.planCardReview .planName .plan {
 width:calc(100% - 66px);
 font-size:14px;
 font-weight:700
}
@media screen and (max-width:420px) {
 .planCardReview .planName .plan {
  font-size:3.8vw
 }
}
.planCardReview .planDetails {
 display:flex;
 align-items:center;
 justify-content:space-between
}
.planCardReview .planDetails .cover {
 width:50px
}
.planCardReview .planDetails .members {
 width:calc(100% - 70px)
}
.colTitle {
 font-size:12px;
 font-weight:400;
 color:#7a869a
}
@media screen and (max-width:420px) {
 .colTitle {
  font-size:3.2vw
 }
}
.colValue {
 font-size:16px;
 font-weight:600;
 color:#253858;
 word-break:break-word
}
@media screen and (max-width:420px) {
 .colValue {
  font-size:4.5vw
 }
}
.reviewBlock {
 margin-top:48px
}
.reviewBlock .blockHead {
 display:flex;
 align-items:center;
 justify-content:space-between
}
.reviewBlock .blockHead p:first-child {
 font-size:18px;
 font-weight:700
}
@media screen and (max-width:420px) {
 .reviewBlock .blockHead p:first-child {
  font-size:5.1vw
 }
}
.reviewBlock .blockHead p.reviewPortMemberName {
 font-size:16px
}
@media screen and (max-width:420px) {
 .reviewBlock .blockHead p.reviewPortMemberName {
  font-size:4.5vw
 }
}
.reviewBlock .blockHead a {
 font-size:14px
}
@media screen and (max-width:420px) {
 .reviewBlock .blockHead a {
  font-size:3.8vw
 }
}
.reviewBlock .blockHead a:after {
 content:"";
 border:solid #ff5630;
 border-width:0 1px 1px 0;
 display:inline-block;
 padding:2px;
 transform:rotate(-45deg);
 position:relative;
 vertical-align:middle;
 margin-left:8px;
 right:2px
}
.reviewBlock .blockHead__member p {
 font-size:16px;
 font-weight:700;
 text-transform:capitalize
}
@media screen and (max-width:420px) {
 .reviewBlock .blockHead__member p {
  font-size:4.5vw
 }
}
.reviewBlock .reviewFieldsWrapper {
 display:flex;
 justify-content:space-between;
 align-items:flex-start;
 flex-wrap:wrap;
 margin-top:8px
}
.reviewBlock .reviewFieldsWrapper .reviewFieldsBlock {
 width:45%;
 padding-right:20px;
 margin-bottom:16px
}
.reviewBlock .reviewFieldsWrapper .reviewFieldsBlock:last-child,
.reviewBlock .reviewFieldsWrapper .reviewFieldsBlock:nth-last-child(2) {
 margin-bottom:0
}
.fixedCta {
 background:#fff;
 box-shadow:0 -3px 6px rgba(0,0,0,.16);
 padding:16px;
 position:sticky;
 bottom:0
}
.fixedCta .btn {
 margin-top:0
}
@media only screen and (max-width:1023px) {
 .allMemberMedicalMob {
  margin-top:40px
 }
}
.cancelBookingBtn {
 background:#fff;
 border:1px solid #505f79
}
.cancelBookingBtn,
.cancelBookingBtn:hover {
 color:#505f79!important
}
.cancelBookingBtn:disabled {
 background:#fff;
 color:#b3bac5!important;
 border-color:#b3bac5
}
.faqCardWrapper {
 background:#fff;
 overflow:hidden;
 margin:16px -16px;
 padding:0 0 16px
}
@media only screen and (min-width:1024px) {
 .faqCardWrapper {
  margin-left:0;
  margin-right:0;
  border-radius:10px
 }
}
.faqCardWrapper h6 {
 font-size:16px;
 color:#36b37e;
 font-weight:700;
 border-left:4px solid #36b37e;
 padding-left:10px;
 margin:16px 16px 0
}
@media screen and (max-width:420px) {
 .faqCardWrapper h6 {
  font-size:4.5vw
 }
}
.faqCardWrapper__card {
 display:inline-block;
 border-radius:10px;
 background:#fff;
 box-shadow:0 6px 16px rgba(37,56,88,.16);
 padding:12px;
 font-size:14px;
 color:#253858;
 white-space:normal;
 margin:16px;
 vertical-align:top
}
@media screen and (max-width:420px) {
 .faqCardWrapper__card {
  font-size:3.8vw
 }
}
@media only screen and (min-width:1024px) {
 .faqCardWrapper__card {
  font-size:16px
 }
}
@media only screen and (min-width:1024px) and (max-width:420px) {
 .faqCardWrapper__card {
  font-size:4.5vw
 }
}
.faqCardWrapper__card__ques {
 font-weight:600;
 margin-bottom:8px
}
.faqCardWrapper__card__ans a {
 text-transform:none
}
.faqCardWrapper__card__ans p {
 max-height:44px;
 overflow:hidden;
 text-overflow:ellipsis
}
@media only screen and (min-width:1024px) {
 .faqCardWrapper__card__ans p {
  max-height:50px
 }
}
.faqCardWrapper__card__viewAll {
 text-align:right;
 margin-top:16px
}
.faqCardWrapper__card__viewAll a {
 text-transform:none
}
.faqCardWrapper__card__viewAll a:after {
 content:"";
 border:solid #ff5630;
 border-width:0 1px 1px 0;
 display:inline-block;
 padding:2px;
 transform:rotate(-45deg);
 position:relative;
 top:-1px;
 margin-left:4px
}
@media only screen and (min-width:1024px) {
 .faqCardWrapper__card__viewAll a:after {
  top:-2px
 }
}
.faqCardWrapper__scroller {
 white-space:nowrap;
 transition:transform .3s,height .3s;
 -ms-overflow-style:none;
 scrollbar-width:none;
 display:list-item
}
.faqCardWrapper__scroller::-webkit-scrollbar {
 display:none
}
.faqCardWrapper__indicator {
 display:flex;
 align-items:center;
 justify-content:center;
 position:relative
}
.faqCardWrapper__indicator span {
 width:6px;
 height:6px;
 background:#7a869a;
 margin-right:4px;
 border-radius:50%
}
.faqCardWrapper__indicator span.active {
 background:#253858
}
.p0 .faqCardWrapper {
 padding-left:16px;
 padding-right:16px
}
.faqFullscreen {
 position:fixed;
 width:100%;
 height:100%;
 left:0;
 bottom:0;
 background:#fff;
 overflow:auto;
 -ms-overflow-style:none;
 scrollbar-width:none
}
.faqFullscreen::-webkit-scrollbar {
 display:none
}
.faqFullscreen__top {
 background:#e3fcef;
 padding:16px 16px 46px
}
@media only screen and (min-width:1024px) {
 .faqFullscreen__top {
  margin:0;
  padding:52px 40px 0 60px;
  height:100vh;
  background-color:#172b4d;
  width:378px
 }
}
.faqFullscreen__top .back {
 width:24px;
 height:24px;
 position:relative;
 left:-5px
}
.faqFullscreen__top .back:before {
 content:"";
 border:solid #253858;
 border-width:0 2px 2px 0;
 display:inline-block;
 padding:6px;
 transform:rotate(135deg);
 position:absolute;
 left:50%;
 top:50%;
 margin:-7px 0 0 -4px
}
@media only screen and (min-width:1024px) {
 .faqFullscreen__top .back {
  cursor:pointer
 }
}
.faqFullscreen__top .welcomeMsg {
 font-size:24px;
 font-weight:600;
 margin-top:24px
}
@media only screen and (min-width:1024px) {
 .faqFullscreen__top .welcomeMsg {
  font-size:32px;
  font-weight:700;
  color:#fff;
  background-color:#172b4d
 }
 .faqFullscreen__top .welcomeMsg span {
  display:block
 }
}
.faqFullscreen__mainCard {
 background:#fff;
 border-radius:32px 32px 0 0;
 padding:24px 0 16px;
 margin-top:-32px;
 animation:fade .3s ease-in .3s forwards
}
@keyframes fade {
 0% {
  opacity:0
 }
 to {
  opacity:1
 }
}
@media only screen and (min-width:1024px) {
 .faqFullscreen__mainCard {
  margin:84px auto 0;
  padding:0;
  width:calc(100% - 378px);
  position:relative
 }
}
.faqFullscreen__mainCard .popQueryHead {
 font-size:14px;
 font-weight:600;
 margin:0 0 8px 16px
}
@media screen and (max-width:420px) {
 .faqFullscreen__mainCard .popQueryHead {
  font-size:3.8vw
 }
}
@media only screen and (min-width:1024px) {
 .faqFullscreen__mainCard .popQueryHead {
  margin:0 0 14px;
  font-size:16px
 }
}
@media only screen and (min-width:1024px) and (max-width:420px) {
 .faqFullscreen__mainCard .popQueryHead {
  font-size:4.5vw
 }
}
.faqFullscreen__mainCard .faqChipsTabs {
 font-size:0;
 padding-left:16px;
 margin-bottom:16px;
 overflow:auto;
 white-space:nowrap;
 -ms-overflow-style:none;
 scrollbar-width:none
}
.faqFullscreen__mainCard .faqChipsTabs::-webkit-scrollbar {
 display:none
}
.faqFullscreen__mainCard .faqChipsTabs>p {
 font-size:14px;
 font-weight:600;
 height:36px;
 border:1px solid #5e6c84;
 border-radius:40px;
 padding:0 24px;
 display:inline-flex;
 align-items:center;
 margin-right:8px
}
@media screen and (max-width:420px) {
 .faqFullscreen__mainCard .faqChipsTabs>p {
  font-size:3.8vw
 }
}
.faqFullscreen__mainCard .faqChipsTabs>p.active {
 background:#f2fffa;
 color:#36b37e;
 border-color:#36b37e
}
.faqFullscreen__mainCard__faqList .faqList__faqCard {
 border-radius:10px;
 box-shadow:0 6px 16px rgba(37,56,88,.1);
 padding:12px;
 margin:0 16px 16px;
 display:flex;
 align-items:center;
 font-size:14px;
 position:relative
}
@media screen and (max-width:420px) {
 .faqFullscreen__mainCard__faqList .faqList__faqCard {
  font-size:3.8vw
 }
}
@media only screen and (min-width:1024px) {
 .faqFullscreen__mainCard__faqList .faqList__faqCard {
  margin:0 0 16px;
  cursor:pointer;
  padding:16px;
  font-size:16px
 }
}
@media only screen and (min-width:1024px) and (max-width:420px) {
 .faqFullscreen__mainCard__faqList .faqList__faqCard {
  font-size:4.5vw
 }
}
.faqFullscreen__mainCard__faqList .faqList__faqCard:after {
 content:"";
 border:solid #253858;
 border-width:0 2px 2px 0;
 display:inline-block;
 padding:3px;
 transform:rotate(-45deg);
 margin-left:16px
}
@media only screen and (min-width:1024px) {
 .faqFullscreen__mainCard__faqList .faqList__faqCard:after {
  position:absolute;
  right:16px
 }
}
.faqFullscreen__mainCard .faqQuesAns {
 padding:0 16px;
 margin-bottom:32px
}
@media only screen and (min-width:1024px) {
 .faqFullscreen__mainCard .faqQuesAns {
  padding:0
 }
}
.faqFullscreen__mainCard .faqQuesAns .faqQues {
 font-size:16px;
 font-weight:700;
 margin-bottom:12px
}
@media screen and (max-width:420px) {
 .faqFullscreen__mainCard .faqQuesAns .faqQues {
  font-size:4.5vw
 }
}
.faqFullscreen__mainCard .faqQuesAns .faqAns {
 font-size:14px
}
@media screen and (max-width:420px) {
 .faqFullscreen__mainCard .faqQuesAns .faqAns {
  font-size:3.8vw
 }
}
@media only screen and (min-width:1024px) {
 .faqFullscreen__mainCard .faqQuesAns .faqAns {
  font-size:16px
 }
}
@media only screen and (min-width:1024px) and (max-width:420px) {
 .faqFullscreen__mainCard .faqQuesAns .faqAns {
  font-size:4.5vw
 }
}
.proTip {
 font-size:14px;
 color:#00a3bf;
 border-radius:8px;
 border:1px solid #00a3bf;
 padding:16px 16px 16px 42px;
 margin:16px 16px 32px;
 background:#f2fdff url(https://static.pbcdn.in/health-cdn/images/insurer-logo/quotes-logos/protip.svg) no-repeat 8px 17px
}
@media screen and (max-width:420px) {
 .proTip {
  font-size:3.8vw
 }
}
.proTip h3 {
 display:inline-block;
 margin-right:4px
}
.proTip h3:after {
 content:":";
 display:inline-block;
 color:#00a3bf
}
@media only screen and (min-width:1024px) {
 .proTip {
  margin:16px 0 32px
 }
}
.faqKnowMore {
 margin:32px 16px 0;
 display:flex;
 flex-wrap:wrap;
 justify-content:space-between
}
@media only screen and (min-width:1024px) {
 .faqKnowMore {
  margin:32px 0 0;
  padding:0
 }
}
.faqKnowMore>p {
 color:#505f79;
 font-size:14px;
 text-align:center;
 width:100%;
 margin-bottom:12px
}
@media screen and (max-width:420px) {
 .faqKnowMore>p {
  font-size:3.8vw
 }
}
.faqKnowMore .faqButton {
 text-transform:none;
 font-size:16px;
 color:#ff5630;
 border-radius:8px;
 border:1px solid #ff5630;
 height:48px;
 width:48%;
 display:inline-flex;
 align-items:center;
 justify-content:center;
 font-weight:700;
 position:relative;
 cursor:pointer
}
@media screen and (max-width:420px) {
 .faqKnowMore .faqButton {
  font-size:4.5vw
 }
}
.faqKnowMore .faqButton .chat-count {
 right:-4px;
 bottom:30px
}
.faqCallbackBanner {
 margin:16px;
 background:#fff url(https://static.pbcdn.in/health-cdn/images/insurer-logo/quotes-logos/scheduleCallGraphic.svg) no-repeat 98% 90%;
 border-radius:8px;
 box-shadow:0 6px 16px rgba(37,56,88,.1);
 padding:12px 10px;
 width:66%
}
@media only screen and (min-width:1024px) {
 .faqCallbackBanner {
  background-size:200px;
  background-position:98% 60%;
  padding-right:220px;
  margin:40px auto 30px
 }
}
.faqCallbackBanner__title {
 font-size:16px;
 font-weight:700;
 color:#36b37e;
 border-left:4px solid #36b37e;
 padding-left:8px;
 margin:0 0 8px -10px
}
@media screen and (max-width:420px) {
 .faqCallbackBanner__title {
  font-size:4.5vw
 }
}
.faqCallbackBanner__desc {
 font-size:14px;
 margin-bottom:16px
}
@media screen and (max-width:420px) {
 .faqCallbackBanner__desc {
  font-size:3.8vw
 }
}
.faqCallbackBanner__cta {
 width:160px;
 height:36px;
 display:inline-flex;
 align-items:center;
 justify-content:center;
 border:1px solid #ff5630;
 color:#ff5630;
 font-size:14px;
 font-weight:700;
 border-radius:8px;
 cursor:pointer
}
@media screen and (max-width:420px) {
 .faqCallbackBanner__cta {
  font-size:3.8vw
 }
}
.helpfulFaq {
 border-top:1px solid #dfe1e6;
 border-bottom:1px solid #dfe1e6;
 display:flex;
 align-items:center;
 justify-content:space-between;
 margin:0 16px;
 padding:0 12px;
 height:54px;
 font-size:16px
}
@media screen and (max-width:420px) {
 .helpfulFaq {
  font-size:4.5vw
 }
}
@media only screen and (min-width:1024px) {
 .helpfulFaq {
  margin:0;
  padding:0
 }
}
.helpfulFaq .tagFaq {
 font-size:14px;
 color:#505f79;
 display:block;
 line-height:normal
}
@media screen and (max-width:420px) {
 .helpfulFaq .tagFaq {
  font-size:3.8vw
 }
}
.helpfulFaq .likeDisklikeFaq {
 display:flex;
 justify-content:space-between
}
.helpfulFaq .likeDisklikeFaq .likeFaq {
 width:24px;
 height:24px;
 background:url(https://static.pbcdn.in/health-cdn/images/insurer-logo/quotes-logos/helpful_faq.svg) no-repeat 0 0;
 margin-left:24px;
 cursor:pointer
}
.helpfulFaq .likeDisklikeFaq .dislike {
 background-position:0 -49px
}
.helpfulFaq .likeDisklikeFaq .likeTick {
 background-position:0 -100px
}
.helpfulFaq .likeDisklikeFaq .dislikeTick {
 background-position:0 -153px
}
.helpfulFaq .inner {
 width:300px;
 display:flex;
 margin:0 auto;
 justify-content:space-between;
 align-items:center
}
@media only screen and (min-width:1024px) {
 .faq_question_main {
  display:flex
 }
 .back {
  width:24px;
  height:24px;
  position:absolute;
  left:65px;
  cursor:pointer;
  top:-71px
 }
 .back:before {
  content:"";
  border:solid #253858;
  border-width:0 2px 2px 0;
  display:inline-block;
  padding:6px;
  transform:rotate(135deg);
  position:absolute;
  left:50%;
  top:50%;
  margin:-7px 0 0 -4px
 }
 .faqWebScroll {
  margin:0 auto;
  overflow:auto;
  max-height:calc(100vh - 85px);
  padding:10px 70px
 }
 .topBg_Faq {
  background:#e3fcef;
  max-width:800px;
  margin:0 auto
 }
 .faqWrapperIcons {
  display:flex;
  justify-content:flex-end
 }
 .faqArrows {
  display:flex
 }
 .arrowBox {
  width:24px;
  height:24px;
  border-radius:30px;
  background:#fff;
  border:1px solid #dfe1e6;
  margin:0 16px 0 0;
  cursor:pointer;
  font-size:0
 }
 .arrowBox:last-child {
  margin-right:0
 }
 .arrowBox:after {
  content:"";
  border:solid #253858;
  border-width:0 1.8px 1.8px 0;
  display:inline-block;
  padding:2px;
  transform:rotate(-45deg);
  position:relative;
  top:9px;
  margin-left:7px
 }
 .arrowBox.previous {
  margin:0 12px 0 0
 }
 .arrowBox.previous:after {
  transform:rotate(135deg);
  margin-left:10px
 }
}
@media only screen and (min-width:320px) and (max-width:1280px) {
 .faqCallbackBanner {
  width:auto
 }
}
.rowWrapperWall {
 max-width:1140px;
 margin:30px auto
}
.backWall {
 font-size:14px;
 font-weight:600;
 position:relative;
 display:inline-block;
 padding-left:24px;
 cursor:pointer;
 margin:0 0 24px
}
@media screen and (max-width:420px) {
 .backWall {
  font-size:3.8vw
 }
}
.backWall:before {
 border:solid #253858;
 border-width:0 2px 2px 0;
 display:inline-block;
 padding:3px;
 transform:rotate(135deg);
 top:60%;
 margin-top:-6px
}
.backWall:after,
.backWall:before {
 content:"";
 position:absolute;
 left:5px
}
.backWall:after {
 height:2px;
 width:10px;
 background:#253858;
 top:58%;
 margin-top:-2.5px
}
.wallHeader {
 display:flex;
 justify-content:space-between;
 align-items:center;
 margin:0 0 30px
}
.wallHeader h2 {
 font-size:32px;
 font-weight:400;
 line-height:46px
}
.wallHeader h2 span {
 display:block;
 font-weight:600
}
.wallPopular {
 display:flex
}
.wallPopular .popularBox {
 height:80px;
 width:200px;
 border-radius:8px;
 border-left:3px solid #2d3cd9;
 margin-left:16px;
 display:flex
}
.wallPopular .popularBox .textPopular {
 font-size:18px;
 font-weight:700;
 color:#2d3cd9;
 padding:15px 0 0
}
.wallPopular .popularBox .textPopular span {
 font-size:14px;
 display:block;
 color:#253858;
 font-weight:400
}
.wallPopular .popularBox .iconsWall {
 background:url(https://static.pbcdn.in/health-cdn/images/insurer-logo/quotes-logos/wall-sprite.svg) no-repeat 4px 0;
 width:38px;
 height:24px;
 margin:20px 8px 0
}
.wallPopular .popularBox .iconsWall.second {
 background-position:6px -68px
}
.wallPopular .popularBox .iconsWall.third {
 background-position:6px -139px
}
.wallPopular .second-Box {
 background:#fdf7f0;
 border-left-color:#ff9b2c
}
.wallPopular .second-Box .textPopular {
 color:#ff9b2c
}
.wallPopular .third-Box {
 background:#e9f5f2;
 border-left-color:#71c5a0
}
.wallPopular .third-Box .textPopular {
 color:#71c5a0
}
.wallPopular .first-Box {
 background:#f4f5fd
}
.cardContainer {
 display:grid;
 grid-template-columns:repeat(3,1fr);
 grid-gap:0 20px;
 grid-auto-rows:10px;
 margin-bottom:40px
}
.wallCard {
 box-shadow:0 6px 16px rgba(52,105,203,.16);
 border-radius:8px;
 padding:24px;
 margin-bottom:20px;
 cursor:pointer;
 position:relative;
 display:flex;
 flex-flow:wrap;
 background:#fff
}
.wallCard iframe {
 min-width:100%
}
@media only screen and (max-width:1024px) {
 .wallCard iframe {
  height:240px
 }
}
.wallCard .wallProfile {
 display:flex;
 width:100%
}
.wallCard .wallProfile .profileBox {
 min-width:58px;
 min-height:58px;
 max-width:58px;
 max-height:58px;
 border:1px solid #dfe1e6;
 border-radius:29px;
 overflow:hidden
}
.wallCard .wallProfile .profileBox img {
 width:100%;
 height:100%;
 border-radius:100%;
 object-fit:contain
}
.wallCard .wallProfile .profileContent {
 margin-left:20px
}
.wallCard .wallProfile .profileContent .nameWall {
 font-size:16px;
 color:#172b4d;
 font-weight:700;
 word-break:break-word
}
@media screen and (max-width:420px) {
 .wallCard .wallProfile .profileContent .nameWall {
  font-size:4.5vw
 }
}
.wallCard .wallProfile .profileContent .postWall {
 font-size:14px;
 color:#172b4d;
 font-weight:400
}
@media screen and (max-width:420px) {
 .wallCard .wallProfile .profileContent .postWall {
  font-size:3.8vw
 }
}
.wallCard .wallProfile .profileContent .sinceYear {
 color:#505f79;
 font-size:14px;
 font-weight:400
}
@media screen and (max-width:420px) {
 .wallCard .wallProfile .profileContent .sinceYear {
  font-size:3.8vw
 }
}
.wallCard .wallQuote {
 color:#172b4d;
 display:block;
 font-size:14px;
 padding:14px 0 0;
 word-break:break-word;
 display:-webkit-box;
 margin:0 0 8px;
 -webkit-line-clamp:4;
 -webkit-box-orient:vertical;
 overflow:hidden;
 text-overflow:ellipsis;
 line-height:24px
}
@media screen and (max-width:420px) {
 .wallCard .wallQuote {
  font-size:3.8vw
 }
}
.wallCard .wallQuote .comma {
 color:#0065ff
}
.wallCard .wallSocial {
 display:flex;
 padding-top:12px
}
.wallCard .wallSocial .likes {
 background:url(https://static.pbcdn.in/health-cdn/images/insurer-logo/quotes-logos/wall-sprite.svg) no-repeat -4px -204px;
 font-size:12px;
 color:#172b4d;
 padding:2px 0 0 30px
}
.wallCard .wallSocial .date {
 background:url(https://static.pbcdn.in/health-cdn/images/insurer-logo/quotes-logos/wall-sprite.svg) no-repeat -4px -258px;
 font-size:12px;
 color:#172b4d;
 padding:3px 0 0 30px
}
.wallCard .wallTagline {
 font-size:16px;
 color:#253858;
 font-weight:600;
 margin-bottom:20px;
 width:100%
}
@media screen and (max-width:420px) {
 .wallCard .wallTagline {
  font-size:4.5vw
 }
}
.wallCard .wallVideo {
 border-bottom:1px solid #dfe1e6;
 margin:0 auto 16px;
 text-align:center;
 padding-bottom:16px
}
.wallCard .wallSingleVideo {
 margin:0;
 padding-bottom:0;
 border-bottom:none
}
.wallCard .backDrop {
 background:rgba(37,56,88,.7);
 content:"";
 width:100%;
 height:100%;
 position:absolute;
 top:0;
 left:0;
 border-radius:8px;
 display:none;
 align-items:center;
 justify-content:center
}
.wallCard .backDrop .button {
 width:182px;
 border:1px solid #ff5630;
 color:#ff5630!important;
 background:#fff;
 border-radius:8px;
 padding:0;
 font-size:14px;
 font-weight:600;
 cursor:pointer;
 height:auto;
 line-height:48px
}
.wallCard:hover .backDrop {
 display:flex
}
.wallCardBanner {
 background:#e5f1ff;
 padding:16px;
 font-size:14px;
 font-weight:600;
 float:left;
 display:flex!important;
 flex-flow:nowrap;
 box-shadow:none
}
@media screen and (max-width:420px) {
 .wallCardBanner {
  font-size:3.8vw
 }
}
.wallCardBanner .bannerText1 {
 color:#6b778c
}
.wallCardBanner .bannerText2 {
 color:#253858;
 padding:6px 0
}
.wallCardBanner .bannerText3 {
 color:#ff5630;
 cursor:pointer
}
.wallCardBanner .bannerText3:after {
 content:"";
 border:solid #ff5630;
 border-width:0 1.5px 1.5px 0;
 display:inline-block;
 padding:2px;
 transform:rotate(-45deg);
 margin-left:3px;
 vertical-align:middle;
 position:relative;
 margin-top:-1px
}
.wall-modal {
 position:fixed;
 width:100%;
 height:100%;
 background:rgba(23,43,77,.9);
 z-index:99;
 animation:filterWebFade .3s ease-out;
 left:0;
 top:0
}
.wall-modal .modalInnerWeb {
 width:90%;
 max-width:800px;
 background:#fff;
 border-radius:8px;
 z-index:99;
 margin:3vh auto 0;
 max-height:90vh;
 overflow:auto;
 padding:24px 24px 0
}
.wall-modal .wallTop {
 width:100%;
 padding:0;
 justify-content:space-between;
 background:#fff;
 font-weight:500;
 color:#253858;
 font-size:14px;
 margin-bottom:8px;
 border-radius:8px 8px 0 0;
 display:flex
}
@media only screen and (max-width:1024px) {
 .wall-modal .wallTop {
  margin-bottom:16px
 }
}
.wall-modal .wallTop .cross_wallTop {
 height:36px;
 width:36px;
 cursor:pointer;
 text-align:center;
 position:relative;
 overflow:hidden;
 display:block;
 right:-10px;
 top:-10px
}
@media only screen and (max-width:1024px) {
 .wall-modal .wallTop .cross_wallTop {
  position:fixed;
  overflow:hidden;
  display:block;
  right:0;
  top:0;
  background:#fff
 }
}
.wall-modal .wallTop .cross_wallTop:after,
.wall-modal .wallTop .cross_wallTop:before {
 content:"";
 width:2px;
 height:20px;
 display:block;
 position:absolute;
 left:50%;
 top:50%;
 background:#253858
}
.wall-modal .wallTop .cross_wallTop:after {
 transform:translate(-50%,-50%) rotate(-45deg)
}
.wall-modal .wallTop .cross_wallTop:before {
 transform:translate(-50%,-50%) rotate(45deg)
}
.wall-modal .wallTop.wallFooter {
 box-shadow:0 -3px 6px 0 rgba(0,0,0,.16);
 border-radius:0;
 margin:0 -24px;
 width:797px;
 padding:10px 24px
}
@media only screen and (max-width:1024px) {
 .wall-modal .wallTop.wallFooter {
  width:117%;
  position:fixed;
  bottom:0;
  z-index:99
 }
}
.wall-modal .wallTop.wallFooter .wallProfileModal {
 align-items:center
}
.body-background {
 background-color:#fff!important
}
@media only screen and (max-width:1024px) {
 .body-background {
  background-color:#f5f6fc!important;
  padding-bottom:0
 }
}
.wallProfileModal {
 display:flex;
 align-items:center
}
@media only screen and (max-width:1024px) {
 .wallProfileModal {
  align-items:flex-start
 }
}
.wallProfileModal .profileBox {
 min-width:58px;
 min-height:58px;
 max-width:58px;
 max-height:58px;
 border:1px solid #dfe1e6;
 border-radius:29px;
 overflow:hidden;
 display:flex
}
.wallProfileModal .profileBox img {
 width:100%;
 height:100%;
 border-radius:100%;
 object-fit:contain
}
.wallProfileModal .profileContent {
 margin-left:20px
}
.wallProfileModal .profileContent .nameWall {
 font-size:16px;
 color:#172b4d;
 font-weight:700;
 margin-bottom:3px;
 word-break:break-word
}
@media screen and (max-width:420px) {
 .wallProfileModal .profileContent .nameWall {
  font-size:4.5vw
 }
}
.wallProfileModal .profileContent .postWall {
 font-size:14px;
 color:#172b4d;
 font-weight:400;
 display:inline-block
}
@media screen and (max-width:420px) {
 .wallProfileModal .profileContent .postWall {
  font-size:3.8vw
 }
}
.wallProfileModal .profileContent .sinceYear {
 color:#505f79;
 font-size:14px;
 font-weight:400;
 display:inline-block;
 margin-left:16px;
 margin-right:16px
}
@media screen and (max-width:420px) {
 .wallProfileModal .profileContent .sinceYear {
  font-size:3.8vw
 }
}
@media only screen and (max-width:1024px) {
 .wallProfileModal .profileContent .sinceYear {
  margin-left:0
 }
}
.wallSocialModal {
 display:inline-flex;
 font-weight:400;
 position:relative;
 padding-left:0
}
@media only screen and (max-width:1024px) {
 .wallSocialModal {
  margin-left:0;
  padding-left:0
 }
}
.wallSocialModal .likes {
 background:url(https://static.pbcdn.in/health-cdn/images/insurer-logo/quotes-logos/wall-sprite.svg) no-repeat -4px -204px;
 font-size:12px;
 color:#172b4d;
 padding:2px 0 0 30px
}
.wallSocialModal .date {
 background:url(https://static.pbcdn.in/health-cdn/images/insurer-logo/quotes-logos/wall-sprite.svg) no-repeat -6px -258px;
 font-size:12px;
 color:#172b4d;
 padding:3px 0 0 27px;
 margin:5px 0 0
}
.wallInnerContainer {
 padding:12px 12px 0 0;
 max-height:60vh;
 overflow:auto;
 margin-bottom:16px
}
@media only screen and (max-width:1024px) {
 .wallInnerContainer {
  max-height:inherit;
  padding:0 0 90px
 }
 .wallInnerContainer::-webkit-scrollbar {
  display:none
 }
}
.wallInnerContainer .modal-quote {
 font-size:16px;
 word-break:break-word
}
@media screen and (max-width:420px) {
 .wallInnerContainer .modal-quote {
  font-size:4.5vw
 }
}
@media only screen and (max-width:1024px) {
 .wallInnerContainer .modal-quote {
  font-size:14px
 }
}
@media only screen and (max-width:1024px) and (max-width:420px) {
 .wallInnerContainer .modal-quote {
  font-size:3.8vw
 }
}
.dataInsurer {
 display:flex;
 flex-flow:wrap;
 margin:0 0 0 12px;
 width:calc(100% - 92px)
}
@media only screen and (max-width:1024px) {
 .dataInsurer {
  width:100%;
  margin-left:0
 }
}
.dataItem {
 display:flex;
 width:33%;
 flex-direction:column;
 margin-bottom:20px;
 padding-right:12px
}
@media only screen and (max-width:1024px) {
 .dataItem {
  width:50%
 }
}
.dataItem .label {
 color:#505f79;
 font-size:12px;
 margin-bottom:5px;
 font-weight:400
}
@media screen and (max-width:420px) {
 .dataItem .label {
  font-size:3.2vw
 }
}
.dataItem .labelData {
 font-size:16px;
 color:#253858;
 font-weight:600;
 word-break:break-word
}
@media screen and (max-width:420px) {
 .dataItem .labelData {
  font-size:4.5vw
 }
}
@media only screen and (max-width:1024px) {
 .dataItem .labelData {
  font-size:14px
 }
}
@media only screen and (max-width:1024px) and (max-width:420px) {
 .dataItem .labelData {
  font-size:3.8vw
 }
}
.dataInsurerWrapper {
 display:flex;
 margin:26px 0 10px
}
@media only screen and (max-width:1024px) {
 .dataInsurerWrapper {
  flex-direction:column
 }
 .dataInsurerWrapper .insurerName {
  display:flex
 }
 .dataInsurerWrapper .insurerName>div {
  width:calc(100% - 92px);
  margin-left:12px
 }
}
.dataInsurerWrapper picture {
 width:80px;
 height:40px;
 padding:8px;
 background:#fff;
 border:1px solid #dfe1e6;
 border-radius:8px;
 display:flex;
 align-items:center;
 justify-content:center
}
.dataInsurerWrapper picture img {
 max-height:24px;
 display:block
}
ul.dataWallListing {
 counter-reset:my-sec-counter;
 padding-right:10px
}
ul.dataWallListing li {
 font-size:16px;
 position:relative;
 padding:0 0 24px 37px
}
@media screen and (max-width:420px) {
 ul.dataWallListing li {
  font-size:4.5vw
 }
}
@media only screen and (max-width:1024px) {
 ul.dataWallListing li {
  font-size:14px
 }
}
@media only screen and (max-width:1024px) and (max-width:420px) {
 ul.dataWallListing li {
  font-size:3.8vw
 }
}
ul.dataWallListing li:before {
 width:44px;
 height:44px;
 content:"0" counter(my-sec-counter);
 counter-increment:my-sec-counter;
 position:absolute;
 left:-11px;
 top:-9px;
 background:none;
 z-index:9;
 line-height:44px;
 text-align:center;
 font-size:18px;
 font-weight:500;
 display:block
}
ul.dataWallListing li h3 {
 font-size:16px;
 font-weight:700
}
@media screen and (max-width:420px) {
 ul.dataWallListing li h3 {
  font-size:4.5vw
 }
}
@media only screen and (max-width:1024px) {
 ul.dataWallListing li h3 {
  font-size:14px
 }
}
@media only screen and (max-width:1024px) and (max-width:420px) {
 ul.dataWallListing li h3 {
  font-size:3.8vw
 }
}
ul.dataWallListing li p {
 font-size:16px;
 color:#505f79;
 word-break:break-word
}
@media screen and (max-width:420px) {
 ul.dataWallListing li p {
  font-size:4.5vw
 }
}
@media only screen and (max-width:1024px) {
 ul.dataWallListing li p {
  font-size:14px;
  line-height:21px
 }
}
@media only screen and (max-width:1024px) and (max-width:420px) {
 ul.dataWallListing li p {
  font-size:3.8vw
 }
}
.wallInnerContainer::-webkit-scrollbar {
 width:6px
}
.wallInnerContainer::-webkit-scrollbar-track {
 background:#f1f1f1
}
.wallInnerContainer::-webkit-scrollbar-thumb {
 background:#b3bac5
}
.videoContainer {
 margin:0 0 20px
}
.videoContainer iframe {
 width:96%;
 height:350px
}
@media only screen and (min-width:1025px) {
 .hideBig {
  display:none!important
 }
}
@media only screen and (max-width:1024px) {
 .hideSmall {
  display:none!important
 }
 .hideBig.hideBig {
  display:block!important
 }
 body,
 html {
  background-color:#f5f6fc!important
 }
 .rowWrapper {
  max-width:100%;
  width:100%;
  padding:0
 }
 .wallHeader {
  display:inline
 }
 .wallHeader h2 {
  font-size:20px;
  line-height:30px;
  display:flex;
  flex-direction:column;
  position:relative;
  margin:0 0 24px 16px;
  padding-left:32px
 }
 .wallHeader h2 .backWall {
  position:absolute;
  top:18px;
  left:0
 }
 .cardContainer {
  display:block;
  column-count:1;
  column-gap:0;
  padding:0 16px
 }
 .cardContainer>div {
  display:inline-block;
  width:100%
 }
 .cardContainer .card-item {
  width:100%
 }
 .cardContainer .wallCard {
  padding:16px
 }
 .cardContainer .wallCard .wallSingleVideo,
 .cardContainer .wallCard .wallSingleVideo iframe,
 .cardContainer .wallCard .wallVideo iframe {
  width:100%
 }
 .cardContainer .wallCardBanner {
  padding:16px 12px
 }
 .wallPopular {
  overflow:hidden;
  overflow-x:auto;
  white-space:nowrap;
  display:inline-flex;
  align-items:flex-start;
  width:100%;
  margin-bottom:30px
 }
 .wallPopular .popularBox {
  display:inline-flex;
  min-width:200px
 }
 .wallPopular .first-Box {
  background:#eaecfa
 }
 .wallPopular::-webkit-scrollbar {
  display:none
 }
 .backWall:after {
  margin-top:-3.5px
 }
 .wall-modal .modalInnerWeb {
  max-height:unset;
  margin:0;
  border-radius:0;
  width:100%;
  height:100%;
  animation:filterSlideUp .3s ease-out;
  background:#fff;
  max-width:100%
 }
 .frame-Mobile {
  width:100%;
  height:320px
 }
 .viewDetailMobile {
  border-top:1px solid #dfe1e6;
  width:calc(100% + 32px);
  margin:16px -16px -8px;
  text-align:center;
  padding:12px 0 7px;
  color:#ff5630;
  font-size:14px;
  font-weight:600
 }
}
@media only screen and (max-width:1024px) and (max-width:420px) {
 .viewDetailMobile {
  font-size:3.8vw
 }
}
body {
 margin:0;
 padding:0;
 font-family:-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Oxygen-Sans,Ubuntu,Cantarell,Helvetica Neue,sans-serif;
 line-height:1.5;
 color:#253858
}
.fitBg {
 background:#fff
}
@media only screen and (max-width:1024px) {
 .fitBg {
  background:#fff!important
 }
}
h1,
h2,
h3,
h4,
h5,
h6,
li,
ol,
p,
ul {
 margin:0;
 padding:0
}
@media only screen and (min-width:1024px) {
 .fitPassDesktopFirstScroll {
  min-height:calc(100vh - 120px)
 }
}
.rowWrapperFit {
 width:1140px;
 margin:0 auto
}
@media only screen and (max-width:1024px) {
 .rowWrapperFit {
  width:100%;
  padding:0 16px
 }
}
.headerWrapperFit {
 box-shadow:0 3px 6px 0 rgba(0,0,0,.16);
 width:100%;
 background:#fff;
 position:relative;
 z-index:3;
 height:72px;
 display:flex
}
@media only screen and (max-width:1024px) {
 .headerWrapperFit {
  height:48px;
  box-shadow:none;
  border-bottom:1px solid #dfe1e6
 }
}
.headerWrapperFit .headerInnerWrapperFit {
 display:flex;
 justify-content:space-between;
 align-items:center
}
@media only screen and (max-width:1024px) {
 .headerWrapperFit .headerInnerWrapperFit {
  padding:0 16px
 }
}
.headerWrapperFit .pbLogoF {
 background:url(https://static.pbcdn.in/health-cdn/images/fitpass/sprite_fitPass.svg) no-repeat -5px -3px;
 width:192px;
 height:32px
}
@media only screen and (max-width:1024px) {
 .headerWrapperFit .pbLogoF {
  background-size:80%;
  height:24px;
  background-position:-2px -1px
 }
}
.linkCallFit {
 font-weight:600;
 font-size:14px;
 color:#0065ff;
 padding-left:32px
}
@media screen and (max-width:420px) {
 .linkCallFit {
  font-size:3.8vw
 }
}
.linkCallFit:before {
 content:"";
 background:url(https://static.pbcdn.in/health-cdn/images/fitpass/sprite_fitPass.svg) no-repeat -6px -217px;
 width:17px;
 height:18px;
 left:8px;
 top:29px;
 position:absolute
}
.toll-link-fit {
 position:relative;
 cursor:pointer;
 height:72px;
 display:flex;
 align-items:center
}
@media only screen and (max-width:1024px) {
 .toll-link-fit {
  display:none
 }
}
.toll-link-fit .toll_wrapper_web_fit {
 display:none
}
.toll-link-fit:hover .toll_wrapper_web_fit {
 display:block;
 position:absolute;
 right:0;
 width:285px;
 border-radius:0 0 8px 8px;
 box-shadow:0 8px 19px -1px rgba(0,0,0,.3);
 background-color:#fff;
 padding:0 20px 20px;
 top:79px
}
.toll-link-fit:hover .toll_wrapper_web_fit:after {
 position:absolute;
 top:-14px;
 right:19px;
 content:"";
 width:0;
 height:0;
 border-left:14px solid transparent;
 border-right:14px solid transparent;
 border-bottom:14px solid #fff
}
.toll-link-fit:hover .toll_wrapper_web_fit .toll_inner_wrapper_fit {
 display:grid;
 grid-template-columns:inherit;
 text-align:left;
 color:#979797;
 font-size:14px;
 line-height:22px;
 margin-top:20px
}
@media screen and (max-width:420px) {
 .toll-link-fit:hover .toll_wrapper_web_fit .toll_inner_wrapper_fit {
  font-size:3.8vw
 }
}
.toll-link-fit:hover .toll_wrapper_web_fit .toll_inner_wrapper_fit a {
 font-size:16px;
 font-weight:600;
 color:#0065ff
}
@media screen and (max-width:420px) {
 .toll-link-fit:hover .toll_wrapper_web_fit .toll_inner_wrapper_fit a {
  font-size:4.5vw
 }
}
@media only screen and (max-width:1023px) {
 .heroTitle {
  background:#f9fafb;
  padding-bottom:56px
 }
}
.heroTitle h3 {
 font-size:48px;
 font-weight:700;
 margin:95px 0 8px
}
@media only screen and (max-width:1023px) {
 .heroTitle h3 {
  margin:32px 0 0;
  text-align:center;
  font-size:24px
 }
}
.heroTitle h3 span {
 color:#0065ff
}
.heroTitle h3 em {
 font-style:normal
}
.heroTitle h3 .priceMembership {
 text-decoration:line-through;
 padding:0 10px
}
@media only screen and (max-width:1024px) {
 .heroTitle h3 .priceMembership {
  padding:0 5px
 }
}
.heroTitle h3 .free {
 color:#36b37e
}
.heroTitle .subTitle {
 font-size:16px;
 padding-right:90px;
 display:block
}
@media screen and (max-width:420px) {
 .heroTitle .subTitle {
  font-size:4.5vw
 }
}
.innerWrpperFit {
 display:flex;
 justify-content:space-between;
 align-items:flex-start;
 margin-top:48px;
 position:relative
}
@media only screen and (max-width:1024px) {
 .innerWrpperFit {
  flex-direction:column;
  justify-content:left;
  margin-top:0
 }
}
.innerWrpperFit .leftBoxFit {
 width:580px;
 margin-bottom:30px
}
@media only screen and (max-width:1024px) {
 .innerWrpperFit .leftBoxFit {
  width:100%;
  margin-bottom:0;
  padding:0 6px 48px;
  position:relative
 }
}
.innerWrpperFit .leftBoxFit .headingLeft {
 font-size:18px;
 text-align:left
}
@media screen and (max-width:420px) {
 .innerWrpperFit .leftBoxFit .headingLeft {
  font-size:5.1vw
 }
}
@media only screen and (max-width:1024px) {
 .innerWrpperFit .leftBoxFit .headingLeft {
  font-size:14px;
  margin-right:16px
 }
}
@media only screen and (max-width:1024px) and (max-width:420px) {
 .innerWrpperFit .leftBoxFit .headingLeft {
  font-size:3.8vw
 }
}
.innerWrpperFit .leftBoxFit .headingLeft span {
 font-weight:700;
 color:#00a3bf
}
.innerWrpperFit .rightBoxFit {
 width:485px;
 border-radius:24px;
 box-shadow:0 6px 16px 0 rgba(0,0,0,.16);
 padding:24px;
 margin-bottom:42px;
 background:#fff
}
@media only screen and (max-width:1024px) {
 .innerWrpperFit .rightBoxFit {
  width:100%;
  box-shadow:0 -16px 16px rgba(23,76,255,.06);
  padding:0 16px;
  border-radius:24px 24px 0 0;
  position:relative;
  top:-24px;
  margin-bottom:0
 }
}
.innerWrpperFit .rightBoxFit .rightHeading {
 font-size:24px;
 font-weight:700;
 line-height:32px
}
.innerWrpperFit .rightBoxFit .formContainerFit {
 margin:22px 0 0
}
.innerWrpperFit .rightBoxFit .formContainerFit .labelFit {
 font-size:18px;
 font-weight:700
}
@media screen and (max-width:420px) {
 .innerWrpperFit .rightBoxFit .formContainerFit .labelFit {
  font-size:5.1vw
 }
}
@media only screen and (max-width:1024px) {
 .innerWrpperFit .rightBoxFit .formContainerFit .labelFit {
  font-size:16px
 }
}
@media only screen and (max-width:1024px) and (max-width:420px) {
 .innerWrpperFit .rightBoxFit .formContainerFit .labelFit {
  font-size:4.5vw
 }
}
.innerWrpperFit .rightBoxFit .formContainerFit .errorFit {
 font-size:12px;
 color:#ff5630
}
@media screen and (max-width:420px) {
 .innerWrpperFit .rightBoxFit .formContainerFit .errorFit {
  font-size:3.2vw
 }
}
.fitpassLogo {
 display:block;
 width:180px;
 height:38px;
 background:url(https://static.pbcdn.in/health-cdn/images/fitpass/sprite_fitPass.svg) no-repeat 0 -184px;
 background-size:280px;
 margin-bottom:8px
}
@media only screen and (max-width:1023px) {
 .fitpassLogo {
  margin:0 auto
 }
}
.selectionWrapperFit {
 margin:0
}
.selectionWrapperFit .SelectionInnerFit {
 position:relative
}
.selectionWrapperFit .SelectionInnerFit input+label {
 display:flex;
 flex-direction:row;
 width:100%;
 border:1px solid #dfe1e6;
 padding:0 0 0 44px;
 margin:12px 0 0;
 align-items:center;
 border-radius:8px;
 height:48px;
 font-size:16px;
 cursor:pointer
}
@media screen and (max-width:420px) {
 .selectionWrapperFit .SelectionInnerFit input+label {
  font-size:4.5vw
 }
}
@media only screen and (max-width:1024px) {
 .selectionWrapperFit .SelectionInnerFit input+label {
  cursor:none
 }
}
.selectionWrapperFit .SelectionInnerFit input:checked+label {
 border-color:#36b37e;
 color:#36b37e
}
.selectionWrapperFit .SelectionInnerFit .inputRadioFit {
 -webkit-appearance:none;
 outline:none;
 width:18px;
 height:18px;
 margin:0 5px 0 0;
 border-radius:30px;
 background-color:#fff;
 border:1px solid #5e6c84;
 vertical-align:middle;
 position:absolute;
 top:16px;
 left:16px
}
.selectionWrapperFit .SelectionInnerFit .inputRadioFit:checked {
 background-color:#36b37e;
 border:1px solid #36b37e
}
.selectionWrapperFit .SelectionInnerFit .inputRadioFit:checked:before {
 background:#fff;
 border:1px solid #fff;
 top:4px;
 left:4px;
 width:8px;
 height:8px;
 content:"";
 display:block;
 position:relative;
 border-radius:50%
}
.fieldFitPass {
 position:relative;
 margin:16px 0 8px
}
.fieldFitPass input {
 width:100%;
 -webkit-appearance:none;
 outline:none;
 height:100%;
 padding:16px;
 font-weight:400;
 border-radius:8px!important;
 background:#fff;
 border:1px solid #5e6c84;
 height:56px;
 font-size:16px;
 color:#253858
}
@media screen and (max-width:420px) {
 .fieldFitPass input {
  font-size:4.5vw
 }
}
.fieldFitPass label {
 position:absolute;
 color:#5e6c84;
 top:50%;
 left:8px;
 padding:0 8px;
 background:#fff;
 transform:translateY(-50%);
 transition:all .3s ease-in
}
.fieldFitPass input:focus+label,
.fieldFitPass input:not(:placeholder-shown)+label {
 font-size:12px;
 transform:none;
 top:-10px;
 color:#253858;
 letter-spacing:normal
}
@media screen and (max-width:420px) {
 .fieldFitPass input:focus+label,
 .fieldFitPass input:not(:placeholder-shown)+label {
  font-size:3.2vw
 }
}
.fieldFitPass input:disabled {
 border-color:#97a0af;
 color:#7a869a;
 cursor:not-allowed
}
.fieldFitPass input:disabled+label {
 color:#7a869a
}
.buttonFit {
 border-radius:8px;
 height:48px;
 font-size:16px;
 font-weight:600;
 width:100%;
 border:none;
 outline:none;
 margin:24px 0;
 background:#ff5630;
 color:#fff;
 cursor:pointer
}
@media screen and (max-width:420px) {
 .buttonFit {
  font-size:4.5vw
 }
}
@media only screen and (max-width:1024px) {
 .buttonFit {
  cursor:none
 }
}
.buttonFit:disabled {
 background:#dfe1e6;
 color:#7a869a!important;
 cursor:auto
}
.termFit {
 font-size:14px;
 text-align:center
}
@media screen and (max-width:420px) {
 .termFit {
  font-size:3.8vw
 }
}
@media only screen and (max-width:1024px) {
 .termFit {
  font-size:12px;
  text-align:center
 }
}
@media only screen and (max-width:1024px) and (max-width:420px) {
 .termFit {
  font-size:3.2vw
 }
}
.termFit span {
 color:#0065ff;
 cursor:pointer
}
h3.sectionHead {
 font-size:40px;
 font-weight:700;
 position:relative;
 padding-left:20px
}
h3.sectionHead:before {
 content:"";
 position:absolute;
 height:100%;
 width:4px;
 background:#0065ff;
 left:0
}
@media only screen and (max-width:1024px) {
 h3.sectionHead {
  font-size:20px
 }
}
.faqWrapperFit {
 margin:32px 0 46px
}
@media only screen and (max-width:1023px) {
 .faqWrapperFit {
  padding:0 16px
 }
}
@media only screen and (max-width:1024px) {
 .faqWrapperFit {
  margin:0;
  padding-bottom:16px
 }
}
.faqWrapperFit .accordionSectionFit {
 position:relative;
 z-index:2;
 border:1px solid #dfe1e6;
 border-radius:4px;
 margin:16px 0 0
}
.faqWrapperFit .accordionSectionFit input[type=checkbox] {
 position:absolute;
 opacity:0;
 z-index:-1
}
.faqWrapperFit .accordionSectionFit>label {
 padding:16px;
 width:100%;
 display:block;
 cursor:pointer;
 position:relative
}
@media only screen and (max-width:1024px) {
 .faqWrapperFit .accordionSectionFit>label {
  cursor:none
 }
}
.faqWrapperFit .accordionSectionFit>label:after {
 content:"+";
 display:inline-block;
 padding:4px;
 vertical-align:middle;
 position:absolute;
 right:12px;
 top:8%;
 transition:all .3s ease-in;
 font-size:24px
}
.faqWrapperFit .accordionSectionFit .accordionContentFit {
 max-height:0;
 transition:all .35s;
 opacity:0;
 display:none
}
.faqWrapperFit .accordionSectionFit input[type=checkbox]:checked+label {
 font-weight:700
}
.faqWrapperFit .accordionSectionFit input[type=checkbox]:checked+label:after {
 content:"-";
 font-weight:400
}
.faqWrapperFit .accordionSectionFit input[type=checkbox]:checked~.accordionContentFit {
 max-height:100%;
 opacity:1;
 display:block;
 padding:0 16px 16px
}
.footerFit {
 background:#f9fafb;
 width:100%;
 padding:0
}
.footerFit .innerFooterFit {
 width:1140px;
 margin:0 auto;
 padding:32px 0 0;
 color:#7a869a;
 font-size:14px;
 line-height:22px
}
@media screen and (max-width:420px) {
 .footerFit .innerFooterFit {
  font-size:3.8vw
 }
}
@media only screen and (min-width:1024px) {
 .footerFit .innerFooterFit.btmPad {
  padding-bottom:80px
 }
}
@media only screen and (max-width:1023px) {
 .footerFit .innerFooterFit.btmPad {
  padding-bottom:110px
 }
}
.footerFit .innerFooterFit a {
 color:#7a869a
}
@media only screen and (max-width:1024px) {
 .footerFit .innerFooterFit {
  width:100%;
  padding:16px 16px 0
 }
}
.footerFit .innerFooterFit p {
 padding-bottom:24px;
 text-align:center
}
@media only screen and (max-width:1024px) {
 .footerFit .innerFooterFit p {
  text-align:left
 }
}
.congoBox {
 margin:48px auto 60px;
 padding:0 103px;
 display:flex;
 justify-content:space-between;
 align-items:center
}
@media only screen and (max-width:1023px) {
 .congoBox {
  width:100%;
  flex-direction:column;
  justify-content:left;
  text-align:center;
  margin:24px auto 0;
  padding:0 16px
 }
}
.congoBox .leftCongo {
 width:425px
}
@media only screen and (max-width:1023px) {
 .congoBox .leftCongo {
  order:2;
  margin-top:16px;
  width:100%
 }
}
.congoBox .leftCongo h3 {
 font-size:32px;
 font-weight:700;
 color:#36b37e;
 margin-bottom:24px
}
@media only screen and (max-width:1023px) {
 .congoBox .leftCongo h3 {
  font-size:18px;
  margin-bottom:8px
 }
}
.congoBox .leftCongo .codeBox {
 font-size:18px
}
@media screen and (max-width:420px) {
 .congoBox .leftCongo .codeBox {
  font-size:5.1vw
 }
}
@media only screen and (max-width:1024px) {
 .congoBox .leftCongo .codeBox {
  font-size:14px
 }
}
@media only screen and (max-width:1024px) and (max-width:420px) {
 .congoBox .leftCongo .codeBox {
  font-size:3.8vw
 }
}
.congoBox .leftCongo .codeBox span {
 font-size:24px;
 font-weight:700;
 display:block
}
.congoBox .leftCongo .availText {
 font-size:14px;
 border-bottom:1px dashed #253858;
 cursor:pointer;
 display:inline-block;
 width:auto
}
@media screen and (max-width:420px) {
 .congoBox .leftCongo .availText {
  font-size:3.8vw
 }
}
.congoBox .leftCongo .availText a {
 color:#253858;
 font-weight:400
}
@media only screen and (max-width:1024px) {
 .congoBox .leftCongo .availText {
  margin-bottom:24px;
  cursor:none
 }
}
.congoBox .leftCongo .buttonFit {
 width:328px
}
@media only screen and (max-width:1023px) {
 .congoBox .leftCongo .buttonFit {
  width:100%;
  margin:16px 0
 }
}
.congoBox .rightCongo {
 width:372px
}
@media only screen and (max-width:1023px) {
 .congoBox .rightCongo {
  order:1
 }
 .congoBox .rightCongo img {
  width:228px
 }
}
.fitModal {
 position:fixed;
 width:100%;
 height:100%;
 background:rgba(23,43,77,.9);
 z-index:99;
 animation:filterWebFade .3s ease-out;
 left:0;
 top:0
}
.fitModal .modalInnerWeb {
 width:90%;
 max-width:1140px;
 background:#fff;
 border-radius:8px;
 z-index:99;
 margin:24px auto;
 overflow:hidden;
 padding:24px 24px 0
}
@media only screen and (max-width:1024px) {
 .fitModal .modalInnerWeb {
  width:100%;
  max-width:100%;
  height:100vh;
  margin:0;
  border-radius:0;
  padding:16px
 }
}
.fitModal .modalInnerWeb .topSection {
 display:flex;
 justify-content:space-between;
 align-items:center;
 font-size:18px;
 font-weight:700;
 margin:0 0 16px
}
@media screen and (max-width:420px) {
 .fitModal .modalInnerWeb .topSection {
  font-size:5.1vw
 }
}
.fitModal .modalInnerWeb p {
 font-size:14px;
 margin-bottom:32px;
 line-height:22px
}
@media screen and (max-width:420px) {
 .fitModal .modalInnerWeb p {
  font-size:3.8vw
 }
}
.fitModal .modalInnerWeb .boxHeightFit {
 height:80vh;
 overflow-y:scroll;
 margin-right:16px;
 margin-bottom:24px;
 padding-right:16px
}
@media only screen and (max-width:1024px) {
 .fitModal .modalInnerWeb .boxHeightFit {
  height:90%
 }
}
@keyframes filterWebFade {
 0% {
  opacity:0
 }
 to {
  opacity:1
 }
}
.fitModal .closeFit {
 height:36px;
 width:36px;
 cursor:pointer;
 text-align:center;
 border-radius:50%;
 position:relative;
 overflow:hidden;
 display:block;
 right:0;
 top:0;
 text-indent:-9999999px
}
@media only screen and (max-width:1024px) {
 .fitModal .closeFit {
  cursor:none
 }
}
.fitModal .closeFit:after,
.fitModal .closeFit:before {
 content:"";
 width:2px;
 height:20px;
 display:block;
 position:absolute;
 left:78%;
 top:50%;
 background:#253858
}
.fitModal .closeFit:after {
 transform:translate(-50%,-50%) rotate(-45deg)
}
.fitModal .closeFit:before {
 transform:translate(-50%,-50%) rotate(45deg)
}
.call-toll-fit {
 background:#ddfeef url(https://static.pbcdn.in/health-cdn/images/fitpass/sprite_fitPass.svg) no-repeat 1px -63px;
 width:32px;
 height:32px;
 text-indent:-999999px;
 display:flex;
 border-radius:50%
}
.carousel .slide img {
 width:auto!important
}
.carousel.carousel-slider {
 overflow:inherit!important
}
.carousel .control-dots .dot {
 background:#7a869a!important;
 box-shadow:none!important
}
.carousel .control-dots .dot.selected,
.carousel .control-dots .dot:hover {
 background:#253858!important
}
.carousel .control-dots {
 bottom:-40px!important
}
@media only screen and (max-width:1024px) {
 .carousel .control-dots {
  bottom:-19px!important
 }
}
.carousel.carousel-slider .control-arrow,
.carousel .carousel-status {
 display:none
}
.textSelectFit {
 color:#505f79;
 font-size:14px;
 display:block;
 font-weight:400
}
@media screen and (max-width:420px) {
 .textSelectFit {
  font-size:3.8vw
 }
}
@media only screen and (max-width:1023px) {
 .hideSmall {
  display:none!important
 }
 .box-mob1 {
  width:50%
 }
 .txtbig {
  font-size:18px;
  font-weight:600;
  color:#0065ff
 }
}
@media only screen and (max-width:1023px) and (max-width:420px) {
 .txtbig {
  font-size:5.1vw
 }
}
.bgElements {
 position:absolute;
 width:100%;
 height:100%
}
@media only screen and (max-width:1023px) {
 .bgElements {
  top:0
 }
}
.bgElements i {
 position:absolute
}
.bgElements .el_circle {
 width:18px;
 height:18px;
 border:3px solid #aed2ff;
 top:20px;
 left:335px;
 border-radius:50%
}
@media only screen and (max-width:1023px) {
 .bgElements .el_circle {
  left:285px;
  top:32px
 }
}
.bgElements .el_circle.el_circle2 {
 top:540px;
 left:451px
}
.bgElements .el_circle.el_circle3 {
 top:505px;
 left:72px
}
.bgElements .el_cross {
 width:16px;
 height:16px;
 top:88px;
 left:531px
}
.bgElements .el_cross:after,
.bgElements .el_cross:before {
 content:"";
 width:3px;
 height:100%;
 transform:rotate(45deg);
 position:absolute;
 background:#aed2ff
}
.bgElements .el_cross:after {
 transform:rotate(-45deg)
}
.bgElements .el_cross.el_cross2 {
 top:505px;
 left:72px
}
.bgElements .el_square {
 width:18px;
 height:18px;
 border:3px solid #aed2ff;
 top:436px;
 left:281px;
 transform:rotate(45deg)
}
.bgElements .el_square.el_square2 {
 top:88px;
 left:531px
}
@media only screen and (max-width:1023px) {
 .bgElements .el_square {
  left:47px;
  top:182px
 }
}
.bgElements .el_spiral {
 width:200px;
 height:210px;
 top:361px;
 left:546px
}
.bgElements .el_spiral i {
 border:2px solid #aed2ff;
 border-radius:50%;
 left:50%;
 top:50%;
 transform:translate(-50%,-50%)
}
.bgElements .el_spiral i:first-child {
 width:186px;
 height:195px
}
.bgElements .el_spiral i:nth-child(2) {
 width:172px;
 height:180px
}
.bgElements .el_spiral i:nth-child(3) {
 width:158px;
 height:165px
}
.bgElements .el_spiral i:nth-child(4) {
 width:144px;
 height:150px
}
.bgElements .el_spiral i:nth-child(5) {
 width:130px;
 height:135px
}
.bgElements .el_spiral i:nth-child(6) {
 width:116px;
 height:120px
}
.bgElements .el_spiral i:nth-child(7) {
 width:102px;
 height:105px
}
.bgElements .el_spiral i:nth-child(8) {
 width:88px;
 height:90px
}
.bgElements .el_spiral i:nth-child(9) {
 width:74px;
 height:75px
}
.bgElements .el_spiral i:nth-child(10) {
 width:60px;
 height:60px
}
.bgElements .el_spiral i:nth-child(11) {
 width:46px;
 height:45px
}
.bgElements .el_spiral i:nth-child(12) {
 width:32px;
 height:30px
}
.bgElements .el_spiral i:nth-child(13) {
 width:18px;
 height:15px
}
.bgElements .el_spiral i:nth-child(14) {
 width:4px;
 height:0
}
.bgElements .el_pattern {
 display:flex;
 flex-wrap:wrap;
 width:110px;
 top:65px;
 right:-100px;
 gap:16px
}
.bgElements .el_pattern i {
 position:static;
 width:8px;
 height:8px;
 border-radius:50%;
 background:#aed2ff
}
.scrollIcon {
 position:absolute;
 bottom:0;
 left:50%;
 transform:translateX(-50%);
 z-index:2
}
.scrollIcon a {
 display:block;
 width:24px;
 height:36px;
 border:2px solid #0065ff;
 border-radius:15px;
 margin:0 auto 25px;
 position:relative;
 background:#fff
}
.scrollIcon a:before {
 content:"";
 border:solid #0065ff;
 border-width:0 2px 2px 0;
 display:inline-block;
 padding:3px;
 position:absolute;
 left:50%;
 margin-left:-1px;
 transform:rotate(45deg) translateX(-50%);
 animation:scrollIcon 1s linear infinite alternate
}
@keyframes scrollIcon {
 0% {
  top:12px
 }
 to {
  top:22px
 }
}
.fitpassExplainWrapper {
 margin:70px 0
}
@media only screen and (max-width:1023px) {
 .fitpassExplainWrapper {
  margin:32px 0;
  padding:0 16px
 }
}
.fitpassExplainWrapper ul li {
 margin-top:60px;
 display:flex;
 align-items:center;
 justify-content:space-between
}
@media only screen and (max-width:1023px) {
 .fitpassExplainWrapper ul li {
  margin-top:32px;
  flex-direction:column
 }
}
.fitpassExplainWrapper ul li i {
 width:360px;
 height:270px;
 background:url(https://static.pbcdn.in/health-cdn/images/fitpass/fitpassIllustrations.svg) no-repeat
}
@media only screen and (max-width:1023px) {
 .fitpassExplainWrapper ul li i {
  width:187px;
  height:140px;
  background-size:187px;
  margin-bottom:16px
 }
}
.fitpassExplainWrapper ul li i.onePass {
 background-position:0 0
}
.fitpassExplainWrapper ul li i.anyhow {
 background-position:0 -340px
}
@media only screen and (max-width:1023px) {
 .fitpassExplainWrapper ul li i.anyhow {
  background-position:0 -177px
 }
}
.fitpassExplainWrapper ul li i.anywhere {
 background-position:0 -680px
}
@media only screen and (max-width:1023px) {
 .fitpassExplainWrapper ul li i.anywhere {
  background-position:0 -354px
 }
}
.fitpassExplainWrapper ul li>div {
 width:460px
}
@media only screen and (max-width:1023px) {
 .fitpassExplainWrapper ul li>div {
  width:100%
 }
}
.fitpassExplainWrapper ul li>div h4 {
 font-size:32px;
 font-weight:700;
 margin-bottom:16px
}
.fitpassExplainWrapper ul li>div h4:after {
 content:"";
 display:block;
 width:50px;
 height:4px;
 background:#0065ff
}
@media only screen and (max-width:1023px) {
 .fitpassExplainWrapper ul li>div h4 {
  font-size:16px;
  margin-bottom:8px
 }
}
@media only screen and (max-width:1023px) and (max-width:420px) {
 .fitpassExplainWrapper ul li>div h4 {
  font-size:4.5vw
 }
}
@media only screen and (max-width:1023px) {
 .fitpassExplainWrapper ul li>div h4:after {
  content:none
 }
}
.fitpassExplainWrapper ul li>div p {
 color:#505f79
}
@media only screen and (max-width:1023px) {
 .fitpassExplainWrapper ul li>div p {
  font-size:14px
 }
}
@media only screen and (max-width:1023px) and (max-width:420px) {
 .fitpassExplainWrapper ul li>div p {
  font-size:3.8vw
 }
}
@media only screen and (min-width:1024px) {
 .fitpassExplainWrapper ul li {
  padding:0 48px
 }
 .fitpassExplainWrapper ul li:nth-child(2) i {
  order:2
 }
}
@media only screen and (max-width:1023px) {
 .mobileWrap {
  padding:0
 }
}
.consentPop {
 position:relative
}
@media only screen and (min-width:1024px) {
 .consentPop {
  max-width:800px!important
 }
}
@media only screen and (max-width:1023px) {
 .consentPop .boxHeightFit {
  padding-right:0!important
 }
}
.consentPop .consentInfo {
 display:flex;
 flex-wrap:wrap
}
@media only screen and (max-width:1023px) {
 .consentPop .consentInfo {
  flex-direction:column
 }
}
.consentPop .infoBlocks {
 font-size:16px;
 color:#253858;
 font-weight:600
}
@media screen and (max-width:420px) {
 .consentPop .infoBlocks {
  font-size:4.5vw
 }
}
@media only screen and (min-width:1024px) {
 .consentPop .infoBlocks:last-of-type {
  margin-left:120px
 }
}
.consentPop .infoBlocks span {
 font-size:12px;
 color:#505f79;
 font-weight:400;
 display:block
}
@media screen and (max-width:420px) {
 .consentPop .infoBlocks span {
  font-size:3.2vw
 }
}
.consentPop input[type=text] {
 border:1px solid #5e6c84;
 outline:none;
 color:#253858;
 width:180px;
 height:36px;
 border-radius:8px;
 margin-right:8px
}
@media only screen and (max-width:1023px) {
 .consentPop input[type=text] {
  width:100%;
  margin:8px 0;
  height:48px
 }
}
.consentPop input[type=text].errorFld {
 border-color:#ff5630
}
.consentPop .consentButtonStrip {
 position:sticky;
 position:-webkit-sticky;
 bottom:0;
 background:#fff;
 padding-top:8px;
 text-align:center
}
.consentPop .consentButtonStrip small {
 color:#ff5630
}
.consentPop .consentButton {
 height:48px;
 background:#ff5630;
 width:360px;
 -webkit-appearance:none;
 border:none;
 box-shadow:none;
 cursor:pointer;
 font-size:16px;
 border-radius:8px;
 font-weight:600;
 display:block;
 margin:0 auto
}
@media screen and (max-width:420px) {
 .consentPop .consentButton {
  font-size:4.5vw
 }
}
@media only screen and (max-width:1023px) {
 .consentPop .consentButton {
  width:100%
 }
}
.consentPop .consentButton:disabled {
 background:#dfe1e6;
 color:#7a869a!important;
 cursor:auto
}
.consentPop .closeFit {
 position:absolute;
 right:16px;
 top:8px
}
.consentPop .consentNameFld {
 display:inline
}
.consentPop .consentNameFld small {
 display:block
}
.font-weight-bold {
 font-weight:700
}
.fitpassBtmStickyBar {
 height:80px;
 box-shadow:0 -3px 10px rgba(0,0,0,.1);
 text-align:center;
 position:fixed;
 left:0;
 width:100%;
 z-index:99;
 background:#fff;
 font-size:24px;
 color:#253858;
 font-weight:700;
 display:flex;
 align-items:center;
 justify-content:center;
 bottom:-100%
}
@media only screen and (max-width:1023px) {
 .fitpassBtmStickyBar {
  flex-direction:column;
  height:unset;
  padding:16px 12px;
  font-size:14px
 }
}
@media only screen and (max-width:1023px) and (max-width:420px) {
 .fitpassBtmStickyBar {
  font-size:3.8vw
 }
}
.fitpassBtmStickyBar span {
 color:#0065ff
}
.fitpassBtmStickyBar strike {
 margin:0 8px
}
@media only screen and (max-width:1023px) {
 .fitpassBtmStickyBar strike {
  margin:0
 }
}
.fitpassBtmStickyBar button {
 width:300px;
 height:48px;
 border-radius:8px;
 background:#ff5630;
 font-size:16px;
 font-weight:700;
 border:none;
 box-shadow:none;
 outline:none;
 cursor:pointer;
 margin-left:32px
}
@media screen and (max-width:420px) {
 .fitpassBtmStickyBar button {
  font-size:4.5vw
 }
}
@media only screen and (max-width:1023px) {
 .fitpassBtmStickyBar button {
  width:100%;
  margin-left:0;
  margin-top:8px
 }
}
.fitpassBtmStickyBar.slideIn {
 animation:fitpassBtmStickyBarSlideIn 1s ease-in-out 0s forwards
}
@keyframes fitpassBtmStickyBarSlideIn {
 0% {
  bottom:-100%
 }
 to {
  bottom:0
 }
}
.fitpassBtmStickyBar.slideOut {
 animation:slideOut 1s ease-in-out 0s forwards
}
@keyframes slideOut {
 0% {
  bottom:0
 }
 to {
  bottom:-100%
 }
}
@media only screen and (max-width:1023px) {
 .fitpassWrapper {
  background:#fff
 }
}
.agentClick {
 width:320px;
 height:60px;
 background:#fff;
 box-shadow:0 -6px 16px rgba(0,0,0,.16);
 border-radius:24px 24px 0 0;
 font-size:18px;
 font-weight:700;
 position:fixed;
 bottom:0;
 right:16px;
 display:flex;
 align-items:center;
 padding:0 24px;
 cursor:pointer;
 z-index:2
}
@media screen and (max-width:420px) {
 .agentClick {
  font-size:5.1vw
 }
}
.agentClick:after {
 content:"";
 border:solid #253858;
 border-width:0 2px 2px 0;
 display:inline-block;
 padding:4px;
 -webkit-transform:rotate(45deg);
 transform:rotate(45deg);
 position:relative;
 top:1px;
 right:-159px
}
.slideScreenAgentRight {
 position:fixed;
 height:calc(100% - 16px);
 background:#fff;
 z-index:100;
 top:16px;
 width:400px;
 right:16px;
 border-radius:24px 24px 0 0;
 overflow:hidden;
 -webkit-animation:slidescreenAgent .3s ease-in-out forwards;
 animation:slidescreenAgent .3s ease-in-out forwards;
 box-shadow:-6px 0 16px rgba(0,0,0,.16)
}
.slideScreenAgentRight .headerContainerAgent {
 background:#fff;
 width:100%;
 padding:0 16px;
 justify-content:space-between;
 height:58px;
 align-items:center;
 font-size:18px;
 font-weight:700;
 display:flex;
 box-shadow:0 1px 3px rgba(0,0,0,.16)
}
@media screen and (max-width:420px) {
 .slideScreenAgentRight .headerContainerAgent {
  font-size:5.1vw
 }
}
.slideScreenAgentRight .headerContainerAgent .closeAgent {
 text-indent:-999999px;
 position:relative;
 width:25px;
 cursor:pointer
}
.slideScreenAgentRight .headerContainerAgent .closeAgent:after,
.slideScreenAgentRight .headerContainerAgent .closeAgent:before {
 content:"";
 width:2px;
 height:18px;
 display:block;
 position:absolute;
 left:50%;
 top:54%;
 background:#253858;
 border-radius:2px
}
.slideScreenAgentRight .headerContainerAgent .closeAgent:before {
 transform:translate(-50%,-50%) rotate(45deg)
}
.slideScreenAgentRight .headerContainerAgent .closeAgent:after {
 transform:translate(-50%,-50%) rotate(-45deg)
}
.slideScreenAgentRight .agentWrapper {
 height:calc(100vh - 80px);
 overflow-y:auto;
 position:fixed;
 width:100%;
 padding:0 0 16px;
 display:block
}
.slideScreenAgentRight .agentWrapper::-webkit-scrollbar {
 width:8px
}
.slideScreenAgentRight .agentWrapper::-webkit-scrollbar-track {
 box-shadow:inset 0 0 5px #dfe1e6
}
.slideScreenAgentRight .agentWrapper::-webkit-scrollbar-thumb {
 background:#dfe1e6;
 border-radius:8px
}
.slideScreenAgentRight .agentWrapper::-webkit-scrollbar-thumb:hover {
 background:#97a0af
}
@-webkit-keyframes slidescreenAgent {
 0% {
  -webkit-transform:translateY(100%);
  transform:translateY(100%)
 }
 to {
  -webkit-transform:translateY(0);
  transform:translateY(0)
 }
}
@keyframes slidescreenAgent {
 0% {
  -webkit-transform:translateY(100%);
  transform:translateY(100%)
 }
 to {
  -webkit-transform:translateY(0);
  transform:translateY(0)
 }
}
.agentAccordionSection {
 position:relative;
 z-index:2;
 border-bottom:1px solid #dfe1e6
}
.agentAccordionSection input[type=checkbox] {
 position:absolute;
 opacity:0;
 z-index:-1
}
.agentAccordionSection>label {
 padding:16px;
 width:100%;
 display:block;
 font-size:16px;
 color:#253858;
 cursor:pointer;
 position:relative;
 font-weight:600
}
@media screen and (max-width:420px) {
 .agentAccordionSection>label {
  font-size:4.5vw
 }
}
.agentAccordionSection>label:after {
 content:"";
 border:solid #253858;
 border-width:0 2px 2px 0;
 display:inline-block;
 padding:4px;
 transform:rotate(45deg);
 vertical-align:middle;
 position:absolute;
 right:20px;
 top:50%;
 transition:all .3s ease-in;
 margin-top:-7px;
 transform-origin:center center
}
.agentAccordionSection .accordionContent {
 max-height:0;
 transition:all .35s;
 opacity:0;
 display:none
}
.agentAccordionSection input[type=checkbox]:checked+label {
 color:#36b37e;
 font-weight:700
}
.agentAccordionSection input[type=checkbox]:checked+label:after {
 transform:rotate(-135deg);
 margin-top:-2px
}
.agentAccordionSection input[type=checkbox]:checked+label .hideOnSelect,
.agentAccordionSection input[type=checkbox]:checked+label .labelTagline {
 display:none
}
.agentAccordionSection input[type=checkbox]:checked~.accordionContent {
 max-height:100%;
 opacity:1;
 display:block;
 padding:0 16px
}
.agentAccordionSection .labelTagline {
 display:block;
 width:92%;
 white-space:nowrap;
 overflow:hidden
}
.agentAccordionSection .labelTagline li {
 display:inline-block;
 color:#7a869a;
 font-size:14px;
 font-weight:400;
 position:relative;
 padding:0 8px 0 5px
}
@media screen and (max-width:420px) {
 .agentAccordionSection .labelTagline li {
  font-size:3.8vw
 }
}
.agentAccordionSection .labelTagline li:first-child {
 padding-left:0
}
.agentAccordionSection .labelTagline li:after {
 width:4px;
 height:4px;
 border-radius:25px;
 background:#7a869a;
 content:"";
 position:absolute;
 right:0;
 top:10px
}
.agentAccordionSection .labelTagline li:last-child:after {
 content:none
}
.agentAccordionSection.leadAccordian>label:after {
 top:28px
}
.customerProfile {
 display:flex;
 width:100%;
 justify-content:space-between;
 flex-flow:wrap
}
.customerProfile li {
 width:50%;
 display:flex;
 flex-direction:column;
 margin-bottom:14px;
 font-weight:400
}
.customerProfile li .labeAgent {
 font-size:12px;
 font-weight:500;
 opacity:.6
}
@media screen and (max-width:420px) {
 .customerProfile li .labeAgent {
  font-size:3.2vw
 }
}
.customerProfile li .labelTxt {
 width:80%;
 word-wrap:break-word;
 font-size:14px
}
@media screen and (max-width:420px) {
 .customerProfile li .labelTxt {
  font-size:3.8vw
 }
}
.moreLeads {
 color:#ff5630;
 font-size:14px;
 font-weight:600;
 margin:0 auto;
 padding-bottom:15px;
 text-align:center;
 cursor:pointer
}
@media screen and (max-width:420px) {
 .moreLeads {
  font-size:3.8vw
 }
}
.leadTime {
 color:#7a869a;
 font-size:14px;
 font-weight:400;
 margin-bottom:16px
}
@media screen and (max-width:420px) {
 .leadTime {
  font-size:3.8vw
 }
}
.agentsLeadsBox .agentLeadInner {
 border-bottom:1px solid #dfe1e6;
 margin-bottom:16px;
 cursor:pointer;
 display:flex;
 flex-direction:column
}
.agentsLeadsBox .agentLeadInner.singleLead {
 cursor:inherit
}
.agentsLeadsBox .agentLeadInner:last-child,
.agentsLeadsBox .agentLeadInner:nth-last-child(2) {
 border:none
}
.noSelection {
 text-align:center;
 position:relative;
 top:-10px;
 padding:5px 0;
 color:#de350b;
 font-size:14px
}
@media screen and (max-width:420px) {
 .noSelection {
  font-size:3.8vw
 }
}
.quotesInnerListing {
 width:100%;
 border-radius:8px;
 box-shadow:0 6px 16px 0 rgba(52,105,203,.16);
 background-color:#fff;
 padding:12px;
 display:flex;
 flex-direction:column;
 position:relative;
 margin:0 0 16px;
 justify-content:space-between
}
.quotesInnerListing .firstQuoteBox {
 display:flex;
 width:100%;
 margin:8px 0 16px
}
.quotesInnerListing .secondQuoteBox {
 display:flex;
 justify-content:space-between;
 padding:0 15px;
 width:100%
}
.quotesInnerListing .logoMobBox {
 height:40px;
 width:90px;
 object-fit:contain
}
.quotesInnerListing .logoMobBox img {
 max-width:100%;
 max-height:100%;
 width:auto
}
.quotesInnerListing .planNameQuotes {
 font-size:16px;
 font-weight:600;
 width:calc(100% - 90px);
 margin-left:10px
}
@media screen and (max-width:420px) {
 .quotesInnerListing .planNameQuotes {
  font-size:4.5vw
 }
}
.quotesInnerListing .viewQuotesLinks {
 color:#36b37e;
 font-size:12px;
 font-weight:600;
 cursor:pointer;
 margin:2px 0 0
}
@media screen and (max-width:420px) {
 .quotesInnerListing .viewQuotesLinks {
  font-size:3.2vw
 }
}
.quotesInnerListing .innerValuesQuotes {
 color:#7a869a;
 font-size:12px
}
@media screen and (max-width:420px) {
 .quotesInnerListing .innerValuesQuotes {
  font-size:3.2vw
 }
}
.quotesInnerListing .innerValuesQuotes span {
 color:#253858;
 font-size:16px;
 margin:0;
 display:block;
 position:relative;
 cursor:pointer
}
@media screen and (max-width:420px) {
 .quotesInnerListing .innerValuesQuotes span {
  font-size:4.5vw
 }
}
.quotesInnerListing .innerValuesQuotes span:after {
 content:"";
 border:solid #253858;
 border-width:0 2px 2px 0;
 display:inline-block;
 padding:4px;
 transform:rotate(-45deg);
 vertical-align:middle;
 position:absolute;
 right:51px;
 top:15px;
 transition:all .3s ease-in;
 margin-top:-7px;
 transform-origin:center center
}
.quotesInnerListing .quotesButtonValue {
 text-align:left
}
.quotesInnerListing .quotesButtonValue span {
 display:block;
 font-size:14px;
 color:#7a869a;
 margin:4px 0 0
}
@media screen and (max-width:420px) {
 .quotesInnerListing .quotesButtonValue span {
  font-size:3.8vw
 }
}
.quotesInnerListing .quotesButtonValue span:last-child {
 color:#253858
}
.quotesInnerListing .quotesButtonValue button {
 display:none;
 width:115px;
 height:36px;
 background:#ff5630;
 border-radius:8px;
 border:none;
 outline:none;
 cursor:pointer;
 color:#fff;
 font-size:14px
}
@media screen and (max-width:420px) {
 .quotesInnerListing .quotesButtonValue button {
  font-size:3.8vw
 }
}
.quotesInnerListing .agentCoverSelectBox {
 position:relative
}
.quotesInnerListing .agentCoverSelectBox span {
 color:#7a869a;
 font-size:14px;
 margin:0;
 display:block
}
@media screen and (max-width:420px) {
 .quotesInnerListing .agentCoverSelectBox span {
  font-size:3.8vw
 }
}
.quotesInnerListing .agentCoverSelectBox select {
 border:0;
 outline:none;
 color:#253858;
 font-size:16px;
 -webkit-appearance:none;
 -moz-appearance:none;
 appearance:none;
 margin:5px 0 0
}
@media screen and (max-width:420px) {
 .quotesInnerListing .agentCoverSelectBox select {
  font-size:4.5vw
 }
}
.tagsRight {
 font-weight:700;
 font-size:8px;
 background:#e0f3eb;
 border-radius:4px;
 padding:4px;
 color:#36b37e;
 position:absolute;
 right:4px;
 top:4px
}
.tagsRight.tags2 {
 color:#eaa900;
 background:#fcf5e3
}
.tagsRight.tags3 {
 font-size:12px;
 font-weight:700;
 color:#7a869a;
 background:#f4f5f7;
 right:inherit;
 top:16px;
 left:95px;
 z-index:1
}
@media screen and (max-width:420px) {
 .tagsRight.tags3 {
  font-size:3.2vw
 }
}
.tagsRight.tags4 {
 right:inherit;
 top:16px;
 left:200px;
 font-weight:600;
 font-size:12px;
 z-index:1
}
@media screen and (max-width:420px) {
 .tagsRight.tags4 {
  font-size:3.2vw
 }
}
.interestTabsBox {
 width:100%;
 margin:0 0 16px
}
.interestTabsBox .interestTabs {
 height:36px;
 align-items:center;
 display:inline-flex;
 justify-content:center;
 font-size:14px;
 padding:0 12px;
 width:auto;
 background:#fafbfc;
 border:1px solid #dfe1e6;
 border-radius:40px;
 color:#505f79;
 margin:0 12px 8px 0
}
@media screen and (max-width:420px) {
 .interestTabsBox .interestTabs {
  font-size:3.8vw
 }
}
.interestTabsBox .closeApplied {
 width:12px;
 height:12px;
 text-indent:-999999px;
 position:relative;
 margin-left:8px;
 cursor:pointer
}
.interestTabsBox .closeApplied:after,
.interestTabsBox .closeApplied:before {
 content:"";
 width:1px;
 height:12px;
 display:block;
 position:absolute;
 left:50%;
 top:50%;
 background:#505f79;
 border-radius:2px;
 transform:translate(-50%,-50%) rotate(45deg)
}
.interestTabsBox .closeApplied:after {
 transform:translate(-50%,-50%) rotate(-45deg)
}
.interestTabsBox .lineCross {
 text-decoration:line-through
}
.addPref {
 margin:0 0 16px;
 display:block;
 position:relative
}
.addPref .inputPref {
 width:100%;
 height:56px;
 background:#fff;
 border:1px solid #5e6c84;
 border-radius:8px;
 outline:none;
 padding:0 64px 0 16px;
 font-size:16px;
 color:#253858
}
@media screen and (max-width:420px) {
 .addPref .inputPref {
  font-size:4.5vw
 }
}
.addPref .inputPref::placeholder {
 color:#5e6c84;
 font-size:16px
}
@media screen and (max-width:420px) {
 .addPref .inputPref::placeholder {
  font-size:4.5vw
 }
}
.addPref .plusPref {
 position:absolute;
 right:16px;
 top:9px;
 display:block;
 color:transparent;
 height:34px;
 width:34px;
 cursor:pointer
}
.addPref .plusPref:before {
 width:34px;
 height:34px;
 border:2px solid #ff5630;
 border-radius:30px;
 content:"";
 display:block
}
.addPref .plusPref:after {
 content:"+";
 display:block;
 position:absolute;
 top:-8px;
 right:7px;
 color:#ff5630;
 font-size:31px
}
.warning {
 position:relative;
 top:-10px;
 left:4px;
 color:#de350b;
 font-size:14px
}
@media screen and (max-width:420px) {
 .warning {
  font-size:3.8vw
 }
}
.spLeftRecommend {
 margin:0 0 0 16px
}
ul.recommendsListing {
 position:relative;
 margin:0 0 16px
}
ul.recommendsListing li {
 color:#7a869a;
 font-size:14px;
 font-weight:600;
 line-height:22px;
 position:relative
}
@media screen and (max-width:420px) {
 ul.recommendsListing li {
  font-size:3.8vw
 }
}
ul.recommendsListing li:before {
 width:6px;
 height:100%;
 background-color:#36b37e;
 content:"";
 position:absolute;
 top:0;
 left:-32px
}
ul.pitchRemomendBox {
 margin:0 0 16px
}
ul.pitchRemomendBox>li {
 margin:0 0 24px
}
ul.pitchRemomendBox>li .headLisiting {
 font-size:14px;
 font-weight:600;
 position:relative;
 padding:3px 0
}
@media screen and (max-width:420px) {
 ul.pitchRemomendBox>li .headLisiting {
  font-size:3.8vw
 }
}
ul.pitchRemomendBox>li .headLisiting:before {
 width:6px;
 height:100%;
 background-color:#36b37e;
 content:"";
 position:absolute;
 top:0;
 left:-16px
}
ul.pitchRemomendBox>li .textTagline {
 color:#505f79;
 font-size:14px;
 margin:8px 0
}
@media screen and (max-width:420px) {
 ul.pitchRemomendBox>li .textTagline {
  font-size:3.8vw
 }
}
ul.lisitngTxt {
 margin:0
}
ul.lisitngTxt li {
 color:#505f79;
 font-size:14px;
 position:relative;
 margin:16px 0 0;
 padding:0 0 0 16px
}
@media screen and (max-width:420px) {
 ul.lisitngTxt li {
  font-size:3.8vw
 }
}
ul.lisitngTxt li:before {
 content:"";
 position:absolute;
 top:11px;
 left:0;
 width:9px;
 height:1px;
 background-color:#505f79
}
.cityTabsListing {
 overflow:auto;
 white-space:nowrap;
 margin:10px 0 24px
}
.cityTabsListing::-webkit-scrollbar {
 display:none
}
.cityTabsListing .cityTab {
 margin:0 6px 0 0;
 cursor:pointer;
 background:#fff
}
.cityTabsListing .cityTab.active {
 border-color:#36b37e;
 color:#36b37e;
 cursor:inherit
}
.officeAddressLisitng {
 margin:0 0 16px
}
.officeAddressLisitng li {
 padding:0 0 16px 60px;
 margin:16px 0 0;
 position:relative
}
.officeAddressLisitng li:before {
 width:40px;
 height:40px;
 background:url(https://static.pbcdn.in/health-cdn/images/insurer-logo/quotes-logos/locationPin.svg) no-repeat 0 0;
 content:"";
 position:absolute;
 left:0;
 top:4px
}
.officeAddressLisitng li:after {
 width:calc(100% - 60px);
 height:1px;
 background:#dfe1e6;
 content:"";
 position:absolute;
 left:60px;
 bottom:0
}
.officeAddressLisitng li:last-child {
 border-bottom:none
}
.officeAddressLisitng li:last-child:after {
 display:none
}
.officeAddressLisitng li .labelOffice {
 font-size:12px;
 color:#7a869a
}
@media screen and (max-width:420px) {
 .officeAddressLisitng li .labelOffice {
  font-size:3.2vw
 }
}
.officeAddressLisitng li p {
 font-size:14px
}
@media screen and (max-width:420px) {
 .officeAddressLisitng li p {
  font-size:3.8vw
 }
}
.preferneceLListing {
 margin:0 0 16px;
 padding:0;
 list-style:none;
 border-radius:8px;
 border:1px solid #dfe1e6;
 background-color:#fff;
 max-height:216px;
 overflow-x:auto
}
.preferneceLListing li {
 padding:16px;
 border-bottom:1px solid #dfe1e6;
 font-size:14px;
 cursor:pointer
}
@media screen and (max-width:420px) {
 .preferneceLListing li {
  font-size:3.8vw
 }
}
.preferneceLListing li:last-child {
 border-bottom:none
}
.multiLeadsBox {
 margin:0;
 display:flex
}
.multiLeadsBox .pos-rel {
 position:relative;
 margin:0 8px 0 0
}
.multiLeadsBox .agent-input-radio {
 -webkit-appearance:none;
 outline:0;
 width:18px;
 height:18px;
 border-radius:50%;
 background-color:#fff;
 border:1px solid #7a869a;
 margin:2px 0 0
}
.multiLeadsBox .agent-input-radio:checked:before {
 content:"";
 width:10px;
 height:10px;
 background:#36b37e;
 border-radius:50%;
 position:absolute;
 left:50%;
 top:11px;
 transform:translate(-50%,-50%)
}
.multiLeadsBox .agent-input-radio:checked {
 background-color:#fff;
 border:1px solid #36b37e
}
:root body {
 margin:0;
 font-size:16px;
 color:#253858;
 font-family:-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Oxygen-Sans,Ubuntu,Cantarell,Helvetica Neue,sans-serif;
 line-height:1.5
}
@media screen and (max-width:420px) {
 :root body {
  font-size:4.5vw
 }
}
body,
html {
 background:#f4f5f7
}
h1,
h2,
h3,
h4,
h5,
h6,
li,
p,
ul {
 margin:0;
 padding:0
}
h1,
h2,
h3,
h4,
h5,
h6 {
 font-weight:700
}
li {
 list-style:none
}
* {
 -webkit-tap-highlight-color:transparent;
 -webkit-font-smoothing:antialiased;
 scroll-behavior:smooth
}
*,
:after,
:before {
 box-sizing:border-box
}
a {
 color:#36b37e;
 text-decoration:none
}
@media only screen and (max-width:1023px) {
 .hideSmall {
  display:none!important
 }
}
@media only screen and (min-width:1024px) {
 .hideBig {
  display:none!important
 }
}
.hide {
 display:none
}
.flexRow {
 display:flex
}
.align-center {
 align-items:center
}
.flex-wrap {
 flex-wrap:wrap
}
.segment_btn {
 width:100%;
 height:48px;
 -webkit-appearance:none;
 background:#ff5630;
 color:#fff;
 font-size:16px;
 font-weight:600;
 text-transform:uppercase;
 border:none;
 box-shadow:none;
 border-radius:4px;
 font-family:-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Oxygen-Sans,Ubuntu,Cantarell,Helvetica Neue,sans-serif;
 cursor:pointer;
 outline:none
}
.segment_btn:hover {
 color:#fff!important
}
.ghostBtn {
 background:#fff!important;
 border:1px solid #253858!important
}
.ghostBtn,
.ghostBtn:hover {
 color:#253858!important
}
.segmentWrapper {
 max-width:1170px;
 width:100%;
 margin:0 auto
}
@media only screen and (min-width:1024px) {
 .segmentWrapper {
  padding:0 15px
 }
}
strong {
 color:#253858
}
.ws-nowrap {
 white-space:nowrap
}
.header {
 display:flex;
 justify-content:center;
 align-items:center;
 height:56px;
 background-color:#fff;
 font-weight:600;
 box-shadow:0 1px 2px rgba(0,0,0,.1607843137254902)
}
.bookmark {
 overflow:scroll
}
.bookmark ul li {
 font-size:14px;
 font-weight:400;
 float:left;
 border:1px solid #dfe1e6;
 padding:8px 10px;
 border-radius:44px;
 margin-right:4px
}
@media screen and (max-width:420px) {
 .bookmark ul li {
  font-size:3.8vw
 }
}
.blue-bg {
 background-color:#edfdf6!important
}
.white-bg {
 background-color:#fff!important
}
.warning-bg {
 background-color:#fff7db!important
}
.quotes_rvmp_card {
 background:#fff;
 box-shadow:0 1px 2px rgba(52,105,203,.16);
 padding:24px 12px;
 border-top:1px solid #dfe1e6
}
@media only screen and (max-width:1023px) {
 .quotes_rvmp_card {
  position:relative;
  z-index:2
 }
}
@media only screen and (min-width:1024px) {
 .quotes_rvmp_card {
  width:calc(100% - 120px);
  display:flex;
  align-items:center;
  justify-content:space-between;
  margin-left:auto;
  flex-wrap:wrap;
  overflow:hidden;
  cursor:pointer
 }
}
.quotes_rvmp_card:first-of-type {
 border-radius:8px 8px 0 0;
 border-top:none;
 padding:12px 12px 24px
}
@media only screen and (min-width:1024px) {
 .quotes_rvmp_card:first-of-type {
  border-radius:0 8px 0 0
 }
}
.quotes_rvmp_card:last-of-type {
 border-radius:0 0 8px 8px
}
.quotes_rvmp_card:only-of-type {
 border-radius:8px;
 border-top:none;
 padding:12px
}
@media only screen and (min-width:1024px) {
 .quotes_rvmp_card:only-of-type {
  border-radius:0 8px 8px 8px
 }
}
@media only screen and (min-width:1024px) {
 .quotes_rvmp_card__upper_div {
  width:calc(100% - 251px)
 }
}
.quotes_rvmp_card__pre_layout_heading {
 background-color:#e3fcef;
 color:#19b24d;
 margin:0 12px;
 font-size:12px;
 font-weight:600;
 padding:6px 0;
 text-align:center;
 border-top-left-radius:8px;
 border-top-right-radius:8px
}
@media screen and (max-width:420px) {
 .quotes_rvmp_card__pre_layout_heading {
  font-size:3.2vw
 }
}
.quotes_rvmp_card__content {
 display:flex;
 flex-direction:column
}
.quotes_rvmp_card__content__plan_header {
 display:flex;
 align-items:center
}
.quotes_rvmp_card__content__plan_header picture {
 width:80px;
 height:40px;
 background-color:#fff;
 border:1px solid #dfe1e6;
 border-radius:8px;
 margin-right:12px;
 display:flex;
 align-items:center;
 justify-content:center
}
.quotes_rvmp_card__content__plan_header picture img {
 width:60px
}
.quotes_rvmp_card__content__plan_header__name {
 font-size:16px;
 font-weight:600;
 display:block
}
@media screen and (max-width:420px) {
 .quotes_rvmp_card__content__plan_header__name {
  font-size:4.5vw
 }
}
.quotes_rvmp_card__content__plan_header__discount {
 color:#36b37e;
 display:flex;
 font-size:12px;
 font-weight:600;
 margin-top:4px;
 align-items:center
}
@media screen and (max-width:420px) {
 .quotes_rvmp_card__content__plan_header__discount {
  font-size:3.2vw
 }
}
.quotes_rvmp_card__content__plan_header__discount:before {
 content:"";
 width:15px;
 height:15px;
 background:url(https://static.pbcdn.in/health-cdn/images/insurer-logo/quotes-logos/newQuotesSprite_orange.svg) no-repeat 0 0;
 background-position:0 -783px;
 margin-right:4px
}
.quotes_rvmp_card__content__plan_amounts {
 display:flex;
 margin-top:16px;
 justify-content:space-between
}
@media only screen and (min-width:1024px) {
 .quotes_rvmp_card__content__plan_amounts {
  width:100%;
  flex-direction:row;
  margin-top:0;
  justify-content:space-between
 }
}
.quotes_rvmp_card__content__plan_amounts>div {
 width:50%;
 font-size:16px;
 font-weight:700
}
@media screen and (max-width:420px) {
 .quotes_rvmp_card__content__plan_amounts>div {
  font-size:4.5vw
 }
}
@media only screen and (max-width:1023px) {
 .quotes_rvmp_card__content__plan_amounts>div:first-child {
  width:auto
 }
}
@media only screen and (min-width:1024px) {
 .quotes_rvmp_card__content__plan_amounts>div {
  width:unset;
  max-width:50%;
  min-width:85px
 }
}
.quotes_rvmp_card__content__plan_amounts>div>span {
 font-size:12px;
 font-weight:400;
 color:#7a869a;
 display:block
}
@media screen and (max-width:420px) {
 .quotes_rvmp_card__content__plan_amounts>div>span {
  font-size:3.2vw
 }
}
.quotes_rvmp_card__content__plan_amounts>div>em {
 font-style:normal
}
.quotes_rvmp_card__content__plan_amounts .hiked__price {
 text-decoration:line-through
}
.quotes_rvmp_card__content__features {
 margin-top:14px;
 display:flex;
 flex-wrap:wrap;
 gap:6px
}
@media only screen and (min-width:1024px) {
 .quotes_rvmp_card__content__features {
  margin-bottom:16px
 }
}
.quotes_rvmp_card__content__features li {
 font-size:12px;
 color:#505f79;
 border-radius:4px;
 border:1px solid #dfe1e6;
 padding:4px 8px;
 display:inline-flex;
 align-items:center
}
@media screen and (max-width:420px) {
 .quotes_rvmp_card__content__features li {
  font-size:3.2vw
 }
}
.quotes_rvmp_card__content__features li:last-child {
 background:#f2fffa;
 border:none;
 font-weight:600;
 color:#36b37e;
 cursor:pointer
}
.quotes_rvmp_card__content__features li:last-child:after {
 content:"";
 border:solid #36b37e;
 border-width:0 1px 1px 0;
 display:inline-block;
 padding:2px;
 transform:rotate(-45deg);
 margin-left:4px
}
.quotes_rvmp_card__content__bottom_buttons {
 margin-top:12px
}
@media only screen and (min-width:1024px) {
 .quotes_rvmp_card__content__bottom_buttons {
  margin-top:0;
  display:flex;
  flex-direction:column;
  gap:10px
 }
}
.quotes_rvmp_card__content__bottom_buttons .quotesRevampCtaWrap {
 display:flex;
 gap:10px
}
@media only screen and (min-width:1024px) {
 .quotes_rvmp_card__content__bottom_buttons .quotesRevampCtaWrap {
  flex-direction:column;
  width:235px
 }
}
.quotes_rvmp_card__content__bottom_buttons button {
 width:50%;
 padding:0
}
@media only screen and (min-width:1024px) {
 .quotes_rvmp_card__content__bottom_buttons button {
  width:100%
 }
}
.quotes_rvmp_card__content__bottom_buttons .primaryMainCta {
 -webkit-appearance:none;
 font-weight:600;
 border-radius:8px;
 cursor:pointer;
 transition:background .3s ease-in-out;
 height:48px;
 background:#ff5630;
 color:#fff!important;
 font-size:16px;
 border:none;
 height:36px;
 font-size:14px
}
@media screen and (max-width:420px) {
 .quotes_rvmp_card__content__bottom_buttons .primaryMainCta {
  font-size:4.5vw
 }
}
.quotes_rvmp_card__content__bottom_buttons .primaryMainCta:hover {
 background:#fc2e00 radial-gradient(circle,transparent 1%,#fc2e00 0) 50%/15000%
}
.quotes_rvmp_card__content__bottom_buttons .primaryMainCta:active {
 background-color:#ff8063;
 background-size:100%;
 transition:background 0s ease-in-out
}
.quotes_rvmp_card__content__bottom_buttons .primaryMainCta:disabled {
 background:#dfe1e6;
 color:#7a869a;
 pointer-events:none
}
.quotes_rvmp_card__content__bottom_buttons .primaryMainCta:focus {
 outline:none
}
@media screen and (max-width:420px) {
 .quotes_rvmp_card__content__bottom_buttons .primaryMainCta {
  font-size:3.8vw
 }
}
.quotes_rvmp_card__content__bottom_buttons .secondaryOutlinedCta {
 -webkit-appearance:none;
 font-weight:600;
 border-radius:8px;
 cursor:pointer;
 transition:background .3s ease-in-out;
 height:48px;
 background:#ff5630;
 color:#fff!important;
 font-size:16px;
 background:#fff;
 color:#ff5630!important;
 border:1px solid #ff5630;
 height:36px;
 font-size:14px
}
@media screen and (max-width:420px) {
 .quotes_rvmp_card__content__bottom_buttons .secondaryOutlinedCta {
  font-size:4.5vw
 }
}
.quotes_rvmp_card__content__bottom_buttons .secondaryOutlinedCta:hover {
 background:#fc2e00 radial-gradient(circle,transparent 1%,#fc2e00 0) 50%/15000%
}
.quotes_rvmp_card__content__bottom_buttons .secondaryOutlinedCta:active {
 background-color:#ff8063;
 transition:background 0s ease-in-out
}
.quotes_rvmp_card__content__bottom_buttons .secondaryOutlinedCta:disabled {
 background:#dfe1e6;
 color:#7a869a;
 pointer-events:none
}
.quotes_rvmp_card__content__bottom_buttons .secondaryOutlinedCta:focus {
 outline:none
}
.quotes_rvmp_card__content__bottom_buttons .secondaryOutlinedCta.selected {
 border-color:#505f79;
 color:#505f79!important
}
.quotes_rvmp_card__content__bottom_buttons .secondaryOutlinedCta:hover {
 background:#fff radial-gradient(circle,transparent 1%,#fff 0) 50%/15000%
}
.quotes_rvmp_card__content__bottom_buttons .secondaryOutlinedCta:active {
 background-color:#dfe1e6;
 background-size:100%;
 transition:background 0s
}
@media screen and (max-width:420px) {
 .quotes_rvmp_card__content__bottom_buttons .secondaryOutlinedCta {
  font-size:3.8vw
 }
}
.quotes_rvmp_card__content__bottom_buttons .shortlistBtn {
 border-color:#253858;
 color:#253858!important;
 font-weight:600;
 display:flex;
 align-items:center;
 justify-content:center
}
@media only screen and (min-width:1024px) {
 .quotes_rvmp_card__content__bottom_buttons .shortlistBtn {
  order:3
 }
}
.quotes_rvmp_card__content__bottom_buttons .shortlistBtn:before {
 content:"";
 width:19px;
 height:18px;
 background:url(https://static.pbcdn.in/health-cdn/images/insurer-logo/quotes-logos/newQuotesSprite_orange.svg) no-repeat 0 0;
 background-position:5px -229px;
 margin-right:4px
}
.quotes_rvmp_card__content__bottom_buttons .shortlistBtn.selected {
 border-color:#36b37e;
 color:#36b37e!important
}
.quotes_rvmp_card__content__bottom_buttons .shortlistBtn.selected:before {
 background-position:-27px -231px
}
.quotes_rvmp_card__content__bottom_buttons .addtoCompareCta {
 width:100%
}
.quotes_rvmp_card__content__bottom_buttons .addtoCompareCta>label {
 position:relative;
 display:flex;
 -webkit-appearance:none;
 font-weight:600;
 border-radius:8px;
 cursor:pointer;
 transition:background .3s ease-in-out;
 height:48px;
 background:#ff5630;
 color:#fff!important;
 font-size:16px;
 border:none;
 height:36px;
 font-size:14px;
 align-items:center;
 justify-content:center
}
@media screen and (max-width:420px) {
 .quotes_rvmp_card__content__bottom_buttons .addtoCompareCta>label {
  font-size:4.5vw
 }
}
.quotes_rvmp_card__content__bottom_buttons .addtoCompareCta>label:hover {
 background:#fc2e00 radial-gradient(circle,transparent 1%,#fc2e00 0) 50%/15000%
}
.quotes_rvmp_card__content__bottom_buttons .addtoCompareCta>label:active {
 background-color:#ff8063;
 background-size:100%;
 transition:background 0s ease-in-out
}
.quotes_rvmp_card__content__bottom_buttons .addtoCompareCta>label:disabled {
 background:#dfe1e6;
 color:#7a869a;
 pointer-events:none
}
.quotes_rvmp_card__content__bottom_buttons .addtoCompareCta>label:focus {
 outline:none
}
@media screen and (max-width:420px) {
 .quotes_rvmp_card__content__bottom_buttons .addtoCompareCta>label {
  font-size:3.8vw
 }
}
.quotes_rvmp_card__content__bottom_buttons .addtoCompareCta>label input {
 position:absolute;
 opacity:0;
 visibility:hidden
}
.quotes_rvmp_card__content__bottom_buttons .addtoCompareCta.selected label {
 border:1px solid #505f79!important;
 color:#505f79!important;
 background:#fff
}
.quotes_rvmp_card .coverSelectBox:after {
 position:absolute;
 top:6px;
 right:1px;
 z-index:1
}
.quotes_rvmp_card .coverSelectBox .quotes_select {
 font-size:16px;
 color:#253858;
 font-weight:700;
 border:none;
 padding-top:0;
 padding-bottom:0;
 background:none;
 position:relative;
 z-index:2;
 cursor:pointer;
 width:auto;
 padding-right:15px
}
@media screen and (max-width:420px) {
 .quotes_rvmp_card .coverSelectBox .quotes_select {
  font-size:4.5vw
 }
}
.quotes_rvmp_card__showMore {
 font-size:12px;
 font-weight:600;
 width:calc(100% - 24px);
 margin:0 auto;
 background:#eaf2ff;
 border-radius:0 0 8px 8px;
 min-height:24px;
 text-align:center;
 cursor:pointer;
 padding:5px
}
@media screen and (max-width:420px) {
 .quotes_rvmp_card__showMore {
  font-size:3.2vw
 }
}
.quotes_rvmp_card__showMore:after {
 content:"";
 border:solid #253858;
 border-width:0 1px 1px 0;
 display:inline-block;
 padding:2px;
 transform:rotate(45deg);
 margin-left:5px;
 position:relative;
 top:-2px;
 transition:transform .3s ease-in-out,top .3s ease-in-out
}
.quotes_rvmp_card__showMore.--showLess:after {
 transform:rotate(-135deg);
 top:1px
}
.tipBox {
 border-radius:8px;
 margin:12px 0;
 font-size:12px;
 color:#505f79;
 padding:12px 8px
}
@media screen and (max-width:420px) {
 .tipBox {
  font-size:3.2vw
 }
}
@media only screen and (min-width:1024px) {
 .tipBox {
  margin:16px -12px -12px;
  border-radius:0;
  padding:12px 16px;
  width:calc(100% + 24px)
 }
 .tipBox>p {
  margin-left:24px
 }
}
.tipBox span {
 display:flex;
 font-weight:700;
 color:#253858;
 margin-bottom:4px
}
.tipBox span i {
 background:url(https://static.pbcdn.in/health-cdn/images/insurer-logo/quotes-logos/newQuotesSprite_orange.svg) no-repeat 0 0;
 margin-right:6px
}
.tipBox.love {
 background:#f1fdf7
}
.tipBox.love span i {
 width:18px;
 height:15px;
 background-position:0 -201px
}
.tipBox.know {
 background:#fff7db
}
.tipBox.know span i {
 width:12px;
 height:20px;
 background-position:0 -460px
}
@media only screen and (min-width:1024px) {
 .quotes_revamp_add_compare {
  margin:0 6px 0 0;
  cursor:pointer
 }
}
@media only screen and (min-width:1024px) {
 .add_to_compare_label {
  font-size:12px;
  font-weight:600;
  color:#253858;
  cursor:pointer
 }
}
@media only screen and (min-width:1024px) and (max-width:420px) {
 .add_to_compare_label {
  font-size:3.2vw
 }
}
@media only screen and (min-width:1024px) {
 .shortlist_cards .main_quotes_container .quotes_stack_content_container:only-child .checkbox_quotes.quotes_revamp_add_compare {
  border-color:#97a0af
 }
 .shortlist_cards .main_quotes_container .quotes_stack_content_container:only-child .add_to_compare_label {
  color:#97a0af
 }
}
.feature_filter {
 background:transparent linear-gradient(99deg,#516fca,#3439cd) 0 0 no-repeat;
 padding:16px 0;
 margin:0 0 16px
}
@media only screen and (max-width:1023px) {
 .feature_filter {
  width:calc(100% + 32px);
  margin:0 0 16px -16px
 }
}
@media only screen and (min-width:1024px) {
 .feature_filter {
  border-radius:8px;
  padding:16px 12px
 }
}
.feature_filter__header {
 padding:0 16px;
 display:flex;
 align-items:center;
 font-size:16px;
 font-weight:700;
 color:#fff;
 margin-bottom:16px
}
@media screen and (max-width:420px) {
 .feature_filter__header {
  font-size:4.5vw
 }
}
@media only screen and (min-width:1024px) {
 .feature_filter__header {
  padding:0
 }
}
.feature_filter__header i {
 width:32px;
 height:32px;
 background:#fff;
 border-radius:50%;
 display:flex;
 align-items:center;
 justify-content:center;
 margin-right:8px
}
.feature_filter__header i:before {
 content:"";
 background:url(https://static.pbcdn.in/health-cdn/images/insurer-logo/quotes-logos/newQuotesSprite_orange.svg) no-repeat 0 0;
 width:23px;
 height:24px;
 background-position:0 -586px;
 background-size:58px
}
.feature_filter__header__featureFilterArrows {
 display:flex;
 margin-top:1px;
 margin-left:auto
}
.feature_filter__header__arrowBox {
 width:24px;
 height:24px;
 border-radius:30px;
 background:#fff;
 border:1px solid #dfe1e6;
 margin:0 16px 0 0;
 cursor:pointer;
 font-size:0
}
.feature_filter__header__arrowBox:last-child {
 margin-right:0
}
.feature_filter__header__arrowBox:after {
 content:"";
 border:solid #253858;
 border-width:0 1.8px 1.8px 0;
 display:inline-block;
 padding:2px;
 transform:rotate(-45deg);
 position:relative;
 top:9px;
 margin-left:7px
}
.feature_filter__header__arrowBox.previous {
 margin:0 12px 0 0
}
.feature_filter__header__arrowBox.previous:after {
 transform:rotate(135deg);
 margin-left:10px
}
.feature_filter ul {
 overflow:auto;
 white-space:normal;
 display:inline-flex;
 width:100%;
 -ms-overflow-style:none;
 scrollbar-width:none;
 scroll-snap-type:x mandatory;
 scroll-padding:0 12px
}
.feature_filter ul::-webkit-scrollbar {
 display:none
}
@media only screen and (min-width:1024px) {
 .feature_filter ul {
  scroll-padding:unset;
  scroll-behavior:smooth!important
 }
}
.feature_filter ul li {
 scroll-snap-align:center;
 position:relative;
 min-width:269px;
 height:128px;
 background-color:#fff;
 border-radius:8px;
 box-shadow:0 3px 6px rgba(0,0,0,.16);
 margin:0 8px 0 0;
 overflow:hidden
}
@media only screen and (min-width:1024px) {
 .feature_filter ul li {
  scroll-snap-align:start;
  cursor:pointer
 }
}
.feature_filter ul li:first-child {
 margin-left:12px
}
@media only screen and (min-width:1024px) {
 .feature_filter ul li:first-child {
  margin-left:0
 }
}
.feature_filter ul li:last-child {
 margin-right:12px
}
@media only screen and (min-width:1024px) {
 .feature_filter ul li:last-child {
  margin-right:0
 }
}
.feature_filter ul li h6 {
 font-size:14px;
 font-weight:600;
 color:#253858;
 margin:14px 0 10px 12px
}
@media screen and (max-width:420px) {
 .feature_filter ul li h6 {
  font-size:3.8vw
 }
}
.feature_filter ul li h6 i {
 font-size:10px;
 font-weight:600;
 color:#36b37e;
 border-radius:4px;
 background:#eaf7f2;
 font-style:normal;
 padding:3px 6px;
 margin-left:6px
}
@media screen and (max-width:420px) {
 .feature_filter ul li h6 i {
  font-size:2.8vw
 }
}
.feature_filter ul li p {
 font-size:12px;
 color:#505f79;
 margin:0 0 0 12px
}
@media screen and (max-width:420px) {
 .feature_filter ul li p {
  font-size:3.2vw
 }
}
.feature_filter ul li span {
 display:block;
 position:absolute;
 width:100%;
 bottom:0;
 left:0;
 padding:6px 0;
 font-size:14px;
 color:#ff5630;
 background-color:#f4f5f7;
 text-align:center;
 border-bottom-left-radius:8px;
 border-bottom-right-radius:8px;
 font-weight:600
}
@media screen and (max-width:420px) {
 .feature_filter ul li span {
  font-size:3.8vw
 }
}
.feature_filter ul li .checked {
 color:#253858
}
.shortlist_coach_mark {
 position:fixed;
 z-index:101;
 left:0;
 top:0;
 width:100%;
 height:100%;
 background-color:rgba(37,56,88,.9)
}
.shortlist_coach_mark__content {
 padding:16px 23px 16px 16px;
 position:absolute;
 left:0;
 bottom:20%;
 background-color:#fff;
 border-radius:8px;
 color:#253858;
 opacity:1;
 margin:16px
}
.shortlist_coach_mark__content h4 {
 font-size:16px;
 font-weight:700;
 margin-bottom:8px
}
@media screen and (max-width:420px) {
 .shortlist_coach_mark__content h4 {
  font-size:4.5vw
 }
}
.shortlist_coach_mark__content p {
 font-size:14px;
 margin-bottom:18px
}
@media screen and (max-width:420px) {
 .shortlist_coach_mark__content p {
  font-size:3.8vw
 }
}
.shortlist_coach_mark__content__actions {
 display:flex;
 justify-content:flex-end
}
.shortlist_coach_mark__content__actions button {
 border:none;
 background-color:#fff;
 color:#253858!important;
 margin-left:30px;
 font-weight:600;
 font-size:14px
}
@media screen and (max-width:420px) {
 .shortlist_coach_mark__content__actions button {
  font-size:3.8vw
 }
}
.shortlist_coach_mark__content__actions button:last-child {
 color:#0065ff!important
}
.shortlist_coach_mark__active_state {
 position:fixed;
 display:flex;
 justify-content:center;
 bottom:0;
 background-color:red;
 width:100%;
 height:48px
}
.main_quotes_mobile_div.shortlist_main {
 background:#fff!important;
 height:calc(100vh - 62px);
 margin-top:0
}
.noShortlistedWrap {
 display:flex;
 flex-direction:column;
 align-items:center;
 justify-content:center;
 height:100%
}
@media only screen and (min-width:1024px) {
 .noShortlistedWrap {
  background:#fff;
  border-radius:8px;
  padding:24px;
  box-shadow:0 3px 6px rgba(0,0,0,.16)
 }
}
.noShortlistedWrap:before {
 content:"";
 width:308px;
 height:292px;
 background:url(https://static.pbcdn.in/health-cdn/images/insurer-logo/quotes-logos/noShortlist.svg) no-repeat
}
.noShortlistedWrap p {
 font-size:20px;
 font-weight:600;
 text-align:center;
 margin:24px 0 20px
}
@media screen and (max-width:420px) {
 .noShortlistedWrap p {
  font-size:5.6vw
 }
}
.noShortlistedWrap p span {
 display:block;
 font-size:14px;
 font-weight:400;
 color:#505f79
}
@media screen and (max-width:420px) {
 .noShortlistedWrap p span {
  font-size:3.8vw
 }
}
.noShortlistedWrap button {
 width:220px;
 -webkit-appearance:none;
 font-weight:600;
 border-radius:8px;
 cursor:pointer;
 transition:background .3s ease-in-out;
 height:48px;
 background:#ff5630;
 color:#fff!important;
 font-size:16px;
 border:none
}
@media screen and (max-width:420px) {
 .noShortlistedWrap button {
  font-size:4.5vw
 }
}
.noShortlistedWrap button:hover {
 background:#fc2e00 radial-gradient(circle,transparent 1%,#fc2e00 0) 50%/15000%
}
.noShortlistedWrap button:active {
 background-color:#ff8063;
 background-size:100%;
 transition:background 0s ease-in-out
}
.noShortlistedWrap button:disabled {
 background:#dfe1e6;
 color:#7a869a;
 pointer-events:none
}
.noShortlistedWrap button:focus {
 outline:none
}
.shortlist_bottom_compare {
 position:sticky;
 bottom:0;
 left:0;
 background-color:#fff;
 display:flex;
 flex-direction:column;
 justify-content:center;
 align-items:center;
 padding:16px;
 box-shadow:0 -3px 16px rgba(0,0,0,.16);
 width:100%;
 z-index:98
}
.shortlist_bottom_compare p {
 color:#97a0af;
 font-size:12px;
 font-weight:600;
 margin-bottom:12px
}
@media screen and (max-width:420px) {
 .shortlist_bottom_compare p {
  font-size:3.2vw
 }
}
.shortlist_bottom_compare button {
 background:#fff;
 height:44px;
 width:100%;
 border-radius:8px;
 font-size:16px;
 font-weight:600;
 color:#ff5630!important;
 text-align:center;
 border:1px solid #ff5630
}
@media screen and (max-width:420px) {
 .shortlist_bottom_compare button {
  font-size:4.5vw
 }
}
.shortlist_bottom_compare button:active,
.shortlist_bottom_compare button:hover {
 color:#ff5630!important
}
.shortlist_bottom_compare button:disabled {
 color:#97a0af!important;
 border-color:#97a0af!important
}
.quickWidgetsContainer {
 background-color:#fff;
 box-shadow:0 3px 6px rgba(0,0,0,.16);
 border-radius:8px;
 padding:16px
}
.quickWidgetsContainer h3 {
 font-size:18px
}
@media screen and (max-width:420px) {
 .quickWidgetsContainer h3 {
  font-size:5.1vw
 }
}
.quickWidgetsContainer ul {
 margin-top:22px
}
.quickWidgetsContainer ul li {
 padding:0 0 14px;
 font-size:16px;
 border-bottom:1px solid #dfe1e6;
 margin-bottom:14px;
 cursor:pointer;
 display:flex;
 align-items:center
}
@media screen and (max-width:420px) {
 .quickWidgetsContainer ul li {
  font-size:4.5vw
 }
}
.quickWidgetsContainer ul li:last-child {
 border-bottom:none;
 margin-bottom:0;
 padding-bottom:0
}
.quickWidgetsContainer ul li i {
 width:24px;
 height:20px;
 margin-right:16px;
 background:url(https://static.pbcdn.in/health-cdn/images/insurer-logo/quotes-logos/newQuotesSprite_orange.svg) no-repeat 0 0;
 background-size:53px
}
.quickWidgetsContainer ul li i.popular {
 background-position:3px -81px
}
.quickWidgetsContainer ul li i.value {
 background-position:3px -115px
}
.quickWidgetsContainer ul li i.lowest {
 background-position:0 -149px
}
.shortlistedPlansContainer {
 background-color:#fff;
 box-shadow:0 3px 6px rgba(0,0,0,.16);
 border-radius:8px;
 min-height:150px;
 margin-top:10px;
 padding:16px;
 cursor:pointer
}
.shortlistedPlansContainer h3 {
 font-size:18px;
 font-weight:700;
 cursor:pointer;
 display:flex;
 align-items:center
}
@media screen and (max-width:420px) {
 .shortlistedPlansContainer h3 {
  font-size:5.1vw
 }
}
.shortlistedPlansContainer h3 i.shortlistIcon {
 width:24px;
 height:24px;
 display:flex;
 align-items:center;
 margin-right:8px
}
.shortlistedPlansContainer h3 i.shortlistIcon:before {
 content:"";
 width:24px;
 height:24px;
 background:url(https://static.pbcdn.in/health-cdn/images/insurer-logo/quotes-logos/newQuotesSprite_orange.svg) no-repeat 0 0;
 background-position:-2px -360px;
 background-size:47px
}
.shortlistedPlansContainer h3 i.arrow {
 margin-left:auto
}
.shortlistedPlansContainer h3 i.arrow:before {
 content:"";
 border:solid #253858;
 border-width:0 2px 2px 0;
 display:block;
 padding:4px;
 transform:rotate(-45deg);
 font-size:0;
 position:relative;
 top:1px
}
.shortlistedPlansContainer h3 i.counter {
 width:21px;
 height:21px;
 font-style:normal;
 border-radius:50%;
 background:#36b37e;
 margin-left:4px;
 display:flex;
 align-items:center;
 justify-content:center;
 color:#fff;
 font-size:14px;
 font-weight:600
}
@media screen and (max-width:420px) {
 .shortlistedPlansContainer h3 i.counter {
  font-size:3.8vw
 }
}
.shortlistedPlansContainer>p {
 font-size:14px;
 color:#505f79;
 margin-top:4px
}
@media screen and (max-width:420px) {
 .shortlistedPlansContainer>p {
  font-size:3.8vw
 }
}
.shortlistedPlansContainer__empty {
 border:1px dashed #dfe1e6;
 display:flex;
 justify-content:center;
 align-items:center;
 height:56px;
 font-size:14px;
 border-radius:8px;
 margin-top:16px;
 color:#505f79
}
@media screen and (max-width:420px) {
 .shortlistedPlansContainer__empty {
  font-size:3.8vw
 }
}
ul li .shortlistedPlansContainer__plan {
 display:flex;
 margin-top:18px
}
ul li .shortlistedPlansContainer__plan__img picture {
 width:90px;
 height:45px;
 background:#fff;
 border:1px solid #dfe1e6;
 border-radius:8px;
 display:flex;
 align-items:center;
 justify-content:center
}
ul li .shortlistedPlansContainer__plan__details {
 margin-left:8px
}
ul li .shortlistedPlansContainer__plan__details p {
 font-size:14px;
 color:#505f79;
 font-weight:400
}
@media screen and (max-width:420px) {
 ul li .shortlistedPlansContainer__plan__details p {
  font-size:3.8vw
 }
}
ul li .shortlistedPlansContainer__plan__details p:first-child {
 font-size:16px;
 color:#253858;
 font-weight:600
}
@media screen and (max-width:420px) {
 ul li .shortlistedPlansContainer__plan__details p:first-child {
  font-size:4.5vw
 }
}
.shortlistedPlansContainer__more {
 border-top:1px solid #dfe1e6;
 margin:12px -16px -16px;
 padding:12px 0;
 text-align:center;
 font-size:14px;
 font-weight:600;
 cursor:pointer;
 color:#ff5630
}
@media screen and (max-width:420px) {
 .shortlistedPlansContainer__more {
  font-size:3.8vw
 }
}
.shortlistedPlansContainer__more:after {
 content:"";
 border:solid #ff5630;
 border-width:0 1px 1px 0;
 display:inline-block;
 padding:2px;
 transform:rotate(-45deg);
 margin-left:4px;
 position:relative;
 top:-1px
}
.callScheduleWrapV2 {
 position:fixed;
 bottom:0;
 right:0;
 width:328px;
 height:48px;
 transition:height .3s ease-in-out
}
.callScheduleWrapV2 .callBackClick {
 width:100%;
 height:48px;
 background:#36b37e;
 color:#fff;
 box-shadow:0 -6px 16px rgba(0,0,0,.16);
 border-radius:24px 24px 0 0;
 font-size:16px;
 font-weight:700;
 display:flex;
 align-items:center;
 justify-content:space-between;
 padding:0 24px;
 cursor:pointer;
 z-index:2;
 transition:color .3s ease-in-out,background .3s ease-in-out
}
@media screen and (max-width:420px) {
 .callScheduleWrapV2 .callBackClick {
  font-size:4.5vw
 }
}
.callScheduleWrapV2 .callBackClick:after {
 content:"";
 border:solid #fff;
 border-width:2px 0 0 2px;
 display:inline-block;
 padding:4px;
 transform:rotate(45deg);
 position:relative;
 top:3px;
 transition:border-color .3s ease-in-out,transform .3s ease-in-out
}
.callScheduleWrapV2 .call_schedule {
 min-height:unset;
 margin-bottom:0;
 padding-bottom:0
}
.callScheduleWrapV2.--open {
 height:245px
}
.callScheduleWrapV2.--open .callBackClick {
 background:#fff;
 color:#253858
}
.callScheduleWrapV2.--open .callBackClick:after {
 border-color:#253858;
 transform:rotate(-135deg);
 top:-3px
}
.callBackWrapper {
 width:328px;
 height:267px;
 background:#fff;
 color:#253858;
 box-shadow:0 -6px 16px rgba(0,0,0,.16);
 border-radius:24px 24px 0 0;
 font-size:16px;
 font-weight:700;
 position:fixed;
 bottom:0;
 right:0;
 display:flex;
 align-items:flex-start;
 flex-direction:column;
 padding:14px 24px;
 cursor:pointer;
 z-index:2
}
@media screen and (max-width:420px) {
 .callBackWrapper {
  font-size:4.5vw
 }
}
.callBackWrapper>div {
 margin:5px 0
}
.callBackWrapper .call_schedule {
 width:100%
}
.callBackWrapper .closeCallShedule {
 border:solid #253858;
 border-width:0 2px 2px 0;
 display:inline-block;
 padding:4px;
 -webkit-transform:rotate(45deg);
 transform:rotate(45deg);
 position:relative;
 top:-17px;
 right:-268px
}
.quotesAddCompare {
 border-radius:32px 32px 0 0;
 box-shadow:0 -6px 16px rgba(0,101,255,.15);
 position:fixed;
 bottom:0;
 width:100%;
 background:#fff;
 padding:20px 16px 0;
 z-index:98
}
@media only screen and (min-width:1024px) {
 .quotesAddCompare {
  display:none
 }
}
.quotesAddCompare__head {
 font-size:16px;
 font-weight:700;
 display:flex;
 align-items:center;
 justify-content:space-between
}
@media screen and (max-width:420px) {
 .quotesAddCompare__head {
  font-size:4.5vw
 }
}
.quotesAddCompare__head i {
 width:20px;
 height:20px;
 position:relative;
 cursor:pointer;
 text-indent:-99999px
}
.quotesAddCompare__head i:after,
.quotesAddCompare__head i:before {
 content:"";
 width:2px;
 height:100%;
 display:block;
 background:#253858;
 border-radius:2px;
 position:absolute;
 left:50%;
 top:0
}
.quotesAddCompare__head i:before {
 transform:translateX(-50%) rotate(45deg)
}
.quotesAddCompare__head i:after {
 transform:translateX(-50%) rotate(-45deg)
}
.quotesAddCompare__planRow {
 display:flex;
 align-items:flex-start;
 margin-top:18px;
 gap:16px
}
.quotesAddCompare__planRow__planCol {
 position:relative;
 width:50%
}
.quotesAddCompare__planRow__planCol picture {
 width:100px;
 height:50px;
 border-radius:8px;
 border:1px solid #dfe1e6;
 display:flex;
 align-items:center;
 justify-content:center;
 margin-bottom:8px
}
.quotesAddCompare__planRow__planCol picture img {
 width:64px
}
.quotesAddCompare__planRow__planCol__details {
 font-size:16px;
 font-weight:700
}
@media screen and (max-width:420px) {
 .quotesAddCompare__planRow__planCol__details {
  font-size:4.5vw
 }
}
.quotesAddCompare__planRow__planCol__details span {
 display:block;
 font-size:14px;
 font-weight:400;
 color:#505f79;
 margin-top:4px
}
@media screen and (max-width:420px) {
 .quotesAddCompare__planRow__planCol__details span {
  font-size:3.8vw
 }
}
.quotesAddCompare__planRow .--addPlan {
 font-size:16px;
 font-weight:600;
 color:#97a0af
}
@media screen and (max-width:420px) {
 .quotesAddCompare__planRow .--addPlan {
  font-size:4.5vw
 }
}
.quotesAddCompare__planRow .--addPlan:before {
 content:"+";
 width:100px;
 height:50px;
 border-radius:8px;
 border:1px dashed #dfe1e6;
 display:flex;
 align-items:center;
 justify-content:center;
 font-weight:400;
 font-size:32px;
 margin-bottom:8px
}
.quotesAddCompare__cta {
 border-top:1px solid #dfe1e6;
 margin:12px 0 0 -16px;
 width:calc(100% + 32px);
 display:flex;
 align-items:center;
 justify-content:center;
 font-size:16px;
 font-weight:700;
 color:#ff5630;
 height:48px
}
@media screen and (max-width:420px) {
 .quotesAddCompare__cta {
  font-size:4.5vw
 }
}
.quotesAddCompare__cta.disabled {
 color:#97a0af
}
.div_compare_revamp .div_remove_compare {
 width:18px;
 height:18px;
 right:unset;
 left:88px
}
.quotes_main_container {
 background:#f4f5f7!important
}
.main_quotes_mobile_div {
 background:transparent!important;
 margin-top:12px
}
@media only screen and (min-width:1024px) {
 .main_quotes_div {
  justify-content:space-between;
  position:relative;
  padding-bottom:24px
 }
 .main_quotes_div .quotes_stack_content_container:last-child {
  margin-bottom:0
 }
}
@media only screen and (min-width:1024px) {
 .main-container-quotesV2 {
  display:flex;
  flex-wrap:wrap
 }
}
.quotesListWidgets {
 margin:0 0 16px -16px;
 width:calc(100% + 32px);
 position:relative;
 padding:16px 0
}
@media only screen and (min-width:1024px) {
 .quotesListWidgets {
  width:100%;
  margin:0 0 16px;
  border-radius:8px;
  overflow:hidden
 }
 .quotesListWidgets .faqWrapperIcons {
  position:absolute;
  right:16px;
  top:16px
 }
}
.quotesListWidgets.popularPlans:before {
 content:"";
 position:absolute;
 background:transparent linear-gradient(141deg,#eae6ff,#0065ff) 0 0 no-repeat;
 width:100%;
 height:100%;
 left:0;
 top:0;
 opacity:.3
}
.quotesListWidgets.popularPlans.moneyValue {
 background:#fff
}
.quotesListWidgets.popularPlans.moneyValue .quotes_rvmp_card {
 background:#edfdf6;
 box-shadow:none
}
.quotesListWidgets.popularPlans.moneyValue .quotes_rvmp_card .quotes_rvmp_card__content__features li {
 border:none;
 background:#fff
}
.quotesListWidgets.popularPlans.moneyValue .quotes_rvmp_card__content__plan_header picture {
 border:none
}
.quotesListWidgets.popularPlans.moneyValue:before {
 content:none
}
.quotesListWidgets.popularPlans.moneyValue .tipBox.love {
 background:#d8fcea
}
.quotesListWidgets .faqCardWrapper {
 background:none;
 margin:0;
 padding:0
}
.quotesListWidgets .faqCardWrapper__card {
 background:none
}
.quotesListWidgets .quotes_rvmp_card {
 width:100%;
 border-radius:8px;
 padding:12px
}
@media only screen and (min-width:1024px) {
 .quotesListWidgets .filterAppliedHighlight {
  width:calc(100% - 24px);
  margin:0 auto
 }
}
.quotesListWidgets__header {
 padding:0 16px;
 position:relative
}
.quotesListWidgets__header p,
.quotesListWidgets__header p i {
 display:flex;
 align-items:center
}
.quotesListWidgets__header p i {
 width:40px;
 height:40px;
 background:#fff;
 border-radius:50%;
 margin-right:8px;
 justify-content:center
}
.quotesListWidgets__header p i:before {
 content:"";
 background:url(https://static.pbcdn.in/health-cdn/images/insurer-logo/quotes-logos/newQuotesSprite_orange.svg) no-repeat 0 0
}
.quotesListWidgets__header p span {
 font-size:16px;
 font-weight:700
}
@media screen and (max-width:420px) {
 .quotesListWidgets__header p span {
  font-size:4.5vw
 }
}
.quotesListWidgets__header__desc {
 margin-top:6px;
 font-size:14px;
 font-weight:400;
 color:#505f79;
 display:block!important
}
@media screen and (max-width:420px) {
 .quotesListWidgets__header__desc {
  font-size:3.8vw
 }
}
@media only screen and (min-width:1024px) {
 .quotesListWidgets__header__desc {
  margin:0 0 0 48px
 }
}
.quotesListWidgets.mostPopular .quotesListWidgets__header p i:before {
 background-position:0 -101px;
 width:22px;
 height:22px;
 background-size:65px
}
.quotesListWidgets.lowestPremium .quotesListWidgets__header p i:before {
 background-position:0 -140px;
 width:20px;
 height:17px
}
.quotesListWidgets.moneyValue .quotesListWidgets__header p i {
 background:#f2f7ff
}
.quotesListWidgets.moneyValue .quotesListWidgets__header p i:before {
 background-position:0 -148px;
 width:20px;
 height:21px;
 background-size:67px
}
.faqCardWrapper__card {
 border-radius:0;
 margin:0;
 box-shadow:none;
 padding:16px
}
.faqCardWrapper__card .faq__advise_content {
 justify-content:space-between
}
.faqCardWrapper__card .faq__advise_content__img {
 width:52px;
 height:56px;
 margin-right:12px;
 background:url(https://static.pbcdn.in/health-cdn/images/insurer-logo/quotes-logos/newQuotesSprite_orange.svg) no-repeat 0 0;
 background-position:0 -536px;
 border-radius:0
}
.faqCardWrapper__card .faq__advise_content__text {
 width:calc(100% - 52px)
}
.faq {
 background-color:#fff
}
.faq__heading {
 color:#505f79;
 font-size:12px;
 margin-bottom:8px
}
.faq__question {
 font-size:16px;
 font-weight:700;
 margin-bottom:10px
}
.faq__answer {
 font-size:14px;
 letter-spacing:.2px;
 color:#505f79;
 margin-bottom:21px;
 line-height:1.5
}
.faq__advise_content {
 display:flex;
 justify-content:flex-start
}
.faq__advise_content__img {
 width:113px;
 height:55px;
 margin-right:10px;
 background-color:#fdca00;
 border-radius:50%
}
.faq__advise_content__text {
 color:#505f79;
 font-size:14px;
 line-height:1.5
}
.need_help {
 padding:12px;
 background-color:#fff;
 box-shadow:0 6px 16px rgba(52,105,203,.36);
 border-radius:8px;
 margin-bottom:16px
}
.need_help__header {
 display:flex
}
.need_help__header__img {
 width:34px;
 height:38px;
 background:url(https://static.pbcdn.in/health-cdn/images/insurer-logo/quotes-logos/newQuotesSprite_orange.svg) no-repeat 0 0;
 margin-right:16px;
 background-position:0 -608px
}
.need_help__header__content__heading {
 color:#253858;
 font-size:14px;
 font-weight:600;
 margin-bottom:4px
}
@media screen and (max-width:420px) {
 .need_help__header__content__heading {
  font-size:3.8vw
 }
}
.need_help__header__content__description {
 font-size:12px;
 color:#505f79
}
@media screen and (max-width:420px) {
 .need_help__header__content__description {
  font-size:3.2vw
 }
}
.need_help__buttons {
 margin-top:12px;
 margin-left:50px;
 display:flex;
 gap:12px
}
.need_help__buttons button {
 width:50%;
 display:flex;
 align-items:center;
 justify-content:center;
 padding:0
}
.need_help__buttons button:before {
 content:"";
 width:14px;
 height:14px;
 background:url(https://static.pbcdn.in/health-cdn/images/insurer-logo/quotes-logos/newQuotesSprite_orange.svg) no-repeat 0 0;
 margin-right:6px
}
.need_help__buttons__chat_with_us {
 -webkit-appearance:none;
 font-weight:600;
 border-radius:8px;
 cursor:pointer;
 transition:background .3s ease-in-out;
 background:#fff;
 color:#ff5630!important;
 border:1px solid #ff5630;
 height:36px;
 font-size:14px
}
.need_help__buttons__chat_with_us.selected {
 border-color:#505f79;
 color:#505f79!important
}
.need_help__buttons__chat_with_us:hover {
 background:#fff radial-gradient(circle,transparent 1%,#fff 0) 50%/15000%
}
.need_help__buttons__chat_with_us:active {
 background-color:#dfe1e6;
 background-size:100%;
 transition:background 0s
}
@media screen and (max-width:420px) {
 .need_help__buttons__chat_with_us {
  font-size:3.8vw
 }
}
.need_help__buttons__chat_with_us:active,
.need_help__buttons__chat_with_us:hover {
 color:#ff5630!important
}
.need_help__buttons__chat_with_us:before {
 background-position:0 -661px!important
}
.need_help__buttons__call_us {
 -webkit-appearance:none;
 font-weight:600;
 border-radius:8px;
 cursor:pointer;
 transition:background .3s ease-in-out;
 height:48px;
 background:#ff5630;
 color:#fff!important;
 font-size:16px;
 border:none;
 height:36px;
 font-size:14px
}
@media screen and (max-width:420px) {
 .need_help__buttons__call_us {
  font-size:4.5vw
 }
}
.need_help__buttons__call_us:hover {
 background:#fc2e00 radial-gradient(circle,transparent 1%,#fc2e00 0) 50%/15000%
}
.need_help__buttons__call_us:active {
 background-color:#ff8063;
 background-size:100%;
 transition:background 0s ease-in-out
}
.need_help__buttons__call_us:disabled {
 background:#dfe1e6;
 color:#7a869a;
 pointer-events:none
}
.need_help__buttons__call_us:focus {
 outline:none
}
@media screen and (max-width:420px) {
 .need_help__buttons__call_us {
  font-size:3.8vw
 }
}
.need_help__buttons__call_us:before {
 background-position:0 -691px!important
}
@media only screen and (max-width:1023px) {
 .newQuotesFilters {
  background:#fff;
  padding:12px 0 12px 12px;
  scroll-snap-type:x mandatory;
  scroll-padding:0 12px
 }
 .newQuotesFilters .innerQuickFilters {
  scroll-snap-align:start
 }
 .newQuotesFilters .innerQuickFilters.inViewPort {
  border:1px solid #36b37e
 }
 .newQuotesFilters .innerQuickFilters.allFilterMobFixed:before,
 .newQuotesFilters .innerQuickFilters.lp:before,
 .newQuotesFilters .innerQuickFilters.mp:before,
 .newQuotesFilters .innerQuickFilters.vm:before {
  content:"";
  height:16px;
  background:url(https://static.pbcdn.in/health-cdn/images/insurer-logo/quotes-logos/newQuotesSprite_orange.svg) no-repeat 0 0;
  margin-right:6px;
  position:relative;
  top:-1px
 }
 .newQuotesFilters .innerQuickFilters.mp:before {
  background-position:0 -77px;
  width:17px
 }
 .newQuotesFilters .innerQuickFilters.vm:before {
  background-position:0 -108px;
  width:14px
 }
 .newQuotesFilters .innerQuickFilters.lp:before {
  background-position:0 -140px;
  width:20px
 }
 .newQuotesFilters .newQuotesAllFilters.allFilterMobFixed {
  width:36px;
  background:none;
  box-shadow:none!important;
  border:none!important;
  border-radius:20px 0 0 20px
 }
 .newQuotesFilters .newQuotesAllFilters.allFilterMobFixed span {
  box-shadow:0 1px 4px rgba(0,0,0,.16);
  border-radius:20px 0 0 20px;
  position:relative
 }
 .newQuotesFilters .newQuotesAllFilters.allFilterMobFixed span:before {
  content:"";
  background:url(https://static.pbcdn.in/health-cdn/images/insurer-logo/quotes-logos/newQuotesSprite_orange.svg) no-repeat 0 0;
  margin-right:6px;
  width:17px;
  height:13px;
  background-position:0 -173px
 }
 .newQuotesFilters .newQuotesAllFilters.allFilterMobFixed span i {
  position:absolute;
  left:5px;
  top:-1px;
  background:#36b37e
 }
}
@media only screen and (max-width:1023px) {
 .claimSupportCard {
  margin-top:0;
  margin-bottom:12px
 }
}
.textLink {
 color:#36b37e
}
.textLink:after {
 content:"";
 border:solid #36b37e;
 border-width:0 1px 1px 0;
 display:inline-block;
 padding:2px;
 transform:rotate(-45deg);
 margin-left:3px;
 vertical-align:middle
}
.whyChooseWrapper_revamp .whyChooseWrapper {
 background:none;
 margin:0 0 0 -16px;
 width:calc(100% + 32px);
 padding:0
}
@media only screen and (min-width:1024px) {
 .whyChooseWrapper_revamp .whyChooseWrapper {
  width:100%;
  margin:16px 0
 }
 .whyChooseWrapper_revamp .whyChooseWrapper ul>li {
  width:calc(50% - 90.5px)
 }
 .whyChooseWrapper_revamp .whyChooseWrapper ul>li:first-child {
  width:130px;
  background:none;
  box-shadow:none;
  white-space:normal;
  padding:0;
  margin-right:32px
 }
 .whyChooseWrapper_revamp .whyChooseWrapper ul>li:first-child span {
  position:relative;
  top:50%;
  transform:translateY(-50%);
  display:block;
  font-size:20px;
  font-weight:700;
  line-height:28px
 }
}
@media only screen and (min-width:1024px) and (max-width:420px) {
 .whyChooseWrapper_revamp .whyChooseWrapper ul>li:first-child span {
  font-size:5.6vw
 }
}
@media only screen and (min-width:1024px) {
 .whyChooseWrapper_revamp .whyChooseWrapper ul>li:last-child {
  margin-right:0
 }
}
.mobile_bottom_bar {
 height:56px
}
.mobile_bottom_bar .mobile_bottom_chat .bottom_bar_span {
 font-size:12px;
 color:#253858
}
@media screen and (max-width:420px) {
 .mobile_bottom_bar .mobile_bottom_chat .bottom_bar_span {
  font-size:3.2vw
 }
}
.mobile_bottom_bar .mobile_bottom_chat .cart-circle {
 top:-2px;
 right:-5px
}
.mobile_bottom_bar .mobile_bottom_chat i {
 width:28px;
 height:28px;
 background:url(https://static.pbcdn.in/health-cdn/images/insurer-logo/quotes-logos/newQuotesSprite_orange.svg) no-repeat 0 0
}
.mobile_bottom_bar .mobile_bottom_chat i.bottom_bar_icons.allPlans {
 background-position:0 -334px
}
.mobile_bottom_bar .mobile_bottom_chat i.bottom_bar_icons.allPlans+.bottom_bar_span {
 color:#36b37e
}
.mobile_bottom_bar .mobile_bottom_chat i.bottom_bar_icons.shortlist {
 background-position:0 -375px
}
.mobile_bottom_bar .mobile_bottom_chat i.bottom_bar_icons.compare {
 background-position:-1px -418px
}
.mobile_bottom_bar .mobile_bottom_chat i.bottom_bar_icons.callNow {
 background-position:0 -842px
}
.comparePageHead {
 white-space:nowrap
}
@media only screen and (max-width:1023px) {
 .coachMarkShortlist {
  display:block;
  position:fixed;
  width:100%;
  height:100%;
  left:0;
  top:0;
  z-index:99;
  opacity:0;
  animation:fadeCoachMask .5s ease-in-out 0s forwards
 }
 @keyframes fadeCoachMask {
  0% {
   visibility:hidden;
   opacity:0
  }
  to {
   visibility:visible;
   opacity:1
  }
 }
 .coachMarkShortlist:before {
  content:"";
  position:absolute;
  width:100%;
  height:100%;
  left:0;
  top:0;
  background:rgba(37,56,88,.9);
  clip-path:polygon(0 0,100% 0,100% 100%,65% 100%,65% 92%,37% 92%,37% 100%,0 100%)
 }
 .coachMarkShortlist.withCallUs:before {
  clip-path:polygon(0 0,100% 0,100% 100%,50% 100%,50% 92%,27% 92%,27% 100%,0 100%)
 }
 .coachMarkShortlist .pointer {
  position:absolute;
  width:16px;
  height:16px;
  border-radius:50%;
  background:#fff;
  top:87%;
  left:48vw
 }
 .coachMarkShortlist .pointer:before {
  content:"";
  position:absolute;
  width:12px;
  height:12px;
  border-radius:50%;
  border:1px solid #253858;
  left:50%;
  top:50%;
  transform:translate(-50%,-50%)
 }
 .coachMarkShortlist .pointer:after {
  content:"";
  position:absolute;
  width:1px;
  height:100px;
  background:#fff;
  bottom:140%;
  left:50%;
  transform:translateX(-50%)
 }
 .coachMarkShortlist.withCallUs .pointer {
  left:36vw
 }
 .coachMarkShortlist .coachBox {
  width:90%;
  left:50%;
  transform:translateX(-50%);
  position:absolute;
  background:#fff;
  border-radius:8px;
  padding:16px;
  bottom:30%;
  font-size:14px;
  color:#253858;
  font-weight:400
 }
}
@media only screen and (max-width:1023px) and (max-width:420px) {
 .coachMarkShortlist .coachBox {
  font-size:3.8vw
 }
}
@media only screen and (max-width:1023px) {
 .coachMarkShortlist .coachBox span {
  font-size:16px;
  font-weight:700;
  display:block;
  margin-bottom:8px
 }
}
@media only screen and (max-width:1023px) and (max-width:420px) {
 .coachMarkShortlist .coachBox span {
  font-size:4.5vw
 }
}
@media only screen and (max-width:1023px) {
 .coachMarkShortlist .coachBox a {
  display:block;
  float:right;
  margin-top:16px;
  font-size:14px;
  font-weight:600;
  color:#ff5630
 }
}
@media only screen and (max-width:1023px) and (max-width:420px) {
 .coachMarkShortlist .coachBox a {
  font-size:3.8vw
 }
}
@media only screen and (max-width:1023px) {
 .navbarWrapper {
  position:relative
 }
}
@media only screen and (min-width:1024px) {
 .filterAppliedHighlightWrap {
  width:100%
 }
}
.filterAppliedHighlight {
 font-size:12px;
 font-weight:700;
 width:calc(100% - 24px);
 margin:0 auto;
 background:#f1fdf7;
 border-radius:8px 8px 0 0;
 height:26px;
 text-align:center;
 box-shadow:inset 0 -1px 2px rgba(0,0,0,.16)
}
@media screen and (max-width:420px) {
 .filterAppliedHighlight {
  font-size:3.2vw
 }
}
@media only screen and (min-width:1024px) {
 .filterAppliedHighlight {
  width:calc(100% - 168px);
  margin:0 24px 0 auto
 }
}
.filterAppliedHighlight>p {
 display:flex;
 align-items:center;
 justify-content:center;
 height:100%
}
.filterAppliedHighlight .quotesUsp {
 color:#36b37e
}
.filterAppliedHighlight .filterFlagVal:before {
 content:"";
 width:17px;
 height:16px;
 background:url(https://static.pbcdn.in/health-cdn/images/insurer-logo/quotes-logos/newQuotesSprite_orange.svg) no-repeat 0 0;
 margin-right:8px
}
.filterAppliedHighlight .filterFlagVal.claim:before {
 background-position:0 -752px
}
.filterAppliedHighlight .filterFlagVal.cashless:before {
 background-position:0 -720px
}
.filterAppliedHighlight.autoSlider {
 position:relative;
 overflow:hidden
}
.filterAppliedHighlight.autoSlider>p {
 width:100%;
 height:100%;
 position:absolute;
 top:0;
 left:100%;
 animation:mostPopUspSlider 12s ease-in-out infinite
}
@keyframes mostPopUspSlider {
 0% {
  left:100%
 }
 6% {
  left:0
 }
 50% {
  left:0
 }
 54% {
  left:-100%
 }
 to {
  left:-100%
 }
}
.filterAppliedHighlight.autoSlider>p:first-child {
 animation-delay:0s
}
.filterAppliedHighlight.autoSlider>p:nth-child(2) {
 animation-delay:6s
}
.scroll-to-top {
 position:fixed;
 padding:0 16px;
 height:32px;
 left:50%;
 z-index:100;
 transform:translateX(-50%);
 background:#5e6c84;
 border-radius:18px;
 font-size:12px;
 font-weight:600;
 color:#fff;
 display:flex;
 align-items:center;
 opacity:0;
 cursor:pointer
}
@media screen and (max-width:420px) {
 .scroll-to-top {
  font-size:3.2vw
 }
}
@media only screen and (max-width:1023px) {
 .scroll-to-top {
  top:30px;
  z-index:8
 }
}
@media only screen and (min-width:1024px) {
 .scroll-to-top {
  top:110px;
  z-index:1
 }
}
.scroll-to-top i {
 width:14px;
 height:14px;
 margin-right:8px;
 position:relative;
 background:url(https://static.pbcdn.in/health-cdn/images/insurer-logo/quotes-logos/newQuotesSprite_orange.svg) no-repeat 0 0;
 background-position:0 -814px
}
.scroll-to-top.--slideIn {
 animation:scrollTopSlideIn .5s ease-in forwards
}
@media only screen and (max-width:1023px) {
 @keyframes scrollTopSlideIn {
  to {
   top:70px;
   opacity:1
  }
 }
}
@media only screen and (min-width:1024px) {
 @keyframes scrollTopSlideIn {
  to {
   top:130px;
   opacity:1
  }
 }
}
.scroll-to-top.--slideOut {
 animation:scrollTopSlideOut .5s ease-out forwards
}
@media only screen and (max-width:1023px) {
 @keyframes scrollTopSlideOut {
  0% {
   top:70px;
   opacity:1
  }
  to {
   top:30px;
   opacity:0
  }
 }
}
@media only screen and (min-width:1024px) {
 @keyframes scrollTopSlideOut {
  0% {
   top:130px;
   opacity:1
  }
  to {
   top:110px;
   opacity:0
  }
 }
}
@media only screen and (min-width:1024px) {
 .dynamic_offer .rightFixCol {
  position:sticky;
  position:-webkit-sticky;
  top:140px
 }
}
@media only screen and (min-width:1024px) {
 .quotes_compare_div>div {
  width:33.33333%!important
 }
 .quotes_compare_div .--addPlan {
  text-align:center
 }
}

</style>
<main role="main">
	<section class="invest-long page-heading-h2" style="background: none;">
        <div class="container invest-long-bg" style="box-shadow: none;">
            <div class="row" id="data_alll--">
                
    			 
               
                <div class="col-12 col-md-12 col-lg-12 col-sm-12  ">
                     <div class="main_quotes_div is-hidden-mobile is-hidden-tablet-only-custom  null">
    <div class="main_quotes_container">
        <div class="quotes_stack_content_container is-hidden-mobile is-hidden-tablet-only-custom " id="quoteStack0">
            <div class="quotes_content_desktop is-hidden-mobile is-hidden-tablet-only-custom">
                <div class="new_quotes_plan_container">
                    <div class="quotes_logo_container1">
                        <picture>
                            <source type="image/webp"
                                srcset="https://static.pbcdn.in/health-cdn/images/insurer-logo/Care_Health@2x.webp">
                            <source type="image/png"
                                srcset="https://static.pbcdn.in/health-cdn/images/insurer-logo/Care_Health@2x.png"><img
                                src="https://static.pbcdn.in/health-cdn/images/insurer-logo/Care_Health@2x.png"
                                alt="Care Health" class="img_contain" width="90">
                        </picture>
                    </div>
                    <div class="features_container"><span class="quotes_more_plans more"><span>13 More
                                Plans</span></span></div>
                </div>
                <div class="quotes_content_container  is-hidden-mobile is-hidden-tablet-only-custom">
                    <div class="top_quotes_content">
                        <div class="planContent_container "><span class="quotes_plan_name">Care Classic </span></div>
                        <div class="cover_container newPremColCont">
                            <div class="div_cover"><span class="span_cover">Cover</span><span
                                    class="span_cover_content ">₹ 5L</span></div>
                            <div class="div_network " id="CashlessHospitalonQuotes"><span class="span_network">Cashless
                                    Hospitals</span><span class="span_network_content ">364</span></div>
                        </div>
                        <div class="premium_container ">
                            <div class="premium_button" id="ProceedToProduct">₹897/month</div><span
                                class="annually_premium">₹ 10,758 annually</span>
                        </div>
                        <div class="shortlist_container ">
                            <div class="Path_shortlist  "><img alt="shortlistIcon" class="shortlist_icon"
                                    src="https://static.pbcdn.in/health-cdn/images/insurer-logo/quotes-logos/shortlist.svg">
                            </div>
                        </div>
                    </div>
                    <div class="bottom_quotes_content ">
                        <div class="check_features_cont">
                            <div class="checkbox_container"><label class="label_checkbox_plan"><input type="checkbox"
                                        class="checkbox_quotes">Add to Compare</label>
                                <div class="request-loader"></div>
                            </div>
                            <div class="div_features" id="viewfeatureclick"><span class="quotes_features">View
                                    Features</span></div>
                        </div>
                        <div class="div_cover_usp">
                            <div class="div_usp"><img alt="usp"
                                    src="https://static.pbcdn.in/health-cdn/images/insurer-logo/quotes-logos/claim.svg"
                                    class="usp_svg"><a
                                    class="is-primary tooltip is-tooltip-multiline is-tooltip-top tip-box"
                                    data-tooltip="Policy can be issued as early as 7 days after Covid positive detection"><span
                                        class="span_usp">7 day covid cooling off period </span></a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="quotes_stack_content_container is-hidden-mobile is-hidden-tablet-only-custom " id="quoteStack1">
            <div class="quotes_content_desktop is-hidden-mobile is-hidden-tablet-only-custom">
                <div class="new_quotes_plan_container">
                    <div class="quotes_logo_container1">
                        <picture>
                            <source type="image/webp"
                                srcset="https://static.pbcdn.in/health-cdn/images/insurer-logo/Niva_Bupa_(formerly_known_as_Max_Bupa)@2x.webp">
                            <source type="image/png"
                                srcset="https://static.pbcdn.in/health-cdn/images/insurer-logo/Niva_Bupa_(formerly_known_as_Max_Bupa)@2x.png">
                            <img src="https://static.pbcdn.in/health-cdn/images/insurer-logo/Niva_Bupa_(formerly_known_as_Max_Bupa)@2x.png"
                                alt="Niva Bupa (formerly known as Max Bupa)" class="img_contain" width="90">
                        </picture>
                    </div>
                    <div class="features_container"><span class="quotes_more_plans more"><span>10 More
                                Plans</span></span></div>
                </div>
                <div class="quotes_content_container  is-hidden-mobile is-hidden-tablet-only-custom">
                    <div class="newLaunchedTag"><span class="">5% Online discount*</span></div>
                    <div class="top_quotes_content">
                        <div class="planContent_container "><span class="quotes_plan_name">1Cr Super Saver </span><span
                                class="new_launched_tag"><span class="newLaunchedTag_name">New Launch</span></span>
                        </div>
                        <div class="cover_container newPremColCont">
                            <div class="div_cover"><span class="span_cover">Cover</span><span
                                    class="span_cover_content ">₹ 1Cr</span></div>
                            <div class="div_network " id="CashlessHospitalonQuotes"><span class="span_network">Cashless
                                    Hospitals</span><span class="span_network_content ">301</span></div>
                        </div>
                        <div class="premium_container ">
                            <div class="premium_button" id="ProceedToProduct">₹1,228/month</div><span
                                class="annually_premium">₹ 14,729 annually</span>
                        </div>
                        <div class="shortlist_container ">
                            <div class="Path_shortlist  "><img alt="shortlistIcon" class="shortlist_icon"
                                    src="https://static.pbcdn.in/health-cdn/images/insurer-logo/quotes-logos/shortlist.svg">
                            </div>
                        </div>
                    </div>
                    <div class="bottom_quotes_content ">
                        <div class="check_features_cont">
                            <div class="checkbox_container"><label class="label_checkbox_plan"><input type="checkbox"
                                        class="checkbox_quotes">Add to Compare</label>
                                <div class="request-loader"></div>
                            </div>
                            <div class="div_features" id="viewfeatureclick"><span class="quotes_features">View
                                    Features</span></div>
                        </div>
                        <div class="div_cover_usp"><span class="max_condition1">0 day covid cooling off
                                period<sup>#</sup><sup></sup></span></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="quotes_stack_content_container is-hidden-mobile is-hidden-tablet-only-custom " id="quoteStack2">
            <div class="quotes_content_desktop is-hidden-mobile is-hidden-tablet-only-custom">
                <div class="new_quotes_plan_container">
                    <div class="quotes_logo_container1">
                        <picture>
                            <source type="image/webp"
                                srcset="https://static.pbcdn.in/health-cdn/images/insurer-logo/Star_Health@2x.webp">
                            <source type="image/png"
                                srcset="https://static.pbcdn.in/health-cdn/images/insurer-logo/Star_Health@2x.png"><img
                                src="https://static.pbcdn.in/health-cdn/images/insurer-logo/Star_Health@2x.png"
                                alt="Star Health" class="img_contain" width="90">
                        </picture>
                    </div>
                    <div class="features_container"><span class="quotes_more_plans more"><span>5 More
                                Plans</span></span></div>
                </div>
                <div class="quotes_content_container  is-hidden-mobile is-hidden-tablet-only-custom">
                    <div class="newLaunchedTag"><span class="">5% Online discount on checkout*</span></div>
                    <div class="top_quotes_content">
                        <div class="planContent_container "><span class="quotes_plan_name">Health Optima </span></div>
                        <div class="cover_container newPremColCont">
                            <div class="div_cover"><span class="span_cover">Cover</span><span
                                    class="span_cover_content ">₹ 5L</span></div>
                            <div class="div_network " id="CashlessHospitalonQuotes"><span class="span_network">Cashless
                                    Hospitals</span><span class="span_network_content ">300</span></div>
                        </div>
                        <div class="premium_container ">
                            <div class="premium_button" id="ProceedToProduct">₹979/month</div><span
                                class="annually_premium">₹ 11,747 annually</span>
                        </div>
                        <div class="shortlist_container ">
                            <div class="Path_shortlist  "><img alt="shortlistIcon" class="shortlist_icon"
                                    src="https://static.pbcdn.in/health-cdn/images/insurer-logo/quotes-logos/shortlist.svg">
                            </div>
                        </div>
                    </div>
                    <div class="bottom_quotes_content ">
                        <div class="check_features_cont">
                            <div class="checkbox_container"><label class="label_checkbox_plan"><input type="checkbox"
                                        class="checkbox_quotes">Add to Compare</label>
                                <div class="request-loader"></div>
                            </div>
                            <div class="div_features" id="viewfeatureclick"><span class="quotes_features">View
                                    Features</span></div>
                        </div>
                        <div class="div_cover_usp">
                            <div class="div_usp"><img alt="usp"
                                    src="https://static.pbcdn.in/health-cdn/images/insurer-logo/quotes-logos/claim.svg"
                                    class="usp_svg"><a
                                    class="is-primary tooltip is-tooltip-multiline is-tooltip-top tip-box"
                                    data-tooltip="Get discount of 5% after submission of proposal"><span
                                        class="span_usp">5% online discount on checkout </span></a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="quotes_stack_content_container is-hidden-mobile is-hidden-tablet-only-custom " id="quoteStack3">
            <div class="quotes_content_desktop is-hidden-mobile is-hidden-tablet-only-custom">
                <div class="new_quotes_plan_container">
                    <div class="quotes_logo_container1">
                        <picture>
                            <source type="image/webp"
                                srcset="https://static.pbcdn.in/health-cdn/images/insurer-logo/Aditya_Birla@2x.webp">
                            <source type="image/png"
                                srcset="https://static.pbcdn.in/health-cdn/images/insurer-logo/Aditya_Birla@2x.png"><img
                                src="https://static.pbcdn.in/health-cdn/images/insurer-logo/Aditya_Birla@2x.png"
                                alt="Aditya Birla" class="img_contain" width="90">
                        </picture>
                    </div>
                    <div class="features_container"><span class="quotes_more_plans more"><span>7 More
                                Plans</span></span></div>
                </div>
                <div class="quotes_content_container  is-hidden-mobile is-hidden-tablet-only-custom">
                    <div class="top_quotes_content">
                        <div class="planContent_container "><span class="quotes_plan_name">1 Cr Sum Insured
                                **</span><span class="new_launched_tag"><span class="newLaunchedTag_name">New
                                    Launch</span></span></div>
                        <div class="cover_container newPremColCont">
                            <div class="div_cover"><span class="span_cover">Cover</span><span
                                    class="span_cover_content ">₹ 1Cr</span></div>
                            <div class="div_network " id="CashlessHospitalonQuotes"><span class="span_network">Cashless
                                    Hospitals</span><span class="span_network_content ">278</span></div>
                        </div>
                        <div class="premium_container ">
                            <div class="premium_button" id="ProceedToProduct">₹1,186/month</div><span
                                class="annually_premium">₹ 14,229 annually</span>
                        </div>
                        <div class="shortlist_container ">
                            <div class="Path_shortlist  "><img alt="shortlistIcon" class="shortlist_icon"
                                    src="https://static.pbcdn.in/health-cdn/images/insurer-logo/quotes-logos/shortlist.svg">
                            </div>
                        </div>
                    </div>
                    <div class="bottom_quotes_content ">
                        <div class="check_features_cont">
                            <div class="checkbox_container"><label class="label_checkbox_plan"><input type="checkbox"
                                        class="checkbox_quotes">Add to Compare</label>
                                <div class="request-loader"></div>
                            </div>
                            <div class="div_features" id="viewfeatureclick"><span class="quotes_features">View
                                    Features</span></div>
                        </div>
                        <div class="div_cover_usp">
                            <div class="div_usp"><img alt="usp"
                                    src="https://static.pbcdn.in/health-cdn/images/insurer-logo/quotes-logos/claim.svg"
                                    class="usp_svg"><a
                                    class="is-primary tooltip is-tooltip-multiline is-tooltip-top tip-box"
                                    data-tooltip="30 days Waiting Period for Covid-19"><span class="span_usp">30 days
                                        Waiting Period for Covid-19 </span></a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="quotes_stack_content_container is-hidden-mobile is-hidden-tablet-only-custom " id="quoteStack4">
            <div class="quotes_content_desktop is-hidden-mobile is-hidden-tablet-only-custom">
                <div class="new_quotes_plan_container">
                    <div class="quotes_logo_container1">
                        <picture>
                            <source type="image/webp"
                                srcset="https://static.pbcdn.in/health-cdn/images/insurer-logo/Bajaj_Allianz@2x.webp">
                            <source type="image/png"
                                srcset="https://static.pbcdn.in/health-cdn/images/insurer-logo/Bajaj_Allianz@2x.png">
                            <img src="https://static.pbcdn.in/health-cdn/images/insurer-logo/Bajaj_Allianz@2x.png"
                                alt="Bajaj Allianz" class="img_contain" width="90">
                        </picture>
                    </div>
                    <div class="features_container"><span class="quotes_more_plans more"><span>1 More
                                Plans</span></span></div>
                </div>
                <div class="quotes_content_container  is-hidden-mobile is-hidden-tablet-only-custom">
                    <div class="top_quotes_content">
                        <div class="planContent_container "><span class="quotes_plan_name">Health Guard Family Floater
                            </span></div>
                        <div class="cover_container newPremColCont">
                            <div class="div_cover"><span class="span_cover">Cover</span><span
                                    class="span_cover_content ">₹ 5L</span></div>
                            <div class="div_network " id="CashlessHospitalonQuotes"><span class="span_network">Cashless
                                    Hospitals</span><span class="span_network_content ">339</span></div>
                        </div>
                        <div class="premium_container ">
                            <div class="premium_button" id="ProceedToProduct">₹984/month</div><span
                                class="annually_premium">₹ 11,800 annually</span>
                        </div>
                        <div class="shortlist_container ">
                            <div class="Path_shortlist  "><img alt="shortlistIcon" class="shortlist_icon"
                                    src="https://static.pbcdn.in/health-cdn/images/insurer-logo/quotes-logos/shortlist.svg">
                            </div>
                        </div>
                    </div>
                    <div class="bottom_quotes_content ">
                        <div class="check_features_cont">
                            <div class="checkbox_container"><label class="label_checkbox_plan"><input type="checkbox"
                                        class="checkbox_quotes">Add to Compare</label>
                                <div class="request-loader"></div>
                            </div>
                            <div class="div_features" id="viewfeatureclick"><span class="quotes_features">View
                                    Features</span></div>
                        </div>
                        <div class="div_cover_usp"><span class="max_condition1">98% claim settlement
                                ratio<sup>#</sup><sup></sup></span></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="quotes_stack_content_container is-hidden-mobile is-hidden-tablet-only-custom " id="quoteStack5">
            <div class="quotes_content_desktop is-hidden-mobile is-hidden-tablet-only-custom">
                <div class="new_quotes_plan_container">
                    <div class="quotes_logo_container1">
                        <picture>
                            <source type="image/webp"
                                srcset="https://static.pbcdn.in/health-cdn/images/insurer-logo/DIGIT@2x.webp">
                            <source type="image/png"
                                srcset="https://static.pbcdn.in/health-cdn/images/insurer-logo/DIGIT@2x.png"><img
                                src="https://static.pbcdn.in/health-cdn/images/insurer-logo/DIGIT@2x.png" alt="DIGIT"
                                class="img_contain" width="90">
                        </picture>
                    </div>
                    <div class="features_container"><span class="quotes_more_plans more"><span>4 More
                                Plans</span></span></div>
                </div>
                <div class="quotes_content_container  is-hidden-mobile is-hidden-tablet-only-custom">
                    <div class="top_quotes_content">
                        <div class="planContent_container "><span class="quotes_plan_name">Arogya Sanjeevani </span>
                        </div>
                        <div class="cover_container newPremColCont">
                            <div class="div_cover"><span class="span_cover">Cover</span><span
                                    class="span_cover_content ">₹ 5L</span></div>
                            <div class="div_network " id="CashlessHospitalonQuotes"><span class="span_network">Cashless
                                    Hospitals</span><span class="span_network_content ">243</span></div>
                        </div>
                        <div class="premium_container ">
                            <div class="premium_button" id="ProceedToProduct">₹459/month</div><span
                                class="annually_premium">₹ 5,501 annually</span>
                        </div>
                        <div class="shortlist_container ">
                            <div class="Path_shortlist  "><img alt="shortlistIcon" class="shortlist_icon"
                                    src="https://static.pbcdn.in/health-cdn/images/insurer-logo/quotes-logos/shortlist.svg">
                            </div>
                        </div>
                    </div>
                    <div class="bottom_quotes_content ">
                        <div class="check_features_cont">
                            <div class="checkbox_container"><label class="label_checkbox_plan"><input type="checkbox"
                                        class="checkbox_quotes">Add to Compare</label>
                                <div class="request-loader"></div>
                            </div>
                            <div class="div_features" id="viewfeatureclick"><span class="quotes_features">View
                                    Features</span></div>
                        </div>
                        <div class="div_cover_usp"></div>
                    </div>
                </div>
            </div>
        </div>
        <div style="height: 100px;" class="lazyload-placeholder"></div>
        <div style="height: 100px;" class="lazyload-placeholder"></div>
        <div style="height: 100px;" class="lazyload-placeholder"></div>
        <div style="height: 100px;" class="lazyload-placeholder"></div>
        <div style="height: 100px;" class="lazyload-placeholder"></div>
        <div style="height: 100px;" class="lazyload-placeholder"></div>
        <div style="height: 100px;" class="lazyload-placeholder"></div>
        <div style="height: 100px;" class="lazyload-placeholder"></div>
        <div style="height: 100px;" class="lazyload-placeholder"></div>
        <div style="height: 100px;" class="lazyload-placeholder"></div>
        <div style="height: 100px;" class="lazyload-placeholder"></div>
        <div style="height: 100px;" class="lazyload-placeholder"></div>
        <div style="height: 100px;" class="lazyload-placeholder"></div>
        <div style="height: 100px;" class="lazyload-placeholder"></div>
    </div>
    <div class="dynamic_offer is-hidden-mobile is-hidden-tablet-only-custom">
        <div class="">
            <div>
                <div class="greenChannelContainer claimSupportCard greenNoCompare">
                    <div class="greenChannelBanner">
                        <div class="textGreenBanner">
                            <h4>30 minutes<span>Claim Support</span></h4>We provide claim support at your hospital or
                            home in 30 minutes<span class="linkGreenWidget">Know more</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="full_chat_container " style="visibility: visible; height: 0px;">
                <div class="iframe_container"><iframe id="cbframe" title="chat-iframe" style="height: 100%; width: 100%"
                        src="https://pbchathealthexp.policybazaar.com/livechat?cb=1&amp;exp=2&amp;product=Health&amp;leadid=NDQ0NzExNTMy"
                        frameborder="0"> Something wrong... </iframe></div>
            </div>
            <div class="call-me-fixed-quote  md-whiteframe-z1" role="button" tabindex="0"><button type="button"><em
                        class="callback-icon"></em><span>Call Me <em class="now">Now</em></span></button></div>
        </div>
    </div>
</div>
                </div>
                
                
            
			</div>
			
			 
    	</div>
    </section>

</main>


@endsection