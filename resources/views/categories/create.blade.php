<!DOCTYPE html>
<html lang="en">
    <head>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
 

    </head>
<body>
    <div class="row">
        <div class="col-md-6 offset-md-3" style="margin-top: 100px">
            <!-- Trigger button -->
            <a href="#" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Category</a>
        </div>
    
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
           <form action="" id="ajax">
            @csrf
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Category</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
    
                    <!-- Modal Body -->
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="name">Name</label>
                            <input type="text" id="name" class="form-control" name="name" placeholder="Enter category name">
                            <span id="nameError" class="text-danger"></span>
                        </div>
                        <div class="form-group mb-3">
                            <label for="type">Type</label>
                            <select id="type"  name="type" class="form-select">
                                <option disabled selected>Choose Option</option>
                                <option value="electronic">Electronic</option>
                                <option value="furniture">Furniture</option>
                                <option value="grocery">Grocery</option>
                            </select>
                            <span id="categoryError" class="text-danger"></span>

                        </div>
                    </div>
    
                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="savebtn"></button>
                    </div>
                </div>
            </div>
           </form>
        </div>
    </div>













    {{-- error modal --}}
    <div class="modal fade " id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog mt-5  ">
            <div class="modal-content  ">
                <div class="modal-header bg-dark ">
                    <h5 class="modal-title text-white" id="successModalLabel">failed</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body bg-dark text-white">
                    Category cannot be added!
                </div>
                <div class="modal-footer bg-dark">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>
    


{{-- display data --}}
<div class="col-11">
<table class="table table-hover table-bordered table-striped my-5  mx-5 text-center" id="table">
    <thead class="table-light">
        <tr>
            <th>Sr#</th>
            
            <th>Name</th>
            <th>Category</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1; ?>
        @foreach ($items as $item)
        <tr id="category-{{ $item->id }}">
            <td>{{ $i++ }}</td>
            
            <td>{{ $item->name }}</td>
            <td>{{ ucfirst($item->category) }}</td>
            <td>
                <div class="d-flex justify-content-center gap-2">
                    <button type="button" class="btn btn-primary update-btn btn-sm" data-id="{{ $item->id }}" data-name="{{ $item->name }}" data-category="{{ $item->category }}">
                        <i class="fas fa-pencil-alt"></i> Update
                    </button>
                    <button type="button" class="btn btn-danger delete-btn btn-sm" data-id="{{ $item->id }}">
                        <i class="fas fa-trash"></i> Delete
                    </button>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

</div> 
<div class="toast-container position-fixed bottom-0 end-0 p-3" id="toast-container"></div>





{{-- delete modal --}}
<div class="modal" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Delete</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Are you sure you want to delete this category?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
        </div>
      </div>
    </div>
  </div>
  
  
  {{-- update modal --}}
  <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">Update Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="updateForm">
                    <input type="hidden" id="categoryId">
                    <div class="form-group">
                        <label for="updateName">Name</label>
                        <input type="text" class="form-control" id="updateName" name="name">
                    </div>
                    <div class="form-group">
                        <label for="updateCategory">Category</label>
                        <select id="updateCategory" name="category" class="form-select">
                            <option value="electronic">Electronic</option>
                            <option value="furniture">Furniture</option>
                            <option value="grocery">Grocery</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="updateCategoryBtn">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    





<script>
$(document).ready(function () {

$('#exampleModalLabel').html("Create Category");
$('#savebtn').html("Save");

// $('#savebtn').click(function () {
//     var form = $('#ajax')[0];
//     var ajax = new FormData(form);

//     $.ajax({
//         url: '{{ route('store') }}',
//         method: 'POST',
//         processData: false,
//         contentType: false,
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         },
//         data: ajax,
//         success: function (response) {
//             $('#ajax')[0].reset();
//             $('#exampleModal').modal('hide');
            
//             location.reload();

//             Swal.fire({
//                 title: "Success!",
//                 text: "Category added successfully!",
//                 icon: "success"
//             });
//         },
//         error: function (error) {
//             if (error.responseJSON) {
//                 $('#nameError').html(error.responseJSON.errors.name || '');
//                 $('#categoryError').html(error.responseJSON.errors.type || '');
//             }

//             $('#successModal').modal('show');
//         }
//     });
// });
$('#savebtn').click(function () {
    var form = $('#ajax')[0];
    var ajax = new FormData(form);

    $.ajax({
        url: '{{ route('store') }}',
        method: 'POST',
        processData: false,
        contentType: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: ajax,
        success: function (response) {
            $('#ajax')[0].reset();
            $('#exampleModal').modal('hide');

            // Append the new row to the table dynamically
            var newRow = `
                <tr id="category-${response.id}">
                    <td>{{ $i++ }}</td>
                    
                    <td>${response.name}</td>
                    <td>${response.category}</td>
                    <td>
                        <div class="d-flex justify-content-center gap-2">
                            <button type="button" class="btn btn-primary update-btn btn-sm" 
                                data-id="${response.id}" 
                                data-name="${response.name}" 
                                data-category="${response.category}">
                                <i class="fas fa-pencil-alt"></i> Update
                            </button>
                            <button type="button" class="btn btn-danger delete-btn btn-sm" 
                                data-id="${response.id}">
                                 <i class="fas fa-trash"></i> Delete
                            </button>
                        </div>
                    </td>
                </tr>`;
            $('#table tbody').append(newRow);

            Swal.fire({
                title: "Success!",
                text: "Category added successfully!",
                icon: "success"
            });
        },
        error: function (error) {
            if (error.responseJSON) {
                $('#nameError').html(error.responseJSON.errors.name || '');
                $('#categoryError').html(error.responseJSON.errors.type || '');
            }
            $('#successModal').modal('show');
        }
    });
});

});


</script>
{{-- <script>
    $(document).ready(function() {
        $(".delete-btn").click(function() {
            var categoryId = $(this).data('id');
            
            $("#confirmDeleteModal").modal('show');
            
            $("#confirmDeleteBtn").click(function() {
                $.ajax({
                    url: '{{ route('delete') }}',
                    method: 'POST',
                    data: {
                        id: categoryId,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $('#category-' + categoryId).fadeOut(300, function() {
                            $(this).remove();
                        });
                        $("#confirmDeleteModal").modal('hide');  
                       

                        Swal.fire({
                title: "Success!",
                text: "Category deleted successfully!",
                icon: "success"
            });
            // location.reload();

                    },
                    error: function(error) {
                        alert(error.responseJSON.error);  
                    }
                });
            });
        });
    });
    </script> --}}
    <script>
        $(document).ready(function () {
            var categoryId; 
    
            $(".delete-btn").click(function () {
                categoryId = $(this).data('id');
                $("#confirmDeleteModal").modal('show'); 
            });
    
            $("#confirmDeleteBtn").off("click").on("click", function () {
                $.ajax({
                    url: '{{ route('delete') }}', 
                    method: 'POST',
                    data: {
                        id: categoryId,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        if (response.success) {
                            $('#category-' + categoryId).fadeOut(300, function () {
                                $(this).remove(); 
                            });
    
                            $("#confirmDeleteModal").modal('hide');
    
                            Swal.fire({
                                title: "Success!",
                                text: "Category deleted successfully!",
                                icon: "success"
                            });
                        } else {
                            Swal.fire({
                                title: "Error!",
                                text: response.message || "Something went wrong.",
                                icon: "error"
                            });
                        }
                    },
                    error: function (error) {
                        Swal.fire({
                            title: "Error!",
                            text: error.responseJSON?.error || "Something went wrong.",
                            icon: "error"
                        });
                    }
                });
            });
        });
    </script>
    
    
    
    

<script>
    $(document).ready(function() {
        $(".update-btn").click(function() {
            var categoryId = $(this).data('id');
            var categoryName = $(this).data('name');
            var categoryType = $(this).data('category');
            
            $("#categoryId").val(categoryId);
            $("#updateName").val(categoryName);
            $("#updateCategory").val(categoryType);
    
            $("#updateModal").modal('show');
        });
    
        $("#updateCategoryBtn").click(function() {
            var categoryId = $("#categoryId").val();
            var categoryName = $("#updateName").val();
            var categoryType = $("#updateCategory").val();
    
            $.ajax({
                url: '{{ route('update') }}',
                method: 'PUT',
                data: {
                    id: categoryId,
                    name: categoryName,
                    category: categoryType,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    $('#category-' + categoryId).find('td:nth-child(2)').text(categoryName);
                    $('#category-' + categoryId).find('td:nth-child(3)').text(categoryType);
                                            // location.reload();

                    $("#updateModal").modal('hide');
                },
                error: function(error) {
                    alert('Error: ' + error.responseJSON.error);
                }
            });
        });
    });
    </script>

</body>
</html>