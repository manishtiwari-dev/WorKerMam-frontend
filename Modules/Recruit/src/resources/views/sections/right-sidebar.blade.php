 <style>
     .control-sidebar {
         position: absolute;
         top: 0;
         z-index: 830;
         right: 0;
     }

     .right-sidebar {
         z-index: 1000;
         box-shadow: 5px 1px 40px rgba(0, 0, 0, .1);
         transition: all .3s ease;
         border: none;
         background-color: #fff;
     }

     .right-sidebar .rpanel-title {
         background: #2b2b2b;
         display: block;
         padding: 21px;
         color: #fff;
         text-transform: uppercase;
         font-size: 13px;
     }

     .right-sidebar .rpanel-title span {
         float: right;
         cursor: pointer;
         font-size: 11px;
     }

     .control-sidebar-slide-open .control-sidebar {
         width: 50%;
         overflow-y: scroll;
     }

     @media (max-width: 540px) {
         .control-sidebar-slide-open .control-sidebar {
             width: 100%;
         }
     }

     .control-sidebar-slide-open .control-sidebar,
     .control-sidebar-slide-open .control-sidebar:before {
         right: 0;
     }


     .img-sm,
     .card-comments .card-comment img,
     .user-block.user-block-sm img,
     .img-md,
     .img-lg {
         float: left;
     }

     .img-sm,
     .card-comments .card-comment img,
     .user-block.user-block-sm img {
         width: 30px !important;
         height: 30px !important;
     }

     .img-sm+.img-push,
     .card-comments .card-comment img+.img-push,
     .user-block.user-block-sm img+.img-push {
         margin-left: 40px;
     }

     .img-md {
         width: 60px;
         height: 60px;
     }

     .img-md+.img-push {
         margin-left: 70px;
     }

     .img-lg {
         width: 100px;
         height: 100px;
     }

     .img-lg+.img-push {
         margin-left: 110px;
     }

     .img-bordered {
         border: 3px solid #adb5bd;
         padding: 3px;
     }

     .img-bordered-sm {
         border: 2px solid #adb5bd;
         padding: 2px;
     }

     .img-rounded {
         border-radius: 0.25rem;
     }

     .img-circle {
         border-radius: 50%;
     }

     .img-size-64,
     .img-size-50,
     .img-size-32 {
         height: auto;
     }

     .img-size-64 {
         width: 64px;
     }

     .img-size-50 {
         width: 50px;
     }

     .img-size-32 {
         width: 32px;
     }

     .size-32,
     .size-40,
     .size-50 {
         display: block;
         text-align: center;
     }

     .size-32 {
         width: 32px;
         height: 32px;
         line-height: 32px;
     }

     .size-40 {
         width: 40px;
         height: 40px;
         line-height: 40px;
     }

     .size-50 {
         width: 50px;
         height: 50px;
         line-height: 50px;
     }

     .attachment-block {
         border: 1px solid rgba(0, 0, 0, 0.125);
         padding: 5px;
         margin-bottom: 10px;
         background: #f7f7f7;
     }

     .attachment-block .attachment-img {
         max-width: 100px;
         max-height: 100px;
         height: auto;
         float: left;
     }

     .attachment-block .attachment-pushed {
         margin-left: 110px;
     }

     .attachment-block .attachment-heading {
         margin: 0;
     }

     .attachment-block .attachment-text {
         color: #555;
     }

     .connectedSortable {
         min-height: 100px;
     }
 </style>
 
 <link rel="stylesheet" href="{{ asset('asset/css/icons/themify-icons/themify-icons.css') }}" />
 <!-- Control Sidebar -->
 <aside class="control-sidebar control-sidebar-light right-sidebar">
     <!-- Control sidebar content goes here -->
     <div class="slimscrollright" id="right-sidebar-content">

     </div>
 </aside>
 <!-- /.control-sidebar -->
@push('scripts')

@endpush