<x-layout>
    <x-setting heading="All Posts">
    <div class="container mt-5">
        <table class="table table-bordered" id='myTable'>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Title</th>
                    <th>Excerpt</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
       
    </body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript">
      $(function () {
        
        var table = $('#myTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('posts.list') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'title', name: 'title'},
                {data: 'excerpt', name: 'excerpt'},
                {
                    data: 'action', 
                    name: 'action', 
                    orderable: true, 
                    searchable: true
                },
            ]
        });
        
      });
    
      $('#myTable').on('click', 'button[data-id]', function (e) { 
        // $('#myTable').DataTable().row(this).remove().draw();
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var url = window.location.href+'/'+$(this).data('id');

        // confirm then
        $.ajax({
            url: url,
            type: 'DELETE',
            dataType: 'json',
            data: {method: '_DELETE', submit: true}
        }).always(function (data) {
            $('#myTable').DataTable().draw(false);
        });
        
    });
    
    </script>
    </html>
    
        
        </x-setting>
</x-layout>