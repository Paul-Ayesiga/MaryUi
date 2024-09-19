
    new DataTable('#example', {
        responsive: true,
        dom: '<"row"<"col-md-2"l><"col-md-6 text-center"B><"col-md-4"f>>rtip', // Include 'l' for length menu and 'B' for buttons
        buttons: [{
                text: '<i class="bi bi-plus"></i> Add',
                className: 'btn btn-primary',
                action: function (e, dt, node, config) {
                    $('#addEmployeeModal').modal('show');
                }
            },
            {
                extend: 'copy',
                text: '<i class="bi-copy"></i>',
                className: 'btn btn-secondary'
            },
            {
                extend: 'excel',
                text: '<i class="fas fa-file-excel"></i> ',
                className: 'btn btn-success'
            },
            {
                extend: 'pdf',
                text: '<i class="bi bi-pdf"></i>',
                className: 'btn btn-danger'
            },
            {
                extend: 'colvis',
                text: '<i class="fas fa-eye"></i> ',
                className: 'btn btn-info'
            }
        ],
        lengthMenu: [
            [10, 25, 50, 100],
            [10, 25, 50, 100]
        ], // Page length options

            language: {
                    search: "<i class='bi bi-search'></i>",
                    searchPlaceholder: "Search records"
                },
                ajax: {
                    url: FetchUrl,
                    method: 'GET',
                    dataSrc: 'data'
                },
                columns: [{
                        data: null,
                        defaultContent: '<input type="checkbox" name="emp_checkbox">',
                        orderable: false
                    },
                    {
                        data: 'id'
                    },
                    {
                        data: 'avatar',
                        render: function (data) {
                            return '<img src="storage/images/' + data + '" width="50" class="img-thumbnail rounded-circle preview-btn" data-bs-toggle="modal" data-bs-target="#previewImageModal" data-image="storage/images/' + data + '">';
                        }
                    },
                    {
                        data: 'first_name',
                        render: function (data, type, row) {
                            return data + ' ' + row.last_name;
                        }
                    },
                    {
                        data: 'email'
                    },
                    {
                        data: 'post'
                    },
                    {
                        data: 'phone'
                    },
                    {
                        data: null,
                        defaultContent: '<a href="#" class="btn btn-success btn-sm editIcon" data-bs-toggle="modal" data-bs-target="#editEmployeeModal"><i class="bi-pencil-square"></i> Edit</a> <a href="#" class="btn btn-danger btn-sm deleteIcon"><i class="bi-trash"></i> Delete</a>',
                        orderable: false
                    }
                ]
            });

            // Preview image modal
            $(document).on('click', '.preview-btn', function () {
                var imageSrc = $(this).data('image');
                $('#previewImage').attr('src', imageSrc);
            });

            // Edit button click handler
            $(document).on('click', '.editIcon', function () {
                var empId = $(this).attr('id');
                // Handle edit action
            });

            // Delete button click handler
            $(document).on('click', '.deleteIcon', function () {
            var empId = $(this).attr('id');
            // Handle delete action
            });


              // Column-specific filter functionality
              $('#filter_name').on('keyup change', function () {
                  table.column(3).search(this.value).draw(); // Filter by Name column (index 3)
              });

              $('#filter_email').on('keyup change', function () {
                  table.column(4).search(this.value).draw(); // Filter by Email column (index 4)
              });

              $('#filter_post').on('keyup change', function () {
                  table.column(5).search(this.value).draw(); // Filter by Post column (index 5)
              });

              // Handle select all checkbox
              $('#select_all').on('click', function () {
                  var isChecked = $(this).prop('checked');
                  $('input[name="emp_checkbox"]').prop('checked', isChecked);
              });

              // Handle bulk delete button click
              $('#bulk_delete').on('click', function () {
                  var selectedIds = [];
                  $('input[name="emp_checkbox"]:checked').each(function () {
                      selectedIds.push($(this).closest('tr').find('td').eq(1).text()); // Assuming ID is in the second column
                  });

                  if (selectedIds.length > 0) {
                      if (confirm('Are you sure you want to delete the selected records?')) {
                          $.ajax({
                              url: bulkDeleteUrl,
                              method: 'POST',
                              data: {
                                  ids: selectedIds,
                                  _token: '{{ csrf_token() }}'
                              },
                              success: function (response) {
                                  if (response.status == 'success') {
                                      table.ajax.reload(); // Reload the table data
                                      alert('Records deleted successfully');
                                  } else {
                                      alert('An error occurred');
                                  }
                              }
                          });
                      }
                  } else {
                      alert('No records selected');
                  }
              });

              // Handle individual delete button click
              $(document).on('click', '.deleteIcon', function () {
              var empId = $(this).attr('id');
              if (confirm('Are you sure you want to delete this record?')) {
                  $.ajax({
                      url: deleteUrl.replace(':id', empId),
                      method: 'DELETE',
                      data: {
                          _token: '{{ csrf_token() }}'
                      },
                      success: function (response) {
                          if (response.status == 'success') {
                              table.ajax.reload(); // Reload the table data
                              alert('Record deleted successfully');
                          } else {
                              alert('An error occurred');
                          }
                      }
                  });
              }
              });
