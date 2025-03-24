@extends('back.layout.pages-layout')
@section('pageTitle', isset($pageTitle)? $pageTitle : "Page Title Here")
@section('content')

@livewire('admin.categories')

@endsection

@push('scripts')
    <script>
    $(document).ready(function() {

        // Konfigurasi Toastr
        toastr.options = {
            "timeOut": "3000",
            "positionClass": "toast-top-center"
        };

        window.addEventListener('showParentCategoryModalForm',function(){
            $('#pcategory_modal').modal('show');
        });
        window.addEventListener('hideParentCategoryModalForm',function(){
            $('#pcategory_modal').modal('hide');
        });
        window.addEventListener('showCategoryModalForm',function(){
            $('#category_modal').modal('show');
        });
        window.addEventListener('hideCategoryModalForm',function(){
            $('#category_modal').modal('hide');
        });

        $('table tbody#sortable_parent_categories').sortable({
            cursor:"move",
            update:function(event, ui){
                $(this).children().each(function(index){
                   if($(this).attr('data-ordering') != (index + 1)){
                    $(this).attr('data-ordering',(index+1)).addClass('updated');
                   }
                });
                var positions = [];
                $('.updated').each(function(){
                    positions.push([$(this).attr('data-index'),$(this).attr('data-ordering')]);
                    $(this).removeClass('updated');
                });

                Livewire.dispatch('updateParentCategoryOrdering',[positions]);
            }
        });

        $('table tbody#sortable_categories').sortable({
            cursor:"move",
            update:function(event, ui){
                $(this).children().each(function(index){
                   if($(this).attr('data-ordering') != (index + 1)){
                    $(this).attr('data-ordering',(index+1)).addClass('updated');
                   }
                });
                var positions = [];
                $('.updated').each(function(){
                    positions.push([$(this).attr('data-index'),$(this).attr('data-ordering')]);
                    $(this).removeClass('updated');
                });

                Livewire.dispatch('updateCategoryOrdering',[positions]);
            }
        });


        window.addEventListener('deleteParentCategory',function(event){
            var id = event.detail[0].id;
            Swal.fire({
            title: 'Are you sure?',
            text: "You want to delete this parent category",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Delete'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.dispatch('deleteParentCategoryAction', [id]);
                }
            });
        });

        window.addEventListener('deleteCategory',function(event){
            var id = event.detail[0].id;
            Swal.fire({
            title: 'Are you sure?',
            text: "You want to delete this category",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Delete'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.dispatch('deleteCategoryAction', [id]);
                }
            });
        });

        window.addEventListener('postDeleted', function(event) {
            var message = event.detail[0].message;
            var status = event.detail[0].status;

            if (status === 'success') {
                toastr.success(message);
            } else if (status === 'error') {
                toastr.error(message);
            } else {
              toastr.info(message);
            }

        });

    });

    </script>
@endpush
