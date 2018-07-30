
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

<script src="https://unpkg.com/scrollreveal/dist/scrollreveal.min.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.18/b-1.5.2/b-flash-1.5.2/b-html5-1.5.2/b-print-1.5.2/r-2.2.2/datatables.min.js"></script>

@yield('javascript')

<script>
  $(document).ready(function() {

    @yield('jquery')

     window.sr = ScrollReveal();
      sr.reveal('#title', {
        duration: 1000,
        origin: 'top'
      });
      sr.reveal('#title2', {
        duration: 1000,
        delay: 1000,
        origin: 'bottom'
      });
      sr.reveal('#nav', {
        duration: 1000,
        delay: 2000,
        easing:'ease',
        origin: 'right'
      });

      table = $("#example").DataTable({
        responsive: true,
        buttons   : [
            {
            extend:    'csv',
            orientation: 'landscape',
            pageSize: 'LEGAL',
            text:      'CSV',
            titleAttr: 'CSV',
            className: 'btn btn-outline-light btn-sm',
            exportOptions: {
                columns: ':visible'
            }
            },
            {
            extend:    'pdf',
            orientation: 'landscape',
            pageSize: 'LEGAL',
            text:      'PDF',
            titleAttr: 'PDF',
            className: 'btn btn-outline-light btn-sm',
            exportOptions: {
                columns: ':visible'
            }
            },               
            {
            extend:    'print',
            orientation: 'landscape',
            pageSize: 'B4',
            text:      'Print',
            titleAttr: 'Print',
            className: 'btn btn-outline-light btn-sm',
            exportOptions: {
                columns: ':visible'
            }
            },  
        ]
    });
    table.buttons().container().insertBefore('#print');

  });
</script>