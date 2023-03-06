@php($ambil_konfigurasi_aplikasis = \App\Models\Master_konfigurasi_aplikasi::where('id_konfigurasi_aplikasis',1)->first())
<!DOCTYPE html>
<html lang="en">

<head>
	<base href="./">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<meta name="description" content="{{$ambil_konfigurasi_aplikasis->deskripsi_konfigurasi_aplikasis}}">
	<meta name="author" content="{{$ambil_konfigurasi_aplikasis->nama_konfigurasi_aplikasis}}">
	<meta name="keyword" content="{{$ambil_konfigurasi_aplikasis->keyword_konfigurasi_aplikasis}}">
	<title>{{$ambil_konfigurasi_aplikasis->nama_konfigurasi_aplikasis}}</title>
	<link rel="icon" type="image/png" href="{{URL::asset($ambil_konfigurasi_aplikasis->icon_konfigurasi_aplikasis)}}" sizes="any" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="{{URL::asset('template/css/nucleo-icons.css')}}" rel="stylesheet" />
    <link href="{{URL::asset('template/css/nucleo-svg.css')}}" rel="stylesheet" />
    <script src="{{URL::asset('template/js/42d5adcbca.js')}}" crossorigin="anonymous"></script>
    <link id="pagestyle" href="{{URL::asset('template/css/soft-ui-dashboard.css?v=1.0.6')}}" rel="stylesheet" />
	<link href="{{URL::asset('template/vendors/flag-icon-css/css/flag-icon.min.css')}}" rel="stylesheet">
	<link href="{{URL::asset('template/vendors/pace-progress/css/pace.min.css')}}" rel="stylesheet">
	<link href="{{URL::asset('template/vendors/@coreui/coreui-chartjs/css/coreui-chartjs.css')}}" rel="stylesheet">
	<link rel="stylesheet" href="{{URL::asset('template/vendors/fancybox/jquery.fancybox.min.css')}}" />
	<link rel="stylesheet" href="{{URL::asset('template/vendors/sweetalert2/dist/sweetalert2.min.css')}}" />
	<link type="text/css" media="screen" rel="stylesheet" href="{{ URL::asset('template/vendors/jqueryui/jquery-ui.css')}}" />
	<link type="text/css" media="screen" rel="stylesheet" href="{{{ URL::asset('template/vendors/daterangepicker/daterangepicker.css')}}}" />
	<link type="text/css" media="screen" rel="stylesheet" src="{{ URL::asset('template/vendors/datetimepicker/bootstrap-datetimepicker.min.css') }}"></link>
	<link type="text/css" media="screen" rel="stylesheet" href="{{{ URL::asset('template/vendors/select2/dist/css/select2.min.css')}}}" />
	<link type="text/css" media="screen" rel="stylesheet" href="{{ URL::asset('template/vendors/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" />
	<link href="{{URL::asset('template/vendors/@coreui/icons/css/free.min.css')}}" rel="stylesheet">
	<link href="{{URL::asset('template/vendors/@coreui/icons/css/coreui-icons.min.css')}}" rel="stylesheet">
	<link href="{{URL::asset('template/vendors/flag-icon-css/css/flag-icon.min.css')}}" rel="stylesheet">
	<link href="{{URL::asset('template/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
	<link href="{{URL::asset('template/vendors/simple-line-icons/css/simple-line-icons.css')}}" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.1.6/css/fixedHeader.dataTables.min.css" />
	<link type="text/css" media="screen" rel="stylesheet" href="{{ URL::asset('template/vendors/codemirror/css/codemirror.css')}}">

	<meta name="_token" content="{{ csrf_token() }}">
	<script src="{{URL::asset('template/vendors/jquery/js/jquery.min.js')}}"></script>
	<style type="text/css">
		.page-item.active .page-link{
			color:#000 !important;
		}
		.activeicon {
			fill: #fff !important;
		}
		@media (max-width: 768px)
	    {
	    	.jam{
	    		display: none;
	    	}
		}
		.g-sidenav-show.g-sidenav-pinned .sidenav {
			z-index: 1;
		}
		#ui-datepicker-div{
			z-index: 100 !important;
		}
	    .nowrap{
	    	white-space: nowrap;
	    }
	    .dropdown-item .badge {
	        position: absolute;
	        right: 10px;
	        margin-top: 2px;
	    }
	    .right-align {
	        text-align: right;
	    }
	    .center-align {
	        text-align: center;
	    }
	    .col-center {
	        margin: 0 auto;
	    }
	    .readonlycustom {
	        color: #303030;
	    }
	    .errorform {
	        color: red;
			font-size: 12px;
	    }
	    .errorformfile {
	        padding-top: 10px;
			font-size: 12px;
	        color: red;
	    }
	    .row-center {
	        margin: 0 auto;
	    }
	    .select2-container .select2-selection--single{
	    	height: 40px;
	    }
	    .select2-container .select2-selection--single .select2-selection__rendered{
	    	margin-top: 4px;
	    }
	    .select2-container--default .select2-selection--single .select2-selection__arrow b{
	    	margin-top: 4px;
	    }
		#input2-group2{
			height: 42px !important;
		}
		.width100{
			width:100%
		}
		.sidenav-header
		{
			text-align:center !important;
		}
	    .scrolltable{
	        overflow-x: auto;
			overflow-y: none !important;
			height:650px;
	    }
		input[type=file]::file-selector-button {
			margin-right: 20px;
			border: none;
			background: #000;
			padding: 5px 20px;
			border-radius: 10px;
			color: #fff;
			cursor: pointer;
			transition: background .2s ease-in-out;
		}

		input[type=file]::file-selector-button:hover {
			background: #F57328;
		}
		.alert-danger{
			color:#ffffff;
		}
		.input-mini{
			width:100% !important;
		}
		.daterangepicker .ranges .range_inputs>div:nth-child(2){
			padding-left:0 !important;
		}
		.btn-ordering{
			width:100%;
			text-align:left;
		}
	</style>
    <script type="text/javascript">
        jQuery(document).ready(function () {
            //Select2
                $('.select2').select2({
                    width: '100%',
                });
        });
    </script>
</head>

<body class="g-sidenav-show  bg-gray-100">
	@include('dashboard.layouts.sidebar')
	<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
		@include('dashboard.layouts.header')
		<div class="container-fluid py-4">
			@yield('content')
			@include('dashboard.layouts.footer')
		</div>
  	</main>
		
	<script src="{{ URL::asset('template/vendors/jqueryui/jquery-ui.js') }}"></script>
    <script src="{{URL::asset('template/js/core/popper.min.js')}}"></script>
    <script src="{{URL::asset('template/js/core/bootstrap.min.js')}}"></script>
    <script src="{{URL::asset('template/js/plugins/perfect-scrollbar.min.js')}}"></script>
    <script src="{{URL::asset('template/js/plugins/smooth-scrollbar.min.js')}}"></script>
	<script src="{{URL::asset('template/vendors/pace-progress/js/pace.min.js')}}"></script>
	<script src="{{URL::asset('template/vendors/@coreui/coreui-pro/js/coreui.bundle.min.js')}}"></script>
	<script src="{{URL::asset('template/vendors/fancybox/jquery.fancybox.min.js')}}"></script>
	<script src="{{URL::asset('template/vendors/sweetalert2/dist/sweetalert2.min.js')}}"></script>
	<script src="{{URL::asset('template/vendors/sweetalert2/sweet-alert.init.js')}}"></script>
	<script src="{{ URL::asset('template/vendors/price/jquery.price.js') }}"></script>
	<script type="text/javascript" src="{{{ URL::asset('template/vendors/daterangepicker/moment.js')}}}"></script>
	<script type="text/javascript" src="{{{ URL::asset('template/vendors/daterangepicker/daterangepicker.js')}}}"></script>
	<script type="text/javascript" src="{{ URL::asset('template/vendors/datetimepicker/bootstrap-datetimepicker.min.js') }}"></script>
	<script type="text/javascript" src="{{ URL::asset('template/vendors/select2/dist/js/select2.full.min.js') }}"></script>
	<script type="text/javascript" src="{{ URL::asset('template/vendors/templateEditor/ckeditor/ckeditor.js') }} "></script>
	<script type="text/javascript" src="{{ URL::asset('template/vendors/datatables.net/js/jquery.dataTables.js') }}"></script>
	<script type="text/javascript" src="{{ URL::asset('template/vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
	<script src="{{URL::asset('template/js/tooltips.js')}}"></script>
	<script src="{{URL::asset('template/js/datatables.js')}}"></script>
	<script type="text/javascript" src="{{ URL::asset('template/vendors/chained/jquery.chained.js') }}"></script>
	<script type="text/javascript" src="{{ URL::asset('template/vendors/mousewheel/jquery.mousewheel.min.js') }}"></script>
	<script src="https://cdn.datatables.net/fixedheader/3.1.6/js/dataTables.fixedHeader.min.js"></script>
    <script type="text/javascript" src="{{ URL::asset('template/vendors/codemirror/js/codemirror.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('template/vendors/codemirror/js/xml.js') }}"></script>
  	<script src="{{URL::asset('template/js/soft-ui-dashboard.min.js?v=1.0.6')}}"></script>
	<script type="text/javascript">
		$(function() {
		   	$(".scrolltable").mousewheel(function(event, delta) {
		    	this.scrollLeft -= (delta * 30);
		    	event.preventDefault();
		   	});
		});
	    jQuery(document).ready(function () {
			//Scrollbar
				var win = navigator.platform.indexOf('Win') > -1;
				if (win && document.querySelector('#sidenav-scrollbar')) {
				var options = {
					damping: '0.5'
				}
				Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
				}

	        //Number
	            $('.number_form').keyup(function () {
	                this.value = this.value.replace(/[^0-9\.]/g, '');
	            });

	        //Price
	            $('.price-format').priceFormat({
	                clearPrefix: true,
		        	allowNegative: true,
	            });

	        //Daterangepicker
		   		var dateNowRange = new Date();
	       		$('.getStartEndDate').daterangepicker({
	       		    startDate   : dateNowRange,
	       		    endDate     : dateNowRange,
	       		   	separator 	: " sampai ",
				    locale: {
				      	monthNames: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'],
				      	cancelLabel: "Batal",
        				fromLabel: "Dari",
        				toLabel: "Sampai",
        				customRangeLabel: "Pilih Sendiri",
        				daysOfWeek: [
							            "Mi",
							            "Se",
							            "Se",
							            "Ra",
							            "Ka",
							            "Ju",
							            "Sa"
							        ],
				    },
	       		    ranges: {
	       		       'Hari Ini': [moment(), moment()],
	       		       'Kemarin': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
	       		       '7 Hari Terakhir': [moment().subtract(6, 'days'), moment()],
	       		       '30 Hari Terakhir': [moment().subtract(29, 'days'), moment()],
	       		       'Bulan Ini': [moment().startOf('month'), moment().endOf('month')],
	       		       'Akhir Bulan': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
	       		    },
	       		    "showDropdowns": true,
	       		    timePicker: false,
	       		    timePickerSeconds: false,
	       		    timePicker12Hour: false,
	       		    timePickerIncrement: 1,
	       		    format      : 'DD MMM YYYY'
	       		});

	       		var dateNowRange = new Date();
	       		$('.getStartEndDateRange').daterangepicker({
	       		    startDate   : dateNowRange,
	       		    endDate     : dateNowRange,
	       		   	separator 	: " sampai ",
				    locale: {
				      	monthNames: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'],
				      	cancelLabel: "Batal",
        				fromLabel: "Dari",
        				toLabel: "Sampai",
        				customRangeLabel: "Pilih Sendiri",
        				daysOfWeek: [
							            "Mi",
							            "Se",
							            "Se",
							            "Ra",
							            "Ka",
							            "Ju",
							            "Sa"
							        ],
				    },
	       		    "showDropdowns": true,
	       		    timePicker: false,
	       		    format      : 'DD MMM YYYY'
	       		});

	       		var dateNowRange = new Date();
	       		$('.getStartEndDateTime').daterangepicker({
	       		    startDate   : dateNowRange,
	       		    endDate     : dateNowRange,
	       		   	separator 	: " sampai ",
				    locale: {
				      	monthNames: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'],
				      	cancelLabel: "Batal",
        				fromLabel: "Dari",
        				toLabel: "Sampai",
        				customRangeLabel: "Pilih Sendiri",
        				daysOfWeek: [
							            "Mi",
							            "Se",
							            "Se",
							            "Ra",
							            "Ka",
							            "Ju",
							            "Sa"
							        ],
				    },
	       		    ranges: {
	       		       'Hari Ini': [moment(), moment()],
	       		       'Kemarin': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
	       		       '7 Hari Terakhir': [moment().subtract(6, 'days'), moment()],
	       		       '30 Hari Terakhir': [moment().subtract(29, 'days'), moment()],
	       		       'Bulan Ini': [moment().startOf('month'), moment().endOf('month')],
	       		       'Akhir Bulan': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
	       		    },
	       		    "showDropdowns": true,
	       		    timePicker: true,
	       		    timePickerSeconds: true,
	       		    timePicker12Hour: false,
	       		    timePickerIncrement: 1,
	       		    format      : 'DD MMM YYYY HH:mm:ss'
	       		});

	        //Datepicker
	            $('.getDate').datepicker({
	                dayNames: ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'],
	            	dayNamesMin: ['Mi', 'Sn', 'Sl', 'Rb', 'Km', 'Jm', 'Sb'],
	            	dayNamesShort: ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'],
	            	monthNamesShort: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'],
	            	dateFormat: "dd M yy",
	            	changeMonth: true,
	            	changeYear: true,
	            });
	            $('.getDateTime').datetimepicker({
	                dayNames: ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'],
	            	dayNamesMin: ['Mi', 'Sn', 'Sl', 'Rb', 'Km', 'Jm', 'Sb'],
	            	dayNamesShort: ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'],
	            	monthNamesShort: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'],
	            	dateFormat: "dd M yy",
					timeFormat: "HH:mm:ss",
	            	changeMonth: true,
	            	changeYear: true,
					enableTime: true,
	            });

	        //Month Year
	        	$('.getDateMonthYear').datepicker({
	        		monthNamesShort: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'],
	        		changeMonth: true,
	        		changeYear: true,
	        		dateFormat: "M yy",
	        		showButtonPanel: true,
	        		onClose: function() {
				        var iMonth = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
				        var iYear = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
				        $(this).datepicker('setDate', new Date(iYear, iMonth, 1));
				   	},
				   	closeText : "Pilih",
				   	currentText : "Bulan Ini",
	        	});

	     	//Timepicker
	     	    $('.getTime').timepicker({
	     	        timeFormat: 'HH:mm:ss',
	     	    });
	     	    
	     	    $('.getHours').timepicker({
	     	        timeFormat: 'HH:mm',
	     	    });

	        //Datatable
	            $('#tablesort').DataTable({
	                "paging": false,
	                "ordering": true,
	                "info": false,
	                "searching": false,
	            });

	            $('#tablesort1').DataTable({
	                "paging": false,
	                "ordering": true,
	                "info": false,
	                "searching": false,
	            });

	            $('#tablefixed').DataTable({
	                "paging": false,
	                "ordering": false,
	                "info": false,
	                "searching": false,
	                fixedHeader: {
	                	header: true,
				    },
			        "scrollY": 500,
			        "scrollX": true
	            });

	        //Sweet Alert
	            $('.showModalHapus').click(function () {
	                var that = this;
	                var myLabel = $(that).data('nama');
	                var myLink = $(that).data('link');
	                swal({
	                    title: "Anda yakin ingin mehapus " + myLabel + "?",
	                    text: "Data akan dihapus dan Anda tidak dapat mengembalikan",
	                    type: "info",
	                    showCancelButton: true,
	                    confirmButtonColor: "#dc3545",
	                    confirmButtonText: "Ya",
	                    cancelButtonText: "Batal"
	                }).then((result) => {
	                    if (result.value) {
	                        swal({
	                            title: "Delete",
	                            text: "Data anda berhasil di hapus",
	                            type: "info"
	                        }).then(function () {
	                            $.ajax({
	                                type: 'GET',
	                                url: myLink,
	                                headers: { 'X-CSRF-Token': $('meta[name=_token]').attr('content') },
	                                success: function (data) {
	                                    location.reload();
	                                }
	                            });
	                        });
	                    }
	                    else if (result.dismiss === swal.DismissReason.cancel) {
	                        swal(
	                            'Batal',
	                            'Tidak ada perubahan yang dilakukan.',
	                            'error'
	                        )
	                    }
	                });
	            });

	        //Menu
	            $('#urutan_halaman').sortable({
	                handle: 'span',
	                update: function (event, ui) {
	                    $.ajaxSetup({
	                        headers: { 'X-CSRF-Token': $('meta[name=_token]').attr('content') }
	                    });
	                    $.post("{{URL('dashboard/menu/prosesurutan')}}", { type: "urutanHalaman", namaHalaman: $('#urutan_halaman').sortable('serialize') });
	                }
	            });

	        //CKeditor
	            for (no = 1; no <= 10; no++) {
	                if ($('#editor' + no).attr('class') != undefined) {
	                    CKEDITOR.replace('editor' + no,
	                        {
	                            extraPlugins: 'divarea',
	                            on: {
	                                instanceReady: function () {
	                                    this.editable().setStyle('background-color', '#ffffff');
	                                }
	                            },
	                            filebrowserBrowseUrl: '{{ URL("/") }}/template/vendors/templateEditor/kcfinder/browse.php?opener=ckeditor&type=files',
	                            filebrowserImageBrowseUrl: '{{ URL("/") }}/template/vendors/templateEditor/kcfinder/browse.php?opener=ckeditor&type=images',
	                            filebrowserFlashBrowseUrl: '{{ URL("/") }}/template/vendors/templateEditor/kcfinder/browse.php?opener=ckeditor&type=flash',

	                            filebrowserUploadUrl: '{{ URL("/") }}/template/vendors/templateEditor/kcfinder/upload.php?opener=ckeditor&type=files',
	                            filebrowserImageUploadUrl: '{{ URL("/") }}/template/vendors/templateEditor/kcfinder/upload.php?opener=ckeditor&type=images',
	                            filebrowserFlashUploadUrl: '{{ URL("/") }}/template/vendors/templateEditor/kcfinder/upload.php?opener=ckeditor&type=flash',
	                            font_names: 'Arial/Arial, Helvetica, sans-serif;' +
	                                'Comic Sans MS/Comic Sans MS, cursive;' +
	                                'Courier New/Courier New, Courier, monospace;' +
	                                'Georgia/Georgia, serif;' +
	                                'Lucida Sans Unicode/Lucida Sans Unicode, Lucida Grande, sans-serif;' +
	                                'Tahoma/Tahoma, Geneva, sans-serif;' +
	                                'Times New Roman/Times New Roman, Times, serif;' +
	                                'Trebuchet MS/Trebuchet MS, Helvetica, sans-serif;' +
	                                'Verdana/Verdana, Geneva, sans-serif',
	                        });
	                }
	                CKEDITOR.on('dialogDefinition', function (ev) {
	                    var dialogName = ev.data.name,
	                        dialogDefinition = ev.data.definition;
	                    if (dialogName === 'image') {
	                        dialogDefinition.removeContents('Upload');
	                    }
	                });
	            }

	        //Fitur Sub Menu
	        @if (Request:: segment(3) == 'tambah_submenu' || Request:: segment(3) == 'edit_submenu')
		        checkCheckedSubMenu();
		        $("#fitur_lihat").click(function () {
		            checkCheckedSubMenu();
		        });

		        function checkCheckedSubMenu() {
		            if ($('#fitur_lihat').prop('checked') == true) {
		                $('#fitur_baca').prop('disabled', false);
		                $('#fitur_tambah').prop('disabled', false);
		                $('#fitur_edit').prop('disabled', false);
		                $('#fitur_hapus').prop('disabled', false);
		                $('#fitur_cetak').prop('disabled', false);
		            }
		            else {
		                $('#fitur_baca').prop('checked', false);
		                $('#fitur_baca').prop('disabled', true);
		                $('#fitur_tambah').prop('checked', false);
		                $('#fitur_tambah').prop('disabled', true);
		                $('#fitur_edit').prop('checked', false);
		                $('#fitur_edit').prop('disabled', true);
		                $('#fitur_hapus').prop('checked', false);
		                $('#fitur_hapus').prop('disabled', true);
		                $('#fitur_cetak').prop('checked', false);
		                $('#fitur_cetak').prop('disabled', true);
		            }
		        }
		    @endif

		        //Level System
			        //Check Checkbox Before
				        var check_checkbox_one_lihat = $('input[class="chk-lihat"]').prop('checked');
				        if (check_checkbox_one_lihat == false)
				            $('input[class="chk-all-lihat"]').prop('checked', false);
				        else if (check_checkbox_one_lihat == true) {
				            var check_checked = $('input:checkbox:checked.chk-lihat').length;
				            var check_unchecked = $('input:checkbox.chk-lihat').length;
				            if (check_checked == check_unchecked)
				                $('input[class="chk-all-lihat"]').prop('checked', true);
				        }

				        var check_checkbox_one_baca = $('input[class="chk-baca"]').prop('checked');
				        if (check_checkbox_one_baca == false)
				            $('input[class="chk-all-baca"]').prop('checked', false);
				        else if (check_checkbox_one_baca == true) {
				            var check_checked = $('input:checkbox:checked.chk-baca').length;
				            var check_unchecked = $('input:checkbox.chk-baca').length;
				            if (check_checked == check_unchecked)
				                $('input[class="chk-all-baca"]').prop('checked', true);
				        }

				        var check_checkbox_one_tambah = $('input[class="chk-tambah"]').prop('checked');
				        if (check_checkbox_one_tambah == false)
				            $('input[class="chk-all-tambah"]').prop('checked', false);
				        else if (check_checkbox_one_tambah == true) {
				            var check_checked = $('input:checkbox:checked.chk-tambah').length;
				            var check_unchecked = $('input:checkbox.chk-tambah').length;
				            if (check_checked == check_unchecked)
				                $('input[class="chk-all-tambah"]').prop('checked', true);
				        }

				        var check_checkbox_one_edit = $('input[class="chk-edit"]').prop('checked');
				        if (check_checkbox_one_edit == false)
				            $('input[class="chk-all-edit"]').prop('checked', false);
				        else if (check_checkbox_one_edit == true) {
				            var check_checked = $('input:checkbox:checked.chk-edit').length;
				            var check_unchecked = $('input:checkbox.chk-edit').length;
				            if (check_checked == check_unchecked)
				                $('input[class="chk-all-edit"]').prop('checked', true);
				        }

				        var check_checkbox_one_hapus = $('input[class="chk-hapus"]').prop('checked');
				        if (check_checkbox_one_hapus == false)
				            $('input[class="chk-all-hapus"]').prop('checked', false);
				        else if (check_checkbox_one_hapus == true) {
				            var check_checked = $('input:checkbox:checked.chk-hapus').length;
				            var check_unchecked = $('input:checkbox.chk-hapus').length;
				            if (check_checked == check_unchecked)
				                $('input[class="chk-all-hapus"]').prop('checked', true);
				        }

				        var check_checkbox_one_cetak = $('input[class="chk-cetak"]').prop('checked');
				        if (check_checkbox_one_cetak == false)
				            $('input[class="chk-all-cetak"]').prop('checked', false);
				        else if (check_checkbox_one_cetak == true) {
				            var check_checked = $('input:checkbox:checked.chk-cetak').length;
				            var check_unchecked = $('input:checkbox.chk-cetak').length;
				            if (check_checked == check_unchecked)
				                $('input[class="chk-all-cetak"]').prop('checked', true);
				        }

			        //All Checkbox
				        $('input[class="chk-all-lihat"]').click(function () {
				            var check_checkbox_all = $('input[class="chk-all-lihat"]').prop('checked');
				            console.log(check_checkbox_all);
				            if (check_checkbox_all == true)
				                $('input[class="chk-lihat"]').prop('checked', true);
				            else if (check_checkbox_all == false)
				                $('input[class="chk-lihat"]').prop('checked', false);
				        });

				        $('input[class="chk-all-baca"]').click(function () {
				            var check_checkbox_all = $('input[class="chk-all-baca"]').prop('checked');
				            if (check_checkbox_all == true)
				                $('input[class="chk-baca"]').prop('checked', true);
				            else if (check_checkbox_all == false)
				                $('input[class="chk-baca"]').prop('checked', false);
				        });

				        $('input[class="chk-all-tambah"]').click(function () {
				            var check_checkbox_all = $('input[class="chk-all-tambah"]').prop('checked');
				            if (check_checkbox_all == true)
				                $('input[class="chk-tambah"]').prop('checked', true);
				            else if (check_checkbox_all == false)
				                $('input[class="chk-tambah"]').prop('checked', false);
				        });

				        $('input[class="chk-all-edit"]').click(function () {
				            var check_checkbox_all = $('input[class="chk-all-edit"]').prop('checked');
				            if (check_checkbox_all == true)
				                $('input[class="chk-edit"]').prop('checked', true);
				            else if (check_checkbox_all == false)
				                $('input[class="chk-edit"]').prop('checked', false);
				        });

				        $('input[class="chk-all-hapus"]').click(function () {
				            var check_checkbox_all = $('input[class="chk-all-hapus"]').prop('checked');
				            if (check_checkbox_all == true)
				                $('input[class="chk-hapus"]').prop('checked', true);
				            else if (check_checkbox_all == false)
				                $('input[class="chk-hapus"]').prop('checked', false);
				        });

				        $('input[class="chk-all-cetak"]').click(function () {
				            var check_checkbox_all = $('input[class="chk-all-cetak"]').prop('checked');
				            if (check_checkbox_all == true)
				                $('input[class="chk-cetak"]').prop('checked', true);
				            else if (check_checkbox_all == false)
				                $('input[class="chk-cetak"]').prop('checked', false);
				        });

			        //One Checkbox
				        $('input[class="chk-lihat"]').click(function () {
				            var check_checked = $('input:checkbox:checked.chk-lihat').length;
				            var check_unchecked = $('input:checkbox.chk-lihat').length;
				            if (check_checked == check_unchecked)
				                $('input[class="chk-all-lihat"]').prop('checked', true);
				            else
				                $('input[class="chk-all-lihat"]').prop('checked', false);
				        });

				        $('input[class="chk-baca"]').click(function () {
				            var check_checked = $('input:checkbox:checked.chk-baca').length;
				            var check_unchecked = $('input:checkbox.chk-baca').length;
				            if (check_checked == check_unchecked)
				                $('input[class="chk-all-baca"]').prop('checked', true);
				            else
				                $('input[class="chk-all-baca"]').prop('checked', false);
				        });

				        $('input[class="chk-tambah"]').click(function () {
				            var check_checked = $('input:checkbox:checked.chk-tambah').length;
				            var check_unchecked = $('input:checkbox.chk-tambah').length;
				            if (check_checked == check_unchecked)
				                $('input[class="chk-all-tambah"]').prop('checked', true);
				            else
				                $('input[class="chk-all-tambah"]').prop('checked', false);
				        });

				        $('input[class="chk-edit"]').click(function () {
				            var check_checked = $('input:checkbox:checked.chk-edit').length;
				            var check_unchecked = $('input:checkbox.chk-edit').length;
				            if (check_checked == check_unchecked)
				                $('input[class="chk-all-edit"]').prop('checked', true);
				            else
				                $('input[class="chk-all-edit"]').prop('checked', false);
				        });

				        $('input[class="chk-hapus"]').click(function () {
				            var check_checked = $('input:checkbox:checked.chk-hapus').length;
				            var check_unchecked = $('input:checkbox.chk-hapus').length;
				            if (check_checked == check_unchecked)
				                $('input[class="chk-all-hapus"]').prop('checked', true);
				            else
				                $('input[class="chk-all-hapus"]').prop('checked', false);
				        });

				        $('input[class="chk-cetak"]').click(function () {
				            var check_checked = $('input:checkbox:checked.chk-cetak').length;
				            var check_unchecked = $('input:checkbox.chk-cetak').length;
				            if (check_checked == check_unchecked)
				                $('input[class="chk-all-cetak"]').prop('checked', true);
				            else
				                $('input[class="chk-all-cetak"]').prop('checked', false);
				        });
	        });
  </script>
</body>

</html>