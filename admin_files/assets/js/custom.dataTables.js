$(document).ready(function() {
    setTimeout(function() {


        $('#list-users').DataTable({
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            dom: 'Blfrtip',
            buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
            "processing": true,
            "serverSide": true,
            "ajax": {
                url: "/search.php?w=users_list", 
                data: function(d){
                    d.user_status = $('#list-users').data('status');
                }
            }
        });

        $('.simple-table').DataTable();
    }, 500);
});
